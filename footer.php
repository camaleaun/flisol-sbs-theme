<?php
if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctrGeneral = General::getInstance();

$facebook = $ctrGeneral->getSocialNetworks( 'facebook' );
$youtube = $ctrGeneral->getSocialNetworks( 'youtube' );
$instagram = $ctrGeneral->getSocialNetworks( 'instagram' );
$twitter = $ctrGeneral->getSocialNetworks( 'twitter' );
$github = $ctrGeneral->getSocialNetworks( 'github' );

?>
</main>

    <footer id="footer-principal">

        <section class="container">

            <div class="row">
            <div class="col-md-4">
                <div class="footer__menu">
                    <h3 class="footer__menu-titulo">
                        ><span class="blink">_</span> Navegue
                    </h3>
                    <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer-menu',
                            'menu_id'        => 'menu-itens-footer',
                            'container'      => false,
                            'menu_class'     => 'nav flex-column'
                        ) );
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer__menu">
                <h3 class="footer__menu-titulo">
                    ><span class="blink">_</span> Acompanhe
                </h3>
                <nav class="nav flex redes">
                    <?php if ( $facebook ): ?>
                    <a href="<?php echo $facebook; ?>">
                        <img src='<?php echo theme_url('/dist/images/facebook.svg') ?>' alt="Facebook" class="img-fluid">
                    </a>
                    <?php endif; ?>
                    <?php if ( $instagram ): ?>
                    <a href="<?php echo $instagram; ?>">
                        <img src='<?php echo theme_url('/dist/images/instagram.svg') ?>' alt="Instragram" class="img-fluid">
                    </a>
                    <?php endif; ?>
                    <?php if ( $github ): ?>
                    <a href="<?php echo $github; ?>">
                        <img src='<?php echo theme_url('/dist/images/github.svg') ?>' alt="Git Hub" class="img-fluid">
                    </a>
                    <?php endif; ?>

                </nav>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer__menu">
                <h3 class="footer__menu-titulo">
                    ><span class="blink">_</span> Apoio
                </h3>
                    <a href="https://www.udesc.br/ceplan">
                        <img class="m-3" width="100px" src='<?php echo theme_url('/dist/images/udesc-logo.png') ?>' alt="UDESC" class="img-fluid">
                    </a>
                    <a href="https://www.univille.edu.br/pt-BR/a-univille/campi-unidades/campus-sbs/599089">
                        <img class="m-3" width="100px" src='<?php echo theme_url('/dist/images/univille-logo-2.png') ?>' alt="Univille" class="img-fluid">
                    </a>
                </div>
            </div>
            </div>

            <hr>

            <div class="d-flex footer-copy">

            <h3>Orgulhosamente desenvolvido com WordPress</h3>
            <a href="#">FliWiki</a>


            </div>

        </section>

        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/dist/scripts/main.js"></script>
        <?php wp_footer(); ?>
    </footer>
</body>
</html>