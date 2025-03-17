<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>




<?php
$page_for_posts = get_option( 'page_for_posts' );
$inner_banner_image = get_field('inner_banner_image',$page_for_posts);
$inner_banner_text = get_field('inner_bannr_text',$page_for_posts);
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


<section class="latestnews_sec tophead news_details blog_details">
    <div class="container">
        <h2><span>Latest <em>Blogposts</em></span></h2>
			<?php
				/* Start the Loop */
				while ( have_posts() ) :
				the_post();
				?>
				<div class="news_box">
		        	<?php
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					if ($image) : ?>
		            <div class="news_img">
		            	<img src="<?php echo $image[0]; ?>" alt="newsimg">
		            </div>
		            <?php endif; ?>
		            <div class="news_text">
		                <ul>
		                    <li><i class="fa-regular fa-calendar-days"></i><?php echo get_the_date('d.m.Y'); ?></li>
		                </ul>
		               	<h4><?php echo get_the_title();?></h4>
		                <?php echo get_the_content();?>
		            </div>
		        </div>
	      		<div class="comments_main">
					<?php
					// If comments are open or there is at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div> 
		
		<?php
			endwhile; // End of the loop.
		?>
	</div>
</section>
<?php get_footer(); ?>
