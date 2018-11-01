<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?php wp_title(''); ?>
        <?php if(wp_title('', false)) { echo ' :'; } ?>
        <?php bloginfo('name'); ?>
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="manifest" href="/site.webmanifest">
    <link rel="apple-touch-icon" href="/icon.png">

    <?php wp_head(); ?>
</head>

<body class="bg-color">
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- header -->
    <header class="pure-u-1" role="banner">

        <!-- logo -->
        <div class="pure-u-1 bg-image" id='logo' style="background-image:url(<?php header_image()?>);color:<?php header_textcolor();?>">
            <div class="bg-image-title">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?></a></h1>
                <p class="site-description">
                    <?php bloginfo( 'description' ); ?>
                </p>
            </div>
        </div>
        <!-- /logo -->

        <!-- nav -->
        <nav class="pure-u-1 nav-color nav-shadow center" role="navigation">
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