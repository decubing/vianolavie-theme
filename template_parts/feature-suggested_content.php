<div class="feature-suggested_content">
  <div class="suggested_content-title">
    Suggested Content
  </div>
  <div class="suggested_content-loop_content">
    
  <?php 
  //Suggested Content Loop
  $the_query = new WP_Query( array( 
    'post__not_in'  => get_field('not_suggested_content'),
    'post_type'     => 'post',
    'posts_per_page'=> 6,
    'offset'        => 3,
    'ignore_sticky_posts' => 1,
    'meta_query' => array(
  		array(
  			'key'     => 'front_page_placement',
  			'value'   => array( 'Masthead Scroller', 'Featured Voice' ),
  			'compare' => 'NOT IN',
  		),
  	),

  ));
  if ( $the_query->have_posts() ){
    while ( $the_query->have_posts() ){ 
      $the_query->the_post();
      get_template_part('template_parts/loop_content', 'listed_medium');
      wp_reset_postdata(); 
    }
  }
  ?>
  
  </div>

</div>
