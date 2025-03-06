<?php
/**
 * OnePage test
 */

function uncode_page_require_asset_onepage( $content_array ) {
	// We require OnePage.js also in pages that have a row with a data-name
	foreach ( $content_array as $content ) {
		if ( strpos( $content, 'row_name' ) !== false ) {
			$regex_attr = '/row_name=\"(.*?)\"/';
			preg_match_all( $regex_attr, $content, $matches, PREG_SET_ORDER );

			foreach ( $matches as $key => $value ) {
				if ( is_array( $value ) && isset( $value[1] ) && $value[1] ) {
					return true;
				}
			}
		}
	}

	return false;
}
