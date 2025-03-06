<?php
/**
 * GSAP test
 */

function uncode_page_require_asset_gsap( $content_array ) {
	global $uncode_post_data, $uncode_check_asset;

	$gsap_required = false;

	if ( apply_filters( 'uncode_enqueue_gsap', false ) ) {
		return true;
	}

	// Check magnetic in page header (basic header)
	if ( uncode_post_data_is_singular() ) {
		$specific_header_type = get_post_meta( $uncode_post_data['ID'], '_uncode_header_type', true );

		if ( $specific_header_type === 'header_basic' ) {
			$zoom_effect = get_post_meta( $uncode_post_data['ID'], '_uncode_header_kburns', true );

			if ( $zoom_effect === 'magnetic' ) {
				$uncode_check_asset['magnetic'] = true; // This activates the magnetic cursor
				$gsap_required = true;
			}
		} else if ( $specific_header_type === '' ) {
			$generic_header_type  = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_header' );

			if ( $generic_header_type === 'header_basic' ) {
				$zoom_effect  = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_header_kburns' );

				if ( $zoom_effect === 'magnetic' ) {
					$uncode_check_asset['magnetic'] = true; // This activates the magnetic cursor
					$gsap_required = true;
				}
			}
		}
	} else if ( uncode_post_data_is_archive() || uncode_post_data_is_post_type_archive() ) {
		if ( isset( $uncode_post_data['post_type'] ) ) {
			$post_type = $uncode_post_data['post_type'];
			$generic_header_type  = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_index_header' );

			if ( $generic_header_type === 'header_basic' ) {
				$zoom_effect  = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_index_header_kburns' );

				if ( $zoom_effect === 'magnetic' ) {
					$uncode_check_asset['magnetic'] = true; // This activates the magnetic cursor
					$gsap_required = true;
				}
			}
		}
	} else if ( uncode_post_data_is_home() ) {
		$header_type = ot_get_option( '_uncode_post_index_header' );

		if ( $header_type === 'header_basic' ) {
			$zoom_effect = ot_get_option('_uncode_post_index_header_kburns');

			if ( $zoom_effect === 'magnetic' ) {
				$uncode_check_asset['magnetic'] = true; // This activates the magnetic cursor
				$gsap_required = true;
			}
		}
	}

	// Check skew from PO or TO
	if ( uncode_post_data_is_singular() ) {
		$specific_skew = get_post_meta( $uncode_post_data['ID'], '_uncode_specific_skew', true );

		if ( $specific_skew === 'on' ) {
			$uncode_check_asset['skewIt'] = true; // This activates the skew
			$gsap_required = true;
		} else if ( $specific_skew === '' ) {
			$generic_skew  = ot_get_option( '_uncode_skew' );

			if ( $generic_skew === 'on' ) {
				$uncode_check_asset['skewIt'] = true; // This activates the skew
				$gsap_required = true;
			}
		}
	}

	// Check other effects
	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'single_image_magnetic="yes"' ) !== false ) {
			$uncode_check_asset['magnetic'] = true; // This activates the magnetic cursor
			$gsap_required = true;
		}

		if ( strpos( $content, 'media_image_magnetic="yes"' ) !== false ) {
			$uncode_check_asset['magnetic'] = true; // This activates the magnetic cursor
			$gsap_required = true;
		}

		if ( strpos( $content, 'kburns="magnetic"' ) !== false ) {
			$uncode_check_asset['magnetic'] = true; // This activates the magnetic cursor
			$gsap_required = true;
		}

		if ( strpos( $content, '[uncode_rotating_text' ) !== false ) {
			$uncode_check_asset['rotatingTxt'] = true; // This activates the rotating text
			$gsap_required = true;
		}

		if ( strpos( $content, ' skew="yes"' ) !== false ) {
			$uncode_check_asset['skewIt'] = true; // This activates the skew
			$gsap_required = true;
		}

		if ( strpos( $content, ' index_type="titles"' ) !== false ) {
			$uncode_check_asset['dropImage'] = true; // This activates the drop image
			$gsap_required = true;
		}

		if ( strpos( $content, ' css_animation="marquee' ) !== false || strpos( $content, ' css_alt_animation="marquee' ) !== false ) {
			$uncode_check_asset['textMarquee'] = true; // This activates the text marquee
			$gsap_required = true;
		}
	}

	return $gsap_required;
}
