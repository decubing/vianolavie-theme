<?php 
//Start Single Page Layout  
if(is_single() && have_posts()):
?>

  <?php
  //Add Suggested Content
  add_suggested_content();
  ?>

<div class="layout-single">

  <?php
  //Media Masthead
  get_template_part('template_parts/feature', 'media_masthead');
  ?>  
  
  <div class="single-container">
        
    <div class="container-content">
  
    <?php
    //Begin Single Loop
    while(have_posts()): the_post();
    ?>
  
      <div class="content-loop_content">
        
        <?php 
                
        // NolaVie Notice
        get_template_part('template_parts/loop_content', 'nolavie_notice'); 

        // Single Post
        get_template_part('template_parts/loop_content', 'single_post'); 

        // Related Content
        // get_template_part('template_parts/feature', 'related_content');
              
        ?>
      
      </div>
    
      <?php
      //End Single Post Loop
      endwhile;
      ?>

      
      <div class="content-feature">
        <?php get_template_part('template_parts/feature', 'recent_posts'); ?>
      </div>
    </div>
    
    <div class="container-feature">
      <?php get_template_part('template_parts/feature', 'related_content'); ?>
    </div>
  </div>
</div> 


<?php 
//End Single Page
endif;
?>