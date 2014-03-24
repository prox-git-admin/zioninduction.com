<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8" />
	<title><?php
		global $page, $paged;
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'happyhealth' ), max( $paged, $page ) );
		?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />  
	<meta name="description" content="<?php if ( is_single() ) :
	    single_post_title('', true); 
	else :
	    bloginfo('name'); echo " - "; bloginfo('description');
	endif;
	?>" />	
	<style type="text/css" media="all">@import "<?php bloginfo( 'stylesheet_url' ); ?>";</style>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/style-custom.css" media="screen" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style/prettyPhoto.css" />
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,700,300,900' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Nunito:400,300,700' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700' rel='stylesheet' type='text/css' />	
	<?php if ( get_option('sf_color_scheme') == 'Blue'): ?>
		<style type="text/css" media="all">@import "<?php echo get_template_directory_uri(); ?>/style-blue.css";</style>
	<?php endif; ?>
	<?php if ( get_option('sf_color_scheme') == 'Green'): ?>
		<style type="text/css" media="all">@import "<?php echo get_template_directory_uri(); ?>/style-green.css";</style>
	<?php endif; ?>
	<?php  
	if ( get_option('sf_mobile') == 'true'): ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/stylemobile.css" />
	<?php endif;?>
		<?php  
	if ( (get_option('sf_mobile') == 'true') && ( get_option('sf_offcanvas') == 'true') ): ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/mobilenavigation.css" />
    <?php endif;?>
	<?php   
	 $options = get_option("sf_favicon");
	 $file = $options['file']; 
	 $options1 = get_option("sf_apple_touch_icon");
	 $filetouchicon = $options1['file'];
	 $optionslogo = get_option("sf_logo");
	 $filelogo = $optionslogo['file'];
	 $optionslogoretina = get_option("sf_logo_retina");
	 $filelogoretina = $optionslogoretina['file'];		
	?>
	<?php if ($filelogo['url'] <> '') : 
			$src = $filelogo['url'];
         else : 
		    $src =  get_template_directory_uri()."/images/logo.png";
         endif;
          
		 if ($filelogoretina['url'] <> '') : 
			$srcretina = $filelogoretina['url'];
		 else : 
			$srcretina =  get_template_directory_uri()."/images/logo-retina.png";
		 endif;?>
		 <?php
     	  if ( get_option('sf_search_form') == ''):
		  $sf_search_form = 'false';
		  else :
		  $sf_search_form = get_option('sf_search_form');
          endif;
		 
 		  $sf_slogan_header = esc_attr(convert_smart_quotes(get_option('sf_slogan_header')));
     	  
		  if ( get_option('sf_reg_menu') == ''):
		  $sf_reg_menu = 'false';
		  else :
		  $sf_reg_menu = get_option('sf_reg_menu');
		  endif;

		  $sf_type_slideshow_tab1 = convert_smart_quotes(get_option('sf_type_slideshow_tab1'));
		  $sf_type_slideshow_tab2 = convert_smart_quotes(get_option('sf_type_slideshow_tab2'));
		  $sf_type_slideshow_tab3 = convert_smart_quotes(get_option('sf_type_slideshow_tab3'));
		  $sf_type_slideshow_tab4 = convert_smart_quotes(get_option('sf_type_slideshow_tab4'));
		  $sf_type_slideshow_tab5 = convert_smart_quotes(get_option('sf_type_slideshow_tab5'));

		 ?>
	<?php if ($file['url']<>'') : ?><link rel="shortcut icon" type="image/x-icon" href="<?php echo $file['url'];?>" /><?php endif;?>
	<?php if ($filetouchicon['url']<>'') : ?><link rel="apple-touch-icon-precomposed" href="<?php echo $filetouchicon['url'];?>" /><?php endif;?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php echo bloginfo( 'name' ); ?> RSS Feed" href="<?php echo bloginfo( 'rss2_url' ); ?>" />
	<?php wp_head();?>
	<script type="text/javascript">
	jQuery(document).ready(function ($){
        $(window).scroll(function () {
            if ($(document).scrollTop() <= 40) {
                $('#header-full').removeClass('small');
                $('.tabs-blur').removeClass('no-blur');
                $('#main-header').removeClass('small');
            } else {
                $('#header-full').addClass('small');
                $('.tabs-blur').addClass('no-blur');
                $('#main-header').addClass('small');
            }
        });

        $("a[data-rel^='prettyPhoto']").prettyPhoto({
			default_width: 600,
			default_height: 420,
			social_tools: false
		});
		$(".gallery-icon a").prettyPhoto({
			default_width: 600,
			default_height: 420,
			social_tools: false
		});
			$('a[data-rel]').each(function() {
			$(this).attr('rel', $(this).data('rel'));
		});
        $('#slideshow-tabs').tabs({ show: { effect: "fade", duration: 200 }, hide: { effect: "fade", duration: 300 } });
		  $('#tabs-content-bottom').tabs({ show: { effect: "fade", duration: 200 }, hide: { effect: "fade", duration: 300 } });
        $('.slider-tabs.flexslider').flexslider({
            animation: "slide",
            pauseOnAction: true,
        });		
		$('.slider-partners.flexslider').flexslider({
            animation: "slide",
            pauseOnAction: true,
            itemWidth: 163,
            itemMargin: 0
        });			
		
		$('#slider-news.flexslider').flexslider({
            animation: "slide",
            pauseOnAction: true
        });
			$('#form-comment').validate();
		$('a[data-rel]').each(function() {
			$(this).attr('rel', $(this).data('rel'));
		});
		 $('#slider-event.flexslider').flexslider({
            animation: "slide",
            pauseOnAction: true
        });
        $( ".accordion" ).accordion({
	        heightStyle: "content"
        });
		$('img[data-retina]').retina({checkIfImageExists: true});
		$(".open-menu").click(function(){
		    $("body").addClass("no-move");
		});
		$(".close-menu, .close-menu-big").click(function(){
		    $("body").removeClass("no-move");
		});
	});
	</script>
</head>
<body <?php if ( 'posts' == get_option( 'show_on_front' ) ) : body_class(); else: body_class('slideshow'); endif; ?>>
	<header id="main-header" class="clearfix">
        <div id="header-full" class="clearfix">
            <div id="header" class="clearfix">
                <a href="#nav" class="open-menu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				    <span class="icon-bar"></span>
				</a>
                <a href="<?php echo home_url(); ?>" id="logo"><img src="<?php echo $src;?>" data-retina="<?php echo $srcretina;?>" alt="<?php bloginfo('name'); ?>" /></a>
                <aside id="header-content" >
                    <?php if ($sf_search_form == "true") :?>
					  <form method="get" action="" id="searchform">
                        <div>
                            <input type="text" name="s" class="input" />
                            <input type="submit" class="button" value="Search" />
                        </div>
                    </form>
					<?php endif;?>
 		             <?php wp_nav_menu( array( 'theme_location' => 'header-navigation','container' => '', 'items_wrap' => '<ul id="nav-header">%3$s</ul>'  ) ); ?>
                    <?php if ($sf_slogan_header <> ''):?><h3 id="slogan"><?php echo $sf_slogan_header;?></h3><?php endif;?>
                </aside>
            </div>
        </div>
        <nav id="nav" class="clearfix">
                    <a href="#" class="close-menu-big">Close</a>
                    <div id="nav-container">
                        <a href="#" class="close-menu">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <?php wp_nav_menu( array( 'theme_location' => 'main-navigation','container' => '', 'items_wrap' => '<ul id="nav-main">%3$s</ul>'  ) ); ?>
                        <?php 
						$sf_reg_button_text = esc_attr(convert_smart_quotes(get_option('sf_reg_button_text')));
						$sf_reg_button_url = esc_attr(convert_smart_quotes(get_option('sf_reg_button_url')));
						if (($sf_reg_button_text <> '') || ($sf_reg_button_url <> '') ) :?><a href="<?php echo $sf_reg_button_url;?>" id="button-registration"><?php echo $sf_reg_button_text;?></a><?php endif;?>
                    </div>
                </nav>
    </header>