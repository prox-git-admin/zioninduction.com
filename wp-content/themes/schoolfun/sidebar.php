<?php
	wp_reset_query();?>	
	<?php if ((get_query_var( 'taxonomy' ) == "faq-category") || (is_singular("team")) || (is_singular("event")) ): ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-pages' ) ) : ?>					
				<aside class="widget-container">
					<div class="widget-wrapper clearfix">
						<h3 class="widget-title">Search</h3>
						<?php get_search_form(); ?>
					</div>
				</aside>
				<?php endif;?>
	    <?php elseif ( is_page_template('blog-template.php') || is_single() || is_category() || is_archive() || is_search()  ) :
			if ( ! dynamic_sidebar( 'sidebar-blog-posts' ) ) : ?>					
				<aside class="widget-container">
					<div class="widget-wrapper clearfix">
						<h3 class="widget-title">Search</h3>
						<?php get_search_form(); ?>
					</div>
				</aside>
			<?php endif;?>		 
		<?php else:
			if ( ! dynamic_sidebar( 'sidebar-pages' ) ) : ?>					
				<aside class="widget-container">
					<div class="widget-wrapper clearfix">
						<h3 class="widget-title">Search</h3>
						<?php get_search_form(); ?>
					</div>
				</aside>
			<?php endif;?>
		<?php endif; ?>

		