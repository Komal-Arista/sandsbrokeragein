<?php
/*Template Name: Template - Air*/
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



<section class="supply_sec tophead">
    <div class="container">
        <div class="row supply_box">
        	<?php
			$supply_chain_image = get_field('supply_chain_image');
			if($inner_banner_image){?>
            <div class="col-md-6">
                <img src="<?php echo $supply_chain_image['url'];?>" alt="<?=$supply_chain_image['alt'];?>">
            </div>
            <?php }?>
            <?php
			$supply_chain_content = get_field('supply_chain_content');
			if($supply_chain_content){?>
            <div class="col-md-6">
                <?php echo $supply_chain_content; ?>
            </div>
            <?php }?>
        </div>
    </div>
</section>




<section class="security_sec tophead">
    <div class="container">
        <div class="row">
        	<?php
			$security_image = get_field('security_image');
			if($security_image){?>
            <div class="col-md-6">
            <div class="security_img">
                <img src="<?php echo $security_image['url'];?>" alt="<?php echo $security_image['alt'];?>">
            </div>   
        </div>
        <?php }?>
        <?php
		$security_content = get_field('security_content');
		if($security_content){?>
        <div class="col-md-6">
            <div class="security_box">
                 <?php echo $security_content; ?>
            </div>
        </div>
        <?php }?>
        
        </div>        
    </div>
</section>


<section class="whatset_sec tophead set_us">
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



<section class="fashionably_sec fashionably_sec2 tophead">
    <div class="container">
    	<h2><span>Why <em>Choose</em> Us</span></h2>
        <div class="row">
        	
        	<?php 
		  	while( have_rows('air_repeater') ): the_row(); 
				$air_repeater_image = get_sub_field('air_repeater_image');
				$air_repeater_content = get_sub_field('air_repeater_content');
			?>
           <div class="col-md-6">
             <div class="fashionably_box">
                <img src="<?php echo $air_repeater_image['url'];?>" alt="<?php echo $air_repeater_image['alt'];?>">
                <div class="fashionably_text">
                    <?php echo $air_repeater_content; ?>
                </div>
            </div>
           </div>
           <?php endwhile; ?>
           
        </div>
    </div>
</section>




<section class="resources_sec tophead" id="career">
	<div class="container-fluid">
		<?php
$resource_background_image = get_field('resource_background_image', '5');
if($resource_background_image){
?>
		<div class="resourse_outer">
			<img src="<?php echo $resource_background_image['url'];?>" alt="resource1">
			<div class="resource_inner">
				<?php
				$resource_title = get_field('resource_title', '5');
				$resource_heading = get_field('resource_heading', '5');
				$resource_link = get_field('resource_link', '5');
				?>
				
				<div class="resource_inner_bx">
					<?php if($resource_title){?>
					<h2><span><?=$resource_title;?></span></h2>
					<?php } ?>
					<?php if($resource_heading){?>
					<p><?=$resource_heading;?></p>
					<?php } ?>
					<?php if($resource_link){?>
					<a href="<?=$resource_link;?>" class="ylw_btn">access here</a>
					<?php } ?>
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
