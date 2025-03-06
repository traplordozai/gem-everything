<?php
/**
 * Ajax Filters cache functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Check if transients for ajax filters are enabled
 */
function uncode_ajax_filters_cache_enabled() {
	$enabled = ot_get_option( '_uncode_enable_ajax_filters_transients' ) === 'on' ? true : false;
	return $enabled;
}

/**
 * Get transients lifespan
 */
function uncode_ajax_filters_get_transient_lifespan() {
	$lifespan = ot_get_option( '_uncode_ajax_filters_transients_lifespan' ) ? true : false;

	switch ( $lifespan ) {
		case 'day':
			$seconds = DAY_IN_SECONDS;
			break;

		case 'week':
			$seconds = 7 * DAY_IN_SECONDS;
			break;

		case 'month':
		default:
			$seconds = 30 * DAY_IN_SECONDS;
			break;
	}

	return apply_filters( 'uncode_ajax_filters_transients_lifespan_in_seconds', $seconds );
}

/**
 * Delete transients related to a specific post ID
 */
function uncode_ajax_filters_delete_post_cache( $post_ids ) {
	if ( $post_ids && ! is_array( $post_ids ) ) {
		$post_ids = array( $post_ids );
	}

	$post_objects_data = get_transient( 'uncode_ajax_filters_post_objects_data' );
	$all_posts_data    = get_transient( 'uncode_ajax_filters_all_posts' );

	$post_objects_data_needs_update = false;
	$all_posts_data_needs_update    = false;

	if ( is_array( $post_ids ) && ( is_array( $post_objects_data ) || is_array( $all_posts_data ) ) ) {
		foreach ( $post_ids as $post_id ) {
			$post_type = get_post_type( $post_id );

			if ( isset( $post_objects_data[$post_id] ) ) {
				unset( $post_objects_data[$post_id] );
				$post_objects_data_needs_update = true;
			}

			if ( isset( $all_posts_data[$post_type] ) ) {
				unset( $all_posts_data[$post_type] );
				$all_posts_data_needs_update = true;
			}
		}
	}

	if ( $post_objects_data_needs_update ) {
		set_transient( 'uncode_ajax_filters_post_objects_data', $post_objects_data, uncode_ajax_filters_get_transient_lifespan() );
	}

	if ( $all_posts_data_needs_update ) {
		set_transient( 'uncode_ajax_filters_all_posts', $all_posts_data, uncode_ajax_filters_get_transient_lifespan() );
	}

	delete_transient( 'uncode_ajax_filters_queries' );
}

/**
 * Delete all transients
 */
function uncode_ajax_filters_delete_all_cache() {
	delete_transient( 'uncode_ajax_filters_post_objects_data' );
	delete_transient( 'uncode_ajax_filters_all_posts' );
	delete_transient( 'uncode_ajax_filters_queries' );
}

/**
 * Check if we need to clear transients after post update
 */
function uncode_ajax_filters_clear_cache_after_post_update() {
	if ( ot_get_option( '_uncode_enable_ajax_filters_clear_after_post_update' ) === 'on' ) {
		return true;
	}

	return false;
}

/**
 * Check if we need to clear transients after order
 */
function uncode_ajax_filters_clear_cache_after_order() {
	if ( ot_get_option( '_uncode_enable_ajax_filters_clear_after_order' ) === 'on' ) {
		return true;
	}

	return false;
}

/**
 * Check if we need to clear transients after review
 */
function uncode_ajax_filters_clear_cache_after_review() {
	if ( ot_get_option( '_uncode_enable_ajax_filters_clear_after_review' ) === 'on' ) {
		return true;
	}

	return false;
}

/**
 * Delete transients after delete post
 */
function uncode_ajax_filters_clear_transient_after_delete_post_hook( $post_id ) {
	if ( ! uncode_ajax_filters_cache_enabled() || ! uncode_ajax_filters_clear_cache_after_post_update() ) {
		return;
	}

	if ( ! $post_id ) {
		return;
	}

	uncode_ajax_filters_delete_post_cache( $post_id );
}
add_action( 'delete_post', 'uncode_ajax_filters_clear_transient_after_delete_post_hook' );

/**
 * Delete transients after trash post
 */
function uncode_ajax_filters_clear_transient_after_trash_post_hook( $post_id ) {
	if ( ! uncode_ajax_filters_cache_enabled() || ! uncode_ajax_filters_clear_cache_after_post_update() ) {
		return;
	}

	if ( ! $post_id ) {
		return;
	}

	uncode_ajax_filters_delete_post_cache( $post_id );
}
add_action( 'wp_trash_post', 'uncode_ajax_filters_clear_transient_after_trash_post_hook' );

/**
 * Delete transients after untrash post
 */
function uncode_ajax_filters_clear_transient_after_untrash_post_hook( $post_id ) {
	if ( ! uncode_ajax_filters_cache_enabled() || ! uncode_ajax_filters_clear_cache_after_post_update() ) {
		return;
	}

	if ( ! $post_id ) {
		return;
	}

	uncode_ajax_filters_delete_post_cache( $post_id );
}
add_action( 'untrashed_post', 'uncode_ajax_filters_clear_transient_after_untrash_post_hook' );

/**
 * Delete transients after post terms change
 */
function uncode_ajax_filters_clear_transient_after_object_terms_hook( $post_id ) {
	if ( ! uncode_ajax_filters_cache_enabled() || ! uncode_ajax_filters_clear_cache_after_post_update() ) {
		return;
	}

	if ( ! $post_id ) {
		return;
	}

	uncode_ajax_filters_delete_post_cache( $post_id );
}
add_action( 'set_object_terms', 'uncode_ajax_filters_clear_transient_after_object_terms_hook' );

/**
 * Delete transients after taxonomy term is deleted
 */
function uncode_ajax_filters_clear_transient_after_delete_term_hook( $term, $taxonomy ) {
	if ( ! uncode_ajax_filters_cache_enabled() || ! uncode_ajax_filters_clear_cache_after_post_update() ) {
		return;
	}

	$args = array(
		'post_type' => 'any',
		'fields'    => 'ids',
		'tax_query' => array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => $term,
			),
		),
	);

	$query    = new WP_Query( $args );
	$post_ids = $query->have_posts() ? $query->posts : array();

	uncode_ajax_filters_delete_post_cache( $post_ids );
}
add_action( 'pre_delete_term', 'uncode_ajax_filters_clear_transient_after_delete_term_hook', 10, 2 );

/**
 * Delete transients after post status changes
 */
function uncode_ajax_filters_clear_transient_after_post_status_hook( $new_status, $old_status, $post ) {
	if ( ! uncode_ajax_filters_cache_enabled() || ! uncode_ajax_filters_clear_cache_after_post_update() ) {
		return;
	}

	if ( ( 'publish' === $new_status || 'publish' === $old_status ) && $post->ID ) {
		uncode_ajax_filters_delete_post_cache( $post->ID );
	}
}
add_action( 'transition_post_status', 'uncode_ajax_filters_clear_transient_after_post_status_hook', 10, 3 );

/**
 * Delete transients after product review
 */
function uncode_ajax_filters_clear_transient_after_review_hook( $comment_id ) {
	if ( ! uncode_ajax_filters_cache_enabled() || ! uncode_ajax_filters_clear_cache_after_review() ) {
		return;
	}

	if ( isset( $_POST['rating'], $_POST['comment_post_ID'] ) && 'product' === get_post_type( absint( $_POST['comment_post_ID'] ) ) ) {
		if ( ! $_POST['rating'] || $_POST['rating'] > 5 || $_POST['rating'] < 0 ) {
			return;
		}

		$post_id = isset( $_POST['comment_post_ID'] ) ? absint( $_POST['comment_post_ID'] ) : 0;

		uncode_ajax_filters_delete_post_cache( $post_id );
	}
}
add_action( 'comment_post', 'uncode_ajax_filters_clear_transient_after_review_hook' );

/**
 * Delete transients after order is created
 */
function uncode_ajax_filters_clear_transient_after_new_order_hook( $order ) {
	if ( ! uncode_ajax_filters_cache_enabled() || ! uncode_ajax_filters_clear_cache_after_order() ) {
		return;
	}

	$product_ids = array();

	foreach( $order->get_items() as $item_id => $item ){
    	$product_ids[] = $item->get_product_id();
	}

	uncode_ajax_filters_delete_post_cache( $product_ids );
}
add_action( 'woocommerce_checkout_order_created', 'uncode_ajax_filters_clear_transient_after_new_order_hook' );

/**
 * Show delete transients button in Theme Options
 */
function uncode_ajax_filters_show_delete_transients_button( $field_id ) {
	if ( $field_id === '_uncode_enable_ajax_filters_transients' ) {
		echo '<div class="clear-ajax-filters-transients-help" style="display:none;"><span class="clear-ajax-filters-transients-help__text">' . esc_html__( 'Click this button to manually delete all transients related to the Ajax Filters.', 'uncode' ) . '</span><button class="option-tree-ui-button button clear-ajax-filters-transients-help__button" data-deleting="' . esc_html__( 'Deleting transients…', 'uncode' ) . '" data-original="' . esc_html__( 'Delete all transients', 'uncode' ) . '">' . esc_html__( 'Delete all transients', 'uncode' ) . '</button></div>';
	}
}
add_action( 'ot_after_type_on_off',  'uncode_ajax_filters_show_delete_transients_button' );

/**
 * Delete transients via AJAX
 */
function uncode_ajax_filters_delete_transients_via_ajax( $field_id ) {
	if ( isset( $_POST[ 'delete_ajax_filters_transients_nonce' ] ) && wp_verify_nonce( $_POST[ 'delete_ajax_filters_transients_nonce' ], 'uncode-delete-ajax-filters-transients-nonce' ) ) {
		uncode_ajax_filters_delete_all_cache();
		wp_send_json_success();
	}

	// Invalid nonce or data
	wp_send_json_error();
}
add_action( 'wp_ajax_uncode_delete_ajax_filters_transients', 'uncode_ajax_filters_delete_transients_via_ajax' );

/**
 * Get post terms from cache
 */
function uncode_ajax_filters_get_post_terms_from_cache( $post_objects_data, $post_id, $tax_to_query, $tax_source = '' ) {
	$post_terms = array();

	// Valid cache found
	if ( is_array( $post_objects_data ) && isset( $post_objects_data[ $post_id ] ) && isset( $post_objects_data[ $post_id ]['terms'] ) && isset( $post_objects_data[ $post_id ]['terms'][ $tax_to_query ] ) ) {
		return array(
			'from_cache' => true,
			'data'       => $post_objects_data
		);
	}

	$post_terms = get_the_terms( $post_id, $tax_to_query );

	if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
		$post_terms_with_index = array();

		foreach ( $post_terms as $post_term ) {
			$post_terms_with_index[$post_term->term_id] = $post_term;
		}

		// Add missing parent terms
		$post_terms = uncode_add_missing_parent_terms( $post_terms_with_index );

		foreach ( $post_terms as $post_term ) {
			$add_to_count = false;

			if ( class_exists( 'WooCommerce' ) && $tax_source === 'product_att' && apply_filters( 'uncode_use_woocommerce_nav_attributes_query', false ) && get_option( 'woocommerce_attribute_lookup_enabled' ) === 'yes' && 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
				global $wpdb;

				$lookup_table_name = $wpdb->prefix . 'wc_product_attributes_lookup';

				$results_query = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $lookup_table_name WHERE product_or_parent_id = %d AND term_id = %d AND in_stock = 1", $post_id, $post_term->term_id ), ARRAY_A );

				if ( is_array( $results_query ) && count( $results_query ) > 0 ) {
					$add_to_count = true;
				}
			} else {
				$add_to_count = true;
			}

			if ( ! $add_to_count ) {
				unset( $post_terms[ $post_term ] );
			}
		}
	}

	$post_objects_data = is_array( $post_objects_data ) ? $post_objects_data : array();

	if ( ! isset( $post_objects_data[ $post_id ] ) ) {
		$post_objects_data[ $post_id ] = array();
	}

	if ( ! isset( $post_objects_data[ $post_id ]['terms'] ) ) {
		$post_objects_data[ $post_id ]['terms'] = array();
	}

	$post_terms = is_array( $post_terms ) ? $post_terms : array();

	$post_objects_data[ $post_id ]['terms'][ $tax_to_query ] = $post_terms;

	return array(
		'from_cache' => false,
		'data'       => $post_objects_data
	);
}

/**
 * Get product data from cache
 */
function uncode_ajax_filters_get_product_data_from_cache( $post_objects_data, $post_id, $keys = array() ) {
	// Valid cache found
	if ( is_array( $post_objects_data ) && isset( $post_objects_data[ $post_id ] ) && isset( $post_objects_data[ $post_id ]['product_data'] ) && isset( $post_objects_data[ $post_id ]['product_data']['type'] ) ) {
		$has_keys = true;

		foreach	( $keys as $key ) {
			if ( ! isset( $post_objects_data[ $post_id ]['product_data'][$key] ) ) {
				$has_keys = false;
				break;
			}
		}

		if ( $has_keys ) {
			return array(
				'from_cache' => true,
				'data'       => $post_objects_data
			);
		}
	}

	$product = wc_get_product( $post_id );

	$post_objects_data = is_array( $post_objects_data ) ? $post_objects_data : array();

	if ( ! isset( $post_objects_data[ $post_id ] ) ) {
		$post_objects_data[ $post_id ] = array();
	}

	if ( is_a( $product, 'WC_Product' ) ) {
		if ( ! isset( $post_objects_data[ $post_id ]['product_data'] ) ) {
			$post_objects_data[ $post_id ]['product_data'] = array();
		}

		$post_objects_data[ $post_id ]['product_data']['type'] = $product->get_type();

		if ( in_array( 'on_sale', $keys ) ) {
			$post_objects_data[ $post_id ]['product_data']['on_sale'] = $product->is_on_sale();
		}

		if ( in_array( 'instock', $keys ) ) {
			$post_objects_data[ $post_id ]['product_data']['instock'] = $product->is_in_stock();
		}

		if ( in_array( 'price', $keys ) ) {
			$post_objects_data[ $post_id ]['product_data']['price'] = floatval( $product->get_price() );

			if ( $product->get_type() === 'variable' ) {
				$post_objects_data[ $post_id ]['product_data']['min_price'] = floatval( $product->get_variation_price( 'min', true ) );
				$post_objects_data[ $post_id ]['product_data']['max_price'] = floatval( $product->get_variation_price( 'max', true ) );
			}
		}

		if ( in_array( 'rating', $keys ) ) {
			$post_objects_data[ $post_id ]['product_data']['rating'] = round( $product->get_average_rating() );
		}
	} else {
		return array(
			'from_cache' => true,
			'data'       => $post_objects_data
		);
	}

	return array(
		'from_cache' => false,
		'data'       => $post_objects_data
	);
}

/**
 * Get author data from cache
 */
function uncode_ajax_filters_get_author_data_from_cache( $post_objects_data, $post_id ) {
	// Valid cache found
	if ( is_array( $post_objects_data ) && isset( $post_objects_data[ $post_id ] ) && isset( $post_objects_data[ $post_id ]['author_data'] ) ) {
		if ( isset( $post_objects_data[ $post_id ]['author_data']['author_id'] ) && isset( $post_objects_data[ $post_id ]['author_data']['author_name'] ) ) {
			return array(
				'from_cache' => true,
				'data'       => $post_objects_data
			);
		}
	}

	$post_objects_data = is_array( $post_objects_data ) ? $post_objects_data : array();

	if ( ! isset( $post_objects_data[ $post_id ] ) ) {
		$post_objects_data[ $post_id ] = array();
	}

	if ( ! isset( $post_objects_data[ $post_id ]['author_data'] ) ) {
		$post_objects_data[ $post_id ]['author_data'] = array();
	}

	$post_objects_data[ $post_id ]['author_data']['author_id']   = get_post_field( 'post_author', $post_id );
	$post_objects_data[ $post_id ]['author_data']['author_name'] = get_the_author_meta( 'display_name' );

	return array(
		'from_cache' => false,
		'data'       => $post_objects_data
	);
}

/**
 * Get date data from cache
 */
function uncode_ajax_filters_get_date_data_from_cache( $post_objects_data, $post_id, $date_format ) {
	// Valid cache found
	if ( is_array( $post_objects_data ) && isset( $post_objects_data[ $post_id ] ) && isset( $post_objects_data[ $post_id ]['date_data'] ) ) {
		if ( isset( $post_objects_data[ $post_id ]['date_data']['date'] ) && isset( $post_objects_data[ $post_id ]['date_data']['timestamp'] ) ) {
			return array(
				'from_cache' => true,
				'data'       => $post_objects_data
			);
		}
	}

	$post_objects_data = is_array( $post_objects_data ) ? $post_objects_data : array();

	if ( ! isset( $post_objects_data[ $post_id ] ) ) {
		$post_objects_data[ $post_id ] = array();
	}

	if ( ! isset( $post_objects_data[ $post_id ]['date_data'] ) ) {
		$post_objects_data[ $post_id ]['date_data'] = array();
	}

	$post_objects_data[ $post_id ]['date_data']['date']      = get_the_date( $date_format, $post_id );
	$post_objects_data[ $post_id ]['date_data']['timestamp'] = get_the_time( 'U', $post_id);

	return array(
		'from_cache' => false,
		'data'       => $post_objects_data
	);
}
