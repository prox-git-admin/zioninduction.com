<?php get_header();
/*
Template Name: Blog
*/
?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignright\""; endif; ?>>
                <?php get_template_part('breadcrumbs');?>
				 <?php if ( have_posts() ) :?>
                <?php while (have_posts()) : the_post(); ?>
				<article class="static-page">
				<h1 id="main-title"><?php the_title();?></h1>	
				<?php the_content();?>
				</article>
				<?php endwhile;?>
				<?php endif;?>
				<?php get_template_part('slide-news');?>
              <div class="news-group clearfix">
				<?php 
				global $paged;
				query_posts(array( 'post_type' => 'post', 'post__not_in' => get_option( 'sticky_posts' ),'ignore_sticky_posts' => 1, 'paged' => get_query_var('paged') ));
			 if ( have_posts() ) :
			 $x =1 ;
			
     		while (have_posts()) : the_post();
				global $more; $more=0;	
				$blogimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb' );
				$blogimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-retina' );	
				if ($x % 2 == '0') {$last=' last';} else {$last='';}
				?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('news-container static-page'.$last); ?>>
                       	<?php if ((get_post_format()<>'quote') AND (get_post_format()<>'aside')): ?>
						<?php if ( has_post_thumbnail() ) : ?>
						<figure>
                            <a href="<?php the_permalink();?>"><img src="<?php echo $blogimage[0];?>" data-retina="<?php echo $blogimageretina[0];?>" alt="<?php the_title();?>" /></a>
                        </figure>
						<?php endif;?>
						<?php endif;?>
						 <?php if (get_comments_number() > 0 ): ?><?php comments_popup_link(_x('','schoolfun'), _x('1','schoolfun'), _x(' % ','schoolfun'), 'link-comment');?>
					<?php endif;?>
                        <header>
                            <p><?php the_category(', '); ?></p>
                            <h2 class="title-news"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                            <time datetime="<?php the_time('Y-m-d');?>"><?php the_time('F d, Y');?></time>
                        </header>
                        <?php the_excerpt();?>
                    </article>					
					<?php $x++; endwhile; endif;?>     					
                   </div>                           
				<div id="pages-container" class="clearfix">
					<?php if (function_exists('wp_pagenavi')) :				
							wp_pagenavi( );					
						else :?>
							<div class="blog-pagination clearfix">
							<div class="button-next"><?php next_posts_link(__('Next Entries','schoolfun')); ?></div>
							<div class="button-prev"><?php previous_posts_link(__('Previous Entries','schoolfun')); ?></div>
						</div> 
						<?php 
						endif;
					?>
			</div>
            </div>
            <div id="sidebar" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignleft\""; endif; ?>>
               <?php get_sidebar();?>
            </div>
            <?php get_template_part('tabs-content-bottom');?>  
        </div>
    </div>
<?php get_footer();?>