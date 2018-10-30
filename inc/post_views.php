<?php

function get_post_views() {
    global $post;
    $post_ID = $post->ID;
    $count_key = 'post_views_count';
    $post_views = (int)get_post_meta( $post_ID, $count_key, true );
    return $post_views;
 }

 function set_post_views() {
    if (is_singular())
    {
        global $post;
        $post_ID = $post->ID;
        
        if($post_ID)
        {
            $count_key = 'post_views_count';
            $post_views = (int)get_post_meta($post_ID, $count_key, true);
            if(!update_post_meta($post_ID, $count_key, ($post_views+1)))
            {
              add_post_meta($post_ID, $count_key, 1, true);
            }
        }
    }
}
add_action('wp_head', 'set_post_views');
?>