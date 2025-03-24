<?php
	/*Template Name: Template - Advance Search*/
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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style>
	/* Banner CSS */
	.adv-srch-banner-only .banner_box:before { background:transparent;}
	.adv-srch-banner-only { margin-top:88px;}
	.adv-srch-banner-only .inner_banner img { height:346px;}
	.adv-search-result .search-box { background:#fff; position:absolute; top:0; left:0; right:0; margin:-220px auto 0 auto; max-width:650px; padding:3px 3px 3px 10px; border-radius:10px; display:flex;}
	.adv-search-result .search-box input { height:auto !important;}
	.adv-search-result .search-box #search { color:#000; font-family:'Roboto', sans-serif; padding:10px 10px 10px 38px; width:75%; border:0; font-size:20px; background-image:url(https://www.sandsbrokerageinc.com/wp-content/uploads/2024/08/adv-search-icon.webp);
    background-repeat:no-repeat; background-position:center left; text-transform:uppercase;}
	.adv-search-result .search-box #search_data { font-family:'Roboto', sans-serif; padding:10px 10px; width:25%; border:0; background:#000000; color:#fff; text-transform:uppercase; font-size:20px; border-radius:8px; transition:0.5s ease; cursor:pointer; margin-top:0;}
	.adv-search-result .search-box #search_data:hover { background:#f7c600; color:#000;}
	.adv-srch-banner-only .banbx_inn { top:35%;}
	.adv-search-result .search-box ul.carrier-list { width:100%; position:absolute; top:60px; left:0; right:0; margin:0 auto; background:#fff; border-radius:10px; padding:5px; box-shadow:0 3px 3px #c3c3c3; z-index:9; max-height: 375px; overflow-y: auto;}
	.adv-search-result .search-box ul.carrier-list li a { font-size:16px; text-transform:uppercase; color:#000; font-weight:400; display:block; transition:none;}
	.adv-search-result .search-box ul.carrier-list li a:hover { color:#d9ac00;}
	.adv-search-result .search-box ul.carrier-list li { text-align:left; padding:5px 0 5px 15px; border-bottom:1px solid #e8e8e8;}
	.adv-search-result .search-box ul.carrier-list li:last-child { border-bottom:0;}
	.adv-search-result { background:#f1f1f1; padding:60px 0; min-height:600px;}
	.adv-search-result #carrier-data ul { border:1px solid #c7c7c7; margin-top:0; width:100%; max-width:1435px; background:#fff; box-shadow:0 0 10px #c7c7c7; padding:0; border-radius:0; margin-left:auto; margin-right:auto; display:flex; flex-wrap:wrap;}
	.adv-search-result #carrier-data ul li { vertical-align:top; display:inline-block; border-bottom:1px solid #c7c7c7; padding:10px;}
	.adv-search-result #carrier-data ul li.cd-left { width:20%; background:#ebebeb; text-align:right; font-weight:500; border-right:1px solid #c7c7c7; border-left:1px solid #c7c7c7; line-height:22px;}
	.adv-search-result #carrier-data ul li.cd-right { width:30%; line-height:22px;}
	.adv-srch-banner-only .banbx_inn { padding-left:15px; padding-right:15px;}
	.adv-search-result p.cerror { text-align:center; border:1px solid red; padding:10px !important; font-weight:600;}

	.carrier-data-main, .carrier-list {
	  -webkit-user-select: none; /* Safari */
	  -ms-user-select: none; /* IE 10 and IE 11 */
	  user-select: none; /* Standard syntax */
	}

	@media screen and (max-width: 1399px) {
		.adv-srch-banner-only { margin-top:74px;}
		.adv-search-result .container { max-width:100%;}
	}

	@media screen and (max-width: 991px) {
		.adv-srch-banner-only { margin-top:70px;}
		.adv-srch-banner-only .inner_banner img { height:310px;}
		.adv-search-result #carrier-data ul li.cd-left {width:35%;}
		.adv-search-result #carrier-data ul li.cd-right {width:65%;}
	}

	@media screen and (max-width: 819px) {
		.adv-search-result .search-box { margin:-220px auto 0 auto; padding-right:3px;}
	}

	@media screen and (max-width: 767px) {
		.adv-search-result #carrier-data ul li.cd-left {width:45%;}
		.adv-search-result #carrier-data ul li.cd-right {width:55%;}
		.adv-search-result { min-height:300px;}
	}

	@media screen and (max-width: 650px) {
		.adv-search-result .search-box { margin:-220px 15px 0 15px;}
	}

	@media screen and (max-width: 599px) {
		.adv-srch-banner-only { margin-top:130px;}
		.adv-srch-banner-only .inner_banner img { height:250px;}
		.adv-srch-banner-only .banbx_inn { top:32%;}
		.adv-search-result .search-box { margin:-160px 15px 0 15px;}
		.adv-search-result .search-box #search, .adv-search-result .search-box #search_data { font-size:16px;}
		.adv-search-result .search-box ul.carrier-list li a { font-size:16px;}
		.adv-search-result { padding:30px 0;}
		.adv-search-result #carrier-data ul { display:flex; flex-wrap:wrap;}
		.adv-search-result #carrier-data ul li.cd-left { width:40%; border-right:0;}
		.adv-search-result #carrier-data ul li.cd-right { width:60%; word-wrap:break-word;}
		.adv-search-result #carrier-data ul li.cd-left, .adv-search-result #carrier-data ul li.cd-right { line-height:18px;}
		.adv-search-result .search-box #search {padding:5px 10px 5px 38px;}
		.adv-search-result .search-box #search_data { padding:5px 5px 5px 5px;}
		.adv-search-result .search-box ul.carrier-list { top:50px;}
	}

	@media screen and (max-width: 479px) {
		.adv-search-result #carrier-data ul li.cd-left, .adv-search-result #carrier-data ul li.cd-right { font-size:14px;}
	}

	@media screen and (max-width: 359px) {
		.adv-search-result #carrier-data ul li.cd-left, .adv-search-result #carrier-data ul li.cd-right { font-size:14px;}
	}

	/* Banner CSS */

	
	/* Search CSS */
	#carrier-data * {
	  box-sizing: border-box;
	}
	.cerror{
		color: red;
	}
	/* Search CSS */
</style>
<section class="contact_btm_sec tophead adv-search-result">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<?php
				if ( is_user_logged_in() ) {
					$user = wp_get_current_user();
					if ( in_array('manager', (array) $user->roles) || in_array('super_manager', (array) $user->roles) || in_array('super_admin', (array) $user->roles) || in_array('administrator', (array) $user->roles) ) {
			?>
				<div class="search-box">
					<input type="text" id="search" placeholder="SEARCH" /> <input type="button" id="search_data" value="Search"><br />
					<div id="display"></div>
				</div>
			<?php
					} else {
						echo '<p class="cerror">You do not have permission to view this page.</p>';
					}
			} else {
					echo '<p class="cerror">You must be logged in to view this page.</p>';
				}
			?>

				<script>
					/* Code to disable select and copy content, right click, F12 key and Ctr + u key */
					document.addEventListener('contextmenu', event => event.preventDefault());
					$(document).keydown(function (event) {
						if (event.keyCode == 123) {
							return false;
						} else if (event.ctrlKey && (event.keyCode == 67 || event.keyCode == 86  || event.keyCode == 85 || event.keyCode == 117)) {
							return false;
						} else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
							return false;
						}
					});
					/* Code to disable select and copy content, right click, F12 key and Ctr + u key */

					function fill(customer_profile_name,customer_status,customer_status_as_per_policy,last_load_date,customer_contact_name,customer_city,customer_state,customer_zip,customer_phone,billing_phone,customer_email,customer_website_url,sales_rep_name,region,last_insert_id) {

						if(last_insert_id != ''){
							var search_data = last_insert_id;
							var selected_company_name = customer_profile_name;

							$.ajax({
								type: "POST",
								url: "<?php echo site_url()?>/wp-content/themes/s&stheme/templates/update-search-ajax.php",											
								data: {
									last_insert_id: last_insert_id,
									selected_term: selected_company_name,
								},											
								success: function(html) {
								}
							});
						}
						
						if(customer_profile_name.includes("'")){
							var cp_name = customer_profile_name.replace(/`/g, "'");
						} else if(customer_profile_name.includes('"')){
							var cp_name = customer_profile_name.replace(/`/g, '"');
						} else {
							var cp_name = customer_profile_name;
						}

						var carrier_data = "";

						carrier_data += "<ul class='carrier-data-main'>";
						carrier_data += "<li class='cd-left'>Customer Profile Name:</li><li class='cd-right'>"+cp_name+"</li>";
						carrier_data += "<li class='cd-left'>Customer Status:</li><li class='cd-right'>"+customer_status+"</li>";
						carrier_data += "<li class='cd-left'>Customer Status As Per Policy:</li><li class='cd-right'>"+customer_status_as_per_policy+"</li>";
						carrier_data += "<li class='cd-left'>Last Load Date (MM/DD/YYYY):</li><li class='cd-right'>"+last_load_date+"</li>";
						carrier_data += "<li class='cd-left'>Customer Contact Name:</li><li class='cd-right'>"+customer_contact_name+"</li>";
						carrier_data += "<li class='cd-left'>Customer City:</li><li class='cd-right'>"+customer_city+"</li>";
						carrier_data += "<li class='cd-left'>Customer State:</li><li class='cd-right'>"+customer_state+"</li>";
						carrier_data += "<li class='cd-left'>Customer Zip:</li><li class='cd-right'>"+customer_zip+"</li>";
						carrier_data += "<li class='cd-left'>Customer Phone:</li><li class='cd-right'>"+customer_phone+"</li>";
						carrier_data += "<li class='cd-left'>Billing Phone:</li><li class='cd-right'>"+billing_phone+"</li>";
						carrier_data += "<li class='cd-left'>Customer Email:</li><li class='cd-right'>"+customer_email+"</li>";
						carrier_data += "<li class='cd-left'>Customer Website Url:</li><li class='cd-right'>"+customer_website_url+"</li>";
						carrier_data += "<li class='cd-left'>Sales Rep Name:</li><li class='cd-right'>"+sales_rep_name+"</li>";
						carrier_data += "<li class='cd-left'>Region:</li><li class='cd-right'>"+region+"</li>";
						carrier_data += "</ul>";
						
						$('#search').val(cp_name);
						$('#display').hide();
						$("#carrier-data").show();
						$("#carrier-data").html(carrier_data);
					}

					$(document).ready(function() {
						function searchCarrierData(keyevent, searchterm){
							var search_data = searchterm;
							var page = "advance search"; //advance-search page

							if( keyevent == 13 || keyevent == 'buttonclick' ) {
								if( search_data.length > 2) {
									if (search_data == "") {
									   $("#display").html("");
									} else {								   
										$.ajax({
											type: "POST",
											url: "<?php echo site_url()?>/wp-content/themes/s&stheme/templates/search-ajax.php",											
											data: {
												search: search_data,
												search_page: page,
											},											
											success: function(html) {
												$("#display").html(html).show();

												if(html == '<ul class="carrier-list"><li class="cerror">No Match Found!</li></ul>'){
													$("#carrier-data").hide();
												}
											}
										});
									}
								} else {
									$('#display').show();
									$("#carrier-data").hide();
									var else_carrier_data = '';
									else_carrier_data += '<ul class="carrier-list">';
									else_carrier_data += '<li class="cerror">Please Enter Minimum 3 Character!</li>';
									else_carrier_data += '</ul>';
									$("#display").html(else_carrier_data);
								}								
							}
						}

						$('#search').keypress(function (e) {
							var key = e.which;
							var name = $('#search').val();
							searchCarrierData(key, name);
						});

						$("#search_data").click(function(){
							var name = $('#search').val();
							searchCarrierData('buttonclick', name);
						});						
					});
				</script>

				<div id="carrier-data"></div>
			</div>
		</div>
	</div>
</section>

<?php get_footer();?>