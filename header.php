<!DOCTYPE html>
<html lang="en-us">
  
  <head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php wp_head();?>    
    
  </head>
  
  <body>
      
    <div id="header" class="row">
      <div class="header-navigation">
        <div id="navigation-logo">
          <a href="<?php echo home_url();?>"><img alt="ViaNolaVie" src="<?php echo get_template_directory_uri() ?>/images/logo.svg"></a>
        </div>
        
        <?php wp_nav_menu('menu_id=primary_menu&container=&menu_class=navigation-main&depth=1');?>

        <ul class="navigation-social">
          
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
        <div id="navigation-toggle_area">
          <i class="toggle_area-toggle_button"></i>
        </div>
        <div id="navigation-site_search">
          <form role="search" method="get" id="site_search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
            <input type="text" placeholder="Enter search terms.." value="<?php echo get_search_query() ?>" name="s" required>
            <button><i class="fa fa-search"></i></button>
          </form>
        </div>
      </div>
    </div>