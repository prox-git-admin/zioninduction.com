<?php get_header();
/*
Template Name: Event
*/
?>
    <div id="content-container">
        <div id="content" class="clearfix">
            <div id="full-width">
                <?php get_template_part('breadcrumbs');?> 
				 <?php 
				 $loop = new WP_Query(array('post_type' => 'event', 'order' => 'ASC', 'posts_per_page' => '4','meta_key'=>'sticky', 'meta_value'=>'on')); 
				 if ( $loop->have_posts() ) : ?>
                <div id="slider-event" class="flexslider">
                    <ul class="slides">
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

					while ( $loop->have_posts() ) : $loop->the_post();
						    $custom = get_post_custom($post->ID);
							$startdate = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false;	
							$enddate = isset($custom["enddate"][0]) ? $custom["enddate"][0] : false;
							$starttime = isset($custom["starttime"][0]) ? $custom["starttime"][0] : false;
							$endtime = isset($custom["endtime"][0]) ? $custom["endtime"][0] : false;		
							$location = isset($custom["location"][0]) ? $custom["location"][0] : false;
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'event-sticky' );
					 ?>
                        <li>
                            <div class="panel-slider-event clearfix">
                                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                <time datetime="<?php echo date("Y-m-d",strtotime($startdate));?>"><strong><?php echo date("d",strtotime($startdate));?></strong><br /><span><?php echo date("F, Y",strtotime($enddate));?></span></time>
                                <ul class="list-event-slider">
                                    <li class="hour-slider"><?php echo $starttime;?> <?php if ($endtime <>'') :?>- <?php echo $endtime;?><?php endif;?></li>
                                    <?php if ($location <> '') : ?><li class="location-slider"><em><?php echo $location;?></em></li><?php endif;?>
                                </ul>
                            </div>
                             <?php if ( has_post_thumbnail()) :?><img src="<?php echo $image[0];?>" alt="<?php the_title();?>" /><?php endif;?>
                        </li>
                      <?php endwhile;?>
                    </ul>
                </div>
				<?php endif;?>
				
                <article class="static-page">
				 <?php if ( have_posts() ) :?>
				 	<?php while ( have_posts() ) : the_post();?>
                    <h1 id="main-title" class="event-title"><?php the_title();?></h1> <h3 id="title-month">
					  <?php if ($_GET['sfdate']) : ?>
						 <?php if ($activemonth <> ''):?> 
		 					 <?php echo date("F Y",strtotime($activedate));?>
						 <?php else:?>
					  		 <?php echo $_GET['sfdate'];?>
						 <?php endif;?>
					 <?php elseif ($_POST['sfdate']):?>
					  		 <?php echo date("Y",strtotime($activedate));?>
					  <?php else : ?>
							 <?php echo date("F Y",strtotime($activedate));?>
					 <?php endif;?></h3>
					<?php endwhile;
					endif;?>
					<?php wp_reset_query(); ?>
                    <nav id="nav-event" class="clearfix">
					<?php 
$querystr = "
    SELECT distinct $wpdb->posts.* ,$wpdb->postmeta.meta_value as startdate
    FROM $wpdb->posts, $wpdb->postmeta
    WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
    AND $wpdb->postmeta.meta_key = 'startdate'  
    AND $wpdb->posts.post_status = 'publish' 
    AND $wpdb->posts.post_type = 'event'
	AND month($wpdb->postmeta.meta_value) >= $month
	AND year($wpdb->postmeta.meta_value) >= $year
	GROUP BY month($wpdb->postmeta.meta_value), Year($wpdb->postmeta.meta_value)
    ORDER BY $wpdb->postmeta.meta_value ASC
 ";
$querystr2 = "
    SELECT distinct $wpdb->posts.* ,$wpdb->postmeta.meta_value as startdate
    FROM $wpdb->posts, $wpdb->postmeta
    WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
    AND $wpdb->postmeta.meta_key = 'startdate'  
    AND $wpdb->posts.post_status = 'publish' 
    AND $wpdb->posts.post_type = 'event'
	AND year($wpdb->postmeta.meta_value) >= $year
	GROUP BY Year($wpdb->postmeta.meta_value)
    ORDER BY $wpdb->postmeta.meta_value ASC
 ";
//		$eventstartdate = $wpdb->get_results("select pm.meta_value as startdate from posts p join postmeta pm on p.ID = pm.post_id  where p.post_type = 'event'  and p.post_status = 'publish'  and pm.meta_key = 'startdate' group by pm.meta_value order by pm.meta_value DESC", OBJECT );
$eventstartdate = $wpdb->get_results($querystr, OBJECT);
$eventstartdate2 = $wpdb->get_results($querystr2, OBJECT);

?>
                        <ul>
						 <?php $x=1; foreach($eventstartdate as $events) : ?>
							<?php if ($x <= 4):?>
							
                            <li <?php 
							if ($_GET['sfdate'] <> '') :  
							   if ($activemonth <> ''):
									if ( date("Y-m",strtotime($events->startdate))  == date("Y-m",strtotime($_GET['sfdate'])) )  :
									echo ' class="current-menu-item"';
									endif;
                               endif;                                
							elseif  ($_POST['sfdate'] == '') :
								if ( date("Y-m",strtotime($events->startdate)) == date("Y-m",strtotime($now)) ) :
								echo ' class="current-menu-item"';
								endif;
                             else :
                             endif; 
							?>><a href="<?php echo add_query_arg( 'sfdate', date("Y-m",strtotime($events->startdate)), get_permalink($post->ID))?>"><?php echo date("F Y",strtotime($events->startdate));?></a></li> <?php endif;?>
                          <?php $x++;endforeach;?>						  
                            <li<?php 
							if ($_GET['sfdate'] <> '') :  							
								if ($activemonth == ''):
									if ( date("Y",strtotime($events->startdate))  == $_GET['sfdate'] ) :
									echo ' class="current-menu-item"';
									endif;
								endif;
                            elseif ($_POST['sfdate'] <> '') :
									if (date("Y",strtotime($events->startdate))  == $_POST['sfdate']  ) :
                                    echo ' class="current-menu-item"';
									endif;
                            else:
							endif; 	?>><a href="<?php echo add_query_arg( 'sfdate', date("Y",strtotime($events->startdate)), get_permalink($post->ID))?>"><?php _e("This Year","schoolfun");?></a></li>
                        </ul>
                        <form method="post" action="<?php the_permalink();?>" id="form-year">
                            <div>
                                <label for="select-year"><?php _e("Change Year :","schoolfun");?></label>
                                <select name="sfdate" class="select" id="select-year">
                                     <?php $x=1; foreach($eventstartdate2 as $events2) : ?>
									 <option value="<?php echo date("Y",strtotime($events2->startdate));?>"><?php echo date("Y",strtotime($events2->startdate));?></option>
									 <?php endforeach;?>
                                </select>
                                <input type="submit" name="submit-year" class="button" value="Go" />
                            </div>
                        </form>
                    </nav>
					  <?php if ($_GET['sfdate']) : ?>
					   <?php if ($activemonth <> ''):?> 
						   <?php get_template_part('event-month');?>
						<?php else: ?>
							<?php get_template_part('event-year');?>
					   <?php endif;?>
					  <?php elseif ($_POST['sfdate']):?>
  					  <?php get_template_part('event-year');?>
					  <?php else : ?>
					  <?php get_template_part('event-month');?>
					  <?php endif;?>
                </article>
            </div>
            <?php get_template_part('tabs-content-bottom');?>
        </div>
    </div>
<?php get_footer();?>