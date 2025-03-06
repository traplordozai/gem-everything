<?php
/**
 * Replace functions
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Replace all "text_size" occurrences and find the best available size
 */
function uncode_wf_print_font_size( $size ) {
	// Run only on AJAX calls
	if ( ! UNCDWF_Dynamic::is_init() ) {
		return $size;
	}

	// Skip bigtext
	if ( $size === 'bigtext' ) {
		return $size;
	}

	// Skip custom
	if ( $size === 'custom' ) {
		return $size;
	}

	// If we already have this size in our cache, get it from there
	if ( array_key_exists( $size, UNCDWF_Dynamic::get_font_sizes_map() ) ) {
		$available_size = UNCDWF_Dynamic::get_font_size_value( $size );
	} else {
		$available_size = uncode_wf_find_closest_font_size( $size );
		UNCDWF_Dynamic::add_font_size_map( $size, $available_size );
	}

	return $available_size;
}

/**
 * Find closest available font size
 */
function uncode_wf_find_closest_font_size( $size_name ) {
	$closest    = null;
	$sizes_map  = uncode_wf_get_font_size_map();
	$user_sizes = UNCDWF_Dynamic::font_sizes();
	$size_value = isset( $sizes_map[ $size_name ] ) ? $sizes_map[ $size_name ] : $sizes_map[ 'h1' ];

	// Return early if we don't have any user value
	if ( empty( $user_sizes ) ) {
		return $size_name;
	}

	// First check if the user has this font (with the same value)
	if ( isset( $user_sizes[ $size_name ] ) && $user_sizes[ $size_name ] == $size_value ) {
		return $size_name;
	}

	// Otherwise find the closest font available
	foreach ( $user_sizes as $item ) {
		$size_value = absint( $size_value );

		if ( $closest === null || abs( $size_value - $closest ) > abs( $item - $size_value ) ) {
			$closest = $item;
		}
	}

	// Get key from value
	$key = array_search( $closest, $user_sizes );

	return $key;
}

/**
 * Replace all "text_space" occurrences if the user doesn't have that option
 */
function uncode_wf_print_font_space( $space ) {
	// Run only on AJAX calls
	if ( ! UNCDWF_Dynamic::is_init() ) {
		return $space;
	}

	// User's font spacings
	$user_font_spacings = UNCDWF_Dynamic::font_spacings();

	if ( ! in_array( $space, $user_font_spacings ) ) {
		return '';
	}

	return $space;
}

/**
 * Replace all "text_height" occurrences if the user doesn't have that option
 */
function uncode_wf_print_font_height( $height ) {
	// Run only on AJAX calls
	if ( ! UNCDWF_Dynamic::is_init() ) {
		return $height;
	}

	// User's font heights
	$user_font_spacings = UNCDWF_Dynamic::font_heights();

	if ( ! in_array( $height, $user_font_spacings ) ) {
		return '';
	}

	return $height;
}

/**
 * Print single random placeholder
 */
function uncode_wf_print_single_image( $id ) {
	// Run only on AJAX calls
	if ( ! UNCDWF_Dynamic::is_init() ) {
		return $id;
	}

	// Replace only numeric IDs
	if ( ! is_numeric( $id ) ) {
		return $id;
	}

	switch ( $id ) {
		case '84155':
			# Team placeholder
			$placeholder = apply_filters( 'uncode_wireframes_get_team_placeholder_media_id', uncode_wf_get_team_placeholder_media_id() );
			break;

		case '82903':
			# Quote placeholder
			$placeholder = apply_filters( 'uncode_wireframes_get_quote_placeholder_media_id', uncode_wf_get_quote_placeholder_media_id() );
			break;

		case '83435':
		case '83434':
		case '83433':
		case '83432':
		case '83431':
		case '83430':
		case '83429':
			# Logo placeholder
			$placeholder = apply_filters( 'uncode_wireframes_get_logo_placeholder_media_id', uncode_wf_get_logo_placeholder_media_id() );
			break;

		default:
			# Generic placeholder
			$placeholders = uncode_wf_get_generic_placeholder_media_ids();
			$placeholder  = uncode_wf_get_random_from_array( $placeholders );
			$placeholder  = apply_filters( 'uncode_wireframes_get_generic_placeholder_media_id', $placeholder );
			break;
	}

	// If for some reason we don't have the placeholder, use the old ID
	$placeholder = $placeholder ? $placeholder : $id;

	return $placeholder;
}

/**
 * Print multiple random placeholders
 */
function uncode_wf_print_multiple_images( $ids ) {
	$placeholders = array();

	foreach ( $ids as $id ) {
		$placeholders[] = uncode_wf_print_single_image( $id );
	}

	return implode( ',', $placeholders );
}

/**
 * Print color
 */
function uncode_wf_print_color( $color ) {
	// Run only on AJAX calls
	if ( ! UNCDWF_Dynamic::is_init() ) {
		return $color;
	}

	switch ( $color ) {
		// White
		case 'color-xsdn':
			$color = UNCDWF_Dynamic::light_background_color();
			break;

		// Black
		case 'color-nhtu':
			$color = UNCDWF_Dynamic::dark_background_color();
			break;

		// Grey color
		case 'color-lxmt':
			$color = UNCDWF_Dynamic::light_grey_color();
			break;
	}

	return $color;
}

/**
 * Print form ID
 */
function uncode_wf_print_form_id( $id ) {
	// Run only on AJAX calls
	if ( ! UNCDWF_Dynamic::is_init() ) {
		return $id;
	}

	$map        = uncode_wf_get_forms_map();
	$demo_forms = uncode_wf_get_demo_forms_ids();
	$form_type  = isset( $map[ $id ] ) ? $map[ $id ] : 'basic';

	if ( in_array( $form_type , array_column( $demo_forms, 'type' ) ) ) {
		$form_key = array_search( $form_type, array_column( $demo_forms, 'type' ) );
		$form     = $demo_forms[ $form_key ];
		$form_id  = $form[ 'id' ];
	}

	// If for some reason we don't have the form, use the old ID
	$form_id = isset( $form_id ) && $form_id ? $form_id : $id;

	return $form_id;
}
