<?php
/**
 * VC scripts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * 	Deregister VC scripts
 */
function uncode_dequeue_visual_composer() {
	$production_mode   = ot_get_option('_uncode_production');
	$suffix            = $production_mode === 'on' ? '.min' : '';
	$suffix            = apply_filters( 'uncode_scripts_suffix', $suffix, $production_mode );
	$folder            = $production_mode === 'on' ? 'min/' : '';
	$folder            = apply_filters( 'uncode_scripts_folder', $folder, $production_mode );

	wp_dequeue_style('js_composer_front');
	wp_deregister_style('js_composer_front');
	wp_dequeue_style('vc_inline_css');
	wp_deregister_style('vc_inline_css');

	if ( ! function_exists('vc_is_page_editable') || ! vc_is_page_editable() ) {
		wp_deregister_script( 'wpb_composer_front_js' );
	} else {
		wp_deregister_script('vc_inline_iframe_js');
		wp_register_script( 'vc_inline_iframe_js', plugins_url( 'assets/js/' . $folder . 'page_editable' . $suffix . '.js', __FILE__ ), array( 'jquery', 'underscore', ), UncodeCore_Plugin::VERSION);
		wp_enqueue_script( 'vc_inline_iframe_js', plugins_url( 'assets/js/' . $folder . 'page_editable' . $suffix . '.js', __FILE__ ), array( 'jquery', 'underscore', ), UncodeCore_Plugin::VERSION, true );
		wp_enqueue_script( 'uncode-frontend-app', plugins_url( 'assets/js/' . $folder . 'frontend-app' . $suffix . '.js', __FILE__ ), array( 'jquery', 'uncode-app', ), UncodeCore_Plugin::VERSION, true );
		$google_api_key = ot_get_option('_uncode_gmaps_api');
		if ($google_api_key !== '') {
			$google_api_key = '?key=' . $google_api_key;
		}
		wp_enqueue_script('google-maps-api', '//maps.googleapis.com/maps/api/js' . $google_api_key, array(), false, true);

		$theme_scripts_suffix = $production_mode === 'on' ? '.min' : '';

		wp_enqueue_script('uncode-google-maps', get_template_directory_uri() . '/library/js/uncode.gmaps' . $theme_scripts_suffix . '.js', array('google-maps-api') , UncodeCore_Plugin::VERSION, true);
	}
	wp_deregister_script('vc_pie');
	wp_deregister_script('waypoints');
}

/**
 * 	Custom frontend CSS in iframe
 */
function uncode_core_custom_vc_front_iframe_scripts() {
	wp_enqueue_style( 'uncode_js_composer_front', plugins_url( 'assets/css/vc-frontend-editor.css', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	if ( is_rtl() ) {
		wp_enqueue_style('uncode_js_composer_front-rtl', plugins_url( 'assets/css/vc-frontend-editor-rtl.css', __FILE__ ), 'uncode_js_composer_front', UncodeCore_Plugin::VERSION);
	}
}
add_action( 'vc_load_iframe_jscss', 'uncode_core_custom_vc_front_iframe_scripts' );

/**
 * 	Custom backend scripts
 */
function uncode_init_custom_js() {
	if ( ! defined( 'UNCODE_SLIM' ) ) {
		return;
	}

	wp_enqueue_style('vc-admin', plugins_url( 'assets/css/vc_admin.css', __FILE__ ), false, UncodeCore_Plugin::VERSION);

	if ( is_rtl() ) {
		wp_enqueue_style('vc-admin-rtl', plugins_url( 'assets/css/vc_admin-rtl.css', __FILE__ ), 'vc-admin', UncodeCore_Plugin::VERSION);
	}

	global $post;

	$post_id = isset( $post ) && isset( $post->ID ) ? $post->ID : 0;

	if ( function_exists( 'wp_enqueue_media' ) ) {
		wp_enqueue_media( array( 'post' => $post_id ) );
	}

	wp_enqueue_script('uncode-admin-fix-inputs', plugins_url( 'assets/js/fix_inputs.js', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	wp_enqueue_script('uncode-admin-index-items', plugins_url( 'assets/js/index_items.js', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	wp_enqueue_script('uncode-admin-extend', plugins_url( 'assets/js/js_composer_extend.js', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	wp_enqueue_script('uncode-admin-media-elements', plugins_url( 'assets/js/media_element.js', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	wp_enqueue_script('uncode-page-builder-seo', plugins_url( 'assets/js/seo.js', __FILE__ ), array('jquery-core','underscore'), UncodeCore_Plugin::VERSION, true);
	wp_enqueue_script('uncode-backend-editor', plugins_url( 'assets/js/backend-editor.js', __FILE__ ), array( 'jquery', 'vc-backend-min-js', ), UncodeCore_Plugin::VERSION, true );

	$media_el_parameters = array(
		'disable_media_filtering' => apply_filters( 'uncode_disable_media_filtering', false ),
	);

	wp_localize_script( 'uncode-admin-media-elements', 'MediaElParameters', $media_el_parameters );

	global $wp_styles;
	if ( isset( $wp_styles->registered['font-awesome'] ) ) {
		wp_dequeue_style('font-awesome');
	}
	if ( isset( $wp_styles->registered['vc_font_awesome_5'] ) ) {
		wp_dequeue_style('vc_font_awesome_5');
	}
	if ( isset( $wp_styles->registered['vc_font_awesome_5_shims'] ) ) {
		wp_dequeue_style('vc_font_awesome_5_shims');
	}
}
add_action('vc_backend_editor_render', 'uncode_init_custom_js');

/**
 * 	Custom frontend scripts
 */
function uncode_init_front_css() {
	wp_enqueue_style('vc-admin', plugins_url( 'assets/css/vc_admin.css', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	if ( is_rtl() ) {
		wp_enqueue_style('vc-admin-rtl', plugins_url( 'assets/css/vc_admin-rtl.css', __FILE__ ), 'vc-admin', UncodeCore_Plugin::VERSION);
	}
}
add_action('vc_frontend_editor_render', 'uncode_init_front_css');

function uncode_init_front_js() {
	$post_id = isset( $_GET[ 'post_id' ] ) ? $_GET[ 'post_id' ] : 0;

	if ( function_exists( 'wp_enqueue_media' ) ) {
		wp_enqueue_media( array( 'post' => $post_id ) );
	}
	wp_enqueue_script('uncode-admin-fix-inputs', plugins_url( 'assets/js/fix_inputs.js', __FILE__ ), false, UncodeCore_Plugin::VERSION, true);
	wp_enqueue_script('uncode-admin-index-items', plugins_url( 'assets/js/index_items.js', __FILE__ ), false, UncodeCore_Plugin::VERSION);
	wp_enqueue_script('uncode-admin-media-elements', plugins_url( 'assets/js/media_element.js', __FILE__ ), false, UncodeCore_Plugin::VERSION, true);

	$media_el_parameters = array(
		'disable_media_filtering' => apply_filters( 'uncode_disable_media_filtering', false ),
	);

	wp_localize_script( 'uncode-admin-media-elements', 'MediaElParameters', $media_el_parameters );

	global $wp_styles;
	if (isset($wp_styles->registered['font-awesome'])) {
		wp_dequeue_style('font-awesome');
	}
	if (isset($wp_styles->registered['vc_font_awesome_5'])) {
		wp_dequeue_style('vc_font_awesome_5');
	}
	if ( isset( $wp_styles->registered['vc_font_awesome_5_shims'] ) ) {
		wp_dequeue_style('vc_font_awesome_5_shims');
	}
}
add_action('vc_frontend_editor_hook_load_edit', 'uncode_init_front_js');

function uncode_dequeue_vc_fa() {
	wp_dequeue_style('vc_font_awesome_5');
	wp_dequeue_style('vc_font_awesome_5_shims');
}
add_action('vc_backend_editor_enqueue_js_css', 'uncode_dequeue_vc_fa');
add_action('vc_frontend_editor_enqueue_js_css', 'uncode_dequeue_vc_fa');

function uncode_frontend_re_register_script() {
	if ( function_exists('vc_is_frontend_editor') && vc_is_frontend_editor() ) {
		$production_mode   = ot_get_option('_uncode_production');
		$suffix            = $production_mode === 'on' ? '.min' : '';
		$suffix            = apply_filters( 'uncode_scripts_suffix', $suffix, $production_mode );
		$folder            = $production_mode === 'on' ? 'min/' : '';
		$folder            = apply_filters( 'uncode_scripts_folder', $folder, $production_mode );

		// Frontend editor main JS file
		wp_deregister_script('vc-frontend-editor-min-js');
		wp_register_script( 'vc-frontend-editor-min-js', plugins_url( 'assets/js/' . $folder . 'frontend-editor' . $suffix . '.js', __FILE__ ), array( 'jquery-core', 'vc_accordion_script'), UncodeCore_Plugin::VERSION);
		wp_enqueue_script( 'vc-frontend-editor-min-js', plugins_url( 'assets/js/' . $folder . 'frontend-editor' . $suffix . '.js', __FILE__ ), array( 'jquery-core', 'vc_accordion_script'), UncodeCore_Plugin::VERSION, true );
		wp_localize_script( 'vc-frontend-editor-min-js', 'i18nLocale', visual_composer()->getEditorsLocale() );

		// Removes Gutenberg styles from Frontend Editor
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' );

		if ( function_exists( 'uncode_core_get_front_editor_shortkeys' ) ) {
			wp_localize_script( 'vc-frontend-editor-min-js', 'uncodeFrontEditorShortkeysConf', uncode_core_get_front_editor_shortkeys_configuration() );
		}

		// Add nonce to cleanup Dynamic CSS shortcode atts
		wp_localize_script( 'vc-frontend-editor-min-js', 'uncodeFrontEditorCleanupNonce', array( 'nonce' => wp_create_nonce( 'uncode-clean-dynamic-css-shortcode-nonce' ) ) );

		// Unneeded admin styles
		wp_dequeue_style('uncode-privacy');
		wp_deregister_style('uncode-privacy');
		wp_deregister_script('uncode-privacy');
		wp_deregister_script('uncode-featured-images');

		if ( apply_filters( 'uncode_core_remove_woocommerce_scripts_on_frontend_editor', true ) ) {
			// Remove Woocommerce scripts
			global $wp_scripts;
			if ( isset( $wp_scripts->registered ) && is_array( $wp_scripts->registered ) ) {
				foreach ( $wp_scripts->registered as $registered_script ) {
					if ( isset( $registered_script->src ) && ( strpos( $registered_script->src, 'woocommerce/packages/woocommerce-admin' ) !== false || strpos( $registered_script->src, 'woocommerce/packages/woocommerce-blocks' ) !== false ) ) {
						if ( isset( $registered_script->handle ) && $registered_script->handle ) {
							wp_deregister_script( $registered_script->handle );
						}
					}
				}
			}
			// Remove Woocommerce styles
			global $wp_styles;
			if ( isset( $wp_styles->registered ) && is_array( $wp_styles->registered ) ) {
				foreach ( $wp_styles->registered as $registered_style ) {
					if ( isset( $registered_style->src ) && ( strpos( $registered_style->src, 'woocommerce/packages/woocommerce-admin' ) !== false || strpos( $registered_style->src, 'woocommerce/packages/woocommerce-blocks' ) !== false ) ) {
						if ( isset( $registered_style->handle ) && $registered_style->handle ) {
							wp_deregister_style( $registered_style->handle );
						}
					}
				}
			}
		}
	}
}
add_action('admin_enqueue_scripts', 'uncode_frontend_re_register_script');

/**
 * Remove custom VC scripts when Gutenberg is active
 */
function uncode_core_remove_custom_vc_scripts_if_gutenberg_is_active() {
	if ( ! is_admin() ) {
		return;
	}

	if ( ! function_exists( 'uncode_is_gutenberg_current_editor' ) || ! function_exists( 'use_block_editor_for_post_type' ) ) {
		return;
	}

	$screen    = get_current_screen();
	$post_type = isset( $screen->post_type ) ? $screen->post_type : false;

	if ( $post_type && uncode_is_gutenberg_current_editor( $post_type ) ) {
		remove_action('vc_backend_editor_render', 'uncode_init_custom_js');
	}
}
add_action( 'admin_print_styles', 'uncode_core_remove_custom_vc_scripts_if_gutenberg_is_active' );
