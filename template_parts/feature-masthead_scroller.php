<?php 
  
//Begin Masthead Scroller Query
$posts = get_posts( array(
  'post_type'    => 'post',
  'post_status'  => 'publish',
  'meta_key'     => 'front_page_placement',
  'meta_value'   => 'Masthead Scroller'
));
$categories = get_categories( array(
  'orderby'     => 'name',
  'meta_key'    => 'add_to_masthead_scroller',
  'meta_value'  => 1
) );

if ( !empty($posts) || !empty($categories_query) ): 

?>

<div class="feature-masthead_scroller row">

  <a href="#" class="masthead_scroller-control_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
  <a href="#" class="masthead_scroller-control_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
  <div class="masthead_scroller-slider">
  
  <?php  
    
  //Start Posts Loop  
  foreach ( $posts as $post ) : setup_postdata( $post );
  
    //Set variables depending on the type of content
    $post_image    = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium')[0];
    
    if(!empty($scale_featured_image))
      $scale_featured_image  = get_field('scale_featured_image', $post->ID);

  ?>

    <a class="slider-listed_post" href="<?php the_permalink(); ?>"> 
      
      <div class="listed_post-badge"> <?php vnv_badge($post->ID);?> </div>
  
      <div class="listed_post-h3"><?php echo vnv_limited_title($post->ID); ?></div>
      <div class="listed_post-meta_title"><?php echo get_the_category($post->ID)[0]->name; ?></div>
  
      <?php 
      //Unscaled Feature Image  
      if(!empty($scale_featured_image))
        echo  '<div class="listed_post-unscaled_image" style="background-image:url(' . $post_image . '"></div>';
      ?>
  
      <div class="listed_post-image <?php if( !empty($scale_featured_image) ) echo 'effect-blur';?>" style="background-image:url( <?php echo $post_image; ?> )"></div>
      
      <?php 
      //Play Button
      if( get_field('media_type', $post->ID) ) 
        echo '<span class="listed_post-button_play"><i class="fa fa-play-circle-o"></i></span>';
      ?>
  
      <div class="listed_post-overlay"></div>
  
    </a>

  <?php 
  
  //End Posts Loop
  endforeach; 
  wp_reset_postdata();
  
  //Start Categories Loop  
  foreach ( $categories as $category) :
  
    //Set Variables
    $listed_post_image_id = get_term_meta( $category->term_id, 'image', true );

  ?>
  
    <a class="slider-listed_post" href="<?php echo get_term_link( $category->term_id); ?>"> 
      <div class="listed_post-h3"><?php echo $category->name; ?></div>
      <div class="listed_post-meta_title">Category</div>
      <div class="listed_post-image" style="background-image:url( <?php echo wp_get_attachment_image_src( $listed_post_image_id, 'medium' )[0]; ?> )"></div>
      <div class="listed_post-overlay"></div>
    </a>
  
  <?php
  //End Categories Loop  
  endforeach; 
  ?>

  </div>
  
</div>

<?php 
//End Masthead Scroller Query
endif; 
?>
