<?php if(get_field('add_featured_posts')):?>
  
<div class="sidebar-featured_posts">
  
  <h4><?php the_field('featured_posts_title');?></h4>
  
  <?php 
  
  //Begin Featured Posts  
  $post_objects = get_field('featured_posts');
  if( $post_objects ): 
   
  ?>
  
  <div class="featured_posts-loop_content">   
  
    <?php 
    
    foreach( $post_objects as $post):
      setup_postdata( $post );      
      get_template_part('template_parts/loop_content', 'listed_medium'); 
    endforeach;  
    
    ?>

  </div>
  
  <?php
    
  //End Featured Posts
    wp_reset_postdata();
  endif;
  
  ?>  
  
</div>

<?php endif;?>

