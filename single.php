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

  </section>
    <div class="container single__conteudo">

    <div class="row">

      <article class="col-12 col-lg-12">

        <div class="single__conteudo-conteudo">

         <?php echo the_content(''); ?>


        </div>

      </article>

    </div>

  </div>




<?php
    get_footer();
?>