<?php
/* Template Name: Programacao */
defined( 'ABSPATH' ) || die;

global $post;
$last_id = false;

/* controllers */
$controllerPalestras = new Controller_Palestras();

$palestrasPosts = $controllerPalestras->getPosts($last_id);

get_header();
?>

 <!-- Inicio Programacao -->

  <section id="programacao__fisol" class="section-padrao">

    <div class="container">

      <h2 class="titulo">
        ><span class="blink">_</span> Programação do Evento
      </h2>

      <h3 class="subtitulo">
        Confira o que a edição preparou para você
      </h3>

      <div class="row mt-5 mb-5 row-cols-1 row-cols-lg-2 g-4">
        <?php if ( $palestrasPosts ) : ?>
            <?php foreach ( $palestrasPosts as $palestras ) : ?>
                <div class="col programacao__fisol-item">
                    <div class="card h-100">
                        <img src="<?php echo $palestras->image_cover->imageThumbnail; ?>" class="card-img-top" alt="<?php echo $palestras->post_title; ?>">
                        <?php if(get_field('palestra_online', $palestras->ID)): ?>
                        <span class="local">Online</span>
                        <?php endif; ?>
                        <div class="card-body">
                        <h2 class="card-title"><?php echo $palestras->post_title; ?></h2>
                        <p class="card-text"><?php echo mb_strimwidth($palestras->excerpt, 0, 150, "") ?></p>
                        </div>
                        <div class="card-footer">
                        <div>
                            <p class="palestrante"><span>Palestrante:</span> <?php echo the_field('palestrante_nome', $palestras->ID);  ?></p>
                            <p class="horario"><span>Horário:</span> <?php echo the_field('horario_palestra', $palestras->ID); ?></p>
                        </div>
                        <a class="btn btn-padrao" href='<?php echo get_the_permalink($palestras->ID); ?>'>Ver Mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

      </div>


  </section>

  <!-- FIM Programacao -->



<?php
    get_footer();
?>