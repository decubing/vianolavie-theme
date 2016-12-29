<?php 

if(is_archive() || is_search()):
  
//Masthead Title Feature
get_template_part('template_parts/feature', 'archive_masthead');

//Popular Tags Feature
get_template_part('template_parts/feature', 'popular_tags');

?>

<div id="layout-archive">
  <!-- Does not extend -->
  <div class="container table"> 
    
    <?php 
    
    //Begin Loop Content
    if(have_posts()): 
    
    ?>
    <!-- Does not extend -->
    <div class="archive-loop_content table-cell"> 

      <?php 
      
      while(have_posts()): the_post();
      
        //Medium Post in Loop
        get_template_part('template_parts/loop_content', 'listed_medium');
        
      endwhile;
  
      //Page Navigation in Loop
      get_template_part('template_parts/loop_content', 'pagination');
      
      ?>
      
    </div>
    
    <?php else: ?>
    <!-- Does not extend -->
    <div class="archive-notice table-cell">    
    
      <?php get_template_part('template_parts/feature', '404_notice'); ?>
    
    </div>
          
    <?php
      
    //End Loop Content
    endif;
    
    ?>
    <!-- Does not extend -->
    <div class="archive-page_sharer table-cell">
      
      <?php
        
      //Feature Sharing Option
      get_template_part('template_parts/feature', 'page_sharer');
  
      ?>
      
    </div>
  </div>
</div>

<?php endif;?>