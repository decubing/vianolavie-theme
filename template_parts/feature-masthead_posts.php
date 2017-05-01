<?php if(have_rows('masthead_posts-slider')):?>

<div class="feature-masthead_posts row">

  <a href="#" class="masthead_posts-control_next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
  <a href="#" class="masthead_posts-control_prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
  <img class="masthead_posts-swipe" src="<?php echo get_template_directory_uri(); ?>/images/icon-swipe_to_browse.png">
  <div class="masthead_posts-slider">
  
  <?php  
  //Start Loop  
  while ( have_rows('masthead_posts-slider') ) : the_row(); 
  
    //Set variables depending on the type of content
    if(get_sub_field('slider-listed_post-type') == 'Category'){
      $listed_post          = get_sub_field('slider-listed_category');
      $listed_post_title    = $listed_post->name; 
      $listed_post_subtitle = 'Category';
      $listed_post_image_id = get_term_meta( $listed_post->term_id, 'image', true );
      $listed_post_image    = wp_get_attachment_image_src( $listed_post_image_id, 'medium' )[0];
      $listed_post_link     = get_term_link( $listed_post->term_id );
    }elseif(get_sub_field('slider-listed_post-type') == 'Post, Page, or Media'){
      $listed_post          = get_sub_field('slider-listed_post');
      $listed_post_title    = get_limited_title($listed_post->ID); 
      $listed_post_subtitle = get_the_category($listed_post->ID)[0]->name;
      $listed_post_image    = wp_get_attachment_image_src(get_post_thumbnail_id($listed_post->ID), 'medium')[0];
      $listed_post_link     = get_permalink($listed_post->ID);      
      $scale_featured_image = get_field('scale_featured_image', $listed_post->ID);
    }elseif(get_sub_field('slider-listed_post-type') == 'Other Content or Link'){
      $listed_post_title    = get_sub_field('slider-listed_post-title');
      $listed_post_subtitle = get_sub_field('slider-listed_post-subtitle');
      $listed_post_image    = get_sub_field('slider-listed_post-image')['url'];
      $listed_post_link     = get_sub_field('slider-listed_post-link');      
    }
  ?>

  <a class="slider-listed_post" href="<?php echo $listed_post_link; ?>"> 
    
    <div class="listed_post-badge"><?php get_badge($listed_post->ID);?> </div>

    <div class="listed_post-h3"><?php echo $listed_post_title; ?></div>
    <div class="listed_post-meta_title"><?php echo $listed_post_subtitle; ?></div>
    <?php 
      //Unscaled Feature Image  
      if($scale_featured_image)
        echo  '<div class="listed_post-unscaled_image" style="background-image:url(' . $listed_post_image . '"></div>';
      ?>

    <div class="listed_post-image <?php if($scale_featured_image) echo 'effect-blur';?>" style="background-image:url( <?php echo $listed_post_image; ?> )"></div>
    
      <?php if( get_field('media_type', $listed_post->ID) ) echo '<span class="listed_post-button_play"><i class="fa fa-play-circle-o"></i></span>';?>

    <div class="listed_post-overlay"></div>

  </a>


  <?php 
  
  // Clear content Variables
  $listed_post = '';
  
  //End Loop
  endwhile; 
  
  ?>

  </div>
  
</div>

<?php endif; ?>
