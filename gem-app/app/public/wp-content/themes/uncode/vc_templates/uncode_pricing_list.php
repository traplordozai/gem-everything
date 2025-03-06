<?php
$el_id = $el_class = $values = $css_animation = $animation_delay = $animation_speed = $heading_semantic = $text_font = $text_size = $heading_custom_size = $text_weight = $text_transform = $text_height = $text_space = $text_italic = $gutter_tab_h = $tab_gap = $v_align = $border_style = $border_color = $border_color_type = $border_color_solid = $sub_lead = $media_ratio = $shape = $img_radius = $media_break = $media_max_width = '';
extract(shortcode_atts(array(
	'uncode_shortcode_id' => '',
	'values' => '%5B%7B%22entry%22%3A%22Cosmopolitan%22%2C%22value%22%3A%22%2410%22%7D%2C%7B%22entry%22%3A%22Daiquiri%22%2C%22value%22%3A%22%2412%22%7D%2C%7B%22entry%22%3A%22Negroni%22%2C%22value%22%3A%22%249%22%7D%2C%7B%22entry%22%3A%22Margarita%22%2C%22value%22%3A%22%2411%22%7D%5D',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'el_id' => '',
	'el_class' => '',
	'text_color' => '',
	'text_color_type' => '',
	'text_color_solid' => '',
	'text_color_gradient' => '',
    'heading_semantic' => 'h2',
    'text_font' => '',
    'text_size' => 'h2',
    'heading_custom_size' => '',
    'text_weight' => '',
    'text_transform' => '',
    'text_height' => '',
    'text_space' => '',
    'text_italic' => '',
	'gutter_tab_h' => '2',
	'tab_gap' => '2',
	'media_width_use_pixel' => '',
	'media_width_percent' => 33,
	'media_width_pixel' => '',
	'media_ratio' => '',
	'shape' => '',
	'img_radius' => '',
	'v_align' => 'middle',
	'border_style' => '',
	'border_color' => '',
	'border_color_type' => '',
	'border_color_solid' => '',
 	'sub_lead' => '',
	'media_break' => '',
	'media_max_width' => '',
) , $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$entry_class = array('uncode-pricing-entry');

$el_class = $this->getExtraClass( $el_class );

if ($css_animation !== '' && uncode_animations_enabled()) {
	$entry_class[] = 'animate_when_almost_visible ' . $css_animation;
}

if ( $media_break !== '' ) {
	$entry_class[] = 'pricing-list-break-' . esc_attr($media_break);
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode_pricing_list wpb_content_element' . $el_class, $this->settings['base'], $atts );

$output = '<div class="' . esc_attr($css_class) . '" '  . $el_id . '>';

$head_classes = array('uncode-pricing-heading');

$inline_style_css = uncode_get_dynamic_colors_css_from_shortcode( array(
	'type'       => 'uncode_pricing_list',
	'id'         => $uncode_shortcode_id,
	'attributes' => array(
		'text_color'             => $text_color,
		'text_color_type'        => $text_color_type,
		'text_color_solid'       => $text_color_solid,
		'text_color_gradient'    => $text_color_gradient,
		'border_color'           => $border_color,
		'border_color_type'      => $border_color_type,
		'border_color_solid'     => $border_color_solid,
		'border_color_gradient'  => false,
	)
) );

$text_color = uncode_get_shortcode_color_attribute_value( 'text_color', $uncode_shortcode_id, $text_color_type, $text_color, $text_color_solid, $text_color_gradient );
$border_color = uncode_get_shortcode_color_attribute_value( 'border_color', $uncode_shortcode_id, $border_color_type, $border_color, $border_color_solid, false );

if ( $text_size === 'custom' && $heading_custom_size !== '' ) {
	$inline_style_css .= uncode_get_dynamic_css_font_size_shortcode( array(
		'id'         => $uncode_shortcode_id,
		'font_size'  => $heading_custom_size
	) );
}

$head_classes_in = array();

if ($text_font !== '') {
	$head_classes_in[] = $text_font;
}

if ($text_size !== '') {
	$head_classes_in[] = $text_size;
}
if ($text_height !== '') {
	$head_classes_in[] = $text_height;
}
if ($text_space !== '') {
	$head_classes_in[] = $text_space;
}
if ($text_weight !== '') {
	$head_classes_in[] = 'font-weight-' . $text_weight;
}
if ($text_transform !== '') {
	$head_classes_in[] = 'text-' . $text_transform;
}
if ($text_color !== '') {
	$head_classes_color = 'text-' . $text_color . '-color';
}
if ($text_size === 'custom' && $heading_custom_size !== '') {
	$head_classes_in[] = 'fontsize-' . $uncode_shortcode_id . '-custom';
}

$values = (array) vc_param_group_parse_atts( $values );
$graph_lines_data = array();
foreach ( $values as $data ) {
	$new_line = $data;
	$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
	$new_line['entry'] = isset( $data['entry'] ) ? $data['entry'] : '';

	$graph_lines_data[] = $new_line;
}

$media_class = '';
switch ($gutter_tab_h) {
	case 0:
		$media_class = ' no-gutter';
	break;
	case 1:
		$media_class = ' half-gutter';
	break;
	case 3:
		$media_class = ' double-gutter';
	break;
	case 2:
	default:
		$media_class = ' single-gutter';
	break;
}

switch ($tab_gap) {
	case 0:
		$entry_class[] = 'no-space';
	break;
	case 1:
		$entry_class[] = 'half-space';
	break;
	case 2:
		$entry_class[] = 'single-space';
	break;
	case 3:
		$entry_class[] = 'double-space';
	break;
	case 4:
		$entry_class[] = 'triple-space';
	break;
	case 5:
		$entry_class[] = 'quad-space';
	break;
}

if ($sub_lead === 'yes') {
	$sub_lead = ' text-lead';
} else if ($sub_lead === 'small') {
	$sub_lead = ' text-small';
}


$entry_class[] = 'v-align-' . esc_attr( $v_align );

foreach ( $graph_lines_data as $key => $line ) {
	$div_data = array();
	if ($css_animation !== '' && uncode_animations_enabled()) {
		if ($animation_delay === '') {
			$animation_delay = 0;
		}
		$div_data['data-delay'] = $animation_delay;
		$animation_delay += 50;

		if ($animation_speed !== '') {
			$div_data['data-speed'] = $animation_speed;
		}
	}
	
	$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

    $disabled_class = isset( $line['disabled'] ) && $line['disabled'] === 'yes' ? ' disabled' : '';

	$output .= '<div class="'.esc_attr(trim(implode(' ', $entry_class))). $disabled_class .' list-entry-' . esc_attr( $key ) . '"' . implode(' ', $div_data_attributes) . '>';

	if ( $disabled_class === '' && isset($head_classes_color) ) {
		$head_classes_color_dis = ' ' . $head_classes_color;
	} else {
		$head_classes_color_dis = '';
	}
	if ( isset($line['media']) && $line['media'] !== '' ) {
		$block_data = array();
		$block_data['text_padding'] = 'no-block-padding';
		$block_data['template'] = 'inline-image';
		$block_data['media_id'] = $line['media'];
		$block_data['single_width'] = 12;
		$block_data['images_size'] = $media_ratio !== '' ? $media_ratio : '';
		$block_classes = array('tmb-media');
		if ( $shape !== '' ) {
			$block_classes[] = $shape;
			if ( $img_radius !== ''  && $shape === 'img-round' ) {
				$block_classes[] = 'img-round-' . $img_radius;
			} 
		}
		$block_data['classes'] = $block_classes;

		$media_code = uncode_create_single_block($block_data, rand(), 'inline-image', array('media' => array()), array(), '');

		$media_alt = (isset($media_code['alt'])) ? $media_code['alt'] : '';
		
		$output_media = $media_code;

		if ( $media_width_use_pixel == 'yes' ) {
			if ( $media_width_pixel > 0 && is_numeric( $media_width_pixel ) ) {
				$style_media = esc_attr($media_width_pixel) . 'px';
			} else {
				$style_media = esc_attr($media_width_pixel);
			}
		} else {
			$style_media = esc_attr($media_width_percent) . '%';
		}

		if ( $media_break !== '' && $media_max_width !== '' ) {
			if ( $media_max_width > 0 && is_numeric( $media_max_width ) ) {
				$_media_max_width = esc_attr($media_max_width) . 'px';
			} else {
				$_media_max_width = esc_attr($media_max_width);
			}
			$style_media .= '; max-width: ' . $_media_max_width;
		}

		$output .= '<div class="uncode-pricing-entry-media' . $media_class . '" style="width: ' . $style_media . '">' . $output_media . '</div>';
	}
	$output .= '<div class="uncode-pricing-entry-text">';
	$output .= '<div class="'.esc_attr(trim(implode(' ', $head_classes))) . '">';
	$output .= '<' . $heading_semantic . ' class="uncode-pricing-entry-item uncode-pricing-entry-label '.esc_attr(trim(implode(' ', $head_classes_in))) . $head_classes_color_dis . '"><span>';
	if ($text_italic === 'yes') {
		$output .= '<i>';
	}
	$output .= $line['entry'];
	if ($text_italic === 'yes') {
		$output .= '</i>';
	}
	$output .= '</span></' . $heading_semantic . '>';
	if ($border_style === '') {
		$border_style = 'none';
	} elseif ($border_style === 'double') {
		$border_style .= '; border-bottom-width: 3px';
	}
	$border_class = ' ui-br';
	// if ($disabled_class === '' && $border_color !== '') {
	if ( $border_color !== '' ) {
			$border_class = ' border-' . $border_color . '-color';
	}
	
	$output .= '<div class="uncode-pricing-entry-separator' . esc_attr($border_class) . '" style="border-bottom-style:' . esc_attr($border_style) . '"></div>';
    $output .= '<div class="uncode-pricing-entry-value headings-style headings-color '.esc_attr(trim(implode(' ', $head_classes_in))) . $head_classes_color_dis . '">' . $line['value'] . '</div>';
	$output .= '</div>';
	if ( isset($line['text']) && $line['text'] !== '' ) {
		$output .= '<div class="uncode-pricing-entry-text-inner' . $sub_lead . '">' . wpautop( $line['text'] ) . '</div>';
	}
	$output .= '</div>';
	$output .= '</div>';
}

$output .= uncode_print_dynamic_inline_style( $inline_style_css );
$output .= '</div>';

echo uncode_remove_p_tag($output);
