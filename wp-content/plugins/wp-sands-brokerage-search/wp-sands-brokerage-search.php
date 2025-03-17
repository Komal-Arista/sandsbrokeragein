<?php

/**
 * Plugin Name: S&S Customer Data
 * Plugin URI:  https://www.sandsbrokerageinc.com/
 * Description: Handles SandsBrokerage customer Data.
 * Version:     1.0
 * Author:      Komal Nagdev
 * Author URI:  https://www.sandsbrokerageinc.com/
 */

 if ( ! defined('ABSPATH')) {
    die('Access denied');
 }

//Constants
define("PLUGIN_PATH", plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN_BASENAME', plugin_basename(__FILE__));

include_once PLUGIN_PATH . 'class/SandBrokarageManagement.php';

$sandBrokarageManagementObject = new SandBrokarageManagement();


// Plugin Activation code

register_activation_hook( __FILE__, 'wp_sandsbrokerage_activation' ); // __FILE__ gives plugin file path

function wp_sandsbrokerage_activation() 
{
    include_once 'plugin-setup/plugin-activation.php'; 
}

// Plugin Deactivation code
 
register_deactivation_hook( __FILE__, 'wp_sandsbrokerage_deactivation' );

function wp_sandsbrokerage_deactivation() {

    include_once 'plugin-setup/plugin-deactivation.php'; 
}

//Add Scripts and Styles
function wp_sandsbrokerage_scripts() {

    // to include to specific page 
    if(is_page( 'search' )) { // use slug of that page
       
        wp_enqueue_script('search-script', plugins_url('js/search.js', __FILE__), array('jquery'), '1.0', true);
        wp_localize_script('search-script', 'ajax_search_params', array('ajax_url' => admin_url('admin-ajax.php')));
    }
}

add_action( 'wp_enqueue_scripts', 'wp_sandsbrokerage_scripts' ); // to include scripts in frontend only


// create short code for Search page Frontend

add_shortcode( 'wp-sandsbrokerage-search', 'wp_sandsbrokerage_search' );

function wp_sandsbrokerage_search() {

    ob_start();
    include_once 'public/search.php';
    return ob_get_clean();
}

function ajax_search_sandsbrokerage() {
	global $wpdb;
    $wp_sandsbrokerage = $wpdb->prefix .'sandsbrokerage';

    $search = sanitize_text_field($_POST['search']);
    
    $results = $wpdb->get_results($wpdb->prepare(
        "SELECT id, name 
         FROM $wp_sandsbrokerage
         WHERE name LIKE %s", 
         '%' . $wpdb->esc_like($search) . '%'
    ));

    if ($results) {
        foreach ($results as $res) {
            echo '<div>' . esc_html($res->name) . '</div>';
        }
    } else {
        echo '<div>No results found</div>';
    }
    
    wp_die();
}
add_action('wp_ajax_search_sandsbrokerage', 'ajax_search_sandsbrokerage'); // when user is logged In
//add_action('wp_ajax_nopriv_search_sandsbrokerage', 'ajax_search_sandsbrokerage'); // when user is logged out;












