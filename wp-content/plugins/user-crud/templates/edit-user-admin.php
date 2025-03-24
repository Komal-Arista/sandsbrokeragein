<?php
    global $wpdb;
    $table_prefix = $wpdb->prefix;

    // Get user ID from URL parameter
    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
    $user = get_userdata($user_id);

    $locations = $wpdb->get_results("SELECT * FROM {$table_prefix}locations", ARRAY_A);

    // Convert locations into an associative array for easy lookup
    $location_map = [];
    foreach ($locations as $location) {
        $location_map[$location['id']] = $location['name'];
    }

    $managers = get_users(['role__in' => ['manager']]);
    $super_managers = get_users(['role__in' => ['super_manager']]);

    // Check If user role is manager and if any agent has been assigned or not
    $assigned_agents_count = 0;
    if ($user->roles[0] == 'manager' || $user->roles[0] == 'super_manager') {
        $assigned_agents_count = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(agent_id) FROM {$table_prefix}agent_manager_relationships WHERE manager_id = %d",
                $user_id
            )
        );
    }

    // Disable select box if assigned_agents_count > 0
    $disabled = ($assigned_agents_count > 0) ? 'disabled' : '';
?>

<div class="edit-user-logs edit-flexrow">
    <div class="wrap">

        <div id="successMsg" style="display:none;"></div>
        <div id="errorMsg" style="display:none;"></div>
        <a href="<?php echo get_site_url(); ?>/list-user" class="button-primary">Users List</a>

        <form id="edit-super-user-form" class="flexrow">
            <!-- Add nonce field for security -->
            <?php wp_nonce_field('uct_edit_user_admin_nonce', 'uct_nonce'); ?>

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
                    <label for="admin_location">Location</label>
                    <select name="admin_location" id="admin_location" class="control-form">
                        <option disabled selected value="">Select Location</option>
                        <?php foreach ( $locations as $location ) : ?>
                            <option value="<?php echo esc_attr($location['id']); ?>"
                                            <?php selected( $user->user_location, $location['id'] ); ?>>
                                <?php echo esc_html($location['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span id="locationError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="user_role" id="user_role" class="control-form control-select" <?php echo $disabled; ?>>
                        <option selected disabled>Select Role</option>
                        <option value="agent" <?php echo ($user->roles[0] == 'agent') ? 'selected' : ''; ?>>Agent</option>
                        <option value="manager" <?php echo ($user->roles[0] == 'manager') ? 'selected' : ''; ?>>Manager</option>
                        <option value="super_manager" <?php echo ($user->roles[0] == 'super_manager') ? 'selected' : ''; ?>>Super Manager</option>
                    </select>
                    <span id="userRoleError" class="error" style="display: none; color: red;"></span>
                    <?php if($assigned_agents_count > 0) { ?>
                        <small>You cannot change the role of this user until you unassign all agents from this manager.</small>
                    <?php } ?>
                </div>
            </div>

            <div class="equal-col hidden">
                <div class="form-group">    
                    <label for="user_assigned_manager">Select Manager</label>
                    <select name="user_assigned_manager" id="user_assigned_manager" class="control-form control-select">
                        <option value="" disabled selected><?php _e( 'Select Manager', 'textdomain' ); ?></option>
                            <?php foreach ( $managers as $manager ) :  
                                $location_name = isset($location_map[$manager->user_location]) ? $location_map[$manager->user_location] : 'Not Assigned';    
                            ?>
                        <option value="<?php echo esc_attr( $manager->ID ); ?>" 
                                        <?php selected( $user->assigned_manager, $manager->ID ); ?>>
                            <?php echo esc_html("{$manager->first_name} {$manager->last_name} ({$location_name})"); ?>
                        </option>
                            <?php endforeach; ?>
                    </select>
                    <span id="managerError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col hidden">
                <div class="form-group">    
                    <label for="assigned_super_manager">Select Super Manager</label>
                    <select name="assigned_super_manager" id="assigned_super_manager" class="control-form control-select">
                        <option value="" disabled selected><?php _e('Select Super Manager', 'textdomain'); ?></option>
                            <?php foreach ($super_managers as $manager) :  
                                $location_name = isset($location_map[$manager->user_location]) ? $location_map[$manager->user_location] : 'Not Assigned';
                            ?>
                            <option value="<?php echo esc_attr($manager->ID); ?>"
                                            <?php selected( $user->assigned_manager, $manager->ID ); ?>>
                                <?php echo esc_html("{$manager->first_name} {$manager->last_name} ({$location_name})"); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span id="superManagerError" class="error" style="display: none; color: red;"></span>
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
