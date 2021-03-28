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
require_once FUNCTIONS_DIR . '/classes.php';
require_once FUNCTIONS_DIR . '/controllers.php';
require_once FUNCTIONS_DIR . '/theme-options.php';
require_once FUNCTIONS_DIR . '/shortcodes.php';


if ( is_admin() ) {
	require_once FUNCTIONS_DIR . '/metaboxes.php';
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
		'top-menu' => __('Top Menu', 'textdomain')
	));
}

add_action('init', 'register_theme_menus');

class DD_Wolker_Menu extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
        $GLOBALS['dd_children'] = ( isset($children_elements[$element->ID]) )? 1:0;
        $GLOBALS['dd_depth'] = (int) $depth;
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}
add_filter('nav_menu_css_class','add_parent_css',10,2);
function  add_parent_css($classes, $item){
     global  $dd_depth, $dd_children;
     $classes[] = 'depth'.$dd_depth;
     if($dd_children)
         $classes[] = 'parent';
    return $classes;
}
