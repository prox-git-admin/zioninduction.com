<?php get_header();?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignright\""; endif; ?>>
                <?php get_template_part('breadcrumbs');?>
				<?php
				if ( have_posts() ) :
				?>
				<?php while (have_posts()) : the_post();	
				$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-detail-thumb' );
				$imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-detail-thumb-retina' );                
				?>
                <article class="static-page news">
                    <header class="clearfix">
                        <?php if ( has_post_thumbnail() ) : ?>
						<figure>
                            <img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" />
                        </figure>
						<?php endif;?>
                        <aside  <?php if ( !has_post_thumbnail() ) : ?><?php echo "class='no-featured'";?><?php endif;?>>
                            <h1 id="news-title"><?php the_title();?></h1>
                            <p id="link-category"><?php the_category(', ');?></p>
                            <p id="blog-time" class="clearfix"><time datetime="<?php the_time('Y-m-d');?>"><?php the_time('F j, Y');?></time><?php comments_popup_link(_x('No Comment','schoolfun'), _x('Comment (1)','schoolfun'), _x('Comments (%)','schoolfun'), 'link-comment-header');?></p>
				 <?php if ( (get_option('sf_blog_facebook')<>'') || (get_option('sf_blog_tweet')<>'') || (get_option('sf_blog_plusone')<>'') ) : ?>
							<ul id="social-link" class="clearfix">
							 <?php if (get_option('sf_blog_facebook')<>'') :?>
				                <li><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php the_permalink() ?>" send="false" layout="button_count" width="40" show_faces="false" font=""></fb:like></li>
								<?php endif;?>
                                <?php if (get_option('sf_blog_tweet')<>''):?>
				                <li>
						              <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                                </li>
								<?php endif;?>
								<?php if (get_option('sf_blog_plusone')<>'') : ?>
				                <li class="last">
                                    <div class="g-plusone" data-size="medium"></div>
                                    <script type="text/javascript">
                                      (function() {
                                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                        po.src = 'https://apis.google.com/js/plusone.js';
                                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                      })();
                                    </script>
                                </li>
								<?php endif;?>
				            </ul>
                      <?php endif;?>
                        </aside>
                    </header>
                    <?php the_content();?>
					<?php the_tags('<p><strong>Tagged:</strong> ',', ','</p>'); ?>
					<?php wp_link_pages(); ?>
					<?php edit_post_link( __( 'Edit this post', 'schoolfun' ), '', '' ); ?>
                </article>
				<?php endwhile; endif;?>
                <?php comments_template( '', true ); ?>
            </div>
            <div id="sidebar" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignleft\""; endif; ?>>
                <?php get_sidebar();?>                               
            </div>
            <?php get_template_part('tabs-content-bottom');?> 
        </div>
    </div>
<?php get_footer();?>