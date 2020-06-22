<?php
// WP REST API ENDPOINT ROUTE CREATION
add_action('rest_api_init', function () {
    register_rest_route( 'owt/v1', 'rest02',array(
                 //'methods'  => WP_REST_Server::READABLE, // For GET
                  'methods'  => WP_REST_Server::CREATABLE, // could just use 'POST'
                  'callback' => 'rest02_route',
                  'args'     => array (
                        'title'  => array( 
                            'type'             => 'string',
                            // REQUIRED AND VALIDAE_CALLBACK OPTIONAL
                        //     'required'         => true,
                        //     'validate_callback' => function($param){
                        //         if (strlen($param) > 4) {
                        //             return true;
                        //         } else {
                        //             return false;
                        //         }
                        //    }
                        ),
                        'content'  => array(
                            'type'     => 'string',
                            // REQUIRED AND VALIDAE_CALLBACK OPTIONAL
                            'required' => true,
                            'validate_callback' => function($param){
                                if (strlen($param) > 4 ) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        ),
                        'jwt'    => array(
                            'type' => 'integer',
                            // REQUIRED AND VALIDAE_CALLBACK OPTIONAL
                            'required' => true,
                            'validate_callback' => function($param){
                                if ($param > -1) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        )
                  )
        ));
  });
  // CALLBACK FUNTION
  function rest02_route(WP_REST_Request $request) { // works without WP_REST_Request
        // REQUEST FILTER OPTIONAL - JUST ADDED TO SHOW WHAT CAN BE DONE
        // WE MIGHT HAVE ONE ENDPOINT THAT HANDLES GET< POST, DELETE ETC.
        $request_type = $_SERVER['REQUEST_METHOD'];
        if ($request_type == "POST") { 
            $parameters = array(
                "title"  => $request->get_param("title"),
                "content" => $request->get_param("content"),
                "jwt"   => $request->get_param("jwt")
                );  
            // Do standard validations
            $title = sanitize_text_field($request->get_param("title"));
            $content = sanitize_text_field($request->get_param("content"));
            // Create post object
            $my_post = array(
                'post_title'    => $title,
                'post_content'  => $content,
                'post_status'   => 'publish',
                'post_author'   => 1,
                'post_category' => array( 4 )
            );
            // WE CAN ADD FUNCTIONAILITY TO HANDLE IN CORRECT DATA ETC AND 
            // RETURN A FAILURE MESSAGE - NOT SHOWN HERE TO AID CLARITY
            // Insert the post into the database
            wp_insert_post( $my_post );
            // send custom response message as needed...
            // WP will convert as needed to be sent to client
            return array(
                "status"     => "SUCCESS", 
                "method"     => "POST", 
                "message"    => "ENDPOINT: owt-v1-rest02", 
                "parameters" => $parameters
            );
        }
  }

