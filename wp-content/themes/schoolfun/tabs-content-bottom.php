<?php
if (get_option('sf_type_tab_bottom1') == '') :
$sf_type_tab_bottom1 = "Text";
else:
$sf_type_tab_bottom1 = convert_smart_quotes(get_option('sf_type_tab_bottom1'));
endif;
$sf_tab_bottom1_title = convert_smart_quotes(get_option('sf_tab_bottom1_title'));
$sf_tab_bottom1_description = esc_attr(convert_smart_quotes(get_option('sf_tab_bottom1_description')));

if (get_option('sf_type_tab_bottom2') == '') :
$sf_type_tab_bottom2 = "Text";
else:
$sf_type_tab_bottom2 = convert_smart_quotes(get_option('sf_type_tab_bottom2'));
endif;
$sf_tab_bottom2_title = convert_smart_quotes(get_option('sf_tab_bottom2_title'));
$sf_tab_bottom2_description = esc_attr(convert_smart_quotes(get_option('sf_tab_bottom2_description')));

if (get_option('sf_type_tab_bottom3') == '') :
$sf_type_tab_bottom3 = "Text";
else:
$sf_type_tab_bottom3 = convert_smart_quotes(get_option('sf_type_tab_bottom3'));
endif;
$sf_tab_bottom3_title = convert_smart_quotes(get_option('sf_tab_bottom3_title'));
$sf_tab_bottom3_description = esc_attr(convert_smart_quotes(get_option('sf_tab_bottom3_description')));

if (get_option('sf_type_tab_bottom4') == '') :
$sf_type_tab_bottom4 = "Text";
else:
$sf_type_tab_bottom4 = convert_smart_quotes(get_option('sf_type_tab_bottom4'));
endif;
$sf_tab_bottom4_title = convert_smart_quotes(get_option('sf_tab_bottom4_title'));
$sf_tab_bottom4_description = esc_attr(convert_smart_quotes(get_option('sf_tab_bottom4_description')));

$sf_icon1 = get_option('sf_icon1');
$fileicon1 = $sf_icon1['file'];
$sf_sidebar_title1 = esc_attr(convert_smart_quotes(get_option('sf_sidebar_title1')));
$sf_sidebar_text1 = convert_smart_quotes(get_option('sf_sidebar_text1'));
$sf_sidebar_url1 = esc_attr(convert_smart_quotes(get_option('sf_sidebar_url1')));

$sf_icon2 = get_option('sf_icon2');
$fileicon2 = $sf_icon2['file'];
$sf_sidebar_title2 = esc_attr(convert_smart_quotes(get_option('sf_sidebar_title2')));
$sf_sidebar_text2 = convert_smart_quotes(get_option('sf_sidebar_text2'));
$sf_sidebar_url2 = esc_attr(convert_smart_quotes(get_option('sf_sidebar_url2')));

$sf_icon3 = get_option('sf_icon3');
$fileicon3 = $sf_icon3['file'];
$sf_sidebar_title3 = esc_attr(convert_smart_quotes(get_option('sf_sidebar_title3')));
$sf_sidebar_text3 = convert_smart_quotes(get_option('sf_sidebar_text3'));
$sf_sidebar_url3 = esc_attr(convert_smart_quotes(get_option('sf_sidebar_url3')));

$sf_icon4 = get_option('sf_icon4');
$fileicon4 = $sf_icon4['file'];
$sf_sidebar_title4 = esc_attr(convert_smart_quotes(get_option('sf_sidebar_title4')));
$sf_sidebar_text4 = convert_smart_quotes(get_option('sf_sidebar_text4'));
$sf_sidebar_url4 = esc_attr(convert_smart_quotes(get_option('sf_sidebar_url4')));

$sf_icon5 = get_option('sf_icon5');
$fileicon5 = $sf_icon5['file'];
$sf_sidebar_title5 = esc_attr(convert_smart_quotes(get_option('sf_sidebar_title5')));
$sf_sidebar_text5 = convert_smart_quotes(get_option('sf_sidebar_text5'));
$sf_sidebar_url5 = esc_attr(convert_smart_quotes(get_option('sf_sidebar_url5')));

$sf_welcome_intro_text = convert_smart_quotes(get_option('sf_welcome_intro_text'));
$sf_welcome_intro_name = esc_attr(convert_smart_quotes(get_option('sf_welcome_intro_name')));
$sf_welcome_intro_position = esc_attr(convert_smart_quotes(get_option('sf_welcome_intro_position')));
$sf_welcome_intro_url = esc_attr(convert_smart_quotes(get_option('sf_welcome_intro_url')));
$sf_welcome_intro_text_url = esc_attr(convert_smart_quotes(get_option('sf_welcome_intro_text_url')));
$sf_welcome_intro_image = get_option('sf_welcome_intro_image');
$filewelcome = $sf_welcome_intro_image['file'];
$sf_welcome_intro_image_retina = get_option('sf_welcome_intro_image_retina');
$filewelcomeretina = $sf_welcome_intro_image_retina['file'];
?>
<?php if (($sf_tab_bottom1_title <> '') || ($sf_tab_bottom2_title <> '') || ($sf_tab_bottom3_title <> '') ) : ?>
<div id="tabs-content-bottom">
                <ul id="nav-content-bottom" class="clearfix">
                    <?php if ($sf_tab_bottom1_title<>''):?><li><a href="#panel-1"><?php echo $sf_tab_bottom1_title;?></a></li><?php endif;?>
                    <?php if ($sf_tab_bottom2_title<>''):?><li><a href="#panel-2"><?php echo $sf_tab_bottom2_title;?></a></li><?php endif;?>
                    <?php if ($sf_tab_bottom3_title<>''):?><li><a href="#panel-3"><?php echo $sf_tab_bottom3_title;?></a></li><?php endif;?>
                    <?php if ($sf_tab_bottom4_title<>''):?><li><a href="#panel-4"><?php echo $sf_tab_bottom4_title;?></a></li><?php endif;?>
                </ul>
				<?php if (($sf_tab_bottom1_title <> '') ) : ?>
                <div class="ui-tabs-panel clearfix" id="panel-1">
			    <?php  // Quick Navigation
				 if ($sf_type_tab_bottom1 == "Quick Navigation") :?>
				<?php if ( ($sf_sidebar_title1 <> '' ) || ($sf_sidebar_title2 <> '' ) || ($sf_sidebar_title3 <> '' ) ) :?>
                    <ul id="nav-sidebar-bottom" class="clearfix">
                        <?php if (($sf_sidebar_title1<>'') || ($fileicon1['url'] <> '') || ($sf_sidebar_text1<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url1 <> ''):?><a href="<?php echo $sf_sidebar_url1;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon1['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon1['url'];?>" alt="<?php echo $sf_sidebar_title1;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title1<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title1;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text1<>'') :?><?php echo $sf_sidebar_text1;?><?php endif;?>
                        <?php if ($sf_sidebar_url1 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
                     <?php if (($sf_sidebar_title2<>'') || ($fileicon2['url'] <> '') || ($sf_sidebar_text2<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url2 <> ''):?><a href="<?php echo $sf_sidebar_url2;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon2['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon2['url'];?>" alt="<?php echo $sf_sidebar_title2;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title2<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title2;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text2<>'') :?><?php echo $sf_sidebar_text2;?><?php endif;?>
                        <?php if ($sf_sidebar_url2 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title3<>'') || ($fileicon3['url'] <> '') || ($sf_sidebar_text3<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url3 <> ''):?><a href="<?php echo $sf_sidebar_url3;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon3['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon3['url'];?>" alt="<?php echo $sf_sidebar_title3;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title3<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title3;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text3<>'') :?><?php echo $sf_sidebar_text3;?><?php endif;?>
                        <?php if ($sf_sidebar_url3 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title4<>'') || ($fileicon4['url'] <> '') || ($sf_sidebar_text4<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url4 <> ''):?><a href="<?php echo $sf_sidebar_url4;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon4['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon4['url'];?>" alt="<?php echo $sf_sidebar_title4;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title4<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title4;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text4<>'') :?><?php echo $sf_sidebar_text4;?><?php endif;?>
                        <?php if ($sf_sidebar_url4 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title5<>'') || ($fileicon5['url'] <> '') || ($sf_sidebar_text5<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url5 <> ''):?><a href="<?php echo $sf_sidebar_url5;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon5['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon5['url'];?>" alt="<?php echo $sf_sidebar_title5;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title5<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title5;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text5<>'') :?><?php echo $sf_sidebar_text5;?><?php endif;?>
                        <?php if ($sf_sidebar_url5 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
                    </ul>
                 <?php endif;?>
                 <?php endif;
				 // END Quick Navigation?>
				 
				 <?php  // Quick Menu Navigation
				 if ($sf_type_tab_bottom1 == "Menu Navigation") :?>
				 <?php wp_nav_menu( array( 'theme_location' => 'tab-bottom-navigation','container' => '', 'items_wrap' => '<ul class="nav-tabs-bottom">%3$s</ul>'  ) ); ?>  
				 <?php endif; // END Menu Navigation ?>

				 <?php  // Text
				 if ($sf_type_tab_bottom1 == "Text") :?>
   			      <article>
                        <?php echo $sf_tab_bottom1_description;?>
                  </article>
				 <?php endif; // END Text ?>   


				  <?php  // Custom Post 'Partner'
				 if ($sf_type_tab_bottom1 == "Partners") :?>
				  <?php 
					$loop = new WP_Query(array('post_type' => 'partner', 'posts_per_page'=>100)); 						
					if ($loop->have_posts()):
					?>		
				 <div class="flexslider slider-partners">
                        <ul class="slides">
						<?php 
		   		        while ( $loop->have_posts() ) : $loop->the_post();																
						 $custom = get_post_custom($post->ID);
						 $url = isset($custom["url"][0]) ? $custom["url"][0] : false;	
						 $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'partner-bottab' );
						$imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'partner-bottab-retina' );
						   if ( has_post_thumbnail()) : ?>						  
                            <li><a href="<?php echo $url;?>"><img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" /></a></li>                        
							<?php endif;?>
                        <?php endwhile;?>
                        </ul>
                    </div>
					<?php endif;?>
				<?php endif; // END Custom Post 'Partner' ?>   
                </div>
				<?php endif;?>

				<?php if (($sf_tab_bottom2_title <> '') ) : ?>
                <div class="ui-tabs-panel clearfix" id="panel-2">
			    <?php  // Quick Navigation
				 if ($sf_type_tab_bottom2 == "Quick Navigation") :?>
				<?php if ( ($sf_sidebar_title1 <> '' ) || ($sf_sidebar_title2 <> '' ) || ($sf_sidebar_title3 <> '' ) ) :?>
                    <ul id="nav-sidebar-bottom" class="clearfix">
                        <?php if (($sf_sidebar_title1<>'') || ($fileicon1['url'] <> '') || ($sf_sidebar_text1<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url1 <> ''):?><a href="<?php echo $sf_sidebar_url1;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon1['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon1['url'];?>" alt="<?php echo $sf_sidebar_title1;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title1<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title1;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text1<>'') :?><?php echo $sf_sidebar_text1;?><?php endif;?>
                        <?php if ($sf_sidebar_url1 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
                     <?php if (($sf_sidebar_title2<>'') || ($fileicon2['url'] <> '') || ($sf_sidebar_text2<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url2 <> ''):?><a href="<?php echo $sf_sidebar_url2;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon2['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon2['url'];?>" alt="<?php echo $sf_sidebar_title2;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title2<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title2;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text2<>'') :?><?php echo $sf_sidebar_text2;?><?php endif;?>
                        <?php if ($sf_sidebar_url2 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title3<>'') || ($fileicon3['url'] <> '') || ($sf_sidebar_text3<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url3 <> ''):?><a href="<?php echo $sf_sidebar_url3;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon3['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon3['url'];?>" alt="<?php echo $sf_sidebar_title3;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title3<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title3;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text3<>'') :?><?php echo $sf_sidebar_text3;?><?php endif;?>
                        <?php if ($sf_sidebar_url3 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title4<>'') || ($fileicon4['url'] <> '') || ($sf_sidebar_text4<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url4 <> ''):?><a href="<?php echo $sf_sidebar_url4;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon4['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon4['url'];?>" alt="<?php echo $sf_sidebar_title4;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title4<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title4;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text4<>'') :?><?php echo $sf_sidebar_text4;?><?php endif;?>
                        <?php if ($sf_sidebar_url4 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title5<>'') || ($fileicon5['url'] <> '') || ($sf_sidebar_text5<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url5 <> ''):?><a href="<?php echo $sf_sidebar_url5;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon5['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon5['url'];?>" alt="<?php echo $sf_sidebar_title5;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title5<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title5;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text5<>'') :?><?php echo $sf_sidebar_text5;?><?php endif;?>
                        <?php if ($sf_sidebar_url5 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
                    </ul>
                 <?php endif;?>
                 <?php endif;
				 // END Quick Navigation?>
				 
				 <?php  // Quick Menu Navigation
				 if ($sf_type_tab_bottom2 == "Menu Navigation") :?>
				 <?php wp_nav_menu( array( 'theme_location' => 'tab-bottom-navigation','container' => '', 'items_wrap' => '<ul class="nav-tabs-bottom">%3$s</ul>'  ) ); ?>  
				 <?php endif; // END Menu Navigation ?>

				 <?php  // Text
				 if ($sf_type_tab_bottom2 == "Text") :?>
   			      <article>
                        <?php echo $sf_tab_bottom2_description;?>
                  </article>
				 <?php endif; // END Text ?>   

				  <?php  // Custom Post 'Partner'
				 if ($sf_type_tab_bottom2 == "Partners") :?>
				  <?php 
					$loop = new WP_Query(array('post_type' => 'partner', 'posts_per_page'=>100)); 						
					if ($loop->have_posts()):
					?>		
				 <div class="flexslider slider-partners">
                        <ul class="slides">
						<?php 
		   		        while ( $loop->have_posts() ) : $loop->the_post();				
						$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'partner-bottab' );
						$imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'partner-bottab-retina' );
						 $custom = get_post_custom($post->ID);
						 $url = isset($custom["url"][0]) ? $custom["url"][0] : false;	
						   if ( has_post_thumbnail()) :?>
                            <li><a href="<?php echo $url;?>"><img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" /></a></li>                        
							<?php endif;?>
                        <?php endwhile;?>
                        </ul>
                    </div>
					<?php endif;?>
				<?php endif; // END Custom Post 'Partner' ?>   
                </div>
				<?php endif;?>


				<?php if (($sf_tab_bottom3_title <> '') ) : ?>
                <div class="ui-tabs-panel clearfix" id="panel-3">
			    <?php  // Quick Navigation
				 if ($sf_type_tab_bottom3 == "Quick Navigation") :?>
				<?php if ( ($sf_sidebar_title1 <> '' ) || ($sf_sidebar_title2 <> '' ) || ($sf_sidebar_title3 <> '' ) ) :?>
                    <ul id="nav-sidebar-bottom" class="clearfix">
                        <?php if (($sf_sidebar_title1<>'') || ($fileicon1['url'] <> '') || ($sf_sidebar_text1<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url1 <> ''):?><a href="<?php echo $sf_sidebar_url1;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon1['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon1['url'];?>" alt="<?php echo $sf_sidebar_title1;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title1<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title1;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text1<>'') :?><?php echo $sf_sidebar_text1;?><?php endif;?>
                        <?php if ($sf_sidebar_url1 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
                     <?php if (($sf_sidebar_title2<>'') || ($fileicon2['url'] <> '') || ($sf_sidebar_text2<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url2 <> ''):?><a href="<?php echo $sf_sidebar_url2;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon2['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon2['url'];?>" alt="<?php echo $sf_sidebar_title2;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title2<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title2;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text2<>'') :?><?php echo $sf_sidebar_text2;?><?php endif;?>
                        <?php if ($sf_sidebar_url2 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title3<>'') || ($fileicon3['url'] <> '') || ($sf_sidebar_text3<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url3 <> ''):?><a href="<?php echo $sf_sidebar_url3;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon3['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon3['url'];?>" alt="<?php echo $sf_sidebar_title3;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title3<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title3;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text3<>'') :?><?php echo $sf_sidebar_text3;?><?php endif;?>
                        <?php if ($sf_sidebar_url3 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title4<>'') || ($fileicon4['url'] <> '') || ($sf_sidebar_text4<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url4 <> ''):?><a href="<?php echo $sf_sidebar_url4;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon4['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon4['url'];?>" alt="<?php echo $sf_sidebar_title4;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title4<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title4;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text4<>'') :?><?php echo $sf_sidebar_text4;?><?php endif;?>
                        <?php if ($sf_sidebar_url4 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title5<>'') || ($fileicon5['url'] <> '') || ($sf_sidebar_text5<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url5 <> ''):?><a href="<?php echo $sf_sidebar_url5;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon5['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon5['url'];?>" alt="<?php echo $sf_sidebar_title5;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title5<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title5;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text5<>'') :?><?php echo $sf_sidebar_text5;?><?php endif;?>
                        <?php if ($sf_sidebar_url5 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
                    </ul>
                 <?php endif;?>
                 <?php endif;
				 // END Quick Navigation?>
				 
				 <?php  // Quick Menu Navigation
				 if ($sf_type_tab_bottom3 == "Menu Navigation") :?>
				 <?php wp_nav_menu( array( 'theme_location' => 'tab-bottom-navigation','container' => '', 'items_wrap' => '<ul class="nav-tabs-bottom">%3$s</ul>'  ) ); ?>  
				 <?php endif; // END Menu Navigation ?>

				 <?php  // Text
				 if ($sf_type_tab_bottom3 == "Text") :?>
   			      <article>
                        <?php echo $sf_tab_bottom3_description;?>
                  </article>
				 <?php endif; // END Text ?>   

				  <?php  // Custom Post 'Partner'
				 if ($sf_type_tab_bottom3 == "Partners") :?>
				  <?php 
					$loop = new WP_Query(array('post_type' => 'partner','posts_per_page'=>100)); 						
					if ($loop->have_posts()):
					?>		
				 <div class="flexslider slider-partners">
                        <ul class="slides">
						<?php 
		   		        while ( $loop->have_posts() ) : $loop->the_post();				
						$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'partner-bottab' );
						$imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'partner-bottab-retina' );
						 $custom = get_post_custom($post->ID);
						 $url = isset($custom["url"][0]) ? $custom["url"][0] : false;	
						   if ( has_post_thumbnail()) :?>
                            <li><a href="<?php echo $url;?>"><img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" /></a></li>                        
							<?php endif;?>
                        <?php endwhile;?>
                        </ul>
                    </div>
					<?php endif;?>
				<?php endif; // END Custom Post 'Partner' ?>   
                </div>
				<?php endif;?>
               
                <?php if (($sf_tab_bottom4_title <> '') ) : ?>
                <div class="ui-tabs-panel clearfix" id="panel-4">
			    <?php  // Quick Navigation
				 if ($sf_type_tab_bottom4 == "Quick Navigation") :?>
				<?php if ( ($sf_sidebar_title1 <> '' ) || ($sf_sidebar_title2 <> '' ) || ($sf_sidebar_title3 <> '' ) ) :?>
                    <ul id="nav-sidebar-bottom" class="clearfix">
                        <?php if (($sf_sidebar_title1<>'') || ($fileicon1['url'] <> '') || ($sf_sidebar_text1<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url1 <> ''):?><a href="<?php echo $sf_sidebar_url1;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon1['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon1['url'];?>" alt="<?php echo $sf_sidebar_title1;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title1<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title1;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text1<>'') :?><?php echo $sf_sidebar_text1;?><?php endif;?>
                        <?php if ($sf_sidebar_url1 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
                     <?php if (($sf_sidebar_title2<>'') || ($fileicon2['url'] <> '') || ($sf_sidebar_text2<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url2 <> ''):?><a href="<?php echo $sf_sidebar_url2;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon2['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon2['url'];?>" alt="<?php echo $sf_sidebar_title2;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title2<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title2;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text2<>'') :?><?php echo $sf_sidebar_text2;?><?php endif;?>
                        <?php if ($sf_sidebar_url2 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title3<>'') || ($fileicon3['url'] <> '') || ($sf_sidebar_text3<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url3 <> ''):?><a href="<?php echo $sf_sidebar_url3;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon3['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon3['url'];?>" alt="<?php echo $sf_sidebar_title3;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title3<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title3;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text3<>'') :?><?php echo $sf_sidebar_text3;?><?php endif;?>
                        <?php if ($sf_sidebar_url3 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title4<>'') || ($fileicon4['url'] <> '') || ($sf_sidebar_text4<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url4 <> ''):?><a href="<?php echo $sf_sidebar_url4;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon4['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon4['url'];?>" alt="<?php echo $sf_sidebar_title4;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title4<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title4;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text4<>'') :?><?php echo $sf_sidebar_text4;?><?php endif;?>
                        <?php if ($sf_sidebar_url4 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
					 <?php if (($sf_sidebar_title5<>'') || ($fileicon5['url'] <> '') || ($sf_sidebar_text5<>'') ) : ?>
                    <li><?php if ($sf_sidebar_url5 <> ''):?><a href="<?php echo $sf_sidebar_url5;?>" class="clearfix"><?php endif;?>
                       <?php if ($fileicon5['url'] <> '') : ?>
					   <figure><img src="<?php echo $fileicon5['url'];?>" alt="<?php echo $sf_sidebar_title5;?>" /></figure>
						<?php endif;?>
                        <?php if ($sf_sidebar_title5<>''):?><strong class="title-nav-sidebar"><?php echo $sf_sidebar_title5;?></strong><?php endif;?>
                        <?php if ($sf_sidebar_text5<>'') :?><?php echo $sf_sidebar_text5;?><?php endif;?>
                        <?php if ($sf_sidebar_url5 <> ''):?></a><?php endif;?>
						</li>
					<?php endif;?>
                    </ul>
                 <?php endif;?>
                 <?php endif;
				 // END Quick Navigation?>
				 
				 <?php  // Quick Menu Navigation
				 if ($sf_type_tab_bottom4 == "Menu Navigation") :?>
				 <?php wp_nav_menu( array( 'theme_location' => 'tab-bottom-navigation','container' => '', 'items_wrap' => '<ul class="nav-tabs-bottom">%3$s</ul>'  ) ); ?>  
				 <?php endif; // END Menu Navigation ?>

				 <?php  // Text
				 if ($sf_type_tab_bottom4 == "Text") :?>
   			      <article>
                        <?php echo $sf_tab_bottom4_description;?>
                  </article>
				 <?php endif; // END Text ?>   
				  
				  <?php  // Custom Post 'Partner'
				 if ($sf_type_tab_bottom4 == "Partners") :?>
				  <?php 
					$loop = new WP_Query(array('post_type' => 'partner','posts_per_page'=>100)); 						
					if ($loop->have_posts()):
					?>		
				 <div class="flexslider slider-partners">
                        <ul class="slides">
						<?php 
		   		        while ( $loop->have_posts() ) : $loop->the_post();				
						$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'partner-bottab' );
						$imgretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'partner-bottab-retina' );
						 $custom = get_post_custom($post->ID);
						 $url = isset($custom["url"][0]) ? $custom["url"][0] : false;	
						   if ( has_post_thumbnail()) :?>
                            <li><a href="<?php echo $url;?>"><img src="<?php echo $img[0];?>" data-retina="<?php echo $imgretina[0];?>" alt="<?php the_title();?>" /></a></li>                        
							<?php endif;?>
                        <?php endwhile;?>
                        </ul>
                    </div>
					<?php endif;?>
				<?php endif; // END Custom Post 'Partner' ?>   
                </div>
				<?php endif;?>
				
            </div>
<?php endif;?>