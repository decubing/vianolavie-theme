<?php

//Set content depending on archive type
if( is_category() || is_tag() ){
  $archive_title       = get_queried_object()->name;
  $archive_description = get_queried_object()->description;
  $archive_image_id    = get_term_meta(get_queried_object()->term_id, 'image', true);
  $archive_image       = wp_get_attachment_image_src( $archive_image_id, 'medium' )[0];
  $subcategories       = get_categories( array('child_of' => get_queried_object()->term_id) );
}elseif(is_author()){
  $archive_title       = get_queried_object()->display_name;
  $archive_description = get_the_author_meta('description', get_queried_object()->ID);
  $archive_image       = get_avatar_url( get_queried_object()->ID, array('size' => '180') );
}elseif(is_search()){
  $archive_title       = 'Search Results: "' . get_search_query() . '"';
  $archive_image       = get_template_directory_uri().'/images/icon-search.png';
}
  
?>

<div class="feature-archive_masthead row">
	<div class="archive_masthead-background_image" style="background-image:url(<?php echo $archive_image; ?>)"></div>
  <div class="archive_masthead-masthead_content container">
		
	  <?php 
	  // Archive Content
	  if($archive_image)
	    echo '<div class="masthead_content-archive_image" style="background-image:url(' .$archive_image. ')"></div>';
	  if($archive_title)
	    echo '<div class="masthead_content-archive_title">' . $archive_title . '</div>';
	  if($archive_description)
	    echo '<div class="masthead_content-archive_description">' . $archive_description . '</div>';
	  if($subcategories){
  	  echo '<div class="masthead_content-subcategories">';
  	  foreach($subcategories as $subcategory) { 
        echo '<a class="subcategories-link" href="' . get_category_link( $subcategory->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $subcategory->name ) . '" ' . '>' . $subcategory->name.'</a> ';
      }
  	  echo '</div>';      
	  }
	  ?>
	  		
	</div>
</div>