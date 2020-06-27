<?php

// ================ ADD CUSTOM ENDPOINT  wordcamp/v2/districts TO WP REST API ========================
// NAMESPACE is: wordcamp/v2
// ROUTE is: districts
// Carry out MySQL query
add_action('rest_api_init', function () {
  // namespace, route, callback
  register_rest_route( 'wordcamp/v2', 'acf', array(
                'methods'  => 'GET',
                'callback' => 'get_acf'
      ));
});
function get_acf() {

  
   // args
   $args = array(
      'numberposts'	=> -1,
   );

   $json_data = array(); //create JSON 
   $json_array = array(); // individual entries

   
   // query
   $the_query = new WP_Query( $args );
   if( $the_query->have_posts() ){
      while( $the_query->have_posts() )  {
         $the_query->the_post(); 
         $json_array['id'] = the_title();
         $json_array['source'] = the_field('acf');
         array_push($json_data, $json_array);  
      }

   }

  wp_reset_query();
  // Create RESPONSE object with all its headers etc...
  $response = new WP_REST_Response( $json_data);
  // Set response status - this can be customised 
  $response->set_status(200);
  return $response;
}

