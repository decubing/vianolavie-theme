<?php wp_footer();?>
    <div id="footer" class="row">
      <div class="footer-navigation container">
        <a class="navigation-title" href="<?php echo home_url();?>">ViaNolaVie</a>
        
        <?php wp_nav_menu('menu_id=primary_menu&container=&menu_class=navigation-main&depth=1');?>

        <a id="cc" rel="license" target="_blank" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons License" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" /></a>
      </div>
    </div>
  </body>
</html>
