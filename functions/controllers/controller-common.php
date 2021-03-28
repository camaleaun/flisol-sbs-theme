<?php
class Controller_Common {

    /**
     * Construtor
     */
    public function __construct() {

        /**
         * Remover metatags não utilizadas
         */
        $this->remove_metatags();
        $this->remove_emoji();




        /**
         * Classes para body
         */
        add_filter( 'body_class', array( &$this, 'body_classes' ) );


        /**
         * Depois de ativar o tema
         */
        add_action( 'after_setup_theme', array( &$this, 'setup_features' ) );

        add_filter( 'get_page_by_template' , array( $this , 'get_page_by_template' ) , 10 , 1 );

        add_filter( 'posts_to_array' , array( $this , 'posts_to_array' ) , 10 , 1 );

        add_filter( 'array_to_select' , array( $this , 'array_to_select' ) , 10 , 3 );

        add_action( 'wp_head', array( $this, 'print_custom_vars' ) );

        add_action('after_setup_theme', array( $this , 'remove_admin_bar') );

        add_action('init', array( $this, 'save_campaing_info' ));

    } // __construct


    /** Remover scripts emoji */
    public function remove_emoji() {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');

        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
    }


    /**
     * Remover metatags não utilizadas
     */
    public function remove_metatags() {

        remove_action( 'wp_head', 'wp_generator' );
        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );

    } // remove_metatags





    public function body_classes( $classes ) {
        if( is_home() || is_front_page() ) {
            $classes[] = 'page-home';
        }

        return $classes;
    }





    public function setup_features() {

        /**
         * Suporte de linguagem para Odin
         */
        load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

        /**
         * Registrar Menus
         */
        // register_nav_menus(array(
        //     // 'main-menu' => 'Main Menu'
        // ));

        /*
         * Adicionar suporte à Imagem Destacada
         */
        add_theme_support( 'post-thumbnails' );

        /**
         * Adicionar Feeds automaticamente
         */
        add_theme_support( 'automatic-feed-links' );

        /**
         * Support de CSS pesonalizado para o editor
         */
        add_editor_style( get_template_directory_uri() . '/admin/public/css/editor-style.css' );

    } // setup_features

    public function get_page_by_template( $template_name ){
        $pages = get_pages(
            array(
                'meta_key' => '_wp_page_template',
                'meta_value' => $template_name
            )
        );

        $page = null;

        if( $pages ){
            $page = array_shift( $pages );
        }

        return $page;
    }

    public function posts_to_array( $posts ){
        $posts_arr = array();

        foreach( $posts as $post ){
            $posts_arr[ $post->ID ] = $post->post_title;
        }

        return $posts_arr;
    }

    public function array_to_select( $array , $idField, $nameField){

        if( count( $array ) == 0 ){
            return null;
        }

        $select = array();
        foreach( $array as $item ){
            $select[ $item[ $idField ] ] = $item[ $nameField ];
        }

        return $select;
    }

    public function print_custom_vars() {
        echo '<script> var site_url = "' . home_url() .'";</script>';
    }

    public function remove_admin_bar() {
        if (!current_user_can('administrator') && !is_admin()) {
          show_admin_bar(false);
        }
    }

    public function save_campaing_info() {
        if( is_admin() || !isset( $_GET ) )
            return;

        if (!session_id()) {
            session_start();
        }

        if (isset( $_GET['utm_campaign'] )) {
            $_SESSION['utm_campaign'] = $_GET['utm_campaign'];
        }

        if (isset( $_GET['utm_source'] )) {
            $_SESSION['utm_source'] = $_GET['utm_source'];
        }

        if (isset( $_GET['utm_medium'] )) {
            $_SESSION['utm_medium'] = $_GET['utm_medium'];
        }

        return;
    }

}

new Controller_Common;
