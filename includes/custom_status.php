<?php
// Register Custom Status
function custom_post_status() {

	$args = array(
		'label'                     => _x( 'Archived', 'Status General Name', 'vnv' ),
		'label_count'               => _n_noop( 'Archived (%s)',  'Archived (%s)', 'vnv' ), 
		'public'                    => true,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'exclude_from_search'       => false,
	);
	register_post_status( 'archived', $args );

}
add_action( 'init', 'custom_post_status', 0 );

// Add Custom Post Status to Post Dropdown
add_action('admin_footer-post.php', 'jc_append_post_status_list');
function jc_append_post_status_list(){
  global $post;
  $complete = '';
  $label = '';
    if($post->post_status == 'archived'){
      $complete = ' selected=\"selected\"';
      $label = '<span id=\"post-status-display\"> Archived</span>';
    }
    echo '
    <script>
    jQuery(document).ready(function($){
      $("select#post_status").append("<option value=\"archived\" '.$complete.'>Archived</option>");
      $(".misc-pub-section label").append("'.$label.'");
    });
    </script>
    ';
}
//Add Custom Post Status to Admin Posts lists
add_filter( 'display_post_states', 'jc_display_archive_state' );
function jc_display_archive_state( $states ) {
  global $post;
  $arg = get_query_var( 'post_status' );
  if($arg != 'archived'){
    if($post->post_status == 'archived'){
      return array('Archived');
    }
  }
  return $states;
}

//Add Custom Post Status to Bulk Edit
add_action( 'admin_footer-edit.php', 'jc_append_post_status_bulk_edit' );
function jc_append_post_status_bulk_edit() {
	echo '
	<script>
	jQuery(document).ready(function($){
	$(".inline-edit-status select ").append("<option value=\"archived\">Archived</option>");
	});
	</script>
	';
}

?>