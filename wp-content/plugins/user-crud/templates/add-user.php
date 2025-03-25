<?php 
global $wpdb;
$table_prefix = $wpdb->prefix;

// Fetch locations efficiently
$locations = $wpdb->get_results("SELECT id, name FROM {$table_prefix}locations", ARRAY_A);
$location_map = wp_list_pluck($locations, 'name', 'id');

$current_user_id = get_current_user_id();
$current_user_location = get_user_meta($current_user_id, 'user_location', true);
$result = [];

if ($current_user_location) {
    $location = $wpdb->get_var($wpdb->prepare("SELECT name FROM {$table_prefix}locations WHERE id = %d", $current_user_location));
    $result[] = $location;

    // Fetch managers at the same location
    $managers = get_users([
        'role__in'   => ['manager'],
        'meta_key'   => 'user_location',
        'meta_value' => $current_user_location,
    ]);
}
?>

<div class="users-add-logs edit-flexrow">
    <div class="wrap">
        <h2>Add New User</h2>
        <div id="successMsg" style="display:none;"></div>
        <div id="errorMsg" style="display:none;"></div>
        <a href="<?php echo get_site_url(); ?>/list-user" class="button-primary">Users List</a>
        <a href="<?php echo get_site_url();?>/account" class="button-primary">Back</a>
        
        <form id="add-user-form" class="flexrow">
            <!-- Add nonce field for security -->
            <?php wp_nonce_field('uct_add_user_nonce', 'uct_nonce'); ?>

            <div class="equal-col">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="control-form" autocomplete="off">
                    <span id="usernameError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="control-form" autocomplete="off">
                    <span id="emailError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="control-form" autocomplete="off">
                    <span id="firstNameError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="control-form" autocomplete="off">
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
                    <input type="text" id="location" name="location" value="<?php echo $result[0]; ?>" class="control-form" autocomplete="off" readonly>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">    
                    <label for="role">Role</label>
                    <select name="role" id="role" class="control-form control-select">
                        <option selected disabled>Select Role</option>
                        <option value="agent">Agent</option>
                        <option value="manager">Manager</option>
                    </select>
                    <span id="roleError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col hidden">
                <div class="form-group">    
                <label for="role">Select Manager</label>
                    <select name="assigned_manager" id="assigned_manager" class="control-form control-select">
                        <option value="" disabled selected><?php _e('Select Manager', 'textdomain'); ?></option>
                        <?php foreach ($managers as $manager) : ?>
                            <option value="<?php echo esc_attr($manager->ID); ?>">
                                <?php echo esc_html("{$manager->first_name} {$manager->last_name} (" . ($location_map[$manager->user_location] ?? 'Not Assigned') . ")"); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span id="managerError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="submit-col submit-loader">
                <button type="submit" name="submit_user" class="submit">Add User</button>        
                <div id="loader" style="display:none;">
                    <img src="<?php echo plugins_url( 'images/loading-gif.gif', __FILE__ ); ?>" alt="Loading..." />
                </div>
            </div>
        </form>
    </div>
</div>
