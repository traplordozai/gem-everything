<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$output = '';

extract(shortcode_atts(array(
	'title' => '',
	'filter_type' => '',
	'tax_source' => '',
	'taxonomy' => '',
	'product_att' => '',
	'type' => '',
	'hierarchy' => '',
	'multiple' => '',
	'relation' => '',
	'labels' => '',
	'display' => '',
	'columns_num' => '3',
	'show_count' => '',
	'disable_ajax' => '',
	'date_type' => '',
	'date_sort' => '',
	'author_order_by' => '',
	'order_by' => '',
	'sort_by' => '',
	'select_first_option' => '',
	'price_ranges' =>
'25-
25>100
100>500
500>1000
1000+',
	'el_id' => '',
	'el_class' => '',
	'use_widget_style' => '',
	'widget_desktop_collapse' => '',
	'widget_collapse' => '',
	'widget_collapse_tablet' => '',
	'widget_collapse_icon' => '',
	'widget_style_no_separator' => '',
	'widget_style_title_typography' => '',
	'desktop_visibility' => '',
	'medium_visibility' => '',
	'mobile_visibility' => '',
), $atts));

if ( defined( 'TOPATH' ) ) {
	add_filter( 'to/get_terms_orderby/ignore', '__return_true' );
}

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$el_class = $this->getExtraClass( $el_class );

if ($desktop_visibility === 'yes') {
	$el_class .= ' desktop-hidden';
}
if ($medium_visibility === 'yes') {
	$el_class .= ' tablet-hidden';
}
if ($mobile_visibility === 'yes') {
	$el_class .= ' mobile-hidden';
}

if ( $use_widget_style === 'yes' && $widget_style_no_separator === 'yes' ) {
	$el_class .= ' widget-no-separator';
}

$widget_open = $widget_is_collapse = '';
$_args = array();
if ( $use_widget_style === 'yes' ) {
	$widget_class = '';
	if ( $widget_desktop_collapse === 'yes' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-desktop-collapse';
	} elseif ( $widget_desktop_collapse === 'click' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-desktop-collapse widget-desktop-collapse-open';
		$widget_open = ' open';
	}

	if ( $widget_collapse === 'yes' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-mobile-collapse';
	} elseif ( $widget_collapse === 'click' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-mobile-collapse widget-mobile-collapse-open';
	}

	if ( $widget_collapse_tablet === 'yes' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-tablet-collapse';
	} elseif ( $widget_collapse_tablet === 'click' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-tablet-collapse widget-tablet-collapse-open';
	} else {
		$widget_class .= ' widget-no-tablet-collapse';
	}

	$widget_class .= ' widget-collaps-icon' . $widget_collapse_icon;

	$el_class .= $widget_is_collapse . $widget_class;
	if ( $widget_is_collapse !== '' ) {
		$tag = apply_filters( 'uncode_widget_title_tag', 'h3' );
		$_args['after_widget'] = '</div></aside>';
		$_args['after_title'] = '</' . $tag . '><div class="widget-collapse-content">';
	}
}

if ( $use_widget_style === 'yes' && $widget_style_title_typography ) {
	$el_class .= ' widget-typography-' . $widget_style_title_typography;
}

$can_show = true;

// Params
$filter_type  = $filter_type ? $filter_type : 'taxonomy';
$multiple     = $multiple === 'yes' ? true : false;
$show_count   = $show_count === 'yes' ? true : false;
$labels       = $labels === 'yes' ? true : false;
$disable_ajax = $disable_ajax === 'yes' ? true : false;
$search_type  = '';
$date_type    = $date_type === 'year' ? 'year' : 'default';
$date_sort    = $date_sort === 'asc' ? 'asc' : 'desc';
$order_by     = $order_by === 'custom' || $order_by === 'count' ? $order_by : 'default';
$sort_by      = $sort_by === 'desc' ? 'desc' : 'asc';

// Get current parameters
$current_url = uncode_get_current_url();
$query_args  = array();

if ( isset( $_GET ) && is_array( $_GET ) ) {
	foreach ( $_GET as $filter_key => $filter_value ) {
		$is_valid_filter_key = uncode_is_valid_filter_key( $filter_key );

		if ( $is_valid_filter_key ) {
			$filter_value = str_replace( '%2C', ',', sanitize_text_field( $filter_value ) );

			if ( $filter_value ) {
				$filter_values = explode( ',', $filter_value);

				if ( $filter_key === 'min_price' || $filter_key === 'max_price' ) {
					$filter_values = array_map( 'floatval', $filter_values );
				}

				$query_args[$filter_key] = $filter_values;
			}
		}
	}
}

$filter_terms = array();

if ( $filter_type === 'taxonomy' ) {
	$tax_source   = $tax_source ? 'product_att': 'tax';
	$tax_to_query = $tax_source === 'tax' ? $taxonomy : $product_att;
	$filter_terms = uncode_filters_populate_tax_terms( $tax_source, $tax_to_query, $query_args, $multiple, $hierarchy, $order_by, $sort_by );
	$key_to_query = $tax_to_query;
	$disable_ajax = is_tax( $tax_to_query ) || ( $key_to_query === 'category' && is_category() ) || ( $key_to_query === 'tag' && is_tag() ) ? true : $disable_ajax;

	if ( $disable_ajax ) {
		$el_class .= ' widget-ajax-filters--no-ajax';
	}
} else if ( $filter_type === 'product_status' && class_exists( 'WooCommerce' ) ) {
	$key_to_query = UNCODE_FILTER_KEY_STATUS;
	$filter_terms = uncode_filters_populate_product_status_terms( $query_args, $multiple );
} else if ( $filter_type === 'product_ratings' && class_exists( 'WooCommerce' ) ) {
	$key_to_query = UNCODE_FILTER_KEY_RATING;
	$filter_terms = uncode_filters_populate_product_ratings_terms( $query_args, $multiple );
} else if ( $filter_type === 'search' ) {
	$type         = 'search';
	$key_to_query = UNCODE_FILTER_KEY_SEARCH;
	$search_type  = uncode_filters_get_search_type();
} else if ( $filter_type === 'product_sorting' && class_exists( 'WooCommerce' ) ) {
	$key_to_query = UNCODE_FILTER_KEY_SORTING;
	$filter_terms = uncode_filters_populate_product_sorting_terms( $query_args );
} else if ( $filter_type === 'product_price' && class_exists( 'WooCommerce' ) ) {
	$key_to_query = 'custom_price';
	$filter_terms = uncode_filters_populate_product_price_terms( $price_ranges, $query_args );
} else if ( $filter_type === 'author' ) {
	$key_to_query = UNCODE_FILTER_KEY_AUTHOR;
	$filter_terms = uncode_filters_populate_author_terms( $query_args, $sort_by );

	$disable_ajax = is_author() ? true : $disable_ajax;

	if ( $disable_ajax ) {
		$el_class .= ' widget-ajax-filters--no-ajax';
	}
} else if ( $filter_type === 'date' ) {
	$key_to_query = UNCODE_FILTER_KEY_DATE;
	$filter_terms = uncode_filters_populate_date_terms( $query_args, $date_type, $date_sort );

	$disable_ajax = is_date() ? true : $disable_ajax;

	if ( $disable_ajax ) {
		$el_class .= ' widget-ajax-filters--no-ajax';
	}
}

$filter_group = 'list';
$logo_group   = false;

if ( $type === 'list' ) {
	$filter_group = 'list';
} else if ( $type === 'checkbox' ) {
	$filter_group = 'checkbox';
} else if ( $type === 'label' ) {
	$filter_group = 'label';
} else if ( $type === 'select' ) {
	$filter_group = 'select';
} else if ( $type === 'search' ) {
	$filter_group = 'search';
} else {
	if ( $tax_source === 'product_att' && function_exists('uncode_wc_get_taxonomy_props') ) {
		$tax_props   = uncode_wc_get_taxonomy_props( $tax_to_query );
		$swatch_type = isset( $tax_props->attribute_type ) && $tax_props->attribute_type && uncode_wc_swatches_global_active()? $tax_props->attribute_type : 'select';

		if ( $swatch_type === 'select' ) {
			$filter_group = 'select';
		} else if ( $swatch_type === 'label' ) {
			$filter_group = 'label';
		} else if ( $swatch_type === 'color' ) {
			$filter_group = 'color';
		} else if ( $swatch_type === 'image' ) {
			if ( $type === 'logo' ) {
				$logo_group = true;
			}
			$filter_group = 'image';
		}
	}
}

if ( $multiple ) {
	$el_class .= ' widget-ajax-filters--multiple';
} else {
	$el_class .= ' widget-ajax-filters--single';
}

$el_class .= ' widget-ajax-filters--' . $filter_group;

$widget_unique_id = uncode_get_widget_module_id();

if ( is_search() && $filter_group === 'search' ) {
	$can_show = false;
}
?>

<?php if ( $can_show && ( ( is_array( $filter_terms ) && count( $filter_terms ) > 0 ) || $filter_group === 'search' ) ) : ?>
	<div class="uncode_widget widget-ajax-filters wpb_content_element<?php echo esc_attr( $el_class ); ?>" <?php echo uncode_switch_stock_string( $el_id ); ?> data-id="<?php echo esc_attr( $widget_unique_id ); ?>">
		<?php if ( $use_widget_style === 'yes' ) : ?>
			<aside class="widget widget-style widget-container sidebar-widgets">
		<?php endif; ?>

		<?php if ( $title ) : ?>
			<?php $title_tag = apply_filters( 'uncode_widget_title_tag', 'h3' ); ?>
			<?php if ( $use_widget_style === 'yes' ) : ?>
				<<?php echo esc_attr( $title_tag); ?> class="widget-title<?php echo uncode_switch_stock_string( $widget_open ); ?>"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_tag); ?>>
			<?php else : ?>
				<<?php echo esc_attr( $title_tag); ?> class="widgettitle"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_tag); ?>>
			<?php endif; ?>
			<?php if ( $widget_is_collapse !== '' ) : ?>
				<div class="widget-collapse-content">
			<?php endif; ?>
		<?php endif; ?>

		<?php
		$filter_args = array(
			'current_url'    => $current_url,
			'multiple'       => $multiple,
			'relation'       => apply_filters( 'uncode_filter_multiple_relation_disable_and_query_type', true ) ? '' : $relation,
			'show_count'     => $show_count,
			'is_product_att' => $tax_source === 'product_att' ? true : false,
			'hierarchy'      => $hierarchy,
			'display'        => $display,
			'columns_num'    => $display === 'columns' ? $columns_num : false,
			'labels'         => $labels,
			'disable_ajax'   => $disable_ajax,
			'is_logo'        => $logo_group,
			'search_type'    => $search_type,
			'order_by'       => $order_by,
			'sort_by'        => $sort_by,
		);
		?>

		<div class="term-filters">
			<?php
			switch ( $filter_group ) {
				case 'list':
					uncode_ajax_term_filter_list_html( $key_to_query, $filter_terms, $query_args, $filter_args );
					break;

				case 'checkbox':
					uncode_ajax_term_filter_list_html( $key_to_query, $filter_terms, $query_args, $filter_args, true );
					break;

				case 'label':
					uncode_ajax_term_filter_label_html( $key_to_query, $filter_terms, $query_args, $filter_args );
					break;

				case 'select':
					$filter_args['first_option'] = $select_first_option;
					uncode_ajax_term_filter_select_html( $key_to_query, $filter_terms, $query_args, $filter_args );
					break;

				case 'color':
					uncode_ajax_term_filter_color_html( $key_to_query, $filter_terms, $query_args, $filter_args );
					break;

				case 'image':
					uncode_ajax_term_filter_image_html( $key_to_query, $filter_terms, $query_args, $filter_args );
					break;

				case 'search':
					uncode_ajax_term_filter_search_html( $key_to_query, $filter_terms, $query_args, $filter_args );
					break;
			}
			?>
		</div>

		<?php if ( $use_widget_style === 'yes' ) : ?>
			<?php if ( $title && $widget_is_collapse !== '' ) : ?>
				</div>
			<?php endif; ?>
			</aside>
		<?php endif; ?>
	</div>
<?php endif;

if ( defined( 'TOPATH' ) ) {
	add_filter( 'to/get_terms_orderby/ignore', '__return_false' );
}
