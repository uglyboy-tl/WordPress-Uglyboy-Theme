<!doctype html>
<html <?php language_attributes(); ?> class="borderbox no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title>
        <?php wp_title(''); ?>
        <?php if(wp_title('', false)) { echo ' :'; } ?>
        <?php bloginfo('name'); ?>
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- header -->
    <header class="pure-u-1" role="banner">

        <!-- logo -->
        <div class="pure-u-1" id='logo' style="background-image:url(<?php header_image() ?>)">
            <div class="logo-text">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?></a></h1>
                <h3 class="site-description">
                    <?php bloginfo( 'description' ); ?>
                </h3>
            </div>
        </div>
        <!-- /logo -->

        <!-- nav -->
        <nav class="pure-u-1" role="navigation">
            <?php wp_nav_menu(array(
                'theme_location'  => 'header-menu',
                'container' => 'div',
                'container_class' => 'pure-menu pure-menu-horizontal',
                'menu_class' => 'pure-menu-list',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 2, // currently there is a bug that prevents a depth > 2 from displaying correctly
                'walker' => new Uglyboy_Walker()
            )); 
            ?>
        </nav>
        <!-- /nav -->

    </header>
    <!-- /header -->