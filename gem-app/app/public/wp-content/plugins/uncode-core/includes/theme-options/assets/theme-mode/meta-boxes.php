<?php

/**
* Initialize the Uncode Meta Boxes.
*/

function uncode_page_options()
{
	// Return early if Uncode is not active
	if ( ! function_exists( 'uncode_get_current_post_type' ) || ! function_exists( 'uncode_get_post_types' ) || ! function_exists( 'uncode_is_gutenberg_current_editor' ) ) {
		return;
	}

	/*
	* Init vars
	*/

	global $wpdb;

	$portfolio_cpt_name = ot_get_option('_uncode_portfolio_cpt');
	if ($portfolio_cpt_name == '') {
		$portfolio_cpt_name = 'portfolio';
	}

	$fp_post_types = apply_filters('uncode_fullpage_post_types', array('page', 'portfolio', 'post'));

	$post_type = uncode_get_current_post_type();

	if ( $post_type == 'wpb_gutenberg_param' ) {
		return;
	}

	$uncode_post_types = uncode_get_post_types(true);

	$fields = array();

	function run_array_mb($array, $condition = '', $parent = '')
	{
		if ($array === null || $array === '') {
			return false;
		}
		if ( get_option( 'uncode_core_settings_opt_disable_basic_header' ) === 'on' ) {
			if ( strpos( $condition, 'is(header_basic)' ) !== false && strpos( $condition, 'is(header_uncodeblock)' ) === false ) {
				return false;
			}
		}
		$array['condition'] = $condition;
		$array['parent'] = $parent;
		return $array;
	}

	//////////////////////////
	//  General specific   ///
	//////////////////////////

	$specific_body_background = array(
		'id' => '_uncode_specific_body_background',
		'label' => esc_html__('HTML Body background', 'uncode-core') ,
		'desc' => esc_html__('Specify the HTML body background color and media. The background is visible if you have Content > Background Color set to transparent or a Boxed layout.', 'uncode-core') ,
		'type' => 'background',
		'section' => 'uncode_general_section',
	);

	$specific_main_width_inherit = array(
		'id' => '_uncode_specific_main_width_inherit',
		'label' => esc_html__('Limit width', 'uncode-core') ,
		'desc' => esc_html__('Override the global page width value.','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'custom',
				'label' => esc_html__('Custom', 'uncode-core') ,
			) ,
		) ,
	);

	$specific_main_width = array(
		'id' => '_uncode_specific_main_width',
		'label' => false,
		'desc' => false,
		'type' => 'background',
		'section' => 'uncode_general_section',
		'std' => array(
			'1200',
			'px'
		) ,
		'type' => 'measurement',
		'operator' => 'or',
	);

	$specific_cursor = array(
		'id' => '_uncode_specific_custom_cursor',
		'label' => esc_html__('Cursor', 'uncode-core') ,
		'desc' => esc_html__('Selects a cursor type.f','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('Browser', 'uncode-core') ,
			) ,
			array(
				'value' => 'basic-style',
				'label' => esc_html__('Basic', 'uncode-core') ,
			) ,
			array(
				'value' => 'accent-style',
				'label' => esc_html__('Accent', 'uncode-core') ,
			) ,
			array(
				'value' => 'async-style',
				'label' => esc_html__('Asynchronous', 'uncode-core') ,
			) ,
			array(
				'value' => 'diff-style',
				'label' => esc_html__('Difference', 'uncode-core') ,
			) ,
			array(
				'value' => 'blur-style',
				'label' => esc_html__('Blur', 'uncode-core') ,
			),
		) ,
	);

	$specific_cursor_link = array(
		'id' => '_uncode_specific_custom_cursor_links',
		'label' => esc_html__('Cursor on Links', 'uncode-core') ,
		'desc' => esc_html__('Activate the special cursor only when you hover over a link or an element that mimics a link.','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('On', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('Off', 'uncode-core') ,
			) ,
		) ,
	);

	$specific_body_class = array(
		'id' => '_uncode_specific_body_class',
		'label' => esc_html__('Body class', 'uncode-core') ,
		'desc' => esc_html__('If you wish to style this page with extra codes, then use this field to add a class name and then refer to it in your CSS file.','uncode-core'),
		'type' => 'text',
	);

	$general_fields = array(
		array(
			'label' => '<i class="fa fa-globe3 fa-fw"></i> ' . esc_html__('General', 'uncode-core') ,
			'id' => '_uncode_general_tab',
			'type' => 'tab',
		) ,
		run_array_mb($specific_body_background) ,
		run_array_mb($specific_main_width_inherit) ,
		run_array_mb($specific_main_width, '_uncode_specific_main_width_inherit:is(custom)') ,
		run_array_mb($specific_cursor) ,
		run_array_mb($specific_cursor_link) ,
		run_array_mb($specific_body_class) ,
	);

	$fields = array_merge($fields, apply_filters( 'uncode_core_page_options_general_fields', $general_fields));

	///////////////////////
	//  Menu specific   ///
	///////////////////////

	$specific_menu = array(
		'id' => '_uncode_specific_menu',
		'label' => esc_html__('Menu', 'uncode-core') ,
		'desc' => esc_html__('Override the Menu.','uncode-core'),
		'type' => 'menu-select',
		'choices' => array()
	);

	$specific_menu_width = array(
		'id' => '_uncode_specific_menu_width',
		'label' => esc_html__('Menu width', 'uncode-core') ,
		'desc' => esc_html__('Override the Menu width.','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'full',
				'label' => esc_html__('Full', 'uncode-core') ,
			) ,
			array(
				'value' => 'limit',
				'label' => esc_html__('Limit', 'uncode-core') ,
			) ,
		) ,
	);

	$menu_hide = array(
		'id' => '_uncode_specific_menu_remove',
		'label' => esc_html__('Remove navbar', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Activate this option to remove the Navbar (Logo and Menu).', 'uncode-core') ,
		'std' => 'off',
	);

	$menu_opaque = array(
		'id' => '_uncode_specific_menu_opaque',
		'label' => esc_html__('Remove transparency', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Override to remove the transparency eventually declared in \'Customize -> Light/Dark Skin\'.', 'uncode-core') ,
		'std' => 'off',
	);

	$menu_no_shadow = array(
		'id' => '_uncode_specific_menu_no_shadow',
		'label' => esc_html__('Remove shadow', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Remove the shadow if declared in \'Menu -> Visuals -> Menu Divider Shadow\'.', 'uncode-core') ,
		'std' => 'off',
	);

	$menu_no_padding = array(
		'id' => '_uncode_menu_no_padding',
		'label' => esc_html__('No content padding', 'uncode-core') ,
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('Add Content Padding', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('No Content Padding', 'uncode-core') ,
			) ,
		) ,
		'desc' => esc_html__('Remove the content additional top padding (equal to the Menu height) in the Header.', 'uncode-core') ,
		'std' => '',
	);

	$menu_no_padding_mobile = array(
		'id' => '_uncode_menu_no_padding_mobile',
		'label' => esc_html__('No content padding mobile', 'uncode-core') ,
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('Add Content Padding', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('No Content Padding', 'uncode-core') ,
			) ,
		) ,
		'desc' => esc_html__('Remove the content additional top padding (equal to the Menu height) in the Header.', 'uncode-core') ,
		'std' => '',
	);

	$menu_fields = array(
		array(
			'label' => '<i class="fa fa-menu fa-fw"></i> ' . esc_html__('Menu', 'uncode-core') ,
			'id' => '_uncode_menu_tab',
			'type' => 'tab',
		) ,
		run_array_mb($specific_menu) ,
		run_array_mb($specific_menu_width) ,
		run_array_mb($menu_hide) ,
		run_array_mb($menu_opaque) ,
		run_array_mb($menu_no_shadow) ,
	);

	$fields = array_merge($fields, apply_filters( 'uncode_core_page_options_menu_fields', $menu_fields));

	/////////////////////////
	//  Header specific   ///
	/////////////////////////

	$uncodeblock = array(
		'value' => 'header_uncodeblock',
		'label' => esc_html__('Content Block', 'uncode-core') ,
	);

	$uncodeblocks = uncode_core_get_uncodeblocks_for_dropdowns();
	$allpages     = uncode_core_get_pages_for_dropdowns( esc_html__('Inherit', 'uncode-core') );

	if ( class_exists( 'RevSliderFunctionsAdmin' ) )
	{

		$revslider = array(
			'value' => 'header_revslider',
			'label' => esc_html__('Revolution Slider', 'uncode-core') ,
		);

		$rs_slider = new RevSliderFunctionsAdmin();
		$rs = $rs_slider->get_slider_overview();
		$revsliders = array();

		if ($rs)
		{
			foreach ($rs as $slider)
			{
				$revsliders[] = array(
					'value' => $slider['alias'],
					'label' => $slider['title'],
					'postlink' => admin_url( 'admin.php?page=revslider&view=slide&id=' . $slider['slide_id']  ),
				);
			}
		}
		else
		{
			$revsliders[] = array(
				'value' => '',
				'label' => esc_html__('No Revolution Sliders found', 'uncode-core')
			);
		}
	} else {
		$revslider = $revsliders = '';
	}

	if ( class_exists( 'LS_Config' ) )
	{

		$layerslider = array(
			'value' => 'header_layerslider',
			'label' => esc_html__('LayerSlider', 'uncode-core') ,
		);

		$ls = $wpdb->get_results("SELECT id, name FROM " . $wpdb->prefix . "layerslider WHERE flag_deleted != '1' ORDER BY id ASC LIMIT 999");
		$layersliders = array();
		if ($ls)
		{
			foreach ($ls as $slider)
			{
				$layersliders[] = array(
					'value' => $slider->id,
					'label' => $slider->name,
					'postlink' => admin_url( 'admin.php?page=layerslider&action=edit&id=' . $slider->id  ),
				);
			}
		}
		else
		{
			$layersliders[] = array(
				'value' => '',
				'label' => esc_html__('No sliders found', 'uncode-core')
			);
		}
	}
	else $layerslider = $layersliders = '';

	if ( $post_type === 'product' ) {
		$first_row_option = '';
	} else {
		$first_row_option = array(
				'value' => 'first_row',
				'label' => esc_html__('First Row', 'uncode-core') ,
			);
	}

	if ( get_option( 'uncode_core_settings_opt_disable_basic_header' ) !== 'on' ) {
		$basic_header = array(
			'value' => 'header_basic',
			'label' => esc_html__('Default', 'uncode-core') ,
		);
	} else {
		$basic_header = false;
	}

	$header_type = array(
		'id' => '_uncode_header_type',
		'label' => esc_html__('Header Type', 'uncode-core') ,
		'desc' => esc_html__('Set your preferred layout method. Select Default to use the Basic template, or Content Block to create custom layouts with dynamic options.', 'uncode-core') ,
		'std' => '',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'none',
				'label' => esc_html__('None', 'uncode-core') ,
			) ,
			$basic_header,
			$uncodeblock,
			$first_row_option,
			$revslider,
			$layerslider,
		)
	);

	$header_blocks_list = array(
		'id' => '_uncode_blocks_list',
		'label' => esc_html__('Content Block', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'operator' => 'or',
		'choices' => $uncodeblocks,
	);

	$header_revslider_list = array(
		'id' => '_uncode_revslider_list',
		'label' => esc_html__('Revslider', 'uncode-core') ,
		'desc' => esc_html__('Specify the Revolution Slider.', 'uncode-core') ,
		'type' => 'select',
		'post_type' => 'revslider',
		'operator' => 'or',
		'choices' => $revsliders
	);

	$header_layerslider_list = array(
		'id' => '_uncode_layerslider_list',
		'label' => esc_html__('LayerSlider', 'uncode-core') ,
		'desc' => esc_html__('Specify the LayerSlider.', 'uncode-core') ,
		'type' => 'select',
		'post_type' => 'layerslider',
		'operator' => 'or',
		'choices' => $layersliders
	);

	$header_full_width = array(
		'id' => '_uncode_header_full_width',
		'label' => esc_html__('Container full width', 'uncode-core') ,
		'std' => 'on',
		'type' => 'on-off',
		'desc' => esc_html__('Activate to expand the Header container to full width.', 'uncode-core') ,
		'operator' => 'or',
		'condition' => '',
	);

	$header_content_width = array(
		'id' => '_uncode_header_content_width',
		'label' => esc_html__('Content full width', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Activate to expand the Header content to full width.', 'uncode-core') ,
		'std' => 'off',
		'condition' => '',
		'operator' => 'or',
	);

	$header_custom_width = array(
		'id' => '_uncode_header_custom_width',
		'label' => esc_html__('Custom inner width','uncode-core'),
		'desc' => esc_html__('Adjust the inner content width in %.', 'uncode-core') ,
		'std' => '100',
		'type' => 'numeric-slider',
		'min_max_step' => '0,100,1',
		'condition' => '',
		'operator' => 'or'
	);

	$header_align = array(
		'id' => '_uncode_header_align',
		'label' => esc_html__('Content alignment', 'uncode-core') ,
		'desc' => esc_html__('Specify the text/content alignment.', 'uncode-core') ,
		'type' => 'select',
		'condition' => '',
		'operator' => 'or',
		'std' => 'align_center',
		'choices' => array(
			array(
				'value' => 'left',
				'label' => esc_html__('Left', "uncode-core") ,
			) ,
			array(
				'value' => 'center',
				'label' => esc_html__('Center', "uncode-core") ,
			) ,
			array(
				'value' => 'right',
				'label' => esc_html__('Right', "uncode-core") ,
			) ,
		)
	);

	$header_height = array(
		'id' => '_uncode_header_height',
		'label' => esc_html__('Height', 'uncode-core') ,
		'desc' => esc_html__('Define the height of the Header in px or in % (relative to the window height).', 'uncode-core') ,
		'std' => array(
			'50',
			'%'
		) ,
		'type' => 'measurement',
		'condition' => '',
		'operator' => 'or',
	);

	$header_min_height = array(
		'id' => '_uncode_header_min_height',
		'label' => esc_html__('Minimal height', 'uncode-core') ,
		'desc' => esc_html__('Enter a minimun height for the Header in pixel.', 'uncode-core') ,
		'type' => 'text',
	);

	$header_style = array(
		'id' => '_uncode_header_style',
		'label' => esc_html__('Skin', 'uncode-core') ,
		'desc' => esc_html__('Specify the Header text Skin.', 'uncode-core') ,
		'type' => 'select',
		'section' => 'colors',
		'std' => 'dark',
		'condition' => '',
		'operator' => 'or',
		'choices' => array(
			array(
				'value' => 'light',
				'label' => esc_html__('Light', "uncode-core") ,
				'src' => ''
			) ,
			array(
				'value' => 'dark',
				'label' =>  esc_html__('Dark', "uncode-core") ,
				'src' => ''
			)
		)
	);

	$header_position = array(
		'id' => '_uncode_header_position',
		'label' => esc_html__('Position', 'uncode-core') ,
		'desc' => esc_html__('Specify the position of the Header content inside the container.', 'uncode-core') ,
		'std' => 'header-center header-middle',
		'type' => 'select',
		'operator' => 'or',
		'condition' => '',
		'choices' => array(
			array(
				'value' => 'header-left header-top',
				'label' => esc_html__('Left Top', 'uncode-core') ,
			) ,
			array(
				'value' => 'header-left header-center',
				'label' => esc_html__('Left Center', 'uncode-core') ,
			) ,
			array(
				'value' => 'header-left header-bottom',
				'label' => esc_html__('Left Bottom', 'uncode-core') ,
			) ,
			array(
				'value' => 'header-center header-top',
				'label' => esc_html__('Center Top', 'uncode-core') ,
			) ,
			array(
				'value' => 'header-center header-middle',
				'label' => esc_html__('Center Center', 'uncode-core') ,
			) ,
			array(
				'value' => 'header-center header-bottom',
				'label' => esc_html__('Center Bottom', 'uncode-core') ,
			) ,
			array(
				'value' => 'header-right header-top',
				'label' => esc_html__('Right Top', 'uncode-core') ,
			) ,
			array(
				'value' => 'header-right header-center',
				'label' => esc_html__('Right Center', 'uncode-core') ,
			) ,
			array(
				'value' => 'header-right header-bottom',
				'label' => esc_html__('Right Bottom', 'uncode-core') ,
			) ,
		)
	);

	$title_size = array(
		array(
			'value' => 'h1',
			'label' => esc_html__('h1', 'uncode-core')
		),
		array(
			'value' => 'h2',
			'label' => esc_html__('h2', 'uncode-core'),
		),
		array(
			'value' => 'h3',
			'label' => esc_html__('h3', 'uncode-core'),
		),
		array(
			'value' => 'h4',
			'label' => esc_html__('h4', 'uncode-core'),
		),
		array(
			'value' => 'h5',
			'label' => esc_html__('h5', 'uncode-core'),
		),
		array(
			'value' => 'h6',
			'label' => esc_html__('h6', 'uncode-core'),
		),
	);

	$font_sizes = ot_get_option('_uncode_heading_font_sizes');
	if (!empty($font_sizes)) {
		foreach ($font_sizes as $key => $value) {
			$title_size[] = array(
				'value' => $value['_uncode_heading_font_size_unique_id'],
				'label' => $value['title'],
			);
		}
	}

	$title_size[] = array(
		'value' => 'bigtext',
		'label' => esc_html__('BigText', 'uncode-core'),
	);

	$title_height = array(
		array(
			'value' => '',
			'label' => esc_html__('Default', "uncode-core")
		),
	);

	$font_heights = ot_get_option('_uncode_heading_font_heights');
	if (!empty($font_heights)) {
		foreach ($font_heights as $key => $value) {
			$title_height[] = array(
				'value' => $value['_uncode_heading_font_height_unique_id'],
				'label' => $value['title'],
			);
		}
	}

	$title_spacing = array(
		array(
			'value' => '',
			'label' => esc_html__('Default', "uncode-core")
		),
	);

	$font_spacings = ot_get_option('_uncode_heading_font_spacings');
	if (!empty($font_spacings)) {
		foreach ($font_spacings as $key => $value) {
			$title_spacing[] = array(
				'value' => $value['_uncode_heading_font_spacing_unique_id'],
				'label' => $value['title'],
			);
		}
	}

	$title_font = array(
		array(
			'value' => '',
			'label' => esc_html__('Default', "uncode-core"),
		)
	);

	$custom_fonts_array = ot_get_option('_uncode_font_groups');
	if (!empty($custom_fonts_array)) {
		foreach ($custom_fonts_array as $key => $value) {
			$title_font[] = array(
				'value' => $value['_uncode_font_group_unique_id'],
				'label' => $value['title'],
			);
		}
	}

	$title_weight = array(
		array(
			'value' => '',
			'label' => esc_html__('Default', "uncode-core"),
		),
		array(
			'value' => 100,
			'label' => '100',
		),
		array(
			'value' => 200,
			'label' => '200',
		),
		array(
			'value' => 300,
			'label' => '300',
		),
		array(
			'value' => 400,
			'label' => '400',
		),
		array(
			'value' => 500,
			'label' => '500',
		),
		array(
			'value' => 600,
			'label' => '600',
		),
		array(
			'value' => 700,
			'label' => '700',
		),
		array(
			'value' => 800,
			'label' => '800',
		),
		array(
			'value' => 900,
			'label' => '900',
		)
	);

	$header_featured = array(
		'label' => esc_html__('Featured Image in Header', 'uncode-core') ,
		'id' => '_uncode_header_featured',
		'type' => 'on-off',
		'desc' => esc_html__('Activate to use the Featured Image in the Header.', 'uncode-core') ,
		'std' => 'on',
	);

	$header_background = array(
		'id' => '_uncode_header_background',
		'label' => esc_html__('Background', 'uncode-core') ,
		'desc' => esc_html__('Specify the background media and color.', 'uncode-core') ,
		'type' => 'background',
		'condition' => '',
		'operator' => 'or',
		'std' => array(
			'background-color' => 'color-wayh',
		),
	);

	$header_overlay_color = array(
		'id' => '_uncode_header_overlay_color',
		'label' => esc_html__('Overlay color', 'uncode-core') ,
		'desc' => esc_html__('Specify the overlay background color.', 'uncode-core') ,
		'type' => 'uncode_color',
		'condition' => '',
		'operator' => 'or',
	);

	$header_overlay_color_alpha = array(
		'id' => '_uncode_header_overlay_color_alpha',
		'label' => esc_html__('Overlay color opacity', 'uncode-core') ,
		'desc' => esc_html__('Set the overlay opacity.', 'uncode-core') ,
		'std' => '100',
		'min_max_step' => '0,100,1',
		'type' => 'numeric-slider',
		'condition' => '',
		'operator' => 'or',
	);

	$header_scroll_opacity = array(
		'id' => '_uncode_header_scroll_opacity',
		'label' => esc_html__('Scroll opacity', 'uncode-core') ,
		'desc' => esc_html__('Activate alpha animation when scrolling down.', 'uncode-core') ,
		'type' => 'on-off',
		'std' => 'off',
		'condition' => '',
		'operator' => 'or',
	);

	$header_scrolldown = array(
		'id' => '_uncode_header_scrolldown',
		'label' => esc_html__('Scroll down arrow', 'uncode-core') ,
		'desc' => esc_html__('Activate the scroll down arrow button.', 'uncode-core') ,
		'type' => 'on-off',
		'std' => 'off',
		'condition' => '',
		'operator' => 'and',
	);

	$header_name = array(
		'id' => '_uncode_scroll_header_name',
		'label' => esc_html__('Header section name', 'uncode-core') ,
		'desc' => esc_html__('Insert the Header section name, required for the onepage scroll.','uncode-core'),
		'type' => 'text',
	);

	$header_parallax = array(
		'label' => esc_html__('Parallax', 'uncode-core') ,
		'id' => '_uncode_header_parallax',
		'type' => 'on-off',
		'desc' => esc_html__('Activate the background Parallax effect.', 'uncode-core') ,
		'std' => 'off',
		'operator' => 'or',
		'condition' => '',
	);

	$header_kburns = array(
		'label' => esc_html__('Zoom Effect', 'uncode-core') ,
		'id' => '_uncode_header_kburns',
		'desc' => esc_html__('Select the background Zoom effect you prefer.', 'uncode-core') ,
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('None', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Ken Burns', 'uncode-core') ,
			) ,
			array(
				'value' => 'zoom',
				'label' => esc_html__('Zoom Out', 'uncode-core') ,
			) ,
			array(
				'value' => 'magnetic',
				'label' => esc_html__('Magnetic', 'uncode-core') ,
			) ,
		) ,
	);

	$header_title = array(
		'label' => esc_html__('Title in header', 'uncode-core') ,
		'id' => '_uncode_header_title',
		'type' => 'on-off',
		'desc' => esc_html__('Activate to show title in the Header.', 'uncode-core') ,
		'std' => 'on',
	);


	$header_title_font = array(
		'id' => '_uncode_header_title_font',
		'label' => esc_html__('Title font family', 'uncode-core') ,
		'desc' => esc_html__('Specify the font for the Title.', 'uncode-core') ,
		'type' => 'select',
		'choices' => $title_font,
	);

	$header_title_size = array(
		'id' => '_uncode_header_title_size',
		'label' => esc_html__('Title font size', 'uncode-core') ,
		'desc' => esc_html__('Specify the font size for the Title.', 'uncode-core') ,
		'type' => 'select',
		'choices' => $title_size,
	);

	$header_title_height = array(
		'id' => '_uncode_header_title_height',
		'label' => esc_html__('Title line height', 'uncode-core') ,
		'desc' => esc_html__('Specify the line height for the Title.', 'uncode-core') ,
		'type' => 'select',
		'choices' => $title_height,
	);

	$header_title_spacing = array(
		'id' => '_uncode_header_title_spacing',
		'label' => esc_html__('Title letter spacing', 'uncode-core') ,
		'desc' => esc_html__('Specify the letter spacing for the Title.', 'uncode-core') ,
		'type' => 'select',
		'choices' => $title_spacing,
	);

	$header_title_weight = array(
		'id' => '_uncode_header_title_weight',
		'label' => esc_html__('Title font weight', 'uncode-core') ,
		'desc' => esc_html__('Specify the font weight for the Title.', 'uncode-core') ,
		'type' => 'select',
		'choices' => $title_weight,
	);

	$header_title_italic = array(
		'id' => '_uncode_header_title_italic',
		'label' => esc_html__('Title italic', 'uncode-core') ,
		'desc' => esc_html__('Activate the font style italic for the Title.', 'uncode-core') ,
		'type' => 'on-off',
		'std' => 'off'
	);

	$header_title_transform = array(
		'id' => '_uncode_header_title_transform',
		'label' => esc_html__('Title text transform', 'uncode-core') ,
		'desc' => esc_html__('Specify the Title text transformation.', 'uncode-core') ,
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Default', 'uncode-core') ,
			) ,
			array(
				'value' => 'uppercase',
				'label' => esc_html__('Uppercase', 'uncode-core') ,
			) ,
			array(
				'value' => 'lowercase',
				'label' => esc_html__('Lowercase', 'uncode-core') ,
			) ,
			array(
				'value' => 'capitalize',
				'label' => esc_html__('Capitalize', 'uncode-core') ,
			) ,
		)
	);

	$header_title_custom = array(
		'label' => esc_html__('Custom content', 'uncode-core') ,
		'id' => '_uncode_header_title_custom',
		'type' => 'on-off',
		'desc' => esc_html__('Activate custom contents instead of the default page title.', 'uncode-core') ,
		'std' => 'off',
		'condition' => '',
		'operator' => 'and',
	);

	$header_text = array(
		'id' => '_uncode_header_text',
		'label' => esc_html__('Text content', 'uncode-core') ,
		'type' => 'textarea',
	);

	$header_text_animation = array(
		'id' => '_uncode_header_text_animation',
		'label' => esc_html__('Text animation', 'uncode-core') ,
		'desc' => esc_html__('Specify the entrance animation of the Title text.', 'uncode-core') ,
		'type' => 'select',
		'condition' => '',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Select…', 'uncode-core') ,
			) ,
			array(
				'value' => 'top-t-bottom',
				'label' => esc_html__('Top to bottom', 'uncode-core') ,
			) ,
			array(
				'value' => 'left-t-right',
				'label' => esc_html__('Left to right', 'uncode-core') ,
			) ,
			array(
				'value' => 'right-t-left',
				'label' => esc_html__('Right to left', 'uncode-core') ,
			) ,
			array(
				'value' => 'bottom-t-top',
				'label' => esc_html__('Bottom to top', 'uncode-core') ,
			) ,
			array(
				'value' => 'zoom-in',
				'label' => esc_html__('Zoom in', 'uncode-core') ,
			),
			array(
				'value' => 'zoom-out',
				'label' => esc_html__('Zoom out', 'uncode-core') ,
			),
			array(
				'value' => 'alpha-anim',
				'label' => esc_html__('Alpha', 'uncode-core') ,
			)
		)
	);

	$header_animation_delay = array(
		'id' => '_uncode_header_animation_delay',
		'label' => esc_html__('Animation delay', 'uncode-core') ,
		'desc' => esc_html__('Specify the entrance animation delay of the Title text in milliseconds.', 'uncode-core') ,
		'type' => 'select',
		'condition' => '',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('None', 'uncode-core') ,
			) ,
			array(
				'value' => '100',
				'label' => esc_html__('ms 100', 'uncode-core') ,
			) ,
			array(
				'value' => '200',
				'label' => esc_html__('ms 200', 'uncode-core') ,
			) ,
			array(
				'value' => '300',
				'label' => esc_html__('ms 300', 'uncode-core') ,
			) ,
			array(
				'value' => '400',
				'label' => esc_html__('ms 400', 'uncode-core') ,
			) ,
			array(
				'value' => '500',
				'label' => esc_html__('ms 500', 'uncode-core') ,
			) ,
			array(
				'value' => '600',
				'label' => esc_html__('ms 600', 'uncode-core') ,
			) ,
			array(
				'value' => '700',
				'label' => esc_html__('ms 700', 'uncode-core') ,
			) ,
			array(
				'value' => '800',
				'label' => esc_html__('ms 800', 'uncode-core') ,
			) ,
			array(
				'value' => '900',
				'label' => esc_html__('ms 900', 'uncode-core') ,
			) ,
			array(
				'value' => '1000',
				'label' => esc_html__('ms 1000', 'uncode-core') ,
			) ,
			array(
				'value' => '1100',
				'label' => esc_html__('ms 1100', 'uncode-core') ,
			) ,
			array(
				'value' => '1200',
				'label' => esc_html__('ms 1200', 'uncode-core') ,
			) ,
			array(
				'value' => '1300',
				'label' => esc_html__('ms 1300', 'uncode-core') ,
			) ,
			array(
				'value' => '1400',
				'label' => esc_html__('ms 1400', 'uncode-core') ,
			) ,
			array(
				'value' => '1500',
				'label' => esc_html__('ms 1500', 'uncode-core') ,
			) ,
			array(
				'value' => '1600',
				'label' => esc_html__('ms 1600', 'uncode-core') ,
			) ,
			array(
				'value' => '1700',
				'label' => esc_html__('ms 1700', 'uncode-core') ,
			) ,
			array(
				'value' => '1800',
				'label' => esc_html__('ms 1800', 'uncode-core') ,
			) ,
			array(
				'value' => '1900',
				'label' => esc_html__('ms 1900', 'uncode-core') ,
			) ,
			array(
				'value' => '2000',
				'label' => esc_html__('ms 2000', 'uncode-core') ,
			) ,
		),
	);

	$header_animation_speed = array(
		'id' => '_uncode_header_animation_speed',
		'label' => esc_html__('Animation speed', 'uncode-core') ,
		'desc' => esc_html__('Specify the entrance animation speed of the Title text in milliseconds.', 'uncode-core') ,
		'type' => 'select',
		'condition' => '',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Default (400)', 'uncode-core') ,
			) ,
			array(
				'value' => '100',
				'label' => esc_html__('ms 100', 'uncode-core') ,
			) ,
			array(
				'value' => '200',
				'label' => esc_html__('ms 200', 'uncode-core') ,
			) ,
			array(
				'value' => '300',
				'label' => esc_html__('ms 300', 'uncode-core') ,
			) ,
			array(
				'value' => '400',
				'label' => esc_html__('ms 400', 'uncode-core') ,
			) ,
			array(
				'value' => '500',
				'label' => esc_html__('ms 500', 'uncode-core') ,
			) ,
			array(
				'value' => '600',
				'label' => esc_html__('ms 600', 'uncode-core') ,
			) ,
			array(
				'value' => '700',
				'label' => esc_html__('ms 700', 'uncode-core') ,
			) ,
			array(
				'value' => '800',
				'label' => esc_html__('ms 800', 'uncode-core') ,
			) ,
			array(
				'value' => '900',
				'label' => esc_html__('ms 900', 'uncode-core') ,
			) ,
			array(
				'value' => '1000',
				'label' => esc_html__('ms 1000', 'uncode-core') ,
			) ,
		),
	);

	$header_fields = array(
		array(
			'label' => '<i class="fa fa-columns2 fa-fw"></i> ' . esc_html__('Header', 'uncode-core') ,
			'id' => '_uncode_header_tab',
			'type' => 'tab',
		) ,
		run_array_mb($header_type) ,
		run_array_mb($header_blocks_list, '_uncode_header_type:is(header_uncodeblock)') ,
		run_array_mb($header_revslider_list, '_uncode_header_type:is(header_revslider)') ,
		run_array_mb($header_layerslider_list, '_uncode_header_type:is(header_layerslider)') ,
		run_array_mb($header_full_width, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_height, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_min_height, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_custom, '_uncode_header_type:is(header_basic),_uncode_header_title:is(on)') ,
		run_array_mb($header_text, '_uncode_header_type:is(header_basic),_uncode_header_title_custom:is(on)') ,
		run_array_mb($header_style, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_content_width, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_custom_width, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_align, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_position, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_font, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_size, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_height, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_spacing, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_weight, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_transform, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_title_italic, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_text_animation, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_animation_speed, '_uncode_header_type:is(header_basic),_uncode_header_text_animation:not()') ,
		run_array_mb($header_animation_delay, '_uncode_header_type:is(header_basic),_uncode_header_text_animation:not()') ,
		run_array_mb($header_featured, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_background, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_parallax, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_kburns, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_overlay_color, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_overlay_color_alpha, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($header_name, '_uncode_header_type:is(header_basic)') ,
		run_array_mb($menu_no_padding) ,
		run_array_mb($menu_no_padding_mobile) ,
		run_array_mb($header_scroll_opacity, '_uncode_header_type:is(header_basic),_uncode_header_type:is(header_uncodeblock),_uncode_header_type:is(first_row)') ,
		run_array_mb($header_scrolldown, '_uncode_header_type:not(),_uncode_header_type:not(none)') ,
	);

	$fields = array_merge($fields, apply_filters( 'uncode_core_page_options_header_fields', $header_fields));

	///////////////////////
	//  Body specific   ///
	///////////////////////

	//Here below, they are shown on product post type only
	$specific_select_content = array(
		'id' => '_uncode_specific_select_content',
		'label' => esc_html__('Content Type','uncode-core'),
		'desc' => esc_html__('Set your preferred layout method. Select Default to use the Basic template, or Content Block to create custom layouts with dynamic options.', 'uncode-core') ,
		'type' => 'select',
		'class' => $post_type . '_content_block specific_select_content',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'none',
				'label' => esc_html__('None', 'uncode-core') ,
			) ,
			array(
				'value' => 'default',
				'label' => esc_html__('Default', 'uncode-core') ,
			) ,
			array(
				'value' => 'uncodeblock',
				'label' => esc_html__('Content Block', 'uncode-core') ,
			) ,
		) ,
	);
	$specific_select_content_product = $specific_select_content;
	$specific_select_content_product['choices'][] = array(
		'value' => 'description',
		'label' => esc_html__('Page Builder Description', 'uncode-core') ,
	);

	$specific_content_block = array(
		'id' => '_uncode_specific_content_block',
		'label' => esc_html__('Content Block', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'class' => $post_type . '_content_block specific_content_block',
		'choices' => $uncodeblocks,
		'extra_choices' => array(
			''     => esc_html__('Inherit', 'uncode-core'),
			'none' => esc_html__('None', 'uncode-core'),
		),
	);
	//...here above

	$specific_style = array(
		'id' => '_uncode_specific_style',
		'label' => esc_html__('Skin', 'uncode-core') ,
		'desc' => esc_html__('Override the content Skin.', 'uncode-core') ,
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'light',
				'label' => esc_html__('Light', 'uncode-core') ,
			) ,
			array(
				'value' => 'dark',
				'label' => esc_html__('Dark', 'uncode-core') ,
			) ,
		) ,
	);

	$specific_layout_width = array(
		'id' => '_uncode_specific_layout_width',
		'label' => esc_html__('Content width', 'uncode-core') ,
		'desc' => esc_html__('Define the content width.', 'uncode-core'),
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'full',
				'label' => esc_html__('Full', 'uncode-core') ,
			) ,
			array(
				'value' => 'limit',
				'label' => esc_html__('Limit', 'uncode-core') ,
			) ,
		) ,
	);

	$specific_layout_width_custom = array(
		'id' => '_uncode_specific_layout_width_custom',
		'label' => esc_html__('Width value', 'uncode-core') ,
		'desc' => esc_html__('Define the custom width for the content area in px or in %.', 'uncode-core') ,
		'type' => 'measurement',
		'operator' => 'and',
	);

	$specific_breadcrumb = array(
		'id' => '_uncode_specific_breadcrumb',
		'label' => esc_html__('Show breadcrumb', 'uncode-core') ,
		'desc' => esc_html__('Override to show the navigation Breadcrumb.','uncode-core'),
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Yes', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('No', 'uncode-core') ,
			) ,
		),
	);

	$specific_breadcrumb_align = array(
		'id' => '_uncode_specific_breadcrumb_align',
		'label' => esc_html__('Breadcrumb align', 'uncode-core') ,
		'desc' => esc_html__('Specify the Breadcrumb alignment','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Right', 'uncode-core') ,
			) ,
			array(
				'value' => 'center',
				'label' => esc_html__('Center', 'uncode-core') ,
			) ,
			array(
				'value' => 'left',
				'label' => esc_html__('Left', 'uncode-core') ,
			) ,
		) ,
		'operator' => 'and',
	);

	$specific_title = array(
		'id' => '_uncode_specific_title',
		'label' => esc_html__('Show title', 'uncode-core') ,
		'desc' => esc_html__('Override to show the Title in the content area.','uncode-core'),
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Yes', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('No', 'uncode-core') ,
			) ,
		),
	);

	$specific_media_choices_array = array();

	if ( ! uncode_is_gutenberg_current_editor( $post_type ) && !isset( $_GET['vcv-gutenberg-editor'] ) ) {
		$specific_media_choices_array[] = array(
			'value' => '',
			'label' => esc_html__('Inherit', 'uncode-core') ,
		);

		$specific_media_choices_array[] = array(
			'value' => 'on',
			'label' => esc_html__('Yes', 'uncode-core') ,
		);
	}

	$specific_media_choices_array[] = array(
		'value' => 'off',
		'label' => esc_html__('No', 'uncode-core') ,
	);

	$specific_media = array(
		'id' => '_uncode_specific_media',
		'label' => esc_html__('Show media', 'uncode-core') ,
		'desc' => esc_html__('Override to show the Media in the content area.','uncode-core'),
		'type' => 'select',
		'operator' => 'and',
		'choices' => $specific_media_choices_array
	);

	$specific_media_display = array(
		'id' => '_uncode_featured_media_display',
		'label' => esc_html__('Media layout', 'uncode-core') ,
		'desc' => esc_html__('Specify the layout mode for the images section.','uncode-core'),
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'carousel',
				'label' => esc_html__('Carousel', 'uncode-core') ,
			) ,
			array(
				'value' => 'stack',
				'label' => esc_html__('Stack', 'uncode-core') ,
			) ,
			array(
				'value' => 'isotope',
				'label' => esc_html__('Grid', 'uncode-core') ,
			) ,
		),
	);

	$specific_featured_media = array(
		'id' => '_uncode_specific_featured_media',
		'label' => esc_html__('Show featured image', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the Featured Image in the content area.','uncode-core'),
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Yes', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('No', 'uncode-core') ,
			) ,
		),
	);

	$specific_tags = array(
		'id' => '_uncode_specific_tags',
		'label' => esc_html__('Show tags', 'uncode-core') ,
		'desc' => esc_html__('Override to show the Tags module.','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Yes', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('No', 'uncode-core') ,
			) ,
		),
	);

	$specific_tags_align = array(
		'id' => '_uncode_specific_tags_align',
		'label' => esc_html__('Tags alignment', 'uncode-core') ,
		'desc' => esc_html__('Specify the Tags alignment.','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => 'left',
				'label' => esc_html__('Left align', 'uncode-core') ,
				'src' => ''
			) ,
			array(
				'value' => 'center',
				'label' => esc_html__('Center align', 'uncode-core') ,
				'src' => ''
			) ,
			array(
				'value' => 'right',
				'label' => esc_html__('Right align', 'uncode-core') ,
				'src' => ''
			)
		),
		'operator' => 'and',
		'condition' => '_uncode_specific_tags:is(on)',
	);

	$specific_share_w_tags = array(
		'id' => '_uncode_specific_share',
		'label' => esc_html__('Show share', 'uncode-core') ,
		'desc' => esc_html__('Override to show the Share module.','uncode-core'),
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('Hide', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Display above Comments', 'uncode-core') ,
			) ,
			array(
				'value' => 'tags',
				'label' => esc_html__('Display near Tags', 'uncode-core') ,
			) ,
		),
	);

	$specific_share = array(
		'id' => '_uncode_specific_share',
		'label' => esc_html__('Show share', 'uncode-core') ,
		'desc' => esc_html__('Override to show the Share module.','uncode-core'),
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Yes', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('No', 'uncode-core') ,
			) ,
		),
	);

	$specific_image_layout = array(
		'id' => '_uncode_product_image_layout',
		'label' => esc_html__('Media layout', 'uncode-core') ,
		'desc' => esc_html__('Specify the layout mode for the product images section.', 'uncode-core') ,
		'std' => '',
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'std',
				'label' => esc_html__('Standard', 'uncode-core') ,
			) ,
			array(
				'value' => 'stack',
				'label' => esc_html__('Stack', 'uncode-core') ,
			) ,
			array(
				'value' => 'grid',
				'label' => esc_html__('Grid', 'uncode-core') ,
			) ,
		) ,
	);

	$specific_media_size = array(
		'id' => '_uncode_product_media_size',
		'label' => esc_html__('Media layout size', 'uncode-core') ,
		'desc' => esc_html__('Specify the size of the Media layout area.', 'uncode-core') ,
		'std' => '0',
		'min_max_step' => '0,11,1',
		'type' => 'numeric-slider',
		'operator' => 'and',
	);

	$specific_enable_sticky_desc = array(
		'id' => '_uncode_product_sticky_desc',
		'label' => esc_html__('Sticky content', 'uncode-core') ,
		'desc' => esc_html__('Activate to enable Sticky effect for product description. It works with stack layout only.', 'uncode-core') ,
		'std' => '',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('on', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('off', 'uncode-core') ,
			) ,
		) ,
		'operator' => 'and',
	);

	$specific_enable_woo_zoom = array(
		'id' => '_uncode_product_enable_zoom',
		'label' => esc_html__('Zoom', 'uncode-core') ,
		'desc' => esc_html__('Activate to enable drag Zoom effect on product image.', 'uncode-core') ,
		'std' => '',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('on', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('off', 'uncode-core') ,
			) ,
		) ,
	);

	$specific_thumb_cols = array(
		'id' => '_uncode_thumb_cols',
		'label' => esc_html__('Thumbnails columns', 'uncode-core') ,
		'desc' => esc_html__('Specify how many columns to display for your product Gallery thumbs.', 'uncode-core') ,
		'std' => '',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => '2',
				'label' => '2',
			) ,
			array(
				'value' => '3',
				'label' => '3',
			) ,
			array(
				'value' => '4',
				'label' => '4',
			) ,
			array(
				'value' => '5',
				'label' => '5',
			) ,
			array(
				'value' => '6',
				'label' => '6',
			) ,
		) ,
		'operator' => 'and',
		'condition' => '_uncode_product_image_layout:is()',
	);

	$specific_enable_woo_slider = array(
		'id' => '_uncode_product_enable_slider',
		'label' => esc_html__('Thumbnails carousel', 'uncode-core') ,
		'desc' => esc_html__('Activate to enable Carousel Slider when you click Gallery thumbs.', 'uncode-core') ,
		'std' => '',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('on', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('off', 'uncode-core') ,
			) ,
		) ,
		'operator' => 'and',
		'condition' => '_uncode_product_image_layout:is()',
	);

	$specific_content_block_before = array(
		'id' => '_uncode_specific_content_block_before',
		'label' => esc_html__('Content Block - Before Content', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'choices' => $uncodeblocks,
		'extra_choices' => array(
			''     => esc_html__('Inherit', 'uncode-core'),
			'none' => esc_html__('None', 'uncode-core'),
		),
	);

	$specific_content_block_after_pre = array(
		'id' => '_uncode_specific_content_block_after_pre',
		'label' => esc_html__('After Content (Author Profile)', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'choices' => $uncodeblocks,
		'extra_choices' => array(
			''     => esc_html__('Inherit', 'uncode-core'),
			'none' => esc_html__('None', 'uncode-core'),
		),
	);

	if ($post_type === 'product') {
		$related_post_after_extras = array(
			''        => esc_html__('Inherit', 'uncode-core'),
			'default' => esc_html__('Default', 'uncode-core'),
			'none'    => esc_html__('None', 'uncode-core'),
		);
	} else {
		$related_post_after_extras = array(
			''     => esc_html__('Inherit', 'uncode-core'),
			'none' => esc_html__('None', 'uncode-core'),
		);
	}
	$specific_content_block_after = array(
		'id' => '_uncode_specific_content_block_after',
		'label' => esc_html__('After Content (Related Posts)', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'choices' => $uncodeblocks,
		'extra_choices' => $related_post_after_extras
	);

	$specific_bg_color = array(
		'id' => '_uncode_specific_bg_color',
		'label' => esc_html__('Background color', 'uncode-core') ,
		'desc' => esc_html__('Specify a custom content background color.', 'uncode-core') ,
		'type' => 'uncode_colors_w_transp',
		'operator' => 'and',
	);

	$body_fields = array(
		array(
			'label' => '<i class="fa fa-layout fa-fw"></i> ' . esc_html__('Content', 'uncode-core') ,
			'id' => '_uncode_body_tab',
			'type' => 'tab',
		) ,
	);

	if ($post_type !== 'product') {
		$body_fields[] = run_array_mb($specific_select_content);
	} else {
		$body_fields[] = run_array_mb($specific_select_content_product);
	}
	$body_fields[] = run_array_mb($specific_content_block, '_uncode_specific_select_content:is(uncodeblock)');
	$body_fields[] = run_array_mb($specific_style, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	$body_fields[] = run_array_mb($specific_bg_color, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	$body_fields[] = run_array_mb($specific_layout_width, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	$body_fields[] = run_array_mb($specific_layout_width_custom, '_uncode_specific_layout_width:is(limit),_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	$body_fields[] = run_array_mb($specific_breadcrumb, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	$body_fields[] = run_array_mb($specific_breadcrumb_align, '_uncode_specific_breadcrumb:is(on),_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	//$body_fields[] = run_array_mb($specific_content_block_before);
	$body_fields[] = run_array_mb($specific_title, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	$body_fields[] = run_array_mb($specific_media, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	$body_fields[] = run_array_mb($specific_featured_media, '_uncode_specific_media:not(on),_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	if ($post_type === 'post') {
		$body_fields[] = run_array_mb($specific_share_w_tags, '_uncode_specific_media:not(on),_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	} else {
		$body_fields[] = run_array_mb($specific_share, '_uncode_specific_media:not(on),_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
	}
	if ($post_type === 'post' || $post_type === 'page' || $post_type === 'portfolio' ) {
		$body_fields[] = run_array_mb($specific_media_display, '_uncode_specific_media:not(off),_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(none)');
	}
	if ($post_type === 'product') {
		$body_fields[] = run_array_mb($specific_image_layout, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
		$body_fields[] = run_array_mb($specific_media_size, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
		$body_fields[] = run_array_mb($specific_enable_sticky_desc, '_uncode_product_image_layout:not(std),_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
		$body_fields[] = run_array_mb($specific_enable_woo_zoom, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
		$body_fields[] = run_array_mb($specific_thumb_cols, '_uncode_product_image_layout:not(stack),_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
		if ( ot_get_option( '_uncode_woocommerce_default_product_gallery' ) !== 'on' ) {
			$body_fields[] = run_array_mb($specific_enable_woo_slider, '_uncode_product_image_layout:not(stack),_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(description),_uncode_specific_select_content:not(none)');
		}
	}

	if ($post_type === 'post') {
		$body_fields[] = run_array_mb($specific_tags, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(none)');
		$body_fields[] = run_array_mb($specific_tags_align, '_uncode_specific_select_content:not(uncodeblock),_uncode_specific_select_content:not(none),_uncode_specific_tags:is(on)');
		$body_fields[] = run_array_mb($specific_content_block_after_pre);
	}

	$body_fields[] = run_array_mb($specific_content_block_after);

	$fields = array_merge($fields, apply_filters( 'uncode_core_page_options_body_fields', $body_fields ) );

	if ($post_type !== 'product' && $post_type !== 'portfolio') {

		//////////////////////////
		//  Sidebar specific   ///
		//////////////////////////

		$active_sidebar = array(
			'id' => '_uncode_active_sidebar',
			'label' => esc_html__('Activate sidebar', 'uncode-core') ,
			'desc' => esc_html__('Override the Sidebar visibility.', 'uncode-core') ,
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Inherit', 'uncode-core') ,
				) ,
				array(
					'value' => 'on',
					'label' => esc_html__('Yes', 'uncode-core') ,
				) ,
				array(
					'value' => 'off',
					'label' => esc_html__('No', 'uncode-core') ,
				) ,
			),
		);

		$sidebar = array(
			'id' => '_uncode_sidebar',
			'label' => esc_html__('Sidebar', 'uncode-core') ,
			'desc' => esc_html__('Specify the Sidebar.', 'uncode-core') ,
			'type' => 'sidebar-select',
			'operator' => 'or',
		);

		$sidebar_position = array(
			'id' => '_uncode_sidebar_position',
			'label' => esc_html__('Position', 'uncode-core') ,
			'desc' => esc_html__('Specify the position of the Sidebar.', 'uncode-core') ,
			'type' => 'select',
			'choices' => array(
				array(
					'value' => 'sidebar_right',
					'label' => esc_html__('Right', 'uncode-core') ,
				) ,
				array(
					'value' => 'sidebar_left',
					'label' => esc_html__('Left', 'uncode-core') ,
				) ,
			) ,
			'operator' => 'and',
		);

		$sidebar_size = array(
			'id' => '_uncode_sidebar_size',
			'label' => esc_html__('Size', 'uncode-core') ,
			'desc' => esc_html__('Set the size of the Sidebar.', 'uncode-core') ,
			'std' => '4',
			'min_max_step' => '1,11,1',
			'type' => 'numeric-slider',
			'operator' => 'and',
		);

		$sidebar_sticky = array(
			'id' => '_uncode_sidebar_sticky',
			'label' => esc_html__('Sticky sidebar', 'uncode-core') ,
			'desc' => esc_html__('Activate to have a Sticky Sidebar.', 'uncode-core') ,
			'type' => 'on-off',
			'std' => 'off',
			'operator' => 'and',
		);

		$sidebar_style = array(
			'id' => '_uncode_sidebar_style',
			'label' => esc_html__('Skin', 'uncode-core') ,
			'desc' => esc_html__('Override the Sidebar text Skin.', 'uncode-core') ,
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Inherit', "uncode-core") ,
				) ,
				array(
					'value' => 'light',
					'label' => esc_html__('Light', "uncode-core") ,
				) ,
				array(
					'value' => 'dark',
					'label' => esc_html__('Dark', "uncode-core") ,
				)
			),
			'operator' => 'and',
		);

		$sidebar_bgcolor = array(
			'id' => '_uncode_sidebar_bgcolor',
			'label' => esc_html__('Background color', 'uncode-core') ,
			'desc' => esc_html__('Specify the Sidebar background color.', 'uncode-core') ,
			'type' => 'uncode_color',
			'operator' => 'and',
		);

		$sidebar_fill = array(
			'id' => '_uncode_sidebar_fill',
			'label' => esc_html__('Sidebar filling space', 'uncode-core') ,
			'desc' => esc_html__('Activate to remove padding around the Sidebar and fill the height.', 'uncode-core') ,
			'type' => 'on-off',
			'std' => 'off',
			'operator' => 'and',
		);

		// $sidebar_widget_collapse = array(
		// 	'id' => '_uncode_sidebar_widget_collapse',
		// 	'label' => esc_html__('Mobile collapse', 'uncode-core') ,
		// 	'desc' => esc_html__('Activate to collapse the widgets on mobile devices.', 'uncode-core') ,
		// 	'type' => 'on-off',
		// 	'std' => 'off',
		// 	'operator' => 'and',
		// );

		// $sidebar_widget_collapse_tablet = array(
		// 	'id' => '_uncode_sidebar_widget_collapse_tablet',
		// 	'label' => esc_html__('Tablet collapse', 'uncode-core') ,
		// 	'desc' => esc_html__('Activate to collapse the widgets on tablet devices.', 'uncode-core') ,
		// 	'type' => 'on-off',
		// 	'std' => 'on',
		// 	'operator' => 'and',
		// );

		$sidebar_fields = array(
			array(
				'label' => '<i class="fa fa-content-right fa-fw"></i> ' . esc_html__('Sidebar', 'uncode-core') ,
				'id' => '_uncode_sidebar_tab',
				'type' => 'tab',
			) ,
			run_array_mb($active_sidebar) ,
			run_array_mb($sidebar, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_position, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_size, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_sticky, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_style, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_bgcolor, '_uncode_active_sidebar:is(on)') ,
			run_array_mb($sidebar_fill, '_uncode_active_sidebar:is(on),_uncode_sidebar_bgcolor:not()') ,
			// run_array_mb($sidebar_widget_collapse, '_uncode_active_sidebar:is(on)') ,
			// run_array_mb($sidebar_widget_collapse_tablet, '_uncode_sidebar_widget_collapse:is(on)') ,
		);

		$fields = array_merge($fields, apply_filters( 'uncode_core_page_options_sidebar_fields', $sidebar_fields));

	}

	if ($post_type === 'portfolio') {

		////////////////////////////
		//  Portfolio specific   ///
		////////////////////////////

		$portfolio_details = ot_get_option('_uncode_portfolio_details');

		if (isset($portfolio_details) && !empty($portfolio_details))
		{
			foreach ($portfolio_details as $key => $value)
			{
				$portfolio_details[$key]['id'] = $value['_uncode_portfolio_detail_unique_id'];
				$portfolio_details[$key]['label'] = $value['title'];
				$portfolio_details[$key]['type'] = 'text';
				//$portfolio_details[$key]['condition'] = '_uncode_portfolio_active:not(off)';
			}
		}

		$portfolio_fields = array(
			array(
				'label' => '<i class="fa fa-briefcase3 fa-fw"></i> ' . esc_html__('Details', 'uncode-core') ,
				'id' => '_uncode_portfolio_tab',
				'type' => 'tab',
			) ,
			array(
				'id' => '_uncode_portfolio_active',
				'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('details', 'uncode-core') ,
				'desc' => sprintf( esc_html__('Override the %s visibility.','uncode-core'), $portfolio_cpt_name),
				'type' => 'select',
				'choices' => array(
					array(
						'value' => '',
						'label' => esc_html__('Inherit', 'uncode-core') ,
					) ,
					array(
						'value' => 'on',
						'label' => esc_html__('Yes', 'uncode-core') ,
					) ,
					array(
						'value' => 'off',
						'label' => esc_html__('No', 'uncode-core') ,
					) ,
				),
				'operator' => 'and',
				'condition' => '_uncode_specific_select_content:not(none),_uncode_specific_select_content:not(uncodeblock)',
			) ,
			array(
				'id' => '_uncode_portfolio_position',
				'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('details layout', 'uncode-core') ,
				'desc' => sprintf(esc_html__('Specify the layout template for all the %s posts.', 'uncode-core') , $portfolio_cpt_name) ,
				'type' => 'select',
				'choices' => array(
					array(
						'value' => 'portfolio_top',
						'label' => esc_html__('Details on the top', 'uncode-core') ,
					) ,
					array(
						'value' => 'sidebar_right',
						'label' => esc_html__('Details on the right', 'uncode-core') ,
					) ,
					array(
						'value' => 'portfolio_bottom',
						'label' => esc_html__('Details on the bottom', 'uncode-core') ,
					) ,
					array(
						'value' => 'sidebar_left',
						'label' => esc_html__('Details on the left', 'uncode-core') ,
					) ,
				),
				'operator' => 'and',
				'condition' => '_uncode_specific_select_content:not(none),_uncode_specific_select_content:not(uncodeblock),_uncode_portfolio_active:is(on)',
			) ,
			array(
				'id' => '_uncode_portfolio_sidebar_size',
				'label' => esc_html__('Sidebar size', 'uncode-core') ,
				'desc' => esc_html__('Set the Sidebar size.', 'uncode-core') ,
				'std' => '4',
				'min_max_step' => '1,12,1',
				'type' => 'numeric-slider',
				'operator' => 'and',
				'condition' => '_uncode_specific_select_content:not(none),_uncode_specific_select_content:not(uncodeblock),_uncode_portfolio_position:contains(sidebar),_uncode_portfolio_active:is(on)',
			) ,
			array(
				'id' => '_uncode_portfolio_sidebar_sticky',
				'label' => esc_html__('Sticky sidebar', 'uncode-core') ,
				'desc' => esc_html__('Activate to have a Sticky Sidebar.', 'uncode-core') ,
				'type' => 'on-off',
				'std' => 'off',
				'operator' => 'and',
				'condition' => '_uncode_specific_select_content:not(none),_uncode_specific_select_content:not(uncodeblock),_uncode_portfolio_position:contains(sidebar),_uncode_portfolio_active:is(on)',
			) ,
			array(
				'id' => '_uncode_portfolio_style',
				'label' => esc_html__('Skin', 'uncode-core') ,
				'desc' => esc_html__('Override the Sidebar text Skin.', 'uncode-core') ,
				'type' => 'select',
				'choices' => array(
					array(
						'value' => '',
						'label' => esc_html__('Inherit', "uncode-core") ,
					) ,
					array(
						'value' => 'light',
						'label' => esc_html__('Light', "uncode-core") ,
					) ,
					array(
						'value' => 'dark',
						'label' => esc_html__('Dark', "uncode-core") ,
					)
				),
				'operator' => 'and',
				'condition' => '_uncode_specific_select_content:not(none),_uncode_specific_select_content:not(uncodeblock),_uncode_portfolio_active:is(on)',
			) ,
			array(
				'id' => '_uncode_portfolio_bgcolor',
				'label' => esc_html__('Background color', 'uncode-core') ,
				'desc' => esc_html__('Specify the background color.', 'uncode-core') ,
				'type' => 'uncode_color',
				'operator' => 'and',
				'condition' => '_uncode_specific_select_content:not(none),_uncode_specific_select_content:not(uncodeblock),_uncode_portfolio_active:is(on)',
			) ,
			array(
				'id' => '_uncode_portfolio_sidebar_fill',
				'label' => esc_html__('Sidebar filling space', 'uncode-core') ,
				'desc' => esc_html__('Activate to remove padding around the Sidebar and fill the height.', 'uncode-core') ,
				'type' => 'on-off',
				'std' => 'off',
				'operator' => 'and',
				'condition' => '_uncode_specific_select_content:not(none),_uncode_specific_select_content:not(uncodeblock),_uncode_portfolio_position:contains(sidebar),_uncode_portfolio_bgcolor:not(),_uncode_portfolio_active:is(on)',
			) ,
		);

		if (!empty($portfolio_details)) $portfolio_fields = array_merge($portfolio_fields, $portfolio_details);

		$fields = array_merge($fields, apply_filters( 'uncode_core_page_options_portfolio_fields', $portfolio_fields));

	}

	if ($post_type !== 'page') {

		$ppp_fields = array(
			array(
				'label' => '<i class="fa fa-location fa-fw"></i> ' . esc_html__('Navigation', 'uncode-core') ,
				'id' => '_uncode_navigation_tab',
				'type' => 'tab',
			) ,
			array(
				'id' => '_uncode_specific_navigation_hide',
				'label' => esc_html__('Navigation Type','uncode-core'),
				'desc' => esc_html__('Activate to show the navigation bar. Set your preferred layout method. Select Default to use the Basic template, or Content Block to create custom layouts with the Navigation module.', 'uncode-core') ,
				'type' => 'select',
				'std' => '',
				'choices' => array(
					array(
						'value' => '',
						'label' => esc_html__('Inherit', 'uncode-core') ,
					) ,
					array(
						'value' => 'on',
						'label' => esc_html__('None', 'uncode-core') ,
					) ,
					array(
						'value' => 'default',
						'label' => esc_html__('Default', 'uncode-core') ,
					) ,
					array(
						'value' => 'uncodeblock',
						'label' => esc_html__('Content Block', 'uncode-core') ,
					) ,
				) ,
			) ,
			array(
				'id' => '_uncode_specific_navigation_content_block',
				'label' => esc_html__('Navigation Content Block', 'uncode-core') ,
				'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
				'type' => 'custom-post-type-select',
				'post_type' => 'uncodeblock',
				'choices' => $uncodeblocks,
				'extra_choices' => array(
					''     => esc_html__('Inherit', 'uncode-core'),
				),
				'operator' => 'and',
				'condition' => '_uncode_specific_navigation_hide:is(uncodeblock)',

			) ,
			array(
				'id' => '_uncode_specific_navigation_index',
				'label' => esc_html__( 'Navigation index', 'uncode-core' ),
				'type' => 'page-select',
				'desc' => esc_html__('Specify the page you want to use as index.', 'uncode-core') ,
				'choices' => $allpages,
			) ,
		);

		$fields = array_merge($fields, apply_filters( 'uncode_core_page_options_navigation_fields', $ppp_fields));

	}

	/////////////////////////
	//  Footer specific   ///
	/////////////////////////

	$specific_footer_blocks_list = array(
		'id' => '_uncode_specific_footer_block',
		'label' => esc_html__('Content Block', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'operator' => 'or',
		'choices' => $uncodeblocks,
		'extra_choices' => array(
			''     => esc_html__('Inherit', 'uncode-core'),
			'none' => esc_html__('None', 'uncode-core'),
		),
	);

	$specific_footer_width = array(
		'id' => '_uncode_specific_footer_width',
		'label' => esc_html__('Footer width', 'uncode-core') ,
		'desc' => esc_html__('Override the Footer width.' ,'uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'full',
				'label' => esc_html__('Full', 'uncode-core') ,
			) ,
			array(
				'value' => 'limit',
				'label' => esc_html__('Limit', 'uncode-core') ,
			) ,
		) ,
	);

	$specific_copy_hide = array(
		'id' => '_uncode_specific_copy_hide',
		'label' => esc_html__('Hide Copyright Area', 'uncode-core') ,
		'type' => 'select',
		'desc' => esc_html__('Activate this to hide the Copyright Area.', 'uncode-core') ,
		'std' => '',
		'choices' => array(
			array(
				'value' => 'off',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Hide', 'uncode-core') ,
			) ,
			array(
				'value' => 'show',
				'label' => esc_html__('Show', 'uncode-core') ,
			) ,
		) ,
	);

	$specific_uparrow_hide = array(
		'id' => '_uncode_specific_footer_uparrow_hide',
		'label' => esc_html__('Hide Scroll Up', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Remove the Scroll Up button in the Footer.', 'uncode-core') ,
		'std' => 'off',
	);

	$footer_fields = array(
		array(
			'label' => '<i class="fa fa-ellipsis fa-fw"></i> ' . esc_html__('Footer', 'uncode-core') ,
			'id' => '_uncode_footer_tab',
			'type' => 'tab',
		) ,
		run_array_mb($specific_footer_blocks_list) ,
		run_array_mb($specific_footer_width) ,
		run_array_mb($specific_copy_hide) ,
		run_array_mb($specific_uparrow_hide) ,
	);

	$fields = array_merge($fields, apply_filters( 'uncode_core_page_options_footer_fields', $footer_fields));

	//////////////////////////
	//        Scroll        //
	//////////////////////////

	$array_scroll = array(
		array(
			'value' => '',
			'label' => esc_html__('None', 'uncode-core') ,
		) ,
		array(
			'value' => 'on',
			'label' => esc_html__('Simple Scroll', 'uncode-core') ,
		)
	);

	if (in_array($post_type, $fp_post_types)) {
		$array_scroll[] = array(
			'value' => 'slide',
			'label' => esc_html__('Slides Scroll', 'uncode-core') ,
		);
	}


	$page_scroll = array(
		'id' => '_uncode_page_scroll',
		'label' => esc_html__('Type *', 'uncode-core') ,
		'type' => 'select',
		'desc' => esc_html__('Set the single page scrolling method. NB. For performance reasons, these options are disabled while working with the Frontend Editor.','uncode-core'),
		'std' => 'off',
		'choices' => $array_scroll
	);

	$specific_smooth_scroll = array(
		'id' => '_uncode_specific_smooth_scroll',
		'label' => esc_html__('Smooth Scroll', 'uncode-core') ,
		'desc' => esc_html__('Enable this option to create a smoother scrolling experience on your page.','uncode-core'),
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('On', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('Off', 'uncode-core') ,
			) ,
		) ,
	);

	$scroll_snap = array(
		'id' => '_uncode_scroll_snap',
		'label' => esc_html__('Scroll Snap', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Add Scroll Snap effect (smoothly snaps to rows) on page scroll.', 'uncode-core') ,
		'std' => 'off',
	);

	$specific_skew = array(
		'id' => '_uncode_specific_skew',
		'label' => esc_html__('Skew', 'uncode-core') ,
		'desc' => esc_html__('Apply the Skew effect at the page scroll.','uncode-core'),
		'type' => 'select',
		'operator' => 'and',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('On', 'uncode-core') ,
			) ,
			array(
				'value' => 'off',
				'label' => esc_html__('Off', 'uncode-core') ,
			) ,
		) ,
	);

	$fullpage_type = array(
		'id' => '_uncode_fullpage_type',
		'label' => esc_html__('Effect', 'uncode-core') ,
		'desc' => esc_html__('Specify the transition effect.','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => 'curtain',
				'label' => esc_html__('Curtain', 'uncode-core') ,
			) ,
			array(
				'value' => 'parallax',
				'label' => esc_html__('Parallax', 'uncode-core') ,
			) ,
			array(
				'value' => 'zoom',
				'label' => esc_html__('Zoom', 'uncode-core') ,
			) ,
			array(
				'value' => 'trid',
				'label' => esc_html__('3D', 'uncode-core') ,
			) ,
		) ,
	);

	$fp_opacity = array(
		'id' => '_uncode_fullpage_opacity',
		'label' => esc_html__('Opacity', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Add opacity effect during the transition. NB. In complex page layouts this option can slow down your transitions.', 'uncode-core') ,
		'std' => 'off',
	);

	$scroll_history = array(
		'id' => '_uncode_scroll_history',
		'label' => esc_html__('Disable history', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Disable the Browser URL History (Hash navigation).', 'uncode-core') ,
		'std' => 'off',
	);

	$scroll_safe_padding = array(
		'id' => '_uncode_scroll_safe_padding',
		'label' => esc_html__('Safe padding', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('With the Menu transparent add the Menu height, when you don’t customise the row padding, as padding to your contents to avoid overlapping with the Menu itself.', 'uncode-core') ,
		'std' => 'on',
	);

	$scroll_additional_padding = array(
		'id' => '_uncode_scroll_additional_padding',
		'label' => esc_html__('Safe padding additional', 'uncode-core') ,
		'desc' => esc_html__('Add extra padding to the Safe Padding option.', 'uncode-core') ,
		'std' => '0',
		'min_max_step' => '0,54,18',
		'type' => 'numeric-slider',
		'operator' => 'and',
	);

	$scroll_dots = array(
		'id' => '_uncode_scroll_dots',
		'label' => esc_html__('Hide dots', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Hide the dots navigation.', 'uncode-core') ,
		'std' => 'off',
	);

	$empty_dots = array(
		'id' => '_uncode_empty_dots',
		'label' => esc_html__('Show empty dots', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Display empty dots without specifying a Row Name (dots navigation label).', 'uncode-core') ,
		'std' => 'off',
	);

	$fullpage_menu = array(
		'id' => '_uncode_fullpage_menu',
		'label' => esc_html__('Menu', 'uncode-core') ,
		'desc' => esc_html__('Set the animation for the Menu. NB. When you use the Slides Scroll the default Menu behaviour is Sticky.','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Default', 'uncode-core') ,
			) ,
			array(
				'value' => 'hide',
				'label' => esc_html__('Hide after first slide', 'uncode-core') ,
			) ,
		) ,
	);

	$mobile_scroll = array(
		'id' => '_uncode_fullpage_mobile',
		'label' => esc_html__('Disable Mobile', 'uncode-core') ,
		'desc' => esc_html__('Deactivate the Slide Scroll for small devices.','uncode-core'),
		'type' => 'on-off',
		'std' => 'off',
	);

	if ( ! uncode_is_gutenberg_current_editor( $post_type ) ) {

		$scroller_fields = array(
			array(
				'label' => '<i class="fa fa-download3 fa-fw"></i> ' . esc_html__('Scroll', 'uncode-core') ,
				'id' => '_uncode_scroll_tab',
				'type' => 'tab',
			) ,
			run_array_mb($specific_smooth_scroll),
			run_array_mb($page_scroll),
			run_array_mb($fullpage_type,'_uncode_page_scroll:is(slide)'),
			run_array_mb($fp_opacity,'_uncode_page_scroll:is(slide),_uncode_fullpage_type:not(none)'),
			run_array_mb($scroll_dots,'_uncode_page_scroll:not()'),
			run_array_mb($empty_dots,'_uncode_page_scroll:is(slide),_uncode_scroll_dots:not(on)'),
			run_array_mb($scroll_history,'_uncode_page_scroll:not()'),
			run_array_mb($scroll_safe_padding,'_uncode_page_scroll:is(slide)'),
			run_array_mb($scroll_additional_padding,'_uncode_page_scroll:is(slide),_uncode_scroll_safe_padding:is(on)'),
			run_array_mb($fullpage_menu,'_uncode_page_scroll:is(slide)'),
			run_array_mb($mobile_scroll,'_uncode_page_scroll:is(slide)'),
		);

		if (in_array($post_type, $fp_post_types)) {
			$scroller_fields[] = run_array_mb($scroll_snap,'_uncode_page_scroll:is(on)');
		}

		$scroller_fields[] = run_array_mb($specific_skew, '_uncode_page_scroll:not(slide),_uncode_scroll_snap:not(on)');

		$fields = array_merge($fields, apply_filters( 'uncode_core_page_options_scroll_fields', $scroller_fields));

	}

	$get_custom_fields = ot_get_option('_uncode_'.$post_type.'_custom_fields');
	if (isset($get_custom_fields) && !empty($get_custom_fields))
	{
		foreach ($get_custom_fields as $key => $value)
		{
			$get_custom_fields[$key]['id'] = $value['_uncode_cf_unique_id'];
			$get_custom_fields[$key]['label'] = $value['title'];
			$get_custom_fields[$key]['type'] = 'text';
		}
	}

	$custom_fields = array(
		array(
			'label' => '<i class="fa fa-pencil3 fa-fw"></i> ' . esc_html__('Custom Fields', 'uncode-core') ,
			'id' => '_uncode_cf_tab',
			'type' => 'tab',
		) ,
	);

	if (!empty($get_custom_fields)) $custom_fields = array_merge($custom_fields, $get_custom_fields);

	$fields = array_merge($fields, apply_filters( 'uncode_core_page_options_custom_fields', $custom_fields));

	$uncode_page_array = apply_filters(
		'uncode_core_page_options_fields',
		array(
			'id' => '_uncode_page_options',
			'title' => esc_html__('Page Options', 'uncode-core') ,
			'desc' => '',
			'pages' => $uncode_post_types,
			'context' => 'normal',
			'priority' => 'default',
			'fields' => $fields
		)
	);


	$uncode_page_array_fields = array();

	foreach ( $uncode_page_array['fields'] as $uncode_page_array_field ) {
		if ( is_array( $uncode_page_array_field ) ) {
			$uncode_page_array_fields[] = $uncode_page_array_field;
		}
	}

	$uncode_page_array['fields'] = $uncode_page_array_fields;

	ot_register_meta_box($uncode_page_array);

	// Modal Settings

	$specific_modal_width_inherit = array(
		'id' => '_uncode_specific_modal_width_inherit',
		'label' => esc_html__('Modal width', 'uncode-core') ,
		'desc' => esc_html__('Override the global modal width value.','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'custom',
				'label' => esc_html__('Custom', 'uncode-core') ,
			) ,
		) ,
	);

	$specific_modal_width = array(
		'id' => '_uncode_specific_modal_width',
		'label' => false,
		'desc' => false,
		'type' => 'background',
		'std' => array(
			'1000',
			'px'
		) ,
		'type' => 'measurement',
		'operator' => 'or',
	);

	$specific_modal_height_inherit = array(
		'id' => '_uncode_specific_modal_height_inherit',
		'label' => esc_html__('Modal height', 'uncode-core') ,
		'desc' => esc_html__('Override the global modal height value.','uncode-core'),
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Inherit', 'uncode-core') ,
			) ,
			array(
				'value' => 'custom',
				'label' => esc_html__('Custom', 'uncode-core') ,
			) ,
			array(
				'value' => 'auto',
				'label' => esc_html__('Auto', 'uncode-core') ,
			) ,
		) ,
	);

	$specific_modal_height = array(
		'id' => '_uncode_specific_modal_height',
		'label' => false,
		'desc' => false,
		'type' => 'background',
		'std' => array(
			'700',
			'px'
		) ,
		'type' => 'measurement',
		'operator' => 'or',
	);

	$modal_settings_fields = array(
		run_array_mb($specific_modal_width_inherit) ,
		run_array_mb($specific_modal_width, '_uncode_specific_modal_width_inherit:is(custom)') ,
		run_array_mb($specific_modal_height_inherit) ,
		run_array_mb($specific_modal_height, '_uncode_specific_modal_height_inherit:is(custom)') ,
	);

	$uncode_modal_array = apply_filters(
		'uncode_core_modal_settings_fields',
		array(
			'id' => '_uncode_modal_settings',
			'title' => esc_html__('Quick-View Settings', 'uncode-core') ,
			'desc' => '',
			'pages' => array( 'uncodeblock' ) ,
			'context' => 'normal',
			'priority' => 'default',
			'fields' => $modal_settings_fields
		)
	);

	ot_register_meta_box( $uncode_modal_array );

}
add_action('admin_init', 'uncode_page_options');
