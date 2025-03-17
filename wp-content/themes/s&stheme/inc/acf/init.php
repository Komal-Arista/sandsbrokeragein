<?php
// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/inc/acf/';

    // return
    return $path;

}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {

    // update path
    $dir = get_stylesheet_directory_uri() . '/inc/acf/';

    // return
    return $dir;

}


// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');


// 4. Include ACF
include_once( get_stylesheet_directory() . '/inc/acf/acf.php' );


/* This solves select2 js issues which crashes with WCommerce */
function my_acf_init() {

	acf_update_setting('select2_version', 4);

}

add_action('acf/init', 'my_acf_init');


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}
