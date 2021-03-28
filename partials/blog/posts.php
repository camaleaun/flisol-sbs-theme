<?php
/**
 *
 *
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$controllerPost = new Controller_Post();

$last_id = false;
if ( !isset($_GET['q']) ) {
    $last_post = $controllerPost->get_last_post_home();
    $last_id = $last_post->ID;
    $categoryInfo = array_shift($last_post->categories);
}
$posts = $controllerPost->getPosts($last_id);
$categories = $controllerPost->get_blog_categories();
get_header();
?>

<?php get_footer() ?>