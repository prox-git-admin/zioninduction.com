<?php get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="full-width">
                 <?php get_template_part('breadcrumbs');?>
                <article class="static-page">
                    <?php if ($term->name <> ''):?><h1 id="main-title"><?php echo $term->name;?></h1><?php endif;?>
                    <?php if ($term->description<>''):?><p><?php echo $term->description;?></p><?php endif;?>
                </article>
				<?php
						if (get_option('sf_gallery_order')=='Oldest First') : 
							$loop = new WP_Query(array('post_type' => 'gallery','posts_per_page'=>-1,  'gallery-category'=>$term->slug, 'order' => 'ASC')); 
						elseif (get_option('sf_gallery_order')=='Alphabet') :
							$loop = new WP_Query(array('post_type' => 'gallery','posts_per_page'=>-1,  'gallery-category'=>$term->slug, 'order' => 'ASC', 'orderby' => 'title')); 
						else :
							$loop = new WP_Query(array('post_type' => 'gallery', 'posts_per_page'=>-1, 'gallery-category'=>$term->slug)); 
						endif;
						if ($loop->have_posts()) :										
								?>
                <div class="gallery-group clearfix">
                    <ul class="list-gallery-category detail">
					<?php 	
			        while ( $loop->have_posts() ) : $loop->the_post();
					$custom = get_post_custom($post->ID);		
					$urlimg =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-thumb' );
					$urlimgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-thumb-retina' );
					$bigimg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
							?>
                        <li><a href="<?php echo $bigimg[0];?>" data-rel="prettyPhoto[cat-<?php echo $term->slug;?>]"><img src="<?php echo $urlimg[0];?>" data-retina="<?php echo $urlimgretina[0];?>" alt="<?php the_title();?>" /><span><?php the_title();?></span></a></li>
                       <?php endwhile;?>
                    </ul>
                </div>
				<?php endif;?>
            </div>
            <?php get_template_part('tabs-content-bottom');?>  
        </div>
    </div>
<?php get_footer();?>