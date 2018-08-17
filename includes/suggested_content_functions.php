<?php

// On initialization, create '*vnv_visitor_posts' and '*vnv_visitor_terms' tables
// NOTE Once this has been run once, doesn't need to be run on init anymore
function intialize_suggested_content(){
  global $wpdb;
  global $table_prefix;

  //Creates a table to store all posts visited by specific IP addresses
  $wpdb->query(
    "CREATE TABLE IF NOT EXISTS {$table_prefix}vnv_visitor_posts(
      `entry_id` INT PRIMARY KEY AUTO_INCREMENT,
      `IP` VARCHAR(40) NOT NULL,
      `user_id` BIGINT(20),
      `post_id` BIGINT UNSIGNED NOT NULL,
      `high_attention` BOOLEAN NOT NULL,
      FOREIGN KEY (post_id) REFERENCES {$table_prefix}posts(ID),
      CONSTRAINT uc_pageview UNIQUE (IP, post_id, `user_id`, high_attention)
    )"
  );

  // Creates a view containing IPs, visited posts, and associated terms
  $wpdb->query(
    "CREATE OR REPLACE VIEW {$table_prefix}vnv_visitor_terms AS
      SELECT 
        vnv.IP, 
        vnv.`user_id`,
        vnv.post_id,
        vnv.high_attention,
        tt.term_taxonomy_id,
        tt.term_id,
        tt.taxonomy,
        t.name
      FROM {$table_prefix}vnv_visitor_posts as vnv
      JOIN {$table_prefix}term_relationships as tr
        ON tr.object_id = vnv.post_id
      JOIN {$table_prefix}term_taxonomy as tt
        ON tt.taxonomy IN ('post_tag', 'category')
        AND tt.term_taxonomy_id = tr.term_taxonomy_id
      JOIN {$table_prefix}terms as t
        ON t.term_id = tt.term_id"
  );

}
add_action('init', 'intialize_suggested_content');


// Callback for adding suggested content. Executed when Ajax request comes back from page.
function add_suggested_content_cb($data){
  global $wpdb;
  global $table_prefix;
  
  // Validate nonce
  check_ajax_referer( "NOLA 4 LIFE", 'nonce' );
  $visitor_ip = get_ip_address();
  $post_id = sanitize_text_field( $_POST['post'] );
  $visitor_user_id = sanitize_text_field( $_POST['user'] );
  $high_attention = isset($_POST['high_attention']) ? 1 : 0;
  
  // Check if this visitor has visited this post before at this attention level
  if ($visitor_user_id) {
    // Use user ID if available
    $visitor_rows = $wpdb->get_results(
      "SELECT IP, post_id FROM {$table_prefix}vnv_visitor_posts
        WHERE post_id = {$post_id}
        AND `user_id` = {$visitor_user_id}
        AND high_attention = {$high_attention}"
    );
  } else {
    // Else use IP address
    $visitor_rows = $wpdb->get_results(
      "SELECT IP, post_id FROM {$table_prefix}vnv_visitor_posts
        WHERE IP = \"{$visitor_ip}\"
        AND post_id = {$post_id}
        AND high_attention = {$high_attention}"
    );
  }

  // Insert a new entry for the visitor if none was found
  if (empty($visitor_rows)){
    $res = $wpdb->insert(
      "{$table_prefix}vnv_visitor_posts",
      [
        'IP' => $visitor_ip,
        'post_id' => $post_id,
        'user_id' => $visitor_user_id,
        'high_attention' => $high_attention
      ],
      [
        '%s',
        '%d',
        '%d',
        '%d'
      ]
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
  
  // $visitor_ip = get_ip_address(); // Get user's IP
  $visitor_user_id = get_current_user_id(); // Get user's ID if they're logged in
  $current_post_id = get_the_ID(); // Get current post ID
  $nonce = wp_create_nonce("NOLA 4 LIFE"); //Set nonce for AJAX request
  $wpdata = array(
    'nonce' => $nonce,
    'post' => $current_post_id,
    'user' => $visitor_user_id,
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
  $ATTENTION_LEVEL = 1;
  $USE_CATEGORIES = 1;

  // default values are most inclusive: low attention threshold and includes categories + tags
  $sql = generate_suggested_content_sql($ATTENTION_LEVEL, $USE_CATEGORIES);
  $post_rows = $wpdb->get_results($sql);

  // Get post IDs as an array
  $post_list = array();
  foreach ($post_rows as $row) {
    array_push($post_list, $row->ID);
  }

  // Query for the returned posts, ignoring stickied posts
  $query = new WP_Query( array( 'post__in' => $post_list, 'ignore_sticky_posts' => true ) );
  return $query;
}

// For use in shortcodes
// [query_top_terms high_attention="0" use_categories="0"]
add_shortcode( 'query_top_terms', 'query_top_terms_handler' );
function query_top_terms_handler($atts, $content = null){
  global $wpdb;

  // Query for the current user
  $visitor_ip = get_ip_address();
  $visitor_user_id = get_current_user_id(); // returns 0 if not logged in

  // Default to including the most data: low attention threshold and tags + categories
  $a = shortcode_atts( array(
    'high_attention' => 0,
    'use_categories' => 1,
  ), $atts );

  $sql = generate_top_tags_sql($a['high_attention'], $a['use_categories']);
  $tag_rows = $wpdb->get_results($sql);
  
  // Start generating the string to print out results formatted nicely
  $result_string = "<pre>\n";
  
  // For each result row and column, first we get the max lengths
  $max_lengths = [];

  // Checking the column names
  foreach ($tag_rows[0] as $col_name=>$col_val) {
    $max_lengths[$col_name] = strlen($col_name);
  }

  // Iterating through to get max lengths
  foreach ($tag_rows as $row) {
    foreach ($row as $key => $value) {
      $cur_len = strlen($value);
      // Updates maximum length for the column if it's not set or shorter than the current value
      if (!isset($max_lengths[$key]) || $max_lengths[$key] < $cur_len) {
        $max_lengths[$key] = $cur_len;
      }
    }
  }

  // Print column names
  foreach ($tag_rows[0] as $col_name=>$col_val) {
    $result_string .= str_pad($col_name, $max_lengths[$col_name]) . " | ";
  }
  $result_string .= "\n";

  // Print a lil divider to separate the column names
  foreach ($max_lengths as $key => $value) {
    $result_string .= str_repeat("-", $max_lengths[$col_name]) . "---";
  }
  $result_string .= "\n";

  // Iterate through again to print the formatted results
  foreach ($tag_rows as $row) {
    foreach ($row as $key => $value) {
      $result_string .= str_pad($value, $max_lengths[$key]) . " | ";
    }
    $result_string .= "\n";
  }
  $result_string .= "</pre>";

  return $result_string;
}

/**
 * Generates the SQL to query top suggestions given the passed in params
 *   STEP 1: Get ranked list of tag IDs for user (tag_id with tag_count from vnv_visitor_terms)
 *   STEP 2: Get all posts with ranked tags (join wp_term_relationships on tag_id)
 *   STEP 3: Filter out unpublished posts (join wp_posts on object_id and status = 'publish')
 *   STEP 4: Filter out visited posts for user (left outer join on vnv_visitor_posts)
 *   Return post IDs (wp_term_relationships.object_id)
 *   Can choose how many top tags and how many suggested posts to return
 * $no_of_top_terms: int
 * $max_results:     int
 * $high_attention:  bool
 * $use_categories:  bool
 * TODO Remove wp-config.php from version control
 * TODO Remove Uncategorized category? Its ID is 1
 */
function generate_suggested_content_sql($high_attention_only, $use_categories, $no_of_top_terms = 5, $max_results = 3){
  global $table_prefix;
  $visitor_ip = get_ip_address();
  $visitor_user_id = get_current_user_id(); // returns 0 if not logged in
  
  // Include categories, or just post tags?
  ($use_categories) ?
    $taxonomies = "\"post_tag\", \"category\"" :
    $taxonomies = "\"post_tag\"";

  // First bit of the querying SQL
  $sql = 
    "SELECT p.ID, p.post_title
    FROM
    (SELECT 
      term_taxonomy_id, 
      COUNT(term_taxonomy_id) AS term_count
    FROM {$table_prefix}vnv_visitor_terms ";

  // Use ID if available, otherwise fallback to IP
  $sql .= ($visitor_user_id) ? 
    "WHERE `user_id` = \"{$visitor_user_id}\" " : 
    "WHERE IP = \"{$visitor_ip}\" ";

  // Use high-attention views only?
  // (if not, use only low attention, unless we want to double-weight high attention views?)
  $sql .= ($high_attention_only) ? 
    "AND high_attention = 1 " : 
    "AND high_attention = 0 ";

  // Rest of the SQL
  $sql .= 
    " AND taxonomy IN ({$taxonomies})
      GROUP BY term_taxonomy_id
      ORDER BY term_count DESC
      LIMIT {$no_of_top_terms}) AS tc
    INNER JOIN {$table_prefix}term_relationships AS rels
      ON rels.term_taxonomy_id = tc.term_taxonomy_id
    INNER JOIN {$table_prefix}posts AS p
      ON p.ID = rels.object_ID
      AND p.post_status = 'publish'
    LEFT JOIN {$table_prefix}vnv_visitor_posts as vp
      ON vp.post_id = rels.object_id
      WHERE vp.post_id IS NULL
    LIMIT {$max_results}";

  return $sql;
}

/**
 * Used by query_top_terms_handler to get the top tags for the current user.
 */
function generate_top_tags_sql($high_attention_only, $use_categories, $no_of_top_terms = 20){
  global $table_prefix;
  $visitor_ip = get_ip_address();
  $visitor_user_id = get_current_user_id(); // returns 0 if not logged in
  
  // Include categories, or just post tags?
  ($use_categories) ?
    $taxonomies = "\"post_tag\", \"category\"" :
    $taxonomies = "\"post_tag\"";

  // First bit of the querying SQL
  $sql = 
    "SELECT 
    vt.term_id,
    vt.name,
    vt.taxonomy,
    COUNT(vt.term_taxonomy_id) AS term_count 
    FROM {$table_prefix}vnv_visitor_terms vt ";

  // Use ID if available, otherwise fallback to IP
  $sql .= ($visitor_user_id) ? 
    "WHERE `user_id` = \"{$visitor_user_id}\" " : 
    "WHERE IP = \"{$visitor_ip}\" ";

  // Use high-attention views only?
  // (if not, use only low attention, unless we want to double-weight high attention views?)
  $sql .= ($high_attention_only) ? 
    "AND high_attention = 1 " : 
    "AND high_attention = 0 ";

  // Rest of the SQL
  $sql .= 
    "AND taxonomy IN ({$taxonomies})
    GROUP BY term_taxonomy_id
    ORDER BY term_count DESC
    LIMIT {$no_of_top_terms}";

  return $sql;
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