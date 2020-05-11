<?php
// POST PARAMETER
add_action('rest_api_init', function () {
    register_rest_route( 'owt/v1', 'rest02',array(
               //  'methods'  => WP_REST_Server::READABLE,
                  'methods'  => WP_REST_Server::CREATABLE,
                  'callback' => 'rest02_route',
                  'args'     => array (
                        'title'  => array( 
                            'type'             => 'string',
                            'required'         => true,
                            'validate_callback' => function($param){
                                if (strlen($param) > 4) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        ),
                        'content'  => array(
                            'type'     => 'string',
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
  function rest02_route(WP_REST_Request $request) { // works without WP_REST_Request
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
                'post_category' => array( 3 )
            );
            // Insert the post into the database
            wp_insert_post( $my_post );
            // send response message as needed...
            return array("status"=> "SUCCESS", "method"=>"POST", "message" =>"ENDPOINT: owt-v1-rest02", "parameters" => $parameters);
        }
  }
?>
