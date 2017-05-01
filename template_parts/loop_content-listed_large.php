<?php
//Repeating Variables
$scale_featured_image = get_field('scale_featured_image');
?>


<div class="loop_content-listed_large">
  
  <?php if(has_post_thumbnail() || get_field('media_type', $post->ID)):?>
  
  <a class="listed_large-featured_image " href="<?php the_permalink(); ?>"> 
    
    <div class="featured_image-badge">
      
      <?php get_badge($post->ID); ?>
      
    </div>

    <?php 
      //Unscald Feature Image  
      if($scale_featured_image)
        echo  '<div class="featured_image-unscaled_image" style="background-image:url(' . wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'large')[0]. '"></div>';
      ?>

    <div class="featured_image-image <?php if($scale_featured_image) echo 'effect-blur';?>" style="background-image:url( <?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'large')[0]?> )"></div>
    
    <?php if(get_field('media_type', $post->ID)) echo '<span class="featured_image-play_button"><i class="fa fa-play-circle-o"></i></span> ';?>

  </a>
  
  <?php endif;?>
    
  <div class="listed_large-post_content">
    
    <a class="post_content-title"  href="<?php the_permalink();?>">

      <?php
      //Get badge on posts without thumbails
      if(!has_post_thumbnail() && !get_field('media_type', $post->ID)){
      ?>
      
      <span class="title-badge"><?php get_badge($post->ID); ?></span>
      
      <?php
      }
      
      the_title()
      ?>
    </a>
    <div class="post_content-meta">
      
      <?php the_category(', '); the_date('m/d/Y', ' &#8226; ');?>
            
    </div>
    <div class="post_content-excerpt">
      
      <?php echo get_the_excerpt();?> 
      
      <a href="<?php the_permalink(); ?>">Read More &raquo;</a>
      
    </div>
  </div>
  <div class="listed_large-post_footer row">

    <div class="post_footer-author_info">
      
      <?php
      //Begin Authors
      $authors = get_coauthors();    
      foreach ($authors as $author):
      
        echo get_author_info($author->ID);

      //End Authors
      endforeach;
      ?>
      
    </div>
      
    <?php
    //Page Sharing Options
    get_template_part('template_parts/feature', 'sharing_options');
    ?>
    
  </div>
</div>