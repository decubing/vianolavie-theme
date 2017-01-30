<?php if(is_single() && have_posts()):?>

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
                
        //Single Post
        get_template_part('template_parts/loop_content', 'single_post'); 
              
        ?>
      
      </div>
    
      <?php
      //End Single Post Loop
      endwhile;
      ?>
      
      <div class="content-feature">
      
        <?php
          
        //Suggested Content
        get_template_part('template_parts/feature', 'recent_posts');
        
        ?>
      
      </div>
    </div>
  </div>
</div> 


<?php endif;?>