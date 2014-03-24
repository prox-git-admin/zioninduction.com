<?php
/* Custom Post: Gallery
=====================================================================*/

	add_action('init', 'sf_gallery');
 
	function sf_gallery() {
 
	$labels = array(
		'name' => 'Gallery', 'post type general name',
		'singular_name' => 'gallery', 'post type singular name',
		'add_new' => 'Add New', 'Gallery',
		'add_new_item' => 'Add New Gallery',
		'edit_item' => 'Edit Gallery',
		'new_item' => 'New Gallery',
		'view_item' => 'View Gallery',
		'search_items' => 'Search Gallery',
		'not_found' =>  'Nothing found',
		'not_found_in_trash' => 'Nothing found in Trash',
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'gallery' , $args );
}

function gallery_meta() {
  global $post;
 
}

add_action('save_post', 'save_gallery');

function save_gallery(){
	global $post;
  
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    	if (isset($post_id)) {
    		return $post_id;
    	}
 	
 
}


add_action("manage_posts_custom_column",  "gallery_custom_columns");
add_filter("manage_edit-gallery_columns", "gallery_edit_columns");
 
function gallery_edit_columns($columnsgallery){
  $columnsgallery = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Title"
  );
 
  return $columnsgallery;
}
function gallery_custom_columns($columngallery){
  global $post;
  
}

?>