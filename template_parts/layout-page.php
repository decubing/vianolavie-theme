<?php if(is_page() && !is_front_page() && have_posts() ):?>

<div id="layout-page" class="loop_content"><!-- if is front page: layout-single, class: loop_content -->

  <?php 
  
  //Begin Single Loop
  while(have_posts()): the_post();
  
  ?>
      <!-- Does not extend -->
  <div class="container">  
                        
    <div class="loop_content-single_page">
    <?php 
      
    //Page Title
    if(!get_field('hide_page_title'))
      the_title('<h1 class="single_page-title">', '</h1>'); 
      
    //The Content
    the_content();
    
    ?>
          
  </div>
    
  <?php
    
  //End Single Post Loop
  endwhile;
  
  ?>
  
</div> 

<?php endif;?>