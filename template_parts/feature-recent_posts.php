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
      
    //Limit the Amount of Posts based on Sticky Amount
    $sticky_posts = count(get_option('sticky_posts'));
    $post_per_page = 3;
    if($sticky_posts > 0){
      $post_per_page = 3 - $sticky_posts;
    }
    
    //Begin Recent Posts Loop
    $the_query = new WP_Query( array(
      'post_type' => 'post',
      'posts_per_page' => $post_per_page,
      'post__not_in' => array($post->ID)
    ));
    if ( $the_query->have_posts() ): while ( $the_query->have_posts() ) : $the_query->the_post();
    
    //Repeating Variables
    $scale_featured_image = get_field('scale_featured_image');
    
    ?>

    <a class="loop_content-listed_post" href="<?php the_permalink();?>">

      <?php
      //Start Image for first post
      if( $the_query->current_post == 0 && !is_paged() && has_post_thumbnail() ):
      ?>

      <div class="listed_post-featured_image" href="<?php the_permalink(); ?>"> 
                
        <?php 
          //Scaled Feature Image  
          if($scale_featured_image)
            echo  '<div class="featured_image-unscaled_image" style="background-image:url(' . wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'large')[0]. '"></div>';
          ?>
    
        <div class="featured_image-image <?php if($scale_featured_image) echo 'effect-blur';?>" style="background-image:url( <?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'large')[0]?> )"></div>
        
        <?php if(get_field('media_type', $post->ID)) echo '<span class="featured_image-play_button"><i class="fa fa-play-circle-o"></i></span> ';?>
    
    
      </div>

      <?php
      //End Image for first post
      endif;
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