<?php
/**
 * SVG support
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add support for SVG uploads
 */
function uncode_core_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'uncode_core_mime_types');

function uncode_core_fix_mime_type_svg( $data=null, $file=null, $filename=null, $mimes=null ) {
    $ext = isset( $data['ext'] ) ? $data['ext'] : '';

	if ( strlen( $ext ) < 1 ) {
		$ext = strtolower( end( explode( '.', $filename ) ) );
	}

	if ( $ext === 'svg' ) {
		$data['type'] = 'image/svg+xml';
		$data['ext']  = 'svg';
	}

	return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'uncode_core_fix_mime_type_svg', 75, 4 );
