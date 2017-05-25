<?php
if(comments_open()):
?>


<div class="feature-comments">
  
  <?php
  //Comment Form
  $comment_settings = array(
    'logged_in_as' => '',
     'must_log_in' => '<div class="comments-notice">' . sprintf( __( 'You must <a href="%s">login</a> to post a comment.' ),wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )) . ' Need a ViaNolaVie account? <a href="'.get_permalink( get_page_by_path( 'register') ).'">Click here</a> to signup.</div>',
    'title_reply' => 'Comments',
    'comment_field' => '<div class="comment-input_group"><textarea class="input_group-input" id="comment" name="comment" aria-required="true"></textarea><span class="input_group-highlight"></span><span class="input_group-bar"></span><label class="input_group-label" for="comment">' . _x( 'Your Comment', 'noun' ) . '</label></div>' 
  ); 
  comment_form($comment_settings);
?>

  <div class="comments-comment_list">
    
  <?php
  //Comment List
  foreach(get_comments('post_id='.$post->ID) as $comment) :
  ?>
  
    <div class="comment_list-single_comment">
      <div class="single_comment-comment_meta">
        <div class="comment_meta-comment_date"><?php comment_date('n/j/y', $comment->comment_ID);?></div>
        <div class="comment_meta-comment_time"><?php comment_date('h:i');?></div>
      </div>
      <div class="single_comment-comment_content">
        
        <?php echo apply_filters('the_content', $comment->comment_content);?>
        
        <div class="comment_content-comment_author"><?php echo($comment->comment_author);?></div>
      </div>
      <div class="single_comment-user_favicon">
        <div class="user_favicon-image" style="background-image: url(<?php echo get_avatar_url( $comment->user_id, array('size' => '120') ); ?>)"></div>
      </div>
    </div>
    
  <?php 
  //End Comment List
  endforeach;	
  ?>
  
</div>

</div>

<?php
endif;
?>