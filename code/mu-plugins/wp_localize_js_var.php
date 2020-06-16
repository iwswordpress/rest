<?php
function load_scripts() {
   // register JS file test.js
   wp_register_script( 'wp-rest', get_theme_file_uri() . '/js/test.js');
   // enqueue JS file test.js
   wp_enqueue_script( 'wp-rest', get_theme_file_uri() . '/js/test.js');
   // create global JS variables for the enqueued JS file
   // global JS variables on all pages. Do 'Inspect Source' and find CDATA...
   wp_localize_script( 'wp-rest', 'siteObj',
       array( 
           'siteUrl'    => 'https://49plus.co.uk/udemy/',
           'wpNonce'    => wp_create_nonce('wp_rest'),
           'filePath'   => get_theme_file_uri() . '/js/test.js'
       )
   );
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );

// https://developer.wordpress.org/reference/classes/wp_scripts/localize/
// is_array( $l10n ) - holds the php associative array $l10n
$script = "var $object_name = " . wp_json_encode( $l10n ) . ';'

// on page we could write
// $wp_rest = wp_create_nonce('wp_rest');
// <script>
// var siteObj = {"wp_rest": + "<?php echo $wp_rest; ?&gt;"};
// </script>