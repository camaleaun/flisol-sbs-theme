<?php
/**
 * Template default para páginas sem template
 *
 */
global $wp_query;
$var = $wp_query->get_queried_object();
if ( isset($var->taxonomy) || isset($_GET['q'] ) ){
	inc('partials/blog/categoria');
} else {
	inc('partials/blog/posts');
}
