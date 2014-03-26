<?php 
/*
Template Name: Front Page
*/
get_header();
$sf_banner_image = get_option('sf_banner_image');
$filebanner =  $sf_banner_image['file'];
$sf_banner_url = esc_attr(convert_smart_quotes(get_option('sf_banner_url')));
$sf_homepage_intro_title = esc_attr(convert_smart_quotes(get_option('sf_homepage_intro_title')));
$sf_homepage_intro_text = convert_smart_quotes(get_option('sf_homepage_intro_text'));
$sf_homepage_intro_url_text = esc_attr(convert_smart_quotes(get_option('sf_homepage_intro_url_text')));
$sf_homepage_intro_url = esc_attr(convert_smart_quotes(get_option('sf_homepage_intro_url')));
$sf_homepage_intro_image = get_option('sf_homepage_intro_image');
$fileintroimage = $sf_homepage_intro_image['file'];

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
 <?php get_template_part('slideshow');?>    
    <div id="content-container-home">
        <div id="content" class="clearfix">
           <?php if ($filebanner['url'] <> '' ) : ?>
			<div id="banner-homepage">
                <?php if ($sf_banner_url <> '') : ?><a href="<?php echo $sf_banner_url;?>"><img src="<?php echo $filebanner['url'];?>" alt="Banner" /></a>
				<?php else : ?>
					<img src="<?php echo $filebanner['url'];?>" alt="Banner" />
				<?php endif;?>
            </div>
			<?php endif;?>
            <div id="main-content">
			<?php if ($sf_homepage_intro_title <> '' ) : ?>
                <article id="intro">
                    <?php if ($sf_homepage_intro_title <> '' ) : ?><h1><?php echo $sf_homepage_intro_title;?></h1><?php endif;?>
                    <?php if ($fileintroimage['url'] <> '') : ?><figure><img src="<?php echo $fileintroimage['url'];?>" alt="<?php echo $sf_homepage_intro_title;?>" /></figure><?php endif;?>
                    <?php if ($sf_homepage_intro_text <> '') : ?><p><?php echo $sf_homepage_intro_text;?></p><?php endif;?>
                    <?php if ($sf_homepage_intro_url_text <> '') : ?>
						<?php if ($sf_homepage_intro_url <> '') : ?><a href="<?php echo $sf_homepage_intro_url;?>" class="more-intro">- <?php echo $sf_homepage_intro_url_text;?></a>
						<?php else :?>
						- <?php echo $sf_homepage_intro_url_text;?>
						<?php endif;?>
					<?php endif;?>
                </article>
				<?php endif;?>
                <div id="sidebar-homepage-left" class="sidebar-homepage">
				        <div class="widget-wrapper clearfix">
				        <?php if ( ! dynamic_sidebar( 'sidebar-homepage-left' ) ) : ?>					
						
				<?php endif;?>
				        </div>
                </div>
                <div id="sidebar-homepage-middle" class="sidebar-homepage">                    
				        <div class="widget-wrapper clearfix">
				        <?php if ( ! dynamic_sidebar( 'sidebar-homepage-middle' ) ) : ?>					
						
						<?php endif;?>
				        </div>
                </div>
            </div>			
          
  <div id="sidebar-homepage-right" class="sidebar-homepage">
             
                <?php if ( ! dynamic_sidebar( 'sidebar-homepage-right' ) ) : ?>					
						
						<?php endif;?>
            </div>	

		
            <article id="intro-principal" class="static-page">
                <?php if (($sf_welcome_intro_name <> '') || ($sf_welcome_intro_position <> '') ) : ?><h3 id="title-principal"><?php if ($sf_welcome_intro_name <> '') : ?><strong><?php echo $sf_welcome_intro_name;?><?php endif;?> <?php if ($sf_welcome_intro_position <> '') : ?>-<?php endif;?></strong> <?php if ($sf_welcome_intro_position <> '') : ?><?php echo $sf_welcome_intro_position;?><?php endif;?></h3><?php endif;?>
				<?php if ($filewelcome['url'] <> '') : ?>
                <figure>
                    <img src="<?php echo $filewelcome['url'];?>" data-retina="<?php echo $filewelcomeretina['url'];?>" alt="<?php echo $sf_welcome_name;?>" />
                </figure>
				<?php endif;?>
				<?php if ($sf_welcome_intro_text <> '') :?>
                <div id="content-principal">
                    <?php echo $sf_welcome_intro_text;?>
                    <?php if ($sf_welcome_intro_text_url <> '') : ?>
					<?php if ($sf_welcome_intro_url <> '') : ?>
					<a href="<?php echo $sf_welcome_intro_url;?>" class="more-intro">- <?php echo $sf_welcome_intro_text_url;?></a>
					<?php else:?>
					- <?php echo $sf_welcome_intro_text_url;?>
					<?php endif;?>
					<?php endif;?>
                </div>
				<?php endif;?>
            </article>
        </div>
    </div>
<?php get_footer();?>