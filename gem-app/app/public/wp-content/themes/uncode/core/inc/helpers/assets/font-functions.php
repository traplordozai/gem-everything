<?php
/**
 * Font related functions
 */

/**
 * Get page's required fonts
 */
function uncode_get_page_fonts() {
	global $uncode_post_data;

	$fonts = array();

	// Get an array that contains all the raw content attached to the page
	$content_array = uncode_get_post_data_content_array();

	// Get fonts in Theme Options
	$body_font        = ot_get_option( '_uncode_body_font_family' );
	$heading_font     = ot_get_option( '_uncode_heading_font_family' );
	$menu_font        = ot_get_option( '_uncode_menu_font_family' );
	$buttons_font     = ot_get_option( '_uncode_buttons_font_family' );
	$menu_filter_font = ot_get_option( '_uncode_menu_filter_font_family' );
	$ui_font          = ot_get_option( '_uncode_ui_font_family' );
	$top_bar_font     = ot_get_option( '_uncode_topbar_font_family' );
	$top_bar_core     = get_option( 'uncode_core_settings_opt_enhanced_top_bar' ) === 'on';

	if ( $heading_font ) {
		$fonts[] = $heading_font;
	}

	if ( $body_font ) {
		$fonts[] = $body_font;
	}

	if ( $menu_font ) {
		$fonts[] = $menu_font;
	}

	if ( $buttons_font ) {
		$fonts[] = $buttons_font;
	}

	if ( $buttons_font ) {
		$fonts[] = $buttons_font;
	}

	if ( $menu_filter_font ) {
		$fonts[] = $menu_filter_font;
	}

	if ( $ui_font ) {
		$fonts[] = $ui_font;
	}

	if ( $top_bar_font && $top_bar_core ) {
		$fonts[] = $top_bar_font;
	}

	if ( uncode_post_data_is_singular() ) {

		// Singular
		$header_type = get_post_meta( $uncode_post_data['ID'], '_uncode_header_type', true );

		if ( $header_type === 'header_basic' ) {
			$header_font = get_post_meta( $uncode_post_data['ID'], '_uncode_header_title_font', true );

			if ( $header_font ) {
				$fonts[] = $header_font;
			}
		} else if ( ! $header_type ) {
			$header_type = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_header' );

			if ( $header_type === 'header_basic' ) {
				$header_font = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_header_title_font' );

				if ( $header_font ) {
					$fonts[] = $header_font;
				}
			}
		}
	}

	$fonts = array_unique( $fonts );

	// Get saved fonts
	$font_ids    = array();
	$font_groups = ot_get_option( '_uncode_font_groups' );

	if ( is_array( $font_groups ) ) {
		foreach ( $font_groups as $font_group ) {
			if ( isset( $font_group['_uncode_font_group_unique_id'] ) && ! in_array( $font_group['_uncode_font_group_unique_id'], $fonts ) ) {
				$font_ids[] = $font_group['_uncode_font_group_unique_id'];
			}
		}
	}

	// Check if we have fonts in the content
	$font_ids = array_unique( $font_ids );

	foreach ( $font_ids as $font_id ) {
		foreach ( $content_array as $content ) {
			if ( strpos( $content, $font_id ) !== false ) {
				$fonts[] = $font_id;
				continue;
			}
		}
	}

	$fonts_data = array();

	if ( is_array( $font_groups ) ) {
		foreach ( $font_groups as $font_group ) {
			if ( isset( $font_group['_uncode_font_group'] ) && isset( $font_group['_uncode_font_group_unique_id'] ) && in_array( $font_group['_uncode_font_group_unique_id'], $fonts ) ) {
				$fonts_data[$font_group['_uncode_font_group_unique_id']] = $font_group['_uncode_font_group'];
			}
		}
	}

	return $fonts_data;
}

/**
 * Get page's required Google Font families
 */
function uncode_get_page_google_font_families() {
	$fonts         = uncode_get_page_fonts();
	$font_families = array();
	$font_stack    = get_option( 'uncode_font_options' );

	if ( isset( $font_stack['font_stack'] ) && $font_stack['font_stack'] ) {
		$font_stack = json_decode( str_replace( '&quot;', '"', $font_stack['font_stack'] ), true );
		foreach ( $fonts as $font_id => $font_value ) {
			foreach ( $font_stack as $font_stack_value ) {
				if ( isset( $font_stack_value['source'] ) && isset( $font_stack_value['family'] ) ) {
					if ( $font_stack_value['source'] === 'Google Web Fonts' ) {
						$font_family_name = urlencode( (string) $font_stack_value['family'] );

						if ( $font_family_name === $font_value ) {
							$font_families[] = $font_stack_value;
						}
					}
				}
			}
		}
	}

	return $font_families;
}
