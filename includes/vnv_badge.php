<?php 
  
/**
 * Get ACF 'badge' Field with post ID value
 */
 
function vnv_badge($post_id, $class = null){
    
  if(get_field('badge', $post_id))
    echo '<span class="badge '.$class.' badge-'.get_field('badge', $post_id).'"></span>';
}
  
?>