<?php
/**
 * Taxonomy related functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'uncode_get_legacy_taxonomies' ) ) :
/**
 * @since Uncode 2.3.0
 */
function uncode_get_legacy_taxonomies() {
	$legacy_taxonomies = array(
		'category',
		'post_tag',
		'product_cat',
		'product_tag',
		'portfolio_category',
	);

	$cpt_taxonomies = apply_filters( 'uncode_additional_custom_taxes', array() );
	$legacy_taxonomies       = array_merge( $legacy_taxonomies, $cpt_taxonomies );
	$attributes_with_archive = uncode_get_all_product_attributes_with_archive();
	$legacy_taxonomies       = array_merge( $legacy_taxonomies, $attributes_with_archive );

	return $legacy_taxonomies;
}
endif;//uncode_get_legacy_taxonomies

if ( ! function_exists( 'uncode_get_legacy_taxonomy_cpt_labels' ) ) :
/**
 * @since Uncode 2.3.0
 */
function uncode_get_legacy_taxonomy_cpt_label( $tax, $count ) {
	switch ( $tax ) {
		case 'category':
		case 'post_tag':
			$label = $count !== 1 ? __( 'Posts', 'uncode' ) : __( 'Post', 'uncode' );
			break;

		case 'portfolio_category':
			$label = __( 'Portfolio', 'uncode' );
			break;

		case 'product_cat':
		case 'product_tag':
			$label = $count !== 1 ? __( 'Products', 'uncode' ) : __( 'Product', 'uncode' );
			break;

		default:
			$label = $count !== 1 ? __( 'Items', 'uncode' ) : __( 'Item', 'uncode' );
			break;
	}

	if ( in_array( $tax, uncode_get_all_product_attributes_with_archive() ) ) {
		$label = $count !== 1 ? __( 'Products', 'uncode' ) : __( 'Product', 'uncode' );
	}

	$label = apply_filters( 'uncode_posts_module_tax_query_items_label', $label, $tax, $count );

	return $label;
}
endif;//uncode_get_legacy_taxonomy_cpt_labels

/**
 * Get all registered and public taxonomies
 */
if ( ! function_exists( 'uncode_get_all_registered_taxonomies' ) ) :
	function uncode_get_all_registered_taxonomies() {
		$taxonomies = array();

		$args = array(
			'public' => true,
		);

		$all_taxonomies = get_taxonomies( $args, 'objects' );

		foreach ( $all_taxonomies as $taxonomy_key => $taxonomy_object ) {
			if ( $taxonomy_object->show_ui ) {
				$taxonomy_label = ucwords( $taxonomy_object->label );

				if ( isset( $taxonomy_object->object_type[0] ) ) {
					$taxonomy_label .= ' (' . ucfirst( $taxonomy_object->object_type[0] . ')' );
				}

				$taxonomies[ $taxonomy_key ] = $taxonomy_label;
			}
		}

		$taxonomies = apply_filters( 'uncode_get_registered_taxonomies', $taxonomies );

		return $taxonomies;
	}
endif;

/**
 * Get all registered categories
 */
if ( ! function_exists( 'uncode_get_all_taxonomies' ) ) :
	function uncode_get_all_taxonomies() {
		global $uncode_all_taxonomies;

		$uncode_all_taxonomies = array();
		$registered_taxonomies = uncode_get_all_registered_taxonomies();

		foreach ( $registered_taxonomies as $taxonomy_key => $taxonomy_value ) {
			$uncode_all_taxonomies[] = $taxonomy_key;
		}

		return $uncode_all_taxonomies;
	}
endif;

/**
 * Get all registered product attributes
 */
if ( ! function_exists( 'uncode_get_all_product_attributes' ) ) :
	function uncode_get_all_product_attributes() {
		global $uncode_all_products_attributes;

		$uncode_all_products_attributes = array();

		if ( class_exists( 'WooCommerce' ) ) {
			$attribute_taxonomies = wc_get_attribute_taxonomies();

			if ( $attribute_taxonomies ) {
				foreach ( $attribute_taxonomies as $tax ) {
					$attr_key   = wc_attribute_taxonomy_name( $tax->attribute_name );
					$uncode_all_products_attributes[] = $attr_key;
				}
			}
		}

		return $uncode_all_products_attributes;
	}
endif;

/**
 * Get all product attributes with archives
 */
if ( ! function_exists( 'uncode_get_all_product_attributes_with_archive' ) ) :
	function uncode_get_all_product_attributes_with_archive() {
		$attributes_with_archive = array();

		if ( class_exists( 'WooCommerce' ) ) {
			$attribute_taxonomies = wc_get_attribute_taxonomies();

			if ( $attribute_taxonomies ) {
				foreach ( $attribute_taxonomies as $tax ) {
					if ( $tax->attribute_public === 1 ) {
						$attributes_with_archive[] = wc_attribute_taxonomy_name( $tax->attribute_name );
					}
				}
			}
		}

		return $attributes_with_archive;
	}
endif;

/**
 * Get term count, shown in Posts Module
 */
if ( ! function_exists( 'uncode_get_posts_element_term_count' ) ) :
	function uncode_get_posts_element_term_count( $block_data, $value ) {
		global $uncode_query_options;

		$count = false;

		if ( is_array( $uncode_query_options ) && isset( $uncode_query_options['single_variations'] ) ) {
			if ( isset( $uncode_query_options['single_variations_hide_parent'] ) && $uncode_query_options['single_variations_hide_parent'] ) {
				$terms_count = get_option( 'uncode_terms_hidden_parent_count' );
			} else {
				$terms_count = get_option( 'uncode_terms_all_count' );
			}

			$term_count = isset( $terms_count[$block_data['id']] ) ? $terms_count[$block_data['id']] : false;
		} else {
			$term       = get_term( $block_data['id'] );
			$term_count = isset( $term->count ) ? absint( $term->count ) : false;
		}

		if ( $term_count !== false ) {
			if (isset($value[0]) && $value[0] === 'bordered') {
				$border_count = true;
			} else {
				$border_count = false;
			}

			if (isset($value[0]) && $value[0] === 'colorbg') {
				$colorbg = true;
			} else {
				$colorbg = false;
			}

			if (isset($value[0]) && $value[0] === 'transparentbg') {
				$transparentbg = true;
			} else {
				$transparentbg = false;
			}

			if (isset($value[0]) && $value[0] === 'yesbg') {
				$with_bg = true;
			} else {
				$with_bg = false;
			}

			$count_text = $term_count;
			$has_label = false;

			if ( isset($value[2]) && $value[2] === 'show-label' ) {
				$tax_queried = isset( $block_data['tax_queried'] ) && $block_data['tax_queried'] ? $block_data['tax_queried'] : false;

				if ( $tax_queried ) {
					$has_label = true;
					$count_text .= ' ' . uncode_get_legacy_taxonomy_cpt_label( $tax_queried, $term_count );
				}
			}

			$count_link = '<span class="t-entry-cat-single t-entry-count"><span>' . $count_text . '</span></span>';

			$term_color = get_option( '_uncode_taxonomy_' . $block_data['id'] );
			if (isset($term_color['term_color']) && $term_color['term_color'] !== '' && $with_bg) {
				$term_color = 'text-' . $term_color['term_color'] . '-color';
			} elseif ( $colorbg ) {
				if ( isset($term_color['term_color']) && $term_color['term_color'] !== '' ) {
					$term_color_id = $term_color['term_color'];
				} else {
					$term_color_id = 'accent';
				}
				$term_color = 'style-' . $term_color_id . '-bg tmb-term-evidence font-ui';
			} elseif ( $transparentbg ) {
				$term_color = 'transparent-cat tmb-term-evidence font-ui';
			} elseif ( $border_count ) {
				$term_color = 'bordered-cat tmb-term-evidence font-ui';
			}

			if ( !is_array($term_color) ) {
				$term_color .= $has_label ? ' with-label' : ' no-label';
				$count_link = str_replace('<span>', '<span class="'.$term_color.'">', $count_link);
			}

			$count = $count_link;
		}

		return $count;
	}
endif;
