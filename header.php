<!doctype html>
<html <?php language_attributes(); ?> class="borderbox">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

	<body class="pure-skin-uglyboy">
		<!-- header -->
		<header>
			<!-- logo -->
			<div class="">
				<a href="<?php echo home_url(); ?>">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
				</a>
			</div>
			<!-- /logo -->

			<!-- nav -->
			<div id="nav-height">
				<?php wp_nav_menu( array(
					 'theme_location'  => 'header-menu',
					 'container' => 'nav',
					 'container_class' => 'pure-menu pure-menu-horizontal',
					 'container_id' => 'nav-menu',
					 'menu_class' => 'pure-menu-list',
					 'menu_id' => 'menu',
					 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					 'depth'           => 2, // currently there is a bug that prevents a depth > 2 from displaying correctly
					 'walker' => new Uglyboy_Walker()
				)); ?>
			</div>

			<!-- /nav -->
			
		</header>
		<!-- /header -->
		<div class="pure-g container">
