<?php
//Recent Posts  

//Prevent Repeating Posts
global $post;
?>

<div class="feature-recent_posts">
  <div class="recent_posts-title">
    Recent Posts on ViaNolaVie
  </div>
  <div class="recent_posts-loop_content">
    
    <?php 
    //Begin Recent Posts Loop
    $the_query = new WP_Query( array(
      'post_type' => 'post',
      'posts_per_page' => 3,
      'post__not_in' => array($post->ID)
    ));
    if ( $the_query->have_posts() ): while ( $the_query->have_posts() ) : $the_query->the_post();
    ?>

    <a class="loop_content-listed_post" href="<?php the_permalink();?>">
      
      <?php
      //Image for first post
      if( $the_query->current_post == 0 && !is_paged() && has_post_thumbnail() )
        echo '<span class="listed_post-image" style="background-image:url('. wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0].')"></span>';
      ?>
      
      <span class="listed_post-title"><?php the_title();?></span>
      <span class="listed_post-excerpt"><?php echo get_the_excerpt($post->ID) ?></span>
      <span class="listed_post-badge">
        
        <?php get_badge($post->ID, 'badge-small'); ?>
        
      </span>    
    </a>
  
    <?php
    //End Recent Posts Loop 
      endwhile;
      wp_reset_postdata();
    endif;
    ?>

  </div>
</div>