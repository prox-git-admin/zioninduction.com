<?php get_header();
/*
Template Name: History
*/
?>

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
            <div id="main-content">
                <?php get_template_part('breadcrumbs');?> 
                <article class="static-page">
				 <?php 
				 global $wpdb;
				$querystr = "
				SELECT $wpdb->posts.* ,$wpdb->postmeta.meta_value as startdate
				FROM $wpdb->posts, $wpdb->postmeta
				WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
				AND $wpdb->postmeta.meta_key = 'startdate'  
				AND $wpdb->posts.post_status = 'publish' 
				AND $wpdb->posts.post_type = 'history'
				GROUP BY YEAR($wpdb->postmeta.meta_value)
				ORDER BY startdate DESC
					 ";
				 $eventstartdate = $wpdb->get_results($querystr, OBJECT);
					?>
					<?php if (have_posts()): ?>
					<?php while (have_posts()) : the_post();?>
                    <h1 id="main-title"><?php the_title();?></h1>
                    <?php the_content();?>
					<?php endwhile;?>
					<?php endif;?>
                    <div id="history-container">
					 <?php foreach($eventstartdate as $events) : 					
					 $year = date("Y",strtotime($events->startdate));
					 $args = array(
						'post_type' => 'history',
						'post_status'=>'publish',
						'meta_key' => 'startdate',
						'orderby'=> 'startdate',
						'order'=> 'ASC',
						'meta_query' => array(
							array(
								'key' => 'startdate',
								'value' => $year,
								'compare' => 'LIKE'
							)
						)
					);
					 $loop = new WP_Query( $args );
					
					 ?>
                        <h3 class="history-year"><?php echo $year;?></h3>
						<?php if ($loop->have_posts()): 
						while ($loop->have_posts()) : $loop->the_post();
						?>
                        <div class="history-moment clearfix">
						<?php 						
						$custom = get_post_custom($post->ID);																
						$date = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false;
						$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'history-thumb' );
						$imageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'history-thumb-retina' );
						?>
                            <header>
                               <?php echo date("F d, Y",strtotime($date));?>
                            </header>
                            <aside>
                                <h2 class="history-title"><?php the_title();?></h2>
								 <?php if (has_post_thumbnail()):?><img src="<?php echo $image[0];?>" data-retina="<?php echo $imageretina[0];?>" alt="<?php the_title();?>" class="alignleft img-history" />
								 <?php endif;?>
                                <?php the_content();?>
                            </aside>
                        </div>
						<?php endwhile;?>
						<?php endif;?>
                        
						<?php endforeach;?>                        
                    </div>
                </article>
            </div>
            <div id="sidebar">
               <?php get_sidebar();?>
            </div>
          <?php get_template_part('tabs-content-bottom');?>
        </div>
    </div>
<?php get_footer();?>