<?php

function get_author_info($author_id){
  
  //Set Variables from WordPress
  $author_posts_url = get_author_posts_url($author_id);
  $avatar_url = get_avatar_url( $author_id, array('size' => '120') );
  $author_display_name = get_userdata($author_id)->display_name;
  $author_roles = get_userdata($author_id)->roles;

  
  //Find and Remove Unnecessary 
  $search_restricted_roles = array_search('hello', $author_roles);
  unset( $author_roles[$search_restricted_roles] );
  $clean_author_roles = implode( ', ',$author_roles);

    return
    '<a class="author_info-the_author" href="' . $author_posts_url . '">
      <span class="the_author-avatar" style="background-image:url(' . $avatar_url . ')"></span>
      <span class="the_author-name_and_roll">' . $author_display_name . '<span class="name_and_roll-the_role">' . $clean_author_roles . '</span></span>
    </a>';
}

?>