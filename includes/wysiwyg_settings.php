<?php
  
/**
 * Add Custom Formats to TinyMCE
 */
function vnv_mce_formats($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'vnv_mce_formats');
 
function vnv_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Lead Paragraph',  
			'block' => 'p',  
			'classes' => 'lead',
			'wrapper' => false,
		),
	);  
	
	// Insert the array, JSON ENCODED, into 'style_formats'
	
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
add_filter( 'tiny_mce_before_init', 'vnv_mce_before_init_insert_formats' ); 

/**
 * Style Custom Formats in TinyMCE Editor
 */
function vnv_theme_add_editor_styles() {
  add_editor_style( 'style-tinymce.css' );
}
add_action( 'init', 'vnv_theme_add_editor_styles' );

?>