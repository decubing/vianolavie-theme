<div class="loop_content-single_post">
  <div class="single_post-author_info">
  
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
    
    <div class="author_info-badge">
      
      <?php if(get_badge($post->id)) echo get_badge($post->id);?>
      
    </div>
  </div>
  <h1 class="single_post-the_title"><?php the_title(); ?></h1> 
  <div class="single_post-post_meta">
    <?php the_date('M d, Y');?> <span class="post_meta-divider">•</span> <?php the_category(', '); ?>
  </div>
  <div class="single_post-the_content">
        
    <?php 
    //Post Images
    get_template_part('template_parts/loop_content', 'post_images');

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
  <!--
  <div class="single_post-comments">
    <h3>Comments</h3>
    <div class="single_post-comments">
      <div class="comments-comment_entry row">
        <form class="comment_entry-comment_form">
          <div class="comment_form-input_group">
            <textarea class="input_group-input"></textarea>
            <span class="input_group-highlight"></span>
            <span class="input_group-bar"></span>
            <label class="input_group-label">Your Comment</label>
          </div>
          <button class="button-red comment_form-submit">Submit</button> 
          <button class="button comment_entry-cancel">Cancel</button>
        </form>
        <div class="comment_entry-user_favicon " style="background-image: url(http://clients.decubing.com/vianolavie/wp-content/uploads/2016/07/sample_thumbnail.jpg)"></div>
      </div>
      <div class="comments-comment_list">
        <div class="comment_list-single_comment table">
          <div class="single_comment-comment_meta table-cell">
            <div class="comment_meta-comment_date">10/22/17</div>
            <div class="comment_meta-comment_time">10:22 AM</div>
          </div>
          <div class="single_comment-comment_content table-cell">
            <p>Secondary line text lorem ipsum sic dapibus, neque id cursus faucibusas sadf asdf asd fas dfasdfasfasd fasdfasdfasdfasd fasfsdf</p>
            <p>Secondary line text lorem ipsum sic dapibus, neque id cursus faucibusas sadf asdf asd fas dfasdf asfasdfasdfasdfasd fasd fasfsdf</p>
  
            <div class="comment_content-comment_author">Joe Smith</div>
          </div>
          <div class="single_comment-user_favicon no_mobile">
            <div class="user_favicon-image image-circular table-cell" style="background-image: url(http://clients.decubing.com/vianolavie/wp-content/uploads/2016/07/sample_thumbnail.jpg)"></div>
          </div>
        </div>
        <div class="comment_list-single_comment table">
          <div class="single_comment-comment_meta table-cell">
            <div class="comment_meta-comment_date">10/22/17</div>
            <div class="comment_meta-comment_time">10:22 AM</div>
          </div>
          <div class="single_comment-comment_content table-cell">
             <p>Secondary line text lorem ipsum sic dapibus, neque id cursus faucibusas sadf asdf asd fas dfasdf asfasdfasd fasdfasdf asdfasfsdf</p>
            <p>Secondary line text lorem ipsum sic dapibus, neque id cursus faucibusas sadf asdf asd fas dfasdfasfasdfasdf asdfasd fasdfasfsdf</p>
            <div class="comment_content-comment_author">Joe Smith</div>
          </div>
          <div class="single_comment-user_favicon no_mobile">
            <div class="user_favicon-image image-circular table-cell" style="background-image: url(http://clients.decubing.com/vianolavie/wp-content/uploads/2016/07/sample_thumbnail.jpg)"></div>
          </div>
        </div>
        <div class="comment_list-single_comment table">
          <div class="single_comment-comment_meta table-cell">
            <div class="comment_meta-comment_date">10/22/17</div>
            <div class="comment_meta-comment_time">10:22 AM</div>
          </div>
          <div class="single_comment-comment_content table-cell">
            <p>Secondary line text lorem ipsum sic dapibus, neque id cursus faucibusas sadf asdf asd fas dfasdfasfasd fasdfas dfasdfas dfasfsdf</p>
            <p>Secondary line text lorem ipsum sic dapibus, neque id cursus faucibusas sadf asdf asd fas dfasdfasfasdfasd fasdfasd fasdfasf sdf</p>
            <div class="comment_content-comment_author">Joe Smith</div>
          </div>
          <div class="single_comment-user_favicon no_mobile">
            <div class="user_favicon-image image-circular table-cell" style="background-image: url(http://clients.decubing.com/vianolavie/wp-content/uploads/2016/07/sample_thumbnail.jpg)"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  -->
</div>