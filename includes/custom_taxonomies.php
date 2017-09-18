<?php
// Register new taxonomies
function vnv_add_location_taxonomy() {
  
  //Attachment Taxonomy
	$attachment_labels = array(
		'name'              => 'Media Labels',
		'singular_name'     => 'Media Label',
		'search_items'      => 'Search Labels',
		'all_items'         => 'All Labels',
		'parent_item'       => 'Parent Label',
		'edit_item'         => 'Edit Label',
		'update_item'       => 'Update Label',
		'add_new_item'      => 'Add New Label',
		'new_item_name'     => 'New Label Name',
		'menu_name'         => 'Media Labels',
	);
	$attachment_args = array(
		'labels' => $attachment_labels,
		'hierarchical' => true,
		'query_var' => 'true',
		'rewrite' => 'true',
		'show_admin_column' => 'true',
	);
	register_taxonomy( 'media_label', 'attachment', $attachment_args );

  //Post Badge Taxonomy
	$badge_labels = array(
		'name'              => 'Badges',
		'singular_name'     => 'Badge',
		'search_items'      => 'Search Badges',
		'all_items'         => 'All Badges',
		'parent_item'       => 'Parent Badge',
		'edit_item'         => 'Edit Badge',
		'update_item'       => 'Update Badge',
		'add_new_item'      => 'Add New Badge',
		'new_item_name'     => 'New Badge Name',
		'menu_name'         => 'Badges',
	);
	$badge_args = array(
		'labels' => $badge_labels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => true,
	);
	register_taxonomy( 'badge', 'post', $badge_args );
	
	
}
add_action( 'init', 'vnv_add_location_taxonomy' );


//Show Badge Taxonomy in Select

?>