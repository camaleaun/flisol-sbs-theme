<?php
/**
 * BLOG CATEGORIA
 *
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

global $wp_query;

$controllerPost = new Controller_Post();

if ( isset( $_GET['q'] ) ) {
	$posts = $controllerPost->getPosts();
} else {
	$category = $wp_query->get_queried_object();
	$posts = $controllerPost->getPostsByCategory($category);
}

get_header();
?>
<?php get_footer() ?>