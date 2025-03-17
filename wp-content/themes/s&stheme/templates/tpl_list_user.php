<?php
	/*Template Name: Template - List User*/
	get_header();
	$inner_banner_image = get_field('inner_banner_image');
	$inner_banner_text = get_field('inner_bannr_text');
	echo do_shortcode('[restrictedpages]');
?>
<?php if($inner_banner_image){?>
	<div class="bannersec adv-srch-banner-only">
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

<section class="contact_btm_sec tophead adv-search-result">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<?php
				if ( is_user_logged_in() ) {
					$user = wp_get_current_user();
					if ( in_array('super_manager', (array) $user->roles) ) {
			?>
				<div class="user-list">
                    <?php echo do_shortcode('[user_crud]'); ?>
				</div>
			<?php
					} else {
						echo '<p class="cerror">You do not have permission to view this page.</p>';
					}
			} else {
					echo '<p class="cerror">You must be logged in to view this page.</p>';
				}
			?>
			</div>
		</div>
	</div>
</section>

<?php get_footer();?>