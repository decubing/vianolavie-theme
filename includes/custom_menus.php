<?php

function register_vnv_menu() {
  register_nav_menu('primary_menu',__( 'Primary Menu' ));
}
add_action( 'init', 'register_vnv_menu' );
  
?>