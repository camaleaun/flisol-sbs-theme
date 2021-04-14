<?php
/* Template Name: Página Padrão */
defined( 'ABSPATH' ) || die;

get_header();
?>

  <section id="programacao__fisol" class="section-padrao">

    <div class="container">

      <h2 class="titulo">
        ><span class="blink">_</span> <?php wp_title(''); ?>
      </h2>

      <h3 class="subtitulo flsbs__aligncenter">
      </h3>

      <div class="row mt-5 mb-5 row-cols-1 row-cols-lg-2 g-4">
        <?php the_content(); ?>
      </div>


  </section>




<?php
    get_footer();
?>