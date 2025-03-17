<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<style>
.cont-locn-foot p {
    color: #000;
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 15px;    display: flex;
    align-items: baseline;
    gap: 5px;text-align: left;
}
.cont-locn-foot h3 {
    font-size: 22px;
    line-height: 30px;
    color: #000;
    font-weight: 500;
    display: inline-block;
    padding-bottom: 12px;
    margin-top: 30px;
}
@media all and (max-width:1200px){
.cont-locn-foot p { justify-content: center;}	
	
}
</style>

<footer class="footer_sec">
	<div class="container">
		<div class="footer_top">
			<div class="row">
				<div class="col-md-4"> <?php 
					$footer_logo = get_field('footer_logo','option');
					if( isset( $footer_logo ) ) { ?>
						<a href="<?php echo home_url(); ?>" class="foot_logo"><img src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt']; ?>"></a> <?php 
					} ?>
					
					<div class="cont-locn-foot">
						<h3>Our Locations</h3>
						<p><i class="fa-sharp fa-solid fa-location-dot"></i> 120 Wood Avenue South, Suite 408, Iselin, NJ 08830</p>
						<p><i class="fa-sharp fa-solid fa-location-dot"></i> 16821 Buccaneer Ln., Suite 200, Houston, Texas 77058</p>
						<div class="bb-seal-fot">
							<a class="bb-sl-lnk" href="https://www.bbb.org/us/nj/iselin/profile/transportation-services/s-s-brokerage-inc-0221-90215865/#sealclick" target="_blank" rel="nofollow"><img class="bb-sl-lgo" src="https://seal-newjersey.bbb.org/seals/blue-seal-293-61-bbb-90215865.png" style="border: 0;" alt="S & S Brokerage Inc BBB Business Review" /></a>
						</div>
					</div>
				</div>
				
				<div class="col-md-3">
					<strong>Information</strong>
					<?php
						$defaults = array(
						'theme_location'  => 'footer',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul class="nav navbar-nav">%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
						);
						wp_nav_menu( $defaults );
					?>
				</div>
				<div class="col-md-3">
					<strong>Company Services</strong>
					<?php
						$defaults = array(
						'theme_location'  => 'services',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul class="nav navbar-nav">%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
						);
						wp_nav_menu( $defaults );
					?>
				</div>
				<!-- <div class="col-md-2">
					<strong>Company Services</strong>
					<?php
						$defaults = array(
						'theme_location'  => 'others',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul class="nav navbar-nav">%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
						);
						wp_nav_menu( $defaults );
					?>
				</div> -->
				<!--<div class="col-md-2">
					<strong>Latest News</strong>
					<?php
						$defaults = array(
						'theme_location'  => 'news',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul class="nav navbar-nav">%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
						);
						wp_nav_menu( $defaults );
					?>
				</div>-->
				<div class="col-md-2">
					<strong>Contact</strong>
					<ul class="ftrcontact">
						<?php
						$phone = get_field('phone',153);
						$inner_phone = get_field('inner_phone',153);
						$fax = get_field('fax',153);
						$inner_fax = get_field('inner_fax',153);
						?>
						<?php if($phone){?>
						<li>
							<i class="fa-solid fa-phone"></i><a href="tel:<?=$inner_phone;?>"><?=$phone;?></a>
						</li>
						<?php } ?>
						<?php if($fax){?>
						<li>
							<i class="fa-solid fa-fax"></i><a href="tel:<?=$inner_fax;?>"><?=$fax;?></a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer_bottom">
		<div class="container">
			<div class="row">
				<?php
            	$copyright_text=get_field('copyright_text','option');
				if($copyright_text){?>
					<div class="col-md-10">
						<p><?=$copyright_text;?></p>
					</div>
					<?php } ?>
					<!--<?php
            	   $developed_by=get_field('developed_by','option');
				   if($developed_by){?>
					<div class="col-md-6">
						<p><?=$developed_by;?></p>
					</div>
					<?php } ?> -->
					<div class="col-md-2">
						<ul class="footer_sos">
							 <?php 
				         while( have_rows('social_box','option') ): the_row(); 
				         $social_link = get_sub_field('social_link','option');
				         $social_icon = get_sub_field('social_icon','option');
				             ?>
							<li><a href="<?php echo $social_link; ?>" target="_blank"><?php echo $social_icon; ?></a></li>
							<?php endwhile; ?>
						</ul>
					</div>
			</div>
		</div>		
	</div>
</footer>
<?php 
global $post;
$curr_page_id = $post->ID;

if($curr_page_id != 781 && $curr_page_id != 990 && $curr_page_id != 974) { ?>
	<script src="<?php echo get_template_directory_uri();?>/assets/js/jquerymin.js"></script> <?php
} ?>

<!-- Bootstrap core JavaScript -->

<script src="<?php echo get_template_directory_uri();?>/assets/js/bootstrap.js"></script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/wow.js"></script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/scrollspy.js"></script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/wowscripts.js"></script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/carouselscript.js"></script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/owl.carousel.js"></script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/custom-file-input.js"></script>

<script>
    $(document).ready(function() {
    $(".tab_menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
</script>


<?php wp_footer();?>

<script>
    jQuery('#spanYear').html(new Date().getFullYear());
</script>

</body>
</html>
