<?php
/**
 * Uncode AJAX Filter config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$filter_type_options = array(
	esc_html__('Taxonomy', 'uncode-core') => '',
	esc_html__('Search', 'uncode-core')   => 'search',
	esc_html__('Date', 'uncode-core')     => 'date',
	esc_html__('Author', 'uncode-core')   => 'author',
);

if ( class_exists( 'WooCommerce' ) ) {
	$filter_type_options[esc_html__('Product Price', 'uncode-core')] = 'product_price';
	$filter_type_options[esc_html__('Product Status', 'uncode-core')] = 'product_status';
	$filter_type_options[esc_html__('Product Ratings', 'uncode-core')] = 'product_ratings';
	$filter_type_options[esc_html__('Product Sorting', 'uncode-core')] = 'product_sorting';
}

$first_params = array(
	array(
		"type" => 'textfield',
		"heading" => esc_html__("Title", 'uncode-core') ,
		"param_name" => "title",
		"description" => esc_html__("The module title. Leave blank to hide the title.", 'uncode-core') ,
		'admin_label' => true,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Query", 'uncode-core') ,
		"param_name" => "filter_type",
		"description" => esc_html__("Specify the query.", 'uncode-core') ,
		'admin_label' => true,
		"value" => $filter_type_options,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Source", 'uncode-core') ,
		"param_name" => "tax_source",
		"description" => esc_html__("Specify the taxonomy.", 'uncode-core') ,
		'admin_label' => true,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Product Attribute', 'uncode-core') => 'product_att',
		),
		'dependency' => array(
			'element' => 'filter_type',
			'is_empty' => true,
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Taxonomy", 'uncode-core') ,
		"param_name" => "taxonomy",
		"description" => esc_html__("Select the taxonomy.", 'uncode-core') ,
		"std" => '' ,
		'admin_label' => true,
		"value" => $all_taxonomies,
		'dependency' => array(
			'element' => 'tax_source',
			'is_empty' => true,
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Attribute", 'uncode-core') ,
		"param_name" => "product_att",
		"description" => esc_html__("Select the product attribute.", 'uncode-core') ,
		"std" => '' ,
		"value" => $all_product_atts,
		'admin_label' => true,
		'dependency' => array(
			'element' => 'tax_source',
			'value' => 'product_att',
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Type", 'uncode-core') ,
		"param_name" => "type",
		"description" => esc_html__("Specify the type of filter.", 'uncode-core') ,
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Text', 'uncode-core') => 'list',
			esc_html__('Checkbox', 'uncode-core') => 'checkbox',
			esc_html__('Select', 'uncode-core') => 'select',
			esc_html__('Label', 'uncode-core') => 'label',
			esc_html__('Logo (for image swatches only)', 'uncode-core') => 'logo',
		),
		'dependency' => array(
			'element' => 'filter_type',
			'value' => array(
				'',
				'author',
				'date',
				'product_price',
				'product_status',
				'product_ratings',
				'product_sorting',
			),
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Hierarchy", 'uncode-core') ,
		"param_name" => "hierarchy",
		"description" => esc_html__("Choose how to show terms hierarchy (if term supports it). NB. If it is on \"Yes\" the hierarchy is only displayed if the Filter Type supports it and when Display Type is on \"List\".", 'uncode-core') ,
		"value" => array(
			esc_html__('No, show all terms in same level', 'uncode-core') => '',
			esc_html__('No, show only parent terms', 'uncode-core') => 'parent_only',
			esc_html__('Yes', 'uncode-core') => 'yes',
		),
		'dependency' => array(
			'element' => 'tax_source',
			'is_empty' => true,
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Display", 'uncode-core') ,
		"param_name" => "display",
		"description" => esc_html__("Choose how to display the terms.", 'uncode-core') ,
		"value" => array(
			esc_html__('List', 'uncode-core') => '',
			esc_html__('Inline', 'uncode-core') => 'inline',
			esc_html__('Columns', 'uncode-core') => 'columns',
		),
		'dependency' => array(
			'element' => 'filter_type',
			'value' => array(
				'',
				'author',
				'date',
				'product_price',
				'product_status',
				'product_ratings',
				'product_sorting',
			),
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Columns", 'uncode-core') ,
		"param_name" => "columns_num",
		"min" => 2,
		"max" => 6,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Number of columns", 'uncode-core') ,
		'dependency' => array(
			'element' => 'display',
			'value' => array( 'columns' ),
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Label", 'uncode-core') ,
		"param_name" => "labels",
		"description" => esc_html__("Enable to show labels below the color and image swatches.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'tax_source',
			'value' => 'product_att',
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Count", 'uncode-core') ,
		"param_name" => "show_count",
		"description" => esc_html__("Enable to show how many items have this term.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'filter_type',
			'value' => array(
				'',
				'author',
				'date',
				'product_price',
				'product_status',
				'product_ratings',
			),
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Multiple selection", 'uncode-core') ,
		"param_name" => "multiple",
		"description" => esc_html__("Enable if the user can select multiple terms when filtering.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'filter_type',
			'value' => array(
				'',
				'product_status',
				'product_ratings',
			),
		)
	) ,
);

if ( ! apply_filters( 'uncode_filter_multiple_relation_disable_and_query_type', true ) ) {
	$first_params[] = array(
		"type" => 'dropdown',
		"heading" => esc_html__("Multiselect relation", 'uncode-core') ,
		"param_name" => "relation",
		"description" => esc_html__("Choose how multiple terms selection should behave. NB. Some filter types do not support 'AND' type relationships.", 'uncode-core') ,
		"value" => array(
			esc_html__('OR - Results need to match at least one of the selected terms', 'uncode-core') => '',
			esc_html__('AND - Results need to match all selected terms at the same time', 'uncode-core') => 'and',
		),
		'dependency' => array(
			'element' => 'multiple',
			'not_empty' => true,
		)
	) ;
}

$second_params = array(
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Date", 'uncode-core') ,
		"param_name" => "date_type",
		"description" => esc_html__("Choose how to display the date.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Year', 'uncode-core')    => 'year',
		),
		'dependency' => array(
			'element' => 'filter_type',
			'value' => array(
				'date',
			),
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Sort", 'uncode-core') ,
		"param_name" => "date_sort",
		"description" => esc_html__("Choose how to sort the date.", 'uncode-core') ,
		"value" => array(
			esc_html__('Descending', 'uncode-core') => '',
			esc_html__('Ascending', 'uncode-core')  => 'asc',
		),
		'dependency' => array(
			'element' => 'filter_type',
			'value' => array(
				'date',
			),
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Order by", 'uncode-core') ,
		"param_name" => "order_by",
		"description" => esc_html__("Select how to sort retrieved terms. NB. \"Custom Order\" works only with product taxonomies.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Custom order', 'uncode-core')  => 'custom',
			esc_html__('Count', 'uncode-core')  => 'count',
		),
		'dependency' => array(
			'element' => 'filter_type',
			'is_empty' => true,
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Sort order", 'uncode-core') ,
		"param_name" => "sort_by",
		"description" => esc_html__("Designates the ascending or descending order.", 'uncode-core') ,
		"value" => array(
			esc_html__('Ascending', 'uncode-core')  => '',
			esc_html__('Descending', 'uncode-core') => 'desc',
		),
		'dependency' => array(
			'element' => 'filter_type',
			'value' => array(
				'',
				'author',
			),
		)
	) ,
	array(
		"type" => 'textfield',
		"heading" => esc_html__("First Term", 'uncode-core') ,
		"param_name" => "select_first_option",
		"description" => esc_html__("Add an entry to the select as the first option (optional).", 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'select',
		)
	) ,
	array(
		"type" => 'textarea_safe',
		"heading" => esc_html__("Price Ranges", 'uncode-core') ,
		"param_name" => "price_ranges",
		"description" => esc_html__("Each range on a line separate by the \">\" symbol. Use \"-\" with one value to limit the lower price. Use \"+\" with one value to limit the upper price. Do not include the currency symbol.", 'uncode-core') ,
		"value" =>
'25-
25>100
100>500
500>1000
1000+',
		'dependency' => array(
			'element' => 'filter_type',
			'value' => 'product_price',
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Disable AJAX", 'uncode-core') ,
		"param_name" => "disable_ajax",
		"description" => esc_html__("Disable AJAX for this module, pointing the links to the url of the taxonomy's archive.", 'uncode-core') ,
		"value" => array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'filter_type',
			'value' => array(
				'',
				'author',
				'date',
			),
		)
	) ,
	$add_widget_style,
	$add_widget_collapse_desktop,
	$add_widget_collapse_tablet,
	$add_widget_collapse,
	$add_widget_icon,
	$add_widget_style_no_separator,
	$add_widget_style_title_typo,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Desktop", 'uncode-core') ,
		"param_name" => "desktop_visibility",
		"description" => esc_html__("Choose the visibiliy of the element in desktop layout mode (960px >).", 'uncode-core') ,
		'group' => esc_html__('Responsive', 'uncode-core') ,
		"value" => Array(
			'' => 'yes'
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Tablet", 'uncode-core') ,
		"param_name" => "medium_visibility",
		"description" => esc_html__("Choose the visibiliy of the element in tablet layout mode (570px > < 960px).", 'uncode-core') ,
		'group' => esc_html__('Responsive', 'uncode-core') ,
		"value" => Array(
			'' => 'yes'
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Mobile", 'uncode-core') ,
		"param_name" => "mobile_visibility",
		"description" => esc_html__("Choose the visibiliy of the element in mobile layout mode (< 570px).", 'uncode-core') ,
		'group' => esc_html__('Responsive', 'uncode-core') ,
		"value" => Array(
			'' => 'yes'
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Element ID', 'uncode-core') ,
		'param_name' => 'el_id',
		'description' => esc_html__('This value has to be unique. Change it in case it\'s needed.', 'uncode-core') ,
		"group" => esc_html__("Extra", 'uncode-core')
	) ,
	array(
		"type" => "textfield",
		"heading" => esc_html__("Extra class", 'uncode-core') ,
		"param_name" => "el_class",
		"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.", 'uncode-core') ,
		'group' => esc_html__('Extra', 'uncode-core')
	) ,
);

$uncode_ajax_filter_params = array_merge( $first_params, $second_params );

vc_map(
	array(
		'name' => esc_html__('Ajax Filter', 'uncode-core') ,
		'base' => 'uncode_ajax_filter',
		'icon' => 'fa fa-filter',
		'weight' => 10,
		// 'category' => array(
		// 	esc_html__('WooCommerce', 'uncode-core') ,
		// ),
		'description' => esc_html__('WooCommerce Ajax Filter', 'uncode-core') ,
		'params' => $uncode_ajax_filter_params,
	)
);
