<?php
/**
 * Isotope/Packery/Cells-By-Row test
 */

function uncode_page_require_asset_isotope( $content_array ) {
	global $uncode_post_data, $uncode_check_asset;


	$isotope = array(
		'isotope'      => false,
		'packery'      => false,
		'cells-by-row' => false,
	);

	if ( apply_filters( 'uncode_enqueue_isotope', false ) ) {
		$isotope = array(
			'isotope'      => true,
			'packery'      => true,
			'cells-by-row' => true,
		);

		return $isotope;
	}

	if ( uncode_post_data_is_singular() ) {
		$with_builder = false;
		if ( isset( $uncode_post_data['post_content'] ) && strpos( $uncode_post_data['post_content'], '[vc_row' ) !== false ) {
			$with_builder = true;
		}

		if ( ! $with_builder && isset( $uncode_post_data['post_type'] ) && isset( $uncode_post_data['ID'] ) ) {
			$generic_media_display = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_featured_media_display' );
			$media_display         = get_post_meta( $uncode_post_data['ID'], '_uncode_featured_media_display', true );

			if ( $media_display === '' ) {
				$media_display = $generic_media_display;
			}

			if ($media_display === 'isotope') {
				$uncode_check_asset['ilightbox'] = true; // This activates also the lightbox
				$isotope['isotope'] = true;
			}
		}
	} else if ( uncode_post_data_is_archive() || uncode_post_data_is_post_type_archive() ) {
		if ( isset( $uncode_post_data['post_type'] ) ) {
			$generic_body_content_block = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_index_content_block' );

			if ($generic_body_content_block === '') {
				$isotope['isotope'] = true;
			}
		}
	} else if ( uncode_post_data_is_home() ) {
		$content_id = ot_get_option( '_uncode_post_index_content_block' );

		if ( $content_id === '' ) {
			$isotope['isotope'] = true;
		}
	}

	foreach ( $content_array as $content ) {
		// For packery mode, we can just check the isotope_mode value
		if ( strpos( $content, 'isotope_mode="packery"' ) !== false ) {
			$isotope['isotope'] = true;
			$isotope['packery'] = true;
		}

		// For cellsByRow mode, we can just check the isotope_mode value
		if ( strpos( $content, 'isotope_mode="cellsByRow"' ) !== false ) {
			$isotope['isotope']      = true;
			$isotope['cells-by-row'] = true;
		}

		// Check uncode_index shortcodes. That's always an isotope
		// unless we have carousel has the index_type
		$regex = '/\[uncode_index(.*?)\]/';
		preg_match_all( $regex, $content, $uncode_indexes, PREG_SET_ORDER );

		foreach ( $uncode_indexes as $key => $uncode_index ) {
			if ( is_array( $uncode_index ) &&  isset( $uncode_index[0] ) ) {
				$has_isotope = false;

				if ( strpos( $uncode_index[0], ' index_type="' ) === false || strpos( $uncode_index[0], 'index_type="isotope"' ) !== false ) {
					$has_isotope = true;
				}

				if ( $has_isotope ) {
					$isotope['isotope'] = true;
					break;
				}
			}
		}

		// Check vc_gallery shortcodes
		$regex = '/\[vc_gallery(.*?)\]/';
		preg_match_all( $regex, $content, $vc_galleries, PREG_SET_ORDER );

		foreach ( $vc_galleries as $key => $vc_gallery ) {
			if ( is_array( $vc_gallery ) &&  isset( $vc_gallery[0] ) ) {
				$has_isotope = false;

				if ( strpos( $vc_gallery[0], ' type="' ) === false || strpos( $vc_gallery[0], ' type="isotope"' ) !== false ) {
					$has_isotope = true;
				}

				if ( strpos( $vc_gallery[0], ' type="justified"' ) ) {
					$uncode_check_asset['justified'] = true; // This is a justified gallery

					// Justified galleries with filters have isotope utils
					// Also when infinite is enabled
					if ( strpos( $vc_gallery[0], 'filtering="yes"' ) !== false || strpos( $vc_gallery[0], 'infinite="yes"' )!== false  ) {
						$has_isotope = true;
					}
				}

				if ( $has_isotope ) {
					$isotope['isotope'] = true;
				}
			}
		}
	}

	return $isotope;
}
