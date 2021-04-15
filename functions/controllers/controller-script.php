<?php

class Controller_Scripts {

	private $scripts_in_header = false;
	private $scripts_in_footer = true;
	private $scripts_version = 2;


	public function __construct() {
		/**
		 * Adicionar CSS e JS corretamente no site
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'add_css_js' ) );

        wp_register_style( 'main-style', theme_url( 'dist/styles/main.css' ), array(), $this->scripts_version );

        wp_register_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), $this->scripts_version );

        // JS
        //wp_register_script( 'head-scripts', theme_url( 'dist/scripts/main.js' ), array(), $this->scripts_version, $this->scripts_in_header );
		/**
		 * Remover CSS e JS não utlizados
		 */
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
		add_action( 'init', array( $this, 'remove_css_js' ), 99 );
		/**
		 * Adicionar data-attributes no script do rodapé
		 */
		add_filter( 'clean_url', array( $this, 'handle_scripts' ), 11, 1 );

		//add_action( 'wp_head', array( $this, 'metas_seo' ) );
	}


	/* public function metas_seo() {
		echo '<meta name="p:domain_verify" content="f1272606cf204dbb528022c460b016d9"/>';
	} */


	public function add_css_js() {
		$theme = wp_get_theme();
		if ( theme_url() !== get_stylesheet_directory_uri() ) {
			return;
		}

		// CSS
		wp_register_style( 'main-style', theme_url( 'dist/styles/main.css' ), array(), $this->scripts_version );
		wp_enqueue_style( 'main-style' );

		wp_register_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), $this->scripts_version );
		wp_enqueue_style( 'font-awesome' );

		// Enfileirar JS
		wp_enqueue_script( 'head-scripts' );
	}


	public function handle_scripts( $url ) {
		if ( $url != theme_url( 'public/js/vendor/require.js' ) ) {
			return $url;
		}

		return sprintf(
			"%s' data-js='%s' data-main='%s' data-base-url='%s' data-template-url='%s",
			$url,
			'script-default',
			theme_url( 'public/js/boot' ),
			home_url(),
			theme_url()
		);
	}

	public function remove_css_js() {

		/* if ( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_dequeue_script( 'jquery' );
		} */
	}

}

new Controller_Scripts;
