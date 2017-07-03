<?php
//======================================================================
// Define Custom Roles
//======================================================================

//Add VNV Roles
add_action('init','add_vnv_custom_roles');
function add_vnv_custom_roles(){

  //Check if roles weren't already set  
  if(!get_option('vnv_roles_are_set')){
    
    //Add Teacher Role
    add_role('vnv_teacher', 'VNV Teacher', array(
        'create_posts' => true,
        'create_users' => true,
        'delete_others_posts' => true,
        'delete_posts' => true, 
        'delete_private_posts' => true,
        'edit_others_posts' => true,
        'edit_post_subscriptions' => true,
        'edit_posts' => true,
        'edit_private_posts' => true,
        'manage_categories' => true,
        'manage_links' => true,
        'moderate_comments' => true,
        'read' => true,
        'read_private_posts' => true,
        'unfiltered_html' => true,
        'upload_files' => true
    ));
    
    //Add Student Role
    add_role('vnv_student', 'VNV Student', array(
        'create_posts' => true,
        'edit_posts' => true,
        'read' => true,
        'unfiltered_html' => true,
        'upload_files' => true
    ));
    
    //Save option to make sure roles aren't reset
    update_option('vnv_roles_are_set', true);
  }
}

//======================================================================
// Create Ready For Editor Status
//======================================================================

//Create "Ready For Editor" status  
function register_vnv_ready_for_editor_status(){
	register_post_status( 'ready_for_editor', array(
		'label'                     => 'Ready for Editor',
		'public'                    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Ready for Editor <span class="count">(%s)</span>', 'Ready for Editor <span class="count">(%s)</span>' ),
	) );
}
add_action( 'init', 'register_vnv_ready_for_editor_status' );


// Add Ready for Editor Post Status to Post Dropdown
add_action('admin_footer-post.php', 'append_vnv_ready_for_editor_status_to_list');
function append_vnv_ready_for_editor_status_to_list(){
  global $post;
  $complete = '';
  $label = '';
    if($post->post_status == 'ready_for_editor'){
      $complete = ' selected=\"selected\"';
      $label = '<span id=\"post-status-display\"> Ready for Editor</span>';
    }
    echo '
    <script>
    jQuery(document).ready(function($){
      $("select#post_status").append("<option value=\"ready_for_editor\" '.$complete.'>Ready for Editor</option>");
    });
    </script>
    ';
}

//Add Ready for Editor Post Status to Admin Posts lists
add_filter( 'display_post_states', 'display_vnv_ready_for_editor_status' );
function display_vnv_ready_for_editor_status( $states ) {
  global $post;
  $arg = get_query_var( 'post_status' );
  if($arg != 'ready_for_editor'){
    if($post->post_status == 'ready_for_editor'){
      return array('Ready for Editor');
    }
  }
  return $states;
}

//Add Ready for Editor Post Status to Bulk Edit
add_action( 'admin_footer-edit.php', 'add_vnv_ready_for_editor_status_bulk_edit' );
function add_vnv_ready_for_editor_status_bulk_edit() {
	echo '
	<script>
	jQuery(document).ready(function($){
	$(".inline-edit-status select ").append("<option value=\"ready_for_editor\">Ready for Editor</option>");
	});
	</script>
	';
}  

//======================================================================
// Prevent Non-Admins from Publishing Posts
//======================================================================

//Remove Quick Edit
function remove_quick_edit( $actions ) {
  unset($actions['inline hide-if-no-js']);
  return $actions;
}

//Remove Publish Button
function remove_save_button(){   
 echo'<style>#publish{display:none }</style>';
 
}

//Activate Restrictions for VNV Teachers
if ( in_array( 'vnv_teacher', (array) wp_get_current_user()->roles ) ) {
  add_filter('post_row_actions','remove_quick_edit',10,1);
  add_filter( 'bulk_actions-edit-post', '__return_empty_array' );
  add_action( 'admin_print_scripts', 'remove_save_button' );
}

?>