<?php

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

    // --------------------------------

    if( ! defined( 'CLASSES_DIR' ) ) {
        define( 'CLASSES_DIR', FUNCTIONS_DIR . '/classes' );
    }

    //Carrega todos os arquivos no diretório
    foreach (glob( CLASSES_DIR ."/*.php") as $arquivo) {
        require_once  $arquivo;
    }
