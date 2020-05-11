<?php
/* Courtesy of:
  Author: Art Vandelay
  Author URI: http://watch-learn.com
  https://www.youtube.com/watch?v=C2twS9ArdCI
 */
function wl_posts() {
	$args = [
		'numberposts' => 99999,
		'post_type' => 'post'
	];
	$posts = get_posts($args);
	$data = [];
	$i = 0;
	foreach($posts as $post) {
		$data[$i]['id'] = $post->ID;
		$data[$i]['title'] = $post->post_title;
		$data[$i]['content'] = $post->post_content;
		$data[$i]['slug'] = $post->post_name;
		$data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
		$data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
		$data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
		$i++;
	}
    // could set $data to HTML like our pages rest-api
	return $data;
}
function wl_post( $slug ) {
	$args = [
		'name' => $slug['slug'],
		'post_type' => 'post'
	];
	$post = get_posts($args);
	$data['id'] = $post[0]->ID;
	$data['title'] = $post[0]->post_title;
	$data['content'] = $post[0]->post_content;
	$data['slug'] = $post[0]->post_name;
	$data['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
	$data['featured_image']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
	$data['featured_image']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');
    // could set $data to HTML like our pages rest-api
	return $data;
}
add_action('rest_api_init', function() {
	register_rest_route('wl/v1', 'posts', [
		'methods' => 'GET',
		'callback' => 'wl_posts',
	]);
	register_rest_route( 'wl/v1', 'posts/(?P<slug>[a-zA-Z0-9-]+)', array(
		'methods' => 'GET',
		'callback' => 'wl_post',
	) );
});