<?php
/* Custom Post: Team
=====================================================================*/

add_action('init', 'sf_team');
 
	function sf_team() {
 
	$labels = array(
		'name' => 'Team', 'post type general name',
		'singular_name' => 'Team', 'post type singular name',
		'add_new' => 'Add New', 'team',
		'add_new_item' => 'Add New Team',
		'edit_item' => 'Edit Team',
		'new_item' => 'New Team',
		'view_item' => 'View Team',
		'search_items' => 'Search Team',
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
 
	register_post_type( 'team' , $args );
}

function team_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $position = isset($custom["position"][0]) ? $custom["position"][0] : false;
  $twitter_url = isset($custom["twitter_url"][0]) ? $custom["twitter_url"][0] : false;
  $linkedin_url = isset($custom["linkedin_url"][0]) ? $custom["linkedin_url"][0] : false;
  $facebook_url = isset($custom["facebook_url"][0]) ? $custom["facebook_url"][0] : false;
  $gplus_url = isset($custom["gplus_url"][0]) ? $custom["gplus_url"][0] : false;
  $email_team = isset($custom["email_team"][0]) ? $custom["email_team"][0] : false;
  ?>
  <p class="ct_custom_p"><label for="txtposition"><?php _e("Position:","workchaos");?></label> <input type="text" name="position" value="<?php echo $position; ?>" id="txtcompany" /></p>
  <p class="ct_custom_p"><label for="txttwitter"><?php _e("Twitter URL:","workchaos");?></label> <input type="text" name="twitter_url" value="<?php echo $twitter_url; ?>" id="txttwitter" /></p>
  <p class="ct_custom_p"><label for="txtlinkedin"><?php _e("Linkedin URL:","workchaos");?></label> <input type="text" name="linkedin_url" value="<?php echo $linkedin_url; ?>" id="txtlinkedin" /></p>
  <p class="ct_custom_p"><label for="txtfacebook"><?php _e("Facebook URL:","workchaos");?></label> <input type="text" name="facebook_url" value="<?php echo $facebook_url; ?>" id="txtfacebook" /></p>
  <p class="ct_custom_p"><label for="txtgplus"><?php _e("Google Plus URL:","workchaos");?></label> <input type="text" name="gplus_url" value="<?php echo $gplus_url; ?>" id="txtgplus" /></p>
  <p class="ct_custom_p"><label for="txtemail"><?php _e("Email address:","workchaos");?></label> <input type="text" name="email_team" value="<?php echo $email_team; ?>" id="txtemail" /></p>
 
  <?php
  
}

add_action('save_post', 'save_team');

function save_team(){
	global $post;
  
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    	if (isset($post_id)) {
    		return $post_id;
    	}
	if(isset($_POST['position'])) {
		update_post_meta($post->ID, "position", $_POST["position"]);
  		update_post_meta($post->ID, "twitter_url", $_POST["twitter_url"]);
  		update_post_meta($post->ID, "linkedin_url", $_POST["linkedin_url"]);
  		update_post_meta($post->ID, "facebook_url", $_POST["facebook_url"]);
  		update_post_meta($post->ID, "gplus_url", $_POST["gplus_url"]);
  		update_post_meta($post->ID, "email_team", $_POST["email_team"]);
  	}
}


add_action("manage_posts_custom_column",  "team_custom_columns");
add_filter("manage_edit-team_columns", "team_edit_columns");
 
function team_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name",
    "position" => "Position"
  );
 
  return $columns;
}
function team_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "position":
      $custom = get_post_custom();
      echo $custom["position"][0];
      break;
  }
}
?>