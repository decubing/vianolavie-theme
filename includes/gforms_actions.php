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