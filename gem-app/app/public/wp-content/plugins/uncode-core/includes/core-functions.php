<?php
/**
 * Shared functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Safe unserialize() replacement
 * - accepts a strict subset of PHP's native serialized representation
 * - does not unserialize objects
 *
 * @see  https://github.com/matomo-org/matomo/blob/master/libs/upgradephp/upgrade.php
 *
 * @param string $str
 * @return mixed
 * @throw Exception if $str is malformed or contains unsupported types (e.g., resources, objects)
 */
function _uncode_core_safe_unserialize( $str ) {

	if ( empty( $str ) || !is_string( $str ) ) {
		return false;
	}

	$stack = array();
	$expected = array();

	/*
	 * states:
	 *   0 - initial state, expecting a single value or array
	 *   1 - terminal state
	 *   2 - in array, expecting end of array or a key
	 *   3 - in array, expecting value or another array
	 */
	$state = 0;
	while ( $state != 1 ) {
		$type = isset($str[0]) ? $str[0] : '';

		if ($type == '}') {
			$str = substr($str, 1);
		} else if ($type == 'N' && $str[1] == ';') {
			$value = null;
			$str = substr($str, 2);
		} else if ($type == 'b' && preg_match('/^b:([01]);/', $str, $matches)) {
			$value = $matches[1] == '1' ? true : false;
			$str = substr($str, 4);
		} else if ($type == 'i' && preg_match('/^i:(-?[0-9]+);(.*)/s', $str, $matches)) {
			$value = (int)$matches[1];
			$str = $matches[2];
		} else if ($type == 'd' && preg_match('/^d:(-?[0-9]+\.?[0-9]*(E[+-][0-9]+)?);(.*)/s', $str, $matches)) {
			$value = (float)$matches[1];
			$str = $matches[3];
		} else if ($type == 's' && preg_match('/^s:([0-9]+):"(.*)/s', $str, $matches) && substr($matches[2], (int)$matches[1], 2) == '";') {
			$value = substr($matches[2], 0, (int)$matches[1]);
			$str = substr($matches[2], (int)$matches[1] + 2);
		} else if ($type == 'a' && preg_match('/^a:([0-9]+):{(.*)/s', $str, $matches)) {
			$expectedLength = (int)$matches[1];
			$str = $matches[2];
		} else {
			// object or unknown/malformed type
			return false;
		}

		switch($state) {
			case 3: // in array, expecting value or another array
				if ($type == 'a') {
					$stack[] = &$list;
					$list[$key] = array();
					$list = &$list[$key];
					$expected[] = $expectedLength;
					$state = 2;
					break;
				}
				if ($type != '}') {
					$list[$key] = $value;
					$state = 2;
					break;
				}

				// missing array value
				return false;

			case 2: // in array, expecting end of array or a key
				if ($type == '}') {
					if (count($list) < end($expected)) {
						// array size less than expected
						return false;
					}

					unset($list);
					$list = &$stack[count($stack)-1];
					array_pop($stack);

					// go to terminal state if we're at the end of the root array
					array_pop($expected);
					if (count($expected) == 0) {
						$state = 1;
					}
					break;
				}
				if ($type == 'i' || $type == 's') {
					if (count($list) >= end($expected)) {
						// array size exceeds expected length
						return false;
					}

					$key = $value;
					$state = 3;
					break;
				}

				// illegal array index type
				return false;

			case 0: // expecting array or value
				if ($type == 'a') {
					$data = array();
					$list = &$data;
					$expected[] = $expectedLength;
					$state = 2;
					break;
				}
				if ($type != '}') {
					$data = $value;
					$state = 1;
					break;
				}

				// not in array
				return false;
		}
	}

	if (!empty($str)) {
		// trailing data in input
		return false;
	}
	return $data;
}

/**
 * Wrapper for _uncode_core_safe_unserialize() that handles exceptions and multibyte encoding issue
 *
 * @see  https://github.com/matomo-org/matomo/blob/master/libs/upgradephp/upgrade.php
 *
 * @param string $str
 * @return mixed
 */
function uncode_core_safe_unserialize( $str ) {
	// ensure we use the byte count for strings even when strlen() is overloaded by mb_strlen()
	if (function_exists('mb_internal_encoding') && (((int) ini_get('mbstring.func_overload')) & 2)) {
		$mbIntEnc = mb_internal_encoding();
		mb_internal_encoding('ASCII');
	}

	$out = _uncode_core_safe_unserialize($str);

	if (isset($mbIntEnc)) {
		mb_internal_encoding($mbIntEnc);
	}
	return $out;
}

/**
 * Wrapper for base64_encode
 */
function uncode_core_encode( $data ) {
	return base64_encode( $data );
}

/**
 * Wrapper for base64_decode
 */
function uncode_core_decode( $data ) {
	$data = base64_decode( $data );

	if ( apply_filters( 'uncode_core_decode_iso_strings', false ) ) {
		$data = mb_convert_encoding( $data, 'UTF-8', 'ISO-8859-1' );
	}

	return $data;
}

/**
 * Check if we have a valid license of Uncode
 * making a call to our API
 */
function uncode_core_is_registered() {
	if ( function_exists( 'uncode_get_purchase_code' ) && function_exists( 'uncode_api_check_response' ) ) {
		$purchase_code = uncode_get_purchase_code();

		if ( ! $purchase_code ) {
			return false;
		}

		$response = wp_remote_post( 'https://api.undsgn.com/uncode-license/validate-license.php',
			array(
				'timeout'    => 45
		) );

		$response_code = uncode_api_check_response( $response );

		if ( $response_code !== 3 ) {
			return false;
		} else {
			return true;
		}
	}

	return false;
}

/**
 * Wrapper for wp_calculate_image_srcset
 */
function uncode_calc_img_srcset( $srcset_point, $img_url, $img_data, $get_media_id ) {
	return wp_calculate_image_srcset( $srcset_point, $img_url, $img_data, $get_media_id );
}

/**
 * Get all registered and public taxonomies
 */
if ( ! function_exists( 'uncode_get_registered_taxonomies' ) ) :
	function uncode_get_registered_taxonomies() {
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
 * Create a dropdown for the posts module with all the registered categories
 */
if ( ! function_exists( 'uncode_get_taxonomies_for_posts_module' ) ) :
	function uncode_get_taxonomies_for_posts_module() {
		$taxonomies = array();
		$registered_taxonomies = uncode_get_registered_taxonomies();

		foreach ( $registered_taxonomies as $taxonomy_key => $taxonomy_value ) {
			$taxonomies[] = array( $taxonomy_key, $taxonomy_value );
		}

		return $taxonomies;
	}
endif;

/**
 * Get all registered and public taxonomies
 */
if ( ! function_exists( 'uncode_core_get_all_registered_taxonomies' ) ) :
	function uncode_core_get_all_registered_taxonomies() {
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
 * Create a dropdown for the ajax filter with all the registered categories
 */
if ( ! function_exists( 'uncode_core_get_taxonomies_for_ajax_filter' ) ) :
	function uncode_core_get_taxonomies_for_ajax_filter() {
		$all_taxonomies = array();
		$registered_taxonomies = uncode_core_get_all_registered_taxonomies();

		foreach ( $registered_taxonomies as $taxonomy_key => $taxonomy_value ) {
			$all_taxonomies[$taxonomy_value] = $taxonomy_key;
		}

		return $all_taxonomies;
	}
endif;

/**
 * Create a dropdown for the ajax filter with all the product attributes
 */
if ( ! function_exists( 'uncode_core_get_product_attributes_for_ajax_filter' ) ) :
	function uncode_core_get_product_attributes_for_ajax_filter() {
		$all_products_attributes = array();

		if ( class_exists( 'WooCommerce' ) ) {
			$attribute_taxonomies = wc_get_attribute_taxonomies();

			if ( $attribute_taxonomies ) {
				foreach ( $attribute_taxonomies as $tax ) {
					$attr_key   = wc_attribute_taxonomy_name( $tax->attribute_name );
					$attr_label = wc_attribute_label( $attr_key ) . ' (ID:' . $tax->attribute_id . ')';
					$all_products_attributes[$attr_label] = $attr_key;
				}
			}
		}

		return $all_products_attributes;
	}
endif;

/**
 * Wrapper for remove_filter
 */
function uncode_core_unhook( $tag, $hook, $priority = 10, $args = 1 ) {
	remove_filter( $tag, $hook, $priority, $args );
}

/**
 * Wrapper for add_filter
 */
function uncode_core_addhook( $tag, $hook, $priority = 10, $args = 1 ) {
	add_filter( $tag, $hook, $priority, $args );
}

/**
 * Generate SVG on demand
 */
function uncode_core_get_srcset_placeholder_svg( $width, $height ) {
	$svg = '<svg width="' . $width . '" height="' . $height . '" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h1v1H0z" fill="none" fill-rule="evenodd"/></svg>';
	$svg = 'data:image/svg+xml;base64,' . base64_encode( $svg );

	return $svg;
}

/**
 * Check validity of purchase code.
 */
function uncode_core_check_valid_purchase_code() {
	$is_valid      = true;
	$purchase_code = trim( get_option( 'envato_purchase_code_13373220', false ) );

	if ( $purchase_code && ! preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $purchase_code ) ) {
		$is_valid = false;
	}

	return $is_valid;
}

/**
 * Filter ai-uncode script.
 */
add_filter( 'script_loader_tag','uncode_unclean_url',10,3 );
