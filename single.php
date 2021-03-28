<?php
/**
 * BLOG SINGLE
 *
 */

    if( ! defined( 'WPINC' ) ) {
        header( 'Location: /' );
        exit;
    }
    get_header();
    the_post();
    $contollerPost = new Controller_Post();
    $post = $contollerPost->get_post_by_id(get_the_ID());
    $categoryInfo = array_shift($post->categories);
    $postRelateds = $contollerPost->get_posts_related($post->ID, $categoryInfo);
?>

<?php get_footer() ?>