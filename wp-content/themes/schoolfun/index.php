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
    <div id="content-container">
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
						<aside class="widget-container">
							<div class="widget-wrapper clearfix">
							<h3 class="widget-title">Search</h3>
							<?php get_search_form(); ?>
							</div>
						</aside>
				<?php endif;?>
				        </div>
                </div>
                <div id="sidebar-homepage-middle" class="sidebar-homepage">                    
				        <div class="widget-wrapper clearfix">
				        <?php if ( ! dynamic_sidebar( 'sidebar-homepage-middle' ) ) : ?>					
						<aside class="widget-container">
							<div class="widget-wrapper clearfix">
							<h3 class="widget-title">Search</h3>
							<?php get_search_form(); ?>
							</div>
						</aside>
						<?php endif;?>
				        </div>
                </div>
            </div>			
            <div id="sidebar-homepage-right" class="sidebar-homepage">
                <?php if ( ($sf_sidebar_title1 <> '' ) || ($sf_sidebar_title2 <> '' ) || ($sf_sidebar_title3 <> '' ) ) :?>
				<ul id="nav-sidebar" class="clearfix">
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
                <?php if ( ! dynamic_sidebar( 'sidebar-homepage-right' ) ) : ?>					
						<aside class="widget-container">
							<div class="widget-wrapper clearfix">
							<h3 class="widget-title">Search</h3>
							<?php get_search_form(); ?>
							</div>
						</aside>
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