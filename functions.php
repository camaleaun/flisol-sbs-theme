<?php
defined( 'ABSPATH' ) || die;

if ( ! defined( 'FUNCTIONS_DIR' ) ) {
	define( 'FUNCTIONS_DIR', get_template_directory() . '/functions' );
}

if ( ! defined( 'ODIN_CORE_DIR' ) ) {
	define( 'ODIN_CORE_DIR', get_template_directory() . '/core' );
}

if ( ! defined( 'ODIN_CLASSES_DIR' ) ) {
	define( 'ODIN_CLASSES_DIR', ODIN_CORE_DIR . '/classes' );
}
/**
 *Define path and URL to the ACF plugin.
 */
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/inc/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/' );


/**
 * Criação de páginas estáticas
 */
require_once FUNCTIONS_DIR . '/pages.php';

/**
 * Funções abstraídas para usar no WP
 */
require_once FUNCTIONS_DIR . '/abstract-functions.php';

/**
 * Libs
 */
require_once FUNCTIONS_DIR . '/lib/aq-resizer/aq-resizer.php';

/**
 * AquaResizer
 */
require_once ODIN_CLASSES_DIR . '/class-thumbnail-resizer.php';


/**
 * Include the ACF plugin
 */
require_once MY_ACF_PATH . 'acf.php';

/**
 * Includes do Odin para criação de CPT's, Metaboxes, Taxonomias, etc
 */
require_once ODIN_CLASSES_DIR . '/class-post-type.php';
require_once ODIN_CLASSES_DIR . '/class-metabox.php';
require_once ODIN_CLASSES_DIR . '/class-taxonomy.php';
require_once ODIN_CLASSES_DIR . '/class-theme-options.php';

/*--------------------------------------------------------------------------------------
*
* Arquivos do tema
*
*-------------------------------------------------------------------------------------*/
require_once FUNCTIONS_DIR . '/taxonomies.php';
require_once FUNCTIONS_DIR . '/custom-post-types.php';
require_once FUNCTIONS_DIR . '/breadcrumbs.php';
require_once FUNCTIONS_DIR . '/classes.php';
require_once FUNCTIONS_DIR . '/controllers.php';
require_once FUNCTIONS_DIR . '/theme-options.php';
require_once FUNCTIONS_DIR . '/shortcodes.php';
//require_once FUNCTIONS_DIR . '/fields-custom-acf.php';

/**
 * Include Fields Custom Theme Humanus - ACF
 */
require_once FUNCTIONS_DIR . '/fields-custom-acf.php';



if ( is_admin() ) {
	require_once FUNCTIONS_DIR . '/metaboxes.php';
}

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}

// Remove a barra de admin
add_filter('show_admin_bar', '__return_false');

// Remover link RSD
remove_action ('wp_head', 'rsd_link');

// Remove a versão do WordPress do cabeçalho
remove_action('wp_head', 'wp_generator');

// Remove wlwmanifest_link - Recurso usado pelo Windows Live Writer.
remove_action( 'wp_head', 'wlwmanifest_link');

// Remove WP verson from meta tag
add_filter('the_generator', 'sdt_remove_version');

// Function to remove version numbers
function sdt_remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// Remove WP verson from meta tag
function sdt_remove_version() {
    return '';
}

/*
 * Register dynamic menus
 */
function register_theme_menus(){
	register_nav_menus(array(
		'top-menu' => __('Top Menu', 'textdomain'),
		'footer-menu' => __('Footer Menu', 'textdomain'),
	));
}

add_action('init', 'register_theme_menus');

function mr_wp_title( $title ) {
    // Do not filter for RSS feed / if SEO plugin installed
    if ( is_feed() || class_exists('All_in_One_SEO_Pack') || class_exists('HeadSpace_Plugin') || class_exists('Platinum_SEO_Pack') || class_exists('wpSEO') || defined('WPSEO_VERSION') )
        return $title;
    if ( is_front_page() ) {
        $title = get_bloginfo('name').' - '.get_bloginfo('description');
    }
    if ( is_front_page() && get_bloginfo('description') == '' ) {
        $title = get_bloginfo('name');
    }
    if ( !is_front_page() ) {
        $title;
    }
    return $title;
}
add_filter( 'wp_title', 'mr_wp_title' );