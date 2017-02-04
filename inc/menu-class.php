<?php

class Uglyboy_Walker extends Walker {

	var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"pure-menu-children\">\n";
	}

	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

		global $wp_query;
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		
		/* */ 
		if (in_array('current-menu-item', $classes)) {
			$active = true;
		}
		if (in_array('menu-item-has-children', $classes)) {
			$classes = array();
			$classes[] = 'pure-menu-allow-hover';
			$dropdown = true;
		}
		else{
			$classes = array();
		}
		$classes[] = 'pure-menu-item';
		if($active){
			$classes[] = 'pure-menu-selected';
		}

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
		
		$output .= $indent . '<li' . $class_names .'>';

		$atts           = array();
		$atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
		$atts['target'] = !empty($item->target)     ? $item->target     : '';
		$atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
		$atts['href']   = !empty($item->url)        ? $item->url        : '';
		
		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
		
		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (! empty($value)) {
				$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}


		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'class="pure-menu-link" >';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}
}
?>