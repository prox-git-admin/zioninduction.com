<?php
/* Custom Post: Testimonial
=====================================================================*/

	add_action('init', 'sf_testimonial');
 
	function sf_testimonial() {
 
	$labels = array(
		'name' => 'Testimonial', 'post type general name',
		'singular_name' => 'Testimonial', 'post type singular name',
		'add_new' => 'Add New', 'testimonial',
		'add_new_item' => 'Add New Testimonial',
		'edit_item' => 'Edit Testimonial',
		'new_item' => 'New Testimonial',
		'view_item' => 'View Testimonial',
		'search_items' => 'Search Testimonial',
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
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'testimonial' , $args );
}

function testimonial_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $company_name = isset($custom["company_name"][0]) ? $custom["company_name"][0] : false;
  $website_url_testimonial = isset($custom["website_url_testimonial"][0]) ? $custom["website_url_testimonial"][0] : false;
  $star = isset($custom["star"][0]) ? $custom["star"][0] : false;
  ?>
  <p class="ct_custom_p"><label for="txtcompany"><?php _e("Company Name:","workchaos");?></label> <input type="text" name="company_name" value="<?php echo $company_name; ?>" id="txtcompany" /></p>
  <p class="ct_custom_p"><label for="txturl"><?php _e("Website URL:","workchaos");?></label> <input type="text" name="website_url_testimonial" value="<?php echo $website_url_testimonial; ?>" id="txturl" /></p>   
 
  <?php
}

add_action('save_post', 'save_testimonial');

function save_testimonial(){
	global $post;
  
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    	if (isset($post_id)) {
    		return $post_id;
    	}
 	
 	if(isset($_POST['company_name'])) {
  		update_post_meta($post->ID, "company_name", $_POST["company_name"]);
  	}
  	if(isset($_POST['website_url_testimonial'])) {
  		update_post_meta($post->ID, "website_url_testimonial", $_POST["website_url_testimonial"]);
  	}
   
}


add_action("manage_posts_custom_column",  "testimonial_custom_columns");
add_filter("manage_edit-testimonial_columns", "testimonial_edit_columns");
 
function testimonial_edit_columns($columnstestimonial){
  $columnstestimonial = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name",
    "company_name" => "Company Name",
    "website_url_testimonial" => "Website",
  );
 
  return $columnstestimonial;
}
function testimonial_custom_columns($columntestimonial){
  global $post;
 
  switch ($columntestimonial) {
    case "company_name":
      $custom = get_post_custom();
      echo $custom["company_name"][0];
      break;
    case "website_url_testimonial":
      $custom = get_post_custom();
      echo $custom["website_url_testimonial"][0];
      break;
    }
}
?>