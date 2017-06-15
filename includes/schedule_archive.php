<?php
//Create "Archived" status  
function register_vnv_archived_status(){
	register_post_status( 'archived', array(
		'label'                     => 'Archived',
		'public'                    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Archived <span class="count">(%s)</span>', 'Archived <span class="count">(%s)</span>' ),
	) );
}
add_action( 'init', 'register_vnv_archived_status' );

// Add Archived Post Status to Post Dropdown
add_action('admin_footer-post.php', 'append_vnv_archived_status_to_list');
function append_vnv_archived_status_to_list(){
  global $post;
  $complete = '';
  $label = '';
    if($post->post_status == 'archived'){
      $complete = ' selected=\"selected\"';
      $label = '<span id=\"post-status-display\"> Archived</span>';
    }
    echo '
    <script>
    jQuery(document).ready(function($){
      $("select#post_status").append("<option value=\"archived\" '.$complete.'>Archived</option>");
      $(".misc-pub-section label").append("'.$label.'");
    });
    </script>
    ';
}

//Add Archived Post Status to Admin Posts lists
add_filter( 'display_post_states', 'display_vnv_archived_status' );
function display_vnv_archived_status( $states ) {
  global $post;
  $arg = get_query_var( 'post_status' );
  if($arg != 'archived'){
    if($post->post_status == 'archived'){
      return array('Archived');
    }
  }
  return $states;
}

//Add Archived Post Status to Bulk Edit
add_action( 'admin_footer-edit.php', 'add_vnv_archived_status_bulk_edit' );
function add_vnv_archived_status_bulk_edit() {
	echo '
	<script>
	jQuery(document).ready(function($){
	$(".inline-edit-status select ").append("<option value=\"archived\">Archived</option>");
	});
	</script>
	';
}  

//Set Archived Status on Scheduled Date
function on_vnv_post_update($post_id, $post ){
  global $wpdb;
  
  //Get Post ID
  $ID = $post_id;
  
  //Debugging Scripts
  //echo "<script type='text/javascript'>console.log('id: $ID');</script>";

  //Limit Function to Posts with relevant meta  
  if(get_post_meta($ID,'archive_date')){
    
    //Get Expiration Time
    $archive_date = strtotime(get_post_meta($ID,'archive_date',true));
      
    //Unschedule any existing events
    $timestamp = wp_next_scheduled( 'archive_post_event', array($ID) );
    wp_unschedule_event( $timestamp, 'archive_post_event', array($ID) );
        
    //Schedule Event Cron
    if($archive_date != null)
      wp_schedule_single_event( $archive_date, 'archive_post_event', array($ID) );
  }
}
add_action(  'save_post',  'on_vnv_post_update', 10, 2 );

//When Cron event fires, change post status
function archive_post($ID){
  $post_id = str_replace(array( '[', ']' ), '', $ID); //Remove array brackets to fire function
	$post_update_array = array(
    'ID' => $post_id,
    'post_status' => 'archived'
  );
  wp_update_post( $post_update_array);
}
add_action( 'archive_post_event', 'archive_post', 10, 1  );

?>