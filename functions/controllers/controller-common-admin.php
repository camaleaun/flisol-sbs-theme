<?php

class Controller_Common_Admin {

	/**
	 * Construtor
	 */
	public function __construct() {

		/**
		 * Adicionar / remover CSS do admin
		 */
		add_action( 'admin_print_styles', array( &$this, 'print_styles_admin' ) );


		/**
		 * Restaurar colunas no dashboard do Admin do WP
		 */
		add_action( 'admin_head-index.php', array( &$this, 'restore_dashboard_columns' ) );


		/**
		 * Adicionar CSS para melhorar visualização do codestyling
		 */
		add_action( 'admin_head', array( &$this, 'style_codelstyling' ) );


		/**
		 * Mudar label dos menus do painel
		 */
		add_action( 'admin_menu', array( &$this, 'change_post_label' ) );


		/**
		 * Personalizar logo da página de login
		 */
		add_action( 'login_head', array( &$this, 'page_login_logo' ) );


		/**
		 * Reescrever link da página de login para a raiz do site
		 */
		add_filter( 'login_headerurl', array( &$this, 'page_login_url_home' ) );


		/**
		 * Reescrever o título do logo da página de login
		 */
		add_filter( 'login_headertitle', array( &$this, 'page_login_logo_title' ) );


		/**
		 * Alterar texto do rodapé da área de administração do WP
		 */
		add_filter( 'admin_footer_text', array( &$this, 'footer_admin' ) );

		/**
		 * Remover versão do WP do rodapé
		 */
		add_action( 'update_footer', array( &$this, 'text_version' ), 999 );


		/**
		 * Favicon para área de administração
		 */
		add_action( 'login_head', array( &$this, 'favicon_admin' ) );
		add_action( 'admin_head', array( &$this, 'favicon_admin' ) );


		add_filter( 'wpseo_metabox_prio', array( &$this, 'lower_wpseo_priority' ) );


		add_filter( 'get_admin_post_id', array( &$this, 'get_admin_post_id' ) );


		add_action( 'admin_enqueue_scripts', array( $this, 'add_custom_admin_js' ), 999 );

		add_action( 'after_setup_theme', array( $this, 'remove_core_updates' ) );


	} // __construct


	/**
	 * Restaurar colunas no Admin do WP
	 */
	public function restore_dashboard_columns() {

		add_screen_option(
			'layout_columns',
			array(
				/**
				 * Quantidade máximas de colunas
				 */
				'max'     => 2,

				/**
				 * Valor definido como padrão
				 */
				'default' => 1
			)
		);

	} // restore_dashboard_columns


	/**
	 * Adicionar / remover CSS do admin
	 */
	public function print_styles_admin() {

		$is_editor   = current_user_can( 'editor' );
		$is_dev_mode = isset( $_GET['dev'] );

		/**
		 * Se o usuário for Shop Manager e não estiver em modo de desenvolvimento
		 */
		if ( $is_editor && ! $is_dev_mode ) {
			wp_enqueue_style( 'interface_cleaner', theme_url( 'admin/public/css/admin-interface-cleaner.css' ), array(), null );
		}

	} // print_styles_admin


	/**
	 * Style para codestyling
	 */
	public function style_codelstyling() {

		$screen = get_current_screen();

		if ( 'tools_page_codestyling-localization/codestyling-localization' != $screen->id ) {
			return false;
		}


		// Deixar tabela com 100% da largura tela
		$style = '<style>';
		$style .= 'table.widefat.clear { width: auto }';
		$style .= '</style>';


		echo $style;

	} // style_codelstyling


	/**
	 * Mudar Labels dos menus do painel
	 */
	public function change_post_label() {

		global $menu;

		$menu[5][0] = 'Blog';

	} // change_post_label


	/**
	 * Personalizar logo da página de login
	 */
	public function page_login_logo() {

		$logo_url   = theme_url( 'admin/images/logo-login.png' );
		$img_height = 380;
		$img_width  = 100;

		$css = '<style>';
		$css .= 'body.login #login h1 a {';
		$css .= "background: url( '{$logo_url}' ) no-repeat scroll center top transparent; background-size: auto;";
		$css .= "height: {$img_height}px;";
		$css .= "width: {$img_width}%;";
        $css .= '}';
        $css .= 'body.login #login h1 {';
        $css .= "background-color: #ff8f2a;";
        $css .= '}';
		$css .= '</style>';


		echo $css;

	} // page_login_logo


	/**
	 * Reescrever link da página de login para a raiz do site
	 */
	public function page_login_url_home() {

		return home_url();

	} // page_login_url_home


	/**
	 * Reescrever o título do logo da página de login
	 */
	public function page_login_logo_title() {

		return esc_attr( get_bloginfo( 'name' ) );

	} // page_login_logo_title


	/**
	 * Alterar texto do rodapé da área de administração do WP
	 */
	public function footer_admin() {

		$footer_text = '&copy; ' . date( 'Y' ) . ' - ' . get_bloginfo( 'name' );
		$footer_text .= ' | Criado por <a href="https://saobentodosul.flisol.org.br" target="_blank">Flisol SBS</a>';
		$footer_text .= ' usando <a href="http://www.wordpress.org">WordPress</a>';
		$footer_text .= ' | Desenvolvido por: Luiz Felipe Massaneiro e Patrick Freitas';

		echo $footer_text;

	} // footer_admin


	/**
	 * Remover versão do WP do rodapé
	 */
	public function text_version() {

		return '';

	} // text_version


	/**
	 * Favicon para área de administração
	 */
	public function favicon_admin() {

		$favicon = '<!-- Favicon IE 9 -->';
		$favicon .= '<!--[if lte IE 9]><link rel="icon" type="image/x-icon" href="' . theme_url( 'dist/images/favicon.ico' ) . '" /> <![endif]-->';

		$favicon .= '<!-- Favicon Outros Navegadores -->';
		$favicon .= '<link rel="shortcut icon" type="image/png" href="' . theme_url( 'dist/images/favicon.png' ) . '" />';

		$favicon .= '<!-- Favicon iPhone -->';
		$favicon .= '<link rel="apple-touch-icon" href="' . theme_url( 'dist/images/favicon.png' ) . '" />';

		echo $favicon;

	} // favicon_admin


	// -----------------------------------------------------------------------------


	/**
	 * Muda a prioridade do metaboxe do Yoast
	 *
	 */
	function lower_wpseo_priority( $html ) {
		return 'low';
	}


	// -----------------------------------------------------------------------------

	public function get_admin_post_id() {
		$post_id = null;

		if ( isset( $_GET['post'] ) ) {
			$post_id = $_GET['post'];
		}

		if ( isset( $_POST['post_ID'] ) ) {
			$post_id = $_POST['post_ID'];
		}

		if ( $post_id == 0 ) {
			return null;
		}

		return $post_id;
	}

	public function add_custom_admin_js( $hook ) {
//		wp_register_script( 'JavascriptUtil', get_template_directory_uri() . '/admin/public/js/JavaScriptUtil.js', array( 'jquery' ), false, true );
		wp_register_script( 'Parsers', get_template_directory_uri() . '/admin/public/js/Parsers.js', array( 'JavascriptUtil' ), false, true );
		wp_register_script( 'InputMask', get_template_directory_uri() . '/admin/public/js/InputMask.js', array( 'Parsers' ), false, true );
		wp_register_script( 'custom-admin-scripts', get_template_directory_uri() . '/admin/public/js/admin.js?v=1', array( 'InputMask' ), false, true );
        wp_register_script( 'custom-admin-scripts-new', get_template_directory_uri() . '/admin/public/js/admin-scripts.js?v=1', array( 'jquery' ), false, true );


        wp_enqueue_script( 'main-scripts' );
		wp_enqueue_script( 'JavascriptUtil' );
		wp_enqueue_script( 'Parsers' );
		wp_enqueue_script( 'InputMask' );
		wp_enqueue_script( 'custom-admin-scripts' );
        wp_enqueue_script( 'custom-admin-scripts-new' );
	}

	public function remove_core_updates() {

		$user      = new WP_User( get_current_user_id() );
		$user_role = array_shift( $user->roles );

		if ( $user_role == "administrator" ) {
			return true;
		}

		if ( ! current_user_can( 'update_core' ) ) {
			//return;
		}
		add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
		add_filter( 'pre_option_update_core', '__return_null' );
		add_filter( 'pre_site_transient_update_core', '__return_null' );

		remove_action( 'load-update-core.php', 'wp_update_plugins' );
		add_filter( 'pre_site_transient_update_plugins', '__return_null' );
	}

} // Controller_Common_Admin

new Controller_Common_Admin;
