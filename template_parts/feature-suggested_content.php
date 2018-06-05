<div class="feature-suggested_content">
  <div class="suggested_content-title">
    Suggested Content
  </div>
  <div class="suggested_content-loop_content">
    
  <?php 
  //Suggested Content Loop - should get at most three posts
  $content_counter = 0;
  $suggested_content = get_suggested_content();
  if ( !is_null($suggested_content) && $suggested_content->have_posts() ){
    while ( $suggested_content->have_posts() ){ 
      $suggested_content->the_post();
      get_template_part('template_parts/loop_content', 'listed_medium');
      wp_reset_postdata();
      $content_counter++;
      if ($content_counter >= 3) return;
    }
  }
  // Fallback Content Loop - fills in the gaps if there isn't any/enough suggested content
  $fallback_content = new WP_Query( array( 'post_type' => 'post', 'ignore_sticky_posts' => true ) );
  if ( $fallback_content->have_posts() ){
    while ( $fallback_content->have_posts() ){
      $fallback_content->the_post();
      get_template_part('template_parts/loop_content', 'listed_medium');
      wp_reset_postdata();
      $content_counter++;
      if ($content_counter >= 3) return;
    }
  }
  ?>
  
  </div>

</div>
