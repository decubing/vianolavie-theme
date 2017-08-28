<?php 
if(is_archive() || is_search() || is_home() || is_page('content-archive')):
  
  //Masthead Title Feature
  get_template_part('template_parts/feature', 'archive_masthead');
?>

<div id="layout-archive" class="layout-archive">

  <?php 
  //Content Archive
  if(is_page('content-archive')):
  
  //Content Archive Loop
  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
  $the_query = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'meta_query' => array(
      array(
  			'key'     => 'front_page_placement',
  			'value'   => array( 'Archived' ),
  			'compare' => 'IN',
  		),
  	),
  	'paged' => $paged,
  ));
  if($the_query->have_posts()):  
  ?>
  
  <div class="archive-loop_content"> 
  
    <?php
    //Start Content Archive Loop
    while ( $the_query->have_posts() ) : $the_query->the_post();

      //Medium Post in Loop
      get_template_part('template_parts/loop_content', 'listed_medium');

    //End Content Archive Loop
    endwhile;
    ?>

    <div class="loop_content-pagination">
      
      <?php
      //Page Navigation 
      echo paginate_links( array(
      	'base' => str_replace( 99999900000, '%#%', esc_url( get_pagenum_link( 99999900000 ) ) ),
      	'format' => '?paged=%#%',
      	'current' => max( 1, get_query_var('paged') ),
      	'total' => $the_query->max_num_pages
      ) );
      ?>
      
    </div>
    <?php else: ?>

    <div class="archive-notice">    
    
      <?php get_template_part('template_parts/feature', '404_notice'); ?>
    
    </div>
          
    <?php
      
    //End Content Archive
    endif;
    
    //End Content Archive Loop
    endif;
    
    //Begin Standard Archive
    if(!is_page('content-archive')): if(have_posts()): 
    ?>

    <div class="archive-loop_content"> 

      <?php 
      while(have_posts()): the_post();
      
        //Medium Post in Loop
        get_template_part('template_parts/loop_content', 'listed_medium');
        
      endwhile;
      ?>
      
      <div class="loop_content-pagination">
      <?php
      //Page Navigation 
      echo paginate_links();
      ?>
      </div>
    </div>
    
    <?php else: ?>

    <div class="archive-notice">    
    
      <?php get_template_part('template_parts/feature', '404_notice'); ?>
    
    </div>
          
    <?php
      
    //End Standard Archive
    endif; endif;
    ?>

</div>

<?php endif;?>