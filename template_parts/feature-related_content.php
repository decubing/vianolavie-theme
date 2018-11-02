<div class="feature-related_content">
  <div class="related_content-title">
    Related Content
  </div>
  <div class="related_content-loop_content">
    
  <?php 
  //related Content Loop - should get at most two posts (cf. suggested content, which gets three)
  $content_counter = 0;
  $current_post_id = get_the_ID();
  $limit = 3;
  $related_content = get_related_content($current_post_id, $limit);
  if ( !is_null($related_content) && $related_content->have_posts() ){
    while ( $related_content->have_posts() ){ 
      $related_content->the_post();
      get_template_part('template_parts/loop_content', 'listed_medium');
      wp_reset_postdata();
      $content_counter++;
      if ($content_counter >= $limit) return;
    }
  }
  // Fallback Content Loop - fills in the gaps if there isn't any/enough related content
  $fallback_content = new WP_Query( array( 'post_type' => 'post', 'ignore_sticky_posts' => true ) );
  if ( !is_null($fallback_content) && $fallback_content->have_posts() ){
    while ( $fallback_content->have_posts() ){
      $fallback_content->the_post();
      get_template_part('template_parts/loop_content', 'listed_medium');
      wp_reset_postdata();
      $content_counter++;
      if ($content_counter >= $limit) return;
    }
  }
  ?>
  
  </div>

</div>
