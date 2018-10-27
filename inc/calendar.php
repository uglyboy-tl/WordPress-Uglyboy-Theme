<?php

function filter_get_calendar( $cache_key ) { 
    return str_replace('<table id="wp-calendar">','<table id="wp-calendar" class="pure-table pure-table-horizontal">',$cache_key); 
}; 

add_filter( 'get_calendar', 'filter_get_calendar'); 

?>