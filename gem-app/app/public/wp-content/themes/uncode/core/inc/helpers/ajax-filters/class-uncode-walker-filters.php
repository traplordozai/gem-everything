<?php
/**
 * Taxonomy API: Walker_Category class
 *
 * @package WordPress
 * @subpackage Template
 * @since 4.4.0
 */

/**
 * Core class used to create an HTML list of categories.
 *
 * @since 2.1.0
 *
 * @see Walker
 */
class Uncode_Walker_Filters extends Walker_Category {

	public $query_args = array();
	public $filter_args = array();
	public $has_checked = false;
	public $is_checkbox = false;

	function __construct( $query_args, $filter_args, $is_checkbox ) {
		$this->query_args  = $query_args;
		$this->filter_args = $filter_args;
		$this->is_checkbox = $is_checkbox;
	}

	/**
	 * What the class handles.
	 *
	 * @since 2.1.0
	 * @var string
	 *
	 * @see Walker::$tree_type
	 */
	public $tree_type = 'category';

	/**
	 * Database fields to use.
	 *
	 * @since 2.1.0
	 * @var string[]
	 *
	 * @see Walker::$db_fields
	 * @todo Decouple this
	 */
	public $db_fields = array(
		'parent' => 'parent',
		'id'     => 'term_id',
	);

	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 2.1.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Used to append additional content. Passed by reference.
	 * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
	 * @param array  $args   Optional. An array of arguments. Will only append content if style argument
	 *                       value is 'list'. See wp_list_categories(). Default empty array.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' !== $args['style'] ) {
			return;
		}

		$indent  = str_repeat( "\t", $depth );
		$output .= "$indent<ul class='children'>\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @since 2.1.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Used to append additional content. Passed by reference.
	 * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
	 * @param array  $args   Optional. An array of arguments. Will only append content if style argument
	 *                       value is 'list'. See wp_list_categories(). Default empty array.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' !== $args['style'] ) {
			return;
		}

		$indent  = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

	/**
	 * Starts the element output.
	 *
	 * @since 2.1.0
	 * @since 5.9.0 Renamed `$category` to `$data_object` and `$id` to `$current_object_id`
	 *              to match parent class for PHP 8 named parameter support.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string  $output            Used to append additional content (passed by reference).
	 * @param WP_Term $data_object       Category data object.
	 * @param int     $depth             Optional. Depth of category in reference to parents. Default 0.
	 * @param array   $args              Optional. An array of arguments. See wp_list_categories().
	 *                                   Default empty array.
	 * @param int     $current_object_id Optional. ID of the current category. Default 0.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = array(), $current_object_id = 0 ) {
		// Restores the more descriptive, specific name for use within this method.
		$category = $data_object;

		/** This filter is documented in wp-includes/category-template.php */
		$cat_name = apply_filters( 'list_cats', esc_attr( $category->name ), $category );

		// Don't generate an element if the category name is empty.
		if ( '' === $cat_name ) {
			return;
		}

		$atts         = array();
		$atts['href'] = get_term_link( $category );

		if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
			/**
			 * Filters the category description for display.
			 *
			 * @since 1.2.0
			 *
			 * @param string  $description Category description.
			 * @param WP_Term $category    Category object.
			 */
			$atts['title'] = strip_tags( apply_filters( 'category_description', $category->description, $category ) );
		}

		/**
		 * Filters the HTML attributes applied to a category list item's anchor element.
		 *
		 * @since 5.2.0
		 *
		 * @param array   $atts {
		 *     The HTML attributes applied to the list item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $href  The href attribute.
		 *     @type string $title The title attribute.
		 * }
		 * @param WP_Term $category          Term data object.
		 * @param int     $depth             Depth of category, used for padding.
		 * @param array   $args              An array of arguments.
		 * @param int     $current_object_id ID of the current category.
		 */
		$atts = apply_filters( 'category_list_link_attributes', $atts, $category, $depth, $args, $current_object_id );

		$filter_id           = 'filter_' . rand() . '_' . $category->term_id;
		$current_filter_atts = uncode_get_filter_link_attributes( $category, $category->taxonomy, $this->query_args, $this->filter_args );

		list( $filter_url, $filter_atts ) = $current_filter_atts;

		$multiple   = isset( $this->filter_args['multiple'] ) ? $this->filter_args['multiple'] : false;
		$checked = $filter_atts['checked'];

		if ( ! $multiple ) {
			if ( $this->has_checked ) {
				$checked = false;
			}

			if ( $checked ) {
				$this->has_checked = true;
			}
		}

		$atts['href'] = $filter_url;
		$atts['class'] = 'term-filter-link';

		if ( ! $this->is_checkbox && $checked ) {
			$atts['class'] .= ' term-filter-link--active';
		}

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		if ( $checked ) {
			$checked = 'checked="checked"';
		}

		if ( apply_filters( 'uncode_show_term_description', false, $category ) && $category->description ) {
			$cat_name .= '<span class="term-filter-description">' . $category->description . '</span>';
		}

		if ( $this->is_checkbox ) {
			$link = '<label for="' . esc_attr( $filter_id ) . '">';
			$link .= '<input type="checkbox" name="' . esc_attr( $filter_id ) . '" id="' . esc_attr( $filter_id ) . '" value="' . esc_attr( $category->slug ) . '" ' . esc_attr( $checked ) . '>';
			$link .= '<a' . $attributes . '>';
			$link .= $cat_name;
			$link .= '</a>';
			$link .= '</label>';
		} else {
			$link = '<a' . $attributes . '>';
			$link .= $cat_name;
			$link .= '</a>';
		}

		if ( ! empty( $args['show_count'] ) ) {
			if ( isset( $this->filter_args['filter_terms'] ) && isset( $this->filter_args['filter_terms'][$category->term_id] ) && isset( $this->filter_args['filter_terms'][$category->term_id]['count'] ) ) {
				$link .= ' <span class="filter-count term-filter-count">(' . number_format_i18n( $this->filter_args['filter_terms'][$category->term_id]['count'] ) . ')</span>';
			}
		}
		if ( 'list' === $args['style'] ) {
			$output     .= "\t<li";
			$css_classes = array(
				'term-filter',
			);

			/**
			 * Filters the list of CSS classes to include with each category in the list.
			 *
			 * @since 4.2.0
			 *
			 * @see wp_list_categories()
			 *
			 * @param string[] $css_classes An array of CSS classes to be applied to each list item.
			 * @param WP_Term  $category    Category data object.
			 * @param int      $depth       Depth of page, used for padding.
			 * @param array    $args        An array of wp_list_categories() arguments.
			 */
			$css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
			$css_classes = $css_classes ? ' class="' . esc_attr( $css_classes ) . '"' : '';

			$output .= $css_classes;
			$output .= ">$link\n";
		} elseif ( isset( $args['separator'] ) ) {
			$output .= "\t$link" . $args['separator'] . "\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 2.1.0
	 * @since 5.9.0 Renamed `$page` to `$data_object` to match parent class for PHP 8 named parameter support.
	 *
	 * @see Walker::end_el()
	 *
	 * @param string $output      Used to append additional content (passed by reference).
	 * @param object $data_object Category data object. Not used.
	 * @param int    $depth       Optional. Depth of category. Not used.
	 * @param array  $args        Optional. An array of arguments. Only uses 'list' for whether should
	 *                            append to output. See wp_list_categories(). Default empty array.
	 */
	public function end_el( &$output, $data_object, $depth = 0, $args = array() ) {
		if ( 'list' !== $args['style'] ) {
			return;
		}

		$output .= "</li>\n";
	}
}
