<?php
/* Template Name:  Página 404 */

defined( 'ABSPATH' ) || die;

global $post;

get_header();
?>

<section id="sobre__fisol" class="section-padrao">

<div class="container">

    <h2 class="titulo">
    <i class="fas fa-jedi"></i>
    </h2>

    <h3 class="subtitulo">
    “O medo é o caminho para o Lado Sombrio. O medo traz a raiva. A raiva traz o ódio. O ódio traz o sofrimento.” - Yoda
    </h3>

    <div class="row mt-5 mb-5 saiba-mais">
        <a class="btn btn-padrao mt-5 mb-5" href='<?php echo get_home_url(); ?>'>Voltar para o lado luminoso da força</a>
    </div>

</section>


<?php get_footer(); ?>