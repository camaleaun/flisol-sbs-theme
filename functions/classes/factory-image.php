<?php


if( !defined( 'WPINC' ) )
  die();

/**
 *  Factory used to create images
 *
 *  Case you need change
 *  @description define the attributes and methos to be used in all parts of one product
 */
class ImageFactory extends Odin_Thumbnail_Resizer
{


    public static function create( $imageId, $widthResize, $heightResize, $crop = false, $upscale = true )
    {
        return new Image( $imageId, $widthResize, $heightResize, $crop, $upscale );
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
            wp_delete_file( $imageResizedPath );
        }

        if( !file_exists( $imageResizedPath )){
            $image->resize( $widthImage, $heightImage, array( 'center', 'top' ) );
            $image->save( $imageResizedPath );
        }

        return $image;
    }
}