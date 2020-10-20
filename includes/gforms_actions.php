<?php

// Add the class from the regsistration form to a user's classes ACF field.
// Annoyingly, this field is only accessible via an ID from this hook.
// On prod this field's ID is 3
add_action( 'gform_user_registered', 'vnv_add_class_on_registration', 10, 4 );
function vnv_add_class_on_registration( $user_id, $feed, $entry, $user_pass ) {
  $class = $entry[3]; // gravity forms field ID
  $acf_user_id = "user_$user_id";
  if ($class) {
    // update_sub_field(['classes', 1, 'class'], $class, $acf_user_id);
    update_field('classes', [['class' => $class]], $acf_user_id);
  }
}

// find users with a given class name in the "Classes" ACF field
// LIMITATION: only indexes first 9 class fields (should be enough)
add_filter( 'pre_get_users', 'vnv_filter_users_by_classes', 10, 1);
function vnv_filter_users_by_classes( $user_query ) {

  // Return early if no class search string OR we have a meta_query already
  if (empty($_REQUEST['class-s']) || !empty($user_query->meta_query->queries)) {
    return $user_query;
  }

  $class_args = [];
  for ($i=0; $i < 9; $i++) { 
    $class_args[] = [
      'key'     => "classes_${i}_class",
      'value'   => $_REQUEST['class-s'],
      'compare' => '='
    ];
  }

  $meta_query = array_merge(['relation' => 'OR'], $class_args);
  $user_query->set('meta_query', $meta_query);
}

// Temporary script: run once to update classes field with class
add_action( 'init', 'vnv_class_to_classes' );
function vnv_class_to_classes() {
  if ( get_option('vnv_class_update_script') !== '2.0' ) {
    // get all users
    // foreach user, if 'class' meta, send it to 'classes; ACF meta
    $users = get_users(['fields' => 'ID']);
    foreach ( $users as $user_id ) {
      $class = get_user_meta( $user_id, 'class', true );
      if ($class) {
        update_field('classes', [['class' => $class]], "user_$user_id");
      }
    }
    update_option( 'vnv_class_update_script', '2.0' );
  }
}

// Used (in userClassesFilter.js, via enqueue.php) to get classes for filtering on the admin-side Users screen
// Returns an innerHTML string for easy appending to the DOM, as this is all we need this for
function vnv_get_all_classes() {
  global $wpdb;
  $result = $wpdb->get_col(
    "SELECT DISTINCT um.meta_value 
    FROM wp_usermeta um
    WHERE um.meta_key IN (
      'classes_0_class', 'classes_1_class',
      'classes_2_class', 'classes_3_class',
      'classes_4_class', 'classes_5_class',
      'classes_6_class', 'classes_7_class',
      'classes_8_class')
    ORDER BY um.meta_value ASC"
  );
  
  $HTMLstring = "<select name=\"class-s\" id=\"user-class-search-input\">\n<option value=\"\">Select a class...</option>\n";
  foreach ($result as $class) {
    if (strpos($class, '"') !== false) continue;
    $class = htmlspecialchars($class, ENT_QUOTES);
    $HTMLstring .= "<option value=\"$class\">$class</option>\n";
  }
  // Close select tag
  $HTMLstring .= '</select>';

	return $HTMLstring;
}