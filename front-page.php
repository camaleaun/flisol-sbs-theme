<?php
/* Template Name: Pagina Inicial */

defined( 'ABSPATH' ) || die;

global $post;

get_header();
?>

  <!-- Inicio Sobre -->

<?php inc('partials/front-page/home-about'); ?>

  <!-- FIM Sobre -->

  <!-- Inicio Atividades -->

<?php inc('partials/front-page/home-activities'); ?>

  <!-- FIM Atividades -->

  <!-- Palestras -->

<?php inc('partials/front-page/home-palestras'); ?>

  <!-- Fim Palestras -->

  <!-- Data-->

<?php inc('partials/front-page/home-data'); ?>

  <!-- FIM Data -->

  <!-- Blog -->

<?php inc('partials/front-page/home-blog'); ?>

  <!-- Fim Palestras -->

<?php get_footer(); ?>