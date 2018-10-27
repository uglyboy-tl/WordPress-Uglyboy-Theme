<?php

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

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function uglyboygravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}


add_filter('avatar_defaults', 'uglyboygravatar'); // Custom Gravatar in Settings > Discussion
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

?>