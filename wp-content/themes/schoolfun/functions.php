<?php

//Load Localitation Path
load_theme_textdomain( 'schoolfun', get_template_directory() . '/languages' );

function schoolfun_add_javascripts() {

  wp_enqueue_script('jquery');
  wp_enqueue_script( 'tabs', get_template_directory_uri('template_directory') . '', array('jquery', 'jquery-ui-core', 'jquery-ui-tabs'), '1.0');
   wp_enqueue_script( 'jquery-effects-fade', get_template_directory_uri('template_directory') . '', array('jquery', 'jquery-effects-core', 'jquery-ui-tabs'), '1.0');
  wp_enqueue_script( 'jquery-ui-accordion', get_template_directory_uri('template_directory') . '', array('jquery', 'jquery-ui-core', 'jquery-ui-accordion'), '1.0');
   wp_enqueue_script( 'parallax', get_template_directory_uri('template_directory') . '/script/jquery.parallax-1.1.3.js', array( 'jquery' ) );
wp_enqueue_script( 'localscroll', get_template_directory_uri('template_directory') . '/script/jquery.localscroll-1.2.7-min.js', array( 'jquery' ) );
wp_enqueue_script( 'scrollTo', get_template_directory_uri('template_directory') . '/script/jquery.scrollTo-1.4.2-min.js', array( 'jquery' ) );
  wp_enqueue_script( 'prettyphoto', get_template_directory_uri('template_directory') . '/script/jquery.prettyPhoto.js', array( 'jquery' ) );
  wp_enqueue_script( 'flexslider', get_template_directory_uri('template_directory') . '/script/jquery.flexslider.js', array( 'jquery' ) );
  wp_enqueue_script( 'retina', get_template_directory_uri('template_directory') . '/script/jquery.retina.js', array( 'jquery' ) );
  wp_enqueue_script( 'validation', get_template_directory_uri('template_directory') . '/script/jquery.validate.js', array( 'jquery' ) );
wp_enqueue_script( 'modernizr', get_template_directory_uri('template_directory') . '/script/modernizr.js', array( 'jquery' ) );
  wp_enqueue_script( 'comment-reply' ); 
}
if (!is_admin()) {
  add_action( 'wp_print_scripts', 'schoolfun_add_javascripts' ); 
}
else {
  wp_enqueue_script('jquery-ui-core');
  wp_enqueue_script('jquery-ui-datepicker');
  wp_enqueue_script( 'jquery-ui-datepicker-validation', get_template_directory_uri('template_directory') . '/script/jquery.ui.datepicker.validation.js', array( 'jquery' ) );
}

function convert_smart_quotes($string) 
{ 
    $search = array("\'", 
                    '\"', 
                    ); 
 
    $replace = array("'", 
                     '"'); 
 
    return str_replace($search, $replace, $string); 
}
add_action( 'init', 'my_custom_menus' );

function my_custom_menus() {
	register_nav_menus(
		array(
			'main-navigation' => __('Main Navigation','schoolfun'),
     		'header-navigation' => __('Header Navigation','schoolfun'),
			'left-slider-navigation' => __('Slider Left Navigation','schoolfun'),
			'right-slider-navigation' => __('Slider Right Navigation','schoolfun'),
			'tab-bottom-navigation' => __('Tab Bottom Navigation','schoolfun'),
			'footer-navigation' => __('Footer Navigation','schoolfun')
		)
	);
}

/* Styling Password Form for Password Protected Post
=====================================================================*/

function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form id="form-password" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post"><p>';
	$o .= __('This post is password protected. To view it please enter your password below:','schoolfun');
	$o .= '</p><label class="pass-label" for="' . $label . '">Password:</label><input name="post_password" id="' . $label . '" type="password" class="input" />';
	$o .= '<input type="submit" name="Submit" class="button" value="' . esc_attr__( "Submit" ) . '" />
	</form>';
	return $o;
}

add_filter( 'the_password_form', 'custom_password_form' );


/* Comments & Pingback
=====================================================================*/
function schoolfun_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID(); ?>">
	<?php echo get_avatar( $comment, 64 ); ?>
	<article id="comment-<?php comment_ID(); ?>"  <?php comment_class('clearfix'); ?>>
		<header class="clearfix">
			<h3><?php comment_author_link(); ?> -</h3><time><?php comment_date();?> <?php comment_time(); ?></time>
		</header>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<p><em><?php _e( 'Your comment is awaiting moderation.', 'schoolfun' ); ?></em></p>
			<?php endif; ?>
			<div class="comment-wrapper">
			<?php comment_text(); ?>
			</div>
		<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</article><!-- #comment-##  -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'schoolfun' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'schoolfun'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}



remove_filter ('category_description', 'wptexturize');
remove_filter ('list_cats', 'wptexturize');
remove_filter ('comment_author', 'wptexturize');
remove_filter ('comment_text', 'wptexturize');
remove_filter ('the_title', 'wptexturize');
remove_filter ('the_content', 'wptexturize');
remove_filter ('the_excerpt', 'wptexturize');

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_length($length) {
	return 23;
}
add_filter('excerpt_length', 'new_excerpt_length');

add_theme_support( 'automatic-feed-links' );

if ( ! isset( $content_width ) )
	$content_width = 1115;


/* Post Format Wordpress 3.1
=====================================================================*/

add_theme_support( 'post-formats', array( 'quote', 'aside' ) );
add_post_type_support( 'blog', 'post-formats' );


/* Shortcodes
=====================================================================*/
function sfbutton($atts, $content = null) {
	extract(shortcode_atts(array(
		"href" => 'http://',
		"position" => 'alignleft'
	), $atts));
	return '<a href="'.$href.'" class="button '.$position.'">'.do_shortcode($content).'</a><div class="clear"></div>';
}
add_shortcode("button", "sfbutton");


function hhquote($atts, $content = null) {
	extract(shortcode_atts(array(
        "position" => 'fullsize'
	), $atts));
	return '<blockquote class="'.$position.'"><p>'.do_shortcode($content).'</p></blockquote>';
}
add_shortcode('quotes', 'hhquote');

function hhdropcap($atts, $content = null) {
	extract(shortcode_atts(array(
        "size" => 'medium'
	), $atts));
	return '<p><span class="dropcap '.$size.'">'.do_shortcode($content).'</span>';
}
add_shortcode('dropcap', 'hhdropcap');

function hhsep() {
    return '<div class="separator"></div>';
}
add_shortcode('separator', 'hhsep');

function hhseptop($atts, $content = null) {
    extract(shortcode_atts(array(
		"top" => 'Top'
	), $atts));
	return '<div class="separator"><a href="#">'.do_shortcode($content).'</a></div>';
}
add_shortcode('separatortop', 'hhseptop');

function hhcolumns($atts, $content = null) {
	extract(shortcode_atts(array(
		"width" => 'half',
		"last" => ''
	), $atts));
	if ($last==''):
		return '<div class="'.$width.'">'.do_shortcode($content).'</div>';
	elseif ($last=='true'):
		return '<div class="'.$width.' '.$last.'">'.do_shortcode($content).'</div><div class="clear"></div>';
	else:
		return '<div class="'.$width.'">'.do_shortcode($content).'</div>';
	endif;
}
add_shortcode("columns", "hhcolumns");

function reverse_categories($terms, $id, $taxonomy){
    if($taxonomy == 'category'){
        $terms = array_reverse($terms, true);
    }
    return $terms;
}
add_filter('get_the_terms', 'reverse_categories', 10, 3);


function the_breadcrumb() {
	global $post;
  $pages= get_pages();
  $count=0;
  $countevent=0;
  $countblog=0;
  $countgallery=0;
  foreach ($pages as $mypage) :
	  if (get_page_template_slug($mypage->ID)=="team-template.php") :
	   $count++;
       $teamID = $mypage->ID;
	   $teamName = $mypage->post_title;
	   elseif (get_page_template_slug($mypage->ID)=="event-template.php") :
	   $countevent++;
       $eventID = $mypage->ID;
	   $eventName = $mypage->post_title;
	    elseif (get_page_template_slug($mypage->ID)=="gallery-template.php") :
	   $countgallery++;
       $galID = $mypage->ID;
	   $galName = $mypage->post_title;
	   elseif (get_page_template_slug($mypage->ID)=="blog-template.php") :
	   $countblog++;
       $blogID = $mypage->ID;
	   $blogName = $mypage->post_title;
      endif;
  endforeach;

	if (!is_front_page()) {?>
		<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="<?php echo get_option('home');?>" itemprop="url" class="icon-home">
                    <span itemprop="title">Home</span>
            </a> <span class="arrow">&gt;</span>
        </div>  	
		<?php	if (is_singular("team")) :	?>
		<?php if ($count > 0) :?>
					<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo get_page_link( $teamID ); ?>" itemprop="url">
								<span itemprop="title"><?php echo get_the_title($teamID);?></span>
							</a> <span class="arrow">&gt;</span>
							<span class="last-breadcrumbs">
						   <?php echo $term->name;?>
							 </span>
					  </div>
		  <?php endif;
					  $args=array('orderby' => 'id', 'order'=> 'asc');
					  $terms = wp_get_post_terms($post->ID, "team-category", $args);
						  foreach ($terms as $term) : ?>
						 <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo get_term_link($term,$args);?>" itemprop="url">
								<span itemprop="title"><?php echo $term->name;?></span>
							</a> <span class="arrow">&gt;</span>
					  </div>
						<?php  endforeach;?>
						<span class="last-breadcrumbs">
						   <?php echo  get_the_title($post->ID);?>
							 </span>
		<?php	elseif (is_singular("event")) :	?>
		<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo get_page_link( $eventID ); ?>" itemprop="url">
								<span itemprop="title"><?php echo get_the_title($eventID);?></span>
							</a> <span class="arrow">&gt;</span>
							<span class="last-breadcrumbs">
						   <?php echo $term->name;?>
							 </span>
					  </div>
					
						<span class="last-breadcrumbs">
						   <?php echo  get_the_title($post->ID);?>
							 </span>	
			<?php  
		elseif (is_tax("gallery-category")) :
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );?>
			<?php if ($count > 0) :?>
					<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo get_page_link( $galID ); ?>" itemprop="url">
								<span itemprop="title"><?php echo get_the_title($galID);?></span>
							</a> <span class="arrow">&gt;</span>
							<span class="last-breadcrumbs">
						   <?php echo $term->name;?>
							 </span>
					  </div>
			<?php else:?>
					<span class="last-breadcrumbs">                 
							<?php echo $term->name;?>
					</span>
			<?php endif;
		elseif (is_tax("team-category")) :
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );?>
			<?php if ($count > 0) :?>
					<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="<?php echo get_page_link( $teamID ); ?>" itemprop="url">
								<span itemprop="title"><?php echo get_the_title($teamID);?></span>
							</a> <span class="arrow">&gt;</span>
							<span class="last-breadcrumbs">
						   <?php echo $term->name;?>
							 </span>
					  </div>
			<?php else:?>
					<span class="last-breadcrumbs">                 
							<?php echo $term->name;?>
					</span>
		<?php endif;?>				 
		<?php elseif (is_category() || is_single()) :?>
				
							<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<a href="<?php echo get_page_link( $blogID ); ?>" itemprop="url"><?php echo get_the_title($blogID);?></a>
							<span class="arrow">&gt;</span>
							</div>
					
					
					<?php if (is_single()) :?>
					 <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
						<?php the_category('<span class="arrow">&gt;</span> ',TRUE);?>
						<span class="arrow">&gt;</span>
					</div>
				   <?php endif;	?>
					<?php 
					if (is_category()) { ?>
					<span class="last-breadcrumbs">
                        <?php printf( __( 'Category Archives: %s', 'schoolfun' ), '' . single_tag_title( '', false ) . '' );?>
                    </span>
					<?php } elseif (is_single()) { ?>
					<span class="last-breadcrumbs">
                        <?php the_title();?>
                    </span>
				   <?php } ?>
        	<?php elseif (is_tag() ) :?>
			        <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<a href="<?php echo get_page_link( $blogID ); ?>" itemprop="url"><?php echo get_the_title($blogID);?></a>
							<span class="arrow">&gt;</span>
							</div>
					<span class="last-breadcrumbs">
                        <?php printf( __( 'Tag Archives: %s', 'schoolfun' ), '' . single_tag_title('',false) . '' );?>
                    </span>
			<?php elseif (is_archive() ) :?>	
			<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<a href="<?php echo get_page_link( $blogID ); ?>" itemprop="url"><?php echo get_the_title($blogID);?></a>
							<span class="arrow">&gt;</span>
							</div>
					<span class="last-breadcrumbs">
                      <?php if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'schoolfun' ), '' . get_the_date() . '' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'schoolfun' ), '' . get_the_date( _x( 'F Y', 'monthly archives date format', 'schoolfun' ) ) . '' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'schoolfun' ), '' . get_the_date( _x( 'Y', 'yearly archives date format', 'schoolfun' ) ) . '' );
					else :
						_e( 'Archives', 'schoolfun' );
					endif;
					?>
                    </span>		
			 <?php elseif (is_page()) :

			$mypages = get_pages('parent_of='.$post->ID.'&sort_column=post_date&sort_order=asc');
			//foreach($mypages as $page)
			//{   
				if( $post->post_parent > 0)  :
				?>
			 	 <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="<?php echo get_page_link( $post->post_parent ); ?>" itemprop="url">
                            <span itemprop="title"><?php echo get_the_title($post->post_parent);?></span>
                        </a> <span class="arrow">&gt;</span>
						<span class="last-breadcrumbs">
                        <?php the_title();?>
                    </span>
                  </div>
<?php           else  : ?>
						<span class="last-breadcrumbs">
                        <?php the_title();?>
                    </span>             			
		<?php	endif; ?>
		
		<?php elseif (is_404()): ?>
		   <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<a href="<?php echo get_page_link( $blogID ); ?>" itemprop="url"><?php echo get_the_title($blogID);?></a>
							<span class="arrow">&gt;</span>
							</div>
		<span class="last-breadcrumbs">                 
					<?php echo _x("Page not found","schoolfun");?>
				</span>		
		<?php elseif (is_search()): ?>
		   <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<a href="<?php echo get_page_link( $blogID ); ?>" itemprop="url"><?php echo get_the_title($blogID);?></a>
							<span class="arrow">&gt;</span>
							</div>
				<span class="last-breadcrumbs">                 
					<?php echo _x("Search","schoolfun");?>
				</span>
		<?php
		endif;		
	?>
	<?php }
	
	
}

/* schoolfun Settings
=====================================================================*/
$themename = "schoolfun";
$shortname = "sf";


$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 
//GENERAL SETTING
array( "name" => __('General','schoolfun'),
    "desc" => __("This is the general setting for your theme.","schoolfun"),
	"type" => "section"),
array( "type" => "open"),
array( "type" => "groupopen" ),
array( "name" => __("Colour Scheme","schoolfun"),
	"desc" => __("Select the colour scheme for your theme","schoolfun"),
	"id" => $shortname."_color_scheme",
	"type" => "select",
	"options" => array("Maroon", "Blue", "Green"),
	"std" => "Maroon"),
array( "type" => "imgopen"),
array( "name" => __("Custom Favicon","schoolfun"),
	"desc" => __("A favicon is <strong>16x16</strong> pixel icon that represents your site; Browse image with .ico or .png that you want to use as the favicon","schoolfun"),
	"id" => $shortname."_favicon",
	"type" => "__FILE__",
	"std" => ""),
	
array( "name" => __("Favicon","schoolfun"),
	"desc" => "",
	"id" => $shortname."_favicon",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),

array( "type" => "imgopen"),
array( "name" => __("Apple Touch Icon","schoolfun"),
	"desc" => __("An Apple Touch Icon is <strong>129x129</strong> pixel icon that represents your site; Browse image with .png that you want to use","schoolfun"),
	"id" => $shortname."_apple_touch_icon",
	"type" => "__FILE__",
	"std" => ""),
	
array( "name" => __("Apple Touch Icon","schoolfun"),
	"desc" => "",
	"id" => $shortname."_apple_touch_icon",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "type" => "groupclose"),


array( "type" => "groupopen", "odd"=>"odd"),
array( "type" => "imgopen"),
array( "name" => __("Logo URL","schoolfun"),
	"desc" => __("Browse your image for your image logo and the size of your image must be <strong>290x102</strong> pixel","schoolfun"),
	"id" => $shortname."_logo",
	"type" => "__FILE__",
	"std" => ""),


array( "name" => __("Logo","schoolfun"),
	"desc" => "",
	"id" => $shortname."_logo",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),

array( "type" => "imgopen"),
array( "name" => __("Logo (Retina) URL","schoolfun"),
	"desc" => __("Browse image for your retina image logo and the size must be <strong>580x204</strong> pixel. This logo will appear on retina display or HiDPI gadget.","schoolfun"),
	"id" => $shortname."_logo_retina",
	"type" => "__FILE__",
	"std" => ""),

array( "name" => __("Logo (Retina)","schoolfun"),
	"desc" => "",
	"id" => $shortname."_logo_retina",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),

array( "type" => "groupclose"),


array( "type" => "groupopen"),
array( "name" => __("Display Search Form","schoolfun"),
	"desc" => "This will display search form on header",
	"id" => $shortname."_search_form",
	"type" => "checkbox",
	"std" => "false"),
array( "name" => __("Slogan on header","schoolfun"),
	"desc" => "Display text slogan on header",
	"id" => $shortname."_slogan_header",
	"type" => "text",
	"std" => ""),
array( "name" => __("Registration Button Text","schoolfun"),
	"desc" => "Registration Button Text",
	"id" => $shortname."_reg_button_text",
	"type" => "text",
	"std" => ""),
array( "name" => __("Registration Button URL","schoolfun"),
	"desc" => "Registration Button URL",
	"id" => $shortname."_reg_button_url",
	"type" => "text",
	"std" => ""),
array( "type" => "groupclose"),


array( "type" => "groupopen", "odd"=>"odd"),

array( "name" => __("Sidebar Position","schoolfun"),
	"id" => $shortname."_sidebar",
	"type" => "select",
	"options" => array("Left", "Right"),
	"std" => "Right"),
array( "name" => __("Display Mobile Version","schoolfun"),
	"desc" => "",
	"id" => $shortname."_mobile",
	"type" => "checkbox",
	"std" => "false"),

array( "name" => __("Off Canvas Navigation","schoolfun"),
	"desc" => __("Off Canvas Navigation like Facebook or Google. You need to activate the mobile version to use it.","schoolfun"),
	"id" => $shortname."_offcanvas",
	"type" => "checkbox",
	"std" => "false"),
array( "type" => "groupclose" ),

array( "type" => "close"),
// END GENEREAL


// HOMEPAGE SETTING
array( "name" => __("Homepage","schoolfun"),
	  "desc" => __("This is setting for Homepage","schoolfun"),
	"type" => "section"),
array( "type" => "open"),

array( "type" => "groupopen" ),
array( "name" => __("Homepage Intro Title","schoolfun"),
	"desc" => __("Homepage Intro Title","schoolfun"),
	"id" => $shortname."_homepage_intro_title",
	"type" => "text",
	"std" => ""),
array( "name" => __("Homepage Intro Text","schoolfun"),
	"desc" => __("Only &lt;strong&gt;, &lt;em&gt;, &lt;u&gt; and &lt;a&gt; HTML code allowed.","schoolfun"),
	"id" => $shortname."_homepage_intro_text",
	"type" => "textarea",
	"std" => ""),
array( "name" => __("Homepage Intro URL Text","schoolfun"),
	"desc" => __("Homepage Intro URL Text","schoolfun"),
	"id" => $shortname."_homepage_intro_url_text",
	"type" => "text",
	"std" => ""),
array( "name" => __("Homepage Intro URL","schoolfun"),
	"desc" => __("Homepage Intro URL","schoolfun"),
	"id" => $shortname."_homepage_intro_url",
	"type" => "text",
	"std" => ""),
array( "type" => "imgopen"),
array( "name" => __("Homepage Intro Image","schoolfun"),
	"desc" => __("Browse image used for Homepage Intro image. Recommended image size is <strong>726x400</strong> pixel.","schoolfun"),
	"id" => $shortname."_homepage_intro_image",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Banner","schoolfun"),
	"desc" => "Browse image used for Homepage Banner. Recommended image size is <strong>1125x150</strong> pixel.",
	"id" => $shortname."_banner_image",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "type" => "groupclose" ),


array( "type" => "groupopen", "odd"=>"odd" ),
array( "type" => "imgopen"),
array( "name" => __("Banner","schoolfun"),
	"desc" => __("Image width no more than 550 pixel.","schoolfun"),
	"id" => $shortname."_banner_image",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Banner","schoolfun"),
	"desc" => "",
	"id" => $shortname."_banner_image",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("URL Banner","schoolfun"),
	"desc" => __("URL Banner","schoolfun"),
	"id" => $shortname."_banner_url",
	"type" => "text",
	"std" => ""),
array( "type" => "groupclose" ),

array( "type" => "groupopen" ),
array( "name" => __("Welcome Intro Name","schoolfun"),
	"desc" => __("","schoolfun"),
	"id" => $shortname."_welcome_intro_name",
	"type" => "text",
	"std" => ""),
array( "name" => __("Welcome Intro Position","schoolfun"),
	"desc" => __("","schoolfun"),
	"id" => $shortname."_welcome_intro_position",
	"type" => "text",
	"std" => ""),
array( "name" => __("Welcome Intro Text","schoolfun"),
	"desc" => __("HTML code allowed","schoolfun"),
	"id" => $shortname."_welcome_intro_text",
	"type" => "textarea",
	"std" => ""),
array( "name" => __("Welcome Intro Text URL","schoolfun"),
	"desc" => __("","schoolfun"),
	"id" => $shortname."_welcome_intro_text_url",
	"type" => "text",
	"std" => ""),
array( "name" => __("Welcome Intro URL","schoolfun"),
	"desc" => __("Welcome Intro URL","schoolfun"),
	"id" => $shortname."_welcome_intro_url",
	"type" => "text",
	"std" => ""),
array( "type" => "imgopen"),
array( "name" => __("Welcome Intro Image","schoolfun"),
	"desc" => __("Browse image used for Homepage Intro image. Recommended image size is <strong>322x433</strong> pixel.","schoolfun"),
	"id" => $shortname."_welcome_intro_image",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Welcome Intro Image","schoolfun"),
	"desc" => "",
	"id" => $shortname."_welcome_intro_image",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "type" => "imgopen"),
array( "name" => __("Welcome Intro Image (Retina)","schoolfun"),
	"desc" => __("Browse image used for Homepage Intro image. Recommended image size is <strong>644x866</strong> pixel. This image will appear on retina display or HiDPI gadget.","schoolfun"),
	"id" => $shortname."_welcome_intro_image_retina",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Welcome Intro Image (Retina)","schoolfun"),
	"desc" => "",
	"id" => $shortname."_welcome_intro_image_retina",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "type" => "groupclose" ),

array( "type" => "close"),
// END HOMEPAGE

// SLIDESHOW SETTING
array( "name" => __("Slideshow Homepage","schoolfun"),
	  "desc" => __("There are 5 images for slideshow. Recommended size is <strong>2000x620</strong> pixel","schoolfun"),
	"type" => "section"),
array( "type" => "open"),
array( "type" => "groupopen" ),
array( "name" => __("Type of Slideshow Tab 1","schoolfun"),
	"id" => $shortname."_type_slideshow_tab1",
	"type" => "select",
	"options" => array("Default", "News", "Event", "Menu Navigation"),
	"std" => "Default"),
array( "name" => __("Tabs 1 Title","schoolfun"),
	"desc" => "Tabs 1 title. Fill this title to activate Slide 1",
	"id" => $shortname."_tabs1_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Tabs 1 Subtitle","schoolfun"),
	"desc" => "Tabs 1 subtitle",
	"id" => $shortname."_tabs1_subtitle",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 1 Title","schoolfun"),
	"desc" => "Slide 1 title",
	"id" => $shortname."_slide1_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 1 Description","schoolfun"),
	"desc" => "Slide 1 description",
	"id" => $shortname."_slide1_description",	
	"type" => "textarea",
	"std" => ""),
array( "type" => "imgopen"),
array( "name" => __("Slide 1 Background","schoolfun"),
	"desc" => __("Browse image used for Background 1. Recommended image size is <strong>2000x620</strong> pixel.","schoolfun"),
	"id" => $shortname."_slide1_background",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Slide 1 Background","schoolfun"),
	"desc" => "",
	"id" => $shortname."_slide1_background",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Slide 1 URL","schoolfun"),
	"desc" => "Slide 1 URL",
	"id" => $shortname."_slide1_url",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 1 Text URL","schoolfun"),
	"desc" => "Slide 1 Text URL",
	"id" => $shortname."_slide1_texturl",	
	"type" => "text",
	"std" => ""),

array( "type" => "groupclose"),

array( "type" => "groupopen", "odd"=>"odd" ),
array( "name" => __("Type of Slideshow Tab 2","schoolfun"),
	"id" => $shortname."_type_slideshow_tab2",
	"type" => "select",
	"options" => array("Default", "News", "Event", "Menu Navigation"),
	"std" => "Default"),
array( "name" => __("Tabs 2 Title","schoolfun"),
	"desc" => "Tabs 2 title. Fill this title to activate Slide 2",
	"id" => $shortname."_tabs2_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Tabs 2 Subtitle","schoolfun"),
	"desc" => "Tabs 2 subtitle",
	"id" => $shortname."_tabs2_subtitle",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 2 Title","schoolfun"),
	"desc" => "Slide 2 title",
	"id" => $shortname."_slide2_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 2 Description","schoolfun"),
	"desc" => "Slide 2 description",
	"id" => $shortname."_slide2_description",	
	"type" => "textarea",
	"std" => ""),
array( "type" => "imgopen"),
array( "name" => __("Slide 2 Background","schoolfun"),
	"desc" => __("Browse image used for Background 2. Recommended image size is <strong>2000x620</strong> pixel.","schoolfun"),
	"id" => $shortname."_slide2_background",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Slide 2 Background","schoolfun"),
	"desc" => "",
	"id" => $shortname."_slide2_background",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Slide 2 URL","schoolfun"),
	"desc" => "Slide 2 URL",
	"id" => $shortname."_slide2_url",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 2 Text URL","schoolfun"),
	"desc" => "Slide 2 Text URL",
	"id" => $shortname."_slide2_texturl",	
	"type" => "text",
	"std" => ""),

array( "type" => "groupclose"),

array( "type" => "groupopen" ),
array( "name" => __("Type of Slideshow Tab 3","schoolfun"),
	"id" => $shortname."_type_slideshow_tab3",
	"type" => "select",
	"options" => array("Default", "News", "Event", "Menu Navigation"),
	"std" => "Default"),
array( "name" => __("Tabs 3 Title","schoolfun"),
	"desc" => "Tabs 3 title. Fill this title to activate Slide 3",
	"id" => $shortname."_tabs3_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Tabs 3 Subtitle","schoolfun"),
	"desc" => "Tabs 3 subtitle",
	"id" => $shortname."_tabs3_subtitle",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 3 Title","schoolfun"),
	"desc" => "Slide 3 title",
	"id" => $shortname."_slide3_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 3 Description","schoolfun"),
	"desc" => "Slide 3 description",
	"id" => $shortname."_slide3_description",	
	"type" => "textarea",
	"std" => ""),
array( "type" => "imgopen"),
array( "name" => __("Slide 3 Background","schoolfun"),
	"desc" => __("Browse image used for Background 3. Recommended image size is <strong>2000x620</strong> pixel.","schoolfun"),
	"id" => $shortname."_slide3_background",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Slide 3 Background","schoolfun"),
	"desc" => "",
	"id" => $shortname."_slide3_background",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Slide 3 URL","schoolfun"),
	"desc" => "Slide 3 URL",
	"id" => $shortname."_slide3_url",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 3 Text URL","schoolfun"),
	"desc" => "Slide 3 Text URL",
	"id" => $shortname."_slide3_texturl",	
	"type" => "text",
	"std" => ""),

array( "type" => "groupclose"),

array( "type" => "groupopen", "odd"=>"odd" ),
array( "name" => __("Type of Slideshow Tab 4","schoolfun"),
	"id" => $shortname."_type_slideshow_tab4",
	"type" => "select",
	"options" => array("Default", "News", "Event", "Menu Navigation"),
	"std" => "Default"),
array( "name" => __("Tabs 4 Title","schoolfun"),
	"desc" => "Tabs 4 title. Fill this title to activate Slide 4",
	"id" => $shortname."_tabs4_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Tabs 4 Subtitle","schoolfun"),
	"desc" => "Tabs 4 subtitle",
	"id" => $shortname."_tabs4_subtitle",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 4 Title","schoolfun"),
	"desc" => "Slide 4 title",
	"id" => $shortname."_slide4_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 4 Description","schoolfun"),
	"desc" => "Slide 4 description",
	"id" => $shortname."_slide4_description",	
	"type" => "textarea",
	"std" => ""),
array( "type" => "imgopen"),
array( "name" => __("Slide 4 Background","schoolfun"),
	"desc" => __("Browse image used for Background 4. Recommended image size is <strong>2000x620</strong> pixel.","schoolfun"),
	"id" => $shortname."_slide4_background",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Slide 4 Background","schoolfun"),
	"desc" => "",
	"id" => $shortname."_slide4_background",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Slide 4 URL","schoolfun"),
	"desc" => "Slide 4 URL",
	"id" => $shortname."_slide4_url",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 4 Text URL","schoolfun"),
	"desc" => "Slide 4 Text URL",
	"id" => $shortname."_slide4_texturl",	
	"type" => "text",
	"std" => ""),

array( "type" => "groupclose"),

array( "type" => "groupopen" ),
array( "name" => __("Type of Slideshow Tab 5","schoolfun"),
	"id" => $shortname."_type_slideshow_tab5",
	"type" => "select",
	"options" => array("Default", "News", "Event", "Menu Navigation"),
	"std" => "Default"),
array( "name" => __("Tabs 5 Title","schoolfun"),
	"desc" => "Tabs 5 title. Fill this title to activate Slide 5",
	"id" => $shortname."_tabs5_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Tabs 5 Subtitle","schoolfun"),
	"desc" => "Tabs 5 subtitle",
	"id" => $shortname."_tabs5_subtitle",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 5 Title","schoolfun"),
	"desc" => "Slide 5 title",
	"id" => $shortname."_slide5_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 5 Description","schoolfun"),
	"desc" => "Slide 5 description",
	"id" => $shortname."_slide5_description",	
	"type" => "textarea",
	"std" => ""),
array( "type" => "imgopen"),
array( "name" => __("Slide 5 Background","schoolfun"),
	"desc" => __("Browse image used for Background 5. Recommended image size is <strong>2000x620</strong> pixel.","schoolfun"),
	"id" => $shortname."_slide5_background",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Slide 5 Background","schoolfun"),
	"desc" => "",
	"id" => $shortname."_slide5_background",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Slide 5 URL","schoolfun"),
	"desc" => "Slide 5 URL",
	"id" => $shortname."_slide5_url",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Slide 5 Text URL","schoolfun"),
	"desc" => "Slide 5 Text URL",
	"id" => $shortname."_slide5_texturl",	
	"type" => "text",
	"std" => ""),

array( "type" => "groupclose"),

array( "type" => "close"),
// END SLIDESHOW

// QUICK NAVIGATION
array( "name" => __("Quick Navigation","schoolfun"),
	  "desc" => __("This is Setting for Quick Navigation on the Homepage","schoolfun"),
	"type" => "section"),
array( "type" => "open"),
array( "type" => "groupopen", "odd"=>"odd"),
array( "type" => "imgopen"),
array( "name" => __("Sidebar Icon 1","schoolfun"),
	"desc" => __("Browse image used for icon 1 and the size of your image must be <strong>92x92</strong> pixel.","schoolfun"),
	"id" => $shortname."_icon1",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Sidebar Icon 1","schoolfun"),
	"desc" => "",
	"id" => $shortname."_icon1",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Sidebar Title 1","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_title1",
	"type" => "text",
	"std" => ""),
array( "name" => __("Sidebar Text 1","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_text1",
	"type" => "textarea",
	"std" => ""),
array( "name" => __("Sidebar URL 1","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_url1",
	"type" => "text",
	"std" => ""),
array( "type" => "groupclose"),

array( "type" => "groupopen"),
array( "type" => "imgopen"),
array( "name" => __("Sidebar Icon 2","schoolfun"),
	"desc" => __("Browse image used for icon 2 and the size of your image must be <strong>92x92</strong> pixel.","schoolfun"),
	"id" => $shortname."_icon2",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Sidebar Icon 2","schoolfun"),
	"desc" => "",
	"id" => $shortname."_icon2",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Sidebar Title 2","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_title2",
	"type" => "text",
	"std" => ""),
array( "name" => __("Sidebar Text 2","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_text2",
	"type" => "textarea",
	"std" => ""),
array( "name" => __("Sidebar URL 2","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_url2",
	"type" => "text",
	"std" => ""),
array( "type" => "groupclose"),
array( "type" => "groupopen", "odd"=>"odd"),
array( "type" => "imgopen"),
array( "name" => __("Sidebar Icon 3","schoolfun"),
	"desc" => __("Browse image used for icon 3 and the size of your image must be <strong>92x92</strong> pixel.","schoolfun"),
	"id" => $shortname."_icon3",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Sidebar Icon 3","schoolfun"),
	"desc" => "",
	"id" => $shortname."_icon3",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Sidebar Title 3","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_title3",
	"type" => "text",
	"std" => ""),
array( "name" => __("Sidebar Text 3","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_text3",
	"type" => "textarea",
	"std" => ""),
array( "name" => __("Sidebar URL 3","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_url3",
	"type" => "text",
	"std" => ""),
array( "type" => "groupclose"),

array( "type" => "groupopen"),
array( "type" => "imgopen"),
array( "name" => __("Sidebar Icon 4","schoolfun"),
	"desc" => __("Browse image used for icon 4 and the size of your image must be <strong>92x92</strong> pixel.","schoolfun"),
	"id" => $shortname."_icon4",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Sidebar Icon 4","schoolfun"),
	"desc" => "",
	"id" => $shortname."_icon4",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Sidebar Title 4","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_title4",
	"type" => "text",
	"std" => ""),
array( "name" => __("Sidebar Text 4","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_text4",
	"type" => "textarea",
	"std" => ""),
array( "name" => __("Sidebar URL 4","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_url4",
	"type" => "text",
	"std" => ""),
array( "type" => "groupclose"),
array( "type" => "groupopen", "odd"=>"odd"),
array( "type" => "imgopen"),
array( "name" => __("Sidebar Icon 5","schoolfun"),
	"desc" => __("Browse image used for icon 5 and the size of your image must be <strong>92x92</strong> pixel.","schoolfun"),
	"id" => $shortname."_icon5",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Sidebar Icon 5","schoolfun"),
	"desc" => "",
	"id" => $shortname."_icon5",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Sidebar Title 5","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_title5",
	"type" => "text",
	"std" => ""),
array( "name" => __("Sidebar Text 5","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_text5",
	"type" => "textarea",
	"std" => ""),
array( "name" => __("Sidebar URL 5","schoolfun"),
	"desc" => "",
	"id" => $shortname."_sidebar_url5",
	"type" => "text",
	"std" => ""),
array( "type" => "groupclose"),
array( "type" => "close"),
// END QUICK NAVIGATION

// BOTTOM TABS SETTING
array( "name" => __("Bottom Tabs","schoolfun"),
	  "desc" => __("This is setting to show Tabs in the bottom of all page","schoolfun"),
	"type" => "section"),
array( "type" => "open"),
array( "type" => "groupopen" ),
array( "name" => __("Type of Tab 1","schoolfun"),
	"id" => $shortname."_type_tab_bottom1",
	"type" => "select",
	"options" => array("Quick Navigation", "Menu Navigation", "Text", "Partners"),
	"std" => "Text"),
array( "name" => __("Tab Bottom 1 Title","schoolfun"),
	"desc" => "Tab bottom 1 title. Fill this title to activate Tab bottom 1",
	"id" => $shortname."_tab_bottom1_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Tab Bottom 1 Description","schoolfun"),
	"desc" => "Tab Bottom 1 description",
	"id" => $shortname."_tab_bottom1_description",	
	"type" => "textarea",
	"std" => ""),
array( "type" => "groupclose" ),

array( "type" => "groupopen" ,"odd"=>"odd"),
array( "name" => __("Type of Tab 2","schoolfun"),
	"id" => $shortname."_type_tab_bottom2",
	"type" => "select",
	"options" => array("Quick Navigation", "Menu Navigation", "Text", "Partners"),
	"std" => "Text"),
array( "name" => __("Tab Bottom 2 Title","schoolfun"),
	"desc" => "Tab bottom 2 title. Fill this title to activate Tab bottom 2",
	"id" => $shortname."_tab_bottom2_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Tab Bottom 2 Description","schoolfun"),
	"desc" => "Tab Bottom 2 description",
	"id" => $shortname."_tab_bottom2_description",	
	"type" => "textarea",
	"std" => ""),
array( "type" => "groupclose" ),

array( "type" => "groupopen" ),
array( "name" => __("Type of Tab 3","schoolfun"),
	"id" => $shortname."_type_tab_bottom3",
	"type" => "select",
	"options" => array("Quick Navigation", "Menu Navigation", "Text", "Partners"),
	"std" => "Text"),
array( "name" => __("Tab Bottom 3 Title","schoolfun"),
	"desc" => "Tab bottom 3 title. Fill this title to activate Tab bottom 3",
	"id" => $shortname."_tab_bottom3_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Tab Bottom 3 Description","schoolfun"),
	"desc" => "Tab Bottom 3 description",
	"id" => $shortname."_tab_bottom3_description",	
	"type" => "textarea",
	"std" => ""),
array( "type" => "groupclose" ),

array( "type" => "groupopen" ,"odd"=>"odd"),
array( "name" => __("Type of Tab 4","schoolfun"),
	"id" => $shortname."_type_tab_bottom4",
	"type" => "select",
	"options" => array("Quick Navigation", "Menu Navigation", "Text", "Partners"),
	"std" => "Text"),
array( "name" => __("Tab Bottom 4 Title","schoolfun"),
	"desc" => "Tab bottom 4 title. Fill this title to activate Tab bottom 4",
	"id" => $shortname."_tab_bottom4_title",	
	"type" => "text",
	"std" => ""),
array( "name" => __("Tab Bottom 4 Description","schoolfun"),
	"desc" => "Tab Bottom 4 description",
	"id" => $shortname."_tab_bottom4_description",	
	"type" => "textarea",
	"std" => ""),
array( "type" => "groupclose" ),
array( "type" => "close"),
// END BOTTOM TABS

// CUSTOM POST SETTING
array( "name" => __("Custom Post","schoolfun"),
    "desc" => __("This is option for Custom Post (Team, Gallery and Testimonial).","schoolfun"),
	"type" => "section"),
array( "type" => "open"),
array( "type" => "groupopen" ),
array( "name" => __("Testimonial order by","schoolfun"),
	"desc" => "",
	"id" => $shortname."_testimonial_order",
	"type" => "select",
	"options" => array("Newest First", "Oldest First"),
	"std" => "Newest First"),
array( "name" => __("Gallery order by","schoolfun"),
	"desc" => "",
	"id" => $shortname."_gallery_order",
	"type" => "select",
	"options" => array("Newest First", "Oldest First"),
	"std" => "Newest First"),
array( "name" => __("Team order by","schoolfun"),
	"desc" => "",
	"id" => $shortname."_team_order",
	"type" => "select",
	"options" => array("Newest First", "Oldest First"),
	"std" => "Newest First"),

array( "name" => __("Facebook Like in Blog Post","schoolfun"),
	"desc" => "",
	"id" => $shortname."_blog_facebook",
	"group" => "group",
	"type" => "checkbox",
	"std" => "false"),

array( "name" => __("Tweet in Blog Post","schoolfun"),
	"desc" => "",
	"id" => $shortname."_blog_tweet",
	"group" => "group",
	"type" => "checkbox",
	"std" => "false"),

array( "name" => __("Google +1 in Blog Post","schoolfun"),
	"desc" => "",
	"id" => $shortname."_blog_plusone",
	"type" => "checkbox",
	"std" => "false"),

array( "type" => "groupclose" ),
array( "type" => "close"),


// END CUSTOM POST


// FOOTER SETTING
array( "name" => __("Footer","schoolfun"),
	  "desc" => __("Footer area.","schoolfun"),
	"type" => "section"),
array( "type" => "open"),
array( "type" => "groupopen"),
array( "name" => __("Footer Title","schoolfun"),
	"desc" => __("","schoolfun"),
	"id" => $shortname."_sub_footer_title",
	"type" => "text",
	"std" => ""),
array( "name" => __("Footer Text","schoolfun"),
	"desc" => __("","schoolfun"),
	"id" => $shortname."_sub_footer_text",
	"type" => "textarea",
	"std" => ""),
array( "type" => "imgclose"),


array( "type" => "groupopen","odd"=>"odd" ),
array( "name" => __("Copyright Text","schoolfun"),
	"desc" => "",
	"id" => $shortname."_footer_copyright",
	"type" => "text",
	"std" => ""),
array( "name" => __("Text Contact on Footer","schoolfun"),
		"desc" => __("Text contact on Footer","schoolfun"),
		"id" => $shortname."_text_contact_footer",
		"type" => "textarea",
		"std" => ""),
array( "type" => "groupclose" ),

array( "type" => "groupopen"),
array( "name" => __("Slogan on Footer","schoolfun"),
	"desc" => "",
	"id" => $shortname."_footer_slogan",
	"type" => "text",
	"std" => ""),
array( "type" => "imgopen"),
array( "name" => __("Background on Footer ","schoolfun"),
	"desc" => __("Browse image used for footer image. Recommended image size <strong>2000x620</strong> pixel.","schoolfun"),
	"id" => $shortname."_footer_bg",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Background on footer","schoolfun"),
	"desc" => "",
	"id" => $shortname."_footer_bg",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "type" => "imgopen"),
array( "name" => __("Logo Footer","schoolfun"),
	"desc" => __("Browse your image for your image logo and the size of your image must be <strong>200x60</strong> pixel","schoolfun"),
	"id" => $shortname."_logo_footer",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Logo Footer","schoolfun"),
	"desc" => "",
	"id" => $shortname."_logo_footer",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "type" => "imgopen"),
array( "name" => __("Logo (Retina) Footer","schoolfun"),
	"desc" => __("Browse image for your retina image logo and the size must be <strong>400x120</strong> pixel. This logo will appear on retina display or HiDPI gadget.","schoolfun"),
	"id" => $shortname."_logo_retina_footer",
	"type" => "__FILE__",
	"std" => ""),
array( "name" => __("Logo (Retina) Footer","schoolfun"),
	"desc" => "",
	"id" => $shortname."_logo_retina_footer",
	"type" => "remove",
	"std" => ""),
array( "type" => "imgclose"),
array( "name" => __("Logo Footer URL","schoolfun"),
		"desc" => __("","schoolfun"),
		"id" => $shortname."_logo_footer_url",
		"type" => "text",
		"std" => ""),
array( "name" => __("Google Analytics Code","schoolfun"),
		"desc" => __("You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer","schoolfun"),
		"id" => $shortname."_ga_code",
		"type" => "textarea",
		"std" => ""),
array( "type" => "groupclose" ),

array( "type" => "close"),
// END FOOTER

// SOCIAL NETWORK SETTING
array( "name" => __('Social Network','schoolfun'),
    "desc" => __("This is the social network setting for your theme.","schoolfun"),
	"type" => "section"),
array( "type" => "open"),
array( "type" => "groupopen" ),
array( "name" => __("Facebook URL","schoolfun"),
	"desc" => "",
	"id" => $shortname."_facebook",
	"group" => "group",
	"type" => "text"),
array( "name" => __("Twitter URL","schoolfun"),
	"desc" => "",
	"id" => $shortname."_twitter",
	"group" => "group",
	"type" => "text"),
array( "name" => __("Linkedin URL","schoolfun"),
	"desc" => "",
	"id" => $shortname."_linkedin",
	"group" => "group",
	"type" => "text"),
array( "name" => __("Google+ URL","schoolfun"),
	"desc" => "",
	"id" => $shortname."_gplus",
	"group" => "group",
	"type" => "text"),
array( "name" => __("Youtube URL","schoolfun"),
	"desc" => "",
	"id" => $shortname."_youtube",
	"type" => "text"),
array( "name" => __("Flickr URL","schoolfun"),
	"desc" => "",
	"id" => $shortname."_flickr",
	"type" => "text"),
array( "type" => "groupclose"),

array( "type" => "close")

);


function schoolfun_add_admin() {
global $themename, $shortname, $options;
if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) )  {
	if ( 'save' == isset($_REQUEST['action']) && $_REQUEST['action'] ) {
		foreach ($options as $value) {
 			if (isset($value['id'])) {
 				if (isset($_REQUEST[ $value['id'] ])) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ] );
				}
			}
		}
 
		
		foreach ($options as $value) {	
		   
				if( $value['type'] == '__FILE__' )
				
				{  
					if ($_FILES[$value['id']]) {
						
						$newinput = array();
						$overrides = array('test_form' => false); 
						$file = wp_handle_upload($_FILES[$value['id']], $overrides);
        				$newinput['file'] = $file;
						if (isset($file['url']))
						update_option( $value['id'], $newinput );
						
					}	
					
				}
				elseif( $value['type'] == 'remove' ){
				if ($_POST['removeimage'.$value['id']]){ 
				   	$img = get_option($value['id']);
					$file = $img['file']; 
									
					$expl=explode('/', $file['url']);
					$count = count($expl);
					$year = $expl[$count-3];
					$mounth = $expl[$count-2];
					$filenames = $expl[$count-1];
					$filenameupload =ABSPATH."wp-content"."/uploads/".$year."/".$mounth."/".$filenames;
					if (file_exists($filenameupload))
					   $fileupload =ABSPATH."wp-content"."/uploads/".$year."/".$mounth."/".$filenames;
					else 
						$fileupload =ABSPATH."wp-content"."/uploads/".$filenames;
					if (($file['url']<>'') ){
		 			   //chmod($filenameupload,"777");
					   if (unlink($fileupload))
					   	delete_option( $value['id']);	
					   else _e('error deleting image','schoolfun');
					}				
				}	
				}
				elseif( isset( $_REQUEST[ $value['id'] ] ) )	
						
				{			
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  );						
				}
				else {
					delete_option( $value['id']);	
				}
				
		}
		$fragment=$_POST['fragment'];
		header("Location: admin.php?page=functions.php&saved=true&fragment=$fragment");
		die;

 	} else if ( 'reset' == isset($_REQUEST['action']) && $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
			delete_option( $value['id'] ); 
		}
 		header("Location: admin.php?page=functions.php&reset=true");
		die;

	}
}
 
add_theme_page(__('Theme Options','schoolfun'), __('Theme Options','schoolfun'), 'administrator', basename(__FILE__), 'schoolfun_admin');
}

function schoolfun_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
wp_enqueue_script('jquery'); 
wp_enqueue_script('jquery-ui-core'); 
wp_enqueue_script('jquery-ui-tabs'); 
wp_enqueue_style("tabs", $file_dir."/functions/jquery-ui.css", false, "1.0", "all");
}
function schoolfun_admin() { ?>
<script type="text/javascript">
   jQuery(document).ready(function() {
    jQuery("#tabs").tabs();
  });
  </script>
<?php 
global $themename, $shortname, $options;
$i=0;
 
if ( isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( isset($_REQUEST['reset']) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>
<div class="wrap ct_wrap">
<h2><?php echo ucwords($themename); ?> <?php _e('Settings','schoolfun');?></h2>
 <p><?php printf(__('To easily use the %s theme, you can use the menu below.','schoolfun'),$themename);?></p>
  <div id="tabs">
    <ul>
	<?php $x=0; foreach ($options as $value) {
		switch ( $value['type'] ) {
			case "section":
			   $x++;
			   if (isset($_GET['fragment'])) {
			   		$fragment=$_GET['fragment'];
			   }
			   ?>
			   
			   <li class="menusection <?php if ($fragment==$x): echo"ui-tabs-selected ui-tabs-active"; endif; ?>"><a href="#fragment-<?php echo $x;?>" onclick="document.getElementById('fragment-input').value= <?php echo $x ?>"><?php if (isset($_POST['fragment'])) { echo $_POST["fragment"]; } ?><?php echo $value['name']; ?></a></li>
			   <?php break;
		}
		}
	?>	
				    
	</ul>
<div class="ct_opts">
<form method="post" enctype="multipart/form-data" action="">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>


 
<?php break;
 
case "title":
?>


 
<?php break;
 
case 'text':
?>

<div class="ct_input ct_text <?php if (isset($value['group'])) {echo $value['group'];} ?>">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(htmlspecialchars(get_option( $value['id']), ENT_QUOTES  )); } else { if (isset($value['std'])) {echo $value['std'];} } ?>" />
 <small><?php if (isset($value['desc'])) {echo $value['desc'];} ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="ct_input ct_textarea <?php if (isset($value['group'])) {echo $value['group'];} ?>">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(htmlspecialchars(get_option( $value['id'])) ); } else { if (isset($value['std'])) {echo $value['std'];} } ?></textarea>
 <small><?php if (isset($value['desc'])) {echo $value['desc'];} ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="ct_input ct_select <?php if (isset($value['group'])) {echo $value['group'];} ?>">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php if (isset($value['desc'])) {echo $value['desc'];} ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="ct_input ct_checkbox <?php if (isset($value['group'])) {echo $value['group'];} ?>">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
<label for="<?php echo $value['id']; ?>" class="labelchk"><?php if (isset($value['labelchk'])) {echo $value['labelchk'];} ?></label>

	<small><?php if (isset($value['desc'])) {echo $value['desc'];} ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case '__FILE__':
$img = get_option($value['id']);$file = $img['file'];
?>
	 <div class="ct_input ct_upload <?php if (isset($value['group'])) {echo $value['group'];} else if (($file['url']<>'') ) {echo "group";} ?>">
	  
		<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label> 
		<span id="browser">		
		<input type="file" id="upload" name="<?php echo $value['id'] ?>" size="15" />				
		
		</span>	
		<small><?php echo $value['desc']; ?></small>
		<label for="<?php echo $value['id']; ?>">&nbsp;</label> 
		<span class="browser-admin">
		<input type="submit" id="submit" name="submit" class="saveupload button-primary"  value="<?php _e('Upload','schoolfun');?>"/>
		</span>
		<div class="clearfix"></div>  

	<br />	  				
		<?php 
		$img = get_option($value['id']);$file = $img['file']; 
		if (($file['url']<>'') ){
		?>
		<div id="imgholder">		
		<?php  echo "<img  src='{$file['url']}' />"; ?>
		</div>		 	
		<?php } ?>		
		
	</div>

<?php
break;
case 'remove':

	 
	  $img = get_option($value['id']);$file = $img['file']; 
		if (($file['url']<>'') ){
?>	<div class="ct_input ct_upload ct_remove"> 		
		 <span id="browser">
		<input type="submit" id="removeimage<?php echo $value['id']; ?>" name="removeimage<?php echo $value['id']; ?>"   value="<?php _e('Delete','schoolfun');?>"/>
		</span>		
		
		  			
</div>
<?php
}

break;
case 'section':

$i++;

?>
<div class="ct_options" id="fragment-<?php echo $i;?>">
				<p class="titlesection"><?php echo $value['desc']; ?></p>
				


 
<?php break;
 
 case 'groupopen':?>
  <div class="ct_groupopen <?php if (isset($value['odd'])) {echo $value['odd'];}?>">
<?php
break;
case 'groupclose':?>
  </div>
<?php
break;
case 'imgopen':?>
<div class="ct_imgopen">
<?php
break;
case 'imgclose':?>
</div>
<?php
break;
}
}
?>
 
<span class="savechanges"><input name="save<?php echo $i; ?>" type="submit" value="Save Changes" class="button-primary" />
			    </span><br />
	<input type="hidden" name="action" value="save" />
	<input type="hidden" name="fragment" value="<?php echo $fragment ?>" id="fragment-input" />
	</form>
 	</div>
	</ul>
  </div>
</div>

<?php
}
?>
<?php
add_action('admin_init', 'schoolfun_add_init');
add_action('admin_menu', 'schoolfun_add_admin');

/* End schoolfun Settings
=====================================================================*/


/* Call Custom Post 
======================================================================*/
require_once(get_template_directory()."/functions/custom-post/init.php");


/* Featured Images for Posts, Page, Testimonial, Team , Event , and Gallery
=====================================================================*/
add_theme_support( 'post-thumbnails', array( 'post', 'page', 'testimonial', 'gallery', 'team','history', 'event', 'partner') );


add_image_size( 'event-on-toptab', 190, 230, true );
add_image_size( 'event-on-toptab-retina', 380, 460, true );
add_image_size( 'event-sticky', 675, 295, true );
add_image_size( 'event-on-slide-one', 322, 140, true );
add_image_size( 'event-on-slide-one-retina', 644, 280, true );
add_image_size( 'event-on-slide-more', 250, 270, true );
add_image_size( 'event-on-slide-more-retina', 500, 540, true );
add_image_size( 'single-event', 270, 290, true );

add_image_size( 'partner-bottab', 163, 100, true );
add_image_size( 'partner-bottab-retina', 326, 200, true );

add_image_size( 'history-thumb', 228, 158, true );
add_image_size( 'history-thumb-retina', 456, 316, true );

add_image_size( 'team-thumb', 155, 155, true );
add_image_size( 'team-thumb-retina', 310, 310, true );
add_image_size( 'team-single', 180, 180, true );
add_image_size( 'team-single-retina', 360, 360, true );
add_image_size( 'team-thumb-widget', 65, 65, true );
add_image_size( 'team-thumb-widget-retina', 130, 130, true );

add_image_size( 'gallery-thumb', 160, 160, true );
add_image_size( 'gallery-thumb-retina', 320, 320, true );
add_image_size( 'gallery-slide-widget', 301, 195, true );
add_image_size( 'gallery-slide-widget-retina', 602, 390, true );
add_image_size( 'gallery-thumb-widget', 66, 66, true );
add_image_size( 'gallery-thumb-widget-retina', 132, 132, true );
add_image_size( 'gallery-random-side', 341, 240, true );
add_image_size( 'gallery-random-side-retina', 682, 480, true );

add_image_size( 'blog-thumb-widget', 123, 94, true );
add_image_size( 'blog-thumb-widget-retina', 246, 188, true );
add_image_size( 'blog-thumb', 342, 170, true );
add_image_size( 'blog-thumb-retina', 684, 340, true );
add_image_size( 'blog-detail-thumb', 351, 235, true );
add_image_size( 'blog-detail-thumb-retina', 702, 470, true );

add_image_size( 'testimonial-widget', 96, 96, true );
add_image_size( 'testimonial-widget-retina', 192, 192, true );
add_image_size( 'testimonial-thumb', 200, 280, true );
add_image_size( 'testimonial-thumb-retina', 400, 560, true );

/* Call Custom Widget
============================================================*/
require_once(get_template_directory()."/functions/widget/init.php");
?>