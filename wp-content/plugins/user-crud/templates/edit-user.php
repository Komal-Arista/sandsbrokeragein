<?php

global $wpdb;
$table_prefix = $wpdb->prefix;

// Get user ID from URL parameter
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$user = get_userdata($user_id);
$user_roles = $user->roles ?? [];
$user_role = $user_roles[0] ?? '';

// Fetch locations efficiently
$locations = $wpdb->get_results("SELECT id, name FROM {$table_prefix}locations", ARRAY_A);
$location_map = wp_list_pluck($locations, 'name', 'id');

// Get current user location
$current_user_location = get_user_meta(get_current_user_id(), 'user_location', true);
$location_name = $location_map[$current_user_location] ?? 'Not Assigned';

// Fetch managers for the same location
$managers = [];
if ($current_user_location) {
    $managers = get_users([
        'role__in'    => ['manager'],
        'meta_key'    => 'user_location',
        'meta_value'  => $current_user_location
    ]);
}

// Check if user is a manager and has assigned agents
$assigned_agents_count = ($user_role === 'manager') ? (int) $wpdb->get_var(
    $wpdb->prepare(
        "SELECT COUNT(agent_id) FROM {$table_prefix}agent_manager_relationships WHERE manager_id = %d",
        $user_id
    )
) : 0;

// Disable role selection if agents are assigned
$disabled = ($assigned_agents_count > 0) ? 'disabled' : '';

?>

<div class="edit-user-logs edit-flexrow">
    <div class="wrap">

        <div id="successMsg" style="display:none;"></div>
        <div id="errorMsg" style="display:none;"></div>
        <a href="<?php echo get_site_url(); ?>/list-user" class="button-primary">Users List</a>
        <a href="<?php echo get_site_url();?>/account" class="button-primary">Back</a>

        <form id="edit-user-form" class="flexrow">
            <!-- Add nonce field for security -->
            <?php wp_nonce_field('uct_edit_user_nonce', 'uct_nonce'); ?>

            <input type="hidden" id="user_id" name="user_id" value="<?php echo esc_attr($user->ID); ?>">

            <div class="equal-col">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="control-form" value="<?php echo esc_attr($user->user_login); ?>" autocomplete="off" readonly>
                    <span id="usernameError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="control-form" value="<?php echo esc_attr($user->user_email); ?>" autocomplete="off">
                    <span id="emailError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="control-form" value="<?php echo esc_attr($user->first_name); ?>" autocomplete="off">
                    <span id="firstNameError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="control-form" value="<?php echo esc_attr($user->last_name); ?>" autocomplete="off">
                    <span id="lastNameError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="control-form" autocomplete="off">
                    <span id="passwordError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="password">Location</label>
                    <input type="text" id="location" name="location" value="<?php echo $location_name; ?>" class="control-form" autocomplete="off" readonly>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="control-form control-select" <?php echo $disabled; ?>>
                        <option selected disabled>Select Role</option>
                        <option value="agent" <?php echo ($user->roles[0] == 'agent') ? 'selected' : ''; ?>>Agent</option>
                        <option value="manager" <?php echo ($user->roles[0] == 'manager') ? 'selected' : ''; ?>>Manager</option>
                    </select>
                    <span id="roleError" class="error" style="display: none; color: red;"></span>
                    <?php if($assigned_agents_count > 0) { ?>
                        <small>You cannot change this user's role until all subordinates are unassigned from this manager.</small>
                    <?php } ?>
                </div>
            </div>

            <div class="equal-col hidden">
                <div class="form-group">    
                    <label for="role">Select Manager</label>
                    <select name="assigned_manager" id="assigned_manager" class="control-form control-select">
                        <option value="" disabled selected><?php _e('Select Manager', 'textdomain'); ?></option>
                            <?php foreach ($managers as $manager) : 
                                if ($user_id == $manager->ID) {
                                    continue; // Skip this iteration
                                }    
                            ?>
                            <option value="<?php echo esc_attr($manager->ID); ?>"
                                <?php selected( $user->assigned_manager, $manager->ID ); ?>>
                                <?php echo esc_html("{$manager->first_name} {$manager->last_name} (" . ($location_map[$manager->user_location] ?? 'Not Assigned') . ")"); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span id="managerError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="submit-col submit-loader"><button type="submit" class="submit">Update User</button>
                <div id="loader" style="display:none;">
                    <img src="<?php echo plugins_url( 'images/loading-gif.gif', __FILE__ ); ?>" alt="Loading..." />
                </div>
            </div>
        </form>
    </div>
</div>
