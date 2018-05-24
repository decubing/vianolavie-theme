<?php 
  
/**
 * Get ACF 'badge' Field with post ID value
 */
 
function vnv_badge($post_id, $class = null){
    
  //Badge from ACF (Old Way of Creating Badges)
  if(get_field('badge', $post_id)){
    
    //ViaNola Badge
    if(get_field('badge', $post_id) == 'nolavie'){
      $badge_content = '<img alt="NolaVie" class="badge-image" src="'.get_template_directory_uri().'/images/badge-nolavie.svg">';
      
    //NolaVie Badge
    }elseif(get_field('badge', $post_id) == 'vianola'){
      $badge_content = '<img alt="ViaNola" class="badge-image" src="'.get_template_directory_uri().'/images/badge-vianola.svg">';

    //New Orleans Historical Badge
    }elseif(get_field('badge', $post_id) == 'new_orleans_historical'){
      $badge_content = '<img alt="New Orleans Historical" class="badge-image" src="'.get_template_directory_uri().'/images/badge-new_orleans_historical.png">';

    //CANO Badge
    }elseif(get_field('badge', $post_id) == 'cano-logo'){
      $badge_content = 'CANO';
    }
    
  //Badge taxonomy (New Way of Creating Badges)
  }elseif(wp_get_post_terms( $post_id, 'badge' )){
    
    //Set Badge Variables
    $badge_terms = wp_get_post_terms( $post_id, 'badge' );
    $badge_content = '';
    
    //Start Badge Loop
    foreach ($badge_terms as $badge){
      
      //Set Variables
      $badge_name = $badge->name;
      $badge_image_id = get_term_meta( $badge->term_id, 'image', true );
      $badge_src = wp_get_attachment_image_src( $badge_image_id, 'small')[0];
            
      //Badges with Images
      if($badge_src){
        $badge_content .= '<img alt="'.$badge_name.'" class="badge-image" src="'.$badge_src.'">';
        
      //Badges without Image
      }else{
        $badge_content = $badge_name;
      }
      
    }
    
  //Fallback    
  }else{
        $badge_content = null;
  }

  //Show Badge
  if($badge_content != null || $badge_content != '' )
    echo '<span class="badge '.$class.'">'.$badge_content.'</span>';      

}

//Make Badges Mandatory
add_action('admin_footer', function() {
?>
<script type="text/javascript">
  jQuery(document).ready(function ($) {
    
    //Require Badges
    if($('#badgediv').length){
      $('#publish').click(function(){
        if ($('#badgediv').find('input:checked').length > 0) {
          return true;
        } else {
          alert('No badges added. You must add one badge before publishing.');
          return false;
        }
      });
    }
    
  });
</script>
<?php
});
?>