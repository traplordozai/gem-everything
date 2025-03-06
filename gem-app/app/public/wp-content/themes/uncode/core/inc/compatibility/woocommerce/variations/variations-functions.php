<?php
/**
 * Variations related functions
 */

/**
 * Register scripts
 */
function uncode_wc_variations_add_scripts() {
	$scripts_prod_conf = uncode_get_scripts_production_conf();
	$resources_version = $scripts_prod_conf[ 'resources_version' ];
	$suffix            = $scripts_prod_conf[ 'suffix' ];

	wp_register_script( 'uncode-woocommerce-variations', get_template_directory_uri() . '/library/js/woocommerce-variations' . $suffix . '.js', array( 'jquery', 'wc-add-to-cart-variation' ) , $resources_version, true );
}
add_action( 'wp_enqueue_scripts', 'uncode_wc_variations_add_scripts' );

/**
 * Enqueue scripts
 */
function uncode_wc_enqueue_variations_scripts() {
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'uncode-woocommerce-variations' );
}
add_action( 'woocommerce_before_add_to_cart_form', 'uncode_wc_enqueue_variations_scripts' );
add_action( 'uncode_entry_wc_before_single_attribute_selector', 'uncode_wc_enqueue_variations_scripts' );
add_action( 'uncode_quick_view_custom_style_scripts', 'uncode_wc_enqueue_variations_scripts' );

/**
 * Ajax add to cart for varations
 */
function uncode_wc_variations_add_to_cart() {
	// Notices
	ob_start();
	wc_print_notices();
	$notices = ob_get_clean();

	ob_start();
	woocommerce_mini_cart();
	$mini_cart = ob_get_clean();

	$data = array(
		'notices'   => $notices,
		'fragments' => apply_filters(
			'woocommerce_add_to_cart_fragments',
			array(
				'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>',
			)
		),
		'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() ),
	);

	wp_send_json( $data );
	die();
}
add_action( 'wp_ajax_uncode_ajax_add_to_cart', 'uncode_wc_variations_add_to_cart' );
add_action( 'wp_ajax_nopriv_uncode_ajax_add_to_cart', 'uncode_wc_variations_add_to_cart' );

/**
 * Append JSON data to the image for variations (Dynamic SRCSET)
 */
function uncode_wc_variations_add_srcset_json( $async_data, $type, $block_data, $dynamic_srcset_sizes, $id, $media_attributes, $resized_image, $orig_w, $orig_h, $single_w, $single_h, $crop, $fixed = null ) {
	$layout = isset( $block_data['layout'] ) ? $block_data['layout'] : array();
	if ( isset( $layout['variations'] ) && $layout['variations'] &&  isset( $block_data['id'] ) && $block_data['id'] && isset( $block_data['product'] ) && $block_data['product'] ) {
		$product = wc_get_product( $block_data['id'] );

		if ( $product && $product->is_type( 'variable' ) ) {
			$json_data            = array();
			$available_variations = $product->get_available_variations();

			foreach ( $available_variations as $variation ) {
				if ( isset( $variation['image_id'] ) && $variation['image_id'] ) {
					$variation_image_id         = $variation['image_id'];
					$variation_media_attributes = uncode_get_media_info( $variation_image_id );
					$variation_media_metavalues = unserialize($variation_media_attributes->metadata);
					$image_orig_w               = isset( $variation_media_metavalues['width'] ) ? $variation_media_metavalues['width'] : $orig_w;
					$image_orig_h               = isset( $variation_media_metavalues['height'] ) ? $variation_media_metavalues['height'] : $orig_h;
					$variation_resized_image    = uncode_resize_image( $variation_media_attributes->id, $variation_media_attributes->guid, $variation_media_attributes->path, $image_orig_w, $image_orig_h, $single_w, $single_h, $crop, $fixed );

					if ( $type === 'srcset' ) {
						// Dynamic SRCSET
						$image_orig_w__ = isset( $variation_resized_image['width'] ) ? $variation_resized_image['width'] : $image_orig_w;
						$image_orig_h__ = isset( $variation_resized_image['height'] ) ? $variation_resized_image['height'] : $image_orig_h;

						$adaptive_async_data_all = uncode_get_srcset_async_data( $block_data, $dynamic_srcset_sizes, $variation_image_id, $variation_media_attributes, $variation_resized_image, $image_orig_w__, $image_orig_h__, $single_w, $single_h, $crop, $fixed );

						// Strip unneeded data
						unset( $adaptive_async_data_all['srcset_placeholder'] );
						unset( $adaptive_async_data_all['string_without_srcset'] );
						unset( $adaptive_async_data_all['string'] );

						// Add URL
						$adaptive_async_data_all['src'] = $variation_resized_image['url'];
						$adaptive_async_data_all['orig_w'] = $image_orig_w;
						$adaptive_async_data_all['orig_h'] = $image_orig_h;

						// Build JSON
						$json_data[$variation_image_id] = $adaptive_async_data_all;
					} else if ( $type === 'ai' ) {
						// Adaptive images with async off (or adaptive images off)
						$variation_srcset = wp_get_attachment_image_srcset( $variation_image_id, array( $variation_resized_image['width'], $variation_resized_image['height'] ) );

						$json_data[$variation_image_id] = array(
							'src'    => $variation_resized_image['url'],
							'srcset' => $variation_srcset,
							'width'  => $variation_resized_image['width'],
							'height' => $variation_resized_image['height'],
							'alt'    => isset( $variation_media_attributes->alt ) ? $variation_media_attributes->alt : '',
						);

					} else if ( $type === 'ai_async' ) {
						$json_data[$variation_image_id] = array(
							'src'         => $variation_resized_image['url'],
							'width'       => $variation_resized_image['width'],
							'height'      => $variation_resized_image['height'],
							'alt'         => isset( $variation_media_attributes->alt ) ? $variation_media_attributes->alt : '',
							'singlew'     => $variation_resized_image['single_width'],
							'singleh'     => $variation_resized_image['single_height'],
							'uniqueid'    => $variation_image_id . '-' . uncode_big_rand(),
							'guid'        => is_array( $variation_media_attributes->guid ) ? $variation_media_attributes->guid['url'] : $variation_media_attributes->guid,
							'path'        => $variation_media_attributes->path,
							'data-width'  => $image_orig_w,
							'data-height' => $image_orig_h,
							'crop'        => $crop,
						);
					}
				}
			}

			if ( count( $json_data ) > 0 ) {
				$variations_json = wp_json_encode( $json_data );
				$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

				if ( $type === 'srcset' ) {
					$async_data['string'] .= ' data-product_variations="' . $variations_attr . '"';
					$async_data['product_variations'] = $json_data;
				} else if ( $type === 'ai' || $type === 'ai_async' ) {
					$async_data .= ' data-product_variations="' . $variations_attr . '"';
				}
			}
		}
	}

	return $async_data;
}
add_filter( 'uncode_adaptive_get_async_data', 'uncode_wc_variations_add_srcset_json', 10, 12 );

/**
 * Get taxonomy properties by name
 */
function uncode_wc_get_taxonomy_props( $taxonomy ) {
	$props                = array();
	$tax_id               = wc_attribute_taxonomy_id_by_name( $taxonomy );
	$attribute_taxonomies = wc_get_attribute_taxonomies();

	if ( $attribute_taxonomies ) {
		foreach ( $attribute_taxonomies as $tax ) {
			if ( isset( $tax->attribute_id ) && absint( $tax->attribute_id ) === $tax_id ) {
				return $tax;
			}
		}
	}

	return $props;
}

/**
 * Print single attribute (select or swatch)
 */
function uncode_wc_print_single_attribute( $product, $attribute_name, $options, $available_variations, $limit ) {
	$swatches     = uncode_wc_get_attribute_swatches( $product->get_id(), $attribute_name, $options, $available_variations );
	$has_swatches = is_array( $swatches ) && count( $swatches ) > 0 ? true : false;

	if ( $has_swatches ) {
		uncode_wc_print_swatches( $product, $swatches, $attribute_name, $options, $available_variations, $limit, true );
	} else {
		wc_dropdown_variation_attribute_options( array( 'id' => $attribute_name . '-' . rand(), 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'available_variations' => $available_variations ) );
	}
}

/**
 * Add data to the attribute dropdown (when showing a single attribute and it is a select)
 */
function uncode_wc_dropdown_variation_attribute_options_html( $html, $args ) {
	if ( isset( $args['available_variations'] ) && isset( $args['attribute'] ) ) {
		if ( is_array( $args['options'] ) ) {
			foreach ( $args['options'] as $option ) {
				$data_variation     = '';
				$selected_variation = uncode_wc_get_selected_variation_for_attr( $args['attribute'], $option, $args['available_variations'] );
				if ( is_array( $selected_variation ) ) {
					$variation_json = wp_json_encode( $selected_variation );
					$variation_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variation_json ) : _wp_specialchars( $variation_json, ENT_QUOTES, 'UTF-8', true );
					$data_variation = ' data-variation="' . $variation_attr . '"';
				}
				$html = str_replace( '<option value="' . $option . '"', '<option' . $data_variation . ' value="' . $option . '"', $html );
			}
		}
	}

	return $html;
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'uncode_wc_dropdown_variation_attribute_options_html', 10, 2 );

/**
 * Add class to product div when has variation's gallery
 */
function uncode_wc_product_class( $classes, $class = '', $post_id = 0 ) {
	if ( ot_get_option( '_uncode_woocommerce_default_product_gallery' ) === 'on' ) {
		return $classes;
	}

	if ( ! apply_filters( 'uncode_woocommerce_use_variation_galleries', true ) ) {
		return $classes;
	}

	if ( function_exists( 'vc_is_page_editable' ) && vc_is_page_editable() ) {
		return $classes;
	}

	if ( ! $post_id || ! in_array( get_post_type( $post_id ), array( 'product', 'product_variation' ), true ) ) {
		return $classes;
	}

	if ( ot_get_option( '_uncode_woocommerce_catalog_mode' ) === 'on' && ot_get_option( '_uncode_woocommerce_catalog_mode_show_variations' ) !== 'on' ) {
		return $classes;
	}

	$product = wc_get_product( $post_id );

	if ( $product && $product->is_type( 'variable' ) ) {
		$has_variation_gallery = get_post_meta( $post_id, 'has_variation_gallery', true );

		if ( empty( $has_variation_gallery ) ) {
			$available_variations = $product->get_available_variations();

			foreach ( $available_variations as $variation ) {
				$variation_id          = $variation['variation_id'];
				$variation_gallery_ids = uncode_wc_get_variation_gallery_ids( $variation_id );

				if ( is_array( $variation_gallery_ids ) && count( $variation_gallery_ids ) > 0 ) {
					$classes[] = 'woocommerce-product-gallery--with-variation-gallery product-gallery-placeholder';

					update_post_meta( $post_id, 'has_variation_gallery', 1 );

					return $classes;
				}
			}

			update_post_meta( $post_id, 'has_variation_gallery', 0 );
		} else if ( $has_variation_gallery === '1' ) {
			$classes[] = 'woocommerce-product-gallery--with-variation-gallery product-gallery-placeholder';
		}
	}

	return $classes;
}
add_filter( 'post_class', 'uncode_wc_product_class', 20, 3 );

/**
 * Add class to page header div when has variation's gallery
 */
function uncode_wc_page_header_product_class( $classes, $post_id = 0, $product = null ) {
	if ( ot_get_option( '_uncode_woocommerce_default_product_gallery' ) === 'on' ) {
		return $classes;
	}

	if ( ! apply_filters( 'uncode_woocommerce_use_variation_galleries', true ) ) {
		return $classes;
	}

	if ( function_exists( 'vc_is_page_editable' ) && vc_is_page_editable() ) {
		return $classes;
	}

	if ( ot_get_option( '_uncode_woocommerce_catalog_mode' ) === 'on' && ot_get_option( '_uncode_woocommerce_catalog_mode_show_variations' ) !== 'on' ) {
		return $classes;
	}

	if ( ! $post_id ) {
		return $classes;
	}

	if ( $product && $product->is_type( 'variable' ) ) {
		$has_variation_gallery = get_post_meta( $post_id, 'has_variation_gallery', true );

		if ( empty( $has_variation_gallery ) ) {
			$available_variations = $product->get_available_variations();

			foreach ( $available_variations as $variation ) {
				$variation_id          = $variation['variation_id'];
				$variation_gallery_ids = uncode_wc_get_variation_gallery_ids( $variation_id );

				if ( is_array( $variation_gallery_ids ) && count( $variation_gallery_ids ) > 0 ) {
					$classes[] = 'woocommerce-product-gallery--with-variation-gallery';
					$classes[] = 'product-gallery-placeholder';

					update_post_meta( $post_id, 'has_variation_gallery', 1 );

					return $classes;
				}
			}

			update_post_meta( $post_id, 'has_variation_gallery', 0 );
		} else if ( $has_variation_gallery === '1' ) {
			$classes[] = 'woocommerce-product-gallery--with-variation-gallery product-gallery-placeholder';
		}
	}

	return $classes;
}
add_filter( 'uncode_page_header_product_class', 'uncode_wc_page_header_product_class', 10, 3 );

/**
 * Get first avaialble variation for a specific attribute value
 */
function uncode_wc_get_selected_variation_for_attr( $attribute_name, $attribute_value, $available_variations, $check_for_visibility = false ) {
	if ( is_array( $available_variations ) ) {
		foreach ( $available_variations as $variation ) {
			if ( isset( $variation['attributes'] ) ) {
				$variation_attributes = $variation['attributes'];

				if ( is_array( $variation_attributes ) && isset( $variation_attributes['attribute_' . $attribute_name] ) ) {
					if ( $variation_attributes['attribute_' . $attribute_name] === $attribute_value ) {
						return $variation;
					}

					if ( $check_for_visibility && $variation_attributes['attribute_' . $attribute_name] === '' ) {
						return $variation;
					}
				}
			}
		}
	}

	return array();
}

/**
 * Print variations element in posts modules
 */
function uncode_wc_print_variations_element( $product, $options, $single_text, $has_add_to_cart_overlay = false ) {
	$output = '';

	if ( $product->is_type( 'variable' ) ) {
		$variations_wrapper_class = $has_add_to_cart_overlay ? 'single-attribute-selector--shift' : '';

		if ( isset( $options[0] ) && $options[0] === 'over_visible' ) {
			$variations_wrapper_class .= ' single-attribute-selector--over-visible';
		}

		if ( isset( $options[4] ) && $options[4] === 'dynamic_title' ) {
			$variations_wrapper_class .= ' single-attribute-selector--dynamic-title';
		}

		if ( isset( $options[5] ) ) {
			if ( $options[5] === 'size_regular' ) {
				$variations_wrapper_class .= ' swatch-size-regular';
			} else if ( $options[5] === 'size_small' ) {
				$variations_wrapper_class .= ' swatch-size-small';
			}
		}

		if ( isset( $options[6] ) ) {
			if ( $options[6] === 'tablet' ) {
				$variations_wrapper_class .= ' mobile-hidden';
			} else if ( $options[6] === 'desktop' ) {
				$variations_wrapper_class .= ' mobile-hidden tablet-hidden';
			}
		}

		if ( isset( $options[1] ) && $options[1] !== '_all' ) {
			$selected_variation   = $options[1];
			$variations_limit     = isset( $options[2] ) && $options[2] ? absint( $options[2] ) : 0;
			$available_variations = $product->get_available_variations();
			$attributes           = $product->get_variation_attributes();

			if ( isset( $options[3] ) && $options[3] === 'hover' ) {
				$variations_wrapper_class .= ' single-attribute-selector--hover';
			}

			foreach ( $attributes as $attribute_name => $attribute_options ) {
				if ( $attribute_name === $selected_variation ) {
					ob_start();
					do_action( 'uncode_entry_wc_before_single_attribute_selector' );
					uncode_wc_print_single_attribute( $product, $attribute_name, $attribute_options, $available_variations, $variations_limit );
					$variations_output = ob_get_clean();

					if ( $variations_output ) {
						$variations_wrapper_class .= $single_text === 'overlay' ? ' t-entry-meta t-entry-variations single-attribute-selector' : ' t-entry-variations single-attribute-selector';
						$output .= '<div class="' . $variations_wrapper_class . '">' . $variations_output . '</div>';
					}

					break;
				}
			}

		} else {
			ob_start();
			woocommerce_variable_add_to_cart();
			$variable_form_html = ob_get_clean();

			if ( $variable_form_html ) {
				$variations_wrapper_class .= $single_text === 'overlay' ? ' t-entry-meta t-entry-variations' : ' t-entry-variations';
				$output .= '<div class="' . $variations_wrapper_class . '">' . $variable_form_html . '</div>';
			}
		}
	}

	return $output;
}

/**
 * Calculate the default selected attribute
 */
function uncode_wc_get_default_selected_attribute( $attribute_name, $default_selected ) {
	$selected     = false;
	$selected_key = 'attribute_' . sanitize_title( $attribute_name );
	$selected     = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $default_selected;

	if ( uncode_is_quick_view() && isset( $_REQUEST['post_url'] ) ) {
		$qw_product_url = $_REQUEST['post_url'];

		if ( $qw_product_url ) {
			$qw_product_url_attributes = parse_url( $qw_product_url, PHP_URL_QUERY );

			if ( $qw_product_url_attributes ) {
				parse_str( $qw_product_url_attributes, $qw_selected_attributes );

				$selected = isset( $qw_selected_attributes[ $selected_key ] ) ? wc_clean( wp_unslash( $qw_selected_attributes[ $selected_key ] ) ) : $selected;

			}
		}
	}

	return $selected;
}

/**
 * Print atribute image element in posts modules
 */
function uncode_wc_print_attribute_image_element( $product, $options, $single_text, $single_elements_click ) {
	$output      = '';
	$product_att = $options[0];
	$tax_props   = uncode_wc_get_taxonomy_props( $product_att );

	if ( isset( $tax_props->attribute_type ) && $tax_props->attribute_type === 'image' ) {
		$att_terms      = wc_get_product_terms( $product->get_id(), $product_att );
		$t_entry_class  = count( $att_terms ) > 0 ? ' t-entry-attribute-image--multiple' : '';
		$t_entry_class .= isset( $options[1] ) && $options[1] === 'border_no' ? ' no-border' : '';
		$link_enabled   = isset( $options[2] ) && $options[2] === 'with_link' ? true : false;

		$output .= '<div class="t-entry-attribute-image'. $t_entry_class . '">';

		foreach ( $att_terms as $term ) {
			$thumbnail_id    = absint( get_term_meta( $term->term_id, 'uncode_pa_thumbnail_id', true ) );
			$thumbnail_id    = $thumbnail_id ? $thumbnail_id : false;
			$image_size      = uncode_wc_get_image_swatch_size( $product_att );
			$thumbnail_size  = $image_size === 'regular' ? 'uncode_woocommerce_nav_thumbnail_regular' : 'uncode_woocommerce_nav_thumbnail_crop';
			$image           = $thumbnail_id ? wp_get_attachment_image( $thumbnail_id, $thumbnail_size ) : wc_placeholder_img( $thumbnail_size );
			$has_archive     = $tax_props->attribute_public ? true : false;
			$no_link_allowed = $single_text === 'overlay' && $single_elements_click !== 'yes' ? true : false;

			if ( $link_enabled && $has_archive && ! $no_link_allowed ) {
				$image_url = get_term_link( $term, $product_att );
				$output .= '<a href="' . $image_url . '" class="t-entry-attribute-image__link">';
			}

			$output .= $image;

			if ( $link_enabled && $has_archive && ! $no_link_allowed ) {
				$output .= '</a>';
			}
		}

		$output .= '</div>';

	}

	return $output;
}

/**
 * Delete object terms of a taxonomy
 */
function uncode_wc_delete_single_variations_object_terms( $variation_id, $taxonomy ) {
	$terms_to_delete = wp_get_object_terms( $variation_id, $taxonomy );

	if ( is_array( $terms_to_delete ) ) {
		$term_ids_to_delete = array_column( $terms_to_delete, 'term_id' );

		if ( is_array( $term_ids_to_delete ) ) {
			wp_remove_object_terms( $variation_id, $term_ids_to_delete, $taxonomy );
		}
	}
}

/**
 * Delete all terms attached to variations
 */
function uncode_wc_delete_single_variations_terms( $variation_id, $attributes_to_remove, $taxonomies ) {
	// Delete taxonomies
	foreach ( $taxonomies as $taxonomy ) {
		uncode_wc_delete_single_variations_object_terms( $variation_id, $taxonomy );
	}

	// Delete attributes
	foreach ( $attributes_to_remove as $attribute ) {
		uncode_wc_delete_single_variations_object_terms( $variation_id, $attribute );
	}

	// Delete post meta
	delete_post_meta( $variation_id, '_wc_average_rating' );
}

/**
 * When processing variations from Theme Options,
 * get the count of each taxonomy term
 */
function uncode_get_terms_count_after_process_variations( $taxonomies, $attribute_taxonomies, $hide_parent = false ) {
	global $has_ajax_filters;
	$has_ajax_filters = true;

	$terms_count = array();

	WPBMap::addAllMappedShortcodes();

	if ( $hide_parent ) {
		$post_module_shortcode = '[uncode_index loop="size:All|order_by:date|post_type:product" woo_single_variations="yes" woo_single_variations_hide_parent="yes" run_dry="yes" ]';
	} else {
		$post_module_shortcode = '[uncode_index loop="size:All|order_by:date|post_type:product" woo_single_variations="yes" run_dry="yes" ]';
	}

	$content_output = do_shortcode( $post_module_shortcode );

	foreach( $taxonomies as $taxonomy ) {
		$filter_terms = uncode_filters_populate_tax_terms( 'tax', $taxonomy, array(), false, false, 'default', 'asc' );

		foreach ( $filter_terms as $filter_term_key => $filter_term_value ) {
			$terms_count[$filter_term_key] = $filter_term_value['count'];
		}
	}

	foreach( $attribute_taxonomies as $attribute_tax ) {
		if ( $attribute_tax->attribute_public ) {
			$attribute_tax_name = wc_attribute_taxonomy_name( $attribute_tax->attribute_name );

			if ( $attribute_tax_name ) {
				$filter_terms = uncode_filters_populate_tax_terms( 'product_att', $attribute_tax_name, array(), false, false, 'default', 'asc' );

				foreach ( $filter_terms as $filter_term_key => $filter_term_value ) {
					$terms_count[$filter_term_key] = $filter_term_value['count'];
				}
			}
		}
	}

	return $terms_count;
}

/**
 * Check if single variations are enabled
 */
function uncode_single_variations_enabled() {
	$enabled = ot_get_option( '_uncode_woocommerce_enable_single_variations' ) === 'on' ? true : false;

	return $enabled;
}

/**
 * Process variations from Theme Options, adding a post meta
 * to check if a product has variations
 */
function uncode_wc_process_variations() {
	if ( wp_verify_nonce( $_POST[ 'uncode_process_variations_nonce' ], 'uncode-process-variations-nonce' ) ) {
		do_action( 'uncode_before_process_variations' );

		$excluded_attributes = uncode_single_variations_get_excluded_attributes();

		$attributes_to_remove = array();
		$attribute_taxonomies = wc_get_attribute_taxonomies();
		foreach( $attribute_taxonomies as $tax ) {
			$attributes_to_remove[] = wc_attribute_taxonomy_name( $tax->attribute_name );
		}

		// Taxonomies
		$taxonomies = array(
			'product_cat',
			'product_tag',
		);

		$taxonomies = apply_filters( 'uncode_single_variations_taxonomies_to_update', $taxonomies );

		$args = array(
			'post_type'      => 'product_variation',
			'posts_per_page' => -1,
			'fields'         => 'ids',
		);

		$the_query = new WP_Query( $args );

		$variations = is_array( $the_query->posts ) ? $the_query->posts : array();

		foreach ( $variations as $variation_id ) {
			$variation      = wc_get_product( $variation_id );
			$parent_id      = $variation->get_parent_id();
			$parent_product = wc_get_product( $parent_id );

			// First delete all terms
			uncode_wc_delete_single_variations_terms( $variation_id, $attributes_to_remove, $taxonomies );

			// Delete post meta
			if ( ! apply_filters( 'uncode_process_variations_update_meta', true ) ) {
				delete_post_meta( $variation_id, '_wc_average_rating' );
				delete_post_meta( $variation_id, '_uncode_show_single_variation' );
			}

			if ( $parent_id ) {
				if ( $parent_product->get_catalog_visibility() === 'hidden' ) {
					continue;
				}

				if ( apply_filters( 'uncode_process_variations_update_meta', true ) ) {
					foreach ( $taxonomies as $taxonomy ) {
						$terms = (array) wp_get_post_terms( $parent_id, $taxonomy, array( 'fields' => 'ids' ) );
						wp_set_post_terms( $variation_id, $terms, $taxonomy );
					}
				}

				// Variation attributes
				$variation  = new WC_Product_Variation( $variation_id );
				$attributes = $variation->get_variation_attributes();

				if ( apply_filters( 'uncode_process_variations_update_meta', true ) ) {
					if ( ! empty( $attributes ) ) {
						foreach ( $attributes as $key => $term ) {
							$attr_tax = str_replace( 'attribute_', '', $key );
							wp_set_post_terms( $variation_id, $term, $attr_tax );
						}
					}
				}

				if ( apply_filters( 'uncode_process_variations_update_meta', true ) ) {
					// Parent attributes
					$parent_attributes = $parent_product->get_attributes();

					if ( ! empty( $parent_attributes ) ) {
						foreach ( $parent_attributes as $parent_attribute ) {
							if ( $parent_attribute->get_variation() ) {
								$skip = true;

								$parent_attribute_key = 'attribute_' . $parent_attribute->get_taxonomy();

								// Save terms if variations are not fully combined (eg. "any size")
								if ( isset( $attributes[$parent_attribute_key] ) && ! $attributes[$parent_attribute_key] ) {
									$skip = false;
								}

								// Save terms if attribute is hidden
								if ( in_array( $parent_attribute->get_taxonomy(), $excluded_attributes ) ) {
									$skip = false;
								}

								if ( $skip ) {
									continue;
								}
							}

							$attr_tax = $parent_attribute->get_taxonomy();
							$terms    = (array) $parent_attribute->get_terms();

							if ( ! empty( $terms ) ) {
								$tmp = array();

								foreach ( $terms as $term ) {
									$tmp[] = $term->term_id;
								}

								wp_set_post_terms( $variation_id, $tmp, $attr_tax );
							}
						}
					}
				}

				if ( apply_filters( 'uncode_process_variations_update_meta', true ) ) {
					// Average ratings
					$parent_average_rating = get_post_meta( $parent_id, '_wc_average_rating', true );

					if ( $parent_average_rating ) {
						update_post_meta( $variation_id, '_wc_average_rating', $parent_average_rating );
					}

					update_post_meta( $variation_id, '_uncode_show_single_variation', $parent_product->get_status() === 'publish' ? 'yes' : 'no' );
				}

				do_action( 'uncode_after_process_single_variation', $variation_id, $parent_id );
			}
		}

		if ( apply_filters( 'uncode_process_variations_update_meta', true ) ) {
			// Update terms count
			if ( apply_filters( 'uncode_woocommerce_enable_single_variations_hide_parent', false ) ) {
				$terms_all_count = uncode_get_terms_count_after_process_variations( $taxonomies, $attribute_taxonomies );
				update_option( 'uncode_terms_all_count', $terms_all_count, false );
			}

			$terms_hidden_parent_count = uncode_get_terms_count_after_process_variations( $taxonomies, $attribute_taxonomies, true );
			update_option( 'uncode_terms_hidden_parent_count', $terms_hidden_parent_count, false );

			// Save IDs of variable products
			delete_option( 'uncode_variable_product_parent_ids' );

			if ( is_array( $excluded_attributes ) && count( $excluded_attributes ) > 0 ) {
				$args = array(
					'type'   => 'variable',
					'limit'  => -1,
					'return' => 'ids',
				);

				$variable_product_parent_ids = wc_get_products( $args );

				update_option( 'uncode_variable_product_parent_ids', $variable_product_parent_ids, false );
			}
		} else {
			delete_option( 'uncode_terms_all_count' );
			delete_option( 'uncode_terms_hidden_parent_count' );
			delete_option( 'uncode_variable_product_parent_ids' );
		}

		wp_send_json_success(
			array(
				'message' => esc_html__( 'Variations processed.', 'uncode' )
			)
		);
	}

	// Invalid nonce or data
	wp_send_json_error(
		array(
			'message' => esc_html__( 'Invalid nonce or empty data.', 'uncode' )
		)
	);
}
add_action( 'wp_ajax_uncode_process_variations', 'uncode_wc_process_variations' );

/**
 * Fix pagination on archives if we are using single variations
 */
function uncode_single_variations_fix_main_query( $query ) {
	if ( isset( $query->query_vars ) && isset( $query->query_vars['wc_query'] ) ) {
		if ( class_exists( 'WooCommerce' ) && uncode_single_variations_enabled() && ! is_admin() ) {
			$shop_archive = false;

			if ( ( is_shop() || is_product_category() || is_product_tag() || is_tax() ) ) {
				$shop_archive = true;
			}

			if ( is_tax() ) {
				$queried_object     = get_queried_object();
				$queried_object_tax = isset( $queried_object->taxonomy ) ? $queried_object->taxonomy : false;

				if ( $queried_object_tax && taxonomy_is_product_attribute( $queried_object_tax ) ) {
					$shop_archive = true;
				}
			}

			if ( $shop_archive ) {
				$uncodeblock_id = ot_get_option('_uncode_product_index_content_block');
				$uncodeblock_id = apply_filters( 'wpml_object_id', $uncodeblock_id, 'post' );
				$content        = get_post_field('post_content', $uncodeblock_id);

				if ( strpos( $content, 'woo_single_variations="yes"' ) !== false ) {
					$query->set( 'post_type', array( 'product', 'product_variation' ) );
				}
			}
		}
  	}
}
add_action( 'pre_get_posts', 'uncode_single_variations_fix_main_query' );

/**
 * Hide parent products from single variations loops
 */
function uncode_single_variations_hide_parent_clause( $clauses, $wp_query ) {
	global $wpdb;

	$clauses['where'] .= " AND  0 = (select count(*) as variationcount from {$wpdb->posts} as uncode_products where uncode_products.post_parent = {$wpdb->posts}.ID and uncode_products.post_type= 'product_variation' and uncode_products.post_status = 'publish') ";

	return $clauses;
}

/**
 * Get attributes to hide
 */
function uncode_single_variations_get_excluded_attributes() {
	$attributes    = array();
	$excluded_atts = ot_get_option('_uncode_woocommerce_single_variations_excluded_atts');

	if ( $excluded_atts ) {
		$attribute_ids = explode( ',', $excluded_atts );

		foreach( $attribute_ids as $attribute_id ) {
			$attribute_slug = wc_attribute_taxonomy_name_by_id( absint( $attribute_id ) );
			$attributes[]   = $attribute_slug;
		}
	}

	return $attributes;
}

/**
 * Hide variations that has specific attributes
 */
function uncode_single_variations_hide_attributes_from_query( $main_query_args, $query_options ) {
	if ( ! uncode_single_variations_enabled() ) {
		return $main_query_args;
	}

	if ( is_array( $query_options ) && isset( $query_options['single_variations'] ) && $query_options['single_variations'] ) {
		$attributes_to_hide = uncode_single_variations_get_excluded_attributes();

		if ( ! is_array( $attributes_to_hide ) || ! count( $attributes_to_hide ) > 0 ) {
			return $main_query_args;
		}

		$woocommerce_hide_out_of_stock_items = get_option( 'woocommerce_hide_out_of_stock_items' );

		if ( 'yes' === $woocommerce_hide_out_of_stock_items ) {
			$product_visibility_term_ids = wc_get_product_visibility_term_ids();
		}

		$tax_query = array();

		$main_tax_query_args = isset( $main_query_args['tax_query'] ) ? $main_query_args['tax_query'] : array( 'relation' => 'AND' );

		$tax_query = array_merge( $tax_query, $main_tax_query_args );

		$tax_query[] = array(
			'taxonomy' => 'product_type',
			'field'    => 'slug',
			'terms'    => 'variable',
		);

		$excluded_attribute_products_query = array(
			'post_type'      => 'product',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'tax_query'      => $tax_query,
		);

		$all_child_products = array();
		$products           = new WP_Query( $excluded_attribute_products_query );

		if ( ! empty( $products->posts ) ) {
			$first_variation_products = array();

			foreach ( $products->posts as $__product ) {
				$_product = wc_get_product( $__product->ID );

				if ( ! $_product ) {
					continue;
				}

				$args = array(
					'post_type'      => 'product_variation',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'post_parent'    => $_product->get_id(),
					'order'          => 'DESC',
					'orderby'        => 'meta_value_num',
					'meta_key'       => '_price',
					'tax_query'      => array(),
				);

				if ( 'yes' === $woocommerce_hide_out_of_stock_items ) {
					$args['tax_query'][] = array(
						array(
							'taxonomy' => 'product_visibility',
							'field'    => 'term_taxonomy_id',
							'terms'    => $product_visibility_term_ids['outofstock'],
							'operator' => 'NOT IN',
						),
					);
				}

				$variation_ids = get_children( $args, ARRAY_A );

				if ( empty( $variation_ids ) ) {
					continue;
				}
				$variation_ids = array_keys( $variation_ids );

				$all_child_products = array_merge( $all_child_products, $variation_ids );

				foreach ( $variation_ids as $variation_id ) {
					$variation_product = wc_get_product( $variation_id );
					if ( ! $variation_product ) {
						continue;
					}

					if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) && ! $variation_product->is_in_stock() ) {
						continue;
					}

					$variation_attributes = $variation_product->get_attributes();
					if ( empty( $variation_attributes ) ) {
						continue;
					}

					$array_key = '';
					$single_attribute_and_hide_attribute_product = false;

					foreach ( $variation_attributes as $key => $val ) {
						if ( in_array( $key, $attributes_to_hide ) ) {
							if ( 1 == count( $variation_attributes ) ) {
								// $single_attribute_and_hide_attribute_product = true;
							}
							continue;
						}
						$array_key .= $key . $val;
					}

					if ( false == $single_attribute_and_hide_attribute_product ) {
						$first_variation_products[ $array_key ] = $variation_id;
					}
				}

				if ( ! empty( $first_variation_products ) ) {
					$all_child_products = array_diff( $all_child_products, $first_variation_products );
				}
			}
		}

		$query_args = array(
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'post_type'      => 'product_variation',
			'no_found_rows'  => 1,
			'meta_query'     => array(),
			'tax_query'      => array(
				'relation' => 'AND',
			),
		);

		if ( 'yes' === $woocommerce_hide_out_of_stock_items ) {
			$query_args['tax_query'][] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'term_taxonomy_id',
					'terms'    => $product_visibility_term_ids['outofstock'],
					'operator' => 'IN',
				),
			);

			$out_of_stock_variations   = new WP_Query( $query_args );

			if ( ! empty( $out_of_stock_variations->posts ) ) {
				$out_of_stock_variations_ids = wp_list_pluck( $out_of_stock_variations->posts, 'ID' );
				$all_child_products          = array_merge( $all_child_products, $out_of_stock_variations_ids );
			}
		}

		if ( ! empty( $all_child_products ) ) {
			$post__not_in = isset( $main_query_args['post__not_in'] ) ? (array) $main_query_args['post__not_in'] : array();
			$post__not_in = array_merge( $post__not_in, $all_child_products );
			$main_query_args['post__not_in'] = $post__not_in;
		}
	}

	return $main_query_args;
}
add_filter( 'uncode_get_uncode_index_args_for_filters', 'uncode_single_variations_hide_attributes_from_query', 10, 2 );

/**
 * Change variation title if has hidden attributes
 */
function uncode_single_variations_change_title( $title, $post_id ) {
	if ( ! uncode_single_variations_enabled() ) {
		return $title;
	}

	global $uncode_query_options;

	if ( is_array( $uncode_query_options ) && isset( $uncode_query_options['single_variations'] ) && $uncode_query_options['single_variations'] && 'product_variation' == get_post_type( $post_id ) ) {
		$custom_title =  get_post_meta( $post_id, '_uncode_wc_variation_title', true );

		if ( $custom_title ) {
			$title = $custom_title;
		} else {
			$attributes_to_hide = uncode_single_variations_get_excluded_attributes();

			if ( ! is_array( $attributes_to_hide ) || ! count( $attributes_to_hide ) > 0 ) {
				return $title;
			}

			$product              = wc_get_product( $post_id );
			$variation_attributes = $product->get_attributes();

			if ( $variation_attributes ) {
				foreach ( $variation_attributes as $key => $val ) {
					if ( in_array( $key, $attributes_to_hide ) ) {
						if ( taxonomy_exists( $key ) ) {
							$term = get_term_by( 'slug', $val, $key );
							if ( ! is_wp_error( $term ) && ! empty( $term->name ) ) {
								$val = $term->name;
							}
						}
						if ( stristr( $title, $val . ',' ) ) {
							$title = str_replace( $val . ',', '', $title );
						}
						if ( stristr( $title, ', ' . $val ) ) {
							$title = str_replace( ', ' . $val, '', $title );
						}
					}
				}
			}
		}
	}
	return $title;
}
add_filter( 'uncode_single_block_title', 'uncode_single_variations_change_title', 10, 2 );

/**
 * Show the "Select options" button instead of the "Add to cart" one
 */
function uncode_single_variations_redirect_to_product( $product ) {
	$redirect_to_product = false;

	if ( ! uncode_single_variations_enabled() ) {
		return $redirect_to_product;
	}

	global $uncode_query_options;

	if ( is_array( $uncode_query_options ) && isset( $uncode_query_options['single_variations'] ) && $uncode_query_options['single_variations'] && $product->get_type() === 'variation' ) {
		$product_attributes = $product->get_variation_attributes();

		if ( is_array( $product_attributes ) ) {
			foreach( $product_attributes as $product_attribute_key => $product_attribute ) {
				// Redirect when variation is not fully combined (eg. "any size")
				if ( ! $product_attribute ) {
					$redirect_to_product = true;
				}

				// Redirect also when the variation has an excluded attribute
				if ( in_array( str_replace( 'attribute_', '', $product_attribute_key ), uncode_single_variations_get_excluded_attributes() ) ) {
					$redirect_to_product = true;
				}
			}
		}
	}

	$redirect_to_product = apply_filters( 'uncode_single_variations_redirect_to_product', $redirect_to_product, $product );

	return $redirect_to_product;
}

/**
 * Use parent image if no variations are found
 */
function uncode_single_variations_use_parent_image( $product ) {
	$use_parent_image = false;

	if ( ! uncode_single_variations_enabled() ) {
		return true;
	}

	global $uncode_query_options;

	if ( is_array( $uncode_query_options ) && isset( $uncode_query_options['single_variations'] ) && $uncode_query_options['single_variations'] && $product->get_type() === 'variation' ) {
		$product_attributes = $product->get_variation_attributes();

		$found_variations = 0;

		if ( is_array( $product_attributes ) ) {
			foreach( $product_attributes as $product_attribute_key => $product_attribute ) {
				if ( ! in_array( str_replace( 'attribute_', '', $product_attribute_key ), uncode_single_variations_get_excluded_attributes() ) ) {
					$found_variations++;
				}
			}
		}

		if ( $found_variations === 0 ) {
			$use_parent_image = true;
		}
	}

	$use_parent_image = apply_filters( 'uncode_single_variations_use_parent_image', $use_parent_image, $product );

	return $use_parent_image;
}
