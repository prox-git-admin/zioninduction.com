<?php get_header();
/*
Template Name: One column, no sidebar
*/
?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="full-width">
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
            <?php get_template_part('tabs-content-bottom');?> 
        </div>
    </div>
<?php get_footer();?>