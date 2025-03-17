<?php
/*Template Name: Template - News*/
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







<section class="latestnews_sec tophead">
    <div class="container">
        <h2><span>Latest <em>News</em></span></h2>
        <div class="row">
        	
        	<?php
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query('post_type=news&showposts=6'.'&paged='.$paged);
			?>	
			<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
            <div class="col-lg-4 col-md-6 col-sm-6">
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
                            <li><i class="fa-light fa-user"></i><?php echo get_the_author(); ?></li>
                            <li><i class="fa-regular fa-calendar-days"></i><?php echo get_the_date('d.m.Y'); ?></li>
                        </ul>
                       	<h4><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title();?></a></h4>
                        <p><?php echo strlen(substr(strip_tags(get_the_content()),0,100)) ?substr(strip_tags(get_the_content()),0,100).'&hellip;&nbsp;&nbsp;' : get_the_content().'&nbsp;&nbsp;';?></p>
                        <a class="ylw_btn" href="<?php echo get_the_permalink(); ?>">Read More</a>
                    </div>
                </div>
            </div>
            <?php endwhile;  wp_reset_postdata();?>
            <?php bittersweet_pagination(); ?>
		<?php $wp_query = null; $wp_query = $temp;?>
        </div>
        
    </div>
</section>





<?php get_footer();?>