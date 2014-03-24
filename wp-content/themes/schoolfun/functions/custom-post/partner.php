<?php
/* Custom Post: Partner
=====================================================================*/

add_action('init', 'sf_partner');
 
	function sf_partner() {
 
	$labels = array(
		'name' => 'Partner', 'post type general name',
		'singular_name' => 'partner', 'post type singular name',
		'add_new' => 'Add New', 'partner',
		'add_new_item' => 'Add New Partner',
		'edit_item' => 'Edit Partner',
		'new_item' => 'New Partner',
		'view_item' => 'View Partner',
		'search_items' => 'Search Partner',
		'not_found' =>  'Nothing Found',
		'not_found_in_trash' => 'Nothing Found in Trash',
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
 
	register_post_type( 'partner' , $args );
}

function partner_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $url = isset($custom["url"][0]) ? $custom["url"][0] : false;
  ?>
  <p class="ct_custom_p"><label for="txturl">URL</label><input type="text" id="url" name="url" value="<?php echo $url;?>"/> </p>  
  <?php
}

add_action('save_post', 'save_partner');

function save_partner(){
	global $post;
  
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    	if (isset($post_id)) {
    		return $post_id;
    	}
	if(isset($_POST['url'])) {
		update_post_meta($post->ID, "url", $_POST["url"]);
  	}
}


add_action("manage_posts_custom_column",  "partner_custom_columns");
add_filter("manage_edit-partner_columns", "partner_edit_columns");
 
function partner_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name"
  ); 
  return $columns;
}

function partner_custom_columns($column){
  global $post;
   switch ($column) {
    case "url":
      $custom = get_post_custom();
      echo $custom["url"][0];
      break;
  }
 

}
?>