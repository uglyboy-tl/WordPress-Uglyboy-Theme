<?php
/*
 *  Author: uglyboy | @uglyboy
 *  URL: uglyboy.cn | @uglyboy
 *  Custom functions, support, custom post types and more.
 */
function uglyboy_setup() {
    // Localisation Support
    load_theme_textdomain('uglyboy', get_template_directory() . '/languages');
    
    add_theme_support('html5');
    
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
        'flex-width' => true,// 自适应高度
        'flex-width' => true,// 自适应宽度
        'default-text-color' => '#eee',
        'default-image' => get_template_directory_uri() .'/img/header.jpg',
    ));
    
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
        'before_widget' => '<div id="%1$s" class="card card-body %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="card-title">',
        'after_title' => '</h4>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'uglyboy'),
        'description' => __('Description for this widget-area...', 'uglyboy'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="card card-body pure-u-1 pure-u-md-1-3 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="card-title">',
        'after_title' => '</h4>'
    ));
}
add_action( 'widgets_init', 'uglyboy_widgets_init' );

// 增加主题选项
require get_template_directory() . '/inc/theme_options.php';

// 注册 css/js 文件
require get_template_directory() . '/inc/init.php';

// 清理 WordPress 功能
require get_template_directory() . '/inc/clean.php';

// 图标
require get_template_directory() . '/inc/icon_functions.php';

// 菜单组件
require get_template_directory() . '/inc/menu.php';

// 页面导航组件
require get_template_directory() . '/inc/paginate_links.php';

// 日历组件
require get_template_directory() . '/inc/calendar.php';

// 评论组件
require get_template_directory() . '/inc/comment.php';

// 标签云组件
require get_template_directory() . '/inc/tag_cloud.php';

// 文章阅读次数
require get_template_directory() . '/inc/post_views.php';

?>