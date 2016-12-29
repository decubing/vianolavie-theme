<div class="loop_content-listed_large">
  
  <?php if(has_post_thumbnail() || get_field('media_type', $post->ID)):?>
  
  <a class="listed_large-featured_image" style="background-image:url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'large')[0];  ?>)" href="<?php the_permalink(); ?>"> 
    
    <?php get_badge($post->ID); ?>

    <?php if(get_field('media_type', $post->ID)) echo '<span class="button-play"><i class="fa fa-play-circle-o"></i></span> ';?>

  </a>
  
  <?php endif;?>
    
  <div class="listed_large-post_content">
    
    <?php
    //Get badge on posts without thumbails
    get_badge($post->ID);
    ?>

    <h2 class="post_content-title"><a href="<?php the_permalink();?>"> <?php echo get_limited_title($post->ID);?> </a></h2>
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
      ?>
      
      <a class="author_info-the_author" href="<?php echo get_author_posts_url($author->ID);?>">
        <span class="the_author-avatar" style="background-image:url(<?php echo get_avatar_url( $author->ID, array('size' => '120') ); ?>)"></span>
        <span class="the_author-name_and_roll"><?php echo $author->display_name;?> <span class="name_and_roll-the_role"><?php echo implode( ', ', get_userdata($author->ID)->roles);?></span></span>
      </a>
  
      <?php
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