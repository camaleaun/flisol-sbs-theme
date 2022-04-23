<?php
    //global $post;

    $title = get_the_title($post);
    $parent_title = get_the_title($post->post_parent);

    $page = $wp_query->post->post_type;

    if ($page == 'page') {
        $page_title = $wp_query->post->post_title;
    } else {
        $page_title = $wp_query->post->post_type;
    }

?>
<div class="container-fluid">

      <a href='<?php echo get_home_url(); ?>' class="logo">
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

    <h1><?php wp_title(''); ?></h1>
    <?php wp_custom_breadcrumbs(); ?>
    <div class="breadcrumb-item">
    </div>

    </div>

</section>