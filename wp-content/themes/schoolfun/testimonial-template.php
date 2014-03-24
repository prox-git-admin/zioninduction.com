<?php get_header();
/*
Template Name: Testimonial
*/
?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignright\""; endif; ?>>
                  <?php get_template_part('breadcrumbs');?>
                <article class="static-page">
				    <?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
                    <h1 id="main-title"><?php the_title();?></h1>
                    <?php the_content();?>
					<?php endwhile;?>
					<?php endif;?>
					 <?php
						$ordertesti = get_option('sf_testimonial_order');
						if ($ordertesti == '') $ordertestiby = "DESC";
						if ($ordertesti =="Newest First") $ordertestiby = "DESC"; else $ordertestiby = "ASC";
						$loop = new WP_Query(array('post_type' => 'testimonial', 'order' => $ordertestiby)); 						
						
						 if ($loop->have_posts()):						
						?>
                    <ul class="list-testimonial">
					<?php  $i=1;
						while ( $loop->have_posts() ) : $loop->the_post();				
							$custom = get_post_custom($post->ID);
							$company_name = isset($custom["company_name"][0]) ? $custom["company_name"][0] : false;						
							$testithumb =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'testimonial-thumb' );
							$testithumbretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'testimonial-thumb-retina' );?>
                        <li class="clearfix<?php if ($i % 2 == 0) : echo ' odd'; endif;?>">
                            <?php if (has_post_thumbnail()) : ?><img src="<?php echo $testithumb[0];?>" data-retina="<?php echo $testithumbretina[0];?>" alt="<?php the_title();?>" class="img-testimonial" />
							<?php endif;?>
                            <?php the_content();?>
                            <h3 class="testimonial-title"><?php the_title();?> <?php if ($company_name <> '') : ?>- <span><?php echo $company_name;?></span><?php endif;?></h3>
                        </li>
						<?php $i++;endwhile;?>                       
                    </ul>
					<?php endif;?>
                </article>
            </div>
            <div id="sidebar" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignleft\""; endif; ?>>
                <?php get_sidebar();?>
            </div>
            <?php get_template_part('tabs-content-bottom');?> 
        </div>
    </div>
<?php get_footer();?>