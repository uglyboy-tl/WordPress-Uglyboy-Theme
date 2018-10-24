<!doctype html>
<html <?php language_attributes(); ?> class="borderbox">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title>
        <?php wp_title(''); ?>
        <?php if(wp_title('', false)) { echo ' :'; } ?>
        <?php bloginfo('name'); ?>
    </title>

    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- wrapper -->
    <div class="pure-g">

        <!-- header -->
        <header class="pure-u-1" role="banner">

            <!-- logo -->
            <div class="pure-u-1" id='logo'>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?></a></h1>
                <h3 class="site-description">
                    <?php bloginfo( 'description' ); ?>
                </h3>
           </div>
            <!-- /logo -->

            <!-- nav -->
            <nav class="pure-u-1" role="navigation">
                <?php wp_nav_menu( array(
                'theme_location'  => 'header-menu',
                'container' => 'div',
                'container_class' => 'pure-menu pure-menu-horizontal',
                'container_id' => '',
                'menu_class' => 'pure-menu-list',
                'menu_id' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 2, // currently there is a bug that prevents a depth > 2 from displaying correctly
                'walker' => new Uglyboy_Walker()
            )); ?>
            </nav>
            <!-- /nav -->

        </header>
        <!-- /header -->