<?php
/**
 * Plugin Name: Customer Data CRUD Plugin
 * Description: A simple plugin to manage customer Data with DataTables and CRUD operations only Super Manager can Access this.
 * Version: 1.0
 * Author: Komal Nagdev
 */

if ( ! defined('ABSPATH')) {
die('Access denied');
}

// Enqueue DataTables and Bootstrap for responsiveness
function enqueue_customer_assets() {
    // Bootstrap CSS (Required for Bootstrap styling)
    //wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css');

    // DataTables CSS and Responsive CSS
    //wp_enqueue_style('data-tables-bootstrap', 'https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css');
    //wp_enqueue_style('data-tables-responsive', 'https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css');

    // DataTables JS and Dependencies
    //wp_enqueue_script('data-tables', 'https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js', array('jquery'), null, true);
    //wp_enqueue_script('data-tables-bootstrap', 'https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js', array('jquery', 'data-tables'), null, true);
    //wp_enqueue_script('data-tables-responsive', 'https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js', array('jquery', 'data-tables'), null, true);

    // Custom script for handling DataTables in your plugin
    //wp_enqueue_script('customer-crud-js', plugin_dir_url(__FILE__) . 'assets/js/customer-crud.js', array('jquery', 'data-tables'), null, true);
    
    // Enqueue Flatpickr CSS
    wp_enqueue_style('flatpickr-css', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), null);

    // Enqueue Flatpickr JS
    wp_enqueue_script('flatpickr-js', 'https://cdn.jsdelivr.net/npm/flatpickr', array('jquery'), null, true);

    wp_enqueue_script('customer-crud-js', plugin_dir_url(__FILE__) . 'assets/js/customer-crud.js', array('jquery', 'data-tables'), null, true);

    // Pass AJAX URL to JavaScript
    wp_localize_script('customer-crud-js', 'uct_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));

    // Custom styling for the plugin
    wp_enqueue_style('customer-crud-style', plugin_dir_url(__FILE__) . 'style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_customer_assets');


// Shortcode for displaying the user CRUD interface
function uct_customer_crud_shortcode() {
    
    // include this file when shotcode called
    include(plugin_dir_path(__FILE__) . 'templates/add-customer.php');
}
add_shortcode('customer_crud', 'uct_customer_crud_shortcode');

// AJAX action for adding a customer
function uct_add_customer() {
    // Check nonce for security
    if (!isset($_POST['uct_nonce']) || !wp_verify_nonce($_POST['uct_nonce'], 'uct_add_customer_nonce')) {
        wp_send_json_error(array('message' => 'Invalid nonce'));
    }
    
    // Required fields
    $required_fields = ['customer_profile_name'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            wp_send_json_error(array('message' => ucfirst($field) . ' is required.'));
        }
    }

    // Create a new customer
    global $wpdb;
    $table_name = $wpdb->prefix . 'sandsbrokerage';

    $result = $wpdb->insert( 
        $table_name, 
        array( 
            'customer_profile_name' => sanitize_text_field($_POST['customer_profile_name']), 
            'customer_status' => sanitize_text_field($_POST['customer_status']),
            'customer_status_as_per_policy' => sanitize_text_field($_POST['customer_status_as_per_policy']), 
            'last_load_date' => sanitize_text_field($_POST['last_load_date']),
            'customer_contact_name' => sanitize_text_field($_POST['customer_contact_name']), 
            'customer_city' => sanitize_text_field($_POST['customer_city']),
            'customer_state' => sanitize_text_field($_POST['customer_state']), 
            'customer_zip' => sanitize_text_field($_POST['customer_zip']),
            'customer_phone' => sanitize_text_field($_POST['customer_phone']), 
            'billing_phone' => sanitize_text_field($_POST['billing_phone']),
            'customer_email' => sanitize_text_field($_POST['customer_email']), 
            'customer_website_url' => sanitize_text_field($_POST['customer_website_url']),
            'sales_rep_name' => sanitize_text_field($_POST['sales_rep_name']), 
            'region' => sanitize_text_field($_POST['region']),
            'date' => current_time('mysql'), 
        ) 
    );

    if ($result === false) {
        wp_send_json_error(array(
            'message' => 'Database insert failed!',
            'error' => $wpdb->last_error // Get the exact error message
        ));
    }

    // Return success response
    wp_send_json_success(array('message' => 'Customer Added Successfully'));
}
add_action('wp_ajax_uct_add_customer', 'uct_add_customer'); // For logged-in users only

