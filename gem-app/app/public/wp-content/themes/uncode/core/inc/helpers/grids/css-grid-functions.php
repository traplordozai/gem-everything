<?php
/**
 * CSS Grid related functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Calculate a 12 base width from the number of columns.
 */
function uncode_get_css_grid_columns_width( $columns ) {
	$width   = 3;
	$columns = absint( $columns );
	$columns = $columns ? $columns : 4;

	switch ( $columns ) {
		case 1:
			$width = 12;
			break;

		case 2:
			$width = 6;
			break;

		case 3:
			$width = 4;
			break;

		case 4:
			$width = 3;
			break;

		case 5:
			$width = 3;
			break;

		case 6:
			$width = 2;
			break;
	}

	return $width;
}
