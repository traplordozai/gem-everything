<?php
/**
 * Product Gallery functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Get product gallery settings from Theme Options and Page Options
 * (both WC default and Uncode custom galleries)
 */
function uncode_woocommerce_get_product_gallery_settings() {
	static $settings = '';

	if ( '' !== $settings ) {
		return $settings;
	}

	// Theme Options settings
	$generic_layout     = ot_get_option( '_uncode_product_image_layout' );
	$generic_layout     = $generic_layout === 'stack' || $generic_layout === 'grid' ? $generic_layout : 'standard';
	$generic_columns    = absint( ot_get_option( '_uncode_product_thumb_cols' ) );
	$generic_columns    = $generic_columns ? $generic_columns : 3;
	$generic_columns    = $generic_layout === 'stack' || $generic_layout === 'grid' ? 1 : $generic_columns;
	$generic_zoom       = $generic_layout === 'stack' || $generic_layout === 'grid' ? false : ot_get_option( '_uncode_product_enable_zoom' );
	$generic_zoom       = $generic_zoom === 'on' ? true : false;
	$generic_flexslider = $generic_layout === 'stack' || $generic_layout === 'grid' ? false : true;
	$generic_lightbox   = $generic_layout === 'stack' || $generic_layout === 'grid' ? false : true;

	$post_id = 0;

	if ( function_exists( 'is_product' ) && is_product() ) {
		global $post;
		$post_id = $post->ID;
	}

	// Allow third-party plugins to filter the product ID
	$post_id = apply_filters( 'uncode_woocommerce_get_default_product_gallery_settings_post_id', $post_id );

	if ( $post_id > 0 ) {
		// Get an array that contains all the raw content attached to the page
		$content_array = uncode_get_post_data_content_array();

		$module_found = false;

		// Init settings
		$module_layout     = 'standard';
		$module_columns    = 3;
		$module_zoom       = true;
		$module_flexslider = true;
		$module_lightbox   = true;

		foreach ( $content_array as $content ) {
			if ( strpos( $content, '[uncode_single_product_gallery' ) !== false ) {
				$module_found = true;

				// Check shortcodes
				$regex = '/\[uncode_single_product_gallery(.*?)\]/';
				preg_match_all( $regex, $content, $product_galleries, PREG_SET_ORDER );

				foreach ( $product_galleries as $key => $product_gallery ) {
					if ( is_array( $product_gallery ) &&  isset( $product_gallery[1] ) ) {
						$regex_attr = '/(.*?)=\"(.*?)\"/';
						preg_match_all( $regex_attr, trim( $product_gallery[1] ), $product_gallery_atts, PREG_SET_ORDER );

						if ( is_array( $product_gallery_atts ) ) {
							foreach ( $product_gallery_atts as $key_attr => $value_attr ) {
								if ( isset( $value_attr[1] ) && isset( $value_attr[2] ) ) {
									switch ( trim( $value_attr[1] ) ) {
										case 'layout':
											$module_layout = $value_attr[2] === 'stack' || $value_attr[2] === 'grid' ? $value_attr[2] : $module_layout;
											break;

										case 'zoom':
											$module_zoom = $value_attr[2] === 'yes' ? false : $module_zoom;
											break;

										case 'columns':
											$module_columns = absint( $value_attr[2] );
											break;
									}
								}
							}
						}

						break;
					}
				}
			}
		}

		if ( $module_found ) {
			$module_layout     = $module_layout === 'stack' || $module_layout === 'grid' ? $module_layout : 'standard';
			$module_columns    = $module_columns ? $module_columns : 3;
			$module_columns    = $module_layout === 'stack' || $module_layout === 'grid' ? 1 : $module_columns;
			$module_zoom       = $module_layout === 'stack' || $module_layout === 'grid' ? false : $module_zoom;
			$module_flexslider = $module_layout === 'stack' || $module_layout === 'grid' ? false : true;
			$module_lightbox   = $module_layout === 'stack' || $module_layout === 'grid' ? false : true;

			// Pass values
			$generic_layout     = $module_layout;
			$generic_columns    = $module_columns;
			$generic_zoom       = $module_zoom;
			$generic_flexslider = $module_flexslider;
			$generic_lightbox   = $module_lightbox;

		} else {

			// Layout
			$specific_layout = get_post_meta( $post_id, '_uncode_product_image_layout', true );
			if ( $specific_layout === 'std' ) {
				$specific_layout = 'standard';
			} else if ( $specific_layout === '' ) {
				$specific_layout = $generic_layout;
			}

			// Columns
			$specific_columns = get_post_meta( $post_id, '_uncode_thumb_cols', true );

			if ( $specific_layout === 'standard' ) {
				if ( $specific_columns === '' ) {
					$specific_columns = $generic_columns;
				} else {
					$specific_columns = absint( $specific_columns );
				}
			} else {
				$specific_columns = 1;
			}

			// Zoom
			$specific_zoom = get_post_meta( $post_id, '_uncode_product_enable_zoom', true );
			if ( $specific_layout === 'standard' ) {
				if ( $specific_zoom === 'off' ) {
					$specific_zoom = false;
				} else if ( $specific_zoom === 'on' ) {
					$specific_zoom = true;
				} else {
					$specific_zoom = $generic_zoom;
				}
			} else {
				$specific_zoom = false;
			}

			// Flexslider
			$specific_flexslider = $specific_layout === 'stack' || $specific_layout === 'grid' ? false : true;

			// Lightbox
			$specific_lightbox = $specific_layout === 'stack' || $specific_layout === 'grid' ? false : true;

			// Use specific values
			$generic_layout     = $specific_layout;
			$generic_columns    = $specific_columns;
			$generic_zoom       = $specific_zoom;
			$generic_flexslider = $specific_flexslider;
			$generic_lightbox   = $specific_lightbox;
		}
	}

	$settings = array(
		'type'       => ot_get_option('_uncode_woocommerce_default_product_gallery') === 'on' ? 'default' : 'custom',
		'layout'     => $generic_layout,
		'columns'    => $generic_columns,
		'zoom'       => $generic_zoom,
		'flexslider' => $generic_flexslider,
		'lightbox'   => $generic_lightbox,
	);

	return $settings;
}

/**
 * Load default WC product gallery templates from WooCommerce folder (WC default)
 */
function uncode_woocommerce_get_original_product_gallery_templates( $template, $template_name, $args, $template_path, $default_path ) {
	if ( ot_get_option('_uncode_woocommerce_default_product_gallery') === 'on' ) {
		$default_wc_path = WC()->plugin_path() . '/templates/';

		$original_templates = array(
			'single-product/product-image.php',
			'single-product/product-thumbnails.php'
		);

		if ( $template_name && $default_wc_path && in_array( $template_name, $original_templates ) ) {
			$template = $default_wc_path . $template_name;
		}
	}

	return $template;
}
add_filter( 'wc_get_template', 'uncode_woocommerce_get_original_product_gallery_templates', 10, 5 );

/**
 * Change default WC product gallery columns (WC default)
 */
function uncode_woocommerce_default_product_gallery_thumbnails_columns( $columns ) {
	if ( ot_get_option('_uncode_woocommerce_default_product_gallery') === 'on' ) {
		$settings = uncode_woocommerce_get_product_gallery_settings();
		$columns  = $settings['columns'];
	}

	return $columns;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'uncode_woocommerce_default_product_gallery_thumbnails_columns' );

/**
 * Enable/disable default WC product gallery zoom (WC default)
 */
function uncode_woocommerce_default_product_gallery_zoom_enabled( $enabled ) {
	if ( ot_get_option('_uncode_woocommerce_default_product_gallery') === 'on' ) {
		$settings = uncode_woocommerce_get_product_gallery_settings();
		$enabled  = $settings['zoom'];
	}

	return $enabled;
}
add_filter( 'woocommerce_single_product_zoom_enabled', 'uncode_woocommerce_default_product_gallery_zoom_enabled' );

/**
 * Enable/disable default WC product gallery flexslider (WC default)
 */
function uncode_woocommerce_default_product_gallery_flexslider_enabled( $enabled ) {
	if ( ot_get_option('_uncode_woocommerce_default_product_gallery') === 'on' ) {
		$settings = uncode_woocommerce_get_product_gallery_settings();
		$enabled  = $settings['flexslider'];
	}

	return $enabled;
}
add_filter( 'woocommerce_single_product_flexslider_enabled', 'uncode_woocommerce_default_product_gallery_flexslider_enabled' );

/**
 * Change default product gallery columns (1 column) (WC default)
 */
function uncode_woocommerce_product_thumbnails_columns_one() {
	return 1;
}

/**
 * Change default product gallery columns (2 columns) (WC default)
 */
function uncode_woocommerce_product_thumbnails_columns_two() {
	return 2;
}

/**
 * Change default product gallery columns (3 columns) (WC default)
 */
function uncode_woocommerce_product_thumbnails_columns_three() {
	return 3;
}

/**
 * Change default product gallery columns (4 columns) (WC default)
 */
function uncode_woocommerce_product_thumbnails_columns_four() {
	return 4;
}

/**
 * Change default product gallery columns (5 columns) (WC default)
 */
function uncode_woocommerce_product_thumbnails_columns_five() {
	return 5;
}

/**
 * Change default product gallery columns (6 columns) (WC default)
 */
function uncode_woocommerce_product_thumbnails_columns_six() {
	return 6;
}
