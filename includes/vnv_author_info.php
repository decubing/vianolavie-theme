<?php

function vnv_author_info(){
  //Get Loop Inforatmion
  global $post;

  //Make Sure Co-Authors Exists
  if( !empty(get_coauthors($post->ID)) ){    

    //Setup Co- Author Info
    foreach(get_coauthors($post->ID) as $author){
      
      //Guest Author
      if($author->type == 'guest-author'){
        echo
        '<div class="author_info-the_author">
          <span class="the_author-avatar" style="background-image:url(' . get_avatar_url( $author->ID, array('size' => '120') ) . ')"></span>
          <span class="the_author-name_and_role">' . $author->display_name . '<span class="name_and_role-the_role">Author</span></span>
        </div>';
        
      //Standard WP Author
      }else{
      
        //Cleanup Role Content
        $author_roles = get_userdata($author->ID)->roles;
        $restricted_roles = array('bbp_keymaster','bbp_participant');
        $filtered_roles   = array_diff($author_roles, $restricted_roles);
        $cleaned_roles    = implode( ', ', $filtered_roles);
        
        //Display Standard Author
        echo
        '<a class="author_info-the_author" href="' . get_author_posts_url($author->ID) . '">
          <span class="the_author-avatar" style="background-image:url(' . get_avatar_url( $author->ID, array('size' => '120') ) . ')"></span>
          <span class="the_author-name_and_role">' . $author->display_name . '<span class="name_and_role-the_role">' . $cleaned_roles . '</span></span>
        </a>';    
      }
      
    }
    
  }else{
    'Co-Authors Plugin Must Be Installed!';
  }
}
?>