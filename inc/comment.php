<?php

function filter_get_comment_class( $classes ) { 
    array_push($classes,"card","card-body");
    return $classes; 
}; 

add_filter( 'comment_class', 'filter_get_comment_class'); 

?>