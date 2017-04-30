<?php
//Media Items 
if( have_rows('media_items') ):
  
  //Repeated Variables
  $media_alignment = get_field('media_alignment')[0];
?>

<div class="loop_content-post_media <?php echo $media_alignment; ?>">

  <?php
  //Start Post Image Loop
  while(have_rows('media_items')): the_row();

    //Repeated Variables
    $media_type = get_sub_field('media_type');
    $image = get_sub_field('image');
    $audio = get_sub_field('audio');
    $embed_code = get_sub_field('embed_code'); 
    $media_caption = get_sub_field('media_caption');   
    $image_credit = get_field('image_credit', $image['ID']);   
    $audio_credit = get_field('image_credit', $audio['ID']);   
    
    //Begin Image Display
    if($media_type == 'image'):
      
      //Set Image size
      if($media_alignment == 'full_width'){
        $image_size = $image['sizes']['large'];
      }else{
        $image_size = $image['sizes']['medium'];
      }
    ?>   
       
    <div class="post_media-image_item">
      <a class="image_item-thumb <?php if($media_alignment != 'full_width') echo 'fancybox'; ?>" rel="gallery" href="<?php echo $image['url']?>" title="<?php echo $image['title']?>">
        <img class="thumb-image" src="<?php echo $image_size; ?>" alt="<?php echo $image['alt']; ?>"  />      
      </a>
      
      <div class="image_item-meta">
        
        <?php
        //Image Caption
        if($media_caption)
          echo '<div class="meta-media_caption">'.$media_caption.'</div>';
  
        //Conditional Attributions
        if($image_credit)
          echo '<div class="meta-credit">'.$image_credit.'</div>';
        ?>
        
      </div>
    </div>
    
    <?php
    //End Image Dsiplay
    endif;
    
    //Begin Audio Display
    if($media_type == 'audio'):  
    ?>
  
    <div class="post_media-audio_item">
      <audio class="audio_item-player" controls>
        <source src="<?php echo $audio['url']?>" type="">
        Your browser does not support this audio format.      
      </audio>
      <div class="audio_item-meta">
                    
      <?php
      //Audio Caption
      if($media_caption)
        echo '<div class="meta-media_caption">'.$media_caption.'</div>';

      //Conditional Attributions
      if($audio_credit)
        echo '<div class="meta-credit">'.$audio_credit.'</div>';
      ?>
      
      </div>
    </div>  
    
    <?php
    //End Audio Dsiplay
    endif;
    
    //Begin Audio Display
    if($media_type == 'embed_code'):  
    ?>
  
    <div class="post_media-embed_code">

      <div class="embed_code-meta">
                    
      <?php
      //Display Embed Code
      echo $embed_code;
      ?>
      
      </div>
    </div>  
    
    <?php
    //End Audio Dsiplay
    endif;
    ?>
  
  <?php
  //End Post Image Loop
  endwhile;
  ?>
    
</div>

<?php endif;?> 