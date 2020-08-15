<?php
// WP REST API ENDPOINT ROUTE CREATION
add_action('rest_api_init', function () {
    register_rest_route( 'udemy/v2', 'mirror',array(
                 //'methods'  => WP_REST_Server::READABLE, // For GET
                  'methods'  => WP_REST_Server::CREATABLE, // could just use 'POST'
                  'callback' => 'rest_mirror',
                  'args'     => array (
                        'formdata'  => array( 
                            'type'             => 'string',
                           
                        ),
                     
                  )
        ));
  });
  // CALLBACK FUNCTION
  function rest_mirror(WP_REST_Request $request) { // works without WP_REST_Request
        // REQUEST FILTER OPTIONAL - JUST ADDED TO SHOW WHAT CAN BE DONE
        // WE MIGHT HAVE ONE ENDPOINT THAT HANDLES GET< POST, DELETE ETC.
        $request_type = $_SERVER['REQUEST_METHOD'];
        if ($request_type == "POST") { 
            $parameters = array(
                "formdata"  => $request->get_param("formdata"), 
                );  
            // Do standard validations
            $formdata = sanitize_text_field($request->get_param("formdata"));
           
          
            return array(
                "status"     => "SUCCESS", // these fields can have add field name
                "method"     => "POST", 
                "message"    => "ENDPOINT: udemy-mirror", 
                "formdata"   => $formdata,
                "parameters" => $parameters
            );
        }
  }

