<?php
/*Template Name: Template - Privacy Policy*/
get_header(); ?>

<?php
$inner_banner_image = get_field('inner_banner_image');
$inner_banner_text 	= get_field('inner_bannr_text');

if($inner_banner_image) { ?>
	<div class="bannersec">
	    <div class="banner_box inner_banner">
	      	<img src="<?php echo $inner_banner_image['url'];?>" alt="<?=$inner_banner_image['alt'];?>">
	      	<div class="banbx_inn ">
	      		<div class="container"> <?php 
	      			if($inner_banner_text) { ?>
	      				<h1><?=$inner_banner_text;?></h1> <?php 
	      			} ?>	
			    </div>
		   </div>
	   </div>
	</div> <?php 
} ?>

<section class="privacy_policy_sec tophead"> 
	<div class="container"> <?php
		$privacy_policy_content = get_field('privacy_policy_content');
		if($privacy_policy_content) { ?>
		    <div class="privacy_policy">
	            <?php echo $privacy_policy_content; ?>        
	        </div> <?php 
	   	} ?>
	</div>
</section>

<?php get_footer();?>