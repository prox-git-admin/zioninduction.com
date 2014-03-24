<?php get_header();?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignright\""; endif; ?>>
                <?php get_template_part('breadcrumbs');?>
				<article class="static-page">
				 <h1 id="main-title">  <h1 ><?php _e("This is somewhat embarrassing, isn&rsquo;t it?","happyhealth");?></h1>
						<p><?php _e("It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.","happyhealth");?></p>	</h1>
						 <?php get_search_form(); ?>	
				   <?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>
						<div class="widget">
							<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'workchaos' ); ?></h2>
							<ul>
							<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
							</ul>
						</div>
				</article>
            </div>
            <div id="sidebar" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignleft\""; endif; ?>>
               <?php get_sidebar();?>
            </div>
            <?php get_template_part('tabs-content-bottom');?>  
        </div>
    </div>
<?php get_footer();?>