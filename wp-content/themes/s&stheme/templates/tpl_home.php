<?php
/*Template Name: Template - Home*/
get_header();
?>

<div class="bannersec">
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<!-- <?php 
		  	$slides = get_field('homebanner_repeater');
			$count_slides = count($slides);
			// for($i=0;$i<$count_slides;$i++){
		  	?> -->
		  	<?php
		  	$i=0;
		  	while(have_rows('homebanner_repeater')): the_row();
			$homebanner_title = get_sub_field('homebanner_title');
			?>
		    <li data-target="#carouselExampleControls" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i==0)?'active':''; ?>">
		    	<div class="transport_bx">
					<p><?=$homebanner_title;?></p>
				</div>
		    </li>
		   <!--  <li data-target="#carouselExampleControls" data-slide-to="1">
		    	<div class="transport_bx">
					<p>Warehousing</p>
				</div>
		    </li>
		    <li data-target="#carouselExampleControls" data-slide-to="2">
		    	<div class="transport_bx">
					<p>Air Freight</p>
				</div>
		    </li> -->
		    <?php $i++; endwhile; ?>
		    
		</ol>
	  <div class="carousel-inner">
  	    <?php
		  	$i=1;
		  	while(have_rows('homebanner_repeater')): the_row();
			$homebanner_image = get_sub_field('homebanner_image');
			$homebanner_text = get_sub_field('homebanner_text');
			$homebanner_video = get_sub_field('homebanner_video');
		?>
		<div class="carousel-item <?php if($i==1){ ?>active<?php } ?>">	
	      <div class="banner_box">
	      	<?php
	      	if($homebanner_image){
			?>
	      	<img src="<?php echo $homebanner_image['url'];?>" alt="<?=$homebanner_image['alt'];?>">
	      	<?php }?>
	      	<?php
	      	if($homebanner_video){
			?>
			<div class="banvideo">
		  		<video loop autoplay muted>
		  			<source src="<?php echo $homebanner_video; ?>"></source>
		  		</video>
			</div>
			<?php }?>
			<?php
	      	if($homebanner_text){
			?>
	      	<div class="banbx_inn">
	      		<div class="container">
                <strong><?=$homebanner_text;?></strong>				
				</div>
	      	</div>
	      	<?php }?>
	      </div>
	    </div>
	    <?php $i++; endwhile; ?>

	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
</div>

<?php
$logistic_service_title=get_field('logistic_service_title');
$logistic_service_content=get_field('logistic_service_content');
$logistic_service_link=get_field('logistic_service_link');
$logistic_service_image=get_field('logistic_service_image');
?>

<section class="fast_service_sec tophead">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="fast_service_box">
					<div class="fast_service_inn">
						<?php
						if($logistic_service_title){
						?>
                        <h1><?=$logistic_service_title;?></h1>
                        <?php } ?>
                        <?php if($logistic_service_content){?>
                        <p><?=$logistic_service_content;?></p>
                        <?php } ?>
                        <?php if($logistic_service_link){?>
						<a href="<?=$logistic_service_link;?>" class="plus_btn"><i class="fa-solid fa-plus"></i>View more<br>
						about our services</a>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<?php if($logistic_service_image){?>
				<div class="img_box">
					<img src="<?php echo $logistic_service_image['url'];?>" alt="<?=$logistic_service_image['alt'];?>">
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<section class="serve_sec tophead owlnavstyle">
	<div class="container">
		<?php
		$industry_title = get_field('industry_title');
		if($industry_title){
		?>
		<h2><?= $industry_title;?></h2>
		<?php } ?>
		
		<div class="owl-carousel">
			<?php 
		  		while( have_rows('industry_repeater') ): the_row(); 
				$industry_icon = get_sub_field('industry_icon');
				$industry_heading = get_sub_field('industry_heading');
			?>	
			<div class="item">
				<div class="serve_bx">
					<i><img src="<?php echo $industry_icon['url'];?>" alt="service1"></i>
					<?php if($industry_heading){?>
					<p><?= $industry_heading;?></p>
					<?php } ?>
				</div>
			</div>
			<?php endwhile; ?>
			
		</div>
		
		<!-- <div class="owl-carousel">
			<?php
			$i=1;
			while(have_rows('industry_repeater')): the_row();
			$industry_icon = get_sub_field('industry_icon');
			$industry_title = get_sub_field('industry_title');
			?>
			
			<div class="item">
				<div class="serve_bx">
					<?php if($industry_icon){?>
					<i><img src="<?php echo $industry_icon['url'];?>" alt="<?= $industry_icon['alt'];?>"></i>
					<?php } ?>
					<?php if($industry_title){?>
					<p><?= $industry_title;?></p>
					<?php } ?>
				</div>
			</div>
			<?php $i++; endwhile; ?>
			
		</div> -->
	</div>
</section>


<?php
$your_needs_image = get_field('your_needs_image');
$your_needs_title = get_field('your_needs_title');
$your_needs_content = get_field('your_needs_content');
$your_needs_link = get_field('your_needs_link');
?>

<section class="fleet_cover_sec tophead">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<?php if($your_needs_image){?>
				<div class="img_box">
					<img src="<?php echo $your_needs_image['url'];?>" alt="service1">
				</div>
				<?php } ?>
			</div>
			<div class="col-md-5 fleet_rt">
				<?php if($your_needs_title){?>
                <h2><?=$your_needs_title;?></h2>
                <?php } ?>
                <?php if($your_needs_content){?>
                 <p><?=$your_needs_content;?></p>
                 <?php } ?>
                <?php if($your_needs_link){?>
				<a href="<?=$your_needs_link;?>" class="plus_btn"><i class="fa-solid fa-plus"></i>View more<br>
				about our services</a>
				<?php } ?>
			</div>
		</div>
	</div>
</section>


<?php
$testimonial_background_image = get_field('testimonial_background_image');
if($testimonial_background_image){
?>

<section class="testimonial_sec tophead" style="background: url(<?php echo $testimonial_background_image['url'];?>) no-repeat center center";>
	<div class="container">
		<div class="owl-carousel">
			
			<?php
			while(have_rows('testimonial_repeater')): the_row();
			$client_image = get_sub_field('client_image');
			$client_name = get_sub_field('client_name');
			$client_designation = get_sub_field('client_designation');
			$client_description = get_sub_field('client_description');
			?>
			
			<div class="item">
				<div class="testimonial_bx">
					<i class="quote"><img src="<?php echo get_template_directory_uri();?>/assets/images/quote.webp" alt="quote"></i>
					<h2><?=$client_description;?></h2>
					<div class="media">
						<img src="<?php echo $client_image['url'];?>" alt="<?=$client_image['alt'];?>">
						<div class="media-body">
							<span><?=$client_designation;?></span>
							<p><?=$client_name;?></p>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
			
			
		</div>
	</div>
</section>

<?php } ?>

<section class="quality_sec tophead">
	<div class="container">
		<h2>How We Work</h2>
		<div class="row">
			<?php
			while(have_rows('quality_box_repeater')): the_row();
			$quality_box_icon = get_sub_field('quality_box_icon');
			$quality_box_title = get_sub_field('quality_box_title');
			$quality_box_content = get_sub_field('quality_box_content');
			?>
			<div class="col-md-3">
				<div class="quality_bx">
					<?php if($quality_box_icon){?>
					<i><img src="<?php echo $quality_box_icon['url'];?>" alt="quality"></i>
					<?php } ?>
					<?php if($quality_box_title){?>
                     <h6><?=$quality_box_title;?></h6>
                     <?php } ?>
                     <?php if($quality_box_content){?>
					<p><?=$quality_box_content;?></p>
					<?php } ?>
				</div>
			</div>
			<?php endwhile; ?>
			

		</div>
	</div>
</section>


<?php
$secure_courier_title = get_field('secure_courier_title');
$secure_courier_content = get_field('secure_courier_content');
$secure_courier_link = get_field('secure_courier_link');
$secure_courier_image = get_field('secure_courier_image');
?>

<section class="fast_service_sec tophead courier_sec2">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="fast_service_box">
					<div class="fast_service_inn">
						<?php if($secure_courier_title){?>
                    <h3><?=$secure_courier_title;?></h3>
                    <?php } ?>
                    <?php if($secure_courier_content){?>
			          <p><?=$secure_courier_content;?></p>
			          <?php } ?>
			          <?php if($secure_courier_link){?>
						<a href="<?=$secure_courier_link;?>" class="plus_btn"><i class="fa-solid fa-plus"></i>View more<br>
						about our services</a>
						<?php } ?>
					</div>	
				</div>	
			</div>
			<div class="col-md-8">
				<?php if($secure_courier_image){?>
				<div class="img_box">
					<img src="<?php echo $secure_courier_image['url'];?>" alt="courier">
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<!-- <section class="meet_team_sec tophead">
	<div class="container">
		<?php
		$team_title=get_field('team_title');
		if($team_title){
		?>
		<h3><?=$team_title;?></h3>
		<?php } ?>
		<div class="owl-carousel">
			<?php
			while(have_rows('team_repeater')): the_row();
			$team_name = get_sub_field('team_name');
			$team_designation = get_sub_field('team_designation');
			$team_image = get_sub_field('team_image');
			?>
			<div class="item">
				<div class="team_box">
					<div class="media">
						<img src="<?php echo $team_image['url'];?>" alt="<?=$team_image['alt'];?>">
						<div class="media-body">
							<p><?=$team_designation;?></p>
							<strong><?=$team_name;?></strong>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
			
		</div>
	</div>
</section> -->

<?php
$best_courier_service_background_image = get_field('best_courier_service_background_image');
if($best_courier_service_background_image){
?>

<section class="best_service_sec tophead">
	<div class="best_service_bx">
		<img src="<?php echo $best_courier_service_background_image['url'];?>" alt="truck">
		<div class="best_service_bxinn">
			<?php
			$best_courier_service_title = get_field('best_courier_service_title');
			$best_courier_service_heading = get_field('best_courier_service_heading');
			?>
			
			<div class="container">
				<?php if($best_courier_service_title){?>
				<h2><?=$best_courier_service_title;?></h2>
				<?php } ?>
				<?php if($best_courier_service_heading){?>
				<p><?=$best_courier_service_heading;?></p>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<?php
$best_courier_service_under_section_content = get_field('best_courier_service_under_section_content');
if($best_courier_service_under_section_content){
?>
<section class="lorem_sec text-center tophead">
	<div class="container">
     <h2><?=$best_courier_service_under_section_content;?></h2>
	</div>
</section>
<?php } ?>


<section class="blog_sec tophead blog_sec_home"> 
	<div class="container">
		<h3>Latest Blogposts</h3>
		<div class="owl-carousel"> <?php
		    $args = array(  
				'category' 		=> '16',
				'post_type' 	=> 'post',
				'post_status' 	=> 'publish',
				'numberposts'	=> -1,
				'orderby' 		=> 'ID', 
				'order' 		=> 'DESC', 
   		    );
			
		    //$loop = new WP_Query( $args );
		    //while ( $loop->have_posts() ) : $loop->the_post(); 
			$my_posts = get_posts( $args );
			if(!empty($my_posts)) {
				
				foreach ( $my_posts as $post ) : 
					setup_postdata( $post ); ?>
					
					<div class="item">
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
		
		<div class="view-all-btn"><a href="https://www.sandsbrokerageinc.com/blog/" class="ylw_btn">View All</a></div>
	</div>
</section>



<section class="resources_sec tophead" id="career">
	<div class="container-fluid"> <?php
		
		$resource_background_image = get_field('resource_background_image');
		if($resource_background_image) { ?>
			<div class="resourse_outer">
				<img src="<?php echo $resource_background_image['url'];?>" alt="resource1">
				
				<div class="resource_inner"> <?php
					$resource_title = get_field('resource_title');
					//$resource_heading = get_field('resource_heading');
					//$resource_link = get_field('resource_link');
					?>
					
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