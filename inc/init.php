<?php

function uglyboy_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('uglyboyscripts', get_template_directory_uri() . '/js/scripts.js', array('zepto'), '1.0.0'); // Custom scripts
        wp_enqueue_script('uglyboyscripts'); // Enqueue it!

        wp_deregister_script( 'jquery' );
        wp_register_script( 'zepto', 'https://cdn.bootcss.com/zepto/1.2.0/zepto.min.js', array(), '1.2.0' );
        
        wp_enqueue_script("lightbox",get_template_directory_uri() . "/js/lightbox.js",array('zepto'),'0.1.0');
    }
}

// Load Uglyboy styles
function uglyboy_styles()
{
    wp_enqueue_style("pure","https://cdn.bootcss.com/pure/1.0.0/pure-min.css",array(),'1.0.0');
    wp_enqueue_style("grids-responsive-min","https://cdn.bootcss.com/pure/1.0.0/grids-responsive-min.css",array("pure"),'1.0.0');
    wp_enqueue_style('typo', 'https://apps.bdimg.com/libs/typo.css/2.0/typo.css', array(), '2.0', 'all');
    //wp_enqueue_style('normalize', 'https://necolas.github.io/normalize.css/8.0.0/normalize.css', array(), '8.0.0', 'all');
    wp_enqueue_style('font-awesome','https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css',array(),'4.7.0');
    
    wp_register_style('uglyboy', get_template_directory_uri() . '/style.css', array("grids-responsive-min"), '1.0', 'all');
    wp_enqueue_style('uglyboy'); // Enqueue it!
    
    wp_register_style('skin', get_template_directory_uri() . '/css/skin-md.css', array("uglyboy"), '1.0', 'all');
    wp_enqueue_style('skin'); // Enqueue it!  
    
    wp_enqueue_style("lightbox-css",get_template_directory_uri() . "/css/lightbox.css",array(),'0.1.0');
}


add_action('init', 'uglyboy_scripts'); // Add Custom CSS to wp_head
//remove_action('wp_head', 'wp_enqueue_scripts', 1); // Add Custom JS to wp_footer
//add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_enqueue_scripts', 'uglyboy_styles'); 

?>