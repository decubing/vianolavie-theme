<?php 
  
/**
 * Get title that is limited to 25 characters. 
 */
 
function vnv_limited_title($post_id){
  
  //Set title and length
  $title = wp_specialchars_decode(get_the_title($post_id));
  $length = 35;
  
  if(strlen($title) > $length ){
    $title = substr($title, 0, $length).' ...';
  }
  
  return $title;
   
}
  
?>