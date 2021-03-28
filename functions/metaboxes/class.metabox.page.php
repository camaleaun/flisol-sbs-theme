<?php

class MetaboxPage {

    public $pageTemplate = '';

    public function __construct( $pageTemplate, $hasEditorField = false ){
        $this->pageTemplate   = $pageTemplate;
        $this->hasEditorField = $hasEditorField;
        add_action( 'init' , array( $this, 'createMetaboxes' ) );
        add_action( 'tiny_mce_before_init' , array( $this, 'setEditorOptions' ) );

    }

    // -----------------------------------------------------------------------------

    public function createMetaboxes(){

        if( !$this->checkPageTemplate() )
            return;

        if( !method_exists( $this, 'setupMetaboxes') )
            return;


        $this->removePageSupport();
        $this->setupMetaboxes();
    }

    // -----------------------------------------------------------------------------

    public function checkPageTemplate(){
        $post_id = $this->getAdminPostID();

        if( $post_id == 0 )
            return false;

        $pageTemplate = get_page_template_slug( $post_id );

        if( $pageTemplate != $this->pageTemplate )
            return false;

        return true;
    }

    // -----------------------------------------------------------------------------


    public function setEditorOptions( $settings ) {

        if( get_post_type() != 'page' )
            return $settings;

        if( !$this->checkPageTemplate() )
            return $settings;

        if( method_exists( $this, 'setupEditorSettings') )
            return $this->setupEditorSettings( $settings );

    }

    // -----------------------------------------------------------------------------

    public function getAdminPostID(){

        if( isset( $_POST[ 'post_ID' ] ) )
            return $_POST[ 'post_ID' ] ;

        if( isset( $_GET[ 'post' ] ) )
            return $_GET[ 'post' ] ;

        return null;
    }

    // -----------------------------------------------------------------------------

    public function removePageSupport(){
        $current_user = wp_get_current_user();
        $roles        = $current_user->roles;

        if( !$this->hasEditorField )
            remove_post_type_support( 'page', 'editor' );

        remove_post_type_support( 'page', 'thumbnail' );

        if( in_array( 'editor', $roles ) )
            remove_post_type_support( 'page', 'page-attributes' );

    }

    // -----------------------------------------------------------------------------
}