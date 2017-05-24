<?php
   
//Remove Quick Edit
function remove_quick_edit( $actions ) {
  unset($actions['inline hide-if-no-js']);
  return $actions;
}

//Remove Publish Button
function remove_save_button(){   
 echo'<script>jQuery(document).ready(function($){$("#publish").remove();});</script>';
 
}

//Activate Restrictions for Non-Administrators 
if ( !current_user_can('manage_options') ) {
  add_filter('post_row_actions','remove_quick_edit',10,1);
  add_filter( 'bulk_actions-edit-post', '__return_empty_array' );
  add_action( 'admin_print_footer_scripts', 'remove_save_button' );
}

