<?php

//Default Width, Title Tag, and Other Setup Functions
include_once('includes/theme_setup.php' );

//Enqueue Scripts and Styles
include_once('includes/enqueue.php' );

//Register Custom Menues
include_once('includes/custom_menus.php' );

//Update Customizer
include_once('includes/customizer.php' );

//Require Plugins
include_once('includes/require_plugins.php' );

//Admin Notices
include_once('includes/admin_notices.php' );

//WYSIWG Settings
include_once('includes/wysiwyg_settings.php' );

//Custom Function to get acf post badges values
include_once('includes/vnv_badge.php' );

//Custom Function to get a with a limited character count
include_once('includes/vnv_limited_title.php' );

//Custom Captions and other Media Settings
include_once('includes/media_settings.php' );

//Custom Author Info Area
include_once('includes/vnv_author_info.php' );

//Schedule Archive Status
include_once('includes/schedule_archive.php' );

//Add and define Custom Roles
include_once('includes/custom_roles.php');

//Add and define Custom Taxonomies
include_once('includes/custom_taxonomies.php');

//Add Open Graph Meta
include_once('includes/vnv_og_meta.php');

?>