<?php
/*
 *  Author: uglyboy | @uglyboy
 *  URL: uglyboy.cn | @uglyboy
 *  Custom functions, support, custom post types and more.
 */
if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Localisation Support
    load_theme_textdomain('uglyboy', get_template_directory() . '/languages');
}

function uglyboy_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('uglyboyscripts', get_template_directory_uri() . '/js/scripts.js', array('zepto'), '1.0.0'); // Custom scripts
        wp_enqueue_script('uglyboyscripts'); // Enqueue it!

        wp_deregister_script( 'jquery' );
        wp_register_script( 'zepto', 'https://cdn.bootcss.com/zepto/1.2.0/zepto.min.js', array(), '1.2.0' );
        
        wp_enqueue_script("lightbox",get_template_directory_uri() . "/js/lightbox.js",array('zepto'),'0.1.0');
    }
}

// Load Uglyboy conditional scripts
function uglyboy_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load Uglyboy styles
function uglyboy_styles()
{
    wp_enqueue_style("pure","https://cdn.bootcss.com/pure/1.0.0/pure-min.css",array(),'1.0.0');
    wp_enqueue_style("grids-responsive-min","https://cdn.bootcss.com/pure/1.0.0/grids-responsive-min.css",array(),'1.0.0');
    wp_enqueue_style('typo', 'https://apps.bdimg.com/libs/typo.css/2.0/typo.css', array(), '2.0', 'all');
    
    wp_register_style('uglyboy', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('uglyboy'); // Enqueue it!
    
    wp_register_style('skin', get_template_directory_uri() . '/css/skin-md.css', array(), '1.0', 'all');
    wp_enqueue_style('skin'); // Enqueue it!  
    
    wp_enqueue_style("lightbox-css",get_template_directory_uri() . "/css/lightbox.css",array(),'0.1.0');
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'uglyboy'),
        'description' => __('Description for this widget-area...', 'uglyboy'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'uglyboy'),
        'description' => __('Description for this widget-area...', 'uglyboy'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}
/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'uglyboy_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'uglyboy_conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'uglyboy_styles'); // Add Theme Stylesheet

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
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


require get_template_directory() . '/inc/menu.php';
?>