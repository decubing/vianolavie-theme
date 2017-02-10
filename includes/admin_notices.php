<?php

//Display Staging/Local Server notice on WP Backend
function frontend_testing_server_notice() {
  $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  if ( (strpos($url,'staging') !== false) || $_SERVER["SERVER_ADDR"] == '::1' ) {
  	$class = 'notice notice-warning callout callout-info callout-full';
  	$message = __( '<strong>Warning:</strong> You are currently on a testing server. <strong>Any changes may be overwritten.</strong>', 'vnv' );
  	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
  }
}
add_action( 'admin_notices', 'frontend_testing_server_notice' );

//Display FAQ Links for 'Teacher' users on WP Backend
function instructor_faq_notice() {
  $user = wp_get_current_user();
  $faqs_url = get_permalink(get_page_by_path( 'faqs-for-instructors' ));
  if ( in_array( 'teacher', (array) $user->roles ) ) {
  	$class = 'notice notice-info';
  	$message = __( '<strong>Instructor FAQs:</strong> <a href="'.$faqs_url.'">Click here</a> to view ViaNolaVie\'s FAQs for Instructors.', 'vnv' );
  	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
  }
}
add_action( 'admin_notices', 'instructor_faq_notice' );

?>