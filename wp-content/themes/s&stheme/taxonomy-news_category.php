<?php
/*Template Name: Template - News*/
get_header();
?>

<?php 
$news_category_slug = get_queried_object()->slug;
$news_category_name = get_queried_object()->name;
$news_category_id = get_queried_object()->term_id;
?>
<?php
$taxonomy = 'news_category';
$inner_banner_image = get_field('inner_banner_image',$taxonomy . '_' . $news_category_id);
?>
<?php if($inner_banner_image){?>
<div class="bannersec">
    <div class="banner_box inner_banner">
      	<img src="<?php echo $inner_banner_image['url'];?>" alt="<?=$inner_banner_image['alt'];?>">
      	<div class="banbx_inn ">
      		<div class="container">
      			<h1><?php echo $news_category_name; ?></h1>
		    </div>
	   </div>
   </div>
</div>
<?php } ?>


<section class="latestnews_sec tophead">
    <div class="container">
        <h2><span>Latest <em>News</em></span></h2>
        	
			<?php
			//PAGINATION-CODE
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			//PAGINATION-CODE
			
			$al_tax_post_args = array(
			'post_type' => 'news', // Your Post type Name that You Registered
			'order' => 'DESC',
			'paged' => $paged,
			'tax_query' => array(
			array(
			'taxonomy' => 'news_category',
			'field' => 'slug',
			'terms' => $news_category_slug
			)
			)
			);
			$al_tax_post_qry = new WP_Query($al_tax_post_args);
			
			$i=1;
			if($al_tax_post_qry->have_posts()) :
			?>
			<div class="row">
			<?php
			while($al_tax_post_qry->have_posts()) :
			$al_tax_post_qry->the_post();
			?>
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
            <?php  endwhile; ?>
			<?php wp_reset_postdata(); ?>
        </div>
        <?php  endif; ?>
		<?php bittersweet_pagination(); ?>
        
</section>


<?php get_footer(); ?>