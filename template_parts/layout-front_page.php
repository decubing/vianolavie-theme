<?php 
if(is_front_page()):

  //Masthead Slider Feature
  get_template_part('template_parts/feature', 'masthead_posts');
?>

<div class="layout-front_page">
  <div class="front_page-top_content">
    <div class="top_content-voice_of_the_week">
      <div class="voice_of_the_week-label">
        Voice of the Week
      </div>
      <div class="voice_of_the_week-loop_content">
        
        <?php
        //Voice of the Week Loop
        $post_object = get_field('voice_of_the_week');
        if( $post_object ){
          $post = $post_object;
          setup_postdata( $post );
          get_template_part('template_parts/loop_content','listed_large'); 
          wp_reset_postdata();
        }
        ?>
      
      </div>    
    </div>
    <div class="top_content-recent_posts">
      <div class="recent_posts-feature">
      
        <?php 
        //Recent Posts 
        get_template_part('template_parts/feature','recent_posts');
        ?>
        
      </div>
    </div>
  </div>
  <div class="front_page-center_content">
    <div class="center_content-content">
      <div class="content-info_area">
        
        <?php the_field('info_area');?>
        
      </div>
      <div class="content-quick_links">
        
        <?php
        // Quick Links
        if( have_rows('quick_links') ){
          while ( have_rows('quick_links') ) : the_row();
            echo '<a class="quick_links-single" href="'.get_sub_field('link_url').'"><i class="fa '.get_sub_field('link_icon').'"></i>'.get_sub_field('link_text').'</a>';
          endwhile;
        }
        ?>
      </div>
    </div>
  </div>
  <div class="front_page-bottom_content">
    <div class="bottom_content-feature">

      <?php
      //Suggested Content
      get_template_part('template_parts/feature', 'suggested_content')
      ?>
      
    </div>
  </div>
</div>

<?php endif; ?>