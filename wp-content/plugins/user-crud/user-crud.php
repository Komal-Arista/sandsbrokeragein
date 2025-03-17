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

    // Custom script for handling CRUD operations
    wp_enqueue_script('user-crud-js', plugin_dir_url(__FILE__) . 'assets/js/user-crud.js', array('jquery'), null, true);

    // Localize the script to pass ajaxurl to the frontend
    wp_localize_script('user-crud-js', 'uct_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php') // Pass the ajaxurl
    ));

    // Custom style for the plugin
    wp_enqueue_style('user-crud-style', plugin_dir_url(__FILE__) . 'style.css');
}
add_action('wp_enqueue_scripts', 'uct_enqueue_assets');

// Shortcode for displaying the user CRUD interface
function uct_user_crud_shortcode() {
    
    if (!is_user_logged_in() || !current_user_can('super_manager')) {
        return '<p>You do not have permission to access this page.</p>';
    }
    if (isset($_GET['action']) && $_GET['action'] === 'add') {
        include(plugin_dir_path(__FILE__) . 'templates/add-user.php');
    } elseif (isset($_GET['action']) && $_GET['action'] === 'edit') {
        include(plugin_dir_path(__FILE__) . 'templates/edit-user.php');
    } else {
        include(plugin_dir_path(__FILE__) . 'templates/list-users.php');
    }
   
}
add_shortcode('user_crud', 'uct_user_crud_shortcode');

function uct_get_users() {
    global $wpdb;
    $table_prefix = $wpdb->prefix;

    // Get the current logged-in user ID
    $current_user_id = get_current_user_id();

    // Get the current user's location
    $current_user_location = get_user_meta($current_user_id, 'user_location', true);

    $users = array();

    if ($current_user_location) {
        $users = $wpdb->get_results($wpdb->prepare(
            "SELECT u.ID, u.user_login, u.user_email, 
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
            WHERE um_location.meta_value = %s
            ORDER BY u.ID DESC",
            $current_user_location
        ));
    }

    // Prepare the data in the expected format for DataTables
    $data = array();
    foreach ($users as $user) {

        // Decode the serialized `wp_capabilities` to get the role
        $roles = maybe_unserialize($user->wp_capabilities);
        $role = (is_array($roles) && (isset($roles['agent']) || isset($roles['manager']))) ? key($roles) : null;

        // Only process users with role "agent" or "manager"
        if ($role === null) {
            continue; // Skip users who are neither agent nor manager
        }

        // Check if user role is "manager" and has assigned agents
        $assigned_agents_count = 0;
        if ($role == 'manager') {
            $assigned_agents_count = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT COUNT(agent_id) FROM {$table_prefix}agent_manager_relationships WHERE manager_id = %d",
                    $user->ID
                )
            );
        }

        // Disable select box if assigned_agents_count > 0
        $delete_disabled = ($assigned_agents_count > 0) ? 'disabled' : '';
        $delete_class = ($assigned_agents_count > 0) ? 'disabled-button' : '';
            
        $data[] = array(
            'ID' => $user->ID,
            'user_login' => $user->user_login,
            'user_name' => trim(($user->first_name ?? 'N/A') . ' ' . ($user->last_name ?? 'N/A')),
            'user_email' => $user->user_email,
            'user_role' => ucfirst($role) ?? 'N/A',
            'assigned_manager' =>  $user->assigned_manager 
                                   ? ucfirst(get_user_meta($user->assigned_manager, 'first_name', true)) . " " .  ucfirst(get_user_meta($user->assigned_manager, 'last_name', true)) 
                                   : 'N/A' ,
            'user_location' => $user->user_location ?? 'N/A',
            'actions' => '<button class="edit-user" data-id="' . $user->ID . '">Edit</button>' .
                         '<button class="delete-user ' . $delete_class . '" data-id="' . $user->ID . '" ' . $delete_disabled . '>Delete</button>',
        );
    }

    // Send the response
    wp_send_json_success(array(
        'data' => $data
    ));
}
add_action('wp_ajax_uct_get_users', 'uct_get_users');

// AJAX action for deleting a user
function uct_delete_user() {
    if (isset($_POST['user_id'])) {
        $user_id = intval($_POST['user_id']);

        if (wp_delete_user($user_id)) {

            // Update the custom relationship table
            global $wpdb;
            $table_name = $wpdb->prefix . 'agent_manager_relationships';

            // Delete existing relationship for this agent
            delete_user_meta( $user_id, 'assigned_manager' );
            $wpdb->delete( $table_name, array( 'agent_id' => $user_id ) );

            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_uct_delete_user', 'uct_delete_user');

// AJAX action for adding a user
function uct_add_user() {
    // Check nonce for security
    if (!isset($_POST['uct_nonce']) || !wp_verify_nonce($_POST['uct_nonce'], 'uct_add_user_nonce')) {
        wp_send_json_error(array('message' => 'Invalid nonce'));
    }

    // Required fields
    $required_fields = ['username', 'email', 'first_name', 'last_name', 'password', 'role'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(array('message' => ucfirst($field) . ' is required.'));
        }
    }

    // Validate username
    $username = sanitize_text_field($_POST['username']);
    if (strlen($username) < 3) {
        wp_send_json_error(array('message' => 'Username must be at least 3 characters long.'));
    }

    // Check if username already exists
    if (username_exists($username)) {
        wp_send_json_error(array('message' => 'This username is already taken.', 'username' => 'error'));
    }

    // Validate email
    $email = sanitize_email($_POST['email']);
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Invalid email address.'));
    }

    // Check if email already exists
    if (email_exists($email)) {
        wp_send_json_error(array('message' => 'This email is already registered.', 'email' => 'error'));
    }

    // Validate first and last name
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    if (empty($first_name) || empty($last_name)) {
        wp_send_json_error(array('message' => 'First name and last name are required.'));
    }

    // Validate password
    $password = sanitize_text_field($_POST['password']);
    if (strlen($password) < 6) {
        wp_send_json_error(array('message' => 'Password must be at least 6 characters long.'));
    }

    // Validate role
    $role = sanitize_text_field($_POST['role']);
    if (!in_array($role, ['agent', 'manager'])) {
        wp_send_json_error(array('message' => 'Invalid role selected.'));
    }

    $current_user_id = get_current_user_id();

    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $password = sanitize_text_field($_POST['password']);
    $role = sanitize_text_field($_POST['role']);
    $manager_id = sanitize_text_field($_POST['assigned_manager']);
    
    // Create a new user
    $user_id = wp_create_user($username, $password, $email);

    // Check for errors
    if (is_wp_error($user_id)) {
        wp_send_json_error(array('message' => 'Failed to create user.'));
        return;
    }

    // Check if the user was created successfully
    if (!is_wp_error($user_id)) {

        // Update the Ultimate Member status to 'approved'
        update_user_meta($user_id, 'account_status', 'approved');

        // Trigger Ultimate Member hooks for status update
        // do_action('um_registration_complete', $user_id, $role);
        // do_action('um_user_status_updated', $user_id, 'approved');

        // Set the first name and last name
        wp_update_user(array(
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
        ));

        // Get the user object
        $user = new WP_User($user_id);

        // Assign the role to the user
        $user->set_role($role);
    }

    // Fetch the logged in users user_location meta value
    $user_location = get_user_meta($current_user_id, 'user_location', true);
    update_user_meta($user_id, 'user_location', $user_location);

    // Update Manager Id
    if($role === 'manager')
    {
        $assigned_manager_id = $current_user_id;
    } else {
        $assigned_manager_id = $manager_id;
    }
    update_user_meta( $user_id, 'assigned_manager',   $assigned_manager_id);

    // Update the custom relationship table
    global $wpdb;
    $table_name = $wpdb->prefix . 'agent_manager_relationships';

    // Delete existing relationship for this agent
    $wpdb->delete( $table_name, array( 'agent_id' => $user_id ) );

    // If a manager is selected, insert the new relationship
    if ( !empty( $current_user_id ) ) {
        $wpdb->insert( 
            $table_name, 
            array( 
                'agent_id' => $user_id, 
                'manager_id' => $assigned_manager_id 
            ) 
        );
    }

    // Return success response
    wp_send_json_success(array('message' => 'User created successfully', 'user_id' => $user_id));
}

add_action('wp_ajax_uct_add_user', 'uct_add_user'); // For logged-in users only

// AJAX action for updating a user
function uct_update_user() {

    // Check nonce for security
    if (!isset($_POST['uct_nonce']) || !wp_verify_nonce($_POST['uct_nonce'], 'uct_edit_user_nonce')) {
        wp_send_json_error(array('message' => 'Invalid nonce'));
    }
    
    $user_id = intval($_POST['user_id']);

    // Required fields
    $required_fields = ['username', 'email', 'first_name', 'last_name', 'role'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(array('message' => ucfirst($field) . ' is required.'));
        }
    }

    // Validate email
    $email = sanitize_email($_POST['email']);
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Invalid email address.'));
    }

    // Get the user ID and check if the email belongs to the current user
    $current_user = get_userdata($user_id);
    // If the email has changed, check if the new email already exists
    if ($current_user && $email !== $current_user->user_email && email_exists($email)) {
        wp_send_json_error(array('message' => 'This email is already registered.', 'email' => 'error'));
    }

    // Validate first and last name
    $first_name = sanitize_text_field($_POST['first_name']);
    if (empty($first_name)) {
        wp_send_json_error(array('message' => 'First name is required.'));
    }

    $last_name = sanitize_text_field($_POST['last_name']);
    if (empty($last_name)) {
        wp_send_json_error(array('message' => 'Last name is required.'));
    }

    // Validate password
    $password = sanitize_text_field($_POST['password']);
    if ((isset($password)) && ($password != '') && (strlen($password) < 6)) {
        wp_send_json_error(array('message' => 'Password must be at least 6 characters long.'));
    }
 
    $user_data = array(
        'ID' => $user_id,
        'user_email' => $_POST['email'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'role' => $_POST['role'],
    );

     // Attempt to update the user
     $updated_user_id = wp_update_user($user_data);

    if(isset($_POST['password']) && $_POST['password'] != '') { //update password if entered
        wp_set_password( $_POST['password'], $user_id );
    }

    $current_user_id =  get_current_user_id();
    $role = sanitize_text_field($_POST['role']);
    $manager_id = sanitize_text_field($_POST['assigned_manager']);

    // Update Manager Id
    if($role === 'manager')
    {
        $assigned_manager_id = $current_user_id;
    } else {
        $assigned_manager_id = $manager_id;
    }
    update_user_meta( $user_id, 'assigned_manager',   $assigned_manager_id);

    // Update the custom relationship table
    global $wpdb;
    $table_name = $wpdb->prefix . 'agent_manager_relationships';

    // Delete existing relationship for this agent
    $wpdb->delete( $table_name, array( 'agent_id' => $user_id ) );

    // If a manager is selected, insert the new relationship
    if ( !empty( $current_user_id ) ) {
        $wpdb->insert( 
            $table_name, 
            array( 
                'agent_id' => $user_id, 
                'manager_id' => $assigned_manager_id 
            ) 
        );
    }

    if (is_wp_error($updated_user_id)) {
        $error_message = $updated_user_id->get_error_message();
        wp_send_json_error(array('message' => $error_message));
    } else {
        wp_send_json_success(array('message' => 'User updated successfully'));
    }
}
add_action('wp_ajax_uct_update_user', 'uct_update_user');
