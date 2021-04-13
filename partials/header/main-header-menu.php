<div class="container cabecalho__transparente">

    <a href='<?php echo get_home_url(); ?>' class="logo">
    <img src='<?php echo theme_url( '/dist/images/logo.svg' ) ?>' alt="Logo" class="img-fluid logo">
    </a>

    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>

    <?php
        wp_nav_menu( array(
            'theme_location' => 'top-menu',
            'menu_id'        => 'menu-itens',
            'container'      => false,
            'menu_class'     => 'menu'
        ) );
    ?>

</div>

<div class="container cabecalho__main">

    <h2>24 de Abril de 2021</h2>
    <h3>Online para todo o Brasil!</h3>

</div>