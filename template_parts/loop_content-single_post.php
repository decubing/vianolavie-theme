<div class="loop_content-single_post">
  <div class="single_post-author_info">
  
    <?php vnv_author_info();?>
    
    <div class="author_info-badge">
      
      <?php vnv_badge(get_the_ID());?>
      
    </div>
  </div>
  <h1 class="single_post-the_title"><?php the_title(); ?></h1> 
  <div class="single_post-post_meta">
    <?php the_date('M d, Y');?> <span class="post_meta-divider">•</span> <?php the_category(', '); ?>
  </div>
  <div class="single_post-the_content">
        
    <?php   
    //Post Images
    get_template_part('template_parts/loop_content', 'post_media');
    
    //The Content
    the_content();    
    ?>
    
  </div>
  <div class="single_post-sharing_options">
    
    <?php
    //Sharing Options
    get_template_part('template_parts/feature', 'sharing_options');
    ?>
      
  </div>
  <div class="single_post-comments">
    
    <?php
    //Sharing Options
    get_template_part('template_parts/feature', 'comments');
    ?>
      
  </div>
</div>