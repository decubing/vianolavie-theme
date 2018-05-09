<?php
//Add the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
    }
add_filter('language_attributes', 'add_opengraph_doctype');
 
//Add Open Graph Meta Info
function insert_fb_in_head() {
  global $post;
  echo '<meta property="fb:app_id" content="138519577004958"/>';
  echo '<meta property="og:title" content="' . get_the_title() . '"/>';
  echo '<meta property="og:site_name" content="ViaNolaVie"/>';
  echo '<meta property="og:description" content="'.$post->post_content.'"/>';
  echo '<meta property="og:url" content="' . get_permalink() . '"/>';
  
  //Conditions based on types..
  if ( get_field('media_type' , $post->id) == 'YouTube Video'){
    echo '<meta property="og:type" content="video.other"/>';
    echo '<meta property="og:video" content="https://www.youtube.com/watch?v='.get_field('youtube_video_id', $post->id).'"/>';
  }elseif(is_single()){
    echo '<meta property="og:type" content="article"/>';
  }elseif(is_archive())
  
  //Thumbnail
  if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
    echo '<meta property="og:image" content="' . get_template_directory_uri() . '/images/logo-fallback.jpg"/>';
  }else{
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
    echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
  }
  echo "";
  return;
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

?>