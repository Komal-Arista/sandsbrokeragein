<?php
/**
 * Plugin Name: User CRUD Plugin
 * Description: A simple plugin to manage users with DataTables and CRUD operations only Super Manager can Access this.
 * Version: 1.0
 * Author: Komal Nagdev
 */

// Enqueue scripts and styles
function uct_enqueue_assets() {
    wp_enqueue_style('data-tables', 'https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css');
    wp_enqueue_script('data-tables', 'https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js', array('jquery'), null, true);

    if (current_user_can('super_manager')) {
        wp_enqueue_script('user-crud-js', plugin_dir_url(__FILE__) . 'assets/js/user-crud.js', array('jquery'), null, true);

        wp_localize_script('user-crud-js', 'uct_manager_vars', array(
            'ajaxurl' => admin_url('admin-ajax.php') 
        ));
    }
    
    if (current_user_can('super_admin')) {
        wp_enqueue_script('admin-user-crud-js', plugin_dir_url(__FILE__) . 'assets/js/admin-user-crud.js', array('jquery'), null, true);

        wp_localize_script('admin-user-crud-js', 'uct_admin_vars', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }

    // Custom style for the plugin
    wp_enqueue_style('user-crud-style', plugin_dir_url(__FILE__) . 'style.css');
}
add_action('wp_enqueue_scripts', 'uct_enqueue_assets');

// Shortcode for displaying the user CRUD interface
function uct_user_crud_shortcode() {
    
    if (!is_user_logged_in() || (!current_user_can('super_manager') && !current_user_can('super_admin'))) {
        return '<p>You do not have permission to access this page.</p>';
    }
    if (isset($_GET['action']) && $_GET['action'] === 'add') {
            if(current_user_can('super_manager')) {
                include(plugin_dir_path(__FILE__) . 'templates/add-user.php');
            }
            else if(current_user_can('super_admin')) {
                include(plugin_dir_path(__FILE__) . 'templates/add-user-admin.php');
            }
    } elseif (isset($_GET['action']) && $_GET['action'] === 'edit') {
        if(current_user_can('super_manager')) {
            include(plugin_dir_path(__FILE__) . 'templates/edit-user.php');
        }
        else if(current_user_can('super_admin')) {
            include(plugin_dir_path(__FILE__) . 'templates/edit-user-admin.php');
        }
    } else {
        include(plugin_dir_path(__FILE__) . 'templates/list-users.php');
    }
   
}
add_shortcode('user_crud', 'uct_user_crud_shortcode');

// function to fetch all users data
function uct_get_users() { 
    global $wpdb;
    $table_prefix = $wpdb->prefix;

    $current_user_id = get_current_user_id();
    $user_roles = get_userdata($current_user_id)->roles;
    $current_user_location = get_user_meta($current_user_id, 'user_location', true);

    // Base SQL query to fetch users (excluding the current user)
    $base_query = "SELECT u.ID, u.user_login, u.user_email, 
                        um_first.meta_value AS first_name,
                        um_last.meta_value AS last_name,
                        um_assigned_manager.meta_value AS assigned_manager,
                        um_role.meta_value AS wp_capabilities,
                        l.name AS user_location
                   FROM $wpdb->users u
                   LEFT JOIN $wpdb->usermeta um_first 
                   ON u.ID = um_first.user_id AND um_first.meta_key = 'first_name'
                   LEFT JOIN $wpdb->usermeta um_last 
                   ON u.ID = um_last.user_id AND um_last.meta_key = 'last_name'
                   LEFT JOIN $wpdb->usermeta um_assigned_manager 
                   ON u.ID = um_assigned_manager.user_id AND um_assigned_manager.meta_key = 'assigned_manager'
                   LEFT JOIN $wpdb->usermeta um_role 
                   ON u.ID = um_role.user_id AND um_role.meta_key = 'wp_capabilities'
                   LEFT JOIN $wpdb->usermeta um_location
                   ON u.ID = um_location.user_id AND um_location.meta_key = 'user_location'
                   LEFT JOIN wp_locations l 
                   ON um_location.meta_value = l.id
                   WHERE u.ID != %d"; // Exclude current user

    $query_params = [$current_user_id];

    // If the user is a Super Admin, fetch all users except Administrators
    if (in_array('super_admin', $user_roles)) {
        $base_query .= " AND um_role.meta_value NOT LIKE %s";
        $query_params[] = '%' . serialize(['administrator' => true]) . '%';
    }
    // If the user is a Super Manager, fetch only location-specific users (excluding Administrators & Super Admins)
    elseif (in_array('super_manager', $user_roles) && $current_user_location) {
        $base_query .= " AND um_location.meta_value = %s 
                         AND (um_role.meta_value NOT LIKE %s AND um_role.meta_value NOT LIKE %s)";
        $query_params[] = $current_user_location;
        $query_params[] = '%' . serialize(['administrator' => true]) . '%';
        $query_params[] = '%' . serialize(['super_admin' => true]) . '%';
    } else {
        wp_send_json_success(['data' => []]); // If role doesn't match, return empty data
        return;
    }

    $base_query .= " ORDER BY u.ID DESC"; 

    // Execute query
    $users = $wpdb->get_results($wpdb->prepare($base_query, ...$query_params));

    // Prepare the data for DataTables
    $data = [];
    foreach ($users as $user) {
        // Decode serialized wp_capabilities to get the role
        $roles = maybe_unserialize($user->wp_capabilities);
        $role = is_array($roles) ? key($roles) : 'N/A';

        if ($role === 'administrator' || $role === 'super_admin') {
            continue; // Skip administrators and super admins
        }

        // Check if user is a manager and has assigned agents
        $assigned_agents_count = 0;
        if ($role == 'manager' || $role == 'super_manager') {
            $assigned_agents_count = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT COUNT(agent_id) FROM {$table_prefix}agent_manager_relationships WHERE manager_id = %d",
                    $user->ID
                )
            );
        }

        // Disable delete button if assigned agents exist
        $delete_disabled = ($assigned_agents_count > 0) ? 'disabled' : '';
        $delete_class = ($assigned_agents_count > 0) ? 'disabled-button' : '';

        $data[] = [
            'ID' => $user->ID,
            'user_login' => $user->user_login,
            'user_name' => trim(($user->first_name ?? 'N/A') . ' ' . ($user->last_name ?? 'N/A')),
            'user_email' => $user->user_email,
            'user_role' => ucfirst($role) ?? 'N/A',
            'assigned_manager' => $user->assigned_manager 
                                   ? ucfirst(get_user_meta($user->assigned_manager, 'first_name', true)) . " " . ucfirst(get_user_meta($user->assigned_manager, 'last_name', true))
                                   : 'N/A',
            'user_location' => $user->user_location ?? 'N/A',
            'actions' => '<button class="edit-user" data-id="' . $user->ID . '">Edit</button>' .
                         '<button class="delete-user ' . $delete_class . '" data-id="' . $user->ID . '" ' . $delete_disabled . '>Delete</button>',
        ];
    }

    wp_send_json_success(['data' => $data]);
}
add_action('wp_ajax_uct_get_users', 'uct_get_users');

// AJAX action for deleting a user
function uct_delete_user() {
    // Validate user ID
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    if (!$user_id || !get_userdata($user_id)) {
        wp_send_json_error(['message' => 'Invalid user ID.']);
    }

    // Attempt to delete user
    if (wp_delete_user($user_id)) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'agent_manager_relationships';

        // Delete agent-manager relationship
        delete_user_meta($user_id, 'assigned_manager');
        $wpdb->delete($table_name, ['agent_id' => $user_id]);

        wp_send_json_success(['message' => 'User deleted successfully.']);
    } else {
        wp_send_json_error(['message' => 'Failed to delete user.']);
    }
}
add_action('wp_ajax_uct_delete_user', 'uct_delete_user');

// AJAX action for adding a user when Super manager loggs in
function uct_add_user() {
    // Check nonce for security
    if (!isset($_POST['uct_nonce']) || !wp_verify_nonce($_POST['uct_nonce'], 'uct_add_user_nonce')) {
        wp_send_json_error(['message' => 'Invalid nonce']);
    }

    // Required fields
    $required_fields = ['username', 'email', 'first_name', 'last_name', 'password', 'role'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(['message' => ucfirst($field) . ' is required.']);
        }
    }

    $current_user_id = get_current_user_id();
    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $password = sanitize_text_field($_POST['password']);
    $role = sanitize_text_field($_POST['role']);
    $manager_id = sanitize_text_field($_POST['assigned_manager'] ?? '');

    // Fetch the logged-in user's location
    $user_location = get_user_meta($current_user_id, 'user_location', true);

    // Validate location for agents
    if (!empty($manager_id) && $role === 'agent') {
        $manager_location = get_user_meta($manager_id, 'user_location', true);
        if ($manager_location !== $user_location) {
            wp_send_json_error(['message' => 'Location should match the selected Manager\'s location.', 'location' => 'error']);
        }
    }

    // Validate username length
    if (strlen($username) < 3) {
        wp_send_json_error(['message' => 'Username must be at least 3 characters long.']);
    }

    // Check if username or email already exists
    if (username_exists($username)) {
        wp_send_json_error(['message' => 'This username is already taken.', 'username' => 'error']);
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Invalid email address.'));
    }

    // Check if email already exists
    if (email_exists($email)) {
        wp_send_json_error(array('message' => 'This email is already registered.', 'email' => 'error'));
    }

    // Validate password length
    if (strlen($password) < 6) {
        wp_send_json_error(['message' => 'Password must be at least 6 characters long.']);
    }

    // Validate role
    $valid_roles = ['agent', 'manager'];
    if (!in_array($role, $valid_roles)) {
        wp_send_json_error(['message' => 'Invalid role selected.']);
    }

    // Create user
    $user_id = wp_create_user($username, $password, $email);
    if (is_wp_error($user_id)) {
        wp_send_json_error(['message' => 'Failed to create user.']);
    }

    // Update user meta
    update_user_meta($user_id, 'user_location', $user_location);
    update_user_meta($user_id, 'account_status', 'approved'); // Ultimate Member status

    // Update first & last name
    wp_update_user([
        'ID'         => $user_id,
        'first_name' => $first_name,
        'last_name'  => $last_name,
    ]);

    // Assign role
    $user = new WP_User($user_id);
    $user->set_role($role);

    // Assign manager relationships
    $assigned_manager_id = ($role === 'manager') ? $current_user_id : $manager_id;
    assign_manager($user_id, $assigned_manager_id);

    // Return success response
    wp_send_json_success(['message' => 'User created successfully', 'user_id' => $user_id]);
}
add_action('wp_ajax_uct_add_user', 'uct_add_user');

// AJAX action for updating a user when super manager loggs in
function uct_update_user() {
    // Check nonce for security
    if (!isset($_POST['uct_nonce']) || !wp_verify_nonce($_POST['uct_nonce'], 'uct_edit_user_nonce')) {
        wp_send_json_error(['message' => 'Invalid nonce']);
    }

    // Validate user ID
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    if (!$user_id || !get_userdata($user_id)) {
        wp_send_json_error(['message' => 'Invalid user.']);
    }

    // Required fields
    $required_fields = ['username', 'email', 'first_name', 'last_name', 'role'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(['message' => ucfirst($field) . ' is required.']);
        }
    }

    // Validate email
    $email = sanitize_email($_POST['email']);
    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Invalid email address.']);
    }

    // Check if email already exists (excluding the current user)
    $current_user = get_userdata($user_id);
    if ($current_user && $email !== $current_user->user_email && email_exists($email)) {
        wp_send_json_error(['message' => 'This email is already registered.', 'email' => 'error']);
    }

    // Sanitize name fields
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);

    // Validate and update password if provided
    $password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
    if (!empty($password) && strlen($password) < 6) {
        wp_send_json_error(['message' => 'Password must be at least 6 characters long.']);
    }

    // Prepare user data for update
    $user_data = [
        'ID'         => $user_id,
        'user_email' => $email,
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'role'       => sanitize_text_field($_POST['role']),
    ];

    // Attempt to update the user
    $updated_user_id = wp_update_user($user_data);
    if (is_wp_error($updated_user_id)) {
        wp_send_json_error(['message' => $updated_user_id->get_error_message()]);
    }

    // Update password if provided
    if (!empty($password)) {
        wp_set_password($password, $user_id);
    }

    // Assign manager relationships if applicable
    if ($_POST['role'] === 'manager' || isset($_POST['assigned_manager'])) {
        $manager_id = isset($_POST['assigned_manager']) ? intval($_POST['assigned_manager']) : 0;
        assign_manager($user_id, ($user_data['role'] === 'manager') ? get_current_user_id() : $manager_id);
    }

    // Success response
    wp_send_json_success(['message' => 'User updated successfully']);
}
add_action('wp_ajax_uct_update_user', 'uct_update_user');

// AJAX action for adding a user when super admin logges in
function uct_super_admin_add_user() {
    // Check nonce for security
    if (!isset($_POST['uct_nonce']) || !wp_verify_nonce($_POST['uct_nonce'], 'uct_add_user_admin_nonce')) {
        wp_send_json_error(['message' => 'Invalid nonce']);
    }

    // Define required fields
    $required_fields = ['username', 'email', 'first_name', 'last_name', 'password', 'location', 'role'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(['message' => ucfirst(str_replace('_', ' ', $field)) . ' is required.']);
        }
    }

    // Sanitize inputs
    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $password = sanitize_text_field($_POST['password']);
    $location = sanitize_text_field($_POST['location']);
    $role = sanitize_text_field($_POST['role']);
    $manager_id = isset($_POST['assigned_manager']) ? sanitize_text_field($_POST['assigned_manager']) : null;
    $super_manager_id = isset($_POST['assigned_super_manager']) ? sanitize_text_field($_POST['assigned_super_manager']) : null;

    if($manager_id != null && $role == 'agent') {
        $manager_location_id = get_user_meta($manager_id, 'user_location', true);
        if($manager_location_id != $location)
        {
            wp_send_json_error(['message' => 'Location should match the selected Manager\'s location.', 'location' => 'error']);
        }
    }
    if($super_manager_id != null && $role == 'manager') {
        $super_manager_location_id = get_user_meta($super_manager_id, 'user_location', true);
        if($super_manager_location_id != $location)
        {
            wp_send_json_error(['message' => 'Location should match the selected Super Manager\'s Location.', 'location' => 'error']);
        }
    }

    // Validate username
    if (strlen($username) < 3) {
        wp_send_json_error(['message' => 'Username must be at least 3 characters long.']);
    }

    // Check if username already exists
    if (username_exists($username)) {
        wp_send_json_error(['message' => 'This username is already taken.', 'username' => 'error']);
    }

    // Validate email
    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Invalid email address.']);
    }

    // Check if email already exists
    if (email_exists($email)) {
        wp_send_json_error(['message' => 'This email is already registered.', 'email' => 'error']);
    }

    // Validate password
    if (strlen($password) < 6) {
        wp_send_json_error(['message' => 'Password must be at least 6 characters long.']);
    }

    // Validate role
    $allowed_roles = ['agent', 'manager', 'super_manager'];
    if (!in_array($role, $allowed_roles)) {
        wp_send_json_error(['message' => 'Invalid role selected.']);
    }

    // Create a new user
    $created_user_id = wp_create_user($username, $password, $email);

    // Check for errors
    if (is_wp_error($created_user_id)) {
        wp_send_json_error(['message' => 'Failed to create user.']);
    }

    // Update user meta and role
    update_user_meta($created_user_id, 'account_status', 'approved'); // For Ultimate Member plugin
    update_user_meta($created_user_id, 'user_location', $location);

    wp_update_user([
        'ID' => $created_user_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
    ]);

    // Assign role
    $user = new WP_User($created_user_id);
    $user->set_role($role);

    // Assign manager relationships
    if ($role === 'agent' && !empty($manager_id)) {
        assign_manager($created_user_id, $manager_id);
    } elseif ($role === 'manager' && !empty($super_manager_id)) {
        assign_manager($created_user_id, $super_manager_id);
    }

    // Return success response
    wp_send_json_success(['message' => 'User created successfully', 'user_id' => $created_user_id]);
}
add_action('wp_ajax_uct_super_admin_add_user', 'uct_super_admin_add_user'); 

// AJAX action for updating a user when super admin loggs in
function uct_super_admin_update_user() {
    // Verify nonce for security
    if (!isset($_POST['uct_nonce']) || !wp_verify_nonce($_POST['uct_nonce'], 'uct_edit_user_admin_nonce')) {
        wp_send_json_error(['message' => 'Invalid request.']);
    }

    // Define required fields
    $required_fields = ['user_id', 'username', 'email', 'first_name', 'last_name', 'location', 'role'];
    
    // Validate required fields
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(['message' => ucfirst($field) . ' is required.']);
        }
    }

    // Sanitize input data
    $user_id = intval($_POST['user_id']);
    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
    $location = sanitize_text_field($_POST['location']);
    $role = sanitize_text_field($_POST['role']);
    $manager_id = !empty($_POST['assigned_manager']) ? intval($_POST['assigned_manager']) : null;
    $super_manager_id = !empty($_POST['assigned_super_manager']) ? intval($_POST['assigned_super_manager']) : null;

    // Validate role
    $allowed_roles = ['agent', 'manager', 'super_manager'];
    if (!in_array($role, $allowed_roles)) {
        wp_send_json_error(['message' => 'Invalid role selected.']);
    }

    // Ensure the email is valid and unique
    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Invalid email address.']);
    }
    $current_user = get_userdata($user_id);
    if ($current_user && $email !== $current_user->user_email && email_exists($email)) {
        wp_send_json_error(['message' => 'This email is already registered.', 'email' => 'error']);
    }

    // Validate password if provided
    if (!empty($password) && strlen($password) < 6) {
        wp_send_json_error(['message' => 'Password must be at least 6 characters long.']);
    }

    // Validate location consistency with assigned managers
    if ($role === 'agent' && !empty($manager_id)) {
        $manager_location = get_user_meta($manager_id, 'user_location', true);
        if ($manager_location !== $location) {
            wp_send_json_error(['message' => 'Location should match the selected Manager\'s location.', 'location' => 'error']);
        }
    }

    if ($role === 'manager' && !empty($super_manager_id)) {
        $super_manager_location = get_user_meta($super_manager_id, 'user_location', true);
        if ($super_manager_location !== $location) {
            wp_send_json_error(['message' => 'Location should match the selected Super Manager\'s location.', 'location' => 'error']);
        }
    }
    // Prepare user data for update
    $user_data = [
        'ID' => $user_id,
        'user_email' => $email,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'role' => $role,
    ];

    $updated_user_id = wp_update_user($user_data);
    if (is_wp_error($updated_user_id)) {
        wp_send_json_error(['message' => $updated_user_id->get_error_message()]);
    }

    // Update password if provided
    if (!empty($password)) {
        wp_set_password($password, $user_id);
    }

    // Update user_location
    update_user_meta($user_id, 'user_location', $location);

    // Assign manager relationships
    if ($role === 'agent' && $manager_id) {
        assign_manager($user_id, $manager_id);
    } elseif ($role === 'manager' && $super_manager_id) {
        assign_manager($user_id, $super_manager_id);
    }

    wp_send_json_success(['message' => 'User updated successfully.']);
}
add_action('wp_ajax_uct_super_admin_update_user', 'uct_super_admin_update_user');

// Function to assign manager relationships
function assign_manager($agent_id, $assigned_manager_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'agent_manager_relationships';

    // Ensure agent ID and manager ID are valid
    if (empty($agent_id) || empty($assigned_manager_id)) {
        return;
    }

    // Remove any existing relationship for the agent
    $wpdb->delete($table_name, ['agent_id' => $agent_id]);

    update_user_meta( $agent_id, 'assigned_manager',   $assigned_manager_id);

    // Insert new relationship
    $wpdb->insert($table_name, [
        'agent_id'   => $agent_id,
        'manager_id' => $assigned_manager_id
    ]);
}
