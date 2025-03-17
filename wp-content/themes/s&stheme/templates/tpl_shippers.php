<?php
/*Template Name: Template - Shippers*/
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



<section class="career_sec shipping_top tophead">
	<div class="container">
		<div class="row">
			<?php
			$shippers_top_content = get_field('shippers_top_content');
			if($shippers_top_content){?>
			<div class="col-md-7 career_rt shipper_inner">
				<?php echo $shippers_top_content; ?>
			</div>
			<?php }?>
			<?php
			$shippers_top_image = get_field('shippers_top_image');
			if($shippers_top_image){?>
			<div class="col-md-5">
				<div class="career_img">
					<img src="<?php echo $shippers_top_image['url'];?>" alt="<?=$shippers_top_image['alt'];?>">
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</section>


<?php
$transporting_experience_bg = get_field('transporting_experience_bg');
$transporting_experience_heading = get_field('transporting_experience_heading');
$transporting_experience_link = get_field('transporting_experience_link');
if($transporting_experience_bg){?>
<section class="port_sec streamlined_sec  tophead" style="background: url(<?php echo $transporting_experience_bg['url'];?>) no-repeat top left;">
	<div class="container">
		<div class="streamlined_box">
			<h2><?php echo $transporting_experience_heading; ?></h2>
			<a class="ylw_btn" href="<?php echo $transporting_experience_link; ?>">Contact Now</a>
		</div>	
	</div>
</section>
<?php }?>



<section class="about_shippers tophead about_shippers2">
    <div class="container">
    	<?php
		$about_shippers_topheading = get_field('about_shippers_topheading');
		if($about_shippers_topheading){?>
        <h2><span><?php echo $about_shippers_topheading; ?></span></h2>
        <?php }?>
        <div class="row">
        	
        	<?php 
		  		while( have_rows('about_shippers_box') ): the_row(); 
				$about_shippers_image = get_sub_field('about_shippers_image');
				$about_shippers_content = get_sub_field('about_shippers_content');
			?>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                <div class="ashippers_box">
                     <img class="w-100" src="<?php echo $about_shippers_image['url'];?>" alt="<?php echo $about_shippers_image['allt'];?>">  
                     <div class="cntnt">
                     	<?php echo $about_shippers_content; ?>
                     </div>       
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
					$resource_title = get_field('resource_title', '5'); ?>
					
					<div class="resource_inner_bx"> <?php 
						if($resource_title){ ?>
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