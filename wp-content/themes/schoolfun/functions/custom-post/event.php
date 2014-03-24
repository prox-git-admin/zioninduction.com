<?php
/* Custom Post: Event
=====================================================================*/

add_action('init', 'sf_event');
 
	function sf_event() {
 
	$labels = array(
		'name' => 'Event', 'post type general name',
		'singular_name' => 'event', 'post type singular name',
		'add_new' => 'Add New', 'event',
		'add_new_item' => 'Add New Event',
		'edit_item' => 'Edit Event',
		'new_item' => 'New Event',
		'view_item' => 'View Event',
		'search_items' => 'Search Event',
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
 
	register_post_type( 'event' , $args );
}

function event_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $startdate = isset($custom["startdate"][0]) ? $custom["startdate"][0] : false;
  $enddate = isset($custom["enddate"][0]) ? $custom["enddate"][0] : false;
  $starttime = isset($custom["starttime"][0]) ? $custom["starttime"][0] : false;
  $endtime = isset($custom["endtime"][0]) ? $custom["endtime"][0] : false;
  $location = isset($custom["location"][0]) ? $custom["location"][0] : false;
  $sticky =  isset($custom["sticky"][0]) ? $custom["sticky"][0] : false;
  ?>
  <p class="ct_custom_p"><label for="txtstardate"><?php echo _x("Start Date","schoolfun");?></label><input class='date' type="text" id="startdate" name="startdate" value="<?php echo $startdate;?>"/> </p>
  <p class="ct_custom_p"><label for="txtenddate"><?php echo _x("End Date","schoolfun");?></label><input class='date' type="text" id="enddate" name="enddate" value="<?php echo $enddate;?>"/></p> 
   <p class="ct_custom_p">
  <label for="txtstarttime"><?php echo _x("Start Time (hh:mm)","schoolfun");?></label>
  <input type="text" name="starttime" value="<?php echo $starttime;?>"> <?php echo _x("Use 24 hour format ( 21:00 = 09:00 pm )","schoolfun");?>
  </p>
  <p class="ct_custom_p">
  <label for="txtstarttime"><?php echo _x("End Time (hh:mm)","schoolfun");?> </label>
  <input type="text" name="endtime" value="<?php echo $endtime;?>"> <?php echo _x("Use 24 hour format ( 21:00 = 09:00 pm )","schoolfun");?>
  </p>
  <p class="ct_custom_p"><label for="txtlocation"><?php echo _x("Location","schoolfun");?></label><input type="text" id="location" name="location" value="<?php echo $location;?>"/></p> 
  <p class="ct_custom_p"><label for="txtsticky"><?php echo _x("Sticky Post","schoolfun");?> <?php echo $sticky;?></label><input type="checkbox" style="width:10px;" name="sticky" id="sticky" <?php checked( $sticky, 'on' ); ?> /><?php echo _x("Check this to show this event as slideshow","schoolfun");?></p>  
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#startdate').datepicker({
        dateFormat : 'yy-mm-dd',
	
beforeShow: customRange,
		showOn: "button",
      buttonImage: "<?php echo get_template_directory_uri('template_directory');?>/functions/images/calendar.gif",
      buttonImageOnly: true
    });
	jQuery('#enddate').datepicker({
        dateFormat : 'yy-mm-dd',
			beforeShow: customRange,

		showOn: "button",
      buttonImage: "<?php echo get_template_directory_uri('template_directory');?>/functions/images/calendar.gif",
      buttonImageOnly: true,

    });			
	
});
function customRange(input) {
  if (input.id == 'enddate') {
    return {
      minDate: jQuery('#startdate').datepicker("getDate")
    };
  } else if (input.id == 'startdate') {
    return {
      maxDate: jQuery('#enddate').datepicker("getDate")
    };
  }
}
</script>
  
 
  <?php
}

add_action('save_post', 'save_event');

function save_event(){
	global $post;
  
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    	if (isset($post_id)) {
    		return $post_id;
    	}
	if(isset($_POST['startdate'])) {
		update_post_meta($post->ID, "startdate", $_POST["startdate"]);
  	}
	if(isset($_POST['enddate'])) {
		update_post_meta($post->ID, "enddate", $_POST["enddate"]);
  	}
	if(isset($_POST['starttime'])) {
		update_post_meta($post->ID, "starttime", $_POST["starttime"]);
  	}
	if(isset($_POST['endtime'])) {
		update_post_meta($post->ID, "endtime", $_POST["endtime"]);
  	}
	if(isset($_POST['location'])) {
		update_post_meta($post->ID, "location", $_POST["location"]);
  	}	
	$sticky = isset( $_POST['sticky'] ) && $_POST['sticky'] ? 'on' : 'off';
	update_post_meta($post->ID, "sticky", $_POST["sticky"]);  
}


add_action("manage_posts_custom_column",  "event_custom_columns");
add_filter("manage_edit-event_columns", "event_edit_columns");
 
function event_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Name",
   "startdate" => "Start Date",
   "enddate" => "End Date",
    "starttime" => "Start Time",
    "endtime" => "End Time",
  );
 
  return $columns;
}
function event_custom_columns($column){
  global $post;
   switch ($column) {
    case "startdate":
      $custom = get_post_custom();
      echo $custom["startdate"][0];
      break;
	 case "enddate":
      $custom = get_post_custom();
      echo $custom["enddate"][0];
      break;
	 case "starttime":
      $custom = get_post_custom();
      echo $custom["starttime"][0];
      break;
     case "endtime":
      $custom = get_post_custom();
      echo $custom["endtime"][0];
      break;
	case "location":
      $custom = get_post_custom();
      echo $custom["location"][0];
      break;
	case "sticky":
      $custom = get_post_custom();
      echo $custom["sticky"][0];
      break;
  }
 

}
?>