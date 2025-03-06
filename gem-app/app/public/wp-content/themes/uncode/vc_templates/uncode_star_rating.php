<?php
$el_id = $el_class = $css_animation = $animation_delay = $animation_speed = $rate = $text_size = $custom_size = $text = $sub_lead = $display = $text_display = '';
extract(shortcode_atts(array(
	'uncode_shortcode_id' => '',
    'rate' => 4.5,
	'text_color' => '',
	'text_color_type' => '',
	'text_color_solid' => '',
	'text_color_gradient' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
    'text_size' => 'custom',
    'custom_size' => '',
    'text' => '',
    'sub_lead' => '',
    'display' => '',
    'text_display' => '',
	'el_id' => '',
	'el_class' => '',
) , $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$el_class = $this->getExtraClass( $el_class );

$el_class = array( $el_class );

$inline_style_css = uncode_get_dynamic_colors_css_from_shortcode( array(
	'type'       => 'uncode_star_rating',
	'id'         => $uncode_shortcode_id,
	'attributes' => array(
		'text_color'             => $text_color,
		'text_color_type'        => $text_color_type,
		'text_color_solid'       => $text_color_solid,
		'text_color_gradient'    => $text_color_gradient,
	)
) );

if ( $text_size === 'custom' && $custom_size !== '' ) {
	$inline_style_css .= uncode_get_dynamic_css_font_size_shortcode( array(
		'id'         => $uncode_shortcode_id,
		'font_size'  => $custom_size
	) );
}

$text_color = uncode_get_shortcode_color_attribute_value( 'text_color', $uncode_shortcode_id, $text_color_type, $text_color, $text_color_solid, $text_color_gradient );

$un_star_class = array( 'uncode-star-rating' );
$star_class = array();
if ($text_color !== '') {
	$star_class[] = 'text-' . $text_color . '-color';
}

if ($text_size !== '') {
	$un_star_class[] = $text_size;
    if ($text_size === 'custom' && $custom_size !== '') {
        $un_star_class[] = 'fontsize-' . $uncode_shortcode_id . '-custom';
    }
}

$display = $display === '' ? 'block' : $display;
$el_class[] = 'display-' . esc_attr( $display );

if ($css_animation !== '' && uncode_animations_enabled()) {
	$el_class[] = 'animate_when_almost_visible ' . $css_animation;
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode_star_rating wpb_content_element ' . esc_attr(trim(implode(' ', $el_class))), $this->settings['base'], $atts );

$rate = str_replace(",",".",$rate);
$rate_w = $rate / 5 * 100;

$output = '<div class="' . esc_attr($css_class) . '" '  . $el_id . '>';
$output .= '<div class="' . esc_attr(trim(implode(' ', $un_star_class))) . '">';
$output .= '<span class="' . esc_attr(trim(implode(' ', $star_class))) . '" style="width:' . esc_attr( $rate_w ) . '%"></span>';
$output .= '</div>';
if ( $text !== '' ) {
    $star_txt_class = '';
    if ($sub_lead === 'yes') {
        $star_txt_class = ' text-lead';
    } else if ($sub_lead === 'small') {
        $star_txt_class = ' text-small';
    }
    $star_txt_class .= $text_display === '' ? ' display-block' : ' display-' . $text_display;

    $output .= '<span class="uncode-star-rating-text' . $star_txt_class . '">' . wp_kses_post( $text ) . '</span>';
}
$output .= uncode_print_dynamic_inline_style( $inline_style_css );
$output .= '</div>';

echo uncode_remove_p_tag($output);
