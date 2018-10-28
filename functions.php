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

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    
    // Localisation Support
    load_theme_textdomain('uglyboy', get_template_directory() . '/languages');
}

if(function_exists('register_nav_menus')){    
    register_nav_menus(array(  
        'header-menu' => __( 'Header Menu', 'uglyboy' ),    
    ));  
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

// 注册 css/js 文件
require get_template_directory() . '/inc/init.php';

// 清理 WordPress 功能
require get_template_directory() . '/inc/clean.php';

// 菜单组件
require get_template_directory() . '/inc/menu.php';

// 日历组件
require get_template_directory() . '/inc/calendar.php';

// 图标
require get_template_directory() . '/inc/icon-functions.php';
?>