<?php 
  
/**
 * Get ACF 'badge' Field with post ID valu
 */
 
function get_badge($post_id){

 if(get_field('badge', $post_id))
   echo '<span class="badge badge-'.get_field('badge', $post_id).'"></span>';
 
}
  
?>