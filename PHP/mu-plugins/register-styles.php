<?php
add_action( 'wp_enqueue_scripts', 'mu_theme_enqueue_styles' );
function mu_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style-font', 'https://fonts.googleapis.com/css?family=Quicksand', array('parent-style'));
    wp_enqueue_style( 'child-style-font', 'https://fonts.googleapis.com/css?family=Raleway', array('parent-style'));
    wp_enqueue_style( 'child-style-w3', 'https://www.w3schools.com/w3css/4/w3.css', array('parent-style'));
}
?>