<?php
/*Template Name: Template - Blog*/
get_header();

$inner_banner_image = get_field('inner_banner_image');
$inner_banner_text 	= get_field('inner_bannr_text'); 

if($inner_banner_image) { ?>
	<div class="bannersec">
		<div class="banner_box inner_banner">
			<img src="<?php echo $inner_banner_image['url'];?>" alt="<?=$inner_banner_image['alt'];?>" />
			<div class="banbx_inn ">
				<div class="container"> <?php 
					if($inner_banner_text) { ?>
						<h1><?php echo $inner_banner_text; ?></h1> <?php 
					} ?>	
				</div>
		   </div>
	   </div>
	</div> <?php 
} ?>

<section class="all-blog tophead all-blog-pg-list-only"> 
	<div class="container">
		<div class="all-blog-inner"> <?php
		    $args = array(  
				'category' 		=> '16',
				'post_type' 	=> 'post',
				'post_status' 	=> 'publish',
				'numberposts'	=> -1,
				'orderby' 		=> 'ID', 
				'order' 		=> 'DESC',
			);
			
			$my_posts = get_posts( $args );
			if(!empty($my_posts)) {
				
				foreach ( $my_posts as $post ) : 
					setup_postdata( $post ); ?>
					
					<div class="blog-list">
						<div class="blog_bx">
							<div class="blog_date">
								<em><?php echo get_the_date( 'd' ); ?></em>
								<span><?php echo get_the_date( 'M' ); ?></span>
							</div>	
							<div class="blog_text">
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<p><?php echo get_the_excerpt();?></p>
								<a href="<?php the_permalink(); ?>" class="plus_btn"><i class="fa-solid fa-plus"></i>Read More<br></a>
							</div>
						</div>
					</div>
				<?php
				endforeach;
				wp_reset_postdata();
				
			} ?>
		</div>
	</div>
</section>



<section class="resources_sec tophead" id="career">
	<div class="container-fluid"> <?php
		
		$resource_background_image = get_field('resource_background_image');
		if($resource_background_image) { ?>
			<div class="resourse_outer">
				<img src="<?php echo $resource_background_image['url'];?>" alt="resource1">
				
				<div class="resource_inner"> <?php
					$resource_title = get_field('resource_title'); ?>
					
					<div class="resource_inner_bx"> <?php
						if($resource_title) { ?>
							<h2><span><?php echo $resource_title; ?></span></h2> <?php 
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
		}
		
		$canada_global_logistic_background_image = get_field('canada_global_logistic_background_image');
		if($canada_global_logistic_background_image) { ?>
		
			<div class="resource_outer2">
				<img src="<?php echo $canada_global_logistic_background_image['url'];?>" alt="resource2"> <?php
					
				$canada_global_logistic_title = get_field('canada_global_logistic_title');
				$canada_global_logistic_heading = get_field('canada_global_logistic_heading');
				$canada_global_logistic_link = get_field('canada_global_logistic_link'); ?>
				
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
			</div> <?php 
		} ?>
	</div>
</section>

<?php get_footer();?>