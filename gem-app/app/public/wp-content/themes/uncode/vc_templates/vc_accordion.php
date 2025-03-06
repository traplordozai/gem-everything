<?php
$output = $title = $interval = $history = $target = $el_id = $el_class = $collapsible = $active_tab = $history = $sign = $history_tab = $typography = $titles_font = $titles_size = $titles_weight = $titles_transform = $titles_height = $titles_space = $active_bg_color = $active_bg_color_type = $active_bg_color_solid = $active_bg_color_gradient = $active_txt_color = $active_txt_color_type = $active_txt_color_solid = $active_txt_color_gradient = $radius = $shadow = $shadow_darker = $panel_event = $gutter_simple = $content_border = $title_padding = $no_lazy = $no_toggle = '';

global $history_tab;

extract(shortcode_atts(array(
	'uncode_shortcode_id' => '',
	'title' => '',
	'interval' => 0,
	'history' => '',
	'target' => '',
	'el_id' => '',
	'el_class' => '',
	'collapsible' => 'no',
	'active_tab' => '1',
	'radius' => '',
	'shadow' => '',
	'shadow_darker' => '',
	'panel_event' => '',
	'history' => '',
	'sign' => '',
	'sign_size' => '',
	'typography' => '',
	'label_border' => '',
	'content_border' => '',
	'title_padding' => '',
	'titles_font' => '',
	'titles_size' => '',
	'heading_custom_size' => '',
	'titles_weight' => '',
	'titles_transform' => '',
	'titles_height' => '',
	'titles_space' => '',
	'active_bg_color' => '',
	'active_bg_color_type' => 'uncode-palette',
	'active_bg_color_solid' => '',
	'active_bg_color_gradient' => '',
	'active_txt_color' => '',
	'active_txt_color_type' => 'uncode-palette',
	'active_txt_color_solid' => '',
	'active_txt_color_gradient' => '',
	'gutter_simple' => '',
	'no_h_padding' => '',
	'no_lazy' => '',
	'no_toggle' => '',
) , $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$history_tab = $history;

global $tab_titles_typography;
$tab_titles_typography = array(
	'uncode_shortcode_id' => $uncode_shortcode_id,
	'titles_font' => $titles_font,
	'titles_size' => $titles_size,
	'heading_custom_size' => $heading_custom_size,
	'titles_weight' => $titles_weight,
	'titles_transform' => $titles_transform,
	'titles_height' => $titles_height,
	'titles_space' => $titles_space
);

$el_unique_id = 'accordion_' . rand();
preg_match_all('/vc_accordion_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE);
$accordion_tab = array();
if (isset($matches[0])) {
	$accordion_tab = $matches[0];
}
$counter = 1;
foreach ($accordion_tab as $tab) {
	if ($counter == $active_tab) {
		$content = str_replace($tab[0], $tab[0] . ' id="' . esc_attr( $el_unique_id ) . '" active="1"', $content);
	} else {
		$content = str_replace($tab[0], $tab[0] . ' id="' . esc_attr( $el_unique_id ) . '"', $content);
	}
	$counter++;
}

$el_class = $this->getExtraClass($el_class);

$el_class .= ( $sign !== '' ) ? ' ' . $sign . '-signed' : '';
$el_class .= ' sign-size-' . esc_attr($sign_size ? $sign_size : 'rg');

$el_class .= ( $typography !== '' ) ? ' default-typography' : '';
$el_class .= ( $label_border !== 'yes' ) ? ' w-border' : '';
$el_class .= ( $content_border === 'yes' ) ? ' no-content-border' : '';
$el_class .= ( $title_padding === 'yes' ) ? ' no-title-margin' : '';

global $parent_panel_class, $panel_a_class;

$parent_panel_class = $radius !== '' ? ' unradius-' . $radius : '';
$panel_a_class = '';

if ($shadow !== '') {

	if ( $shadow_darker !== '' ) {
		$shadow = 'darker-' . $shadow;
	}
	$parent_panel_class .= ' unshadow-' . $shadow;
}

switch ($gutter_simple) {
	case 0:
		$parent_panel_class .= ' no-block-padding';
	break;
	case 1:
		$parent_panel_class .= ' single-block-padding has-padding';
		$panel_a_class = 'single-block-padding no-h-padding';
	break;
	case 2:
		$parent_panel_class .= ' double-block-padding has-padding';
		$panel_a_class = 'double-block-padding no-h-padding';
	break;
}

if ( $no_h_padding === 'yes' ) {
	$parent_panel_class .= ' no-h-padding';
}

$inline_style_css = uncode_get_dynamic_colors_css_from_shortcode( array(
	'type'       => 'vc_tabs',
	'id'         => $uncode_shortcode_id,
	'attributes' => array(
		'active_bg_color' => $active_bg_color,
		'active_bg_color_type' => $active_bg_color_type,
		'active_bg_color_solid' => $active_bg_color_solid,
		'active_bg_color_gradient' => $active_bg_color_gradient,
		'active_txt_color' => $active_txt_color,
		'active_txt_color_type' => $active_txt_color_type,
		'active_txt_color_solid' => $active_txt_color_solid,
		'active_txt_color_gradient' => $active_txt_color_gradient,
	)
) );

if ( $titles_size === 'custom' && $heading_custom_size !== '' ) {
	$inline_style_css .= uncode_get_dynamic_css_font_size_shortcode( array(
		'id'         => $uncode_shortcode_id,
		'font_size'  => $heading_custom_size
	) );
}

global $acc_tab_active_bg_color, $acc_tab_active_txt_color;
$acc_tab_active_bg_color = uncode_get_shortcode_color_attribute_value( 'active_bg_color', $uncode_shortcode_id, $active_bg_color_type, $active_bg_color, $active_bg_color_solid, $active_bg_color_gradient );
$acc_tab_active_txt_color = uncode_get_shortcode_color_attribute_value( 'active_txt_color', $uncode_shortcode_id, $active_txt_color_type, $active_txt_color, $active_txt_color_solid, $active_txt_color_gradient );

$data_classes = array();
$data_classes_str = '';
if (!empty($acc_tab_active_bg_color)) {
	$data_classes[] = 'style-' . $acc_tab_active_bg_color . '-bg';
}

if (!empty($acc_tab_active_txt_color)) {
	$data_classes[] = 'text-' . $acc_tab_active_txt_color . '-color';
}

if ( ( !empty($data_classes) || $parent_panel_class !== '' ) && function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
	$data_classes_str = ' data-classes="' . esc_attr(trim(implode(' ' , $data_classes))) . ' ' . $parent_panel_class . '"';
}
if ( $panel_a_class !== '' ) {
	$data_classes_str .= ' data-a-classes="' . $panel_a_class . '"';
}

if( $panel_event !== '' ) {
	$el_class .= ' tabs-trigger-' . esc_attr( $panel_event );
}

if ( $no_lazy === 'yes' ) {
	$el_class .= ' tabs-no-lazy';
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-accordion wpb_accordion wpb_content_element ' . $el_class, $this->settings['base'], $atts);

$output = '<div class="' . esc_attr(trim($css_class)) . '" data-collapsible="' . esc_attr( $collapsible ) . '" data-target="' . esc_attr( $target ) . '" data-active-tab="' . esc_attr( $active_tab ) . '"' . $data_classes_str . ' ' . $el_id . '>
		<div class="panel-group wpb_wrapper wpb_accordion_wrapper" id="' . esc_attr( $el_unique_id ) . '" role="tablist" aria-multiselectable="true" data-no-toggle="' . esc_attr( $no_toggle === 'yes' ) . '">
' . wpb_widget_title( array(
	'title' => $title,
	'extraclass' => 'wpb_accordion_heading',
) ) . '
' . $content . '
		</div>';
		$output .= uncode_print_dynamic_inline_style( $inline_style_css );
		$output .= '</div>';

echo uncode_remove_p_tag($output);
$parent_panel_class = $panel_a_class = $history_tab = $acc_tab_active_bg_color = $acc_tab_active_txt_color = '';
