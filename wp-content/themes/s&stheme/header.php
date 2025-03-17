<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
  <head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-M6D69RM');</script>
    <!-- End Google Tag Manager -->
	
	<?php
	//global $post;
	//$curr_page_id = $post->ID;
	
	//if($curr_page_id == 781) { ?>
	<!-- <meta name="robots" content="noindex, nofollow" /> --> 
	<?php
	//} ?>

    <meta charset="<?php bloginfo('charset');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  
    <link href="<?php echo get_template_directory_uri();?>/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri();?>/assets/css/fonts.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri();?>/assets/css/doc.css" rel="stylesheet">
	<!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css"> -->
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
	<link href="<?php echo get_template_directory_uri();?>/assets/css/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri();?>/assets/css/animate.css" rel="stylesheet">
	
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M6D69RM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php wp_body_open(); ?>
<header class="header_sec">
	<div class="container">
		<nav class="navbar navbar-expand-lg nav_top">			
			<?php
				$header_logo = get_field('header_logo','option');
				if( isset( $header_logo ) ){ 
			?>
					<a class="navbar-brand" href="#"><img src="<?php echo $header_logo['url']; ?>" alt="<?php echo $header_logo['alt']; ?>" /></a>				
			<?php } ?>

			<?php 
				if ( is_user_logged_in() ) {
					Global $post;
					$current_pageID = $post->ID;
					$manager_pageID = array("935", "899", "817", "985", "974", "990");
					$agent_pageID   = array("935", "899");

					$user = wp_get_current_user();
					
					if ( in_array('manager', (array) $user->roles) && in_array($current_pageID, $manager_pageID) ) {
					
					} else if ( in_array('agent', (array) $user->roles) && in_array($current_pageID, $agent_pageID) ) {
					
					} else {
			?>
						<a class="bbb-seal" href="https://www.bbb.org/us/nj/iselin/profile/transportation-services/s-s-brokerage-inc-0221-90215865/#sealclick" target="_blank" rel="nofollow"><img class="seal-logo" src="https://seal-newjersey.bbb.org/seals/blue-seal-293-61-bbb-90215865.png" style="border: 0;" alt="S & S Brokerage Inc BBB Business Review" /></a>
			<?php
					}
				} else {

			?>
					<a class="bbb-seal" href="https://www.bbb.org/us/nj/iselin/profile/transportation-services/s-s-brokerage-inc-0221-90215865/#sealclick" target="_blank" rel="nofollow"><img class="seal-logo" src="https://seal-newjersey.bbb.org/seals/blue-seal-293-61-bbb-90215865.png" style="border: 0;" alt="S & S Brokerage Inc BBB Business Review" /></a>
			<?php
				}
			?>
			  
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  
  			  <!-- First Main Menu Start -->
			  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
			  	<?php
					if ( is_user_logged_in() ) {

						Global $post;
						$current_pageID = $post->ID;
						$manager_pageID = array("935", "899", "817", "985", "974", "990", "1053", "1063");
						$agent_pageID   = array("935", "899");

						$user = wp_get_current_user();
						if( !in_array('super_manager', (array) $user->roles))
						{ ?>
						<style>
								.super_manager_user_menu{ display:none !important;}
						</style>
						<?php }
						if ( (in_array('manager', (array) $user->roles) || in_array('super_manager', (array) $user->roles)) && in_array($current_pageID, $manager_pageID) ) {

							$defaults = array(
							'theme_location'  => '',
							'menu'            => 'Manager Menu',
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
							'items_wrap'      => '<ul class="navbar-nav menu_sec manager-menu">%3$s</ul>',
							'depth'           => 0,
							'walker'          => new wp_bootstrap_navwalker()
							);

						} else if ( in_array('agent', (array) $user->roles) && in_array($current_pageID, $agent_pageID) ) {

							$defaults = array(
							'theme_location'  => '',
							'menu'            => 'Agent Menu',
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
							'items_wrap'      => '<ul class="navbar-nav menu_sec agent-menu">%3$s</ul>',
							'depth'           => 0,
							'walker'          => new wp_bootstrap_navwalker()
							);

						} else {

							$defaults = array(
							'theme_location'  => 'primary',
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
							'items_wrap'      => '<ul class="navbar-nav menu_sec loggedin-menu">%3$s</ul>',
							'depth'           => 0,
							'walker'          => new wp_bootstrap_navwalker()
							);

						}

					} else {

						$defaults = array(
						'theme_location'  => 'primary',
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
						'items_wrap'      => '<ul class="navbar-nav menu_sec">%3$s</ul>',
						'depth'           => 0,
						'walker'          => new wp_bootstrap_navwalker()
						);

					}

					wp_nav_menu( $defaults );
				?>
			  </div>
			<!-- First Main Menu End -->

			<!-- Second Sidebar Menu Start -->
			<?php
				if ( is_user_logged_in() ) {
					Global $post;
					$current_pageID = $post->ID;
					$manager_pageID = array("935", "899", "817", "985", "974", "990");
					$agent_pageID   = array("935", "899");

					$user = wp_get_current_user();
					
					if ( in_array('manager', (array) $user->roles) && in_array($current_pageID, $manager_pageID) ) {
					
					} else if ( in_array('agent', (array) $user->roles) && in_array($current_pageID, $agent_pageID) ) {
					
					} else {

						//echo '<button class="navbar-toggler hamburger" type="button"><span class="icon-bar"></span><span class="icon-bar"></span>	<span class="icon-bar"></span></button>'; 

						echo '<div class="overlay_menu">';

							$defaults = array(
							'theme_location'  => 'topmenu',
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
							'items_wrap'      => '<ul>%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
							);
							wp_nav_menu( $defaults );

						echo '</div>';
					}
				} else {

					echo '<button class="navbar-toggler hamburger" type="button"><span class="icon-bar"></span><span class="icon-bar"></span>	<span class="icon-bar"></span></button>'; 

					echo '<div class="overlay_menu">';

						$defaults = array(
						'theme_location'  => 'topmenu',
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
						'items_wrap'      => '<ul>%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
						);
						wp_nav_menu( $defaults );

					echo '</div>';
				}
			?>
			<!-- Second Sidebar Menu End -->

		</nav>
	</div>
</header>