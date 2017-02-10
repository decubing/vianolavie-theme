<?php
//Post Images 
if( have_rows('post_images') ):
  
  //Repeated Variables
  $alignment_options = get_field('alignment_options')[0];
?>

<div class="loop_content-post_images <?php echo $alignment_options; ?>">

  <?php
  //Start Post Image Loop
  while(have_rows('post_images')): the_row();

    //Repeated Variables
    $image = get_sub_field('image');
    if($alignment_options == 'full_width'){
      $image_size = $image['sizes']['large'];
    }else{
      $image_size = $image['sizes']['medium'];
    }
  ?>
  
  <div class="post_images-single_image">
    <a class="single_image-thumb <?php if($alignment_options != 'full_width') echo 'fancybox'; ?>" rel="gallery" href="<?php echo $image['url']?>" title="<?php echo $image['title']?>">
      <img class="thumb-image" src="<?php echo $image_size; ?>" alt="<?php echo $image['alt']; ?>"  />      
    </a>
    
    <?php
    //Image Caption
    if($image['caption'] != '')
      echo '<div class="single_image-caption">'.$image['caption'].'</div>'
    ?>
    
    <div class="single_image-attribution">
      
      <?php
      //Conditional Attributions
      if(get_sub_field('image_credit'))
        echo '<div class="attribution-credit">Credit: '.get_sub_field('image_credit').'</div>';

      if(get_sub_field('image_source'))
        echo '<div class="attribution-source">Source: '.get_sub_field('image_source').'</div>';
      ?>
      
    </div>
  </div>

  <?php
  //End Post Image Loop
  endwhile;
  ?>
    
</div>

<?php endif;?>