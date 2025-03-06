<?php
$uncode_shortcode_id = $el_id = $el_class = $json = $trigger = $no_loop = $autoplay = $loop = $speed = $frame_from = $frame_to = $media_width_use_pixel = $media_width_pixel = $media_width_percent = $css_animation = $animation_delay = $animation_speed = $wrapper_class = $alignment = '';

extract(shortcode_atts(array(
	'uncode_shortcode_id' => '',
	'json' => '',
	'trigger' => '',
	'no_loop' => '',
	'speed' => 10,
	'frame_from' => 0,
	'frame_to' => 100,
	'media_width_use_pixel' => '',
	'media_width_pixel' => '',
	'media_width_percent' => '100',
	'alignment' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'el_id' => '',
	'el_class' => '',
) , $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
	$player_id = 'player_' . esc_attr( trim( $el_id ) );
} else {
	$el_id = ' id="uncode_lottie_' . esc_attr( $uncode_shortcode_id ) . '"';
	$player_id = 'player_' . esc_attr( $uncode_shortcode_id );
}

if ( $trigger === '' ) {
	$autoplay = 'autoplay';
} else {
	$autoplay = 'data-trigger="' . esc_attr($trigger) . '"';
}

if ( $no_loop === '' ) {
	$loop = 'loop';
}

$frames = floatval( $frame_from ) . ',' . floatval ( $frame_to );

if ($media_width_use_pixel === 'yes' && $media_width_pixel !== '') {
	$media_width = preg_replace("/[^0-9,.]/", "", $media_width_pixel);
	$actual_width = $media_width . 'px';
} else {
	$media_width = preg_replace("/[^0-9,.]/", "", $media_width_percent);
	$actual_width = $media_width . '%';
}

$div_data = array();
if ($css_animation !== '' && uncode_animations_enabled()) {
	$wrapper_class = ' animate_when_almost_visible ' . $css_animation;
	if ($animation_delay !== '') {
		$div_data['data-delay'] = $animation_delay;
	}
	if ($animation_speed !== '') {
		$div_data['data-speed'] = $animation_speed;
	}
}

$el_class .= ' text-' . ($alignment === '' ? 'left' : $alignment);

$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'uncode-lottie wpb_content_element ' . $el_class, $this->settings['base'], $atts );

$lottie_tag_id = ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ? 'data-id' : 'id';
$lottie_tag_start = ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ? 'div class="uncode-lottie-player"' : 'lottie-player';
$lottie_tag_end = ( function_exists('vc_is_page_editable') && vc_is_page_editable() )  ? 'div' : 'lottie-player';

$output = '<div class="' . esc_attr($css_class) . '" ' . uncode_switch_stock_string( $el_id ) . ' ' . implode(' ', $div_data_attributes) . '>';
	$output .= '<div class="uncode-lottie-wrap' .  esc_attr( $wrapper_class ) . '">';
		if ( $json !== '' ) {
			$output .= '<' . uncode_switch_stock_string($lottie_tag_start) . ' style="max-width: ' . uncode_switch_stock_string( $actual_width ) . '" ' . esc_attr($lottie_tag_id) . '="' . esc_attr( $player_id ) . '" src="' . esc_url( $json ) . '" background="transparent" speed="' . (floatval($speed)/10) . '" data-frames="' . uncode_switch_stock_string( $frames ) . '" ' . uncode_switch_stock_string( $loop ) . ' ' . uncode_switch_stock_string( $autoplay ) . '></' . esc_attr($lottie_tag_end) . '>';
		}
	$output .= '</div>';
$output .= '</div>';

echo uncode_remove_p_tag($output);