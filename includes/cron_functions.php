<?php

//======================================================================
//Auto Archive Posts on Scheduled Date
//======================================================================
add_action(  'save_post',  'on_vianolavie_post_update', 10, 2 );
function on_vianolavie_post_update($post_id, $post ){
  
  global $wpdb;
  //Get Post ID
  $ID = $post_id;
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

//When Cron event fires, change post status
add_action( 'archive_post_event', 'archive_post', 10, 1  );
function archive_post($ID){
  $post_id = str_replace(array( '[', ']' ), '', $ID); //Remove array brackets to fire function
	$post_update_array = array(
    'ID' => $post_id,
    'post_status' => 'archived'
  );
  wp_update_post( $post_update_array);
}

?>