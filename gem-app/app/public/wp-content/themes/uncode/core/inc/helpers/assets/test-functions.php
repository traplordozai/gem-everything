<?php
/**
 * Test related functions
 */

/**
 * Get page's required assets
 */
function uncode_get_page_assets() {
	global $uncode_check_asset, $uncode_post_data;

	$assets = array();

	// Get an array that contains all the raw content attached to the page
	$content_array = uncode_get_post_data_content_array();

	// Suffix
	$scripts_prod_conf = uncode_get_scripts_production_conf();
	$suffix            = $scripts_prod_conf['suffix'];

	// Check smooth scroll from PO or TO
	if ( uncode_post_data_is_singular() ) {
		$smooth_scroll = get_post_meta( $uncode_post_data['ID'], '_uncode_specific_smooth_scroll', true );
	}
	$smooth_scroll = (isset($smooth_scroll) && $smooth_scroll === 'on') ? $smooth_scroll : ot_get_option('_uncode_smooth_scroll');

	// Global App (always required)
	$assets['uncode-global'] = array(
		'handle'    => 'uncode-global',
		'path'      => get_template_directory_uri() . '/library/js/global' . $suffix . '.js',
		'deps'      => array(),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// Utils (always required)
	$assets['uncode-utils'] = array(
		'handle'    => 'uncode-utils',
		'path'      => get_template_directory_uri() . '/library/js/utils' . $suffix . '.js',
		'deps'      => apply_filters( 'uncode_smooth_scroll', $smooth_scroll ) ? array( 'jquery', 'lenis-scroll' ) : array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// Menu System (always required)
	$assets['uncode-menuSystem'] = array(
		'handle'    => 'uncode-menuSystem',
		'path'      => get_template_directory_uri() . '/library/js/menuSystem' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// disableHoverScroll (always required)
	$assets['uncode-disableHoverScroll'] = array(
		'handle'    => 'uncode-disableHoverScroll',
		'path'      => get_template_directory_uri() . '/library/js/disableHoverScroll' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// Animations (always required)
	$assets['uncode-animations'] = array(
		'handle'    => 'uncode-animations',
		'path'      => get_template_directory_uri() . '/library/js/animations' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// tapHover (always required)
	$assets['uncode-tapHover'] = array(
		'handle'    => 'uncode-tapHover',
		'path'      => get_template_directory_uri() . '/library/js/tapHover' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// preventDoubleTransition (always required)
	$assets['uncode-preventDoubleTransition'] = array(
		'handle'    => 'uncode-preventDoubleTransition',
		'path'      => get_template_directory_uri() . '/library/js/preventDoubleTransition' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// printScreen (always required)
	$assets['uncode-printScreen'] = array(
		'handle'    => 'uncode-printScreen',
		'path'      => get_template_directory_uri() . '/library/js/printScreen' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// Check Skin on Scroll
	if ( uncode_page_require_check_skin_on_scroll() ) {
		$assets['change-skin-on-scroll'] = array(
			'handle'    => 'change-skin-on-scroll',
			'path'      => get_template_directory_uri() . '/library/js/changeSkinOnScroll' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Check Content Parallax
	if ( uncode_page_require_asset_row_parallax( $content_array ) ) {
		$assets['row-parallax'] = array(
			'handle'    => 'row-parallax',
			'path'      => get_template_directory_uri() . '/library/js/rowParallax' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Check Sticky Trigger
	if ( uncode_page_require_asset_sticky_trigger( $content_array ) ) {
		$assets['sticky-trigger'] = array(
			'handle'    => 'sticky-trigger',
			'path'      => get_template_directory_uri() . '/library/js/stickyTrigger' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
		$assets['gsap'] = array(
			'handle'    => 'gsap',
			'path'      => get_template_directory_uri() . '/library/js/lib/gsap' . $suffix . '.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);
		$assets['scrollTrigger'] = array(
			'handle'    => 'scrollTrigger',
			'path'      => get_template_directory_uri() . '/library/js/lib/ScrollTrigger' . $suffix . '.js',
			'deps'      => array( 'gsap' ),
			'type'      => 'js',
			'in_footer' => true,
		);

	}

	// Check Lenis Scroll
	if ( apply_filters( 'uncode_smooth_scroll', $smooth_scroll ) ) {
		$assets['lenis-scroll'] = array(
			'handle'    => 'lenis-scroll',
			'path'      => get_template_directory_uri() . '/library/js/lib/lenis' . $suffix . '.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['lenis-scroll-style'] = array(
			'handle'    => 'lenis-scroll-style',
			'path'      => get_template_directory_uri() . '/library/css/style-lenis.css',
			'type'      => 'css',
		);
	}

	// Check medias attached to a single post/page once
	uncode_page_require_asset_featured_medias( $content_array );

	// Check videos/oembeds/medias once
	uncode_page_require_asset_background_media( $content_array );

	// Check self hosted videos with WP shortcdode once
	uncode_page_require_asset_video_shortcode( $content_array );

	// Check css grids once
	uncode_page_require_asset_css_grid( $content_array );

	// GSAP
	if ( uncode_page_require_asset_gsap( $content_array ) ) {
		$assets['gsap'] = array(
			'handle'    => 'gsap',
			'path'      => get_template_directory_uri() . '/library/js/lib/gsap' . $suffix . '.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);

		// Magnetic
		if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['magnetic'] ) ) ) {
			$assets['uncode-magnetic'] = array(
				'handle'    => 'uncode-magnetic',
				'path'      => get_template_directory_uri() . '/library/js/magnetic' . $suffix . '.js',
				'deps'      => array( 'jquery', 'gsap' ),
				'type'      => 'js',
				'in_footer' => true,
			);
		}

		// Rotating Text
		if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['rotatingTxt'] ) ) ) {
			$assets['inview'] = array(
				'handle'    => 'inview',
				'path'      => get_template_directory_uri() . '/library/js/lib/inview' . $suffix . '.js',
				'deps'      => array( 'jquery-waypoints' ),
				'type'      => 'js',
				'in_footer' => true,
			);

			$assets['uncode-rotatingTxt'] = array(
				'handle'    => 'uncode-rotatingTxt',
				'path'      => get_template_directory_uri() . '/library/js/rotatingTxt' . $suffix . '.js',
				'deps'      => array( 'jquery', 'gsap', 'inview' ),
				'type'      => 'js',
				'in_footer' => true,
			);
		}

		// Skew
		if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['skewIt'] ) ) ) {
			$assets['uncode-skewIt'] = array(
				'handle'    => 'uncode-skewIt',
				'path'      => get_template_directory_uri() . '/library/js/skewIt' . $suffix . '.js',
				'deps'      => array( 'jquery', 'gsap' ),
				'type'      => 'js',
				'in_footer' => true,
			);
		}
	}

	// jQuery Bigtext
	if ( uncode_page_require_asset_jquery_bigtext( $content_array ) ) {
		$assets['jquery-bigtext'] = array(
			'handle'    => 'jquery-bigtext',
			'path'      => get_template_directory_uri() . '/library/js/lib/jquery.bigtext' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-bigText'] = array(
			'handle'    => 'uncode-bigText',
			'path'      => get_template_directory_uri() . '/library/js/bigText' . $suffix . '.js',
			'deps'      => array( 'jquery-bigtext' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Isotope
	$requires_isotope = uncode_page_require_asset_isotope( $content_array );

	if ( $requires_isotope['isotope'] ) {
		$assets['isotope-library'] = array(
			'handle'    => 'isotope-library',
			'path'      => get_template_directory_uri() . '/library/js/lib/isotope.pkgd' . $suffix . '.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-isotope'] = array(
			'handle'    => 'uncode-isotope',
			'path'      => get_template_directory_uri() . '/library/js/isotopeLayout' . $suffix . '.js',
			'deps'      => array( 'isotope-library' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	if ( $requires_isotope['packery'] ) {
		$assets['packery'] = array(
			'handle'    => 'packery',
			'path'      => get_template_directory_uri() . '/library/js/lib/packery-mode.pkgd' . $suffix . '.js',
			'deps'      => array( 'isotope-library' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	if ( $requires_isotope['cells-by-row'] ) {
		$assets['cells-by-row'] = array(
			'handle'    => 'cells-by-row',
			'path'      => get_template_directory_uri() . '/library/js/lib/cells-by-row' . $suffix . '.js',
			'deps'      => array( 'isotope-library' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Infinite scroll
	if ( uncode_page_require_asset_jquery_infinitescroll( $content_array ) ) {
		$assets['jquery-infinitescroll'] = array(
			'handle'    => 'jquery-infinitescroll',
			'path'      => get_template_directory_uri() . '/library/js/lib/jquery.infinitescroll' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// jQuery Waypoints (always required)
	$assets['jquery-waypoints'] = array(
		'handle'    => 'jquery-waypoints',
		'path'      => get_template_directory_uri() . '/library/js/lib/jquery.waypoints' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// jQuery SmartMenus (always required)
	$assets['jquery-smartmenus'] = array(
		'handle'    => 'jquery-smartmenus',
		'path'      => get_template_directory_uri() . '/library/js/lib/jquery.smartmenus' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// jQuery Easing (always required)
	$assets['jquery-easing'] = array(
		'handle'    => 'jquery-easing',
		'path'      => get_template_directory_uri() . '/library/js/lib/jquery.easing' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// jQuery Mousewheel (always required)
	$assets['jquery-mousewheel'] = array(
		'handle'    => 'jquery-mousewheel',
		'path'      => get_template_directory_uri() . '/library/js/lib/jquery.mousewheel' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// Owl Carousel
	if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['carousel'] ) ) || uncode_page_require_asset_owl_carousel( $content_array ) ) {
		$assets['owl-carousel'] = array(
			'handle'    => 'owl-carousel',
			'path'      => get_template_directory_uri() . '/library/js/lib/owl.carousel2' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['inview'] = array(
			'handle'    => 'inview',
			'path'      => get_template_directory_uri() . '/library/js/lib/inview' . $suffix . '.js',
			'deps'      => array( 'jquery-waypoints' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-carousel'] = array(
			'handle'    => 'uncode-carousel',
			'path'      => get_template_directory_uri() . '/library/js/carousel' . $suffix . '.js',
			'deps'      => array( 'owl-carousel', 'inview' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-owlcarousel'] = array(
			'handle'    => 'uncode-style-owlcarousel',
			'path'      => get_template_directory_uri() . '/library/css/style-owlcarousel.css',
			'type'      => 'css',
		);
	}

	// Uncode Owl Nav
	if ( uncode_page_require_asset_owlnav( $content_array ) ) {
		$assets['uncode-owl-nav'] = array(
			'handle'    => 'uncode-owl-nav',
			'path'      => get_template_directory_uri() . '/library/js/uncode-owl-nav' . $suffix . '.js',
			'deps'      => array( 'jquery', 'owl-carousel' ),
			'type'      => 'js',
			'in_footer' => true,
		);
		
		$assets['uncode-style-owl-nav'] = array(
			'handle'    => 'uncode-style-owl-nav',
			'path'      => get_template_directory_uri() . '/library/css/style-owl-nav.css',
			'type'      => 'css',
		);
	}

	// iLightBox
	if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['ilightbox'] ) ) || uncode_page_require_asset_ilightbox( $content_array ) ) {

		if ( get_option( 'uncode_core_settings_opt_lightbox_enhance' ) === 'on' ) {
			$assets['lightgallery'] = array(
				'handle'    => 'lightgallery',
				'path'      => get_template_directory_uri() . '/library/js/lib/lightgallery' . $suffix . '.js',
				'deps'      => array( 'jquery' ),
				'type'      => 'js',
				'in_footer' => true,
			);
			$assets['lg_video'] = array(
				'handle'    => 'lg_video',
				'path'      => get_template_directory_uri() . '/library/js/lib/lg-video' . $suffix . '.js',
				'deps'      => array( 'lightgallery' ),
				'type'      => 'js',
				'in_footer' => true,
			);
			$assets['lg_zoom'] = array(
				'handle'    => 'lg_zoom',
				'path'      => get_template_directory_uri() . '/library/js/lib/lg-zoom' . $suffix . '.js',
				'deps'      => array( 'lightgallery' ),
				'type'      => 'js',
				'in_footer' => true,
			);
			$assets['lg_thumbnail'] = array(
				'handle'    => 'lg_thumbnail',
				'path'      => get_template_directory_uri() . '/library/js/lib/lg-thumbnail' . $suffix . '.js',
				'deps'      => array( 'lightgallery' ),
				'type'      => 'js',
				'in_footer' => true,
			);
			$asset_lightgallery = uncode_page_require_asset_lightgallery( $content_array );
			if ( in_array( 'fullscreen', $asset_lightgallery ) ) {
				$assets['lg_fullscreen'] = array(
					'handle'    => 'lg_fullscreen',
					'path'      => get_template_directory_uri() . '/library/js/lib/lg-fullscreen' . $suffix . '.js',
					'deps'      => array( 'lightgallery' ),
					'type'      => 'js',
					'in_footer' => true,
				);
			}
			if ( in_array( 'hash', $asset_lightgallery ) ) {
				$assets['lg_hash'] = array(
					'handle'    => 'lg_hash',
					'path'      => get_template_directory_uri() . '/library/js/lib/lg-hash' . $suffix . '.js',
					'deps'      => array( 'lightgallery' ),
					'type'      => 'js',
					'in_footer' => true,
				);
			}
			if ( in_array( 'share', $asset_lightgallery ) ) {
				$assets['lg_share'] = array(
					'handle'    => 'lg_share',
					'path'      => get_template_directory_uri() . '/library/js/lib/lg-share' . $suffix . '.js',
					'deps'      => array( 'lightgallery' ),
					'type'      => 'js',
					'in_footer' => true,
				);
			}
			$assets['uncode-lightbox'] = array(
				'handle'    => 'uncode-lightbox',
				'path'      => get_template_directory_uri() . '/library/js/lightgallery' . $suffix . '.js',
				'deps'      => array( 'lightgallery' ),
				'type'      => 'js',
				'in_footer' => true,
			);
			$assets['uncode-style-lightgallery'] = array(
				'handle'    => 'uncode-style-lightgallery',
				'path'      => get_template_directory_uri() . '/library/css/style-lightgallery.css',
				'type'      => 'css',
			);

		} else {
			$assets['ilightbox'] = array(
				'handle'    => 'ilightbox',
				'path'      => get_template_directory_uri() . '/library/js/lib/ilightbox' . $suffix . '.js',
				'deps'      => array( 'jquery' ),
				'type'      => 'js',
				'in_footer' => true,
			);
			$assets['uncode-lightbox'] = array(
				'handle'    => 'uncode-lightbox',
				'path'      => get_template_directory_uri() . '/library/js/lightbox' . $suffix . '.js',
				'deps'      => array( 'ilightbox' ),
				'type'      => 'js',
				'in_footer' => true,
			);
			$assets['uncode-style-ilightbox'] = array(
				'handle'    => 'uncode-style-ilightbox',
				'path'      => get_template_directory_uri() . '/library/css/style-ilightbox.css',
				'type'      => 'css',
			);
		}
	}

	// Justified Gallery
	if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['justified'] ) ) || apply_filters( 'uncode_enqueue_justified_gallery', false ) ) {
		$assets['jquery-justifiedGallery'] = array(
			'handle'    => 'jquery-justifiedGallery',
			'path'      => get_template_directory_uri() . '/library/js/lib/jquery.justifiedGallery' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-justifiedGallery'] = array(
			'handle'    => 'uncode-justifiedGallery',
			'path'      => get_template_directory_uri() . '/library/js/justifiedGalleryInit' . $suffix . '.js',
			'deps'      => array( 'jquery-justifiedGallery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-justifiedGallery'] = array(
			'handle'    => 'uncode-style-justifiedGallery',
			'path'      => get_template_directory_uri() . '/library/css/style-justifiedGallery.css',
			'type'      => 'css',
		);
	}

	// VC Chart
	if ( uncode_page_require_asset_jquery_vc_chart( $content_array ) ) {
		$assets['jquery-vc_chart'] = array(
			'handle'    => 'jquery-vc_chart',
			'path'      => get_template_directory_uri() . '/library/js/lib/jquery.vc_chart' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-vc_pie'] = array(
			'handle'    => 'uncode-style-vc_pie',
			'path'      => get_template_directory_uri() . '/library/css/style-vc_pie.css',
			'type'      => 'css',
		);
	}

	// VC Progress
	if ( uncode_page_require_asset_jquery_vc_progress( $content_array ) ) {
		$assets['jquery-vc_progress'] = array(
			'handle'    => 'jquery-vc_progress',
			'path'      => get_template_directory_uri() . '/library/js/lib/jquery.vc_progress' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-vc_progress'] = array(
			'handle'    => 'uncode-style-vc_progress',
			'path'      => get_template_directory_uri() . '/library/css/style-vc_progress.css',
			'type'      => 'css',
		);
	}

	// Counterup
	if ( uncode_page_require_asset_jquery_counterup( $content_array ) ) {
		$assets['jquery-counterup'] = array(
			'handle'    => 'jquery-counterup',
			'path'      => get_template_directory_uri() . '/library/js/lib/jquery.counterup' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-counters'] = array(
			'handle'    => 'uncode-counters',
			'path'      => get_template_directory_uri() . '/library/js/counters' . $suffix . '.js',
			'deps'      => array( 'jquery-counterup' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-vc_counter'] = array(
			'handle'    => 'uncode-style-vc_counter',
			'path'      => get_template_directory_uri() . '/library/css/style-vc_counter.css',
			'type'      => 'css',
		);
	}

	// Countdown
	if ( uncode_page_require_asset_jquery_countdown( $content_array ) ) {
		$assets['jquery-countdown'] = array(
			'handle'    => 'jquery-countdown',
			'path'      => get_template_directory_uri() . '/library/js/lib/jquery.countdown' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-countdowns'] = array(
			'handle'    => 'uncode-countdowns',
			'path'      => get_template_directory_uri() . '/library/js/countdowns' . $suffix . '.js',
			'deps'      => array( 'jquery-countdown' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-vc_countdown'] = array(
			'handle'    => 'uncode-style-vc_countdown',
			'path'      => get_template_directory_uri() . '/library/css/style-vc_countdown.css',
			'type'      => 'css',
		);
	}

	// Share
	if ( uncode_page_require_asset_share( $content_array ) ) {
		$assets['share'] = array(
			'handle'    => 'share',
			'path'      => get_template_directory_uri() . '/library/js/lib/share' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-share'] = array(
			'handle'    => 'uncode-share',
			'path'      => get_template_directory_uri() . '/library/js/share' . $suffix . '.js',
			'deps'      => array( 'share' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-share'] = array(
			'handle'    => 'uncode-style-share',
			'path'      => get_template_directory_uri() . '/library/css/style-share.css',
			'type'      => 'css',
		);
	}

	// Noise
	if ( uncode_page_require_asset_simplex_noise( $content_array ) ) {
		$assets['simple-noise'] = array(
			'handle'    => 'simplex-noise',
			'path'      => get_template_directory_uri() . '/library/js/lib/simplex-noise' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-noise'] = array(
			'handle'    => 'uncode-noise',
			'path'      => get_template_directory_uri() . '/library/js/noise' . $suffix . '.js',
			'deps'      => array( 'simplex-noise' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-noise'] = array(
			'handle'    => 'uncode-style-noise',
			'path'      => get_template_directory_uri() . '/library/css/style-noise.css',
			'type'      => 'css',
		);
	}

	// Multi BG
	if ( uncode_page_require_asset_multi_bg( $content_array ) ) {
		$assets['uncode-multi-bg'] = array(
			'handle'    => 'uncode-multi-bg',
			'path'      => get_template_directory_uri() . '/library/js/multiBg' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-multi-bg'] = array(
			'handle'    => 'uncode-style-multi-bg',
			'path'      => get_template_directory_uri() . '/library/css/style-multi-bg.css',
			'type'      => 'css',
		);
	}

	// Sticky Kit (always required)
	$assets['jquery-sticky-kit'] = array(
		'handle'    => 'jquery-sticky-kit',
		'path'      => get_template_directory_uri() . '/library/js/lib/jquery.sticky-kit' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// stickyElements (always required)
	$assets['uncode-stickyElements'] = array(
		'handle'    => 'uncode-stickyElements',
		'path'      => get_template_directory_uri() . '/library/js/stickyElements' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'type'      => 'js',
		'in_footer' => true,
	);

	// Tab History
	if ( uncode_page_require_asset_bootstrap_tab_history( $content_array ) ) {
		$assets['bootstrap-tab-history'] = array(
			'handle'    => 'bootstrap-tab-history',
			'path'      => get_template_directory_uri() . '/library/js/lib/bootstrap-tab-history' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}


	// Unmodal
	if ( uncode_page_require_asset_unmodal( $content_array ) ) {
		$assets['uncode-unmodal'] = array(
			'handle'    => 'uncode-unmodal',
			'path'      => get_template_directory_uri() . '/library/js/unmodal' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-unmodal'] = array(
			'handle'    => 'uncode-style-unmodal',
			'path'      => get_template_directory_uri() . '/library/css/style-unmodal.css',
			'type'      => 'css',
		);
	}

	// Livesearch
	if ( uncode_page_require_asset_livesearch( $content_array ) ) {
		$assets['uncode-style-livesearch'] = array(
			'handle'    => 'uncode-style-livesearch',
			'path'      => get_template_directory_uri() . '/library/css/style-livesearch.css',
			'type'      => 'css',
		);

		$uncode_check_asset['livesearch'] = true;
	}

	// Menu Badges
	if ( apply_filters( 'uncode_activate_menu_badges', false ) ) {
		$assets['uncode-style-badges'] = array(
			'handle'    => 'uncode-style-badges',
			'path'      => get_template_directory_uri() . '/library/css/style-badges.css',
			'type'      => 'css',
		);
	}

	// Pricing tables
	if ( uncode_page_require_asset_pricing_tables( $content_array ) ) {
		$assets['uncode-style-pricing-tables'] = array(
			'handle'    => 'uncode-style-pricing-tables',
			'path'      => get_template_directory_uri() . '/library/css/style-pricing-tables.css',
			'type'      => 'css',
		);
	}

	// Full Page (Slides Scroll)
	if ( uncode_page_require_asset_jquery_fullpage( $content_array ) ) {
		$assets['jquery-fullpage'] = array(
			'handle'    => 'jquery-fullpage',
			'path'      => get_template_directory_uri() . '/library/js/lib/jquery.fullpage' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-fullPage'] = array(
			'handle'    => 'uncode-fullPage',
			'path'      => get_template_directory_uri() . '/library/js/fullPage' . $suffix . '.js',
			'deps'      => array( 'jquery-fullpage' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-onepage'] = array(
			'handle'    => 'uncode-style-onepage',
			'path'      => get_template_directory_uri() . '/library/css/style-onepage.css',
			'type'      => 'css',
		);

		$assets['uncode-style-fullpage'] = array(
			'handle'    => 'uncode-style-fullpage',
			'path'      => get_template_directory_uri() . '/library/css/style-fullpage.css',
			'type'      => 'css',
		);
	}

	// One Page (Simple Scroll)
	if ( uncode_page_require_asset_onepage( $content_array ) || ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['onepage'] ) ) || apply_filters( 'uncode_enqueue_onepage', false ) ) ) {
		$assets['uncode-onePage'] = array(
			'handle'    => 'uncode-onePage',
			'path'      => get_template_directory_uri() . '/library/js/onePage' . $suffix . '.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-onepage'] = array(
			'handle'    => 'uncode-style-onepage',
			'path'      => get_template_directory_uri() . '/library/css/style-onepage.css',
			'type'      => 'css',
		);
	}

	// Collapse
	if ( uncode_page_require_asset_collapse( $content_array ) ) {
		$assets['collapse'] = array(
			'handle'    => 'collapse',
			'path'      => get_template_directory_uri() . '/library/js/lib/collapse' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-collapse'] = array(
			'handle'    => 'uncode-collapse',
			'path'      => get_template_directory_uri() . '/library/js/collapse' . $suffix . '.js',
			'deps'      => array( 'collapse' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-panels'] = array(
			'handle'    => 'uncode-style-panels',
			'path'      => get_template_directory_uri() . '/library/css/style-panels.css',
			'type'      => 'css',
		);
	}

	// Accordion
	if ( uncode_page_require_asset_accordion( $content_array ) ) {
		$assets['uncode-checkScrollForTabs'] = array(
			'handle'    => 'uncode-checkScrollForTabs',
			'path'      => get_template_directory_uri() . '/library/js/checkScrollForTabs' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Video Thumbs
	if ( uncode_page_require_asset_video_thumbs( $content_array ) ) {
		$assets['uncode-video-thumbs'] = array(
			'handle'    => 'uncode-video-thumbs',
			'path'      => get_template_directory_uri() . '/library/js/video-thumbs' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Inline Images
	if ( uncode_page_require_asset_inline_images( $content_array ) ) {
		$assets['uncode-inline-images'] = array(
			'handle'    => 'uncode-inline-images',
			'path'      => get_template_directory_uri() . '/library/js/inline-images' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-inline-images'] = array(
			'handle'    => 'uncode-style-inline-images',
			'path'      => get_template_directory_uri() . '/library/css/style-inline-images.css',
			'type'      => 'css',
		);
	}

	// Tabs
	if ( uncode_page_require_asset_tab( $content_array ) ) {
		$assets['tab'] = array(
			'handle'    => 'tab',
			'path'      => get_template_directory_uri() . '/library/js/lib/tab' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-tabs'] = array(
			'handle'    => 'uncode-tabs',
			'path'      => get_template_directory_uri() . '/library/js/tabs' . $suffix . '.js',
			'deps'      => array( 'tab' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-checkScrollForTabs'] = array(
			'handle'    => 'uncode-checkScrollForTabs',
			'path'      => get_template_directory_uri() . '/library/js/checkScrollForTabs' . $suffix . '.js',
			'deps'      => array( 'uncode-tabs' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-navs'] = array(
			'handle'    => 'uncode-style-navs',
			'path'      => get_template_directory_uri() . '/library/css/style-navs.css',
			'type'      => 'css',
		);
	}

	// Tooltip
	if ( uncode_page_require_asset_tooltip( $content_array ) ) {
		$assets['tooltip'] = array(
			'handle'    => 'tooltip',
			'path'      => get_template_directory_uri() . '/library/js/lib/tooltip' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-tooltip'] = array(
			'handle'    => 'uncode-tooltip',
			'path'      => get_template_directory_uri() . '/library/js/tooltip' . $suffix . '.js',
			'deps'      => array( 'tooltip' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-tooltip'] = array(
			'handle'    => 'uncode-style-tooltip',
			'path'      => get_template_directory_uri() . '/library/css/style-tooltip.css',
			'type'      => 'css',
		);
	}

	// Transition (always required)
	$assets['transition'] = array(
		'handle'    => 'transition',
		'path'      => get_template_directory_uri() . '/library/js/lib/transition' . $suffix . '.js',
		'deps'      => array(),
		'in_footer' => true,
		'type'      => 'js',
		'required'  => true,
	);

	// Rellax
	if ( uncode_page_require_asset_rellax( $content_array ) ) {
		$assets['rellax'] = array(
			'handle'    => 'rellax',
			'path'      => get_template_directory_uri() . '/library/js/lib/rellax' . $suffix . '.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-parallax'] = array(
			'handle'    => 'uncode-parallax',
			'path'      => get_template_directory_uri() . '/library/js/parallax' . $suffix . '.js',
			'deps'      => array( 'rellax' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// OkVideo
	if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['okvideo'] ) ) || apply_filters( 'uncode_enqueue_okvideo', false ) ) {
		$assets['okvideo'] = array(
			'handle'    => 'okvideo',
			'path'      => get_template_directory_uri() . '/library/js/lib/okvideo' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'type'      => 'js',
		);
		$assets['uncode-okvideo'] = array(
			'handle'    => 'uncode-okvideo',
			'path'      => get_template_directory_uri() . '/library/js/okvideo-prepend' . $suffix . '.js',
			'deps'      => array( 'jquery', 'okvideo' ),
			'in_footer' => true,
			'type'      => 'js',
		);
	}

	if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['twitter'] ) ) || apply_filters( 'uncode_enqueue_twitter', false ) ) {
		$assets['uncode-style-twitter'] = array(
			'handle'    => 'uncode-style-twitter',
			'path'      => get_template_directory_uri() . '/library/css/style-twitter.css',
			'type'      => 'css',
		);
	}

	// Mediaelement
	$native_media_player = ot_get_option('_uncode_media_player') === 'on';
	if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['mediaelement'] ) ) || apply_filters( 'uncode_enqueue_mediaelement', false ) ) {
		if ( $native_media_player !== true ) {
			$assets['wp-mediaelement'] = array(
				'handle'  => 'wp-mediaelement',
				'enqueue' => true,
				'type'    => 'js',
			);
		}

		if ( isset( $uncode_check_asset['bg_video'] ) || apply_filters( 'uncode_enqueue_mediaelement', false ) ) {
			$assets['uncode-backgroundSelfVideos'] = array(
				'handle'    => 'uncode-backgroundSelfVideos',
				'path'      => get_template_directory_uri() . '/library/js/backgroundSelfVideos' . $suffix . '.js',
				'deps'      => $native_media_player ? array( 'jquery' ) : array( 'wp-mediaelement' ),
				'type'      => 'js',
				'in_footer' => true,
			);
		}

		if ( $native_media_player !== true ) {
			$assets['uncode-style-mediaelement'] = array(
				'handle'    => 'uncode-style-mediaelement',
				'path'      => get_template_directory_uri() . '/library/css/style-mediaelement.css',
				'type'      => 'css',
			);
		}
	}

	// Comments
	if ( uncode_page_require_asset_comments( $content_array ) ) {
		if ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['comment-reply'] ) ) {
			$assets['comment-reply'] = array(
				'handle'  => 'comment-reply',
				'enqueue' => true,
				'type'    => 'js',
			);
		}

		$assets['uncode-style-comments'] = array(
			'handle'    => 'uncode-style-comments',
			'path'      => get_template_directory_uri() . '/library/css/style-comments.css',
			'type'      => 'css',
		);
	}

	// Breadcrumbs
	if ( uncode_page_require_asset_breadcrumbs( $content_array ) ) {
		$assets['uncode-style-breadcrumbs'] = array(
			'handle'    => 'uncode-style-breadcrumbs',
			'path'      => get_template_directory_uri() . '/library/css/style-breadcrumbs.css',
			'type'      => 'css',
		);
	}

	// Object-fit polyfill
	if ( uncode_page_require_asset_objectfit_polyfill( $content_array ) ) {
		$assets['uncode-ofi'] = array(
			'handle'    => 'uncode-ofi',
			'path'      => get_template_directory_uri() . '/library/js/lib/ofi' . $suffix . '.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Cursor
	if ( uncode_page_require_asset_magic_cursor( $content_array ) ) {
		$assets['uncode-cursor'] = array(
			'handle'    => 'uncode-cursor',
			'path'      => get_template_directory_uri() . '/library/js/cursor' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Custom Fields
	if ( uncode_page_require_asset_custom_fields( $content_array ) ) {
		$assets['uncode-style-vc_custom_fields'] = array(
			'handle'    => 'uncode-style-vc_custom_fields',
			'path'      => get_template_directory_uri() . '/library/css/style-vc_custom_fields.css',
			'type'      => 'css',
		);
	}

	// Filters
	if ( uncode_page_require_asset_filters( $content_array ) ) {
		$assets['uncode-style-filters'] = array(
			'handle'    => 'uncode-style-filters',
			'path'      => get_template_directory_uri() . '/library/css/style-filters.css',
			'type'      => 'css',
		);
	}

	// Extra Filters
	if ( uncode_page_require_asset_extra_filters( $content_array ) ) {
		$assets['uncode-extra-filters'] = array(
			'handle'    => 'uncode-extra-filters',
			'path'      => get_template_directory_uri() . '/library/js/filters' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-filters'] = array(
			'handle'    => 'uncode-style-filters',
			'path'      => get_template_directory_uri() . '/library/css/style-filters.css',
			'type'      => 'css',
		);
	}

	// Widgets
	if ( uncode_page_require_asset_widgets( $content_array ) ) {
		$assets['uncode-widgets'] = array(
			'handle'    => 'uncode-widgets',
			'path'      => get_template_directory_uri() . '/library/js/widgets' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-widgets'] = array(
			'handle'    => 'uncode-style-widgets',
			'path'      => get_template_directory_uri() . '/library/css/style-widgets.css',
			'type'      => 'css',
		);
	}

	// TwentyTwenty
	if ( uncode_page_require_asset_twentytwenty( $content_array ) ) {
		$assets['uncode-twentytwenty'] = array(
			'handle'    => 'uncode-twentytwenty',
			'path'      => get_template_directory_uri() . '/library/js/twentytwenty' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-twentytwenty'] = array(
			'handle'    => 'uncode-style-twentytwenty',
			'path'      => get_template_directory_uri() . '/library/css/style-twentytwenty.css',
			'type'      => 'css',
		);
	}

	// BG Changer
	if ( uncode_page_require_asset_bg_changer( $content_array ) ) {
		$assets['uncode-bgChanger'] = array(
			'handle'    => 'uncode-bgChanger',
			'path'      => get_template_directory_uri() . '/library/js/bgChanger' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Vertical Text
	uncode_page_require_asset_vertical_text( $content_array );

	if ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['fixedElement'] ) ) {
		$assets['uncode-verticalText'] = array(
			'handle'    => 'uncode-verticalText',
			'path'      => get_template_directory_uri() . '/library/js/verticalText' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		if ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['verticalText'] ) ) {
				$assets['uncode-style-vertical-text'] = array(
				'handle'    => 'uncode-style-vertical-text',
				'path'      => get_template_directory_uri() . '/library/css/style-vertical-text.css',
				'type'      => 'css',
			);
		}

		if ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['horizontalText'] ) ) {
				$assets['uncode-style-horizontal-text'] = array(
				'handle'    => 'uncode-style-horizontal-text',
				'path'      => get_template_directory_uri() . '/library/css/style-horizontal-text.css',
				'type'      => 'css',
			);
		}
	}

	// Iconbox
	if ( uncode_page_require_asset_iconbox( $content_array ) ) {
		$assets['uncode-style-iconbox'] = array(
			'handle'    => 'uncode-style-iconbox',
			'path'      => get_template_directory_uri() . '/library/css/style-iconbox.css',
			'type'      => 'css',
		);
	}

	// Dividers
	if ( uncode_page_require_asset_dividers( $content_array ) ) {
		$assets['uncode-style-dividers'] = array(
			'handle'    => 'uncode-style-dividers',
			'path'      => get_template_directory_uri() . '/library/css/style-dividers.css',
			'type'      => 'css',
		);
	}

	// Single Media
	if ( uncode_page_require_asset_single_media( $content_array ) ) {
		$assets['uncode-style-single-media'] = array(
			'handle'    => 'uncode-style-single-media',
			'path'      => get_template_directory_uri() . '/library/css/style-single-media.css',
			'type'      => 'css',
		);
	}

	// Drop Image
	if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['dropImage'] ) ) || apply_filters( 'uncode_enqueue_drop_image', false ) ) {
		$assets['uncode-dropImage'] = array(
			'handle'    => 'uncode-dropImage',
			'path'      => get_template_directory_uri() . '/library/js/dropImage' . $suffix . '.js',
			'deps'      => array( 'jquery', 'gsap' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-drop-image'] = array(
			'handle'    => 'uncode-style-drop-image',
			'path'      => get_template_directory_uri() . '/library/css/style-drop-image.css',
			'type'      => 'css',
		);
	}

	// Post Table
	if ( uncode_page_require_asset_post_table( $content_array ) ) {
		$assets['uncode-postTable'] = array(
			'handle'    => 'uncode-postTable',
			'path'      => get_template_directory_uri() . '/library/js/postTable' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-post-table'] = array(
			'handle'    => 'uncode-style-post-table',
			'path'      => get_template_directory_uri() . '/library/css/style-post-table.css',
			'type'      => 'css',
		);
	}

	// Read more
	if ( uncode_page_require_asset_read_more( $content_array ) ) {
		$assets['uncode-read-more'] = array(
			'handle'    => 'uncode-read-more',
			'path'      => get_template_directory_uri() . '/library/js/read-more' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-read-more'] = array(
			'handle'    => 'uncode-style-read-more',
			'path'      => get_template_directory_uri() . '/library/css/style-read-more.css',
			'type'      => 'css',
		);
	}

	// Rotate It
	if ( uncode_page_require_asset_rotate_it( $content_array ) ) {
		$assets['uncode-rotateIt'] = array(
			'handle'    => 'uncode-rotateIt',
			'path'      => get_template_directory_uri() . '/library/js/rotateIt' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Text Marquee
	if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['textMarquee'] ) ) || apply_filters( 'uncode_enqueue_text_marquee', false ) ) {
		$assets['inview'] = array(
			'handle'    => 'inview',
			'path'      => get_template_directory_uri() . '/library/js/lib/inview' . $suffix . '.js',
			'deps'      => array( 'jquery-waypoints' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-textMarquee'] = array(
			'handle'    => 'uncode-textMarquee',
			'path'      => get_template_directory_uri() . '/library/js/textMarquee' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-text-marquee'] = array(
			'handle'    => 'uncode-style-text-marquee',
			'path'      => get_template_directory_uri() . '/library/css/style-text-marquee.css',
			'type'      => 'css',
		);

	}

	// Pricing List
	if ( uncode_page_require_asset_pricing_list( $content_array ) ) {
		$assets['uncode-style-pricing-list'] = array(
			'handle'    => 'uncode-style-pricing-list',
			'path'      => get_template_directory_uri() . '/library/css/style-pricing-list.css',
			'type'      => 'css',
		);
	}

	// Star Rating
	if ( uncode_page_require_asset_star_rating( $content_array ) ) {
		$assets['uncode-style-star-rating'] = array(
			'handle'    => 'uncode-style-star-rating',
			'path'      => get_template_directory_uri() . '/library/css/style-star-rating.css',
			'type'      => 'css',
		);
	}

	// Sticky scroll
	if ( uncode_page_require_asset_sticky_scroll( $content_array ) ) {
		$assets['gsap'] = array(
			'handle'    => 'gsap',
			'path'      => get_template_directory_uri() . '/library/js/lib/gsap' . $suffix . '.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['scrollTrigger'] = array(
			'handle'    => 'scrollTrigger',
			'path'      => get_template_directory_uri() . '/library/js/lib/ScrollTrigger' . $suffix . '.js',
			'deps'      => array( 'gsap' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-stickyScroll'] = array(
			'handle'    => 'uncode-sticky-scroll',
			'path'      => get_template_directory_uri() . '/library/js/stickyScroll' . $suffix . '.js',
			'deps'      => array( 'jquery', 'scrollTrigger' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-sticky-scroll'] = array(
			'handle'    => 'uncode-style-sticky-scroll',
			'path'      => get_template_directory_uri() . '/library/css/style-sticky-scroll.css',
			'type'      => 'css',
		);
	}

	// VC Navigation
	if ( uncode_page_require_asset_vc_navigation( $content_array ) ) {
		$assets['uncode-style-vc_navigation'] = array(
			'handle'    => 'uncode-style-vc_navigation',
			'path'      => get_template_directory_uri() . '/library/css/style-vc_navigation.css',
			'type'      => 'css',
		);
	}

	// CSS Grid
	if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['cssgrid'] ) ) ) {
		$assets['uncode-style-css-grid'] = array(
			'handle'    => 'uncode-style-css-grid',
			'path'      => get_template_directory_uri() . '/library/css/style-css-grid.css',
			'type'      => 'css',
		);

		// AJAX pagination and load more
		if ( ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['cssgrid_js'] ) ) ) {
			$assets['uncode-css-grid'] = array(
				'handle'    => 'uncode-css-grid',
				'path'      => get_template_directory_uri() . '/library/js/cssGrid' . $suffix . '.js',
				'deps'      => array( 'jquery' ),
				'type'      => 'js',
				'in_footer' => true,
			);
		}
	}

	// Linear Grid
	if ( uncode_page_require_asset_linear_grid( $content_array ) ) {
		$assets['uncode-style-linear-grid'] = array(
			'handle'    => 'uncode-style-linear-grid',
			'path'      => get_template_directory_uri() . '/library/css/style-linear-grid.css',
			'type'      => 'css',
		);

		$assets['gsap'] = array(
			'handle'    => 'gsap',
			'path'      => get_template_directory_uri() . '/library/js/lib/gsap' . $suffix . '.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['gsap-draggable'] = array(
			'handle'    => 'gsap-draggable',
			'path'      => get_template_directory_uri() . '/library/js/lib/Draggable' . $suffix . '.js',
			'deps'      => array( 'gsap' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-linear-grid'] = array(
			'handle'    => 'uncode-linear-grid',
			'path'      => get_template_directory_uri() . '/library/js/linearGrid' . $suffix . '.js',
			'deps'      => array( 'jquery', 'gsap', 'gsap-draggable' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Ajax Filters
	if ( uncode_page_require_asset_ajax_filters( $content_array ) ) {
		$assets['uncode-style-ajax-filters'] = array(
			'handle'    => 'uncode-style-ajax-filters',
			'path'      => get_template_directory_uri() . '/library/js/ajax-filters' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-filters'] = array(
			'handle'    => 'uncode-style-filters',
			'path'      => get_template_directory_uri() . '/library/css/style-filters.css',
			'type'      => 'css',
		);
	}

	// Gallery Utils
	if ( $requires_isotope['isotope'] || ( is_array( $uncode_check_asset ) && isset( $uncode_check_asset['gallery_utils'] ) ) ) {
		$assets['uncode-style-gallery-utils'] = array(
			'handle'    => 'uncode-style-gallery-utils',
			'path'      => get_template_directory_uri() . '/library/css/style-gallery-utils.css',
			'type'      => 'css',
		);
	}

	// Utils (always required)
	$assets['uncode-style-utils'] = array(
		'handle'    => 'uncode-style-utils',
		'path'      => get_template_directory_uri() . '/library/css/style-utils.css',
		'type'      => 'css',
	);

	// CF7
	if ( uncode_page_require_asset_cf7( $content_array ) ) {
		$assets['uncode-style-cf7'] = array(
			'handle'    => 'uncode-style-cf7',
			'path'      => get_template_directory_uri() . '/library/css/style-cf7.css',
			'type'      => 'css',
		);

		$uncode_check_asset['cf7'] = true;
	}

	// WordPress Gallery
	if ( uncode_page_require_asset_wordpress_gallery( $content_array ) ) {
		$assets['uncode-style-wordpress-gallery'] = array(
			'handle'    => 'uncode-style-wordpress-gallery',
			'path'      => get_template_directory_uri() . '/library/css/style-wordpress-gallery.css',
			'type'      => 'css',
		);
	}

	// Author Profile
	if ( uncode_page_require_asset_author_profile( $content_array ) ) {
		$assets['uncode-style-author-profile'] = array(
			'handle'    => 'uncode-style-author-profile',
			'path'      => get_template_directory_uri() . '/library/css/style-author.css',
			'type'      => 'css',
		);
	}

	// Vivus
	if ( uncode_page_require_asset_vivus( $content_array ) ) {
		$assets['vivus'] = array(
			'handle'    => 'vivus',
			'path'      => get_template_directory_uri() . '/library/js/lib/vivus' . $suffix . '.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Google Maps
	if ( uncode_page_require_asset_gmaps( $content_array ) ) {
		$assets['uncode-style-gmaps'] = array(
			'handle'    => 'uncode-style-gmaps',
			'path'      => get_template_directory_uri() . '/library/css/style-gmaps.css',
			'type'      => 'css',
		);
	}

	// VC Particles
	if ( uncode_page_require_asset_particles( $content_array ) ) {
		$assets['uncode-particles'] = array(
			'handle'    => 'uncode-particles',
			'path'      => get_template_directory_uri() . '/library/js/particles' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Revslider
	if ( uncode_page_require_asset_revslider( $content_array ) ) {
		$assets['uncode-revslider'] = array(
			'handle'    => 'uncode-revslider',
			'path'      => get_template_directory_uri() . '/library/js/revslider' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// LayerSlider
	if ( uncode_page_require_asset_layerslider( $content_array ) ) {
		$assets['uncode-layerslider'] = array(
			'handle'    => 'uncode-layerslider',
			'path'      => get_template_directory_uri() . '/library/js/layerslider' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// Shortpixel
	if ( uncode_page_require_asset_shortpixel( $content_array ) ) {
		$assets['uncode-shortpixel'] = array(
			'handle'    => 'uncode-shortpixel',
			'path'      => get_template_directory_uri() . '/library/js/shortpixel' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);
	}

	// WooCommerce
	if ( uncode_page_require_asset_woocommerce( $content_array ) ) {
		$assets['woocommerce-uncode'] = array(
			'handle'    => 'woocommerce-uncode',
			'path'      => get_template_directory_uri() . '/library/js/woocommerce-uncode' . $suffix . '.js',
			'deps'      => array( 'jquery', 'wc-cart-fragments' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-woocommerce'] = array(
			'handle'    => 'uncode-woocommerce',
			'path'      => get_template_directory_uri() . '/library/css/woocommerce.css',
			'type'      => 'css',
		);

		$uncode_check_asset['woocommerce'] = true;
	}

	// Swatches
	if ( uncode_page_require_asset_swatches( $content_array ) || ( isset( $uncode_check_asset['woocommerce'] ) && $uncode_check_asset['woocommerce'] === true ) ) {
		$assets['uncode-swacthes'] = array(
			'handle'    => 'uncode-swatches',
			'path'      => get_template_directory_uri() . '/library/css/style-swatches.css',
			'type'      => 'css',
		);
	}

	// Wishlist
	if ( uncode_page_require_asset_wishlist( $content_array ) || ( isset( $uncode_check_asset['woocommerce'] ) && $uncode_check_asset['woocommerce'] === true && class_exists( 'YITH_WCWL' ) ) ) {
		$assets['uncode-woocommerce-wishlist'] = array(
			'handle'    => 'uncode-woocommerce-wishlist',
			'path'      => get_template_directory_uri() . '/library/js/woocommerce-wishlist' . $suffix . '.js',
			'deps'      => array( 'jquery' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-wishlist'] = array(
			'handle'    => 'uncode-wishlist',
			'path'      => get_template_directory_uri() . '/library/css/wishlist.css',
			'type'      => 'css',
		);

		$uncode_check_asset['wishlist'] = true;
	}

	// Lottie
	if ( uncode_page_require_asset_lottie( $content_array ) ) {
		$assets['uncode-lottie'] = array(
			'handle'    => 'uncode-lottie',
			'path'      => get_template_directory_uri() . '/library/js/uncode-lottie' . $suffix . '.js',
			'deps'      => array( 'jquery', 'uncode-lottie-interactivity' ),
			'type'      => 'js',
			'in_footer' => true,
		);

		$assets['uncode-style-lottie'] = array(
			'handle'    => 'uncode-style-lottie',
			'path'      => get_template_directory_uri() . '/library/css/style-lottie.css',
			'type'      => 'css',
		);
	}

	// App loader
	$assets['uncode-app'] = array(
		'handle'    => 'uncode-app',
		'path'      => get_template_directory_uri() . '/library/js/app-loader' . $suffix . '.js',
		'deps'      => array( 'jquery' ),
		'type'      => 'js',
		'in_footer' => true,
		'required'  => true,
	);

	return $assets;
}

/**
 * Always split assets
 */
function uncode_get_whenever_page_assets() {

	$assets = array();

	// Get an array that contains all the raw content attached to the page
	$content_array = uncode_get_post_data_content_array();

	// Lottie Player
	if ( uncode_page_require_asset_lottie( $content_array ) ) {
		$assets['lottie'] = array(
			'handle'    => 'uncode-lottie-player',
			'path'      => get_template_directory_uri() . '/library/js/lib/lottie-player.js',
			'deps'      => array(),
			'type'      => 'js',
			'in_footer' => true,
		);

		if ( uncode_page_require_asset_lottie_interactivity( $content_array ) ) {
			$assets['lottie-interactivity'] = array(
				'handle'    => 'uncode-lottie-interactivity',
				'path'      => get_template_directory_uri() . '/library/js/lib/lottie-interactivity.js',
				'deps'      => array('uncode-lottie-player'),
				'type'      => 'js',
				'in_footer' => true,
			);
		}
	}

	return $assets;
}
