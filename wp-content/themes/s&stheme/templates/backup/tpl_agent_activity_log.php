<?php
	/*Template Name: Template - Agent Activity Log*/
	get_header();

	$inner_banner_image = get_field('inner_banner_image');
	$inner_banner_text = get_field('inner_bannr_text');
	echo do_shortcode('[restrictedpages]');
?>
<?php if($inner_banner_image){?>
	<div class="bannersec adv-srch-banner-only">
		<div class="banner_box inner_banner">
			<img src="<?php echo $inner_banner_image['url'];?>" alt="<?=$inner_banner_image['alt'];?>">
			<div class="banbx_inn ">
				<div class="container">
					<?php if($inner_banner_text){?>
					<h1><?=$inner_banner_text;?></h1>
					<?php } ?>	
				</div>
		   </div>
	   </div>
	</div>
<?php } ?>

<style>
	.manager {
	  -webkit-user-select: none; /* Safari */
	  -ms-user-select: none; /* IE 10 and IE 11 */
	  user-select: none; /* Standard syntax */
	}
</style>
<script>
	/* Code to disable select and copy content, right click, F12 key and Ctr + u key */
	document.addEventListener('contextmenu', event => event.preventDefault());
	jQuery(document).keydown(function (event) {
		if (event.keyCode == 123) {
			return false;
		} else if (event.ctrlKey && (event.keyCode == 67 || event.keyCode == 86  || event.keyCode == 85 || event.keyCode == 117)) {
			return false;
		} else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
			return false;
		}
	});
	/* Code to disable select and copy content, right click, F12 key and Ctr + u key */
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css" rel="stylesheet">

<section class="contact_btm_sec tophead adv-search-result">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				global $wpdb;
				$table_prefix = $wpdb->prefix;

				// Check if the user is logged in
				if (is_user_logged_in()) {
					$current_user = wp_get_current_user();
					$current_user_roles = (array)$current_user->roles;
					$current_user_location_id = get_user_meta($current_user->ID, 'user_location', true);
					$users = [];

					// Check if the user has the required roles
					if (in_array('manager', $current_user_roles) || in_array('super_manager', $current_user_roles)) {
						// Define query logic based on user roles
						$query = '';
						if (in_array('super_manager', $current_user_roles)) {
								if ($current_user_location_id == '4') { // Super Manager with India-All location
									$query = "SELECT u.ID, u.display_name, u.user_email, s.id, s.created_on, s.client_ip, s.event_type, s.user_roles, um.meta_value AS location
											FROM {$wpdb->users} u
											LEFT JOIN {$wpdb->prefix}usermeta um ON u.ID = um.user_id AND um.meta_key = 'user_location'
											INNER JOIN {$table_prefix}wsal_occurrences s ON u.ID = s.user_id
											WHERE u.ID != 1
											ORDER BY s.id DESC";
								} else { // Super Manager with specific location
									$user_ids = $wpdb->get_col(
										$wpdb->prepare(
											"SELECT user_id 
											FROM {$table_prefix}usermeta 
											WHERE meta_key = 'user_location' AND meta_value = %s", 
											$current_user_location_id
										)
									);
									if (!empty($user_ids)) {
										$placeholders = implode(',', array_fill(0, count($user_ids), '%d'));
										$query = $wpdb->prepare(
											"SELECT u.ID, u.display_name, u.user_email, s.id, s.created_on, s.client_ip, s.event_type, s.user_roles
											FROM {$wpdb->users} u
											INNER JOIN {$table_prefix}wsal_occurrences s ON u.ID = s.user_id
											WHERE u.ID IN ($placeholders)
											ORDER BY s.id DESC",
											$user_ids
										);
									}
								}
						} elseif (in_array('manager', $current_user_roles)) { // Manager
							$agent_ids = $wpdb->get_col(
								$wpdb->prepare(
									"SELECT agent_id 
									FROM {$table_prefix}agent_manager_relationships 
									WHERE manager_id = %d", 
									$current_user->ID
								)
							);
							if (!empty($agent_ids)) {
								$placeholders = implode(',', array_fill(0, count($agent_ids), '%d'));
								$query = $wpdb->prepare(
									"SELECT u.ID, u.display_name, u.user_email, s.id, s.created_on, s.client_ip, s.event_type, s.user_roles
									FROM {$wpdb->users} u
									INNER JOIN {$table_prefix}wsal_occurrences s ON u.ID = s.user_id
									WHERE u.ID IN ($placeholders)
									ORDER BY s.id DESC",
									$agent_ids
								);
							}
						}

						// Fetch users if a query is defined
						if (!empty($query)) {
							$users = $wpdb->get_results($query);
						}
						// echo "<pre>";
						// print_r($users);
						// echo "</pre>"; die;
						?>
						<div class="manager">
							<table id="agent_activity_log" summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th>Event Type</th>
										<th>Details</th>
										<th>Created On</th>
										<th>Client IP</th>
										<?php if (in_array('super_manager', $current_user_roles) && $current_user_location_id == '4') : ?>
											<th>Location</th>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php
									if (!empty($users)) {
										foreach ($users as $index => $user) {

											$timestamp = $user->created_on;

											// Create DateTime object
											$date = DateTime::createFromFormat('U.u', $timestamp);

											$date->setTimezone(new DateTimeZone('Asia/Kolkata'));

											$formatted_date = $date->format("F j, Y h:i:s a");
											?>
											<tr>
												<td><?php echo $index + 1; ?></td>
												<td><?php echo esc_html($user->display_name); ?></td>
												<td><?php echo esc_html($user->user_email); ?></td>
												<td style="text-transform: capitalize;"><?php echo esc_html(str_replace('_', ' ', $user->user_roles)); ?></td>
												<td style="text-transform: capitalize;"><?php echo esc_html($user->event_type); ?></td>
												<td>
													<?php
													if (in_array($user->event_type, ['login', 'logout', 'failed-login', 'created', 'deleted', 'modified'])) {
														switch ($user->event_type) {
															case 'login':
																echo "User logged in.";
																break;

															case 'logout':
																echo "User logged out.";
																break;

															case 'failed-login':
																echo "Failed login attempt.";
																break;

															case 'created':
															case 'deleted':
															case 'modified':
																// Fetch all metadata for the current occurrence_id in one query
																$metadata = $wpdb->get_results(
																	$wpdb->prepare(
																		"SELECT name, value 
																		FROM {$wpdb->prefix}wsal_metadata 
																		WHERE occurrence_id = %d",
																		$user->id
																	),
																	OBJECT_K // Fetch results as an associative array with 'name' as the key
																);

																if ($user->event_type == 'created') {
																	if (isset($metadata['NewUserID'])) {
																		$user_id = $metadata['NewUserID']->value;
																		$userData = get_userdata($user_id);

																		if ($userData) {
																			$username = esc_html($userData->user_login);
																			$email = esc_html($userData->user_email);
																			$roles = implode(', ', array_map('esc_html', $userData->roles));

																			echo "<strong>Username:</strong> $username<br>";
																			echo "<strong>Email:</strong> $email<br>";
																			echo "<strong>Role:</strong> $roles";
																		} else {
																			echo "User data not found as user might be deleted.";
																		}
																	}
																} elseif ($user->event_type == 'deleted') {
																	if (isset($metadata['TargetUserData'])) {
																		$serializedData = $metadata['TargetUserData']->value;
																		$userData = unserialize($serializedData);

																		if ($userData && is_object($userData)) {
																			echo "<strong>Username:</strong> " . esc_html($userData->Username) . "<br>";
																			echo "<strong>Email:</strong> " . esc_html($userData->Email) . "<br>";
																			echo "<strong>Role:</strong> " . esc_html($userData->Roles);
																		} else {
																			echo "User data not found.";
																		}
																	}
																} elseif ($user->event_type == 'modified') {
																	if (!empty($metadata)) {
																		$dataFound = false; 
																		foreach ($metadata as $name => $data) {
																			// Exclude specific names
																			if (!in_array($name, ['multisite_text', 'EditUserLink', 'TargetUserID', 'TargetUserData'])) {
																				echo "<strong>" . esc_html($name) . ":</strong> " . esc_html($data->value) . "<br>";
																				$dataFound = true;
																			} 
																		}
																		// If no valid data was found, display the message
																		if (!$dataFound) {
																			echo "User data not found as user might be deleted.";
																		}
																	} else {
																		echo "User data not found as user might be deleted.";
																	}
																}
																break;

															default:
																echo "N/A";
																break;
														}
													} else {
														echo "N/A";
													}
													?>
												</td>
												<td><?php echo $formatted_date;?></td>
												<td><?php echo esc_html($user->client_ip); ?></td>
												<?php if (in_array('super_manager', $current_user_roles) && $current_user_location_id == '4') : 
													$location = $wpdb->get_results("SELECT `name` FROM {$table_prefix}locations 
                                            										WHERE id = {$user->location}", ARRAY_A);
											
													$location_name = 	array_column($location, 'name');
												?>
													<td><?php echo !empty($location_name) ? esc_html($location_name[0]) : "N/A"; ?></td>
												<?php endif; ?>
											</tr>
											<?php
										}
									} 
									?>
								</tbody>
							</table>
						</div>
						<?php
					} else {
						// If the user does not have the required roles
						echo '<p class="cerror">You do not have permission to view this page.</p>';
					}
				} else {
					// If the user is not logged in
					echo '<p class="cerror">You must be logged in to view this page.</p>';
				}
				?>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#agent_activity_log').DataTable({
			"responsive": true,
			"lengthMenu": [[40, 60, 80, 100], [40, 60, 80, 100]]
		});
	});
</script>

<script src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>

<?php get_footer();?>