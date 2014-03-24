 <?php 
 	global $wpdb;
					   $now = date("Y-m-d");
						  $month = date('m');
						  $year = date('Y');
						  if (isset($_GET['sfdate'])) :
						     $activedate = $_GET['sfdate'];
						     $date = explode("-",$activedate);						   							 
						  else : 
						     $activedate = date("Y-m-d");
						     $date = explode("-",$activedate);
						  endif;

					 $activemonth = $date[1];
 					 $activeyear = $date[0];
					 if ($activemonth<> '') $str =" AND month($wpdb->postmeta.meta_value) = $activemonth ";
					  $querystr = "
						SELECT $wpdb->posts.* ,$wpdb->postmeta.meta_value as startdate, count(*) as countevent
						FROM $wpdb->posts, $wpdb->postmeta
						WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
						AND $wpdb->postmeta.meta_key = 'startdate'  
						AND $wpdb->posts.post_status = 'publish' 
						AND $wpdb->posts.post_type = 'event'
						AND year($wpdb->postmeta.meta_value) = '$activeyear' ".$str.
						"GROUP BY $wpdb->postmeta.meta_value
						ORDER BY $wpdb->postmeta.meta_value ASC";
					
					  $eventstartdate = $wpdb->get_results($querystr, OBJECT);?>
                    <div class="accordion">
					 <?php  foreach($eventstartdate as $events) : ?>
				        <h3 class="title-event"><?php echo date("F d, Y",strtotime($events->startdate));?> - <em><?php echo $events->countevent;?> <?php if ($events->countevent > 1): echo "Events"; else : echo "Event"; endif;?></em></h3>
                        <div class="content-event clearfix">
						 <?php // $args1 = array('post_type' => 'event', 'post_status'=>'publish','meta_key' => 'startdate', 'meta_value'=>$events1->startdate,'meta_compare' => '=');
//					 $loop1 = new WP_Query( $args1 );
					 ?>
					 <?php $x=1;
					 $querystr1 = "SELECT wpposts.*, wpostmeta.meta_value as startdate, wpostmeta2.meta_value as enddate, wpostmeta3.meta_value as starttime, wpostmeta4.meta_value as endtime, wpostmeta5.meta_value as location
				  	 FROM $wpdb->posts as wpposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2, $wpdb->postmeta wpostmeta3, $wpdb->postmeta wpostmeta4, $wpdb->postmeta wpostmeta5
					 WHERE wpposts.ID = wpostmeta.post_id
					 AND wpposts.ID = wpostmeta2.post_id
					 AND wpposts.ID = wpostmeta3.post_id
					 AND wpposts.ID = wpostmeta4.post_id
					 AND wpposts.ID = wpostmeta5.post_id
					 AND wpostmeta.meta_key = 'startdate' AND wpostmeta.meta_value = '$events->startdate'
					 AND wpostmeta2.meta_key = 'enddate'
					 AND wpostmeta3.meta_key = 'starttime'
					 AND wpostmeta4.meta_key = 'endtime'
					 AND wpostmeta5.meta_key = 'location'
					 AND wpposts.post_status = 'publish' 
					 AND wpposts.post_type = 'event'
					 ORDER BY wpostmeta.meta_value, wpostmeta3.meta_value ASC
					 ";
					   $eventstartdate1 = $wpdb->get_results($querystr1, OBJECT);
//					    if ($loop1->have_posts()): 
//						while ($loop1->have_posts()) : $loop1->the_post();
//						$custom = get_post_custom($post->ID);
						foreach($eventstartdate1 as $events1) :
						 setup_postdata($events1);
						$imgone = wp_get_attachment_image_src( get_post_thumbnail_id($events1->ID), 'event-on-slide-one' );
						$imgmore = wp_get_attachment_image_src( get_post_thumbnail_id($events1->ID), 'event-on-slide-more' );
						$imgoneretina = wp_get_attachment_image_src( get_post_thumbnail_id($events1->ID), 'event-on-slide-one-retina' );
						$imgmoreretina = wp_get_attachment_image_src( get_post_thumbnail_id($events1->ID), 'event-on-slide-more-retina' );
//						if ($events1->startdate == $startdate) : 
						?>
                            <div class="<?php if ($events->countevent > 1) : echo 'event-container'; else : echo 'event-container-one'; endif;?> clearfix <?php if ($x % 4 == 0) : echo ' last'; endif;?>" itemscope itemtype="http://data-vocabulary.org/Event">
                                <?php if (has_post_thumbnail($events1->ID)):?> <img src="<?php if ($events->countevent > 1) : echo $imgmore[0]; else : echo $imgone[0]; endif;?>" data-retina="<?php if ($events->countevent > 1) : echo $imgmoreretina[0]; else : echo $imgoneretina[0]; endif;?>" alt="" itemprop="photo" />
								<?php endif;?>
								 <?php if ($events->countevent > 1) :?><h4 itemprop="summary"><a href="<?php echo get_permalink($events1->ID);?>" itemprop="url"><?php echo $events1->post_title;?></a></h4>
								 <?php endif;?>
                                <div class="panel-event-info">
                                    <ul class="list-event-slider">
									    <?php if (($events1->startdate <> '') && ($events1->enddate <> '')) : ?>
                                        <li class="time-slider"><time itemprop="startDate" datetime="<?php echo date("Y-m-d",strtotime($events1->startdate));?>"><?php echo date("F d, Y",strtotime($events1->startdate));?></time> <?php if ($events1->enddate <> '') :?>- <time itemprop="endDate" datetime="<?php echo date("Y-m-d",strtotime($events1->enddate));?>"><?php echo date("F d, Y",strtotime($events1->enddate));?></time><?php endif;?></li>
										<?php endif;?>
                                        <?php if (($events1->starttime <> '') && ($events1->endtime <> '')) : ?>
										<li class="hour-slider"><?php echo $events1->starttime;?> <?php if ($events1->endtime <> '') :?>- <?php echo $events1->endtime;?><?php endif;?></li>
										<?php endif;?>
                                     <li class="location-slider" itemprop="location" itemscope itemtype="http://data-vocabulary.org/Organization"><em itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address"><?php echo $events1->location;?></em></li>
                                    </ul>
									<?php if ($events->countevent > 1) :?><a href="<?php echo get_permalink($events1->ID);?>" class="button-detail"><?php _e('View Detail','schoolfun');?></a>
									<?php endif;?>
                                </div>
                                <?php if ($events->countevent == 1) :?><h2 class="title-event-one" itemprop="summary"><a href="<?php echo get_permalink($events1->ID);?>" itemprop="url"><?php echo $events1->post_title;?></a></h2>
								<?php endif;?>
                            </div>
							<?php 
							$x++;
							endforeach;	
							//endif;
							//endwhile;
							//endif;?>
                        </div>
						<?php endforeach;?>                        
                    </div>