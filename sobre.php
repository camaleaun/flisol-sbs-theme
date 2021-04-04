<?php
/* Template Name: Sobre */

defined( 'ABSPATH' ) || die;

global $post;

get_header();
?>

  <!-- Inicio Sobre -->

    <?php inc('partials/about/initial-about'); ?>

  <!-- FIM Sobre -->

  <!-- Cidade -->
    <?php inc('partials/about/city'); ?>
  <!-- FIM Cidade -->

  <!-- Local-->
    <?php inc('partials/about/local'); ?>
  <!-- FIM Local -->

  <!-- Inicio Equipe -->
    <?php inc('partials/about/team'); ?>
  <!-- Fim Equipe -->



<?php get_footer(); ?>