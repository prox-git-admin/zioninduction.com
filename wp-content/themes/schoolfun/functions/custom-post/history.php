<?php
/* Custom Post: History
=====================================================================*/

add_action('init', 'sf_history');
 
	function sf_history() {
 
	$labels = array(
		'name' => 'History', 'post type general name',
		'singular_name' => 'history', 'post type singular name',
		'add_new' => 'Add New', 'history',
		'add_new_item' => 'Add New History',
		'edit_item' => 'Edit History',
		'new_item' => 'New History',
		'view_item' => 'View History',
		'search_items' => 'Search History',
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
 
	register_post_type( 'history' , $args );
}

function history_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $startdate = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false; 
  ?>
  <p class="ct_custom_p"><label for="txtstardate">Date</label><input class='date' type="text" id="startdate" name="startdate" value="<?php echo $startdate;?>"/> </p>
 
  
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#startdate').datepicker({
        dateFormat : 'yy-mm-dd'
    });	
});

</script>
  
 
  <?php
}

add_action('save_post', 'save_history');

function save_history(){
	global $post;
  
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    	if (isset($post_id)) {
    		return $post_id;
    	}
	if(isset($_POST['startdate'])) {
		update_post_meta($post->ID, "startdate", $_POST["startdate"]);
  	}	
}


add_action("manage_posts_custom_column",  "history_custom_columns");
add_filter("manage_edit-history_columns", "history_edit_columns");
 
function history_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name",
    "startdate" => "Date"
  );
 
  return $columns;
}
function history_custom_columns($column){
  global $post;
  

}
?>