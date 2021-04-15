<?php
defined( 'ABSPATH' ) || die;

global $post;
$last_id = false;

/* controllers */
$controllerAtividades = new Controller_Atividades();

$atividadesPosts = $controllerAtividades->getPosts($last_id);

?>
<?php if ( $atividadesPosts ) : ?>

<section id="home__atividades" class="section-padrao section-background mt-5 pb-5">

    <div class="container">

      <h2 class="titulo">
        ><span class="blink">_</span>  Atividades
      </h2>
      <h4> Confira as nossas atividades. Todas as atividades são abertas a comunidade.</h4>

      <div class="row">
        <?php foreach ( array_slice( $atividadesPosts, 0, 2) as $atividades ) : ?>
        <div class="col-12 home__atividades-item mb-5 mt-5">
          <div class="atividade-cabecalho">
            <img src='<?php echo theme_url('/dist/images/calendar.svg') ?>' alt="Ícone Calendario">
            <h3><?php echo $atividades->post_title; ?></h3>
          </div>
          <div class="atividade-conteudo">
            <div>
              <p><?php echo mb_strimwidth($atividades->excerpt, 0, 150, "") ?></p>
            </div>
            <hr>
            <div class="atividade-conteudo-rodape">
                <?php if(get_field('horario_atividade', $atividades->ID)): ?>
                <time>Horário <?php echo the_field('horario_atividade', $atividades->ID); ?></time>
              <?php else: ?>
              <time>Horário - Ocorrerá durante todo o evento.</time>
              <?php endif; ?>
              <strong><?php echo the_field('responsavel_atividade_nome', $atividades->ID);  ?></strong>
              <a class="btn btn-padrao" href='<?php echo get_the_permalink($atividades->ID); ?>'>Saiba Mais</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="row mt-5 mb-5 saiba-mais">
        <a class="btn btn-padrao" href='<?php echo get_home_url(); ?>/atividades'>Ver todas as atividades</a>
      </div>

    </div>

  </section>
<?php endif; ?>