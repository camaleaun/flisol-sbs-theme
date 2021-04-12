<?php
/**
 * PALESTRAS SINGLE
 *
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}
global $wp_query;
get_header();
the_post();

$last_id = false;

/* controllers */
$controllerAtividades = new Controller_Atividades();

$atividadesPosts = $controllerAtividades->get_post_by_id(get_the_ID());

$categoryInfo = array_shift($atividadesPosts->categories);

?>
  <div class="container single__conteudo">

    <div class="row">

      <article class="col-12 col-lg-8">

        <div class="single__conteudo-featured">
          <img src="<?php echo $atividadesPosts->image_cover->imageThumbnail; ?>" alt="">
        </div>

        <div class="single__conteudo-conteudo">

         <?php echo apply_filters('the_content', $atividadesPosts->post_content); ?>


        </div>

      </article>

      <sidebar class="col-12 col-lg-4">

        <!-- Inicio do sidebar conteudo -->

        <div class="single__sidebar-cabecalho">
          <h3>Detalhe do Evento</h3>
        </div>

        <div class="single__sidebar__item">

          <div class="single__sidebar__item-icon">

            <i class="far fa-hand-spock"></i>

          </div>

          <!-- Tipo de evento -->

          <div class="single__sidebar__item-conteudo">

            <h4 class="single__sidebar__item-titulo">Tipo de atividade</h4>
            <h4 class="single__sidebar__item-subtitulo"><?php echo the_field('tipo_da_atividade'); ?></h4>

          </div>

        </div>

        <!-- Data -->

        <div class="single__sidebar__item">

          <div class="single__sidebar__item-icon">

            <i class="far fa-calendar-alt"></i>

          </div>

          <div class="single__sidebar__item-conteudo">

            <h4 class="single__sidebar__item-titulo">Data</h4>
            <h4 class="single__sidebar__item-subtitulo"><?php echo the_field('data_atividade'); ?></h4>

          </div>

        </div>

        <!-- Organizador -->

        <div class="single__sidebar__item">

          <div class="single__sidebar__item-icon">

            <i class="far fa-user"></i>

          </div>

          <div class="single__sidebar__item-conteudo">

            <h4 class="single__sidebar__item-titulo">Responsável</h4>
            <h4 class="single__sidebar__item-subtitulo"><?php echo the_field('responsavel_atividade_nome'); ?></h4>

          </div>

        </div>

        <!-- Local -->

        <div class="single__sidebar__item">

          <div class="single__sidebar__item-icon">

            <i class="fas fa-map-marker-alt"></i>

          </div>

          <div class="single__sidebar__item-conteudo">

            <h4 class="single__sidebar__item-titulo">Local</h4>
            <?php if(get_field('atividade_online')): ?>
                <h4 class="single__sidebar__item-subtitulo">Online</h4>
            <?php endif; ?>
            <?php if(get_field('local_da_atividade')): ?>
                <h4 class="single__sidebar__item-subtitulo"><?php echo the_field('local_da_atividade'); ?></h4>
            <?php endif; ?>

          </div>

        </div>

        <div class="single__sidebar__item">

          <div class="single__sidebar__item-icon">

            <i class="far fa-folder-open"></i>

          </div>

          <!-- Categoria -->

          <div class="single__sidebar__item-conteudo">

            <h4 class="single__sidebar__item-titulo">Categoria</h4>
            <h4 class="single__sidebar__item-subtitulo"><?php echo $categoryInfo->name; ?></h4>

          </div>

        </div>

        <!-- Fim do sidebar conteudo -->


      </sidebar>

    </div>

  </div>

<?php get_footer() ?>