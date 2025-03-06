<?php
/**
 * Custom Grid related functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Build the shortcode for the custom grid.
 */
function uncode_get_custom_grid_output( $custom_matrix_objects, $content_block_id ) {
	$nothing_found_text = esc_html__( 'Nothing found.', 'uncode' );

	if ( absint( $content_block_id ) > 0 && count( $custom_matrix_objects ) > 0 ) {
		$grid_output           = '';
		$content_block_id      = apply_filters( 'wpml_object_id', $content_block_id, 'uncodeblock', true );
		$content_block_content = get_post_field( 'post_content', $content_block_id );
		$has_placeholder       = strpos( $content_block_content, '[uncode_module_placeholder]') !== false;

		if ( ! $has_placeholder ) {
			if ( current_user_can( 'edit_posts' ) ) {
				$nothing_found_text .= ' ' . esc_html__( 'Please add at least one \'Placeholder\' to your design.', 'uncode' );
			}
		}

		if ( $content_block_content && strpos( $content_block_content, '[vc_row') !== false && $has_placeholder ) {
			$matrix = uncode_get_custom_grid_matrix( $content_block_content );

			if ( is_array( $custom_matrix_objects ) ) {
				$needed_rows = uncode_get_custom_grid_needed_rows( $matrix, $custom_matrix_objects );

				foreach ( $needed_rows as $row ) {
					$grid_output .= str_replace( '[uncode_module_placeholder]', '', $row );
				}

				return $grid_output;
			}
		}
	}

	return '[vc_row_inner][vc_column_inner]<div class="tmb tmb-iso-w12 tmb-iso-h1"><p class="t-entry-title">' . $nothing_found_text . '</p></div>[/vc_column_inner][/vc_row_inner]';
}

/**
 * Get custom grid matrix.
 */
function uncode_get_custom_grid_matrix( $content_block_content ) {
	WPBMap::addAllMappedShortcodes();

	$rows       = array();
	$inner_rows = array();
	$pos        = 0;


	// Remove main row and column
	$regex = '/\[vc_row (.*?)\]/m';
	$content_block_content = preg_replace( $regex, '', $content_block_content, 1 );
	$regex = '/\[vc_column (.*?)\]/m';
	$content_block_content = preg_replace( $regex, '', $content_block_content, 1 );
	$content_block_content = str_replace( '[vc_row]', '', $content_block_content );
	$content_block_content = str_replace( '[vc_column]', '', $content_block_content );
	$content_block_content = str_replace( '[/vc_column][/vc_row]', '', $content_block_content );

	// Find all inner rows
	$regex = '/\[vc_row_inner(.*?)\/vc_row_inner\](.*?)/m';
	preg_match_all( $regex, $content_block_content, $matches, PREG_SET_ORDER|PREG_OFFSET_CAPTURE, 0 );

	$last_row_end = 0;

	if ( count( $matches ) ) {
		foreach ( $matches as $key => $value ) {
			if ( is_array( $value ) && isset( $value[0] ) && isset( $value[2] ) ) {
				$begin = $value[0];
				$end   = $value[2];

				if ( is_array( $begin ) && isset( $begin[0] ) && isset( $begin[1] ) ) {
					$inner_row = $begin[0];
					$pos_start = $begin[1];
				}

				if ( is_array( $end ) && isset( $end[1] ) ) {
					$pos_end = $end[1];
				}

				if ( $inner_row && $pos_end ) {
					$last_row_end = $pos_end;

					$rows[] = array(
						'row'   => $inner_row,
						'start' => $pos_start,
						'end'   => $pos_end,
					);
				}
			}
		}
	}

	$prev_end = 0;

	foreach ( $rows as $row ) {
		$current_start = $row['start'];

		if ( $current_start > $prev_end ) {
			$custom_row_start = $prev_end;
			$custom_row       = substr( $content_block_content, $prev_end, $current_start - $prev_end );

			preg_match_all( '/' . get_shortcode_regex() . '/', trim( $custom_row ), $custom_shortcode_found );

			if ( is_array( $custom_shortcode_found ) && isset( $custom_shortcode_found[0] ) ) {
				$custom_shortcode_rows = $custom_shortcode_found[0];

				if ( is_array( $custom_shortcode_rows ) ) {
					foreach ( $custom_shortcode_rows as $key => $custom_shortcode_row) {
						$custom_row_end = $custom_row_start + strlen( $custom_shortcode_row );

						$rows[] = array(
							'row'   => $custom_shortcode_row,
							'start' => $custom_row_start,
							'end'   => $custom_row_end,
						);

						$custom_row_start = $custom_row_end;
					}
				}
			}

			$prev_end = $current_start;
		}

		if ( $current_start === $prev_end ) {
			$prev_end = $row['end'];
		}
	}

	$last_orphan_content = substr( $content_block_content, $last_row_end, strlen( $content_block_content ) );

	if ( $last_orphan_content ) {
		$custom_row_start = $last_row_end;
		preg_match_all( '/' . get_shortcode_regex() . '/', trim( $last_orphan_content ), $custom_shortcode_found );

		if ( is_array( $custom_shortcode_found ) && isset( $custom_shortcode_found[0] ) ) {
			$custom_shortcode_rows = $custom_shortcode_found[0];

			if ( is_array( $custom_shortcode_rows ) ) {
				foreach ( $custom_shortcode_rows as $key => $custom_shortcode_row) {
					$custom_row_end = $custom_row_start + strlen( $custom_shortcode_row );

					$rows[] = array(
						'row'   => $custom_shortcode_row,
						'start' => $custom_row_start,
						'end'   => $custom_row_end,
					);

					$custom_row_start = $custom_row_end;
				}
			}
		}
	}

	usort( $rows, function( $a, $b ) {
		return $a['start'] - $b['start'];
	});

	$rows = uncode_custom_grid_count_placeholders( $rows );

	return $rows;
}

/**
 * Count placeholders in a row.
 */
function uncode_custom_grid_count_placeholders( $rows ) {
	foreach ( $rows as $row_key => $row ) {
		$rows[$row_key]['count'] = substr_count( $row['row'], '[uncode_module_placeholder]' );
	}

	return $rows;
}

/**
 * Get needed rows from matrix.
 */
function uncode_get_custom_grid_needed_rows( $matrix, $matrix_objects ) {
	$needed_rows       = array();
	$original_matrix   = $matrix;
	$current_row_index = 0;
	$current_row       = $matrix[$current_row_index];
	$processed_in_row  = 0;

	while ( count( $matrix_objects ) > 0 ) {
		$current_row = $matrix[$current_row_index];

		if ( $current_row['count'] === 0 ) {
			$needed_rows[] = $current_row['row'];

			$current_row_index++;
			if ( $current_row_index >= count( $matrix ) ) {
				$current_row_index = 0;
				$matrix            = $original_matrix;
			}

			continue;
		}

		if ( $current_row['count'] > $processed_in_row ) {
			$matrix[$current_row_index]['row'] = uncode_custom_grid_replace_placeholder( $current_row['row'], $matrix_objects[0] );
			$processed_in_row++;
			unset( $matrix_objects[0] );
			$matrix_objects = array_values( $matrix_objects );
		}

		if ( $current_row['count'] === $processed_in_row || count( $matrix_objects ) === 0 ) {
			$needed_rows[]    = $matrix[$current_row_index]['row'];
			$processed_in_row = 0;

			$current_row_index++;
			if ( $current_row_index >= count( $matrix ) ) {
				$current_row_index = 0;
				$matrix            = $original_matrix;
			}
		}
	}

	return $needed_rows;
}

/**
 * Replace the first found placeholder in a row with the thumb element.
 */
function uncode_custom_grid_replace_placeholder( $current_row_markup, $thumb_data ) {
	$pos          = strpos( $current_row_markup, '[uncode_module_placeholder]' );
	$column_width = '';

	$regex = '/\[vc_column_inner(.*?)\]/';

	if ( strpos( $current_row_markup, '[vc_column_inner' ) !== false ) {
		$regex = '/\[vc_column_inner(.*?)\](.*?)\[\/vc_column_inner]/';
		preg_match_all( $regex, $current_row_markup, $matches, PREG_SET_ORDER );

		if ( count( $matches ) ) {
			$reversed_matches = array_reverse( $matches );

			foreach ( $reversed_matches as $key => $value ) {
				if ( isset( $value[0] ) && isset( $value[1] ) && isset( $value[2] ) && $value[2] === '[uncode_module_placeholder]' ) {
					$regex_attr = '/(.*?)=\"(.*?)\"/';
					preg_match_all( $regex_attr, trim( $value[1] ), $matches_attr, PREG_SET_ORDER );
					foreach ( $matches_attr as $key_attr => $value_attr ) {
						if ( isset( $value_attr[1] ) && trim( $value_attr[1] ) === 'width' ) {
							$column_width = $value_attr[2];
						}
					}

					break;
				}
			}
		}
	}

	if ( ! $column_width ) {
		$column_width = '1/1';
	}

	$width_array = explode( '/', $column_width );
	$width_media = ( (int) trim( $width_array[0] ) / trim( $width_array[1] ) ) * 12;

	$thumb_data['block_data']['template'] = 'custom-grid-functions.php';
	$thumb_data['block_data']['single_width'] = $width_media;

	foreach ( $thumb_data['block_data']['classes'] as $key => $class ) {
		if ( strpos( $class, 'tmb-iso-w' ) !== false ) {
			$thumb_data['block_data']['classes'][$key] = 'tmb-iso-w' . $width_media;
			break;
		}
	}

	$thumb_html = uncode_create_single_block( $thumb_data['block_data'], $thumb_data['id'], $thumb_data['style_preset'], $thumb_data['layout'], $thumb_data['lightbox_classes'], $thumb_data['carousel_textual'], $thumb_data['with_html'] );

	if ( $pos !== false ) {
		$current_row_markup = substr_replace( $current_row_markup, $thumb_html, $pos, strlen( '[uncode_module_placeholder]' ) );
	}

	return $current_row_markup;
}
