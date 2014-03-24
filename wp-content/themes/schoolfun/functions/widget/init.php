<?php
function schoolfun_widgets_init() {	
	register_sidebar( array(
		'name' => __( 'Homepage Left', 'schoolfun' ),
		'id' => 'sidebar-homepage-left',
		'description' => __( 'Homepage Left widget area', 'schoolfun' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s"><div class="widget-wrapper clearfix">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Homepage Middle', 'schoolfun' ),
		'id' => 'sidebar-homepage-middle',
		'description' => __( 'Homepage middle widget area', 'schoolfun' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s"><div class="widget-wrapper clearfix">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Homepage Right', 'schoolfun' ),
		'id' => 'sidebar-homepage-right',
		'description' => __( 'Homepage right widget area', 'schoolfun' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s"><div class="widget-wrapper clearfix">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Sidebar Pages', 'schoolfun' ),
		'id' => 'sidebar-pages',
		'description' => __( 'Sidebar pages widget area', 'schoolfun' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s"><div class="widget-wrapper clearfix">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar Blog Posts', 'schoolfun' ),
		'id' => 'sidebar-blog-posts',
		'description' => __( 'Sidebar blog posts widget area', 'schoolfun' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s"><div class="widget-wrapper clearfix">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Footer Left', 'schoolfun' ),
		'id' => 'footer-left',
		'description' => __( 'Footer left widget area', 'schoolfun' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s"><div class="widget-wrapper clearfix">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => __( 'Footer Middle', 'schoolfun' ),
		'id' => 'footer-middle',
		'description' => __( 'Footer middle widget area', 'schoolfun' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s"><div class="widget-wrapper clearfix">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	
}
add_action( 'widgets_init', 'schoolfun_widgets_init' );

get_template_part("functions/widget/widget");
?>