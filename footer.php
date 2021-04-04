<?php
if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}
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
                    <a href="#">
                    <img src='<?php echo theme_url('/dist/images/facebook.svg') ?>' alt="Facebook" class="img-fluid">
                    </a>
                    <a href="#">
                    <img src='<?php echo theme_url('/dist/images/instagram.svg') ?>' alt="Instragram" class="img-fluid">
                    </a>
                    <a href="#">
                    <img src='<?php echo theme_url('/dist/images/github.svg') ?>' alt="Git Hub" class="img-fluid">
                    </a>

                </nav>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer__menu">
                <h3 class="footer__menu-titulo">
                    ><span class="blink">_</span> Apoio
                </h3>

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