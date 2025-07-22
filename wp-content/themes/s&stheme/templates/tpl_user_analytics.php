<?php
	/*Template Name: Template - User Analytics*/
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
            <a href="<?php echo get_site_url();?>/account" class="button-primary">Back</a>
				<?php
					if ( is_user_logged_in() ) {
						$current_user = wp_get_current_user();

						if ( in_array('manager', (array) $current_user->roles) || in_array('super_manager', (array) $current_user->roles) || in_array('super_admin', (array) $current_user->roles)) {
										$location_id = get_user_meta($current_user->ID, 'user_location', true);
										$show_location = (in_array('super_admin', (array) $current_user->roles)) ? true : false; 
						?>
										<div class="manager">
											<table id="manager_agent_list" class="table table-bordered table-hover dt-responsive">
												<thead>
													<tr>
														<th>Sr. No.</th>
														<th>Name</th>
														<th>Email</th>
														<th>Search Term</th>
														<th>Selected Term</th>
														<th>Search Page</th>
														<?php if($show_location) { ?><th>Location</th> <?php } ?>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
													<!-- Data will be inserted dynamically by DataTables -->
												</tbody>
											</table>
										</div>
						<?php
						} else {
								echo '<p class="cerror">You do not have permission to view this page.</p>';
						}
				} else {
						echo '<p class="cerror">You must be logged in to view this page.</p>';
				}
				?>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function() {
        var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
        var show_location = <?php echo $show_location ? 'true' : 'false'; ?>; 

        var columns = [
            { 
                "data": null, 
                "render": function(data, type, row, meta) {
                    return meta.row + 1 + meta.settings._iDisplayStart; // Continuous serial number
                } 
            },
            { 
                "data": "full_name",
                "render": function(data) {										
                    return data && data.trim() !== "" ? data : "N/A";
                }
            },
            { 
                "data": "user_email",
                "render": function(data) {
                    return data && data.trim() !== "" ? data : "N/A";
                }
            },
            { 
                "data": "search_term",
                "render": function(data) {
                    return data && data.trim() !== "" ? data : "N/A";
                }
            },
            { 
                "data": "selected_term",
                "render": function(data) {
                    return data && data.trim() !== "" ? data : "N/A";
                }
            },
            { 
                "data": "search_page",
                "render": function(data) {
                    return data && data.trim() !== "" ? data : "N/A";
                }
            },
            { 
                "data": "date",
                "render": function(data) {
                    return data && data.trim() !== "" ? data : "N/A";
                }
            }
        ];

				console.log(columns);

        // Add Location column if user is an Super Admin
        if (show_location) {
            columns.splice(6, 0, { 
                "data": "location",
                "title": "Location",
                "render": function(data) {
                    return data && data.trim() !== "" ? data : "N/A";
                }
            });
        }

        var table = jQuery('#manager_agent_list').DataTable({
            "responsive": true,
            "lengthMenu": [[40, 60, 80, 100], [40, 60, 80, 100]],
            "processing": true,
            "serverSide": true,
            "paging": true,
            "pageLength": 40, // Default number of records per page
            "searching": true, // Ensure search is enabled
            "ajax": function(data, callback, settings) {
                var searchValue = data.search.value;

                // Only send search request if input length is greater than 3 or empty
                if (searchValue.length > 3 || searchValue.length === 0) {
                    var requestData = {
                        action: 'user_analytics_data',
                        draw: data.draw,
                        start: data.start,
                        length: data.length,
                        search_value: searchValue // Pass search input
                    };

                    jQuery.ajax({
                        url: ajaxUrl,
                        type: "GET",
                        data: requestData,
                        success: function(response) {
                            if (response.data && response.data.data) {
                                callback({
                                    draw: response.draw,
                                    recordsTotal: response.data.recordsTotal,
                                    recordsFiltered: response.data.recordsFiltered,
                                    data: response.data.data // Return processed data
                                });
                            } else {
                                console.error("Invalid response format:", response);
                                callback({ data: [] });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                            callback({ data: [] });
                        }
                    });
                } else {
                    // If search value is less than 4 characters, do nothing
                    callback({ data: [], recordsTotal: 0, recordsFiltered: 0 });
                }
            },
            "columns": columns,
            "stateSave": false
        });

        // Manually trigger search when input is 4+ characters
        jQuery('#manager_agent_list_filter input').unbind().bind('keyup', function() {
            var searchValue = jQuery(this).val();
            if (searchValue.length > 3 || searchValue.length === 0) {
                table.search(searchValue).draw();
            }
        });
    });

</script>

<script src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>

<?php get_footer();?>