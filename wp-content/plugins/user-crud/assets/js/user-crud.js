jQuery(document).ready(function($) {

    // Initialize DataTable
    var table = $('#user-table').DataTable({
        "ajax": {
            "url": uct_vars.ajaxurl,  // Use localized ajaxurl
            "method": "POST",
            "data": {
                action: "uct_get_users"
            },
            "dataSrc": function(json) {
                //console.log(json); // Add this line to inspect the AJAX response
                return json.data.data;  // Return the 'data' property from the response
            },
            "beforeSend": function() {
                // Show the loader when the request is sent
                $('#loader').show();
            },
            "complete": function() {
                // Hide the loader once the request is complete (success or failure)
                $('#loader').hide();
            }
        },
        "columns": [
            { 
                "data": null, // Index column
                "render": function (data, type, row, meta) {
                    // Calculate index based on page number
                    return meta.row + 1 + meta.settings._iDisplayStart;
                }
            },
            { "data": "user_login" },
            { "data": "user_name" },
            { "data": "user_email" },
            { "data": "user_role" },
            { "data": "assigned_manager" },
            { "data": "user_location" },
            { "data": "actions" }
        ]
    });

    // click on Delete button
    $(document).on('click', '.delete-user', function() {
        var userId = $(this).data('id');
        if (confirm('Are you sure you want to delete this user?')) {
            // Show loader
            $('#loader').show();
            $.ajax({
                url: uct_vars.ajaxurl, // Use localized ajaxurl
                method: 'POST',
                data: {
                    action: 'uct_delete_user',
                    user_id: userId
                },
                success: function(response) {
                    if (response.success) {
                        // Hide loader
                        $('#loader').hide();
                        table.ajax.reload();
                        $('#successMsg').text('User deleted successfully!').show();
                    } else {
                        alert('Error deleting user.');
                    }
                }
            });
        }
    });

    // Add user form submission
    $('#add-user-form').on('submit', function(e) {
        e.preventDefault();

        // Clear all previous error messages
        $('span[id$="Error"]').hide().text('');

        // Flag to track validation status
        let isValid = true;

        // Get form field values
        const username = $('#username').val().trim();
        const email = $('#email').val().trim();
        const firstName = $('#first_name').val().trim();
        const lastName = $('#last_name').val().trim();
        const password = $('#password').val().trim();
        const role = $('#role').val();
        const manager = $('#assigned_manager').val();

        // Validate username
        if (username.length < 3) {
            isValid = false;
            $('#usernameError').text('Username must be at least 3 characters long.').show();
        }

        // Validate email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            isValid = false;
            $('#emailError').text('Please enter a valid email address.').show();
        }

        // Validate first name
        if (firstName === '') {
            isValid = false;
            $('#firstNameError').text('First name is required.').show();
        }

        // Validate last name
        if (lastName === '') {
            isValid = false;
            $('#lastNameError').text('Last name is required.').show();
        }

        // Validate password
        if (password.length < 6) {
            isValid = false;
            $('#passwordError').text('Password must be at least 6 characters long.').show();
        }

        // Validate role
        if (role === null || role === '') {
            isValid = false;
            $('#roleError').text('Please select a role.').show();
        }

        // Validate role
        if (role == 'agent' && (manager === null || manager === '')) {
            isValid = false;
            $('#managerError').text('Please select a manager.').show();
        }

        // Stop submission if validation fails
        if (!isValid) {
            return;
        }

        // Show loader
        $('#loader').show();

        // Prepare data for AJAX request
        var formData = {
            action: 'uct_add_user', // The action we are hooking into
            username: $('#username').val(),
            email: $('#email').val(),
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            password: $('#password').val(),
            role: $('#role').val(),
            assigned_manager: $('#assigned_manager').val(),
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
                    $('#successMsg').text('User added successfully!').show();
                    setTimeout(() => {
                        window.location.href = '?action=list';
                    }, 1500); // Reload after 1.5 seconds

                } else {
                    if(response.data.username){
                        $('#usernameError').text(response.data.message).show();
                    } else if(response.data.email){
                        $('#emailError').text(response.data.message).show();
                    } else {
                        $('#errorMsg').text(response.data.message).show();
                    }
                }
            },
            error: function() {
                // Hide loader
                $('#loader').hide();
                $('#errorMsg').text(xhr.responseText).show();
            }
        });
    });


    // Click on Edit button
    $(document).on('click', '.edit-user', function() {
        var userId = $(this).data('id');
        window.location.href = '?action=edit&user_id=' + userId;
    });


    // Edit user form submission
    $('#edit-user-form').on('submit', function(e) {
        e.preventDefault();

        // Clear all previous error messages
        $('span[id$="Error"]').hide().text('');

        // Flag to track validation status
        let isValid = true;

        // Get form field values
        const username = $('#username').val().trim();
        const email = $('#email').val().trim();
        const firstName = $('#first_name').val().trim();
        const lastName = $('#last_name').val().trim();
        const password = $('#password').val().trim();
        const role = $('#role').val();
        const manager = $('#assigned_manager').val();

        // Validate email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            isValid = false;
            $('#emailError').text('Please enter a valid email address.').show();
        }

        // Validate first name
        if (firstName === '') {
            isValid = false;
            $('#firstNameError').text('First name is required.').show();
        }

        // Validate last name
        if (lastName === '') {
            isValid = false;
            $('#lastNameError').text('Last name is required.').show();
        }

        // Validate password
        if (password !== '' && password.length < 6) {
            isValid = false;
            $('#passwordError').text('Password must be at least 6 characters long.').show();
        }

        // Validate role
        if (role === null || role === '') {
            isValid = false;
            $('#roleError').text('Please select a role.').show();
        }

         // Validate role
         if (role == 'agent' && (manager === null || manager === '')) {
            isValid = false;
            $('#managerError').text('Please select a manager.').show();
        }

        // Stop submission if validation fails
        if (!isValid) {
            return;
        }

        // Show loader
        $('#loader').show();

        // Prepare data for AJAX request
        var formData = {
            action: 'uct_update_user', // The action we are hooking into
            user_id: $('#user_id').val(),
            username: $('#username').val(),
            email: $('#email').val(),
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            password: $('#password').val(),
            role: $('#role').val(),
            assigned_manager: $('#assigned_manager').val(),
            uct_nonce: $('#uct_nonce').val()  // Include nonce for security
        };

        $.ajax({
            url: uct_vars.ajaxurl, // Use localized ajaxurl
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Hide loader
                    $('#loader').hide();
                    $('#successMsg').text('User edited successfully!').show();
                    setTimeout(() => {
                        window.location.href = '?action=list';
                    }, 1500); // Reload after 1.5 seconds
                } else {
                    if(response.data.email){
                        $('#emailError').text(response.data.message).show();
                    } else {
                        $('#errorMsg').text(response.data.message).show();
                    }
                }
            },
            error: function() {
                // Hide loader
                $('#loader').hide();
                $('#errorMsg').text(xhr.responseText).show();
            }
        });
    });

    // Name Field only accepts characters and spaces
    $('#first_name').on('input', function () {
        let value = $(this).val();
        let sanitizedValue = value.replace(/[^a-zA-Z\s]/g, '');
        $(this).val(sanitizedValue);
    });

    $('#last_name').on('input', function () {
        let value = $(this).val();
        let sanitizedValue = value.replace(/[^a-zA-Z\s]/g, '');
        $(this).val(sanitizedValue);
    });

    // Run on page load
    toggleManagerDropdown();

    // Run when role selection changes
    $('#role').change(function() {
        toggleManagerDropdown();
    });

    function toggleManagerDropdown() {
        var selectedRole = $('#role').val();
        if (selectedRole === 'agent') {
            $('#assigned_manager').parent().show();
        } else {
            $('#assigned_manager').parent().hide();
        }
    }

});
