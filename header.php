<?php

/**
 * Header (Cabeçalho do site)
 */

if( ! defined( 'WPINC' ) ) {
	header( 'Location: /' );
	exit;
}

?>
<!doctype html>

<html class="no-js" lang="pt-br" dir="ltr">
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
		<?php get_template_part( 'partials/header/head' ) ?>
	</head>
	<body <?php body_class() ?> data-baseurl='<?php echo theme_url() ?>'>

    <?php
    if ( is_front_page() ) : ?>
        <header class="header" id="cabecalho" style="background-image: url(<?php echo theme_url('/dist/images/home-img.jpg'); ?>)">
            <?php inc( 'partials/header/main-header-menu' ) ?>
        </header>
    <?php
        else :
    ?>
        <header class="header cabecalho__fundo--branco" id="cabecalho">
            <?php inc( 'partials/header/internal-menu' ) ?>
        </header>
    <?php
        endif;
    ?>


    <main>

