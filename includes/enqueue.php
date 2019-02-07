<?php
/**
 * Enqueue scripts and styles.
 */
function vnv_scripts_and_styles() {
  
  //Styles
	wp_enqueue_style( 'vnv-style', get_stylesheet_uri() );
	wp_enqueue_style( 'fancybox-style', get_template_directory_uri().'/scripts/fancybox/jquery.fancybox.css?v=2.1.5' );
	
	//Scripts
	wp_enqueue_script( 'vnv-scripts', get_template_directory_uri().'/functions.js', array( 'vnv-autosize','vnv-mastheadSlider','vnv-toggleMobileNav','vnv-sharethis','jSticky', 'sticky-kit', 'fancybox', 'jquery' ), NULL, true ); //Remember to update Dependencies..
	wp_enqueue_script( 'vnv-autosize', get_template_directory_uri().'/scripts/autosize.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'vnv-mastheadSlider', get_template_directory_uri().'/scripts/mastheadSlider.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'vnv-toggleMobileNav', get_template_directory_uri().'/scripts/toggleMobileNav.js', array('jquery'), NULL, true );
// 	wp_enqueue_script( 'vnv-pageSharer', get_template_directory_uri().'/scripts/pageSharer.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'vnv-expandSearch', get_template_directory_uri().'/scripts/expandSearch.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'vnv-sharethis', get_template_directory_uri().'/scripts/shareThis.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'jSticky', get_template_directory_uri().'/scripts/jSticky.js', array('jquery'), '11.4.2012', true );
	wp_enqueue_script( 'sticky-kit', get_template_directory_uri().'/scripts/sticky-kit.js', array('jquery'), '11.4.2012', true );
	wp_enqueue_script( 'fancybox', get_template_directory_uri().'/scripts/fancybox/jquery.fancybox.pack.js?v=2.1.5', array('jquery'), NULL, true );
	
}

/**
 * Script to fix an edit flow bug that prevents authors from being modified.
 */
function edit_flow_fix() {
	wp_enqueue_script( 'edit_flow_fix', get_template_directory_uri().'/scripts/editFlowKludge.js', array(), NULL, true );	
}

add_action( 'wp_enqueue_scripts', 'vnv_scripts_and_styles' );
add_action( 'admin_enqueue_scripts', 'edit_flow_fix' );
?>