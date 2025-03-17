<?php
/*Template Name: Template - About Us*/
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




<section class="about_sec tophead">
	<div class="container">
		<div class="row">
			<?php
			$about_content = get_field('about_content');
			if($about_content){?>
			<div class="col-md-8 about_left">
				<?php echo $about_content; ?>
			</div>
			<?php }?>
			<?php
			$about_image = get_field('about_image');
			if($about_image){?>
			<div class="col-md-4 about_rt">
				<img src="<?php echo $about_image['url'];?>" alt="<?=$about_image['alt'];?>">
			</div>
			<?php }?>
		</div>
	</div>
</section>




<section class="about_sec about_sec2 tophead">
	<div class="container">
		<div class="row">
			<?php
			$mission_content = get_field('mission_content');
			if($mission_content){?>
			<div class="col-md-9 about_left">
				<?php echo $mission_content; ?>
				<?php
				$mission_signature = get_field('mission_signature');
				if($mission_signature){?>
                <i><img src="<?php echo $mission_signature['url'];?>" alt="<?=$mission_signature['alt'];?>"></i>
                <?php }?>
			</div> 
			<?php }?>
			<?php
			$mission_image = get_field('mission_image');
			if($mission_image){?>
			<div class="col-md-3 about_rt">
				<img src="<?php echo $mission_image['url'];?>" alt="<?php echo $mission_image['url'];?>">
			</div>
			<?php }?>
		</div>
	</div>
</section>



<?php
$high_work_image = get_field('high_work_image');
if($high_work_image){?>
<section class="achievement_sec tophead">
	<div class="achievement_box">
		<img src="<?php echo $high_work_image['url'];?>" alt="<?php echo $high_work_image['alt'];?>" class="w-100">
		<?php
		$high_work_content = get_field('high_work_content');
		if($high_work_content){?>
		<div class="acheive_text">
			<div class="container">
				<?php echo $high_work_content; ?>
				<?php
				$high_work_pdf = get_field('high_work_pdf');
				if($high_work_pdf){?>
				<a href="<?php echo $high_work_pdf['url'];?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/assets/images/dwnload.webp" alt=""></a>
				<?php }?>
			</div>
		</div>
		<?php }?>
	</div>
</section>
<?php }?>



<?php
$why_topcontent = get_field('why_topcontent');
?>
<section class="whychoose_sec tophead">
	<div class="container">
		<?php echo $why_topcontent; ?>
		<div class="row whychoose_inner">
			
			<?php 
		  		while( have_rows('why_box') ): the_row(); 
				$why_icon = get_sub_field('why_icon');
				$why_number = get_sub_field('why_number');
				$why_content = get_sub_field('why_content');
			?>
			<div class="col-md-3">
				<div class="why_box">
					<div class="why_top">
						<i><img src="<?php echo $why_icon['url'];?>" alt="<?php echo $why_icon['url'];?>" class="w-100"></i>
						<em><?php echo $why_number; ?></em>
					</div>
					<?php echo $why_content; ?>
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
					$resource_title = get_field('resource_title', '5');?>
					
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
</section>

<?php get_footer();?>