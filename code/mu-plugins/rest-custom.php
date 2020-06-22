<?php
// 
// ================ ADD CUSTOM FIELD TO WP REST API =========================
// We can add extra fields to the REST output as follows with authorName being
// the new field name. The return supplies the data to this aadded field.
// This can be useful for Author's name as the standard posts endpoint just gives
// the authors ID.
// register_rest_field ( 'name-of-post-type', 'name-of-field-to-return', array-of-callbacks-and-schema() )
function add_author_name_to_posts() {
    register_rest_field('post', 'authorName', array( 
        'get_callback' => function() {
          return get_the_author();
      }
    ));
  }
add_action('rest_api_init', 'add_author_name_to_posts');

// ================ ADD CUSTOM ENDPOINT  wordcamp/v2/districts TO WP REST API ========================
// NAMESPACE is: wordcamp/v2
// ROUTE is: districts
// Carry out MySQL query
add_action('rest_api_init', function () {
  // namespace, route, callback
  register_rest_route( 'wordcamp/v2', 'districts', array(
                'methods'  => 'GET',
                'callback' => 'get_districts'
      ));
});
function get_districts() {

  $sql = "SELECT ID, UnitName FROM 01_tblTest";
  global $wpdb;
  $results = $wpdb->get_results($wpdb->prepare($sql, ""));
  // This is PHP code to create a JSON like data structure
  $json_data = array();//create the array 
  $json_array = array(); 
  foreach ($results as $objRS)//foreach loop  
  {  
      $json_array['ID'] = $objRS->ID;  
      $json_array['Name'] = $objRS->UnitName;  
      // here pushing the record array in to another array  
      array_push($json_data,$json_array);  
  }
  wp_reset_query();
  // Create headers
  $response = new WP_REST_Response( $json_data);
  // Set response status - this can be customised 
  $response->set_status(200);
  return $response;
}


// ================ ADD CUSTOM ENDPOINT TO WP REST API ========================
// NAMESPACE is wordcamp/v2
// https://49plus.co.uk/udemy/wp-json/wordcamp/v2/totalusers
// Carry out MySQL query to get total number of users
add_action('rest_api_init', function () {
  register_rest_route( 'wordcamp/v2', 'totalusers',array(
                'methods'  => 'GET',
                'callback' => 'total_users'
      ));
});
function total_users($request) {
  $request_type = $_SERVER['REQUEST_METHOD'];
  if ($request_type == "GET") { 
    global $wpdb;
    $sql = "SELECT COUNT(*) AS 'TOTAL' FROM ".$wpdb->prefix."users";
    $results = $wpdb->get_results($sql);
    wp_reset_query();
  }
  $response = new WP_REST_Response($results);
  $response->set_status(200);
  return $response;
}














// ================ ADD CUSTOM ENDPOINT TO WP REST API ========================
// NAMESPACE is wordcamp/v2
// https://49plus.co.uk/udemy/wp-json/wordcamp/v2/latest-posts/4
add_action('rest_api_init', function () {
    register_rest_route( 'wordcamp/v2', 'latest-posts/(?P<category_id>\d+)',array(
                  'methods'  => 'GET', 
                  'callback' => 'get_latest_posts_by_category'
        ));
  });
  function get_latest_posts_by_category($request) {
    $args = array(
            'category' => $request['category_id']
    );
    $posts = get_posts($args);
    if (empty($posts)) {
      return new WP_Error( 'empty_category', 'there is no post in this category', array('status' => 'CategoryID needed') );
    }
    // We can output HTML too...
    // $posts = "<h1>HTML TEST DATA GOES HERE</h1>";
    $response = new WP_REST_Response($posts);
    $response->set_status(200);
    return $response;
  }