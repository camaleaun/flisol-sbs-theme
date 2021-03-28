<?php
if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}
?>
<footer class="flsbs__footer">
        <div class="flsbs__bottom-footer">
            <div class="container">
                <p>Flisol São Bento do Sul 2021 - <a href="<?php echo get_home_url(); ?>/politica-de-privacidade">Conheça nossa política de privacidade</a></p>
            </div>
        </div>
    </div>
</footer>

<!--
O restante do rodapé que virá dentro do body.
Criado automaticamente pelo WordPress.
-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/dist/scripts/main.js"></script>
<?php wp_footer(); ?>

</div><!-- .pagina -->

<!-- Fecha o body -->
</body>

<!-- Fecha o HTML -->
</html>