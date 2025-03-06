<?php
/**
 * Functions that fire when saving a post
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Print nonce
 */
function uncode_print_clean_dynamic_css_shortcode_nonce() {
	wp_nonce_field( 'uncode-clean-dynamic-css-shortcode-nonce', 'dynamic_css_cleanup' );
}
add_action( 'post_submitbox_start', 'uncode_print_clean_dynamic_css_shortcode_nonce' );

/**
 * Clean up post content
 */
function uncode_get_clean_dynamic_css_shortcode_content( $content ) {
	$regex = '/\[([^\[]+) [^\s]+_type=\\\\\"(uncode-palette|uncode-solid|uncode-gradient)\\\\\".*?\]/m';
	preg_match_all( $regex, $content, $shortcodes, PREG_SET_ORDER, 0 );

	$shortcodes_with_colors = uncode_get_shortcodes_with_colors( $shortcodes );

	foreach ( $shortcodes_with_colors as $shortcode ) {
		$clean_shortcode     = $shortcode;
		$shortcode_data      = uncode_get_shortcodes_with_colors_data( wp_unslash( $shortcode ) );
		$atts_keys_to_remove = array();
		$atts_data_to_remove = array();
		$selected_colors     = array();
		$has_changed         = false;

		// Iterate each attribute and find the attributes we need to remove
		if ( isset( $shortcode_data['attributes'] ) && is_array( $shortcode_data['attributes'] ) ) {
			foreach ( $shortcode_data['attributes'] as $att_key => $att_value ) {
				if ( $att_value === 'uncode-gradient' ) {
					$att_to_search         = str_replace( '_type', '', $att_key );
					$atts_keys_to_remove[] = $att_to_search . '_solid';
					$atts_keys_to_remove[] = $att_to_search;

					$selected_colors[$att_to_search . '_gradient'] = false;
				} else if ( $att_value === 'uncode-solid' ) {
					$att_to_search         = str_replace( '_type', '', $att_key );
					$atts_keys_to_remove[] = $att_to_search . '_gradient';
					$atts_keys_to_remove[] = $att_to_search;

					$selected_colors[$att_to_search . '_solid'] = false;
				} else if ( $att_value === 'uncode-palette' ) {
					$att_to_search         = str_replace( '_type', '', $att_key );
					$atts_keys_to_remove[] = $att_to_search . '_gradient';
					$atts_keys_to_remove[] = $att_to_search . '_solid';

					$selected_colors[$att_to_search] = false;
				}
			}

			foreach ( $shortcode_data['attributes'] as $att_key => $att_value ) {
				// Build a list of unneeded attributes we need to remove later
				if ( in_array( $att_key, $atts_keys_to_remove ) ) {
					$atts_data_to_remove[] = array(
						'key'   => $att_key,
						'value' => $att_value,
					);

					$has_changed = true;
				}

				// Check if the selected color type exists and has a value
				if ( array_key_exists( $att_key, $selected_colors ) && $att_value ) {
					$selected_colors[$att_key] = true;
				}
			}

			// If selected color types don't exist, remove them
			foreach ( $selected_colors as $selected_color_key => $selected_color_value ) {
				if ( ! $selected_color_value ) {
					if ( strpos( $selected_color_key, '_gradient' ) !== false ) {
						$att_value = 'uncode-gradient';
					} else if ( strpos( $selected_color_key, '_solid' ) !== false ) {
						$att_value = 'uncode-solid';
					} else {
						$att_value = 'uncode-palette';
					}

					$atts_data_to_remove[] = array(
						'key'   => $selected_color_key . '_type',
						'value' => $att_value,
					);

					$has_changed = true;
				}
			}
		}

		// Finally, remove the attributes from the shortcode string
		if ( $has_changed ) {
			foreach ( $atts_data_to_remove as $data_to_remove ) {
				$string_to_search = ' ' . $data_to_remove['key'] . '=\"' . $data_to_remove['value'] . '\"';
				$clean_shortcode = str_replace( $string_to_search, '', $clean_shortcode );
			}

			$content = str_replace( $shortcode, $clean_shortcode, $content );
		}
	}

	return $content;
}
add_filter( 'content_save_pre', 'uncode_get_clean_dynamic_css_shortcode_content' );
