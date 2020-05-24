<?php
// POST 


add_action('rest_api_init', function () {
    register_rest_route( 'udemy/v1', 'login',array(
                  'methods'  => WP_REST_Server::CREATABLE, // same as POST
                  'callback' => 'authenticate',
                  'args'     => array (
                        'password'  => array( 
                            'type'             => 'string',
                            'required'         => true,
                            'validate_callback' => function($param){
                                if (strlen($param) > 3 ) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        ),
                        'email'  => array(
                            'type'     => 'string',
                            'required' => true,
                            'validate_callback' => function($param){
                                if (filter_var($param, FILTER_VALIDATE_EMAIL )) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        )
                  )
        ));
  });

  function authenticate(WP_REST_Request $request) { // works without WP_REST_Request
        $request_type = $_SERVER['REQUEST_METHOD'];

        if ($request_type == "POST") { 
            $parameters = array(
                "user_email" => $request->get_param("email"),
                "user_password"  => $request->get_param("password")
            );

            $Email = sanitize_email($request->get_param("email")) ;
            $Password = sanitize_text_field($request->get_param("password")) ;

            $user = get_user_by( 'email', $Email );
            $ID = $user->ID;
           
            $valid = wp_authenticate_email_password(null, $Email, $Password);
            // !!!!! For DEV MODE only
            // In PROD MODE just send back JWT
            if ($valid) {
                $JWT = getJWT($Email, $ID) ;
                    return array( "valid" => $valid,"message" =>"SUCCESSFUL","jwt"=>$JWT, "ID"=>$ID, 
                );
            } else {
                    return array(  "valid" => $valid, "message" =>"INVALID"
                 );
            }
            
        }
    }
    
  function getJWT($Email, $ID) {
      
    // CREATION OF JSON WEB TOKEN JWT

    // JWT Header
    $header = [
        "alg"     => "HS256", // hashing algorithm used
        "typ"     => "JWT"
    ];
    
    // JWT Payload data
    $payload = [
        "id"        => $ID,
        "email"        => $Email
    
    ];
    // Highly confidential key! We can store this is DB and retrieve and use a SALT key for greater security.
    $secret = "2020QWERTY";
    
    // ***************** Create the JWT. The code in jwt.php in mu-plugins folder **********************
   return  generateJWT('sha256', $header, $payload, $secret);
}
?>