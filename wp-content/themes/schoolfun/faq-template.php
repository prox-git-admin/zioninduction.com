<?php get_header();
/*
Template Name: FAQ
*/
?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content">
                <?php get_template_part('breadcrumbs');?>
				
                <article class="static-page">
				   <?php
					if ( have_posts() ) :	   
					while (have_posts()) : the_post();	?>
					<h1 id="main-title"><?php the_title();?></h1>
					<?php the_content();?>
					<?php endwhile;?>
                     <?php endif;?>
					<?php
				$taxonomy     = 'faq-category';
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
				?>
					<?php foreach ($term_obj as $term) :?>
                     <h2><?php echo $term->name;?></h2>
					 <?php $loop = new WP_Query(array('post_type' => 'faq', 'taxonomy' => $taxonomy, 'term' => $term->slug)); 
						if ($loop->have_posts()):?>		
						<div class="accordion">
						<?php while ( $loop->have_posts() ) : $loop->the_post();
         				?>
                            <h3 class="title-faq"><?php the_title();?></h3>
				            <div class="content-faq">
				                <?php the_content();?>
				            </div>
							<?php endwhile;?>                            
                        </div>
						<?php endif; endforeach;?>			                
                </article>
            </div>
            <div id="sidebar">
                <?php get_sidebar();?>
            </div>
            <?php get_template_part('tabs-content-bottom');?>  
        </div>
    </div>
<?php get_footer();?>