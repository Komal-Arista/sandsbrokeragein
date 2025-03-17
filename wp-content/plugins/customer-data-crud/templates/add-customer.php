
<div class="customers-add-logs edit-flexrow">
    <div class="wrap">
        <h2>Add New Customer Data</h2>

        <a href="<?php echo get_site_url();?>/account" class="button-primary">My Account</a>
        <div id="successMsg" style="display:none;"></div>
        <div id="errorMsg" style="display:none;"></div>

        <form id="add-customer-form" class="flexrow">
            <!-- Add nonce field for security -->
            <?php wp_nonce_field('uct_add_customer_nonce', 'uct_nonce'); ?>

            <div class="equal-col">
                <div class="form-group">
                    <label for="customer_profile_name">Customer Profile Name</label>
                    <input type="text" id="customer_profile_name" name="customer_profile_name" class="control-form" autocomplete="off">
                    <span id="customerProfileNameError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="customer_status">Customer Status</label>
                    <input type="text" id="customer_status" name="customer_status" class="control-form" autocomplete="off">
                    <span id="customerStatusError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="customer_status_as_per_policy">Customer Status As Per Policy</label>
                    <input type="text" id="customer_status_as_per_policy" name="customer_status_as_per_policy" class="control-form" autocomplete="off">
                    <span id="customerStatusPolicyError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="last_load_date">Last Load Date</label>
                    <input type="text" id="last_load_date" name="last_load_date" class="control-form" autocomplete="off">
                    <span id="lastLoadDateError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="customer_contact_name">Customer Contact Name</label>
                    <input type="text" id="customer_contact_name" name="customer_contact_name" class="control-form" autocomplete="off">
                    <span id="customerContactNameError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="customer_city">Customer City</label>
                    <input type="text" id="customer_city" name="customer_city" class="control-form" autocomplete="off">
                    <span id="customerCityError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="customer_state">Customer State</label>
                    <input type="text" id="customer_state" name="customer_state" class="control-form" autocomplete="off">
                    <span id="customerStateError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="customer_zip">Customer Zip</label>
                    <input type="text" id="customer_zip" name="customer_zip" class="control-form" autocomplete="off">
                    <span id="customerStateError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="customer_phone">Customer Phone Number</label>
                    <input type="text" id="customer_phone" name="customer_phone" class="control-form" autocomplete="off">
                    <span id="customerPhoneError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="billing_phone">Billing Phone Number</label>
                    <input type="text" id="billing_phone" name="billing_phone" class="control-form" autocomplete="off">
                    <span id="billingPhoneError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="customer_email">Customer Email</label>
                    <input type="text" id="customer_email" name="customer_email" class="control-form" autocomplete="off">
                    <span id="customerEmailError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="customer_website_url">Customer Website URL</label>
                    <input type="text" id="customer_website_url" name="customer_website_url" class="control-form" autocomplete="off">
                    <span id="customerWebsiteUrlError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="sales_rep_name">Sales Representative Name</label>
                    <input type="text" id="sales_rep_name" name="sales_rep_name" class="control-form" autocomplete="off">
                    <span id="salesRepNameError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="equal-col">
                <div class="form-group">
                    <label for="region">Region</label>
                    <input type="text" id="region" name="region" class="control-form" autocomplete="off">
                    <span id="regionNameError" class="error" style="display: none; color: red;"></span>
                </div>
            </div>

            <div class="submit-col submit-loader">
                <button type="submit" name="submit_user" class="submit">Add Customer</button>        
                <div id="loader" style="display:none;">
                    <img src="<?php echo plugins_url( 'images/loading-gif.gif', __FILE__ ); ?>" alt="Loading..." />
                </div>
            </div>
        </form>
    </div>
</div>
