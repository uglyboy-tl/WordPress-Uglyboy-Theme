<?php

function uglyboy_get_icon( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'uglyboy' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return __( 'Please define an icon name.', 'uglyboy' );
	}

	// Set defaults.
	$defaults = array(
		'icon'     => '',
		'size'    => '',
		'fallback' => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	// Set icon_size.
	$icon_size = '';


	if ( $args['size'] ) {
		$icon_size = ' fa-' . esc_attr($args['size']);
	}

	// Begin icon markup.
	$icon = '<i class="fa fa-' . esc_attr( $args['icon']) . $icon_size . '"' . $aria_hidden . '></i>';

	return $icon;
}

?>