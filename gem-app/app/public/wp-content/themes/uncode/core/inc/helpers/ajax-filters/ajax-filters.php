<?php
/**
 * Ajax Filters related functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! defined( 'UNCODE_FILTER_PREFIX' ) ) {
	define( 'UNCODE_FILTER_PREFIX', 'unfilter' );
}

if ( ! defined( 'UNCODE_FILTER_PREFIX_TAX' ) ) {
	define( 'UNCODE_FILTER_PREFIX_TAX', 'tax_' );
}

if ( ! defined( 'UNCODE_FILTER_PREFIX_PA' ) ) {
	define( 'UNCODE_FILTER_PREFIX_PA', 'filter_' );
}

if ( ! defined( 'UNCODE_FILTER_KEY_STATUS' ) ) {
	define( 'UNCODE_FILTER_KEY_STATUS', 'status' );
}

if ( ! defined( 'UNCODE_FILTER_KEY_RATING' ) ) {
	define( 'UNCODE_FILTER_KEY_RATING', 'rating' );
}

if ( ! defined( 'UNCODE_FILTER_KEY_SEARCH' ) ) {
	define( 'UNCODE_FILTER_KEY_SEARCH', 'key' );
}

if ( ! defined( 'UNCODE_FILTER_KEY_SORTING' ) ) {
	define( 'UNCODE_FILTER_KEY_SORTING', 'orderby' );
}

if ( ! defined( 'UNCODE_FILTER_KEY_AUTHOR' ) ) {
	define( 'UNCODE_FILTER_KEY_AUTHOR', 'author_' );
}

if ( ! defined( 'UNCODE_FILTER_KEY_DATE' ) ) {
	define( 'UNCODE_FILTER_KEY_DATE', 'date' );
}

if ( ! defined( 'UNCODE_FILTER_PREFIX_RELATION' ) ) {
	define( 'UNCODE_FILTER_PREFIX_RELATION', 'query_type_' );
}

if ( ! defined( 'UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX' ) ) {
	define( 'UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX', UNCODE_FILTER_PREFIX_RELATION . UNCODE_FILTER_PREFIX_TAX );
}

if ( ! defined( 'UNCODE_FILTER_PREFIX_QUERY_TYPE_PA' ) ) {
	define( 'UNCODE_FILTER_PREFIX_QUERY_TYPE_PA', UNCODE_FILTER_PREFIX_RELATION . UNCODE_FILTER_PREFIX_PA );
}

if ( ! defined( 'UNCODE_FILTER_PREFIX_QUERY_TYPE_STATUS' ) ) {
	define( 'UNCODE_FILTER_PREFIX_QUERY_TYPE_STATUS', UNCODE_FILTER_PREFIX_RELATION . UNCODE_FILTER_KEY_STATUS );
}

/**
 * Function that manually calls the Posts Module shortcode
 * so that the query is populated before calling Ajax Filter modules
 */
function uncode_check_for_row_with_custom_ajax_filters( $content ) {
	if ( strpos( $content, '[uncode_index' ) !== false ) {
		$regex = '/\[uncode_index(.*?)\](.*?)/';
		$regex_attr = '/(.*?)=\"(.*?)\"/';
		preg_match_all( $regex, $content, $matches, PREG_SET_ORDER );
		if ( is_array( $matches ) ) {
			$first_match = $matches[0];

			if ( is_array( $first_match ) ) {
				$post_module_shortcode = $first_match[0];

				if ( $post_module_shortcode ) {
					global $has_ajax_filters;

					$has_ajax_filters = true;

					preg_match_all( $regex_attr, trim( $post_module_shortcode ), $matches_attr, PREG_SET_ORDER );
					foreach ( $matches_attr as $key_attr => $value_attr ) {
						if ( trim( $value_attr[1] ) === 'loop' ) {
							$loop_string = trim( $value_attr[0] );
							$loop = $value_attr[2];
							$loop_parse = uncode_parse_loop_data( $loop );
							$loop_parse['size'] = 'All';
							$loop_string_new = 'loop="' . uncode_unparse_loop_data( $loop_parse ) . '"';

							$post_module_shortcode = str_replace( $loop_string, $loop_string_new, $post_module_shortcode );
							$post_module_shortcode = str_replace( '[uncode_index', '[uncode_index run_dry="yes"', $post_module_shortcode );
						}
					}

					ob_start();
					do_shortcode( $post_module_shortcode );
					ob_end_clean();
				}
			}
		}
	}
}

/**
 * Function that populates the module with tax terms
 */
function uncode_filters_populate_tax_terms( $tax_source, $tax_to_query, $query_args, $multiple, $hierarchy, $order_by, $sort_by ) {
	// Populate terms
	$tax_terms = array();

	$current_post_type = uncode_get_current_post_type();

	if ( is_tax( $tax_to_query ) || ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $current_post_type == 'uncodeblock' ) {
		$terms = array();
		$post_terms = get_terms( $tax_to_query );

		if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
			global $uncode_query_options;

			if ( isset( $uncode_query_options['single_variations'] ) && $uncode_query_options['single_variations'] ) {
				if ( isset( $uncode_query_options['single_variations_hide_parent'] ) && $uncode_query_options['single_variations_hide_parent'] ) {
					$terms_count = get_option( 'uncode_terms_hidden_parent_count' );
				} else {
					$terms_count = get_option( 'uncode_terms_all_count' );
				}
			}

			foreach ( $post_terms as $post_term ) {
				if ( $post_term->count > 0 ) {
					$count = $post_term->count;

					if ( isset( $uncode_query_options['single_variations'] ) && $uncode_query_options['single_variations'] ) {
						if ( isset( $terms_count[$post_term->term_id] ) ) {
							$count = $terms_count[$post_term->term_id];
						}
					}

					$tax_terms[ $post_term->term_id ] = array(
						'count' => $count,
						'term'  => $post_term,
					);
				}
			}
		}
	} else {
		global $uncode_ajax_filter_query;
		global $uncode_ajax_filter_query_unfiltered;

		$posts_query = null;

		$fixed = apply_filters( 'uncode_make_multiple_ajax_filter_fixed', false );

		if ( is_tax( $tax_to_query ) || ( $fixed && $multiple ) || ( ( ! $multiple || uncode_get_filters_query_relation( $tax_to_query, $query_args, $tax_source ) === 'or' ) && uncode_is_only_current_filter( $tax_to_query, $query_args, $tax_source ) ) ) {
			if ( ! is_null( $uncode_ajax_filter_query_unfiltered ) ) {
				$posts_query = $uncode_ajax_filter_query_unfiltered;
			}
		} else {
			// We have filters, so use terms attached to posts we found
			// We use them also for AND queries
			if ( ! is_null( $uncode_ajax_filter_query ) ) {
				$posts_query = $uncode_ajax_filter_query;
			}
		}

		if ( ! is_null( $posts_query ) ) {
			if ( ! count( $posts_query ) > 0 ) {
				$no_results = false;

				if ( ! is_null( $uncode_ajax_filter_query ) ) {
					if ( ! count( $uncode_ajax_filter_query ) > 0 ) {
						$no_results = true;
					}
				}

				if ( $no_results ) {
					$tax_to_query_values = uncode_filters_get_query_string_value( $tax_to_query );

					if ( is_array( $tax_to_query_values ) ) {
						$known_terms   = 0;
						$unknown_terms = 0;

						foreach ( $tax_to_query_values as $tax_to_query_value ) {
							$term = get_term_by( 'slug', $tax_to_query_value, $tax_to_query );

							if ( ! is_wp_error( $term ) && $term ) {
								$tax_terms[ $term->term_id ] = array(
									'count' => 0,
									'term'  => $term,
								);
								$known_terms++;
							} else {
								$unknown_terms++;
							}
						}

						if ( ! $known_terms && $unknown_terms > 0 ) {
							if ( ! is_null( $uncode_ajax_filter_query_unfiltered ) ) {
								$unfiltered_posts_query = $uncode_ajax_filter_query_unfiltered;
							}

							if ( $unfiltered_posts_query ) {
								if ( uncode_ajax_filters_cache_enabled() ) {
									$post_objects_data  = get_transient( 'uncode_ajax_filters_post_objects_data' );
									$cache_needs_update = false;
								}

								foreach	( $posts_query as $post_id ) {
									if ( uncode_ajax_filters_cache_enabled() ) {
										// Load from cache
										$new_post_objects_data = uncode_ajax_filters_get_post_terms_from_cache( $post_objects_data, $post_id, $tax_to_query, $tax_source );

										$post_objects_data = $new_post_objects_data['data'];

										if ( $new_post_objects_data['from_cache'] === false ) {
											$cache_needs_update = true;
										}

										$post_terms = isset( $post_objects_data[$post_id] ) && isset( $post_objects_data[ $post_id ]['terms'] ) && isset( $post_objects_data[ $post_id ]['terms'][ $tax_to_query ] ) ? $post_objects_data[ $post_id ]['terms'][ $tax_to_query ] : array();
									} else {
										// Rebuild each time, no cache
										$post_terms = get_the_terms( $post_id, $tax_to_query );
										$post_terms = is_wp_error( $post_terms ) ? $post_terms : array();
									}

									if ( ! empty( $post_terms ) ) {
										foreach ( $post_terms as $post_term ) {
											$tax_terms[ $post_term->term_id ] = array(
												'count' => 0,
												'term'  => $post_term,
											);
										}
									}
								}

								if ( uncode_ajax_filters_cache_enabled() && $cache_needs_update ) {
									set_transient( 'uncode_ajax_filters_post_objects_data', $post_objects_data, uncode_ajax_filters_get_transient_lifespan() );
								}
							}
						}
					}
				}
			} else {
				if ( uncode_ajax_filters_cache_enabled() ) {
					$post_objects_data  = get_transient( 'uncode_ajax_filters_post_objects_data' );
					$cache_needs_update = false;
				}

				foreach	( $posts_query as $post_id ) {
					if ( uncode_ajax_filters_cache_enabled() ) {
						// Load from cache
						$new_post_objects_data = uncode_ajax_filters_get_post_terms_from_cache( $post_objects_data, $post_id, $tax_to_query, $tax_source );

						$post_objects_data = $new_post_objects_data['data'];

						if ( $new_post_objects_data['from_cache'] === false ) {
							$cache_needs_update = true;
						}

						$post_terms = isset( $post_objects_data[$post_id] ) && isset( $post_objects_data[ $post_id ]['terms'] ) && isset( $post_objects_data[ $post_id ]['terms'][ $tax_to_query ] ) ? $post_objects_data[ $post_id ]['terms'][ $tax_to_query ] : array();

						if ( ! empty( $post_terms ) ) {
							foreach ( $post_terms as $post_term ) {
								if ( isset( $tax_terms[ $post_term->term_id ] ) ) {
									$tax_terms[ $post_term->term_id ]['count']++;
								} else {
									$tax_terms[ $post_term->term_id ] = array(
										'count' => 1,
										'term'  => $post_term,
									);
								}
							}
						}
					} else {
						// Rebuild each time, no cache
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

								if ( $add_to_count ) {
									if ( isset( $tax_terms[ $post_term->term_id ] ) ) {
										$tax_terms[ $post_term->term_id ]['count']++;
									} else {
										$tax_terms[ $post_term->term_id ] = array(
											'count' => 1,
											'term'  => $post_term,
										);
									}
								}
							}
						}
					}
				}

				if ( uncode_ajax_filters_cache_enabled() && $cache_needs_update ) {
					set_transient( 'uncode_ajax_filters_post_objects_data', $post_objects_data, uncode_ajax_filters_get_transient_lifespan() );
				}
			}
		}
	}

	// Keep parents only
	if ( $hierarchy === 'parent_only' ) {
		$tax_terms = uncode_get_only_parent_filters( $tax_terms );
	}

	// Order terms
	if ( $order_by === 'count' ) {
		$tax_terms = uncode_sort_filters_by_count( $tax_terms, $sort_by );
	} else if ( $order_by === 'custom' ) {
		$tax_terms = uncode_sort_filters_by_custom_order( $tax_terms, $sort_by );
	} else {
		$tax_terms = uncode_sort_filters_by_name( $tax_terms, $sort_by );
	}

	$tax_terms = apply_filters( 'uncode_filters_get_tax_terms', $tax_terms, $tax_source, $tax_to_query, $query_args, $multiple, $hierarchy, $order_by, $sort_by );

	return $tax_terms;
}

/**
 * Function that populates the module with author terms
 */
function uncode_filters_populate_author_terms( $query_args, $sort_by ) {
	// Populate terms
	$author_terms = array();

	$current_post_type = uncode_get_current_post_type();
	if ( is_author() || ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $current_post_type == 'uncodeblock' ) {
		$users = get_users();

		foreach ( $users as $user ) {
			$number_of_posts = absint( count_user_posts( $user->ID, 'post' ) );

			if ( $number_of_posts > 0 ) {
				$author_terms[ $user->ID ] = array(
					'name'  => $user->display_name,
					'count' => $number_of_posts,
				);
			}
		}
	} else {
		global $uncode_ajax_filter_query;
		global $uncode_ajax_filter_query_unfiltered;

		$posts_query = null;

		if ( is_author() || ( uncode_is_only_current_filter( UNCODE_FILTER_KEY_AUTHOR, $query_args ) ) ) {
			if ( ! is_null( $uncode_ajax_filter_query_unfiltered ) ) {
				$posts_query = $uncode_ajax_filter_query_unfiltered;
			}
		} else {
			// We have filters, so use terms attached to posts we found
			if ( ! is_null( $uncode_ajax_filter_query ) ) {
				$posts_query = $uncode_ajax_filter_query;
			}
		}

		if ( ! is_null( $posts_query ) ) {
			if ( ! count( $posts_query ) > 0 ) {
				$no_results = false;

				if ( ! is_null( $uncode_ajax_filter_query ) ) {
					if ( ! count( $uncode_ajax_filter_query ) > 0 ) {
						$no_results = true;
					}
				}

				if ( $no_results ) {
					$tax_to_query_values = uncode_filters_get_query_string_value( UNCODE_FILTER_KEY_AUTHOR );

					if ( is_array( $tax_to_query_values ) ) {
						$known_terms   = 0;
						$unknown_terms = 0;

						foreach ( $tax_to_query_values as $tax_to_query_value ) {
							$user = get_user_by( 'ID', $tax_to_query_value );

							if ( $user ) {
								$author_terms[ $user->ID ] = array(
									'name'  => $user->display_name,
									'count' => 0,
								);
								$known_terms++;
							} else {
								$unknown_terms++;
							}
						}

						if ( ! $known_terms && $unknown_terms > 0 ) {
							$users = get_users();

							foreach ( $users as $user ) {
								$number_of_posts = absint( count_user_posts( $user->ID, 'post' ) );

								if ( $number_of_posts > 0 ) {
									$author_terms[ $user->ID ] = array(
										'name'  => $user->display_name,
										'count' => $number_of_posts,
									);
								}
							}
						}
					}
				}
			} else {
				if ( uncode_ajax_filters_cache_enabled() ) {
					$post_objects_data  = get_transient( 'uncode_ajax_filters_post_objects_data' );
					$cache_needs_update = false;
				}

				foreach ( $posts_query as $post_id ) {
					if ( uncode_ajax_filters_cache_enabled() ) {
						// Load from cache
						$new_post_objects_data = uncode_ajax_filters_get_author_data_from_cache( $post_objects_data, $post_id );

						$post_objects_data = $new_post_objects_data['data'];

						if ( $new_post_objects_data['from_cache'] === false ) {
							$cache_needs_update = true;
						}

						$author_id    = isset( $post_objects_data[$post_id] ) && isset( $post_objects_data[ $post_id ]['author_data'] ) && isset( $post_objects_data[ $post_id ]['author_data']['author_id'] ) ? $post_objects_data[ $post_id ]['author_data']['author_id'] : '';
						$display_name = isset( $post_objects_data[$post_id] ) && isset( $post_objects_data[ $post_id ]['author_data'] ) && isset( $post_objects_data[ $post_id ]['author_data']['author_name'] ) ? $post_objects_data[ $post_id ]['author_data']['author_name'] : '';
					} else {
						// Rebuild each time, no cache
						$author_id    = get_post_field( 'post_author', $post_id );
						$display_name = get_the_author_meta( 'display_name', $author_id );
					}

					if ( $author_id && $display_name ) {
						if ( isset( $author_terms[ $author_id ] ) ) {
							$author_terms[ $author_id ]['count']++;
						} else {
							$author_terms[ $author_id ] = array(
								'name'  => $display_name,
								'count' => 1,
							);
						}
					}
				}

				if ( uncode_ajax_filters_cache_enabled() && $cache_needs_update ) {
					set_transient( 'uncode_ajax_filters_post_objects_data', $post_objects_data, uncode_ajax_filters_get_transient_lifespan() );
				}
			}
		}
	}

	// Order terms
	$author_terms = uncode_sort_filters_by_author_name( $author_terms, $sort_by );

	$author_terms = apply_filters( 'uncode_filters_get_author_terms', $author_terms, $query_args, $sort_by );

	return $author_terms;
}

/**
 * Function that populates the module with date terms
 */
function uncode_filters_populate_date_terms( $query_args, $date_type, $date_sort ) {
	global $uncode_ajax_filter_query_post_type;

	$date_format  = $date_type === 'year' ? 'Y' : 'Y_m';
	$display_date = $date_type === 'year' ? 'Y' : 'F Y';

	// Populate terms
	$date_terms = array();

	$posts_query = null;

	$current_post_type = uncode_get_current_post_type();
	if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() || $current_post_type == 'uncodeblock' ) ) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => apply_filters( 'uncode_ajax_filters_all_posts_query_limit', 50 ),
			'fields'         => 'ids',
		);

		$all_posts_query = new WP_Query( $args );
		$posts_query     = $all_posts_query->have_posts() ? $all_posts_query->posts : array();

	} else if ( is_date() ) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		);

		if ( uncode_ajax_filters_cache_enabled() && is_array( $uncode_ajax_filter_query_post_type ) ) {
			$all_posts_query_transient = get_transient( 'uncode_ajax_filters_all_posts' );
			$all_posts_query_transient = is_array( $all_posts_query_transient ) ? $all_posts_query_transient : array();

			$posts_query = array();

			foreach ( $uncode_ajax_filter_query_post_type as $cpt ) {
				// Valid cache found
				if ( isset( $all_posts_query_transient[ $cpt ] ) ) {
					$posts_query = array_merge( $posts_query, $all_posts_query_transient[ $cpt ] );
				} else {
					// Add this CPT to cache
					$args['post_type'] = $cpt;
					$all_posts_cpt_query = new WP_Query( $args );
					$all_posts_cpt_query_ids = $all_posts_cpt_query->have_posts() ? $all_posts_cpt_query->posts : array();
					$posts_query = array_merge( $posts_query, $all_posts_cpt_query_ids );

					// Update transient
					$all_posts_query_transient[$cpt] = $all_posts_cpt_query_ids;
					set_transient( 'uncode_ajax_filters_all_posts', $all_posts_query_transient, uncode_ajax_filters_get_transient_lifespan() );
				}
			}
		} else {
			$all_posts_query = new WP_Query( $args );
			$posts_query     = $all_posts_query->have_posts() ? $all_posts_query->posts : array();
		}
	} else {
		global $uncode_ajax_filter_query;
		global $uncode_ajax_filter_query_unfiltered;

		if ( is_date() || ( uncode_is_only_current_filter( UNCODE_FILTER_KEY_DATE, $query_args ) ) ) {
			if ( ! is_null( $uncode_ajax_filter_query_unfiltered ) ) {
				$posts_query = $uncode_ajax_filter_query_unfiltered;
			}
		} else {
			// We have filters, so use terms attached to posts we found
			if ( ! is_null( $uncode_ajax_filter_query ) ) {
				$posts_query = $uncode_ajax_filter_query;
			}
		}
	}

	if ( ! is_null( $posts_query ) ) {
		if ( ! count( $posts_query ) > 0 ) {
			$no_results = false;

			if ( ! is_null( $uncode_ajax_filter_query ) ) {
				if ( ! count( $uncode_ajax_filter_query ) > 0 ) {
					$no_results = true;
				}
			}

			if ( $no_results ) {
				$tax_to_query_values = uncode_filters_get_query_string_value( UNCODE_FILTER_KEY_DATE );

				if ( is_array( $tax_to_query_values ) ) {
					$known_terms   = 0;
					$unknown_terms = 0;

					foreach ( $tax_to_query_values as $tax_to_query_value ) {
						$date  = $tax_to_query_value;
						$year  = false;
						$month = false;

						if ( strpos( $date, '_' ) !== false ) {
							$dates          = explode( '_', $date );
							$date_to_search = $dates[0] . '-' . $dates[1] . '-01';
							$year           = absint( $dates[0] );
							$month          = absint( $dates[1] );
							$valid_date     = uncode_filters_validate_date( $date_to_search );
						} else {
							$date_to_search = $date;
							$year           = absint( $date );
							$valid_date     = uncode_filters_validate_date( $date_to_search, 'Y' );
						}

						if ( $valid_date && $year ) {
							$args = array(
								'post_type'      => $uncode_ajax_filter_query_post_type,
								'posts_per_page' => -1,
								'fields'         => 'ids',
							);

							if ( $year ) {
								$args['year'] = $year;
							}

							if ( $month ) {
								$args['monthnum'] = $month;
							}

							$all_posts_query        = new WP_Query( $args );
							$no_results_posts_query = $all_posts_query->have_posts() ? $all_posts_query->posts : array();

							if ( count( $no_results_posts_query ) > 0 ) {
								foreach ( $no_results_posts_query as $post_id ) {
									$date      = get_the_date( $date_format, $post_id );
									$timestamp = get_the_time( 'U', $post_id );

									if ( isset( $date_terms[ $date ] ) ) {
										$date_terms[ $date ]['count']++;
									} else {
										$date_terms[ $date ] = array(
											'name'  => wp_date( $display_date, $timestamp ),
											'count' => 1,
										);
									}
								}

								wp_reset_query();
							}
						}

						if ( ! $date_terms ) {
							if ( ! is_null( $uncode_ajax_filter_query_unfiltered ) ) {
								$unfiltered_posts_query = $uncode_ajax_filter_query_unfiltered;
							}

							if ( $unfiltered_posts_query ) {
								foreach ( $unfiltered_posts_query as $post_id ) {
									$date      = get_the_date( $date_format, $post_id );
									$timestamp = get_the_time( 'U', $post_id );

									$date_terms[ $date ] = array(
										'name'  => wp_date( $display_date, $timestamp ),
										'count' => 0,
									);
								}
							}
						}
					}
				}
			}
		} else {
			if ( uncode_ajax_filters_cache_enabled() ) {
				$post_objects_data  = get_transient( 'uncode_ajax_filters_post_objects_data' );
				$cache_needs_update = false;
			}

			foreach ( $posts_query as $post_id ) {
				if ( uncode_ajax_filters_cache_enabled() ) {
					// Load from cache
					$new_post_objects_data = uncode_ajax_filters_get_date_data_from_cache( $post_objects_data, $post_id, $date_format );

					$post_objects_data = $new_post_objects_data['data'];

					if ( $new_post_objects_data['from_cache'] === false ) {
						$cache_needs_update = true;
					}

					$date      = isset( $post_objects_data[$post_id] ) && isset( $post_objects_data[ $post_id ]['date_data'] ) && isset( $post_objects_data[ $post_id ]['date_data']['date'] ) ? $post_objects_data[ $post_id ]['date_data']['date'] : '';
					$timestamp = isset( $post_objects_data[$post_id] ) && isset( $post_objects_data[ $post_id ]['date_data'] ) && isset( $post_objects_data[ $post_id ]['date_data']['timestamp'] ) ? $post_objects_data[ $post_id ]['date_data']['timestamp'] : '';
				} else {
					// Rebuild each time, no cache
					$date      = get_the_date( $date_format, $post_id );
					$timestamp = get_the_time( 'U', $post_id);
				}

				if ( $date && $timestamp ) {
					if ( isset( $date_terms[ $date ] ) ) {
						$date_terms[ $date ]['count']++;
					} else {
						$date_terms[ $date ] = array(
							'name'  => wp_date( $display_date, $timestamp ),
							'count' => 1,
						);
					}
				}
			}

			if ( uncode_ajax_filters_cache_enabled() && $cache_needs_update ) {
				set_transient( 'uncode_ajax_filters_post_objects_data', $post_objects_data, uncode_ajax_filters_get_transient_lifespan() );
			}
		}
	}

	// Order terms
	$date_terms = uncode_sort_filters_by_date( $date_terms, $date_sort );

	$date_terms = apply_filters( 'uncode_filters_get_date_terms', $date_terms, $query_args, $date_type, $date_sort );

	return $date_terms;
}

/**
 * Function that populates the module with product status terms
 */
function uncode_filters_populate_product_status_terms( $query_args, $multiple ) {
	$filter_terms = array(
		'sale' => array(
			'name'  => uncode_filters_get_label( 'sale' ),
			'count' => 0,
		),
		'instock' => array(
			'name'  => uncode_filters_get_label( 'instock' ),
			'count' => 0,
		),
	);

	$current_post_type = uncode_get_current_post_type();

	if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $current_post_type == 'uncodeblock' ) {
		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => apply_filters( 'uncode_ajax_filters_all_posts_query_limit', 50 ),
			'fields'         => 'ids',
		);

		$all_posts_query = new WP_Query( $args );
		$posts_query     = $all_posts_query->have_posts() ? $all_posts_query->posts : array();
	} else {
		global $uncode_ajax_filter_query;
		global $uncode_ajax_filter_query_unfiltered;

		$posts_query = null;

		if ( ( ! $multiple || uncode_get_filters_query_relation( UNCODE_FILTER_KEY_STATUS, $query_args ) === 'or' ) && uncode_is_only_current_filter( UNCODE_FILTER_KEY_STATUS, $query_args ) ) {
			if ( ! is_null( $uncode_ajax_filter_query_unfiltered ) ) {
				$posts_query = $uncode_ajax_filter_query_unfiltered;
			}
		} else {
			// We have filters, so use terms attached to posts we found
			// We use them also for AND queries
			if ( ! is_null( $uncode_ajax_filter_query ) ) {
				$posts_query = $uncode_ajax_filter_query;
			}
		}
	}

	if ( ! is_null( $posts_query ) ) {
		if ( ! count( $posts_query ) > 0 ) {
			$no_results = false;

			if ( ! is_null( $uncode_ajax_filter_query ) ) {
				if ( ! count( $uncode_ajax_filter_query ) > 0 ) {
					$no_results = true;
				}
			}

			if ( $no_results ) {
				$tax_to_query_values = uncode_filters_get_query_string_value( UNCODE_FILTER_KEY_STATUS );

				if ( is_array( $tax_to_query_values ) ) {
					$known_terms      = 0;
					$unknown_terms    = 0;
					$new_filter_terms = array();

					foreach ( $tax_to_query_values as $tax_to_query_value ) {
						if ( array_key_exists( $tax_to_query_value, $filter_terms ) ) {
							$new_filter_terms[$tax_to_query_value] = $filter_terms[$tax_to_query_value];
							$known_terms++;
						} else {
							$unknown_terms++;
						}
					}

					if ( ! $known_terms && $unknown_terms > 0 ) {
						$new_filter_terms = $filter_terms;
					}

					$filter_terms = $new_filter_terms;

					$filter_terms = apply_filters( 'uncode_filters_get_product_status_terms', $filter_terms );

					return $filter_terms;
				}

				return false;
			}
		} else {
			if ( uncode_ajax_filters_cache_enabled() ) {
				$post_objects_data  = get_transient( 'uncode_ajax_filters_post_objects_data' );
				$cache_needs_update = false;
			}

			foreach ( $posts_query as $post_id ) {
				if ( uncode_ajax_filters_cache_enabled() ) {
					// Load from cache
					$new_post_objects_data = uncode_ajax_filters_get_product_data_from_cache( $post_objects_data, $post_id, array( 'on_sale', 'instock' ) );

					$post_objects_data = $new_post_objects_data['data'];

					if ( $new_post_objects_data['from_cache'] === false ) {
						$cache_needs_update = true;
					}

					$product_data = isset( $post_objects_data[$post_id] ) && isset( $post_objects_data[ $post_id ]['product_data'] ) ? $post_objects_data[ $post_id ]['product_data'] : array();

					if ( ! isset( $product_data['type'] ) || $product_data['type'] === 'grouped' ) {
						continue;
					}

					if ( isset( $product_data['on_sale'] ) && $product_data['on_sale'] ) {
						$filter_terms['sale']['count']++;
					}

					if ( isset( $product_data['instock'] ) && $product_data['instock'] ) {
						$filter_terms['instock']['count']++;
					}
				} else {
					$product = wc_get_product( $post_id );

					if ( is_a( $product, 'WC_Product' ) ) {
						if ( $product->get_type() === 'grouped' ) {
							continue;
						}

						if ( $product->is_on_sale() ) {
							$filter_terms['sale']['count']++;
						}

						if ( $product->is_in_stock() ) {
							$filter_terms['instock']['count']++;
						}
					}
				}
			}

			if ( uncode_ajax_filters_cache_enabled() && $cache_needs_update ) {
				set_transient( 'uncode_ajax_filters_post_objects_data', $post_objects_data, uncode_ajax_filters_get_transient_lifespan() );
			}

			// Remove empty terms
			foreach ( $filter_terms as $key => $value ) {
				if ( $value['count'] === 0 ) {
					unset( $filter_terms[$key] );
				}
			}
		}
	}

	$filter_terms = apply_filters( 'uncode_filters_get_product_status_terms', $filter_terms, $query_args, $multiple );

	return $filter_terms;
}

/**
 * Function that populates the module with product rating terms
 */
function uncode_filters_populate_product_sorting_terms( $query_args ) {
	$catalog_orderby_options = array(
		'menu_order' => array(
			'name' => __( 'Default sorting', 'woocommerce' )
		),
		'popularity' => array(
			'name' => __( 'Sort by popularity', 'woocommerce' )
		),
		'rating' => array(
			'name' => __( 'Sort by average rating', 'woocommerce' )
		),
		'date' => array(
			'name' => __( 'Sort by latest', 'woocommerce' )
		),
		'price' => array(
			'name' => __( 'Sort by price: low to high', 'woocommerce' )
		),
		'price-desc' => array(
			'name' => __( 'Sort by price: high to low', 'woocommerce' )
		),
	);

	if ( ! wc_review_ratings_enabled() ) {
		unset( $catalog_orderby_options['rating'] );
	}

	$catalog_orderby_options = apply_filters( 'uncode_filters_get_product_sorting_terms', $catalog_orderby_options );

	return $catalog_orderby_options;
}

/**
 * Function that populates the module with product rating terms
 */
function uncode_filters_populate_product_price_terms( $lines, $query_args ) {
	$lines        = str_replace( '&gt;', '>', $lines );
	$lines        = explode( PHP_EOL, $lines );
	$price_ranges = array();

	if ( is_array( $lines ) && count( $lines ) > 0 ) {
		foreach ( $lines as $line ) {
			$line = trim( $line );

			if ( strpos( $line, '=' ) !== false ) {
				$line  = str_replace( '=', '', $line );
				$price = floatval( $line );

				$price_ranges[] = array(
					'name'      => wc_price( $price ),
					'min_price' => $price,
					'max_price' => $price,
					'count'     => 0
				);
			} else if ( strpos( $line, '-' ) !== false ) {
				$line  = str_replace( '-', '', $line );
				$price = floatval( $line );

				$price_ranges[] = array(
					'name'      => sprintf( _x( 'Under %s', 'ajax_price_filter', 'uncode' ), wc_price( $price ) ),
					'min_price' => 0,
					'max_price' => $price,
					'count'     => 0
				);
			} else if ( strpos( $line, '+' ) !== false ) {
				$line  = str_replace( '+', '', $line );
				$price = floatval( $line );

				$price_ranges[] = array(
					'name'      => sprintf( _x( 'Over %s', 'ajax_price_filter', 'uncode' ), wc_price( $price ) ),
					'min_price' => $price,
					'max_price' => 0,
					'count'     => 0
				);
			} else if ( strpos( $line, '>' ) !== false ) {
				$prices = explode( '>', $line );

				if ( isset( $prices[0] ) && isset( $prices[1] ) ) {
					$min_price = floatval( $prices[0] );
					$max_price = floatval( $prices[1] );

					if ( $max_price < $min_price ) {
						$old_price = $min_price;
						$min_price = $max_price;
						$max_price = $old_price;
					}

					$price_ranges[] = array(
						'name'      => wc_price( $min_price ) . ' - ' . wc_price( $max_price ),
						'min_price' => $min_price,
						'max_price' => $max_price,
						'count'     => 0
					);
				}
			}
		}
	}

	$current_post_type = uncode_get_current_post_type();

	if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $current_post_type == 'uncodeblock' ) {
		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => apply_filters( 'uncode_ajax_filters_all_posts_query_limit', 50 ),
			'fields'         => 'ids',
		);

		$all_posts_query = new WP_Query( $args );
		$posts_query     = $all_posts_query->have_posts() ? $all_posts_query->posts : array();

	} else {
		global $uncode_ajax_filter_query;
		global $uncode_ajax_filter_query_unfiltered;

		$posts_query = null;

		if ( uncode_is_only_current_filter( 'custom_price', $query_args ) ) {
			if ( ! is_null( $uncode_ajax_filter_query_unfiltered ) ) {
				$posts_query = $uncode_ajax_filter_query_unfiltered;
			}
		} else {
			// We have filters, so use terms attached to posts we found
			if ( ! is_null( $uncode_ajax_filter_query ) ) {
				$posts_query = $uncode_ajax_filter_query;
			}
		}
	}

	if ( ! is_null( $posts_query ) ) {
		if ( ! count( $posts_query ) > 0 ) {
			$no_results = false;

			if ( ! is_null( $uncode_ajax_filter_query ) ) {
				if ( ! count( $uncode_ajax_filter_query ) > 0 ) {
					$no_results = true;
				}
			}

			if ( $no_results ) {
				$new_filter_terms = array();
				$range_found      = false;

				if ( isset( $_GET['min_price'] ) || isset( $_GET['max_price'] ) ) {
					if ( isset( $_GET['min_price'] ) && isset( $_GET['max_price'] ) ) {
						$min_price = floatval( $_GET['min_price'] );
						$max_price = floatval( $_GET['max_price'] );
					} else if ( isset( $_GET['min_price'] ) ) {
						$min_price = floatval( $_GET['min_price'] );
						$max_price = 0;
					} else if ( isset( $_GET['max_price'] ) ) {
						$max_price = floatval( $_GET['max_price'] );
						$min_price = 0;
					}

					foreach ( $price_ranges as $price_range ) {
						if ( $min_price === $price_range['min_price'] && $max_price === $price_range['max_price'] ) {
							$new_filter_terms[] = $price_range;
							$range_found = true;
						}
					}

					if ( ! $range_found ) {
						$new_filter_terms = $price_ranges;
					}

					$price_ranges = $new_filter_terms;

					$price_ranges = apply_filters( 'uncode_filters_get_product_price_terms', $price_ranges, $lines, $query_args );

					return $price_ranges;
				}

				return false;
			}
		} else {
			if ( uncode_ajax_filters_cache_enabled() ) {
				$post_objects_data  = get_transient( 'uncode_ajax_filters_post_objects_data' );
				$cache_needs_update = false;
			}

			foreach ( $posts_query as $post_id ) {
				if ( uncode_ajax_filters_cache_enabled() ) {
					// Load from cache
					$new_post_objects_data = uncode_ajax_filters_get_product_data_from_cache( $post_objects_data, $post_id, array( 'price' ) );

					$post_objects_data = $new_post_objects_data['data'];

					if ( $new_post_objects_data['from_cache'] === false ) {
						$cache_needs_update = true;
					}

					$product_data = isset( $post_objects_data[$post_id] ) && isset( $post_objects_data[ $post_id ]['product_data'] ) ? $post_objects_data[ $post_id ]['product_data'] : array();

					if ( ! isset( $product_data['type'] ) || ! isset( $product_data['price'] ) ) {
						continue;
					}

					$is_variable_product = $product_data['type'] === 'variable' ? true : false;

					foreach ( $price_ranges as $key => $price_range ) {
						if ( $is_variable_product ) {
							$variation_min_price = $product_data['min_price'];
							$variation_max_price = $product_data['max_price'];

							$variable_price = array( 'min_price' => $variation_min_price,   'max_price' => $variation_max_price );

							if ( uncode_filters_is_product_in_price_range( $variable_price, $price_range, true ) ) {
								$price_ranges[$key]['count']++;
							}
						} else {
							if ( uncode_filters_is_product_in_price_range( $product_data['price'], $price_range ) ) {
								$price_ranges[$key]['count']++;
							}
						}
					}
				} else {
					$product = wc_get_product( $post_id );

					if ( is_a( $product, 'WC_Product' ) ) {
						$price = floatval( $product->get_price() );

						$is_variable_product = $product->get_type() === 'variable' ? true : false;

						foreach ( $price_ranges as $key => $price_range ) {
							if ( $is_variable_product ) {
								$variation_min_price = floatval( $product->get_variation_price( 'min', true ) );
								$variation_max_price = floatval( $product->get_variation_price( 'max', true ) );

								$variable_price = array( 'min_price' => $variation_min_price,   'max_price' => $variation_max_price );

								if ( uncode_filters_is_product_in_price_range( $variable_price, $price_range, true ) ) {
									$price_ranges[$key]['count']++;
								}
							} else {
								if ( uncode_filters_is_product_in_price_range( $price, $price_range ) ) {
									$price_ranges[$key]['count']++;
								}
							}
						}
					}
				}
			}

			if ( uncode_ajax_filters_cache_enabled() && $cache_needs_update ) {
				set_transient( 'uncode_ajax_filters_post_objects_data', $post_objects_data, uncode_ajax_filters_get_transient_lifespan() );
			}

			// Remove empty terms
			foreach ( $price_ranges as $key => $value ) {
				if ( $value['count'] === 0 ) {
					unset( $price_ranges[$key] );
				}
			}
		}
	}

	$price_ranges = apply_filters( 'uncode_filters_get_product_price_terms', $price_ranges, $lines, $query_args );

	return $price_ranges;
}

/**
 * Function that populates the module with product rating terms
 */
function uncode_filters_populate_product_ratings_terms( $query_args, $multiple ) {
	$filter_terms = array(
		5 => array(
			'name'  => uncode_filters_get_label( 'rating', 5 ),
			'count' => 0,
		),
		4 => array(
			'name'  => uncode_filters_get_label( 'rating', 4 ),
			'count' => 0,
		),
		3 => array(
			'name'  => uncode_filters_get_label( 'rating', 3 ),
			'count' => 0,
		),
		2 => array(
			'name'  => uncode_filters_get_label( 'rating', 2 ),
			'count' => 0,
		),
		1 => array(
			'name'  => uncode_filters_get_label( 'rating', 1 ),
			'count' => 0,
		),
	);

	$current_post_type = uncode_get_current_post_type();

	if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $current_post_type == 'uncodeblock' ) {
		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => apply_filters( 'uncode_ajax_filters_all_posts_query_limit', 50 ),
			'fields'         => 'ids',
		);

		$all_posts_query = new WP_Query( $args );
		$posts_query     = $all_posts_query->have_posts() ? $all_posts_query->posts : array();
	} else {
		global $uncode_ajax_filter_query;
		global $uncode_ajax_filter_query_unfiltered;

		$posts_query = null;

		if ( ( ! $multiple || uncode_get_filters_query_relation( UNCODE_FILTER_KEY_RATING, $query_args ) === 'or' ) && uncode_is_only_current_filter( UNCODE_FILTER_KEY_RATING, $query_args ) ) {
			if ( ! is_null( $uncode_ajax_filter_query_unfiltered ) ) {
				$posts_query = $uncode_ajax_filter_query_unfiltered;
			}
		} else {
			// We have filters, so use terms attached to posts we found
			// We use them also for AND queries
			if ( ! is_null( $uncode_ajax_filter_query ) ) {
				$posts_query = $uncode_ajax_filter_query;
			}
		}
	}

	if ( ! is_null( $posts_query ) ) {
		if ( ! count( $posts_query ) > 0 ) {
			$no_results = false;

			if ( ! is_null( $uncode_ajax_filter_query ) ) {
				if ( ! count( $uncode_ajax_filter_query ) > 0 ) {
					$no_results = true;
				}
			}

			if ( $no_results ) {
				$tax_to_query_values = uncode_filters_get_query_string_value( UNCODE_FILTER_KEY_RATING );

				if ( is_array( $tax_to_query_values ) ) {
					$known_terms      = 0;
					$unknown_terms    = 0;
					$new_filter_terms = array();

					foreach ( $tax_to_query_values as $tax_to_query_value ) {
						if ( array_key_exists( $tax_to_query_value, $filter_terms ) ) {
							$new_filter_terms[$tax_to_query_value] = $filter_terms[$tax_to_query_value];
							$known_terms++;
						} else {
							$unknown_terms++;
						}
					}

					if ( ! $known_terms && $unknown_terms > 0 ) {
						$new_filter_terms = $filter_terms;
					}

					$filter_terms = $new_filter_terms;

					$filter_terms = apply_filters( 'uncode_filters_get_product_ratings_terms', $filter_terms, $query_args, $multiple );

					return $filter_terms;
				}

				return false;
			}
		} else {
			if ( uncode_ajax_filters_cache_enabled() ) {
				$post_objects_data  = get_transient( 'uncode_ajax_filters_post_objects_data' );
				$cache_needs_update = false;
			}

			foreach ( $posts_query as $post_id ) {
				if ( uncode_ajax_filters_cache_enabled() ) {
					// Load from cache
					$new_post_objects_data = uncode_ajax_filters_get_product_data_from_cache( $post_objects_data, $post_id, array( 'rating' ) );

					$post_objects_data = $new_post_objects_data['data'];

					if ( $new_post_objects_data['from_cache'] === false ) {
						$cache_needs_update = true;
					}

					$product_data = isset( $post_objects_data[$post_id] ) && isset( $post_objects_data[ $post_id ]['product_data'] ) ? $post_objects_data[ $post_id ]['product_data'] : array();

					if ( ! isset( $product_data['type'] ) || ! isset( $product_data['rating'] ) ) {
						continue;
					}

					$rating = $product_data['rating'];

					if ( $rating > 1 ) {
						$filter_terms[$rating]['count']++;
					}
				} else {
					$product = wc_get_product( $post_id );

					if ( is_a( $product, 'WC_Product' ) ) {
						$rating = round( $product->get_average_rating() );

						global $uncode_query_options;

						if ( isset( $uncode_query_options['single_variations'] ) && $uncode_query_options['single_variations'] && $product->get_type() === 'variation' ) {
							$parent_id = $product->get_parent_id();

							if ( $parent_id > 0 ) {
								$_rating = get_post_meta( $parent_id, '_wc_average_rating', true );

								if ( $_rating ) {
									$rating = round( $_rating );
								}
							}
						}

						if ( $rating > 1 ) {
							$filter_terms[$rating]['count']++;
						}
					}
				}

			}

			// Remove empty terms
			foreach ( $filter_terms as $key => $value ) {
				if ( $value['count'] === 0 ) {
					unset( $filter_terms[$key] );
				}
			}
		}
	}

	$filter_terms = apply_filters( 'uncode_filters_get_product_ratings_terms', $filter_terms, $query_args, $multiple );

	return $filter_terms;
}

/**
 * Function that get the label of a filter
 */
function uncode_filters_get_label( $type, $count = 0 ) {
	$label = '';

	switch ( $type ) {
		case 'sale':
			$label = __( 'On sale', 'uncode' );
			break;

		case 'instock':
			$label = __( 'In stock', 'uncode' );
			break;

		case 'rating':
			$label = sprintf( _n( '%s star', '%s stars', $count, 'uncode' ), number_format_i18n( $count ) );
			break;
	}

	return $label;
}

/**
 * Sort found terms by name
 */
function uncode_sort_filters_by_name( $terms, $sort_by ) {
	$sorted_array = array();

	foreach ( $terms as $term_id => $term_data ) {
		$term = $term_data['term'];
		$name = $term->name;
		$sorted_array[$term_id] = $name;
	}

	if ( $sort_by === 'desc' ) {
		arsort( $sorted_array );
	} else {
		asort( $sorted_array );
	}

	foreach ( $sorted_array as $key => $value ) {
		$sorted_array[$key] = $terms[$key];
	}

	return $sorted_array;
}

/**
 * Sort found terms by count
 */
function uncode_sort_filters_by_count( $terms, $sort_by ) {
	$sorted_array = array();

	foreach ( $terms as $term_id => $term_data ) {
		$term  = $term_data['term'];
		$count = $term_data['count'];
		$sorted_array[$term_id] = $count;
	}

	if ( $sort_by === 'desc' ) {
		arsort( $sorted_array, SORT_NUMERIC );
	} else {
		asort( $sorted_array, SORT_NUMERIC );
	}

	foreach ( $sorted_array as $key => $value ) {
		$sorted_array[$key] = $terms[$key];
	}

	return $sorted_array;
}

/**
 * Sort found terms by custom order
 */
function uncode_sort_filters_by_custom_order( $terms, $sort_by ) {
	$sorted_array = array();

	foreach ( $terms as $term_id => $term_data ) {
		$term  = $term_data['term'];
		$term_order = get_term_meta( $term_id, 'order', true );
		$sorted_array[$term_id] = $term_order;
	}

	if ( $sort_by === 'desc' ) {
		arsort( $sorted_array, SORT_NUMERIC );
	} else {
		asort( $sorted_array, SORT_NUMERIC );
	}

	foreach ( $sorted_array as $key => $value ) {
		$sorted_array[$key] = $terms[$key];
	}

	return $sorted_array;
}

/**
 * Sort found authors by name
 */
function uncode_sort_filters_by_author_name( $authors, $sort_by ) {
	$sorted_array = array();

	foreach ( $authors as $author_id => $author_data ) {
		$name = $author_data['name'];
		$sorted_array[$author_id] = $name;
	}

	if ( $sort_by === 'desc' ) {
		arsort( $sorted_array );
	} else {
		asort( $sorted_array );
	}

	foreach ( $sorted_array as $key => $value ) {
		$sorted_array[$key] = $authors[$key];
	}

	return $sorted_array;
}

/**
 * Sort found authors by date
 */
function uncode_sort_filters_by_date( $dates, $date_sort ) {
	if ( $date_sort === 'asc' ) {
		ksort( $dates );
	} else {
		krsort( $dates );

	}

	return $dates;
}

/**
 * Ensure to always have parents of child categories (terms array)
 */
function uncode_add_missing_parent_terms( $terms ) {
	foreach ( $terms as $term_id => $term ) {
		if ( $term->parent > 0 && ! isset( $terms[$term->parent] ) ) {
			$parent_term = get_term( $term->parent, $term->taxonomy );

			$terms[$parent_term->term_id] = $parent_term;

			if ( $parent_term->parent > 0 && ! isset( $terms[$parent_term->parent] ) ) {
				$terms = uncode_add_missing_parent_terms( $terms );
			}
		}
	}

	return $terms;
}

/**
 * Get only parents from list of terms
 */
function uncode_get_only_parent_filters( $terms ) {
	$parent_terms = array();

	foreach ( $terms as $term_id => $term_data ) {
		$term = $term_data['term'];

		if ( $term->parent > 0 ) {
			continue;
		}

		$parent_terms[$term_id] = $term_data;
	}

	return $parent_terms;
}

/**
 * Check if filter key is a valid taxonomy
 */
function uncode_is_valid_filter_key( $filter_key ) {
	$is_valid = false;

	if ( $filter_key === UNCODE_FILTER_PREFIX ) {
		$is_valid = true;
	} else if ( in_array( $filter_key, uncode_get_special_filter_keys() ) ) {
		$is_valid = true;
	} else if ( substr( $filter_key, 0, strlen( UNCODE_FILTER_PREFIX_RELATION ) ) == UNCODE_FILTER_PREFIX_RELATION ) {
		$is_valid = true;
	} else {
		if ( substr( $filter_key, 0, strlen( UNCODE_FILTER_PREFIX_PA ) ) == UNCODE_FILTER_PREFIX_PA ) {
			$filter_key = 'pa_' . substr( $filter_key, strlen( UNCODE_FILTER_PREFIX_PA ) );
		} else if ( substr( $filter_key, 0, strlen( UNCODE_FILTER_PREFIX_TAX ) ) == UNCODE_FILTER_PREFIX_TAX ) {
			$filter_key = substr( $filter_key, strlen( UNCODE_FILTER_PREFIX_TAX ) );
		}

		$is_valid = taxonomy_exists( $filter_key );
	}

	return $is_valid;
}

/**
 * Build the filter link
 */
function uncode_build_filter_link( $link, $query_args ) {
	unset( $query_args[UNCODE_FILTER_PREFIX] );

	foreach ( $query_args as $key => $value ) {
		if ( is_array( $value ) ) {
			$value = implode( ',', $value );
		}

		if ( ! $value ) {
			unset( $query_args[$key] );
		} else {
			if ( apply_filters( 'uncode_filters_sanitize_value', true ) ) {
				$value = str_replace( '%2C', ',', urlencode( sanitize_text_field( wp_unslash( $value ) ) ) );
			} else {
				$value = str_replace( '%2C', ',', wp_unslash( $value ) );
			}
			$query_args[$key] = $value;
		}
	}

	// Remove relation args if related key is not set
	foreach ( $query_args as $key => $value ) {
		if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_PA ) ) == UNCODE_FILTER_PREFIX_QUERY_TYPE_PA ) {
			$key_to_search = UNCODE_FILTER_PREFIX_PA . substr( $key, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_PA ) );
			if ( ! isset( $query_args[$key_to_search] ) ) {
				unset( $query_args[$key] );
			}
		} else if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX ) ) == UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX ) {
			$key_to_search = UNCODE_FILTER_PREFIX_TAX . substr( $key, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX ) );
			if ( ! isset( $query_args[$key_to_search] ) ) {
				unset( $query_args[$key] );
			}
		} else if ( $key === UNCODE_FILTER_PREFIX_QUERY_TYPE_STATUS ) {
			$key_to_search = UNCODE_FILTER_KEY_STATUS;
			if ( ! isset( $query_args[$key_to_search] ) ) {
				unset( $query_args[$key] );
			}
		}
	}

	if ( count( $query_args ) > 0 ) {
		$query_args[UNCODE_FILTER_PREFIX] = 1;
	}

	$link = add_query_arg( $query_args, $link );

	return $link;
}

/**
 * Remove all filters of a specific key from the URL
 */
function uncode_clear_key_filters( $current_key, $link, $query_args ) {
	unset( $query_args[UNCODE_FILTER_PREFIX] );

	$prefix_pa = 'pa_';

	if ( ! in_array( $current_key, uncode_get_special_filter_keys() ) ) {
		if ( substr( $current_key, 0, strlen( $prefix_pa ) ) == $prefix_pa ) {
			$key_with_prefix = UNCODE_FILTER_PREFIX_PA . substr( $current_key, strlen( $prefix_pa ) );
		} else {
			$key_with_prefix = UNCODE_FILTER_PREFIX_TAX . $current_key;
		}
	} else {
		$key_with_prefix = $current_key;
	}

	if ( $current_key === 'custom_price' ) {
		unset( $query_args['min_price'] );
		unset( $query_args['max_price'] );
	} else {
		unset( $query_args[$key_with_prefix] );
	}

	foreach ( $query_args as $key => $value ) {
		if ( is_array( $value ) ) {
			$value = implode( ',', $value );
		}

		if ( ! $value ) {
			unset( $query_args[$key] );
		} else {
			if ( apply_filters( 'uncode_filters_sanitize_value', true ) ) {
				$value = str_replace( '%2C', ',', urlencode( sanitize_text_field( wp_unslash( $value ) ) ) );
			} else {
				$value = str_replace( '%2C', ',', wp_unslash( $value ) );
			}
			$query_args[$key] = $value;
		}
	}

	// Remove relation args if related key is not set
	foreach ( $query_args as $key => $value ) {
		if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_PA ) ) == UNCODE_FILTER_PREFIX_QUERY_TYPE_PA ) {
			$key_to_search = UNCODE_FILTER_PREFIX_PA . substr( $key, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_PA ) );
			if ( ! isset( $query_args[$key_to_search] ) ) {
				unset( $query_args[$key] );
			}
		} else if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX ) ) == UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX ) {
			$key_to_search = UNCODE_FILTER_PREFIX_TAX . substr( $key, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX ) );
			if ( ! isset( $query_args[$key_to_search] ) ) {
				unset( $query_args[$key] );
			}
		} else if ( $key === UNCODE_FILTER_PREFIX_QUERY_TYPE_STATUS ) {
			$key_to_search = UNCODE_FILTER_KEY_STATUS;
			if ( ! isset( $query_args[$key_to_search] ) ) {
				unset( $query_args[$key] );
			}
		}
	}

	if ( count( $query_args ) > 0 ) {
		$query_args[UNCODE_FILTER_PREFIX] = 1;
	}

	$link = add_query_arg( $query_args, $link );

	return $link;
}

/**
 * Remove 'pa_' and use 'filter_' prefix for product attributes
 */
function uncode_get_filter_pa_key( $taxonomy ) {
	$prefix = 'pa_';

	if ( substr( $taxonomy, 0, strlen( $prefix ) ) == $prefix ) {
		$taxonomy = UNCODE_FILTER_PREFIX_PA . substr( $taxonomy, strlen( $prefix ) );
	}

	return $taxonomy;
}

/**
 * Use 'tax_' prefix for taxonomies
 */
function uncode_get_filter_tax_key( $taxonomy ) {
	$taxonomy = UNCODE_FILTER_PREFIX_TAX . $taxonomy;

	return $taxonomy;
}

/**
 * Returns attributes (href and class) to be used for filter anchors
 */
function uncode_get_filter_link_attributes( $term, $key_to_query, $query_args = array(), $args = array(), $filter_terms = array() ) {
	$is_product_att = isset( $args['is_product_att'] ) && $args['is_product_att'] === true ? true : false;
	$allow_multiple = isset( $args['multiple'] ) && $args['multiple'] === true ? true : false;
	$link           = isset( $args['current_url'] ) ? $args['current_url'] : uncode_get_current_url();
	$relation       = isset( $args['relation'] ) && $args['relation'] === 'and' ? 'and' : 'or';
	$disable_ajax   = isset( $args['disable_ajax'] ) ? $args['disable_ajax'] : false;
	$class          = '';
	$atts           = array( 'checked' => false );

	if ( $key_to_query === 'custom_price' ) {
		$filter_value  = isset( $filter_terms[$term] ) ? $filter_terms[$term] : array();
		$min_price     = 0;
		$max_price     = 0;
		$old_min_price = false;
		$old_max_price = false;

		if ( isset( $filter_value['min_price'] ) && $filter_value['min_price'] > 0 ) {
			$min_price = $filter_value['min_price'];
		}

		if ( isset( $filter_value['max_price'] ) && $filter_value['max_price'] > 0 ) {
			$max_price = $filter_value['max_price'];
		}

		if ( isset( $query_args['min_price'] ) ) {
			$old_min_price = $query_args['min_price'][0];
			unset( $query_args['min_price'] );
		}

		if ( isset( $query_args['max_price'] ) ) {
			$old_max_price = $query_args['max_price'][0];
			unset( $query_args['max_price'] );
		}

		if ( $min_price > 0 ) {
			$query_args['min_price'] = array( $min_price );
		}

		if ( $max_price > 0 ) {
			$query_args['max_price'] = array( $max_price );
		}

		if ( isset( $query_args['min_price'] ) && isset( $query_args['max_price'] ) ) {
			if ( $old_min_price && $old_max_price && $old_min_price === $query_args['min_price'][0] && $old_max_price === $query_args['max_price'][0] ) {
				$atts['checked'] = true;
				unset( $query_args['min_price'] );
				unset( $query_args['max_price'] );
			}
		} else if ( isset( $query_args['min_price'] ) ) {
			if ( $old_min_price === $query_args['min_price'][0] && ! $old_max_price ) {
				$atts['checked'] = true;
				unset( $query_args['min_price'] );
			}
		} else if ( isset( $query_args['max_price'] ) ) {
			if ( $old_max_price === $query_args['max_price'][0] && ! $old_min_price ) {
				$atts['checked'] = true;
				unset( $query_args['max_price'] );
			}
		}
	} else {
		if ( in_array( $key_to_query, uncode_get_special_filter_keys() ) ) {
			$key_value = $term;

			if ( $disable_ajax ) {
				if ( $key_to_query === UNCODE_FILTER_KEY_AUTHOR || $key_to_query === UNCODE_FILTER_KEY_DATE ) {
					global $uncode_ajax_filter_query, $uncode_ajax_filter_query_post_type;

					$posts_query = false;
					$post_type   = false;

					if ( ! is_null( $uncode_ajax_filter_query ) ) {
						$posts_query = $uncode_ajax_filter_query;
						$post_type   = $uncode_ajax_filter_query_post_type;
					}

					if ( $posts_query && $post_type ) {
						if ( is_array( $post_type ) && count( $post_type ) === 1 && in_array( 'post', $post_type ) ) {
							if ( $key_to_query === UNCODE_FILTER_KEY_DATE ) {
								$date  = $key_value;
								$year  = false;
								$month = false;

								if ( strpos( $date, '_' ) !== false ) {
									$dates          = explode( '_', $date );
									$date_to_search = $dates[0] . '-' . $dates[1] . '-01';
									$year           = absint( $dates[0] );
									$month          = absint( $dates[1] );
									$valid_date     = uncode_filters_validate_date( $date_to_search );
								} else {
									$date_to_search = $date;
									$year           = absint( $date );
									$valid_date     = uncode_filters_validate_date( $date_to_search, 'Y' );
								}

								if ( $valid_date && $year ) {
									$link = get_month_link( $year, $month );

									if ( is_date() ) {
										$query_year     = get_query_var('year');
										$query_monthnum = get_query_var('monthnum');

										if ( $year === $query_year && $month && $month === $query_monthnum ) {
											$atts['checked'] = true;
										} else if ( $year === $query_year ) {
											$atts['checked'] = true;

										}
									}

									return array(
										$link,
										$atts,
									);
								}
							} else if ( $key_to_query === UNCODE_FILTER_KEY_AUTHOR ) {
								$link = get_author_posts_url( $key_value );

								if ( $link ) {
									if ( is_author( $key_value ) ) {
										$queried_object = get_queried_object();

										if ( ! is_wp_error( $queried_object ) && $queried_object ) {
											if ( isset( $queried_object->ID ) && $queried_object->ID === $key_value ) {
												$atts['checked'] = true;
											}
										}
									}

									return array(
										$link,
										$atts,
									);
								}
							}
						}
					}
				}
			}
		} else {
			$key_value = $term->slug;

			if ( $disable_ajax ) {
				$link = get_term_link( $key_value, $key_to_query );

				if ( ! is_wp_error( $link ) ) {
					if ( is_tax( $key_to_query ) || $key_to_query === 'category' || $key_to_query === 'tag' ) {
						$queried_object = get_queried_object();

						if ( ! is_wp_error( $queried_object ) && $queried_object ) {
							if ( isset( $queried_object->slug ) && $queried_object->slug === $key_value ) {
								$atts['checked'] = true;
							}
						}
					}

					return array(
						$link,
						$atts,
					);
				}
			}

			if ( $is_product_att ) {
				$key_to_query = uncode_get_filter_pa_key( $key_to_query );
			} else {
				if ( ! ( substr( $key_to_query, 0, strlen( UNCODE_FILTER_PREFIX_RELATION ) ) == UNCODE_FILTER_PREFIX_RELATION ) ) {
					$key_to_query = uncode_get_filter_tax_key( $key_to_query );
				}
			}
		}

		if ( isset( $query_args[$key_to_query] ) ) {
			if ( ! apply_filters( 'uncode_filters_sanitize_value', true ) ) {
				$query_args_in_query = $query_args[$key_to_query];
				foreach( $query_args_in_query as $query_args_in_query_key => $query_args_in_query_value ) {
					$query_args_in_query_sanitized_value = sanitize_title( $query_args_in_query_value );

					if ( $key_value === $query_args_in_query_sanitized_value ) {
						$key_value = $query_args_in_query_value;
					}
				}
			}

			// Remove current term if already chosen
			if ( in_array( $key_value, $query_args[$key_to_query] ) ) {
				$taxonomy_values = $query_args[$key_to_query];
				$atts['checked'] = true;

				if ( ( $key = array_search( $key_value, $taxonomy_values ) ) !== false ) {
					unset( $taxonomy_values[$key] );
				}

				$query_args[$key_to_query] = $taxonomy_values;
			} else {
				// Otherwise, add it to the link
				$query_args[$key_to_query][] = $key_value;
			}

			// Single filters
			if ( ! $allow_multiple ) {
				foreach ( $query_args[$key_to_query] as $key => $value ) {
					if ( $value !== $key_value ) {
						unset( $query_args[$key_to_query][$key] );
					}
				}
			}
		} else {
			$query_args[$key_to_query] = array( $key_value );
		}
	}

	if ( $relation === 'and' ) {
		$query_args[UNCODE_FILTER_PREFIX_RELATION . $key_to_query] = 'and';
	}

	$link = uncode_build_filter_link( $link, $query_args );

	return array(
		$link,
		$atts,
	);
}

/**
 * Get query args from GET parameters
 */
function uncode_get_query_args_from_query( $active_filters ) {
	$query_args = array();

	foreach ( $active_filters as $key => $data ) {
		$prefix_pa = 'pa_';

		if ( $key !== UNCODE_FILTER_KEY_RATING && $key !== UNCODE_FILTER_KEY_SEARCH && $key !== UNCODE_FILTER_KEY_AUTHOR && $key !== UNCODE_FILTER_KEY_DATE ) {
			if ( $key === UNCODE_FILTER_KEY_STATUS ) {
				if ( isset( $data['relation'] ) ) {
					$query_args[UNCODE_FILTER_PREFIX_QUERY_TYPE_STATUS] = $data['relation'];
				}
			} else if ( substr( $key, 0, strlen( $prefix_pa ) ) == $prefix_pa ) {
				$key = UNCODE_FILTER_PREFIX_PA . substr( $key, strlen( $prefix_pa ) );

				if ( isset( $data['relation'] ) ) {
					$relation = UNCODE_FILTER_PREFIX_RELATION . $key;
					$query_args[$relation] = $data['relation'];
				}
			} else {
				$key = UNCODE_FILTER_PREFIX_TAX . $key;

				if ( isset( $data['relation'] ) ) {
					$relation = UNCODE_FILTER_PREFIX_RELATION . $key;
					$query_args[$relation] = $data['relation'];
				}
			}
		}

		if ( isset( $data['terms'] ) && is_array( $data['terms'] ) && count( $data['terms'] ) > 0 ) {
			$query_args[$key] = array();

			foreach ( $data['terms'] as $term  ) {
				if ( in_array( $key, uncode_get_special_filter_keys() ) ) {
					$key_value = $term;
				} else {
					$key_value = isset( $term->slug ) && $term->slug ? $term->slug : '';
				}

				$query_args[$key][] = $key_value;
			}
		}
	}

	if ( isset( $_GET['min_price'] ) && $_GET['min_price'] ) {
		$min_price = floatval( $_GET['min_price'] );
		$query_args['min_price'] = $min_price;
	}

	if ( isset( $_GET['max_price'] ) && $_GET['max_price'] ) {
		$max_price = floatval( $_GET['max_price'] );
		$query_args['max_price'] = $max_price;
	}

	if ( isset( $_GET['s'] ) && $_GET['s'] ) {
		$query_args['s'] = $_GET['s'];
	}

	if ( isset( $_GET['post_type'] ) && $_GET['post_type'] ) {
		$query_args['post_type'] = $_GET['post_type'];
	}

	return $query_args;
}

/**
 * Check if a specific taxonomy is the only current filter
 */
function uncode_get_special_filter_keys() {
	$keys = apply_filters(
		'uncode_get_special_filter_keys',
		array(
			's',
			'post_type',
			'min_price',
			'max_price',
			UNCODE_FILTER_KEY_STATUS,
			UNCODE_FILTER_KEY_RATING,
			UNCODE_FILTER_KEY_SEARCH,
			UNCODE_FILTER_KEY_SORTING,
			UNCODE_FILTER_KEY_AUTHOR,
			UNCODE_FILTER_KEY_DATE,
		)
	);

	return $keys;
}

/**
 * Check if a specific taxonomy is the only current filter
 */
function uncode_is_only_current_filter( $taxonomy, $query_args, $tax_source = false ) {
	global $uncode_all_taxonomies;
	global $uncode_all_products_attributes;

	if ( is_null( $uncode_all_taxonomies ) ) {
		$uncode_all_taxonomies = uncode_get_all_taxonomies();
	}

	if ( is_null( $uncode_all_products_attributes ) ) {
		$uncode_all_products_attributes = uncode_get_all_product_attributes();
	}

	if ( ! in_array( $taxonomy, uncode_get_special_filter_keys() ) && $taxonomy !== 'custom_price' ) {
		$is_product_att = $tax_source === 'product_att' ? true : false;
		$taxonomy       = $is_product_att ? uncode_get_filter_pa_key( $taxonomy ) : UNCODE_FILTER_PREFIX_TAX . $taxonomy;
	}

	$all_taxonomies          = array();
	$all_products_attributes = array();

	foreach ( $uncode_all_taxonomies as $value ) {
		$all_taxonomies[] = UNCODE_FILTER_PREFIX_TAX . $value;
	}

	foreach ( $uncode_all_products_attributes as $value ) {
		$all_products_attributes[] = uncode_get_filter_pa_key($value);
	}

	if ( $taxonomy === 'custom_price' ) {
		unset( $query_args['min_price'] );
		unset( $query_args['max_price'] );
	}

	foreach ( $query_args as $query_key => $query_value ) {
		if ( $query_key === $taxonomy ) {
			unset( $query_args[$query_key] );
		}

		// Remove invalid keys from our test, but keep the special ones (status, reviews, etc)
		if ( ! in_array( $query_key, $all_taxonomies ) && ! in_array( $query_key, $all_products_attributes ) && ! in_array( $query_key, uncode_get_special_filter_keys() ) ) {
			unset( $query_args[$query_key] );
		}

		// Ignore orderby
		if ( $query_key === 'orderby' ) {
			unset( $query_args[$query_key] );
		}
	}

	if ( count( $query_args ) > 0 ) {
		return false;
	}

	return true;
}

/**
 * Get query relation of a specific taxonomy
 */
function uncode_get_filters_query_relation( $taxonomy, $query_args, $tax_source = false ) {
	if ( $taxonomy === UNCODE_FILTER_KEY_STATUS ) {
		$relation = UNCODE_FILTER_PREFIX_QUERY_TYPE_STATUS;
	} else {
		$is_product_att = $tax_source === 'product_att' ? true : false;
		$taxonomy       = $is_product_att ? UNCODE_FILTER_PREFIX_PA . $taxonomy : UNCODE_FILTER_PREFIX_TAX . $taxonomy;
		$relation       = UNCODE_FILTER_PREFIX_RELATION . $taxonomy;
	}

	foreach ( $query_args as $query_key => $query_value ) {
		if ( $query_key === $relation && is_array( $query_value ) && in_array( 'and', $query_value ) ) {
			return 'and';
		}
	}

	return 'or';
}

/**
 * Check if a price is in a range of prices
 */
function uncode_filters_is_product_in_price_range( $price, $price_range, $is_variable = false ) {
	if ( $is_variable ) {
		if ( $price_range['min_price'] > 0 && $price_range['max_price'] > 0 ) {
			if ( $price['max_price'] >= $price_range['min_price'] && $price['min_price'] <= $price_range['max_price'] ) {
				return true;
			}
		} else if ( $price_range['max_price'] > 0 ) {
			if ( $price['max_price'] <= $price_range['max_price'] ) {
				return true;
			}
		} else {
			if ( $price['max_price'] >= $price_range['min_price'] ) {
				return true;
			}
		}
	} else {
		if ( $price_range['max_price'] > 0 ) {
			if ( $price >= $price_range['min_price'] && $price <= $price_range['max_price'] ) {
				return true;
			}
		} else {
			if ( $price >= $price_range['min_price'] ) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Check if we are filtering
 */
function uncode_is_filtering() {
	if ( isset( $_GET['unfilter'] ) && $_GET['unfilter'] ) {
		return true;
	}

	return false;
}

/**
 * Get params values from _GET
 */
function uncode_filters_get_query_string_value( $tax_to_query ) {
	if ( isset( $_GET ) ) {
		foreach ( $_GET as $key => $value ) {
			$value             = str_replace( '%2C', ',', urlencode( sanitize_text_field( wp_unslash( $value ) ) ) );
			$selected_term_ids = array();
			$selected_terms    = explode( ',', $value );

			if ( $key === UNCODE_FILTER_KEY_STATUS && $tax_to_query === $key ) {
				return $selected_terms;
			} else if ( $key === UNCODE_FILTER_KEY_RATING && $tax_to_query === $key ) {
				return $selected_terms;
			} else if ( $key === UNCODE_FILTER_KEY_AUTHOR && $tax_to_query === $key ) {
				return $selected_terms;
			} else if ( $key === UNCODE_FILTER_KEY_DATE && $tax_to_query === $key ) {
				return $selected_terms;
			} else if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_PA ) ) == UNCODE_FILTER_PREFIX_PA ) {
				$taxonomy = 'pa_' . substr( $key, strlen( UNCODE_FILTER_PREFIX_PA ) );
				if ( $tax_to_query === $taxonomy ) {
					return $selected_terms;
				}
			} else if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_TAX ) ) == UNCODE_FILTER_PREFIX_TAX ) {
				$taxonomy = substr( $key, strlen( UNCODE_FILTER_PREFIX_TAX ) );
				if ( $tax_to_query === $taxonomy ) {
					return $selected_terms;
				}
			}
		}
	}

	return false;
}

/**
 * Get clear all URL
 */
function uncode_filters_get_clear_all_url() {
	$url = uncode_get_current_url();
	$query_args = array();

	if ( isset( $_GET['s'] ) && $_GET['s'] ) {
		$query_args['s'] = $_GET['s'];

		if ( isset( $_GET['post_type'] ) && $_GET['post_type'] ) {
			$query_args['post_type'] = $_GET['post_type'];
		}
	}

	if ( count( $query_args ) > 0 ) {
		$url = add_query_arg( $query_args, $url );
	}

	$url = apply_filters( 'uncode_filters_get_clear_all_url', $url );

	return $url;
}

/**
 * Loop the query to find the search type
 */
function uncode_filters_get_search_type() {
	global $uncode_ajax_filter_query;
	global $uncode_ajax_filter_query_unfiltered;

	$posts_query = false;
	$post_types  = array();

	if ( ! is_null( $uncode_ajax_filter_query_unfiltered ) && $uncode_ajax_filter_query_unfiltered instanceof WP_Query ) {
		$posts_query = $uncode_ajax_filter_query_unfiltered;
	}

	if ( $posts_query && $posts_query instanceof WP_Query ) {
		while ( $posts_query->have_posts() ) {
			$posts_query->the_post();

			$post_type    = get_post_type();
			$post_types[] = $post_type;
		}
	}

	$post_types = array_unique( $post_types );

	if ( count( $post_types ) === 1 && in_array( 'product', $post_types ) ) {
		return 'product';
	} else {
		return 'mixed';
	}
}

/**
 * Function that get the label of an author filter
 */
function uncode_filters_get_author_label( $user_id ) {
	$label = '';
	$user  = get_user_by( 'ID', $user_id );

	if ( $user && isset( $user->display_name ) ) {
		$label = $user->display_name;
	}

	return $label;
}

/**
 * Function that get the label of a date filter
 */
function uncode_filters_get_date_label( $date ) {
	$label          = '';
	$valid_date     = false;
	$date_to_search = false;
	$date_format    = 'Y';

	if ( strpos( $date, '_' ) !== false ) {
		$dates          = explode( '_', $date );
		$date_to_search = $dates[0] . '-' . $dates[1] . '-01';
		$valid_date     = uncode_filters_validate_date( $date_to_search );
		$date_format    = 'F Y';
	} else {
		$date_to_search = $date;
		$valid_date     = uncode_filters_validate_date( $date_to_search, 'Y' );

		if ( $valid_date ) {
			$date_to_search = $date_to_search . '-01-01';
		}
	}

	if ( $valid_date && $date_to_search ) {
		$datetime = new DateTime( $date_to_search );
		$label    = wp_date( $date_format, $datetime->getTimestamp() );
	}

	return $label;
}

/**
 * Function that validates a date
 */
function uncode_filters_validate_date( $date, $format = 'Y-m-d' ) {
    $d = DateTime::createFromFormat( $format, $date );
    return $d && $d->format( $format ) == $date;
}
