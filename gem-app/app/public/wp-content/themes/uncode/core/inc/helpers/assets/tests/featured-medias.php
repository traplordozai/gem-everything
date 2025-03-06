<?php
/**
 * Featured Medias in single pages test
 */

function uncode_page_require_asset_featured_medias( $content_array ) {
	global $uncode_post_data, $uncode_check_asset;

	if ( uncode_post_data_is_singular() ) {
		$with_builder = false;
		if ( isset( $uncode_post_data['post_content'] ) && strpos( $uncode_post_data['post_content'], '[vc_row' ) !== false ) {
			$with_builder = true;
		}

		if ( ! $with_builder && isset( $uncode_post_data['post_type'] ) && isset( $uncode_post_data['ID'] ) ) {
			$media_visible = get_post_meta( $uncode_post_data['ID'], '_uncode_specific_media', true );

			if ( $media_visible === '' ) {
				$generic_media_visible = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_media' );
				$media_visible = $generic_media_visible;
			}

			if ( $media_visible !== 'off' ) {
				$generic_media_display = ot_get_option( '_uncode_' . $uncode_post_data['post_type'] . '_featured_media_display' );
				$media_display         = get_post_meta( $uncode_post_data['ID'], '_uncode_featured_media_display', true );

				if ( $media_display === '' ) {
					$media_display = $generic_media_display;
				}

				if ($media_display === 'carousel') {
					$uncode_check_asset['ilightbox'] = true; // This activates also the lightbox
					$uncode_check_asset['carousel'] = true; // This activates also the carousel
				}

				$media_ids     = get_post_meta( $uncode_post_data['ID'], '_uncode_featured_media', true );
				$media_ids_arr = explode( ',', $media_ids );

				if ( is_array( $media_ids_arr ) && ! empty( $media_ids_arr ) ) {
					foreach ( $media_ids_arr as $media_id ) {
						$media_id_info = uncode_get_media_info( $media_id );

						if ( isset( $media_id_info->post_mime_type ) && strpos( $media_id_info->post_mime_type, 'video/' ) !== false ) {
							$uncode_check_asset['mediaelement'] = true;
						}

						if ( isset( $media_id_info->post_mime_type ) && strpos( $media_id_info->post_mime_type, 'audio/' ) !== false ) {
							$uncode_check_asset['mediaelement'] = true;
						}
					}
				}
			}
		}
	}

	return false;
}
