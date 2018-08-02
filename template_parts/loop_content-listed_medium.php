<?php
//Repeating Variables
$scale_featured_image = get_field('scale_featured_image');
?>


<div class="loop_content-listed_medium">
  
  <?php if(has_post_thumbnail() || get_field('media_type', get_the_ID())): ?>
  
  <a class="listed_medium-featured_image " href="<?php the_permalink(); ?>"> 
    
    <div class="featured_image-badge"><?php vnv_badge($post->ID, 'badge-small'); ?></div>

    <div class="featured_image-title"><?php the_title();?></div>

    <?php 
      //Unscaled Feature Image  
      if($scale_featured_image)
        echo  '<div class="featured_image-unscaled_image" style="background-image:url(' . wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'large')[0]. '"></div>';
      ?>

    <div class="featured_image-image <?php if($scale_featured_image) echo 'effect-blur';?>" style="background-image:url( <?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'large')[0]?> )"></div>
    
    <?php if(get_field('media_type', $post->ID)) echo '<span class="featured_image-play_button"><i class="fa fa-play-circle-o"></i></span> ';?>

    <div class="featured_image-overlay"></div>

  </a>
    
  <?php else: ?>

  <a class="listed_medium-excerpt" href="<?php the_permalink(); ?>">
    <div class="excerpt-title">
      <?php the_title();?>
    </div>
    <div class="excerpt-badge">
      <?php vnv_badge(get_the_ID(), 'badge-small'); ?>
    </div>
  </a>

  <?php endif;?>
  
  <div class="listed_medium-post_footer row">
    <div class="post_footer-meta">
          
      <?php 
        
      //Set Footer Meta
      if(is_category()){
        
        //Show Author Info
        $authors = get_coauthors();    
        $numItems = count($authors);
        $i = 0;
        foreach ($authors as $author):
          
          //Conditionally show link to author
          if($author->type == 'guest-author'){
            echo $author->display_name;
          }else{
            echo '<a class="meta-author_link" href="'.get_author_posts_url($author->ID).'">'.$author->display_name.'</a>';
          }        
          
          //Conditionally add comma
          if(++$i != $numItems)
            echo ', ';
  
        //End Authors
        endforeach;
              
      }else{
        
        //Show Category
        if( !empty(get_the_category()) ){
          echo '<a href="' . esc_url( get_category_link( get_the_category()[0]->term_id ) ) . '">' . esc_html( get_the_category()[0]->name ) . '</a>';
        
        //Or Show Page Type
        }else{
          echo get_post_type();
        }
      }
      
      ?>
      
    </div>
  </div>
</div>