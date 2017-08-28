<?php if(is_page() && !is_front_page() && have_posts() && !is_page('content-archive')):?>

<div class="layout-page">

  <?php 
  
  //Begin Single Loop
  while(have_posts()): the_post();
  
  ?>
      <!-- Does not extend -->
                        
  <div class="loop_content-single_page">
  
    <?php 
      
    //Page Title
    if(!get_field('hide_page_title'))
      the_title('<div class="single_page-title">', '</div>'); 
      
    //Registration Page text
    get_template_part('template_parts/feature', 'registration_form_text');
    
    //Class URL Generator
    if(is_page('create-class-url'))
      get_template_part('template_parts/feature', 'class_url_generator');
    
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