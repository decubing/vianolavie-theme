<?php 
global $post;
if( get_field('media_type', $post->id)):
?>

  <div class="feature-media_masthead">
    
    <?php if( get_field('media_type' , $post->id) == 'YouTube Video' ): //Begin YouTube Video  ?>
  
    <iframe class="media_masthead-media_content" src="https://www.youtube.com/embed/<?php the_field('youtube_video_id', $post->id);?>" frameborder="0" allowfullscreen></iframe>
  
    <?php endif; //End YouTube Video  ?>
  
    <?php if( get_field('media_type', $post->id) == 'SoundCloud Audio' ): //Begin SoundCloud Audio ?>
  
    <iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php the_field('soundcloud_track_id', $post->id);?>&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
  
    <?php endif; //End SoundCloud Audio?>
  
    <?php 
      
    if( get_field('media_type', $post->id) == 'Custom Media' ): //Begin Custom Media 
    
      the_field('custom_embed_code', $post->id);
      
    endif; //End SoundCloud Audio
    ?>
  
    <div class="media_masthead-background" style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'medium')[0];  ?>)"></div> <!-- Conditional Element: If has featured Image --> 
  </div>

<?php endif;?>