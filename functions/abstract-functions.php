<?php
if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

// --------------------------------

/**
 * Classe
 */
class Abstract_Functions {

    /**
     * Retorna a variável get_template_diretory_uri()
     * @param $path - (optional) Caminho dentro do tema
     */
    public static function theme_url( $path ) {
        $path = ( null !== $path ) ? "/{$path}" : '';
        return get_template_directory_uri() . $path;
    }

    public static function removeCaractersByPhone( $phone ) {

        $phone = preg_replace('/[^a-z0-9\-]/', '', $phone);
        $phone = preg_replace('/(-){2,}/', '', $phone);
        $phone = str_replace('-', '', $phone);
        $phone = str_replace('.', '', $phone);

        return $phone;
    }





    /**
     * Retorna a função get_template_part( $slug, $name = '' )
     */
    public static function inc( $slug, $name ) {
        get_template_part( $slug, $name );
    }





    /**
     * Retorna a URL da página passada em $slug
     */
    public static function page_url( $slug ) {
        return get_permalink( get_page_by_path( $slug ) );
    }





    /**
     * Socialite
     */
    public static function socialite( $social, $url ) {
        switch( $social ) {
            case 'facebook' :
                echo '<a class="socialite facebook-like" data-layout="button_count" data-show-faces="false" data-href="' . $url . '"></a>';
                break;

            case 'twitter' :
                echo '<a href="https://twitter.com/share" class="socialite twitter-share" data-url="' . $url . '"></a>';
                break;

            case 'googleplus' :
                echo '<div class="socialite googleplus-one" data-size="medium" data-href="' . $url . '"></div>';
                break;

            case 'pinterest' :
                echo '<a class="socialite pinterest-pinit" target="_blank" href="//www.pinterest.com/pin/create/button/?url=' . $url . '" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>';
                break;

            case 'facebook-comments' :
                echo '<div class="socialite fb-comments" data-href="' . $url . '" data-width="780" data-num-posts="5"></div>';
                break;
        }
    }

} // Abstract_Functions





/**
 * Funções
 */
function theme_url( $path = null ) {
    return Abstract_Functions::theme_url( $path );
}



function inc( $slug, $name = null ) {
    return Abstract_Functions::inc( $slug, $name );
}



function page_url( $slug ) {
    return Abstract_Functions::page_url( $slug );
}



function socialite( $social, $url ) {
    return Abstract_Functions::socialite( $social, $url );
}

function removeCaractersByPhone( $phone ) {
    return Abstract_Functions::removeCaractersByPhone( $phone );
}
