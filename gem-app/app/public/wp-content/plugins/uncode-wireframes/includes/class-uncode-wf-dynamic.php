<?php
/**
 * Holds dynamic values
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'UNCDWF_Dynamic' ) ) :

/**
 * UNCDWF_Dynamic Class
 */
class UNCDWF_Dynamic {
	/**
	 * Flag for init.
	 */
	private static $init = false;

	/**
	 * Uncode option.
	 */
	private $uncode_option = array();

	/**
	 * User's options.
	 */
	private static $bg_color_light;
	private static $color_light_grey;
	private static $bg_color_dark;
	private static $font_sizes = array();
	private static $font_spacings = array();
	private static $font_heights;

	/**
	 * Holds an array that contains the desired font size
	 * and the best available size. Every time a wireframe
	 * is processed we store the found desired/best sizes
	 * in this array to improve the performance. Instead of
	 * calculating again the same font size.
	 */
	private static $font_sizes_map = array();

	/**
	 * Holds an array that contains the IDs of our
	 * media placeholders.
	 */
	private static $placeholder_ids = array();

	/**
	 * Holds an array that contains the IDs of
	 * generic placeholders.
	 */
	private static $placeholder_generic_ids = array();

	/**
	 * Team placeholder ID.
	 */
	private static $placeholder_team_id = false;

	/**
	 * Quote placeholder ID.
	 */
	private static $placeholder_quote_id = false;

	/**
	 * Logo placeholder ID.
	 */
	private static $placeholder_logo_id = false;

	/**
	 * Holds wireframe categories for later use
	 */
	private static $wireframe_categories = array();

	/**
	 * Holds an array that contains the ID of a
	 * needed dependency and a bool (in case is
	 * installed or not)
	 */
	private static $deps = array();

	/**
	 * Holds an array that contains the IDs
	 * of our forms.
	 */
	private static $form_ids = array();

	/**
	 * Constructor.
	 */
	public function __construct() {
		self::$init = true;
		$this->populate_uncode_option();
		$this->populate_user_preferences();
		$this->populate_wireframe_categories();
	}

	/**
	 * Test is class has been instantiated
	 */
	public static function is_init() {
		return self::$init;
	}

	/**
	 * Get uncode_option from DB and store its value.
	 */
	public function populate_uncode_option() {
		$uncode_id = apply_filters( 'ot_options_id', 'uncode' );

		if ( is_multisite() ) {
			$uncode_option = get_blog_option( get_current_blog_id(), $uncode_id );
		} else {
			$uncode_option = get_option( $uncode_id );
		}

		$this->uncode_option = $uncode_option;
	}

	/**
	 * Populate user's preferences
	 */
	public function populate_user_preferences() {
		self::$bg_color_light   = $this->get_user_light_background_color();
		self::$color_light_grey = $this->get_user_light_grey_color();
		self::$bg_color_dark    = $this->get_user_dark_background_color();
		self::$font_sizes       = $this->get_user_font_sizes();
		self::$font_spacings    = $this->get_user_font_spacings();
		self::$font_heights     = $this->get_user_font_heights();
		self::$placeholder_ids  = $this->populate_placeholder_ids();
		self::$form_ids         = $this->populate_form_ids();
	}

	/**
	 * Get light bg color
	 */
	private function get_user_light_background_color() {
		$bg_color_light = isset( $this->uncode_option[ '_uncode_background_color_light' ] ) ? $this->uncode_option[ '_uncode_background_color_light' ] : 'color-xsdn';

		return $bg_color_light;
	}

	/**
	 * Get light bg color from outside
	 */
	public static function light_background_color() {
		return self::$bg_color_light;
	}

	/**
	 * Get light grey color
	 */
	private function get_user_light_grey_color() {
		$color_light_grey = isset( $this->uncode_option[ '_uncode_menu_border_color_light' ] ) ? $this->uncode_option[ '_uncode_menu_border_color_light' ] : self::light_background_color();

		return $color_light_grey;
	}

	/**
	 * Get light grey color from outside
	 */
	public static function light_grey_color() {
		return self::$color_light_grey;
	}

	/**
	 * Get dark bg color
	 */
	private function get_user_dark_background_color() {
		$bg_color_dark = isset( $this->uncode_option[ '_uncode_background_color_dark' ] ) ? $this->uncode_option[ '_uncode_background_color_dark' ] : 'color-wayh';

		return $bg_color_dark;
	}

	/**
	 * Get dark bg color from outside
	 */
	public static function dark_background_color() {
		return self::$bg_color_dark;
	}

	/**
	 * Get font sizes
	 */
	private function get_user_font_sizes() {
		$font_sizes    = array();

		// h1 to h6
		for ( $i = 1; $i < 7; $i++ ) {
			$_value = absint( $this->uncode_option[ '_uncode_heading_h' . $i ] );

			if ( $_value ) {
				$font_sizes[ 'h' . $i ] = $_value;
			}
		}

		// custom font sizes (if any)
		$custom_font_sizes = isset( $this->uncode_option[ '_uncode_heading_font_sizes' ] ) ? $this->uncode_option[ '_uncode_heading_font_sizes' ] : false;

		if ( is_array( $custom_font_sizes ) ) {
			foreach ( $custom_font_sizes as $custom_font_size ) {
				$_value = absint( $custom_font_size[ '_uncode_heading_font_size' ] );

				if ( $_value ) {
					$font_sizes[ $custom_font_size[ '_uncode_heading_font_size_unique_id' ] ] = $_value;
				}
			}
		}

		return $font_sizes;
	}

	/**
	 * Get font sizes from outside
	 */
	public static function font_sizes() {
		return self::$font_sizes;
	}

	/**
	 * Get $font_sizes_map "cache" variable
	 */
	public static function get_font_sizes_map() {
		return self::$font_sizes_map;
	}

	/**
	 * Get font size value from $font_sizes_map
	 */
	public static function get_font_size_value( $key ) {
		$value = isset( self::$font_sizes_map[ $key ] ) ? self::$font_sizes_map[ $key ] : '';

		return $value;
	}

	/**
	 * Update our $font_sizes_map "cache" variable
	 */
	public static function add_font_size_map( $desired_size, $available_size ) {
		self::$font_sizes_map[ $desired_size ] = $available_size;
	}

	/**
	 * Get font spacings
	 */
	private function get_user_font_spacings() {
		$font_spacings = array();

		// custom font spacing (if any)
		$user_font_spacings = isset( $this->uncode_option[ '_uncode_heading_font_spacings' ] ) ? $this->uncode_option[ '_uncode_heading_font_spacings' ] : false;

		if ( is_array( $user_font_spacings ) ) {
			foreach ( $user_font_spacings as $custom_font_space ) {
				$font_spacings[] = $custom_font_space[ '_uncode_heading_font_spacing_unique_id' ];
			}
		}

		return $font_spacings;
	}

	/**
	 * Get font spacings from outside
	 */
	public static function font_spacings() {
		return self::$font_spacings;
	}

	/**
	 * Get font heights
	 */
	private function get_user_font_heights() {
		$font_heights = array();

		// custom font spacing (if any)
		$user_font_heights = isset( $this->uncode_option[ '_uncode_heading_font_heights' ] ) ? $this->uncode_option[ '_uncode_heading_font_heights' ] : false;

		if ( is_array( $user_font_heights ) ) {
			foreach ( $user_font_heights as $custom_font_height ) {
				$font_heights[] = $custom_font_height[ '_uncode_heading_font_height_unique_id' ];
			}
		}

		return $font_heights;
	}

	/**
	 * Get font heights from outside
	 */
	public static function font_heights() {
		return self::$font_heights;
	}

	/**
	 * Populate placeholder IDs
	 */
	private function populate_placeholder_ids() {
		$placeholders = get_option( 'uncode_wireframes_placeholders', array() );

		return $placeholders;
	}

	/**
	 * Get placeholder IDs from outside
	 */
	public static function get_placeholder_ids() {
		return self::$placeholder_ids;
	}

	/**
	 * Get generic placeholder IDs from outside
	 */
	public static function get_generic_placeholder_ids() {
		if ( empty( self::$placeholder_generic_ids ) ) {
			$all_placeholders = self::$placeholder_ids;

			foreach ( $all_placeholders as $placeholder ) {
				if ( $placeholder[ 'type' ] === 'generic' ) {
					self::$placeholder_generic_ids[] = $placeholder;
				}
			}
		}

		return self::$placeholder_generic_ids;
	}

	/**
	 * Get team placeholder ID from outside
	 */
	public static function get_team_placeholder_id() {
		if ( ! self::$placeholder_team_id ) {
			$all_placeholders = self::$placeholder_ids;

			foreach ( $all_placeholders as $placeholder ) {
				if ( $placeholder[ 'type' ] === 'team' ) {
					self::$placeholder_team_id = $placeholder;
				}
			}
		}

		return self::$placeholder_team_id;
	}

	/**
	 * Get quote placeholder ID from outside
	 */
	public static function get_quote_placeholder_id() {
		if ( ! self::$placeholder_quote_id ) {
			$all_placeholders = self::$placeholder_ids;

			foreach ( $all_placeholders as $placeholder ) {
				if ( $placeholder[ 'type' ] === 'quote' ) {
					self::$placeholder_quote_id = $placeholder;
				}
			}
		}

		return self::$placeholder_quote_id;
	}

	/**
	 * Get logo placeholder ID from outside
	 */
	public static function get_logo_placeholder_id() {
		if ( ! self::$placeholder_logo_id ) {
			$all_placeholders = self::$placeholder_ids;

			foreach ( $all_placeholders as $placeholder ) {
				if ( $placeholder[ 'type' ] === 'logo' ) {
					self::$placeholder_logo_id = $placeholder;
				}
			}
		}

		return self::$placeholder_logo_id;
	}

	/**
	 * Get wireframe categories for later use
	 */
	public function populate_wireframe_categories() {
		$categories = uncode_wf_get_wireframe_categories();

		self::$wireframe_categories = $categories;
	}

	/**
	 * Get wireframe categories from outside
	 */
	public static function get_wireframe_categories() {
		if ( empty( self::$wireframe_categories ) ) {
			self::$wireframe_categories = uncode_wf_get_wireframe_categories();
		}

		return self::$wireframe_categories;
	}

	/**
	 * Check if a dependency is installed
	 */
	public static function has_dependency( $dependency ) {
		// check if we already have a test for this dep
		if ( array_key_exists( $dependency, self::$deps ) ) {
			return self::$deps[ $dependency ];
		}

		// first time we check this dep
		$has_dep = uncode_wf_check_for_dependency( $dependency );

		// save the result in our class
		self::$deps[ $dependency ] = $has_dep;

		return $has_dep;
	}

	/**
	 * Populate form IDs
	 */
	private function populate_form_ids() {
		$forms = get_option( 'uncode_wireframes_forms', array() );

		return $forms;
	}

	/**
	 * Get form IDs from outside
	 */
	public static function get_form_ids() {
		return self::$form_ids;
	}
}

endif;

// return new UNCDWF_Dynamic();
