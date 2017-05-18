<?php

function get_author_info($author){
      
  //Set Variables from WordPress
  $author_posts_url = get_author_posts_url($author->ID);
  $avatar_url       = get_avatar_url( $author->ID, array('size' => '120') );
  $author_display_name = $author->display_name;
  $author_roles     = $author->roles;

  //Find and Remove Unnecessary 
  $restricted_roles = array('bbp_keymaster','bbp_participant');
  $filtered_roles   = array_diff($author_roles, $restricted_roles);
  $cleaned_roles    = implode( ', ',$filtered_roles);

  //Display Guest Authors Differently from Regular Ones
  if($author->type == 'guest-author'){
    return
    '<div class="author_info-the_author">
      <span class="the_author-avatar" style="background-image:url(' . $avatar_url . ')"></span>
      <span class="the_author-name_and_role">' . $author_display_name . '<span class="name_and_role-the_role">Author</span></span>
    </div>';
  }else{
    return
    '<a class="author_info-the_author" href="' . $author_posts_url . '">
      <span class="the_author-avatar" style="background-image:url(' . $avatar_url . ')"></span>
      <span class="the_author-name_and_role">' . $author_display_name . '<span class="name_and_role-the_role">' . $cleaned_roles . '</span></span>
    </a>';    
  }
    
}

?>