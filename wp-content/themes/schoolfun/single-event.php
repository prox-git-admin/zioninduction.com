<?php get_header();?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content">
                 <?php get_template_part('breadcrumbs');?> 
				<?php
				if ( have_posts() ) :
				while (have_posts()) : the_post();					   
				   $custom = get_post_custom($post->ID);
				   $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-event' );
				   $imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-event-retina' );
   				   $imgbig = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
				   $startdate = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false;	
				   $enddate = isset($custom["enddate"][0]) ? $custom["enddate"][0] : false;
				   $starttime = isset($custom["starttime"][0]) ? $custom["starttime"][0] : false;
				   $endtime = isset($custom["endtime"][0]) ? $custom["endtime"][0] : false;		
				   $location = isset($custom["location"][0]) ? $custom["location"][0] : false;
				?>
                <article class="static-page" itemscope itemtype="http://data-vocabulary.org/Event">
                    <h1 id="main-title" itemprop="summary"><?php the_title();?></h1>
                    <div id="event-info">
                        <ul class="list-event-slider">
                            <?php if (($startdate <> '') || ($enddate <> '')) : ?>
                                <li class="time-slider"><time itemprop="startDate" datetime="<?php echo date("F-m-d",strtotime($startdate));?>"><?php echo date("F d, Y",strtotime($startdate));?></time> <?php if ($enddate <> '') :?>- <time itemprop="endDate" datetime="<?php echo date("F-m-d",strtotime($enddate));?>"><?php echo date("F d, Y",strtotime($enddate));?></time><?php endif;?></li>
								<?php endif;?>
                             <?php if (($starttime <> '') || ($endtime <> '')) : ?>
								<li class="hour-slider"><?php echo $starttime;?> <?php if ($endtime <> '') :?>- <?php echo $endtime;?><?php endif;?></li>
							 <?php endif;?>
                            <?php if ($location <> '') : ?><li class="location-slider"><em itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address"><?php echo $location;?></em></li>
							<?php endif;?>
                        </ul>
                        <?php if ( has_post_thumbnail() ) : ?><a href="<?php echo $imgbig[0];?>" data-rel="prettyPhoto"><img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" /></a>
						<?php endif;?>
                    </div>
                    <?php the_content();?>
                </article>
				<?php endwhile;
				endif;?>
            </div>
            <div id="sidebar">
                <?php get_sidebar();?>
            </div>           
            <?php get_template_part('tabs-content-bottom');?>
        </div>
    </div>
<?php get_footer();?>