<?php

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

class Controller_Image{
    /**
     * Construtor
     */
    public function __construct() {

        add_filter( 'get_image_resized', array ($this, 'get_image_resized' ), 10,3 );
        add_filter( 'get_images_resized', array ($this, 'get_images_resized' ), 10,2 );

    } //  __construct

    public function get_image_resized( $image_id , $size , $fix_size = '' ){
        $image_info = wp_get_attachment_metadata( $image_id );
        if( $image_info ){
            if( $fix_size == 'height' ){
                $image_height = $size[ 1 ];
                $image_width = $image_height * ( $image_info[ 'width'] / $image_info[ 'height'] );
            }

            if( $fix_size == 'width' ){
                $image_width = $size[ 0 ];
                $image_height = $image_width * ( $image_info[ 'height'] / $image_info[ 'width'] );
            }

            if( $fix_size == 'best-fit' ){
                $ratio_width =  $image_info[ 'width'] / $size[ 0 ];
                $ratio_height =  $image_info[ 'height'] / $size[ 1 ];
                if( $ratio_width >= $ratio_height ){
                    $image_width = $size[ 0 ];
                    $image_height = $image_width * ( $image_info[ 'height'] / $image_info[ 'width'] );
                }
                else{
                    $image_height = $size[ 1 ];
                    $image_width = $image_height * ( $image_info[ 'width'] / $image_info[ 'height'] );
                }
            }

            if( $fix_size == '' ){
                $image_height = $size[ 1 ];
                $image_width = $size[ 0 ];
            }

            $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
            $widthImage = 310;
            $heightImage = 290;
            $cropImage = array( 'center', 'top' );

            //$image = $this->createImageWithCustomCrop( $image_id,  $image_width, $image_height , $cropImage );
            // var_dump( $image );
            //ImageFactory::createImageWithCustomCrop( $imageID , $widthImage, $heightImage, $cropImage );
            $image = aq_resize( wp_get_attachment_url( $image_id ) , $image_width, $image_height, true, false, true);

            $imageResized = array();
            // $imageResized[ 'url' ] = $image->imageThumbnail;
            $imageResized[ 'url' ] = $image[0];
            $imageResized[ 'full' ] = wp_get_attachment_url( $image_id );
            $imageResized[ 'alt' ] = $this->get_image_meta_alt( $image_id );
            $imageResized[ 'caption' ] = $this->get_image_meta_caption( $image_id );
            return $imageResized;
        }
        else{
            return null;
        }
    }

    public function get_image_meta_alt( $image_id ){
        return ( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) );
    }

    public function get_image_meta_caption( $image_id ){
        $post_image = get_post( $image_id );
        if( $post_image ){
            $caption = $post_image->post_excerpt;
            return $caption;
        }
        else{
            return '';
        }
    }

    public function get_images_resized( $image_ids , $sizes ){

        if( count( $image_ids ) == 0 || count( $sizes ) == 0 ) {
            return null;
        }
        $images = array();
        if ( $image_ids ) {
            foreach( $image_ids as $image_id ){

                foreach( $sizes as $size ){

                    @list( $size_name, $size_width ,$size_height, $fix_size ) = $size;

                    if( !isset( $size_name ) || ( !isset( $size_width ) && !isset( $size_height ) ) ){
                        continue;
                    }

                    $image_resized = $this->get_image_resized( $image_id , array( $size_width , $size_height ) , $fix_size );
                    if( $image_resized ){
                        $images[ $image_id ][ $size_name ] = $image_resized;
                    }
                }
            }
        }

        if( count( $images ) == 0 ){
            return null;
        }
        return $images;
    }

    public static function createImageWithCustomCrop( $imageAttachId, $widthImage, $heightImage, $crop = false )
    {
        $upload_dir = wp_upload_dir();
        $imageOriginalPath = get_attached_file( $imageAttachId );
        $imageOriginalPathParts = explode( '.', $imageOriginalPath );
        $ext = array_pop( $imageOriginalPathParts );
        $imageOriginalPathBase = implode( '.', $imageOriginalPathParts );

        $image = wp_get_image_editor( $imageOriginalPath );

        if ( is_wp_error( $image ) ) {
            return $image;
        }

        $image->imageSrc = str_replace( $upload_dir['basedir'], $upload_dir['baseurl'], $imageOriginalPath );
        $imageResizedPath = $imageOriginalPathBase . '-' . $widthImage .'x'. $heightImage .'.'. $ext;
        $image->alt          = get_post_meta ( $imageAttachId, '_wp_attachment_image_alt', true );
        $image->title          = get_the_title( $imageAttachId );
        $image->imageThumbnail = str_replace( $upload_dir['basedir'], $upload_dir['baseurl'], $imageResizedPath );

         if( WP_DEBUG ){
            //wp_delete_file( $imageResizedPath );
        }

        if( !file_exists( $imageResizedPath )){
            $image->resize( $widthImage, $heightImage, array( 'center', 'top' ) );
            $image->save( $imageResizedPath );
        }

        return $image;
    }
}

new Controller_Image;
