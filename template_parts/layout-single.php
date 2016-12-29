<?php if(is_single() && have_posts()):?>

<div id="layout-single" class="loop_content"><!-- if is front page: layout-single, class: loop_content -->

  <?php 
  
  //Begin Single Loop
  while(have_posts()): the_post();
  
  //Media Masthead
  get_template_part('template_parts/loop_content', 'media_masthead');
  
  ?>
      
  <div class="loop_content-container">  
     <!-- Does not extend -->                   
    <div class="loop_content-single_post table-cell">
      
      <?php get_template_part('template_parts/loop_content', 'single_post'); ?>
      
    </div>
    
    <div id="sidebar">
    
      <?php
        
      //Suggested Content Sidebar
      get_template_part('template_parts/sidebar', 'suggested_content');
      
      ?>
    
    </div>

  </div>
  
  <?php
    
  //End Single Post Loop
  endwhile;
  
  ?>
  
</div> 


<?php endif;?>