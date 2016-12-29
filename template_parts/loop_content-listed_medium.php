<div class="loop_content-listed_medium">
  
  <?php if(has_post_thumbnail() || get_field('media_type', $post->ID)): ?>
  
  <a class="listed_medium-featured_image" style="background-image:url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'medium')[0];  ?>)" href="<?php the_permalink(); ?>"> 
    
    <?php get_badge($post->ID); ?>
    
    <span class="listed_medium-title"><?php echo get_limited_title($post->ID);?></span>

    <?php if(get_field('media_type', $post->ID)) echo '<span class="button-play"><i class="fa fa-play-circle-o"></i></span> ';?>    
    <!-- Does not extend -->
    <span class="image_overlay"></span>
  </a>
  
  <?php else: ?>

  <a class="listed_medium-excerpt" href="">

    <?php get_badge($post->ID); ?>

    <span class="listed_medium-title"><?php echo get_limited_title($post->ID);?></span>

    <span class="the_excerpt"><?php echo get_the_excerpt();?></span>
  </a>

  <?php endif;?>
  
  <div class="listed_medium-post_footer row">
    <div class="post_footer-meta">
          
      <?php 
        
      //Set Footer Meta
      if(is_category()){
        
        //Begin Authors
        coauthors_posts_links( '', ', ', '', '');
        
      }else{
        the_category(', ');
      }
      
      ?>
      
    </div>
    
    <?php
    //Page Sharing Options
    get_template_part('template_parts/feature', 'sharing_options');
    ?>
  </div>
</div>