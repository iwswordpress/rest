<?php
function load_scripts() {
// register JS file test.js
   wp_register_script( 'wp-rest', get_theme_file_uri() . '/js/test.js');
   //wp_register_script( 'wp-rest', 'https://49plus.co.uk/udemy/wp-content/themes/child/js/test.js');
   // wp_enqueue_script( 'wp-rest', 'https://49plus.co.uk/udemy/wp-content/themes/child/js/test.js');
   // enqueue JS file test.js
   wp_enqueue_script( 'wp-rest', get_theme_file_uri() . '/js/test.js');
   // create global JS variables for the enqueued JS file
   // global JS variables on all pages. Do 'Inspect Source' and find CDATA...
   wp_localize_script( 'wp-rest', 'siteObj',
       array( 
           'siteUrl'    => 'https://49plus.co.ukudemy/',
           'wpNonce'    => wp_create_nonce('wp_rest'),
           'filePath'   => get_theme_file_uri() . '/js/test.js'
       )
   );
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );
  