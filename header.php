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
          <div class="navigation-upper_content">
            
            <?php

            //Tagline
            if(get_bloginfo('description'))
              echo '<div class="upper_content-description">' . get_bloginfo('description') . '</div>';
      
            //Conditional Logged in Info
            if(is_user_logged_in()){
              
              //User Info
              echo '<div class="upper_content-user">
                <div class="user-name">Hello '.wp_get_current_user()->user_login.'!</div> <a class="user-logout" href="'.wp_logout_url().'">Logout</a></div>';
              
            }else{
              
              //Login Or Signup Buttons
              echo '<a class="upper_content-signup" href="'.get_permalink( get_page_by_path( 'register') ).'">Signup</a> <a class="upper_content-login" href="'. wp_login_url() .'">Login</a>';
              
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
                <input id="form-input"class="form-input" type="text" placeholder="Enter search terms.." value="<?php echo get_search_query() ?>" name="s" required>
                <button><i class="fa fa-search"></i></button>
              </form>
            </div>  
          </div>
        </div>
      </div>
    </div>