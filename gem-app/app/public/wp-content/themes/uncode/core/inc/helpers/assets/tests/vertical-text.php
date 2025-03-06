<?php
/**
 * Vertical Text test
 */

function uncode_page_require_asset_vertical_text( $content_array ) {
	global $uncode_check_asset;

	if ( apply_filters( 'uncode_enqueue_vertical_text', false ) ) {
		$uncode_check_asset['fixedElement'] = true;
		$uncode_check_asset['verticalText'] = true;
		$uncode_check_asset['horizontalText'] = true;
	}

	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[uncode_vertical_text' ) !== false ) {
			$uncode_check_asset['fixedElement'] = true;
		}

		$regex = '/\[uncode_vertical_text(.*?)\]/';
		preg_match_all( $regex, $content, $shortcode_matches, PREG_SET_ORDER );

		foreach ( $shortcode_matches as $key => $vertical_text ) {
			if ( is_array( $vertical_text ) &&  isset( $vertical_text[0] ) ) {
				$regex_attr = '/layout=\"(.*?)\"/';
				preg_match_all( $regex_attr, $vertical_text[0], $layout_values, PREG_SET_ORDER );

				$has_vertical_layout = true;

				foreach ( $layout_values as $key => $layout_value ) {
					if ( is_array( $layout_value ) && isset( $layout_value[1] ) ) {
						if ( strpos( $layout_value[1], 'media' ) === false ) {
							$has_vertical_layout = false;
						}
					}
				}

				if ( $has_vertical_layout ) {
					$uncode_check_asset['verticalText'] = true;
				} else {
					$uncode_check_asset['horizontalText'] = true;
				}
			}

			if ( isset( $uncode_check_asset['verticalText'] ) && isset( $uncode_check_asset['horizontalText'] ) ) {
				break;
			}
		}
	}
}
