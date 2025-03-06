<?php
/**
 * Core functions
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Initialize dynamic class
 */
function uncode_wf_initialize_dynamic_class() {
	return new UNCDWF_Dynamic();
}

/**
 * Adds wireframes to VC
 */
function uncode_wf_add_wireframes() {
	global $post;

	// Check if we are on a content block
	$is_content_block = isset( $post->post_type ) && $post->post_type === 'uncodeblock' ? true : false;

	// Get list of files
	$files              = uncode_wf_get_top_wireframes();
	$wireframes_root    = UNCDWF_WIREFRAMES_DIR;
	$wireframes_folders = uncode_wf_get_wireframe_folders();

	foreach ( $wireframes_folders as $folder ) {
		$files = array_merge( $files, glob( "{$wireframes_root}/{$folder}/*.php" ) );
	}

	// Remove duplicates
	$files = array_unique( $files );

	// Load every file
	foreach ( $files as $filename ) {
		include_once $filename;
	}
}

/**
 * Gets wireframes categories
 */
function uncode_wf_get_wireframe_categories() {
	$wireframe_categories = array(
		'all'                 => esc_html__( 'All', 'uncode-wireframes' ),
		'contents'            => esc_html__( 'Contents', 'uncode-wireframes' ),
		'icons'               => esc_html__( 'Icons', 'uncode-wireframes' ),
		'call_to_action'      => esc_html__( 'Call To Actions', 'uncode-wireframes' ),
		'headers'             => esc_html__( 'Headers', 'uncode-wireframes' ),
		'portfolio'           => esc_html__( 'Portfolio', 'uncode-wireframes' ),
		'blogs'               => esc_html__( 'Blog', 'uncode-wireframes' ),
		'news'                => esc_html__( 'News', 'uncode-wireframes' ),
		'galleries'           => esc_html__( 'Galleries', 'uncode-wireframes' ),
		'grids'               => esc_html__( 'Grids', 'uncode-wireframes' ),
		'patterns'            => esc_html__( 'Patterns', 'uncode-wireframes' ),
		'cards'               => esc_html__( 'Cards', 'uncode-wireframes' ),
		'shop'                => esc_html__( 'Shop', 'uncode-wireframes' ),
		'products'            => esc_html__( 'Products', 'uncode-wireframes' ),
		'cart-checkout'       => esc_html__( 'Cart & Checkout', 'uncode-wireframes' ),
		'shop-utilities'      => esc_html__( 'Shop Utilities', 'uncode-wireframes' ),
		'counters'            => esc_html__( 'Counters', 'uncode-wireframes' ),
		'pricing_tables'      => esc_html__( 'Pricing Tables', 'uncode-wireframes' ),
		'tabs-accordions'     => esc_html__( 'Tabs Accordions', 'uncode-wireframes' ),
		'forms'               => esc_html__( 'Forms', 'uncode-wireframes' ),
		'maps'                => esc_html__( 'Maps', 'uncode-wireframes' ),
		'team_members'        => esc_html__( 'Team Members', 'uncode-wireframes' ),
		'quotes'              => esc_html__( 'Quotes', 'uncode-wireframes' ),
		'specials'            => esc_html__( 'Special', 'uncode-wireframes' ),
		'navigation'          => esc_html__( 'Navigation', 'uncode-wireframes' ),
		'carousel-navigation' => esc_html__( 'Carousel Navigation', 'uncode-wireframes' ),
		'footers'             => esc_html__( 'Footers', 'uncode-wireframes' ),
		'popups'              => esc_html__( 'Popups', 'uncode-wireframes' ),
	);

	return $wireframe_categories;
}

/**
 * Maps wireframes folders
 */
function uncode_wf_get_wireframe_folders() {
	$wireframe_folders = array(
		'contents',
		'icons',
		'call-to-action',
		'headers',
		'portfolio',
		'blogs',
		'news',
		'galleries',
		'grids',
		'patterns',
		'counters',
		'pricing-tables',
		'forms',
		'maps',
		'team-members',
		'quotes',
		'shop',
		'products',
		'cart-checkout',
		'shop-utilities',
		'specials',
		'navigation',
		'footers',
		'carousel-navigation',
		'popups',
		'tabs-accordions',
		'cards',
	);

	return $wireframe_folders;
}

/**
 * Gets top wireframes
 */
function uncode_wf_get_top_wireframes() {
	$top_wireframes = array(
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Details-Images.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Columns.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Author-Grid.php',
		UNCDWF_WIREFRAMES_DIR . 'portfolio/Portfolio-Titles-Inline-Mouse-Center.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Evidence-Off-Grid.php',
		UNCDWF_WIREFRAMES_DIR . 'counters/Counter-Creative-Alt.php',
		UNCDWF_WIREFRAMES_DIR . 'grids/Grid-Justify.php',
		UNCDWF_WIREFRAMES_DIR . 'specials/Special-Heading-with-Images-Light.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-About-Creative-Light.php',
		UNCDWF_WIREFRAMES_DIR . 'headers/Header-Slider-Classic-Agency.php',
		UNCDWF_WIREFRAMES_DIR . 'portfolio/Portfolio-Titles-Block-Mouse-Left.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Justify-Wide.php',
		UNCDWF_WIREFRAMES_DIR . 'carousel-navigation/Carousel-Nav-Arrows-Outside.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Justify-with-Image.php',
		UNCDWF_WIREFRAMES_DIR . 'grids/Grid-Texts.php',
		UNCDWF_WIREFRAMES_DIR . 'tabs-accordions/Tabs-with-Contents.php',
		UNCDWF_WIREFRAMES_DIR . 'news/News-Table-Center.php',
		UNCDWF_WIREFRAMES_DIR . 'portfolio/Portfolio-Three-Overlay-Fullscreen.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Image-Details-Fullwidth.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Image-Cards-Parallax.php',
		UNCDWF_WIREFRAMES_DIR . 'pricing-tables/Pricing-List-Tabs-Images.php',
		UNCDWF_WIREFRAMES_DIR . 'grids/Grid-Texts-Alt.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Shape-Dividers-Waves.php',
		UNCDWF_WIREFRAMES_DIR . 'footers/Footer-Creative-Freelance.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-with-Image-Cards.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Image-Details-Alt-Fullwidth.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Content-Carousel.php',
		UNCDWF_WIREFRAMES_DIR . 'icons/Icon-Left.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Media-Off-Grid.php',
		UNCDWF_WIREFRAMES_DIR . 'team-members/Team-Members-Corporation.php',
		UNCDWF_WIREFRAMES_DIR . 'call-to-action/Call-To-Action-Buttons.php',
		UNCDWF_WIREFRAMES_DIR . 'headers/Header-Classic-Consultants-Alt.php',
		UNCDWF_WIREFRAMES_DIR . 'news/News-with-Focus.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Content-Carousel-Alt-Dark.php',
		UNCDWF_WIREFRAMES_DIR . 'contents/Content-Features.php',
		UNCDWF_WIREFRAMES_DIR . 'portfolio/Portfolio-Classic-Photographer.php',
		UNCDWF_WIREFRAMES_DIR . 'call-to-action/Call-To-Action-Accent.php',
		UNCDWF_WIREFRAMES_DIR . 'blogs/Blog-Magazine.php',
		UNCDWF_WIREFRAMES_DIR . 'blogs/Blog-Four-Fullwidth.php',
		UNCDWF_WIREFRAMES_DIR . 'shop/Shop-Classic.php',
	);

	return $top_wireframes;
}

/**
 * Gets an array that maps the font ID with the corresponding size
 */
function uncode_wf_get_font_size_map() {
	$font_sizes = array(
		'h1'              => 35,
		'h2'              => 29,
		'h3'              => 24,
		'h4'              => 20,
		'h5'              => 17,
		'h6'              => 14,
		'fontsize-160000' => 12,
		'fontsize-155944' => 50,
		'fontsize-338686' => 75,
		'fontsize-445851' => 100,
		'fontsize-739966' => 125,
		'fontsize-160206' => 150,
	);

	return $font_sizes;
}

/**
 * Gets an array that maps the original form ID with its type
 */
function uncode_wf_get_forms_map() {
	$forms = array(
		'83021' => 'agency',
		'83025' => 'basic',
		'83034' => 'classic',
		'83032' => 'contact-simple',
		'83045' => 'corporate',
		'83060' => 'newsletter-agency',
		'83028' => 'simple',
		'83036' => 'newsletter',
	);

	return $forms;
}

/**
 * Gets generic wireframe placeholders IDs
 */
function uncode_wf_get_generic_placeholder_media_ids() {
	$ids          = array();
	$placeholders = UNCDWF_Dynamic::get_generic_placeholder_ids();

	foreach ( $placeholders as $placeholder ) {
		$ids[] = $placeholder[ 'id' ];
	}

	return $ids;
}

/**
 * Gets team wireframe placeholder ID
 */
function uncode_wf_get_team_placeholder_media_id() {
	$placeholder = UNCDWF_Dynamic::get_team_placeholder_id();

	return $placeholder[ 'id' ];
}

/**
 * Gets quote wireframe placeholder ID
 */
function uncode_wf_get_quote_placeholder_media_id() {
	$placeholder = UNCDWF_Dynamic::get_quote_placeholder_id();

	return $placeholder[ 'id' ];
}

/**
 * Gets logo wireframe placeholder ID
 */
function uncode_wf_get_logo_placeholder_media_id() {
	$placeholder = UNCDWF_Dynamic::get_logo_placeholder_id();

	return $placeholder[ 'id' ];
}

/**
 * Gets demo forms IDs
 */
function uncode_wf_get_demo_forms_ids() {
	$forms = UNCDWF_Dynamic::get_form_ids();

	return $forms;
}

/**
 * Check if a dependency is installed
 */
function uncode_wf_check_for_dependency( $dependency ) {
	$is_installed = false;

	switch ( $dependency ) {
		case 'woocommerce':
			if ( class_exists( 'WooCommerce' ) ) {
				$is_installed = true;
			}
			break;

		case 'cf7':
			if ( class_exists( 'WPCF7' ) ) {
				$is_installed = true;
			}
			break;
	}

	return $is_installed;
}

/**
 * Get random element from array
 */
function uncode_wf_get_random_from_array( $array ) {
	$element = is_array( $array ) && $array ? $array[ mt_rand( 0, count( $array ) - 1 ) ] : false;

	return $element;
}
