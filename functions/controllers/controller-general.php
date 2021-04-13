<?php

if( !defined( 'WPINC' ) )
  die();

/**
 *  Singleton General
 *  @description define the attributes and methos to be used in all parts of the store
 */
class General   {

private static $contact;
private static $location;
private static $socialNetworks;
private static $mailChimp;
private static $widgetBlog;
//private static $formOptions;

    public static $instance      = null;

    public static function getInstance() {
        static $instance = null;
        if (null === $instance)
            $instance = new General();
        return $instance;
    }

    protected function __construct() {
        add_action( 'init', array( &$this , 'loadGeneralInfo' ) );
    }

    public function loadGeneralInfo( ){
        $this->loadContactInfo();
        $this->loadAddressInfo();
        $this->loadSocialNetworkInfo();
        $this->loadMailChimpInfo();
        $this->loadWidgetBlog();

    }

    public function loadContactInfo(){
        self::$contact= new stdClass();
        $contact_data = get_option( 'contact' );
        self::$contact->general_email = @$contact_data[ 'contact_general_email' ];
        self::$contact->general_contact_email = @$contact_data[ 'contact_email' ];
        self::$contact->general_phone = @$contact_data[ 'contact_phone' ];
        self::$contact->general_github = @$contact_data[ 'contact_github' ];
    }

    public function loadMailChimpInfo(){
        self::$mailChimp= new stdClass();
        $mail_chimp_data = get_option( 'mailchimp' );
        self::$mailChimp->link_subscribe_newsletter = @$mail_chimp_data[ 'link_subscribe_newsletter' ];
    }

    public function loadWidgetBlog(){
        self::$widgetBlog= new stdClass();
        $widget_blog_data = get_option( 'widget_sidebar_blog' );
        self::$widgetBlog->info_adverts_blog = wpautop(@$widget_blog_data[ 'info_adverts_blog' ]);
        self::$widgetBlog->link_info_adverts_blog = @$widget_blog_data[ 'link_info_adverts_blog' ];
    }

    public function loadAddressInfo(){
        self::$location= new stdClass();
        $unit_data = get_option( 'location' );
        self::$location->address = @$unit_data['location_address'];
        self::$location->complements = @$unit_data['location_complements'];
        self::$location->neighborhood = @$unit_data['location_neighborhood'];
        self::$location->zip = @$unit_data['location_zip'];
        self::$location->city = @$unit_data['location_city'];
        self::$location->state = @$unit_data['location_state'];
    }

    public function loadSocialNetworkInfo(){
        self::$socialNetworks= new stdClass();
        $social_data = get_option( 'social_networks' );
        self::$socialNetworks->facebook = @$social_data[ 'social_networks_facebook' ];
        self::$socialNetworks->youtube = @$social_data[ 'social_networks_youtube' ];
        self::$socialNetworks->instagram = @$social_data[ 'social_networks_instagram' ];
        self::$socialNetworks->twitter = @$social_data[ 'social_networks_twitter' ];
        self::$socialNetworks->github = @$social_data[ 'social_networks_github' ];
    }

    public function get_available_social_networks(){
        $available_social_networks = array();
        if( self::$socialNetworks->facebook != '' ){
            $available_social_networks[ 'facebook' ] = self::$socialNetworks->facebook;
        }

        if( self::$socialNetworks->youtube != '' ){
            $available_social_networks[ 'youtube' ] = self::$socialNetworks->youtube;
        }

        if( self::$socialNetworks->twitter != '' ){
            $available_social_networks[ 'twitter' ] = self::$socialNetworks->twitter;
        }

        if( self::$socialNetworks->foursquare != '' ){
            $available_social_networks[ 'foursquare' ] = self::$socialNetworks->foursquare;
        }

        return $available_social_networks;
    }

    public function getContact( $name = '' ){
        if( $name != '' ){
            return self::$contact->{$name};
        }
        return self::$contact;
    }

    public function getLocation( $name = '' ){
        if( $name != '' ){
            return self::$location->{$name};
        }
        return self::$location;
    }

    public function getSocialNetworks( $name = '' ){
        if( $name != '' ){
            return self::$socialNetworks->{$name};
        }
        return self::$socialNetworks;
    }

    public function getMailChimp( $name = '' ){
        if( $name != '' ){
            return self::$mailChimp->{$name};
        }
        return self::$mailChimp;
    }

    public function getAddressInfo($name = '') {
        if( $name != '' ) {
            return self::$location->{$name};
        }
        return self::$location;
    }

    public function getWidgetBlog( $name = '' ){
        if( $name != '' ){
            return self::$widgetBlog->{$name};
        }
        return self::$widgetBlog;
    }

}

General::getInstance();
