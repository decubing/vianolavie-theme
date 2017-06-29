<?php 

if(is_archive() || is_search() || is_home()):
  
//Masthead Title Feature
get_template_part('template_parts/feature', 'archive_masthead');

?>

<div id="layout-archive" class="layout-archive">
  <!-- Does not extend -->
      
    <?php 
    
    //Begin Loop Content
    if(have_posts()): 
    
    ?>

    <div class="archive-loop_content"> 

      <?php 
      while(have_posts()): the_post();
      
        //Medium Post in Loop
        get_template_part('template_parts/loop_content', 'listed_medium');
        
      endwhile;
      ?>
      
      <div class="loop_content-pagination">
      <?php
      //Page Navigation 
      echo paginate_links();
      ?>
      </div>
    </div>
    
    <?php else: ?>

    <div class="archive-notice">    
    
      <?php get_template_part('template_parts/feature', '404_notice'); ?>
    
    </div>
          
    <?php
      
    //End Loop Content
    endif;
    
    ?>

</div>

<?php endif;?>