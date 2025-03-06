<?php
/**
 * Add custom settings to variations
 */

/**
 * Add galleries to variations in admin
 */
function uncode_wc_admin_get_variation_gallery_from_ajax() {
	if ( isset( $_POST[ 'nonce_uncode_wc_variation_gallery_html' ] ) ) {
		if ( ! wp_verify_nonce( $_POST[ 'nonce_uncode_wc_variation_gallery_html' ], 'uncode-variation-gallery-nonce' ) ) {
			// Invalid nonce
			wp_send_json_error(
				array(
					'error' => esc_html__( 'Invalid nonce.', 'uncode' )
				)
			);
		}

		if ( ! isset( $_POST[ 'variation_ids' ] ) ) {
			// No varation IDs
			wp_send_json_error(
				array(
					'error' => esc_html__( 'Invalid variation IDs.', 'uncode' )
				)
			);
		}

		$variation_ids = array_map( 'absint', $_POST[ 'variation_ids' ] );
		$images        = array();

		if ( is_array( $variation_ids ) && count( $variation_ids ) > 0 ) {
			foreach( $variation_ids as $variation_id ) {
				$gallery_ids = uncode_wc_get_variation_gallery_ids( $variation_id );

				ob_start();
				?>

				<input type="hidden" class="uncode-variation-gallery-ids" name="uncode_variation_gallery_ids[<?php echo esc_attr( $variation_id ) ?>]" value="<?php echo esc_attr( implode( ',', $gallery_ids ) ) ?>">

				<ul class="uncode-variation-gallery-list">
					<?php foreach( $gallery_ids as $gallery_id ) : ?>
						<?php $attachment = wp_get_attachment_image_src( $gallery_id, 'thumbnail' ); ?>

						<?php if ( $attachment ) : ?>
							<li>
								<a href="#" class="uncode-variation-gallery-thumb remove" rel="<?php echo esc_attr( $gallery_id ) ?>"><img src="<?php echo esc_attr( $attachment[0] ) ?>"></a>
							</li>
						<?php endif; ?>

					<?php endforeach; ?>
				</ul>

				<?php
				$html = ob_get_clean();
				$images[$variation_id] = $html;
			}
		}

		wp_send_json_success(
			array(
				'images' => $images
			)
		);
	} else {
		// Invalid data
		wp_send_json_error(
			array(
				'error' => esc_html__( 'Invalid data.', 'uncode' )
			)
		);
	}
}
add_action( 'wp_ajax_uncode_wc_get_variation_gallery_html', 'uncode_wc_admin_get_variation_gallery_from_ajax' );

/**
 * Get variation gallery IDs
 */
function uncode_wc_get_variation_gallery_ids( $variation_id ) {
	$ids         = array();
	$gallery_ids = get_post_meta( $variation_id, '_uncode_wc_variation_gallery_ids', true );
	$gallery_ids = explode( ',', $gallery_ids );

	if ( is_array( $gallery_ids ) ) {
		foreach ( $gallery_ids as $gallery_id ) {
			$gallery_id = absint( $gallery_id );

			if ( $gallery_id > 0 ) {
				$ids[] = $gallery_id;
			}
		}
	}

	return $ids;
}

/**
 * Save images and title when saving the variation via AJAX
 */
function uncode_wc_save_variation_on_ajax( $variation_id, $i ) {
	if ( ! isset( $_POST['uncode_variation_gallery_ids'] ) || ! isset( $_POST['uncode_variation_title'] )) {
		return;
	}

	if ( isset( $_POST['uncode_variation_gallery_ids'] ) ) {
		$ids = uncode_wc_sanitize_variation_gallery_ids( $_POST['uncode_variation_gallery_ids'][$variation_id] );

		update_post_meta( $variation_id, '_uncode_wc_variation_gallery_ids', $ids );
	}

	if ( uncode_single_variations_enabled() && isset( $_POST['uncode_variation_title'] ) ) {
		$title = esc_attr( $_POST['uncode_variation_title'][$variation_id] );

		update_post_meta( $variation_id, '_uncode_wc_variation_title', $title );
	}
}
add_action( 'woocommerce_save_product_variation', 'uncode_wc_save_variation_on_ajax', 10, 2 );

/**
 * Save images and title when saving the post (no AJAX)
 */
function uncode_wc_save_variation( $post_id, $post ) {
	// Check the nonce
	if ( empty( $_POST['woocommerce_meta_nonce'] ) || ! wp_verify_nonce( $_POST['woocommerce_meta_nonce'], 'woocommerce_save_data' ) ) {
		return;
	}

	$post_id = absint( $post_id );

	// $post_id and $post are required
	if ( empty( $post_id ) || empty( $post ) ) {
		return;
	}

	// Dont' save meta boxes for revisions or autosaves
	if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
		return;
	}

	// Check user has permission to edit
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
	if ( empty( $_POST['post_ID'] ) || absint( $_POST['post_ID'] ) !== $post_id ) {
		return;
	}

	// Check the post type
	if ( ! in_array( $post->post_type, array( 'product' ) ) ) {
		return;
	}

	// Delete check
	delete_post_meta( $post_id, 'has_variation_gallery' );

	if ( ! isset( $_POST['uncode_variation_gallery_ids'] ) ) {
		return;
	}

	$variation_gallery_ids = $_POST['uncode_variation_gallery_ids'] && is_array( $_POST['uncode_variation_gallery_ids'] ) ? $_POST['uncode_variation_gallery_ids'] : array();

	foreach ( $variation_gallery_ids as $variation_id => $images_id ) {
		$images_id = uncode_wc_sanitize_variation_gallery_ids( $images_id );

		if ( $images_id ) {
			update_post_meta( $variation_id, '_uncode_wc_variation_gallery_ids', $images_id );
		} else {
			delete_post_meta( $variation_id, '_uncode_wc_variation_gallery_ids' );
		}
	}

	if ( uncode_single_variations_enabled() ) {
		$variation_titles =$_POST['uncode_variation_title'] && is_array( $_POST['uncode_variation_title'] ) ? $_POST['uncode_variation_title'] : array();

		foreach ( $variation_titles as $variation_id => $variation_title ) {
			$variation_title = esc_attr( $variation_title );

			if ( $variation_title ) {
				update_post_meta( $variation_id, '_uncode_wc_variation_title', $variation_title );
			} else {
				delete_post_meta( $variation_id, '_uncode_wc_variation_title' );
			}
		}
	}

}
add_action( 'save_post', 'uncode_wc_save_variation', 1, 2 );

/**
 * Validate and sanitize gallery IDs
 */
function uncode_wc_sanitize_variation_gallery_ids( $ids ) {
	$array_ids     = explode( ',', $ids );
	$sanitized_ids = array();

	foreach ( $array_ids as $id ) {
		$valid_id = absint( $id );

		if ( $valid_id > 0 ) {
			$sanitized_ids[] = $valid_id;
		}
	}

	$ids = implode( ',', $sanitized_ids );
	$ids = $ids ? $ids : '';

	return $ids;
}

/**
 * Filter product gallery IDs passing the gallery attached to each variation
 */
function uncode_woocommerce_product_get_gallery_image_ids() {
	global $uncode_variation_gallery;

	return $uncode_variation_gallery;
}

/**
 * Filter product image ID (featured thumbnail) passing the
 * featured image of the variation instead
 */
function uncode_woocommerce_variation_image_id() {
	global $uncode_variation_image_id;

	return $uncode_variation_image_id;
}

/**
 * Get all default product images (when no variations are selected)
 */
function uncode_woocommerce_get_default_product_images( $product ) {
	$default_images = array(
		absint( $product->get_image_id() )
	);

	$thumbnails = $product->get_gallery_image_ids();
	if ( $thumbnails && is_array( $thumbnails ) ) {
		foreach ( $thumbnails as $thumbnail_id ) {
			$default_images[] = absint( $thumbnail_id );
		}
	}

	return $default_images;
}

/**
 * Get variation gallery via AJAX
 */
function uncode_wc_get_variation_gallery_ajax() {
	if ( isset( $_POST['variation'] ) && isset( $_POST['product_id'] ) ) {
		global $product, $post, $vc_column_inner_width;

		$variation_data   = $_POST['variation'];
		$html             = false;
		$is_clearing      = isset( $_POST['clear'] ) && $_POST['clear'] ? true : false;
		$is_module        = false;
		$shortcode_string = '';

		// Setup globals
		uncode_setup_globals();

		// Setup product
		$product_id = absint( $_POST['product_id'] );
		$product    = wc_get_product( $product_id );

		// Setup post
		if ( ! ( isset( $post->ID ) && $post->ID > 0 ) ) {
			$post = get_post( $product_id );
		}

		// Gallery options
		$gallery_params = isset( $_POST['gallery_params'] ) && is_array( $_POST['gallery_params'] ) ? $_POST['gallery_params'] : array();

		if ( isset( $gallery_params['globals'] ) && isset( $gallery_params['globals']['vc_column_inner_width'] ) ) {
			$vc_column_inner_width = $gallery_params['globals']['vc_column_inner_width'];
		}

		if ( isset( $gallery_params['shortcode_atts'] ) ) {
			$is_module       = true;
			$shortcode_atts   = $gallery_params['shortcode_atts'];
			$shortcode_string = '[uncode_single_product_gallery';

			if ( is_array( $shortcode_atts ) ) {
				foreach ( $shortcode_atts as $shortcode_att_key => $shortcode_att_value ) {
					$shortcode_string .= ' ' . $shortcode_att_key . '="' . $shortcode_att_value . '"';
				}
			}

			$shortcode_string .= ']';
		}

		if ( $variation_data === '0' ) {
			ob_start();
			if ( $is_module ) {
				// We need this to map VC shortcodes in AJAX
				WPBMap::addAllMappedShortcodes();

				echo do_shortcode( $shortcode_string );
			} else {
				woocommerce_show_product_images();
			}

			$html = ob_get_clean();
		} else if ( is_array( $variation_data ) && isset( $variation_data['variation_id'] ) ) {
			global $uncode_variation_gallery, $uncode_variation_image_id;

			// Get variation's gallery
			$uncode_variation_gallery = $variation_data['variation_gallery'];

			// Get variation's thumbnail
			$uncode_variation_image_id = isset( $variation_data['image_id'] ) ? $variation_data['image_id'] : 0;

			ob_start();

			add_filter( 'uncode_product_image_id', 'uncode_woocommerce_variation_image_id' );
			add_filter( 'post_thumbnail_id', 'uncode_woocommerce_variation_image_id' );
			add_filter( 'woocommerce_product_get_gallery_image_ids', 'uncode_woocommerce_product_get_gallery_image_ids' );
			if ( $is_module ) {
				// We need this to map VC shortcodes in AJAX
				WPBMap::addAllMappedShortcodes();

				echo do_shortcode( $shortcode_string );
			} else {
				woocommerce_show_product_images();
			}
			if ( function_exists( 'uncode_core_unhook' ) ) {
				uncode_core_unhook( 'uncode_product_image_id', 'uncode_woocommerce_variation_image_id' );
				uncode_core_unhook( 'post_thumbnail_id', 'uncode_woocommerce_variation_image_id' );
				uncode_core_unhook( 'woocommerce_product_get_gallery_image_ids', 'uncode_woocommerce_product_get_gallery_image_ids' );
			}

			$html = ob_get_clean();
		}

		if ( ! $html ) {
			// No HTML
			wp_send_json_error(
				array(
					'error' => esc_html__( 'Ivalid HTML data', 'uncode' ),
				)
			);
		} else {
			// Success
			wp_send_json_success(
				array(
					'html' => $html,
				)
			);
		}

		// No HTML
		wp_send_json_error(
			array(
				'error' => esc_html__( 'Ivalid HTML data', 'uncode' )
			)
		);
	} else {
		// Invalid data
		wp_send_json_error(
			array(
				'error' => esc_html__( 'Ivalid POST data', 'uncode' ),
			)
		);
	}
}
add_action( 'wp_ajax_uncode_get_variation_gallery', 'uncode_wc_get_variation_gallery_ajax' );
add_action( 'wp_ajax_nopriv_uncode_get_variation_gallery', 'uncode_wc_get_variation_gallery_ajax' );

/**
 * Add variation name for single products as variations
 */
function uncode_wc_add_single_variation_name( $loop, $variation_data, $variation_post ) {
	if ( uncode_single_variations_enabled() ) {
		woocommerce_wp_text_input(
			array(
				'id'            => 'uncode_variation_title' . $variation_post->ID,
				'name'          => 'uncode_variation_title[' . $variation_post->ID . ']',
				'value'         => get_post_meta( $variation_post->ID, '_uncode_wc_variation_title', true ),
				'type'          => 'text',
				'label'         => esc_attr__( 'Variation title (variations as single products)', 'uncode' ),
				'wrapper_class' => 'form-row form-row-full',
			)
		);
	}
}
add_action( 'woocommerce_product_after_variable_attributes', 'uncode_wc_add_single_variation_name', 999, 3 );
