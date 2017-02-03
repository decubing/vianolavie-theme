<?php if(is_page() && !is_front_page() && have_posts() ):?>

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
    
    //The Content
    the_content();
    
    //Signup Page
    if(is_page('contribute')){
      if(!is_user_logged_in()){
        echo '<div class="single_page-login">Already signed up? <a href="http://www.vianolavie.org/login">Click here</a> to login.</div>';     
        echo do_shortcode('[gravityform id="3" title="false" description="false"]');   
      }else{
        echo '<div class="single_page-login">You are currently logged in as <em>'.wp_get_current_user()->user_login.'</em>. Not you? <a class="user-logout" href="'.wp_logout_url().'">Logout</a>.</div>';     
        echo do_shortcode('[gravityform id="6" title="false" description="false"]');           
      }
    }

    
    ?>
          
  </div>
    
  <?php
    
  //End Single Post Loop
  endwhile;
  
  ?>
  
</div> 

<?php endif;?>