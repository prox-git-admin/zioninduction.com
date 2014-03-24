<?php 
/* Custom Post: Post FAQ
=====================================================================*/

	add_action('init', 'sf_faqs');
 
	function sf_faqs() {
 
	$labels = array(
		'name' => 'FAQ', 'post type general name',
		'singular_name' => 'FAQ', 'post type singular name',
		'add_new' => 'Add New', 'faq',
		'add_new_item' => 'Add New FAQ',
		'edit_item' => 'Edit FAQ',
		'new_item' => 'New FAQ',
		'view_item' => 'View FAQ',
		'search_items' => 'Search FAQ',
		'not_found' =>  'Nothing Found',
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
		'supports' => array('title','editor')
	  ); 
 
	register_post_type( 'faq' , $args );
}

function faqs_meta() {
  
}

add_action('save_post', 'save_faqs');

function save_faqs(){
	global $post;
  
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    	if (isset($post_id)) {
    		return $post_id;
    	}
 	
  	
}


add_action("manage_posts_custom_column",  "faqs_custom_columns");
add_filter("manage_edit-faqs_columns", "faqs_edit_columns");
 
function faqs_edit_columns($columnsfaq){
  $columnsfaq = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name"
  );
 
  return $columnsfaq;
}
function faqs_custom_columns($columnfaq){
 
}