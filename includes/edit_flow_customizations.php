<?php

/**
* Limit custom statuses based on user role
* In this example, we limit the statuses available to the
* 'contributor' user role
*
* @see http://editflow.org/extend/limit-custom-statuses-based-on-user-role/
*
* @param array $custom_statuses The existing custom status objects
* @return array $custom_statuses Our possibly modified set of custom statuses
*/
function efx_limit_custom_statuses_for_teachers( $custom_statuses ) {

  $current_user = wp_get_current_user();
  switch( $current_user->roles[0] ) {
    // Only allow a Teachers to access specific statuses from the dropdown
    case 'teacher':
      $permitted_statuses = array(
        'ready-for-editor',
        'draft',
        'pending',
      );
      // Remove the custom status if it's not whitelisted
      foreach( $custom_statuses as $key => $custom_status ) {
        if ( !in_array( $custom_status->slug, $permitted_statuses ) )
          unset( $custom_statuses[$key] );
      }
      break;
  }
  return $custom_statuses;
}
add_filter( 'ef_custom_status_list', 'efx_limit_custom_statuses_for_teachers' );
function efx_limit_custom_statuses_for_students( $custom_statuses ) {
  $current_user = wp_get_current_user();
  switch( $current_user->roles[0] ) {
    // Only allow a Students to access specific statuses from the dropdown
    case 'student':
      $permitted_statuses = array(
        'draft',
        'pending',
      );
      // Remove the custom status if it's not whitelisted
      foreach( $custom_statuses as $key => $custom_status ) {
        if ( !in_array( $custom_status->slug, $permitted_statuses ) )
          unset( $custom_statuses[$key] );
      }
      break;
  }
  return $custom_statuses;
}
add_filter( 'ef_custom_status_list', 'efx_limit_custom_statuses_for_students' );

?>