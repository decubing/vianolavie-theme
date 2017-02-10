<?php
  
if ( ! function_exists( 'ph_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function ph_setup() {
  	 
  	// Add default posts and comments RSS feed links to head.
  	add_theme_support( 'automatic-feed-links' );
  
  	/*
  	 * Let WordPress manage the document title.
  	 * By adding theme support, we declare that this theme does not use a
  	 * hard-coded <title> tag in the document head, and expect WordPress to
  	 * provide it for us.
  	 */
  	add_theme_support( 'title-tag' );
  
  	// This theme uses wp_nav_menu() in one location.
  	register_nav_menus( array(
  		'primary' => esc_html__( 'Primary', 'ph' ),
  	) );
  
  	/*
  	 * Switch default core markup for search form
  	 * to output valid HTML5.
  	 */
  	add_theme_support( 'html5', array(
  		'search-form'
  	) );
  
    /**
     * Support custom post thumbnails
     */
    add_theme_support('post-thumbnails');
  
  }
endif;
add_action( 'after_setup_theme', 'ph_setup' );  

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ph_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'content_width', 1200 );
}
add_action( 'after_setup_theme', 'ph_content_width', 0 );

/**
 * Set excerpt display.
 */
function vnv_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'vnv_excerpt_more' );

/**
 * Set excerpt length.
 */
function vnv_custom_excerpt_length( $length ) {
    return 18;
}
add_filter( 'excerpt_length', 'vnv_custom_excerpt_length' );

/**
 * Remove Add Media Button
 */
function remove_add_media_buttons(){
  remove_action( 'media_buttons', 'media_buttons' );
}
add_action('admin_head', 'remove_add_media_buttons');
?>