<?php wp_footer();?>
    <div id="footer" class="row">
      <div class="footer-navigation container">
        <a class="navigation-title" href="<?php echo home_url();?>">ViaNolaVie</a>
        
        <?php wp_nav_menu('menu_id=primary_menu&container=&menu_class=navigation-main&depth=1');?>

        <a id="cc" rel="license" target="_blank" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons License" src="https://i.creativecommons.org/l/by-nc/4.0/88x31.png" /></a>
      </div>
    </div>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-90545488-1', 'auto');
      ga('send', 'pageview');
    
    </script>
  </body>
</html>
