<?php 
  
/**
 * Get title that is limited to 25 characters. 
 */
 
function get_limited_title($post_id){
  
  //Set title and length
  $title = get_the_title($post_id);
  $length = 35;
  
  if(strlen($title) > $length ){
    $title = substr(get_the_title($post_id), 0, $length).' ...';
  }
  
  return $title;
   
}
  
?>