<?php
/*
 *  Author: uglyboy | @uglyboy
 *  URL: uglyboy.cn | @uglyboy
 *  Custom functions, support, custom post types and more.
 */
function uglyboy_setup() {
    // Localisation Support
    load_theme_textdomain('uglyboy', get_template_directory() . '/languages');

    // Add Menu Support
    add_theme_support('menus');
    
	register_nav_menus(
		array(
            'header-menu' => __( 'Header Menu', 'uglyboy' ),    
		)
	);
    // Add theme support for Custom Logo.
    add_theme_support('custom-logo'); 
       
    add_theme_support( 'custom-header',array(
        'default-image' => str_replace('http','https',get_template_directory_uri()) .'/img/header.jpg',
    ));

    add_theme_support( 'custom-background');
    
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    
}
add_action( 'after_setup_theme', 'uglyboy_setup' );

// If Dynamic Sidebar Exists
function uglyboy_widgets_init() {
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
        'before_widget' => '<div id="%1$s" class="%2$s pure-u-1 pure-u-md-1-3">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}
add_action( 'widgets_init', 'uglyboy_widgets_init' );

// 注册 css/js 文件
require get_template_directory() . '/inc/init.php';

// 清理 WordPress 功能
require get_template_directory() . '/inc/clean.php';

// 图标
require get_template_directory() . '/inc/icon_functions.php';

// 菜单组件
require get_template_directory() . '/inc/menu.php';

// 日历组件
require get_template_directory() . '/inc/calendar.php';

// 标签云组件
require get_template_directory() . '/inc/tag_cloud.php';

// 文章阅读次数
require get_template_directory() . '/inc/post_views.php';

?>