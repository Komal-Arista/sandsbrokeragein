<?php
/*Template Name: Template - Career*/
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

<section class="career_sec tophead">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<?php
				$career_top_image = get_field('career_top_image');
				if($career_top_image){?>
				<div class="career_img">
					<img src="<?php echo $career_top_image['url'];?>" alt="<?php echo $career_top_image['alt'];?>">
				</div>
				<?php }?>
				
			</div>
			<?php
			$career_top_content = get_field('career_top_content');
			if($career_top_content){?>
			<div class="col-md-6 career_rt">
				<?php echo $career_top_content; ?>
			</div>
			<?php }?>
		</div>
	</div>
</section>




<section class="benefit_sec tophead">
	<div class="container">
		<?php
		$career_benefit_heading = get_field('career_benefit_heading');
		if($career_benefit_heading){?>
		<h2><span><?php echo $career_benefit_heading; ?></span></h2>
		<?php }?>
		
		<div class="owl-carousel">
			
			<?php 
		  		while( have_rows('career_benefit_slider') ): the_row(); 
				$career_benefit_image = get_sub_field('career_benefit_image');
				$career_benefit_heading = get_sub_field('career_benefit_heading');
			?>
			<div class="item">
				<div class="benefit_box">
					<div class="benefit_img">
						<img src="<?php echo $career_benefit_image['url'];?>" alt="<?php echo $career_benefit_image['alt'];?>">
					</div>
					<?php echo $career_benefit_heading; ?>
				</div>
			</div>
			<?php endwhile; ?>
			
		</div>
	</div>
</section>

<?php get_footer();?>
