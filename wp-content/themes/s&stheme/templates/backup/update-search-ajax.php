<?php
	require_once dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) . '/wp-config.php';
	global $wpdb;
	$wpdb->show_errors = TRUE;

	// check user logged in or not and role as well
	if ( is_user_logged_in() ) {

		// Set the timezone to India
		date_default_timezone_set('Asia/Kolkata');
		$current_datetime = date('Y-m-d H:i:s');
		$formatted_datetime = date('Y-m-d h:i:s A', strtotime($current_datetime));

		$current_user = wp_get_current_user();

		if ( in_array('agent', (array) $current_user->roles) || in_array('super_manager', (array) $current_user->roles) || in_array('manager', (array) $current_user->roles) || in_array('administrator', (array) $current_user->roles) ) {

			$search_data_table_name = $wpdb->prefix . 'search_data';

			$last_insert_id = sanitize_text_field($_POST['last_insert_id']);
			$selected_term = sanitize_text_field($_POST['selected_term']);

			$wpdb->update(
				$search_data_table_name,
				array(
					'selected_term' => $selected_term,
				),
				array('id'=>$last_insert_id)
			);

		}
	}
?>