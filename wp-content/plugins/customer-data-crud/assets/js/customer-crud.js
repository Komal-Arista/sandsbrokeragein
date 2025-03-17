jQuery(document).ready(function($) {

    // Initialize Flatpickr for start_date
    const startDatePicker = flatpickr('#last_load_date', {
        dateFormat: "m-d-Y", // MM-DD-YYYY format
        allowInput: false,   // Allow manual input
    });

    // Add user form submission
    $('#add-customer-form').on('submit', function(e) {
  
        e.preventDefault();

        // Clear all previous error messages
        $('span[id$="Error"]').hide().text('');
        $('#errorMsg, #successMsg').hide().text('');

        // Flag to track validation status
        let isValid = true;

        // Get form field values
        const customer_profile_name = $('#customer_profile_name').val().trim();
        const customer_email = $('#customer_email').val().trim();
        const customer_status = $('#customer_status').val().trim();
        const customer_status_as_per_policy = $('#customer_status_as_per_policy').val().trim();
        const customer_contact_name = $('#customer_contact_name').val().trim();
        const customer_city = $('#customer_city').val().trim();
        const customer_state = $('#customer_state').val().trim();
        const customer_zip = $('#customer_zip').val().trim();
        const customer_phone = $('#customer_phone').val().trim();
        const billing_phone = $('#billing_phone').val().trim();
        const customer_website_url = $('#customer_website_url').val().trim();
        const sales_rep_name = $('#sales_rep_name').val().trim();
        const region = $('#region').val().trim();

        // Validate username
        if (customer_profile_name.length < 3) {
            isValid = false;
            $('#customerProfileNameError').text('Customer Profile Name must be at least 3 characters long.').show();
        }

        // Validate email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(customer_email)) {
            isValid = false;
            $('#customerEmailError').text('Please enter a valid email address.').show();
        }

        // Validate customer_status (Only letters allowed)
        if (!isValidAlphabetic(customer_status)) {
            isValid = false;
            $('#customerStatusError').text('Customer Status can only contain letters.').show();
        }

        // Validate customer_status_as_per_policy (Only letters allowed)
        if (!isValidAlphabetic(customer_status_as_per_policy)) {
            isValid = false;
            $('#customerStatusPolicyError').text('Customer Status As Per Policy can only contain letters.').show();
        }
        
        // Validate customer_phone
        if (!isValidPhone(customer_phone)) {
            isValid = false;
            $('#customerPhoneError').text('Invalid phone format. Use (XXX) XXX-XXXX, 10-digit number, or +X-XXX-XXX-XXXX.').show();
        }

        // Validate billing_phone
        if (!isValidPhone(billing_phone)) {
            isValid = false;
            $('#billingPhoneError').text('Invalid phone format. Use (XXX) XXX-XXXX, 10-digit number, or +X-XXX-XXX-XXXX.').show();
        }

        // Validate ZIP/Postal Code
        if (!isValidZip(customer_zip)) {
            isValid = false;
            $('#customerZipError').text('Invalid ZIP/Postal Code. Use valid formats like 110001, 12345, 12345-6789, or SW1A 1AA.').show();
        }

         // Validate Website URL
         if (!isValidURL(customer_website_url)) {
            isValid = false;
            $('#customerWebsiteUrlError').text('Invalid website URL. Use format like https://example.com').show();
        }

        // Stop submission if validation fails
        if (!isValid) {
            return;
        }

        // Show loader
        $('#loader').show();

        // Prepare data for AJAX request
        var formData = {
            action: 'uct_add_customer', // The action we are hooking into
            customer_profile_name: customer_profile_name,
            customer_status: customer_status,
            customer_status_as_per_policy: customer_status_as_per_policy,
            last_load_date: $('#last_load_date').val().trim(),
            customer_contact_name: customer_contact_name,
            customer_city: customer_city,
            customer_state: customer_state,
            customer_zip: customer_zip,
            customer_phone: customer_phone,
            billing_phone: billing_phone,
            customer_email: customer_email,
            customer_website_url: customer_website_url,
            sales_rep_name: sales_rep_name,
            region: region,
            uct_nonce: $('#uct_nonce').val()  // Include nonce for security
        };

        $.ajax({
            url: uct_vars.ajaxurl, // Use localized ajaxurl (defined in PHP)
            method: 'POST',
            data: formData,
            success: function(response) {
                // Hide loader
                $('#loader').hide();
                if (response.success) {
                    $('#successMsg').text('customer added successfully!').show();
                    $('#add-customer-form')[0].reset();
                } else {
                    $('#errorMsg').text(response.data.error).css('color', 'red').show();
                }
            },
            error: function(xhr, status, error) {
                // Hide loader
                $('#loader').hide();
                let errorMessage = "An unknown error occurred. Please try again.";
                    if (xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message) {
                        errorMessage = xhr.responseJSON.data.message; // Extract WP error message
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                $('#errorMsg').text(errorMessage).css('color', 'red').show();
            }
        });
    });

    // Allow only letters for specific fields
    function isValidAlphabetic(value) {
        return value === '' || /^[A-Za-z\s]+$/.test(value); // Allows letters and spaces only
    }

    // Function to validate phone number format
    function isValidPhone(value) {
        return value === '' || 
                /^\(\d{3}\) \d{3}-\d{4}$/.test(value) ||  // (XXX) XXX-XXXX format
                /^\d{10}$/.test(value);  // 10-digit format
    }  

    // Function to validate ZIP/Postal Code for multiple countries
    function isValidZip(value) {
        return value === '' || 
               /^[0-9]{6}$/.test(value) ||             // India (6-digit)
               /^[0-9]{5}(-[0-9]{4})?$/.test(value) || // US (12345 or 12345-6789)
               /^[A-Za-z0-9\s-]+$/.test(value);        // UK & other countries (Alphanumeric)
    }

    // Function to validate website URL
    function isValidURL(value) {
        return value === '' || 
               /^(https?:\/\/)?([a-zA-Z0-9.-]+)\.([a-zA-Z]{2,})(\/\S*)?$/.test(value);
    }

    // Restrict input to letters only for real-time validation
    $('#customer_profile_name, #customer_status, #customer_status_as_per_policy, #customer_contact_name, #customer_city, #customer_state, #sales_rep_name, #region').on('keypress', function(event) {
        let charCode = event.which;
        if (!(charCode >= 65 && charCode <= 90) && // A-Z
            !(charCode >= 97 && charCode <= 122) && // a-z
            !(charCode === 32)) { // Space
            event.preventDefault();
        }
    });

    // Restrict input to numbers, parentheses, spaces, dashes, and plus (+) sign
    $('#customer_phone, #billing_phone').on('keypress', function(event) {
        let charCode = event.which;
        let charStr = String.fromCharCode(charCode);

        // Allow numbers (0-9), parentheses (), spaces, dashes (-), and plus (+)
        if (!charStr.match(/[0-9()\s-+]/)) {
            event.preventDefault();
        }
    });
});
