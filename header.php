<!DOCTYPE html>
<html lang="en-us">
  
  <head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php wp_head();?>    
    
  </head>
  
  <body>
    <div class="header">
      <div class="header-content">
        <div class="content-logo">
          <a href="<?php echo home_url();?>"><img alt="ViaNolaVie" src="<?php echo get_template_directory_uri() ?>/images/logo.svg"></a>
        </div>
        <div class="content-mobile_toggle">
          <div class="mobile_toggle-action"><i class="fa fa-bars"></i></div>
        </div>
        <div class="content-navigation">
          <div class="navigation-tag_line">
            Talking about life &amp; culture in New Orleans
            
            <?php
            //Conditional Logged in Info
            if(is_user_logged_in()){
             echo '<div class="tag_line-user">Hello '.wp_get_current_user()->user_login.'! <a class="user-logout" href="'.wp_logout_url().'">Logout</a></div>';
            }else{
              echo '<a class="tag_line-button" href="'.get_permalink(1185).'"><img alt="Talk to Us" src="'.get_template_directory_uri().'/images/button-talk_to_us.svg"></a>';
            }
            ?>
                        
          </div>
          <div class="navigation-links">
            
            <?php wp_nav_menu('menu_id=primary_menu&container=&menu_class=links-primary&depth=1');?>
            
            <ul class="links-social">
              
              <?php 
              //Social Links from Customizer
              if( get_theme_mod('vnv_facebook_url') )
                echo '<li><a target="_blank" href="'. get_theme_mod('vnv_facebook_url') .'"><i class="fa fa-facebook-square"></i></a></li>';
              if( get_theme_mod('vnv_twitter_url') )
                echo '<li><a target="_blank" href="'. get_theme_mod('vnv_twitter_url') .'"><i class="fa fa-twitter-square"></i></a></li>';
              if( get_theme_mod('vnv_newsletter_url') ) 
                echo '<li><a target="_blank" href="'. get_theme_mod('vnv_newsletter_url') .'"><i class="fa fa-envelope"></i></a></li>';
              ?>
    
              <li><a target="_blank" href="<?php echo bloginfo('rss2_url');?>"><i class="fa fa-rss-square"></i></a></li>
            </ul>
            <div class="links-site_search">
              <form class="site_search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
                <input id="form-input"class="form-input" type="text" placeholder="Enter search terms.." value="" name="s" required>
                <button><i class="fa fa-search"></i></button>
              </form>
            </div>  
          </div>
        </div>
      </div>
    </div>