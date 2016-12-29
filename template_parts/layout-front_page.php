<?php 
  
if(is_front_page()):

  //Masthead Slider Feature
  get_template_part('template_parts/feature', 'masthead_posts');
  
  //Popular Tags Feature
  get_template_part('template_parts/feature', 'popular_tags');
  
?>


<div id="layout-front_page">
  <!-- Does not extend -->
  <div class="front_page-container table"> 
    
    <?php 
      
    //Begin Recent Posts Query
    $paged = ( get_query_var('page') ) ? get_query_var('page') : 1; //Using 'page' for pagination to work on front page.
    $the_query = new WP_Query( 'post_type=post&paged='.$paged );
    if ( $the_query->have_posts() ):
    
    ?>
      
    <div class="front_page-loop_content"> 
 
      <?php
        
      //Loop Recent Posts
      while ( $the_query->have_posts() ) {
        $the_query->the_post();
        
        //Large Post in Loop
        get_template_part('template_parts/loop_content', 'listed_large');
    
      }      
      
      //Pagination
      require( locate_template( 'template_parts/loop_content-pagination.php' ) ); //Using require() because $the_query doesn't exented to get_template_parts();

      ?>
      
      <div class="mobile loop_content-load_posts">
        <a class="load_posts-button" href="#">
          Load More Posts
        </a>  
        <span class="load_posts-image_overlay"></span>
      </div>
  
    </div>
    
    <?php
    //End Recent Posts Query
    wp_reset_postdata();
    endif;
    ?>
    
    <div class="front_page-page_sharer table-cell">
      
      <?php
        
      //Page Sharer
      get_template_part('template_parts/feature', 'page_sharer');
      
      ?>
      
    </div>
    
    <div id="sidebar">
      
      <?php 
        
      //Featured Posts
      get_template_part('template_parts/sidebar', 'featured_posts');

      //Text Blog
      get_template_part('template_parts/sidebar', 'text_block');

      //Suggested Posts
      get_template_part('template_parts/sidebar', 'suggested_content');

      ?>
      
    </div>
  </div>
</div>

<?php endif; ?>