<?php 
  
/**
 * Get ACF 'badge' Field with post ID valu
 */
 
function get_badge($post_id, $class){
  if(get_field('badge', $post_id))
    echo '<span class="badge '.$class.' badge-'.get_field('badge', $post_id).'"></span>';
}
  
?>