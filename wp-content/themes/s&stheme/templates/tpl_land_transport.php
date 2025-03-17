<?php
/*Template Name: Template - Land Transport*/
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


 
 <section class="truckload_sec tophead">
     <div class="container">
         <div class="row">
         	<?php
			$truck_freight_content = get_field('truck_freight_content');
			if($inner_banner_image){?>
             <div class="col-md-12 col-lg-12 col-xl-6 pr-5 pb-4">
                <div class="truckload_text">
                     <h2><?php echo $truck_freight_content; ?></h2>
                 </div>
             </div>
             <?php }?>
             <?php
			$truck_freight_image = get_field('truck_freight_image');
			$exp_years = get_field('exp_years');
			if($truck_freight_image || $exp_years){?>
             <div class="col-md-12 col-lg-12 col-xl-6 pl-5">
                 <div class="truckload_img">
                     <img src="<?php echo $truck_freight_image['url'];?>" alt="<?=$truck_freight_image['alt'];?>">
                     <span><strong><?php echo $exp_years; ?></strong></span>
                 </div>
             </div>   
             <?php }?>         
         </div>
     </div>
 </section>
 
 
<div class="truckload_services">
	<?php
	$truckload_service_image = get_field('truckload_service_image');
	if($truckload_service_image){?>
    <div class="services_truc">
        <img src="<?php echo $truckload_service_image['url'];?>" alt="<?=$truckload_service_image['alt'];?>">
    </div>
    <?php }?> 
    <div class="container">
        <div class="row">
        	
        <?php
		$truckload_service_content = get_field('truckload_service_content');
		if($truckload_service_content){?>
        <div class="col-md-6">
            <div class="tservices_box">
                <?php echo $truckload_service_content; ?>
            </div>
        </div>
        <?php }?>
        <?php
		$truckload_capabilities_content = get_field('truckload_capabilities_content');
		if($truckload_capabilities_content){?>	
        <div class="col-md-6">
            <div class="tservices_box">
                <?php echo $truckload_capabilities_content; ?>
            </div>
        </div>
        <?php }?>
    </div>
    </div>
</div>
 




<section class="truckload_Industry tophead">
    <div class="container">
    	<?php
		$truckload_industry_topheading = get_field('truckload_industry_topheading');
		if($truckload_industry_topheading){?>	
        <h2><span><?php echo $truckload_industry_topheading; ?></span></h2>
        <?php }?>
       <div class="truckland_desk">
	        <div class="row">
	        	
	        	<?php 
			  		while( have_rows('truckload_industry_repeater') ): the_row(); 
					$truckload_industry_icon = get_sub_field('truckload_industry_icon');
					$truckload_industry_option = get_sub_field('truckload_industry_option');
				?>
	            <div class="col-3">
	                <div class="Industry_box">
	                    <img src="<?php echo $truckload_industry_icon['url'];?>" alt="<?=$truckload_industry_icon['alt'];?>">
	                    <strong><?php echo $truckload_industry_option; ?></strong>
	                </div>
	            </div>
	            <?php endwhile; ?>
	            
	        </div>
        </div>
        
        
            <div class="truckland_mob">
		        <div class="owl-carousel">
		        	<?php 
				  		while( have_rows('truckload_industry_repeater') ): the_row(); 
						$truckload_industry_icon = get_sub_field('truckload_industry_icon');
						$truckload_industry_option = get_sub_field('truckload_industry_option');
					?>
		            <div class="item">
		                <div class="Industry_box">
		                    <img src="<?php echo $truckload_industry_icon['url'];?>" alt="<?=$truckload_industry_icon['alt'];?>">
		                    <strong><?php echo $truckload_industry_option; ?></strong>
		                </div>
		            </div>
		            <?php endwhile; ?>
		        </div>
	        </div>
        
        
    </div>
</section>


<?php
$client_testimonial_topheading = get_field('client_testimonial_topheading');
$client_testimonial_bg = get_field('client_testimonial_bg');
if($client_testimonial_topheading){?>	
<section class="clienc_testimonials tophead" style="background: url(<?php echo $client_testimonial_bg['url'];?>) no-repeat;">
    <div class="container">
    	<?php
if($client_testimonial_topheading){?>	
         <h2><span><?php echo $client_testimonial_topheading; ?></span></h2>
         <?php }?>
        <div class="owl-carousel">
        	<?php 
		  		while( have_rows('client_testimonial') ): the_row(); 
				$testimonial_content  = get_sub_field('testimonial_content');
				$testimonial_name = get_sub_field('testimonial_name');
			?>
            <div class="item">              
                <?php echo $testimonial_content; ?>
                <span><?php echo $testimonial_name; ?></span>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php }?>



<section class="resources_sec tophead" id="career">
	<div class="container-fluid"> <?php
		$resource_background_image = get_field('resource_background_image', '5');
		if($resource_background_image) { ?>

			<div class="resourse_outer">
				<img src="<?php echo $resource_background_image['url'];?>" alt="resource1">
				
				<div class="resource_inner"> <?php
					$resource_title = get_field('resource_title', '5'); ?>
					
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
			</div>
		<?php } ?>
		
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
