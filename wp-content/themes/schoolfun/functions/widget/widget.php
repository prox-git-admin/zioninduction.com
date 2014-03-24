<?php
/* Widget: Schoolfun Text Widget */

class SF_Widget_Text extends WP_Widget {

	function SF_Widget_Text() {
		$widgets_opt = array('description'=>__('Widget to show text and image.','schoolfun'));
		parent::WP_Widget(false,$name= "Schoolfun Text Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$textbutton = apply_filters( 'widget_textbutton', $instance['textbutton'], $instance );
		$text = apply_filters( 'widget_text', $instance['text'], $instance );
		$image = apply_filters( 'widget_image', $instance['image'], $instance );
		$pageid = apply_filters('pageid', $instance['pageid'], $instance);
		$googlemap = apply_filters( 'widget_googlemap', $instance['googlemap'], $instance );
		$address = apply_filters( 'widget_address', $instance['address'], $instance );
		$email = apply_filters( 'widget_email', $instance['email'], $instance );
		$phone = apply_filters( 'widget_phone', $instance['phone'], $instance );

		echo $before_widget;
		if ( !empty( $title ) ) : echo $before_title . $title . $after_title; endif;
		?>
		<article class="text-widget <?php if ( empty( $textbutton ) ) : echo "no-border"; endif; ?>">
		<?php
		if ( !empty( $image ) ) : ?>
			<img src="<?php echo $image ?>" alt="<?php echo $title ?>" class="imgframe" />
		<?php endif; ?>
		<?php
		echo $instance['filter'] ? wpautop($text) : $text;
		if (($address=='') && ($email=='') && ($phone=='')): ?>
		<?php else: ?>
			<ul>
				<?php if ($address<>''): ?>
					<li><strong><?php _e('Address:','schoolfun');?></strong> <?php echo $address;?></li>
				<?php endif; ?>
				<?php if ($email<>''): ?>
					<li><strong><?php _e('Email:','schoolfun');?></strong> <?php echo $email;?></li>
				<?php endif; ?>
				<?php if ($phone<>''): ?>
					<li><strong><?php _e('Phone:','schoolfun');?></strong> <?php echo $phone;?></li>
				<?php endif; ?>
			</ul>	
		<?php endif;
		if ($googlemap<>'') : ?>
			<iframe class="map-area" src="<?php echo $googlemap; ?>"></iframe><br />
		<?php endif;						
		echo "</article>";
		if ( !empty( $textbutton ) ) : ?>
		<a href="<?php echo get_page_link($pageid);?>" class="button-more"><?php echo $textbutton; ?></a>
		<?php endif; ?>		 		
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['textbutton'] = strip_tags($new_instance['textbutton']);
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['pageid'] = strip_tags($new_instance['pageid']);
		$instance['googlemap'] = strip_tags($new_instance['googlemap']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['email'] = strip_tags($new_instance['email']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'textbutton' => '', 'image' => '', 'googlemap' => '', 'address' => '', 'phone' => '', 'email' => '' ) );
		$title = strip_tags($instance['title']);
		$textbutton = strip_tags($instance['textbutton']);
		$text = format_to_edit($instance['text']);
		$image = esc_attr($instance['image']);
		$pageid = esc_attr(isset($instance['pageid']) ? $instance['pageid'] : false);
		$googlemap= strip_tags($instance['googlemap']);
		$address= strip_tags($instance['address']);
		$phone= strip_tags($instance['phone']);
		$email= strip_tags($instance['email']);
		
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
		
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image URL:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs','schoolfun');?></label></p>
		<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo esc_attr($address); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('googlemap'); ?>"><?php _e('Google Map URL:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('googlemap'); ?>" name="<?php echo $this->get_field_name('googlemap'); ?>" type="text" value="<?php echo esc_attr($googlemap); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('textbutton'); ?>"><?php _e('Text for Button:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('textbutton'); ?>" name="<?php echo $this->get_field_name('textbutton'); ?>" type="text" value="<?php echo esc_attr($textbutton); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('pageid'); ?>"><?php _e('Link goes to:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" class="widefat" >
			<?php foreach ($listpages as $opt => $val)
				echo "<option value='$opt'" . ( $pageid  == $opt ? "selected='selected'" : '' ). ">$val</option>";
			?>
		</select></p>

<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SF_Widget_Text");'));


/* Widget: Schoolfun Twitter Widget */

class SF_Widget_LastTwitter extends WP_Widget {

	function SF_Widget_LastTwitter() {
		$widgets_opt = array('description'=>__('Widget to show latest Twitter','schoolfun'));
		parent::WP_Widget(false,$name= "Schoolfun Twitter Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {		
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$username = apply_filters( 'widget_username', $instance['username'], $instance );
		$totaltwitter = apply_filters( 'widget_totaltwitter', $instance['totaltwitter'], $instance );
		$followus = apply_filters( 'widget_followus', $instance['followus'], $instance );
		$concumerkey = apply_filters( 'widget_consumerkey', $instance['consumerkey'], $instance );
		$consumersecret = apply_filters( 'widget_consumersecret', $instance['consumersecret'], $instance );
		$accesstoken = apply_filters( 'widget_accesstoken', $instance['accesstoken'], $instance );
		$accesstokensecret = apply_filters( 'widget_accesstokensecret', $instance['accesstokensecret'], $instance );	
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
		?>			
				
					<?php 
					
							
							if(!require_once('twitteroauth.php')){ 
								echo '<strong>Couldn\'t find twitteroauth.php!</strong>' . $after_widget;
								return;
							}
														
							function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
							  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
							  return $connection;
							}
							  
							  							  
							$connection = getConnectionWithAccessToken($instance['consumerkey'], $instance['consumersecret'], $instance['accesstoken'], $instance['accesstokensecret']);
							$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$instance['username']."&count=10") or die('Couldn\'t retrieve tweets! Wrong username?');
							
														
							if(!empty($tweets->errors)){
								if($tweets->errors[0]->message == 'Invalid or expired token'){
									echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
								}else{
									echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
								}
								return;
							}
							
							for($i = 0;$i <= count($tweets); $i++){
								if(!empty($tweets[$i])){
									$tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
									$tweets_array[$i]['text'] = $tweets[$i]->text;			
									$tweets_array[$i]['status_id'] = $tweets[$i]->id_str;			
								}	
							}							
							
							//save tweets to wp option 		
								update_option('wc_twitter_plugin_tweets',serialize($tweets_array));															
							
						//convert links to clickable format
						function convert_links($status,$targetBlank=true,$linkMaxLen=250){
						 
							// the target
								$target=$targetBlank ? " target=\"_blank\" " : "";
							 
							// convert link to url
								$status = preg_replace("/((http:\/\/|https:\/\/)[^ )
]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);
							 
							// convert @ to follow
								$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);
							 
							// convert # to search
								$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);
							 
							// return the status
								return $status;
						}
					
					
					//convert dates to readable format	
						function relative_time($a) {
							//get current timestampt
							$b = strtotime("now"); 
							//get timestamp when tweet created
							$c = strtotime($a);
							//get difference
							$d = $b - $c;
							//calculate different time values
							$minute = 60;
							$hour = $minute * 60;
							$day = $hour * 24;
							$week = $day * 7;
								
							if(is_numeric($d) && $d > 0) {
								//if less then 3 seconds
								if($d < 3) return "right now";
								//if less then minute
								if($d < $minute) return floor($d) . " seconds ago";
								//if less then 2 minutes
								if($d < $minute * 2) return "about 1 minute ago";
								//if less then hour
								if($d < $hour) return floor($d / $minute) . " minutes ago";
								//if less then 2 hours
								if($d < $hour * 2) return "about 1 hour ago";
								//if less then day
								if($d < $day) return floor($d / $hour) . " hours ago";
								//if more then day, but less then 2 days
								if($d > $day && $d < $day * 2) return "yesterday";
								//if less then year
								if($d < $day * 365) return floor($d / $day) . " days ago";
								//else return more than a year
								return "over a year ago";
							}
						}	
					?>						
					<div id="twitter-widget <?php echo $args['widget_id'] ?>-twit" class="texttwitter">
					<ul class='menu'>
						<?php
						   $fctr = '1';
						   $wc_twitter_plugin_tweets = maybe_unserialize(get_option('wc_twitter_plugin_tweets'));
							foreach($wc_twitter_plugin_tweets as $tweet){								
								print '<li><span>'.convert_links($tweet['text']).'</span><br /><a class="twitter_time" target="_blank" href="http://twitter.com/'.$instance['username'].'/statuses/'.$tweet['status_id'].'">'.relative_time($tweet['created_at']).'</a></li>';
								if($fctr == $instance['totaltwitter']){ break; }
								$fctr++;
							}
							?>										
							</ul>
					</div>
				<?php			
			
			if ( !empty( $followus ) ) {
				?>
				<a href="http://www.twitter.com/<?php echo $username ?>" class="button-more"><?php echo $followus ?></a>
				<div class="clear"></div>
				<?php
			}?>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['totaltwitter'] = strip_tags($new_instance['totaltwitter']);
		$instance['followus'] = strip_tags($new_instance['followus']);
		$instance['consumerkey'] = strip_tags($new_instance['consumerkey']);
		$instance['consumersecret'] = strip_tags($new_instance['consumersecret']);
		$instance['accesstoken'] = strip_tags($new_instance['accesstoken']);
		$instance['accesstokensecret'] = strip_tags($new_instance['accesstokensecret']);		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'username' => '', 'totaltwitter' => '', 'followus' => '', 'consumerkey' => '', 'consumersecret' => '', 'accesstoken' => '', 'accesstokensecret' => '', 'cachetime' => '' ) );
		$title = strip_tags($instance['title']);
		$username = strip_tags($instance['username']);
		$followus = strip_tags($instance['followus']);
		$totaltwitter = (int)($instance['totaltwitter']);
		$consumerkey =  strip_tags($instance['consumerkey']);
		$consumersecret =  strip_tags($instance['consumersecret']);
		$accesstoken =  strip_tags($instance['accesstoken']);
		$accesstokensecret =  strip_tags($instance['accesstokensecret']);		
		if ( $totaltwitter < 1 || 10 < $totaltwitter )
			$totaltwitter  = 2;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('consumerkey'); ?>"><?php _e('Consumer Key:','schoolfun'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('consumerkey'); ?>" name="<?php echo $this->get_field_name('consumerkey'); ?>" type="text" value="<?php echo esc_attr($consumerkey); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('consumersecret'); ?>"><?php _e('Consumer Secret:','schoolfun'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('consumersecret'); ?>" name="<?php echo $this->get_field_name('consumersecret'); ?>" type="text" value="<?php echo esc_attr($consumersecret); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('accesstoken'); ?>"><?php _e('Access Token:','schoolfun'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('accesstoken'); ?>" name="<?php echo $this->get_field_name('accesstoken'); ?>" type="text" value="<?php echo esc_attr($accesstoken); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('accesstokensecret'); ?>"><?php _e('Access Token Secret:','schoolfun'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('accesstokensecret'); ?>" name="<?php echo $this->get_field_name('accesstokensecret'); ?>" type="text" value="<?php echo esc_attr($accesstokensecret); ?>" /></p>		
		<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter Username:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('followus'); ?>"><?php _e('"Follow Us" Button Text:','schoolfun'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('followus'); ?>" name="<?php echo $this->get_field_name('followus'); ?>" type="text" value="<?php echo esc_attr($followus); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('totaltwitter'); ?>"><?php _e('Number of Tweets:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('totaltwitter'); ?>"  id="<?php echo $this->get_field_id('totaltwitter'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totaltwitter == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SF_Widget_LastTwitter");'));


/* Widget: Schoolfun News Widget */

class SF_Widget_News extends WP_Widget {

	function SF_Widget_News() {
		$widgets_opt = array('description'=>__('Widget to show latest post with featured images.','schoolfun'));
		parent::WP_Widget(false,$name= "Schoolfun News Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$textbutton = apply_filters( 'widget_textbutton', $instance['textbutton'], $instance );
		$totalnews = apply_filters( 'widget_totalnews', $instance['totalnews'], $instance );
		$pageid = apply_filters('pageid', $instance['pageid'], $instance);
		
		$r = new WP_Query(array('showposts' => $totalnews, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
		if ($r->have_posts()) :
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 		
    
		echo "<ul class=\"menu news-sidebar\">";
		while ($r->have_posts()) : $r->the_post(); 
		$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-widget' );
			$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-widget-retina' ); 
		?>
			<li class="clearfix">
				<?php if ((get_post_format()<>'quote') AND (get_post_format()<>'aside')): ?>
				<?php if ( has_post_thumbnail() ) : ?><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" class="imgframe alignleft" /><?php endif;?>
				<?php endif;?>
				<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
				<span class="date-news"><?php the_time('F j, Y'); ?></span>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php if ( !empty( $textbutton ) ) : ?>
			<a href="<?php echo get_page_link($pageid);?>" class="button-more"><?php echo $textbutton; ?></a>
		<?php endif; ?>
		<?php
		echo $after_widget;
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['textbutton'] = strip_tags($new_instance['textbutton']);
		$instance['totalnews'] = strip_tags($new_instance['totalnews']);
		$instance['pageid'] = strip_tags($new_instance['pageid']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'totalnews' => '', 'textbutton' =>'', 'pageid' => '' ) );
		$title = strip_tags($instance['title']);
		$textbutton = strip_tags($instance['textbutton']);
		$totalnews = strip_tags($instance['totalnews']);
		$pageid = strip_tags($instance['pageid']);
		
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
		
		$totalnews = (int)($instance['totalnews']);
		if ( $totalnews < 1 || 10 < $totalnews )
			$totalnews  = 3;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('totalnews'); ?>"><?php _e('Number of posts to show:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('totalnews'); ?>"  id="<?php echo $this->get_field_id('totalnews'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totalnews == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_id('textbutton'); ?>"><?php _e('Text for Button:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('textbutton'); ?>" name="<?php echo $this->get_field_name('textbutton'); ?>" type="text" value="<?php echo esc_attr($textbutton); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('pageid'); ?>"><?php _e('Link goes to:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" class="widefat" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SF_Widget_News");'));

/* Widget: Schoolfun Flickr Widget */

class SF_Widget_Flickr extends WP_Widget {

	function SF_Widget_Flickr() {
		$widgets_opt = array('description'=>__('Widget to show photos from a Flickr ID.','schoolfun'));
		parent::WP_Widget(false,$name= "Schoolfun Flickr Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$flickrid = apply_filters( 'widget_flickrid', $instance['flickrid'], $instance );
		$flickrtype = apply_filters( 'widget_flickrtype', $instance['flickrtype'], $instance );
		$flickrtotal = apply_filters( 'widget_flickrtotal', $instance['flickrtotal'], $instance );
		$flickrsort = apply_filters( 'widget_flickrsort', $instance['flickrsort'], $instance );
		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
			if ( !empty( $flickrid ) ) {
				?>
				<div class="flickr">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $flickrtotal; ?>&amp;display=<?php echo $flickrsort; ?>&amp;&amp;layout=h&amp;source=<?php echo $flickrtype; ?>&amp;user=<?php echo $flickrid; ?>&amp;size=t"></script> 
				</div>
				<?php
			}?>
    	 <div class="binder-left"></div><div class="binder-right"></div>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickrid'] = strip_tags($new_instance['flickrid']);
		$instance['flickrtype'] = strip_tags($new_instance['flickrtype']);
		$instance['flickrtotal'] = strip_tags($new_instance['flickrtotal']);
		$instance['flickrsort'] = strip_tags($new_instance['flickrsort']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'flickrid' => '', 'flickrtype' => '', 'flickrtotal' => '', 'flickrsort' => '') );
		$title = strip_tags($instance['title']);
		$flickrid = strip_tags($instance['flickrid']);
		$flickrtype = strip_tags($instance['flickrtype']);
		$flickrsort = strip_tags($instance['flickrsort']);
		$flickrtotal = (int)($instance['flickrtotal']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('flickrid'); ?>">Flickr ID(<a href=http://idgettr.com/>idGettr</a>):</label>
		<input class="widefat" id="<?php echo $this->get_field_id('flickrid'); ?>" name="<?php echo $this->get_field_name('flickrid'); ?>" type="text" value="<?php echo esc_attr($flickrid); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_name('flickrtype'); ?>"><?php _e('Type:','schoolfun');?></label>
		<select name="<?php echo $this->get_field_name('flickrtype'); ?>"  id="<?php echo $this->get_field_id('flickrtype'); ?>" class="widefat" >
		<?php
			echo "<option value='user' " . ( $flickrtype == 'user' ? "selected='selected'" : '' ) . ">User</option>";
			echo "<option value='group' " . ( $flickrtype == 'group' ? "selected='selected'" : '' ) . ">Group</option>";
		?>
		</select></p>
		
		<p><label for="<?php echo $this->get_field_name('flickrtotal'); ?>"><?php _e('Number of photo to show:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('flickrtotal'); ?>"  id="<?php echo $this->get_field_id('flickrtotal'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 15; ++$i )
			echo "<option value='$i' " . ( $flickrtotal == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
		
		<p><label for="<?php echo $this->get_field_name('flickrsort'); ?>"><?php _e('Sorting:','schoolfun');?></label>
		<select name="<?php echo $this->get_field_name('flickrsort'); ?>"  id="<?php echo $this->get_field_id('flickrsort'); ?>" class="widefat" >
		<?php
			echo "<option value='latest' " . ( $flickrsort == 'latest' ? "selected='selected'" : '' ) . ">Latest</option>";
			echo "<option value='random' " . ( $flickrsort == 'random' ? "selected='selected'" : '' ) . ">Random</option>";
		?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SF_Widget_Flickr");'));


/* Widget: Schoolfun Random Testimonial */

class SF_Widget_Testimonial extends WP_Widget {

	function SF_Widget_Testimonial() {
		$widgets_opt = array('description'=>__('Widget to show random testimonial.','schoolfun'));
		parent::WP_Widget(false,$name= "Schoolfun Random Testimonial",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$textbutton = apply_filters( 'widget_textbutton', $instance['textbutton'], $instance );
		$pageid = apply_filters('pageid', $instance['pageid'], $instance);
		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
		
		$loop = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => 1, 'orderby' => 'rand' )); 
		while ( $loop->have_posts() ) : $loop->the_post(); 
			$custom = get_post_custom(isset($post->ID));
			$screenshot_url = isset($custom["screenshot_url"][0]) ? $custom["screenshot_url"][0] : false;
			$website_url_testimonial = isset($custom["website_url_testimonial"][0]) ? $custom["website_url_testimonial"][0] : false;
			$company_name = isset($custom["company_name"][0]) ? $custom["company_name"][0] : false;		
			$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'testimonial-widget' );
			$urlimageretina =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'testimonial-widget-retina' );

			?>
			<article class="text-widget">
				<?php if ( has_post_thumbnail() ) : ?><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" class="imgframe alignleft testimonial" /><?php endif;?>
				<div class="testimonial-header">
   					<h4><?php the_title();?></h4>
					<?php if ($website_url_testimonial<>'') : ?>
						<h5><a href="<?php echo $website_url_testimonial ?>"><?php echo $company_name ?></a></h5>
					<?php else : ?>
						<h5><?php echo $company_name ?></h5>
					<?php endif; ?>					
				</div>
				<blockquote><?php the_content() ?></blockquote>
			</article>			
		<?php endwhile;?>
			<?php if ( !empty( $textbutton ) ) : ?>
        	<a href="<?php echo get_page_link($pageid);?>" class="button-more"><?php echo $textbutton; ?></a>
			<?php endif; ?>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['textbutton'] = strip_tags($new_instance['textbutton']);
		$instance['pageid'] = strip_tags($new_instance['pageid']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'textbutton' => '', 'pageid' => '' ) );
		$title = strip_tags($instance['title']);
		$textbutton = strip_tags($instance['textbutton']);
		$pageid = strip_tags($instance['pageid']);
		
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
		

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('textbutton'); ?>"><?php _e('Text for Button:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('textbutton'); ?>" name="<?php echo $this->get_field_name('textbutton'); ?>" type="text" value="<?php echo esc_attr($textbutton); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('pageid'); ?>"><?php _e('Link goes to:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" class="widefat" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SF_Widget_Testimonial");'));



/* Widget: Schoolfun Partner Widget */

class SF_Widget_Partner extends WP_Widget {

	function SF_Widget_Partner() {
		$widgets_opt = array('description'=>__('Widget to show latest partner.','schoolfun'));
		parent::WP_Widget(false,$name= "Schoolfun Partner Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);	
		$totalpartner = apply_filters( 'widget_totalpartner', $instance['totalpartner'], $instance );		
		
		$r = new WP_Query(array('post_type' => 'partner', 'showposts' => $totalpartner, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 		
    if ($r->have_posts()) :
		echo "<ul class=\"menu partner-sidebar\">";
		while ($r->have_posts()) : $r->the_post(); 
		$custom = get_post_custom(isset($post->ID));
		$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'partner-bottab' );
		$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'partner-bottab-retina' ); 
		$url = isset($custom["url"][0]) ? $custom["url"][0] : false;
		?>
			<li class="clearfix">
				<?php if ( has_post_thumbnail() ) : ?><a href="<?php echo $url; ?>"><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" />
				</a><?php endif;?>				
			</li>
		<?php endwhile; ?>
		</ul>
		<?php if ( !empty( $textbutton ) ) : ?>
			<a href="<?php echo get_page_link($pageid);?>" class="button-more"><?php echo $textbutton; ?></a>
		<?php endif; ?>
		<?php
				endif;
		echo $after_widget;	

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);		
		$instance['totalpartner'] = strip_tags($new_instance['totalpartner']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'totalpartner' => '' ) );
		$title = strip_tags($instance['title']);
		$totalpartner = strip_tags($instance['totalpartner']);
	
		
		$totalpartner = (int)($instance['totalpartner']);
		if ( $totalpartner < 1 || 10 < $totalpartner )
			$totalpartner  = 3;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('totalpartner'); ?>"><?php _e('Number of posts to show:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('totalpartner'); ?>"  id="<?php echo $this->get_field_id('totalpartner'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totalpartner == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>	
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SF_Widget_Partner");'));


/* Widget: Schoolfun Team Widget */

class SF_Widget_Team extends WP_Widget {

	function SF_Widget_Team() {
		$widgets_opt = array('description'=>__('Widget to show latest team	.','schoolfun'));
		parent::WP_Widget(false,$name= "Schoolfun Team Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$totalteam = apply_filters( 'widget_totalteam', $instance['totalteam'], $instance );
		$orderbyteam = apply_filters( 'widget_orderbyteam', $instance['orderbyteam'], $instance );
		$textbutton = apply_filters( 'widget_textbutton', $instance['textbutton'], $instance );
		$pageid = apply_filters('pageid', $instance['pageid'], $instance);
		if ($orderbyteam == 'Oldest') :
			$r = new WP_Query(array('post_type' => 'team', 'order' => 'ASC', 'showposts' => $totalteam, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
		else :
			$r = new WP_Query(array('post_type' => 'team', 'order' => 'DESC', 'showposts' => $totalteam, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
		endif;		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
		if ($r->have_posts()) :
		echo "<ul class=\"menu team-sidebar\">";
		while ($r->have_posts()) : $r->the_post(); ?>
			<?php
			$custom = get_post_custom(isset($post->ID));
			$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'team-thumb-widget' );
			$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'team-thumb-widget-retina' );		
			$position = isset($custom["position"][0]) ? $custom["position"][0] : false;
			$twitter_url = isset($custom["twitter_url"][0]) ? $custom["twitter_url"][0] : false;
			$linkedin_url = isset($custom["linkedin_url"][0]) ? $custom["linkedin_url"][0] : false;
			$facebook_url = isset($custom["facebook_url"][0]) ? $custom["facebook_url"][0] : false;
			$gplus_url = isset($custom["gplus_url"][0]) ? $custom["gplus_url"][0] : false;
			$email_team = isset($custom["email_team"][0]) ? $custom["email_team"][0] : false;
			?>
					<li class="clearfix">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink();?>"><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" class="imgframe alignleft" ></a>
							<?php endif;?>
						<div class="team-sidebar-content">
							<a href="<?php the_permalink();?>"><h4><?php the_title();?></h4></a>
							<?php if ($position <> ''): ?><h5><?php echo $position ?></h5><?php endif;?>
							<?php if ( ($twitter_url<>'') || ($linkedin_url<>'') || ($facebook_url<>'') || ($gplus_url<>'')): ?>
							<p class="team-sidebar-social">
							<?php
							if ($twitter_url<>'') : ?>
								<a href="<?php echo $twitter_url ?>" class="icon-twitter-team">Twitter</a>
							<?php endif; ?>
							<?php
							if ($linkedin_url<>'') : ?>
								<a href="<?php echo $linkedin_url ?>" class="icon-linkedin-team">Linkedin</a>
							<?php endif; ?>
							<?php
							if ($facebook_url<>'') : ?>
								<a href="<?php echo $facebook_url ?>" class="icon-facebook-team">Facebook</a>
							<?php endif; ?>
							<?php
							if ($gplus_url<>'') : ?>
								<a href="<?php echo $gplus_url ?>" class="icon-gplus-team">Google Plus</a>
							<?php endif; ?>
							</p>
							<?php endif;?>
						</div>
					</li>
		<?php endwhile; ?>
		</ul>
		<?php endif;
		if ( !empty( $textbutton ) ) : ?>
			<a href="<?php echo get_page_link($pageid);?>" class="button-more"><?php echo $textbutton; ?></a>
		<?php endif; ?>
		<?php
		echo $after_widget;
		// Reset the global $the_post as this query will have stomped on it
		

		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['totalteam'] = strip_tags($new_instance['totalteam']);
		$instance['orderbyteam'] = strip_tags($new_instance['orderbyteam']);
		$instance['textbutton'] = strip_tags($new_instance['textbutton']);
		$instance['pageid'] = strip_tags($new_instance['pageid']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'totalteam' => '', 'orderbyteam' => '', 'pageid' => '' ) );
		$title = strip_tags($instance['title']);
		$totalteam = strip_tags($instance['totalteam']);
		$orderbyteam = strip_tags($instance['orderbyteam']);
		$textbutton = strip_tags($instance['textbutton']);
		$pageid = strip_tags($instance['pageid']);
		
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
		
		$totalteam = (int)($instance['totalteam']);
		if ( $totalteam < 1 || 10 < $totalteam )
			$totalteam  = 3;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('totalteam'); ?>"><?php _e('Number of team to show:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('totalteam'); ?>"  id="<?php echo $this->get_field_id('totalteam'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totalteam == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_name('orderbyteam'); ?>"><?php _e('Order by:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('orderbyteam'); ?>"  id="<?php echo $this->get_field_id('orderbyteam'); ?>" class="widefat" >
		<?php
			echo "<option value='Newest' " . ( $orderbyteam == 'Newest' ? "selected='selected'" : '' ) . ">Newest</option>";
			echo "<option value='Oldest' " . ( $orderbyteam == 'Oldest' ? "selected='selected'" : '' ) . ">Oldest</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_id('textbutton'); ?>"><?php _e('Text for Button:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('textbutton'); ?>" name="<?php echo $this->get_field_name('textbutton'); ?>" type="text" value="<?php echo esc_attr($textbutton); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('pageid'); ?>"><?php _e('Link goes to:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" class="widefat" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SF_Widget_Team");'));


/* Widget: Schoolfun Latest Gallery */

class SF_Widget_Gallery extends WP_Widget {

	function SF_Widget_Gallery() {
		$widgets_opt = array('description'=>__('Widget to show latest gallery.','schoolfun'));
		parent::WP_Widget(false,$name= "Schoolfun Latest Gallery",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$totalgallery = apply_filters( 'widget_totalgallery', $instance['totalgallery'], $instance );
		$displaygallery = apply_filters( 'widget_displaygallery', $instance['displaygallery'], $instance );		
		$gallerytype = apply_filters( 'widget_gallerytype', $instance['gallerytype'], $instance );
		$textbutton = apply_filters( 'widget_textbutton', $instance['textbutton'], $instance );
		$pageid = apply_filters('pageid', $instance['pageid'], $instance);
		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
		if ($displaygallery == 'Random') :
			$loop = new WP_Query(array('post_type' => 'gallery', 'orderby' => 'rand', 'showposts' => '1', 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
		?>
		
		<?php
		   $i=0;
			while ( $loop->have_posts() ) : $loop->the_post();
				$i++;
				$custom = get_post_custom($post->ID);
				$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-random-side' );
				$urlbig =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
				$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-random-side-retina' );		
        ?>
		
				<div id="<?php echo $args['widget_id'] ?>-random" class="random-portfolio clearfix">
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php echo $urlbig[0];?>" data-rel="prettyPhoto[ra-<?php echo $args['widget_id']; ?>]"><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" ></a>
				<?php endif;?>
				<h4><a href="<?php echo $urlbig[0];?>" data-rel="prettyPhoto[ra-<?php echo $args['widget_id']; ?>-random]"><?php the_title();?></a></h4>
				</div>
			
		<?php $i++; endwhile;?>
	
		<?php 
		else :
			$loop = new WP_Query(array('post_type' => 'gallery', 'order' => 'DESC', 'showposts' => $totalgallery, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
			if ($gallerytype=="Thumbnail"):
		?>
		<ul id="<?php echo $args['widget_id'] ?>-thumbnail" class="list-portfolio-sidebar clearfix">
        <?php $i=1;
		     while ( $loop->have_posts() ) : $loop->the_post();		
				$custom = get_post_custom($post->ID);
				$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-thumb-widget' );
				$urlbig =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
				$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-thumb-widget-retina' );
				?>
		<?php if ( has_post_thumbnail() ) : ?><li <?php if ($i % 3 == 0) echo "class='last'";?>><a href="<?php echo $urlbig[0];?>" data-rel="prettyPhoto[pp-<?php echo $args['widget_id'] ?>]-thumbnail"><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" /></a></li><?php endif;?>
		<?php
		     $i++; 
			 endwhile;?>
       </ul>
		<?php
		else :?>
            
		<script type="text/javascript">
				jQuery(document).ready(function($){
					$("#<?php echo $args['widget_id'] ?>-slide").flexslider({
						animation: "slide",
						animationLoop: false,
					    pauseOnAction: true
			        });
				});
				</script>
		<div id="<?php echo $args['widget_id'] ?>-slide" class="flexslider">
			<ul class="slides">
			<?php while ( $loop->have_posts() ) : $loop->the_post();		
				$custom = get_post_custom($post->ID);
				$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-slide-widget' );
				$urlbig =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
				$urlimageretina =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-slide-widget-retina' );
				?>
							<li>
								<div class="slides-image">
									<a href="<?php echo $urlbig[0];?>" data-rel="prettyPhoto[pp-<?php echo $args['widget_id'] ?>]"><img src="<?php echo $urlimage[0];?>" alt="<?php the_title();?>"  data-retina="<?php echo $urlimageretina[0];?>" /></a>
								</div><h4><a href="<?php echo $urlbig[0];?>" data-rel="prettyPhoto[pp-<?php echo $args['widget_id'] ?>-slide]"><?php the_title();?></a></h4>
							</li>
         
		<?php
		         endwhile; ?>
		    </ul>
        </div>
		<?php 
		endif;

		endif;
		?>
		<?php if ( !empty( $textbutton ) ) : ?>
			<a href="<?php echo get_page_link($pageid);?>" class="button-more"><?php echo $textbutton; ?></a>
		<?php endif; ?>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['totalgallery'] = strip_tags($new_instance['totalgallery']);
		$instance['displaygallery'] = strip_tags($new_instance['displaygallery']);
		$instance['gallerytype'] = strip_tags($new_instance['gallerytype']);
		$instance['textbutton'] = strip_tags($new_instance['textbutton']);
		$instance['pageid'] = strip_tags($new_instance['pageid']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'totalgallery' => '', 'orderbygallery' => '', 'pageid' => '' ) );
		$title = strip_tags($instance['title']);
		$totalgallery = strip_tags($instance['totalgallery']);
		$displaygallery = strip_tags($instance['displaygallery']);
		$gallerytype = strip_tags($instance['gallerytype']);
		$textbutton = strip_tags($instance['textbutton']);
		$pageid = strip_tags($instance['pageid']);
		
		
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('displaygallery'); ?>"><?php _e('Display gallery:','schoolfun');?></label>
		<select name="<?php echo $this->get_field_name('displaygallery'); ?>"  id="<?php echo $this->get_field_id('displaygallery'); ?>" class="widefat" >
		<?php
			echo "<option value='Random' " . ( $displaygallery == 'Random' ? "selected='selected'" : '' ) . ">Random</option>";
			echo "<option value='Latest' " . ( $displaygallery == 'Latest' ? "selected='selected'" : '' ) . ">Latest</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_name('totalgallery'); ?>"><?php _e('Number of gallery to show:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('totalgallery'); ?>"  id="<?php echo $this->get_field_id('totalgallery'); ?>" class="widefat" >
		<?php
		for ( $i = 3; $i <= 9; ++$i )
			echo "<option value='$i' " . ( $totalgallery == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_name('gallerytype'); ?>"><?php _e('Gallery type:','schoolfun');?></label>
		<select name="<?php echo $this->get_field_name('gallerytype'); ?>"  id="<?php echo $this->get_field_id('gallerytype'); ?>" class="widefat" >
		<?php
			echo "<option value='Thumbnail' " . ( $gallerytype == 'Thumbnail' ? "selected='selected'" : '' ) . ">Thumbnail</option>";
			echo "<option value='Slideshow' " . ( $gallerytype == 'Slideshow' ? "selected='selected'" : '' ) . ">Slideshow</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_id('textbutton'); ?>"><?php _e('Text for Button:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('textbutton'); ?>" name="<?php echo $this->get_field_name('textbutton'); ?>" type="text" value="<?php echo esc_attr($textbutton); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('pageid'); ?>"><?php _e('Link goes to:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" class="widefat" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SF_Widget_Gallery");'));

/* Widget: Schoolfun Tabs Widget */

class SF_Widget_Tabs extends WP_Widget {

	function SF_Widget_Tabs() {
		$widgets_opt = array('description'=>'Widget to display built in content using tabs.');
		parent::WP_Widget(false,$name= "Schoolfun Tabs Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$titletabs1 = apply_filters( 'widget_titletabs1', $instance['titletabs1'], $instance );
		$titletabs2 = apply_filters( 'widget_titletabs2', $instance['titletabs2'], $instance );
		$contenttabs1 = apply_filters( 'widget_contenttabs1', $instance['contenttabs1'], $instance );
		$contenttabs2 = apply_filters( 'widget_contenttabs2', $instance['contenttabs2'], $instance );
		$idtabs1 = apply_filters( 'widget_idtabs1', $instance['idtabs1'], $instance );
		$idtabs2 = apply_filters( 'widget_idtabs2', $instance['idtabs2'], $instance );
		$totalrecord = apply_filters( 'widget_totalrecord', $instance['totalrecord'], $instance );
		$totalrecord2 = apply_filters( 'widget_totalrecord2', $instance['totalrecord2'], $instance );
		
		echo $before_widget;
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#tabs-widget-<?php echo $args['widget_id']; ?>').tabs({ show: { effect: "fade", duration: 200 }, hide: { effect: "fade", duration: 500 } });
		});
		</script>
		<div id="tabs-widget-<?php echo $args['widget_id']; ?>">
		<ul class="tabs-widget">
			<li class="first-tabs"><a href="#panel1-<?php echo $args['widget_id']; ?>"><?php echo $titletabs1; ?></a></li>
			<li class="last-tabs"><a href="#panel2-<?php echo $args['widget_id']; ?>"><?php echo $titletabs2; ?></a></li>
		</ul>
		<div class="ui-tabs-panel" id="panel1-<?php echo $args['widget_id']; ?>">
			<?php if ($contenttabs1=="Random Testimonial") {
				$loop = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => 1, 'orderby' => 'rand' )); 
				while ( $loop->have_posts() ) : $loop->the_post(); 
			$custom = get_post_custom(isset($post->ID));
			$screenshot_url = isset($custom["screenshot_url"][0]) ? $custom["screenshot_url"][0] : false;
			$website_url_testimonial = isset($custom["website_url_testimonial"][0]) ? $custom["website_url_testimonial"][0] : false;
			$company_name = isset($custom["company_name"][0]) ? $custom["company_name"][0] : false;			
			$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'testimonial-widget' );
			$urlimageretina =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'testimonial-widget-retina' );
			?>
			<article class="text-widget">
<?php if ( has_post_thumbnail() ) : ?><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" class="imgframe alignleft testimonial" /><?php endif;?>
				<div class="testimonial-header">
   					<h4><?php the_title();?></h4>
					<?php if ($website_url_testimonial<>'') : ?>
						<h5><a href="<?php echo $website_url_testimonial ?>"><?php echo $company_name ?></a></h5>
					<?php else : ?>
						<h5><?php echo $company_name ?></h5>
					<?php endif; ?>
				</div>
				<blockquote><?php the_content() ?></blockquote>
			</article>			
		<?php endwhile;?>
			<?php if ( !empty( $textbutton ) ) : ?>
        	<a href="<?php echo get_page_link($pageid);?>" class="button-more"><?php echo $textbutton; ?></a>
			<?php endif; ?>
			<?php
			}
			if ($contenttabs1=="Latest News") {
				$r = new WP_Query(array('showposts' => $totalrecord, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
				if ($r->have_posts()) :
					if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
					echo "<ul class=\"menu news-sidebar\">";
					while ($r->have_posts()) : $r->the_post(); 
					$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-widget' );
					$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-widget-retina' );
					?>
						<li class="clearfix">
							<?php if ( has_post_thumbnail() ) : ?><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" class="imgframe alignleft" /><?php endif;?>
							<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
							<span class="date-news"><?php the_time('F j, Y'); ?></span>
							<h5><?php comments_popup_link(__('No Comments','schoolfun'), __('1 Comment','schoolfun'), __(' % Comments','schoolfun'));?></h5>
						</li>
					<?php endwhile; ?>
				<?php endif; ?>
				</ul>
			<?php
			}
			if ($contenttabs1=="Random Gallery") { 
				$loop = new WP_Query(array('post_type' => 'gallery', 'posts_per_page' => 1, 'orderby' => 'rand', 'post_status' => 'publish' ));
			
		   $i=0;
			while ( $loop->have_posts() ) : $loop->the_post();
				$i++;
				$custom = get_post_custom($post->ID);
				$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-random-side' );
				$urlbig =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-big' );
				$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-random-side-retina' );		
        ?>
				<div id="<?php echo $args['widget_id'] ?>-random" class="random-portfolio">
				<?php if ( has_post_thumbnail() ) : ?>
					<img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" >
				<?php endif;?>
				<h4><a href="<?php echo $urlbig[0];?>" data-rel="prettyPhoto[pp-<?php echo $args['widget_id'] ?>-random]"><?php the_title();?></a></h4>
				</div>
			
		<?php $i++; endwhile;
	
			}
			if ($contenttabs1=="Latest Gallery") {
				$loop = new WP_Query(array('post_type' => 'gallery', 'order' => 'DESC', 'showposts' => $totalrecord, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
				?>
				<ul  id="<?php echo $args['widget_id'] ?>-thumbnail" class="list-portfolio-sidebar clearfix">
        <?php $i=1;
		     while ( $loop->have_posts() ) : $loop->the_post();		
				$custom = get_post_custom($post->ID);
				$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-thumb-widget' );
				$urlbig =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-big' );
				$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-thumb-widget-retina' );
				?>
		<?php if ( has_post_thumbnail() ) : ?><li <?php if ($i % 3 == 0) echo "class='last'";?>><a href="<?php echo $urlbig[0];?>" data-rel="prettyPhoto[pp-<?php echo $args['widget_id'] ?>]-thumbnail"><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" /></a></li><?php endif;?>
		<?php
		     $i++; 
			 endwhile;?>
       </ul>
			<?php
			}
			if ($contenttabs1=="Latest Flickr") {
				?>
				<div class="flickr">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $totalrecord;?>&amp;display=latest&amp;&amp;layout=h&amp;source=user&amp;user=<?php echo $idtabs1; ?>&amp;size=t"></script> 
				</div>				
				<?php
			}
			
			?>
		</div>
		<div class="ui-tabs-panel" id="panel2-<?php echo $args['widget_id']; ?>">
			<?php if ($contenttabs2=="Random Testimonial") {
				$loop = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => 1, 'orderby' => 'rand' )); 
				while ( $loop->have_posts() ) : $loop->the_post(); 
			$custom = get_post_custom(isset($post->ID));
			$screenshot_url = isset($custom["screenshot_url"][0]) ? $custom["screenshot_url"][0] : false;
			$website_url_testimonial = isset($custom["website_url_testimonial"][0]) ? $custom["website_url_testimonial"][0] : false;
			$company_name = isset($custom["company_name"][0]) ? $custom["company_name"][0] : false;			
			$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'testimonial-widget' );
			$urlimageretina =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'testimonial-widget-retina' );
            $star = isset($custom["star"][0]) ? $custom["star"][0] : false;
			?>	

			<article class="text-widget">
<?php if ( has_post_thumbnail() ) : ?><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" class="imgframe alignleft testimonial" /><?php endif;?>
				<div class="testimonial-header">
   					<h4><?php the_title();?></h4>
					<?php if ($website_url_testimonial<>'') : ?>
						<h5><a href="<?php echo $website_url_testimonial ?>"><?php echo $company_name ?></a></h5>
					<?php else : ?>
						<h5><?php echo $company_name ?></h5>
					<?php endif; ?>
					<?php if ($star<>''):?><span class="star rate<?php echo $star;?>"><?php _e('Rate','schoolfun');?>: <?php echo $star;?></span><?php endif;?>
				</div>
				<blockquote><?php the_content() ?></blockquote>
			</article>			
		<?php endwhile;?>
			<?php if ( !empty( $textbutton ) ) : ?>
        	<a href="<?php echo get_page_link($pageid);?>" class="button-more"><?php echo $textbutton; ?></a>
			<?php endif; ?>
			<?php
			}
			if ($contenttabs2=="Latest News") {
				$r = new WP_Query(array('showposts' => $totalrecord2, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
				if ($r->have_posts()) :
					if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
					echo "<ul class=\"menu news-sidebar\">";
					while ($r->have_posts()) : $r->the_post(); 
					$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-widget' );
					$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-widget-retina' );
					?>
						<li class="clearfix">
							<?php if ( has_post_thumbnail() ) : ?><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" class="imgframe alignleft" /><?php endif;?>
							<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
							<span class="date-news"><?php the_time('F j, Y'); ?></span>
							<h5><?php comments_popup_link(__('No Comments','schoolfun'), __('1 Comment','schoolfun'), __(' % Comments','schoolfun'));?></h5>
						</li>
					<?php endwhile; ?>
				<?php endif; ?>
				</ul>
			<?php
			}
			if ($contenttabs2=="Random Gallery") {
				$loop = new WP_Query(array('post_type' => 'gallery', 'posts_per_page' => 1, 'orderby' => 'rand', 'post_status' => 'publish' ));
				 $i=0;
			while ( $loop->have_posts() ) : $loop->the_post();
				$i++;
				$custom = get_post_custom($post->ID);
				$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-random-side' );
				$urlbig =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-big' );
				$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-random-side-retina' );		
        ?>
		
					<div id="<?php echo $args['widget_id'] ?>-random" class="random-portfolio">
				<?php if ( has_post_thumbnail() ) : ?>
					<img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" >
				<?php endif;?>
				<h4><a href="<?php echo $urlbig[0];?>" data-rel="prettyPhoto[pp-<?php echo $args['widget_id'] ?>-random]"><?php the_title();?></a></h4>
				</div>
			
		<?php $i++; endwhile;
	
			}
			if ($contenttabs2=="Latest Gallery") {
				$loop = new WP_Query(array('post_type' => 'gallery', 'order' => 'DESC', 'showposts' => $totalrecord2, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
				?>
				<ul  id="<?php echo $args['widget_id'] ?>-thumbnail" class="list-portfolio-sidebar clearfix">
        <?php $i=1;
		     while ( $loop->have_posts() ) : $loop->the_post();		
				$custom = get_post_custom($post->ID);
				$urlimage =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-thumb-widget' );
				$urlbig =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-big' );
				$urlimageretina = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'gallery-thumb-widget-retina' );
				?>
		<?php if ( has_post_thumbnail() ) : ?><li <?php if ($i % 3 == 0) echo "class='last'";?>><a href="<?php echo $urlbig[0];?>" data-rel="prettyPhoto[pp-<?php echo $args['widget_id'] ?>]-thumbnail"><img src="<?php echo $urlimage[0];?>" data-retina="<?php echo $urlimageretina[0];?>" alt="<?php the_title();?>" /></a></li><?php endif;?>
		<?php
		     $i++; 
			 endwhile;?>
       </ul>
			<?php
			}
			if ($contenttabs2=="Latest Flickr") {
				?>
				<div class="flickr">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $totalrecord2;?>&amp;display=latest&amp;&amp;layout=h&amp;source=user&amp;user=<?php echo $idtabs2; ?>&amp;size=t"></script> 
				</div>
				<?php
			}
			
			?>
		</div>
		<?php
		echo "</div>";?>
		<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['titletabs1'] = strip_tags($new_instance['titletabs1']);
		$instance['titletabs2'] = strip_tags($new_instance['titletabs2']);
		$instance['contenttabs1'] = strip_tags($new_instance['contenttabs1']);
		$instance['contenttabs2'] = strip_tags($new_instance['contenttabs2']);
		$instance['idtabs1'] = strip_tags($new_instance['idtabs1']);
		$instance['idtabs2'] = strip_tags($new_instance['idtabs2']);
		$instance['totalrecord'] = strip_tags($new_instance['totalrecord']);
		$instance['totalrecord2'] = strip_tags($new_instance['totalrecord2']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'titletabs1' => '', 'titletabs2' => '', 'contenttabs1' => '', 'contenttabs2' => '', 'idtabs1' => '', 'idtabs2' => '' ) );
		$titletabs1 = strip_tags($instance['titletabs1']);
		$titletabs2 = strip_tags($instance['titletabs2']);
		$contenttabs1= strip_tags($instance['contenttabs1']);
		$contenttabs2= strip_tags($instance['contenttabs2']);
		$idtabs1= strip_tags($instance['idtabs1']);
		$idtabs2= strip_tags($instance['idtabs2']);
		$totalrecord= strip_tags($instance['totalrecord']);
		$totalrecord2= strip_tags($instance['totalrecord2']);
		
?>
		<p><label for="<?php echo $this->get_field_id('titletabs1'); ?>"><?php _e('Title Tabs 1:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('titletabs1'); ?>" name="<?php echo $this->get_field_name('titletabs1'); ?>" type="text" value="<?php echo esc_attr($titletabs1); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_name('contenttabs1'); ?>">Content Tabs 1:</label>
		<select name="<?php echo $this->get_field_name('contenttabs1'); ?>"  id="<?php echo $this->get_field_id('contenttabs1'); ?>" class="widefat" >
		<?php
			echo "<option value='Random Testimonial' " . ( $contenttabs1 == 'Random Testimonial' ? "selected='selected'" : '' ) . ">Random Testimonial</option>";
			echo "<option value='Random Gallery' " . ( $contenttabs1 == 'Random Gallery' ? "selected='selected'" : '' ) . ">Random Gallery</option>";
			echo "<option value='Latest Gallery' " . ( $contenttabs1 == 'Latest Gallery' ? "selected='selected'" : '' ) . ">Latest Gallery</option>";
			echo "<option value='Latest News' " . ( $contenttabs1 == 'Latest News' ? "selected='selected'" : '' ) . ">Latest News</option>";
			echo "<option value='Latest Flickr' " . ( $contenttabs1 == 'Latest Flickr' ? "selected='selected'" : '' ) . ">Latest Flickr</option>";
			
		?>
		</select></p>
		
		<p><label for="<?php echo $this->get_field_id('idtabs1'); ?>"><?php _e('Flickr ID Tabs 1:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('idtabs1'); ?>" name="<?php echo $this->get_field_name('idtabs1'); ?>" type="text" value="<?php echo esc_attr($idtabs1); ?>" /></p>
		
        <p><label for="<?php echo $this->get_field_name('totalrecord'); ?>"><?php _e('Number of record to show:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('totalrecord'); ?>"  id="<?php echo $this->get_field_id('totalrecord'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totalrecord == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
		
		<p><label for="<?php echo $this->get_field_id('titletabs2'); ?>"><?php _e('Title Tabs 2:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('titletabs2'); ?>" name="<?php echo $this->get_field_name('titletabs2'); ?>" type="text" value="<?php echo esc_attr($titletabs2); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_name('contenttabs2'); ?>">Content Tabs 2:</label>
		<select name="<?php echo $this->get_field_name('contenttabs2'); ?>"  id="<?php echo $this->get_field_id('contenttabs2'); ?>" class="widefat" >
		<?php
			echo "<option value='Random Testimonial' " . ( $contenttabs2 == 'Random Testimonial' ? "selected='selected'" : '' ) . ">Random Testimonial</option>";
			echo "<option value='Random Gallery' " . ( $contenttabs2 == 'Random Gallery' ? "selected='selected'" : '' ) . ">Random Gallery</option>";
			echo "<option value='Latest Gallery' " . ( $contenttabs2 == 'Latest Gallery' ? "selected='selected'" : '' ) . ">Latest Gallery</option>";
			echo "<option value='Latest News' " . ( $contenttabs2 == 'Latest News' ? "selected='selected'" : '' ) . ">Latest News</option>";
			echo "<option value='Latest Flickr' " . ( $contenttabs2 == 'Latest Flickr' ? "selected='selected'" : '' ) . ">Latest Flickr</option>";			
		?>
		</select></p>
		
		<p><label for="<?php echo $this->get_field_id('idtabs2'); ?>"><?php _e('Flickr ID Tabs 2:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('idtabs2'); ?>" name="<?php echo $this->get_field_name('idtabs2'); ?>" type="text" value="<?php echo esc_attr($idtabs2); ?>" /></p>

		        <p><label for="<?php echo $this->get_field_name('totalrecord2'); ?>"><?php _e('Number of record to show:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('totalrecord2'); ?>"  id="<?php echo $this->get_field_id('totalrecord2'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totalrecord2 == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SF_Widget_Tabs");'));



/* Widget: Schoolfun Event Widget */

class SF_Widget_Event extends WP_Widget {

	function SF_Widget_Event() {
		$widgets_opt = array('description'=>__('Widget to show latest event.','schoolfun'));
		parent::WP_Widget(false,$name= "Schoolfun Event Widget",$widgets_opt);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$textbutton = apply_filters( 'widget_textbutton', $instance['textbutton'], $instance );
		$totalevent = apply_filters( 'widget_totalevent', $instance['totalevent'], $instance );
		$pageid = apply_filters('pageid', $instance['pageid'], $instance);
		global $wpdb;
		$querystr = "
    SELECT $wpdb->posts.* ,$wpdb->postmeta.meta_value as startdate
    FROM $wpdb->posts, $wpdb->postmeta
    WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
    AND $wpdb->postmeta.meta_key = 'startdate'  
    AND $wpdb->posts.post_status = 'publish' 
    AND $wpdb->posts.post_type = 'event'
	GROUP BY $wpdb->postmeta.meta_value
    ORDER BY $wpdb->postmeta.meta_value DESC Limit 0,$totalevent
 ";
//		$eventstartdate = $wpdb->get_results("select pm.meta_value as startdate from posts p join postmeta pm on p.ID = pm.post_id  where p.post_type = 'event'  and p.post_status = 'publish'  and pm.meta_key = 'startdate' group by pm.meta_value order by pm.meta_value DESC", OBJECT );
$eventstartdate = $wpdb->get_results($querystr, OBJECT);
	
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 		
    
		echo "<ul class=\"menu event-sidebar\">";
	 foreach($eventstartdate as $events) :		
		$date = date("d",strtotime($events->startdate));
		$month = date("M",strtotime($events->startdate));
		?>
								<li class="clearfix">
									<?php
									   $querystr1 = "
										SELECT wpposts.*, wpostmeta.meta_value as startdate, wpostmeta2.meta_value as enddate, wpostmeta3.meta_value as starttime, wpostmeta4.meta_value as endtime, wpostmeta5.meta_value as location
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
										ORDER BY wpostmeta.meta_value, wpostmeta3.meta_value ASC Limit 0,$totalevent
									 ";
									 $eventstartdate1 = $wpdb->get_results($querystr1, OBJECT);

										//$row = new WP_Query(array( 'meta_key'=> 'startdate', 'orderby'=>'meta_value', 'post_type'=>'event', 'post_status' => 'publish'));
		                                  
	                                  // $args1 = array(
										//	'post_type' => 'event',
										//	'meta_query' => array( array( 'key' => 'startdate', 'value' => $events->startdate,'compare' //=> '=='  ))); 
									  // $row = new WP_Query($args1);
										//if ($row->have_posts()) :
										?>
								        <div class="event-date-widget">
                                            <strong><?php echo $date;?></strong>
                                            <span><?php echo $month;?></span>
                                        </div>
									
                                        <div class="event-content-widget">
										<?php //while ($row->have_posts()) : $row->the_post(); 
											//$custom = get_post_custom(isset($post->ID));
											//$startdate = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false;	
											//$enddate = isset($custom["enddate"][0]) ? $custom["enddate"][0] : false;
											//$starttime = isset($custom["starttime"][0]) ? $custom["starttime"][0] : false;
											//$endtime = isset($custom["endtime"][0]) ? $custom["endtime"][0] : false;		
											//$location = isset($custom["location"][0]) ? $custom["location"][0] : false;?>
											
											<?php //if ($startdate == $events->startdate) :?>
											 <?php foreach($eventstartdate1 as $events1) :	
											 setup_postdata($events1);?>
                                            <article>
                                                <h4><a href="<?php echo get_permalink($events1->ID);?>"><?php echo $events1->post_title;?></a></h4>
                                                <p><?php echo date("F d, Y",strtotime($events1->startdate));?> <?php if ($events1->enddate <> '') : ?>- <?php echo date("F d, Y",strtotime($events1->enddate));?><?php endif;?><br />
                                                    <?php echo $events1->starttime;?> <?php if ($events1->endtime <> '') : ?>- <?php echo $events1->endtime;?><?php endif;?>
                                                </p>
                                                <?php if ($events1->location <> ''):?><em><?php echo $events1->location;?></em><?php endif;?>
                                            </article>   
											<?php endforeach;?>
                                            <?php //endif;?>
										<?php //endwhile;?>	
                                        </div>
										<?php //endif;?>
								    </li>                                   
		<?php endforeach; ?>
		</ul>
		<?php if ( !empty( $textbutton ) ) : ?>
			<a href="<?php echo get_page_link($pageid);?>" class="button-more"><?php echo $textbutton; ?></a>
		<?php endif; ?>
		<?php
		echo $after_widget;
		// Reset the global $the_post as this query will have stomped on it
	//	wp_reset_postdata();

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['textbutton'] = strip_tags($new_instance['textbutton']);
		$instance['totalevent'] = strip_tags($new_instance['totalevent']);
		$instance['pageid'] = strip_tags($new_instance['pageid']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'totalevent' => '', 'textbutton' =>'', 'pageid' => '' ) );
		$title = strip_tags($instance['title']);
		$textbutton = strip_tags($instance['textbutton']);
		$totalevent = strip_tags($instance['totalevent']);
		$pageid = strip_tags($instance['pageid']);
		
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
		
		$totalevent = (int)($instance['totalevent']);
		if ( $totalevent < 1 || 10 < $totalevent )
			$totalevent  = 3;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('totalevent'); ?>"><?php _e('Number of event to show:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('totalevent'); ?>"  id="<?php echo $this->get_field_id('totalevent'); ?>" class="widefat" >
		<?php
		for ( $i = 1; $i <= 10; ++$i )
			echo "<option value='$i' " . ( $totalevent == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_id('textbutton'); ?>"><?php _e('Text for Button:','schoolfun');?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('textbutton'); ?>" name="<?php echo $this->get_field_name('textbutton'); ?>" type="text" value="<?php echo esc_attr($textbutton); ?>" /></p>
		<p><label for="<?php echo $this->get_field_name('pageid'); ?>"><?php _e('Link goes to:','schoolfun');?></label>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>"  id="<?php echo $this->get_field_id('pageid'); ?>" class="widefat" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SF_Widget_Event");'));



?>