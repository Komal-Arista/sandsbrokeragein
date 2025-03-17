<?php
/*Template Name: Template - Warehouse*/
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



<section class="warehouse_sec tophead"> 
	<div class="container">
		<?php
		$warehouse_top_content = get_field('warehouse_top_content');
		if($warehouse_top_content){?>
	    <div class="warehouse">
            <?php echo $warehouse_top_content; ?>        
        </div> 
         <?php }?>
            
		<div class="warehouse_contant">
			<?php
		$warehouse_top_heading = get_field('warehouse_top_heading');
		if($warehouse_top_heading){?>
		    <h2><?php echo $warehouse_top_heading; ?></h2>
		     <?php }?>
		     
		     
		    <?php 
		  		while( have_rows('warehouse_top_repeater') ): the_row(); 
				$warehouse_repeater_image = get_sub_field('warehouse_repeater_image');
				$warehouse_repeater_content = get_sub_field('warehouse_repeater_content');
			?> 
		    <div class="row">
	            <div class="col-md-6">
	                <img src="<?php echo $warehouse_repeater_image['url'];?>" alt="<?=$warehouse_repeater_image['alt'];?>" />
	            </div>
	            <div class="col-md-6">
	                <?php echo $warehouse_repeater_content; ?>
	            </div>
	        </div>
        	<?php endwhile; ?>
        
		</div>
		
	</div>
</section>

<?php if( have_rows('warehouse_service_tab') ): ?>
<section class="services tophead">
    <div class="container">
        <?php
		$warehouse_service_heading = get_field('warehouse_service_heading');
		if($warehouse_service_heading){?>
		    <h2><?php echo $warehouse_service_heading; ?></h2>
		     <?php }?>
    <ul class="tab_menu">
    	<?php $i=1; while( have_rows('warehouse_service_tab') ): the_row(); 
			$mwarehouse_service_tab_heading = get_sub_field('warehouse_service_tab_heading');
		?>
		<li <?php if($i==1){ ?>class="current"<?php } ?>><a href="#tab<?php echo $i; ?>"><?php echo $mwarehouse_service_tab_heading; ?></a></li>
        <?php $i++; endwhile; ?>
        
    </ul>
    <?php $i=1; while( have_rows('warehouse_service_tab') ): the_row(); 
		$warehouse_service_tab_image = get_sub_field('warehouse_service_tab_image');
		$warehouse_service_content = get_sub_field('warehouse_service_content');
		$warehouse_service_link = get_sub_field('warehouse_service_link');
	?>
     <div class="tab-content"  id="tab<?php echo $i; ?>" <?php if($i==1){ ?>style="display: block"<?php } ?>>
        <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $warehouse_service_tab_image['url'];?>" alt="<?php echo $warehouse_service_tab_image['alt'];?>">
        </div>
        <div class="col-md-6">
            <?php echo $warehouse_service_content; ?>
            <a href="<?php echo $warehouse_service_link; ?>" class="ylw_btn">Learn More</a>
        </div>
    </div>
    </div>
    <?php $i++; endwhile; ?>
    
    
  </div>
</section>
<?php endif; ?>	



<?php
$guaranteed_image = get_field('guaranteed_image');
$guaranteed_text = get_field('guaranteed_text');
if($guaranteed_image){?>
<section class="best_service_sec tophead guaranteed">
	<div class="best_service_bx">
		<img src="<?php echo $guaranteed_image['url'];?>" alt="<?php echo $guaranteed_image['alt'];?>">
		<?php
		if($guaranteed_text){?>
		<div class="best_service_bxinn">
			<div class="container">
				<h2><?php echo $guaranteed_text; ?></h2>				
			</div>
		</div>
		<?php }?>
	</div>
</section>
<?php }?>





<?php
$industries_support_topcontent = get_field('industries_support_topcontent'); ?>
<section class="support_sec tophead">
    <div class="container">
        <?php echo $industries_support_topcontent; ?>
        
        
        <div class="row">
        	
        <?php 
        	while( have_rows('industries_support_box') ): the_row(); 
			$industries_support_image = get_sub_field('industries_support_image');
			$industries_support_heading = get_sub_field('industries_support_heading');
		?>
          <div class="col-md-4 col-sm-6">
             <div class="support_box">
                 <img src="<?php echo $industries_support_image['url'];?>" alt="<?php echo $industries_support_image['alt'];?>">
                 <div class="support_text">
                     <strong><?php echo $industries_support_heading; ?></strong>
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