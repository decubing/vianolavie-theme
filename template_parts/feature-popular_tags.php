<?php

$tags = get_tags('orderby=count&order=DESC&number=30'); 

if ( $tags ):

?>

<div class="feature-popular_tags">
  <div class="popular_tags-title table-cell ">Trending Topics</div>
  <div class="popular_tags-tag_content table-cell">
    <div class="tag_content-wrapper">
      
      <?php
        
      //Start Tag Loop
      foreach ($tags as $tag):
        
      ?>
      
      <a class="tag_content-title" href="<?php echo get_tag_link( $tag->term_id ); ?>"><?php echo $tag->name; ?></a>

      <?php	
        
      //End Tag Loop 
      endforeach;
      
      ?>
      
    </div>
  </div>
</div>

<?php
  
endif;

?>
