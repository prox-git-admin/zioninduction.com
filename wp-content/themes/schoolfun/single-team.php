<?php get_header();?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content">
                 <?php get_template_part('breadcrumbs');?> 
				 <?php if (have_posts()) : ?>
                <article class="static-page">
				 <?php 
				while ( have_posts() ) : the_post();
				 $custom = get_post_custom($post->ID);						
				 $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'team-single' );
				 $imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'team-single-retina' );	
				 $position = isset($custom["position"][0]) ? $custom["position"][0] : false;
				 $twitter_url = isset($custom["twitter_url"][0]) ? $custom["twitter_url"][0] : false;
				 $linkedin_url = isset($custom["linkedin_url"][0]) ? $custom["linkedin_url"][0] : false;
				 $facebook_url = isset($custom["facebook_url"][0]) ? $custom["facebook_url"][0] : false;
				 $gplus_url = isset($custom["gplus_url"][0]) ? $custom["gplus_url"][0] : false;
				 $email_team = isset($custom["email_team"][0]) ? $custom["email_team"][0] : false;	?>
                    <div id="profile-team">
                          <?php if ( has_post_thumbnail() ) : ?>
						  <img src="<?php echo $img[0];?>" data-retina="images/img-42-retina.jpg" alt="" />
						  <?php endif;?>
					<?php if ( ($facebook_url <> '') || ($twitter_url <>'') || ($gplus_url <> '') || ($linkedin_url <> '') || ($email_team <> '') || ($position <> '') ) : ?>
                        <ul id="list-social-team">
                            <?php if ($facebook_url <> '') : ?><li class="facebook-team"><a href="<?php echo $facebook_url;?>"><span></span>Facebook</a></li><?php endif;?>
                            <?php if ($twitter_url <> '') : ?><li class="twitter-team"><a href="<?php echo $twitter_url;?>"><span></span>Twitter</a></li>
							<?php endif;?>
                            <?php if ($gplus_url <> '') : ?><li class="gplus-team"><a href="<?php echo $gplus_url;?>"><span></span>Google+</a></li>
							<?php endif;?>
                            <?php if ($linkedin_url <> '') : ?><li class="linkedin-team"><a href="<?php echo $linkeding_url;?>"><span></span>Linkedin</a></li>
							<?php endif;?>
							 <?php if ($position <> '') : ?><li class="position-team"><?php echo $position;?></li><?php endif;?>
                            <?php if ($email_team <> '') : ?><li class="email-team"><?php echo $email_team;?></li><?php endif;?>
                        </ul>
						<?php endif;?>
                    </div>
                    <h1 id="main-title"><?php the_title();?></h1>
                    <?php the_content();?>
               <?php endwhile;?>
                </article>
				<?php endif;?>
            </div>
            <div id="sidebar">
                <?php get_sidebar();?>
            </div>
             <?php get_template_part('tabs-content-bottom');?>            
        </div>
    </div>
<?php get_footer();?>