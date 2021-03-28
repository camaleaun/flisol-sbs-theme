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
    /* array(
        'post_title' => 'Home',
        'post_name'  => 'front-page'
    ),
    array(
        'post_title' => 'A Humanus',
        'post_name'  => 'sobre'
    ),
    array(
        'post_title' => 'Produtos',
        'post_name'  => 'produtos'
    ),
    array(
        'post_title' => 'Serviços',
        'post_name'  => 'servicos'
    ),
    array(
        'post_title' => 'Clientes',
        'post_name'  => 'clientes'
    ),
    array(
        'post_title' => 'Parceiros',
        'post_name'  => 'parceiros'
    ),
    array(
        'post_title' => 'Conteúdos',
        'post_name'  => 'conteudos'
    ),
    array(
        'post_title' => 'Blog',
        'post_name'  => 'blog'
    ),
    array(
        'post_title' => 'Contato',
        'post_name'  => 'contato'
    ), */
);

foreach( $panel_pages as $p_page ) {
    if( !get_page_by_path( $p_page['post_name'] ) ) {
        wp_insert_post( array_merge( $default_configs, $p_page ) );
    }
}
