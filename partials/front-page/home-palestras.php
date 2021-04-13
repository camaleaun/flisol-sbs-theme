<?php
defined( 'ABSPATH' ) || die;

global $post;
$last_id = false;

/* controllers */
$controllerPalestras = new Controller_Palestras();

$palestrasPosts = $controllerPalestras->getPosts($last_id);

?>

<section id="home__sobre" class="section-padrao pb-5">

    <div class="container">

        <h2 class="titulo">
        ><span class="blink">_</span> Palestras
        </h2>

        <div class="row mb-5">

            <div class="col-md-4">

                <div class="home__sobre-feature">

                <img class="img-fluid" src='<?php echo theme_url('/dist/images/online-casino.svg') ?>' alt="Ícone Online">

                <h3>Online</h3>

                <p>
                    O evento será totalmente online, assista as palestras quantas vezes quiser.
                </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="home__sobre-feature">

                <img class="img-fluid" src='<?php echo theme_url('/dist/images/best-price.svg') ?>' alt="Ícone Grátis">

                <h3>Gratuito</h3>

                <p>Todas as palestras e atividades são totalmente gratuitas e indicadas para todas as pessoas com conhecimento técnico ou não.</p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="home__sobre-feature">

                <img class="img-fluid" src='<?php echo theme_url('/dist/images/network.svg') ?>' alt="Ícone Network">

                <h3>Networking</h3>

                <p>Aproveite as palestras ao vivo para interagir com outras pessoas.</p>

                </div>

            </div>

        </div>
        <?php if ( $palestrasPosts ) : ?>
        <hr>

        <div class="mt-5 row">
            <?php foreach ( array_slice($palestrasPosts, 0, 2) as $palestras ) : ?>
                <div class="col-md-5 m-auto home__atividades-item palestra-item mb-5 mt-5">
                    <div class="atividade-cabecalho">
                        <img src='<?php echo theme_url('/dist/images/calendar.svg') ?>' alt="Ícone Calendario">
                        <h3><?php echo $palestras->post_title; ?></h3>
                    </div>
                    <div class="atividade-conteudo">
                        <div>
                        <p><?php echo mb_strimwidth($palestras->excerpt, 0, 150, "") ?></p>
                        </div>
                        <hr>
                        <div class="atividade-conteudo-rodape">
                        <time>Horário <?php echo the_field('horario_palestra', $palestras->ID); ?></time>
                        <strong><?php echo the_field('palestrante_nome', $palestras->ID);  ?></strong>
                        <a class="btn btn-padrao" href='<?php echo get_the_permalink($palestras->ID); ?>'>Saiba Mais</a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="row mt-5 mb-5 saiba-mais">
            <a class="btn btn-one btn-padrao" href='<?php echo get_home_url(); ?>/programacao'>Ver todas as palestras</a>
        </div>

        <?php endif; ?>

    </div>

</section>