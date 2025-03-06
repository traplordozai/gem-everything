<?php
/**
 * Ajax Filters views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Alter the loop query options adding the dynamic ($_GET) data
 */
function uncode_index_query_options_add_filters( $query_options = array() ) {
	$query_options    = is_array( $query_options ) ? $query_options : array();
	$filters_query    = array();

	if ( isset( $_GET ) && is_array( $_GET ) ) {
		ksort( $_GET );

		foreach ( $_GET as $key => $value ) {
			if ( apply_filters( 'uncode_filters_sanitize_value', true ) ) {
				$value = str_replace( '%2C', ',', urlencode( sanitize_text_field( wp_unslash( $value ) ) ) );
			} else {
				$value = str_replace( '%2C', ',', sanitize_text_field( wp_unslash( $value ) ) );
			}

			$selected_term_ids = array();
			$selected_terms    = explode( ',', $value );

			asort( $selected_terms );

			if ( $key === UNCODE_FILTER_KEY_STATUS ) {
				$filters_query = uncode_add_terms_to_filters_query( $filters_query, $selected_terms, $key );
			} else if ( $key === UNCODE_FILTER_PREFIX_QUERY_TYPE_STATUS ) {
				$filters_query[UNCODE_FILTER_KEY_STATUS]['relation'] = $value;
			} else if ( $key === UNCODE_FILTER_KEY_RATING ) {
				$filters_query = uncode_add_terms_to_filters_query( $filters_query, $selected_terms, $key );
			} else if ( $key === UNCODE_FILTER_KEY_AUTHOR ) {
				$filters_query = uncode_add_terms_to_filters_query( $filters_query, $selected_terms, $key );
			} else if ( $key === UNCODE_FILTER_KEY_DATE ) {
				$filters_query = uncode_add_terms_to_filters_query( $filters_query, $selected_terms, $key );
			} else if ( $key === UNCODE_FILTER_KEY_SEARCH ) {
				$filters_query = uncode_add_terms_to_filters_query( $filters_query, $selected_terms, $key );
			} else if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_STATUS ) ) == UNCODE_FILTER_PREFIX_QUERY_TYPE_STATUS ) {
				// Product status relation
				$filters_query[$key]['relation'] = $value;
			} else if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_PA ) ) == UNCODE_FILTER_PREFIX_QUERY_TYPE_PA ) {
				// Product attribute relation
				$taxonomy = 'pa_' . substr( $key, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_PA ) );
				$filters_query[$taxonomy]['relation'] = $value;
			} else if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX ) ) == UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX ) {
				// Regular taxonomy relation
				$taxonomy = substr( $key, strlen( UNCODE_FILTER_PREFIX_QUERY_TYPE_TAX ) );
				$filters_query[$taxonomy]['relation'] = $value;
			} else if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_PA ) ) == UNCODE_FILTER_PREFIX_PA ) {
				// Product attribute
				$taxonomy = 'pa_' . substr( $key, strlen( UNCODE_FILTER_PREFIX_PA ) );
				if ( taxonomy_exists( $taxonomy ) ) {
					$selected_terms_values = uncode_get_terms_from_slugs( $taxonomy, $selected_terms );
					$filters_query = uncode_add_terms_to_filters_query( $filters_query, $selected_terms_values, $taxonomy );
				}
			} else if ( substr( $key, 0, strlen( UNCODE_FILTER_PREFIX_TAX ) ) == UNCODE_FILTER_PREFIX_TAX ) {
				// Regular taxonomy
				$taxonomy = substr( $key, strlen( UNCODE_FILTER_PREFIX_TAX ) );
				if ( taxonomy_exists( $taxonomy ) ) {
					$selected_terms_values = uncode_get_terms_from_slugs( $taxonomy, $selected_terms );
					$filters_query = uncode_add_terms_to_filters_query( $filters_query, $selected_terms_values, $taxonomy );
				}
			}
		}
	}

	if ( is_array( $filters_query ) && ! empty( $filters_query ) ) {
		$query_options['filters_query'] = $filters_query;
	}

	return $query_options;
}
add_filter( 'uncode_index_query_options', 'uncode_index_query_options_add_filters' );

/**
 * Add terms to the filters query
 */
function uncode_add_terms_to_filters_query( $filters_query, $selected_terms, $key ) {
	if ( is_array( $selected_terms ) && count( $selected_terms ) > 0 ) {
		if ( is_array( $filters_query ) && isset( $filters_query[$key] ) && isset( $filters_query[$key]['terms'] ) ) {
			$filters_query[$key]['terms'] = array_merge( $selected_terms, $filters_query[$key]['terms'] );
		} else {
			$filters_query[$key]['terms'] = $selected_terms;
		}
	}

	return $filters_query;
}

/**
 * Get terms from slugs
 */
function uncode_get_terms_from_slugs( $taxonomy, $slugs ) {
	$terms = array();

	foreach ( $slugs as $slug ) {
		$term = get_term_by( 'slug', $slug, $taxonomy );

		if ( ! is_wp_error( $term ) && $term ) {
			$terms[$term->term_id] = $term;
		}
	}

	return $terms;
}

/**
 * Filter Uncode Index query args and pass terms filters
 */
function uncode_filter_uncode_index_args( $args, $query_options ) {
	if ( is_array( $query_options ) && isset( $query_options['has_filters'] ) && $query_options['has_filters'] && isset( $query_options['filters_query'] ) && is_array( $query_options['filters_query'] ) ) {
		// Return early to get the query without filters
		if ( isset( $query_options['no_filters'] ) && $query_options['no_filters'] ) {
			return $args;
		}

		$filters_query = $query_options['filters_query'];

		foreach ( $filters_query as $key => $filter_args ) {
			if ( $key === UNCODE_FILTER_KEY_STATUS && class_exists( 'WooCommerce' ) ) {
				$values = isset( $filter_args['terms'] ) && is_array( $filter_args['terms'] ) ? $filter_args['terms'] : array();
				$ids_on_sale = wc_get_product_ids_on_sale();

				foreach ( $values as $value ) {
					$product_ids = array();

					foreach ( $ids_on_sale as $id ) {
						$product = wc_get_product( $id );

						if ( is_a( $product, 'WC_Product' ) ) {
							if ( isset( $query_options['single_variations'] ) && $query_options['single_variations'] && $product->get_type() === 'variation' ) {
								$product_ids[] = $id;
							}

							$parent_id = $product->get_parent_id();

							if ( $parent_id > 0 ) {
								$product_ids[] = $parent_id;
							} else {
								$product_ids[] = $id;
							}
						}
					}

					$product_ids = array_unique( $product_ids );

					if ( $value === 'sale' ) {
						if ( isset( $args['post__in'] ) && is_array( $args['post__in'] ) ) {
							$args['post__in'] = array_merge( $args['post__in'], $product_ids );
						} else {
							$args['post__in'] = $product_ids;
						}
					} else if ( $value === 'instock' ) {
						$args[ 'tax_query' ][] = array(
							'taxonomy' => 'product_visibility',
							'field'    => 'name',
							'terms'    => 'outofstock',
							'operator' => 'NOT IN'
						);
					}
				}
			} else if ( $key === UNCODE_FILTER_KEY_RATING && class_exists( 'WooCommerce' ) ) {
				$values = isset( $filter_args['terms'] ) && is_array( $filter_args['terms'] ) ? $filter_args['terms'] : array();

				$args['meta_query']['relation'] = 'OR';

				foreach ( $values as $value ) {
					$value = absint( $value );
					$args['meta_query'][] = array(
						'key'     => '_wc_average_rating',
						'value'   => array( $value - 0.5, $value + 0.5),
						'compare' => 'BETWEEN',
						'type' => 'DECIMAL'
					);
				}
			} else if ( $key === UNCODE_FILTER_KEY_SEARCH ) {
				$values = isset( $filter_args['terms'] ) && is_array( $filter_args['terms'] ) ? $filter_args['terms'] : array();
				$search_key = isset( $values[0] ) ? $values[0] : false;

				if ( $search_key ) {
					$args['s'] = sanitize_text_field( $search_key );
				}
			} else if ( $key === UNCODE_FILTER_KEY_AUTHOR ) {
				$values = isset( $filter_args['terms'] ) && is_array( $filter_args['terms'] ) ? $filter_args['terms'] : array();
				$author_id = isset( $values[0] ) ? absint( $values[0] ) : false;
				$args['author'] = $author_id;
			} else if ( $key === UNCODE_FILTER_KEY_DATE ) {
				$values = isset( $filter_args['terms'] ) && is_array( $filter_args['terms'] ) ? $filter_args['terms'] : array();
				$date   = isset( $values[0] ) ? $values[0] : false;
				$year   = false;
				$month  = false;

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

				if ( $valid_date ) {
					if ( $year ) {
						$args['year'] = $year;
					}

					if ( $month ) {
						$args['monthnum'] = $month;
					}
				}
			} else if ( taxonomy_exists( $key ) ) {
				$terms    = isset( $filter_args['terms'] ) && is_array( $filter_args['terms'] ) ? array_keys( $filter_args['terms'] ) : array();
				$operator = isset( $filter_args['relation'] ) && $filter_args['relation'] === 'and' ? 'AND' : 'IN';

				if ( isset( $filter_args['relation'] ) && $filter_args['relation'] === 'and' ) {
					foreach ( $terms as $term_id ) {
						$tax_query = array(
							'field'    => 'term_id',
							'taxonomy' => $key,
							'terms'    => $term_id,
							'operator' => 'IN',
						);

						$args['tax_query'][] = $tax_query;
					}
				} else {
					$tax_query = array(
						'field'    => 'term_id',
						'taxonomy' => $key,
						'terms'    => $terms,
						'operator' => 'IN',
					);

					$args['tax_query'][] = $tax_query;
				}

				$is_product_tax = $key === 'product_cat' || $key === 'product_tag' || substr( $key, 0, strlen( 'pa_' ) ) == 'pa_';

				if ( ! $is_product_tax ) {
					$args['tax_query']['relation'] = 'IN';
				}
			}
		}

		if ( apply_filters( 'uncode_filter_fix_archive_tax_and_query', true ) && is_tax() && ! is_product_category() && ! is_product_tag() ) {
			$args['tax_query']['relation'] = 'AND';
		}
	}

	return $args;
}
add_filter( 'uncode_get_uncode_index_args_for_filters', 'uncode_filter_uncode_index_args', 10, 2 );

/**
 * Fix WooCommerce chosen query type
 */
function uncode_filter_woocommerce_layered_nav_default_query_type( $query_type, $taxonomy, $data ) {
	$query_type = 'IN';
	$filter_tax = uncode_get_filter_pa_key( $taxonomy );

	if ( ! apply_filters( 'uncode_filter_multiple_relation_disable_and_query_type', true ) ) {
		if ( isset( $_GET ) && is_array( $_GET ) ) {
			if ( isset( $_GET[ $filter_tax ] ) ) {
				if ( isset( $_GET[ UNCODE_FILTER_PREFIX_RELATION . $filter_tax ] ) ) {
					$operator = $_GET[ UNCODE_FILTER_PREFIX_RELATION . $filter_tax ];

					if ( $operator === 'and' ) {
						$query_type = 'AND';
					}
				}
			}
		}
	}

	return $query_type;
}

/**
 * Fix WooCommerce chosen query type in archives
 */
function uncode_filter_woocommerce_layered_nav_default_query_type_filter( $query_type ) {
	if ( apply_filters( 'uncode_filter_multiple_relation_disable_and_query_type', true ) && isset( $_GET[UNCODE_FILTER_PREFIX] ) ) {
		$query_type = 'or';
	}

	return $query_type;
}
add_filter( 'woocommerce_layered_nav_default_query_type', 'uncode_filter_woocommerce_layered_nav_default_query_type_filter' );
