<?php
	require_once dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) . '/wp-config.php';
	global $wpdb;
	//$wpdb->show_errors = TRUE;

	$last_insert_id = '';

	// check user logged in or not and role as well
	if ( is_user_logged_in() ) {

		// Set the timezone to India
		date_default_timezone_set('Asia/Kolkata');
		$current_datetime = date('Y-m-d H:i:s');
		$formatted_datetime = date('Y-m-d h:i:s A', strtotime($current_datetime));

		$current_user = wp_get_current_user();

		if ( in_array('agent', (array) $current_user->roles) || in_array('super_manager', (array) $current_user->roles) || in_array('manager', (array) $current_user->roles) || in_array('administrator', (array) $current_user->roles) ) {

			//Insert Data in to wp_search_data table
			$search_data_table_name = $wpdb->prefix . 'search_data';

			$search_term = sanitize_text_field(wp_unslash($_POST['search']));
			$search_page = sanitize_text_field($_POST['search_page']);
			$location_id = intval( get_user_meta($current_user->ID, 'user_location', true) );

			if( !empty($location_id) ) {
				
				$result = $wpdb->get_var( $wpdb->prepare(
					"SELECT name FROM {$wpdb->prefix}locations WHERE id = %d", 
					$location_id
				));
				
				if( !empty($result) ) {
					$location = esc_html($result); 
				} else {
					$location = null; 
				}
			} else {
				$location = null; 
			}

			// Insert new search record
			$wpdb->insert(
				$search_data_table_name,
				array(
					'user_id' => $current_user->ID,
					'display_name' => $current_user->display_name,
					'user_email' => $current_user->user_email,
					'user_role' => implode(', ', $current_user->roles),
					'search_term' => strtolower($search_term),
					'selected_term' => "",
					'search_page' => $search_page,
					'location' => $location,
					'date' => $formatted_datetime,
				),
				array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
			);
			
			 $last_insert_id = $wpdb->insert_id;

			// Delete records older than 1 month for current user
			$wpdb->query(
				$wpdb->prepare(
					"DELETE FROM $search_data_table_name
					WHERE user_id = %d
					AND `date` < NOW() - INTERVAL 1 MONTH",
					$current_user->ID
				)
			);
		}
	}

	$exclude_search_term = array("Tra", "Tran", "Trans", "Transp", "Transpo", "Transpor", "Transport", "Transports", "Transporta",  "Transportat", "Transportati", "Transportatio", "Transportation", "LLC", "Inc", "Log", "Logi", "Logis", "Logist", "Logistic", "Logistics", "Roa", "Road", "Roadw", "Roadwa", "Roadway", "Roadways", "Tru",  "Truc", "Truck", "Trucki", "Truckin", "Trucking", "Exp", "Expr", "Expre", "Expres", "Express", "Car", "Carr", "Carri", "Carrie", "Carrier", "Carriers", "Com", "Comp", "Compa", "Compan", "Company", "cor", "corp", "corpo", "corpor", "corpora", "corporat", "corporati", "corporatio","corporation", "inc", "inco", "incor", "incorp", "incorpo", "incorpor", "incorpora", "incorporat", "incorporate", "incorporated", "USA", "AIR");

	if(isset($_POST['search']) && !in_array(strtolower($_POST['search']), array_map('strtolower',$exclude_search_term))) {
  		$search_data = $_POST['search'];

		echo '<ul class="carrier-list">';
		$lc_list = $wpdb->get_results("SELECT * FROM wp_sandsbrokerage WHERE customer_profile_name LIKE '%$search_data%'");

		if(count($lc_list) > 0) {
			foreach ( $lc_list as $clist ) {
				
				if (str_contains($clist->customer_profile_name, "'")) {
					$customer_profile_name = str_replace("'","`",$clist->customer_profile_name);
				} else if (str_contains($clist->customer_profile_name, '"')) {
					$customer_profile_name = str_replace('"',"`",$clist->customer_profile_name);
				} else {
					$customer_profile_name = $clist->customer_profile_name;
				}
			?>
				<li onclick='fill("<?php echo $customer_profile_name; ?>","<?php echo $clist->customer_status; ?>","<?php echo $clist->customer_status_as_per_policy; ?>","<?php echo $clist->last_load_date; ?>","<?php echo $clist->customer_contact_name; ?>","<?php echo $clist->customer_city; ?>","<?php echo $clist->customer_state; ?>","<?php echo $clist->customer_zip; ?>","<?php echo $clist->customer_phone; ?>","<?php echo $clist->billing_phone; ?>","<?php echo $clist->customer_email; ?>","<?php echo $clist->customer_website_url; ?>","<?php echo $clist->sales_rep_name; ?>","<?php echo $clist->region; ?>","<?php echo $last_insert_id; ?>")'>
					<a id="<?php echo $clist->id; ?>" href="javascript:void(0)">
						<?php echo $clist->customer_profile_name; ?>
					</a>
				</li>			
		<?php
			}
		} else {
			echo '<li class="cerror"><span style="text-transform: uppercase;">'.$search_data.'</span> - No Match Found!</li>';
		}
		echo '</ul>';
	} else {
		$search_data = $_POST['search'];
		echo '<ul class="carrier-list">';
		echo '<li class="cerror"><span style="text-transform: uppercase;">'.$search_data.'</span> - No Match Found!</li>';
		echo '</ul>';
	}
?>