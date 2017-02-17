<?php
//TEMPORARY FIX: Add CSS to remove Caption and Description Fields
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
    .media-types-required-info,
    .wp_attachment_details p:nth-of-type(1),
    .attachment-info .setting[data-setting="caption"],
    .attachment-info .setting[data-setting="description"],
    .media-sidebar .setting[data-setting="caption"],
    .media-sidebar .setting[data-setting="description"] { 
      display: none !important; 
    }
    .acf-field-58a740bb96d82{
      margin-top: 10px !important;
      padding-top: 10px;
      border-top: 1px solid grey;
    }
  </style>';
}

?>