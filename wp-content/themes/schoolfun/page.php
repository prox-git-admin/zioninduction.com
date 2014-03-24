<?php get_header();?>
    <div id="content-container">
        <div id="content" class="clearfix">
		<?php  if (have_posts()):
			$args = array(
				'sort_order' => 'DESC',
				'child_of' => $post->ID,
				'post_type' => 'page',
				'post_status' => 'publish'
				); 
				$children = get_pages($args); ?>
            <?php if ($children) :?>
			<nav id="nav-sub-container" class="clearfix">
                <ul id="nav-sub">
				<?php foreach($children as $child):?>
                    <li><a href="<?php echo get_page_link( $child->ID );?>"><?php echo $child->post_title;?></a></li>
                 <?php endforeach;?> 
                </ul>
            </nav>
			<?php endif;?>
			<?php endif;?>
            <div id="main-content" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignright\""; endif; ?>>
				<?php get_template_part('breadcrumbs');?>                
				<?php if ( have_posts() ) :?>
				<?php while (have_posts()) : the_post();?>
                <article class="static-page">
                    <h1 id="main-title"><?php the_title();?></h1>
                    <?php the_content();?>
                </article>
				<?php endwhile;?>
				<?php wp_link_pages('pagelink= %'); ?>
				<?php endif;?>
            </div>
            <div id="sidebar" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignleft\""; endif; ?>>
                <?php get_sidebar();?>               
            </div>
			 <?php get_template_part('tabs-content-bottom');?>              
        </div>
    </div>
<?php get_footer();?>