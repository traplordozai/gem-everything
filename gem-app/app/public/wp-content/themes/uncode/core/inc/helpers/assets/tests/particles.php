<?php
/**
 * Particles test
 */

function uncode_page_require_asset_particles( $content_array ) {
	if ( apply_filters( 'uncode_enqueue_particles', false ) ) {
		return true;
	}

	// Required by the Particles VC module
	foreach ( $content_array as $content ) {
		if ( strpos( $content, '[vc_particles_background' ) !== false ) {
			return true;
		}
	}

	return false;
}
