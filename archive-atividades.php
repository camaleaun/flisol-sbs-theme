<?php
/* Template Name: Atividades */
defined( 'ABSPATH' ) || die;

global $post;
$last_id = false;

/* controllers */
$controllerAtividades = new Controller_Atividades();

$atividadesPosts = $controllerAtividades->getPosts($last_id);

get_header();
?>

 <!-- Inicio Programacao -->

  <section id="programacao__fisol" class="section-padrao">

    <div class="container">

      <h2 class="titulo">
        ><span class="blink">_</span> Atividades
      </h2>

      <h3 class="subtitulo flsbs__aligncenter">
        Confira o que a edição preparou para você
      </h3>

      <div class="row mt-5 mb-5 row-cols-1 row-cols-lg-2 g-4">
        <?php if ( $atividadesPosts ) : ?>
            <?php foreach ( $atividadesPosts as $atividades ) : ?>
                <div class="col programacao__fisol-item">
                    <div class="card h-100">
                        <img src="<?php echo $atividades->image_cover->imageThumbnail; ?>" class="card-img-top" alt="<?php echo $atividades->post_title; ?>">
                        <?php if(get_field('palestra_online', $atividades->ID)): ?>
                        <span class="local">Online</span>
                        <?php endif; ?>
                        <div class="card-body">
                        <h2 class="card-title"><?php echo $atividades->post_title; ?></h2>
                        <p class="card-text"><?php echo mb_strimwidth($atividades->excerpt, 0, 150, "") ?></p>
                        </div>
                        <div class="card-footer">
                        <div>
                            <p class="palestrante"><span>Responsável:</span> <?php echo the_field('responsavel_atividade_nome', $atividades->ID);  ?></p>
                            <?php if(get_field('horario_atividade', $atividades->ID)): ?>
                                <p class="horario"><span>Horário:</span> <?php echo the_field('horario_atividade', $atividades->ID); ?></p>
                            <?php else: ?>
                                <p class="horario"><span>Horário:</span> <small>Ocorrerá durante todo o evento.</small></p>
                            <?php endif; ?>
                        </div>
                        <a class="btn btn-padrao" href='<?php echo get_the_permalink($atividades->ID); ?>'>Ver Mais</a>
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