<?php
/**
 * Swatches related functions
 */

/**
 * Check if Uncode swatches are active
 */
function uncode_wc_swatches_global_active() {
	$is_active = apply_filters( 'uncode_woocommerce_use_swatches', true );

	if ( class_exists( 'Woo_Variation_Swatches' ) ) {
		$is_active = false;
	} else if ( defined( 'YITH_WCCL' ) || defined( 'YITH_WCCL_PREMIUM' ) ) {
		$is_active = false;
	}

	return $is_active;
}

/**
 * Register scripts
 */
function uncode_wc_swatches_add_scripts() {
	// Return early if swatches functionality is disabled
	if ( ! uncode_wc_swatches_global_active() ) {
		return;
	}

	$scripts_prod_conf  = uncode_get_scripts_production_conf();
	$resources_version  = $scripts_prod_conf[ 'resources_version' ];
	$suffix             = $scripts_prod_conf[ 'suffix' ];

	wp_register_script( 'uncode-woocommerce-swatches', get_template_directory_uri() . '/library/js/woocommerce-swatches' . $suffix . '.js', array( 'jquery' ) , $resources_version, true );
}
add_action( 'wp_enqueue_scripts', 'uncode_wc_swatches_add_scripts' );

/**
 * Enqueue scripts
 */
function uncode_wc_enqueue_swatches_scripts() {
	wp_enqueue_script( 'uncode-woocommerce-swatches' );
}
add_action( 'woocommerce_before_add_to_cart_form', 'uncode_wc_enqueue_swatches_scripts' );
add_action( 'uncode_entry_wc_before_single_attribute_selector', 'uncode_wc_enqueue_swatches_scripts' );
add_action( 'uncode_quick_view_custom_style_scripts', 'uncode_wc_enqueue_swatches_scripts' );

/**
 * Get array of swatches for the attributes
 */
function uncode_wc_get_attribute_swatches( $product_id, $attribute_name, $attribute_options, $available_variations ) {
	$swatches = array();

	if ( uncode_wc_swatches_global_active() && apply_filters( 'uncode_woocommerce_use_swatches_for_product', true, $product_id, $attribute_name ) ) {
		$tax_props   = uncode_wc_get_taxonomy_props( $attribute_name );

		if ( uncode_wc_attribute_with_thumbnail( $attribute_name, $product_id ) ) {
			$swatch_type = 'thumbnail';
		} else {
			$swatch_type = isset( $tax_props->attribute_type ) && $tax_props->attribute_type ? $tax_props->attribute_type : 'select';
		}

		foreach ( $attribute_options as $key => $value ) {
			$swatch_value = uncode_wc_get_attribute_swatch_value( $attribute_name, $value, $swatch_type, $available_variations );

			if ( $swatch_value ) {
				$swatches[ $key ] = $swatch_value;
			}
		}
	}

	return $swatches;
}

/**
 * Check if attribute is using the variation's thumbnail
 */
function uncode_wc_attribute_with_thumbnail( $attribute_name, $product_id ) {
	$attribute_with_thumbnail = ot_get_option( '_uncode_woocommerce_attribute_with_thumbnail' );

	if ( $attribute_with_thumbnail === $attribute_name ) {
		return true;
	}

	return false;
}

/**
 * Get swatch value for a single attribute
 */
function uncode_wc_get_attribute_swatch_value( $attribute_name, $attribute_value, $swatch_type, $available_variations ) {
	$swatch = array();

	if ( $swatch_type === 'thumbnail' ) {
		$selected_variation = uncode_wc_get_selected_variation_for_attr( $attribute_name, $attribute_value, $available_variations, true );
		$thumbnail_id       = false;
		$hidden             = false;

		if ( empty( $selected_variation ) ) {
			$hidden = true;
		}

		if ( is_array( $selected_variation ) && isset( $selected_variation['image_id'] ) ) {
			$thumbnail_id = $selected_variation['image_id'] ? absint( $selected_variation['image_id'] ) : false;
		}

		$swatch = array(
			'type'   => 'featured',
			'value'  => $thumbnail_id,
			'hidden' => $hidden,
		);

	} else {
		$selected_variation = uncode_wc_get_selected_variation_for_attr( $attribute_name, $attribute_value, $available_variations, true );
		$hidden             = false;

		if ( empty( $selected_variation ) ) {
			$hidden = true;
		}

		$term = get_term_by( 'slug', $attribute_value, $attribute_name );

		if ( $term ) {
			switch ( $swatch_type ) {
				case 'color':
					$color = get_term_meta( $term->term_id, 'uncode_pa_color', true );
					$color = $color ? $color : '#EEEEEF';

					$swatch = array(
						'type'   => 'color',
						'value'  => $color,
						'hidden' => $hidden,
					);
					break;

				case 'image':
					$thumbnail_id = absint( get_term_meta( $term->term_id, 'uncode_pa_thumbnail_id', true ) );
					$thumbnail_id = $thumbnail_id ? $thumbnail_id : false;

					$swatch = array(
						'type'   => 'image',
						'value'  => $thumbnail_id,
						'hidden' => $hidden,
					);

					break;

				case 'label':
					$swatch = array(
						'type'   => 'label',
						'value'  => $term->name,
						'hidden' => $hidden,
					);
					break;

			}
		}
	}

	return $swatch;
}

/**
 * Print swatches
 */
function uncode_wc_print_swatches( $product, $swatches, $attribute_name, $options, $available_variations, $limit = 0, $single_attribute = false ) {
	if ( is_array( $swatches ) && count( $swatches ) > 0 ) {
		$selected = false;

		// Get selected value.
		if ( $attribute_name && $product instanceof WC_Product ) {
			$default_selected = $product->get_variation_default_attribute( $attribute_name );
			$selected         = uncode_wc_get_default_selected_attribute( $attribute_name, $default_selected );

			$tax_props = uncode_wc_get_taxonomy_props( $attribute_name );
			$swatch_type = isset( $tax_props->attribute_type ) && $tax_props->attribute_type ? $tax_props->attribute_type : 'select';

			echo '<div class="swatches-select swatches-select--single swatches-select--type-' . $swatch_type . '" data-swatch-id="' . esc_attr( $attribute_name ) . '">';
				$options_fliped = array_flip( $options );

				if ( ! empty( $options ) ) {
					if ( $product && taxonomy_exists( $attribute_name ) ) {
						$terms = wc_get_product_terms(
							$product->get_id(),
							$attribute_name,
							array(
								'fields' => 'all',
							)
						);

						$count = 0;

						$terms = apply_filters( 'uncode_woocommerce_swatches_terms', $terms, $selected, $default_selected );

						foreach ( $terms as $term ) {
							if ( $limit > 0 && $count >= $limit ) {
								break;
							}

							if ( in_array( $term->slug, $options, true ) ) {
								$key = $options_fliped[$term->slug];
								echo uncode_wc_print_single_swatch( $swatches, $key, $term, $selected, $attribute_name, $available_variations, $single_attribute );
								$count++;
							}
						}

						if ( $limit > 0 && count( $terms ) > $limit ) {
							echo '<span class="swatches-more-link text-small" data-link="' . get_permalink( $product->get_id() ) . '">+' . ( count( $terms ) - $limit ) . '</span>';
						}
					}
				}
			echo '</div>';
		}
	}
}

/**
 * Print single swatch
 */
function uncode_wc_print_single_swatch( $swatches, $key, $term, $selected, $attribute_name, $available_variations, $single_attribute ) {
	if ( isset( $swatches[$key] ) && $swatches[$key]['type'] ) {
		$type = $swatches[$key]['type'];

		$swatch_classes = array(
			'swatch',
			'swatch--single',
			'swatch-type-' . esc_attr( $type ),
		);

		if ( $term->slug === $selected ) {
			$swatch_classes[] = 'swatch--active';
		}

		$data_variation = '';

		if ( $single_attribute ) {
			$selected_variation = uncode_wc_get_selected_variation_for_attr( $attribute_name, $term->slug, $available_variations );
			$product_url        = $available_variations[0]['product_url'];

			if ( is_array( $selected_variation ) ) {
				$product_url    = isset( $selected_variation['variation_selected_url'] ) && $selected_variation['variation_selected_url'] ? $selected_variation['variation_selected_url'] : $product_url;
				$variation_json = wp_json_encode( $selected_variation );
				$variation_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variation_json ) : _wp_specialchars( $variation_json, ENT_QUOTES, 'UTF-8', true );
				$data_variation = ' data-variation="' . $variation_attr . '"';
			}

			$data_variation .= ' data-variation-link="' . $product_url . '"';
		}

		$swatch_description = apply_filters( 'uncode_show_term_description', false, $term ) && isset( $term->description ) && $term->description ? '<span class="swatch__description">' . $term->description . '</span>': '';

		switch ( $type ) {
			case 'color':
				$color = isset( $swatches[$key]['value'] ) ? $swatches[$key]['value'] : '#EEEEEF';
				if ( $color === '#FFFFFF' || $color === '#ffffff' || $color === '#FFF' || $color === '#fff' ) {
					$swatch_classes[] = 'swatch--white';
				}

				if ( isset( $swatches[$key]['hidden'] ) && $swatches[$key]['hidden'] ) {
					$swatch_classes[] = 'hidden';
				}

				echo '<div class="' . esc_attr( implode( ' ', $swatch_classes ) ) . '" data-swatch-value="' . esc_attr( $term->slug ) . '" data-swatch-title="' . esc_attr( $term->name ) . '" style="background-color:'. esc_attr( $color ) . '" ' . $data_variation . '><span>' . esc_html( $term->name ) . $swatch_description. '</span></div>';
				break;

			case 'image':
				$image_size   = uncode_wc_get_image_swatch_size( $attribute_name );
				$swatch_classes[] = 'swatch--image-' . $image_size;
				$thumbnail_size = $image_size === 'regular' ? 'uncode_woocommerce_nav_thumbnail_regular' : 'uncode_woocommerce_nav_thumbnail_crop';

				$thumbnail_id = isset( $swatches[$key]['value'] ) ? $swatches[$key]['value'] : false;
				$image        = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, $thumbnail_size ) : wc_placeholder_img_src( $thumbnail_size );

				if ( isset( $swatches[$key]['hidden'] ) && $swatches[$key]['hidden'] ) {
					$swatch_classes[] = 'hidden';
				}

				echo '<div class="' . esc_attr( implode( ' ', $swatch_classes ) ) . '" data-swatch-value="' . esc_attr( $term->slug ) . '" data-swatch-title="' . esc_attr( $term->name ) . '" style="background-image:url('. esc_url( $image ) . ')" ' . $data_variation . '><span>' . esc_html( $term->name ) . $swatch_description . '</span></div>';
				break;

			case 'featured':
				$thumbnail_id   = isset( $swatches[$key]['value'] ) ? $swatches[$key]['value'] : false;
				$thumbnail_size = apply_filters( 'uncode_woocommerce_swatches_thumbnail_size', 'uncode_woocommerce_nav_thumbnail_crop', $term );
				$image        = $thumbnail_id ? wp_get_attachment_image( $thumbnail_id, $thumbnail_size ) : wc_placeholder_img( $thumbnail_size );

				if ( isset( $swatches[$key]['hidden'] ) && $swatches[$key]['hidden'] ) {
					$swatch_classes[] = 'hidden';
				}

				echo '<div class="' . esc_attr( implode( ' ', $swatch_classes ) ) . '" data-swatch-value="' . esc_attr( $term->slug ) . '" data-swatch-title="' . esc_attr( $term->name ) . '" ' . $data_variation . '><span>' . $image . $swatch_description . '</span></div>';
				break;

			case 'label':
				if ( isset( $swatches[$key]['hidden'] ) && $swatches[$key]['hidden'] ) {
					$swatch_classes[] = 'hidden';
				}

				echo '<div class="' . esc_attr( implode( ' ', $swatch_classes ) ) . '" data-swatch-value="' . esc_attr( $term->slug ) . '" data-swatch-title="' . esc_attr( $term->name ) . '" ' . $data_variation . '><span>' . esc_html( $term->name ) . $swatch_description . '</span></div>';
				break;
		}
	}
}

/**
 * Get the thumbnail's size of the swatch
 */
function uncode_wc_get_image_swatch_size( $attribute ) {
	$size         = 'crop';
	$atts_options = get_option( 'uncode_wc_attribute_options' );
	$tax_props    = uncode_wc_get_taxonomy_props( $attribute );
	$attribute_id = isset( $tax_props->attribute_id ) ? $tax_props->attribute_id : 0;

	if ( $attribute_id && is_array( $atts_options ) && isset( $atts_options[$attribute_id] ) && is_array( $atts_options[$attribute_id] ) && isset( $atts_options[$attribute_id]['swatch_thumbnail_size'] ) ) {
		$size = $atts_options[$attribute_id]['swatch_thumbnail_size'];
	}

	$size = $size === 'regular' || $size === 'crop' ? $size : 'crop';

	return $size;
}
