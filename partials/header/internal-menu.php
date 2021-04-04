 <div class="container">

      <a href="#" class="logo">
        <img src='<?php echo theme_url( '/dist/images/logo.svg' ) ?>' alt="Logo" class="img-fluid logo">
      </a>

        <input class="menu-btn" type="checkbox" id="menu-btn" />
        <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>

         <?php
            wp_nav_menu( array(
                'theme_location' => 'top-menu',
                'menu_id'        => 'menu-itens-internal',
                'container'      => false,
                'menu_class'     => 'menu'
            ) );
        ?>

</div>

<section class="breadcrumb" style="background-image: url(<?php echo theme_url('/dist/images/the-conference.jpg'); ?>);">

    <div class="container">

    <h1>Sobre</h1>
    <div class="breadcrumb-item">
        <a href="/index.html">Home</a> &#187; <span class="atual">Sobre</span>
    </div>

    </div>

</section>