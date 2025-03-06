<?php

$theme = wp_get_theme();

if ( $theme->parent() ) {
	$parent_theme_version = $theme->parent()->version;
} else {
	$parent_theme_version = $theme->get( 'Version' );
}

define('UNCODE_PARENT_VERSION', $parent_theme_version);
define('UNCODE_VERSION', $theme->get( 'Version' ));
define('UNCODE_SLIM', true);
define('UNCODE_NAME', $theme->get( 'Name' ));
define('UNCODE_ICONS_PATH', get_template_directory_uri() . '/core/assets/icons/selection.json');

if ( ! function_exists( 'uncode_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function uncode_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on uncode, use a find and replace
	 * to change 'uncode' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'uncode', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Enable support for Custom Logo.
	 */
	$logo_defaults = array(
		'height'      => 50,
		'width'       => 150,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array(),
	);
	add_theme_support( 'custom-logo', $logo_defaults );

	/*
	 * Enable support for Custom Headers.
	 */
	$header_defaults = array(
		'height'      => 475,
		'header-text' => false,
		'flex-width'  => true,
		'flex-height' => true,
    );
    add_theme_support( 'custom-header', $header_defaults );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'uncode' ),
		'secondary' => esc_html__( 'Secondary Menu', 'uncode' ),
		'cta' => esc_html__( 'Call To Action Menu', 'uncode' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'uncode_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * Add small thumbnails.
	 */
	add_image_size( 'uncode_woocommerce_nav_thumbnail_regular', 350 );
	add_image_size( 'uncode_woocommerce_nav_thumbnail_crop', 348, 348, true );
}
endif; // uncode_setup
add_action( 'after_setup_theme', 'uncode_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uncode_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uncode_content_width', 840 );
}
add_action( 'after_setup_theme', 'uncode_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function uncode_widgets_init()
{
	$sidebars_array = ot_get_option('_uncode_sidebars');
	if (isset($sidebars_array) && $sidebars_array !== '') {
		$sidebars = is_array($sidebars_array) ? $sidebars_array : array($sidebars_array);
		foreach ($sidebars as $key => $value)
		{
			if (isset($value['_uncode_sidebar_unique_id']) && $value['_uncode_sidebar_unique_id'] !== '') {
				$sidebar_name = $value['_uncode_sidebar_unique_id'];
				register_sidebar(array(
					'name' => $value['title'],
					'id' => $sidebar_name,
					'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'uncode' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s widget-container collapse-init sidebar-widgets">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
				));
			}
		}
	}

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'uncode' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'uncode' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s widget-container collapse-init sidebar-widgets">',
		'after_widget'  => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action('widgets_init', 'uncode_widgets_init');

function uncode_unclean_url( $tag, $handle, $src ){
	if (false !== strpos($src, 'ai-uncode')){
		global $ai_bpoints, $adaptive_images_async, $wp_version;

		if (! $ai_bpoints) {
			$ai_sizes = uncode_get_default_breakpoint_sizes();
		} else {
			$ai_sizes = implode(',', $ai_bpoints);
		}

		$url_parts    = parse_url($src);
		$url_home     = parse_url(home_url());
		$url_home     = (isset($url_home['path'])) ? '/' . trim($url_home['path'], '/') . '/' : '/';
		$explode_path = explode('/', trim($url_parts['path'], '/'));
		$is_content   = false;

		foreach ($explode_path as $key => $value) {
			if ($value === 'wp-content') {
				$is_content = true;
			}
			if ($is_content) {
				unset($explode_path[$key]);
			}
		}

		if (count($explode_path) > 0) {
			$path_domain = '/' . implode('/', $explode_path) . '/';
		} else {
			$path_domain = '/';
		}

		$ai_async = ($adaptive_images_async === 'on') ? " data-async='true'" : "";

		// Mobile advanced settings
		$mobile_advanced          = ot_get_option('_uncode_adaptive_mobile_advanced');
		$limit_density            = ot_get_option('_uncode_adaptive_limit_density');
		$use_current_device_width = ot_get_option('_uncode_adaptive_use_orientation_width');

		// Mobile advanced settings
		$data_mobile_advanced = '';

		if ( $mobile_advanced == 'on' ) {
			if ( $limit_density == 'on' ) {
				$data_mobile_advanced .= "data-limit-density='true' ";
			}

			if ( $use_current_device_width == 'on' ) {
				$data_mobile_advanced .= "data-use-orientation-width='true' ";
			}
		}

		if ( version_compare( $wp_version, '6.4', '>=' ) ) {
			$tag = str_replace( $src, apply_filters( 'uncode_ai_script_path', $url_parts['path'], $url_parts ) . '" ' . $data_mobile_advanced . 'id="uncodeAI"'.$ai_async.' data-home="'.$url_home.'" data-path="'.$path_domain.'" data-breakpoints-images="' . $ai_sizes, $tag );
		} else {
			$tag = str_replace( $src, apply_filters( 'uncode_ai_script_path', $url_parts['path'], $url_parts ) . "' " . $data_mobile_advanced . "id='uncodeAI'".$ai_async." data-home='".$url_home."' data-path='".$path_domain."' data-breakpoints-images='" . $ai_sizes, $tag );
		}


	}

	return $tag;
}

function uncode_oembed_result($html, $url, $args) {
	if(strpos($url, 'youtu.be') !== false || strpos($url, 'youtube.com') !== false){
		if (gettype($args) === 'array') {
			$args = http_build_query($args);
		}
		if ($args !== '') {
			$html = str_replace("?feature=oembed", "?feature=oembed&" . $args, $html);
		}
  }
  if(strpos($url, 'vimeo.com') !== false){
  	if (gettype($args) === 'array') {
  		$args = http_build_query($args);
  	}
  	$parse_url = parse_url($url);
  	if ($args !== '') {
  		$html = str_replace($parse_url['path'], $parse_url['path'] . "?" . $args, $html);
  	}
  }
  return $html;
}

add_filter('oembed_result','uncode_oembed_result', 10, 3);

/**
 * Setup Uncode globals.
 */
function uncode_setup_globals() {
	global $adaptive_images, $adaptive_images_async, $adaptive_images_async_blur, $dynamic_srcset_active, $dynamic_srcset_sizes, $dynamic_srcset_bg_mobile_size, $register_adaptive_meta, $ai_sizes, $ai_bpoints, $resize_image_quality, $activate_webp, $enable_adaptive_dynamic_img, $enable_adaptive_dynamic_bg;

	$enable_adaptive_dynamic_img = true;
	$enable_adaptive_dynamic_bg  = true;

	if ( defined( 'WP_ROCKET_VERSION' ) ) {
		if ( get_rocket_option( 'lazyload' ) ) {
			$enable_adaptive_dynamic_img = false;
		}

		if ( get_rocket_option( 'lazyload_css_bg_img' ) ) {
			$enable_adaptive_dynamic_bg = false;
		}
	}

	// Register meta
	$register_adaptive_meta = ot_get_option('_uncode_adaptive_register_meta') === 'on' ? true : false;

	// Adaptive images
	$adaptive_images = ot_get_option('_uncode_adaptive');
	$adaptive_images_async = ot_get_option('_uncode_adaptive_async');
	$adaptive_images_async_blur = ot_get_option('_uncode_adaptive_async_blur');
	$ai_sizes = ot_get_option('_uncode_adaptive_sizes');
	if ($ai_sizes === '') {
		$ai_sizes = uncode_get_default_breakpoint_sizes();
	}
	$ai_sizes = preg_replace('/\s+/', '', $ai_sizes);
	$ai_bpoints = explode(',', $ai_sizes);
	$resize_image_quality = ot_get_option('_uncode_adaptive_quality');

	// Dynamic SRCSET
	$dynamic_srcset_active = $adaptive_images === 'off' && ot_get_option('_uncode_dynamic_srcset') === 'on' ? true : false;

	// Always activate the registratione of the adaptive meta
	// PS. Added here to make it always active, even when we are
	// in the frontend editor (se below when we deactivate the srcset)
	if ( $dynamic_srcset_active ) {
		$register_adaptive_meta = true;
	}

	if (function_exists('vc_is_page_editable') && vc_is_page_editable()) {
		$dynamic_srcset_active = false;
	}

	if ( $dynamic_srcset_active ) {
		$dynamic_srcset_sizes = ot_get_option('_uncode_dynamic_srcset_sizes');
		if ($dynamic_srcset_sizes === '') {
			$dynamic_srcset_sizes = '720,1032';
		}
		$dynamic_srcset_sizes = preg_replace('/\s+/', '', $dynamic_srcset_sizes);
		$dynamic_srcset_sizes = explode(',', $dynamic_srcset_sizes);
		$dynamic_srcset_bg_mobile_size = absint( ot_get_option('_uncode_dynamic_srcset_bg_mobile_size') );
		$activate_webp = apply_filters( 'uncode_activate_webp', false );
	}
}

/**
 * Enqueue scripts and styles.
 */
function uncode_equeue() {

	global $LOGO, $adaptive_images, $adaptive_images_async, $dynamic_srcset_active, $dynamic_srcset_bg_mobile_size, $register_adaptive_meta, $ai_sizes, $general_style, $menutype, $post, $resize_image_quality, $activate_webp, $uncode_post_data;

	$LOGO = new stdClass;
	$logo_switchable = ot_get_option('_uncode_logo_switch');
	$logo_mobile_switch = ot_get_option('_uncode_logo_mobile_switch');
	if ($logo_switchable === 'on') {
		$logo_light = ot_get_option('_uncode_logo_light');
		$logo_dark = ot_get_option('_uncode_logo_dark');
		$LOGO->logo_id = array($logo_light,$logo_dark);

		if ( $logo_mobile_switch === 'on' ) {
			$logo_mobile_light = ot_get_option('_uncode_logo_mobile_light');
			$logo_mobile_dark = ot_get_option('_uncode_logo_mobile_dark');
			$LOGO->logo_mobile_id = array($logo_mobile_light,$logo_mobile_dark);
		}
	} else {
		$LOGO->logo_id = ot_get_option('_uncode_logo');
		if ( $logo_mobile_switch === 'on' ) {
			$LOGO->logo_mobile_id = ot_get_option('_uncode_logo_mobile');
		}
	}
	$LOGO->logo_min = ot_get_option('_uncode_min_logo');
	$LOGO->logo_height = ot_get_option('_uncode_logo_height');

	$general_style = ot_get_option('_uncode_general_style');
	if ($general_style === '') {
		$general_style = 'light';
	}
	$menutype = ot_get_option('_uncode_headers');
	$main_width = ot_get_option('_uncode_main_width');

	// Check if we are in the frontend editor
	$is_frontend_editor = function_exists( 'vc_is_page_editable' ) && vc_is_page_editable() ? true : false;

	// Setup globals
	uncode_setup_globals();

	$scripts_prod_conf = uncode_get_scripts_production_conf();
	$resources_version = $scripts_prod_conf[ 'resources_version' ];
	if ( function_exists('get_rocket_option') && ( get_rocket_option( 'remove_query_strings' ) || get_rocket_option( 'minify_css' ) || get_rocket_option( 'minify_js' ) ) || ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ) {
		$resources_version = null;
	}

	// Check if we can split the assets
	$split_css = $is_frontend_editor ? false : uncode_can_split_css();
	$split_js  = $is_frontend_editor ? false : uncode_can_split_js();

	if ( $split_css || $split_js ) {
		$page_assets = uncode_get_page_assets();
	}
	$whenever_page_assets = uncode_get_whenever_page_assets();

	/** CSS */
	if ( $split_css ) {
		if ( uncode_can_inline_main_core_style() ) {
			wp_enqueue_style('uncode-style', get_template_directory_uri() . '/style.css', array() , $resources_version, 'all');
		} else {
			wp_enqueue_style('uncode-style', get_template_directory_uri() . '/library/css/style-core.css', array() , $resources_version, 'all');
		}

		foreach ( $page_assets as $page_asset_key => $page_asset_value ) {
			uncode_enqueue_style( $page_asset_value, $resources_version );
		}
	} else {
		wp_enqueue_style('uncode-style', get_template_directory_uri() . '/library/css/style.css', array() , $resources_version, 'all');

		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'uncode-woocommerce', get_template_directory_uri() . '/library/css/woocommerce.css', array() , $resources_version, 'all');
		}

	}

	foreach ( $whenever_page_assets as $page_asset_key => $whenever_page_asset_value ) {
		uncode_enqueue_style( $whenever_page_asset_value, $resources_version );
	}

	wp_enqueue_style('uncode-icons', get_template_directory_uri() . '/library/css/uncode-icons.css', array() , $resources_version, 'all');

	// WC Variation Swatches Pro
	if ( class_exists( 'Woo_Variation_Swatches_Pro' ) ) {
		wp_enqueue_style( 'uncode-woo-variation-swatches-pro', get_template_directory_uri() . '/library/css/woo-variation-swatches.css', array() , $resources_version, 'all');
	}

	$front_css = get_template_directory() . '/library/css/';
	$ot_id     = is_multisite() ? get_current_blog_id() : '';
	if ( ! uncode_can_inline_style_custom_style() && ( apply_filters( 'uncode_force_dynamic_style_load', false ) || file_exists($front_css . 'style-custom'.$ot_id.'.css') && wp_is_writable($front_css . 'style-custom'.$ot_id.'.css') && ! uncode_append_custom_styles_to_head() ) ) {
		$dynamic_css_exists = true;
		if ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
			$resources_version = rand();
		}
		$style_custom_ver = $resources_version;
		if ( apply_filters( 'uncode_use_style_custom_ver', false ) ) {
			$last_style_custom_ver = get_option( 'uncode_style_custom_last_update' );
			if ( $last_style_custom_ver ) {
				$style_custom_ver = $last_style_custom_ver;
			}
		}
		wp_enqueue_style('uncode-custom-style', get_template_directory_uri() . '/library/css/style-custom'.$ot_id.'.css', array() , $style_custom_ver, 'all');
	} else {
		$dynamic_css_exists = false;
		$styles = uncode_create_dynamic_css( true );
		wp_add_inline_style( 'uncode-style', uncode_compress_css_inline($styles['custom']));
	}

	// Don't load custom CSS in the front editor
	if ( ! ( function_exists( 'vc_is_page_editable' ) && vc_is_page_editable() ) ) {
		$uncode_get_dynamic_css = uncode_get_page_dynamic_css();

		if ( $uncode_get_dynamic_css ) {
			$uncode_dynamic_css_handle = $dynamic_css_exists ? 'uncode-custom-style' : 'uncode-style';
			$uncode_dynamic_css_handle = apply_filters( 'uncode_dynamic_css_handle', $uncode_dynamic_css_handle, $dynamic_css_exists );

			wp_add_inline_style( $uncode_dynamic_css_handle, uncode_compress_css_inline( $uncode_get_dynamic_css ) );
		}
	}

	// Native media player
	$native_media_player = ot_get_option('_uncode_media_player') === 'on';

	/** Add JS parameters to frontend */
	$parallax_factor = ot_get_option('_uncode_parallax_factor');
	if ($parallax_factor === '') {
		$parallax_factor = 2.5;
	}
	$constant_scroll = ot_get_option('_uncode_scroll_constant');
	if ($constant_scroll === '') {
		$constant_scroll = 'on';
	}
	$constant_factor = ot_get_option('_uncode_scroll_constant_factor');
	if ($constant_factor === '') {
		$constant_factor = 2;
	}
	$scroll_speed_value = ot_get_option('_uncode_scroll_speed_value');
	if ($scroll_speed_value === '') {
		$scroll_speed_value = 1000;
	}
	$scroll_speed = ($constant_scroll === 'on') ? $constant_factor : $scroll_speed_value;
	if ($scroll_speed == 0 && $constant_scroll === 'on') {
		$scroll_speed = 0.1;
	}

	if ( uncode_post_data_is_singular() ) {
		$smooth_scroll = get_post_meta( $uncode_post_data['ID'], '_uncode_specific_smooth_scroll', true );
	}

	$smooth_scroll = (isset($smooth_scroll) && $smooth_scroll !== '') ? $smooth_scroll : ot_get_option('_uncode_smooth_scroll');

	$site_parameters = array(
		'days'                       => esc_html__( 'days', 'uncode' ),
		'hours'                      => esc_html__( 'hours', 'uncode' ),
		'minutes'                    => esc_html__( 'minutes', 'uncode' ),
		'seconds'                    => esc_html__( 'seconds', 'uncode' ),
		'constant_scroll'            => $constant_scroll ,
		'scroll_speed'               => $scroll_speed ,
		'parallax_factor'            => ($parallax_factor / 10) ,
		'loading'                    => esc_html__( 'Loading…', 'uncode' ),
		'slide_name'                 => esc_html__( 'slide', 'uncode' ),
		'slide_footer'               => esc_html__( 'footer', 'uncode' ),
		'ajax_url'                   => admin_url( 'admin-ajax.php' ),
		'nonce_adaptive_images'      => wp_create_nonce( 'uncode-adaptive-images-nonce' ),
		'nonce_srcset_async'         => wp_create_nonce( 'uncode-nonce_srcset-async-nonce' ),
		'enable_debug'               => apply_filters( 'uncode_enable_debug_on_js_scripts', false ),
		'block_mobile_videos'        => apply_filters( 'uncode_block_mobile_videos', false ),
		'is_frontend_editor'         => $is_frontend_editor,
		'main_width'				 => $main_width,
		'mobile_parallax_allowed'    => apply_filters( 'uncode_mobile_parallax_allowed', false ),
		'listen_for_screen_update'   => apply_filters( 'uncode_listen_for_screen_update', true ),
		'wireframes_plugin_active'   => class_exists( 'Uncode_Wireframes' ) ? true : false,
		'sticky_elements'			 => apply_filters( 'uncode_sticky_elements', ot_get_option('_uncode_sticky_elements') ),
		'resize_quality'             => $resize_image_quality,
		'register_metadata'          => $register_adaptive_meta,
		'bg_changer_time'			 => floatval( apply_filters( 'uncode_bg_changer_time', 1000 ) ),
		'update_wc_fragments'		 => apply_filters( 'uncode_update_wc_fragments_on_load', true ),
		'optimize_shortpixel_image'	 => apply_filters( 'uncode_optimize_shortpixel_image', false ),
		'menu_mobile_offcanvas_gap'	 => apply_filters( 'uncode_mobile_offcanvas_gap', 45 ),
		'custom_cursor_selector'	 => apply_filters( 'uncode_custom_cursor_selector', '[href], .trigger-overlay, .owl-next, .owl-prev, .owl-dot, input[type="submit"], input[type="checkbox"], button[type="submit"], a[class^="ilightbox"], .ilightbox-thumbnail, .ilightbox-prev, .ilightbox-next, .overlay-close, .unmodal-close, .qty-inset > span, .share-button li, .uncode-post-titles .tmb.tmb-click-area, .btn-link, .tmb-click-row .t-inside, .lg-outer button, .lg-thumb img, a[data-lbox], .uncode-close-offcanvas-overlay, .uncode-nav-next, .uncode-nav-prev, .uncode-nav-index' ),
		'mobile_parallax_animation'  => apply_filters( 'uncode_mobile_parallax_animation_allowed', false ),
		'lbox_enhanced'				 => apply_filters( 'uncode_lightgallery', get_option( 'uncode_core_settings_opt_lightbox_enhance' ) === 'on' ),
		'native_media_player'		 => apply_filters( 'uncode_native_mediaplayer', $native_media_player ),
		'vimeoPlayerParams'			 => apply_filters( 'uncode_vimeo_params', '?autoplay=0' ),
		'ajax_filter_key_search'	 => UNCODE_FILTER_KEY_SEARCH,
		'ajax_filter_key_unfilter'	 => UNCODE_FILTER_PREFIX,
		'index_pagination_disable_scroll' => apply_filters( "index_pagination_disable_scroll", false ),
		'index_pagination_scroll_to' => apply_filters( "uncode_index_pagination_scroll_to", false ),
		'uncode_wc_popup_cart_qty'   => apply_filters( 'uncode_woocommerce_popup_cart_quantity', ot_get_option( '_uncode_woocommerce_popup_cart_quantity'  ) === 'on' ),
		'disable_hover_hack'         => apply_filters( 'uncode_ajax_filters_disable_hover_hack', false ),
		'uncode_nocookie'            => apply_filters('uncode_nocookie', false) ? '-nocookie' : '',
		'menuHideOnClick'			 => apply_filters('uncode_menu_hide_on_click', true),
		'smoothScroll'				 => apply_filters( 'uncode_smooth_scroll', $smooth_scroll ),
		'smoothScrollDisableHover'	 => apply_filters( 'uncode_smooth_scroll_disable_hover', false ),
		'smoothScrollQuery'			 => apply_filters( 'uncode_smooth_scroll_query', 960 ),
		'uncode_force_onepage_dots'  => apply_filters( 'uncode_force_onepage_dots', false ),
		'uncode_smooth_scroll_safe'  => apply_filters( 'uncode_smooth_scroll_safe', ot_get_option( '_uncode_smooth_scroll_safe' ) === 'on' ),
		'uncode_lb_add_galleries'    => apply_filters( 'uncode_lb_add_galleries', ', .gallery' ),
		'uncode_lb_add_items' 	     => apply_filters( 'uncode_lb_add_items', ', .gallery .gallery-item a' ),
	);

	/** JS */
	$suffix = $scripts_prod_conf[ 'suffix' ];

	if ($adaptive_images === 'on' || $adaptive_images === '') {
		$site_parameters['uncode_adaptive'] = true;
		$site_parameters['ai_breakpoints']  = $ai_sizes;
		if ( $adaptive_images_async === 'on' ) {
			$site_parameters['uncode_adaptive_async']  = true;
		}
		wp_enqueue_script('ai-uncode', get_template_directory_uri() . '/library/js/ai-uncode' . $suffix . '.js', array() , $resources_version, false);
	}

	if ( $dynamic_srcset_active ) {
		$site_parameters['dynamic_srcset_active']               = true;
		$site_parameters['dynamic_srcset_bg_mobile_breakpoint'] = apply_filters( 'uncode_dynamic_srcset_bg_mobile_breakpoint', 570 );
		$site_parameters['dynamic_srcset_bunch_limit']          = apply_filters( 'uncode_dynamic_srcset_bunch_limit', 1 );
		$site_parameters['dynamic_srcset_bg_mobile_size']       = $dynamic_srcset_bg_mobile_size;
		$site_parameters['activate_webp']                       = $activate_webp;
		$site_parameters['force_webp']                          = apply_filters( 'uncode_dynamic_srcset_force_webp', false );
	}

	wp_enqueue_script('uncode-init', get_template_directory_uri() . '/library/js/init' . $suffix . '.js', array() , $resources_version, false);

	wp_localize_script( 'uncode-init', 'SiteParameters', $site_parameters );

	if ( $native_media_player === true && function_exists( 'uncode_deregister_script' ) ) {
		uncode_deregister_script('mediaelement');
		uncode_deregister_script('wp-mediaelement');
	}

	foreach ( $whenever_page_assets as $page_asset_key => $whenever_page_asset_value ) {
		uncode_enqueue_script( $whenever_page_asset_value, $resources_version );
	}

	if ( $split_js ) {
		foreach ( $page_assets as $page_asset_key => $page_asset_value ) {
			uncode_enqueue_script( $page_asset_value, $resources_version );
		}
	} else {

		if ( $native_media_player !== true ) {
			wp_enqueue_script('wp-mediaelement');
		}

		wp_enqueue_script('uncode-plugins', get_template_directory_uri() . '/library/js/plugins' . $suffix . '.js', array('jquery') , $resources_version, true);
		$uncode_app_dep = array('jquery');
		if ( $is_frontend_editor ) {
			$uncode_app_dep[] = 'uncode-lottie-player';
			$uncode_app_dep[] = 'uncode-lottie-interactivity';
		}

		wp_enqueue_script('uncode-app', get_template_directory_uri() . '/library/js/app' . $suffix . '.js', $uncode_app_dep , $resources_version, true);

		// Comments
		if ( is_singular() && comments_open() && get_option('thread_comments') ) {
			wp_enqueue_script('comment-reply');
		}

		// Polyfill for object-fit
		if ( $dynamic_srcset_active || apply_filters( 'uncode_enqueue_objectfit_polyfill', false ) ) {
			wp_enqueue_script( 'uncode-ofi', get_template_directory_uri() . '/library/js/lib/ofi.min.js', array() , $resources_version, true );
			wp_script_add_data( 'uncode-ofi', 'conditional', 'lt IE 11' );
			wp_add_inline_script( 'uncode-ofi', 'objectFitImages();' );
		}
	}

	/** Deregister CSS */
	global $wp_styles, $wp_scripts;
	if (isset($wp_styles->registered['media-views'])) {
		$wp_styles->registered['media-views']->deps = array_diff($wp_styles->registered['media-views']->deps, array('wp-mediaelement'));
	}
	if (isset($wp_styles->registered['mediaelement'])) {
		wp_deregister_style('mediaelement');
	}
	if (isset($wp_styles->registered['wp-mediaelement'])) {
		wp_deregister_style('wp-mediaelement');
	}

	/** Main CSS **/
	$output_css = '';
	$main_align = ot_get_option('_uncode_main_align');
	$boxed = ot_get_option('_uncode_boxed');
	if ($main_align == 'left')
	{
		$main_align_css = 'margin-right: auto;';
	}
	elseif ($main_align == 'right')
	{
		$main_align_css = 'margin-left: auto;';
	}
	else
	{
		$main_align_css = 'margin: auto;';
	}

	$logo_height_mobile = ot_get_option('_uncode_logo_height_mobile');
	if ($logo_height_mobile !== '') {
		$logo_height_mobile = preg_replace('/[^0-9.]+/', '', $logo_height_mobile);
		$output_css .= "\n@media (max-width: 959px) { .navbar-brand > * { height: " . $logo_height_mobile . "px !important;}}";
	}

	global $wp_query;
	$is_product_search = isset( $_GET['post_type'] ) && $_GET['post_type'] === 'product' ? true: false;

	if ( is_search() && ! $is_product_search ) {
		$main_width =  ot_get_option( '_uncode_main_width' );
	} else if ( is_search() && $is_product_search && ! $wp_query->have_posts() ) {
		$main_width =  ot_get_option( '_uncode_main_width' );
	} else {
		$id = get_the_ID();
		$metabox_data = get_post_custom($id);

		$post_type = isset( $post->post_type ) ? $post->post_type : 'post';
		$post_type_width = ot_get_option( '_uncode_' . $post_type . '_layout_width' );
		if ( $post_type === 'portfolio' ) {
			if ( $post_type_width === 'limit' ) {
				$post_type_width_custom =  ot_get_option( '_uncode_' . $post_type . '_layout_width_custom' );
				$main_width = $post_type_width_custom;
			} elseif ( $post_type_width === 'full' ) {
				$main_width = array('100', '%');
			}
		}
		if ( isset($metabox_data['_uncode_specific_main_width_inherit'][0]) && $metabox_data['_uncode_specific_main_width_inherit'][0] != ''
			&&
			isset($metabox_data['_uncode_specific_main_width'][0]) && isset($metabox_data['_uncode_specific_main_width_inherit'][0])) {
			$main_width = unserialize($metabox_data['_uncode_specific_main_width'][0]);
		}
	}

	if ((isset($main_width[0]) && $main_width[0] !== '') || (!is_array($main_width) && $main_width !== '')) {
		if (is_array($main_width)) {
			if ($main_width[1] === 'px') {
				$output_width = round($main_width[0] / 12) * 12;
				$output_unit = 'px';
			} else {
				$output_width = $main_width[0];
				$output_unit = '%';
				$output_css .= "\n@media (min-width: 960px) { .limit-width { max-width: " . $main_width[0] . "%; " . $main_align_css . "}}";
			}
		} else {
			if (strpos($main_width, 'px') !== false) {
				$output_width = preg_replace('/[^0-9,.]/', '', $main_width);
				$output_unit = 'px';
			} else {
				$output_width = preg_replace('/[^0-9,.]/', '', $main_width);
				$output_unit = '%';
			}
		}

		$output_css .= "\n@media (min-width: 960px) { .limit-width { max-width: " . $output_width . $output_unit . "; " . $main_align_css . "}}";
	}

	$body_border = ot_get_option('_uncode_body_border');
	$body_border = ($body_border !== '' && $body_border !== 0) ? $body_border : 0;

	$offcanvas_overlay = ot_get_option('_uncode_offcanvas_overlay');

	/** Menu CSS **/
	if (strpos($menutype, 'vmenu') !== false) {
		$vmenu_width = ot_get_option('_uncode_vmenu_width');
		$vmenu_position = ot_get_option('_uncode_vmenu_position');

		if ($vmenu_width == '') {
			$vmenu_width = '200';
		}

		$vmenu_width = apply_filters( 'uncode_vmenu_width', $vmenu_width );
		if ( is_numeric($vmenu_width) ) {
			$vmenu_width .= 'px';
		}

		$output_css .= "\n@media (min-width: 960px) { .main-header, .vmenu-container { width: " . ($vmenu_width) . " !important; } }";
		if ($menutype === 'vmenu') {
			if ($vmenu_position === 'left') {
				$output_css .= "\n@media (min-width: 960px) { .pin-trigger { left: calc(" . $vmenu_width . " + " . $body_border . "px) !important; top: " . ($body_border) . "px !important; } }";
			} else {
				$output_css .= "\n@media (min-width: 960px) { .pin-trigger { left: " . ($body_border) . "px !important; top: " . ($body_border) . "px !important; } }";
			}
		}

		//$vmenu_border_offset = $vmenu_width + $body_border;

		if ($menutype === 'vmenu-offcanvas') {
			if ($vmenu_position === 'left')
			{
				$output_css .= "\n@media (min-width: 960px) { .vmenu-container { transform: translateX(-100%); -webkit-transform: translateX(-100%); -ms-transform: translateX(-100%);} .off-opened .vmenu-container { transform: translateX(0px); -webkit-transform: translateX(0px); -ms-transform: translateX(0px);}}";
				if ( $offcanvas_overlay !== 'on' ) {
					$output_css .= "\n@media (min-width: 960px) { .off-opened .row-offcanvas, .off-opened:not(.scrolling-trigger) .main-container { transform: translateX(" . $vmenu_width . "); -webkit-transform: translateX(" . $vmenu_width . "); -ms-transform: translateX(" . $vmenu_width . "); } }";
					$output_css .= "\n@media (min-width: 960px) { .off-opened.scrolling-trigger .main-container { margin-left: " . $vmenu_width . "; } }";
					$output_css .= "\n@media (min-width: 960px) { .chrome .main-header, .firefox .main-header, .ie .main-header, .edge .main-header { clip: rect(0px, auto, auto, 0px); } }";
				}
			}
			else
			{
				$output_css .= "\n@media (min-width: 960px) { .vmenu-container { transform: translateX(0px); -webkit-transform: translateX(0px); -ms-transform: translateX(0px);} .off-opened .vmenu-container { transform: translateX(-100%); -webkit-transform: translateX(-100%); -ms-transform: translateX(-100%);}}";
				if ( $offcanvas_overlay !== 'on' ) {
					$output_css .= "\n@media (min-width: 960px) { .off-opened .row-offcanvas, .off-opened:not(.scrolling-trigger) .main-container { transform: translateX(-" . $vmenu_width . "); -webkit-transform: translateX(-" . $vmenu_width . "); -ms-transform: translateX(-" . $vmenu_width . "); } }";
					$output_css .= "\n@media (min-width: 960px) { .off-opened.scrolling-trigger .main-container { margin-left: -" . $vmenu_width . "; } }";
					$output_css .= "\n@media (min-width: 960px) { .chrome .main-header, .firefox .main-header, .ie .main-header, .edge .main-header { clip: rect(0px, 0px, 99999999999px, -" . $vmenu_width . "); } }";
				}
			}
		} /*else {
			if ($vmenu_position == 'right' && $boxed !== 'on' ) {
				$output_css .= "\n@media (min-width: 960px) { .vmenu-container { left: 100%; transform: translateX(-" . $vmenu_border_offset . "px); -webkit-transform: translateX(-" . $vmenu_border_offset . "px); -ms-transform: translateX(-" . $vmenu_border_offset . "px);}}";
			} elseif ($vmenu_position == 'left' && $boxed !== 'on' ) {
				$output_css .= "\n@media (min-width: 960px) { .vmenu-container { right: 100%; transform: translateX(" . $vmenu_border_offset . "px); -webkit-transform: translateX(" . $vmenu_border_offset . "px); -ms-transform: translateX(" . $vmenu_border_offset . "px);} }";
			}
		}*/
	}

	if ( function_exists( 'uncode_is_sidecart_enabled' ) && uncode_is_sidecart_enabled() && $body_border > 0 ) {
		$top_border = $body_border;
		if ( is_admin_bar_showing() ) {
			$top_border = $body_border + 32;
		}
		$output_css .= "\n@media (min-width: 960px) { #uncode_sidecart { bottom: " . $body_border . "px !important; top: " . $top_border . "px !important; } body.uncode-sidecart-right #uncode_sidecart { right: " . $body_border . "px !important; } body.uncode-sidecart-left #uncode_sidecart { left: " . $body_border . "px !important; } }";
	}

	$menu_first_uppercase = ot_get_option('_uncode_menu_first_uppercase');
	$menu_other_uppercase = ot_get_option('_uncode_menu_other_uppercase');

	if ($menu_first_uppercase === 'on') {
		$output_css .= "\n.menu-primary ul.menu-smart > li > a, .menu-primary ul.menu-smart li.dropdown > a, .menu-primary ul.menu-smart li.mega-menu > a, .vmenu-container ul.menu-smart > li > a, .vmenu-container ul.menu-smart li.dropdown > a { text-transform: uppercase; }";
	}

	if ($menu_other_uppercase === 'on') {
		$output_css .= "\n.menu-primary ul.menu-smart ul a, .vmenu-container ul.menu-smart ul a { text-transform: uppercase; }";
	}

	$menu_custom_padding = ot_get_option('_uncode_menu_custom_padding');
	$custom_menu_padding_desktop = ot_get_option('_uncode_menu_custom_padding_desktop');
	$custom_menu_padding_mobile = ot_get_option('_uncode_menu_custom_padding_mobile');
	$custom_menu_padding_desktop_shrinked = $custom_menu_padding_desktop > 9 ? $custom_menu_padding_desktop - 9 : 0;

	if ($menu_custom_padding === 'on') {
		$output_css .= "\nbody.menu-custom-padding .col-lg-0.logo-container, body.menu-custom-padding .col-lg-2.logo-container, body.menu-custom-padding .col-lg-12 .logo-container, body.menu-custom-padding .col-lg-4.logo-container { padding-top: " . esc_attr( intval( $custom_menu_padding_desktop ) ) . "px; padding-bottom: " . esc_attr( intval( $custom_menu_padding_desktop ) ) . "px; }";
		$output_css .= "\nbody.menu-custom-padding .col-lg-0.logo-container.shrinked, body.menu-custom-padding .col-lg-2.logo-container.shrinked, body.menu-custom-padding .col-lg-12 .logo-container.shrinked, body.menu-custom-padding .col-lg-4.logo-container.shrinked { padding-top: " . esc_attr( intval( $custom_menu_padding_desktop_shrinked ) ) . "px; padding-bottom: " . esc_attr( intval( $custom_menu_padding_desktop_shrinked ) ) . "px; }";
		$output_css .= "\n@media (max-width: 959px) { body.menu-custom-padding .menu-container .logo-container { padding-top: " . esc_attr( intval( $custom_menu_padding_mobile ) ) . "px !important; padding-bottom: " . esc_attr( intval( $custom_menu_padding_mobile ) ) . "px !important; } }";

	}

	$output_css .= "\n#changer-back-color { transition: background-color " . floatval( apply_filters( 'uncode_bg_changer_time', 1000 ) ) . "ms cubic-bezier(0.25, 1, 0.5, 1) !important; } #changer-back-color > div { transition: opacity " . floatval( apply_filters( 'uncode_bg_changer_time', 1000 ) ) . "ms cubic-bezier(0.25, 1, 0.5, 1) !important; } body.bg-changer-init.disable-hover .main-wrapper .style-light,  body.bg-changer-init.disable-hover .main-wrapper .style-light h1,  body.bg-changer-init.disable-hover .main-wrapper .style-light h2, body.bg-changer-init.disable-hover .main-wrapper .style-light h3, body.bg-changer-init.disable-hover .main-wrapper .style-light h4, body.bg-changer-init.disable-hover .main-wrapper .style-light h5, body.bg-changer-init.disable-hover .main-wrapper .style-light h6, body.bg-changer-init.disable-hover .main-wrapper .style-light a, body.bg-changer-init.disable-hover .main-wrapper .style-dark, body.bg-changer-init.disable-hover .main-wrapper .style-dark h1, body.bg-changer-init.disable-hover .main-wrapper .style-dark h2, body.bg-changer-init.disable-hover .main-wrapper .style-dark h3, body.bg-changer-init.disable-hover .main-wrapper .style-dark h4, body.bg-changer-init.disable-hover .main-wrapper .style-dark h5, body.bg-changer-init.disable-hover .main-wrapper .style-dark h6, body.bg-changer-init.disable-hover .main-wrapper .style-dark a { transition: color " . floatval( apply_filters( 'uncode_bg_changer_time', 1000 ) ) . "ms cubic-bezier(0.25, 1, 0.5, 1) !important; }";

	$menu_mobile_overlay = ot_get_option('_uncode_menu_mobile_centered');
	$menu_stick_mobile = function_exists('vc_is_page_editable') && vc_is_page_editable() ? false : ot_get_option('_uncode_menu_sticky_mobile');

	if ($menu_stick_mobile === 'on' && $menu_mobile_overlay === 'off-canvas') {
		$output_css .= "\n@media (max-width: 959px) {
			body.menu-mobile-off-canvas .main-menu-container {
				width: calc(100vw - " . apply_filters( 'uncode_mobile_offcanvas_gap', 45 ) . "px);
			}
			body.menu-mobile-off-canvas.menu-mobile-borders.has-body-borders .main-menu-container {
				width: calc( ( 100vw - 9px ) - " . apply_filters( 'uncode_mobile_offcanvas_gap', 45 ) . "px);
			}
		}";
	}

	if ($output_css !== '') {
		wp_add_inline_style('uncode-style', $output_css);
	}

	$custom_css = ot_get_option('_uncode_custom_css');
	if ($custom_css !== '') {
		if ($dynamic_css_exists) {
			wp_add_inline_style('uncode-custom-style', uncode_compress_css_inline($custom_css));
		} else {
			wp_add_inline_style('uncode-style', uncode_compress_css_inline($custom_css));
		}
	}
}

add_action( 'wp', 'uncode_load_script_conditional' );
function uncode_load_script_conditional(){
	add_action('wp_enqueue_scripts', 'uncode_equeue');
}

function uncode_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'uncode_add_excerpts_to_pages' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function uncode_body_classes($classes){
	global $LOGO, $post, $menutype, $metabox_data, $adaptive_images, $adaptive_images_async, $general_style;

	// Adds a class of group-blog to blogs with more than 1 published author.
	if (is_multi_author())
	{
		$classes[] = 'group-blog';
	}

	$boxed = ot_get_option('_uncode_boxed');
	$main_align = ot_get_option('_uncode_main_align');

	if ($menutype === '') {
		$menutype = 'hmenu-right';
	}
	if (strpos($menutype, 'vmenu') !== false) {
		$vmenu_v_position = ot_get_option('_uncode_vmenu_v_position');
		if ($menutype === 'vmenu-offcanvas') {
			$classes[] = 'menu-offcanvas';
			$classes[] = 'vmenu-' . $vmenu_v_position;

			$offcanvas_overlay = ot_get_option('_uncode_offcanvas_overlay');
			if ( $offcanvas_overlay === 'on' ) {
				$classes[] = 'vmenu-offcanvas-overlay';
			}

		} else {
			$classes[] = 'vmenu';
			$classes[] = $menutype . '-' . $vmenu_v_position;
		}
		$horizontal_align = ot_get_option('_uncode_vmenu_align');
		$classes[] = 'vmenu-' . $horizontal_align;
		$vmenu_position = ot_get_option('_uncode_vmenu_position');
		$classes[] = 'vmenu-position-' . $vmenu_position;
	} else {
		$vmenu_position = ot_get_option('_uncode_hmenu_position') == '' ? 'left' : ot_get_option('_uncode_hmenu_position');
		$classes[] = 'hormenu-position-' . $vmenu_position;

		if ( ot_get_option( '_uncode_menu_full') === 'on' ) {
			$classes[] = 'megamenu-full-submenu';
		}

		switch ($menutype)
		{
			case 'hmenu-right':
				$classes[] = 'hmenu';
				$classes[] = 'hmenu-position-right';
			break;
			case 'hmenu-left':
				$classes[] = 'hmenu';
				$classes[] = 'hmenu-position-left';
			break;
			case 'hmenu-justify':
				$classes[] = 'hmenu';
				$classes[] = 'hmenu-position-center';
			break;
			case 'hmenu-center':
				$classes[] = 'hmenu-center';
			break;
			case 'hmenu-center-split':
				$classes[] = 'hmenu';
				$classes[] = 'hmenu-center-split';
			break;
			case 'hmenu-center-double':
				$classes[] = 'hmenu';
				$classes[] = 'hmenu-center-double';
			break;
		}
	}

	if ($boxed === 'on') {
		$classes[] = 'boxed-width';
	} else {
		$classes[] = 'header-full-width';
	}

	if ($menutype == 'menu-overlay' || $menutype == 'menu-overlay-center') {
		$vmenu_v_position = ot_get_option('_uncode_vmenu_v_position');
		$vmenu_position = ot_get_option('_uncode_vmenu_position');
		if ($vmenu_position === 'left') {
			$classes[] = 'menu-overlay-left';
		}
		$horizontal_align = ot_get_option('_uncode_vmenu_align');
		$classes[] = 'vmenu-' . $horizontal_align;
		$classes[] = 'vmenu-' . $vmenu_v_position;
		$classes[] = 'vmenu-middle';
		$classes[] = 'menu-overlay';
		if ($menutype == 'menu-overlay-center') {
			$classes[] = 'menu-overlay-center';
		}
	}

	if ( ot_get_option( '_uncode_input_underline') === 'on' ) {
		$classes[] = 'input-underline';
	} else if ( ot_get_option('_uncode_input_underline') === 'background' ) {
		$classes[] = 'input-background';
	}

	$classes[] = 'main-' . $main_align . '-align';

	$menu_mobile_transparency = ot_get_option('_uncode_menu_mobile_transparency');
	if ($menu_mobile_transparency === 'on' && $menutype !== 'hmenu-center') {
		$classes[] = 'menu-mobile-transparent';
	}

	$menu_custom_padding = ot_get_option('_uncode_menu_custom_padding');
	if ($menu_custom_padding === 'on') {
		$classes[] = 'menu-custom-padding';
	}

	$link_color = ot_get_option('_uncode_body_link_color');
	if ($link_color === 'accent') {
		$classes[] = 'textual-accent-color';
	}

	$menu_mobile_overlay = ot_get_option('_uncode_menu_mobile_centered');
	$menu_stick_mobile = ot_get_option('_uncode_menu_sticky_mobile');
	$menu_mobile_animation = ot_get_option('_uncode_menu_mobile_animation');

	if ($menu_stick_mobile === 'on') {
		$classes[] = 'menu-sticky-mobile';
		if ($menu_mobile_overlay === 'on') {
			$classes[] = 'menu-mobile-centered';
		} elseif ($menu_mobile_overlay === 'off-canvas') {
			$classes[] = 'menu-mobile-centered';
			$classes[] = 'menu-mobile-off-canvas';
			$menu_mobile_animation = '';
		}
	}
	if ( $menu_stick_mobile !== 'on' || ( $menu_mobile_overlay !== 'on' && $menu_mobile_overlay !== 'off-canvas' ) ) {
		$classes[] = 'menu-mobile-default';
	}

	if ($menu_mobile_animation === 'scale') {
		$classes[] = 'menu-mobile-animated';
	} elseif ($menu_mobile_animation === 'simple') {
		$classes[] = 'menu-mobile-animated-simple';
	} elseif ($menu_mobile_animation === '3d') {
		$classes[] = 'menu-mobile-animated-trid';
	}

	if (uncode_is_full_page()) {
		$classes[] = 'uncode-fullpage fp-waiting';

		if ( uncode_is_full_page() == 'slide'  ) {
			$classes[] = 'uncode-fullpage-slide';
			if ( isset($metabox_data['_uncode_fullpage_type'][0]) && $metabox_data['_uncode_fullpage_type'][0] != '' ) {
				$classes[] = 'uncode-fullpage-' . $metabox_data['_uncode_fullpage_type'][0];
			}

			if ( !isset($metabox_data['_uncode_scroll_safe_padding'][0]) || $metabox_data['_uncode_scroll_safe_padding'][0] == 'on' ) {
				$classes[] = 'uncode-scroll-safe-padding';
			}

			if ( isset($metabox_data['_uncode_fullpage_menu'][0]) && $metabox_data['_uncode_fullpage_menu'][0] !== '' ) {
				$classes[] = 'uncode-fp-menu-' . $metabox_data['_uncode_fullpage_menu'][0];
			}

			if ( isset($metabox_data['_uncode_fullpage_opacity'][0]) && $metabox_data['_uncode_fullpage_opacity'][0] === 'on' ) {
				$classes[] = 'uncode-fp-opacity';
			}
		}

	}

	if (uncode_is_full_page() || (isset($metabox_data['_uncode_page_scroll'][0]) && $metabox_data['_uncode_page_scroll'][0] === 'on')) {

		if ( isset($metabox_data['_uncode_scroll_dots'][0]) && $metabox_data['_uncode_scroll_dots'][0] == 'on' ) {
			$classes[] = 'uncode-scroll-no-dots';
		}

		if ( isset($metabox_data['_uncode_scroll_history'][0]) && $metabox_data['_uncode_scroll_history'][0] == 'on' ) {
			$classes[] = 'uncode-scroll-no-history';
		}

		if ( uncode_is_full_page() ) {
			if ( isset($metabox_data['_uncode_empty_dots'][0]) && $metabox_data['_uncode_empty_dots'][0] == 'on' ) {
				$classes[] = 'uncode-empty-dots';
			}

			if ( isset($metabox_data['_uncode_fullpage_mobile'][0]) && $metabox_data['_uncode_fullpage_mobile'][0] == 'on' ) {
				$classes[] = 'uncode-fp-mobile-disable';
			}

		}

	}

	if ( uncode_is_scroll_snap() ) {
		$classes[] = 'uncode-scroll-snap fp-waiting';
	}

	if ( ot_get_option('_uncode_woocommerce_default_product_gallery') !== 'on' && function_exists('uncode_woocommerce_single_product_zoom_global_enabled') && uncode_woocommerce_single_product_zoom_global_enabled() ) {
		$classes[] = 'wc-zoom-enabled';
	}

	if ( $menutype === 'vmenu' && ot_get_option('_uncode_menu_accordion_active') == 'on' ) {
		$classes[] = 'menu-accordion-active';
	}

	$no_cta = apply_filters( 'uncode_cta_menu_hide', ot_get_option('_uncode_menu_no_cta') );
	$theme_locations = get_nav_menu_locations();
	if ($no_cta === 'off' && isset($theme_locations['cta'])) {
		$classes[] = 'menu-has-cta';
	}

	if ( class_exists( 'WooCommerce' ) ) {
		$woo_cart = apply_filters( 'uncode_woo_cart', ot_get_option('_uncode_woocommerce_cart') );
		$woo_icon = apply_filters( 'uncode_woo_icon', ot_get_option('_uncode_woocommerce_cart_icon') );
		if ($woo_cart === 'on' && $woo_icon !== '') {
			if ($menutype === 'menu-overlay' || $menutype === 'menu-overlay-center' || $menutype === 'offcanvas_head' || $menutype === 'vmenu-offcanvas') {
				$woo_cart_desktop = apply_filters( 'uncode_woo_cart_desktop', ot_get_option('_uncode_woocommerce_cart_desktop') );
			} else {

				$woo_cart_desktop = '';
			}

			if ($woo_cart_desktop === 'on') {
				$classes[] = 'menu-cart-desktop';
			}
		}
	}

	if ( ! apply_filters( 'uncode_mobile_parallax_allowed', false ) ) {
		$classes[] = 'mobile-parallax-not-allowed';
	}

	if ( apply_filters( 'uncode_mobile_no_bounce', true ) ) {
	    $classes[] = 'ilb-no-bounce';
	}

	if ( uncode_get_purchase_code() ) {
		$classes[] = 'unreg';
	}

	if ($adaptive_images === 'on' && $adaptive_images_async === 'on') {
		$classes[] = 'adaptive-images-async';
	}

	if ( isset( $LOGO->logo_mobile_id ) && $LOGO->logo_mobile_id !== '' ) {
		$classes[] = 'uncode-logo-mobile';
	}

	$search_active = apply_filters( 'uncode_search_active', ot_get_option( '_uncode_menu_search') );
	$socials_active = apply_filters( 'uncode_socials_active', ot_get_option( '_uncode_menu_socials') );
	$socials = ot_get_option( '_uncode_social_list');

	$post_type = isset( $post->post_type ) ? $post->post_type : 'post';
	if (isset($metabox_data['_uncode_specific_menu'][0]) && $metabox_data['_uncode_specific_menu'][0] !== '') {
		$primary_menu = $metabox_data['_uncode_specific_menu'][0];
	} else {
		$menu_generic = ot_get_option( '_uncode_'.$post_type.'_menu');
		if ($menu_generic !== '') {
			$primary_menu = $menu_generic;
		} else {
			$primary_menu = '';
			if (isset($theme_locations['primary'])) {
				$menu_obj = get_term( $theme_locations['primary'], 'nav_menu' );
				if (isset($menu_obj->name)) {
					$primary_menu = $menu_obj->name;
				}
			}
		}
	}
	$menu_count = wp_get_nav_menu_items($primary_menu);

	$no_cta = apply_filters( 'uncode_cta_menu_hide', ot_get_option('_uncode_menu_no_cta') );
	if ($no_cta === 'off' && isset($theme_locations['cta'])) {
		$cta_obj = get_term( $theme_locations['cta'], 'nav_menu' );
		$cta_menu = isset( $cta_obj->name ) ? $cta_obj->name : false;
	} else {
		$cta_menu = false;
	}

	$footer_copyright = ot_get_option('_uncode_footer_copyright');
	$footer_copyright_hide = ot_get_option('_uncode_copy_hide');
	$footer_text = ot_get_option('_uncode_footer_text');

	$empty_menu = false;

	switch( $menutype ) {
		case 'vmenu-offcanvas':
			if ( ( $footer_copyright === 'off' || $footer_copyright_hide === 'on' ) && $footer_text === '' && $search_active !== 'on' && ( $socials_active !== 'on' || empty( $socials ) ) && !$primary_menu && !$cta_menu ) {
				$empty_menu = true;
			}
			break;

		case 'menu-overlay':
		case 'menu-overlay-center':
			if ( $search_active !== 'on' && ( $socials_active !== 'on' || empty( $socials ) ) && !$menu_count && !$cta_menu ) {
				$empty_menu = true;
			}
			break;
	}

	if ( $empty_menu === true ) {
		$classes[] = 'uncode-empty-menu';
	}
	if ( $search_active !== 'on' && ( $socials_active !== 'on' || empty( $socials ) ) && !$menu_count && !$cta_menu ) {
		$classes[] = 'uncode-empty-menu-mobile';
	}

	if ( function_exists( 'uncode_woocommerce_single_product_slider_enabled' ) && uncode_woocommerce_single_product_slider_enabled( true ) ) {
		$classes[] = 'uncode-wc-single-product-slider-enabled';
	}

	if ( ot_get_option( '_uncode_button_shape' ) !== '' ) {
		$classes[] = 'uncode-' . ot_get_option( '_uncode_button_shape' );
	}

	if ( function_exists( 'uncode_is_sidecart_enabled' ) && uncode_is_sidecart_enabled() ) {
		$classes[] = 'uncode-sidecart-enabled';
		$sidecart_position = ot_get_option( '_uncode_woocommerce_sidecart_position' );
		$classes[] = 'uncode-sidecart-' . esc_attr( $sidecart_position == '' ? 'right' : $sidecart_position );

		if ( uncode_is_sidecart_mobile_enabled() ) {
			$classes[] = 'uncode-sidecart-mobile-enabled';
		}
	}

	if ( ot_get_option( '_uncode_woocommerce_atc_notify' ) == 'minicart' && ot_get_option('_uncode_woocommerce_cart') === 'on' ) {
		$classes[] = 'minicart-notification';
	}

	if ( isset($metabox_data['_uncode_specific_body_class'][0]) && $metabox_data['_uncode_specific_body_class'][0] != '' ) {
		$classes[] = esc_attr( $metabox_data['_uncode_specific_body_class'][0] );
	}

	if ( apply_filters( 'uncode_quick_view_body_scroll_disabled', true ) ) {
	    $classes[] = 'qw-body-scroll-disabled';
	}

	if ( strpos($menutype, 'hmenu') !== false  && $boxed !== 'on' && ot_get_option( '_uncode_menu_full') === 'on' ) {
		if ( ot_get_option( '_uncode_submenu_style' ) === 'menu-sub-enhanced' ) {
			$classes[] = 'megamenu-side-to-side';
		}
	}

	$sticky_fix = false;

	if ( ! (function_exists('vc_is_page_editable') && vc_is_page_editable()) && ot_get_option('_uncode_menu_sticky') === 'on' ) {
		$sticky_fix = true;
	}

	if ( ( ot_get_option('_uncode_menu_no_secondary') !== 'on' && isset($theme_locations['secondary']) ) || $menutype === 'hmenu-center' ) {
		$sticky_fix = false;
	}

	if ( $sticky_fix === true ) {
		$classes[] = 'menu-sticky-fix';
	}

	$stylemain = ot_get_option( '_uncode_primary_menu_style');
	if ($stylemain === '') {
		$stylemain = $general_style;
	}

	$transpmainheader = ot_get_option('_uncode_menu_bg_alpha_' . $stylemain);

	if ($transpmainheader !== '100') {
		$remove_transparency = false;
		if (isset($metabox_data['_uncode_specific_menu_opaque'][0]) && $metabox_data['_uncode_specific_menu_opaque'][0] === 'on') {
			$remove_transparency = true;
		} else {
			$get_remove_transparency = ot_get_option( '_uncode_'.$post_type.'_menu_opaque');
			if ($get_remove_transparency === 'on') {
				$remove_transparency = true;
			}
		}

		if (!$remove_transparency) {
			$menu_desktop_transparency = ot_get_option('_uncode_menu_desktop_transparency');
			if ($menu_desktop_transparency === 'on' && $menutype !== 'hmenu-center' && $menutype !== 'vmenu') {
				$classes[] = 'menu-scroll-transparency';
			}
		}
	}

	if ( strpos($menutype, 'hmenu') !== false ) {
		if ( apply_filters( 'uncode_search_active', ot_get_option( '_uncode_menu_search') ) === 'on' && apply_filters( 'uncode_search_dropdown', ot_get_option('_uncode_drop_down_search') ) === 'on' ) {
			$classes[] = 'menu-dd-search';

			if ( apply_filters( 'uncode_search_mobile', ot_get_option('_uncode_woocommerce_cart_mobile') ) === 'on' ) {
				$classes[] = 'menu-dd-search-mobile';
			}

		}
	}

	if ( ot_get_option('_uncode_menu_mobile_borders') === 'on' ) {
		$classes[] = 'menu-mobile-borders';
	}

	$body_border = ot_get_option('_uncode_body_border');

	if ($body_border !== '' && $body_border != 0) {
		$classes[] = 'has-body-borders';
	}

	if ( !(apply_filters( 'uncode_woocommerce_popup_cart_quantity', ot_get_option( '_uncode_woocommerce_popup_cart_quantity'  ) === 'on' )) ) {
		$classes[] = 'no-qty-fx';
	}

	if ( apply_filters( 'uncode_lightgallery_hide_close_button_mobile', false ) ) {
		$classes[] = 'lightgallery-hide-close';
	}

	if ( apply_filters( 'uncode_scrollable_megamenu', false ) ) {
		$classes[] = 'scrollable-megamenu';
	}

	if ($menutype !== 'hmenu-center' && $menutype !== 'vmenu') {
		$blur_menu = ot_get_option('_uncode_menu_blur');
		if ( $blur_menu !== '' ) {
			$classes[] = 'blur-menu-' . $blur_menu;
		}
	}

	return $classes;
}
add_filter('body_class', 'uncode_body_classes');

function uncode_inline_script() {
	$custom_js = ot_get_option('_uncode_custom_js');
	if ($custom_js !== '') {
		$has_script_tag = strpos( $custom_js, '<script' ) !== false ? true : false;

		if ( ! $has_script_tag ) {
			echo '<script type="text/javascript">';
		}

		echo uncode_remove_p_tag( $custom_js );

		if ( ! $has_script_tag ) {
			echo '</script>';
		}
	}
}
add_action( 'wp_footer', 'uncode_inline_script' );

function uncode_inline_tracking_head() {
	$custom_tracking = ot_get_option('_uncode_custom_tracking_head');
	if ($custom_tracking !== '' && uncode_privacy_allow_content( 'tracking' ) !== false ) {
		uncode_privacy_check_needed( 'tracking' );
		$has_script_tag = strpos( $custom_tracking, '<script' ) !== false ? true : false;

		if ( ! $has_script_tag ) {
			echo '<script type="text/javascript">';
		}

		echo uncode_remove_p_tag( $custom_tracking );

		if ( ! $has_script_tag ) {
			echo '</script>';
		}
	}
}
add_action( 'wp_head', 'uncode_inline_tracking_head', 0 );

function uncode_inline_tracking() {
	$custom_tracking = ot_get_option('_uncode_custom_tracking');
	if ($custom_tracking !== '' && uncode_privacy_allow_content( 'tracking' ) !== false ) {
		uncode_privacy_check_needed( 'tracking' );
		$has_script_tag = strpos( $custom_tracking, '<script' ) !== false ? true : false;

		if ( ! $has_script_tag ) {
			echo '<script type="text/javascript">';
		}

		echo uncode_remove_p_tag( $custom_tracking );

		if ( ! $has_script_tag ) {
			echo '</script>';
		}
	}
}
add_action( 'wp_footer', 'uncode_inline_tracking' );

function uncode_redirect_page($original_template) {
	global $post;
	$privacy_page = get_option( 'uncode_privacy_privacy_policy_page', 0 );
	if (! is_user_logged_in() && ! ( $post && $post->ID == $privacy_page ) ) {
		global $is_redirect,$redirect_page;
		$is_redirect_active = ot_get_option('_uncode_redirect');
		if ($is_redirect_active === 'on') {
			$redirect_page = ot_get_option('_uncode_redirect_page');
			if($redirect_page !== '') {
	    		$is_redirect = true;
	      		return get_template_directory() . '/redirect-page.php';
	    	}
		}
	}
	return $original_template;
}
add_action('init','uncode_redirect_page_init');
function uncode_redirect_page_init() {
	add_filter('template_include', 'uncode_redirect_page');
}

add_filter( 'the_content_more_link', 'uncode_modify_read_more_link' );

function uncode_modify_read_more_link() {
	return '<a class="more-link btn-link" href="' . get_permalink() . '">'.esc_html__('Read more','uncode').'<i class="fa fa-angle-right"></i></a>';
}

if (!class_exists('WPBakeryShortCode')) {

	class uncode_index {
		protected $filter_categories = array();
		protected $query = false;
		protected $loop_args = array();
		protected $taxonomies = false;

		public function getCategoriesCss($post_id)
		{
			$categories_css = '';
			$categories_name = array();
			$tag_name = array();
			$categories_id = array();
			$taxonomy_type = array();
			$post_categories = wp_get_object_terms($post_id, $this->getTaxonomies());
			foreach ($post_categories as $cat)
			{
				if (is_taxonomy_hierarchical($cat->taxonomy) && substr( $cat->taxonomy, 0, 3 ) !== 'pa_') {
					if (!in_array($cat->term_id, $this->filter_categories)) {
						$this->filter_categories[] = $cat->term_id;
					}
					$categories_name[] = $cat->name;
					$categories_id[] = $cat->term_id;
				} else if ($cat->taxonomy === 'post_tag') {
					$categories_id[] = $cat->term_id;
					$categories_name[] = $cat->name;
					$tag_name[] = $cat->name;
				}
				$taxonomy_type[] = $cat->taxonomy;
			}

			return array('cat_css' => $categories_css, 'cat_name' => $categories_name, 'cat_id' => $categories_id, 'tag' => $tag_name, 'taxonomy' => $taxonomy_type );
		}
		protected function getTaxonomies()
		{
			if ($this->taxonomies === false) {
				$this->taxonomies = get_object_taxonomies(!empty($this->loop_args['post_type']) ? $this->loop_args['post_type'] : get_post_types(array(
					'public' => false,
					'name' => 'attachment'
				) , 'names', 'NOT'));
			}

			return $this->taxonomies;
		}
		public function getCategoriesLink( $post_id ) {
			$categories_link = array();
			$args = array('orderby' => 'term_group', 'order' => 'DESC', 'fields' => 'all');

			$post_categories = wp_get_object_terms( $post_id, $this->getTaxonomies(), $args);
			foreach ( $post_categories as $cat ) {
				if (is_taxonomy_hierarchical($cat->taxonomy) && substr( $cat->taxonomy, 0, 3 ) !== 'pa_') {
					$categories_link[] = array('link' => '<a href="'.get_term_link($cat->term_id, $cat->taxonomy).'">'.$cat->name.'</a>', 'tax' => $cat->taxonomy, 'cat_id' => $cat->term_id);
				} else if ($cat->taxonomy === 'post_tag') {
					$categories_link[] = array('link' => '<a href="'.get_term_link($cat->term_id, $cat->taxonomy).'">'.$cat->name.'</a>', 'tax' => $cat->taxonomy, 'cat_id' => $cat->term_id);
				}
			}
			return $categories_link;
		}
	}
}

if ( ! function_exists( 'uncode_is_full_page' ) ) :
/**
 * @since Uncode 1.7.0
 */
function uncode_is_full_page() {

	global $metabox_data;
	$return = false;
	if ( isset($metabox_data['_uncode_page_scroll'][0]) && $metabox_data['_uncode_page_scroll'][0] === 'slide' ) {
		$return = $metabox_data['_uncode_page_scroll'][0];
	}

	return $return;

}
endif; //uncode_is_full_page

if ( ! function_exists( 'uncode_is_scroll_snap' ) ) :
/**
 * @since Uncode 1.7.0
 */
function uncode_is_scroll_snap() {

	global $metabox_data;
	$return = false;
	if ( isset($metabox_data['_uncode_page_scroll'][0]) && $metabox_data['_uncode_page_scroll'][0] === 'on' && isset($metabox_data['_uncode_scroll_snap'][0]) && $metabox_data['_uncode_scroll_snap'][0] === 'on' ) {
		$return = 'scroll-snap';
	}

	return $return;

}
endif; //uncode_is_scroll_snap

function uncode_let_to_num( $size ) {
	$l   = substr( $size, -1 );
	$ret = substr( $size, 0, -1 );

	switch ( strtoupper( $l ) ) {
		case 'P':
			$ret *= 1024;
		case 'T':
			$ret *= 1024;
		case 'G':
			$ret *= 1024;
		case 'M':
			$ret *= 1024;
		case 'K':
			$ret *= 1024;
	}

	return $ret;
}

/**
 * Check if Uncode Privacy is active
 */
function uncode_is_uncode_privacy_active() {
	if ( class_exists( 'Uncode_Toolkit_Privacy' ) ) {
		return true;
	}

	return false;
}

/**
 * Check if Gutenberg is active
 */
function uncode_is_gutenberg_active() {
	global $wp_version;

	if ( version_compare( $wp_version, '5', '>=' ) ) {
		return true;
	}

	if ( function_exists( 'the_gutenberg_project' ) ) {
		return true;
	}

	return false;
}

add_action( 'wp_head', 'uncode_custom_css_cb', 1000 );
function uncode_custom_css_cb() {

	if ( ! is_singular() ) {
		return;
	}

	$post_type = isset( $post->post_type ) ? $post->post_type : 'post';
	if (is_author()) {
		$post_type = 'author';
	}
	if (is_archive() || is_home()) {
		$post_type .= '_index';
	}
	if (is_404()) {
		$post_type = '404';
	}
	if (is_search()) {
		$post_type = 'search_index';
	}

	$id = get_the_ID();
	$metabox_data = get_post_custom($id);
}

if ( ! function_exists( 'uncode_change_edit_frontend_icon' ) ) :
	/**
	 * Change frontend editor icon
	 */
	function uncode_change_edit_frontend_icon() {
		if ( ! is_admin_bar_showing() ) {
			return;
		}

		$custom_css = '
			#wpadminbar #wp-admin-bar-vc_inline-admin-bar-link>.ab-item:before {
				content: "\f547";
				top: 2px;
			}';
		wp_add_inline_style( 'uncode-style', $custom_css );
	}
endif;
add_action( 'wp_enqueue_scripts', 'uncode_change_edit_frontend_icon', 100 );

if ( ! function_exists( 'uncode_remove_empty_widget_titles' ) ) :
add_filter( 'widget_title', 'uncode_remove_empty_widget_titles', 10, 3 );
/**
 * Remove widget titles if empty
 * @since Uncode 2.2.0
 */
function uncode_remove_empty_widget_titles( $title = null, $instance = null, $id_bas = null ) {
	if ( isset( $instance['title'] ) && $instance['title'] == '!' ) {
		$title = '';
	}
	return $title;
}
endif;
