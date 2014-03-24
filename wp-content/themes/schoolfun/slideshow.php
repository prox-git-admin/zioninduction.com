<?php
if (get_option('sf_type_slideshow_tab1') == '') 
$sf_type_slideshow_tab1 = "Default";
else
$sf_type_slideshow_tab1 = convert_smart_quotes(get_option('sf_type_slideshow_tab1'));
$sf_tabs1_title = esc_attr(convert_smart_quotes(get_option('sf_tabs1_title')));
$sf_tabs1_subtitle = esc_attr(convert_smart_quotes(get_option('sf_tabs1_subtitle')));
$sf_slide1_title = esc_attr(convert_smart_quotes(get_option('sf_slide1_title')));
$sf_slide1_description = convert_smart_quotes(get_option('sf_slide1_description'));
$sf_slide1_url = get_option('sf_slide1_url');
$sf_slide1_texturl = esc_attr(convert_smart_quotes(get_option('sf_slide1_texturl')));
$slide1bg = get_option("sf_slide1_background");
$fileslide1bg = $slide1bg['file']; 

if (get_option('sf_type_slideshow_tab2') == '') 
$sf_type_slideshow_tab2 = "Default";
else
$sf_type_slideshow_tab2 = convert_smart_quotes(get_option('sf_type_slideshow_tab2'));
$sf_tabs2_title = esc_attr(convert_smart_quotes(get_option('sf_tabs2_title')));
$sf_tabs2_subtitle = esc_attr(convert_smart_quotes(get_option('sf_tabs2_subtitle')));
$sf_slide2_title = esc_attr(convert_smart_quotes(get_option('sf_slide2_title')));
$sf_slide2_description = convert_smart_quotes(get_option('sf_slide2_description'));
$sf_slide2_url = get_option('sf_slide2_url');
$sf_slide2_texturl = esc_attr(convert_smart_quotes(get_option('sf_slide2_texturl')));
$slide2bg = get_option("sf_slide2_background");
$fileslide2bg = $slide2bg['file']; 

if (get_option('sf_type_slideshow_tab3') == '') 
$sf_type_slideshow_tab3 = "Default";
else
$sf_type_slideshow_tab3 = convert_smart_quotes(get_option('sf_type_slideshow_tab3'));
$sf_tabs3_title = esc_attr(convert_smart_quotes(get_option('sf_tabs3_title')));
$sf_tabs3_subtitle = esc_attr(convert_smart_quotes(get_option('sf_tabs3_subtitle')));
$sf_slide3_title = esc_attr(convert_smart_quotes(get_option('sf_slide3_title')));
$sf_slide3_description = convert_smart_quotes(get_option('sf_slide3_description'));
$sf_slide3_url = get_option('sf_slide3_url');
$sf_slide3_texturl = esc_attr(convert_smart_quotes(get_option('sf_slide3_texturl')));
$slide3bg = get_option("sf_slide3_background");
$fileslide3bg = $slide3bg['file']; 

if (get_option('sf_type_slideshow_tab4') == '') 
$sf_type_slideshow_tab4 = "Default";
else
$sf_type_slideshow_tab4 = convert_smart_quotes(get_option('sf_type_slideshow_tab4'));
$sf_tabs4_title = esc_attr(convert_smart_quotes(get_option('sf_tabs4_title')));
$sf_tabs4_subtitle = esc_attr(convert_smart_quotes(get_option('sf_tabs4_subtitle')));
$sf_slide4_title = esc_attr(convert_smart_quotes(get_option('sf_slide4_title')));
$sf_slide4_description = convert_smart_quotes(get_option('sf_slide4_description'));
$sf_slide4_url = get_option('sf_slide4_url');
$sf_slide4_texturl = esc_attr(convert_smart_quotes(get_option('sf_slide4_texturl')));
$slide4bg = get_option("sf_slide4_background");
$fileslide4bg = $slide4bg['file']; 

if (get_option('sf_type_slideshow_tab5') == '') 
$sf_type_slideshow_tab5 = "Default";
else
$sf_type_slideshow_tab5 = convert_smart_quotes(get_option('sf_type_slideshow_tab5'));
$sf_tabs5_title = esc_attr(convert_smart_quotes(get_option('sf_tabs5_title')));
$sf_tabs5_subtitle = esc_attr(convert_smart_quotes(get_option('sf_tabs5_subtitle')));
$sf_slide5_title = esc_attr(convert_smart_quotes(get_option('sf_slide5_title')));
$sf_slide5_description = convert_smart_quotes(get_option('sf_slide5_description'));
$sf_slide5_url = get_option('sf_slide5_url');
$sf_slide5_texturl = esc_attr(convert_smart_quotes(get_option('sf_slide5_texturl')));
$slide5bg = get_option("sf_slide5_background");
$fileslide5bg = $slide5bg['file']; 
?>    	
     <?php if ( ($sf_tabs1_title <>'') || ($sf_tabs2_title <>'') || ($sf_tabs3_title <>'') ||($sf_tabs4_title <>'') || ($sf_tabs5_title <>'') ):?>
	 <div id="slideshow-tabs">
        <div id="panel-tabs" class="clearfix">
            <ul class="nav-tabs-slideshow">
			<?php if ($sf_tabs1_title <>''):?>
                <li><a href="#panel-1"><strong><?php echo $sf_tabs1_title;?></strong><br />
                    <?php if ($sf_tabs1_subtitle<>''):?><span><?php echo $sf_tabs1_subtitle;?></span><?php endif;?>
                    </a>
                </li>
           <?php endif;?>
            <?php if ($sf_tabs2_title <>''):?>
                <li><a href="#panel-2"><strong><?php echo $sf_tabs2_title;?></strong><br />
                    <?php if ($sf_tabs2_subtitle<>''):?><span><?php echo $sf_tabs2_subtitle;?></span><?php endif;?>
                    </a>
                </li>
           <?php endif;?>
		   <?php if ($sf_tabs3_title <>''):?>
                <li><a href="#panel-3"><strong><?php echo $sf_tabs3_title;?></strong><br />
                    <?php if ($sf_tabs3_subtitle<>''):?><span><?php echo $sf_tabs3_subtitle;?></span><?php endif;?>
                    </a>
                </li>
           <?php endif;?>
		   <?php if ($sf_tabs4_title <>''):?>
                <li><a href="#panel-4"><strong><?php echo $sf_tabs4_title;?></strong><br />
                    <?php if ($sf_tabs4_subtitle<>''):?><span><?php echo $sf_tabs4_subtitle;?></span><?php endif;?>
                    </a>
                </li>
           <?php endif;?>       
		    <?php if ($sf_tabs5_title <>''):?>
                <li><a href="#panel-5"><strong><?php echo $sf_tabs5_title;?></strong><br />
                    <?php if ($sf_tabs5_subtitle<>''):?><span><?php echo $sf_tabs5_subtitle;?></span><?php endif;?>
                    </a>
                </li>
           <?php endif;?>   
            </ul>
        </div>

		<?php if ($sf_tabs1_title <>''):?>
		<div class="ui-tabs-panel" id="panel-1" <?php if ($fileslide1bg['url']<>''):?> style="background:url(<?php echo $fileslide1bg['url'];?>) no-repeat 50% 0" <?php endif;?>>
            <div class="tabs-blur" <?php if ($fileslide1bg['url']<>''):?>style="background:url(<?php echo $fileslide1bg['url'];?>) no-repeat 50% 0"<?php endif;?>>
            </div>
			<div class="tabs-container">
			  <?php if ($sf_type_slideshow_tab1 == 'Default'):?>			    
                <article>
                    <?php if ($sf_slide1_title<>''):?><h2><?php echo $sf_slide1_title;?></h2><?php endif;?>
                    <?php if ($sf_slide1_description <> ''):?><p><?php echo $sf_slide1_description;?></p><?php endif;?>
                    <?php if ($sf_slide1_texturl<>''):?>
					<?php if ($sf_slide1_url<>''):?>
					<a href="<?php echo $sf_slide1_url;?>" class="button-more-slide"><?php echo $sf_slide1_texturl;?></a>
					<?php else:?>
					<?php echo $sf_slide1_texturl;?>
					<?php endif;?>
					<?php endif;?>
                </article>
			  <?php elseif ($sf_type_slideshow_tab1 == 'Menu Navigation'):?>
                <article>
                   <?php wp_nav_menu( array( 'theme_location' => 'left-slider-navigation','container' => '', 'items_wrap' => '<ul class="nav-slider-left">%3$s</ul>'  ) ); ?>
                   <?php wp_nav_menu( array( 'theme_location' => 'right-slider-navigation','container' => '', 'items_wrap' => '<ul class="nav-slider-right">%3$s</ul>'  ) ); ?>
                </article>                    
			   <?php elseif ($sf_type_slideshow_tab1 == 'News'):?>
			  <div class="slider-tabs flexslider">
			  <?php 							
				query_posts(array( 'post_type' => 'post', 'posts_per_page' => '5' ));     			
				?>
				<?php if ( have_posts() ) : ?>
                    <ul class="slides">
                     <?php while (have_posts()) : the_post();						
					?>
                        <li>
                            <div class="slider-tabs-content">
				                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <time datetime="<?php the_time('Y-m-d');?>"><?php the_time('F d, Y');?></time>
                                <?php the_excerpt();?>
                            </div>
                        </li>
                     <?php endwhile;?>                       
					</ul>
					<?php endif;?>
                </div>			
				<?php elseif ($sf_type_slideshow_tab1 == 'Event'):?>
			 <div class="slider-tabs event flexslider">
			 <?php 
			$loop = new WP_Query(array('post_type' => 'event',  'posts_per_page' => '5' )); 						
			if ($loop->have_posts()):
			?>					
                    <ul class="slides">
					<?php $i=1;
			      while ( $loop->have_posts() ) : $loop->the_post();				
						$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-on-toptab' );
						$imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-on-toptab-retina' );
						 $custom = get_post_custom($post->ID);
						 $startdate = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false;	
						$enddate = isset($custom["enddate"][0]) ? $custom["enddate"][0] : false;
						$starttime = isset($custom["starttime"][0]) ? $custom["starttime"][0] : false;
						$endtime = isset($custom["endtime"][0]) ? $custom["endtime"][0] : false;		
						$location = isset($custom["location"][0]) ? $custom["location"][0] : false;
					?>
                        <li>
                            <div class="slider-tabs-content">
				                 <?php if ( has_post_thumbnail()) :?>
								 <img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" /><?php endif;?>
                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <ul class="list-event-slider">
                                    <li class="time-slider"><?php echo date("F d, Y",strtotime($startdate));?> <?php if ($enddate <>'') :?>- <?php echo date("F d, Y",strtotime($enddate));?><?php endif;?></li>
                                    <li class="hour-slider"><?php echo $starttime;?> <?php if ($endtime <>'') :?>- <?php echo $endtime;?><?php endif;?></li>
                                    <?php if ($location <> '') : ?><li class="location-slider"><em><?php echo $location;?></em></li><?php endif;?>
                                </ul>
                            </div>
                        </li>
						<?php endwhile;?>                        
					</ul>
					<?php endif;?>
                </div>
				<?php endif;?>
            </div>
        </div>
	 <?php endif;?>
		<?php if ($sf_tabs2_title <>''):?>
		<div class="ui-tabs-panel" id="panel-2" <?php if ($fileslide2bg['url']<>''):?> style="background:url(<?php echo $fileslide2bg['url'];?>) no-repeat 50% 0" <?php endif;?>>
            <div class="tabs-blur" <?php if ($fileslide2bg['url']<>''):?>style="background:url(<?php echo $fileslide2bg['url'];?>) no-repeat 50% 0"<?php endif;?>>
            </div>			
            <div class="tabs-container">
			  <?php if ($sf_type_slideshow_tab2 == 'Default'):?>			    
                <article>
                    <?php if ($sf_slide2_title<>''):?><h2><?php echo $sf_slide2_title;?></h2><?php endif;?>
                    <?php if ($sf_slide2_description <> ''):?><p><?php echo $sf_slide2_description;?></p><?php endif;?>
                    <?php if ($sf_slide2_texturl<>''):?>
					<?php if ($sf_slide2_url<>''):?>
					<a href="<?php echo $sf_slide2_url;?>" class="button-more-slide"><?php echo $sf_slide2_texturl;?></a>
					<?php else:?>
					<?php echo $sf_slide2_texturl;?>
					<?php endif;?>
					<?php endif;?>
                </article>
			  <?php elseif ($sf_type_slideshow_tab2 == 'Menu Navigation'):?>
                <article>
                   <?php wp_nav_menu( array( 'theme_location' => 'left-slider-navigation','container' => '', 'items_wrap' => '<ul class="nav-slider-left">%3$s</ul>'  ) ); ?>
                   <?php wp_nav_menu( array( 'theme_location' => 'right-slider-navigation','container' => '', 'items_wrap' => '<ul class="nav-slider-right">%3$s</ul>'  ) ); ?>
                </article>              
			   <?php elseif ($sf_type_slideshow_tab2 == 'News'):?>
			  <div class="slider-tabs flexslider">
                     <?php 							
				query_posts(array( 'post_type' => 'post', 'posts_per_page' => '5' ));     			
				?>
				<?php if ( have_posts() ) : ?>
                    <ul class="slides">
                     <?php while (have_posts()) : the_post();						
					?>
                        <li>
                            <div class="slider-tabs-content">
				                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <time datetime="<?php the_time('Y-m-d');?>"><?php the_time('F d, Y');?></time>
                                <?php the_excerpt();?>
                            </div>
                        </li>
                     <?php endwhile;?>                       
					</ul>
					<?php endif;?>
                </div>			
				<?php elseif ($sf_type_slideshow_tab2 == 'Event'):?>
			 <div class="slider-tabs event flexslider">
			 <?php 
			$loop = new WP_Query(array('post_type' => 'event', 'posts_per_page' => '5' )); 						
			if ($loop->have_posts()):
			?>					
                    <ul class="slides">
					<?php $i=1;
			      while ( $loop->have_posts() ) : $loop->the_post();				
						$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-on-toptab' );
						$imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-on-toptab-retina' );
						 $custom = get_post_custom($post->ID);
						 $startdate = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false;	
						$enddate = isset($custom["enddate"][0]) ? $custom["enddate"][0] : false;
						$starttime = isset($custom["starttime"][0]) ? $custom["starttime"][0] : false;
						$endtime = isset($custom["endtime"][0]) ? $custom["endtime"][0] : false;		
						$location = isset($custom["location"][0]) ? $custom["location"][0] : false;
					?>
                        <li>
                            <div class="slider-tabs-content">
				                 <?php if ( has_post_thumbnail()) :?>
								 <img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" /><?php endif;?>
                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <ul class="list-event-slider">
                                    <li class="time-slider"><?php echo date("F d, Y",strtotime($startdate));?> <?php if ($enddate <>'') :?>- <?php echo date("F d, Y",strtotime($enddate));?><?php endif;?></li>
                                    <li class="hour-slider"><?php echo $starttime;?> <?php if ($endtime <>'') :?>- <?php echo $endtime;?><?php endif;?></li>
                                    <?php if ($location <> '') : ?><li class="location-slider"><em><?php echo $location;?></em></li><?php endif;?>
                                </ul>
                            </div>
                        </li>
						<?php endwhile;?>                        
					</ul>
					<?php endif;?>
                </div>
				<?php endif;?>
            </div>
        </div>
		<?php endif;?>
       <?php if ($sf_tabs3_title <>''):?>
		<div class="ui-tabs-panel" id="panel-3" <?php if ($fileslide3bg['url']<>''):?> style="background:url(<?php echo $fileslide3bg['url'];?>) no-repeat 50% 0" <?php endif;?>>
            <div class="tabs-blur" <?php if ($fileslide3bg['url']<>''):?>style="background:url(<?php echo $fileslide3bg['url'];?>) no-repeat 50% 0"<?php endif;?>>
            </div>			
            <div class="tabs-container">
			  <?php if ($sf_type_slideshow_tab3 == 'Default'):?>			    
                <article>
                    <?php if ($sf_slide3_title<>''):?><h2><?php echo $sf_slide3_title;?></h2><?php endif;?>
                    <?php if ($sf_slide3_description <> ''):?><p><?php echo $sf_slide3_description;?></p><?php endif;?>
                    <?php if ($sf_slide3_texturl<>''):?>
					<?php if ($sf_slide3_url<>''):?>
					<a href="<?php echo $sf_slide3_url;?>" class="button-more-slide"><?php echo $sf_slide3_texturl;?></a>
					<?php else:?>
					<?php echo $sf_slide3_texturl;?>
					<?php endif;?>
					<?php endif;?>
                </article>
			  <?php elseif ($sf_type_slideshow_tab3 == 'Menu Navigation'):?>
                <article>
                   <?php wp_nav_menu( array( 'theme_location' => 'left-slider-navigation','container' => '', 'items_wrap' => '<ul class="nav-slider-left">%3$s</ul>'  ) ); ?>
                   <?php wp_nav_menu( array( 'theme_location' => 'right-slider-navigation','container' => '', 'items_wrap' => '<ul class="nav-slider-right">%3$s</ul>'  ) ); ?>
                </article>
			   <?php elseif ($sf_type_slideshow_tab3 == 'News'):?>
			  <div class="slider-tabs flexslider">
                     <?php 							
				query_posts(array( 'post_type' => 'post', 'posts_per_page' => '5' ));     			
				?>
				<?php if ( have_posts() ) : ?>
                    <ul class="slides">
                     <?php while (have_posts()) : the_post();						
					?>
                        <li>
                            <div class="slider-tabs-content">
				                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <time datetime="<?php the_time('Y-m-d');?>"><?php the_time('F d, Y');?></time>
                                <?php the_excerpt();?>
                            </div>
                        </li>
                     <?php endwhile;?>                       
					</ul>
					<?php endif;?>
                </div>			
				<?php elseif ($sf_type_slideshow_tab3 == 'Event'):?>
			 <div class="slider-tabs event flexslider">
			 <?php 
			$loop = new WP_Query(array('post_type' => 'event', 'posts_per_page' => '5' )); 						
			if ($loop->have_posts()):
			?>					
                    <ul class="slides">
					<?php $i=1;
			      while ( $loop->have_posts() ) : $loop->the_post();				
						$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-on-toptab' );
						$imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-on-toptab-retina' );
						 $custom = get_post_custom($post->ID);
						 $startdate = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false;	
						$enddate = isset($custom["enddate"][0]) ? $custom["enddate"][0] : false;
						$starttime = isset($custom["starttime"][0]) ? $custom["starttime"][0] : false;
						$endtime = isset($custom["endtime"][0]) ? $custom["endtime"][0] : false;		
						$location = isset($custom["location"][0]) ? $custom["location"][0] : false;
					?>
                        <li>
                            <div class="slider-tabs-content">
				                 <?php if ( has_post_thumbnail()) :?>
								 <img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" /><?php endif;?>
                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <ul class="list-event-slider">
                                    <li class="time-slider"><?php echo date("F d, Y",strtotime($startdate));?> <?php if ($enddate <>'') :?>- <?php echo date("F d, Y",strtotime($enddate));?><?php endif;?></li>
                                    <li class="hour-slider"><?php echo $starttime;?> <?php if ($endtime <>'') :?>- <?php echo $endtime;?><?php endif;?></li>
                                    <?php if ($location <> '') : ?><li class="location-slider"><em><?php echo $location;?></em></li><?php endif;?>
                                </ul>
                            </div>
                        </li>
						<?php endwhile;?>                        
					</ul>
					<?php endif;?>
                </div>
				<?php endif;?>
            </div>		
        </div>
		<?php endif;?>

		<?php if ($sf_tabs4_title <>''):?>
		<div class="ui-tabs-panel" id="panel-4" <?php if ($fileslide4bg['url']<>''):?> style="background:url(<?php echo $fileslide4bg['url'];?>) no-repeat 50% 0" <?php endif;?>>
            <div class="tabs-blur" <?php if ($fileslide4bg['url']<>''):?>style="background:url(<?php echo $fileslide4bg['url'];?>) no-repeat 50% 0"<?php endif;?>>
            </div>			
            <div class="tabs-container">
			  <?php if ($sf_type_slideshow_tab4 == 'Default'):?>			    
                <article>
                    <?php if ($sf_slide4_title<>''):?><h2><?php echo $sf_slide4_title;?></h2><?php endif;?>
                    <?php if ($sf_slide4_description <> ''):?><p><?php echo $sf_slide4_description;?></p><?php endif;?>
                    <?php if ($sf_slide4_texturl<>''):?>
					<?php if ($sf_slide4_url<>''):?>
					<a href="<?php echo $sf_slide4_url;?>" class="button-more-slide"><?php echo $sf_slide4_texturl;?></a>
					<?php else:?>
					<?php echo $sf_slide4_texturl;?>
					<?php endif;?>
					<?php endif;?>
                </article>
			  <?php elseif ($sf_type_slideshow_tab4 == 'Menu Navigation'):?>
                <article>
                   <?php wp_nav_menu( array( 'theme_location' => 'left-slider-navigation','container' => '', 'items_wrap' => '<ul class="nav-slider-left">%3$s</ul>'  ) ); ?>
                   <?php wp_nav_menu( array( 'theme_location' => 'right-slider-navigation','container' => '', 'items_wrap' => '<ul class="nav-slider-right">%3$s</ul>'  ) ); ?>
                </article>                     
			   <?php elseif ($sf_type_slideshow_tab4 == 'News'):?>
			  <div class="slider-tabs flexslider">
                     <?php 							
				query_posts(array( 'post_type' => 'post', 'posts_per_page' => '5' ));     			
				?>
				<?php if ( have_posts() ) : ?>
                    <ul class="slides">
                     <?php while (have_posts()) : the_post();						
					?>
                        <li>
                            <div class="slider-tabs-content">
				                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <time datetime="<?php the_time('Y-m-d');?>"><?php the_time('F d, Y');?></time>
                                <?php the_excerpt();?>
                            </div>
                        </li>
                     <?php endwhile;?>                       
					</ul>
					<?php endif;?>
                </div>			
				<?php elseif ($sf_type_slideshow_tab4 == 'Event'):?>
			 <div class="slider-tabs event flexslider">
			 <?php 
			$loop = new WP_Query(array('post_type' => 'event', 'posts_per_page' => '5' )); 						
			if ($loop->have_posts()):
			?>					
                    <ul class="slides">
					<?php $i=1;
			      while ( $loop->have_posts() ) : $loop->the_post();				
						$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-on-toptab' );
						$imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-on-toptab-retina' );
						 $custom = get_post_custom($post->ID);
						 $startdate = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false;	
						$enddate = isset($custom["enddate"][0]) ? $custom["enddate"][0] : false;
						$starttime = isset($custom["starttime"][0]) ? $custom["starttime"][0] : false;
						$endtime = isset($custom["endtime"][0]) ? $custom["endtime"][0] : false;		
						$location = isset($custom["location"][0]) ? $custom["location"][0] : false;
					?>
                        <li>
                            <div class="slider-tabs-content">
				                 <?php if ( has_post_thumbnail()) :?>
								 <img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" /><?php endif;?>
                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <ul class="list-event-slider">
                                    <li class="time-slider"><?php echo date("F d, Y",strtotime($startdate));?> <?php if ($enddate <>'') :?>- <?php echo date("F d, Y",strtotime($enddate));?><?php endif;?></li>
                                    <li class="hour-slider"><?php echo $starttime;?> <?php if ($endtime <>'') :?>- <?php echo $endtime;?><?php endif;?></li>
                                    <?php if ($location <> '') : ?><li class="location-slider"><em><?php echo $location;?></em></li><?php endif;?>
                                </ul>
                            </div>
                        </li>
						<?php endwhile;?>                        
					</ul>
					<?php endif;?>
                </div>
				<?php endif;?>
            </div>
        </div>
       <?php endif;?>
       <?php if ($sf_tabs5_title <>''):?>
		<div class="ui-tabs-panel" id="panel-5" <?php if ($fileslide5bg['url']<>''):?> style="background:url(<?php echo $fileslide5bg['url'];?>) no-repeat 50% 0" <?php endif;?>>
            <div class="tabs-blur" <?php if ($fileslide5bg['url']<>''):?>style="background:url(<?php echo $fileslide5bg['url'];?>) no-repeat 50% 0"<?php endif;?>>
            </div>
			<div class="tabs-container">
			  <?php if ($sf_type_slideshow_tab5 == 'Default'):?>			    
                <article>
                    <?php if ($sf_slide5_title<>''):?><h2><?php echo $sf_slide5_title;?></h2><?php endif;?>
                    <?php if ($sf_slide5_description <> ''):?><p><?php echo $sf_slide5_description;?></p><?php endif;?>
                    <?php if ($sf_slide5_texturl<>''):?>
					<?php if ($sf_slide5_url<>''):?>
					<a href="<?php echo $sf_slide5_url;?>" class="button-more-slide"><?php echo $sf_slide5_texturl;?></a>
					<?php else:?>
					<?php echo $sf_slide5_texturl;?>
					<?php endif;?>
					<?php endif;?>
                </article>
			  <?php elseif ($sf_type_slideshow_tab5 == 'Menu Navigation'):?>
                <article>
                   <?php wp_nav_menu( array( 'theme_location' => 'left-slider-navigation','container' => '', 'items_wrap' => '<ul id="nav-footer">%3$s</ul>'  ) ); ?>
                   <?php wp_nav_menu( array( 'theme_location' => 'right-slider-navigation','container' => '', 'items_wrap' => '<ul id="nav-footer">%3$s</ul>'  ) ); ?>
                </article>               
			   <?php elseif ($sf_type_slideshow_tab5 == 'News'):?>
			  <div class="slider-tabs flexslider">
                    <?php 							
				query_posts(array( 'post_type' => 'post', 'posts_per_page' => '5' ));     			
				?>
				<?php if ( have_posts() ) : ?>
                    <ul class="slides">
                     <?php while (have_posts()) : the_post();						
					?>
                        <li>
                            <div class="slider-tabs-content">
				                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <time datetime="<?php the_time('Y-m-d');?>"><?php the_time('F d, Y');?></time>
                                <?php the_excerpt();?>
                            </div>
                        </li>
                     <?php endwhile;?>                       
					</ul>
					<?php endif;?>
                </div>			
				<?php elseif ($sf_type_slideshow_tab5 == 'Event'):?>
			 <div class="slider-tabs event flexslider">
			 <?php 
			$loop = new WP_Query(array('post_type' => 'event', 'posts_per_page' => '5' )); 						
			if ($loop->have_posts()):
			?>					
                    <ul class="slides">
					<?php $i=1;
			      while ( $loop->have_posts() ) : $loop->the_post();				
						$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-on-toptab' );
						$imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-on-toptab-retina' );
						 $custom = get_post_custom($post->ID);
						 $startdate = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false;	
						$enddate = isset($custom["enddate"][0]) ? $custom["enddate"][0] : false;
						$starttime = isset($custom["starttime"][0]) ? $custom["starttime"][0] : false;
						$endtime = isset($custom["endtime"][0]) ? $custom["endtime"][0] : false;		
						$location = isset($custom["location"][0]) ? $custom["location"][0] : false;
					?>
                        <li>
                            <div class="slider-tabs-content">
				                 <?php if ( has_post_thumbnail()) :?>
								 <img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" /><?php endif;?>
                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <ul class="list-event-slider">
                                    <li class="time-slider"><?php echo date("F d, Y",strtotime($startdate));?> <?php if ($enddate <>'') :?>- <?php echo date("F d, Y",strtotime($enddate));?><?php endif;?></li>
                                    <li class="hour-slider"><?php echo $starttime;?> <?php if ($endtime <>'') :?>- <?php echo $endtime;?><?php endif;?></li>
                                    <?php if ($location <> '') : ?><li class="location-slider"><em><?php echo $location;?></em></li><?php endif;?>
                                </ul>
                            </div>
                        </li>
						<?php endwhile;?>                        
					</ul>
					<?php endif;?>
                </div>
				<?php endif;?>
            </div>
        </div>
		<?php endif;?>
    </div>
	<?php endif;?>