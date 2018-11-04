<?php

function uglyboy_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('uglyboyscripts', get_template_directory_uri() . '/js/scripts.js', array('zepto'), '1.0.0'); // Custom scripts
        wp_enqueue_script('uglyboyscripts'); // Enqueue it!

        wp_deregister_script( 'jquery' );

        $use_local_assets =false;
        if ( get_option('uglyboy_local_assets') == 'checked') {
            $prefix_url = get_template_directory_uri().'/js';
            $use_local_assets =true;
        }
        wp_register_script( 'zepto', $use_local_assets?$prefix_url.'/zepto.min.js':'https://cdn.bootcss.com/zepto/1.2.0/zepto.min.js', array(), '1.2.0' );
        
        if ( get_option('uglyboy_lightbox') == 'checked') {
            wp_enqueue_script("lightbox",get_template_directory_uri() . "/js/lightbox.js",array('zepto'),'0.1.0');
        }
        if (true) {
            wp_enqueue_script("menu",get_template_directory_uri() . "/js/nav-menu.js",array('zepto'),'1.0');
        }
        if ( get_option('uglyboy_scrollTop') == 'checked') {
            wp_enqueue_script("scrollTop",get_template_directory_uri() . "/js/scrollTop.js",array('zepto'),'0.1.0');
        }
    }
}

// Load Uglyboy styles
function uglyboy_styles()
{
    if ( get_option('uglyboy_local_assets') == 'checked') {
        $prefix_url = get_template_directory_uri().'/css';
        $use_local_assets =true;
    }
    wp_enqueue_style("pure",$use_local_assets?$prefix_url.'/pure-min.css':"https://cdn.bootcss.com/pure/1.0.0/pure-min.css",array(),'1.0.0');
    wp_enqueue_style("grids-responsive-min",$use_local_assets?$prefix_url.'/grids-responsive-min.css':"https://cdn.bootcss.com/pure/1.0.0/grids-responsive-min.css",array("pure"),'1.0.0');
    //wp_enqueue_style('typo', $use_local_assets?$prefix_url.'/typo.css':'https://apps.bdimg.com/libs/typo.css/2.0/typo.css', array(), '2.0', 'all');
    wp_enqueue_style('font-awesome',$use_local_assets?'https://blog.uglyboy.cn/wp-content/themes/Uglyboy/css/font-awesome.min.css':'https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css',array(),'4.7.0');
    
    wp_enqueue_style('uglyboy', get_template_directory_uri() . '/style.css', array("grids-responsive-min"), '2.0.2', 'all');
       
    wp_enqueue_style('skin', get_template_directory_uri() . '/css/skin.css', array("uglyboy"), '1.0', 'all');
    
    wp_enqueue_style('color', get_template_directory_uri() . '/css/color.css', array("uglyboy"), '1.0', 'all');
    
    if ( get_option('uglyboy_lightbox') == 'checked') {
        wp_enqueue_style("lightbox-css",get_template_directory_uri() . "/css/lightbox.css",array(),'0.1.0');
    }
    if (true) {  
        wp_enqueue_style("menu-css",get_template_directory_uri() . "/css/menu.css",array(),'1.0');
    }
}


add_action('wp_footer', 'uglyboy_scripts');
add_action('wp_enqueue_scripts', 'uglyboy_styles'); 

?>