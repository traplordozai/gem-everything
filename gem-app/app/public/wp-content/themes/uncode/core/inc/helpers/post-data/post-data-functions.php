<?php
/**
 * Post Data related functions
 */

/**
 * Get the IDs of each content block attached to the page
 */
function uncode_get_post_data_content_block_ids() {
	global $uncode_post_data;

	$content_block_ids = array();

	// These are the keys inside $uncode_post_data
	// that hold a Content Block ID
	$content_block_keys = array(
		'header_cb_id',
		'content_cb_id',
		'footer_cb_id',
		'after_cb_id',
		'pre_cb_id',
		'navigation_cb_id',
		'no_results_cb_id',
		'header_no_results_cb_id',
	);

	foreach ( $uncode_post_data as $key => $value ) {
		if ( in_array( $key, $content_block_keys ) && $value > 0 ) {
			$content_block_ids[] = $value;
		}
	}

	$content_block_ids = array_unique( $content_block_ids );

	return $content_block_ids;
}

/**
 * Get an array that contains all the
 * raw content attached to the page
 */
function uncode_get_post_data_content_array() {
	global $uncode_post_data;

	if ( ! is_array( $uncode_post_data ) || ! isset( $uncode_post_data['post_content'] ) ) {
		return array();
	}

	$content_array = array(
		$uncode_post_data['post_content'],
	);

	$content_block_ids = uncode_get_post_data_content_block_ids();

	foreach ( $content_block_ids as $content_block_id ) {
		$content_block_id = apply_filters( 'wpml_object_id', $content_block_id, 'uncodeblock' );
		$content_array[]  = get_post_field( 'post_content', $content_block_id );
	}

	// Find content blocks in content
	$already_processed_ids = array();

	// Check quick view in products
	if ( class_exists( 'WooCommerce' ) ) {
		$products_archive_content_block = ot_get_option('_uncode_product_index_content_block');

		$is_shop_archive = ! $products_archive_content_block && ( is_shop() || is_product_category() || is_product_tag() ) ? true : false;

		if ( $is_shop_archive ) {
			$uncode_post_data['has_quick_view'] = true;
		}
	}

	foreach ( $content_array as $content ) {
		// Check content blocks in content
		if ( strpos( $content, '[uncode_block' ) !== false ) {
			$regex = '/\[uncode_block(.*?)\]/';
			$regex_attr = '/(.*?)=\"(.*?)\"/';
			preg_match_all( $regex, $content, $matches, PREG_SET_ORDER );

			foreach ( $matches as $key => $value ) {
				if (isset( $value[1] ) ) {
					preg_match_all( $regex_attr, trim( $value[ 1 ] ), $matches_attr, PREG_SET_ORDER );

					foreach ( $matches_attr as $key_attr => $value_attr ) {
						if ( 'id' === trim( $value_attr[1] ) ) {
							$cb_id = $value_attr[2];
							$cb_id = absint( apply_filters( 'wpml_object_id', $cb_id, 'uncodeblock' ) );

							if ( $cb_id > 0 && ! in_array( $cb_id, $already_processed_ids ) ) {
								$already_processed_ids[] = $cb_id;
								$content_array[] = get_post_field( 'post_content', $cb_id );
							}
						}
					}
				}
			}
		}

		// Check widgetized content blocks in post modules
		if ( strpos( $content, 'widgetized_content_block_id' ) !== false ) {
			$regex = '/widgetized_content_block_id=\"(\d+)\"/';
			preg_match_all( $regex, $content, $matches, PREG_SET_ORDER );

			foreach ( $matches as $key => $value ) {
				if (isset( $value[1] ) ) {
					$cb_id = trim( $value[1] );
					$cb_id = absint( apply_filters( 'wpml_object_id', $cb_id, 'uncodeblock' ) );
					if ( $cb_id > 0 && ! in_array( $cb_id, $already_processed_ids ) ) {
						$already_processed_ids[] = $cb_id;
						$content_array[] = get_post_field( 'post_content', $cb_id );
					}
				}
			}
		}

		// Check ajax filters content blocks in post modules
		if ( strpos( $content, 'ajax_filters_content_block_id' ) !== false ) {
			$regex = '/ajax_filters_content_block_id=\"(\d+)\"/';
			preg_match_all( $regex, $content, $matches, PREG_SET_ORDER );

			foreach ( $matches as $key => $value ) {
				if (isset( $value[1] ) ) {
					$cb_id = trim( $value[1] );
					$cb_id = absint( apply_filters( 'wpml_object_id', $cb_id, 'uncodeblock' ) );
					if ( $cb_id > 0 && ! in_array( $cb_id, $already_processed_ids ) ) {
						$already_processed_ids[] = $cb_id;
						$content_array[] = get_post_field( 'post_content', $cb_id );
					}
				}
			}
		}

		// Check custom grids content blocks in post modules
		if ( strpos( $content, 'custom_grid_content_block_id' ) !== false ) {
			$regex = '/custom_grid_content_block_id=\"(\d+)\"/';
			preg_match_all( $regex, $content, $matches, PREG_SET_ORDER );

			foreach ( $matches as $key => $value ) {
				if (isset( $value[1] ) ) {
					$cb_id = trim( $value[1] );
					$cb_id = absint( apply_filters( 'wpml_object_id', $cb_id, 'uncodeblock' ) );
					if ( $cb_id > 0 && ! in_array( $cb_id, $already_processed_ids ) ) {
						$already_processed_ids[] = $cb_id;
						$content_array[] = get_post_field( 'post_content', $cb_id );
					}
				}
			}
		}

		// Check quick view content blocks in post modules
		if ( class_exists( 'WooCommerce' ) && ! $uncode_post_data['has_quick_view'] ) {
			if ( strpos( $content, 'product_items' ) !== false || strpos( $content, 'product_table_items' ) !== false ) {
				$regex = '/[product_items|product_table_items]=\"(.*?)\"/';
				preg_match_all( $regex, $content, $product_items_values, PREG_SET_ORDER );

				if ( is_array( $product_items_values ) ) {
					foreach ( $product_items_values as $key => $product_items_value ) {
						if ( is_array( $product_items_value ) && isset( $product_items_value[1] ) ) {
							if ( strpos( $product_items_value[1], 'quick-view-button' ) !== false ) {
								// Get content block ID (if any)
								$uncode_post_data['has_quick_view'] = true;
							}
						}
					}
				}
			}
		}
	}

	// Quick View CB ID (if any)
	if ( class_exists( 'WooCommerce' ) && $uncode_post_data['has_quick_view'] ) {
		$quick_view_content_type = ot_get_option( '_uncode_product_index_quick_view_type' );

		if ( $quick_view_content_type === 'uncodeblock' ) {
			$quick_view_content_block_id = ot_get_option( '_uncode_product_index_quick_view_content_block' );

			$quick_view_content_block_id = absint( apply_filters( 'wpml_object_id', $quick_view_content_block_id, 'uncodeblock' ) );
			if ( $quick_view_content_block_id > 0 && ! in_array( $quick_view_content_block_id, $already_processed_ids ) ) {
				$already_processed_ids[] = $quick_view_content_block_id;
				$content_array[] = get_post_field( 'post_content', $quick_view_content_block_id );
			}
		}
	}

	return ( apply_filters( 'uncode_get_post_data_content_array', $content_array ) );
}
