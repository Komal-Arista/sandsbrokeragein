<?php
/*Template Name: Template - Ocean*/
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



<section class="ocean_top_sec tophead">
	<div class="container">
		<div class="row align-items-center">
			<?php
$shipping_image = get_field('shipping_image');
if($shipping_image){?>
			<div class="col-md-12 col-lg-6 col-xl-4 pb-3">
				<div class="ocean_img">
					<img src="<?php echo $shipping_image['url'];?>" alt="<?php echo $shipping_image['alt'];?>">
				</div>
			</div>
			<?php }?>
<?php
$shipping_content = get_field('shipping_content');
if($shipping_content){?>
			<div class="col-md-12 col-lg-6 col-xl-8 ocean_rt">
				<?php echo $shipping_content; ?>
			</div>
			<?php }?>
		</div>
	</div>
</section>



<?php
$port_bg = get_field('port_bg');
$port_content = get_field('port_content');
$port_link = get_field('port_link');
if($port_bg){?>
<section class="port_sec tophead" style="background: url(<?php echo $port_bg['url'];?>) no-repeat top left;">
	<div class="container">
		<div class="port_text">
			<?php echo $port_content; ?>
			<?php
if($port_link){?>
			<a class="ylw_btn" href="<?php echo $port_link; ?>">Ready To Start</a>
			<?php }?>
		</div>	
	</div>
</section>
<?php }?>



<section class="whatset_sec tophead">
	<div class="container">
		<?php
$support_topheading = get_field('support_topheading');
if($support_topheading){?>
		<h2><span><?php echo $support_topheading; ?></span></h2>
		<?php }?>
		
		
		<div class="row whatset_inner">
			<?php 
		  		while( have_rows('support_box') ): the_row(); 
				$support_image = get_sub_field('support_image');
				$support_content = get_sub_field('support_content');
			?>
			<div class="col-lg-4 col-md-6 col-sm-12 col-12">
				<div class="apart_bx">
					<i><img src="<?php echo $support_image['url'];?>" alt="<?php echo $support_image['alt'];?>"></i>
					<?php echo $support_content; ?>
				</div>
			</div>
			<?php endwhile; ?>
			
		</div>
	</div>
</section>



<section class="resources_sec tophead" id="career">
	<div class="container-fluid"> <?php
		$resource_background_image = get_field('resource_background_image', '5');
		if($resource_background_image) { ?>
			
			<div class="resourse_outer">
				<img src="<?php echo $resource_background_image['url'];?>" alt="resource1">
				
				<div class="resource_inner"> <?php
					$resource_title = get_field('resource_title', '5');	?>
					
					<div class="resource_inner_bx"> <?php 
						if($resource_title){?>
							<h2><span><?=$resource_title;?></span></h2> <?php 
						} ?>
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