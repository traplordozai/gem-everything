<?php

/**
 * Declare WC features support
 */
if ( ! function_exists( 'uncode_woocommerce_support' ) ) :
	/**
	 * @since Uncode 1.6.0
	 */
	function uncode_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

		if ( ot_get_option( '_uncode_woocommerce_default_product_gallery' ) === 'on' ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
	}
endif;//uncode_woocommerce_support
add_action( 'after_setup_theme', 'uncode_woocommerce_support' );

/**
 * Opt-out from customize store
 */
function uncode_woocommerce_admin_get_feature_config( $config ) {
	$config['customize-store'] = false;

	return $config;
}
add_filter( 'woocommerce_admin_get_feature_config', 'uncode_woocommerce_admin_get_feature_config' );

/**
 * Main WC scripts
 */
function uncode_wc_scripts() {
	$scripts_prod_conf  = uncode_get_scripts_production_conf();
	$resources_version  = $scripts_prod_conf[ 'resources_version' ];
	$suffix             = $scripts_prod_conf[ 'suffix' ];
	$is_frontend_editor = function_exists( 'vc_is_page_editable' ) && vc_is_page_editable() ? true : false;
	$split_js           = $is_frontend_editor ? false : uncode_can_split_js();

	if ( ot_get_option( '_uncode_woocommerce_atc_notify' ) == 'minicart' && ot_get_option('_uncode_woocommerce_cart') === 'on' ) {
	    wp_enqueue_script( 'imagesloaded' );
	}

	if ( ! $split_js ) {
		wp_enqueue_script( 'woocommerce-uncode', get_template_directory_uri() . '/library/js/woocommerce-uncode' . $suffix . '.js', array( 'jquery', 'wc-cart-fragments' ) , $resources_version, 'all');
		uncode_wc_localize_scripts();
	}
}
add_action( 'wp_enqueue_scripts', 'uncode_wc_scripts', 1000 );

/**
 * Localize WC scripts
 */
function uncode_wc_localize_scripts() {
	$uncode_wc_parameters = apply_filters( 'uncode_enqueue_wc_parameters', array(
		'ajax_url'                        => admin_url( 'admin-ajax.php' ),
		'cart_url'                        => wc_get_cart_url(),
		'empty_cart_url'                  => uncode_woocommerce_get_empty_cart_page_url(),
		'redirect_after_add'              => get_option( 'woocommerce_cart_redirect_after_add' ) === 'yes' ? true : false,
		'variations_ajax_add_to_cart'     => get_option( 'woocommerce_enable_ajax_add_to_cart' ) === 'yes' && ot_get_option('_uncode_product_enable_ajax_add_to_cart') == 'on' ? true : false,
		'swatches_with_url_selection'     => apply_filters( 'uncode_woocommerce_swatches_with_url_selection', true ),
		'i18n_add_to_cart_text'           => __( 'Add to cart', 'woocommerce' ),
		'i18n_variation_add_to_cart_text' => __( 'Select options', 'woocommerce' ),
		'pa_filter_prefix'                => UNCODE_FILTER_PREFIX_PA,
		'yith_ajax_wishlist'              => ! is_product() && class_exists( 'YITH_WCWL' ) && 'yes' === get_option( 'yith_wcwl_ajax_enable', 'no' ) ? true : false,
		'swatches_use_custom_find'        => apply_filters( 'uncode_woocommerce_swatches_use_custom_find', false ),
		'activate_input_check_on_click'   => apply_filters( 'uncode_woocommerce_activate_input_check_on_click', false ),
		'uncode_wc_widget_product_categories_home_url' => esc_js( home_url( '/' ) ),
		'uncode_wc_widget_product_categories_shop_url' => esc_js( wc_get_page_permalink( 'shop' ) ),
		'uncode_wc_widget_product_categories_placeholder' => esc_js( __( 'Select a category', 'woocommerce' ) ),
		'uncode_wc_widget_product_categories_no_results' => esc_js( _x( 'No matches found', 'enhanced select', 'woocommerce' ) ),
		'default_notices' => apply_filters( 'uncode_woocommerce_default_notices', false ),
	) );

	wp_localize_script( 'woocommerce-uncode', 'UncodeWCParameters', $uncode_wc_parameters );
}

/**
 * WC dependent scripts
 */
function uncode_wc_dependent_scripts() {
    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

	if ( apply_filters( 'uncode_dequeue_prettyphoto', true ) ) {
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
	}

	if ( apply_filters( 'uncode_deregister_select2_style', true ) ) {
		wp_deregister_style( 'select2');
	}
    wp_dequeue_script( 'wc-chosen');
}
add_action( 'wp_enqueue_scripts', 'uncode_wc_dependent_scripts', 99 );

/**
 * Dequeue default WC scripts
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Admin WC scripts
 */
function uncode_wc_admin_scripts() {
	if ( get_post_type() === 'product' ) {
		wp_enqueue_style( 'uncode-wc-product-admin', get_template_directory_uri() . '/core/assets/css/uncode-wc-product.css', array(), UNCODE_VERSION );
		wp_enqueue_script( 'uncode-wc-product-admin', get_template_directory_uri() . '/core/assets/js/min/uncode-wc-product-admin.min.js', array( 'jquery' ), UNCODE_VERSION , true );

		$uncode_admin_product_params = array(
			'default_gallery_enabled'          => ot_get_option( '_uncode_woocommerce_default_product_gallery' ) === 'on' ? true : false,
			'enable_debug'                     => apply_filters( 'uncode_enable_debug_on_js_scripts', false ),
			'variation_gallery_nonce'          => wp_create_nonce( 'uncode-variation-gallery-nonce' ),
			'i18n_variation_gallery_title'     => __( 'Gallery Images', 'uncode' ),
			'i18n_variation_gallery_add'       => __( 'Add images', 'uncode' ),
			'i18n_variation_gallery_media_add' => __( 'Add Variation Images', 'uncode' ),
		);

		wp_localize_script( 'uncode-wc-product-admin', 'UncodeAdminProductParams', $uncode_admin_product_params );
	}
}
add_filter( 'admin_enqueue_scripts', 'uncode_wc_admin_scripts' );

/**
 * When using AJAX, pass the correct quantity when adding a product to the cart
 */
function uncode_wc_loop_add_to_cart_scripts() {
    if ( is_shop() || is_product_category() || is_product_tag() || is_product() ) : ?>

		<script>
			window.addEventListener("load", function(){
				jQuery( document ).on( 'change', '.quantity .qty', function() {
					jQuery( this ).closest('form.cart').find('.add_to_cart_button').attr( 'data-quantity', jQuery( this ).val() );
				});
			}, false);
		</script>

    <?php endif;

	if ( isset( $_REQUEST['add-to-cart'] ) ) : ?>

		<script>
			(function( $ ) {
				$( document.body ).trigger( 'uncode-wc-added-to-cart' );
			})(jQuery);
		</script>

    <?php endif;

}
add_action( 'wp_footer', 'uncode_wc_loop_add_to_cart_scripts' );

/**
 * Add class to body
 */
function uncode_wc_body_classes( $classes ) {
	if ( isset( $_REQUEST['add-to-cart'] ) ) {
		$classes[] = 'uncode-wc-added-to-cart';
	}

	if ( ! uncode_is_sidecart_mobile_enabled() ) {
		$classes[] = 'uncode-sidecart-mobile-disabled';
	}

	if ( is_cart() && WC()->cart->is_empty() ) {
		$classes[] = 'cart-is-empty';
	}

	if ( is_checkout() ) {
		if ( WC()->cart->needs_payment() ) {
			ob_start();
			$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
			ob_end_clean();
		} else {
			$available_gateways = array();
		}

		if ( count( $available_gateways ) > 1 ) {
			$classes[] = 'has-multiple-gateways';
		} else {
			$classes[] = 'has-single-gateway';
		}
	}

	if ( ot_get_option('_uncode_woocommerce_default_product_gallery') === 'on' ) {
		$classes[] = 'uncode-default-product-gallery';
	}

	return $classes;

}
add_action( 'body_class', 'uncode_wc_body_classes' );

/**
 * Get remove product URL
 */
if ( ! function_exists( 'uncode_wc_get_cart_remove_url' ) ) :
	/**
	 * @since Uncode 1.7.3
	 */
	function uncode_wc_get_cart_remove_url($cart_item_key) {
		if ( function_exists( 'wc_get_cart_remove_url' ) ) {
			return wc_get_cart_remove_url($cart_item_key);
		} else {
			return WC()->cart->get_remove_url( $cart_item_key );
		}
	}
endif;//uncode_wc_get_cart_remove_url

/**
 * Get formatted cart item data
 */
if ( ! function_exists( 'uncode_wc_get_formatted_cart_item_data' ) ) :
	/**
	 * @since Uncode 1.7.3
	 */
	function uncode_wc_get_formatted_cart_item_data($cart_item) {

		if ( function_exists( 'wc_get_formatted_cart_item_data' ) ) {
			return wc_get_formatted_cart_item_data($cart_item);
		} else {
			return WC()->cart->get_item_data( $cart_item );
		}
	}
endif;//uncode_wc_get_formatted_cart_item_data

/**
 * Hide product title
 */
function uncode_woocommerce_hide_product_title() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
}

/**
 * Reset WC loop
 */
function uncode_wc_single_reset_loop() {
	unset( $GLOBALS['woocommerce_loop'] );
}
add_action( 'woocommerce_after_shop_loop_item', 'uncode_wc_single_reset_loop', 999 );

/**
 * Custom checkout button
 */
function woocommerce_button_proceed_to_checkout() {
	$checkout_url = wc_get_checkout_url();

	?>
	<a href="<?php echo esc_url($checkout_url); ?>" class="checkout-button btn btn-default alt wc-forward <?php echo uncode_btn_style(); ?>"><?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?></a>
	<?php
}

/**
 * Custom variation add to cart button get template
 */
function woocommerce_single_variation_add_to_cart_button() {
	$args = apply_filters( 'uncode_woocommerce_single_variation_add_to_cart_button_args', array() );
	wc_get_template( 'single-product/add-to-cart/variation-add-to-cart-button.php', $args );
}

/**
 * Load single product JS in Single Product builder
 */
if ( ! function_exists( 'woocommerce_product_builder_wp_enqueue_scripts' ) ) :
	/**
	 * @since Uncode 1.7.3
	 */
	function woocommerce_product_builder_wp_enqueue_scripts() {
		global $post;
		$post_type = isset( $post->post_type ) ? $post->post_type : 'post';
		if ( ( class_exists( 'WooCommerce' ) && function_exists('vc_is_page_editable') && vc_is_page_editable() ) || $post_type == 'uncodeblock' ) {
			wp_enqueue_script( 'wc-single-product' );
			wp_enqueue_script( 'zoom' );
		}
	}
endif;//woocommerce_product_builder_wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'woocommerce_product_builder_wp_enqueue_scripts', 100 );

/**
 * Track product views.
 *
 * (basically a copy of wc_track_product_view())
 */
function uncode_woocommerce_track_product_view() {
	if ( ! is_singular( 'product' ) || is_active_widget( false, false, 'woocommerce_recently_viewed_products', true ) || apply_filters( 'uncode_woocommerce_disable_product_view_tracking', false ) ) {
		return;
	}

	global $post;

	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
		$viewed_products = array();
	} else {
		$viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
	}

	// Unset if already in viewed products list.
	$keys = array_flip( $viewed_products );

	if ( isset( $keys[ $post->ID ] ) ) {
		unset( $viewed_products[ $keys[ $post->ID ] ] );
	}

	$viewed_products[] = $post->ID;

	if ( count( $viewed_products ) > 15 ) {
		array_shift( $viewed_products );
	}

	// Store for session only.
	wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}
add_action( 'template_redirect', 'uncode_woocommerce_track_product_view', 20 );

/**
 * Wrapper for wc_wp_theme_get_element_class_name()
 * that checks if the functions exists
 */
function uncode_wc_wp_theme_get_element_class_name( $element ) {
	if ( function_exists( 'wc_wp_theme_get_element_class_name' ) ) {
		return wc_wp_theme_get_element_class_name( $element );
	} else {
		return '';
	}
}

/**
 * Mark store theme completed
 */
function uncode_woocommerce_mark_theme_completed() {
	$woocommerce_task_list_tracked_completed_actions = get_option( 'woocommerce_task_list_tracked_completed_actions', array() );

	$woocommerce_task_list_tracked_completed_actions[] = 'appearance';

	update_option( 'woocommerce_task_list_tracked_completed_actions', array_unique( $woocommerce_task_list_tracked_completed_actions ) );
}
add_action( 'uncode_upgraded', 'uncode_woocommerce_mark_theme_completed' );

/**
 * Increase variation threshold
 */
function uncode_woocommerce_variation_threshold( $threshold) {
	$threshold = uncode_wc_swatches_global_active() ? 1000 : $threshold;

	return $threshold;
}
add_filter( 'woocommerce_ajax_variation_threshold', 'uncode_woocommerce_variation_threshold' );
