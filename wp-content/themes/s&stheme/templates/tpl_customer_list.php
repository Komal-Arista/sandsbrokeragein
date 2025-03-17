<?php
	/*Template Name: Template - Customer List*/
	get_header();

	$inner_banner_image = get_field('inner_banner_image');
	$inner_banner_text = get_field('inner_bannr_text');
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

<section class="contact_btm_sec tophead adv-search-result">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<?php
				if ( is_user_logged_in() ) {
					$current_user = wp_get_current_user();
                    
					// Check if the user has 'manager' role
					if ( in_array('manager', (array) $current_user->roles) ) {

                        global $wpdb;
                        $table_prefix = $wpdb->prefix;

                        $records = $wpdb->get_results("SELECT * FROM {$table_prefix}sandsbrokerage ORDER BY customer_profile_name ASC", ARRAY_A);

			?>
                <div class="manager">
                    <table id="customer_list" class="table table-striped table-bordered display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Customer Profile Name</th>
                                <th>Customer Status</th>
                                <th>Customer Status As Per Policy</th>
                                <th>Last Load Date</th>
                                <th>Customer Contact Name</th>
                                <th>Customer City</th>
                                <th>Customer State</th>
                                <th>Customer Zip</th>
                                <th>Customer Phone</th>
                                <th>Billing Phone</th>
                                <th>Customer Email</th>
                                <th>Sales Rep Name</th>
                                <th>Region</th>
                                <th>Customer Website Url</th>
                            </tr>
                        </thead>
                        <?php
                            foreach ($records as $key=>$record) {
                                ?>
                                <tr>
                                    <td><?php echo ++$key; ?></td>
                                    <td><?php echo !empty($record['customer_profile_name']) ? $record['customer_profile_name'] : '--'; ?></td>
                                    <td><?php echo !empty($record['customer_status']) ? $record['customer_status'] : '--'; ?></td>
                                    <td><?php echo !empty($record['customer_status_as_per_policy']) ? $record['customer_status_as_per_policy'] : '--'; ?></td>
                                    <td><?php echo !empty($record['last_load_date']) ? $record['last_load_date'] : '--'; ?></td>
                                    <td><?php echo !empty($record['customer_contact_name']) ? $record['customer_contact_name'] : '--'; ?></td>
                                    <td><?php echo !empty($record['customer_city']) ? $record['customer_city'] : '--'; ?></td>
                                    <td><?php echo !empty($record['customer_state']) ? $record['customer_state'] : '--'; ?></td>
                                    <td><?php echo !empty($record['customer_zip']) ? $record['customer_zip'] : '--'; ?></td>
                                    <td><?php echo !empty($record['customer_phone']) ? $record['customer_phone'] : '--'; ?></td>
                                    <td><?php echo !empty($record['billing_phone']) ? $record['billing_phone'] : '--'; ?></td>
                                    <td><?php echo !empty($record['customer_email']) ? $record['customer_email'] : '--'; ?></td>
                                    <td><?php echo !empty($record['sales_rep_name']) ? $record['sales_rep_name'] : '--'; ?></td>
                                    <td><?php echo !empty($record['region']) ? $record['region'] : '--'; ?></td>
                                    <td><?php echo !empty($record['customer_website_url']) ? $record['customer_website_url'] : '--'; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        <tfoot>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Customer Profile Name</th>
                                <th>Customer Status</th>
                                <th>Customer Status As Per Policy</th>
                                <th>Last Load Date</th>
                                <th>Customer Contact Name</th>
                                <th>Customer City</th>
                                <th>Customer State</th>
                                <th>Customer Zip</th>
                                <th>Customer Phone</th>
                                <th>Billing Phone</th>
                                <th>Customer Email</th>
                                <th>Sales Rep Name</th>
                                <th>Region</th>
                                <th>Customer Website Url</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
			<?php
					} else {
						// If user does not have the required roles
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

<?php get_footer();?>