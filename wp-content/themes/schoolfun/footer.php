  <?php 
   $sf_text_contact_footer = convert_smart_quotes(get_option('sf_text_contact_footer'));
   $sf_logo_footer_url =  esc_attr(convert_smart_quotes(get_option('sf_logo_footer_url')));
   $sf_footercopyright = convert_smart_quotes(get_option('sf_footer_copyright'));
   $logofooter = get_option("sf_logo_footer");
   $filelogofooter = $logofooter['file'];
   $logoretinafooter = get_option("sf_logo_retina_footer");
   $filelogoretinafooter = $logoretinafooter['file'];

   $sf_footer_bg = get_option('sf_footer_bg');
   $filefooterbg = $sf_footer_bg['file'];

   $sf_footer_slogan = convert_smart_quotes(get_option('sf_footer_slogan'));

   $sf_sub_footer_text = convert_smart_quotes(get_option('sf_sub_footer_text'));
   $sf_sub_footer_title = esc_attr(convert_smart_quotes(get_option('sf_sub_footer_title')));

   $sf_facebook = esc_attr(convert_smart_quotes(get_option('sf_facebook')));
   $sf_twitter= esc_attr(convert_smart_quotes(get_option('sf_twitter')));
   $sf_linkedin = esc_attr(convert_smart_quotes(get_option('sf_linkedin')));
   $sf_flickr = esc_attr(convert_smart_quotes(get_option('sf_flickr')));
   $sf_gplus = esc_attr(convert_smart_quotes(get_option('sf_gplus')));
   $sf_youtube = esc_attr(convert_smart_quotes(get_option('sf_youtube')));	

   ?>
  <footer id="main-footer" <?php if ($filefooterbg['url'] <> '' ) : ?>style="background:url(<?php echo $filefooterbg['url'];?>) no-repeat 50% 0;"<?php endif;?>>
        <div id="blur-top">
            <a href="#" id="link-back-top">Back to Top</a>
        </div>
		
        <div id="slogan-footer">
           <?php if ($sf_footer_slogan<>'') : ?>
           <h4><?php echo $sf_footer_slogan;?></h4>
		   <?php endif;?>
        </div>
		
        <div id="footer-content" class="clearfix">
            <div id="footer-container">
                <div id="sidebar-footer-left" class="sidebar-footer">
                     <?php if ( ! dynamic_sidebar( 'footer-left' ) ) : ?>					
						<aside class="widget-container">
							<div class="widget-wrapper clearfix">
							<h3 class="widget-title">Search</h3>
							<?php get_search_form(); ?>
							</div>
						</aside>
						<?php endif;?>
                </div>
                <div id="sidebar-footer-middle" class="sidebar-footer">
                     <?php if ( ! dynamic_sidebar( 'footer-middle' ) ) : ?>					
						<aside class="widget-container">
							<div class="widget-wrapper clearfix">
							<h3 class="widget-title">Search</h3>
							<?php get_search_form(); ?>
							</div>
						</aside>
						<?php endif;?>
                </div>
				<?php if (($sf_sub_footer_text <> '') || ($sf_sub_footer_title <> '') || ($sf_facebook<>'') || ($sf_twitter<>'') || ($sf_linkedin<>'') || ($sf_flickr<>'') || ($sf_gplus<>'') || ($sf_pinterest<>'') || ($sf_istagram<>'') ): ?>
                <article id="footer-address" class="clearfix">
				<?php if (($sf_sub_footer_text <> '') || ($sf_sub_footer_title <> '') ): ?>
                    <?php if ($sf_sub_footer_title <> ''): ?>
					<h3 id="title-footer-address"><span><?php echo $sf_sub_footer_title;?></span></h3>
					<?php endif;?>
                    <?php if ($sf_sub_footer_text <> '') : ?>
                    <?php echo $sf_sub_footer_text; ?>
					<?php endif;?>
                <?php endif;?>
				<?php if ( ($sf_facebook<>'') || ($sf_twitter<>'') || ($sf_linkedin<>'') || ($sf_flickr<>'') || ($sf_gplus<>'') || ($sf_pinterest<>'') || ($sf_istagram<>'') ) :?>
					<ul id="list-social" class="clearfix">
						<?php if ($sf_facebook<>'') : ?><li id="icon-facebook"><a href="<?php echo $sf_facebook;?>" >Facebook</a></li><?php endif;?>
						<?php if ($sf_twitter<>'') : ?><li id="icon-twitter"><a href="<?php echo $sf_twitter;?>" >Twitter</a></li><?php endif;?>
						<?php if ($sf_gplus<>'') : ?><li id="icon-gplus"><a href="<?php echo $sf_gplus;?>">Google Plus</a></li><?php endif;?>
						<?php if ($sf_linkedin<>'') : ?><li id="icon-linkedin"><a href="<?php echo $sf_linkedin;?>">Linkedin</a></li><?php endif;?>
						<?php if ($sf_youtube<>'') : ?><li id="icon-youtube"><a href="<?php echo $sf_youtube;?>">Youtube</a></li><?php endif;?>
						<?php if ($sf_flickr<>'') : ?><li id="icon-flickr" class="last"><a href="<?php echo $sf_flickr;?>">Flickr</a></li><?php endif;?>												
					</ul>
				 <?php endif;?>
                </article>
				<?php endif;?>
            </div>
        </div>
        <div id="footer-copyright">
            <div id="footer-copyright-content" class="clearfix">
				<?php if ($filelogofooter['url'] <> ''):?>
				       <?php if ($sf_logo_footer_url <> ''):?>
								<a href="<?php echo $sf_logo_footer_url; ?>" id="logo-footer"><img src="<?php echo $filelogofooter['url'];?>" <?php if($filelogoretinafooter['url']<>''):?>data-retina="<?php echo $filelogoretinafooter['url'];?>"<?php endif;?> alt="<?php bloginfo('name'); ?>" /></a>
                       <?php else: ?>
							   <img id="logo-footer" src="<?php echo $filelogofooter['url'];?>" <?php if($filelogoretinafooter['url']<>''):?>data-retina="<?php echo $filelogoretinafooter['url'];?>"<?php endif;?> alt="<?php bloginfo('name'); ?>" />
					   <?php endif;?>
				<?php endif;?>
                <?php if ($sf_text_contact_footer <> '' ): ?><p id="text-address"><?php echo $sf_text_contact_footer;?></p><?php endif;?>
                 <?php wp_nav_menu( array( 'theme_location' => 'footer-navigation','container' => '', 'items_wrap' => '<ul id="nav-footer">%3$s</ul>'  ) ); ?>
                <?php if ($sf_footercopyright <> ''):?><p id="text-copyright"><?php echo $sf_footercopyright;?></p><?php endif;?>
            </div>
        </div>
    </footer>
<?php
wp_footer(); 
$sf_ga_code = convert_smart_quotes(get_option('sf_ga_code'));
echo $sf_ga_code;
?>
</body>
</html>