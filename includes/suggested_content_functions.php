<?php

// On initialization, create '*vnv_visitor_posts' and '*vnv_visitor_tags' tables
// NOTE Once this has been run once, doesn't need to be run on init anymore
function intialize_suggested_content(){
  global $wpdb;
  global $table_prefix;

  //Creates a table to store all posts visited by specific IP addresses
  $wpdb->query(
    "CREATE TABLE IF NOT EXISTS {$table_prefix}vnv_visitor_posts(
      IP VARCHAR(40) NOT NULL, 
      post_id BIGINT UNSIGNED NOT NULL,
      FOREIGN KEY (post_id) REFERENCES {$table_prefix}posts(ID),
      CONSTRAINT PK_Pageview PRIMARY KEY (IP, post_id)
    )"
  );

  // Creates a view containing IPs, visited posts, and associated tags
  $wpdb->query(
    "CREATE OR REPLACE VIEW {$table_prefix}vnv_visitor_tags AS
      SELECT vnv.IP, vnv.post_id, tt.term_taxonomy_id AS tag_id
      FROM {$table_prefix}vnv_visitor_posts as vnv
      JOIN {$table_prefix}term_relationships as tr
        ON tr.object_id = vnv.post_id
      JOIN {$table_prefix}term_taxonomy as tt
        ON tt.taxonomy = 'post_tag'
        AND tt.term_taxonomy_id = tr.term_taxonomy_id"
  );
}
add_action('init', 'intialize_suggested_content');


// Callback for adding suggested content. Executed when Ajax request comes back from page.
function add_suggested_content_cb($data){
  global $wpdb;
  global $table_prefix;
  
  // Validate nonce
  check_ajax_referer( "NOLA 4 LIFE", 'nonce' );
  $visitor_ip = sanitize_text_field( $_POST['ip'] );
  $post_id = sanitize_text_field( $_POST['post'] );
  
  // Check if this visitor (using their IP as a proxy) has visited this post before
  $visitor_rows = $wpdb->get_results(
    "SELECT IP, post_id FROM {$table_prefix}vnv_visitor_posts
      WHERE IP = \"{$visitor_ip}\"
      AND post_id = {$post_id}"
  );

  // Insert a new entry for the IP/post if none was found
  if(empty($visitor_rows)){
    $res = $wpdb->insert(
      "{$table_prefix}vnv_visitor_posts",
      array(
        'IP' => $visitor_ip,
        'post_id' => $post_id
      ),
      array(
        '%s',
        '%d'
      )
    );
  }
  // Stop execution
  wp_die();
}
// Register function for both logged in and logged out users
add_action('wp_ajax_add_suggested', 'add_suggested_content_cb');
add_action('wp_ajax_nopriv_add_suggested', 'add_suggested_content_cb');

// Adds Post/IP combination to vnv_visitor_posts table for Suggested Content use
// Called by layout-single.php
function add_suggested_content(){
  global $wpdb;
  
  $visitor_ip = get_ip_address(); // Get user's IP
  $current_post_id = get_the_ID(); // Get current post ID
  $nonce = wp_create_nonce("NOLA 4 LIFE"); //Set nonce for AJAX request
  $wpdata = array(
    'nonce' => $nonce,
    'ip' => $visitor_ip,
    'post' => $current_post_id,
    'ajaxurl' => admin_url('admin-ajax.php')
  );

  // Add script to page: sends request to add to visit to database six seconds after page load
  wp_enqueue_script( 'vnv-addSuggested', get_template_directory_uri().'/scripts/addSuggested.js', array('jquery') );	
  wp_localize_script( 'vnv-addSuggested', 'wpdata', $wpdata );
}

// Return Suggested Content
// Called by feature-suggested_content.php
function get_suggested_content(){
  global $wpdb;
  global $table_prefix;
  
  $visitor_ip = get_ip_address();
    
  /**
   * STEP 1: Get ranked list of tag IDs for user (tag_id with tag_count from vnv_visitor_tags)
   * STEP 2: Get all posts with ranked tags (join wp_term_relationships on tag_id)
   * STEP 3: Filter out unpublished posts (join wp_posts on object_id and status = 'publish')
   * STEP 4: Filter out visited posts for user (left outer join on vnv_visitor_posts)
   * Return post IDs (wp_term_relationships.object_id)
   * Can choose how many top tags and how many suggested posts to return
   */
  $NO_OF_TOP_TAGS = 5;
  $MAX_RESULTS = 3;
  $post_rows = $wpdb->get_results(
    "SELECT
      rels.object_id
    FROM 
      (SELECT tag_id, COUNT(tag_id) AS tag_count
      FROM {$table_prefix}vnv_visitor_tags
      WHERE IP = \"{$visitor_ip}\"
      GROUP BY tag_id
      ORDER BY tag_count DESC
      LIMIT {$NO_OF_TOP_TAGS}) AS tc
    INNER JOIN {$table_prefix}term_relationships AS rels
      ON rels.term_taxonomy_id = tc.tag_id
    INNER JOIN {$table_prefix}posts AS p
      ON p.ID = rels.object_ID
      AND p.post_status = 'publish'
    LEFT JOIN {$table_prefix}vnv_visitor_posts as vp
      ON vp.post_id = rels.object_id
      WHERE vp.post_id IS NULL
    ORDER BY tag_count DESC
    LIMIT {$MAX_RESULTS}"
  );

  // Get post IDs as an array
  $post_list = array();
  foreach ($post_rows as $row) {
    array_push($post_list, $row->object_id);
  }

  // Query for the returned posts, ignoring stickied posts
  $query = new WP_Query( array( 'post__in' => $post_list, 'ignore_sticky_posts' => true ) );
  return $query;
}

// Modified from https://stackoverflow.com/questions/1634782/what-is-the-most-accurate-way-to-retrieve-a-users-correct-ip-address-in-php/2031935#2031935
function get_ip_address(){
  foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
      if (array_key_exists($key, $_SERVER) === true){
          foreach (explode(',', $_SERVER[$key]) as $ip){
              $ip = trim($ip); // just to be safe
              return $ip;
          }
      }
  }
}
?>