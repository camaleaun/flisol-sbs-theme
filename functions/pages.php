<?php
if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

// --------------------------------

/*
    Páginas do WP para frontend
    http:codex.wordpress.org/Function_Reference/wp_insert_post
*/
$default_configs = array(
    'post_status'    => 'publish',
    'post_type'      => 'page',
    'comment_status' => 'closed',
    'ping_status'    => 'closed',
    'post_content'   => ''
);

$panel_pages = array(
    array(
        'post_title' => 'Home',
        'post_name'  => 'front-page'
    ),
    array(
        'post_title' => 'Sobre',
        'post_name'  => 'sobre'
    ),
    array(
        'post_title' => 'Programação',
        'post_name'  => 'programacao'
    ),
    array(
        'post_title' => 'Palestrantes',
        'post_name'  => 'palestrantes'
    ),
    array(
        'post_title' => 'Atividades',
        'post_name'  => 'atividades'
    ),
    array(
        'post_title' => 'Certificados',
        'post_name'  => 'certificados'
    ),
);

foreach( $panel_pages as $p_page ) {
    if( !get_page_by_path( $p_page['post_name'] ) ) {
        wp_insert_post( array_merge( $default_configs, $p_page ) );
    }
}
