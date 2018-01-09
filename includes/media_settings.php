<?php
//Add Attribution to Image Captions
add_filter('get_image_tag', 'image_with_attribution', 10, 5);
function image_with_attribution( $html, $id, $alt, $title, $size = 'medium' ) {
  
  //Default Variables
  list( $img_src, $width, $height ) = image_downsize($id, $size);
  $hwstring = image_hwstring($width, $height);
  $title = $title ? 'title="' . esc_attr( $title ) . '" ' : '';
  $class = 'align' . esc_attr($align) .' size-' . esc_attr($size) . ' wp-image-' . $id;
  $class = apply_filters( 'get_image_tag_class', $class, $id, $align, $size );

  //Image Credit
	if ( get_field('image_credit' , $id) ){
	  $image_credit = 'data-credit="' . get_field('image_credit' , $id) . '"';
  }

  //Updated HTML
  $html = '<img src="' . esc_attr($img_src) . '" alt="' . esc_attr($alt) . '" ' . $title . $hwstring . 'class="' . $class . '" ' . $image_credit . '/>';
  
  return $html;  
  
}

//TEMPORARY FIX: Add CSS to remove TinyMCE Image Edit Field and add ACF styling
add_action('admin_head', 'remove_tiny_mece_field');
function remove_tiny_mece_field() {
  echo '<style>
    #mceu_39 { 
      display: none !important; 
    }
    .acf-field-58a740bb96d82{
      margin-top: 10px !important;
      padding-top: 10px;
      border-top: 1px solid grey;
    }
  </style>';
}
?>