<?php 
  
//Declare Pagination Variables
function has_older_posts($the_query){
  if( ($the_query->query['paged'] == 1 && $the_query->paged > 1) || $the_query->query['paged'] != $the_query->max_num_pages ){
    return 1;
  }
}
function has_newer_posts($the_query){
  if( $the_query->query['paged'] > 1 ){
    return 1;
  }
} 

//Conditionally Start Pagination 
if(has_older_posts($the_query) || has_newer_posts($the_query)): 

?>
<!-- Does not extend -->
<div class="loop_content-pagination row">
    
  <?php 
  
    //Condition to display 'Older Posts' button
    if ( has_older_posts($the_query) ) 
      echo '<a href="' . get_pagenum_link($the_query->query['paged']+1) . '" class="button pagination-older_posts"><i class="fa fa-chevron-left"></i> Older Posts</a>';

    //Condition to display 'Newer Posts' button
    if ( has_newer_posts($the_query) )
      echo '<a href="' . get_pagenum_link($the_query->query['paged']-1) .'" class="button pagination-newer_posts">Newer Posts <i class="fa fa-chevron-right"></i></a>';
    
  ?>

</div>

<?php endif; ?>