<?php
/**
 * Head - Tudo dentro da tag <head>
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}
?>
<!-- Meta X-UA-Compatible -->
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><![endif]-->

<!-- Charset -->
<meta charset="utf-8" />

<?php if ( is_front_page() ) : ?>
    <title><?php bloginfo('description') .'|'. bloginfo('name'); ?></title>
<?php else : ?>
    <title><?php bloginfo('name') . ' | '.  wp_title(''); ?></title>
<?php endif; ?>
<!-- Viewport -->
<meta name="viewport" content="width=device-width" />
<link rel="preconnect" href="https://fonts.gstatic.com">

<?php wp_head() ?>