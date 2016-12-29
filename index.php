<?php
   
//Header
get_header();

//Layouts
get_template_part('template_parts/layout', 'front_page'); //Front Page
get_template_part('template_parts/layout', 'archive'); //Archive
get_template_part('template_parts/layout', 'single'); //Single Post
get_template_part('template_parts/layout', 'page'); //Single Page
  
//Footer
get_footer();

?>