<?php
/**
 * VC Uncode Index (Posts Module) config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$navigation_font_size = $heading_size;
unset( $navigation_font_size[ 'BigText' ] );

$uncode_index_params_second = array();

$add_text_size = uncode_core_vc_params_get_text_size( 'single_text_lead', false, esc_html__("Blocks", 'uncode-core'), array( 'element' => 'index_type', 'value' => array( 'isotope', 'carousel','css_grid', 'table', 'custom_grid', 'sticky-scroll', 'linear' ) ) );

$index_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'index_back_color', esc_html__("Background color", 'uncode-core'), esc_html__("Specify a background color for the module.", 'uncode-core'), esc_html__("Module", 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'index_type', 'value' => array( 'isotope', 'carousel', 'css_grid', 'linear' ) ) ) );
list( $add_index_back_color_type, $add_index_back_color, $add_index_back_color_solid, $add_index_back_color_gradient ) = $index_back_color_options;

$filter_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'filter_back_color', esc_html__("Filter color", 'uncode-core'), esc_html__("Specify a background color for the filter menu.", 'uncode-core'), esc_html__("Filters", 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'filtering', 'value' => 'yes' ), 'uncode_wrapper_class' => 'post-dependent-field' ) );
list( $add_filter_back_color_type, $add_filter_back_color, $add_filter_back_color_solid, $add_filter_back_color_gradient ) = $filter_back_color_options;

$infinite_button_color_options = uncode_core_vc_params_get_advanced_color_options( 'infinite_button_color', esc_html__("Load more button color", 'uncode-core'), esc_html__("Specify a background color for the load more button.", 'uncode-core'), esc_html__("Module", 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'infinite_button', 'value' => 'yes' ), 'uncode_wrapper_class' => 'pagination-field load-more-field', 'default_label' => true ) );
list( $add_infinite_button_color_type, $add_infinite_button_color, $add_infinite_button_color_solid, $add_infinite_button_color_gradient ) = $infinite_button_color_options;

$footer_back_color_options = uncode_core_vc_params_get_advanced_color_options( 'footer_back_color', esc_html__("Pagination-Load more color", 'uncode-core'), esc_html__("Specify a background color for the pagination/load more.", 'uncode-core'), esc_html__("Module", 'uncode-core'), $uncode_colors, array( 'dependency' => array( 'element' => 'index_type', 'value' => array( 'isotope','css_grid' ) ), 'uncode_wrapper_class' => 'pagination-field' ) );
list( $add_footer_back_color_type, $add_footer_back_color, $add_footer_back_color_solid, $add_footer_back_color_gradient ) = $footer_back_color_options;

$breakpoint_lg_options = uncode_core_vc_params_get_breakpoint_field_options( 'screen_lg', esc_html__("Breakpoint First", 'uncode-core'), esc_html__("Specify the number of columns for this breakpoint.", 'uncode-core'), esc_html__("Module", 'uncode-core'), array( 'screen' => 1000, 'cols' => 3 ), array( 'dependency' => array( 'element' => 'index_type', 'value' => 'css_grid' ) ) );
list( $add_breakpoint_lg_cols, $add_breakpoint_lg_screen ) = $breakpoint_lg_options;

$breakpoint_md_options = uncode_core_vc_params_get_breakpoint_field_options( 'screen_md', esc_html__("Breakpoint Second", 'uncode-core'), esc_html__("Specify the number of columns for this breakpoint.", 'uncode-core'), esc_html__("Module", 'uncode-core'), array( 'screen' => 600, 'cols' => 2 ), array( 'dependency' => array( 'element' => 'index_type', 'value' => 'css_grid' ) ) );
list( $add_breakpoint_md_cols, $add_breakpoint_md_screen ) = $breakpoint_md_options;

$breakpoint_sm_options = uncode_core_vc_params_get_breakpoint_field_options( 'screen_sm', esc_html__("Breakpoint Third", 'uncode-core'), esc_html__("Specify the number of columns for this breakpoint.", 'uncode-core'), esc_html__("Module", 'uncode-core'), array( 'screen' => 480, 'cols' => 1 ), array( 'dependency' => array( 'element' => 'index_type', 'value' => 'css_grid' ) ) );
list( $add_breakpoint_sm_cols, $add_breakpoint_sm_screen ) = $breakpoint_sm_options;

$add_parallax_options = uncode_core_vc_params_get_parallax_options( esc_html__("Blocks", 'uncode-core'), 'single_parallax_intensity', 'single_css_animation' );
$add_parallax_centered_options = uncode_core_vc_params_get_parallax_centered_options( esc_html__("Blocks", 'uncode-core'), 'single_parallax_centered', 'single_parallax_intensity' );

$simplify_single_tab = get_option( 'uncode_core_settings_opt_simplify_single_block_tab' ) === 'on' ? true : false;
$lbox_enhance = get_option( 'uncode_core_settings_opt_lightbox_enhance' ) === 'on';

$heading_size_custom = array (esc_html__('Custom', 'uncode-core') => 'custom');
$heading_size_h = array_merge($heading_size, $heading_size_custom);

foreach ($uncode_post_types as $key => $value) {
	if ($value === 'product') continue;
	$uncode_post_type_list = array(
		'type' => 'sorted_list',
		'heading' => ucfirst($value) . ' ' . esc_html__('elements', 'uncode-core') ,
		'param_name' => $value . '_items',
		'description' => esc_html__('Enable or disable elements and place them in desired order. NB. The Category (when it has a non-relative position) and Icon elements cannot be dragged.', 'uncode-core') ,
		'value' => 'media|featured|onpost|original,title',
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'custom_grid',
				'sticky-scroll',
				'linear',
			)
		),
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode-core') ,
				array(
					array(
						'featured',
						esc_html__('Featured Image', 'uncode-core')
					) ,
					array(
						'secondary',
						esc_html__('Secondary Featured Image', 'uncode-core')
					) ,
					array(
						'media',
						esc_html__('Featured Media', 'uncode-core')
					) ,
					array(
						'custom',
						esc_html__('Custom', 'uncode-core')
					)
				) ,
				array(
					array(
						'onpost',
						esc_html__('Link to post', 'uncode-core')
					) ,
					array(
						'lightbox',
						esc_html__('Lightbox', 'uncode-core')
					) ,
					array(
						'nolink',
						esc_html__('No link', 'uncode-core')
					)
				) ,
				array(
					array(
						'original',
						esc_html__('Original', 'uncode-core')
					) ,
					array(
						'poster',
						esc_html__('Poster', 'uncode-core')
					)
				)
			) ,
			array(
				'title',
				esc_html__('Title', 'uncode-core') ,
			) ,
			array(
				'type',
				esc_html__('Post Type', 'uncode-core') ,
			) ,
			array(
				'author',
				esc_html__('Author', 'uncode-core') ,
				array(
					array(
						'sm_size',
						esc_html__('Small size', 'uncode-core'),
					) ,
					array(
						'md_size',
						esc_html__('Medium size', 'uncode-core'),
					),
					array(
						'lg_size',
						esc_html__('Large size', 'uncode-core'),
					),
					array(
						'xl_size',
						esc_html__('Extra large size', 'uncode-core')
					)
				),
				array(
					array(
						'hide_qualification',
						esc_html__('Hide qualification', 'uncode-core'),
					) ,
					array(
						'display_qualification',
						esc_html__('Display qualification', 'uncode-core'),
					),
				),
			),
			array(
				'date',
				esc_html__('Date', 'uncode-core') ,
			) ,
			array(
				'category',
				esc_html__('Category', 'uncode-core') ,
				array(
					array(
						'nobg',
						esc_html__('Default', 'uncode-core'),
					) ,
					array(
						'yesbg',
						esc_html__('Colored text', 'uncode-core'),
					),
					array(
						'bordered',
						esc_html__('Bordered', 'uncode-core'),
					),
					array(
						'colorbg',
						esc_html__('Colored background', 'uncode-core')
					),
					array(
						'transparentbg',
						esc_html__('Transparent background', 'uncode-core')
					),
				),
				array(
					array(
						'relative',
						esc_html__('Relative position', 'uncode-core'),
					) ,
					array(
						'topleft',
						esc_html__('Over the image, on top left', 'uncode-core'),
					),
					array(
						'topright',
						esc_html__('Over the image, on top right', 'uncode-core'),
					),
					array(
						'bottomleft',
						esc_html__('Over the image, on bottom left', 'uncode-core'),
					),
					array(
						'bottomright',
						esc_html__('Over the image, on bottom right', 'uncode-core'),
					),
				),
				array(
					array(
						'display-icon',
						esc_html__('Display icon (when available)', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'extra',
				esc_html__('Extra', 'uncode-core') ,
			) ,
			array(
				'meta',
				esc_html__('Default Meta', 'uncode-core') ,
				array(
					array(
						'display-icon',
						esc_html__('Display icon', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'text',
				esc_html__('Text', 'uncode-core') ,
				array(
					array(
						'excerpt',
						esc_html__('Excerpt', 'uncode-core')
					) ,
					array(
						'full',
						esc_html__('Full content', 'uncode-core')
					) ,
				)
			) ,
			array(
				'link',
				esc_html__('Button', 'uncode-core'),
				array(
					array(
						'default',
						esc_html__('Inherit', 'uncode-core')
					) ,
					array(
						'default-shape',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'round',
						esc_html__('Round', 'uncode-core')
					) ,
					array(
						'circle',
						esc_html__('Circle', 'uncode-core')
					) ,
					array(
						'square',
						esc_html__('Square', 'uncode-core')
					) ,
					array(
						'link',
						esc_html__('Standard link', 'uncode-core')
					)
				),
				array(
					array(
						'default_size',
						esc_html__('Default size', 'uncode-core')
					) ,
					array(
						'small_size',
						esc_html__('Small size', 'uncode-core')
					) ,
					array(
						'large_size',
						esc_html__('Large size', 'uncode-core')
					) ,
				),
				array(
					array(
						'scale_mobile',
						esc_html__('Scale on mobile', 'uncode-core')
					) ,
					array(
						'not_scale_mobile',
						esc_html__('Not scale on mobile', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_width',
						esc_html__('Default width', 'uncode-core')
					) ,
					array(
						'fluid_width',
						esc_html__('Fluid width', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_outline',
						esc_html__('Default style', 'uncode-core')
					) ,
					array(
						'outline_inverse',
						esc_html__('Outline style', 'uncode-core')
					) ,
				),
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode-core') ,
				array(
					array(
						'sm',
						esc_html__('Small', 'uncode-core')
					) ,
					array(
						'md',
						esc_html__('Medium', 'uncode-core')
					) ,
					array(
						'lg',
						esc_html__('Large', 'uncode-core')
					),
					array(
						'xl',
						esc_html__('Extra Large', 'uncode-core')
					)
				) ,
			) ,
			array(
				'spacer',
				esc_html__('Spacer One', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'spacer_two',
				esc_html__('Spacer Two', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-one',
				esc_html__('Separator One', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-two',
				esc_html__('Separator Two', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
		)
	);

	$uncode_post_type_table_list = array(
		'type' => 'sorted_list',
		'heading' => ucfirst($value) . ' ' . esc_html__('elements', 'uncode-core') ,
		'param_name' => $value . '_table_items',
		'description' => esc_html__('Enable or disable elements and place them in desired order.', 'uncode-core') ,
		'value' => 'col-one|4,title,col-two|3,date,col-three|3,category|nobg|relative|display-icon,col-four|2,link|default|default_size',
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'table',
			)
		),
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode-core') ,
				array(
					array(
						'featured',
						esc_html__('Featured Image', 'uncode-core')
					) ,
					array(
						'secondary',
						esc_html__('Secondary Featured Image', 'uncode-core')
					) ,
					array(
						'media',
						esc_html__('Featured Media', 'uncode-core')
					) ,
					array(
						'custom',
						esc_html__('Custom', 'uncode-core')
					)
				) ,
				array(
					array(
						'onpost',
						esc_html__('Link to post', 'uncode-core')
					) ,
					array(
						'lightbox',
						esc_html__('Lightbox', 'uncode-core')
					) ,
					array(
						'nolink',
						esc_html__('No link', 'uncode-core')
					)
				) ,
				array(
					array(
						'original',
						esc_html__('Original', 'uncode-core')
					) ,
					array(
						'poster',
						esc_html__('Poster', 'uncode-core')
					)
				)
			) ,
			array(
				'title',
				esc_html__('Title', 'uncode-core') ,
			) ,
			array(
				'type',
				esc_html__('Post Type', 'uncode-core') ,
			) ,
			array(
				'author',
				esc_html__('Author', 'uncode-core') ,
				array(
					array(
						'sm_size',
						esc_html__('Small size', 'uncode-core'),
					) ,
					array(
						'md_size',
						esc_html__('Medium size', 'uncode-core'),
					),
					array(
						'lg_size',
						esc_html__('Large size', 'uncode-core'),
					),
					array(
						'xl_size',
						esc_html__('Extra large size', 'uncode-core')
					)
				),
				array(
					array(
						'hide_qualification',
						esc_html__('Hide qualification', 'uncode-core'),
					) ,
					array(
						'display_qualification',
						esc_html__('Display qualification', 'uncode-core'),
					),
				),
				array(
					array(
						'avatar_inline',
						esc_html__('Avatar inline', 'uncode-core'),
					) ,
					array(
						'avatar_above',
						esc_html__('Avatar above', 'uncode-core'),
					),
					array(
						'hidden_avatar',
						esc_html__('Hidden avatar', 'uncode-core'),
					),
				),
			),
			array(
				'date',
				esc_html__('Date', 'uncode-core') ,
			) ,
			array(
				'category',
				esc_html__('Category', 'uncode-core') ,
				array(
					array(
						'nobg',
						esc_html__('Default', 'uncode-core'),
					) ,
					array(
						'yesbg',
						esc_html__('Colored text', 'uncode-core'),
					),
					array(
						'bordered',
						esc_html__('Bordered', 'uncode-core'),
					),
					array(
						'colorbg',
						esc_html__('Colored background', 'uncode-core')
					),
					array(
						'transparentbg',
						esc_html__('Transparent background', 'uncode-core')
					),
				),
				array(
					array(
						'relative',
						esc_html__('Relative position', 'uncode-core'),
					) ,
					array(
						'topleft',
						esc_html__('Over the image, on top left', 'uncode-core'),
					),
					array(
						'topright',
						esc_html__('Over the image, on top right', 'uncode-core'),
					),
					array(
						'bottomleft',
						esc_html__('Over the image, on bottom left', 'uncode-core'),
					),
					array(
						'bottomright',
						esc_html__('Over the image, on bottom right', 'uncode-core'),
					),
				),
				array(
					array(
						'display-icon',
						esc_html__('Display icon (when available)', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'extra',
				esc_html__('Extra', 'uncode-core') ,
				array(
					array(
						'display-icon',
						esc_html__('Display icon', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'meta',
				esc_html__('Default Meta', 'uncode-core') ,
				array(
					array(
						'display-icon',
						esc_html__('Display icon', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'text',
				esc_html__('Text', 'uncode-core') ,
				array(
					array(
						'excerpt',
						esc_html__('Excerpt', 'uncode-core')
					) ,
					array(
						'full',
						esc_html__('Full content', 'uncode-core')
					) ,
				)
			) ,
			array(
				'link',
				esc_html__('Button', 'uncode-core'),
				array(
					array(
						'default',
						esc_html__('Inherit', 'uncode-core')
					) ,
					array(
						'default-shape',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'round',
						esc_html__('Round', 'uncode-core')
					) ,
					array(
						'circle',
						esc_html__('Circle', 'uncode-core')
					) ,
					array(
						'square',
						esc_html__('Square', 'uncode-core')
					) ,
					array(
						'link',
						esc_html__('Standard link', 'uncode-core')
					)
				),
				array(
					array(
						'default_size',
						esc_html__('Default size', 'uncode-core')
					) ,
					array(
						'small_size',
						esc_html__('Small size', 'uncode-core')
					) ,
					array(
						'large_size',
						esc_html__('Large size', 'uncode-core')
					) ,
				),
				array(
					array(
						'scale_mobile',
						esc_html__('Scale on mobile', 'uncode-core')
					) ,
					array(
						'not_scale_mobile',
						esc_html__('Not scale on mobile', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_width',
						esc_html__('Default width', 'uncode-core')
					) ,
					array(
						'fluid_width',
						esc_html__('Fluid width', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_outline',
						esc_html__('Default style', 'uncode-core')
					) ,
					array(
						'outline_inverse',
						esc_html__('Outline style', 'uncode-core')
					) ,
				),
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode-core') ,
				array(
					array(
						'df',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'sm',
						esc_html__('Small', 'uncode-core')
					) ,
					array(
						'md',
						esc_html__('Medium', 'uncode-core')
					) ,
					array(
						'lg',
						esc_html__('Large', 'uncode-core')
					),
					array(
						'xl',
						esc_html__('Extra Large', 'uncode-core')
					)
				) ,
			) ,
			array(
				'spacer',
				esc_html__('Spacer One', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'spacer_two',
				esc_html__('Spacer Two', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'col-one',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-two',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-three',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-four',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-five',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-six',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
		)
	);

	$get_custom_fields = (function_exists('ot_get_option')) ? ot_get_option('_uncode_'.$value.'_custom_fields') : array();
	if (isset($get_custom_fields) && !empty($get_custom_fields))
	{
		foreach ($get_custom_fields as $field_key => $field)
		{
			$uncode_post_type_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
			$uncode_post_type_table_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
		}
	}
	$uncode_index_params_second[] = apply_filters( 'uncode_sorted_list_generic_options', $uncode_post_type_list );
	$uncode_index_params_second[] = apply_filters( 'uncode_sorted_list_generic_table_options', $uncode_post_type_table_list );
}

global $uncode_index_map;


$uncode_post_list = apply_filters( 'uncode_sorted_list_post_options',
	array(
		'type' => 'sorted_list',
		'heading' => esc_html__('Posts', 'uncode-core') . ' ' . esc_html__('elements', 'uncode-core') ,
		'param_name' => 'post_items',
		'description' => esc_html__('Enable or disable elements and place them in desired order. NB. The Category (when it has a non-relative position) and Icon elements cannot be dragged.', 'uncode-core') ,
		'value' => 'media|featured|onpost|original,title,date',
		'group' => esc_html__('Module', 'uncode-core') ,
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode-core') ,
				array(
					array(
						'featured',
						esc_html__('Featured Image', 'uncode-core')
					) ,
					array(
						'secondary',
						esc_html__('Secondary Featured Image', 'uncode-core')
					) ,
					array(
						'media',
						esc_html__('Featured Media', 'uncode-core')
					) ,
					array(
						'custom',
						esc_html__('Custom', 'uncode-core')
					)
				) ,
				array(
					array(
						'onpost',
						esc_html__('Link to post', 'uncode-core')
					) ,
					array(
						'lightbox',
						esc_html__('Lightbox', 'uncode-core')
					) ,
					array(
						'nolink',
						esc_html__('No link', 'uncode-core')
					)
				) ,
				array(
					array(
						'original',
						esc_html__('Original', 'uncode-core')
					) ,
					array(
						'poster',
						esc_html__('Poster', 'uncode-core')
					)
				)
			) ,
			array(
				'title',
				esc_html__('Title', 'uncode-core') ,
			) ,
			array(
				'type',
				esc_html__('Post Type', 'uncode-core') ,
			) ,
			array(
				'author',
				esc_html__('Author', 'uncode-core') ,
				array(
					array(
						'sm_size',
						esc_html__('Small size', 'uncode-core'),
					) ,
					array(
						'md_size',
						esc_html__('Medium size', 'uncode-core'),
					),
					array(
						'lg_size',
						esc_html__('Large size', 'uncode-core'),
					),
					array(
						'xl_size',
						esc_html__('Extra large size', 'uncode-core')
					)
				),
				array(
					array(
						'hide_qualification',
						esc_html__('Hide qualification', 'uncode-core'),
					) ,
					array(
						'display_qualification',
						esc_html__('Display qualification', 'uncode-core'),
					),
				),
			),
			array(
				'date',
				esc_html__('Date', 'uncode-core') ,
			) ,
			array(
				'category',
				esc_html__('Category', 'uncode-core') ,
				array(
					array(
						'nobg',
						esc_html__('Default', 'uncode-core'),
					) ,
					array(
						'yesbg',
						esc_html__('Colored text', 'uncode-core'),
					),
					array(
						'bordered',
						esc_html__('Bordered', 'uncode-core'),
					),
					array(
						'colorbg',
						esc_html__('Colored background', 'uncode-core')
					),
					array(
						'transparentbg',
						esc_html__('Transparent background', 'uncode-core')
					),
				),
				array(
					array(
						'relative',
						esc_html__('Relative position', 'uncode-core'),
					) ,
					array(
						'topleft',
						esc_html__('Over the image, on top left', 'uncode-core'),
					),
					array(
						'topright',
						esc_html__('Over the image, on top right', 'uncode-core'),
					),
					array(
						'bottomleft',
						esc_html__('Over the image, on bottom left', 'uncode-core'),
					),
					array(
						'bottomright',
						esc_html__('Over the image, on bottom right', 'uncode-core'),
					),
				),
				array(
					array(
						'display-icon',
						esc_html__('Display icon (when available)', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'extra',
				esc_html__('Extra', 'uncode-core') ,
			) ,
			array(
				'meta',
				esc_html__('Default Meta', 'uncode-core') ,
				array(
					array(
						'display-icon',
						esc_html__('Display icon', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'text',
				esc_html__('Text', 'uncode-core') ,
				array(
					array(
						'excerpt',
						esc_html__('Excerpt', 'uncode-core')
					) ,
					array(
						'full',
						esc_html__('Full content', 'uncode-core')
					) ,
				)
			) ,
			array(
				'link',
				esc_html__('Button', 'uncode-core'),
				array(
					array(
						'default',
						esc_html__('Inherit', 'uncode-core')
					) ,
					array(
						'default-shape',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'round',
						esc_html__('Round', 'uncode-core')
					) ,
					array(
						'circle',
						esc_html__('Circle', 'uncode-core')
					) ,
					array(
						'square',
						esc_html__('Square', 'uncode-core')
					) ,
					array(
						'link',
						esc_html__('Standard link', 'uncode-core')
					)
				),
				array(
					array(
						'default_size',
						esc_html__('Default size', 'uncode-core')
					) ,
					array(
						'small_size',
						esc_html__('Small size', 'uncode-core')
					) ,
					array(
						'large_size',
						esc_html__('Large size', 'uncode-core')
					) ,
				),
				array(
					array(
						'scale_mobile',
						esc_html__('Scale on mobile', 'uncode-core')
					) ,
					array(
						'not_scale_mobile',
						esc_html__('Not scale on mobile', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_width',
						esc_html__('Default width', 'uncode-core')
					) ,
					array(
						'fluid_width',
						esc_html__('Fluid width', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_outline',
						esc_html__('Default style', 'uncode-core')
					) ,
					array(
						'outline_inverse',
						esc_html__('Outline style', 'uncode-core')
					) ,
				),
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode-core') ,
				array(
					array(
						'sm',
						esc_html__('Small', 'uncode-core')
					) ,
					array(
						'md',
						esc_html__('Medium', 'uncode-core')
					) ,
					array(
						'lg',
						esc_html__('Large', 'uncode-core')
					),
					array(
						'xl',
						esc_html__('Extra Large', 'uncode-core')
					)
				) ,
			) ,
			array(
				'spacer',
				esc_html__('Spacer One', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'spacer_two',
				esc_html__('Spacer Two', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-one',
				esc_html__('Separator One', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-two',
				esc_html__('Separator Two', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
		) ,
	)
);

$uncode_post_table_list = apply_filters( 'uncode_sorted_list_post_table_options',
	array(
		'type' => 'sorted_list',
		'heading' => esc_html__('Posts', 'uncode-core') . ' ' . esc_html__('elements', 'uncode-core') ,
		'param_name' => 'post_table_items',
		'description' => esc_html__('Enable or disable elements and place them in desired order.', 'uncode-core') ,
		'value' => 'col-one|1,media|featured|onpost|poster,col-two|5,title,col-three|2,date,col-four|2,category|inline,col-five|2,link|default|default_size',
		'group' => esc_html__('Module', 'uncode-core') ,
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode-core') ,
				array(
					array(
						'featured',
						esc_html__('Featured Image', 'uncode-core')
					) ,
					array(
						'secondary',
						esc_html__('Secondary Featured Image', 'uncode-core')
					) ,
					array(
						'media',
						esc_html__('Featured Media', 'uncode-core')
					) ,
					array(
						'custom',
						esc_html__('Custom', 'uncode-core')
					)
				) ,
				array(
					array(
						'onpost',
						esc_html__('Link to post', 'uncode-core')
					) ,
					array(
						'lightbox',
						esc_html__('Lightbox', 'uncode-core')
					) ,
					array(
						'nolink',
						esc_html__('No link', 'uncode-core')
					)
				) ,
				array(
					array(
						'original',
						esc_html__('Original', 'uncode-core')
					) ,
					array(
						'poster',
						esc_html__('Poster', 'uncode-core')
					)
				)
			) ,
			array(
				'title',
				esc_html__('Title', 'uncode-core') ,
			) ,
			array(
				'type',
				esc_html__('Post Type', 'uncode-core') ,
			) ,
			array(
				'author',
				esc_html__('Author', 'uncode-core') ,
				array(
					array(
						'sm_size',
						esc_html__('Small size', 'uncode-core'),
					) ,
					array(
						'md_size',
						esc_html__('Medium size', 'uncode-core'),
					),
					array(
						'lg_size',
						esc_html__('Large size', 'uncode-core'),
					),
					array(
						'xl_size',
						esc_html__('Extra large size', 'uncode-core')
					)
				),
				array(
					array(
						'hide_qualification',
						esc_html__('Hide qualification', 'uncode-core'),
					) ,
					array(
						'display_qualification',
						esc_html__('Display qualification', 'uncode-core'),
					),
				),
				array(
					array(
						'avatar_inline',
						esc_html__('Avatar inline', 'uncode-core'),
					) ,
					array(
						'avatar_above',
						esc_html__('Avatar above', 'uncode-core'),
					),
					array(
						'hidden_avatar',
						esc_html__('Hidden avatar', 'uncode-core'),
					),
				),
			),
			array(
				'date',
				esc_html__('Date', 'uncode-core') ,
			) ,
			array(
				'category',
				esc_html__('Category', 'uncode-core') ,
				array(
					array(
						'inline',
						esc_html__('Inline', 'uncode-core'),
					) ,
					array(
						'block',
						esc_html__('Block', 'uncode-core'),
					),
				),
			) ,
			array(
				'extra',
				esc_html__('Extra', 'uncode-core') ,
				array(
					array(
						'display-icon',
						esc_html__('Display icon', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'meta',
				esc_html__('Default Meta', 'uncode-core') ,
				array(
					array(
						'display-icon',
						esc_html__('Display icon', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'text',
				esc_html__('Text', 'uncode-core') ,
				array(
					array(
						'excerpt',
						esc_html__('Excerpt', 'uncode-core')
					) ,
					array(
						'full',
						esc_html__('Full content', 'uncode-core')
					) ,
				)
			) ,
			array(
				'link',
				esc_html__('Button', 'uncode-core'),
				array(
					array(
						'default',
						esc_html__('Inherit', 'uncode-core')
					) ,
					array(
						'default-shape',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'round',
						esc_html__('Round', 'uncode-core')
					) ,
					array(
						'circle',
						esc_html__('Circle', 'uncode-core')
					) ,
					array(
						'square',
						esc_html__('Square', 'uncode-core')
					) ,
					array(
						'link',
						esc_html__('Standard link', 'uncode-core')
					)
				),
				array(
					array(
						'default_size',
						esc_html__('Default size', 'uncode-core')
					) ,
					array(
						'small_size',
						esc_html__('Small size', 'uncode-core')
					) ,
					array(
						'large_size',
						esc_html__('Large size', 'uncode-core')
					) ,
				),
				array(
					array(
						'scale_mobile',
						esc_html__('Scale on mobile', 'uncode-core')
					) ,
					array(
						'not_scale_mobile',
						esc_html__('Not scale on mobile', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_width',
						esc_html__('Default width', 'uncode-core')
					) ,
					array(
						'fluid_width',
						esc_html__('Fluid width', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_outline',
						esc_html__('Default style', 'uncode-core')
					) ,
					array(
						'outline_inverse',
						esc_html__('Outline style', 'uncode-core')
					) ,
				),
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode-core') ,
				array(
					array(
						'sm',
						esc_html__('Small', 'uncode-core')
					) ,
					array(
						'md',
						esc_html__('Medium', 'uncode-core')
					) ,
					array(
						'lg',
						esc_html__('Large', 'uncode-core')
					),
					array(
						'xl',
						esc_html__('Extra Large', 'uncode-core')
					)
				) ,
			) ,
			array(
				'spacer',
				esc_html__('Spacer One', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'spacer_two',
				esc_html__('Spacer Two', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'col-one',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-two',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-three',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-four',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-five',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-six',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
		) ,
	)
);

$uncode_page_list = apply_filters( 'uncode_sorted_list_page_options',
	array(
		'type' => 'sorted_list',
		'heading' => esc_html__('Pages', 'uncode-core') . ' ' . esc_html__('elements', 'uncode-core') ,
		'param_name' => 'page_items',
		'description' => esc_html__('Enable or disable elements and place them in desired order. NB. The Category (when it has a non-relative position) and Icon elements cannot be dragged.', 'uncode-core') ,
		'value' => 'media|featured|onpost|original,title',
		'group' => esc_html__('Module', 'uncode-core') ,
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode-core') ,
				array(
					array(
						'featured',
						esc_html__('Featured Image', 'uncode-core')
					) ,
					array(
						'secondary',
						esc_html__('Secondary Featured Image', 'uncode-core')
					) ,
					array(
						'media',
						esc_html__('Featured Media', 'uncode-core')
					) ,
					array(
						'custom',
						esc_html__('Custom', 'uncode-core')
					)
				) ,
				array(
					array(
						'onpost',
						esc_html__('Link to post', 'uncode-core')
					) ,
					array(
						'lightbox',
						esc_html__('Lightbox', 'uncode-core')
					) ,
					array(
						'nolink',
						esc_html__('No link', 'uncode-core')
					)
				) ,
				array(
					array(
						'original',
						esc_html__('Original', 'uncode-core')
					) ,
					array(
						'poster',
						esc_html__('Poster', 'uncode-core')
					)
				)
			) ,
			array(
				'title',
				esc_html__('Title', 'uncode-core') ,
			) ,
			array(
				'type',
				esc_html__('Post Type', 'uncode-core') ,
			) ,
			array(
				'category',
				esc_html__('Category', 'uncode-core') ,
				array(
					array(
						'nobg',
						esc_html__('Default', 'uncode-core'),
					) ,
					array(
						'yesbg',
						esc_html__('Colored text', 'uncode-core'),
					),
					array(
						'bordered',
						esc_html__('Bordered', 'uncode-core'),
					),
					array(
						'colorbg',
						esc_html__('Colored background', 'uncode-core')
					),
					array(
						'transparentbg',
						esc_html__('Transparent background', 'uncode-core')
					),
				),
				array(
					array(
						'relative',
						esc_html__('Relative position', 'uncode-core'),
					) ,
					array(
						'topleft',
						esc_html__('Over the image, on top left', 'uncode-core'),
					),
					array(
						'topright',
						esc_html__('Over the image, on top right', 'uncode-core'),
					),
					array(
						'bottomleft',
						esc_html__('Over the image, on bottom left', 'uncode-core'),
					),
					array(
						'bottomright',
						esc_html__('Over the image, on bottom right', 'uncode-core'),
					),
				),
				array(
					array(
						'display-icon',
						esc_html__('Display icon (when available)', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'text',
				esc_html__('Text', 'uncode-core') ,
				array(
					array(
						'excerpt',
						esc_html__('Excerpt', 'uncode-core')
					) ,
					array(
						'full',
						esc_html__('Full content', 'uncode-core')
					) ,
				)
			) ,
			array(
				'link',
				esc_html__('Button', 'uncode-core'),
				array(
					array(
						'default',
						esc_html__('Inherit', 'uncode-core')
					) ,
					array(
						'default-shape',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'round',
						esc_html__('Round', 'uncode-core')
					) ,
					array(
						'circle',
						esc_html__('Circle', 'uncode-core')
					) ,
					array(
						'square',
						esc_html__('Square', 'uncode-core')
					) ,
					array(
						'link',
						esc_html__('Standard link', 'uncode-core')
					)
				),
				array(
					array(
						'default_size',
						esc_html__('Default size', 'uncode-core')
					) ,
					array(
						'small_size',
						esc_html__('Small size', 'uncode-core')
					) ,
					array(
						'large_size',
						esc_html__('Large size', 'uncode-core')
					) ,
				),
				array(
					array(
						'scale_mobile',
						esc_html__('Scale on mobile', 'uncode-core')
					) ,
					array(
						'not_scale_mobile',
						esc_html__('Not scale on mobile', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_width',
						esc_html__('Default width', 'uncode-core')
					) ,
					array(
						'fluid_width',
						esc_html__('Fluid width', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_outline',
						esc_html__('Default style', 'uncode-core')
					) ,
					array(
						'outline_inverse',
						esc_html__('Outline style', 'uncode-core')
					) ,
				),
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode-core') ,
				array(
					array(
						'sm',
						esc_html__('Small', 'uncode-core')
					) ,
					array(
						'md',
						esc_html__('Medium', 'uncode-core')
					) ,
					array(
						'lg',
						esc_html__('Large', 'uncode-core')
					),
					array(
						'xl',
						esc_html__('Extra Large', 'uncode-core')
					)
				) ,
			) ,
			array(
				'spacer',
				esc_html__('Spacer One', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'spacer_two',
				esc_html__('Spacer Two', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-one',
				esc_html__('Separator One', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-two',
				esc_html__('Separator Two', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
		),
	)
);

$uncode_page_table_list = apply_filters( 'uncode_sorted_list_page_table_options',
	array(
		'type' => 'sorted_list',
		'heading' => esc_html__('Pages', 'uncode-core') . ' ' . esc_html__('elements', 'uncode-core') ,
		'param_name' => 'page_table_items',
		'description' => esc_html__('Enable or disable elements and place them in desired order.', 'uncode-core') ,
		'value' => 'col-one|4,title,col-two|4,category|inline,col-three|4,link|link|default_size',
		'group' => esc_html__('Module', 'uncode-core') ,
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode-core') ,
				array(
					array(
						'featured',
						esc_html__('Featured Image', 'uncode-core')
					) ,
					array(
						'secondary',
						esc_html__('Secondary Featured Image', 'uncode-core')
					) ,
					array(
						'media',
						esc_html__('Featured Media', 'uncode-core')
					) ,
					array(
						'custom',
						esc_html__('Custom', 'uncode-core')
					)
				) ,
				array(
					array(
						'onpost',
						esc_html__('Link to post', 'uncode-core')
					) ,
					array(
						'lightbox',
						esc_html__('Lightbox', 'uncode-core')
					) ,
					array(
						'nolink',
						esc_html__('No link', 'uncode-core')
					)
				) ,
				array(
					array(
						'original',
						esc_html__('Original', 'uncode-core')
					) ,
					array(
						'poster',
						esc_html__('Poster', 'uncode-core')
					)
				)
			) ,
			array(
				'title',
				esc_html__('Title', 'uncode-core') ,
			) ,
			array(
				'type',
				esc_html__('Post Type', 'uncode-core') ,
			) ,
			array(
				'category',
				esc_html__('Category', 'uncode-core') ,
				array(
					array(
						'inline',
						esc_html__('Inline', 'uncode-core'),
					) ,
					array(
						'block',
						esc_html__('Block', 'uncode-core'),
					),
				),
			) ,
			array(
				'text',
				esc_html__('Text', 'uncode-core') ,
				array(
					array(
						'excerpt',
						esc_html__('Excerpt', 'uncode-core')
					) ,
					array(
						'full',
						esc_html__('Full content', 'uncode-core')
					) ,
				)
			) ,
			array(
				'link',
				esc_html__('Button', 'uncode-core'),
				array(
					array(
						'default',
						esc_html__('Inherit', 'uncode-core')
					) ,
					array(
						'default-shape',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'round',
						esc_html__('Round', 'uncode-core')
					) ,
					array(
						'circle',
						esc_html__('Circle', 'uncode-core')
					) ,
					array(
						'square',
						esc_html__('Square', 'uncode-core')
					) ,
					array(
						'link',
						esc_html__('Standard link', 'uncode-core')
					)
				),
				array(
					array(
						'default_size',
						esc_html__('Default size', 'uncode-core')
					) ,
					array(
						'small_size',
						esc_html__('Small size', 'uncode-core')
					) ,
					array(
						'large_size',
						esc_html__('Large size', 'uncode-core')
					) ,
				),
				array(
					array(
						'scale_mobile',
						esc_html__('Scale on mobile', 'uncode-core')
					) ,
					array(
						'not_scale_mobile',
						esc_html__('Not scale on mobile', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_width',
						esc_html__('Default width', 'uncode-core')
					) ,
					array(
						'fluid_width',
						esc_html__('Fluid width', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_outline',
						esc_html__('Default style', 'uncode-core')
					) ,
					array(
						'outline_inverse',
						esc_html__('Outline style', 'uncode-core')
					) ,
				),
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode-core') ,
				array(
					array(
						'sm',
						esc_html__('Small', 'uncode-core')
					) ,
					array(
						'md',
						esc_html__('Medium', 'uncode-core')
					) ,
					array(
						'lg',
						esc_html__('Large', 'uncode-core')
					),
					array(
						'xl',
						esc_html__('Extra Large', 'uncode-core')
					)
				) ,
			) ,
			array(
				'spacer',
				esc_html__('Spacer One', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'spacer_two',
				esc_html__('Spacer Two', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'col-one',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-two',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-three',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-four',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-five',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-six',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
		),
	)
);

$variations_number = array(
	array(
		'all',
		esc_html__('Show all (single attribute only)', 'uncode-core'),
	)
);
for ( $i=1; $i < 11; $i++ ) {
	$variations_number[] = array( strval( $i ), strval( $i ) . esc_html__(' (single attribute only)', 'uncode-core'), );
}

$products_attributes = array();
$products_attributes_with_image = array();

if ( class_exists( 'WooCommerce' ) && function_exists( 'uncode_wc_get_taxonomy_props' ) ) {
	$attribute_taxonomies = wc_get_attribute_taxonomies();

	if ( $attribute_taxonomies ) {
		$products_attributes = array(
			array(
				'_all',
				esc_html__('All attributes', 'uncode-core'),
			)
		);

		foreach ( $attribute_taxonomies as $tax ) {
			$attr_key              = wc_attribute_taxonomy_name( $tax->attribute_name );
			$attr_label            = wc_attribute_label( $attr_key ) . ' (ID:' . $tax->attribute_id . ')';
			$products_attributes[] = array( $attr_key, $attr_label );

			$tax_props = uncode_wc_get_taxonomy_props( $tax->attribute_name );

			if ( isset( $tax_props->attribute_type ) && $tax_props->attribute_type === 'image' ) {
				$products_attributes_with_image[] = array( $attr_key, $attr_label );
			}
		}
	}
}

$uncode_product_list = apply_filters( 'uncode_sorted_list_product_options',
	array(
		'type' => 'sorted_list',
		'heading' => esc_html__('Products', 'uncode-core') . ' ' . esc_html__('elements', 'uncode-core') ,
		'param_name' => 'product_items',
		'description' => esc_html__('Enable or disable elements and place them in desired order. NB. The Category (when it has a non-relative position), Icon, Quick-View and Wishlist elements cannot be dragged.', 'uncode-core') ,
		'value' => 'media|featured|onpost|original|hide-sale|inherit-atc|inherit-w-atc|atc-typo-default|show-atc,title,price|default',
		'group' => esc_html__('Module', 'uncode-core') ,
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode-core') ,
				array(
					array(
						'featured',
						esc_html__('Featured Image', 'uncode-core')
					) ,
					array(
						'secondary',
						esc_html__('Secondary Featured Image', 'uncode-core')
					) ,
					array(
						'media',
						esc_html__('Featured Media', 'uncode-core')
					) ,
					array(
						'custom',
						esc_html__('Custom', 'uncode-core')
					) ,
				) ,
				array(
					array(
						'onpost',
						esc_html__('Link to post', 'uncode-core')
					) ,
					array(
						'lightbox',
						esc_html__('Lightbox', 'uncode-core')
					) ,
					array(
						'nolink',
						esc_html__('No link', 'uncode-core')
					)
				) ,
				array(
					array(
						'original',
						esc_html__('Original', 'uncode-core')
					) ,
					array(
						'poster',
						esc_html__('Poster', 'uncode-core')
					)
				) ,
				array(
					array(
						'hide-sale',
						esc_html__('Hide badge', 'uncode-core')
					) ,
					array(
						'show-sale',
						esc_html__('Show badge', 'uncode-core')
					)
				) ,
				array(
					array(
						'inherit-atc',
						esc_html__('Inherit Add to Cart Style', 'uncode-core')
					) ,
					array(
						'default-atc',
						esc_html__('Default Add to Cart button', 'uncode-core')
					) ,
					array(
						'enhanced-atc',
						esc_html__('Add to Cart Button Enhanced', 'uncode-core')
					)
				) ,
				array(
					array(
						'inherit-w-atc',
						esc_html__('Inherit Add to Cart to Width', 'uncode-core')
					) ,
					array(
						'fluid-w-atc',
						esc_html__('Add to Cart Fluid Width', 'uncode-core')
					) ,
					array(
						'auto-w-atc',
						esc_html__('Add to Cart Auto Width', 'uncode-core')
					)
				),
				array(
					array(
						'atc-typo-default',
						esc_html__('Add to Cart Default Typography', 'uncode-core')
					) ,
					array(
						'atc-typo-column',
						esc_html__('Add to Cart Column Typography', 'uncode-core')
					) ,
				),
				array(
					array(
						'show-atc',
						esc_html__('Show Add to Cart', 'uncode-core')
					) ,
					array(
						'hide-atc',
						esc_html__('Hide Add to Cart', 'uncode-core')
					) ,
				)
			) ,
			array(
				'title',
				esc_html__('Title', 'uncode-core') ,
			) ,
			array(
				'type',
				esc_html__('Post Type', 'uncode-core') ,
			) ,
			array(
				'category',
				esc_html__('Category', 'uncode-core') ,
				array(
					array(
						'nobg',
						esc_html__('Default', 'uncode-core'),
					) ,
					array(
						'yesbg',
						esc_html__('Colored text', 'uncode-core'),
					),
					array(
						'bordered',
						esc_html__('Bordered', 'uncode-core'),
					),
					array(
						'colorbg',
						esc_html__('Colored background', 'uncode-core')
					),
					array(
						'transparentbg',
						esc_html__('Transparent background', 'uncode-core')
					),
				),
				array(
					array(
						'relative',
						esc_html__('Relative position', 'uncode-core'),
					) ,
					array(
						'topleft',
						esc_html__('Over the image, on top left', 'uncode-core'),
					),
					array(
						'topright',
						esc_html__('Over the image, on top right', 'uncode-core'),
					),
					array(
						'bottomleft',
						esc_html__('Over the image, on bottom left', 'uncode-core'),
					),
					array(
						'bottomright',
						esc_html__('Over the image, on bottom right', 'uncode-core'),
					),
				),
				array(
					array(
						'display-icon',
						esc_html__('Display icon (when available)', 'uncode-core')
					) ,
					array(
						'hide-icon',
						esc_html__('Hide icon', 'uncode-core')
					) ,
				)
			) ,
			array(
				'text',
				esc_html__('Text', 'uncode-core') ,
				array(
					array(
						'excerpt',
						esc_html__('Excerpt', 'uncode-core')
					) ,
					array(
						'full',
						esc_html__('Full content', 'uncode-core')
					) ,
				)
			) ,
			array(
				'link',
				esc_html__('Button', 'uncode-core'),
				array(
					array(
						'default',
						esc_html__('Inherit', 'uncode-core')
					) ,
					array(
						'default-shape',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'round',
						esc_html__('Round', 'uncode-core')
					) ,
					array(
						'circle',
						esc_html__('Circle', 'uncode-core')
					) ,
					array(
						'square',
						esc_html__('Square', 'uncode-core')
					) ,
					array(
						'link',
						esc_html__('Standard link', 'uncode-core')
					)
				),
				array(
					array(
						'default_size',
						esc_html__('Default size', 'uncode-core')
					) ,
					array(
						'small_size',
						esc_html__('Small size', 'uncode-core')
					) ,
					array(
						'large_size',
						esc_html__('Large size', 'uncode-core')
					) ,
				),
				array(
					array(
						'scale_mobile',
						esc_html__('Scale on mobile', 'uncode-core')
					) ,
					array(
						'not_scale_mobile',
						esc_html__('Not scale on mobile', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_width',
						esc_html__('Default width', 'uncode-core')
					) ,
					array(
						'fluid_width',
						esc_html__('Fluid width', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_outline',
						esc_html__('Default style', 'uncode-core')
					) ,
					array(
						'outline_inverse',
						esc_html__('Outline style', 'uncode-core')
					) ,
				),
			) ,
			array(
				'add_to_cart',
				esc_html__('Add to Cart', 'uncode-core'),
				array(
					array(
						'default',
						esc_html__('Inherit', 'uncode-core')
					) ,
					array(
						'default-shape',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'round',
						esc_html__('Round', 'uncode-core')
					) ,
					array(
						'circle',
						esc_html__('Circle', 'uncode-core')
					) ,
					array(
						'square',
						esc_html__('Square', 'uncode-core')
					) ,
					array(
						'link',
						esc_html__('Standard link', 'uncode-core')
					)
				),
				array(
					array(
						'default_size',
						esc_html__('Default size', 'uncode-core')
					) ,
					array(
						'small_size',
						esc_html__('Small size', 'uncode-core')
					) ,
					array(
						'large_size',
						esc_html__('Large size', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_width',
						esc_html__('Default width', 'uncode-core')
					) ,
					array(
						'fluid_width',
						esc_html__('Fluid width', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_outline',
						esc_html__('Default style', 'uncode-core')
					) ,
					array(
						'outline_inverse',
						esc_html__('Outline style', 'uncode-core')
					) ,
				),
			) ,
			array(
				'price',
				esc_html__('Price', 'uncode-core') ,
				array(
					array(
						'default',
						esc_html__('Default layout', 'uncode-core'),
					) ,
					array(
						'inline',
						esc_html__('Inline price', 'uncode-core'),
					),
					array(
						'inline_responsive',
						esc_html__('Inline price responsive', 'uncode-core'),
					),
				),
			) ,
			array(
				'stars',
				esc_html__('Stars', 'uncode-core') ,
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode-core') ,
				array(
					array(
						'sm',
						esc_html__('Small', 'uncode-core')
					) ,
					array(
						'md',
						esc_html__('Medium', 'uncode-core')
					) ,
					array(
						'lg',
						esc_html__('Large', 'uncode-core')
					),
					array(
						'xl',
						esc_html__('Extra Large', 'uncode-core')
					)
				) ,
			) ,
			array(
				'spacer',
				esc_html__('Spacer One', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'spacer_two',
				esc_html__('Spacer Two', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-one',
				esc_html__('Separator One', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
			array(
				'sep-two',
				esc_html__('Separator Two', 'uncode-core') ,
				array(
					array(
						'full',
						esc_html__('Full width', 'uncode-core')
					) ,
					array(
						'reduced',
						esc_html__('Reduced width', 'uncode-core')
					),
					array(
						'extra',
						esc_html__('Extra full width', 'uncode-core')
					)
				)
			) ,
			array(
				'variations',
				esc_html__('Variations', 'uncode-core') ,
				array(
					array(
						'under',
						esc_html__('Relative position', 'uncode-core'),
					) ,
					array(
						'over_visible',
						esc_html__('Over the image (single attribute only)', 'uncode-core'),
					),
					array(
						'over',
						esc_html__('Over the image on hover (single attribute only)', 'uncode-core'),
					),
				),
				$products_attributes,
				$variations_number,
				array(
					array(
						'default',
						esc_html__('Variation change click (single attribute only)', 'uncode-core'),
					) ,
					array(
						'hover',
						esc_html__('Variation change hover (single attribute only)', 'uncode-core'),
					),
				),
				array(
					array(
						'original_title',
						esc_html__('Title original', 'uncode-core'),
					) ,
					array(
						'dynamic_title',
						esc_html__('Title with variation name', 'uncode-core'),
					),
				),
				array(
					array(
						'size_regular',
						esc_html__('Regular size', 'uncode-core'),
					) ,
					array(
						'size_small',
						esc_html__('Small size', 'uncode-core'),
					) ,
					array(
						'size_large',
						esc_html__('Large size', 'uncode-core'),
					) ,
				),
				array(
					array(
						'mobile',
						esc_html__('Device/Tablet/Desktop', 'uncode-core'),
					) ,
					array(
						'tablet',
						esc_html__('Tablet/Desktop', 'uncode-core'),
					) ,
					array(
						'desktop',
						esc_html__('Desktop', 'uncode-core'),
					) ,
				),
			) ,
			array(
				'attribute_image',
				esc_html__('Attribute Image', 'uncode-core') ,
				$products_attributes_with_image,
				array(
					array(
						'border_yes',
						esc_html__('With border', 'uncode-core')
					) ,
					array(
						'border_no',
						esc_html__('No border', 'uncode-core')
					) ,
				),
				array(
					array(
						'no_link',
						esc_html__('No link', 'uncode-core')
					) ,
					array(
						'with_link',
						esc_html__('Link', 'uncode-core')
					) ,
				)
			) ,
			array(
				'stock',
				esc_html__('Stock', 'uncode-core') ,
				array(
					array(
						'all',
						esc_html__('Stock availability', 'uncode-core')
					) ,
					array(
						'out_of_stock',
						esc_html__('Out of stock only', 'uncode-core')
					) ,
				)
			) ,
		),
	)
);

$uncode_product_table_list = apply_filters( 'uncode_sorted_list_product_table_options',
	array(
		'type' => 'sorted_list',
		'heading' => esc_html__('Products', 'uncode-core') . ' ' . esc_html__('elements', 'uncode-core') ,
		'param_name' => 'product_table_items',
		'description' => esc_html__('Enable or disable elements and place them in desired order. NB. The Category (when it has a non-relative position), Icon, Quick-View and Wishlist elements cannot be dragged.', 'uncode-core') ,
		'value' => 'col-one|1,media|featured|onpost|original|hide-sale|inherit-atc|inherit-w-atc|atc-typo-default|hide-atc,col-two|3,title,col-three|2,category|block,col-four|3,price|default,col-five|2,add_to_cart|link|default_size',
		'group' => esc_html__('Module', 'uncode-core') ,
		'options' => array(
			array(
				'media',
				esc_html__('Media', 'uncode-core') ,
				array(
					array(
						'featured',
						esc_html__('Featured Image', 'uncode-core')
					) ,
					array(
						'secondary',
						esc_html__('Secondary Featured Image', 'uncode-core')
					) ,
					array(
						'media',
						esc_html__('Featured Media', 'uncode-core')
					) ,
					array(
						'custom',
						esc_html__('Custom', 'uncode-core')
					) ,
				) ,
				array(
					array(
						'onpost',
						esc_html__('Link to post', 'uncode-core')
					) ,
					array(
						'lightbox',
						esc_html__('Lightbox', 'uncode-core')
					) ,
					array(
						'nolink',
						esc_html__('No link', 'uncode-core')
					)
				) ,
				array(
					array(
						'original',
						esc_html__('Original', 'uncode-core')
					) ,
					array(
						'poster',
						esc_html__('Poster', 'uncode-core')
					)
				) ,
				array(
					array(
						'hide-sale',
						esc_html__('Hide badge', 'uncode-core')
					) ,
					array(
						'show-sale',
						esc_html__('Show badge', 'uncode-core')
					)
				) ,
				array(
					array(
						'inherit-atc',
						esc_html__('Inherit Add to Cart Style', 'uncode-core')
					) ,
					array(
						'default-atc',
						esc_html__('Default Add to Cart button', 'uncode-core')
					) ,
					array(
						'enhanced-atc',
						esc_html__('Add to Cart Button Enhanced', 'uncode-core')
					)
				) ,
				array(
					array(
						'inherit-w-atc',
						esc_html__('Inherit Add to Cart to Width', 'uncode-core')
					) ,
					array(
						'fluid-w-atc',
						esc_html__('Add to Cart Fluid Width', 'uncode-core')
					) ,
					array(
						'auto-w-atc',
						esc_html__('Add to Cart Auto Width', 'uncode-core')
					)
				),
				array(
					array(
						'atc-typo-default',
						esc_html__('Add to Cart Default Typography', 'uncode-core')
					) ,
					array(
						'atc-typo-column',
						esc_html__('Add to Cart Column Typography', 'uncode-core')
					) ,
				),
				array(
					array(
						'show-atc',
						esc_html__('Show Add to Cart', 'uncode-core')
					) ,
					array(
						'hide-atc',
						esc_html__('Hide Add to Cart', 'uncode-core')
					) ,
				)
			) ,
			array(
				'title',
				esc_html__('Title', 'uncode-core') ,
			) ,
			array(
				'type',
				esc_html__('Post Type', 'uncode-core') ,
			) ,
			array(
				'category',
				esc_html__('Category', 'uncode-core') ,
				array(
					array(
						'inline',
						esc_html__('Inline', 'uncode-core'),
					) ,
					array(
						'block',
						esc_html__('Block', 'uncode-core'),
					),
				),
			) ,
			array(
				'text',
				esc_html__('Text', 'uncode-core') ,
				array(
					array(
						'excerpt',
						esc_html__('Excerpt', 'uncode-core')
					) ,
					array(
						'full',
						esc_html__('Full content', 'uncode-core')
					) ,
				)
			) ,
			array(
				'link',
				esc_html__('Button', 'uncode-core'),
				array(
					array(
						'default',
						esc_html__('Inherit', 'uncode-core')
					) ,
					array(
						'default-shape',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'round',
						esc_html__('Round', 'uncode-core')
					) ,
					array(
						'circle',
						esc_html__('Circle', 'uncode-core')
					) ,
					array(
						'square',
						esc_html__('Square', 'uncode-core')
					) ,
					array(
						'link',
						esc_html__('Standard link', 'uncode-core')
					)
				),
				array(
					array(
						'default_size',
						esc_html__('Default size', 'uncode-core')
					) ,
					array(
						'small_size',
						esc_html__('Small size', 'uncode-core')
					) ,
					array(
						'large_size',
						esc_html__('Large size', 'uncode-core')
					) ,
				),
				array(
					array(
						'scale_mobile',
						esc_html__('Scale on mobile', 'uncode-core')
					) ,
					array(
						'not_scale_mobile',
						esc_html__('Not scale on mobile', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_width',
						esc_html__('Default width', 'uncode-core')
					) ,
					array(
						'fluid_width',
						esc_html__('Fluid width', 'uncode-core')
					) ,
				),
				array(
					array(
						'default_outline',
						esc_html__('Default style', 'uncode-core')
					) ,
					array(
						'outline_inverse',
						esc_html__('Outline style', 'uncode-core')
					) ,
				),
			) ,
			array(
				'add_to_cart',
				esc_html__('Add to Cart', 'uncode-core'),
				array(
					array(
						'default',
						esc_html__('Inherit', 'uncode-core')
					) ,
					array(
						'default-shape',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'round',
						esc_html__('Round', 'uncode-core')
					) ,
					array(
						'circle',
						esc_html__('Circle', 'uncode-core')
					) ,
					array(
						'square',
						esc_html__('Square', 'uncode-core')
					) ,
					array(
						'link',
						esc_html__('Standard link', 'uncode-core')
					)
				),
				array(
					array(
						'default_size',
						esc_html__('Default size', 'uncode-core')
					) ,
					array(
						'small_size',
						esc_html__('Small size', 'uncode-core')
					) ,
					array(
						'large_size',
						esc_html__('Large size', 'uncode-core')
					) ,
				),
			) ,
			array(
				'price',
				esc_html__('Price', 'uncode-core') ,
				array(
					array(
						'default',
						esc_html__('Default layout', 'uncode-core'),
					) ,
					array(
						'inline',
						esc_html__('Inline price', 'uncode-core'),
					),
				),
			) ,
			array(
				'stars',
				esc_html__('Stars', 'uncode-core') ,
			) ,
			array(
				'icon',
				esc_html__('Icon', 'uncode-core') ,
				array(
					array(
						'df',
						esc_html__('Default', 'uncode-core')
					) ,
					array(
						'sm',
						esc_html__('Small', 'uncode-core')
					) ,
					array(
						'md',
						esc_html__('Medium', 'uncode-core')
					) ,
					array(
						'lg',
						esc_html__('Large', 'uncode-core')
					),
					array(
						'xl',
						esc_html__('Extra Large', 'uncode-core')
					)
				) ,
			) ,
			array(
				'spacer',
				esc_html__('Spacer One', 'uncode-core') ,
				array(
					array(
						'half',
						esc_html__('0.5x', 'uncode-core')
					) ,
					array(
						'one',
						esc_html__('1x', 'uncode-core')
					) ,
					array(
						'two',
						esc_html__('2x', 'uncode-core')
					)
				)
			) ,
			array(
				'col-one',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-two',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-three',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-four',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-five',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
			array(
				'col-six',
				esc_html__('Column', 'uncode-core') ,
				array(
					array(
						'1',
						esc_html__('1/12', 'uncode-core')
					),
					array(
						'2',
						esc_html__('2/12', 'uncode-core')
					),
					array(
						'3',
						esc_html__('3/12', 'uncode-core')
					),
					array(
						'4',
						esc_html__('4/12', 'uncode-core')
					),
					array(
						'5',
						esc_html__('5/12', 'uncode-core')
					),
					array(
						'6',
						esc_html__('6/12', 'uncode-core')
					),
					array(
						'7',
						esc_html__('7/12', 'uncode-core')
					),
					array(
						'8',
						esc_html__('8/12', 'uncode-core')
					),
					array(
						'9',
						esc_html__('9/12', 'uncode-core')
					),
					array(
						'10',
						esc_html__('10/12', 'uncode-core')
					),
					array(
						'11',
						esc_html__('11/12', 'uncode-core')
					),
					array(
						'12',
						esc_html__('12/12', 'uncode-core')
					),
				)
			) ,
		),
	)
);

$get_post_custom_fields = (function_exists('ot_get_option')) ? ot_get_option('_uncode_post_custom_fields') : array();
if (isset($get_post_custom_fields) && !empty($get_post_custom_fields))
{
	foreach ($get_post_custom_fields as $field_key => $field)
	{
		$uncode_post_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
		$uncode_post_table_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
	}
}

$get_page_custom_fields = (function_exists('ot_get_option')) ? ot_get_option('_uncode_page_custom_fields') : array();
if (isset($get_page_custom_fields) && !empty($get_page_custom_fields))
{
	foreach ($get_page_custom_fields as $field_key => $field)
	{
		$uncode_page_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
		$uncode_page_table_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
	}
}

$get_product_custom_fields = (function_exists('ot_get_option')) ? ot_get_option('_uncode_product_custom_fields') : array();
if (isset($get_product_custom_fields) && !empty($get_product_custom_fields))
{
	foreach ($get_product_custom_fields as $field_key => $field)
	{
		$uncode_product_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
		$uncode_product_table_list['options'][] = array($field['_uncode_cf_unique_id'], $field['title']);
	}
}

$custom_grid_content_block_id = uncode_core_vc_params_get_cb_dropdown(
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Content Block', 'uncode-core') ,
		'param_name' => 'custom_grid_content_block_id',
		'description' => esc_html__('Choose a Content Block.', 'uncode-core'),
		'group' => esc_html__('General', 'uncode-core') ,
		'value' => array(),
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'custom_grid',
		)
	)
);

$widgetized_content_block_id = uncode_core_vc_params_get_cb_dropdown(
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Widgets Content Block', 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		'param_name' => 'widgetized_content_block_id',
		'description' => esc_html__('Choose a Content Block.', 'uncode-core'),
		'group' => esc_html__('Filters', 'uncode-core') ,
		'value' => array(),
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'show_widgetized_content_block',
			'value' => 'yes',
		)
	)
);

$ajax_filters_content_block_id = uncode_core_vc_params_get_cb_dropdown(
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Ajax Filters', 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		'param_name' => 'ajax_filters_content_block_id',
		'description' => esc_html__('Choose a Content Block.', 'uncode-core'),
		'group' => esc_html__('Filters', 'uncode-core') ,
		'value' => array(),
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'ajax',
		) ,
	)
);
$ajax_filters_content_block_id['value'] = array(esc_html__('None', 'uncode-core') => '') + $ajax_filters_content_block_id['value'];

$special_auto_queries = array(
	esc_html__('Default', 'uncode-core') => '',
	esc_html__('Related', 'uncode-core') => 'related',
	esc_html__('Navigation', 'uncode-core') => 'navigation',
);

if ( class_exists( 'WooCommerce' ) ) {
	$special_auto_queries[ esc_html__( 'Up-Sells', 'uncode-core' ) ] = 'up-sells-products';
}

$uncode_taxonomy_sorted_list = array(
	'type' => 'sorted_list',
	'heading' => esc_html__('Taxonomy Elements', 'uncode-core') ,
	'param_name' => 'uncode_taxonomy_items',
	'description' => esc_html__('Enable or disable elements and place them in desired order. NB. The Category (when it has a non-relative position) and Icon elements cannot be dragged.', 'uncode-core') ,
	'value' => 'media|featured|onpost|original,title,count|nobg|relative|hide-label',
	'group' => esc_html__('Module', 'uncode-core') ,
	'options' => array(
		array(
			'media',
			esc_html__('Media', 'uncode-core') ,
			array(
				array(
					'featured',
					esc_html__('Featured Image', 'uncode-core')
				) ,
				array(
					'secondary',
					esc_html__('Secondary Featured Image', 'uncode-core')
				) ,
			) ,
			array(
				array(
					'onpost',
					esc_html__('Link to post', 'uncode-core')
				) ,
				array(
					'lightbox',
					esc_html__('Lightbox', 'uncode-core')
				) ,
				array(
					'nolink',
					esc_html__('No link', 'uncode-core')
				)
			) ,
			array(
				array(
					'original',
					esc_html__('Original', 'uncode-core')
				) ,
				array(
					'poster',
					esc_html__('Poster', 'uncode-core')
				)
			)
		) ,
		array(
			'title',
			esc_html__('Title', 'uncode-core') ,
		) ,
		array(
			'text',
			esc_html__('Description', 'uncode-core') ,
		) ,
		array(
			'count',
			esc_html__('Count', 'uncode-core') ,
			array(
				array(
					'nobg',
					esc_html__('Default', 'uncode-core'),
				) ,
				array(
					'yesbg',
					esc_html__('Colored text', 'uncode-core'),
				),
				array(
					'bordered',
					esc_html__('Bordered', 'uncode-core'),
				),
				array(
					'colorbg',
					esc_html__('Colored background', 'uncode-core')
				),
				array(
					'transparentbg',
					esc_html__('Transparent background', 'uncode-core')
				),
			),
			array(
				array(
					'relative',
					esc_html__('Relative position', 'uncode-core'),
				) ,
				array(
					'inline',
					esc_html__('Next to title', 'uncode-core'),
				),
				array(
					'topleft',
					esc_html__('Over the image, on top left', 'uncode-core'),
				),
				array(
					'topright',
					esc_html__('Over the image, on top right', 'uncode-core'),
				),
				array(
					'bottomleft',
					esc_html__('Over the image, on bottom left', 'uncode-core'),
				),
				array(
					'bottomright',
					esc_html__('Over the image, on bottom right', 'uncode-core'),
				),
			),
			array(
				array(
					'hide-label',
					esc_html__('Hide tax label', 'uncode-core')
				) ,
				array(
					'show-label',
					esc_html__('Display tax label', 'uncode-core')
				) ,
			)
		) ,
		array(
			'link',
			esc_html__('Button', 'uncode-core'),
			array(
				array(
					'default',
					esc_html__('Inherit', 'uncode-core')
				) ,
				array(
					'default-shape',
					esc_html__('Default', 'uncode-core')
				) ,
				array(
					'round',
					esc_html__('Round', 'uncode-core')
				) ,
				array(
					'circle',
					esc_html__('Circle', 'uncode-core')
				) ,
				array(
					'square',
					esc_html__('Square', 'uncode-core')
				) ,
				array(
					'link',
					esc_html__('Standard link', 'uncode-core')
				)
			),
			array(
				array(
					'default_size',
					esc_html__('Default size', 'uncode-core')
				) ,
				array(
					'small_size',
					esc_html__('Small size', 'uncode-core')
				) ,
				array(
					'large_size',
					esc_html__('Large size', 'uncode-core')
				) ,
			),
			array(
				array(
					'scale_mobile',
					esc_html__('Scale on mobile', 'uncode-core')
				) ,
				array(
					'not_scale_mobile',
					esc_html__('Not scale on mobile', 'uncode-core')
				) ,
			),
			array(
				array(
					'default_width',
					esc_html__('Default width', 'uncode-core')
				) ,
				array(
					'fluid_width',
					esc_html__('Fluid width', 'uncode-core')
				) ,
			),
			array(
				array(
					'default_outline',
					esc_html__('Default style', 'uncode-core')
				) ,
				array(
					'outline_inverse',
					esc_html__('Outline style', 'uncode-core')
				) ,
			),
		) ,
		array(
			'icon',
			esc_html__('Icon', 'uncode-core') ,
			array(
				array(
					'sm',
					esc_html__('Small', 'uncode-core')
				) ,
				array(
					'md',
					esc_html__('Medium', 'uncode-core')
				) ,
				array(
					'lg',
					esc_html__('Large', 'uncode-core')
				),
				array(
					'xl',
					esc_html__('Extra Large', 'uncode-core')
				)
			) ,
		) ,
		array(
			'spacer',
			esc_html__('Spacer One', 'uncode-core') ,
			array(
				array(
					'half',
					esc_html__('0.5x', 'uncode-core')
				) ,
				array(
					'one',
					esc_html__('1x', 'uncode-core')
				) ,
				array(
					'two',
					esc_html__('2x', 'uncode-core')
				)
			)
		) ,
		array(
			'spacer_two',
			esc_html__('Spacer Two', 'uncode-core') ,
			array(
				array(
					'half',
					esc_html__('0.5x', 'uncode-core')
				) ,
				array(
					'one',
					esc_html__('1x', 'uncode-core')
				) ,
				array(
					'two',
					esc_html__('2x', 'uncode-core')
				)
			)
		) ,
		array(
			'sep-one',
			esc_html__('Separator One', 'uncode-core') ,
			array(
				array(
					'full',
					esc_html__('Full width', 'uncode-core')
				) ,
				array(
					'reduced',
					esc_html__('Reduced width', 'uncode-core')
				),
				array(
					'extra',
					esc_html__('Extra full width', 'uncode-core')
				)
			)
		) ,
		array(
			'sep-two',
			esc_html__('Separator Two', 'uncode-core') ,
			array(
				array(
					'full',
					esc_html__('Full width', 'uncode-core')
				) ,
				array(
					'reduced',
					esc_html__('Reduced width', 'uncode-core')
				),
				array(
					'extra',
					esc_html__('Extra full width', 'uncode-core')
				)
			)
		) ,
	)
);

$uncode_taxonomy_sorted_table_list = array(
	'type' => 'sorted_list',
	'heading' => esc_html__('Taxonomy Elements', 'uncode-core') ,
	'param_name' => 'uncode_taxonomy_table_items',
	'description' => esc_html__('Enable or disable elements and place them in desired order.', 'uncode-core') ,
	'value' => 'col-one|1,media|featured|onpost|original,col-two|6,title,col-three|3,text|120,col-four|2,count|nobg|relative|hide-label,link|default|default_size',
	'group' => esc_html__('Module', 'uncode-core') ,
	'options' => array(
		array(
			'media',
			esc_html__('Media', 'uncode-core') ,
			array(
				array(
					'featured',
					esc_html__('Featured Image', 'uncode-core')
				) ,
				array(
					'secondary',
					esc_html__('Secondary Featured Image', 'uncode-core')
				) ,
			) ,
			array(
				array(
					'onpost',
					esc_html__('Link to post', 'uncode-core')
				) ,
				array(
					'lightbox',
					esc_html__('Lightbox', 'uncode-core')
				) ,
				array(
					'nolink',
					esc_html__('No link', 'uncode-core')
				)
			) ,
			array(
				array(
					'original',
					esc_html__('Original', 'uncode-core')
				) ,
				array(
					'poster',
					esc_html__('Poster', 'uncode-core')
				)
			)
		) ,
		array(
			'title',
			esc_html__('Title', 'uncode-core') ,
		) ,
		array(
			'text',
			esc_html__('Description', 'uncode-core') ,
		) ,
		array(
			'count',
			esc_html__('Count', 'uncode-core') ,
			array(
				array(
					'nobg',
					esc_html__('Default', 'uncode-core'),
				) ,
				array(
					'yesbg',
					esc_html__('Colored text', 'uncode-core'),
				),
				array(
					'bordered',
					esc_html__('Bordered', 'uncode-core'),
				),
				array(
					'colorbg',
					esc_html__('Colored background', 'uncode-core')
				),
				array(
					'transparentbg',
					esc_html__('Transparent background', 'uncode-core')
				),
			),
			array(
				array(
					'relative',
					esc_html__('Relative position', 'uncode-core'),
				) ,
				array(
					'topleft',
					esc_html__('Over the image, on top left', 'uncode-core'),
				),
				array(
					'topright',
					esc_html__('Over the image, on top right', 'uncode-core'),
				),
				array(
					'bottomleft',
					esc_html__('Over the image, on bottom left', 'uncode-core'),
				),
				array(
					'bottomright',
					esc_html__('Over the image, on bottom right', 'uncode-core'),
				),
			),
			array(
				array(
					'hide-label',
					esc_html__('Hide tax label', 'uncode-core')
				) ,
				array(
					'show-label',
					esc_html__('Display tax label', 'uncode-core')
				) ,
			)
		) ,
		array(
			'link',
			esc_html__('Button', 'uncode-core'),
			array(
				array(
					'default',
					esc_html__('Inherit', 'uncode-core')
				) ,
				array(
					'default-shape',
					esc_html__('Default', 'uncode-core')
				) ,
				array(
					'round',
					esc_html__('Round', 'uncode-core')
				) ,
				array(
					'circle',
					esc_html__('Circle', 'uncode-core')
				) ,
				array(
					'square',
					esc_html__('Square', 'uncode-core')
				) ,
				array(
					'link',
					esc_html__('Standard link', 'uncode-core')
				)
			),
			array(
				array(
					'default_size',
					esc_html__('Default size', 'uncode-core')
				) ,
				array(
					'small_size',
					esc_html__('Small size', 'uncode-core')
				) ,
				array(
					'large_size',
					esc_html__('Large size', 'uncode-core')
				) ,
			),
			array(
				array(
					'scale_mobile',
					esc_html__('Scale on mobile', 'uncode-core')
				) ,
				array(
					'not_scale_mobile',
					esc_html__('Not scale on mobile', 'uncode-core')
				) ,
			),
			array(
				array(
					'default_width',
					esc_html__('Default width', 'uncode-core')
				) ,
				array(
					'fluid_width',
					esc_html__('Fluid width', 'uncode-core')
				) ,
			),
			array(
				array(
					'default_outline',
					esc_html__('Default style', 'uncode-core')
				) ,
				array(
					'outline_inverse',
					esc_html__('Outline style', 'uncode-core')
				) ,
			),
		) ,
		array(
			'icon',
			esc_html__('Icon', 'uncode-core') ,
			array(
				array(
					'df',
					esc_html__('Default', 'uncode-core')
				) ,
				array(
					'sm',
					esc_html__('Small', 'uncode-core')
				) ,
				array(
					'md',
					esc_html__('Medium', 'uncode-core')
				) ,
				array(
					'lg',
					esc_html__('Large', 'uncode-core')
				),
				array(
					'xl',
					esc_html__('Extra Large', 'uncode-core')
				)
			) ,
		) ,
		array(
			'spacer',
			esc_html__('Spacer One', 'uncode-core') ,
			array(
				array(
					'half',
					esc_html__('0.5x', 'uncode-core')
				) ,
				array(
					'one',
					esc_html__('1x', 'uncode-core')
				) ,
				array(
					'two',
					esc_html__('2x', 'uncode-core')
				)
			)
		) ,
		array(
			'spacer_two',
			esc_html__('Spacer Two', 'uncode-core') ,
			array(
				array(
					'half',
					esc_html__('0.5x', 'uncode-core')
				) ,
				array(
					'one',
					esc_html__('1x', 'uncode-core')
				) ,
				array(
					'two',
					esc_html__('2x', 'uncode-core')
				)
			)
		) ,
		array(
			'col-one',
			esc_html__('Column', 'uncode-core') ,
			array(
				array(
					'1',
					esc_html__('1/12', 'uncode-core')
				),
				array(
					'2',
					esc_html__('2/12', 'uncode-core')
				),
				array(
					'3',
					esc_html__('3/12', 'uncode-core')
				),
				array(
					'4',
					esc_html__('4/12', 'uncode-core')
				),
				array(
					'5',
					esc_html__('5/12', 'uncode-core')
				),
				array(
					'6',
					esc_html__('6/12', 'uncode-core')
				),
				array(
					'7',
					esc_html__('7/12', 'uncode-core')
				),
				array(
					'8',
					esc_html__('8/12', 'uncode-core')
				),
				array(
					'9',
					esc_html__('9/12', 'uncode-core')
				),
				array(
					'10',
					esc_html__('10/12', 'uncode-core')
				),
				array(
					'11',
					esc_html__('11/12', 'uncode-core')
				),
				array(
					'12',
					esc_html__('12/12', 'uncode-core')
				),
			)
		) ,
		array(
			'col-two',
			esc_html__('Column', 'uncode-core') ,
			array(
				array(
					'1',
					esc_html__('1/12', 'uncode-core')
				),
				array(
					'2',
					esc_html__('2/12', 'uncode-core')
				),
				array(
					'3',
					esc_html__('3/12', 'uncode-core')
				),
				array(
					'4',
					esc_html__('4/12', 'uncode-core')
				),
				array(
					'5',
					esc_html__('5/12', 'uncode-core')
				),
				array(
					'6',
					esc_html__('6/12', 'uncode-core')
				),
				array(
					'7',
					esc_html__('7/12', 'uncode-core')
				),
				array(
					'8',
					esc_html__('8/12', 'uncode-core')
				),
				array(
					'9',
					esc_html__('9/12', 'uncode-core')
				),
				array(
					'10',
					esc_html__('10/12', 'uncode-core')
				),
				array(
					'11',
					esc_html__('11/12', 'uncode-core')
				),
				array(
					'12',
					esc_html__('12/12', 'uncode-core')
				),
			)
		) ,
		array(
			'col-three',
			esc_html__('Column', 'uncode-core') ,
			array(
				array(
					'1',
					esc_html__('1/12', 'uncode-core')
				),
				array(
					'2',
					esc_html__('2/12', 'uncode-core')
				),
				array(
					'3',
					esc_html__('3/12', 'uncode-core')
				),
				array(
					'4',
					esc_html__('4/12', 'uncode-core')
				),
				array(
					'5',
					esc_html__('5/12', 'uncode-core')
				),
				array(
					'6',
					esc_html__('6/12', 'uncode-core')
				),
				array(
					'7',
					esc_html__('7/12', 'uncode-core')
				),
				array(
					'8',
					esc_html__('8/12', 'uncode-core')
				),
				array(
					'9',
					esc_html__('9/12', 'uncode-core')
				),
				array(
					'10',
					esc_html__('10/12', 'uncode-core')
				),
				array(
					'11',
					esc_html__('11/12', 'uncode-core')
				),
				array(
					'12',
					esc_html__('12/12', 'uncode-core')
				),
			)
		) ,
		array(
			'col-four',
			esc_html__('Column', 'uncode-core') ,
			array(
				array(
					'1',
					esc_html__('1/12', 'uncode-core')
				),
				array(
					'2',
					esc_html__('2/12', 'uncode-core')
				),
				array(
					'3',
					esc_html__('3/12', 'uncode-core')
				),
				array(
					'4',
					esc_html__('4/12', 'uncode-core')
				),
				array(
					'5',
					esc_html__('5/12', 'uncode-core')
				),
				array(
					'6',
					esc_html__('6/12', 'uncode-core')
				),
				array(
					'7',
					esc_html__('7/12', 'uncode-core')
				),
				array(
					'8',
					esc_html__('8/12', 'uncode-core')
				),
				array(
					'9',
					esc_html__('9/12', 'uncode-core')
				),
				array(
					'10',
					esc_html__('10/12', 'uncode-core')
				),
				array(
					'11',
					esc_html__('11/12', 'uncode-core')
				),
				array(
					'12',
					esc_html__('12/12', 'uncode-core')
				),
			)
		) ,
		array(
			'col-five',
			esc_html__('Column', 'uncode-core') ,
			array(
				array(
					'1',
					esc_html__('1/12', 'uncode-core')
				),
				array(
					'2',
					esc_html__('2/12', 'uncode-core')
				),
				array(
					'3',
					esc_html__('3/12', 'uncode-core')
				),
				array(
					'4',
					esc_html__('4/12', 'uncode-core')
				),
				array(
					'5',
					esc_html__('5/12', 'uncode-core')
				),
				array(
					'6',
					esc_html__('6/12', 'uncode-core')
				),
				array(
					'7',
					esc_html__('7/12', 'uncode-core')
				),
				array(
					'8',
					esc_html__('8/12', 'uncode-core')
				),
				array(
					'9',
					esc_html__('9/12', 'uncode-core')
				),
				array(
					'10',
					esc_html__('10/12', 'uncode-core')
				),
				array(
					'11',
					esc_html__('11/12', 'uncode-core')
				),
				array(
					'12',
					esc_html__('12/12', 'uncode-core')
				),
			)
		) ,
		array(
			'col-six',
			esc_html__('Column', 'uncode-core') ,
			array(
				array(
					'1',
					esc_html__('1/12', 'uncode-core')
				),
				array(
					'2',
					esc_html__('2/12', 'uncode-core')
				),
				array(
					'3',
					esc_html__('3/12', 'uncode-core')
				),
				array(
					'4',
					esc_html__('4/12', 'uncode-core')
				),
				array(
					'5',
					esc_html__('5/12', 'uncode-core')
				),
				array(
					'6',
					esc_html__('6/12', 'uncode-core')
				),
				array(
					'7',
					esc_html__('7/12', 'uncode-core')
				),
				array(
					'8',
					esc_html__('8/12', 'uncode-core')
				),
				array(
					'9',
					esc_html__('9/12', 'uncode-core')
				),
				array(
					'10',
					esc_html__('10/12', 'uncode-core')
				),
				array(
					'11',
					esc_html__('11/12', 'uncode-core')
				),
				array(
					'12',
					esc_html__('12/12', 'uncode-core')
				),
			)
		) ,
	)
);

$uncode_post_list['dependency'] = array(
	'element' => 'index_type',
	'value' => array(
		'isotope',
		'carousel',
		'css_grid',
		'custom_grid',
		'sticky-scroll',
		'linear',
	)
);
$uncode_post_table_list['dependency'] = array(
	'element' => 'index_type',
	'value' => array(
		'table',
	)
);
$uncode_page_list['dependency'] = array(
	'element' => 'index_type',
	'value' => array(
		'isotope',
		'carousel',
		'css_grid',
		'custom_grid',
		'sticky-scroll',
		'linear',
	)
);
$uncode_page_table_list['dependency'] = array(
	'element' => 'index_type',
	'value' => array(
		'table',
	)
);
$uncode_product_list['dependency'] = array(
	'element' => 'index_type',
	'value' => array(
		'isotope',
		'carousel',
		'css_grid',
		'custom_grid',
		'sticky-scroll',
		'linear',
	)
);
$uncode_product_table_list['dependency'] = array(
	'element' => 'index_type',
	'value' => array(
		'table',
	)
);
$uncode_taxonomy_sorted_list['dependency'] = array(
	'element' => 'index_type',
	'value' => array(
		'isotope',
		'carousel',
		'css_grid',
		'custom_grid',
		'sticky-scroll',
		'linear',
	)
);
$uncode_taxonomy_sorted_table_list['dependency'] = array(
	'element' => 'index_type',
	'value' => array(
		'table',
	)
);

$uncode_index_params_general = array(
	array(
		'type' => 'uncode_shortcode_id',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'uncode_shortcode_id',
		'description' => '' ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Unique ID', 'uncode-core') ,
		'param_name' => 'el_id',
		'value' => (function_exists('uncode_big_rand')) ? uncode_big_rand() : rand(),
		'description' => esc_html__('This value has to be unique for each module of the same page.', 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Layout", 'uncode-core') ,
		"param_name" => "index_type",
		'admin_label' => true,
		"description" => esc_html__("Specify the layout mode: Grid or Carousel.", 'uncode-core') ,
		"value" => array(
			esc_html__('Grid', 'uncode-core') => 'isotope',
			esc_html__('CSS Grid', 'uncode-core') => 'css_grid',
			esc_html__('Carousel', 'uncode-core') => 'carousel',
			esc_html__('Titles', 'uncode-core') => 'titles',
			esc_html__('Table', 'uncode-core') => 'table',
			esc_html__('Pattern', 'uncode-core') => 'custom_grid',
			esc_html__('Sticky Scroll', 'uncode-core') => 'sticky-scroll',
			esc_html__('Marquee', 'uncode-core') => 'linear',
		) ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Direction', 'uncode-core') ,
		'param_name' => 'sticky_dir',
		'value' => array(
			esc_html__('Left to Right', 'uncode-core') => '',
			esc_html__('Right to Left', 'uncode-core') => 'left',
		) ,
		'description' => esc_html__('Set the direction of the Sticky Scroll elements.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'sticky-scroll',
			) ,
		) ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Wrap level', 'uncode-core') ,
		'param_name' => 'sticky_wrap',
		'value' => array(
			esc_html__('Row', 'uncode-core') => '',
			esc_html__('Column', 'uncode-core') => 'column',
		) ,
		'description' => esc_html__('Set the wrapper of the Sticky Scroll. If you insert other elements within the same Row that get stuck, use \'Column\', alternatively \'Row\'.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'sticky-scroll',
			) ,
		) ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Layout mode', 'uncode-core') ,
		'param_name' => 'isotope_mode',
		"description" => wp_kses(__("Specify the layout mode: Isotope Grid or Carousel. <a href='http://isotope.metafizzy.co/layout-modes.html' target='_blank'>Check this for reference</a>", 'uncode-core'), array( 'a' => array( 'href' => array( ),'target' => array( ) ) ) ) ,
		"value" => array(
			esc_html__('Masonry', 'uncode-core') => 'masonry',
			esc_html__('Fit Rows', 'uncode-core') => 'fitRows',
			esc_html__('Cells by Row', 'uncode-core') => 'cellsByRow',
			esc_html__('Vertical', 'uncode-core') => 'vertical',
			esc_html__('Packery', 'uncode-core') => 'packery',
		) ,
		'group' => esc_html__('General', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
	) ,
	$custom_grid_content_block_id,
	array(
		'type' => 'loop',
		'heading' => esc_html__('Query options', 'uncode-core') ,
		'param_name' => 'loop',
		'admin_label' => true,
		'settings' => array(
			'size' => array(
				'hidden' => false,
				'value' => 10
			) ,
			'order_by' => array(
				'value' => 'date'
			) ,
		) ,
		'value' => 'size:10|order_by:date|post_type:post',
		'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Post Offset', 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		'param_name' => 'offset',
		'admin_label' => true,
		'description' => esc_html__('Enter the amount of posts that should be skipped in the beginning of the query. NB: please note that it\'s not possible to use it with the Filtering if combined also with the Pagination mode.', 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core')
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dynamic query", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "auto_query",
		"description" => esc_html__("Use the WordPress native query for a given context as Content Block for categories, taxonomies, tags, search results, and authors. NB. Note that when you enable this option, the default WordPress query for a specific type of page is used, and the options of the Build Query tab may not taken into account.", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Dynamic query type", 'uncode-core') ,
		"param_name" => "auto_query_type",
		"description" => esc_html__("Select the type of query. NB. Navigation works with Grid, CSS Grid and Titles only.", 'uncode-core') ,
		'group' => esc_html__('General', 'uncode-core') ,
		"value" => $special_auto_queries ,
		'dependency' => array(
			'element' => 'auto_query',
			'not_empty' => true,
		) ,
	) ,
);

if ( class_exists( 'WooCommerce' ) && ot_get_option( '_uncode_woocommerce_enable_single_variations' ) === 'on' ) {
	$uncode_index_params_single_variations = array(
		"type" => 'checkbox',
		"heading" => esc_html__("Variations Single Products", 'uncode-core') ,
		"param_name" => "woo_single_variations",
		'uncode_wrapper_class' => 'woo-single-variations-field',
		'group' => esc_html__('General', 'uncode-core') ,
		"description" => esc_html__("Activate this to have your product variations available as single products in the shop, category & search results when using the Posts module. NB. Please also activate the dedicated option in the Theme Options. Not compatible with “Selective Elements” when excluding attributes from Theme Options.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
	);

	$uncode_index_params_general[] = $uncode_index_params_single_variations;

	if ( apply_filters( 'uncode_woocommerce_enable_single_variations_hide_parent', false ) ) {
		$uncode_index_params_single_variations_hide_parent = array(
			"type" => 'checkbox',
			"heading" => esc_html__("Hide Parent Products", 'uncode-core') ,
			"param_name" => "woo_single_variations_hide_parent",
			'uncode_wrapper_class' => 'woo-single-variations-field',
			'group' => esc_html__('General', 'uncode-core') ,
			"description" => esc_html__("Enable this option to hide the parent products.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			'dependency' => array(
				'element' => 'woo_single_variations',
				'not_empty' => true,
			) ,
		);

		$uncode_index_params_general[] = $uncode_index_params_single_variations_hide_parent;
	}
}

$uncode_index_params_first = array(
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Items', 'uncode-core') ,
		'param_name' => 'grid_items',
		'description' => esc_html__('Specify the number of columns for this breakpoint.', 'uncode-core') ,
		"std" => '4',
		"value" => array(
				esc_html__('1 Column', 'uncode-core') => '1',
				esc_html__('2 Columns', 'uncode-core') => '2',
				esc_html__('3 Columns', 'uncode-core') => '3',
				esc_html__('4 Columns', 'uncode-core') => '4',
				esc_html__('5 Columns', 'uncode-core') => '5',
				esc_html__('6 Columns', 'uncode-core') => '6',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'css_grid',
		) ,
	) ,
	$add_breakpoint_lg_cols,
	$add_breakpoint_lg_screen,
	$add_breakpoint_md_cols,
	$add_breakpoint_md_screen,
	$add_breakpoint_sm_cols,
	$add_breakpoint_sm_screen,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Layout style", 'uncode-core') ,
		"param_name" => "style_preset",
		"description" => esc_html__("Select the visualization mode.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => 'masonry',
			esc_html__('Metro', 'uncode-core') => 'metro',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Fluid heights", 'uncode-core') ,
		"param_name" => "single_height_viewport",
		"description" => esc_html__("Activate this to set heights relative to the browser window height, instead of using the normal metro calculations.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'style_preset',
			'value' => 'metro',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Remove menu height", 'uncode-core') ,
		"param_name" => "single_height_viewport_minus",
		"description" => esc_html__("Activate this option to remove the menu height from the fluid calculations.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_height_viewport',
			'not_empty' => true,
		) ,
	) ,
	$add_index_back_color_type,
	$add_index_back_color,
	$add_index_back_color_solid,
	$add_index_back_color_gradient,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Desktop', 'uncode-core') ,
		'param_name' => 'carousel_lg',
		'value' => 3,
		'description' => esc_html__('Insert the numbers of items for the viewport from 960px.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel'
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Tablet', 'uncode-core') ,
		'param_name' => 'carousel_md',
		'value' => 3,
		'description' => esc_html__('Insert the numbers of items for the viewport from 570px to 960px.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel'
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Device', 'uncode-core') ,
		'param_name' => 'carousel_sm',
		'value' => 1,
		'description' => esc_html__('Insert the numbers of items for the viewport from 0 to 570px.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel'
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'thumb_size',
		'description' => esc_html__('Specify the aspect ratio for the media. Please note that if you use \'Fluid\', or \'Relative\', it\'s necessary to set a Row height value on the Row container settings.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
				'1:1' => 'one-one',
				'2:1' => 'two-one',
				'3:2' => 'three-two',
				'4:3' => 'four-three',
				'5:4' => 'five-four',
				'10:3' => 'ten-three',
				'16:9' => 'sixteen-nine',
				'21:9' => 'twentyone-nine',
				'1:2' => 'one-two',
				'2:3' => 'two-three',
				'3:4' => 'three-four',
				'4:5' => 'four-five',
				'3:10' => 'three-ten',
				'9:16' => 'nine-sixteen',
				esc_html__('Fluid', 'uncode-core') => 'fluid',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'sticky_thumb_size',
		'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
				'1:1' => 'one-one',
				'2:1' => 'two-one',
				'3:2' => 'three-two',
				'4:3' => 'four-three',
				'5:4' => 'five-four',
				'10:3' => 'ten-three',
				'16:9' => 'sixteen-nine',
				'21:9' => 'twentyone-nine',
				'1:2' => 'one-two',
				'2:3' => 'two-three',
				'3:4' => 'three-four',
				'4:5' => 'four-five',
				'3:10' => 'three-ten',
				'9:16' => 'nine-sixteen',
				esc_html__('Fluid', 'uncode-core') => 'fluid',
				esc_html__('Relative', 'uncode-core') => 'relative',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('sticky-scroll')
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Fluid height", 'uncode-core') ,
		"param_name" => "carousel_height_viewport",
		"description" => esc_html__("Specify the carousel height relative to the browser window.", 'uncode-core') ,
		"min" => 0,
		"max" => 100,
		"step" => 1,
		"value" => 0,
		"std" => "100",
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'thumb_size',
			'value' => 'fluid',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Remove menu height", 'uncode-core') ,
		"param_name" => "carousel_height_viewport_minus",
		"description" => esc_html__("Activate this option to remove the menu height from the fluid calculations.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'thumb_size',
			'value' => 'fluid',
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Desktop', 'uncode-core') ,
		'param_name' => 'sticky_th_grid_lg',
		'value' => 3,
		'description' => esc_html__('Insert the numbers of items for the viewport from 960px.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value_not_equal_to' => array(
				'relative',
			) ,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Tablet', 'uncode-core') ,
		'param_name' => 'sticky_th_grid_md',
		'value' => 3,
		'description' => esc_html__('Insert the numbers of items for the viewport from 570px to 960px. NB. If you disable it on tablets, it will automatically set to 1.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value_not_equal_to' => array(
				'relative',
			) ,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Items Device', 'uncode-core') ,
		'param_name' => 'sticky_th_grid_sm',
		'value' => 1,
		'description' => esc_html__('Insert the numbers of items for the viewport from 0 to 570px. NB. If you disable it on devices, it will automatically set to 1.', 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value_not_equal_to' => array(
				'relative',
			) ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Height Desktop", 'uncode-core') ,
		"param_name" => "sticky_th_vh_lg",
		"min" => 0,
		"max" => 100,
		"step" => 1,
		"value" => 100,
		"description" => esc_html__("Sets the height of the elements to Desktop.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value' => array(
				'fluid', 'relative',
			) ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Height Tablet", 'uncode-core') ,
		"param_name" => "sticky_th_vh_md",
		"min" => 0,
		"max" => 100,
		"step" => 1,
		"value" => 100,
		"description" => esc_html__("Sets the height of the elements to Tablet.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value' => array(
				'fluid', 'relative',
			) ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Height Device", 'uncode-core') ,
		"param_name" => "sticky_th_vh_sm",
		"min" => 0,
		"max" => 100,
		"step" => 1,
		"value" => 100,
		"description" => esc_html__("Sets the height of the elements to Device.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value' => array(
				'fluid', 'relative',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Remove menu height", 'uncode-core') ,
		"param_name" => "sticky_th_vh_minus",
		"description" => esc_html__("Activate this option to remove the menu height from the fluid calculations.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'sticky_thumb_size',
			'value' => array(
				'fluid','relative'
			) ,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Breakpoint - First step', 'uncode-core') ,
		'param_name' => 'screen_lg',
		'value' => 1000,
		'description' => wp_kses(__('Insert the isotope large layout breakpoint in pixel.<br />NB. This is referring to the width of the isotope container, not to the window width.', 'uncode-core'), array( 'br' => array( ) ) ) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Breakpoint - Second step', 'uncode-core') ,
		'param_name' => 'screen_md',
		'value' => 600,
		'description' => wp_kses(__('Insert the isotope medium layout breakpoint in pixel.<br />NB. This is referring to the width of the isotope container, not to the window width.', 'uncode-core'), array( 'br' => array( ) ) ) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Breakpoint - Third step', 'uncode-core') ,
		'param_name' => 'screen_sm',
		'value' => 480,
		'description' => wp_kses(__('Insert the isotope small layout breakpoint in pixel.<br />NB. This is referring to the width of the isotope container, not to the window width.', 'uncode-core'), array( 'br' => array( ) ) ) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	// array(
	// 	"type" => 'checkbox',
	// 	"heading" => esc_html__("Filtering", 'uncode-core') ,
	// 	'uncode_wrapper_class' => 'post-dependent-field',
	// 	"param_name" => "filtering",
	// 	"description" => esc_html__("Activate to enable the filters.", 'uncode-core') ,
	// 	"value" => Array(
	// 		esc_html__("Yes, please", 'uncode-core') => 'yes'
	// 	) ,
	// 	'group' => esc_html__('Module', 'uncode-core') ,
	// 	'dependency' => array(
	// 		'element' => 'index_type',
	// 		'value' => array( 'isotope', 'css_grid' )
	// 	) ,
	// ) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Filtering", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filtering",
		"description" => esc_html__("Activate to enable the filters.", 'uncode-core') ,
		"value" => array(
			esc_html__('No', 'uncode-core') => '',
			esc_html__('Standard', 'uncode-core') => 'yes',
			esc_html__('Ajax', 'uncode-core') => 'ajax',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Filter Skin", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_style",
		"description" => esc_html__("Specify the filter Skin color.", 'uncode-core') ,
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	$ajax_filters_content_block_id,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Layout", 'uncode-core') ,
		"param_name" => "ajax_filters_layout",
		"description" => esc_html__("Use this option to set the main layout style.", 'uncode-core') ,
		"value" => array(
			esc_html__('Sidebar', 'uncode-core') => '',
			esc_html__('Horizontal', 'uncode-core') => 'horizontal',
			esc_html__('Overlay Sidebar', 'uncode-core') => 'overlay',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'ajax',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Behavior", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filters_widgets",
		"description" => esc_html__("Set the main behavior of the module.", 'uncode-core') ,
		"value" => array(
			esc_html__('Open On Load', 'uncode-core') => '',
			esc_html__('Closed On Load', 'uncode-core') => 'closed',
			esc_html__('Always Open', 'uncode-core') => 'hidden',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => array('ajax'),
		) ,
		'dependency' => array(
			'element' => 'ajax_filters_layout',
			'value' => array('', 'horizontal'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Sidebar On Desktop", 'uncode-core') ,
		"param_name" => "ajax_filters_position",
		"description" => esc_html__("Set the position of the sidebar on desktop.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => '',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'ajax_filters_layout',
			'value' => array( '', 'overlay' )
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Sidebar On Mobile", 'uncode-core') ,
		"param_name" => "ajax_filters_position_mobile",
		"description" => esc_html__("Set the position of the sidebar on mobile devices.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => '',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'ajax',
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Sidebar Gap", 'uncode-core') ,
		"param_name" => "gutter_size_ajax_filters",
		"min" => 0,
		"max" => 4,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Set the gap between the sidebar and the module.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'ajax_filters_layout',
			'value' => array( '' ),
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Sidebar Width", 'uncode-core') ,
		"param_name" => "column_size_ajax_filters",
		"min" => 1,
		"max" => 11,
		"step" => 1,
		"std" => 3,
		"description" => esc_html__("Set the sidebar width.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'ajax_filters_layout',
			'value' => array( '' ),
		) ,
	) ,
	array(
		"type" => "textfield",
		"heading" => esc_html__("Sidebar Min-Width", 'uncode-core') ,
		"param_name" => "min_w_ajax_filters",
		"description" => esc_html__("Insert the min width in pixel.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'ajax_filters_layout',
			'value' => array( '' ),
		) ,
	) ,
	array(
		"type" => "textfield",
		"heading" => esc_html__("Overlay Max-Width", 'uncode-core') ,
		"param_name" => "max_w_ajax_filters",
		"description" => esc_html__("Insert the max width in pixel.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'ajax_filters_layout',
			'value' => array( '', 'overlay' )
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Menu Position", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filtering_menu",
		"description" => esc_html__("Specify whether to display the filter menu above both thumbs and sidebar or only above thumbs.", 'uncode-core') ,
		"value" => array(
			esc_html__('Above', 'uncode-core') => '',
			esc_html__('Inside', 'uncode-core') => 'inside',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'ajax_filters_layout',
			'value' => array(''),
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Menu Typography", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_typography",
		"description" => esc_html__("Specify the filters typography.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Inherit / Column', 'uncode-core') => 'inherit'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => array('yes', 'ajax'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Menu Uppercase", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filtering_uppercase",
		"description" => esc_html__("Activate this to have the filter menu in uppercase.", 'uncode-core') ,
		"value" => array(
			esc_html__('No', 'uncode-core') => '',
			esc_html__('Yes', 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => array('yes', 'ajax'),
		) ,
	) ,
	$add_filter_back_color_type,
	$add_filter_back_color,
	$add_filter_back_color_solid,
	$add_filter_back_color_gradient,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter full width", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filtering_full_width",
		"description" => esc_html__("Activate this to force the full width of the filter.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => array('yes'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Toggle Filters", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filtering_toggle_align",
		"description" => esc_html__("Set the alignment for the filter toggle button.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => '',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => array('ajax'),
		) ,
	) ,
	array(
		"type" => "textfield",
		"heading" => esc_html__("Toggle 'Hide' Text", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_toggle_hide_text",
		"description" => esc_html__("Specify the button label. NB. The default value is 'Hide Filters'.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => array('ajax'),
		) ,
	) ,
	array(
		"type" => "textfield",
		"heading" => esc_html__("Toggle 'Show' Text", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_toggle_show_text",
		"description" => esc_html__("Specify the button label. NB. The default value is 'Show Filters'.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => array('ajax'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Filter position", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filtering_position",
		"description" => esc_html__("Use this option to specify the main element position. NB. The main element is considered in order the Categories Filter, the Result Count text and the Widgets Toggle.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => array('yes'),
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter mobile hidden", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_mobile",
		"description" => esc_html__("Activate this to hide the filter menu in mobile mode.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => array('yes'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Filter mobile align", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_mobile_align",
		"description" => esc_html__("Set the alignment for the filter mobile.", 'uncode-core') ,
		"value" => array(
			esc_html__('Center', 'uncode-core') => '',
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Right', 'uncode-core') => 'right'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filter_mobile',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter mobile wrapper", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_mobile_wrapper",
		"description" => esc_html__("Activate the filter mobile wrapper.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filter_mobile',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => "textfield",
		"heading" => esc_html__("Filter wrapper text", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_mobile_wrapper_text",
		"description" => esc_html__("Activate the filter wrapper text. NB. The default value is 'Filters'.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filter_mobile_wrapper',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter mobile dropdown", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_mobile_dropdown",
		"description" => esc_html__("Activate the dropdown style for the filter mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filter_mobile',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => "textfield",
		"heading" => esc_html__("Filter dropdown text", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_mobile_dropdown_text",
		"description" => esc_html__("Activate the filter dropdown text. NB. The default value is 'Categories'.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filter_mobile_dropdown',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter scroll", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_scroll",
		"description" => esc_html__("Activate this to scroll to the module when filtering.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter sticky", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_sticky",
		"description" => esc_html__("Activate this to have a sticky filter menu when scrolling.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => array('yes'),
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter 'Show All' opposite", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_all_opposite",
		"description" => esc_html__("Activate this to position the 'Show All' button opposite to the rest.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
		'dependency' => array(
			'element' => 'filtering_position',
			'value' => array(
				'left',
				'right'
			)
		) ,
		'dependency' => array(
			'element' => 'show_extra_filters',
			'is_empty' => true,
		),
	) ,
	array(
		"type" => "textfield",
		"heading" => esc_html__("Filter 'Show All' text", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_all_text",
		"description" => esc_html__("Specify the button label. NB. The default value is 'Show All'.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => array( 'isotope', 'css_grid' )
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Filter categories hidden", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "filter_hide_cats",
		"description" => esc_html__("Activate this to hide the categories filter.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
		'dependency' => array(
			'element' => 'show_extra_filters',
			'not_empty' => true,
		),
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Extra filters", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "show_extra_filters",
		"description" => esc_html__("Activate this to show additional filters. NB. Ajax doesn't work with Pagination and Extra Filters combined.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Widgets filtering", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "show_widgetized_content_block",
		"description" => esc_html__("Activate this to display the widgetized Content Block.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
		'dependency' => array(
			'element' => 'show_extra_filters',
			'value' => 'yes',
		) ,
	) ,
	$widgetized_content_block_id,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Widgets toggle text', 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		'param_name' => 'widgetized_content_block_toggle_text',
		"description" => esc_html__("Specify the Content Block toggle text. NB. The default value is 'Options'.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'show_widgetized_content_block',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Widgets hide toggle icon", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "hide_widgetized_content_block_icon",
		"description" => esc_html__("Activate this to hide the toggle icon.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'show_widgetized_content_block',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Woo sorting", 'uncode-core') ,
		"param_name" => "show_woo_sorting",
		'uncode_wrapper_class' => 'woo-dependent-field post-dependent-field',
		"description" => esc_html__("Activate this to add the WooCommerce sorting dropdown.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'yes',
		) ,
		'dependency' => array(
			'element' => 'show_extra_filters',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Woo sorting count", 'uncode-core') ,
		"param_name" => "show_woo_result_count",
		'uncode_wrapper_class' => 'woo-dependent-field post-dependent-field',
		"description" => esc_html__("Activate this to show the WooCommerce result count.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'show_woo_sorting',
			'value' => 'yes',
		) ,
		// 'dependency' => array(
		// 	'element' => 'filter_hide_cats',
		// 	'is_empty' => true,
		// ),
	) ,

	array(
		"type" => "textfield",
		"heading" => esc_html__("Woo 'Default sorting' text", 'uncode-core') ,
		'uncode_wrapper_class' => 'post-dependent-field',
		"param_name" => "woo_sorting_default_text",
		"description" => esc_html__("Specify the button label when products have the default sorting. NB. The default value is 'Default sorting'.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'show_woo_sorting',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Woo hide sorting icon", 'uncode-core') ,
		"param_name" => "hide_woo_sorting_icon",
		'uncode_wrapper_class' => 'woo-dependent-field post-dependent-field',
		"description" => esc_html__("Activate this to hide the dropdown icon.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'show_woo_sorting',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Woo sorting Skin", 'uncode-core') ,
		"param_name" => "woo_sorting_skin",
		'uncode_wrapper_class' => 'woo-dependent-field post-dependent-field',
		"description" => esc_html__("Specify the sorting dropdown Skin color.", 'uncode-core') ,
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'show_woo_sorting',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Woo sorting shadow", 'uncode-core') ,
		"param_name" => "woo_sorting_shadow",
		'uncode_wrapper_class' => 'woo-dependent-field post-dependent-field',
		"description" => esc_html__("Activate the sorting dropdown shadow.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'isotope',
		) ,
		'dependency' => array(
			'element' => 'show_woo_sorting',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Active Filters", 'uncode-core') ,
		"param_name" => "active_filters",
		"description" => esc_html__("Specify whether to display and how to align the active filter list.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hidden', 'uncode-core') => '',
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'ajax',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Clear All", 'uncode-core') ,
		"param_name" => "clear_all",
		"description" => esc_html__("Specify where to display the Clear All link.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hidden', 'uncode-core') => '',
			esc_html__('Show', 'uncode-core') => 'show',
			esc_html__('Hide on Dekstop', 'uncode-core') => 'desktop',
			esc_html__('Hide on Mobile', 'uncode-core') => 'mobile',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'active_filters',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Woo sorting", 'uncode-core') ,
		'uncode_wrapper_class' => 'woo-dependent-field post-dependent-field',
		"param_name" => "show_woo_sorting_ajax",
		"description" => esc_html__("Activate this to add the WooCommerce sorting dropdown.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hidden', 'uncode-core') => '',
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'filtering',
			'value' => 'ajax',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Woo sorting count", 'uncode-core') ,
		'uncode_wrapper_class' => 'woo-dependent-field post-dependent-field',
		"param_name" => "show_woo_result_count_ajax",
		"description" => esc_html__("Activate this to show the WooCommerce result count.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hidden', 'uncode-core') => '',
			esc_html__('Default', 'uncode-core') => 'yes',
			esc_html__('Shortened', 'uncode-core') => 'short',
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'show_woo_sorting_ajax',
			'not_empty' => true,
		) ,
		// 'dependency' => array(
		// 	'element' => 'filter_hide_cats',
		// 	'is_empty' => true,
		// ),
	) ,

	array(
		"type" => "textfield",
		"heading" => esc_html__("Woo 'Default sorting' text", 'uncode-core') ,
		'uncode_wrapper_class' => 'woo-dependent-field post-dependent-field',
		"param_name" => "woo_sorting_default_text_ajax",
		"description" => esc_html__("Specify the button label when products have the default sorting. NB. The default value is 'Default sorting'.", 'uncode-core') ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'show_woo_sorting_ajax',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Woo sorting Skin", 'uncode-core') ,
		'uncode_wrapper_class' => 'woo-dependent-field post-dependent-field',
		"param_name" => "woo_sorting_skin_ajax",
		"description" => esc_html__("Specify the sorting dropdown Skin color.", 'uncode-core') ,
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'show_woo_sorting_ajax',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Woo sorting shadow", 'uncode-core') ,
		'uncode_wrapper_class' => 'woo-dependent-field post-dependent-field',
		"param_name" => "woo_sorting_shadow_ajax",
		"description" => esc_html__("Activate the sorting dropdown shadow.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Filters', 'uncode-core') ,
		'dependency' => array(
			'element' => 'show_woo_sorting_ajax',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Layout display', 'uncode-core') ,
		'param_name' => 'titles_display',
		"description" => esc_html__("Set the main layout mode.", 'uncode-core'),
		"value" => array(
			esc_html__('Block', 'uncode-core') => 'block',
			esc_html__('Inline', 'uncode-core') => 'inline',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'titles',
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Items gap", 'uncode-core') ,
		"param_name" => "gutter_size",
		"min" => 0,
		"max" => 6,
		"step" => 1,
		"value" => 3,
		"description" => esc_html__("Set the items gap.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'titles',
				'table',
				'sticky-scroll',
				'linear',
			)
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Items vertical alignment", 'uncode-core') ,
		"param_name" => "sticky_scroll_v_align",
		"description" => esc_html__("Specify the items vertical alignment.", 'uncode-core') ,
		"value" => array(
			esc_html__('Top', 'uncode-core') => '',
			esc_html__('Middle', 'uncode-core') => 'middle',
			esc_html__('Bottom', 'uncode-core') => 'bottom'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'sticky-scroll',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Items vertical alignment", 'uncode-core') ,
		"param_name" => "table_v_align",
		"description" => esc_html__("Specify the items vertical alignment.", 'uncode-core') ,
		"value" => array(
			esc_html__('Top', 'uncode-core') => '',
			esc_html__('Middle', 'uncode-core') => 'middle',
			esc_html__('Bottom', 'uncode-core') => 'bottom'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'table',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Items Borders", 'uncode-core') ,
		"param_name" => "table_border",
		"description" => esc_html__("Set borders between items.", 'uncode-core') ,
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Between elements', 'uncode-core') => 'yes',
			esc_html__('Below Each Element', 'uncode-core') => 'below',
			esc_html__('Above Each Element', 'uncode-core') => 'above',
			esc_html__('Above and Below', 'uncode-core') => 'both',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'table',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Items All-Clickable Area", 'uncode-core') ,
		"param_name" => "table_click_row",
		"description" => esc_html__("Set the Rows area all clickable.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'table',
			)
		),
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Items Hover Effect", 'uncode-core') ,
		"param_name" => "table_hover",
		"description" => esc_html__("Specify the hover effect of the Rows.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Opacity', 'uncode-core') => 'opacity',
			esc_html__('Opacity Inverted', 'uncode-core') => 'opacity-inverted',
		) ,
		'dependency' => array(
			'element' => 'table_click_row',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Item space", 'uncode-core') ,
		"param_name" => "drop_h_space",
		"description" => esc_html__("Specify the horizontal space between Items.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Small', 'uncode-core') => 'sm',
			esc_html__('Large', 'uncode-core') => 'lg',
		) ,
		'dependency' => array(
			'element' => 'titles_display',
			'value' => 'inline',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Inner Padding", 'uncode-core') ,
		"param_name" => "inner_padding",
		"description" => esc_html__("Activate this to have an inner padding with the same size as the items gap.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
			) ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Vertical alignment", 'uncode-core') ,
		"param_name" => "css_grid_v_align",
		"description" => esc_html__("Select the vertical alignment. NB. With CSS Grid it's possible to select the vertical alignment of thumbnails between them if they have different heights.", 'uncode-core') ,
		"value" => array(
			esc_html__('Top', 'uncode-core') => '',
			esc_html__('Middle', 'uncode-core') => 'middle',
			esc_html__('Bottom', 'uncode-core') => 'bottom',
		) ,
		"std" => '',
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'css_grid',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Equal height", 'uncode-core') ,
		"param_name" => "css_grid_equal_height",
		"description" => esc_html__("With the 'Content Under Image' Block Layout, activate this to create equal height thumbnails. NB. The equal height is applied to the container element so, for example, it is visible if you have the Border or Shadow options.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'css_grid',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Equal height Last to Bottom", 'uncode-core') ,
		"param_name" => "css_grid_equal_height_bottom",
		"description" => esc_html__("With the 'Content Under Image' Block Layout, activate this to align the last elements of each thumbnail to the bottom.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'css_grid_equal_height',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Equal height remove mobile", 'uncode-core') ,
		"param_name" => "css_grid_equal_height_no_mobile",
		"description" => esc_html__("Deactivate the Equal Height option on mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'css_grid_equal_height',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Direction', 'uncode-core') ,
		'param_name' => 'linear_orientation',
		'value' => array(
			esc_html__('Horizontal', 'uncode-core') => '',
			esc_html__('Vertical', 'uncode-core') => 'vertical',
		) ,
		'description' => esc_html__('Set the direction for Marquee. NB. If you use Vertical orientation please apply the \'overflow-hidden\' class to the container Row if you wish to limit it to the Row in which it is inserted.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'linear',
			) ,
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Alignment", 'uncode-core') ,
		"description" => esc_html__("Sets the alignment for thumbnails.", 'uncode-core') ,
		"param_name" => "linear_v_alingment",
		"group" => esc_html__("Module", 'uncode-core') ,
		"value" => array(
			esc_html__('Middle', 'uncode-core') => '',
			esc_html__('Top', 'uncode-core') => 'top',
			esc_html__('Bottom', 'uncode-core') => 'bottom',
		) ,
		'dependency' => array(
			'element' => 'linear_orientation',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Alignment", 'uncode-core') ,
		"description" => esc_html__("Sets the alignment for thumbnails.", 'uncode-core') ,
		"param_name" => "linear_h_alingment",
		"group" => esc_html__("Module", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => '',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		'dependency' => array(
			'element' => 'linear_orientation',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Size", 'uncode-core') ,
		"param_name" => "size_by",
		"description" => esc_html__("Set the size of thumbnails, preferably use a Clamp value, ex: clamp(100px, 20vw, 450px)", 'uncode-core') ,
		"value" => array(
			esc_html__('Width', 'uncode-core') => '',
			esc_html__('Height', 'uncode-core') => 'height'
		) ,
		"std" => "",
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('linear'),
		) ,
	) ,
	array(
		'type' => 'textfield',
		'std' => 'clamp(100px, 20vw, 450px)',
		'heading' => esc_html__('Width', 'uncode-core') ,
		'param_name' => 'linear_width',
		'description' => esc_html__('Declares the width of the thumbnail.', 'uncode-core') ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'size_by',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Height', 'uncode-core') ,
		'param_name' => 'linear_height',
		'description' => esc_html__('Declares the height of the thumbnail.', 'uncode-core') ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'size_by',
			'value' => array('height'),
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Animation", 'uncode-core') ,
		"description" => esc_html__("Set the Marquee animation type.", 'uncode-core') ,
		"param_name" => "linear_animation",
		"group" => esc_html__("Module", 'uncode-core') ,
		"value" => array(
			esc_html__('Marquee Auto (right to left)', 'uncode-core') => 'marquee',
			esc_html__('Marquee Auto (left to right)', 'uncode-core') => 'marquee-opposite',
			esc_html__('Marquee Scroll (right to left)', 'uncode-core') => 'marquee-scroll',
			esc_html__('Marquee Scroll (left to right)', 'uncode-core') => 'marquee-scroll-opposite',
			esc_html__('None', 'uncode-core') => 'none',
		) ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'linear'
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Speed", 'uncode-core') ,
		"param_name" => "linear_speed",
		"description" => esc_html__("Set the Marquee animation speed.", 'uncode-core') ,
		"min" => -4,
		"max" => 4,
		"step" => 1,
		"value" => 0,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('linear'),
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Edge to Edge", 'uncode-core') ,
		"param_name" => "marquee_clone",
		"description" => esc_html__("Repeat the Marquee to cover the viewport.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'linear_animation',
			'value' => array(
				'marquee-scroll',
				'marquee-scroll-opposite',
			),
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Hover", 'uncode-core') ,
		"param_name" => "linear_hover",
		"description" => esc_html__("Choose to reduce or stop the Marquee animation when hovered.", 'uncode-core') ,
		"value" => array(
			esc_html__('Disabled', 'uncode-core') => '',
			esc_html__('Slow Down', 'uncode-core') => 'yes',
			esc_html__('Pause', 'uncode-core') => 'pause'
		) ,
		'dependency' => array(
			'element' => 'linear_animation',
			'value' => array('marquee', 'marquee-opposite'),
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Draggable", 'uncode-core') ,
		"param_name" => "draggable",
		"description" => esc_html__("Select this option to drag the Marquee.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'linear'
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Freeze", 'uncode-core') ,
		"param_name" => "marquee_freeze",
		"description" => esc_html__("Select this option to stop the Marquee animation.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'linear_animation',
			'value' => array('marquee', 'marquee-opposite', 'marquee-scroll', 'marquee-scroll-opposite'),
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Desktop Freeze", 'uncode-core') ,
		"param_name" => "marquee_freeze_desktop",
		"description" => esc_html__("Select this option to stop the Marquee animation on desktop.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'marquee_freeze',
			'not_empty' => true,
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Mobile Freeze", 'uncode-core') ,
		"param_name" => "marquee_freeze_mobile",
		"description" => esc_html__("Select this option to stop the Marquee animation on mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'marquee_freeze',
			'not_empty' => true,
		) ,
		"group" => esc_html__("Module", 'uncode-core') ,
	) ,
	$uncode_post_list,
	$uncode_page_list,
	$uncode_product_list,
	$uncode_taxonomy_sorted_list,
	$uncode_post_table_list,
	$uncode_page_table_list,
	$uncode_product_table_list,
	$uncode_taxonomy_sorted_table_list,
);

$uncode_index_params_third = array(
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Items Height", 'uncode-core') ,
		"param_name" => "carousel_height",
		"description" => esc_html__("Specify the Items Height.", 'uncode-core') ,
		"value" => array(
			esc_html__('Auto', 'uncode-core') => '',
			esc_html__('Equal height', 'uncode-core') => 'equal',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'thumb_size',
			'value' => array(
				'',
				'one-one',
				'two-one',
				'three-two',
				'four-three',
				'ten-three',
				'sixteen-nine',
				'twentyone-nine',
				'one-two',
				'two-three',
				'three-four',
				'three-ten',
				'nine-sixteen',
				'five-four',
				'four-five',
			),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Items vertical alignment", 'uncode-core') ,
		"param_name" => "carousel_v_align",
		"description" => esc_html__("Specify the items vertical alignment.", 'uncode-core') ,
		"value" => array(
			esc_html__('Top', 'uncode-core') => '',
			esc_html__('Middle', 'uncode-core') => 'middle',
			esc_html__('Bottom', 'uncode-core') => 'bottom'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'type',
			'value' => 'carousel',
		) ,
		'dependency' => array(
			'element' => 'carousel_height',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Autoheight", 'uncode-core') ,
		"param_name" => "carousel_autoh",
		"description" => esc_html__("Activate to adjust the height automatically when possible.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'thumb_size',
			'value' => array(
				'',
				'one-one',
				'two-one',
				'three-two',
				'four-three',
				'ten-three',
				'sixteen-nine',
				'twentyone-nine',
				'one-two',
				'two-three',
				'three-four',
				'three-ten',
				'nine-sixteen',
				'five-four',
				'four-five',
			),
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Transition type', 'uncode-core') ,
		'param_name' => 'carousel_type',
		"value" => array(
			esc_html__('Slide', 'uncode-core') => '',
			esc_html__('Fade', 'uncode-core') => 'fade'
		) ,
		'description' => esc_html__('Specify the transition type.<br />NB. Fade option works only with 1 item selected to create a slideshow.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
		'group' => esc_html__('Module', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Auto rotate slides', 'uncode-core') ,
		'param_name' => 'carousel_interval',
		'value' => array(
			3000,
			5000,
			10000,
			15000,
			esc_html__('Disable', 'uncode-core') => 0
		) ,
		'description' => esc_html__('Specify the automatic timeout between slides in milliseconds.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
		'group' => esc_html__('Module', 'uncode-core')
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Navigation speed', 'uncode-core') ,
		'param_name' => 'carousel_navspeed',
		'value' => array(
			200,
			400,
			700,
			1000,
		) ,
		'std' => 400,
		'description' => esc_html__('Specify the navigation speed between slides in milliseconds.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
		'group' => esc_html__('Module', 'uncode-core')
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Loop", 'uncode-core') ,
		"param_name" => "carousel_loop",
		"description" => esc_html__("Activate the loop option to make the carousel infinite.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Overflow visible", 'uncode-core') ,
		"param_name" => "carousel_overflow",
		"description" => esc_html__("Activate this option to make the element overflow its container (get rid of the cropping area).", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Advanced Navigation", 'uncode-core') ,
		"param_name" => "advanced_nav",
		"description" => esc_html__("Activate to have the Advanced Navigation Target and hide the native Carousel navigation options.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Carousel target', 'uncode-core') ,
		'param_name' => 'el_id1',
		'value' => '',
		'description' => esc_html__("It represents the Target ID for advanced navigation, copy and paste into the Carousel/Slider Navigation module to connect the two modules. PS. If the two modules are in the same Row, there is no need to connect them because the connection is automatic.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"edit_field_class" => "target-advanced_nav input-readonly",
		'dependency' => array(
			'element' => 'advanced_nav',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Arrows", 'uncode-core') ,
		"param_name" => "carousel_nav",
		"edit_field_class" => "hide-advanced_nav",
		"description" => esc_html__("Activate this to show arrows.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Arrows Mobile", 'uncode-core') ,
		"param_name" => "carousel_nav_mobile",
		"edit_field_class" => "hide-advanced_nav",
		"description" => esc_html__("Activate this to show arrows for mobile devices.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Arrows Skin", 'uncode-core') ,
		"param_name" => "carousel_nav_skin",
		"edit_field_class" => "hide-advanced_nav",
		"description" => esc_html__("Specify the arrows Skin.", 'uncode-core') ,
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dots", 'uncode-core') ,
		"param_name" => "carousel_dots",
		"edit_field_class" => "hide-advanced_nav",
		"description" => esc_html__("Activate this to show dots in the bottom.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dots Extra Top", 'uncode-core') ,
		"param_name" => "carousel_dots_space",
		"edit_field_class" => "hide-advanced_nav",
		"description" => esc_html__("Activate this to add extra top space to the Dots.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'std' => '',
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_dots',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dots Mobile", 'uncode-core') ,
		"param_name" => "carousel_dots_mobile",
		"edit_field_class" => "hide-advanced_nav",
		"description" => esc_html__("Activate this to show dots in the bottom for mobile devices.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dots inside", 'uncode-core') ,
		"param_name" => "carousel_dots_inside",
		"edit_field_class" => "hide-advanced_nav",
		"description" => esc_html__("Activate to have the dots inside the carousel.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Dots Position', 'uncode-core') ,
		'param_name' => 'carousel_dot_position',
		"value" => array(
			esc_html__('Center', 'uncode-core') => '',
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Right', 'uncode-core') => 'right',
		) ,
		"edit_field_class" => "hide-advanced_nav",
		'group' => esc_html__('Module', 'uncode-core') ,
		'description' => esc_html__('Specify the position of dots.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Dots container width', 'uncode-core') ,
		'param_name' => 'carousel_dot_width',
		"edit_field_class" => "hide-advanced_nav",
		"value" => array(
			esc_html__('Full Width', 'uncode-core') => '',
			esc_html__('Limit Width', 'uncode-core') => 'limit',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'description' => esc_html__('Specify the width of the dots container.', 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_dots',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Dots container width unit", 'uncode-core') ,
		"param_name" => "column_width_use_pixel",
		"edit_field_class" => "hide-advanced_nav",
		"edit_field_class" => 'vc_column row_height',
		"description" => 'Set this value if you want to constrain the container width.',
		"value" => array(
			'' => 'yes'
		),
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_dot_position',
			'value' => array('left', 'right'),
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Dots container width", 'uncode') ,
		"param_name" => "carousel_width_percent",
		"edit_field_class" => "hide-advanced_nav",
		"min" => 0,
		"max" => 100,
		"step" => 1,
		"value" => 100,
		'group' => esc_html__('Module', 'uncode-core') ,
		"description" => esc_html__("Set the container width with a percent value.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'column_width_use_pixel',
			'is_empty' => true,
		)
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__("Dots container width", 'uncode-core'),
		'group' => esc_html__('Module', 'uncode-core') ,
		'param_name' => 'carousel_width_pixel',
		"edit_field_class" => "hide-advanced_nav",
		'description' => esc_html__("Insert the container width in pixel.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'column_width_use_pixel',
			'not_empty' => true
		)
	) ,
	array(
		"type" => "type_numeric_slider",
		'heading' => esc_html__('Dots container padding', 'uncode-core') ,
		"description" => esc_html__("Activate this option to add left and right padding to dots container.", 'uncode-core') ,
		"param_name" => "carousel_dot_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"edit_field_class" => "hide-advanced_nav",
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'carousel_dots_inside',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Off-Grid", 'uncode-core') ,
		"param_name" => "off_grid",
		'description' => wp_kses(__('Active this to shift elements (even or odd).<br />NB. Please note that this option cannot be combined with the Filtering.', 'uncode-core'), array( 'br' => array( ) ) ) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'std' => '',
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'isotope_mode',
			'value' => array(
				'masonry',
				'packery'
			),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Off-Grid Items Rhythm", 'uncode-core') ,
		"param_name" => "off_grid_element",
		"description" => esc_html__("Select what item to put Off-Grid.", 'uncode-core') ,
		'value' => array(
			esc_html__('Odd', 'uncode-core') => 'odd',
			esc_html__('Even', 'uncode-core') => 'even',
			esc_html__('Custom', 'uncode-core') => 'custom'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'off_grid',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Off-Grid custom value', 'uncode-core') ,
		'param_name' => 'off_grid_custom',
		'value' => '0,2',
		'description' => wp_kses(__('Enter a number or a series of comma separated numbers.<br />NB. The first element is identified by 0.', 'uncode-core'), array( 'br' => array( ) ) ) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'off_grid_element',
			'value' => array(
				'custom',
			) ,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Off-Grid value", 'uncode-core') ,
		"param_name" => "off_grid_val",
		"min" => 1,
		"max" => 7,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the shift value.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'off_grid',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Off-Grid All Items", 'uncode-core') ,
		"param_name" => "off_grid_all",
		"description" => esc_html__("Set this option to apply the Off-Grid to all elements. Normally it is applied only to the elements of the first row.", 'uncode-core') ,
		"std" => '',
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'off_grid',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Pagination", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field',
		"param_name" => "pagination",
		"description" => wp_kses(__("Activate this to add the pagination function.<br>NB. This option doesn't work if combined with the 'Random' order, 'Menu Order', or with other Posts modules on the same page. Ajax doesn't work with Pagination and Extra Filters combined.", 'uncode-core'), array( 'br' => array( ) ) ) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'css_grid',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Load More", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite",
		"description" => wp_kses(__("Activate this to load more items with scrolling.<br>NB. This option doesn't work is combination with the 'Random' order and 'Menu Order' or with multiple isotope in the same page.", 'uncode-core'), array( 'br' => array( ) ) ) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'pagination',
			'is_empty' => true,
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Load more style", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite_button",
		'value' => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Preloader', 'uncode-core') => 'icon',
			esc_html__('Button', 'uncode-core') => 'yes',
		) ,
		"description" => esc_html__("Choose the load more style.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite',
			'value' => 'yes',
		)
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Load more button hover effect", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite_hover_fx",
		"description" => esc_html__("Specify an effect on hover state.", 'uncode-core') ,
		"value" => array(
			'Inherit' => '',
			'Outlined' => 'outlined',
			'Flat' => 'full-colored',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite_button',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => "checkbox",
		"heading" => esc_html__("Load more button outlined inverse", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite_button_outline",
		"description" => esc_html__("Outlined buttons don't have a full background color. NB: this option is available only with Load More Button Hover Effect > Outlined.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite_button',
			'value' => 'yes',
		) ,
	) ,
  array(
		"type" => "textfield",
		"heading" => esc_html__("Load more button text", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite_button_text",
		"description" => esc_html__("Specify the button label. NB. The default value is 'Load more'.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'infinite_button',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Load more button shape", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field load-more-field',
		"param_name" => "infinite_button_shape",
		"description" => esc_html__("Specify the load more button shape.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Default', 'uncode-core') => 'btn-default-shape',
			esc_html__('Round', 'uncode-core') => 'btn-round',
			esc_html__('Circle', 'uncode-core') => 'btn-circle',
			esc_html__('Square', 'uncode-core') => 'btn-square'
		) ,
		'dependency' => array(
			'element' => 'infinite_button',
			'value' => 'yes',
		) ,
	) ,
	$add_infinite_button_color_type,
	$add_infinite_button_color,
	$add_infinite_button_color_solid,
	$add_infinite_button_color_gradient,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Pagination-Load More Skin", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field',
		"param_name" => "footer_style",
		"description" => esc_html__("Specify the pagination/load more Skin color.", 'uncode-core') ,
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'css_grid',
			) ,
		) ,
	) ,
	$add_footer_back_color_type,
	$add_footer_back_color,
	$add_footer_back_color_solid,
	$add_footer_back_color_gradient,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Pagination-Load More full", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field',
		"param_name" => "footer_full_width",
		"description" => esc_html__("Activate this to force the full width of the pagination/load more.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'css_grid',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Pagination History Disabled", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field',
		"param_name" => "pagination_disable_history",
		"description" => esc_html__("Activate this to remove the History Hash fragment when you use multiple Posts module in the same page.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'pagination',
			'not_empty' => true,
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Pagination Typography", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field',
		"param_name" => "pagination_typography",
		"description" => esc_html__("Specify the pagination typography.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Inherit / Column', 'uncode-core') => 'inherit'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'pagination',
			'not_empty' => true,
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Pagination Scroll Disabled", 'uncode-core') ,
		'uncode_wrapper_class' => 'pagination-field',
		"param_name" => "pagination_scroll_disabled",
		"description" => esc_html__("Activate this to remove the scroll effect.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'pagination',
			'not_empty' => true,
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Not Active Items Transparent", 'uncode-core') ,
		"param_name" => "carousel_half_opacity",
		"description" => esc_html__("Activate this option to make Not Active Items Transparent.", 'uncode-core') ,
		"std" => '',
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Not active items scaled", 'uncode-core') ,
		"param_name" => "carousel_scaled",
		"description" => esc_html__("Activate this option to make not active items scaled.", 'uncode-core') ,
		"std" => '',
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Not active items not clickable", 'uncode-core') ,
		"param_name" => "carousel_pointer_events",
		"description" => esc_html__("Activate this option to make not active items not clickable.", 'uncode-core') ,
		"std" => '',
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel',
		) ,
		'dependency' => array(
			'element' => 'carousel_overflow',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Stage padding", 'uncode-core') ,
		"description" => esc_html__("Activate this option to add left and right padding style onto stage-wrapper.", 'uncode-core') ,
		"param_name" => "stage_padding",
		"min" => 0,
		"max" => 75,
		"step" => 5,
		"value" => 0,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Advanced Video Settings", 'uncode-core') ,
		"param_name" => "advanced_videos",
		"description" => esc_html__("Activate the Videos tab with special options for autoplay videos. NB. These options can't work with Metro layout.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'css_grid',
				'carousel',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Block layout", 'uncode-core') ,
		"param_name" => "single_text",
		"description" => esc_html__("Specify the text positioning inside the thumbnail.", 'uncode-core') ,
		"value" => array(
			esc_html__('Content Under Image', 'uncode-core') => 'under',
			esc_html__('Content Overlay', 'uncode-core') => 'overlay',
			esc_html__('Content Lateral', 'uncode-core') => 'lateral',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Item Separator", 'uncode-core') ,
		"param_name" => "drop_image_separator",
		"description" => esc_html__("Specify a separator.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'std' => '',
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('/ (Slash)', 'uncode-core') => 'slash',
			esc_html__('| (Vertical bar)', 'uncode-core') => 'pipe',
			esc_html__('- (Dash)', 'uncode-core') => 'dash',
			esc_html__('• (Bullet)', 'uncode-core') => 'bullet',
			esc_html__('· (Middle dot)', 'uncode-core') => 'dot',
			esc_html__('‣ (Triangle)', 'uncode-core') => 'triangle',
			esc_html__('Custom', 'uncode-core') => 'custom',
		) ,
		'dependency' => array(
			'element' => 'titles_display',
			'value' => 'inline',
		) ,
	) ,
	array(
		"type" => 'textfield',
		"heading" => esc_html__("Item Separator Custom", 'uncode-core') ,
		"param_name" => "drop_image_custom_separator",
		"description" => esc_html__("Specify a separator.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'std' => '',
		'dependency' => array(
			'element' => 'drop_image_separator',
			'value' => 'custom',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Media position", 'uncode-core') ,
		"param_name" => "drop_image_position",
		"description" => esc_html__("Specify the Media layout mode.", 'uncode-core') ,
		"value" => array(
			esc_html__('Mouse', 'uncode-core') => '',
			esc_html__('Background Row', 'uncode-core') => 'row',
			esc_html__('Background Column', 'uncode-core') => 'column',
			esc_html__('Hide Media', 'uncode-core') => 'hide'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'titles',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Media width", 'uncode-core') ,
		"param_name" => "drop_width",
		"description" => esc_html__("Specify the thumbnail width.", 'uncode-core') ,
		"value" => $units,
		"std" => "4",
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'drop_image_position',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Media aspect ratio', 'uncode-core') ,
		'param_name' => 'drop_ratio',
		'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
			'2:1' => 'two-one',
			'3:2' => 'three-two',
			'4:3' => 'four-three',
			'5:4' => 'five-four',
			'10:3' => 'ten-three',
			'16:9' => 'sixteen-nine',
			'21:9' => 'twentyone-nine',
			'1:2' => 'one-two',
			'2:3' => 'two-three',
			'3:4' => 'three-four',
			'4:5' => 'four-five',
			'3:10' => 'three-ten',
			'9:16' => 'nine-sixteen',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'drop_image_position',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Media anchor', 'uncode-core') ,
		'param_name' => 'drop_anchor',
		'description' => esc_html__('Specify the anchor point of the Media with the Mouse.', 'uncode-core') ,
		"value" => array(
			esc_html__('Top Left', 'uncode-core') => '',
			esc_html__('Top Center', 'uncode-core') => 'top-center',
			esc_html__('Top Right', 'uncode-core') => 'top-right',
			esc_html__('Middle Left', 'uncode-core') => 'middle-left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Middle Right', 'uncode-core') => 'middle-right',
			esc_html__('Bottom Left', 'uncode-core') => 'bottom-left',
			esc_html__('Bottom Center', 'uncode-core') => 'bottom-center',
			esc_html__('Bottom Right', 'uncode-core') => 'bottom-right',
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'drop_image_position',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Background repeat", 'uncode-core') ,
		'description' => wp_kses(__('Define the background repeat. <a href=\'http://www.w3schools.com/cssref/pr_background-repeat.asp\' target=\'_blank\'>Check this for reference</a>', 'uncode-core') , array( 'a' => array( 'href' => array(),'target' => array() ) ) ),
		'param_name' => 'back_repeat',
		'param_holder_class' => 'background-image-settings',
		'value' => array(
			esc_html__('Select…', 'uncode-core') => '',
			esc_html__('No Repeat', 'uncode-core') => 'no-repeat',
			esc_html__('Repeat All', 'uncode-core') => 'repeat',
			esc_html__('Repeat Horizontally', 'uncode-core') => 'repeat-x',
			esc_html__('Repeat Vertically', 'uncode-core') => 'repeat-y',
			esc_html__('Inherit', 'uncode-core') => 'inherit'
		) ,
		'dependency' => array(
			'element' => 'drop_image_position',
			'not_empty' => true
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
	),
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Background Attachment", 'uncode-core') ,
		"description" => wp_kses(__("Define the background attachment. <a href='http://www.w3schools.com/cssref/pr_background-attachment.asp' target='_blank'>Check this for reference</a>", 'uncode-core'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
		'param_name' => 'back_attachment',
		'value' => array(
			esc_html__('Select…', 'uncode-core') => '',
			esc_html__('Fixed', 'uncode-core') => 'fixed',
			esc_html__('Scroll', 'uncode-core') => 'scroll',
			esc_html__('Inherit', 'uncode-core') => 'inherit'
		) ,
		'dependency' => array(
			'element' => 'drop_image_position',
			'not_empty' => true
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
	),
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Background Position", 'uncode-core') ,
		"description" => wp_kses(__("Define the background position. <a href='http://www.w3schools.com/cssref/pr_background-position.asp' target='_blank'>Check this for reference</a>", 'uncode-core'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
		'param_name' => 'back_position',
		'value' => array(
			esc_html__('Select…', 'uncode-core') => '',
			esc_html__('Left Top', 'uncode-core') => 'left top',
			esc_html__('Left Center', 'uncode-core') => 'left center',
			esc_html__('Left Bottom', 'uncode-core') => 'left bottom',
			esc_html__('Center Top', 'uncode-core') => 'center top',
			esc_html__('Center Center', 'uncode-core') => 'center center',
			esc_html__('Center Bottom', 'uncode-core') => 'center bottom',
			esc_html__('Right Top', 'uncode-core') => 'right top',
			esc_html__('Right Center', 'uncode-core') => 'right center',
			esc_html__('Right Bottom', 'uncode-core') => 'right bottom'
		) ,
		'dependency' => array(
			'element' => 'drop_image_position',
			'not_empty' => true
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
	),
	array(
		'type' => 'textfield',
		"heading" => esc_html__("Background Size", 'uncode-core') ,
		"description" => wp_kses(__("Define the background size (Default value is 'cover'). <a href='http://www.w3schools.com/cssref/css3_pr_background-size.asp' target='_blank'>Check this for reference</a>", 'uncode-core'), array( 'a' => array( 'href' => array(),'target' => array() ) ) ) ,
		'param_name' => 'back_size',
		'dependency' => array(
			'element' => 'drop_image_position',
			'not_empty' => true
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
	),
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Background on load", 'uncode-core') ,
		"param_name" => "drop_image_default",
		"description" => esc_html__("Set whether the first Item in the list should be active on page load.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'drop_image_position',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Title active on load", 'uncode-core') ,
		"param_name" => "drop_title_default",
		"description" => esc_html__("Set whether the first Item title should be active on page load.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'drop_image_default',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Media Transition Time", 'uncode-core') ,
		"param_name" => "drop_image_time",
		"description" => esc_html__("Specify the transition speed between Items.", 'uncode-core') ,
		"min" => 0,
		"max" => 1000,
		"step" => 50,
		"value" => 250,
		"std" => 250,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'titles',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Media arrangement", 'uncode-core') ,
		"param_name" => "drop_image_arrange",
		"description" => esc_html__("Specify the Media z-index.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'std' => '',
		"value" => array(
			esc_html__('Behind Item ', 'uncode-core') => '',
			esc_html__('Behind All', 'uncode-core') => 'behind',
			esc_html__('Behind None', 'uncode-core') => 'front',
		) ,
		'dependency' => array(
			'element' => 'drop_image_position',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Media border radius", 'uncode-core') ,
		"param_name" => "drop_radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Extra Small', 'uncode-core') => 'xs',
			esc_html__('Small', 'uncode-core') => 'sm',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
			esc_html__('Huge', 'uncode-core') => 'hg',
		),
		"std" => ' ',
		'dependency' => array(
			'element' => 'drop_image_position',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Media shadow", 'uncode-core') ,
		"param_name" => "drop_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'drop_image_position',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Media shadow type", 'uncode-core') ,
		"param_name" => "drop_shadow_weight",
		"description" => esc_html__("Specify the shadow option preset.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"value" => array(
			esc_html__('Extra Small', 'uncode-core') => '',
			esc_html__('Small', 'uncode-core') => 'sm',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
		) ,
		'dependency' => array(
			'element' => 'drop_shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Media shadow Darker", 'uncode-core') ,
		"param_name" => "drop_shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'drop_shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Hover effect", 'uncode-core') ,
		"param_name" => "drop_image_hover",
		"description" => esc_html__("Specify the hover effect.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'std' => '',
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Accent', 'uncode-core') => 'accent',
			esc_html__('Opacity', 'uncode-core') => 'opacity',
			esc_html__('Opacity Inverted', 'uncode-core') => 'opacity-inverted',
		) ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'titles',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Meta", 'uncode') ,
		"param_name" => "drop_image_extra",
		"description" => esc_html__("Activate an additional Meta element.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		'group' => esc_html__('Module', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'titles',
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Meta type", 'uncode-core') ,
		"param_name" => "drop_image_extra_type",
		"description" => esc_html__("Set the additional Meta type.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"value" => array(
			esc_html__('Counter', 'uncode-core') => '',
			esc_html__('Categories', 'uncode-core') => 'category',
			esc_html__('Date', 'uncode-core') => 'date',
			esc_html__('Author', 'uncode-core') => 'author',
			esc_html__('Date - Author', 'uncode-core') => 'date-author',
			esc_html__('Post type', 'uncode-core') => 'type',
			esc_html__('Price (Product)', 'uncode-core') => 'price',
			esc_html__('Items count (Taxonomy query)', 'uncode-core') => 'count',
		) ,
		'dependency' => array(
			'element' => 'drop_image_extra',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Meta size", 'uncode-core') ,
		"param_name" => "drop_image_extra_size",
		"description" => esc_html__("Set the additional Meta size.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"value" => array(
			esc_html__('15%', 'uncode-core') => '15',
			esc_html__('25%', 'uncode-core') => '25',
			esc_html__('50%', 'uncode-core') => '50',
			esc_html__('75%', 'uncode-core') => '75',
			esc_html__('100%', 'uncode-core') => '100',
		) ,
		'std' => '25',
		'dependency' => array(
			'element' => 'drop_image_extra',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Meta weight", 'uncode-core') ,
		"param_name" => "drop_image_extra_weight",
		"description" => esc_html__("Set the additional Meta weight.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Normal', 'uncode-core') => 'normal',
			esc_html__('Bold', 'uncode-core') => 'bold',
		) ,
		'dependency' => array(
			'element' => 'drop_image_extra',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Meta position", 'uncode-core') ,
		"param_name" => "drop_image_extra_position",
		"description" => esc_html__("Set the additional Meta position.", 'uncode-core') ,
		'group' => esc_html__('Module', 'uncode-core') ,
		"value" => array(
			esc_html__('Before - Top', 'uncode-core') => 'before-top',
			esc_html__('Left - Top', 'uncode-core') => 'left-top',
			esc_html__('Center - Top', 'uncode-core') => 'center-top',
			esc_html__('Right - Top', 'uncode-core') => 'right-top',
			esc_html__('After - Top', 'uncode-core') => 'after-top',
			esc_html__('After - Bottom', 'uncode-core') => 'after-bottom',
			esc_html__('Right - Bottom', 'uncode-core') => 'right-bottom',
			esc_html__('Center - Bottom', 'uncode-core') => 'center-bottom',
			esc_html__('Left - Bottom', 'uncode-core') => 'left-bottom',
			esc_html__('Before - Bottom', 'uncode-core') => 'before-bottom',
		) ,
		'std' => 'after-top',
		'dependency' => array(
			'element' => 'drop_image_extra',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Width", 'uncode-core') ,
		"param_name" => "single_width",
		"description" => esc_html__("Specify the thumbnail width.", 'uncode-core') ,
		"value" => $units,
		"std" => "4",
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
			) ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Height", 'uncode-core') ,
		"param_name" => "single_height",
		"description" => esc_html__("Specify the thumbnail height.", 'uncode-core') ,
		"value" => $units,
		"std" => "4",
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				// 'css_grid',
				// 'custom_grid',
			) ,
		) ,
		'dependency' => array(
			'element' => 'style_preset',
			'value' => 'metro',
		) ,
		'dependency' => array(
			'element' => 'single_height_viewport',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Height", 'uncode-core') ,
		"param_name" => "single_fluid_height",
		"min" => 0,
		"max" => 100,
		"step" => 1,
		"value" => 0,
		"std" => '33',
		"description" => esc_html__('Set the row height with a percent value.', 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'css_grid',
			) ,
		) ,
		'dependency' => array(
			'element' => 'style_preset',
			'value' => 'metro',
		) ,
		'dependency' => array(
			'element' => 'single_height_viewport',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'images_size',
		'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
			'2:1' => 'two-one',
			'3:2' => 'three-two',
			'4:3' => 'four-three',
			'5:4' => 'five-four',
			'10:3' => 'ten-three',
			'16:9' => 'sixteen-nine',
			'21:9' => 'twentyone-nine',
			'1:2' => 'one-two',
			'2:3' => 'two-three',
			'3:4' => 'three-four',
			'4:5' => 'four-five',
			'3:10' => 'three-ten',
			'9:16' => 'nine-sixteen',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'style_preset',
			'value' => array('masonry'),
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'custom_grid_images_size',
		'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
			'2:1' => 'two-one',
			'3:2' => 'three-two',
			'4:3' => 'four-three',
			'5:4' => 'five-four',
			'10:3' => 'ten-three',
			'16:9' => 'sixteen-nine',
			'21:9' => 'twentyone-nine',
			'1:2' => 'one-two',
			'2:3' => 'two-three',
			'3:4' => 'three-four',
			'4:5' => 'four-five',
			'3:10' => 'three-ten',
			'9:16' => 'nine-sixteen',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'custom_grid',
			) ,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'css_grid_images_size',
		'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
			'2:1' => 'two-one',
			'3:2' => 'three-two',
			'4:3' => 'four-three',
			'5:4' => 'five-four',
			'10:3' => 'ten-three',
			'16:9' => 'sixteen-nine',
			'21:9' => 'twentyone-nine',
			'1:2' => 'one-two',
			'2:3' => 'two-three',
			'3:4' => 'three-four',
			'4:5' => 'four-five',
			'3:10' => 'three-ten',
			'9:16' => 'nine-sixteen',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('css_grid', 'linear'),
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Aspect ratio', 'uncode-core') ,
		'param_name' => 'table_images_size',
		'description' => esc_html__('Specify the aspect ratio for the media.', 'uncode-core') ,
		"value" => array(
			esc_html__('Regular', 'uncode-core') => '',
			'1:1' => 'one-one',
			'2:1' => 'two-one',
			'3:2' => 'three-two',
			'4:3' => 'four-three',
			'5:4' => 'five-four',
			'10:3' => 'ten-three',
			'16:9' => 'sixteen-nine',
			'21:9' => 'twentyone-nine',
			'1:2' => 'one-two',
			'2:3' => 'two-three',
			'3:4' => 'three-four',
			'4:5' => 'four-five',
			'3:10' => 'three-ten',
			'9:16' => 'nine-sixteen',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('table'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Media position", 'uncode-core') ,
		"param_name" => "single_image_position",
		"description" => esc_html__("Specify the image alignment.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => '',
			esc_html__('Right', 'uncode-core') => 'right'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'lateral',
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Media size", 'uncode-core') ,
		"param_name" => "single_image_size",
		"min" => 1,
		"max" => 11,
		"step" => 1,
		"std" => 6,
		"description" => esc_html__('Set the image size.', 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'lateral',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Media above mobile", 'uncode-core') ,
		"param_name" => "single_lateral_responsive",
		"description" => esc_html__("Activate this to put the media above the content on mobile devices.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'std' => 'yes',
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'lateral',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Skin", 'uncode-core') ,
		"param_name" => "single_style",
		"description" => esc_html__("Specify the Skin inside the content thumbnail.", 'uncode-core') ,
		"value" => array(
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Background color", 'uncode-core') ,
		"param_name" => "single_back_color",
		"description" => esc_html__("Specify a background color for the thumbnail.", 'uncode-core') ,
		"value" => $uncode_colors,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel', 'css_grid', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Shape', 'uncode-core') ,
		'param_name' => 'single_shape',
		'value' => array(
			esc_html__('Select…', 'uncode-core') => '',
			esc_html__('Rounded', 'uncode-core') => 'round',
			esc_html__('Circular', 'uncode-core') => 'circle'
		) ,
		'description' => esc_html__('Specify one if you want to shape the block.', 'uncode-core'),
		'group' => esc_html__('Blocks', 'uncode-core'),
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid','table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Border radius", 'uncode-core') ,
		"param_name" => "radius",
		"description" => esc_html__("Specify the border radius effect.", 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		"value" => array(
			esc_html__('Extra Small', 'uncode-core') => 'xs',
			esc_html__('Small', 'uncode-core') => ' ',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
			esc_html__('Huge', 'uncode-core') => 'hg',
		),
		"std" => ' ',
		'dependency' => array(
			'element' => 'single_shape',
			'value' => 'round'
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Overlay color", 'uncode-core') ,
		"param_name" => "single_overlay_color",
		"description" => esc_html__("Specify a background color for the overlay.", 'uncode-core') ,
		"value" => $uncode_colors,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid','table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay coloration", 'uncode-core') ,
		"param_name" => "single_overlay_coloration",
		"description" => wp_kses(__("Specify the coloration style for the overlay. NB. For the gradient you can't customize the overlay color.", 'uncode-core'), array( 'br' => array( ) ) ) ,
		"value" => array(
			esc_html__('Fully colored', 'uncode-core') => '',
			esc_html__('Gradient top', 'uncode-core') => 'top_gradient',
			esc_html__('Gradient bottom', 'uncode-core') => 'bottom_gradient',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core'),
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid','table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Overlay Blend Mode", 'uncode-core') ,
		"param_name" => "single_overlay_blend",
		"description" => esc_html__("Specify a Blend Mode.", 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core'),
		"value" => array(
			esc_html__('None', 'uncode-core') => '',
			esc_html__('Multiply', 'uncode-core') => 'multiply',
			esc_html__('Screen', 'uncode-core') => 'screen',
			esc_html__('Overlay', 'uncode-core') => 'overlay',
			esc_html__('Darken', 'uncode-core') => 'darken',
			esc_html__('Lighten', 'uncode-core') => 'lighten',
			esc_html__('Color Dodge', 'uncode-core') => 'color-dodge',
			esc_html__('Color Burn', 'uncode-core') => 'color-burn',
			esc_html__('Hard Light', 'uncode-core') => 'hard-light',
			esc_html__('Soft Light', 'uncode-core') => 'soft-light',
			esc_html__('Difference', 'uncode-core') => 'difference',
			esc_html__('Exclusion', 'uncode-core') => 'exclusion',
		) ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'custom_grid',
				'sticky-scroll',
				'linear',
			)
		),
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Overlay opacity", 'uncode-core') ,
		"param_name" => "single_overlay_opacity",
		"min" => 1,
		"max" => 100,
		"step" => 1,
		"value" => 50,
		"description" => esc_html__("Set the overlay opacity.", 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core'),
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid','table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay visibility", 'uncode-core') ,
		"param_name" => "single_overlay_visible",
		"description" => esc_html__("Activate this to show the overlay as starting point.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hidden', 'uncode-core') => 'no',
			esc_html__('Visible', 'uncode-core') => 'yes',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid','table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay animation", 'uncode-core') ,
		"param_name" => "single_overlay_anim",
		"description" => esc_html__("Activate this to animate the overlay on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Animated', 'uncode-core') => 'yes',
			esc_html__('Static', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid','table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay text visibility", 'uncode-core') ,
		"param_name" => "single_text_visible",
		"description" => esc_html__("Activate this to show the text as starting point.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hidden', 'uncode-core') => 'no',
			esc_html__('Visible', 'uncode-core') => 'yes',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel', 'css_grid', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay text animation", 'uncode-core') ,
		"param_name" => "single_text_anim",
		"description" => esc_html__("Activate this to animate the text on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Animated', 'uncode-core') => 'yes',
			esc_html__('Static', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel', 'css_grid', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Overlay text animation type", 'uncode-core') ,
		"param_name" => "single_text_anim_type",
		"description" => esc_html__("Specify the animation type.", 'uncode-core') ,
		"value" => array(
			esc_html__('Opacity', 'uncode-core') => '',
			esc_html__('Bottom to Top', 'uncode-core') => 'btt',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text_anim',
			'value' => 'yes',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Image coloration", 'uncode-core') ,
		"param_name" => "single_image_coloration",
		"description" => esc_html__("Specify the image coloration mode.", 'uncode-core') ,
		"value" => array(
			esc_html__('Standard', 'uncode-core') => '',
			esc_html__('Desaturated', 'uncode-core') => 'desaturated',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel', 'css_grid', 'table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Image coloration animation", 'uncode-core') ,
		"param_name" => "single_image_color_anim",
		"description" => esc_html__("Activate this to animate the image coloration on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Static', 'uncode-core') => '',
			esc_html__('Animated', 'uncode-core') => 'yes',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid', 'table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Image animation", 'uncode-core') ,
		"param_name" => "single_image_anim",
		"description" => esc_html__("Activate this to animate the image on mouse over.", 'uncode-core') ,
		"value" => array(
			esc_html__('Animated', 'uncode-core') => 'yes',
			esc_html__('Static', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid','table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Image magnetic", 'uncode') ,
		"param_name" => "single_image_magnetic",
		"description" => esc_html__("Enable this option to enable the magnetic effect and slightly move the image according with the mouse position.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode') ,
		'dependency' => array(
			'element' => 'single_image_anim',
			'value' => array('yes'),
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Secondary image", 'uncode-core') ,
		"param_name" => "single_secondary",
		"description" => esc_html__("Display the secondary image on hover state.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid','table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content align", 'uncode-core') ,
		"param_name" => "single_h_align",
		"description" => esc_html__("Specify the horizontal alignment.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right',
			esc_html__('Justify', 'uncode-core') => 'justify'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid','table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content align mobile", 'uncode-core') ,
		"param_name" => "single_h_align_mobile",
		"description" => esc_html__("Specify the horizontal alignment in mobile devices.", 'uncode-core') ,
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right',
			esc_html__('Justify', 'uncode-core') => 'justify'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid','table', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content Align Last Column", 'uncode-core') ,
		"param_name" => "single_table_last_align",
		"description" => esc_html__("Specify the text alignment of the last column.", 'uncode-core') ,
		"value" => array(
			esc_html__('Inherit', 'uncode-core') => '',
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right',
			esc_html__('Justify', 'uncode-core') => 'justify'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('table'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content vertical position", 'uncode-core') ,
		"param_name" => "single_v_position",
		"description" => esc_html__("Specify the text vertical position.", 'uncode-core') ,
		"value" => array(
			esc_html__('Middle', 'uncode-core') => '',
			esc_html__('Top', 'uncode-core') => 'top',
			esc_html__('Bottom', 'uncode-core') => 'bottom',
			esc_html__('Justify', 'uncode-core') => 'justify'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'overlay',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content vertical alignment", 'uncode-core') ,
		"param_name" => "single_vertical_text",
		"description" => esc_html__("Specify the text vertical alignment. NB: it works with Metro Layout only.", 'uncode-core') ,
		"value" => array(
			esc_html__('Top', 'uncode-core') => '',
			esc_html__('Middle', 'uncode-core') => 'middle',
			esc_html__('Bottom', 'uncode-core') => 'bottom',
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'lateral',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content width reduced", 'uncode-core') ,
		"param_name" => "single_reduced",
		"description" => esc_html__("Specify the text reduction amount to shrink the overlay content dimension.", 'uncode-core') ,
		"value" => array(
			esc_html__('100%', 'uncode-core') => '',
			esc_html__('75%', 'uncode-core') => 'three_quarter',
			esc_html__('50%', 'uncode-core') => 'half',
			esc_html__('Limit Width', 'uncode-core') => 'limit-width',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'overlay',
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Content Width Full Device", 'uncode-core') ,
		"param_name" => "single_reduced_mobile",
		"description" => esc_html__("Activate this to have 100% content wide on mobile devices.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_reduced',
			'value' => array('three_quarter', 'half'),
		)
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Content horizontal position", 'uncode-core') ,
		"param_name" => "single_h_position",
		"description" => esc_html__("Specify the text horizontal position.", 'uncode-core') ,
		"value" => array(
			esc_html__('Left', 'uncode-core') => 'left',
			esc_html__('Center', 'uncode-core') => 'center',
			esc_html__('Right', 'uncode-core') => 'right'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_reduced',
			'value' => array('three_quarter', 'half'),
		) ,
	) ,
	array(
		"type" => "type_numeric_slider",
		"heading" => esc_html__("Content padding", 'uncode-core') ,
		"param_name" => "single_padding",
		"min" => 0,
		"max" => 5,
		"step" => 1,
		"value" => 2,
		"description" => esc_html__("Set the text/content padding", 'uncode-core') ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Content Padding Vertical", 'uncode-core') ,
		"param_name" => "single_padding_vertical",
		"description" => esc_html__("Activate this to remove lateral padding.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_reduced',
			'value' => array('limit-width'),
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Content Reduced Gap", 'uncode-core') ,
		"param_name" => "single_text_reduced",
		"description" => esc_html__("Activate this to have less space between all the text elements inside the thumbnail.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'custom_grid',
				'sticky-scroll',
				'linear'
			)
		),
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Multiple click areas", 'uncode-core') ,
		"param_name" => "single_elements_click",
		"description" => esc_html__("Activate this to make every single elements clickable instead of the whole block (when availabe). NB. If the Content Layout is set to \"Content Overlay\", activating this will disable the Secondary Image.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'overlay',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Hover Block", 'uncode-core') ,
		"param_name" => "single_thumb_hover",
		"description" => esc_html__("This option extends the hover area over the whole thumbnail (e.g. useful on WooCommerce products).", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'under',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title semantic", 'uncode-core') ,
		"param_name" => "single_title_semantic",
		"description" => esc_html__("Specify element tag.", 'uncode-core') ,
		"value" => $heading_semantic,
		'std' => 'h3',
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title font family", 'uncode-core') ,
		"param_name" => "single_title_family",
		"description" => esc_html__("Specify the title font family.", 'uncode-core') ,
		"value" => $heading_font,
		'std' => '',
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title size", 'uncode-core') ,
		"param_name" => "single_title_dimension",
		"description" => esc_html__("Specify the title dimension.", 'uncode-core') ,
		"value" => $heading_size_h,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Custom size', 'uncode-core') ,
		'param_name' => 'heading_custom_size',
		'description' => esc_html__('Specify a custom font size, ex: clamp(30px,5vw,75px), 4em, etc.', 'uncode-core') ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_title_dimension',
			'value' => array('custom'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title font weight", 'uncode-core') ,
		"param_name" => "single_title_weight",
		"description" => esc_html__("Specify the title font weight.", 'uncode-core') ,
		"value" => $heading_weight,
		'std' => '',
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title text transform", 'uncode-core') ,
		"param_name" => "single_title_transform",
		"description" => esc_html__("Specify the title text transformation.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Uppercase', 'uncode-core') => 'uppercase',
			esc_html__('Lowercase', 'uncode-core') => 'lowercase',
			esc_html__('Capitalize', 'uncode-core') => 'capitalize'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title line height", 'uncode-core') ,
		"param_name" => "single_title_height",
		"description" => esc_html__("Specify the title line height.", 'uncode-core') ,
		"value" => $heading_height,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Title letter spacing", 'uncode-core') ,
		"param_name" => "single_title_space",
		"description" => esc_html__("Specify the title letter spacing.", 'uncode-core') ,
		"value" => $heading_space,
		"group" => esc_html__("Blocks", 'uncode-core') ,
	) ,
	array(
		"type" => 'dropdown',
		'heading' => esc_html__('Title scale mobile', 'uncode-core') ,
		'param_name' => 'single_title_scale_mobile',
		'description' => esc_html__('Activate this to slightly reduce title size on mobile.', 'uncode-core') ,
		"value" => array(
			esc_html__('Yes', 'uncode-core') => '',
			esc_html__('No', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_text',
			'value' => 'overlay' ,
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Title Typography Everything', 'uncode-core') ,
		'param_name' => 'table_general_typo',
		'description' => esc_html__('Apply the title typography to all Meta elements.', 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		),
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('table'),
		) ,
	) ,
	$add_text_size,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Meta typography', 'uncode-core') ,
		'param_name' => 'single_meta_custom_typo',
		'description' => esc_html__('Define custom font settings.', 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		),
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array('isotope','carousel','css_grid', 'custom_grid', 'sticky-scroll', 'linear'),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta font size", 'uncode-core') ,
		"param_name" => "single_meta_size",
		"description" => esc_html__("Specify the meta dimension.", 'uncode-core') ,
		"value" => array(
			esc_html__('Small', 'uncode-core') => '',
			esc_html__('Default', 'uncode-core') => 'default',
			esc_html__('Large', 'uncode-core') => 'large',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta font weight", 'uncode-core') ,
		"param_name" => "single_meta_weight",
		"description" => esc_html__("Specify the meta font weight.", 'uncode-core') ,
		"value" => $heading_weight,
		"std" => '',
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta text transform", 'uncode-core') ,
		"param_name" => "single_meta_transform",
		"description" => esc_html__("Specify the meta text transformation.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Uppercase', 'uncode-core') => 'uppercase',
			esc_html__('Lowercase', 'uncode-core') => 'lowercase',
			esc_html__('Capitalize', 'uncode-core') => 'capitalize'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Meta typography', 'uncode-core') ,
		'param_name' => 'table_meta_custom_typo',
		'description' => esc_html__('Define custom font settings.', 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		),
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'table_general_typo',
			'is_empty' => true,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta font size", 'uncode-core') ,
		"param_name" => "table_meta_size",
		"description" => esc_html__("Specify the meta dimension.", 'uncode-core') ,
		"value" => array(
			esc_html__('Small', 'uncode-core') => '',
			esc_html__('Default', 'uncode-core') => 'default',
			esc_html__('Large', 'uncode-core') => 'large',
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'table_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta font weight", 'uncode-core') ,
		"param_name" => "table_meta_weight",
		"description" => esc_html__("Specify the meta font weight.", 'uncode-core') ,
		"value" =>$heading_weight,
		"std" => '',
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'table_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta text transform", 'uncode-core') ,
		"param_name" => "table_meta_transform",
		"description" => esc_html__("Specify the meta text transformation.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Uppercase', 'uncode-core') => 'uppercase',
			esc_html__('Lowercase', 'uncode-core') => 'lowercase',
			esc_html__('Capitalize', 'uncode-core') => 'capitalize'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'table_meta_custom_typo',
			'not_empty' => true
		) ,
	) ,
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__('Icon', 'uncode-core') ,
		'param_name' => 'single_icon',
		'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
		'settings' => array(
			'emptyIcon' => true,
			'iconsPerPage' => 1100,
			'type' => 'uncode'
		) ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear'
			) ,
		) ,
	) ,
	array(
		'type' => 'vc_link',
		'heading' => esc_html__('Custom link', 'uncode-core') ,
		'param_name' => 'single_link',
		'description' => esc_html__('Enter the custom link for the item.', 'uncode-core') ,
		'group' => esc_html__('Blocks', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Shadow", 'uncode-core') ,
		"param_name" => "single_shadow",
		"description" => esc_html__("Activate this for the shadow effect.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Shadow type", 'uncode-core') ,
		"param_name" => "shadow_weight",
		"description" => esc_html__("Specify the shadow option preset.", 'uncode-core') ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		"value" => array(
			esc_html__('Extra Small', 'uncode-core') => '',
			esc_html__('Small', 'uncode-core') => 'sm',
			esc_html__('Standard', 'uncode-core') => 'std',
			esc_html__('Large', 'uncode-core') => 'lg',
			esc_html__('Extra Large', 'uncode-core') => 'xl',
		) ,
		'dependency' => array(
			'element' => 'single_shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Shadow Darker", 'uncode-core') ,
		"param_name" => "shadow_darker",
		"description" => esc_html__("Activate this for the dark shadow effect.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_shadow',
			'not_empty' => true
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Remove border", 'uncode-core') ,
		"param_name" => "single_border",
		"description" => esc_html__("Activate this to remove the border around the block.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Blocks", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array_merge($add_css_animation_w_parallax, array("group" => esc_html__("Blocks", 'uncode-core'), "param_name" => 'single_css_animation',
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'css_grid',
				'carousel',
				'custom_grid',
				'titles',
				'table',
				'sticky-scroll'
			)
		)
	)),
	array_merge(
		$add_animation_speed,
		array(
			"group" => esc_html__("Blocks", 'uncode-core'),
			"param_name" => 'single_animation_speed',
			'dependency' => array(
				'element' => 'single_css_animation',
				'value' => array(
					'alpha-anim',
					'zoom-in',
					'zoom-out',
					'top-t-bottom',
					'bottom-t-top',
					'left-t-right',
					'right-t-left',
					'curtain',
					'curtain-words',
					'single-curtain',
					'single-slide',
					'single-slide-opposite',
					'typewriter',
				)
			)
		)
	),
	array_merge(
		$add_animation_delay,
		array(
			"group" => esc_html__("Blocks", 'uncode-core'),
			"param_name" => 'single_animation_delay',
			'dependency' => array(
				'element' => 'single_css_animation',
				'value' => array(
					'alpha-anim',
					'zoom-in',
					'zoom-out',
					'top-t-bottom',
					'bottom-t-top',
					'left-t-right',
					'right-t-left',
					'curtain',
					'curtain-words',
					'single-curtain',
					'single-slide',
					'single-slide-opposite',
					'typewriter',
				)
			)
		)
	),
	$add_parallax_options,
	$add_parallax_centered_options,
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Animation sequential", 'uncode-core') ,
		"description" => esc_html__("Specifies whether the animation is applied sequentially.", 'uncode-core') ,
		"param_name" => "single_animation_sequential",
		"group" => esc_html__("Blocks", 'uncode-core') ,
		"value" => array(
			esc_html__('Yes', 'uncode-core') => '',
			esc_html__('No', 'uncode-core')  => 'no',
		) ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'css_grid' ,
		) ,
	) ,
	array(
		"type" => "checkbox",
		"heading" => esc_html__("Animation first items", 'uncode-core') ,
		"description" => esc_html__("Animate only first loop of items in the carousel.", 'uncode-core') ,
		"param_name" => "single_animation_first",
		"group" => esc_html__("Blocks", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'carousel' ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Navigation type", 'uncode-core') ,
		"param_name" => "navigation_type",
		"description" => esc_html__("Select the type of navigation.", 'uncode-core') ,
		"value" => array(
			esc_html__('Prev/Next', 'uncode-core') => '',
			esc_html__('Next', 'uncode-core')      => 'next',
			esc_html__('Prev', 'uncode-core')      => 'prev',
		) ,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'auto_query_type',
			'value'   => 'navigation',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Label position", 'uncode-core') ,
		"param_name" => "navigation_label_position",
		"description" => esc_html__("Select the position of the label.", 'uncode-core') ,
		"value" => array(
			esc_html__('Before Title', 'uncode-core') => '',
			esc_html__('After Title', 'uncode-core')  => 'after',
		) ,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'auto_query_type',
			'value'   => 'navigation',
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Previous text', 'uncode-core') ,
		'param_name' => 'navigation_prev_label',
		'description' => esc_html__('Enter the text for the "Previous" label. Leave empty to disable.', 'uncode-core') ,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'navigation_type',
			'value'   => array( '', 'prev' ),
		) ,
	) ,
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__('Previous icon', 'uncode-core') ,
		'param_name' => 'navigation_prev_icon',
		'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
		'settings' => array(
			'emptyIcon' => true,
			'iconsPerPage' => 1100,
			'type' => 'uncode'
		) ,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'navigation_type',
			'value'   => array( '', 'prev' ),
		) ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Next text', 'uncode-core') ,
		'param_name' => 'navigation_next_label',
		'description' => esc_html__('Enter the text for the "Next" label. Leave empty to disable.', 'uncode-core') ,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'navigation_type',
			'value'   => array( '', 'next' ),
		) ,
	) ,
	array(
		'type' => 'iconpicker',
		'heading' => esc_html__('Next icon', 'uncode-core') ,
		'param_name' => 'navigation_next_icon',
		'description' => esc_html__('Specify icon from library.', 'uncode-core') ,
		'settings' => array(
			'emptyIcon' => true,
			'iconsPerPage' => 1100,
			'type' => 'uncode'
		) ,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'navigation_type',
			'value'   => array( '', 'next' ),
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Icon position", 'uncode-core') ,
		"param_name" => "navigation_icon_position",
		"description" => esc_html__("Select the position of the icon.", 'uncode-core') ,
		"value" => array(
			esc_html__('Title', 'uncode-core') => '',
			esc_html__('Label', 'uncode-core')  => 'label',
		) ,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'auto_query_type',
			'value'   => 'navigation',
		) ,
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Custom label typography', 'uncode-core') ,
		'param_name' => 'navigation_label_custom_typo',
		'description' => esc_html__('Define custom font settings.', 'uncode-core') ,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'value' => array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		),
		'dependency' => array(
			'element' => 'auto_query_type',
			'value'   => 'navigation',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Label font family", 'uncode-core') ,
		"param_name" => "navigation_label_font",
		"description" => esc_html__("Specify text font family.", 'uncode-core') ,
		"value" => $heading_font,
		'std' => '',
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'navigation_label_custom_typo',
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Label font size", 'uncode-core') ,
		"param_name" => "navigation_label_size",
		"description" => esc_html__("Specify a font size.", 'uncode-core') ,
		'std' => '',
		"value" => $navigation_font_size,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'navigation_label_custom_typo',
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Label font weight", 'uncode-core') ,
		"param_name" => "navigation_label_weight",
		"description" => esc_html__("Specify text weight.", 'uncode-core') ,
		"value" => $heading_weight,
		'std' => '',
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'navigation_label_custom_typo',
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Label text transform", 'uncode-core') ,
		"param_name" => "navigation_label_transform",
		"description" => esc_html__("Specify the heading text transformation.", 'uncode-core') ,
		"value" => array(
			esc_html__('Default', 'uncode-core') => '',
			esc_html__('Uppercase', 'uncode-core') => 'uppercase',
			esc_html__('Lowercase', 'uncode-core') => 'lowercase',
			esc_html__('Capitalize', 'uncode-core') => 'capitalize'
		) ,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'navigation_label_custom_typo',
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Label line height", 'uncode-core') ,
		"param_name" => "navigation_label_height",
		"description" => esc_html__("Specify text line height.", 'uncode-core') ,
		"value" => $heading_height,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'navigation_label_custom_typo',
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Label letter spacing", 'uncode-core') ,
		"param_name" => "navigation_label_space",
		"description" => esc_html__("Specify letter spacing.", 'uncode-core') ,
		"value" => $heading_space,
		'group' => esc_html__('Navigation', 'uncode-core') ,
		'dependency' => array(
			'element' => 'navigation_label_custom_typo',
			'value' => array(
				'yes'
			)
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => esc_html__('Type', 'uncode-core') ,
		'param_name' => 'post_matrix',
		'description' => esc_html__('Follow the IDs or create an independent Matrix.', 'uncode-core'),
		'value' => array(
			esc_html__('By ID', 'uncode-core') => '',
			esc_html__('By Matrix', 'uncode-core') => 'matrix',
		) ,
		'std' => '',
		'group' => esc_html__('Single', 'uncode-core'),
	) ,
	array(
		'type' => 'checkbox',
		'heading' => esc_html__('Custom order', 'uncode-core') ,
		'param_name' => 'custom_order',
		'description' => wp_kses(__('Activate this to order the items with drag & drop.<br/>NB. Custom order is only possible when the \'Infinite load more\' or pagination are deactivated.', 'uncode-core'), array( 'br' => array( ) ) ) ,
		'value' => Array(
			esc_html__('Yes, please', 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Single', 'uncode-core'),
		'dependency' => array(
			'element' => 'post_matrix',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'uncode_matrix_set_amount',
		'heading' => esc_html__('Matrix amount', 'uncode-core') ,
		'param_name' => 'matrix_amount',
		'description' => esc_html__('Enter an integer number that will define your matrix range. If you use the pagination mode the max limit is the post count itself.', 'uncode-core') ,
		'group' => esc_html__('Single', 'uncode-core') ,
		'value' => '5',
		'dependency' => array(
			'element' => 'post_matrix',
			'value' => 'matrix',
		) ,
	) ,
	array(
		'type' => 'textfield',
		'edit_field_class' => 'hidden',
		'param_name' => 'order_ids',
		'group' => esc_html__('Single', 'uncode-core') ,
	) ,
	array(
		'type' => 'uncode_items',
		'heading' => 'Items list',
		'param_name' => 'items',
		'description' => esc_html__('Edit single items.') ,
		'group' => esc_html__('Single', 'uncode-core') ,
		'dependency' => array(
			'element' => 'post_matrix',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'uncode_matrix_items',
		'heading' => 'Items list',
		'param_name' => 'matrix_items',
		'description' => esc_html__('Edit single items.') ,
		'group' => esc_html__('Single', 'uncode-core') ,
		'dependency' => array(
			'element' => 'post_matrix',
			'value' => 'matrix',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Remove double tap", 'uncode-core') ,
		"param_name" => "no_double_tap",
		"description" => esc_html__("Remove the double tap action on mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Secondary Image Hidden", 'uncode') ,
		"param_name" => "hide_secondary_mobile",
		"description" => esc_html__("Enable this option to hide the Secondary Image on touch devices.", 'uncode') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode') => 'yes'
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
		'dependency' => array(
			'element' => 'single_secondary',
			'value' => array('yes'),
		)
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Items not Stacked on Tablets", 'uncode-core') ,
		"param_name" => "table_display_tablet",
		"description" => esc_html__("Preserve the Table layout on Tablet.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'table',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Items not Stacked on Mobile", 'uncode-core') ,
		"param_name" => "table_display_mobile",
		"description" => esc_html__("Preserve the Table layout on Mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'table',
			) ,
		) ,
	) ,
	array(
		"type" => "checkbox",
		"heading" => esc_html__("Items Stacked Increased Gap", 'uncode-core') ,
		"description" => esc_html__("Increase the vertical spacing of stacked Items.", 'uncode-core') ,
		"param_name" => "table_mobile_gutter_size",
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'table',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Layout Display Block", 'uncode-core') ,
		"param_name" => "titles_display_mobile",
		"description" => esc_html__("Set the Items Layout to Block on Mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
		'dependency' => array(
			'element' => 'titles_display',
			'value' => 'inline',
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Reduce Items Gap", 'uncode-core') ,
		"param_name" => "titles_gap_reduced_mobile",
		"description" => esc_html__("Set a reduced Items gap on Mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => 'titles',
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Meta Options", 'uncode-core') ,
		"param_name" => "titles_hide_meta_mobile",
		"description" => esc_html__("Set the Meta display mode on Mobile.", 'uncode-core') ,
		"value" => array(
			esc_html__('Select…', 'uncode-core') => '',
			esc_html__('Hide', 'uncode-core') => 'yes',
			esc_html__('Block', 'uncode-core') => 'block',
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
		'dependency' => array(
			'element' => 'drop_image_extra',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Hide Separator", 'uncode-core') ,
		"param_name" => "titles_hide_separator_mobile",
		"description" => esc_html__("Hide the separator on Mobile.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
		'dependency' => array(
			'element' => 'drop_image_separator',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky Scroll Disable Tablet", 'uncode-core') ,
		"param_name" => "no_sticky_scroll_tablet",
		"description" => esc_html__("Disable the Sticky Scroll layout on Tablet. Please note that the elements will be placed on a vertical column.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'sticky-scroll',
			) ,
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky Scroll Disable Device", 'uncode-core') ,
		"param_name" => "no_sticky_scroll_mobile",
		"description" => esc_html__("Disable the Sticky Scroll layout on Device. Please note that the elements will be placed on a vertical column.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'sticky-scroll',
			) ,
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Sticky Scroll Height iOS", 'uncode-core') ,
		"param_name" => "sticky_scroll_mobile_safe_height",
		"description" => esc_html__("If you enable this option only on Safari iOS the browser's address bar is also considered in the height calculation.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'sticky-scroll',
			) ,
		) ,
		"group" => esc_html__("Mobile", 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Desktop Play Hover", 'uncode-core') ,
		"param_name" => "play_hover",
		"description" => esc_html__("Activate this option to have videos that start on hover when a Poster image is set.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Videos', 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced_videos',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Desktop play last frame", 'uncode-core') ,
		"param_name" => "play_pause",
		"description" => esc_html__("Activate this option to have videos that restart from the last frame played, otherwise they restart from the beginning.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Videos', 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced_videos',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Mobile behavior", 'uncode-core') ,
		"param_name" => "mobile_videos",
		"description" => esc_html__("Set the mobile behavior, it's possible to have autoplay video or replace it with the Poster image (suggested option if you have multiple videos on the same page or if the videos are heavy).", 'uncode-core') ,
		"value" => array(
			esc_html__('Replace with poster', 'uncode-core') => '',
			esc_html__('Autoplay videos', 'uncode-core') => 'autoplay',
		) ,
		'group' => esc_html__('Videos', 'uncode-core') ,
		'dependency' => array(
			'element' => 'advanced_videos',
			'not_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => 'Skin',
		'param_name' => 'lbox_skin',
		'value' => array(
			esc_html__('Dark', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'white',
		) ,
		'description' => esc_html__('Specify the lightbox Skin.', 'uncode-core') ,
		'group' => esc_html__('Lightbox', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => 'Transparency',
		'param_name' => 'lbox_transparency',
		'value' => array(
			esc_html__('Semi-Transparent', 'uncode-core') => '',
			esc_html__('Opaque', 'uncode-core') => 'opaque',
		) ,
		'description' => esc_html__('Specify the transparency style of the Lightbox background.', 'uncode-core') ,
		'group' => esc_html__('Lightbox', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => $lbox_enhance ? array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Arrows", 'uncode-core') ,
		"param_name" => "lbox_gallery_arrows",
		"description" => esc_html__("Specify whether to have navigation Arrows or not.", 'uncode-core') ,
		"value" => array(
			esc_html__('Yes', 'uncode-core') => '',
			esc_html__('No', 'uncode-core') => 'no',
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => $lbox_enhance ? array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Arrows Background", 'uncode-core') ,
		"param_name" => "lbox_gallery_arrows_bg",
		"description" => esc_html__("Specify the background transparency.", 'uncode-core') ,
		"value" => array(
			esc_html__('Transparent', 'uncode-core') => '',
			esc_html__('Semi-Transparent', 'uncode-core') => 'semi-transparent',
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_gallery_arrows',
			'is_empty' => true,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		'heading' => 'Direction',
		'param_name' => 'lbox_dir',
		'value' => array(
			esc_html__('Horizontal', 'uncode-core') => '',
			esc_html__('Vertical', 'uncode-core') => 'vertical',
		) ,
		'description' => esc_html__('Specify the lightbox sliding direction.', 'uncode-core') ,
		'group' => esc_html__('Lightbox', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => !$lbox_enhance ? array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Title", 'uncode-core') ,
		"param_name" => "lbox_title",
		"description" => esc_html__("Activate this to add the media title.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Title Link", 'uncode-core') ,
		"param_name" => "lbox_title_link",
		"description" => esc_html__("Enable this option to link the title to the original post when using the Featured Image inside a Lightbox.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'lbox_title',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Caption", 'uncode-core') ,
		"param_name" => "lbox_caption",
		"description" => esc_html__("Activate this to add the media caption.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Social", 'uncode-core') ,
		"param_name" => "lbox_social",
		"description" => esc_html__("Activate this for the social sharing buttons.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Deeplinking", 'uncode-core') ,
		"param_name" => "lbox_deep",
		"description" => esc_html__("Activate this for the deeplinking of every slide.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("No arrows", 'uncode-core') ,
		"param_name" => "lbox_no_arrows",
		"description" => esc_html__("Activate this for not showing the arrows.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => !$lbox_enhance ? array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Actual Size", 'uncode-core') ,
		"param_name" => "lbox_actual_size",
		"description" => esc_html__("Set the magnification to real pixels of the image.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => $lbox_enhance ? array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Fullscreen", 'uncode-core') ,
		"param_name" => "lbox_full",
		"description" => esc_html__("Set the fullscreen magnification on the monitor viewport.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => $lbox_enhance ? array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Download", 'uncode-core') ,
		"param_name" => "lbox_download",
		"description" => esc_html__("Enable image downloading.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => $lbox_enhance ? array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Counter", 'uncode-core') ,
		"param_name" => "lbox_counter",
		"description" => esc_html__("Show the counter with the count of images in the gallery.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => $lbox_enhance ? array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Zoom Origin", 'uncode-core') ,
		"param_name" => "lbox_zoom_origin",
		"description" => esc_html__("Set the zoom effect from the thumbnail, this only works if you are using the image with the original ratio.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => $lbox_enhance ? array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) : 'nothing' ,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("No thumbnails", 'uncode-core') ,
		"param_name" => "lbox_no_tmb",
		"description" => esc_html__("Activate this for not showing the thumbnails.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) ,
		) ,
	) ,
	array(
		"type" => 'dropdown',
		"heading" => esc_html__("Transition", 'uncode-core') ,
		"param_name" => "lbox_transition",
		"description" => esc_html__("Specifies the transition between images. This works if the images have already been preloaded by the plugin script.", 'uncode-core') ,
		"value" => array(
			esc_html__('Slide', 'uncode-core') => '',
			esc_html__('Fade', 'uncode-core') => 'lg-fade',
			esc_html__('Zoom In', 'uncode-core') => 'lg-zoom-in',
			esc_html__('Zoom In Big', 'uncode-core') => 'lg-zoom-in-big',
			esc_html__('Zoom Out', 'uncode-core') => 'lg-zoom-out',
			esc_html__('Zoom Out Big', 'uncode-core') => 'lg-zoom-out-big',
			esc_html__('Zoom Out In', 'uncode-core') => 'lg-zoom-out-in',
			esc_html__('Zoom In Out', 'uncode-core') => 'lg-zoom-in-out',
			esc_html__('Soft Zoom', 'uncode-core') => 'lg-soft-zoom',
			esc_html__('Slide Circular', 'uncode-core') => 'lg-slide-circular',
			esc_html__('Slide Vertical', 'uncode-core') => 'lg-slide-vertical',
			esc_html__('Lollipop', 'uncode-core') => 'lg-lollipop',
			esc_html__('Lollipop Reverse', 'uncode-core') => 'lg-lollipop-rev',
		) ,
		"group" => esc_html__("Lightbox", 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => $lbox_enhance ? array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			) : 'nothing' ,
		) ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Special Cursor", 'uncode-core') ,
		"param_name" => "custom_cursor",
		"description" => esc_html__("Enable this to activate the special curson when you hover over the items.", 'uncode-core') ,
		"value" => array(
			esc_html__('No', 'uncode-core') => '',
			esc_html__('Light', 'uncode-core') => 'light',
			esc_html__('Dark', 'uncode-core') => 'dark',
			esc_html__('Accent', 'uncode-core') => 'accent',
			esc_html__('Difference', 'uncode-core') => 'diff',
			esc_html__('Blur', 'uncode-core') => 'blur',
		) ,
		'group' => esc_html__('Extra', 'uncode-core') ,
		'dependency' => array(
			'element' => 'index_type',
			'value' => array(
				'isotope',
				'carousel',
				'css_grid',
				'table',
				'custom_grid',
				'sticky-scroll',
				'linear',
			)
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Special Cursor Tooltip", 'uncode-core') ,
		"param_name" => "cursor_title",
		"description" => esc_html__("Activate the Cursor textual Tooltip.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'custom_cursor',
			'not_empty' => true,
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Extra', 'uncode-core') ,
	) ,
	array(
		'type' => 'dropdown',
		"heading" => esc_html__("Thumbnail title", 'uncode-core') ,
		"param_name" => "hide_title_tooltip",
		"description" => esc_html__("Use this option to display the original Title element. When using a Tooltip on desktop, it may be useful to show the original thumbnail title only on mobile devices.", 'uncode-core') ,
		"value" => array(
			esc_html__('Hide', 'uncode-core') => '',
			esc_html__('Display on mobile', 'uncode-core') => 'mobile',
			esc_html__('Display on desktop', 'uncode-core') => 'desktop',
			esc_html__('Display always', 'uncode-core') => 'always',
		) ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Tooltip Boing", 'uncode-core') ,
		"param_name" => "cursor_title_boing",
		"description" => esc_html__("Activate the Tooltip Boing effect when moving from one element to another.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Transparent Background", 'uncode-core') ,
		"param_name" => "hide_cursor_bg",
		"description" => esc_html__("Activate to remove the Tooltip background.", 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Custom Tooltip text', 'uncode-core') ,
		'param_name' => 'custom_tooltip',
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
		'description' => esc_html__('Enter a custom text for the Tooltip. Ex: Read More.', 'uncode-core') ,
		'group' => esc_html__('Tooltip', 'uncode-core')
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Extra tooltip class', 'uncode-core') ,
		'param_name' => 'tooltip_class',
		'description' => esc_html__("Enter possible extra classes that allow you to modify the Tooltip style. Ex: 'h2 font-weight-700 font-136269'.", 'uncode-core') ,
		'group' => esc_html__('Tooltip', 'uncode-core') ,
		'dependency' => array(
			'element' => 'cursor_title',
			'not_empty' => true,
		) ,
	) ,
	array(
		"type" => 'checkbox',
		"heading" => esc_html__("Skew", 'uncode-core') ,
		"param_name" => "skew",
		"description" => esc_html__("Apply the Skew scrolling effect.", 'uncode-core') ,
		"value" => Array(
			esc_html__("Yes, please", 'uncode-core') => 'yes'
		) ,
		'group' => esc_html__('Extra', 'uncode-core') ,
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Extra class name', 'uncode-core') ,
		'param_name' => 'el_class',
		'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.', 'uncode-core') ,
		'group' => esc_html__('Extra', 'uncode-core')
	) ,
	array(
		'type' => 'textfield',
		'heading' => esc_html__('Button class name', 'uncode-core') ,
		'param_name' => 'button_class',
		'description' => esc_html__("Define a custom class to change the style of the buttons. Ex: 'btn-underline-out'.", 'uncode-core') ,
		'group' => esc_html__('Extra', 'uncode-core')
	) ,
);

if ( $lbox_enhance ) {
	$uncode_advanced_videos = array(
		array(
			"type" => 'checkbox',
			"heading" => esc_html__("Advanced Videos", 'uncode-core') ,
			"param_name" => "lb_video_advanced",
			"description" => esc_html__("Activate for the advanced video options.", 'uncode-core') ,
			"value" => Array(
				esc_html__("Yes, please", 'uncode-core') => 'yes'
			) ,
			"group" => esc_html__("Lightbox", 'uncode-core') ,
		),
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Autoplay videos", 'uncode-core') ,
			"param_name" => "lb_autoplay",
			"description" => esc_html__("Set the autoplay.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Yes', 'uncode-core') => 'yes',
				esc_html__('No', 'uncode-core') => 'no',
			) ,
			"group" => esc_html__("Lightbox", 'uncode-core') ,
			'dependency' => array(
				'element' => 'lb_video_advanced',
				'not_empty' => true,
			) ,
		),
		array(
			"type" => 'dropdown',
			"heading" => esc_html__("Mute videos", 'uncode-core') ,
			"param_name" => "lb_muted",
			"description" => esc_html__("Set the mute option.", 'uncode-core') ,
			"value" => array(
				esc_html__('Default', 'uncode-core') => '',
				esc_html__('Yes', 'uncode-core') => 'yes',
				esc_html__('No', 'uncode-core') => 'no',
			) ,
			"group" => esc_html__("Lightbox", 'uncode-core') ,
			'dependency' => array(
				'element' => 'lb_video_advanced',
				'not_empty' => true,
			) ,
		),
	);
} else {
	$uncode_advanced_videos = array();
}

$uncode_index_params = array_merge($uncode_index_params_general, $uncode_index_params_first, $uncode_index_params_second, $uncode_index_params_third, $uncode_advanced_videos);

if ( $simplify_single_tab ) {
	foreach ( $uncode_index_params as $uncode_index_param_key => $uncode_index_param_value ) {
		if ( isset( $uncode_index_param_value['group'] ) && ( strpos( $uncode_index_param_value['group'], 'Blocks') !== false ) ) {
			if ( isset( $uncode_index_param_value['param_name'] ) ) {
				if ( in_array( $uncode_index_param_value['param_name'], uncode_core_enabled_simplified_single_options() ) ) {
					$uncode_index_params[$uncode_index_param_key]['param_holder_class'] = 'simple-single-tab-enabled';
				} else {
					$uncode_index_params[$uncode_index_param_key]['param_holder_class'] = 'simple-single-tab-disabled';
				}
			}
		}

		if ( isset( $uncode_index_param_value['type'] ) && $uncode_index_param_value['type'] === 'sorted_list' ) {
			$uncode_index_params[$uncode_index_param_key]['param_holder_class'] = 'simple-single-tab-disabled';
		}
	}
}

$uncode_index_map = array(
	'name' => esc_html__('Posts', 'uncode-core') ,
	'base' => 'uncode_index',
	'weight' => 9950,
	'php_class_name' => 'uncode_index',
	'icon' => 'fa fa-th',
	'category' => array(
		esc_html__('Essentials', 'uncode-core') ,
		esc_html__('Dynamic', 'uncode-core') ,
		esc_html__('WooCommerce Product', 'uncode-core') ,
	),
	'description' => esc_html__('Posts Blog portfolio product masonry grid metro carousel query related index', 'uncode-core') ,
	'params' => $uncode_index_params
);

vc_map($uncode_index_map);
