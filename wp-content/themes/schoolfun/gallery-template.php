<?php get_header();
/*
Template Name: Gallery
*/
?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="full-width">
                 <?php get_template_part('breadcrumbs');?>
				 <?php if (have_posts()):?>
                <article class="static-page">
                   <?php while (have_posts()): the_post();?>
					<h1 id="main-title"><?php the_title();?></h1>
                    <?php the_content();?>
					<?php endwhile;?>
                </article>
				<?php endif;?>
				<?php
				$taxonomy     = 'gallery-category';
				$order		  = 'ASC';
				$show_count   = 0;      // 1 for yes, 0 for no
				$pad_counts   = 0;      // 1 for yes, 0 for no
				$hierarchical = 1;      // 1 for yes, 0 for no
				$title        = '';
										
				$args = array(
						'taxonomy'     => $taxonomy,
						'order'        => $order,
						'show_count'   => $show_count,
						'pad_counts'   => $pad_counts,
						'hierarchical' => $hierarchical,
						'title_li'     => $title
				);
					$term_obj =  get_terms($taxonomy,$args);
					$x = 1;
					foreach ($term_obj as $term) :
					$ordergallery = get_option('sf_gallery_order');	
						if ($ordergallery == '') $ordergalleryby = "DESC";
						if ($ordergallery =="Newest First") $ordergalleryby = "DESC"; else $ordergalleryby = "ASC";
						$loop = new WP_Query(array('post_type' => 'gallery', 'taxonomy' => $taxonomy, 'posts_per_page'=>'10', 'term' => $term->slug, 'order' => $ordergalleryby)); 
						?>
                <div class="gallery-group clearfix">
                    <a href="<?php echo get_term_link($term, $taxonomy);?>" class="link-category-gallery">
                        <strong><?php echo $term->name;?></strong><br />
                        <span><?php echo $term->description;?></span>
                    </a>
					<?php if ($loop->have_posts()):	?>
                    <ul class="list-gallery-category">
					<?php $i=1;  while ( $loop->have_posts() ) : $loop->the_post();
						 $custom = get_post_custom($post->ID);						
						 $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-thumb' );
						 $imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-thumb-retina' );			$big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );	
						?>
                        <li><a href="<?php echo $big[0];?>" data-rel="prettyPhoto[cat-<?php echo $term->slug;?>]"><img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="Man try to hike mountain by bike" /><span><?php the_title();?></span></a></li>
                        <?php endwhile;?>
                    </ul>
					<?php endif;?>
                </div>
				<?php endforeach;?>
            </div>
             <?php get_template_part('tabs-content-bottom');?>  
        </div>
    </div>
<?php get_footer();?>