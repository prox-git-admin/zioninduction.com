<?php $sticky = get_option( 'sticky_posts' );
	$args = array( 'post_type' => 'post', 'post__in'  => $sticky, 'caller_get_posts' => 1, 'ignore_sticky_posts' => 1);
				$myloop= new WP_Query( $args );
				if (count($sticky) > 0) :?>			
                <div id="slider-news" class="flexslider">
				   <?php if ($myloop->have_posts()) : ?>
                    <ul class="slides">
					<?php while ( $myloop->have_posts() ) : $myloop->the_post(); 
					global $more; $more=0;	
					$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-sticky' );
					?>
                        <li>
                            <div class="slider-news-content">
				               <?php if ( has_post_thumbnail() ) : ?><img src="<?php echo $image[0];?>" alt="<?php the_title();?>" /><?php endif;?>
                                <div class="panel-slider-news">
                                    <ul class="category-slider clearfix">
                                        <li><?php the_category('</li><li>'); ?></li>
                                    </ul>
                                    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                </div>
                            </div>
                        </li>
                  <?php endwhile;?>
					</ul>
					<?php endif;?>					
                </div>
				<?php endif;?>
				<?php wp_reset_query();?>