<?php

/**
 * Initialize the custom Theme Options.
 */
add_action('admin_init', 'custom_theme_options');

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options()
{
	if ( ! defined( 'UNCODE_SLIM' ) ) {
		return;
	}

	global $wpdb, $uncode_colors, $uncode_post_types;

	if (!isset($uncode_post_types)) $uncode_post_types = uncode_get_post_types();
	/**
	 * Get a copy of the saved settings array.
	 */
	$saved_settings = ot_settings_value();

	/**
	 * Custom settings array that will eventually be
	 * passes to the OptionTree Settings API Class.
	 */

	if (!function_exists('ot_filter_measurement_unit_types'))
	{
		function ot_filter_measurement_unit_types($array, $field_id)
		{
			return array(
				'px' => 'px',
				'%' => '%'
			);
		}
	}

	add_filter('ot_measurement_unit_types', 'ot_filter_measurement_unit_types', 10, 2);

	function run_array_to($array, $key = '', $value = '')
	{
		$array[$key] = $value;
		return $array;
	}

	$stylesArrayMenu = array(
		array(
			'value' => 'light',
			'label' => esc_html__('Light', 'uncode-core') ,
			'src' => ''
		) ,
		array(
			'value' => 'dark',
			'label' => esc_html__('Dark', 'uncode-core') ,
			'src' => ''
		)
	);

	$uncodeblock = array(
		'value' => 'header_uncodeblock',
		'label' => esc_html__('Content Block', 'uncode-core') ,
	);

	$uncodeblocks = uncode_core_get_uncodeblocks_for_dropdowns();
	$allpages = uncode_core_get_pages_for_dropdowns();

	$uncodeblock_404 = array(
		'id' => '_uncode_404_body',
		'label' => esc_html__('404 content', 'uncode-core') ,
		'desc' => esc_html__('Specify a content for the 404 page.', 'uncode-core'),
		'std' => '',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
				'label' => esc_html__('Default', 'uncode-core') ,
			) ,
			array(
				'value' => 'body_uncodeblock',
				'label' => esc_html__('Content Block', 'uncode-core') ,
			),
		),
		'section' => 'uncode_404_section',
	);

	$uncodeblocks_404 = array(
		'id' => '_uncode_404_body_block',
		'label' => esc_html__('404 Content Block', 'uncode-core') ,
		'desc' => esc_html__('Specify a content for the 404 page.', 'uncode-core'),
		'type' => 'custom-post-type-select',
		'operator' => 'or',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'choices' => array(),
		'extra_choices' => array(
			''     => esc_html__('Inherit', 'uncode-core'),
			'none' => esc_html__('None', 'uncode-core'),
		),
		'condition' => '_uncode_404_body:is(body_uncodeblock)',
	);

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
	}
	else $revslider = $revsliders = '';

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
				'label' => esc_html__('No LayerSliders found', 'uncode-core')
			);
		}
	}
	else $layerslider = $layersliders = '';

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

	$btn_letter_spacing = $title_spacing;
	$btn_letter_spacing[] = array(
		'value' => 'uncode-fontspace-zero',
		'label' => esc_html__('Letter Spacing 0', "uncode-core")
	);

	$font_spacings = ot_get_option('_uncode_heading_font_spacings');
	if (!empty($font_spacings)) {
		foreach ($font_spacings as $key => $value) {
			$btn_letter_spacing[] = $title_spacing[] = array(
				'value' => $value['_uncode_heading_font_spacing_unique_id'],
				'label' => $value['title'],
			);
		}
	}

	$fonts = get_option('uncode_font_options');
	$title_font = array();

	if (isset($fonts['font_stack']) && $fonts['font_stack'] !== '[]')
	{
		$font_stack_string = $fonts['font_stack'];
		$font_stack = json_decode(str_replace('&quot;', '"', $font_stack_string) , true);

		foreach ($font_stack as $font)
		{
			if ($font['source'] === 'Font Squirrel')
			{
				$variants = explode(',', $font['variants']);
				$label = (string)$font['family'] . ' - ';
				$weight = array();
				foreach ($variants as $variant)
				{
					if (strpos(strtolower($variant) , 'hairline') !== false)
					{
						$weight[] = 100;
					}
					else if (strpos(strtolower($variant) , 'light') !== false)
					{
						$weight[] = 200;
					}
					else if (strpos(strtolower($variant) , 'regular') !== false)
					{
						$weight[] = 400;
					}
					else if (strpos(strtolower($variant) , 'semibold') !== false)
					{
						$weight[] = 500;
					}
					else if (strpos(strtolower($variant) , 'bold') !== false)
					{
						$weight[] = 600;
					}
					else if (strpos(strtolower($variant) , 'black') !== false)
					{
						$weight[] = 800;
					}
					else
					{
						$weight[] = 400;
					}
				}
				$label.= implode(',', $weight);
				$title_font[] = array(
					'value' => urlencode((string)$font['family']),
					'label' => $label
				);
			}
			else if ($font['source'] === 'Google Web Fonts')
			{
				$label = (string)$font['family'] . ' - ' . $font['variants'];
				$title_font[] = array(
					'value' => urlencode((string)$font['family']),
					'label' => $label
				);
			}
			else if ($font['source'] === 'Adobe Fonts' || $font['source'] === 'Typekit' )
			{
				$label = (string)$font['family'] . ' - ';
				$variants = explode(',', $font['variants']);
				foreach ($variants as $key => $variant) {
					if ( $variants[$key] !== '' ) {
						preg_match("|\d+|", $variants[$key], $weight);
						$variants[$key] = $weight[0] . '00';
					}
				}
				$label.= implode(',', $variants);
				$title_font[] = array(
					'value' => urlencode(str_replace('"', '', (string)$font['stub'])),
					'label' => $label
				);
			}
			else
			{
				$title_font[] = array(
					'value' => urlencode((string)$font['family']),
					'label' => (string)$font['family']
				);
			}
		}
	}
	else
	{
		$title_font = array(
			array(
				'value' => '',
				'label' => esc_html__('No fonts activated.', "uncode-core"),
			)
		);
	}

	$title_font[] = array(
		'value' => 'manual',
		'label' => esc_html__('Manually entered','uncode-core')
	);

	$custom_fonts = array(
		array(
			'value' => '',
			'label' => esc_html__('Default', "uncode-core"),
		)
	);

	$custom_fonts_array = ot_get_option('_uncode_font_groups');
	if (!empty($custom_fonts_array)) {
		foreach ($custom_fonts_array as $key => $value) {
			$custom_fonts[] = array(
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

	$menu_section_title = array(
		'id' => '_uncode_%section%_menu_block_title',
		'label' => ' <i class="fa fa-menu"></i> ' . esc_html__('Menu', 'uncode-core') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$menu = array(
		'id' => '_uncode_%section%_menu',
		'label' => esc_html__('Menu', 'uncode-core') ,
		'desc' => esc_html__('Override the Primary Menu created in \'Appearance -> Menus\'.','uncode-core'),
		'type' => 'menu-select',
		'choices' => array(),
		'section' => 'uncode_%section%_section',
	);

	$menu_width = array(
		'id' => '_uncode_%section%_menu_width',
		'label' => esc_html__('Menu width', 'uncode-core') ,
		'desc' => esc_html__('Override the Menu width.', 'uncode-core'),
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
		'section' => 'uncode_%section%_section',
	);

	$menu_opaque = array(
		'id' => '_uncode_%section%_menu_opaque',
		'label' => esc_html__('Remove transparency', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Override to remove the transparency eventually declared in \'Customize -> Light/Dark Skin\'.', 'uncode-core') ,
		'std' => 'off',
		'section' => 'uncode_%section%_section',
	);

	$menu_no_padding = array(
		'id' => '_uncode_%section%_menu_no_padding',
		'label' => esc_html__('No content padding', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Remove the content additional top padding (equal to the menu height) in the Header.', 'uncode-core') ,
		'std' => 'off',
		'section' => 'uncode_%section%_section',
	);

	$menu_no_padding_mobile = array(
		'id' => '_uncode_%section%_menu_no_padding_mobile',
		'label' => esc_html__('No content padding mobile', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Remove the content additional top padding (equal to the menu height) in the Header.on mobile.', 'uncode-core') ,
		'std' => 'off',
		'section' => 'uncode_%section%_section',
	);

	$title_archive_custom_activate = array(
		'id' => '_uncode_%section%_custom_title_activate',
		'label' => esc_html__('Custom title and subtitle', 'uncode-core') ,
		'type' => 'on-off',
		'desc' => esc_html__('Activate this to enable the custom title and subtitle.', 'uncode-core') ,
		'std' => 'off',
		'section' => 'uncode_%section%_section',
	);

	$title_archive_custom_text = array(
		'id' => '_uncode_%section%_custom_title_text',
		'label' => esc_html__('Custom title', 'uncode-core') ,
		'type' => 'text',
		'desc' => esc_html__('Insert your custom main archive page title.', 'uncode-core') ,
		'std' => '',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_custom_title_activate:is(on)',
	);

	$subtitle_archive_custom_text = array(
		'id' => '_uncode_%section%_custom_subtitle_text',
		'label' => esc_html__('Custom subtitle', 'uncode-core') ,
		'type' => 'text',
		'desc' => esc_html__('Insert your custom main archive page subtitle.', 'uncode-core') ,
		'std' => '',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_custom_title_activate:is(on)',
	);

	$no_results_subtitle_archive_custom_text = array(
		'id' => '_uncode_%section%_no_results_custom_subtitle_text',
		'label' => esc_html__('Custom subtitle No Results', 'uncode-core') ,
		'type' => 'text',
		'desc' => esc_html__('Insert your custom main archive page subtitle.', 'uncode-core') ,
		'std' => '',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_custom_title_activate:is(on)',
	);

	if ( class_exists( 'WooCommerce' ) ) {
		$no_results_products_subtitle_archive_custom_text = array(
			'id' => '_uncode_%section%_no_results_products_custom_subtitle_text',
			'label' => esc_html__('Custom subtitle No Results Shop', 'uncode-core') ,
			'type' => 'text',
			'desc' => esc_html__('Insert your custom main archive page subtitle.', 'uncode-core') ,
			'std' => '',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_custom_title_activate:is(on),_uncode_woocommerce_use_search_options:is(on)',
			'operator' => 'and'
		);
	} else {
		$no_results_products_subtitle_archive_custom_text = array();
	}

	$header_section_title = array(
		'id' => '_uncode_%section%_header_block_title',
		'label' => '<i class="fa fa-columns2"></i> ' . esc_html__('Header', 'uncode-core') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	if ( get_option( 'uncode_core_settings_opt_disable_basic_header' ) !== 'on' ) {
		$basic_header = array(
			'value' => 'header_basic',
			'label' => esc_html__('Default', 'uncode-core') ,
		);
	} else {
		$basic_header = false;
	}

	$header_type = array(
		'id' => '_uncode_%section%_header',
		'label' => esc_html__('Header Type', 'uncode-core') ,
		'desc' => esc_html__('Set your preferred layout method. Select Default to use the Basic template, or Content Block to create custom layouts with dynamic options.', 'uncode-core'),
		'std' => 'none',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => 'none',
				'label' => esc_html__('None', 'uncode-core') ,
			) ,
			$basic_header,
			$uncodeblock,
			$revslider,
			$layerslider,
		),
		'section' => 'uncode_%section%_section',
	);

	$header_uncode_block = array(
		'id' => '_uncode_%section%_blocks',
		'label' => esc_html__('Content Block', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'condition' => '_uncode_%section%_header:is(header_uncodeblock)',
		'operator' => 'or',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'choices' => array(),
		'extra_choices' => array(
			''     => esc_html__('Select…', 'uncode-core'),
		),
	);

	$no_results_header_uncode_block = array(
		'id' => '_uncode_%section%_no_results_header_content_block',
		'label' => esc_html__('Content Block No Results', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use. NB. Select "Inherit" to use the default template.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'condition' => '_uncode_%section%_header:is(header_uncodeblock)',
		'operator' => 'or',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'choices' => array(),
		'extra_choices' => array(
			''     => esc_html__('Inherit', 'uncode-core'),
		),
	);

	$header_revslider = array(
		'id' => '_uncode_%section%_revslider',
		'label' => esc_html__('Revslider', 'uncode-core') ,
		'desc' => esc_html__('Specify the RevSlider.', 'uncode-core') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_revslider)',
		'operator' => 'or',
		'choices' => $revsliders,
		'section' => 'uncode_%section%_section',
	);

	$header_layerslider = array(
		'id' => '_uncode_%section%_layerslider',
		'label' => esc_html__('LayerSlider', 'uncode-core') ,
		'desc' => esc_html__('Specify the LayerSlider.', 'uncode-core') ,
		'type' => 'select',
		'condition' => '_uncode_%section%_header:is(header_layerslider)',
		'operator' => 'or',
		'choices' => $layersliders,
		'section' => 'uncode_%section%_section',
	);

	if ( get_option( 'uncode_core_settings_opt_disable_basic_header' ) !== 'on' ) {
		$header_title = array(
			'label' => esc_html__('Title in header', 'uncode-core') ,
			'id' => '_uncode_%section%_header_title',
			'type' => 'on-off',
			'desc' => esc_html__('Activate to show title in the Header.', 'uncode-core') ,
			'std' => 'on',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'or',
		);

		$header_title_text = array(
			'id' => '_uncode_%section%_header_title_text',
			'label' => esc_html__('Custom text', 'uncode-core') ,
			'desc' => esc_html__('Add custom text for the header. Every newline in the field is a new line in the Title.', 'uncode-core') ,
			'type' => 'textarea-simple',
			'rows' => '15',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
			'operator' => 'and',
		);

		$header_style = array(
			'id' => '_uncode_%section%_header_style',
			'label' => esc_html__('Skin', 'uncode-core') ,
			'desc' => esc_html__('Specify the Header text Skin.', 'uncode-core') ,
			'std' => 'light',
			'type' => 'select',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'and',
			'choices' => $stylesArrayMenu
		);

		$header_width = array(
			'id' => '_uncode_%section%_header_width',
			'label' => esc_html__('Header width', 'uncode-core') ,
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
			'desc' => esc_html__('Override the Header width.', 'uncode-core') ,
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'or',
		);

		$header_content_width = array(
			'id' => '_uncode_%section%_header_content_width',
			'label' => esc_html__('Content full width', 'uncode-core') ,
			'type' => 'on-off',
			'desc' => esc_html__('Activate to expand the Header content to full width.', 'uncode-core') ,
			'std' => 'off',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'and',
		);

		$header_custom_width = array(
			'id' => '_uncode_%section%_header_custom_width',
			'label' => esc_html__('Custom inner width','uncode-core'),
			'desc' => esc_html__('Adjust the inner content width in %.', 'uncode-core') ,
			'std' => '100',
			'type' => 'numeric-slider',
			'min_max_step' => '0,100,1',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'and',
			'section' => 'uncode_%section%_section',
		);

		$header_align = array(
			'id' => '_uncode_%section%_header_align',
			'label' => esc_html__('Content alignment', 'uncode-core') ,
			'desc' => esc_html__('Specify the text/content alignment.', 'uncode-core') ,
			'std' => 'center',
			'type' => 'select',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
			'operator' => 'and',
			'choices' => array(
				array(
					'value' => 'left',
					'label' => esc_html__('Left', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'center',
					'label' => esc_html__('Center', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'right',
					'label' => esc_html__('Right', 'uncode-core') ,
					'src' => ''
				)
			)
		);

		$header_height = array(
			'id' => '_uncode_%section%_header_height',
			'label' => esc_html__('Height', 'uncode-core') ,
			'desc' => esc_html__('Define the height of the Header in px or in % (relative to the window height).', 'uncode-core') ,
			'type' => 'measurement',
			'std' => array(
				'60',
				'%'
			) ,
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'or',
			'section' => 'uncode_%section%_section',
		);

		$header_min_height = array(
			'id' => '_uncode_%section%_header_min_height',
			'label' => esc_html__('Minimal height', 'uncode-core') ,
			'desc' => esc_html__('Enter a minimun height for the Header in pixel.', 'uncode-core') ,
			'type' => 'text',
			'std' => '300',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'or',
			'section' => 'uncode_%section%_section',
		);

		$header_position = array(
			'id' => '_uncode_%section%_header_position',
			'label' => esc_html__('Content Position', 'uncode-core') ,
			'desc' => esc_html__('Specify the position of the Header content inside the container.', 'uncode-core') ,
			'std' => 'header-center header-middle',
			'type' => 'select',
			'operator' => 'and',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
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
			),
			'section' => 'uncode_%section%_section',
		);

		$header_title_font = array(
			'id' => '_uncode_%section%_header_title_font',
			'class' => 'uncode_font_family_dropdown',
			'label' => esc_html__('Title font family', 'uncode-core') ,
			'desc' => esc_html__('Specify the font for the Title.', 'uncode-core') ,
			'std' => 'font-555555',
			'type' => 'select',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
			'operator' => 'and',
			'choices' => $custom_fonts,
			'section' => 'uncode_%section%_section',
		);

		$header_title_size = array(
			'id' => '_uncode_%section%_header_title_size',
			'class' => 'uncode_font_size_dropdown',
			'label' => esc_html__('Title font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the font size for the Title.', 'uncode-core') ,
			'type' => 'select',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
			'operator' => 'and',
			'choices' => $title_size,
			'section' => 'uncode_%section%_section',
		);

		$header_title_height = array(
			'id' => '_uncode_%section%_header_title_height',
			'class' => 'uncode_line_height_dropdown',
			'label' => esc_html__('Title line height', 'uncode-core') ,
			'desc' => esc_html__('Specify the line height for the Title.', 'uncode-core') ,
			'type' => 'select',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
			'operator' => 'and',
			'choices' => $title_height,
			'section' => 'uncode_%section%_section',
		);

		$header_title_spacing = array(
			'id' => '_uncode_%section%_header_title_spacing',
			'class' => 'uncode_letter_spacing_dropdown',
			'label' => esc_html__('Title letter spacing', 'uncode-core') ,
			'desc' => esc_html__('Specify the letter spacing for the Title.', 'uncode-core') ,
			'type' => 'select',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
			'operator' => 'and',
			'choices' => $title_spacing,
			'section' => 'uncode_%section%_section',
		);

		$header_title_weight = array(
			'id' => '_uncode_%section%_header_title_weight',
			'label' => esc_html__('Title font weight', 'uncode-core') ,
			'desc' => esc_html__('Specify the font weight for the Title.', 'uncode-core') ,
			'type' => 'select',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
			'operator' => 'and',
			'choices' => $title_weight,
			'section' => 'uncode_%section%_section',
		);

		$header_title_italic = array(
			'id' => '_uncode_%section%_header_title_italic',
			'label' => esc_html__('Title italic', 'uncode-core') ,
			'desc' => esc_html__('Activate the font style italic for the Title.', 'uncode-core') ,
			'type' => 'on-off',
			'std' => 'off',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
			'operator' => 'and',
		);

		$header_title_transform = array(
			'id' => '_uncode_%section%_header_title_transform',
			'label' => esc_html__('Title text transform', 'uncode-core') ,
			'desc' => esc_html__('Specify the Title text transformation.', 'uncode-core') ,
			'type' => 'select',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
			'operator' => 'and',
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

		$header_text_animation = array(
			'id' => '_uncode_%section%_header_text_animation',
			'label' => esc_html__('Text animation', 'uncode-core') ,
			'desc' => esc_html__('Specify the entrance animation of the Title text.', 'uncode-core') ,
			'type' => 'select',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on)',
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
			),
			'section' => 'uncode_%section%_section',
		);

		$header_animation_delay = array(
			'id' => '_uncode_%section%_header_animation_delay',
			'label' => esc_html__('Animation delay', 'uncode-core') ,
			'desc' => esc_html__('Specify the entrance animation delay of the Title text in milliseconds.', 'uncode-core') ,
			'type' => 'select',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on),_uncode_%section%_header_text_animation:not()',
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
			'section' => 'uncode_%section%_section',
		);

		$header_animation_speed = array(
			'id' => '_uncode_%section%_header_animation_speed',
			'label' => esc_html__('Animation speed', 'uncode-core') ,
			'desc' => esc_html__('Specify the entrance animation speed of the Title text in milliseconds.', 'uncode-core') ,
			'type' => 'select',
			'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header_title:is(on),_uncode_%section%_header_text_animation:not()',
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
			'section' => 'uncode_%section%_section',
		);

		$header_featured = array(
			'label' => esc_html__('Featured media in header', 'uncode-core') ,
			'id' => '_uncode_%section%_header_featured',
			'type' => 'on-off',
			'desc' => esc_html__('Activate to use the Featured Image in the Header.', 'uncode-core') ,
			'std' => 'on',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'or',
		);

		$header_background = array(
			'id' => '_uncode_%section%_header_background',
			'label' => esc_html__('Background', 'uncode-core') ,
			'desc' => esc_html__('Specify the background media and color.', 'uncode-core') ,
			'type' => 'background',
			'std' => array(
				'Background Color' => 'color-gyho',
				'Background Repeat' => '',
				'Background Attachment' => '',
				'Background Position' => '',
				'Background Size' => '',
				'Background Image' => '',
			),
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'or',
		);

		$header_parallax = array(
			'id' => '_uncode_%section%_header_parallax',
			'label' => esc_html__('Parallax', 'uncode-core') ,
			'type' => 'on-off',
			'desc' => esc_html__('Activate the background Parallax effect.', 'uncode-core') ,
			'std' => 'off',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'or',
		);

		$header_kburns = array(
			'id' => '_uncode_%section%_header_kburns',
			'label' => esc_html__('Zoom Effect', 'uncode-core') ,
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
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'or',
		);

		$header_overlay_color = array(
			'id' => '_uncode_%section%_header_overlay_color',
			'label' => esc_html__('Overlay color', 'uncode-core') ,
			'desc' => esc_html__('Specify the overlay background color.', 'uncode-core') ,
			'type' => 'uncode_color',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'or',
		);

		$header_overlay_color_alpha = array(
			'id' => '_uncode_%section%_header_overlay_color_alpha',
			'label' => esc_html__('Overlay color opacity', 'uncode-core') ,
			'desc' => esc_html__('Set the overlay opacity.', 'uncode-core') ,
			'std' => '100',
			'min_max_step' => '0,100,1',
			'type' => 'numeric-slider',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_%section%_header:is(header_basic)',
			'operator' => 'or',
		);

	} else {
		$header_title = array();
		$header_title_text = array();
		$header_style = array();
		$header_width = array();
		$header_content_width = array();
		$header_custom_width = array();
		$header_align = array();
		$header_height = array();
		$header_min_height = array();
		$header_position = array();
		$header_title_font = array();
		$header_title_size = array();
		$header_title_height = array();
		$header_title_spacing = array();
		$header_title_weight = array();
		$header_title_italic = array();
		$header_title_transform = array();
		$header_text_animation = array();
		$header_animation_delay = array();
		$header_animation_speed = array();
		$header_featured = array();
		$header_background = array();
		$header_parallax = array();
		$header_kburns = array();
		$header_overlay_color = array();
		$header_overlay_color_alpha = array();
	}

	$header_scroll_opacity = array(
		'id' => '_uncode_%section%_header_scroll_opacity',
		'label' => esc_html__('Scroll opacity', 'uncode-core') ,
		'desc' => esc_html__('Activate alpha animation when scrolling down.', 'uncode-core') ,
		'type' => 'on-off',
		'std' => 'off',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:is(header_basic),_uncode_%section%_header:is(header_uncodeblock)',
		'operator' => 'or',
	);

	$header_scrolldown = array(
		'id' => '_uncode_%section%_header_scrolldown',
		'label' => esc_html__('Scroll down arrow', 'uncode-core') ,
		'desc' => esc_html__('Activate the scroll down arrow button.', 'uncode-core') ,
		'type' => 'on-off',
		'std' => 'off',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_header:not(none)',
		'operator' => 'or',
	);

	$show_breadcrumb = array(
		'id' => '_uncode_%section%_breadcrumb',
		'label' => esc_html__('Show Breadcrumb', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the navigation Breadcrumb.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$breadcrumb_align = array(
		'id' => '_uncode_%section%_breadcrumb_align',
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
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_breadcrumb:is(on)',
		'operator' => 'and',
	);

	$show_title = array(
		'id' => '_uncode_%section%_title',
		'label' => esc_html__('Show title', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the Title in the content area.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
		'operator' => 'or'
	);

	$show_title_std_on = run_array_to($show_title, 'std', 'on');

	$remove_pagination = array(
		'id' => '_uncode_%section%_remove_pagination',
		'label' => esc_html__('Remove pagination', 'uncode-core') ,
		'desc' => esc_html__('Activate this to remove the pagination (useful when you use a custom Content Block with Pagination or Load More options).', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
		'operator' => 'or'
	);

	$products_per_page = array(
		'id' => '_uncode_%section%_ppp',
		'label' => esc_html__('Number of products', 'uncode-core') ,
		'desc' => esc_html__('Set the number of items to display on product archives. \'Inherit\' inherits the WordPress Settings > Readings > Blog Number of Posts', 'uncode-core') ,
		'std' => '0',
		'min_max_step' => '0,100,1',
		'type' => 'numeric-slider',
		'section' => 'uncode_%section%_section',
	);

	$show_media = array(
		'id' => '_uncode_%section%_media',
		'label' => esc_html__('Show media', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the medias in the content area.', 'uncode-core') ,
		'std' => 'on',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$media_display = array(
		'id' => '_uncode_%section%_featured_media_display',
		'label' => esc_html__('Media layout', 'uncode-core') ,
		'desc' => esc_html__('Specify the layout mode for the images section.','uncode-core'),
		'type' => 'select',
		'choices' => array(
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
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_media:is(on)',
		'operator' => 'and'
	);


	$show_featured_media = array(
		'id' => '_uncode_%section%_featured_media',
		'label' => esc_html__('Show featured image', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the Featured Image in the content area.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'condition' => '_uncode_%section%_media:not(on)',
		'section' => 'uncode_%section%_section',
		'operator' => 'and'
	);

	$show_tags = array(
		'id' => '_uncode_%section%_tags',
		'label' => esc_html__('Show tags', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the Tags and choose visbility by post to post bases.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$show_tags_align = array(
		'id' => '_uncode_%section%_tags_align',
		'label' => esc_html__('Tags alignment', 'uncode-core') ,
		'desc' => esc_html__('Specify the Tags alignment.', 'uncode-core') ,
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
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_tags:is(on)',
		'operator' => 'or',
	);

	$show_share_w_tags = array(
		'id' => '_uncode_%section%_share',
		'label' => esc_html__('Show share', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the Share module.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'select',
		'choices' => array(
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
		) ,
		'section' => 'uncode_%section%_section',
	);

	$show_share = array(
		'id' => '_uncode_%section%_share',
		'label' => esc_html__('Show share', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the Share module.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$image_layout = array(
		'id' => '_uncode_%section%_image_layout',
		'label' => esc_html__('Media layout', 'uncode-core') ,
		'desc' => esc_html__('Specify the layout mode for the product images section.', 'uncode-core') ,
		'std' => '',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '',
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
		'section' => 'uncode_%section%_section',
	);

	$media_size = array(
		'id' => '_uncode_%section%_media_size',
		'label' => esc_html__('Media layout size', 'uncode-core') ,
		'desc' => esc_html__('Specify the size of the Media layout area.', 'uncode-core') ,
		'std' => '6',
		'min_max_step' => '1,11,1',
		'type' => 'numeric-slider',
		'section' => 'uncode_%section%_section',
	);

	$enable_sticky_desc = array(
		'id' => '_uncode_%section%_sticky_desc',
		'label' => esc_html__('Sticky content', 'uncode-core') ,
		'desc' => esc_html__('Activate to enable Sticky effect for product description.', 'uncode-core') ,
		'std' => 'on',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_image_layout:not()',
	);

	$enable_woo_zoom = array(
		'id' => '_uncode_%section%_enable_zoom',
		'label' => esc_html__('Zoom', 'uncode-core') ,
		'desc' => esc_html__('Activate to enable drag Zoom effect on product image.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_product_select_content:is()',

	);

	if ( ot_get_option( '_uncode_woocommerce_default_product_gallery' ) === 'on' ) {
		$enable_woo_zoom['operator'] = 'and';
		$enable_woo_zoom['condition'] = '_uncode_product_select_content:is(),_uncode_%section%_image_layout:is()';
	}

	$thumb_cols = array(
		'id' => '_uncode_%section%_thumb_cols',
		'label' => esc_html__('Thumbnails columns', 'uncode-core') ,
		'desc' => esc_html__('Specify how many columns to display for your product Gallery thumbs.', 'uncode-core') ,
		'std' => '',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => '2',
				'label' => '2',
			) ,
			array(
				'value' => '',
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
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_image_layout:is()',
	);

	$enable_woo_slider = array(
		'id' => '_uncode_%section%_enable_slider',
		'label' => esc_html__('Thumbnails carousel', 'uncode-core') ,
		'desc' => esc_html__('Activate to enable Carousel Slider when you click Gallery thumbs.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_product_select_content:is(),_uncode_product_image_layout:is()',
	);

	if ( ot_get_option( '_uncode_woocommerce_default_product_gallery' ) === 'on' ) {
		$enable_woo_slider = array();
	}

	$body_section_title = array(
		'id' => '_uncode_%section%_body_title',
		'label' => '<i class="fa fa-layout"></i> ' . esc_html__('Content', 'uncode-core') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$body_uncode_select_content = array(
		'id' => '_uncode_%section%_select_content',
		'label' => esc_html__('Content Type', 'uncode-core') ,
		'desc' => esc_html__('Set your preferred layout method. Select Default to use the Basic template, or Content Block to create custom layouts with dynamic options.', 'uncode-core') ,
		'std' => '',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => 'none',
				'label' => esc_html__('None', 'uncode-core') ,
			) ,
			array(
				'value' => '',
				'label' => esc_html__('Default', 'uncode-core') ,
			) ,
			array(
				'value' => 'uncodeblock',
				'label' => esc_html__('Content Block', 'uncode-core') ,
			) ,
		),
		'section' => 'uncode_%section%_section',
	);

	$body_uncode_select_content_product = $body_uncode_select_content;
	$body_uncode_select_content_product['choices'][] = array(
		'value' => 'description',
		'label' => esc_html__('Page Builder Description', 'uncode-core') ,
	);

	$body_uncode_block_single = array(
		'id' => '_uncode_%section%_content_block',
		'label' => esc_html__('Content Block', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'operator' => 'and',
		'choices' => array(),
		'extra_choices' => array(
			''     => esc_html__('Select…', 'uncode-core'),
		),
	);


	$body_uncode_block = array(
		'id' => '_uncode_%section%_content_block',
		'label' => esc_html__('Content Block', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use. NB. Select "Inherit" to use the default template.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'operator' => 'or',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'choices' => array(),
		'extra_choices' => array(
			''     => esc_html__('Inherit', 'uncode-core'),
			'none' => esc_html__('None', 'uncode-core'),
		),
	);

	$body_uncode_block_before = array(
		'id' => '_uncode_%section%_content_block_before',
		'label' => esc_html__('Content Block - Before Content', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'choices' => array(),
		'extra_choices' => array(
			''     => esc_html__('Select…', 'uncode-core'),
		),
	);

	$body_uncode_block_after_pre = array(
		'id' => '_uncode_%section%_content_block_after_pre',
		'label' => esc_html__('After Content (Author Profile)', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'choices' => array(),
		'extra_choices' => array(
			''     => esc_html__('Select…', 'uncode-core'),
		),
	);

	$body_uncode_block_after = array(
		'id' => '_uncode_%section%_content_block_after',
		'label' => esc_html__('After Content (Related Posts)', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'choices' => array(),
		'extra_choices' => array(
			''     => esc_html__('Select…', 'uncode-core'),
		),
	);

	$no_results_uncode_block = array(
		'id' => '_uncode_%section%_no_results_content_block',
		'label' => esc_html__('Content Block No Results', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use. NB. Select "Inherit" to use the default template.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'operator' => 'or',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'choices' => array(),
		'extra_choices' => array(
			''     => esc_html__('Inherit', 'uncode-core'),
		),
	);

	if ( class_exists( 'WooCommerce' ) ) {
		$no_results_products_uncode_block = array(
			'id' => '_uncode_%section%_no_results_products_content_block',
			'label' => esc_html__('Content Block No Results Shop', 'uncode-core') ,
			'desc' => esc_html__('Set the Content Block to use. NB. Select "Inherit" to use the default template.', 'uncode-core') ,
			'type' => 'custom-post-type-select',
			'operator' => 'and',
			'post_type' => 'uncodeblock',
			'section' => 'uncode_%section%_section',
			'condition' => '_uncode_woocommerce_use_search_options:is(on)',
			'choices' => array(),
			'extra_choices' => array(
				''     => esc_html__('Inherit', 'uncode-core'),
			),
		);
	} else {
		$no_results_products_uncode_block = array();
	}

	$show_comments = array(
		'id' => '_uncode_%section%_comments',
		'label' => esc_html__('Show comments', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the comments and choose visbility by post to post bases.', 'uncode-core') ,
		'std' => 'on',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$body_layout_width = array(
		'id' => '_uncode_%section%_layout_width',
		'label' => esc_html__('Layout width', 'uncode-core') ,
		'desc' => esc_html__('Set the layout width.', 'uncode-core'),
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
		'section' => 'uncode_%section%_section',
		'operator' => 'or',
	);

	$body_layout_width_custom = array(
		'id' => '_uncode_%section%_layout_width_custom',
		'label' => esc_html__('Limit width', 'uncode-core') ,
		'desc' => esc_html__('Define the custom width for the content area in px or in %.', 'uncode-core') ,
		'type' => 'measurement',
		'condition' => '_uncode_%section%_layout_width:is(limit)',
		'operator' => 'and',
		'section' => 'uncode_%section%_section',
	);

	$body_single_post_width = array(
		'id' => '_uncode_%section%_single_width',
		'label' => esc_html__('Single block width', 'uncode-core') ,
		'desc' => esc_html__('Specify the Single block width from 1 to 12.', 'uncode-core'),
		'type' => 'select',
		'std' => '4',
		'condition' => '_uncode_%section%_content_block:is(),_uncode_%section%_content_block:is(none)',
		'operator' => 'or',
		'choices' => array(
			array(
				'value' => '1',
				'label' => '1' ,
			) ,
			array(
				'value' => '2',
				'label' => '2' ,
			) ,
			array(
				'value' => '3',
				'label' => '3' ,
			) ,
			array(
				'value' => '4',
				'label' => '4' ,
			) ,
			array(
				'value' => '5',
				'label' => '5' ,
			) ,
			array(
				'value' => '6',
				'label' => '6' ,
			) ,
			array(
				'value' => '7',
				'label' => '7' ,
			) ,
			array(
				'value' => '8',
				'label' => '8' ,
			) ,
			array(
				'value' => '9',
				'label' => '9' ,
			) ,
			array(
				'value' => '10',
				'label' => '10' ,
			) ,
			array(
				'value' => '11',
				'label' => '11' ,
			) ,
			array(
				'value' => '12',
				'label' => '12' ,
			) ,
		) ,
		'section' => 'uncode_%section%_section',
	);

	$body_single_text_lenght = array(
		'id' => '_uncode_%section%_single_text_length',
		'label' => esc_html__('Single block text length', 'uncode-core') ,
		'desc' => esc_html__('Enter the number of words you want for the block. If nothing in entered the full content will be showed.', 'uncode-core') ,
		'type' => 'text',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_content_block:is(),_uncode_%section%_content_block:is(none)',
		'operator' => 'or',
	);

	$sidebar_section_title = array(
		'id' => '_uncode_%section%_sidebar_title',
		'label' => '<i class="fa fa-content-right"></i> ' . esc_html__('Sidebar', 'uncode-core') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$sidebar_activate = array(
		'id' => '_uncode_%section%_activate_sidebar',
		'label' => esc_html__('Activate sidebar', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the Sidebar.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
	);

	$sidebar_widget = array(
		'id' => '_uncode_%section%_sidebar',
		'label' => esc_html__('Sidebar', 'uncode-core') ,
		'desc' => esc_html__('Specify the Sidebar.', 'uncode-core') ,
		'type' => 'sidebar-select',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
	);

	$sidebar_position = array(
		'id' => '_uncode_%section%_sidebar_position',
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
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
		'section' => 'uncode_%section%_section',
	);

	$sidebar_size = array(
		'id' => '_uncode_%section%_sidebar_size',
		'label' => esc_html__('Size', 'uncode-core') ,
		'desc' => esc_html__('Set the size of the Sidebar.', 'uncode-core') ,
		'std' => '4',
		'min_max_step' => '1,11,1',
		'type' => 'numeric-slider',
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
		'section' => 'uncode_%section%_section',
	);

	$sidebar_sticky = array(
		'id' => '_uncode_%section%_sidebar_sticky',
		'label' => esc_html__('Sticky sidebar', 'uncode-core') ,
		'desc' => esc_html__('Activate to have a Sticky Sidebar.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
		'section' => 'uncode_%section%_section',
	);

	$sidebar_style = array(
		'id' => '_uncode_%section%_sidebar_style',
		'label' => esc_html__('Skin', 'uncode-core') ,
		'desc' => esc_html__('Override the Sidebar text Skin color.', 'uncode-core') ,
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
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
	);

	$sidebar_bgcolor = array(
		'id' => '_uncode_%section%_sidebar_bgcolor',
		'label' => esc_html__('Background color', 'uncode-core') ,
		'desc' => esc_html__('Specify the Sidebar background color.', 'uncode-core') ,
		'type' => 'uncode_color',
		'section' => 'uncode_%section%_section',
		'condition' => '_uncode_%section%_activate_sidebar:not(off)',
	);

	$sidebar_fill = array(
		'id' => '_uncode_%section%_sidebar_fill',
		'label' => esc_html__('Sidebar filling space', 'uncode-core') ,
		'desc' => esc_html__('Activate to remove padding around the Sidebar and fill the height.', 'uncode-core') ,
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
		'std' => 'off',
		'operator' => 'and',
		'condition' => '_uncode_%section%_sidebar_bgcolor:not(),_uncode_%section%_activate_sidebar:not(off)',
	);

	// $sidebar_widget_collapse = array(
	// 	'id' => '_uncode_%section%_sidebar_widget_collapse',
	// 	'label' => esc_html__('Mobile collapse', 'uncode-core') ,
	// 	'desc' => esc_html__('Activate to collapse the widgets on mobile devices.', 'uncode-core') ,
	// 	'type' => 'on-off',
	// 	'std' => 'off',
	// 	'section' => 'uncode_%section%_section',
	// 	'condition' => '_uncode_%section%_activate_sidebar:not(off)',
	// );

	// $sidebar_widget_collapse_tablet = array(
	// 	'id' => '_uncode_%section%_sidebar_widget_collapse_tablet',
	// 	'label' => esc_html__('Tablet collapse', 'uncode-core') ,
	// 	'desc' => esc_html__('Activate to collapse the widgets on tablet devices.', 'uncode-core') ,
	// 	'type' => 'on-off',
	// 	'std' => 'on',
	// 	'section' => 'uncode_%section%_section',
	// 	'condition' => '_uncode_%section%_sidebar_widget_collapse:not(off)',
	// );

	$navigation_section_title = array(
		'id' => '_uncode_%section%_navigation_title',
		'label' => '<i class="fa fa-location"></i> ' . esc_html__('Navigation', 'uncode-core') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$navigation_activate = array(
		'id' => '_uncode_%section%_navigation_activate',
		'label' => esc_html__('Navigation Type', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the navigation bar. Set your preferred layout method. Select Default to use the Basic template, or Content Block to create custom layouts with the Navigation module.', 'uncode-core') ,
		'std' => 'on',
		'type' => 'on-off',
		'type' => 'select',
		'choices' => array(
			array(
				'value' => 'off',
				'label' => esc_html__('None', 'uncode-core') ,
			) ,
			array(
				'value' => 'on',
				'label' => esc_html__('Default', 'uncode-core') ,
			) ,
			array(
				'value' => 'uncodeblock',
				'label' => esc_html__('Content Block', 'uncode-core') ,
			) ,
		),
		'section' => 'uncode_%section%_section',
	);

	$navigation_content_block = array(
		'id' => '_uncode_%section%_navigation_content_block',
		'label' => esc_html__('Navigation Content Block', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core'),
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'operator' => 'and',
		'choices' => array(),
		'condition' => '_uncode_%section%_navigation_activate:is(uncodeblock)',
		'extra_choices' => array(
			''     => esc_html__('Select…', 'uncode-core'),
		),
	);

	$navigation_page_index = array(
		'id' => '_uncode_%section%_navigation_index',
		'label' => esc_html__('Navigation index', 'uncode-core') ,
		'desc' => esc_html__('Specify the page you want to use as index.', 'uncode-core'),
		'type' => 'page-select',
		'section' => 'uncode_%section%_section',
		'choices' => array(),
	);

	$navigation_index_label = array(
		'id' => '_uncode_%section%_navigation_index_label',
		'label' => esc_html__('Navigation index label', 'uncode-core') ,
		'desc' => esc_html__('Enter a custom label for the index button.', 'uncode-core') ,
		'type' => 'text',
		'section' => 'uncode_%section%_section',
	);

	$navigation_nextprev_title = array(
		'id' => '_uncode_%section%_navigation_nextprev_title',
		'label' => esc_html__('Navigation titles', 'uncode-core') ,
		'desc' => esc_html__('Activate to show the next/prev post title.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_%section%_section',
		'operator' => 'and',
		'condition' => '_uncode_%section%_navigation_activate:not(uncodeblock)',
	);

	$footer_section_title = array(
		'id' => '_uncode_%section%_footer_block_title',
		'label' => '<i class="fa fa-ellipsis"></i> ' . esc_html__('Footer', 'uncode-core') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$footer_uncode_block = array(
		'id' => '_uncode_%section%_footer_block',
		'label' => esc_html__('Content Block', 'uncode-core') ,
		'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
		'type' => 'custom-post-type-select',
		'post_type' => 'uncodeblock',
		'section' => 'uncode_%section%_section',
		'choices' => array(),
		'extra_choices' => array(
			''     => esc_html__('Inherit', 'uncode-core'),
			'none' => esc_html__('None', 'uncode-core'),
		),
	);

	$footer_width = array(
		'id' => '_uncode_%section%_footer_width',
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
		'section' => 'uncode_%section%_section',
	);

	$custom_fields_section_title = array(
		'id' => '_uncode_%section%_cf_title',
		'label' => '<i class="fa fa-pencil3"></i> ' . esc_html__('Custom fields', 'uncode-core') ,
		'desc' => '' ,
		'type' => 'textblock-titled',
		'class' => 'section-title',
		'section' => 'uncode_%section%_section',
	);

	$custom_fields_list = array(
		'id' => '_uncode_%section%_custom_fields',
		'class' => 'uncode-custom-fields-list',
		'label' => esc_html__('Custom fields', 'uncode-core') ,
		'desc' => esc_html__('Create here all the custom fields that can be used inside the Posts Module.', 'uncode-core') ,
		'type' => 'list-item',
		'section' => 'uncode_%section%_section',
		'settings' => array(
			array(
				'id' => '_uncode_cf_unique_id',
				'class' => 'unique_id',
				'std' => 'detail-',
				'type' => 'text',
				'label' => esc_html__('Unique custom field ID','uncode-core') ,
				'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode-core'),
			),
		)
	);

	$portfolio_cpt_name = ot_get_option('_uncode_portfolio_cpt');
	if ($portfolio_cpt_name == '') $portfolio_cpt_name = 'portfolio';

	$cpt_single_sections = array();
	$cpt_index_sections = array();
	$cpt_single_options = array();
	$cpt_index_options = array();

	if (count($uncode_post_types) > 0) {
		foreach ($uncode_post_types as $key => $value) {
			if ($value !== 'portfolio' && $value !== 'product') {
				$cpt_obj = get_post_type_object($value);

				if ( is_object($cpt_obj) ) {
					$cpt_name = $cpt_obj->labels->name;
					$cpt_sing_name = $cpt_obj->labels->singular_name;
					$cpt_single_sections[] = array(
						'id' => 'uncode_'.$value.'_section',
						'title' => '<span class="smaller"><i class="fa fa-paper"></i> ' . ucfirst($cpt_sing_name) . '</span>',
						'group' => esc_html__('Single', 'uncode-core')
					);
					$cpt_index_sections[] = array(
						'id' => 'uncode_'.$value.'_index_section',
						'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . ucfirst($cpt_name) . '</span>',
						'group' => esc_html__('Archives', 'uncode-core')
					);
				} elseif ( $value == 'author' ) {
					$cpt_index_sections[] = array(
						'id' => 'uncode_'.$value.'_index_section',
						'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . esc_html__('Authors', 'uncode-core') . '</span>',
						'group' => esc_html__('Archives', 'uncode-core')
					);
				}
			}
		}

		foreach ($uncode_post_types as $key => $value) {
			if ($value !== 'portfolio' && $value !== 'product' && $value !== 'author') {
				$cpt_single_options[] = uncode_core_replace_section_id($value, $menu_section_title);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $menu);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $menu_width);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $menu_opaque);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_section_title);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_type);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_uncode_block);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_revslider);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_layerslider);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_width);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_height);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_min_height);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_title);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_style);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_content_width);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_custom_width);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_align);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_position);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_title_font);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_title_size);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_title_height);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_title_spacing);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_title_weight);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_title_transform);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_title_italic);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_text_animation);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_animation_speed);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_animation_delay);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_featured);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_background);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_parallax);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_kburns);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_overlay_color);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_overlay_color_alpha);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_scroll_opacity);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $header_scrolldown);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $menu_no_padding);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $menu_no_padding_mobile);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $body_section_title);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $body_uncode_select_content);
				$cpt_single_options[] = uncode_core_replace_section_id($value, run_array_to($body_uncode_block_single, 'condition', '_uncode_' . $value . '_select_content:is(uncodeblock)'));
				$cpt_single_options[] = uncode_core_replace_section_id($value, run_array_to($body_layout_width, 'condition', '_uncode_' . $value . '_select_content:is()'));
				$cpt_single_options[] = uncode_core_replace_section_id($value, run_array_to($body_layout_width_custom, 'condition', '_uncode_' . $value . '_select_content:is(),_uncode_' . $value . '_layout_width:is(limit)'));
				$cpt_single_options[] = uncode_core_replace_section_id($value, run_array_to($show_breadcrumb, 'condition', '_uncode_' . $value . '_select_content:is()'));
				$cpt_single_options[] = uncode_core_replace_section_id($value, run_array_to($breadcrumb_align, 'condition', '_uncode_' . $value . '_select_content:is(),_uncode_' . $value . '_breadcrumb:is(on)'));
				$cpt_single_options[] = uncode_core_replace_section_id($value, run_array_to($show_title_std_on, 'condition', '_uncode_' . $value . '_select_content:is()'));


				$cpt_single_options[] = uncode_core_replace_section_id($value, $show_media);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $show_featured_media);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $show_share);
				// $cpt_single_options[] = uncode_core_replace_section_id($value, $image_layout);
				// $cpt_single_options[] = uncode_core_replace_section_id($value, $media_size);
				// $cpt_single_options[] = uncode_core_replace_section_id($value, $enable_sticky_desc);
				// $cpt_single_options[] = uncode_core_replace_section_id($value, $enable_woo_zoom);
				// $cpt_single_options[] = uncode_core_replace_section_id($value, $thumb_cols);
				// $cpt_single_options[] = uncode_core_replace_section_id($value, $enable_woo_slider);


				$cpt_single_options[] = uncode_core_replace_section_id($value, run_array_to($show_share, 'condition', '_uncode_' . $value . '_select_content:is()'));
				$cpt_single_options[] = uncode_core_replace_section_id($value, run_array_to($image_layout, 'condition', '_uncode_' . $value . '_select_content:is()'));
				$cpt_single_options[] = uncode_core_replace_section_id($value, run_array_to($media_size, 'condition', '_uncode_' . $value . '_select_content:is()'));
				$cpt_single_options[] = uncode_core_replace_section_id($value, $body_uncode_block_after_pre);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $body_uncode_block_after);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $show_comments);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_section_title);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_activate);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_widget);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_position);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_size);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_sticky);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_style);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_bgcolor);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_fill);
				// $cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_widget_collapse);
				// $cpt_single_options[] = uncode_core_replace_section_id($value, $sidebar_widget_collapse_tablet);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $navigation_section_title);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $navigation_activate);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $navigation_content_block);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $navigation_page_index);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $navigation_index_label);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $navigation_nextprev_title);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $footer_section_title);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $footer_uncode_block);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $footer_width);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $custom_fields_section_title);
				$cpt_single_options[] = uncode_core_replace_section_id($value, $custom_fields_list);
			}
		}
		foreach ($uncode_post_types as $key => $value) {
			if ($value !== 'portfolio' && $value !== 'product') {
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $menu_section_title);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $menu);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $menu_width);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $menu_opaque);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_section_title);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', run_array_to($header_type, 'std', 'header_basic'));
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_uncode_block);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_revslider);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_layerslider);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_width);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_height);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_min_height);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_title);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_style);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_content_width);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_custom_width);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_align);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_position);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_title_font);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_title_size);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_title_height);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_title_spacing);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_title_weight);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_title_transform);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_title_italic);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_text_animation);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_animation_speed);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_animation_delay);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_featured);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_background);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_parallax);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_kburns);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_overlay_color);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_overlay_color_alpha);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_scroll_opacity);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $header_scrolldown);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $menu_no_padding);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $menu_no_padding_mobile);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $menu_no_padding);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $menu_no_padding_mobile);
				if ($value !== 'author') {
					$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $title_archive_custom_activate);
					$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $title_archive_custom_text);
					$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $subtitle_archive_custom_text);
				}
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $body_section_title);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $show_breadcrumb);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $breadcrumb_align);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $body_uncode_block);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', run_array_to($body_layout_width, 'condition', '_uncode_' . $value . '_index_content_block:is(),_uncode_' . $value . '_index_content_block:is(none)'));
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $body_single_post_width);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $body_single_text_lenght);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', run_array_to($show_title, 'condition', '_uncode_' . $value . '_index_content_block:is(),_uncode_' . $value . '_index_content_block:is(none)'));
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $remove_pagination);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $sidebar_section_title);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', run_array_to($sidebar_activate, 'std', 'on'));
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $sidebar_widget);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $sidebar_position);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $sidebar_size);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $sidebar_sticky);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $sidebar_style);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $sidebar_bgcolor);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $sidebar_fill);
				// $cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $sidebar_widget_collapse);
				// $cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $sidebar_widget_collapse_tablet);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $footer_section_title);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $footer_uncode_block);
				$cpt_index_options[] = uncode_core_replace_section_id($value . '_index', $footer_width);
			}
		}
	}

	$custom_settings_section_one = array(
		array(
			'id' => 'uncode_header_section',
			'title' => '<i class="fa fa-heart3"></i> ' . esc_html__('Navbar', 'uncode-core'),
			'group' => esc_html__('General', 'uncode-core'),
			'group_icon' => 'fa-layout'
		) ,
		array(
			'id' => 'uncode_main_section',
			'title' => '<i class="fa fa-layers"></i> ' . esc_html__('Layout', 'uncode-core'),
			'group' => esc_html__('General', 'uncode-core'),
		) ,
		// array(
		// 	'id' => 'uncode_header_section',
		// 	'title' => '<i class="fa fa-menu"></i> ' . esc_html__('Menu', 'uncode-core'),
		// 	'group' => esc_html__('General', 'uncode-core')
		// ) ,
		array(
			'id' => 'uncode_footer_section',
			'title' => '<i class="fa fa-ellipsis"></i> ' . esc_html__('Footer', 'uncode-core'),
			'group' => esc_html__('General', 'uncode-core')
		) ,
		array(
			'id' => 'uncode_post_section',
			'title' => '<span class="smaller"><i class="fa fa-paper"></i> ' . esc_html__('Post', 'uncode-core') . '</span>',
			'group' => esc_html__('Single', 'uncode-core'),
			'group_icon' => 'fa-file2'
		) ,
		array(
			'id' => 'uncode_page_section',
			'title' => '<span class="smaller"><i class="fa fa-paper"></i> ' . esc_html__('Page', 'uncode-core') . '</span>',
			'group' => esc_html__('Single', 'uncode-core')
		) ,
		array(
			'id' => 'uncode_portfolio_section',
			'title' => '<span class="smaller"><i class="fa fa-paper"></i> ' . ucfirst($portfolio_cpt_name) . '</span>',
			'group' => esc_html__('Single', 'uncode-core')
		) ,
	);

	$custom_settings_section_one = array_merge( $custom_settings_section_one, $cpt_single_sections );

	$custom_settings_section_two = array(
		array(
			'id' => 'uncode_post_index_section',
			'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . esc_html__('Posts', 'uncode-core') . '</span>',
			'group' => esc_html__('Archives', 'uncode-core'),
			'group_icon' => 'fa-archive2'
		) ,
		array(
			'id' => 'uncode_page_index_section',
			'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . esc_html__('Pages', 'uncode-core') . '</span>',
			'group' => esc_html__('Archives', 'uncode-core')
		) ,
		array(
			'id' => 'uncode_portfolio_index_section',
			'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . ucfirst($portfolio_cpt_name) . 's</span>',
			'group' => esc_html__('Archives', 'uncode-core')
		) ,
	);

	$custom_settings_section_one = array_merge( $custom_settings_section_one, $custom_settings_section_two );
	$custom_settings_section_one = array_merge( $custom_settings_section_one, $cpt_index_sections );

	$custom_settings_section_three = array(
		array(
			'id' => 'uncode_search_index_section',
			'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . esc_html__('Search', 'uncode-core') . '</span>',
			'group' => esc_html__('Archives', 'uncode-core')
		) ,
		array(
			'id' => 'uncode_404_section',
			'title' => '<span class="smaller"><i class="fa fa-help"></i> ' . esc_html__('404', 'uncode-core') . '</span>',
			'group' => esc_html__('Single', 'uncode-core')
		) ,
		array(
			'id' => 'uncode_colors_section',
			'title' => '<i class="fa fa-drop"></i> ' . esc_html__('Palette', 'uncode-core'),
			'group' => esc_html__('Visual', 'uncode-core'),
			'group_icon' => 'fa-eye2'
		) ,
		array(
			'id' => 'uncode_typography_section',
			'title' => '<i class="fa fa-font"></i> ' . esc_html__('Typography', 'uncode-core'),
			'group' => esc_html__('Visual', 'uncode-core')
		) ,
		array(
			'id' => 'uncode_customize_section',
			'title' => '<i class="fa fa-box"></i> ' . esc_html__('Customize', 'uncode-core'),
			'group' => esc_html__('Visual', 'uncode-core')
		) ,
	);

	if ( class_exists( 'WooCommerce' ) ) {
		$custom_settings_section_three[] = array(
			'id' => 'uncode_woocommerce_section',
			'title' => esc_html__('WooCommerce', 'uncode-core'),
			'group' => esc_html__('Utility', 'uncode-core')
		);
	}

	$utility_headers = array(
		array(
			'id' => 'uncode_sidebars_section',
			'title' => '<i class="fa fa-content-right"></i> ' . esc_html__('Sidebars', 'uncode-core'),
			'group' => esc_html__('Utility', 'uncode-core'),
			'group_icon' => 'fa-cog2'
		) ,
		array(
			'id' => 'uncode_connections_section',
			'title' => '<i class="fa fa-share2"></i> ' . esc_html__('Socials', 'uncode-core'),
			'group' => esc_html__('Utility', 'uncode-core')
		) ,
		array(
			'id' => 'uncode_extra_section',
			'title' => esc_html__('Extra', 'uncode-core'),
			'group' => esc_html__('Utility', 'uncode-core')
		) ,
		array(
			'id' => 'uncode_cssjs_section',
			'title' => '<i class="fa fa-code"></i> ' . esc_html__('CSS & JS', 'uncode-core'),
			'group' => esc_html__('Utility', 'uncode-core')
		) ,
		array(
			'id' => 'uncode_performance_section',
			'title' => '<i class="fa fa-loader"></i> ' . esc_html__('Performance', 'uncode-core'),
			'group' => esc_html__('Utility', 'uncode-core')
		) ,
	);

	$custom_settings_section_three = array_merge( $custom_settings_section_three, $utility_headers );
	$custom_settings_section_one = array_merge( $custom_settings_section_one, $custom_settings_section_three );

	if ( class_exists( 'YITH_WCWL' ) ) {
		$uncode_woocommerce_wishlist = array(
			'id' => '_uncode_woocommerce_wishlist',
			'label' => esc_html__('Wishlist Icon', 'uncode-core') ,
			'desc' => esc_html__('Activate to show the WooCommerce Wishlist icon in the Menu bar.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		);

		$uncode_woocommerce_wishlist_desktop = array(
			'id' => '_uncode_woocommerce_wishlist_desktop',
			'label' => esc_html__('Wishlist Icon Menu', 'uncode-core') ,
			'desc' => esc_html__('Show the WooCommerce Wishlist icon in the Menu bar when layout is on desktop mode (only for Overlay and Offcanvas Menu).', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_woocommerce_wishlist:is(on),_uncode_headers:not(hmenu-right),_uncode_headers:not(hmenu-justify),_uncode_headers:not(hmenu-left),_uncode_headers:not(hmenu-center),_uncode_headers:not(hmenu-center-split),_uncode_headers:not(hmenu-center-double),_uncode_headers:not(vmenu)',
			'operator' => 'and'
		);

		$uncode_woocommerce_wishlist_icon = array(
			'id' => '_uncode_woocommerce_wishlist_icon',
			'label' => esc_html__('Wishlist icon select', 'uncode-core') ,
			'desc' => esc_html__('Specify the Wishlist icon.', 'uncode-core') ,
			'std' => 'fa fa-heart3',
			'type' => 'text',
			'class' => 'button_icon_container',
			'condition' => '_uncode_woocommerce_wishlist:is(on)',
			'section' => 'uncode_header_section',
		);
	} else {
		$uncode_woocommerce_wishlist = array();
		$uncode_woocommerce_wishlist_desktop = array();
		$uncode_woocommerce_wishlist_icon = array();
	}

	if ( class_exists( 'WooCommerce' ) ) {
		$uncode_woocommerce_search_type = array(
			'id' => '_uncode_menu_search_type',
			'label' => esc_html__('Search type', 'uncode-core') ,
			'desc' => esc_html__("Specify the Search type. NB. With 'Products', as WooCommerce default, the search results will be displayed by the Products template and not by the Search template.", 'uncode-core') ,
			'std' => 'default',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'choices' => array(
				array(
					'value' => 'default',
					'label' => esc_html__('Default', 'uncode-core') ,
				) ,
				array(
					'value' => 'products',
					'label' => esc_html__('Products', 'uncode-core') ,
				) ,
			) ,
			'condition' => '_uncode_menu_search:is(on)',
			'operator' => 'or'
		);
	} else {
		$uncode_woocommerce_search_type = array();
	}

	// Top-Bar Core Settings
	if ( get_option( 'uncode_core_settings_opt_enhanced_top_bar' ) === 'on' ) {
		$top_bar_padding = array(
			'id' => '_uncode_secondary_padding',
			'label' => esc_html__('Top-Bar padding', 'uncode-core') ,
			'desc' => esc_html__('Activate to increase secondary Menu padding.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'and'
		);
		$top_bar_border = array(
			'id' => '_uncode_topbar_border',
			'label' => esc_html__('Top-Bar border', 'uncode-core') ,
			'desc' => esc_html__('Activate to show the Top-Bar bottom border.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'and'
		);
		$top_line_title = array(
			'id' => '_uncode_top_bar_add_block_title',
			'label' => '<i class="fa fa-sidebar fa-rotate-90"></i> ' . esc_html__('Top-Bar', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'and'
		);
		$top_line_onoff = array(
			'id' => '_uncode_menu_bloginfo_show',
			'label' => esc_html__('Top line', 'uncode-core') ,
			'desc' => esc_html__('Activate to show the top text.', 'uncode-core') ,
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Hide', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'left',
					'label' => esc_html__('Left', 'uncode-core') ,
					'src' => ''
				),
				array(
					'value' => 'center',
					'label' => esc_html__('Center', 'uncode-core') ,
					'src' => ''
				),
				array(
					'value' => 'right',
					'label' => esc_html__('Right', 'uncode-core') ,
					'src' => ''
				),
			),
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'and'
		);
		$top_line_onoff_tablet = array(
			'id' => '_uncode_menu_bloginfo_tablet',
			'label' => esc_html__('Hide on Tablet', 'uncode-core') ,
			'desc' => esc_html__('Activate to hide this element on tablet.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_menu_bloginfo_show:not()',
			'operator' => 'and'
		);
		$top_line_onoff_mobile = array(
			'id' => '_uncode_menu_bloginfo_mobile',
			'label' => esc_html__('Hide on Mobile', 'uncode-core') ,
			'desc' => esc_html__('Activate to hide this element on mobile device.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_menu_bloginfo_show:not()',
			'operator' => 'and'
		);
		$top_line_enhanced = array(
			'id' => '_uncode_menu_bloginfo',
			'label' => esc_html__('Top line text', 'uncode-core') ,
			'desc' => esc_html__('Insert additional text on top of the Menu (it works combined with the Secondary Menu).','uncode-core') ,
			'type' => 'textarea',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_menu_bloginfo_show:not()',
			'operator' => 'and'
		);
		$top_line_menu = array(
			'id' => '_uncode_menu_secondary_show',
			'label' => esc_html__('Secondary Menu', 'uncode-core') ,
			'desc' => esc_html__('Specify if to activate the Secondary Menu and positioning.', 'uncode-core') ,
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Hide', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'left',
					'label' => esc_html__('Left', 'uncode-core') ,
					'src' => ''
				),
				array(
					'value' => 'center',
					'label' => esc_html__('Center', 'uncode-core') ,
					'src' => ''
				),
				array(
					'value' => 'right',
					'label' => esc_html__('Right', 'uncode-core') ,
					'src' => ''
				),
			),
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'and'
		);
		$top_line_menu_tablet = array(
			'id' => '_uncode_menu_secondary_tablet',
			'label' => esc_html__('Hide on Tablet', 'uncode-core') ,
			'desc' => esc_html__('Activate to hide this element on tablet.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_menu_secondary_show:not()',
			'operator' => 'and'
		);
		$top_line_menu_mobile = array(
			'id' => '_uncode_menu_secondary_mobile',
			'label' => esc_html__('Hide on Mobile', 'uncode-core') ,
			'desc' => esc_html__('Activate to hide this element on mobile device.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_menu_secondary_show:not()',
			'operator' => 'and'
		);
		$top_bar_socials = array(
			'id' => '_uncode_menu_socials_top_bar',
			'label' => esc_html__('Social Icons', 'uncode-core') ,
			'desc' => esc_html__('Specify if to activate the Social Icons and positioning.', 'uncode-core') ,
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Hide', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'left',
					'label' => esc_html__('Left', 'uncode-core') ,
					'src' => ''
				),
				array(
					'value' => 'center',
					'label' => esc_html__('Center', 'uncode-core') ,
					'src' => ''
				),
				array(
					'value' => 'right',
					'label' => esc_html__('Right', 'uncode-core') ,
					'src' => ''
				),
			),
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'and'
		);
		$top_bar_socials_tablet = array(
			'id' => '_uncode_menu_socials_top_bar_tablet_hide',
			'label' => esc_html__('Hide On Tablet', 'uncode-core') ,
			'desc' => esc_html__('Activate to hide this element on tablet.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'and'
		);
		$top_bar_socials_mobile = array(
			'id' => '_uncode_menu_socials_top_bar_mobile_hide',
			'label' => esc_html__('Hide On Mobile', 'uncode-core') ,
			'desc' => esc_html__('Activate to hide this element on mobile device.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'and'
		);
		$top_bar_responsive = array(
			'id' => '_uncode_top_bar_responsive',
			'label' => esc_html__('Top-Bar responsive', 'uncode-core') ,
			'desc' => esc_html__('Specify if elements that have different positions are stacked on different rows on tablet and mobile device.', 'uncode-core') ,
			'std' => 'center',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('None', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'tablet',
					'label' => esc_html__('Center under tablet', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'mobile',
					'label' => esc_html__('Center under mobile', 'uncode-core') ,
					'src' => ''
				)
			),
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'and'
		);
		$top_bar_customize_title = array(
			'id' => '_uncode_top_bar_add_block_title',
			'label' => '<i class="fa fa-sidebar fa-rotate-90"></i> ' . esc_html__('Top-Bar', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		);
		$top_bar_skin = array(
			'id' => '_uncode_secondary_menu_style',
			'label' => esc_html__('Top-Bar Skin', 'uncode-core') ,
			'desc' => esc_html__('Specify the Top-Bar skin.', 'uncode-core') ,
			'std' => 'dark',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:is(hmenu-right),_uncode_headers:is(hmenu-left),_uncode_headers:is(hmenu-justify),_uncode_headers:is(hmenu-center),_uncode_headers:is(hmenu-center-split),_uncode_headers:is(hmenu-center-double)',
			'operator' => 'or',
			'choices' => $stylesArrayMenu
		);
		$top_bar_font_size = array(
			'id' => '_uncode_secondary_menu_font_size',
			'label' => esc_html__('Tob Bar Font Size', 'uncode-core') ,
			'desc' => esc_html__('Specify the Top-Bar font size.', 'uncode-core') ,
			'std' => '12',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		);
		$top_bar_font_size_mobile = array(
			'id' => '_uncode_secondary_menu_mobile_font_size',
			'label' => esc_html__('Mobile Top-Bar Font Size', 'uncode-core') ,
			'desc' => esc_html__('Specify the Top-Bar font size on mobile devices.', 'uncode-core') ,
			'std' => '10',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		);
		$top_bar_font_family = array(
			'id' => '_uncode_topbar_font_family',
			'class' => 'uncode_font_family_dropdown',
			'label' => esc_html__('Top-Bar font family', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu font family.', 'uncode-core') ,
			'std' => 'font-555555',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		);
		$top_bar_font_weight = array(
			'id' => '_uncode_topbar_font_weight',
			'label' => esc_html__('Top-Bar font weight', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu font weight.', 'uncode-core') ,
			'std' => '400',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		);
		$hide_secondary_menu = $secondary_menu_padding = $top_line_std = $secondary_menu_skin = array();
	} else {
		$hide_secondary_menu = array(
			'id' => '_uncode_menu_no_secondary',
			'label' => esc_html__('Hide secondary Menu', 'uncode-core') ,
			'desc' => esc_html__('Activate to hide the Secondary Menu.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu)',
		);
		$secondary_menu_padding = array(
			'id' => '_uncode_secondary_padding',
			'label' => esc_html__('Secondary Menu padding', 'uncode-core') ,
			'desc' => esc_html__('Activate to increase secondary Menu padding.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_menu_no_secondary:is(off)',
			'operator' => 'and'
		);
		$top_line_std = array(
			'id' => '_uncode_menu_bloginfo',
			'label' => esc_html__('Top line text', 'uncode-core') ,
			'desc' => esc_html__('Insert additional text on top of the Menu (it works combined with the Secondary Menu).','uncode-core') ,
			'type' => 'textarea',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_menu_no_secondary:is(off)',
			'operator' => 'and'
		);
		$secondary_menu_skin = array(
			'id' => '_uncode_secondary_menu_style',
			'label' => esc_html__('Secondary Menu Skin', 'uncode-core') ,
			'desc' => esc_html__('Specify the Secondary Menu Skin.', 'uncode-core') ,
			'std' => 'dark',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:is(hmenu-right),_uncode_headers:is(hmenu-left),_uncode_headers:is(hmenu-justify),_uncode_headers:is(hmenu-center),_uncode_headers:is(hmenu-center-split),_uncode_headers:is(hmenu-center-double)',
			'operator' => 'or',
			'choices' => $stylesArrayMenu
		);
		$top_line_title = $top_line_onoff = $top_line_onoff_mobile = $top_line_onoff_tablet = $top_line_enhanced = $top_bar_font_size = $top_bar_socials = $top_bar_socials_tablet = $top_bar_socials_mobile = $top_bar_responsive = $top_line_menu = $top_line_menu_tablet = $top_line_menu_mobile = $top_bar_padding = $top_bar_border = $top_bar_customize_title = $top_bar_skin = $top_bar_font_size_mobile = $top_bar_font_family = $top_bar_font_weight = array();
	}

	$custom_settings_one = array(
		array(
			'id' => '_uncode_general_block_title',
			'label' => '<i class="fa fa-globe3"></i> ' . esc_html__('General', 'uncode-core') ,
			'desc' => '',
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_main_section',
		) ,
		array(
			'id' => '_uncode_main_width',
			'label' => esc_html__('Layout Width', 'uncode-core') ,
			'desc' => esc_html__('Enter the width of your site.', 'uncode-core') ,
			'std' => array(
				'1200',
				'px'
			) ,
			'type' => 'measurement',
			'section' => 'uncode_main_section',
		) ,
		array(
			'id' => '_uncode_main_align',
			'label' => esc_html__('Layout align', 'uncode-core') ,
			'desc' => esc_html__('Specify the alignment of the content area when is less then 100% width.', 'uncode-core') ,
			'std' => 'center',
			'type' => 'select',
			'section' => 'uncode_main_section',
			'choices' => array(
				array(
					'value' => 'left',
					'label' => esc_html__('Left', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'center',
					'label' => esc_html__('Center', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'right',
					'label' => esc_html__('Right', 'uncode-core') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_boxed',
			'label' => esc_html__('Boxed', 'uncode-core') ,
			'desc' => esc_html__('Activate for the boxed layout.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_main_section',
		) ,
		array(
			'id' => '_uncode_body_border',
			'label' => esc_html__('Body frame', 'uncode-core') ,
			'desc' => esc_html__('Specify the thickness of the frame around the body', 'uncode-core') ,
			'std' => '0',
			'type' => 'numeric-slider',
			'min_max_step'=> '0,36,9',
			'section' => 'uncode_main_section',
			'condition' => '_uncode_boxed:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_body_border_color',
			'label' => esc_html__('Body frame color', 'uncode-core') ,
			'desc' => esc_html__('Specify the body frame color.', 'uncode-core') ,
			'type' => 'uncode_color',
			'section' => 'uncode_main_section',
			'condition' => '_uncode_boxed:is(off),_uncode_body_border:not(0)',
			'operator' => 'and'
		) ,
		// array(
		// 	'id' => '_uncode_mobile_margin',
		// 	'label' => esc_html__('Mobile margin', 'uncode-core') ,
		// 	'desc' => esc_html__('Specify the lateral margins on mobile devices.', 'uncode-core') ,
		// 	'type' => 'select',
		// 	'std' => 'default',
		// 	'choices' => array(
		// 		array(
		// 			'value' => 'default',
		// 			'label' => esc_html__('Default', 'uncode-core') ,
		// 		) ,
		// 		array(
		// 			'value' => 'reduced',
		// 			'label' => esc_html__('Reduced', 'uncode-core') ,
		// 		) ,
		// 	) ,
		// 	'section' => 'uncode_main_section',
		// ) ,
		uncode_core_replace_section_id('main', run_array_to($header_section_title, 'condition', '_uncode_boxed:is(off)')),
		array(
			'id' => '_uncode_header_full',
			'label' => esc_html__('Container full width', 'uncode-core') ,
			'desc' => esc_html__('Activate to expand the Header container to full width.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_main_section',
			'condition' => '_uncode_boxed:is(off)',
			'operator' => 'and'
		) ,
		uncode_core_replace_section_id('main', run_array_to($body_section_title, 'condition', '_uncode_boxed:is(off)')),
		array(
			'id' => '_uncode_body_full',
			'label' => esc_html__('Content area full width', 'uncode-core') ,
			'desc' => esc_html__('Activate to expand the content area to full width.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_main_section',
			'condition' => '_uncode_boxed:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_custom_logo_block_title',
			'label' => '<i class="fa fa-heart3"></i> ' . esc_html__('Logo', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_logo_switch',
			'label' => esc_html__('Logo Switchable', 'uncode-core') ,
			'desc' => esc_html__('Activate to upload different Logo for each Skin.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_logo',
			'label' => esc_html__('Logo', 'uncode-core') ,
			'desc' => esc_html__('Upload a Logo. You can use Images, SVG code or HTML code.', 'uncode-core') ,
			'type' => 'upload',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_logo_switch:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_logo_light',
			'label' => esc_html__('Logo - Light', 'uncode-core') ,
			'desc' => esc_html__('Upload a Logo for the Light Skin.', 'uncode-core') ,
			'type' => 'upload',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_logo_switch:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_logo_dark',
			'label' => esc_html__('Logo - Dark', 'uncode-core') ,
			'desc' => esc_html__('Upload a Logo for the Dark Skin.', 'uncode-core') ,
			'type' => 'upload',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_logo_switch:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_logo_mobile_switch',
			'label' => esc_html__('Logo Mobile Version', 'uncode-core') ,
			'desc' => esc_html__('Activate to upload different Logo for mobile devices.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_logo_mobile',
			'label' => esc_html__('Logo Mobile', 'uncode-core') ,
			'desc' => esc_html__('Upload a Logo for mobile. You can use Images, SVG code or HTML code.', 'uncode-core') ,
			'type' => 'upload',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_logo_mobile_switch:is(on),_uncode_logo_switch:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_logo_mobile_light',
			'label' => esc_html__('Logo Mobile - Light', 'uncode-core') ,
			'desc' => esc_html__('Upload a Logo mobile for the Light Skin.', 'uncode-core') ,
			'type' => 'upload',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_logo_mobile_switch:is(on),_uncode_logo_switch:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_logo_mobile_dark',
			'label' => esc_html__('Logo Mobile - Dark', 'uncode-core') ,
			'desc' => esc_html__('Upload a Logo mobile for the Dark Skin.', 'uncode-core') ,
			'type' => 'upload',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_logo_mobile_switch:is(on),_uncode_logo_switch:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_logo_height',
			'label' => esc_html__('Logo height', 'uncode-core'),
			'desc' => esc_html__('Enter the height of the Logo in px.', 'uncode-core') ,
			'std' => '20',
			'type' => 'text',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_logo_height_mobile',
			'label' => esc_html__('Logo height mobile', 'uncode-core'),
			'desc' => esc_html__('Enter the height of the Logo in px for mobile version.', 'uncode-core') ,
			'type' => 'text',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_headers_block_title',
			'label' => '<i class="fa fa-menu"></i> ' . esc_html__('Menu', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_headers',
			'desc' => esc_html__('Specify the Menu layout.', 'uncode-core') ,
			'label' => '' ,
			'std' => 'hmenu-right',
			'type' => 'radio-image',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_hmenu_position',
			'label' => esc_html__('Menu horizontal position', 'uncode-core') ,
			'desc' => esc_html__('Specify the horizontal position of the Menu.', 'uncode-core') ,
			'std' => 'left',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'left',
					'label' => esc_html__('Default', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'right',
					'label' => esc_html__('Opposite', 'uncode-core') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_vmenu_position',
			'label' => esc_html__('Menu horizontal position', 'uncode-core') ,
			'desc' => esc_html__('Specify the horizontal position of the Menu.', 'uncode-core') ,
			'std' => 'left',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(vmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'left',
					'label' => esc_html__('Left', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'right',
					'label' => esc_html__('Right', 'uncode-core') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_vmenu_v_position',
			'label' => esc_html__('Menu vertical alignment', 'uncode-core') ,
			'desc' => esc_html__('Specify the vertical alignment of the Menu.', 'uncode-core') ,
			'std' => 'middle',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(vmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'top',
					'label' => esc_html__('Top', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'middle',
					'label' => esc_html__('Middle', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'bottom',
					'label' => esc_html__('Bottom', 'uncode-core') ,
					'src' => ''
				) ,
			)
		) ,
		array(
			'id' => '_uncode_vmenu_align',
			'label' => esc_html__('Menu horizontal alignment', 'uncode-core') ,
			'desc' => esc_html__('Specify the horizontal alignment of the Menu.', 'uncode-core') ,
			'std' => 'left',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(vmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'left',
					'label' => esc_html__('Left Align', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'center',
					'label' => esc_html__('Center Align', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'right',
					'label' => esc_html__('Right Align', 'uncode-core') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_vmenu_width',
			'label' => esc_html__('Vertical menu width','uncode-core') ,
			'desc' => esc_html__('Vertical menu width in px', 'uncode-core') ,
			'std' => '252',
			'type' => 'numeric-slider',
			'section' => 'uncode_header_section',
			'rows' => '',
			'post_type' => '',
			'taxonomy' => '',
			'min_max_step' => '108,1024,1',
			'class' => '',
			'condition' => '_uncode_headers:contains(vmenu)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_accordion_active',
			'label' => esc_html__('Vertical Menu open', 'uncode-core') ,
			'desc' => esc_html__('Open the accordion Menu at the current item Menu on page loading.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:is(vmenu)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_full',
			'label' => esc_html__('Menu full width', 'uncode-core') ,
			'desc' => esc_html__('Activate to expand the Menu to full width. (Only for the horizontal menus).', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_boxed:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_offcanvas_overlay',
			'label' => esc_html__('Offcanvas variation', 'uncode-core') ,
			'desc' => esc_html__('Activate this option for Off Canvas variation in which the menu slides over the page without pushing it.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:is(vmenu-offcanvas)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_visuals_block_title',
			'label' => '<i class="fa fa-eye2"></i> ' . esc_html__('Visual', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_shadows',
			'label' => esc_html__('Menu divider shadow', 'uncode-core') ,
			'desc' => esc_html__('Activate to show the Menu divider shadow.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_submenu_shadows',
			'label' => esc_html__('Menu dropdown shadow', 'uncode-core') ,
			'desc' => esc_html__('Activate this for the shadow effect on Menu dropdown on desktop view. NB. This option works for horizontal Menus only.', 'uncode-core') ,
			'std' => 'none',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'std' => '',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('None', 'uncode-core') ,
				) ,
				array(
					'value' => 'xs',
					'label' => esc_html__('Extra Small', 'uncode-core') ,
				) ,
				array(
					'value' => 'sm',
					'label' => esc_html__('Small', 'uncode-core') ,
				) ,
				array(
					'value' => 'std',
					'label' => esc_html__('Standard', 'uncode-core') ,
				) ,
				array(
					'value' => 'lg',
					'label' => esc_html__('Large', 'uncode-core') ,
				) ,
				array(
					'value' => 'xl',
					'label' => esc_html__('Extra Large', 'uncode-core') ,
				) ,
			),
			'condition' => '_uncode_headers:contains(hmenu),_uncode_headers:is(vmenu-offcanvas),_uncode_headers:is(menu-overlay)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_submenu_darker_shadows',
			'label' => esc_html__('Menu dropdown darker shadow', 'uncode-core') ,
			'desc' => esc_html__('Activate this for the dark shadow effect on Menu dropdown on desktop view.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_submenu_shadows:not(),_uncode_headers:contains(hmenu),_uncode_headers:is(vmenu-offcanvas),_uncode_headers:is(menu-overlay)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_submenu_style',
			'label' => esc_html__('Menu Dropdown Style', 'uncode-core') ,
			'desc' => esc_html__('Select the dropdown and Megamenu dropdown style.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Default', 'uncode-core') ,
				) ,
				array(
					'value' => 'menu-sub-enhanced',
					'label' => esc_html__('Enhanced', 'uncode-core') ,
				) ,
			),
			'condition' => '_uncode_headers:contains(hmenu)',
			'operator' => 'and',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_focus',
			'label' => esc_html__('Menu Dropdown Focus', 'uncode-core') ,
			'desc' => esc_html__('Activate this option to have the Focus effect: the main Menu bar takes color if transparent and, with Megamenu dropdowns, an overlay layer is displayed to focus attention to the Menu.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_boxed:is(off),_uncode_menu_full:is(on),_uncode_submenu_style:is(menu-sub-enhanced)',
			'operator' => 'and',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_blur',
			'label' => esc_html__('Menu Background Blur', 'uncode-core') ,
			'desc' => esc_html__('Activate this option to have the Blur effect on the Primary Menu Background. NB. Note that it works with Transparent or Semi-Transparent backgrounds.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:not(hmenu-center),_uncode_headers:not(vmenu)',
			'operator' => 'and',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Disabled', 'uncode-core') ,
				) ,
				array(
					'value' => 'top',
					'label' => esc_html__('Top', 'uncode-core') ,
				) ,
				array(
					'value' => 'stuck',
					'label' => esc_html__('Sticky', 'uncode-core') ,
				) ,
				array(
					'value' => 'always',
					'label' => esc_html__('Always', 'uncode-core') ,
				) ,
			)
		) ,
		array(
			'id' => '_uncode_menu_borders',
			'label' => esc_html__('Menu borders', 'uncode-core') ,
			'desc' => esc_html__('Activate to show the Menu borders.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_no_menu_v_borders',
			'label' => esc_html__('No Vertical Borders', 'uncode-core') ,
			'desc' => esc_html__('Remove the vertical borders.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_borders:is(on)',
			'operator' => 'and',
		) ,
		array(
			'id' => '_uncode_menu_mobile_borders',
			'label' => esc_html__('Menu borders on mobile', 'uncode-core') ,
			'desc' => esc_html__('Activate to display the internal open Menu borders on mobile devices.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_no_arrows',
			'label' => esc_html__('Menu Hide dropdown arrows', 'uncode-core') ,
			'desc' => esc_html__('Activate to hide the dropdow arrows.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_mobile_transparency',
			'label' => esc_html__('Menu mobile transparency', 'uncode-core') ,
			'desc' => esc_html__('Activate the Menu transparency when possible.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:not(hmenu-center),_uncode_headers:not(vmenu)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_change_skin',
			'label' => esc_html__('Menu Skin Changing Scroll', 'uncode-core') ,
			'desc' => esc_html__('This option enables the automatic Skin change of the menu when a Row containing a column with a different Skin is reached. Please note that this option does not recognize any Off-Grid Columns (the Skin change happens when it gets the Row).', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_desktop_transparency:is(on),_uncode_menu_mobile_transparency_scroll:is(on)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_custom_padding',
			'label' => esc_html__('Menu custom vertical padding', 'uncode-core') ,
			'desc' => esc_html__('Activate custom padding above and below the Logo.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_custom_padding_desktop',
			'label' => esc_html__('Padding on desktop', 'uncode-core') ,
			'desc' => esc_html__('Set custom padding on desktop devices.', 'uncode-core') ,
			'std' => '27',
			'type' => 'numeric-slider',
			'min_max_step'=> '0,36,9',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_custom_padding:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_custom_padding_mobile',
			'label' => esc_html__('Padding on mobile', 'uncode-core') ,
			'desc' => esc_html__('Set custom padding on mobile devices.', 'uncode-core') ,
			'std' => '27',
			'type' => 'numeric-slider',
			'min_max_step'=> '0,36,9',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_custom_padding:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_custom_lateral_padding',
			'label' => esc_html__('Padding lateral', 'uncode-core') ,
			'desc' => esc_html__('Set custom padding lateral on desktop devices.', 'uncode-core') ,
			'std' => '36',
			'type' => 'numeric-slider',
			'min_max_step'=> '36,216,36',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:not(vmenu)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_animation_block_title',
			'label' => '<i class="fa fa-fast-forward2"></i> ' . esc_html__('Behavior', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
			// 'condition' => '_uncode_headers:contains(hmenu),_uncode_headers:is(vmenu-offcanvas),_uncode_headers:is(menu-overlay)',
			// 'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_sticky',
			'label' => esc_html__('Menu sticky', 'uncode-core') ,
			'desc' => esc_html__('Activate the Sticky Menu. This is a Menu that is locked into place so that it does not disappear when the user scrolls down the page.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_headers:is(vmenu-offcanvas),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_sticky_mobile',
			'label' => esc_html__('Menu sticky mobile', 'uncode-core') ,
			'desc' => esc_html__('Activate the Sticky Menu on mobile devices. This is a Menu that is locked into place so that it does not disappear when the user scrolls down the page.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_mobile_centered',
			'label' => esc_html__('Menu mobile style', 'uncode-core') ,
			'desc' => esc_html__('Activate this option to set the Menu Mobile style.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_sticky_mobile:is(on)',
			'operator' => 'and',
			'choices' => array(
				array(
					'value' => 'off',
					'label' => esc_html__('Default', 'uncode-core') ,
				) ,
				array(
					'value' => 'on',
					'label' => esc_html__('Centered', 'uncode-core') ,
				) ,
				array(
					'value' => 'off-canvas',
					'label' => esc_html__('Off Canvas', 'uncode-core') ,
				) ,
			)
		) ,
		array(
			'id' => '_uncode_menu_hide',
			'label' => esc_html__('Menu hide', 'uncode-core') ,
			'desc' => esc_html__('Activate the autohide Menu. This is a Menu that is hiding after the user have scrolled down the page.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center),_uncode_headers:is(vmenu-offcanvas)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_hide_mobile',
			'label' => esc_html__('Menu hide mobile', 'uncode-core') ,
			'desc' => esc_html__('Activate the autohide Menu on mobile devices. This is a Menu that is hiding after the user have scrolled down the page.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'condition' => '_uncode_menu_sticky_mobile:is(on)',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_shrink',
			'label' => esc_html__('Menu shrink', 'uncode-core') ,
			'desc' => esc_html__('Activate the Shrink Menu. This is a Menu where the Logo shrinks after the user have scrolled down the page.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:contains(hmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center),_uncode_headers:is(vmenu-offcanvas)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_min_logo',
			'label' => esc_html__('Menu Shrink logo height', 'uncode-core'),
			'desc' => esc_html__('Enter the minimal height of the shrinked Logo in <b>px</b>.', 'uncode-core') ,
			'type' => 'text',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_shrink:is(on),_uncode_headers:not(vmenu)',
			'operator' => 'and',
		) ,
		array(
			'id' => '_uncode_menu_desktop_transparency',
			'label' => esc_html__('Menu desktop transp. scroll', 'uncode-core') ,
			'desc' => esc_html__('Enable this option to have a transparent Menu on the Desktop, even when scrolling the page. This option works only combined with Sticky or Hide settings. With this option enabled, the menu will change Skins automatically with the Skin of the adjacent main Row/Column.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:not(hmenu-center),_uncode_headers:not(vmenu)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_mobile_transparency_scroll',
			'label' => esc_html__('Menu mobile transp. scroll', 'uncode-core') ,
			'desc' => esc_html__('Enable this option to have a transparent Menu on the Mobile, even when scrolling the page. This option works only combined with Sticky Mobile or Hide Mobile settings. With this option enabled, the menu will change Skins automatically with the Skin of the adjacent main Row/Column.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:not(hmenu-center),_uncode_headers:not(vmenu),_uncode_menu_mobile_transparency:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_li_animation',
			'label' => esc_html__('Menu sub-levels animated', 'uncode-core') ,
			'desc' => esc_html__('Activate the animation for Menu sub-levels. NB. This option works for horizontal Menus only.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:not(vmenu)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_menu_overlay_animation',
			'label' => esc_html__('Menu overlay animation', 'uncode-core') ,
			'desc' => esc_html__('Specify the overlay Menu animation when opening and closing.', 'uncode-core') ,
			'std' => 'sequential',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'none',
					'label' => esc_html__('None', 'uncode-core') ,
				) ,
				array(
					'value' => 'simple',
					'label' => esc_html__('Opacity', 'uncode-core') ,
				) ,
				array(
					'value' => 'sequential',
					'label' => esc_html__('Sequential', 'uncode-core') ,
				) ,
				array(
					'value' => '3d',
					'label' => esc_html__('3D', 'uncode-core') ,
				) ,
			)
		) ,
		array(
			'id' => '_uncode_menu_mobile_animation',
			'label' => esc_html__('Menu Mobile animation', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu Mobile items animation.', 'uncode-core') ,
			'std' => 'none',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_sticky_mobile:is(on),_uncode_menu_hide_mobile:is(on),',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'none',
					'label' => esc_html__('None', 'uncode-core') ,
				) ,
				array(
					'value' => 'simple',
					'label' => esc_html__('Opacity', 'uncode-core') ,
				) ,
				array(
					'value' => 'scale',
					'label' => esc_html__('Sequential', 'uncode-core') ,
				) ,
				array(
					'value' => '3d',
					'label' => esc_html__('3D', 'uncode-core') ,
				) ,
			)
		) ,
		array(
			'id' => '_uncode_menu_add_block_title',
			'label' => '<i class="fa fa-square-plus"></i> ' . esc_html__('Additional', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_header_section',
		) ,
		$hide_secondary_menu,
		$secondary_menu_padding,
		array(
			'id' => '_uncode_menu_no_cta',
			'label' => esc_html__('Hide Call To Action Menu', 'uncode-core') ,
			'desc' => esc_html__('Activate to hide the Call To Action Menu.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_menu_socials',
			'label' => esc_html__('Social icons', 'uncode-core') ,
			'desc' => esc_html__('Activate to show the social connection icons in the Menu bar. NB. Please note that if you have enabled Social Icons in the Top-Bar this option is not taken into account, because there can only be one group of Social Icons.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_search',
			'label' => esc_html__('Search icon', 'uncode-core') ,
			'desc' => esc_html__('Activate to show the Search icon in the Menu bar.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_search_desktop',
			'label' => esc_html__('Search Icon Menu', 'uncode-core') ,
			'desc' => esc_html__('Show the Search icon in the Menu bar when layout is on desktop mode (only for Overlay and Offcanvas Menu).', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_search:is(on),_uncode_headers:not(hmenu-right),_uncode_headers:not(hmenu-justify),_uncode_headers:not(hmenu-left),_uncode_headers:not(hmenu-center),_uncode_headers:not(hmenu-center-split),_uncode_headers:not(hmenu-center-double),_uncode_headers:not(vmenu)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_drop_down_search',
			'label' => esc_html__('Search Dropdown', 'uncode-core') ,
			'desc' => esc_html__('Set the dropdown style for main search.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_search:is(on),_uncode_headers:contains(hmenu)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_menu_search_animation',
			'label' => esc_html__('Search animation', 'uncode-core') ,
			'desc' => esc_html__('Specify the Search animation when opening and closing.', 'uncode-core') ,
			'std' => 'sequential',
			'type' => 'select',
			'section' => 'uncode_header_section',
			'choices' => array(
				array(
					'value' => '3d',
					'label' => esc_html__('3D', 'uncode-core') ,
				) ,
				array(
					'value' => 'sequential',
					'label' => esc_html__('Flat', 'uncode-core') ,
				) ,
			) ,
			'condition' => '_uncode_menu_search:is(on)',
			'operator' => 'or'
		) ,
		$uncode_woocommerce_search_type,
		array(
			'id' => '_uncode_woocommerce_cart',
			'label' => esc_html__('Cart Icon', 'uncode-core') ,
			'desc' => esc_html__('Activate to show the WooCommerce Cart icon in the Menu bar.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_woocommerce_cart_desktop',
			'label' => esc_html__('Cart Icon Menu', 'uncode-core') ,
			'desc' => esc_html__('Show the WooCommerce Cart icon in the Menu bar when layout is on desktop mode (only for Overlay and Offcanvas Menu).', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_woocommerce_cart:is(on),_uncode_headers:not(hmenu-right),_uncode_headers:not(hmenu-justify),_uncode_headers:not(hmenu-left),_uncode_headers:not(hmenu-center),_uncode_headers:not(hmenu-center-split),_uncode_headers:not(hmenu-center-double),_uncode_headers:not(vmenu)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_woocommerce_cart_icon',
			'label' => esc_html__('Cart icon select', 'uncode-core') ,
			'desc' => esc_html__('Specify the Cart icon.', 'uncode-core') ,
			'std' => 'fa fa-bag',
			'type' => 'text',
			'class' => 'button_icon_container',
			'condition' => '_uncode_woocommerce_cart:is(on)',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_login_account',
			'label' => esc_html__('Account Icon', 'uncode-core') ,
			'desc' => esc_html__('Activate to show the Account icon in the Menu bar. If WooCommerce is not active it redirects to the WordPress login, if WooCommerce is active it redirects to the My Account.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
		) ,
		array(
			'id' => '_uncode_login_account_desktop',
			'label' => esc_html__('Account Icon Menu', 'uncode-core') ,
			'desc' => esc_html__('Show the Account icon (or My Account if WooCommerce is active) in the Menu bar when layout is on desktop mode (only for Overlay and Offcanvas Menu).', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_login_account:is(on),_uncode_headers:not(hmenu-right),_uncode_headers:not(hmenu-justify),_uncode_headers:not(hmenu-left),_uncode_headers:not(hmenu-center),_uncode_headers:not(hmenu-center-split),_uncode_headers:not(hmenu-center-double),_uncode_headers:not(vmenu)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_login_account_icon',
			'label' => esc_html__('Account icon select', 'uncode-core') ,
			'desc' => esc_html__('Specify the Account icon.', 'uncode-core') ,
			'std' => 'fa fa-user-o',
			'type' => 'text',
			'class' => 'button_icon_container',
			'condition' => '_uncode_login_account:is(on)',
			'section' => 'uncode_header_section',
		) ,
		$uncode_woocommerce_wishlist,
		$uncode_woocommerce_wishlist_desktop,
		$uncode_woocommerce_wishlist_icon,
		array(
			'id' => '_uncode_woocommerce_cart_mobile',
			'label' => esc_html__('Extra Icons Mobile Menu', 'uncode-core') ,
			'desc' => esc_html__('Show the Cart, Account and Search icons in the Menu bar when layout is on mobile mode.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_header_section',
			'condition' => '_uncode_menu_search:is(on),_uncode_woocommerce_cart:is(on),_uncode_login_account:is(on),_uncode_woocommerce_wishlist:is(on)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_vmenu_textarea',
			'label' => esc_html__('Menu Extra HTML', 'uncode-core') ,
			'desc' => esc_html__('HTML area that can be used with Lateral, Overlay and Off Canvas Menu styles.', 'uncode-core') ,
			'type' => 'textarea-simple',
			'rows' => '5',
			'section' => 'uncode_header_section',
			'operator' => 'or',
			'condition' => '_uncode_headers:contains(vmenu),_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
		) ,
		array(
			'id' => '_uncode_menu_mobile_centered_textarea',
			'label' => esc_html__('Menu Mobile Extra HTML', 'uncode-core') ,
			'desc' => esc_html__('HTML area that can be used with the Mobile Centered and Mobile Off Canvas Menu styles.', 'uncode-core') ,
			'type' => 'textarea-simple',
			'rows' => '5',
			'section' => 'uncode_header_section',
			'operator' => 'and',
			'condition' => '_uncode_menu_sticky_mobile:is(on),_uncode_menu_mobile_centered:not(off)',
		) ,
		$top_line_std,

		  ////////////////////////
		 ///     Top-Bar     ///
		//////////////////////
		$top_line_title,
		$top_line_onoff,
		$top_line_onoff_tablet,
		$top_line_onoff_mobile,
		$top_line_enhanced,
		$top_line_menu,
		$top_line_menu_tablet,
		$top_line_menu_mobile,
		$top_bar_socials,
		$top_bar_socials_tablet,
		$top_bar_socials_mobile,
		$top_bar_responsive,
		$top_bar_padding,
		$top_bar_border,

		//////////////////////
		//  Post Single		///
		//////////////////////
		uncode_core_replace_section_id('post', $menu_section_title),
		uncode_core_replace_section_id('post', $menu),
		uncode_core_replace_section_id('post', $menu_width),
		uncode_core_replace_section_id('post', $menu_opaque),
		uncode_core_replace_section_id('post', $header_section_title),
		uncode_core_replace_section_id('post', run_array_to($header_type, 'std', 'header_basic')),
		uncode_core_replace_section_id('post', $header_uncode_block),
		uncode_core_replace_section_id('post', $header_revslider),
		uncode_core_replace_section_id('post', $header_layerslider),

		uncode_core_replace_section_id('post', $header_width),
		uncode_core_replace_section_id('post', $header_height),
		uncode_core_replace_section_id('post', $header_min_height),
		uncode_core_replace_section_id('post', $header_title),
		uncode_core_replace_section_id('post', $header_style),
		uncode_core_replace_section_id('post', $header_content_width),
		uncode_core_replace_section_id('post', $header_custom_width),
		uncode_core_replace_section_id('post', $header_align),
		uncode_core_replace_section_id('post', $header_position),
		uncode_core_replace_section_id('post', $header_title_font),
		uncode_core_replace_section_id('post', $header_title_size),
		uncode_core_replace_section_id('post', $header_title_height),
		uncode_core_replace_section_id('post', $header_title_spacing),
		uncode_core_replace_section_id('post', $header_title_weight),
		uncode_core_replace_section_id('post', $header_title_transform),
		uncode_core_replace_section_id('post', $header_title_italic),
		uncode_core_replace_section_id('post', $header_text_animation),
		uncode_core_replace_section_id('post', $header_animation_speed),
		uncode_core_replace_section_id('post', $header_animation_delay),
		uncode_core_replace_section_id('post', $header_featured),
		uncode_core_replace_section_id('post', $header_background),
		uncode_core_replace_section_id('post', $header_parallax),
		uncode_core_replace_section_id('post', $header_kburns),
		uncode_core_replace_section_id('post', $header_overlay_color),
		uncode_core_replace_section_id('post', $header_overlay_color_alpha),
		uncode_core_replace_section_id('post', $header_scroll_opacity),
		uncode_core_replace_section_id('post', $header_scrolldown),
		uncode_core_replace_section_id('post', $menu_no_padding),
		uncode_core_replace_section_id('post', $menu_no_padding_mobile),
		uncode_core_replace_section_id('post', $body_section_title),
		uncode_core_replace_section_id('post', $body_uncode_select_content),
		uncode_core_replace_section_id('post', run_array_to($body_uncode_block_single, 'condition', '_uncode_post_select_content:is(uncodeblock)')),
		uncode_core_replace_section_id('post', run_array_to($body_layout_width, 'condition', '_uncode_post_select_content:is()')),
		uncode_core_replace_section_id('post', run_array_to($body_layout_width_custom, 'condition', '_uncode_post_select_content:is(),_uncode_post_layout_width:is(limit)')),
		uncode_core_replace_section_id('post', run_array_to($show_breadcrumb, 'condition', '_uncode_post_select_content:is()')),
		uncode_core_replace_section_id('post', run_array_to($breadcrumb_align, 'condition', '_uncode_post_select_content:is(),_uncode_post_breadcrumb:is(on)')),
		uncode_core_replace_section_id('post', run_array_to($show_title, 'condition', '_uncode_post_select_content:is()')),
		uncode_core_replace_section_id('post', run_array_to($show_media, 'condition', '_uncode_post_select_content:is()')),
		uncode_core_replace_section_id('post', run_array_to($media_display, 'condition', '_uncode_post_select_content:is(),_uncode_post_media:is(on)')),
		uncode_core_replace_section_id('post', run_array_to($show_featured_media, 'condition', '_uncode_post_select_content:is(),_uncode_post_media:not(on)')),
		uncode_core_replace_section_id('post', $show_share_w_tags),
		uncode_core_replace_section_id('post', run_array_to($show_tags, 'condition', '_uncode_post_select_content:is()')),
		uncode_core_replace_section_id('post', run_array_to($show_tags_align, 'condition', '_uncode_post_select_content:is()')),
		uncode_core_replace_section_id('post', $body_uncode_block_after_pre),
		uncode_core_replace_section_id('post', $body_uncode_block_after),
		uncode_core_replace_section_id('post', $show_comments),
		uncode_core_replace_section_id('post', $sidebar_section_title),
		uncode_core_replace_section_id('post', run_array_to($sidebar_activate, 'std', 'on')),
		uncode_core_replace_section_id('post', $sidebar_widget),
		uncode_core_replace_section_id('post', $sidebar_position),
		uncode_core_replace_section_id('post', $sidebar_size),
		uncode_core_replace_section_id('post', $sidebar_sticky),
		uncode_core_replace_section_id('post', $sidebar_style),
		uncode_core_replace_section_id('post', $sidebar_bgcolor),
		uncode_core_replace_section_id('post', $sidebar_fill),
		// uncode_core_replace_section_id('post', $sidebar_widget_collapse),
		// uncode_core_replace_section_id('post', $sidebar_widget_collapse_tablet),

		uncode_core_replace_section_id('post', $navigation_section_title),
		uncode_core_replace_section_id('post', $navigation_activate),
		uncode_core_replace_section_id('post', $navigation_content_block),
		uncode_core_replace_section_id('post', $navigation_page_index),
		uncode_core_replace_section_id('post', $navigation_index_label),
		uncode_core_replace_section_id('post', $navigation_nextprev_title),
		uncode_core_replace_section_id('post', $footer_section_title),
		uncode_core_replace_section_id('post', $footer_uncode_block),
		uncode_core_replace_section_id('post', $footer_width),
		uncode_core_replace_section_id('post', $custom_fields_section_title),
		uncode_core_replace_section_id('post', $custom_fields_list),
		///////////////
		//  Page		///
		///////////////
		uncode_core_replace_section_id('page', $menu_section_title),
		uncode_core_replace_section_id('page', $menu),
		uncode_core_replace_section_id('page', $menu_width),
		uncode_core_replace_section_id('page', $menu_opaque),
		uncode_core_replace_section_id('page', $header_section_title),
		uncode_core_replace_section_id('page', $header_type),
		uncode_core_replace_section_id('page', $header_uncode_block),
		uncode_core_replace_section_id('page', $header_revslider),
		uncode_core_replace_section_id('page', $header_layerslider),

		uncode_core_replace_section_id('page', $header_width),
		uncode_core_replace_section_id('page', $header_height),
		uncode_core_replace_section_id('page', $header_min_height),
		uncode_core_replace_section_id('page', $header_title),
		uncode_core_replace_section_id('page', $header_style),
		uncode_core_replace_section_id('page', $header_content_width),
		uncode_core_replace_section_id('page', $header_custom_width),
		uncode_core_replace_section_id('page', $header_align),
		uncode_core_replace_section_id('page', $header_position),
		uncode_core_replace_section_id('page', $header_title_font),
		uncode_core_replace_section_id('page', $header_title_size),
		uncode_core_replace_section_id('page', $header_title_height),
		uncode_core_replace_section_id('page', $header_title_spacing),
		uncode_core_replace_section_id('page', $header_title_weight),
		uncode_core_replace_section_id('page', $header_title_transform),
		uncode_core_replace_section_id('page', $header_title_italic),
		uncode_core_replace_section_id('page', $header_text_animation),
		uncode_core_replace_section_id('page', $header_animation_speed),
		uncode_core_replace_section_id('page', $header_animation_delay),
		uncode_core_replace_section_id('page', $header_featured),
		uncode_core_replace_section_id('page', $header_background),
		uncode_core_replace_section_id('page', $header_parallax),
		uncode_core_replace_section_id('page', $header_kburns),
		uncode_core_replace_section_id('page', $header_overlay_color),
		uncode_core_replace_section_id('page', $header_overlay_color_alpha),
		uncode_core_replace_section_id('page', $header_scroll_opacity),
		uncode_core_replace_section_id('page', $header_scrolldown),
		uncode_core_replace_section_id('page', $menu_no_padding),
		uncode_core_replace_section_id('page', $menu_no_padding_mobile),
		uncode_core_replace_section_id('page', $body_section_title),
		uncode_core_replace_section_id('page', $body_uncode_select_content),
		uncode_core_replace_section_id('page', run_array_to($body_uncode_block_single, 'condition', '_uncode_page_select_content:is(uncodeblock)')),
		uncode_core_replace_section_id('page', run_array_to($body_layout_width, 'condition', '_uncode_page_select_content:is()')),
		uncode_core_replace_section_id('page', run_array_to($body_layout_width_custom, 'condition', '_uncode_page_select_content:is(),_uncode_page_layout_width:is(limit)')),
		uncode_core_replace_section_id('page', run_array_to($show_breadcrumb, 'condition', '_uncode_page_select_content:is()')),
		uncode_core_replace_section_id('page', run_array_to($breadcrumb_align, 'condition', '_uncode_page_select_content:is(),_uncode_page_breadcrumb:is(on)')),
		uncode_core_replace_section_id('page', run_array_to($show_title_std_on, 'condition', '_uncode_page_select_content:is()')),
		uncode_core_replace_section_id('page', run_array_to($show_media, 'condition', '_uncode_page_select_content:is()')),
		uncode_core_replace_section_id('page', run_array_to($media_display, 'condition', '_uncode_page_select_content:is()')),
		uncode_core_replace_section_id('page', run_array_to($show_featured_media, 'condition', '_uncode_page_select_content:is()')),
		uncode_core_replace_section_id('page', $body_uncode_block_after),
		uncode_core_replace_section_id('page', $show_comments),
		uncode_core_replace_section_id('page', $sidebar_section_title),
		uncode_core_replace_section_id('page', $sidebar_activate),
		uncode_core_replace_section_id('page', $sidebar_widget),
		uncode_core_replace_section_id('page', $sidebar_position),
		uncode_core_replace_section_id('page', $sidebar_size),
		uncode_core_replace_section_id('page', $sidebar_sticky),
		uncode_core_replace_section_id('page', $sidebar_style),
		uncode_core_replace_section_id('page', $sidebar_bgcolor),
		uncode_core_replace_section_id('page', $sidebar_fill),
		// uncode_core_replace_section_id('page', $sidebar_widget_collapse),
		// uncode_core_replace_section_id('page', $sidebar_widget_collapse_tablet),
		uncode_core_replace_section_id('page', $footer_section_title),
		uncode_core_replace_section_id('page', $footer_uncode_block),
		uncode_core_replace_section_id('page', $footer_width),
		uncode_core_replace_section_id('page', $custom_fields_section_title),
		uncode_core_replace_section_id('page', $custom_fields_list),
		///////////////////////////
		//  Portfolio Single		///
		///////////////////////////
		uncode_core_replace_section_id('portfolio', $menu_section_title),
		uncode_core_replace_section_id('portfolio', $menu),
		uncode_core_replace_section_id('portfolio', $menu_width),
		uncode_core_replace_section_id('portfolio', $menu_opaque),
		uncode_core_replace_section_id('portfolio', $header_section_title),
		uncode_core_replace_section_id('portfolio', $header_type),
		uncode_core_replace_section_id('portfolio', $header_uncode_block),
		uncode_core_replace_section_id('portfolio', $header_revslider),
		uncode_core_replace_section_id('portfolio', $header_layerslider),

		uncode_core_replace_section_id('portfolio', $header_width),
		uncode_core_replace_section_id('portfolio', $header_height),
		uncode_core_replace_section_id('portfolio', $header_min_height),
		uncode_core_replace_section_id('portfolio', $header_title),
		uncode_core_replace_section_id('portfolio', $header_style),
		uncode_core_replace_section_id('portfolio', $header_content_width),
		uncode_core_replace_section_id('portfolio', $header_custom_width),
		uncode_core_replace_section_id('portfolio', $header_align),
		uncode_core_replace_section_id('portfolio', $header_position),
		uncode_core_replace_section_id('portfolio', $header_title_font),
		uncode_core_replace_section_id('portfolio', $header_title_size),
		uncode_core_replace_section_id('portfolio', $header_title_height),
		uncode_core_replace_section_id('portfolio', $header_title_spacing),
		uncode_core_replace_section_id('portfolio', $header_title_weight),
		uncode_core_replace_section_id('portfolio', $header_title_transform),
		uncode_core_replace_section_id('portfolio', $header_title_italic),
		uncode_core_replace_section_id('portfolio', $header_text_animation),
		uncode_core_replace_section_id('portfolio', $header_animation_speed),
		uncode_core_replace_section_id('portfolio', $header_animation_delay),
		uncode_core_replace_section_id('portfolio', $header_featured),
		uncode_core_replace_section_id('portfolio', $header_background),
		uncode_core_replace_section_id('portfolio', $header_parallax),
		uncode_core_replace_section_id('portfolio', $header_kburns),
		uncode_core_replace_section_id('portfolio', $header_overlay_color),
		uncode_core_replace_section_id('portfolio', $header_overlay_color_alpha),
		uncode_core_replace_section_id('portfolio', $header_scroll_opacity),
		uncode_core_replace_section_id('portfolio', $header_scrolldown),
		uncode_core_replace_section_id('portfolio', $menu_no_padding),
		uncode_core_replace_section_id('portfolio', $menu_no_padding_mobile),
		uncode_core_replace_section_id('portfolio', $body_section_title),
		uncode_core_replace_section_id('portfolio', $body_uncode_select_content),
		uncode_core_replace_section_id('portfolio', run_array_to($body_uncode_block_single, 'condition', '_uncode_portfolio_select_content:is(uncodeblock)')),
		uncode_core_replace_section_id('portfolio', run_array_to($body_layout_width, 'condition', '_uncode_portfolio_select_content:is()')),
		uncode_core_replace_section_id('portfolio', run_array_to($body_layout_width_custom, 'condition', '_uncode_portfolio_select_content:is(),_uncode_portfolio_layout_width:is(limit)')),
		uncode_core_replace_section_id('portfolio', run_array_to($show_breadcrumb, 'condition', '_uncode_portfolio_select_content:is()')),
		uncode_core_replace_section_id('portfolio', run_array_to($breadcrumb_align, 'condition', '_uncode_portfolio_select_content:is(),_uncode_portfolio_breadcrumb:is(on)')),
		uncode_core_replace_section_id('portfolio', run_array_to($show_title_std_on, 'condition', '_uncode_portfolio_select_content:is()')),
		uncode_core_replace_section_id('portfolio', run_array_to($show_media, 'condition', '_uncode_portfolio_select_content:is()')),
		uncode_core_replace_section_id('portfolio', run_array_to($media_display, 'condition', '_uncode_portfolio_select_content:is()')),
		uncode_core_replace_section_id('portfolio', run_array_to($show_featured_media, 'condition', '_uncode_portfolio_select_content:is()')),
		uncode_core_replace_section_id('portfolio', run_array_to($show_share, 'condition', '_uncode_portfolio_select_content:is()')),
		uncode_core_replace_section_id('portfolio', $body_uncode_block_after),
		uncode_core_replace_section_id('portfolio', run_array_to($show_comments, 'std', 'off')),
		array(
			'id' => '_uncode_portfolio_details_title',
			'label' => '<i class="fa fa-briefcase3"></i> ' . esc_html__('Details', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_portfolio_section',
		) ,
		array(
			'id' => '_uncode_portfolio_details',
			'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('details', 'uncode-core') ,
			'desc' => sprintf(esc_html__('Create here all the %s details label that you need.', 'uncode-core') , $portfolio_cpt_name) ,
			'type' => 'list-item',
			'section' => 'uncode_portfolio_section',
			'settings' => array(
				array(
					'id' => '_uncode_portfolio_detail_unique_id',
					'class' => 'unique_id',
					'std' => 'detail-',
					'type' => 'text',
					'label' => sprintf(esc_html__('Unique %s detail ID','uncode-core') , $portfolio_cpt_name) ,
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode-core'),
				),
			)
		) ,
		array(
			'id' => '_uncode_portfolio_position',
			'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('details layout', 'uncode-core') ,
			'desc' => sprintf(esc_html__('Specify the layout template for all the %s posts.', 'uncode-core') , $portfolio_cpt_name) ,
			'type' => 'select',
			'section' => 'uncode_portfolio_section',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Select…', 'uncode-core') ,
				) ,
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
			)
		) ,
		array(
			'id' => '_uncode_portfolio_sidebar_size',
			'label' => esc_html__('Sidebar size', 'uncode-core') ,
			'desc' => esc_html__('Set the Sidebar size.', 'uncode-core') ,
			'std' => '4',
			'min_max_step' => '1,12,1',
			'type' => 'numeric-slider',
			'section' => 'uncode_portfolio_section',
			'operator' => 'and',
			'condition' => '_uncode_portfolio_position:not(),_uncode_portfolio_position:contains(sidebar)',
		) ,
		uncode_core_replace_section_id('portfolio', run_array_to($sidebar_sticky, 'condition', '_uncode_portfolio_position:not(),_uncode_portfolio_position:contains(sidebar)')),
		array(
			'id' => '_uncode_portfolio_style',
			'label' => esc_html__('Skin', 'uncode-core') ,
			'desc' => esc_html__('Specify the Sidebar text Skin color.', 'uncode-core') ,
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
			'section' => 'uncode_portfolio_section',
			'condition' => '_uncode_portfolio_position:not()',
		) ,
		array(
			'id' => '_uncode_portfolio_bgcolor',
			'label' => esc_html__('Sidebar color', 'uncode-core') ,
			'desc' => esc_html__('Specify the Sidebar background color.', 'uncode-core') ,
			'type' => 'uncode_color',
			'section' => 'uncode_portfolio_section',
			'condition' => '_uncode_portfolio_position:not()',
		) ,
		array(
			'id' => '_uncode_portfolio_sidebar_fill',
			'label' => esc_html__('Sidebar filling space', 'uncode-core') ,
			'desc' => esc_html__('Activate to remove padding around the Sidebar and fill the height.', 'uncode-core') ,
			'type' => 'on-off',
			'section' => 'uncode_portfolio_section',
			'std' => 'off',
			'operator' => 'and',
			'condition' => '_uncode_portfolio_position:not(),_uncode_portfolio_sidebar_bgcolor:not(),_uncode_portfolio_position:contains(sidebar)',
		),
		uncode_core_replace_section_id('portfolio', $navigation_section_title),
		uncode_core_replace_section_id('portfolio', $navigation_activate),
		uncode_core_replace_section_id('portfolio', $navigation_content_block),
		uncode_core_replace_section_id('portfolio', $navigation_page_index),
		uncode_core_replace_section_id('portfolio', $navigation_index_label),
		uncode_core_replace_section_id('portfolio', $navigation_nextprev_title),
		uncode_core_replace_section_id('portfolio', $footer_section_title),
		uncode_core_replace_section_id('portfolio', $footer_uncode_block),
		uncode_core_replace_section_id('portfolio', $footer_width),
		uncode_core_replace_section_id('portfolio', $custom_fields_section_title),
		uncode_core_replace_section_id('portfolio', $custom_fields_list),
	);

	$custom_settings_one = array_merge( $custom_settings_one, $cpt_single_options );

	$custom_settings_two = array(
		///////////////////
		//  Page 404		///
		///////////////////
		uncode_core_replace_section_id('404', $menu_section_title),
		uncode_core_replace_section_id('404', $menu),
		uncode_core_replace_section_id('404', $menu_width),
		uncode_core_replace_section_id('404', $menu_opaque),
		uncode_core_replace_section_id('404', $header_section_title),
		uncode_core_replace_section_id('404', $header_type),
		uncode_core_replace_section_id('404', $header_uncode_block),
		uncode_core_replace_section_id('404', $header_revslider),
		uncode_core_replace_section_id('404', $header_layerslider),

		uncode_core_replace_section_id('404', $header_width),
		uncode_core_replace_section_id('404', $header_height),
		uncode_core_replace_section_id('404', $header_min_height),
		uncode_core_replace_section_id('404', $header_title),
		uncode_core_replace_section_id('404', $header_title_text),
		uncode_core_replace_section_id('404', $header_style),
		uncode_core_replace_section_id('404', $header_content_width),
		uncode_core_replace_section_id('404', $header_custom_width),
		uncode_core_replace_section_id('404', $header_align),
		uncode_core_replace_section_id('404', $header_position),
		uncode_core_replace_section_id('404', $header_title_font),
		uncode_core_replace_section_id('404', $header_title_size),
		uncode_core_replace_section_id('404', $header_title_height),
		uncode_core_replace_section_id('404', $header_title_spacing),
		uncode_core_replace_section_id('404', $header_title_weight),
		uncode_core_replace_section_id('404', $header_title_transform),
		uncode_core_replace_section_id('404', $header_title_italic),
		uncode_core_replace_section_id('404', $header_text_animation),
		uncode_core_replace_section_id('404', $header_animation_speed),
		uncode_core_replace_section_id('404', $header_animation_delay),
		uncode_core_replace_section_id('404', $header_background),
		uncode_core_replace_section_id('404', $header_parallax),
		uncode_core_replace_section_id('404', $header_kburns),
		uncode_core_replace_section_id('404', $header_overlay_color),
		uncode_core_replace_section_id('404', $header_overlay_color_alpha),
		uncode_core_replace_section_id('404', $header_scroll_opacity),
		uncode_core_replace_section_id('404', $header_scrolldown),
		uncode_core_replace_section_id('404', $menu_no_padding),
		uncode_core_replace_section_id('404', $menu_no_padding_mobile),
		uncode_core_replace_section_id('404', $body_section_title),
		uncode_core_replace_section_id('404', $body_layout_width),
		uncode_core_replace_section_id('404', $uncodeblock_404),
		uncode_core_replace_section_id('404', $uncodeblocks_404),
		uncode_core_replace_section_id('404', $footer_section_title),
		uncode_core_replace_section_id('404', $footer_uncode_block),
		uncode_core_replace_section_id('404', $footer_width),
		//////////////////////
		//  Posts Index		///
		//////////////////////
		uncode_core_replace_section_id('post_index', $menu_section_title),
		uncode_core_replace_section_id('post_index', $menu),
		uncode_core_replace_section_id('post_index', $menu_width),
		uncode_core_replace_section_id('post_index', $menu_opaque),
		uncode_core_replace_section_id('post_index', $header_section_title),
		uncode_core_replace_section_id('post_index', run_array_to($header_type, 'std', 'header_basic')),
		uncode_core_replace_section_id('post_index', $header_uncode_block),
		uncode_core_replace_section_id('post_index', $header_revslider),
		uncode_core_replace_section_id('post_index', $header_layerslider),

		uncode_core_replace_section_id('post_index', $header_width),
		uncode_core_replace_section_id('post_index', $header_height),
		uncode_core_replace_section_id('post_index', $header_min_height),
		uncode_core_replace_section_id('post_index', $header_title),
		uncode_core_replace_section_id('post_index', $header_style),
		uncode_core_replace_section_id('post_index', $header_content_width),
		uncode_core_replace_section_id('post_index', $header_custom_width),
		uncode_core_replace_section_id('post_index', $header_align),
		uncode_core_replace_section_id('post_index', $header_position),
		uncode_core_replace_section_id('post_index', $header_title_font),
		uncode_core_replace_section_id('post_index', $header_title_size),
		uncode_core_replace_section_id('post_index', $header_title_height),
		uncode_core_replace_section_id('post_index', $header_title_spacing),
		uncode_core_replace_section_id('post_index', $header_title_weight),
		uncode_core_replace_section_id('post_index', $header_title_transform),
		uncode_core_replace_section_id('post_index', $header_title_italic),
		uncode_core_replace_section_id('post_index', $header_text_animation),
		uncode_core_replace_section_id('post_index', $header_animation_speed),
		uncode_core_replace_section_id('post_index', $header_animation_delay),
		uncode_core_replace_section_id('post_index', $header_featured),
		uncode_core_replace_section_id('post_index', $header_background),
		uncode_core_replace_section_id('post_index', $header_parallax),
		uncode_core_replace_section_id('post_index', $header_kburns),
		uncode_core_replace_section_id('post_index', $header_overlay_color),
		uncode_core_replace_section_id('post_index', $header_overlay_color_alpha),
		uncode_core_replace_section_id('post_index', $header_scroll_opacity),
		uncode_core_replace_section_id('post_index', $header_scrolldown),
		uncode_core_replace_section_id('post_index', $menu_no_padding),
		uncode_core_replace_section_id('post_index', $menu_no_padding_mobile),
		uncode_core_replace_section_id('post_index', $title_archive_custom_activate),
		uncode_core_replace_section_id('post_index', $title_archive_custom_text),
		uncode_core_replace_section_id('post_index', $subtitle_archive_custom_text),

		uncode_core_replace_section_id('post_index', $body_section_title),
		uncode_core_replace_section_id('post_index', $show_breadcrumb),
		uncode_core_replace_section_id('post_index', $breadcrumb_align),
		uncode_core_replace_section_id('post_index', $body_uncode_block),
		uncode_core_replace_section_id('post_index', run_array_to($body_layout_width, 'condition', '_uncode_post_index_content_block:is(),_uncode_post_index_content_block:is(none)')),
		uncode_core_replace_section_id('post_index', $body_single_post_width),
		uncode_core_replace_section_id('post_index', $body_single_text_lenght),
		uncode_core_replace_section_id('post_index', run_array_to($show_title, 'condition', '_uncode_post_index_content_block:is(),_uncode_post_index_content_block:is(none)')),
		uncode_core_replace_section_id('post_index', $remove_pagination),
		uncode_core_replace_section_id('post_index', $sidebar_section_title),
		uncode_core_replace_section_id('post_index', run_array_to($sidebar_activate, 'std', 'on')),
		uncode_core_replace_section_id('post_index', $sidebar_widget),
		uncode_core_replace_section_id('post_index', $sidebar_position),
		uncode_core_replace_section_id('post_index', $sidebar_size),
		uncode_core_replace_section_id('post_index', $sidebar_sticky),
		uncode_core_replace_section_id('post_index', $sidebar_style),
		uncode_core_replace_section_id('post_index', $sidebar_bgcolor),
		uncode_core_replace_section_id('post_index', $sidebar_fill),
		// uncode_core_replace_section_id('post_index', $sidebar_widget_collapse),
		// uncode_core_replace_section_id('post_index', $sidebar_widget_collapse_tablet),
		uncode_core_replace_section_id('post_index', $footer_section_title),
		uncode_core_replace_section_id('post_index', $footer_uncode_block),
		uncode_core_replace_section_id('post_index', $footer_width),
		//////////////////////
		//  Pages Index		///
		//////////////////////
		uncode_core_replace_section_id('page_index', $menu_section_title),
		uncode_core_replace_section_id('page_index', $menu),
		uncode_core_replace_section_id('page_index', $menu_width),
		uncode_core_replace_section_id('page_index', $menu_opaque),
		uncode_core_replace_section_id('page_index', $header_section_title),
		uncode_core_replace_section_id('page_index', run_array_to($header_type, 'std', 'header_basic')),
		uncode_core_replace_section_id('page_index', $header_uncode_block),
		uncode_core_replace_section_id('page_index', $header_revslider),
		uncode_core_replace_section_id('page_index', $header_layerslider),

		uncode_core_replace_section_id('page_index', $header_width),
		uncode_core_replace_section_id('page_index', $header_height),
		uncode_core_replace_section_id('page_index', $header_min_height),
		uncode_core_replace_section_id('page_index', $header_title),
		uncode_core_replace_section_id('page_index', $header_style),
		uncode_core_replace_section_id('page_index', $header_content_width),
		uncode_core_replace_section_id('page_index', $header_custom_width),
		uncode_core_replace_section_id('page_index', $header_align),
		uncode_core_replace_section_id('page_index', $header_position),
		uncode_core_replace_section_id('page_index', $header_title_font),
		uncode_core_replace_section_id('page_index', $header_title_size),
		uncode_core_replace_section_id('page_index', $header_title_height),
		uncode_core_replace_section_id('page_index', $header_title_spacing),
		uncode_core_replace_section_id('page_index', $header_title_weight),
		uncode_core_replace_section_id('page_index', $header_title_transform),
		uncode_core_replace_section_id('page_index', $header_title_italic),
		uncode_core_replace_section_id('page_index', $header_text_animation),
		uncode_core_replace_section_id('page_index', $header_animation_speed),
		uncode_core_replace_section_id('page_index', $header_animation_delay),
		uncode_core_replace_section_id('page_index', $header_featured),
		uncode_core_replace_section_id('page_index', $header_background),
		uncode_core_replace_section_id('page_index', $header_parallax),
		uncode_core_replace_section_id('page_index', $header_kburns),
		uncode_core_replace_section_id('page_index', $header_overlay_color),
		uncode_core_replace_section_id('page_index', $header_overlay_color_alpha),
		uncode_core_replace_section_id('page_index', $header_scroll_opacity),
		uncode_core_replace_section_id('page_index', $header_scrolldown),
		uncode_core_replace_section_id('page_index', $menu_no_padding),
		uncode_core_replace_section_id('page_index', $menu_no_padding_mobile),

		uncode_core_replace_section_id('page_index', $body_section_title),
		uncode_core_replace_section_id('page_index', $show_breadcrumb),
		uncode_core_replace_section_id('page_index', $breadcrumb_align),
		uncode_core_replace_section_id('page_index', $body_uncode_block),
		uncode_core_replace_section_id('page_index', run_array_to($body_layout_width, 'condition', '_uncode_page_index_content_block:is(),_uncode_page_index_content_block:is(none)')),
		uncode_core_replace_section_id('page_index', $body_single_post_width),
		uncode_core_replace_section_id('page_index', $body_single_text_lenght),
		uncode_core_replace_section_id('page_index', run_array_to($show_title, 'condition', '_uncode_page_index_content_block:is(),_uncode_page_index_content_block:is(none)')),
		uncode_core_replace_section_id('page_index', $remove_pagination),
		uncode_core_replace_section_id('page_index', $sidebar_section_title),
		uncode_core_replace_section_id('page_index', run_array_to($sidebar_activate, 'std', 'on')),
		uncode_core_replace_section_id('page_index', $sidebar_widget),
		uncode_core_replace_section_id('page_index', $sidebar_position),
		uncode_core_replace_section_id('page_index', $sidebar_size),
		uncode_core_replace_section_id('page_index', $sidebar_sticky),
		uncode_core_replace_section_id('page_index', $sidebar_style),
		uncode_core_replace_section_id('page_index', $sidebar_bgcolor),
		uncode_core_replace_section_id('page_index', $sidebar_fill),
		// uncode_core_replace_section_id('page_index', $sidebar_widget_collapse),
		// uncode_core_replace_section_id('page_index', $sidebar_widget_collapse_tablet),
		uncode_core_replace_section_id('page_index', $footer_section_title),
		uncode_core_replace_section_id('page_index', $footer_uncode_block),
		uncode_core_replace_section_id('page_index', $footer_width),
		////////////////////////
		//  Archive Index		///
		////////////////////////
		uncode_core_replace_section_id('portfolio_index', $menu_section_title),
		uncode_core_replace_section_id('portfolio_index', $menu),
		uncode_core_replace_section_id('portfolio_index', $menu_width),
		uncode_core_replace_section_id('portfolio_index', $menu_opaque),
		uncode_core_replace_section_id('portfolio_index', $header_section_title),
		uncode_core_replace_section_id('portfolio_index', run_array_to($header_type, 'std', 'header_basic')),
		uncode_core_replace_section_id('portfolio_index', $header_uncode_block),
		uncode_core_replace_section_id('portfolio_index', $header_revslider),
		uncode_core_replace_section_id('portfolio_index', $header_layerslider),

		uncode_core_replace_section_id('portfolio_index', $header_width),
		uncode_core_replace_section_id('portfolio_index', $header_height),
		uncode_core_replace_section_id('portfolio_index', $header_min_height),
		uncode_core_replace_section_id('portfolio_index', $header_title),
		uncode_core_replace_section_id('portfolio_index', $header_style),
		uncode_core_replace_section_id('portfolio_index', $header_content_width),
		uncode_core_replace_section_id('portfolio_index', $header_custom_width),
		uncode_core_replace_section_id('portfolio_index', $header_align),
		uncode_core_replace_section_id('portfolio_index', $header_position),
		uncode_core_replace_section_id('portfolio_index', $header_title_font),
		uncode_core_replace_section_id('portfolio_index', $header_title_size),
		uncode_core_replace_section_id('portfolio_index', $header_title_height),
		uncode_core_replace_section_id('portfolio_index', $header_title_spacing),
		uncode_core_replace_section_id('portfolio_index', $header_title_weight),
		uncode_core_replace_section_id('portfolio_index', $header_title_transform),
		uncode_core_replace_section_id('portfolio_index', $header_title_italic),
		uncode_core_replace_section_id('portfolio_index', $header_text_animation),
		uncode_core_replace_section_id('portfolio_index', $header_animation_speed),
		uncode_core_replace_section_id('portfolio_index', $header_animation_delay),
		uncode_core_replace_section_id('portfolio_index', $header_featured),
		uncode_core_replace_section_id('portfolio_index', $header_background),
		uncode_core_replace_section_id('portfolio_index', $header_parallax),
		uncode_core_replace_section_id('portfolio_index', $header_kburns),
		uncode_core_replace_section_id('portfolio_index', $header_overlay_color),
		uncode_core_replace_section_id('portfolio_index', $header_overlay_color_alpha),
		uncode_core_replace_section_id('portfolio_index', $header_scroll_opacity),
		uncode_core_replace_section_id('portfolio_index', $header_scrolldown),
		uncode_core_replace_section_id('portfolio_index', $menu_no_padding),
		uncode_core_replace_section_id('portfolio_index', $menu_no_padding_mobile),
		uncode_core_replace_section_id('portfolio_index', $title_archive_custom_activate),
		uncode_core_replace_section_id('portfolio_index', $title_archive_custom_text),
		uncode_core_replace_section_id('portfolio_index', $subtitle_archive_custom_text),

		uncode_core_replace_section_id('portfolio_index', $body_section_title),
		uncode_core_replace_section_id('portfolio_index', $show_breadcrumb),
		uncode_core_replace_section_id('portfolio_index', $breadcrumb_align),
		uncode_core_replace_section_id('portfolio_index', $body_uncode_block),
		uncode_core_replace_section_id('portfolio_index', run_array_to($body_layout_width, 'condition', '_uncode_portfolio_index_content_block:is(),_uncode_portfolio_index_content_block:is(none)')),
		uncode_core_replace_section_id('portfolio_index', $body_single_post_width),
		uncode_core_replace_section_id('portfolio_index', run_array_to($show_title, 'condition', '_uncode_portfolio_index_content_block:is(),_uncode_portfolio_index_content_block:is(none)')),
		uncode_core_replace_section_id('portfolio_index', $remove_pagination),
		uncode_core_replace_section_id('portfolio_index', $sidebar_section_title),
		uncode_core_replace_section_id('portfolio_index', $sidebar_activate),
		uncode_core_replace_section_id('portfolio_index', $sidebar_widget),
		uncode_core_replace_section_id('portfolio_index', $sidebar_position),
		uncode_core_replace_section_id('portfolio_index', $sidebar_size),
		uncode_core_replace_section_id('portfolio_index', $sidebar_sticky),
		uncode_core_replace_section_id('portfolio_index', $sidebar_style),
		uncode_core_replace_section_id('portfolio_index', $sidebar_bgcolor),
		uncode_core_replace_section_id('portfolio_index', $sidebar_fill),
		// uncode_core_replace_section_id('portfolio_index', $sidebar_widget_collapse),
		// uncode_core_replace_section_id('portfolio_index', $sidebar_widget_collapse_tablet),
		uncode_core_replace_section_id('portfolio_index', $footer_section_title),
		uncode_core_replace_section_id('portfolio_index', $footer_uncode_block),
		uncode_core_replace_section_id('portfolio_index', $footer_width),
	);

	$custom_settings_one = array_merge( $custom_settings_one, $custom_settings_two );
	$custom_settings_one = array_merge( $custom_settings_one, $cpt_index_options );

	$custom_settings_three = array(
		///////////////////////
		//  Search Index		///
		///////////////////////
		uncode_core_replace_section_id('search_index', $menu_section_title),
		uncode_core_replace_section_id('search_index', $menu),
		uncode_core_replace_section_id('search_index', $menu_width),
		uncode_core_replace_section_id('search_index', $menu_opaque),
		uncode_core_replace_section_id('search_index', $header_section_title),
		uncode_core_replace_section_id('search_index', run_array_to($header_type, 'std', 'header_basic')),
		uncode_core_replace_section_id('search_index', $header_uncode_block),
		uncode_core_replace_section_id('search_index', $no_results_header_uncode_block),
		uncode_core_replace_section_id('search_index', $header_revslider),
		uncode_core_replace_section_id('search_index', $header_layerslider),

		uncode_core_replace_section_id('search_index', $header_width),
		uncode_core_replace_section_id('search_index', $header_height),
		uncode_core_replace_section_id('search_index', $header_min_height),
		uncode_core_replace_section_id('search_index', $header_title),
		uncode_core_replace_section_id('search_index', $header_title_text),
		uncode_core_replace_section_id('search_index', $header_style),
		uncode_core_replace_section_id('search_index', $header_content_width),
		uncode_core_replace_section_id('search_index', $header_custom_width),
		uncode_core_replace_section_id('search_index', $header_align),
		uncode_core_replace_section_id('search_index', $header_position),
		uncode_core_replace_section_id('search_index', $header_title_font),
		uncode_core_replace_section_id('search_index', $header_title_size),
		uncode_core_replace_section_id('search_index', $header_title_height),
		uncode_core_replace_section_id('search_index', $header_title_spacing),
		uncode_core_replace_section_id('search_index', $header_title_weight),
		uncode_core_replace_section_id('search_index', $header_title_transform),
		uncode_core_replace_section_id('search_index', $header_title_italic),
		uncode_core_replace_section_id('search_index', $header_text_animation),
		uncode_core_replace_section_id('search_index', $header_animation_speed),
		uncode_core_replace_section_id('search_index', $header_animation_delay),
		uncode_core_replace_section_id('search_index', $header_background),
		uncode_core_replace_section_id('search_index', $header_parallax),
		uncode_core_replace_section_id('search_index', $header_kburns),
		uncode_core_replace_section_id('search_index', $header_overlay_color),
		uncode_core_replace_section_id('search_index', $header_overlay_color_alpha),
		uncode_core_replace_section_id('search_index', $header_scroll_opacity),
		uncode_core_replace_section_id('search_index', $header_scrolldown),
		uncode_core_replace_section_id('search_index', $menu_no_padding),
		uncode_core_replace_section_id('search_index', $menu_no_padding_mobile),
		uncode_core_replace_section_id('search_index', $title_archive_custom_activate),
		uncode_core_replace_section_id('search_index', $subtitle_archive_custom_text),
		uncode_core_replace_section_id('search_index', $no_results_subtitle_archive_custom_text),
		uncode_core_replace_section_id('search_index', $no_results_products_subtitle_archive_custom_text),

		uncode_core_replace_section_id('search_index', $body_section_title),
		uncode_core_replace_section_id('search_index', $body_uncode_block),
		uncode_core_replace_section_id('search_index', $no_results_uncode_block),
		uncode_core_replace_section_id('search_index', $no_results_products_uncode_block),
		uncode_core_replace_section_id('search_index', $body_layout_width),
		uncode_core_replace_section_id('search_index', $remove_pagination),
		uncode_core_replace_section_id('search_index', $sidebar_section_title),
		uncode_core_replace_section_id('search_index', $sidebar_activate),
		uncode_core_replace_section_id('search_index', $sidebar_widget),
		uncode_core_replace_section_id('search_index', $sidebar_position),
		uncode_core_replace_section_id('search_index', $sidebar_size),
		uncode_core_replace_section_id('search_index', $sidebar_sticky),
		uncode_core_replace_section_id('search_index', $sidebar_style),
		uncode_core_replace_section_id('search_index', $sidebar_bgcolor),
		uncode_core_replace_section_id('search_index', $sidebar_fill),
		// uncode_core_replace_section_id('search_index', $sidebar_widget_collapse),
		// uncode_core_replace_section_id('search_index', $sidebar_widget_collapse_tablet),
		uncode_core_replace_section_id('search_index', $footer_section_title),
		uncode_core_replace_section_id('search_index', $footer_uncode_block),
		uncode_core_replace_section_id('search_index', $footer_width),

		array(
			'id' => '_uncode_sidebars',
			'label' => esc_html__('Site sidebars', 'uncode-core') ,
			'desc' => esc_html__('Define here all the sidebars you will need. A default Sidebar is already defined.', 'uncode-core') ,
			'type' => 'list-item',
			'section' => 'uncode_sidebars_section',
			'class' => 'list-item',
			'settings' => array(
				array(
					'id' => '_uncode_sidebar_unique_id',
					'class' => 'unique_id',
					'std' => 'sidebar-',
					'type' => 'text',
					'label' => esc_html__('Unique sidebar ID','uncode-core'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode-core'),
				),
			)
		) ,
		array(
			'id' => '_uncode_font_groups',
			'label' => esc_html__('Custom font families', 'uncode-core') ,
			'desc' => esc_html__('Define here all the fonts you will need.', 'uncode-core') ,
			'std' => array(
				array(
					'title' => 'Font Default',
					'_uncode_font_group_unique_id' => 'font-555555',
					'_uncode_font_group' => 'manual',
					'_uncode_font_manual' => '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif'
				),
			),
			'type' => 'list-item',
			'section' => 'uncode_typography_section',
			'settings' => array(
				array(
					'id' => '_uncode_font_group_unique_id',
					'class' => 'unique_id',
					'std' => 'font-',
					'type' => 'text',
					'label' => esc_html__('Unique font ID','uncode-core'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode-core'),
				),
				array(
					'id' => '_uncode_font_group',
					'label' => esc_html__('Uncode font', 'uncode-core') ,
					'desc' => esc_html__('Specify a font.', 'uncode-core') ,
					'type' => 'select',
					'choices' => $title_font,
				),
				array(
					'id' => '_uncode_font_manual',
					'label' => esc_html__('Font family', 'uncode-core') ,
					'desc' => esc_html__('Enter a font family.', 'uncode-core') ,
					'type' => 'text',
					'condition' => '_uncode_font_group:is(manual)',
					'operator' => 'and'
				)
			)
		) ,
		array(
			'id' => '_uncode_font_size',
			'label' => esc_html__('Default font size', 'uncode-core') ,
			'desc' => esc_html__('Font size for p,li,dt,dd,dl,address,label,small,pre.', 'uncode-core') ,
			'std' => '15',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_large_text_size',
			'label' => esc_html__('Large text font size', 'uncode-core') ,
			'desc' => esc_html__('Font size for large text.', 'uncode-core') ,
			'std' => '18',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_small_text_size',
			'label' => esc_html__('Small text font size', 'uncode-core') ,
			'desc' => esc_html__('Font size for small text.', 'uncode-core') ,
			'std' => '13',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h1',
			'label' => esc_html__('Font size H1', 'uncode-core') ,
			'desc' => esc_html__('Font size for H1.', 'uncode-core') ,
			'std' => '35',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h2',
			'label' => esc_html__('Font size H2', 'uncode-core') ,
			'desc' => esc_html__('Font size for H2.', 'uncode-core') ,
			'std' => '29',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h3',
			'label' => esc_html__('Font size H3', 'uncode-core') ,
			'desc' => esc_html__('Font size for H3.', 'uncode-core') ,
			'std' => '24',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h4',
			'label' => esc_html__('Font size H4', 'uncode-core') ,
			'desc' => esc_html__('Font size for H4.', 'uncode-core') ,
			'std' => '20',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h5',
			'label' => esc_html__('Font size H5', 'uncode-core') ,
			'desc' => esc_html__('Font size for H5.', 'uncode-core') ,
			'std' => '17',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_h6',
			'label' => esc_html__('Font size H6', 'uncode-core') ,
			'desc' => esc_html__('Font size for H6.', 'uncode-core') ,
			'std' => '14',
			'type' => 'text',
			'section' => 'uncode_typography_section',
		) ,
		array(
			'id' => '_uncode_heading_font_sizes',
			'label' => esc_html__('Custom font size', 'uncode-core') ,
			'desc' => esc_html__('Define here all the additional font sizes you will need.', 'uncode-core') ,
			'std' => '',
			'type' => 'list-item',
			'section' => 'uncode_typography_section',
			'settings' => array(
				array(
					'id' => '_uncode_heading_font_size_unique_id',
					'class' => 'unique_id',
					'std' => 'fontsize-',
					'type' => 'text',
					'label' => esc_html__('Unique font size ID','uncode-core'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode-core'),
				),
				array(
					'id' => '_uncode_heading_font_size',
					'label' => esc_html__('Font size', 'uncode-core') ,
					'desc' => esc_html__('Font size.', 'uncode-core') ,
					'std' => '',
					'type' => 'text',
				)
			)
		) ,
		array(
			'id' => '_uncode_heading_font_heights',
			'label' => esc_html__('Custom line height', 'uncode-core') ,
			'desc' => esc_html__('Define here all the additional font line heights you will need.', 'uncode-core') ,
			'std' => '',
			'type' => 'list-item',
			'section' => 'uncode_typography_section',
			'settings' => array(
				array(
					'id' => '_uncode_heading_font_height_unique_id',
					'class' => 'unique_id',
					'std' => 'fontheight-',
					'type' => 'text',
					'label' => esc_html__('Unique font height ID','uncode-core'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode-core'),
				),
				array(
					'id' => '_uncode_heading_font_height',
					'label' => esc_html__('Font line height', 'uncode-core') ,
					'desc' => esc_html__('Insert a line height.', 'uncode-core') ,
					'std' => '',
					'type' => 'text',
				)
			)
		) ,
		array(
			'id' => '_uncode_heading_font_spacings',
			'label' => esc_html__('Custom letter spacing', 'uncode-core') ,
			'desc' => esc_html__('Define here all the letter spacings you will need.', 'uncode-core') ,
			'std' => '',
			'type' => 'list-item',
			'section' => 'uncode_typography_section',
			'settings' => array(
				array(
					'id' => '_uncode_heading_font_spacing_unique_id',
					'class' => 'unique_id',
					'std' => 'fontspace-',
					'type' => 'text',
					'label' => esc_html__('Unique letter spacing ID','uncode-core'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode-core'),
				),
				array(
					'id' => '_uncode_heading_font_spacing',
					'label' => esc_html__('Letter spacing', 'uncode-core') ,
					'desc' => esc_html__('Letter spacing with the unit (em or px). Ex. 0.2em', 'uncode-core') ,
					'std' => '',
					'type' => 'text',
				)
			)
		) ,
		array(
			'id' => '_uncode_custom_colors_list',
			'label' => esc_html__('Color palettes', 'uncode-core') ,
			'desc' => esc_html__('Define all the colors you will need.', 'uncode-core') ,
			'std' => array(
				array(
					'title' => esc_html__('Black','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-jevc',
					'_uncode_custom_color' => '#000000',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('Dark 1','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-nhtu',
					'_uncode_custom_color' => '#101213',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('Dark 2','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-wayh',
					'_uncode_custom_color' => '#141618',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('Dark 3','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-rgdb',
					'_uncode_custom_color' => '#1b1d1f',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('Dark 4','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-prif',
					'_uncode_custom_color' => '#303133',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('White','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-xsdn',
					'_uncode_custom_color' => '#ffffff',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('Light 1','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-lxmt',
					'_uncode_custom_color' => '#f7f7f7',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('Light 2','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-gyho',
					'_uncode_custom_color' => '#eaeaea',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('Light 3','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-uydo',
					'_uncode_custom_color' => '#dddddd',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('Light 4','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-wvjs',
					'_uncode_custom_color' => '#777',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('Cerulean','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-vyce',
					'_uncode_custom_color' => '#0cb4ce',
					'_uncode_custom_color_regular' => 'on',
				),
				array(
					'title' => esc_html__('Blue Ribbon','uncode-core'),
					'_uncode_custom_color_unique_id' => 'color-210407',
					'_uncode_custom_color' => '#006cff',
					'_uncode_custom_color_regular' => 'on',
				),
			),
			'type' => 'list-item',
			'section' => 'uncode_colors_section',
			'class' => 'list-colors',
			'settings' => array(
				array(
					'id' => '_uncode_custom_color_unique_id',
					'std' => 'color-',
					'class' => 'unique_id',
					'type' => 'text',
					'label' => esc_html__('Unique color ID','uncode-core'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode-core'),
				),
				array(
					'id' => '_uncode_custom_color_regular',
					'label' => esc_html__('Monochrome', 'uncode-core') ,
					'desc' => esc_html__('Activate to assign a monochromatic color, otherwise a gradient will be used.', 'uncode-core') ,
					'std' => 'on',
					'type' => 'on-off',
					'section' => 'uncode_customize_section',
				) ,
				array(
					'id' => '_uncode_custom_color',
					'label' => esc_html__('Colorpicker', 'uncode-core') ,
					'desc' => esc_html__('Specify the color for this palette. You can also define a color with the alpha value.', 'uncode-core') ,
					'std' => '#ff0000',
					'type' => 'colorpicker',
					'condition' => '_uncode_custom_color_regular:is(on)',
				) ,
				array(
					'id' => '_uncode_custom_color_gradient',
					'label' => esc_html__('Gradient', 'uncode-core') ,
					'desc' => esc_html__('Specify the gradient color for this palette. NB. You can use a gradient color only as a background color.', 'uncode-core') ,
					'std' => '',
					'type' => 'gradientpicker',
					'condition' => '_uncode_custom_color_regular:is(off)',
				) ,
			)
		) ,
		array(
			'id' => '_uncode_custom_light_block_title',
			'label' => '<i class="fa fa-square-o"></i> ' . esc_html__('Light Skin', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_logo_color_light',
			'label' => esc_html__('SVG/Text logo color', 'uncode-core') ,
			'desc' => esc_html__('Specify the Logo color if it\'s a SVG or textual.', 'uncode-core') ,
			'std' => 'color-prif',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_color_light',
			'label' => esc_html__('Menu text color', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu text color.', 'uncode-core') ,
			'std' => 'color-prif',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_bg_color_light',
			'label' => esc_html__('Primary Menu background', 'uncode-core') ,
			'desc' => esc_html__('Specify the Primary Menu background color.', 'uncode-core') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_bg_alpha_light',
			'label' => esc_html__('Primary Menu Bg Opacity', 'uncode-core') ,
			'desc' => esc_html__('Adjust the Primary Menu background transparency.', 'uncode-core') ,
			'std' => '100',
			'type' => 'numeric-slider',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_submenu_bg_color_light',
			'label' => esc_html__('Primary Submenu background', 'uncode-core') ,
			'desc' => esc_html__('Specify the Primary Submenu background color.', 'uncode-core') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_border_color_light',
			'label' => esc_html__('Primary Menu border color', 'uncode-core') ,
			'desc' => esc_html__('Specify the Primary Menu border color.', 'uncode-core') ,
			'std' => 'color-gyho',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_border_alpha_light',
			'label' => esc_html__('Primary Menu border opacity', 'uncode-core') ,
			'desc' => esc_html__('Adjust the Primary Menu border transparency.', 'uncode-core') ,
			'std' => '100',
			'type' => 'numeric-slider',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_secmenu_bg_color_light',
			'label' => esc_html__('Top-Bar background', 'uncode-core') ,
			'desc' => esc_html__('Specify the Top-Bar background color.', 'uncode-core') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_heading_color_light',
			'label' => esc_html__('Headings color', 'uncode-core') ,
			'desc' => esc_html__('Specify the headings text color.', 'uncode-core') ,
			'std' => 'color-prif',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_text_color_light',
			'label' => esc_html__('Content text color', 'uncode-core') ,
			'desc' => esc_html__('Specify the content area text color.', 'uncode-core') ,
			'std' => 'color-wvjs',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_background_color_light',
			'label' => esc_html__('Content background', 'uncode-core') ,
			'desc' => esc_html__('Specify the content background color.', 'uncode-core') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_custom_dark_block_title',
			'label' => '<i class="fa fa-square"></i> ' . esc_html__('Dark Skin', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_logo_color_dark',
			'label' => esc_html__('SVG/Text logo color', 'uncode-core') ,
			'desc' => esc_html__('Specify the Logo color if it\'s a SVG or textual.', 'uncode-core') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_color_dark',
			'label' => esc_html__('Menu text color', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu text color.', 'uncode-core') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_bg_color_dark',
			'label' => esc_html__('Primary Menu background', 'uncode-core') ,
			'desc' => esc_html__('Specify the Primary Menu background color.', 'uncode-core') ,
			'std' => 'color-wayh',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_bg_alpha_dark',
			'label' => esc_html__('Primary Menu Bg Opacity', 'uncode-core') ,
			'desc' => esc_html__('Adjust the Primary Menu background transparency.', 'uncode-core') ,
			'std' => '100',
			'type' => 'numeric-slider',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_submenu_bg_color_dark',
			'label' => esc_html__('Primary Submenu background', 'uncode-core') ,
			'desc' => esc_html__('Specify the Primary Submenu background color.', 'uncode-core') ,
			'std' => 'color-rgdb',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_border_color_dark',
			'label' => esc_html__('Primary Menu border color', 'uncode-core') ,
			'desc' => esc_html__('Specify the Primary Menu border color.', 'uncode-core') ,
			'std' => 'color-prif',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_border_alpha_dark',
			'label' => esc_html__('Primary Menu border opacity', 'uncode-core') ,
			'desc' => esc_html__('Adjust the Primary Menu border transparency.', 'uncode-core') ,
			'std' => '100',
			'type' => 'numeric-slider',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_secmenu_bg_color_dark',
			'label' => esc_html__('Top-Bar background', 'uncode-core') ,
			'desc' => esc_html__('Specify the Top-Bar background color.', 'uncode-core') ,
			'std' => 'color-wayh',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_heading_color_dark',
			'label' => esc_html__('Headings color', 'uncode-core') ,
			'desc' => esc_html__('Specify the headings text color.', 'uncode-core') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_text_color_dark',
			'label' => esc_html__('Content text color', 'uncode-core') ,
			'desc' => esc_html__('Specify the content area text color.', 'uncode-core') ,
			'std' => 'color-xsdn',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_background_color_dark',
			'label' => esc_html__('Content background', 'uncode-core') ,
			'desc' => esc_html__('Specify the content background color.', 'uncode-core') ,
			'std' => 'color-wayh',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_custom_general_block_title',
			'label' => '<i class="fa fa-globe3"></i> ' . esc_html__('General', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_body_background',
			'label' => esc_html__('HTML body background', 'uncode-core') ,
			'desc' => esc_html__('Specify the body background color and media.', 'uncode-core') ,
			'type' => 'background',
			'std' => array(
				'Background Color' => 'color-lxmt',
				'Background Repeat' => '',
				'Background Attachment' => '',
				'Background Position' => '',
				'Background Size' => '',
				'Background Image' => '',
			),
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_accent_color',
			'label' => esc_html__('Accent color', 'uncode-core') ,
			'desc' => esc_html__('Specify the accent color.', 'uncode-core') ,
			'std' => 'color-210407',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_body_link_color',
			'label' => esc_html__('Links color', 'uncode-core') ,
			'desc' => esc_html__('Specify the color of links in page textual contents.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Default', 'uncode-core') ,
				) ,
				array(
					'value' => 'accent',
					'label' => esc_html__('Accent color', 'uncode-core') ,
				) ,
			)
		) ,
		array(
			'id' => '_uncode_body_font_family',
			'class' => 'uncode_font_family_dropdown',
			'label' => esc_html__('Body font family', 'uncode-core') ,
			'desc' => esc_html__('Specify the body font family.', 'uncode-core') ,
			'std' => 'font-555555',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_body_font_weight',
			'label' => esc_html__('Body font weight', 'uncode-core') ,
			'desc' => esc_html__('Specify the body font weight.', 'uncode-core') ,
			'std' => '400',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		) ,
		array(
			'id' => '_uncode_heading_font_family',
			'class' => 'uncode_font_family_dropdown',
			'label' => esc_html__('Headings font family', 'uncode-core') ,
			'desc' => esc_html__('Specify the headings font family.', 'uncode-core') ,
			'std' => 'font-555555',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_heading_font_weight',
			'label' => esc_html__('Headings font weight', 'uncode-core') ,
			'desc' => esc_html__('Specify the Headings font weight.', 'uncode-core') ,
			'std' => '600',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		) ,
		array(
			'id' => '_uncode_heading_letter_spacing',
			'label' => esc_html__('Headings letter spacing', 'uncode-core') ,
			'desc' => esc_html__('Specify the letter spacing in EMs.', 'uncode-core') ,
			'std' => '0.00',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_fallback_font',
			'class' => 'uncode_font_family_dropdown',
			'label' => esc_html__('Fallback font', 'uncode-core') ,
			'desc' => esc_html__('Select a font to use as fallback when Google Fonts import is not available.', 'uncode-core') ,
			'std' => 'font-555555',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_shadow_type',
			'label' => esc_html__('Shadows', 'uncode-core') ,
			'desc' => esc_html__('Select the type of shadows for the elements of your site.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Legacy', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'diffuse',
					'label' => esc_html__('Diffuse', 'uncode-core') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_custom_cursor',
			'label' => esc_html__('Cursor', 'uncode-core') ,
			'desc' => esc_html__('Selects a cursor type.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Browser', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'basic-style',
					'label' => esc_html__('Basic', 'uncode-core') ,
					'src' => ''
				),
				array(
					'value' => 'accent-style',
					'label' => esc_html__('Accent', 'uncode-core') ,
					'src' => ''
				),
				array(
					'value' => 'async-style',
					'label' => esc_html__('Asynchronous', 'uncode-core') ,
					'src' => ''
				),
				array(
					'value' => 'diff-style',
					'label' => esc_html__('Difference', 'uncode-core') ,
					'src' => ''
				),
				array(
					'value' => 'blur-style',
					'label' => esc_html__('Blur', 'uncode-core') ,
					'src' => ''
				),

			)
		) ,
		array(
			'id' => '_uncode_custom_cursor_links',
			'label' => esc_html__('Cursor on Links', 'uncode-core') ,
			'desc' => esc_html__('Activate the special cursor only when you hover over a link or an element that mimics a link.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_custom_cursor:not()',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_menu_style_block_title',
			'label' => '<i class="fa fa-menu"></i> ' . esc_html__('Menu', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_color_hover',
			'label' => esc_html__('Menu highlight color', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu active and hover effect color (If not specified an opaque version of the Menu color will be used).', 'uncode-core') ,
			'std' => '',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_overlay_menu_style',
			'label' => esc_html__('Overlay Menu Skin', 'uncode-core') ,
			'desc' => esc_html__('Specify the overlay Menu Skin.', 'uncode-core') ,
			'std' => 'light',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
			'choices' => $stylesArrayMenu
		) ,
		array(
			'id' => '_uncode_overlay_menu_bg',
			'label' => esc_html__('Overlay Menu Background', 'uncode-core') ,
			'desc' => esc_html__('Choose the background color of the Overlay Menu.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Default', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'submenu',
					'label' => esc_html__('Primary Submenu Background', 'uncode-core') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_overlay_menu_bg_opacity',
			'label' => esc_html__('Overlay Menu Opacity', 'uncode-core') ,
			'desc' => esc_html__('Choose the opacity of the background of the Overlay Menu.', 'uncode-core') ,
			'std' => '95',
			'min_max_step' => '0,100,1',
			'type' => 'numeric-slider',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
		) ,
		array(
			'id' => '_uncode_primary_menu_style',
			'label' => esc_html__('Primary Menu Skin', 'uncode-core') ,
			'desc' => esc_html__('Specify the Primary Menu Skin.', 'uncode-core') ,
			'std' => 'light',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'choices' => $stylesArrayMenu
		) ,
		array(
			'id' => '_uncode_primary_submenu_style',
			'label' => esc_html__('Primary Submenu Skin', 'uncode-core') ,
			'desc' => esc_html__('Specify the Primary Submenu Skin.', 'uncode-core') ,
			'std' => 'light',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'choices' => $stylesArrayMenu
		) ,
		$secondary_menu_skin,
		array(
			'id' => '_uncode_menu_font_size',
			'label' => esc_html__('Menu font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu font size. NB: the Overlay Menu font size is automatic relative to the viewport.', 'uncode-core') ,
			'std' => '12',
			'type' => 'text',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:not(menu-overlay),_uncode_headers:not(menu-overlay-center)',
			'operator' => 'and',
		) ,
		array(
			'id' => '_uncode_submenu_font_size',
			'label' => esc_html__('Submenu font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the Submenu font size. NB. The Overlay Submenu font size is automatic relative to the viewport.', 'uncode-core') ,
			'std' => '12',
			'type' => 'text',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:not(menu-overlay),_uncode_headers:not(menu-overlay-center)',
			'operator' => 'and',
		) ,
		array(
			'id' => '_uncode_menu_overlay_font_size',
			'label' => esc_html__('Menu font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu font size. NB: the Overlay Menu font size is automatic relative to the viewport.', 'uncode-core') ,
			'std' => '3.5vh',
			'type' => 'text',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
		) ,
		array(
			'id' => '_uncode_submenu_overlay_font_size',
			'label' => esc_html__('Submenu font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the Submenu font size. NB. The Overlay Submenu font size is automatic relative to the viewport.', 'uncode-core') ,
			'std' => '',
			'type' => 'text',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_headers:is(menu-overlay),_uncode_headers:is(menu-overlay-center)',
			'operator' => 'or',
		) ,
		array(
			'id' => '_uncode_menu_mobile_font_size',
			'label' => esc_html__('Mobile Menu font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu Mobile font size.', 'uncode-core') ,
			'std' => '12',
			'type' => 'text',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_menu_sticky_mobile:is(off),_uncode_menu_mobile_centered:is(off)',
			'operator' => 'or',
		) ,
		array(
			'id' => '_uncode_menu_mobile_centered_font_size',
			'label' => esc_html__('Mobile Menu font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu Mobile font size.', 'uncode-core') ,
			'std' => '5.5vw',
			'type' => 'text',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_menu_sticky_mobile:not(off),_uncode_menu_mobile_centered:not(off)',
			'operator' => 'and',
		) ,
		array(
			'id' => '_uncode_submenu_mobile_centered_font_size',
			'label' => esc_html__('Mobile Submenu font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu Mobile Submenu font size.', 'uncode-core') ,
			'std' => '',
			'type' => 'text',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_menu_sticky_mobile:not(off),_uncode_menu_mobile_centered:not(off)',
			'operator' => 'and',
		) ,
		array(
			'id' => '_uncode_menu_font_family',
			'class' => 'uncode_font_family_dropdown',
			'label' => esc_html__('Menu font family', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu font family.', 'uncode-core') ,
			'std' => 'font-555555',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_menu_font_weight',
			'label' => esc_html__('Menu font weight', 'uncode-core') ,
			'desc' => esc_html__('Specify the Menu font weight.', 'uncode-core') ,
			'std' => '600',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		) ,
		array(
			'id' => '_uncode_menu_letter_spacing',
			'label' => esc_html__('Menu letter spacing', 'uncode-core') ,
			'desc' => esc_html__('Specify the letter spacing in EMs. The default value is 0.05.', 'uncode-core') ,
			'std' => '0.05',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_first_uppercase',
			'label' => esc_html__('Menu first level uppercase', 'uncode-core') ,
			'desc' => esc_html__('Activate to transform the first Menu level to uppercase.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_other_uppercase',
			'label' => esc_html__('Menu other levels uppercase', 'uncode-core') ,
			'desc' => esc_html__('Activate to transform all the others Menu level to uppercase.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_customize_section',
		) ,
		$top_bar_customize_title,
		$top_bar_skin,
		$top_bar_font_family,
		$top_bar_font_weight,
		$top_bar_customize_title,
		$top_bar_font_size,
		$top_bar_font_size_mobile,
		array(
			'id' => '_uncode_custom_content_block_title',
			'label' => '<i class="fa fa-layout"></i> ' . esc_html__('Content', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_general_style',
			'label' => esc_html__('Skin', 'uncode-core') ,
			'desc' => esc_html__('Specify the content Skin.', 'uncode-core') ,
			'std' => 'light',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'condition' => '',
			'operator' => 'and',
			'choices' => array(
				array(
					'value' => 'light',
					'label' => esc_html__('Light', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'dark',
					'label' => esc_html__('Dark', 'uncode-core') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_general_bg_color',
			'label' => esc_html__('Background color', 'uncode-core') ,
			'desc' => esc_html__('Specify a custom content background color.', 'uncode-core') ,
			'std' => '',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_custom_buttons_block_title',
			'label' => '<i class="fa fa-download3"></i> ' . esc_html__('Buttons & Forms', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_button_shape',
			'label' => esc_html__('Button shape', 'uncode-core') ,
			'desc' => esc_html__('You can shape the button with the corners round, squared or circle.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Default', 'uncode-core')
				) ,
				array(
					'value' => 'btn-round',
					'label' => esc_html__('Round', 'uncode-core')
				) ,
				array(
					'value' => 'btn-circle',
					'label' => esc_html__('Circle', 'uncode-core')
				) ,
				array(
					'value' => 'btn-square',
					'label' => esc_html__('Square', 'uncode-core')
				)
			)
		) ,
		array(
			'id' => '_uncode_buttons_font_family',
			'class' => 'uncode_font_family_dropdown',
			'label' => esc_html__('Buttons font family', 'uncode-core') ,
			'desc' => esc_html__('Specify the buttons font family.', 'uncode-core') ,
			'std' => 'font-555555',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_buttons_font_size',
			'label' => esc_html__('Buttons font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the base button font size in pixels.', 'uncode-core') ,
			'std' => '12',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_buttons_font_weight',
			'label' => esc_html__('Buttons font weight', 'uncode-core') ,
			'desc' => esc_html__('Specify the buttons font weight.', 'uncode-core') ,
			'std' => '600',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		) ,
		array(
			'id' => '_uncode_buttons_text_transform',
			'label' => esc_html__('Buttons text transform', 'uncode-core') ,
			'desc' => esc_html__('Specify the buttons text transform.', 'uncode-core') ,
			'std' => 'uppercase',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'initial',
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
			) ,
		) ,
		array(
			'id' => '_uncode_buttons_letter_spacing',
			'label' => esc_html__('Buttons letter spacing', 'uncode-core') ,
			'desc' => esc_html__('Specify the letter spacing value.', 'uncode-core') ,
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $btn_letter_spacing,
		) ,
		array(
			'id' => '_uncode_buttons_border_width',
			'label' => esc_html__('Button-Form fields border', 'uncode-core') ,
			'desc' => esc_html__('Specify the width of the borders for buttons and form fields', 'uncode-core') ,
			'std' => '1',
			'type' => 'numeric-slider',
			'min_max_step'=> '1,5,1',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_button_hover',
			'label' => esc_html__('Button hover effect', 'uncode-core') ,
			'desc' => esc_html__('Specify an effect on hover state.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Outlined', 'uncode-core')
				) ,
				array(
					'value' => 'full-colored',
					'label' => esc_html__('Flat', 'uncode-core')
				)
			)
		) ,
		array(
			'id' => '_uncode_button_proportions',
			'label' => esc_html__('Button proportions', 'uncode-core') ,
			'desc' => esc_html__('Specify the buttons proportions.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Style 1', 'uncode-core')
				) ,
				array(
					'value' => 'style2',
					'label' => esc_html__('Style 2', 'uncode-core')
				) ,
				array(
					'value' => 'style3',
					'label' => esc_html__('Style 3', 'uncode-core')
				) ,
			)
		) ,
		array(
			'id' => '_uncode_input_underline',
			'label' => esc_html__('Form inputs style', 'uncode-core') ,
			'desc' => esc_html__('Specify the style of the form inputs.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Default', 'uncode-core')
				) ,
				array(
					'value' => 'background',
					'label' => esc_html__('Background', 'uncode-core')
				),
				array(
					'value' => 'on',
					'label' => esc_html__('Underline', 'uncode-core')
				)
			)
		) ,
		array(
			'id' => '_uncode_custom_menu_filter_block_title',
			'label' => '<i class="fa fa-toggle"></i> ' . esc_html__('Filter Menu', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_filter_font_family',
			'class' => 'uncode_font_family_dropdown',
			'label' => esc_html__('Filter Menu font family', 'uncode-core') ,
			'desc' => esc_html__('Specify the font family.', 'uncode-core') ,
			'std' => 'font-555555',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_menu_filter_font_size',
			'label' => esc_html__('Filter Menu font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the font size in pixels.', 'uncode-core') ,
			'std' => '11',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_menu_filter_font_weight',
			'label' => esc_html__('Filter Menu font weight', 'uncode-core') ,
			'desc' => esc_html__('Specify the font weight.', 'uncode-core') ,
			'std' => '600',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		) ,
		array(
			'id' => '_uncode_menu_filter_letter_spacing',
			'label' => esc_html__('Filter Menu letter spacing', 'uncode-core') ,
			'desc' => esc_html__('Specify the letter spacing value.', 'uncode-core') ,
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $btn_letter_spacing,
		) ,
		array(
			'id' => '_uncode_custom_ui_block_title',
			'label' => '<i class="fa fa-align-left2"></i> ' . esc_html__('Widgets & UI', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_ui_font_family',
			'class' => 'uncode_font_family_dropdown',
			'label' => esc_html__('UI font family', 'uncode-core') ,
			'desc' => esc_html__('Specify the font family (Widgets Titles, Comments Details, etc.).', 'uncode-core') ,
			'std' => 'font-555555',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $custom_fonts
		) ,
		array(
			'id' => '_uncode_ui_font_size',
			'label' => esc_html__('UI font size', 'uncode-core') ,
			'desc' => esc_html__('Specify the font size in pixels (Widgets Titles, Comments Details, etc.).', 'uncode-core') ,
			'std' => '12',
			'type' => 'text',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_ui_font_weight',
			'label' => esc_html__('UI font weight', 'uncode-core') ,
			'desc' => esc_html__('Specify the font weight (Widgets Titles, Comments Details, etc.).', 'uncode-core') ,
			'std' => '600',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $title_weight
		) ,
		array(
			'id' => '_uncode_ui_text_transform',
			'label' => esc_html__('UI text transform', 'uncode-core') ,
			'desc' => esc_html__('Specify the text transform (Widgets Titles, Comments Details, etc.).', 'uncode-core') ,
			'std' => 'uppercase',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => array(
				array(
					'value' => 'initial',
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
			) ,
		) ,
		array(
			'id' => '_uncode_ui_letter_spacing',
			'label' => esc_html__('UI letter spacing', 'uncode-core') ,
			'desc' => esc_html__('Specify the letter spacing value (Widgets Titles, Comments Details, etc.).', 'uncode-core') ,
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'choices' => $btn_letter_spacing,
		) ,
		array(
			'id' => '_uncode_footer_style_block_title',
			'label' => '<i class="fa fa-ellipsis"></i> ' . esc_html__('Footer', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_footer_last_style',
			'label' => esc_html__('Copyright Skin', 'uncode-core') ,
			'desc' => esc_html__('Specify the copyright Skin color.', 'uncode-core') ,
			'std' => 'dark',
			'type' => 'select',
			'section' => 'uncode_customize_section',
			'condition' => '',
			'operator' => 'and',
			'choices' => $stylesArrayMenu
		) ,
		array(
			'id' => '_uncode_footer_bg_color',
			'label' => esc_html__('Copyright background', 'uncode-core') ,
			'desc' => esc_html__('Specify a custom copyright background color.', 'uncode-core') ,
			'std' => '',
			'type' => 'uncode_color',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_customize_extra_block_title',
			'label' => '<i class="fa fa-inbox2"></i> ' . esc_html__('Scroll & Parallax', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_smooth_scroll',
			'label' => esc_html__('Smooth Scroll', 'uncode-core') ,
			'desc' => esc_html__('Enable this option to create a smoother scrolling experience on your site.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_smooth_scroll_safe',
			'label' => esc_html__('Smooth Scroll Safe', 'uncode-core') ,
			'desc' => esc_html__('Activate this option if there are unexpected issues with Smooth Scroll on complex elements. For example, if after a change in page height (such as with Tabs, Accordion, Toggle, Ajax), it is not possible to scroll to the Footer.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_customize_section',
			'condition' => '_uncode_smooth_scroll:is(on)',
		) ,
		array(
			'id' => '_uncode_scroll_constant',
			'label' => esc_html__('ScrollTo constant speed', 'uncode-core') ,
			'desc' => esc_html__('Activate this to always have a constant speed when scrolling to point.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_scroll_constant_factor',
			'label' => esc_html__('ScrollTo constant speed factor', 'uncode-core') ,
			'desc' => esc_html__('Adjust the constant scroll speed factor. Default 2', 'uncode-core') ,
			'std' => '2',
			'type' => 'numeric-slider',
			'min_max_step'=> '1,15,0.25',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'condition' => '_uncode_scroll_constant:is(on)',
		) ,
		array(
			'id' => '_uncode_scroll_speed_value',
			'label' => esc_html__('ScrollTo speed fixed', 'uncode-core') ,
			'desc' => esc_html__('Specify the scroll speed time in milliseconds.', 'uncode-core') ,
			'std' => '1000',
			'type' => 'text',
			'section' => 'uncode_customize_section',
			'operator' => 'or',
			'condition' => '_uncode_scroll_constant:is(off)',
		) ,
		array(
			'id' => '_uncode_parallax_factor',
			'label' => esc_html__('Parallax speed factor', 'uncode-core') ,
			'desc' => esc_html__('Adjust the Parallax speed factor. Default 2.5', 'uncode-core') ,
			'std' => '2.5',
			'type' => 'numeric-slider',
			'min_max_step'=> '0.5,3,0.5',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_sticky_elements',
			'label' => esc_html__('Sticky elements scrollable', 'uncode-core') ,
			'desc' => esc_html__('Activate it to scroll the sidebar independently.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_customize_section',
		) ,
		array(
			'id' => '_uncode_skew',
			'label' => esc_html__('Skew', 'uncode-core') ,
			'desc' => esc_html__('Apply the Skew effect at the page scroll.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_customize_section',
		),
	);

	// if ( ! defined('ENVATO_HOSTED_SITE') )
	// 	$custom_settings_one = array_merge( $custom_settings_one, $custom_settings_four );

	$extra_settings = array(
		array(
			'id' => '_uncode_custom_portfolio_block_title',
			'label' => '<i class="fa fa-briefcase3"></i> ' . ucfirst($portfolio_cpt_name) . ' ' . esc_html__('CPT', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_extra_section',
		) ,
		array(
			'id' => '_uncode_portfolio_cpt',
			'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('CPT label', 'uncode-core') ,
			'desc' => esc_html__('Enter a custom Portfolio Post Type label.', 'uncode-core') ,
			'std' => 'portfolio',
			'type' => 'text',
			'section' => 'uncode_extra_section',
		) ,
		array(
			'id' => '_uncode_portfolio_cpt_slug',
			'label' => ucfirst($portfolio_cpt_name) . ' ' . esc_html__('CPT slug', 'uncode-core') ,
			'desc' => esc_html__('Enter a custom Portfolio Post Type slug.', 'uncode-core') ,
			'std' => 'portfolio',
			'type' => 'text',
			'section' => 'uncode_extra_section',
		) ,
		array(
			'id' => '_uncode_customize_gmaps_block_title',
			'label' => '<i class="fa fa-map2"></i> ' . esc_html__('Google Maps', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_extra_section',
		) ,
		array(
			'id' => '_uncode_gmaps_api',
			'label' => esc_html__('Google Maps API KEY', 'uncode-core') ,
			'desc' => sprintf( wp_kses(__( 'To use Uncode custom styled Google Maps you need to create <a href="%s" target="_blank">here the Google API KEY</a> and paste it in this field.', 'uncode-core' ), array( 'a' => array( 'href' => array(),'target' => array() ) ) ), 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ),
			'type' => 'text',
			'section' => 'uncode_extra_section',
		) ,
		array(
			'id' => '_uncode_customize_redirect_block_title',
			'label' => '<i class="fa fa-link3"></i> ' . esc_html__('Redirect page', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_extra_section',
		) ,
		array(
			'id' => '_uncode_redirect',
			'label' => esc_html__('Redirect page', 'uncode-core') ,
			'desc' => esc_html__('Activate to redirect all the website calls to a specific page. NB. This can only be visible when the user is not logged in.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_extra_section',
		) ,
		array(
			'id' => '_uncode_redirect_page',
			'label' => esc_html__('Page', 'uncode-core') ,
			'desc' => esc_html__('Specify the redirect page. NB. This page will be presented without Menu and footer.', 'uncode-core') ,
			'type' => 'page_select',
			'section' => 'uncode_extra_section',
			'post_type' => 'page',
			'condition' => '_uncode_redirect:is(on)',
			'operator' => 'and',
			'choices' => array(),
		) ,
	);

	if ( ! defined('ENVATO_HOSTED_SITE') ) {
		$extra_settings[] = array(
			'id' => '_uncode_customize_admin_block_title',
			'label' => '<i class="fa fa-head"></i> ' . esc_html__('Admin', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_extra_section',
		);

		$extra_settings[] = array(
			'id' => '_uncode_admin_help',
			'label' => esc_html__('Help button in admin bar', 'uncode-core') ,
			'desc' => esc_html__('Activate to show the Uncode help button in the WP admin bar.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_extra_section',
		);
	}

	$products_attributes = array(
		array(
			'value' => '',
			'label' => esc_html__('None', 'uncode-core'),
		)
	);

	if ( class_exists( 'WooCommerce' ) ) {
		$attribute_taxonomies = wc_get_attribute_taxonomies();

		if ( $attribute_taxonomies ) {
			foreach ( $attribute_taxonomies as $tax ) {
				$attr_key   = wc_attribute_taxonomy_name( $tax->attribute_name );
				$attr_label = wc_attribute_label( $attr_key );

				$products_attributes[] = array(
					'value' => $attr_key,
					'label' => $attr_label
				);
			}
		}
	}

	$woocommerce_settings = array(
		array(
			'id' => '_uncode_woocommerce_hooks',
			'label' => esc_html__('Enable Hooks', 'uncode-core') ,
			'desc' => esc_html__('Activate this to enable default WooCommerce hooks on product loops.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_minicart_style',
			'label' => esc_html__('Mini-Cart', 'uncode-core') ,
			'desc' => esc_html__('Specify the style of the Mini-Cart in the menu.', 'uncode-core') ,
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Dropdown Style', 'uncode-core') ,
				) ,
				array(
					'value' => 'sidecart',
					'label' => esc_html__('Side-Cart Style', 'uncode-core') ,
				) ,
			),
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
			'operator' => 'and',
		),
		array(
			'id' => '_uncode_woocommerce_sidecart_skin',
			'label' => esc_html__('Side-Cart Skin', 'uncode-core') ,
			'desc' => esc_html__('Specify the Side-Cart Skin.', 'uncode-core') ,
			'std' => 'light',
			'type' => 'select',
			'section' => 'uncode_woocommerce_section',
			'condition' => '_uncode_woocommerce_minicart_style:is(sidecart)',
			'operator' => 'and',
			'choices' => array(
				array(
					'value' => 'light',
					'label' => esc_html__('Light', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'dark',
					'label' => esc_html__('Dark', 'uncode-core') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_woocommerce_sidecart_position',
			'label' => esc_html__('Side-Cart position', 'uncode-core') ,
			'desc' => esc_html__('Specify the horizontal position of the Side-Cart.', 'uncode-core') ,
			'std' => 'right',
			'type' => 'select',
			'section' => 'uncode_woocommerce_section',
			'condition' => '_uncode_woocommerce_minicart_style:is(sidecart)',
			'operator' => 'and',
			'choices' => array(
				array(
					'value' => 'right',
					'label' => esc_html__('Right', 'uncode-core') ,
					'src' => ''
				) ,
				array(
					'value' => 'left',
					'label' => esc_html__('Left', 'uncode-core') ,
					'src' => ''
				)
			)
		) ,
		array(
			'id' => '_uncode_woocommerce_popup_cart_quantity',
			'label' => esc_html__('Cart quantity effect', 'uncode-core') ,
			'desc' => esc_html__('Activate to apply the animation effect to the Cart quantity badge.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_activate_sidecart_mobile',
			'label' => esc_html__('Open cart on mobile', 'uncode-core') ,
			'desc' => esc_html__('Activate this to open the Side-Cart on mobile.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '_uncode_woocommerce_minicart_style:is(sidecart)',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_product_index_quick_view',
			'label' => esc_html__('Quick-View', 'uncode-core') ,
			'desc' => esc_html__('Activate the Quick-View functionalities.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_product_index_quick_view_hooks',
			'label' => esc_html__('Quick-View Enable Hooks', 'uncode-core') ,
			'desc' => esc_html__('Activate this to enable default WooCommerce hooks in the Quick-View.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_product_index_quick_view_type',
			'label' => esc_html__('Quick-View content Type', 'uncode-core') ,
			'desc' => esc_html__('Set your preferred layout method. Select Default to use the Basic template, or Content Block to create custom layouts with dynamic options.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Default', 'uncode-core') ,
				) ,
				array(
					'value' => 'uncodeblock',
					'label' => esc_html__('Content Block', 'uncode-core') ,
				) ,
			),
			'section' => 'uncode_woocommerce_section',
			'condition' => '_uncode_product_index_quick_view:is(on)',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_product_index_quick_view_content_block',
			'label' => esc_html__('Quick-View content block', 'uncode-core') ,
			'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
			'type' => 'custom-post-type-select',
			'post_type' => 'uncodeblock',
			'section' => 'uncode_woocommerce_section',
			'condition' => '_uncode_product_index_quick_view_type:is(uncodeblock),_uncode_product_index_quick_view:is(on)',
			'operator' => 'and',
			'choices' => array(),
			'extra_choices' => array(
				''     => esc_html__('Select…', 'uncode-core'),
			),
		),
		array(
			'id' => '_uncode_product_enable_ajax_add_to_cart',
			'label' => esc_html__('AJAX Add To Cart', 'uncode-core') ,
			'desc' => get_option('woocommerce_enable_ajax_add_to_cart') == 'yes' ? esc_html__('Enable AJAX Add To Cart buttons on single product pages. NB. Please note that this option works with Simple and Variable products only.', 'uncode-core') : sprintf( wp_kses(__( 'Enable AJAX Add To Cart buttons on single product pages. NB. Please note that this option works with Simple and Variable products only. Please enable <a href="%s" target="_blank">Enable AJAX add to cart buttons on archives</a> in WooCommerce settings.', 'uncode-core' ), array( 'a' => array( 'href' => array(),'target' => array() ) ) ), admin_url( 'admin.php?page=wc-settings&tab=products' ) ),
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
		),
		array(
			'id' => '_uncode_product_quantity_input_style',
			'label' => esc_html__('Quantity', 'uncode-core') ,
			'desc' => esc_html__('Specify the quantity style.', 'uncode-core') ,
			'std' => '',
			'type' => 'select',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Default', 'uncode-core') ,
				) ,
				array(
					'value' => 'variation',
					'label' => esc_html__('Variation', 'uncode-core') ,
				) ,
			) ,
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
		),
		array(
			'id' => '_uncode_woocommerce_enhanced_atc',
			'label' => esc_html__('Add To Cart Button Enhanced', 'uncode-core') ,
			'desc' => esc_html__('Activate this to enable the enhanced Add To Cart button on loops.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_width_atc',
			'label' => esc_html__('Add To Cart Button Auto Width', 'uncode-core') ,
			'desc' => esc_html__('Activate this to enable the auto width for Add To Cart button on loops.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_atc_notify',
			'label' => esc_html__('Added To Cart Notification', 'uncode-core') ,
			'desc' => esc_html__('Set the behavior for WooCommerce notifications when a product is added to the cart.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'select',
			'section' => 'uncode_woocommerce_section',
			'choices' => array(
				array(
					'value' => '',
					'label' => esc_html__('Default', 'uncode-core')
				) ,
				array(
					'value' => 'minicart',
					'label' => esc_html__('Mini-Cart', 'uncode-core')
				) ,
			),
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_attribute_with_thumbnail',
			'label' => esc_html__('Swatches with thumbnails', 'uncode-core') ,
			'desc' => esc_html__('Select the attribute that should use the featured thumbnail of the variation as a swatch.', 'uncode-core') ,
			'type' => 'select',
			'section' => 'uncode_woocommerce_section',
			'choices' => $products_attributes,
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_default_product_gallery',
			'label' => esc_html__('Default Single Product Gallery', 'uncode-core') ,
			'desc' => esc_html__('For possible extra plugins compatibility purposes, activate this to use the default WooCommerce Product Gallery on the Single Product layout.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_catalog_mode',
			'label' => esc_html__('Catalog Mode', 'uncode-core') ,
			'desc' => esc_html__('Activate this to hide the "Cart" page, "Checkout" page and all the "Add to Cart" buttons in the shop.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_catalog_mode_disabled_for_admins',
			'label' => esc_html__('Catalog Mode Admins', 'uncode-core') ,
			'desc' => esc_html__('Activate this to enable the Catalog Mode for admins.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '_uncode_woocommerce_catalog_mode:is(on)',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_catalog_mode_show_variations',
			'label' => esc_html__('Catalog Mode Show Variations', 'uncode-core') ,
			'desc' => esc_html__('Activate this to show product variations where "Add to cart" is hidden.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '_uncode_woocommerce_catalog_mode:is(on)',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_use_search_options',
			'label' => esc_html__('Use Search Options', 'uncode-core') ,
			'desc' => esc_html__('Activate this to use the Search tab settings when the search does not find results.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_enable_single_variations',
			'label' => esc_html__('Variations Single Products', 'uncode-core') ,
			'desc' => esc_html__('Activate this to enable the possibility to have your product variations available as single products in the shop, category & search results when using the Posts module. NB. Please note that the first time you enable the Variations Single Products option, it\'s necessary to \'Process Variations\'. Please also activate the dedicated option in the Posts module.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_woocommerce_section',
			'condition' => '',
			'operator' => 'and'
		),
		array(
			'id' => '_uncode_woocommerce_single_variations_excluded_atts',
			'label' => esc_html__('Exclude attributes', 'uncode-core') ,
			'desc' => esc_html__('Enter the ID of the attributes that should be excluded.  NB. The values need to be comma separated. Attributes will be not excluded in Up-Sells, Cross-Sells and Related Products.', 'uncode-core') ,
			'type' => 'text',
			'section' => 'uncode_woocommerce_section',
			'condition' => '_uncode_woocommerce_enable_single_variations:is(on)',
		) ,
		array(
			'id' => '_uncode_woocommerce_process_variations',
			'label' => esc_html__('Process Variations', 'uncode-core') ,
			'desc' => esc_html__('Each time a product is added or a variation is changed, and each time a category, tag, or attribute is added or removed, variations must be synced. NB. It is not necessary to save Theme Options after processing variations.', 'uncode-core') ,
			'button_text' => esc_html__('Process All Variations', 'uncode-core'),
			'button_ajax' => true,
			'type' => 'button',
			'section' => 'uncode_woocommerce_section',
			'condition' => '_uncode_woocommerce_enable_single_variations:is(on)',
		),
	);

	$custom_settings_five = array(
		array(
			'id' => '_uncode_footer_layout_block_title',
			'label' => '<i class="fa fa-layers"></i> ' . esc_html__('Layout', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_full',
			'label' => esc_html__('Footer full width', 'uncode-core') ,
			'desc' => esc_html__('Expand the Footer to full width.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_footer_section',
			'condition' => '_uncode_boxed:is(off)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_footer_content_block_title',
			'label' => '<i class="fa fa-cog2"></i> ' . esc_html__('Widget area', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_block',
			'label' => esc_html__('Content Block', 'uncode-core') ,
			'desc' => esc_html__('Set the Content Block to use.', 'uncode-core') ,
			'std' => '',
			'type' => 'custom-post-type-select',
			'section' => 'uncode_footer_section',
			'post_type' => 'uncodeblock',
			'condition' => '',
			'operator' => 'and',
			'choices' => array(),
			'extra_choices' => array(
				''     => esc_html__('Select…', 'uncode-core'),
			),
		) ,
		array(
			'id' => '_uncode_footer_last_block_title',
			'label' => '<i class="fa fa-copyright"></i> ' . esc_html__('Copyright', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_copy_hide',
			'label' => esc_html__('Hide Copyright', 'uncode-core') ,
			'type' => 'on-off',
			'desc' => esc_html__('Activate this to hide the Copyright.', 'uncode-core') ,
			'std' => 'off',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_copyright',
			'label' => esc_html__('Automatic copyright text', 'uncode-core') ,
			'desc' => esc_html__('Activate to use an automatic copyright text.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_text',
			'label' => esc_html__('Custom copyright text', 'uncode-core') ,
			'desc' => esc_html__('Insert a custom text for the Footer copyright.', 'uncode-core') ,
			'type' => 'textarea',
			'section' => 'uncode_footer_section',
			'operator' => 'or',
			'condition' => '_uncode_footer_copyright:is(off)',
		) ,
		array(
			'id' => '_uncode_footer_position',
			'label' => esc_html__('Content alignment', 'uncode-core') ,
			'desc' => esc_html__('Specify the Footer copyright text alignment.', 'uncode-core') ,
			'std' => 'left',
			'type' => 'select',
			'section' => 'uncode_footer_section',
			'choices' => array(
				array(
					'value' => 'left',
					'label' => esc_html__('Left', 'uncode-core')
				) ,
				array(
					'value' => 'center',
					'label' => esc_html__('Center', 'uncode-core')
				) ,
				array(
					'value' => 'right',
					'label' => esc_html__('Right', 'uncode-core')
				)
			)
		) ,
		array(
			'id' => '_uncode_footer_social',
			'label' => esc_html__('Social links', 'uncode-core') ,
			'desc' => esc_html__('Activate to have the social icons in the Footer copyright.', 'uncode-core') ,
			'type' => 'on-off',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_add_block_title',
			'label' => '<i class="fa fa-square-plus"></i> ' . esc_html__('Additional', 'uncode-core') ,
			'type' => 'textblock-titled',
			'class' => 'section-title',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_uparrow',
			'label' => esc_html__('Scroll up', 'uncode-core') ,
			'desc' => esc_html__('Activate to add a Scroll Up button in the Footer.', 'uncode-core') ,
			'type' => 'on-off',
			'std' => 'on',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_uparrow_mobile',
			'label' => esc_html__('Scroll up mobile', 'uncode-core') ,
			'desc' => esc_html__('Activate to add a Scroll Up button in the Footer for mobile devices.', 'uncode-core') ,
			'type' => 'on-off',
			'std' => 'on',
			'condition' => '_uncode_footer_uparrow:is(on)',
			'operator' => 'and',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_footer_uparrow_style',
			'label' => esc_html__('Scroll up style', 'uncode-core') ,
			'desc' => esc_html__('Specify the Scroll Up button style.', 'uncode-core') ,
			'type' => 'select',
			'std' => 'default',
			'choices' => array(
				array(
					'value' => 'default',
					'label' => esc_html__('Default', 'uncode-core')
				) ,
				array(
					'value' => 'circle',
					'label' => esc_html__('Circle', 'uncode-core')
				) ,
			),
			'condition' => '_uncode_footer_uparrow:is(on)',
			'operator' => 'and',
			'section' => 'uncode_footer_section',
		) ,
		array(
			'id' => '_uncode_social_list',
			'label' => esc_html__('Social Networks', 'uncode-core') ,
			'desc' => esc_html__('Define your Social Networks.', 'uncode-core') ,
			'type' => 'list-item',
			'section' => 'uncode_connections_section',
			'class' => 'list-social',
			'settings' => array(
				array(
					'id' => '_uncode_social_unique_id',
					'class' => 'unique_id',
					'std' => 'social-',
					'type' => 'text',
					'label' => esc_html__('Unique social ID','uncode-core'),
					'desc' => esc_html__('This value is created automatically and it shouldn\'t be edited unless you know what you are doing.','uncode-core'),
				),
				array(
					'id' => '_uncode_social',
					'label' => esc_html__('Social Network Icon', 'uncode-core') ,
					'desc' => esc_html__('Specify the social network icon.', 'uncode-core') ,
					'type' => 'text',
					'class' => 'button_icon_container',
				) ,
				array(
					'id' => '_uncode_link',
					'label' => esc_html__('Social Network Link', 'uncode-core') ,
					'desc' => esc_html__('Enter your social network link.', 'uncode-core') ,
					'std' => '',
					'type' => 'text',
					'condition' => '',
					'operator' => 'and'
				) ,
				array(
					'id' => '_uncode_aria',
					'label' => esc_html__('ARIA label', 'uncode-core') ,
					'desc' => esc_html__('Accessible-Rich-Internet-Applications text', 'uncode-core') ,
					'std' => '',
					'type' => 'text',
					'condition' => '',
					'operator' => 'and'
				) ,
				array(
					'id' => '_uncode_menu_hidden',
					'label' => esc_html__('Hide In The Menu', 'uncode-core') ,
					'desc' => esc_html__('Activate to hide the social icon in the Menu (if the social connections in the Menu is active).', 'uncode-core') ,
					'std' => 'off',
					'type' => 'on-off',
					'condition' => '',
					'operator' => 'and'
				) ,
			)
		) ,

		array(
			'id' => '_uncode_custom_css',
			'label' => esc_html__('CSS', 'uncode-core') ,
			'desc' => esc_html__('Enter here your custom CSS.', 'uncode-core') ,
			'std' => '',
			'type' => 'css',
			'section' => 'uncode_cssjs_section',
			'rows' => '13',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_custom_js',
			'label' => esc_html__('JavaScript', 'uncode-core') ,
			'desc' => esc_html__('Enter here your custom JavaScript code. You can wrap your code in a "script" tag or just write the body of your function. Both methods are allowed. However, the syntax highlighter works in the second case only (without the script tag).', 'uncode-core') ,
			'std' => '',
			'type' => 'js',
			'section' => 'uncode_cssjs_section',
			'rows' => '13',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_custom_tracking_head',
			'label' => esc_html__('Tracking (Head)', 'uncode-core') ,
			'desc' => esc_html__('Enter here your custom Tracking code. You can wrap your code in a "script" tag or just write the body of your function. Both methods are allowed. However, the syntax highlighter works in the second case only (without the script tag).', 'uncode-core') ,
			'std' => '',
			'type' => 'js',
			'section' => 'uncode_cssjs_section',
			'rows' => '13',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_custom_tracking',
			'label' => esc_html__('Tracking (Body)', 'uncode-core') ,
			'desc' => esc_html__('Enter here your custom Tracking code. You can wrap your code in a "script" tag or just write the body of your function. Both methods are allowed. However, the syntax highlighter works in the second case only (without the script tag).', 'uncode-core') ,
			'std' => '',
			'type' => 'js',
			'section' => 'uncode_cssjs_section',
			'rows' => '13',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_adaptive',
			'label' => esc_html__('Adaptive Images', 'uncode-core') ,
			'desc' => esc_html__('The Adaptive Images system detects your visitor\'s screen size and automatically delivers device appropriate re-scaled images.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_adaptive_async',
			'label' => esc_html__('Adaptive Images Async', 'uncode-core') ,
			'desc' => esc_html__('Activate to load the Adaptive Images asynchronously, this will improve the loading performance and it\'s necessary if using an aggresive caching system.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'operator' => 'or',
			'condition' => '_uncode_adaptive:is(on)',
		) ,
		array(
			'id' => '_uncode_adaptive_async_blur',
			'label' => esc_html__('Adaptive Images Async Blur', 'uncode-core') ,
			'desc' => esc_html__('Activate to use a bluring effect when loading the images.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'operator' => 'and',
			'condition' => '_uncode_adaptive:is(on),_uncode_adaptive_async:is(on)',
		) ,
		array(
			'id' => '_uncode_adaptive_mobile_advanced',
			'label' => esc_html__('Mobile settings', 'uncode-core') ,
			'desc' => esc_html__('Activate to set specific mobile options.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'operator' => 'or',
			'condition' => '_uncode_adaptive:is(on)',
		) ,
		array(
			'id' => '_uncode_adaptive_use_orientation_width',
			'label' => esc_html__('Current mobile orientation', 'uncode-core') ,
			'desc' => esc_html__('Activate to use the current mobile orientation width (portrait or landscape) instead of the max device\'s width (landscape).', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'operator' => 'and',
			'condition' => '_uncode_adaptive:is(on),_uncode_adaptive_mobile_advanced:is(on)',
		) ,
		array(
			'id' => '_uncode_adaptive_limit_density',
			'label' => esc_html__('Limit device density', 'uncode-core') ,
			'desc' => esc_html__('Activate to limit the pixel density to 2 when generating the most appropriate image for high pixel density displays.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'operator' => 'and',
			'condition' => '_uncode_adaptive:is(on),_uncode_adaptive_mobile_advanced:is(on)',
		) ,
		array(
			'id' => '_uncode_dynamic_srcset',
			'label' => esc_html__('Dynamic Srcset', 'uncode-core') ,
			'desc' => esc_html__('The Dynamic Srcset system creates a list of different responsive images so that browser can pick the most appropriate version based on the actual device\'s resolution.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'operator' => 'or',
			'condition' => '_uncode_adaptive:is(off)',
			'warning' => array(
				'title' => esc_html__('Delete all AI Images', 'uncode-core'),
				'icon' => 'fa fa-warning2',
				'message' => esc_html__('Before using this option, it is recommended to delete the currently Adaptive Images to create the new Adaptive Srcset versions. Please click on \'Delete all AI Images\' and then activate this option.', 'uncode-core'),
				'button'  => esc_html__('Activate Dynamic Srcset', 'uncode-core'),
			),
		) ,
		array(
			'id' => '_uncode_adaptive_quality',
			'label' => esc_html__('Image quality', 'uncode-core') ,
			'desc' => esc_html__('Adjust the images compression quality.', 'uncode-core') ,
			'std' => '90',
			'type' => 'numeric-slider',
			'min_max_step'=> '60,100,1',
			'section' => 'uncode_performance_section',
			'operator' => 'or',
			'condition' => '_uncode_adaptive:is(on),_uncode_dynamic_srcset:is(on)',
		) ,
		array(
			'id' => '_uncode_dynamic_srcset_sizes',
			'label' => esc_html__('Image sizes range', 'uncode-core') ,
			'desc' => esc_html__('Enter all the image sizes you want use for the Dynamic Srcset system. NB. The values needs to be comma separated.', 'uncode-core') ,
			'type' => 'text',
			'std' => '720,1032',
			'section' => 'uncode_performance_section',
			'operator' => 'and',
			'condition' => '_uncode_dynamic_srcset:is(on),_uncode_adaptive:is(off)',
		) ,
		array(
			'id' => '_uncode_dynamic_srcset_bg_mobile_size',
			'label' => esc_html__('Background mobile size', 'uncode-core') ,
			'desc' => esc_html__('Set an optional background images size on mobile devices (leave empty to use the full size).', 'uncode-core') ,
			'type' => 'number',
			'class' => 'force-numer',
			'std' => '',
			'section' => 'uncode_performance_section',
			'operator' => 'and',
			'condition' => '_uncode_dynamic_srcset:is(on),_uncode_adaptive:is(off)',
		) ,
		array(
			'id' => '_uncode_dynamic_srcset_lazy_animations',
			'label' => esc_html__('Synced Animations', 'uncode-core') ,
			'desc' => esc_html__('This option synchronizes the start of possible animations with the actual loading of the images.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'operator' => 'and',
			'condition' => '_uncode_dynamic_srcset:is(on),_uncode_adaptive:is(off)',
		) ,
		array(
			'id' => '_uncode_adaptive_sizes',
			'label' => esc_html__('Image sizes range', 'uncode-core') ,
			'desc' => esc_html__('Enter all the image sizes you want use for the Adaptive Images system. NB. The values needs to be comma separated.', 'uncode-core') ,
			'type' => 'text',
			'std' => '258,516,720,1032,1440,2064,2880',
			'section' => 'uncode_performance_section',
			'operator' => 'or',
			'condition' => '_uncode_adaptive:is(on)',
		) ,
		array(
			'id' => '_uncode_adaptive_register_meta',
			'label' => esc_html__('Register Metadata', 'uncode-core') ,
			'desc' => esc_html__('Activate to register the image metadata when generating thumbnails and Adaptive Images. Useful if you intend to use a plugin for image optimization like ShortPixel.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '_uncode_dynamic_srcset:is(off),_uncode_adaptive:is(on)',
			'operator' => 'or'
		) ,
		array(
			'id' => '_uncode_split_js_files',
			'label' => esc_html__('Split & Modular JS', 'uncode-core') ,
			'desc' => esc_html__('Activate this to load each JavaScript library on-demand only when it’s needed by the specific modules you are using on a page.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_split_css_files',
			'label' => esc_html__('Split & Modular CSS', 'uncode-core') ,
			'desc' => esc_html__('Activate this to load each CSS library on-demand only when it’s needed by the specific modules you are using on a page.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_defer_css_files',
			'label' => esc_html__('Defer CSS Styles', 'uncode-core') ,
			'desc' => esc_html__('Activate this to defer non-critical styles, loading them in a non-blocking way. This option is recommended if you are using a caching plugin otherwise you would see a flash of unstyled content (FOUC). Also, beware of third-party cache plugins settings as they may interfere with this option preventing it from working. Rely on their settings in this case and leave it on-off.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '_uncode_split_css_files:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_defer_style_custom_css',
			'label' => esc_html__('Defer CSS Style Custom', 'uncode-core') ,
			'desc' => esc_html__('Activate it to defer the dynamic style (style-custom.css) as well. If you\'re having FOUC (flash of unstyled content) problems, try leaving it off. Third-party caching and optimization plugins may break this functionality. Rely on their settings in this case and leave it off.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '_uncode_defer_css_files:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_inline_core_css',
			'label' => esc_html__('In-Line Core Style', 'uncode-core') ,
			'desc' => esc_html__('Activate this to inline core styles at the head of the page. Third-party caching and optimization plugins may break this functionality. Rely on their settings in this case and leave it off.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '_uncode_split_css_files:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_inline_style_custom_css',
			'label' => esc_html__('In-Line Style Custom', 'uncode-core') ,
			'desc' => esc_html__('Activate this to inline dynamic styles at the head of the page. Third-party caching and optimization plugins may break this functionality. Rely on their settings in this case and leave it off.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '_uncode_split_css_files:is(on)',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_google_fonts_ondemand',
			'label' => esc_html__('Google Fonts On-demand', 'uncode-core') ,
			'desc' => esc_html__('Activate this to load Google Fonts on-demand only when needed by the specific modules you are using on a page.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_google_fonts_display_swap',
			'label' => esc_html__('Google Fonts Display Swap', 'uncode-core') ,
			'desc' => esc_html__('Activate this for faster rendering with possible flash of unstyled text (FOUT).', 'uncode-core'),
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		// array(
		// 	'id' => '_uncode_google_fonts_preload',
		// 	'label' => esc_html__('Google Fonts Preload', 'uncode-core') ,
		// 	'desc' => esc_html__('Activate this to preload Google Fonts improving page load.', 'uncode-core') ,
		// 	'std' => 'off',
		// 	'type' => 'on-off',
		// 	'section' => 'uncode_performance_section',
		// 	'condition' => '',
		// 	'operator' => 'and'
		// ) ,
		array(
			'id' => '_uncode_move_jquery_footer',
			'label' => esc_html__('Move jQuery to Footer', 'uncode-core') ,
			'desc' => esc_html__('Activate this to move jQuery to the footer (unless there are no other third-party scripts loaded to the head that has jQuery in its dependencies).', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_remove_wp_jquery_migrate',
			'label' => esc_html__('Disable jQuery Migrate', 'uncode-core') ,
			'desc' => esc_html__('Activate this to remove jQuery Migrate.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_remove_wp_emoji',
			'label' => esc_html__('Disable WP Emojis Script', 'uncode-core') ,
			'desc' => esc_html__('Activate this to remove native WordPress Emojis assets.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_remove_wp_embed_script',
			'label' => esc_html__('Disable WP Embed Script', 'uncode-core') ,
			'desc' => esc_html__('Activate this to remove native wp-embed.min.js script.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_remove_wp_block_style',
			'label' => esc_html__('Disable WP Gutenberg Style', 'uncode-core') ,
			'desc' => esc_html__('Activate this to remove the default Gutenberg Block style.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_disable_animations_mobile',
			'label' => esc_html__('Disable Animations on Mobile', 'uncode-core') ,
			'desc' => esc_html__('Activate this disable animations on mobile devices.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
		array(
			'id' => '_uncode_media_player',
			'label' => esc_html__('Disable MediaElement Player', 'uncode-core') ,
			'desc' => esc_html__('Activate this to use the browser\'s native media player instead of a Javascript framework.', 'uncode-core') ,
			'std' => 'on',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ,
	);

	if ( class_exists( 'WooCommerce' ) ) {
		$custom_settings_five[] = array(
			'id' => '_uncode_optimize_woocommerce_assets',
			'label' => esc_html__('Optimize WC assets', 'uncode-core') ,
			'desc' => esc_html__('Activate this to remove unused CSS/JS files from pages where no WooCommerce asset is used.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ;

		$custom_settings_five[] = array(
			'id' => '_uncode_remove_woocommerce_blocks_style',
			'label' => esc_html__('Disable WC Blocks Style', 'uncode-core') ,
			'desc' => esc_html__('Activate this to remove the default WooCommerce Blocks styles.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ;
	}

	if ( class_exists( 'WPCF7' ) ) {
		$custom_settings_five[] = array(
			'id' => '_uncode_optimize_cf7_assets',
			'label' => esc_html__('Optimize Contact Form 7 assets', 'uncode-core') ,
			'desc' => esc_html__('Activate this to remove unused CSS/JS files from pages where no Contact Form 7 asset is used.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ;
	}

	if ( class_exists( 'YITH_WCWL' ) ) {
		$custom_settings_five[] = array(
			'id' => '_uncode_optimize_yith_wishlist_assets',
			'label' => esc_html__('Optimize Wishlist assets', 'uncode-core') ,
			'desc' => esc_html__('Activate this to remove unused CSS/JS files from pages where no Wishlist asset is used.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ;
	}

	if ( class_exists( 'DWLS_Util' ) ) {
		$custom_settings_five[] = array(
			'id' => '_uncode_optimize_dwls_assets',
			'label' => esc_html__('Optimize Live Search assets', 'uncode-core') ,
			'desc' => esc_html__('Activate this to remove unused CSS/JS files from pages where no Live Search asset is used.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '',
			'operator' => 'and'
		) ;
	}

	if ( apply_filters( 'uncode_enable_ajax_filters_transients', false ) ) {
		$custom_settings_five[] = array(
			'id' => '_uncode_enable_ajax_filters_transients',
			'label' => esc_html__('Ajax Filters Transients', 'uncode-core') ,
			'desc' => esc_html__('Activate this to make transients and save queries in the database instead of executing them on each visit.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
		) ;

		$custom_settings_five[] = array(
			'id' => '_uncode_ajax_filters_transients_lifespan',
			'label' => esc_html__('Transients Lifespan', 'uncode-core') ,
			'desc' => esc_html__('Transients older than the specified lifespan will be deleted.', 'uncode-core'),
			'std' => '',
			'type' => 'select',
			'choices' => array(
				array(
					'value' => 'month',
					'label' => esc_html__('30 days', 'uncode-core') ,
				) ,
				array(
					'value' => 'week',
					'label' => esc_html__('7 days', 'uncode-core') ,
				) ,
				array(
					'value' => 'day',
					'label' => esc_html__('1 day', 'uncode-core') ,
				) ,
			),
			'section' => 'uncode_performance_section',
			'condition' => '_uncode_enable_ajax_filters_transients:is(on)',
		) ;

		$custom_settings_five[] = array(
			'id' => '_uncode_enable_ajax_filters_clear_after_post_update',
			'label' => esc_html__('Clear after post update', 'uncode-core') ,
			'desc' => esc_html__('Clear transients after a post is created, updated or deleted.', 'uncode-core') ,
			'std' => 'off',
			'type' => 'on-off',
			'section' => 'uncode_performance_section',
			'condition' => '_uncode_enable_ajax_filters_transients:is(on)',
		) ;

		if ( class_exists( 'WooCommerce' ) ) {
			$custom_settings_five[] = array(
				'id' => '_uncode_enable_ajax_filters_clear_after_order',
				'label' => esc_html__('Clear after order', 'uncode-core') ,
				'desc' => esc_html__('Clear transients after an order is placed in your store.', 'uncode-core') ,
				'std' => 'off',
				'type' => 'on-off',
				'section' => 'uncode_performance_section',
				'condition' => '_uncode_enable_ajax_filters_transients:is(on)',
			) ;

			$custom_settings_five[] = array(
				'id' => '_uncode_enable_ajax_filters_clear_after_review',
				'label' => esc_html__('Clear after review', 'uncode-core') ,
				'desc' => esc_html__('Clear transients after a product review.', 'uncode-core') ,
				'std' => 'off',
				'type' => 'on-off',
				'section' => 'uncode_performance_section',
				'condition' => '_uncode_enable_ajax_filters_transients:is(on)',
			) ;
		}
	}

	$custom_settings_five[] = array(
		'id' => '_uncode_htaccess',
		'label' => esc_html__('Apache Server Configs', 'uncode-core') ,
		'desc' => esc_html__('Activate the enhanced .htaccess, this will improve the web site\'s performance and security.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_performance_section',
		'condition' => '',
		'operator' => 'and'
	);

	$custom_settings_five[] = array(
		'id' => '_uncode_production',
		'label' => esc_html__('Production mode', 'uncode-core') ,
		'desc' => esc_html__('Activate this to switch to production mode, the CSS and JS will be cached by the browser and the JS minified.', 'uncode-core') ,
		'std' => 'off',
		'type' => 'on-off',
		'section' => 'uncode_performance_section',
		'condition' => '',
		'operator' => 'and'
	);

	$custom_settings_one = array_merge( $custom_settings_one, $custom_settings_three );
	if ( class_exists( 'WooCommerce' ) ) {
		$custom_settings_one = array_merge( $custom_settings_one, $woocommerce_settings );
	}
	$custom_settings_one = array_merge( $custom_settings_one, $extra_settings );
	$custom_settings_one = array_merge( $custom_settings_one, $custom_settings_five );

	$custom_settings = array(
		'sections' => $custom_settings_section_one,
		'settings' => $custom_settings_one,
	);

	if (class_exists('WooCommerce'))
	{

		$woo_section = array(
			// array(
			// 	'id' => 'uncode_woocommerce_section',
			// 	'title' => '<i class="fa fa-shopping-cart"></i> ' . esc_html__('WooCommerce', 'uncode-core')
			// ),
			array(
				'id' => 'uncode_product_section',
				'title' => '<span class="smaller"><i class="fa fa-paper"></i> ' . esc_html__('Product', 'uncode-core') . '</span>',
				'group' => esc_html__('Single', 'uncode-core'),
			) ,
			array(
				'id' => 'uncode_product_index_section',
				'title' => '<span class="smaller"><i class="fa fa-archive2"></i> ' . esc_html__('Products', 'uncode-core') . '</span>',
				'group' => esc_html__('Archives', 'uncode-core'),
			) ,
		);

		$woocommerce_post = array(
			/////////////////////////
			//  Product Single		///
			/////////////////////////
			uncode_core_replace_section_id('product', $menu_section_title),
			uncode_core_replace_section_id('product', $menu),
			uncode_core_replace_section_id('product', $menu_width),
			uncode_core_replace_section_id('product', $menu_opaque),
			uncode_core_replace_section_id('product', $header_section_title),
			uncode_core_replace_section_id('product', $header_type),
			uncode_core_replace_section_id('product', $header_uncode_block),
			uncode_core_replace_section_id('product', $header_revslider),
			uncode_core_replace_section_id('product', $header_layerslider),

			uncode_core_replace_section_id('product', $header_width),
			uncode_core_replace_section_id('product', $header_height),
			uncode_core_replace_section_id('product', $header_min_height),
			uncode_core_replace_section_id('product', $header_title),
			uncode_core_replace_section_id('product', $header_style),
			uncode_core_replace_section_id('product', $header_content_width),
			uncode_core_replace_section_id('product', $header_custom_width),
			uncode_core_replace_section_id('product', $header_align),
			uncode_core_replace_section_id('product', $header_position),
			uncode_core_replace_section_id('product', $header_title_font),
			uncode_core_replace_section_id('product', $header_title_size),
			uncode_core_replace_section_id('product', $header_title_height),
			uncode_core_replace_section_id('product', $header_title_spacing),
			uncode_core_replace_section_id('product', $header_title_weight),
			uncode_core_replace_section_id('product', $header_title_transform),
			uncode_core_replace_section_id('product', $header_title_italic),
			uncode_core_replace_section_id('product', $header_text_animation),
			uncode_core_replace_section_id('product', $header_animation_speed),
			uncode_core_replace_section_id('product', $header_animation_delay),
			uncode_core_replace_section_id('product', $header_featured),
			uncode_core_replace_section_id('product', $header_background),
			uncode_core_replace_section_id('product', $header_parallax),
			uncode_core_replace_section_id('product', $header_kburns),
			uncode_core_replace_section_id('product', $header_overlay_color),
			uncode_core_replace_section_id('product', $header_overlay_color_alpha),
			uncode_core_replace_section_id('product', $header_scroll_opacity),
			uncode_core_replace_section_id('product', $header_scrolldown),
			uncode_core_replace_section_id('product', $menu_no_padding),
			uncode_core_replace_section_id('product', $menu_no_padding_mobile),
			uncode_core_replace_section_id('product', $body_section_title),
			uncode_core_replace_section_id('product', $body_uncode_select_content_product),
			uncode_core_replace_section_id('product', run_array_to($body_uncode_block_single, 'condition', '_uncode_product_select_content:is(uncodeblock)')),
			uncode_core_replace_section_id('product', run_array_to($body_layout_width, 'condition', '_uncode_product_select_content:is()')),
			uncode_core_replace_section_id('product', run_array_to($body_layout_width_custom, 'condition', '_uncode_product_select_content:is(),_uncode_product_layout_width:is(limit)')),
			uncode_core_replace_section_id('product', run_array_to($show_breadcrumb, 'condition', '_uncode_product_select_content:is()')),
			uncode_core_replace_section_id('product', run_array_to($breadcrumb_align, 'condition', '_uncode_product_select_content:is(),_uncode_product_breadcrumb:is(on)')),
			uncode_core_replace_section_id('product', run_array_to($show_title, 'condition', '_uncode_product_select_content:is()')),
			uncode_core_replace_section_id('product', run_array_to($show_share, 'condition', '_uncode_product_select_content:is()')),
			uncode_core_replace_section_id('product', run_array_to($image_layout, 'condition', '_uncode_product_select_content:is()')),
			uncode_core_replace_section_id('product', run_array_to($media_size, 'condition', '_uncode_product_select_content:is()')),
			uncode_core_replace_section_id('product', $enable_sticky_desc),
			uncode_core_replace_section_id('product', $enable_woo_zoom),
			uncode_core_replace_section_id('product', run_array_to($thumb_cols, 'condition', '_uncode_product_select_content:is(),_uncode_product_image_layout:is()')),
			uncode_core_replace_section_id('product', $enable_woo_slider),
			uncode_core_replace_section_id('product', $body_uncode_block_after),
			uncode_core_replace_section_id('product', $navigation_section_title),
			uncode_core_replace_section_id('product', $navigation_activate),
			uncode_core_replace_section_id('product', $navigation_content_block),
			uncode_core_replace_section_id('product', $navigation_page_index),
			uncode_core_replace_section_id('product', $navigation_index_label),
			uncode_core_replace_section_id('product', $navigation_nextprev_title),
			uncode_core_replace_section_id('product', $footer_section_title),
			uncode_core_replace_section_id('product', $footer_uncode_block),
			uncode_core_replace_section_id('product', $footer_width),
			uncode_core_replace_section_id('product', $custom_fields_section_title),
			uncode_core_replace_section_id('product', $custom_fields_list),
			/////////////////////////
			//  Products Index		///
			/////////////////////////
			uncode_core_replace_section_id('product_index', $menu_section_title),
			uncode_core_replace_section_id('product_index', $menu),
			uncode_core_replace_section_id('product_index', $menu_width),
			uncode_core_replace_section_id('product_index', $menu_opaque),
			uncode_core_replace_section_id('product_index', $header_section_title),
			uncode_core_replace_section_id('product_index', run_array_to($header_type, 'std', 'header_basic')),
			uncode_core_replace_section_id('product_index', $header_uncode_block),
			uncode_core_replace_section_id('product_index', $header_revslider),
			uncode_core_replace_section_id('product_index', $header_layerslider),

			uncode_core_replace_section_id('product_index', $header_width),
			uncode_core_replace_section_id('product_index', $header_height),
			uncode_core_replace_section_id('product_index', $header_min_height),
			uncode_core_replace_section_id('product_index', $header_title),
			uncode_core_replace_section_id('product_index', $header_style),
			uncode_core_replace_section_id('product_index', $header_content_width),
			uncode_core_replace_section_id('product_index', $header_custom_width),
			uncode_core_replace_section_id('product_index', $header_align),
			uncode_core_replace_section_id('product_index', $header_position),
			uncode_core_replace_section_id('product_index', $header_title_font),
			uncode_core_replace_section_id('product_index', $header_title_size),
			uncode_core_replace_section_id('product_index', $header_title_height),
			uncode_core_replace_section_id('product_index', $header_title_spacing),
			uncode_core_replace_section_id('product_index', $header_title_weight),
			uncode_core_replace_section_id('product_index', $header_title_transform),
			uncode_core_replace_section_id('product_index', $header_title_italic),
			uncode_core_replace_section_id('product_index', $header_text_animation),
			uncode_core_replace_section_id('product_index', $header_animation_speed),
			uncode_core_replace_section_id('product_index', $header_animation_delay),
			uncode_core_replace_section_id('product_index', $header_featured),
			uncode_core_replace_section_id('product_index', $header_background),
			uncode_core_replace_section_id('product_index', $header_parallax),
			uncode_core_replace_section_id('product_index', $header_kburns),
			uncode_core_replace_section_id('product_index', $header_overlay_color),
			uncode_core_replace_section_id('product_index', $header_overlay_color_alpha),
			uncode_core_replace_section_id('product_index', $header_scroll_opacity),
			uncode_core_replace_section_id('product_index', $header_scrolldown),
			uncode_core_replace_section_id('product_index', $menu_no_padding),
			uncode_core_replace_section_id('product_index', $menu_no_padding_mobile),
			uncode_core_replace_section_id('product_index', $title_archive_custom_activate),
			uncode_core_replace_section_id('product_index', $title_archive_custom_text),
			uncode_core_replace_section_id('product_index', $subtitle_archive_custom_text),

			uncode_core_replace_section_id('product_index', $body_section_title),
			uncode_core_replace_section_id('product_index', $show_breadcrumb),
			uncode_core_replace_section_id('product_index', $breadcrumb_align),
			uncode_core_replace_section_id('product_index', $body_uncode_block),
			uncode_core_replace_section_id('product_index', run_array_to($body_layout_width, 'condition', '_uncode_product_index_content_block:is(),_uncode_product_index_content_block:is(none)')),
			uncode_core_replace_section_id('product_index', $body_single_post_width),
			uncode_core_replace_section_id('product_index', run_array_to($show_title, 'condition', '_uncode_product_index_content_block:is(),_uncode_product_index_content_block:is(none)')),
			uncode_core_replace_section_id('product_index', $remove_pagination),
			uncode_core_replace_section_id('product_index', $products_per_page),
			uncode_core_replace_section_id('product_index', $sidebar_section_title),
			uncode_core_replace_section_id('product_index', run_array_to($sidebar_activate, 'std', 'on')),
			uncode_core_replace_section_id('product_index', $sidebar_widget),
			uncode_core_replace_section_id('product_index', $sidebar_position),
			uncode_core_replace_section_id('product_index', $sidebar_size),
			uncode_core_replace_section_id('product_index', $sidebar_sticky),
			uncode_core_replace_section_id('product_index', $sidebar_style),
			uncode_core_replace_section_id('product_index', $sidebar_bgcolor),
			uncode_core_replace_section_id('product_index', $sidebar_fill),
			// uncode_core_replace_section_id('product_index', $sidebar_widget_collapse),
			// uncode_core_replace_section_id('product_index', $sidebar_widget_collapse_tablet),
			uncode_core_replace_section_id('product_index', $footer_section_title),
			uncode_core_replace_section_id('product_index', $footer_uncode_block),
			uncode_core_replace_section_id('product_index', $footer_width),
		);

		$custom_settings['sections'] = array_merge( $custom_settings['sections'], $woo_section );
		// array_push($custom_settings['settings'], $woocommerce_cart_icon);
		// array_push($custom_settings['settings'], $woocommerce_hooks);
		$custom_settings['settings'] = array_merge( $custom_settings['settings'], $woocommerce_post );

	}

	$custom_settings['settings'] = array_filter( $custom_settings['settings'], 'uncode_is_not_null' );

	/* allow settings to be filtered before saving */
	$custom_settings = apply_filters(ot_settings_id() . '_args', $custom_settings);

	/* settings are not the same update the DB */
	if ($saved_settings !== $custom_settings)
	{
		update_option(ot_settings_id() , $custom_settings, false);
	}

	/**
	 * Filter on layout images.
	 */
	function filter_layout_radio_images($array, $layout)
	{

		/* only run the filter where the field ID is my_radio_images */
		if ($layout == '_uncode_headers')
		{
			$array = array(
				array(
					'value' => 'hmenu-right',
					'label' => esc_html__('Right', 'uncode-core') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-right.jpg'
				) ,
				array(
					'value' => 'hmenu-justify',
					'label' => esc_html__('Justify', 'uncode-core') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-justify.jpg'
				) ,
				array(
					'value' => 'hmenu-left',
					'label' => esc_html__('Left', 'uncode-core') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-left.jpg'
				) ,
				array(
					'value' => 'hmenu-center',
					'label' => esc_html__('Center', 'uncode-core') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-center.jpg'
				) ,
				array(
					'value' => 'hmenu-center-split',
					'label' => esc_html__('Center Split', 'uncode-core') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-splitted.jpg'
				) ,
				array(
					'value' => 'hmenu-center-double',
					'label' => esc_html__('Center Double', 'uncode-core') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/hmenu-center-double.jpg'
				) ,
				array(
					'value' => 'vmenu',
					'label' => esc_html__('Lateral', 'uncode-core') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/vmenu.jpg'
				) ,
				array(
					'value' => 'vmenu-offcanvas',
					'label' => esc_html__('Off Canvas', 'uncode-core') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/offcanvas.jpg'
				) ,
				array(
					'value' => 'menu-overlay',
					'label' => esc_html__('Overlay', 'uncode-core') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/overlay.jpg'
				) ,
				array(
					'value' => 'menu-overlay-center',
					'label' => esc_html__('Overlay Center', 'uncode-core') ,
					'src' => get_template_directory_uri() . '/core/assets/images/layout/overlay-center.jpg'
				) ,
			);
		}
		return $array;
	}
	add_filter('ot_radio_images', 'filter_layout_radio_images', 10, 2);
}
