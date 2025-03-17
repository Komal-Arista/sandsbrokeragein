<?php
/*Template Name: Template - news*/
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



<section class="latestnews_sec tophead news_details">
    <div class="container">
        <h2><span>Latest <em>News</em></span></h2>
        <div class="news_box">
        	<?php
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			if ($image) : ?>
            <div class="news_img">
            	<a href="<?php echo get_the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="newsimg"></a>
            </div>
            <?php endif; ?>
            <div class="news_text">
                <ul>
                    <li><i class="fa-regular fa-calendar-days"></i><?php echo get_the_date('d.m.Y'); ?></li>
                </ul>
               	<h4><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title();?></a></h4>
                <?php echo get_the_content();?>
            </div>
        </div>
        
    </div>
</section>





<?php get_footer(); ?>
