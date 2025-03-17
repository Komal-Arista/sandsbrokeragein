<?php
/*Template Name: Template - Contact Us*/
get_header();
?>

<?php
$inner_banner_image = get_field('inner_banner_image');
$inner_banner_text = get_field('inner_bannr_text');
?>
<?php if($inner_banner_image){?>
<div class="bannersec">
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


<style type="text/css">
	
	.contact_box .map-icon i {
    color: #000;
    font-size: 16px;
    margin-right: 5px;
    position: relative;
}
.contact_box .map-icon {
    font-size: 18px;
    line-height: 28px;
    font-weight: 400;
    position: relative;    display: flex;
    align-items: baseline;
}
.contact_box .map-icon:last-child {
    margin-bottom: 25px;
}
</style>

<?php
$address = get_field('address');
$phone = get_field('phone');
$inner_phone = get_field('inner_phone');
$fax = get_field('fax');
$inner_fax = get_field('inner_fax');
?>
<section class="contact_btm_sec tophead">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="contact_box">
					<ul>
						<?php if($address){?>
						<li>
							<i class="fa-sharp fa-solid fa-location-dot"></i>
							<h4>Our Locations</h4>
							<!--<p><?=$address;?></p>-->
							<div class="map-icon"><i class="fa-sharp fa-solid fa-location-dot"></i> 120 Wood Avenue South, Suite 408, Iselin, NJ 08830</div>
							<div class="map-icon"><i class="fa-sharp fa-solid fa-location-dot"></i> 16821 Buccaneer Ln., Suite 200, Houston, Texas 77058</div>
						</li>
						<?php } ?>
						<?php if($phone){?>
						<li>
							<i class="fa-solid fa-phone"></i>
							<h4>our phone</h4>
							<p><a href="tel:<?=$inner_phone;?>"><?=$phone;?></a></p>
						</li>
						<?php } ?>
						<?php if($fax){?>
						<li>
							<i class="fa-solid fa-fax"></i>
							<h4>Our fax</h4>
							<p><a href="tel:<?=$inner_fax;?>"><?=$fax;?></a></p>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<div class="contact-form-column">
					<h2>Feel Free To Ask A Question With Us!</h2>
					<div class="contact_form"><?php echo do_shortcode( '[contact-form-7 id="168" title="Contact Form"]' ); ?></div>
				</div>
			</div>
			
		</div>
	</div>
</section>



<?php
$map = get_field('map');
if($map){
?>

<style type="text/css">
	/*.contact_map { display: flex;gap: 30px;}
	.contact_map .cont-map { width: 50%; margin-bottom: 30px; }

	@media all and (max-width:767px){

		.contact_map { flex-wrap: wrap;gap: 0;}
		.contact_map .cont-map { width: 100%;margin-bottom: 30px; }
	}*/
</style>

<section class="contact_map">
	<div class="container">
		<div class="row mb-5">
			<div class="col-md-6 cont-map mb-4">
				<iframe src="<?=$map;?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
			<div class="col-md-6 cont-map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3470.628179429444!2d-95.1191149241481!3d29.556320675172977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86409c5948baaaab%3A0xfc00fcf5a26762f0!2sAtlas%20Building%2C%2016821%20Buccaneer%20Ln%20Suite%20200%2C%20Houston%2C%20TX%2077058%2C%20USA!5e0!3m2!1sen!2sin!4v1697044843391!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<section class="resources_sec tophead" id="career">
	<div class="container-fluid"> <?php
		$resource_background_image = get_field('resource_background_image', '5');
		if($resource_background_image){ ?>
			
			<div class="resourse_outer">
				<img src="<?php echo $resource_background_image['url'];?>" alt="resource1">
				
				<div class="resource_inner"> <?php
					$resource_title = get_field('resource_title', '5');	?>
					
					<div class="resource_inner_bx">
						<?php if($resource_title){?>
							<h2><span><?=$resource_title;?></span></h2>
						<?php } ?>
					</div>
					
					<div class="career-carousel-sec">
						<div class="owl-carousel"> <?php
						
							$car_args = array(
								'numberposts'	=> 5, 
								'category' 		=> '15',
								'post_type' 	=> 'post',
								'post_status' 	=> 'publish',
								'orderby' 		=> 'ID', 
								'order' 		=> 'DESC',
							);
							
							$my_posts = get_posts( $car_args );
							if(!empty($my_posts)) {
								$inc = 1;
								foreach ( $my_posts as $post ) : 
									setup_postdata( $post ); ?>
									
									<div class="item">
										<div class="career_bx">
											<div class="career_heading"> <h6><?php echo $inc; ?>. <?php the_title(); ?></h6> </div>											
											<div class="career_text">
												<?php echo $post->post_content; ?>
											</div>											
										</div>
									</div>
									
								<?php
								$inc++;
								endforeach;
								wp_reset_postdata();
							} ?>
						
						</div>
					</div>
				</div>
			</div> <?php 
		} ?>
		
		<?php
		$canada_global_logistic_background_image = get_field('canada_global_logistic_background_image', '5');
		if($canada_global_logistic_background_image){
		?>
		
		<div class="resource_outer2">
			<img src="<?php echo $canada_global_logistic_background_image['url'];?>" alt="resource2">
			<?php
		$canada_global_logistic_title = get_field('canada_global_logistic_title', '5');
		$canada_global_logistic_heading = get_field('canada_global_logistic_heading', '5');
		$canada_global_logistic_link = get_field('canada_global_logistic_link', '5');
		?>
			<div class="resource_inner resource_inner2">
				<?php if($canada_global_logistic_title){?>
                  <h2><?=$canada_global_logistic_title;?></h2>
                  <?php } ?>
                  <?php if($canada_global_logistic_heading){?>
 				<p><?=$canada_global_logistic_heading;?></p>
 				<?php } ?>
				<?php if($canada_global_logistic_link){?>
				<a href="<?=$canada_global_logistic_link;?>" class="ylw_btn">Learn More</a>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
	</div>
</section>

<?php get_footer();?>