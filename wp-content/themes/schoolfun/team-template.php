<?php get_header();
/*
Template Name: Team Template
*/
$taxonomy     = 'team-category';
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
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content" <?php if (get_option('sf_sidebar') =='Left'): echo "class=\"alignright\""; endif; ?>>
                <?php get_template_part('breadcrumbs');?> 
                <article class="static-page">                    
				<?php get_template_part('menu-team-category');?> 
                    <div id="team-container">	
					   <?php if (have_posts()):?>
					   <?php while ( have_posts() ) : the_post();?>
                        <h1 id="main-title"><?php the_title();?></h1>
                        <?php the_content();?>
						<?php endwhile;?>
						<?php endif;?>
							<?php 
				$orderteam = get_option('sf_team_order');	
				if ($orderteam == '') $orderteamby = "DESC";
				if ($orderteam =="Newest First") $orderteamby = "DESC"; else $orderteamby = "ASC";
				$loop = new WP_Query(array('post_type' => 'team', 'order' => $orderteamby)); 

				if ($loop->have_posts()):?>
                        <ul id="list-team">
						<?php					
			    $i=1; 
				 while ( $loop->have_posts() ) : $loop->the_post();
				 $custom = get_post_custom($post->ID);						
				 $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'team-thumb' );
				 $imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'team-thumb-retina' );	
				 $position = isset($custom["position"][0]) ? $custom["position"][0] : false;
				 $twitter_url = isset($custom["twitter_url"][0]) ? $custom["twitter_url"][0] : false;
				 $linkedin_url = isset($custom["linkedin_url"][0]) ? $custom["linkedin_url"][0] : false;
				 $facebook_url = isset($custom["facebook_url"][0]) ? $custom["facebook_url"][0] : false;
				 $gplus_url = isset($custom["gplus_url"][0]) ? $custom["gplus_url"][0] : false;
				 $email_team = isset($custom["email_team"][0]) ? $custom["email_team"][0] : false;
							?>
                            <li <?php if ($i % 3 == 0) : echo 'class="last"'; endif;?>>
                                <a href="<?php the_permalink();?>">
                                    <img src="<?php echo $img['0'];?>" data-retina="<?php echo $imgretina['0'];?>" alt="<?php the_title();?>" />
                                    <strong><?php the_title();?></strong>
                                </a>
                            </li>
				<?php $i++;endwhile;?>                         
                        </ul>
                 <?php endif;?>
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