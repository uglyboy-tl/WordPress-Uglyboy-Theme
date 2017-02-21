<?php

if ( ! function_exists( 'uglyboy_setup' ) ) :

function uglyboy_setup() {

	load_theme_textdomain( 'uglyboy' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'header-menu' => __('Header Menu', 'uglyboy'), // Main Navigation
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif; 
add_action( 'after_setup_theme', 'uglyboy_setup' );

function uglyboy_widgets_init() {
	register_sidebar(array(
	  'name'			=> __( 'Sidebar', 'uglyboy' ),
	  'id'				=> 'sidebar',
	  'description'		=> __( 'Widgets in this area will be shown in the sidebar.', 'uglyboy' ),
	  'before_widget'	=> '<section id="%1$s" class="segment %2$s">',
	  'after_widget'	=> '</section>',
	  'before_title'	=> '<h4 class="header">',
	  'after_title'		=> '</h4>',
	));
}
add_action( 'widgets_init', 'uglyboy_widgets_init' );


/*------------------------------------*\
	Functions
\*------------------------------------*/

// Load UglyBoy scripts (header.php)
function uglyboy_scripts()
{
	// 改用jquery 2.1
	wp_deregister_script( 'jquery' );
    //wp_register_script( 'jquery', '//lib.sinaapp.com/js/jquery/2.2.4/jquery-2.2.4.min.js', array(), '2.2.4' );
    wp_register_script( 'zepto', get_template_directory_uri() . '/css/zepto.min.js', array(), '2.2.4' );

    wp_enqueue_style("pure",get_template_directory_uri() . "/css/pure.min.css",array(),'0.6.2');
    wp_enqueue_style("grids-responsive-min",get_template_directory_uri() . "/css/grids-responsive.min.css",array(),'0.6.2');
    wp_enqueue_style('typo', get_template_directory_uri() . '/css/typo.css', array(), '1.0', 'all');
    wp_enqueue_style('addition', get_template_directory_uri() . '/css/addition.css', array(), '1.0', 'all');
    
    wp_enqueue_style("uglyboy-style",get_template_directory_uri() . "/css/pure-skin-uglyboy.css",array(),'0.6.0');

	wp_enqueue_style('uglyboy', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');

	//wp_enqueue_script('uglyboyscripts-jquery', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
	wp_enqueue_script('uglyboyscripts-zepto', get_template_directory_uri() . '/js/scripts.js', array('zepto'), '1.0.0'); // Custom scripts

}
add_action('wp_enqueue_scripts', 'uglyboy_scripts'); // Add Custom Scripts to wp_head

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/menu-class.php';

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}
// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Remove Open Sans that WP adds from frontend
if (!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
    }
     // 前台删除Google字体CSS
    add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
    // 后台删除Google字体CSS
     add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
endif;

// 禁用emoji
remove_action( 'admin_print_scripts',	'print_emoji_detection_script');
remove_action( 'admin_print_styles',	'print_emoji_styles');

remove_action( 'wp_head',				'print_emoji_detection_script',	7);
remove_action( 'wp_print_styles',		'print_emoji_styles');

remove_action('embed_head',				'print_emoji_detection_script');

remove_filter( 'the_content_feed',		'wp_staticize_emoji');
remove_filter( 'comment_text_rss',		'wp_staticize_emoji');
remove_filter( 'wp_mail',				'wp_staticize_emoji_for_email');

//禁用embeds功能 移除wp-embed.min.js文件
function disable_embeds_init() {
    /* @var WP $wp */
    global $wp;
 
    // Remove the embed query var.
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(
        'embed',
    ) );
 
    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
 
    // Turn off
    add_filter( 'embed_oembed_discover', '__return_false' );
 
    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
 
    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
 
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
 
    // Remove all embeds rewrite rules.
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
add_action( 'init', 'disable_embeds_init', 9999 );
 
function disable_embeds_tiny_mce_plugin( $plugins ) {
    return array_diff( $plugins, array( 'wpembed' ) );
}
 
function disable_embeds_rewrites( $rules ) {
    foreach ( $rules as $rule => $rewrite ) {
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {
            unset( $rules[ $rule ] );
        }
    }
 
    return $rules;
}
 
function disable_embeds_remove_rewrite_rules() {
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
 
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );

function disable_embeds_flush_rewrite_rules() {
    remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
 
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );