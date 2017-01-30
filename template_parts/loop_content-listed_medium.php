<div class="loop_content-listed_medium">
  
  <?php if(has_post_thumbnail() || get_field('media_type', $post->ID)): ?>
  
  <a class="listed_medium-featured_image" style="background-image:url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'medium')[0];  ?>)" href="<?php the_permalink(); ?>"> 

    <div class="featured_image-badge">
      
      <?php get_badge($post->ID, 'badge-small'); ?>
      
    </div>    
    <span class="featured_image-title"><?php the_title();?></span>

    <?php if(get_field('media_type', $post->ID)) echo '<span class="button-play"><i class="fa fa-play-circle-o"></i></span> ';?>    

    <span class="featured_image-overlay"></span>
  </a>
  
  <?php else: ?>

  <a class="listed_medium-excerpt" href="<?php the_permalink(); ?>">
    <span class="excerpt-title">
      <?php the_title();?>
    </span>
    <span class="excerpt-badge">
      <?php get_badge($post->ID, 'badge-small'); ?>
    </span>
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
        echo '<a href="' . esc_url( get_category_link( get_the_category()[0]->term_id ) ) . '">' . esc_html( get_the_category()[0]->name ) . '</a>';
      }
      
      ?>
      
    </div>
  </div>
</div>