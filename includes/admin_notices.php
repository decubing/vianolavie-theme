<?php

/**
 * Display Staging/Local Server notice on WP Backend
 */
function frontend_testing_server_notice() {
  $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  if ( (strpos($url,'staging') !== false) || $_SERVER["SERVER_ADDR"] == '::1' ) {
  	$class = 'notice notice-warning callout callout-info callout-full';
  	$message = __( '<strong>Warning:</strong> You are currently on a testing server. <strong>Any changes may be overwritten.</strong>', 'vnv' );
  	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
  }
}
add_action( 'admin_notices', 'frontend_testing_server_notice' );

?>