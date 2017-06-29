<?php
/**
** Remove From Homepage on Scheduled Date
**/

//Set Cron
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
  update_field('front_page_placement', null, $post_id);
}
add_action( 'archive_post_event', 'archive_post', 10, 1  );

?>