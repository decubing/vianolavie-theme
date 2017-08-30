<?php
// register new taxonomy which applies to attachments
function vnv_add_location_taxonomy() {
	$labels = array(
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

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'query_var' => 'true',
		'rewrite' => 'true',
		'show_admin_column' => 'true',
	);

	register_taxonomy( 'media_label', 'attachment', $args );
}
add_action( 'init', 'vnv_add_location_taxonomy' );
?>