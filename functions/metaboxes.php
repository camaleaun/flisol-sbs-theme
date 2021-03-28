<?php

/**
 * This class was created to be a easy way to import METABOXES files and control what metaboxes the pages will use.
 * @author MASSANEIRO, Luís Felipe Massaneiro
 * @copyright Many Makers
 */
class MTB_Import {

    // -----------------------------------------------------------------------------

    public function __construct() {

        if( ! defined( 'MTBS_DIR' ) ) {
            define( 'MTBS_DIR', FUNCTIONS_DIR . '/metaboxes' );
        }

        //Carrega todos os arquivos no diretório
        foreach ( glob( MTBS_DIR ."/*.php") as $arquivo) {
            require_once  $arquivo;
        }
    }
}

new MTB_Import;


