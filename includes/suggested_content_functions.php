<?php

/**
 * This file contains functions related to the "Suggested Content" feature.
 * It has also been appropriated for "Related Content" functions, as
 * related content is related to suggested content.
 */

// On initialization, create '*vnv_visitor_posts' and '*vnv_visitor_terms' tables
function intialize_suggested_content(){
  global $wpdb;
  global $table_prefix;

  // Don't run if it's been run before for the current version
  if ( get_option( "vnv_suggested_content_version" ) == 1 ) return;

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

  // Creates a blacklist table to filter results against
  // Actual filtering happens when getting suggested content,
  // so blacklisted tags are still added to the database
  $wpdb->query(
    "CREATE TABLE IF NOT EXISTS {$table_prefix}vnv_tag_blacklist(
      `tag_name` VARCHAR(40) NOT NULL UNIQUE
    )"
  );

  // Populates the blacklist, if empty
  populate_suggestion_blacklist();

  update_option( "vnv_suggested_content_version", 1 );

}
add_action('admin_init', 'intialize_suggested_content');


// Creates a blacklist table to filter results against
// Actual filtering happens when getting suggested content,
// so blacklisted tags are still added to the database
function populate_suggestion_blacklist(){
  global $wpdb;
  global $table_prefix;

  // Only run if the blacklist table is empty
  $count = $wpdb->get_var("SELECT COUNT(*) FROM {$table_prefix}vnv_tag_blacklist");
  if($count == 0){
    // Populate
    $wpdb->query("INSERT INTO {$table_prefix}vnv_tag_blacklist
      VALUES
      ('nolavie-archive'),
      ('local-new-orleans'),
      ('Music'),
      ('Art'),
      ('food'),
      ('viewpoints'),
      ('partner-content'),
      ('lifestyle'),
      ('Events'),
      ('new-orleans'),
      ('silvethreads'),
      ('kelley-crawford'),
      ('entertainment'),
      ('cuisine'),
      ('film'),
      ('nolavie'),
      ('video'),
      ('literature'),
      ('artists-in-their-own-words'),
      ('Mardi Gras'),
      ('UNO documentary'),
      ('Laszlo Fulop'),
      ('Audio'),
      ('seniors'),
      ('Theater'),
      ('fashion'),
      ('Education'),
      ('Jazz Fest'),
      ('Entrepreneurs'),
      ('dinin'),
      ('hurricane katrina'),
      ('NolaBeings'),
      ('Opinion'),
      ('Books'),
      ('Culture'),
      ('Restaurants'),
      ('press Street: Room 22'),
      ('Folwell Dunbar'),
      ('Arts'),
      ('Jazz'),
      ('poetry'),
      ('Festivals'),
      ('Bring your own'),
      ('WWNO'),
      ('history'),
      ('Dance'),
      ('we got your weekend'),
      ('community'),
      ('Culture Watch'),
      ('text'),
      ('entrepreneur'),
      ('Comedy'),
      ('french quarter'),
      ('Health'),
      ('How’s Bayou?'),
      ('Cassie Pruyn'),
      ('Sports'),
      ('Renee Peck'),
      ('Bayou St. John'),
      ('Mary Rickard'),
      ('Guest Blogs'),
      ('Voices'),
      ('Katrina'),
      ('Carnival'),
      ('business'),
      ('live music nola'),
      ('Big Easy Living'),
      ('Dating'),
      ('Artists'),
      ('uno film'),
      ('Steven Hatley'),
      ('summer'),
      ('photos'),
      ('tourism'),
      ('virtual gallery'),
      ('Treme'),
      ('et cetera'),
      ('creative writing'),
      ('Love NOLA'),
      ('drinks'),
      ('Instagram'),
      ('travel'),
      ('Bettye Anding'),
      ('Brian Friedman'),
      ('My House NOLA'),
      ('Bywater'),
      ('Hollywood South'),
      ('Lower Ninth Ward'),
      ('movies'),
      ('New Orleans Saints'),
      ('halloween'),
      ('Environment'),
      ('food porn'),
      ('New Orleans local'),
      ('Christmas'),
      ('home'),
      ('Storytelling'),
      ('tulane university'),
      ('cocktails'),
      ('week in review'),
      ('Technology'),
      ('Vicki Mayer'),
      ('the times-picayune'),
      ('new orleans food'),
      ('David Benedetto'),
      ('neighborhoods'),
      ('Fitness'),
      ('New Orleans Entrepreneur Week'),
      ('parades'),
      ('Louisiana'),
      ('Interview'),
      ('Tipitinas'),
      ('Instajournal'),
      ('Shane Colman'),
      ('Concerts'),
      ('Cycling'),
      ('changeworks'),
      ('Claire Bangser'),
      ('Room 220'),
      ('Recipes'),
      ('Cooking'),
      ('NOMA'),
      ('food porn friday'),
      ('neighborhood'),
      ('commentary'),
      ('university of new orleans'),
      ('Wesley Hodges'),
      ('holiday'),
      ('Tulane'),
      ('Football'),
      ('Nora Daniels'),
      ('NFL'),
      ('Saints'),
      ('Mardi Gras Indians'),
      ('holidays'),
      ('twenty-somethings'),
      ('New Orleans Museum of Art'),
      ('Thanksgiving'),
      ('submissions'),
      ('Recipe'),
      ('Louisiana Philharmonic Orchestra'),
      ('Jean-Mark Sens'),
      ('Sarah Holtz'),
      ('Bars'),
      ('radio'),
      ('salad'),
      ('Reece Burka'),
      ('women'),
      ('Artist'),
      ('design'),
      ('Concert'),
      ('media histories'),
      ('event preview'),
      ('Artist In Their Own Words'),
      ('caption'),
      ('food trucks'),
      ('Contemporary Arts Center'),
      ('cinema reset'),
      ('Madewood Plantation'),
      ('interviews'),
      ('humor'),
      ('Kim Frusciante'),
      ('Sarah Isabelle Prevot'),
      ('Marigny'),
      ('Jackson Square Artists'),
      ('authors'),
      ('Nola Art House Music'),
      ('Propeller'),
      ('idea village'),
      ('southern food and beverage museum'),
      ('performing arts'),
      ('UNO'),
      ('city park'),
      ('family'),
      ('costumes'),
      ('weekend'),
      ('Press Street'),
      ('Social Entrepreneurs')
    ");
  }

}

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
  $ATTENTION_LEVEL = 1; // Use high-attention views only
  $USE_CATEGORIES = 1; // Use categories in addition to tags

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

// Return Related Content for the given post ID
// Related content is just posts in the same category
// Called by feature-related_content.php
function get_related_content($post_id, $limit = 3){

  // Get posts in the same category as the given post
  // Thanks Felix: https://wordpress.stackexchange.com/a/311965
  global $wpdb;

  $query  = "SELECT x.object_id as ID
    FROM (
    SELECT tr1.object_id, COUNT(tr1.term_taxonomy_id) AS common_tag_count
    FROM {$wpdb->term_relationships} AS tr1
    INNER JOIN {$wpdb->term_relationships} AS tr2 ON tr1.term_taxonomy_id = tr2.term_taxonomy_id
    WHERE tr2.object_id = %d
    GROUP BY tr1.object_id
    HAVING tr1.object_id != %d
    ORDER BY COUNT(tr1.term_taxonomy_id) DESC
    LIMIT 10
    ) x
    INNER JOIN {$wpdb->posts} p ON p.ID = x.object_id
    ORDER BY common_tag_count DESC, p.post_date DESC
    LIMIT %d;";

  $sql = $wpdb->prepare($query, $post_id, $post_id, $limit);
  $ids = $wpdb->get_col($sql);

  // Query for the returned posts, ignoring stickied posts
  $query = new WP_Query( array( 'post__in' => $ids, 'ignore_sticky_posts' => true ) );
  return $query;
  
  // MAYBE filter out pages the user has already been on

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
 */
function generate_suggested_content_sql($high_attention_only, $use_categories, $no_of_top_terms = 5, $max_results = 3){
  global $table_prefix;
  $visitor_ip = get_ip_address();
  $visitor_user_id = get_current_user_id(); // returns 0 if not logged in
  
  // Include categories, or just post tags?
  ($use_categories) ?
    $taxonomies = "\"post_tag\", \"category\"" :
    $taxonomies = "\"post_tag\"";

  // First bit of the querying SQL; filter out blacklist
  $sql = 
    "SELECT p.ID, p.post_title
    FROM
    (SELECT 
      term_taxonomy_id, 
      COUNT(term_taxonomy_id) AS term_count
    FROM 
      (SELECT * FROM {$table_prefix}vnv_visitor_terms as viz 
      LEFT JOIN {$table_prefix}vnv_tag_blacklist AS bl 
      ON viz.name = bl.tag_name 
      WHERE bl.tag_name IS NULL) as vt ";

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
    LEFT JOIN {$table_prefix}vnv_visitor_posts AS vp
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