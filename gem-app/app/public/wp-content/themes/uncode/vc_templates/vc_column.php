<?php

$output = $el_id = $el_class = $width = $column_width_use_pixel = $column_width_percent = $column_width_pixel = $limit_content = $style = $font_family = $uncell_style = $back_color = $back_image = $back_image_auto = $back_image_option = $back_repeat = $back_attachment = $back_position = $back_size = $overlay_color = $overlay_alpha = $overlay_color_blend = $position_vertical = $position_horizontal = $align_horizontal = $expand_height = $override_padding = $gutter_size = $style_back = $div_style = $spaced_cell = $mobile_height = $uncoltable_style = $desktop_visibility = $medium_visibility = $mobile_visibility = $align_medium = $align_mobile = $col_style = $background_div = $zoom_width = $zoom_height = $shift_x = $shift_x_fixed = $shift_y = $shift_y_fixed = $shift_y_down = $shift_y_down_fixed = $z_index = $internal_width = $link_div = $parallax_intensity = $parallax_centered = $skew = $sticky = $shadow = $shadow_darker = $radius = $css_animation = $animation_delay = $animation_speed = $is_carousel = $medium_width = $mobile_width = $col_perc_md = $col_perc_sm = $kburns = $preserve_border = $preserve_border_tablet = $preserve_border_mobile = $uncont_style = $featured_image = $custom_inline_css = $toggle = $max_height = $max_height_mobile = $closed_txt = $icon_closed = $icon_position = $open_txt = $icon_open = $fade = $toggle_classes = $btn_align = $btn_margin = $toggle_scroll = $btn_margin_open = $trigger_resize = $toggle_navbar = $toggle_navbar_mobile = $multi_bg_out = $bg_transition = $bg_transition_time = $bg_carousel_time = $mobile_slideshow = $bg_carousel_time_mobile = $multi_scroll_manually = $bg_transition_pace = $bg_transition_pace_mouse = $bg_transition_threshold = $bg_transition_threshold_mobile = $multi_random = '';
extract(shortcode_atts(array(
  'uncode_shortcode_id' => '',
  'el_id' => '',
  'el_class' => '',
  'el_uncol_class' => '',
  'width' => '1/1',
  'column_width_use_pixel' => '',
  'column_width_percent' => '100',
  'column_width_pixel' => '',
  'limit_content' => '',
  'style' => '',
  'font_family' => '',
  'back_color' => '',
  'back_color_type' => '',
  'back_color_solid' => '',
  'back_color_gradient' => '',
  'back_image' => '',
  'back_image_auto' => '',
  'back_image_option' => '',
  'back_repeat' => '',
  'back_attachment' => '',
  'back_position' => 'center center',
  'back_size' => '',
  'parallax' => '',
  'kburns' => '',
  'overlay_color' => '',
  'overlay_color_type' => '',
  'overlay_color_solid' => '',
  'overlay_color_gradient' => '',
  'overlay_alpha' => '',
  'overlay_color_blend' => '',
  'overlay_animated' => '',
  'overlay_animated_1_color' => '',
  'overlay_animated_1_color_type' => '',
  'overlay_animated_1_color_solid' => '',
  'overlay_animated_2_color' => '',
  'overlay_animated_2_color_type' => '',
  'overlay_animated_2_color_solid' => '',
  'overlay_animated_speed' => '',
  'overlay_animated_size' => '',
  'position_vertical' => 'top',
  'position_horizontal' => 'center',
  'align_horizontal' => 'align_left',
  'expand_height' => '',
  'override_padding' => '',
  'column_padding' => '2',
  'gutter_size' => '3',
  'medium_width' => '',
  'mobile_width' => '',
  'mobile_height' => '',
  'desktop_visibility' => '',
  'medium_visibility' => '',
  'mobile_visibility' => '',
  'align_medium' => '',
  'align_mobile' => '',
  'zoom_width' => '',
  'zoom_height' => '',
  'shift_x_fixed' => '',
  'shift_x' => '',
  'shift_y' => '',
  'shift_y_fixed' => '',
  'shift_y_down' => '',
  'shift_y_down_fixed' => '',
  'z_index' => '',
  'css_animation' => '',
  'animation_delay' => '',
  'animation_speed' => '',
  'parallax_intensity' => '',
  'parallax_centered' => '',
  'skew' => '',
  'sticky' => '',
  'shadow' => '',
  'shadow_darker' => '',
  'radius' => '',
  'link_to' => '',
  'css' => '',
  'border_color' => '',
  'border_color_type' => '',
  'border_color_solid' => '',
  'border_style' => '',
  'preserve_border' => '',
  'preserve_border_tablet' => '',
  'preserve_border_mobile' => '',
  'featured_image' => '',
  'toggle' => '',
  'max_height' => 200,
  'max_height_mobile' => '',
  'closed_txt' => esc_html__("Open", 'uncode-core') ,
  'icon_closed' => '',
  'icon_open' => '',
  'icon_position' => '',
  'open_txt' => esc_html__("Close", 'uncode-core') ,
  'fade' => '',
  'toggle_classes' => '',
  'btn_align' => '',
  'btn_margin' => '',
  'btn_margin_open' => '',
  'toggle_scroll' => '',
  'trigger_resize' => '',
  'toggle_navbar' => '',
  'toggle_navbar_mobile' => '',
  'multiple_media' => '',
  'medias' => '',
  'bg_transition' => '',
  'bg_transition_time' => '250',
  'bg_carousel_time' => '5000',
  'mobile_slideshow' => '',
  'bg_carousel_time_mobile' => '5000',
  'bg_transition_pace' => '20',
  'bg_transition_pace_mouse' => '200',
  'bg_transition_threshold' => 0,
  'bg_transition_threshold_mobile' => 0,
  'multi_scroll_manually' => '',
  'multi_random' => '',
) , $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$col_classes = array('wpb_column');
$uncol_classes = array(
	'uncol'
);
$uncoltable_classes = array(
	'uncoltable'
);

if ( $skew === 'yes' ) {
	$uncoltable_classes[] = 'uncode-skew';
}

$uncell_classes = array(
	'uncell'
);
$uncont_classes = array(
	'uncont'
);
$div_data = array();

$el_class = $this->getExtraClass($el_class);
$el_uncol_class = $this->getExtraClass($el_uncol_class);

if ( $el_uncol_class !== '' ) {
	$uncol_classes[] = $el_uncol_class;
}



$inline_style_css = uncode_get_dynamic_colors_css_from_shortcode( array(
	'type'       => 'vc_column',
	'id'         => $uncode_shortcode_id,
	'attributes' => array(
		'back_color'             => $back_color,
		'back_color_type'        => $back_color_type,
		'back_color_solid'       => $back_color_solid,
		'back_color_gradient'    => $back_color_gradient,
		'overlay_color'          => $overlay_color,
		'overlay_color_type'     => $overlay_color_type,
		'overlay_color_solid'    => $overlay_color_solid,
		'overlay_color_gradient' => $overlay_color_gradient,
		'border_color'           => $border_color,
		'border_color_type'      => $border_color_type,
		'border_color_solid'     => $border_color_solid,
		'border_color_gradient'  => false,
	)
) );

$back_color = uncode_get_shortcode_color_attribute_value( 'back_color', $uncode_shortcode_id, $back_color_type, $back_color, $back_color_solid, $back_color_gradient );
$overlay_color = uncode_get_shortcode_color_attribute_value( 'overlay_color', $uncode_shortcode_id, $overlay_color_type, $overlay_color, $overlay_color_solid, $overlay_color_gradient );
$border_color = uncode_get_shortcode_color_attribute_value( 'border_color', $uncode_shortcode_id, $border_color_type, $border_color, $border_color_solid, false );

global $vc_column_width, $vc_column_inner_width, $changer_back_color_div, $changer_back_color_row, $changer_back_color_column, $changer_back_color_column_inner, $front_background_colors, $uncode_colors_flat_array;

$width_array = explode('/', $width);
$width_media = ( absint( trim( $width_array[0] ) ) / absint( trim( $width_array[1] ) ) ) * 12;
$vc_column_width = $vc_column_inner_width = $width_media;
$width = wpb_translateColumnWidthToSpan($width);

// Pass column width to single image shortcode
if (substr_count($content, '[vc_single_image')) {
	$content = str_replace('[vc_single_image', '[vc_single_image col_width="' . esc_attr( $width_media ) . '"', $content);
}

// Pass column width to gallery shortcode
if (substr_count($content, '[vc_gallery')) {
	$content = str_replace('[vc_gallery', '[vc_gallery col_width="' . esc_attr( $width_media ) . '"', $content);
}

// Pass column width to posts shortcode
if (substr_count($content, '[uncode_index')) {
	$content = str_replace('[uncode_index', '[uncode_index col_width="' . esc_attr( $width_media ) . '"', $content);
}

if ($position_vertical !== '') {
	$col_classes[] = 'pos-' . $position_vertical;
}
if ($position_horizontal !== '') {
	$col_classes[] = 'pos-' . $position_horizontal;
}
if ($align_horizontal !== '') {
	$col_classes[] = $align_horizontal;
}
if ($align_medium !== '') {
	$col_classes[] = $align_medium;
}
if ($align_mobile !== '') {
	$col_classes[] = $align_mobile;
}
if ($featured_image === 'yes') {
	$col_classes[] = 'uncol-featured-image';
}

if ($column_width_use_pixel === 'yes' && $column_width_pixel !== '') {
	$column_width_pixel = preg_replace("/[^0-9,.]/", "", $column_width_pixel);
	$column_width_pixel = 12 * round(($column_width_pixel) / 12);
	$internal_width = ' max-width:' . esc_attr( $column_width_pixel ) . 'px;';
} else {
	if (!empty($column_width_percent) && $column_width_percent !== '100') {
	  $internal_width = ' max-width:' . esc_attr( $column_width_percent ) . '%;';
	}
}

global $metabox_data, $inner_column_style, $previous_blend, $is_cb, $is_footer;
if (isset($metabox_data['_uncode_specific_style'][0]) && $metabox_data['_uncode_specific_style'][0] !== '') {
	$general_style = $metabox_data['_uncode_specific_style'][0];
} else {
	$general_style = ot_get_option('_uncode_general_style');
}

if ($style === '') {
	$style = $general_style;
}

$uncol_classes[] = 'style-' . $style;
if ( $changer_back_color_div != '' && empty($back_color) && $changer_back_color_row ) {
	$div_data['data-skin-change'] = 'style-' . $style;
	$changer_back_color_column = $changer_back_color_column_inner = true;
} else {
	$changer_back_color_column = $changer_back_color_column_inner = false;
}

if ($font_family !== '') {
	$uncol_classes[] = $font_family;
}

if (!empty($mobile_height)) {
	$mobile_height .= is_numeric( $mobile_height ) ? 'px' : '';
	$uncoltable_style .= 'min-height: ' . esc_html($mobile_height) . ';';
}

if ( $back_image_auto === 'yes' && $featured_image !== "yes" && is_singular() && ( $is_cb || $is_footer ) ) {
	$featured_id = get_post_thumbnail_id(get_the_id());
	$featured_id = apply_filters( 'uncode_featured_image_id', $featured_id, get_the_id() );

	if ( $back_image_option === 'secondary' ) {
		$secondary_featured = uncode_get_secondary_featured_thumbnail_id(get_the_id());

		if ( $secondary_featured ) {
			$featured_id = $secondary_featured;
		}
	}

	if ( $featured_id ) {
		$back_image = $featured_id;
	}
}

$back_image = apply_filters( 'wpml_object_id', $back_image, 'attachment' );

if ($override_padding === 'yes') {
	switch ($column_padding) {
		case '0':
		$padding_class = 'no-block-padding';
		break;
		case '1':
		$padding_class = 'one-block-padding';
		break;
		case '2':
		$padding_class = 'single-block-padding';
		break;
		case '3':
		$padding_class = 'double-block-padding';
		break;
		case '4':
		$padding_class = 'triple-block-padding';
		break;
		case '5':
		$padding_class = 'quad-block-padding';
		break;
	}
} else {
	if ((empty($back_image) && empty($back_color))) {
		$padding_class = 'no-block-padding';
	} else {
		$padding_class = 'single-block-padding';
	}
}


if ($expand_height === 'yes') {
	$uncol_classes[] = 'unexpand';
}
if ($sticky === 'yes' && !(function_exists('vc_is_page_editable') && vc_is_page_editable())) {
	$uncol_classes[] = 'sticky-element sticky-sidebar';
}

if (substr_count($content, '[uncode_slider') && ( substr_count($content, 'is_header') || ! function_exists('vc_is_page_editable') || ! vc_is_page_editable() ) ) {
	$is_carousel = true;
	$el_class.= ' column_container';
	if ($override_padding === 'yes' && $column_padding === 0) {
		$slider_padding = ' limit_content="no" top_padding="0" bottom_padding="0" h_padding="0"';
	} else {
		$slider_padding = '';
	}
	$content = str_replace('[uncode_slider','[uncode_slider'.$slider_padding.' style="' . esc_attr( $style ) . '"', $content);
}

if ($this->settings['base'] == 'vc_column') {
	$col_classes[] = 'column_parent';
} else {
	$col_classes[] = 'column_child';
}
$temp_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class, $this->settings['base'], $atts);
if ($temp_class !== '') {
	$col_classes[] = $temp_class;
}

if ($desktop_visibility === 'yes') {
	$col_classes[] = 'desktop-hidden';
}
if ($medium_visibility === 'yes') {
	$col_classes[] = 'tablet-hidden';
}
if ($mobile_visibility === 'yes') {
	$col_classes[] = 'mobile-hidden';
}

$temp_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ') , $this->settings['base'], $atts);
if ($temp_class !== '') {
	$uncell_classes[] = $temp_class;
}
if ( $preserve_border === 'yes' ) {
	if ( $preserve_border_tablet === 'yes' ) {
		$uncell_classes[] = 'vc_custom_preserve_tablet';
	}
	if ( $preserve_border_mobile === 'yes' ) {
		$uncell_classes[] = 'vc_custom_preserve_mobile';
	}
}

if ($border_color !== '') {
	$uncell_classes[] = 'border-' . $border_color . '-color';
	if ($border_style !== '') {
		$uncell_style = 'border-style: ' . $border_style . ';';
	}
}

if ( $css ) {
	$custom_inline_css = uncode_get_custom_inline_css( $css );
}

if ( $custom_inline_css ) {
	$uncell_style .= $custom_inline_css;
}

if ($uncell_style !== '') {
	$uncell_style = ' style="' . esc_attr( $uncell_style ) . '"';
}

global $row_cols_md_counter, $row_cols_sm_counter;

$col_perc_md = $col_perc_sm = 0;

switch ($medium_width) {
	case 1:
		$col_classes[] = 'col-md-16';
		$col_perc_md = 100/6;
	break;
	case 2:
		$col_classes[] = 'col-md-25';
		$col_perc_md = 25;
	break;
	case 3:
		$col_classes[] = 'col-md-33';
		$col_perc_md = 100/3;
	break;
	case 4:
		$col_classes[] = 'col-md-50';
		$col_perc_md = 50;
	break;
	case 5:
		$col_classes[] = 'col-md-66';
		$col_perc_md = 100/1.5;
	break;
	case 6:
		$col_classes[] = 'col-md-75';
		$col_perc_md = 75;
	break;
	case 7:
		$col_classes[] = 'col-md-100';
		$col_perc_md = 100;
	break;
}
if ( $row_cols_md_counter >= 100 ) {
	$col_classes[] = 'col-md-clear';
}

switch ($mobile_width) {
	case 1:
		$col_classes[] = 'col-sm-16';
		$col_perc_sm = 100/6;
	break;
	case 2:
		$col_classes[] = 'col-sm-25';
		$col_perc_sm = 25;
	break;
	case 3:
		$col_classes[] = 'col-sm-33';
		$col_perc_sm = 100/3;
	break;
	case 4:
		$col_classes[] = 'col-sm-50';
		$col_perc_sm = 50;
	break;
	case 5:
		$col_classes[] = 'col-sm-66';
		$col_perc_sm = 100/1.5;
	break;
	case 6:
		$col_classes[] = 'col-sm-75';
		$col_perc_sm = 75;
	break;
	case 7:
		$col_classes[] = 'col-sm-100';
		$col_perc_sm = 100;
	break;
}
if ( $row_cols_sm_counter >= 100 ) {
	$col_classes[] = 'col-sm-clear';
}

//addition go below class declaration
$row_cols_md_counter = $row_cols_md_counter + $col_perc_md;
$row_cols_sm_counter = $row_cols_sm_counter + $col_perc_sm;

if ($gutter_size === '') {
	$gutter_size = 3;
}

switch ($gutter_size) {
	case 0:
		$col_classes[] = 'no-internal-gutter';
	break;
	case 1:
		$col_classes[] = 'one-internal-gutter';
	break;
	case 2:
		$col_classes[] = 'half-internal-gutter';
	break;
	case 3:
	default:
		$col_classes[] = 'single-internal-gutter';
	break;
	case 4:
		$col_classes[] = 'double-internal-gutter';
	break;
	case 5:
		$col_classes[] = 'triple-internal-gutter';
	break;
	case 6:
		$col_classes[] = 'quad-internal-gutter';
	break;
}

$shadow_classes = '';
$radius_classes = $radius !== '' ? 'unradius-' . $radius : '';

if ($shadow !== '') {

	if ( $shadow_darker !== '' ) {
		$shadow = 'darker-' . $shadow;
	}
	$shadow_classes = 'unshadow-' . $shadow;

}

if ($internal_width !== '' && $this->settings['base'] == 'vc_column' && $width === 'vc_col-sm-12') {
	$uncont_classes[] = $padding_class;
	$uncont_classes[] = 'col-custom-width';
	if (!empty($back_color)) {
		$uncont_classes[] = 'style-' . $back_color . '-bg';
	}
	$uncont_classes[] = $shadow_classes;
	$uncont_classes[] = $radius_classes;
} else {
	$uncell_classes[] = $padding_class;
	if (!empty($back_color)) {
		$uncell_classes[] = 'style-' . $back_color . '-bg';
	}
	$uncell_classes[] = $shadow_classes;
	$uncell_classes[] = $radius_classes;
}

/** BEGIN - background construction **/
if (!empty($back_image) || $overlay_color !== '' || $overlay_animated === 'yes') {
	if ($parallax === 'yes' || $kburns !== '') {
		$back_size = 'cover';
		if ($parallax === 'yes') {
			$back_attachment = '';
			$uncell_classes[] = 'with-parallax';
		}
		if ($kburns === 'yes') {
			$uncell_classes[] = 'with-kburns';
		} elseif ($kburns === 'zoom') {
			$uncell_classes[] = 'with-zoomout';
		} elseif ($kburns === 'magnetic') {
			$uncell_classes[] = 'magnetic';
		}
	} else {
		if ($back_size === '') {
			$back_size = 'cover';
		}
	}

	if ($back_repeat === '') {
		$back_repeat = 'no-repeat';
	}

	$back_array = array (
		'background-image' => $back_image,
		'background-color' => $back_color,
		'background-repeat' => $back_repeat,
		'background-position' => $back_position,
		'background-size' => $back_size,
		'background-attachment' => $back_attachment,
	);

    $background_div_width = '';

    if ($column_width_use_pixel === 'yes' && $column_width_pixel !== '') {
        $column_width_pixel = preg_replace("/[^0-9,.]/", "", $column_width_pixel);
        $column_width_pixel = 12 * round(($column_width_pixel) / 12);
        $background_div_width .= 'max-width: ' . $column_width_pixel . 'px;';
    } else {
        if (!empty($column_width_percent) && $column_width_percent !== '100') {
            $background_div_width .= 'max-width: ' . $column_width_percent . '%;';
        }
    }
    if ($background_div_width !== '') {
        $background_div_width .= 'margin-left: auto; margin-right: auto;';
    }

	if ( $overlay_color_blend !== '' ) {
		$back_array['mix-blend-mode'] = $overlay_color_blend;
		$previous_blend = true;
	}

	if ( $overlay_animated === 'yes' ) {
		if ( $overlay_animated_1_color_type === 'uncode-palette' ) {
			if ( isset($front_background_colors[$overlay_animated_1_color]) && in_array( $overlay_animated_1_color, $uncode_colors_flat_array ) ) {
				$back_array['overlay-animated-1'] = $front_background_colors[$overlay_animated_1_color];
			}
		} elseif ( $overlay_animated_1_color_type === 'uncode-solid' ) {
			$back_array['overlay-animated-1'] = $overlay_animated_1_color_solid;
		}
		if ( $overlay_animated_2_color_type === 'uncode-palette' ) {
			if ( isset($front_background_colors[$overlay_animated_2_color]) && in_array( $overlay_animated_2_color, $uncode_colors_flat_array ) ) {
				$back_array['overlay-animated-2'] = $front_background_colors[$overlay_animated_2_color];
			}
		} elseif ( $overlay_animated_2_color_type === 'uncode-solid' ) {
			$back_array['overlay-animated-2'] = $overlay_animated_2_color_solid;
		}

		$back_array['overlay-animated-speed'] = $overlay_animated_speed !== '' ? esc_attr($overlay_animated_speed) : '200';
		$back_array['overlay-animated-size'] = $overlay_animated_size !== '' ? esc_attr($overlay_animated_size) : '1';
	}

	if ( $multiple_media === 'yes' && $medias !== '' && !(function_exists('vc_is_page_editable') && vc_is_page_editable()) ) {
		$medias = $back_image . ','. $medias;
		$media_ids = explode(',', $medias);
		$multi_bg_array = array();
		$multi_bg_array['transition-time'] = $bg_transition_time !== '' ? esc_html( $bg_transition_time ) : '250';
		if ( $bg_transition !== '' ) {
			$multi_bg_array['transition'] = esc_html( $bg_transition );
			if ( $bg_transition === 'mouse' ) {
				$multi_bg_array['transition-pace'] = $bg_transition_pace_mouse !== '' ? esc_html( $bg_transition_pace_mouse ) : '200';
				if ( $mobile_slideshow === 'yes' ) {
					$multi_bg_array['carousel-mobile'] = "yes";
					$multi_bg_array['carousel-time'] = $bg_carousel_time_mobile !== '' ? esc_html( $bg_carousel_time_mobile ) : '5000';
				}
			} else {
				if ( $multi_scroll_manually === 'yes' ) {
					$multi_bg_array['transition-pace'] = $bg_transition_pace !== '' ? esc_html( $bg_transition_pace ) : '20';
				}
			}

		} else {
			$multi_bg_array['carousel-time'] = $bg_carousel_time !== '' ? esc_html( $bg_carousel_time ) : '5000';
		}
		if ( $bg_transition !== 'mouse' ) {
			$multi_bg_array['transition-threshold'] = $bg_transition_threshold !== '' ? esc_html( $bg_transition_threshold ) : '0';
		} else {
			$multi_bg_array['transition-threshold'] = $bg_transition_threshold_mobile !== '' ? esc_html( $bg_transition_threshold_mobile ) : '0';
		}
		if ( $multi_random === 'yes' ) {
			$multi_bg_array['multi-random'] = 'true';
		}
		$multi_bg_data = '';
		foreach ($multi_bg_array as $att => $data_val) {
			$multi_bg_data .= ' data-' . $att . '="' . $data_val . '"';
		}
		$background_div .= '<div class="uncode-multi-bgs"' . $multi_bg_data . '>';
		foreach ($media_ids as $media_key => $media_id) {
			$back_array_multi = $back_array;
			$back_array_multi['background-image'] = $media_id;
			$back_result_array = uncode_get_back_html($back_array_multi, $overlay_color, $overlay_alpha, '', 'column', 'multi-background');
			$background_div .= $back_result_array['back_html'];
		}
		$background_div .= '</div>';
	} else {
		$back_result_array = uncode_get_back_html($back_array, $overlay_color, $overlay_alpha, '', 'column');
		$background_div = $back_result_array['back_html'];
	}
}

/** END - background construction **/

/** BEGIN - shift construction **/
if (($zoom_width != '0' && $zoom_width != '') || ($zoom_height != '0' && $zoom_height != '') || ($shift_x != '0' && $shift_x != '') || ($shift_y != '0' && $shift_y != '') || ($shift_y_down != '0' && $shift_y_down != '')) {
	switch ($zoom_width) {
		case 1:
			$uncol_classes[] = 'zoom_width_half';
		break;
		case 2:
			$uncol_classes[] = 'zoom_width_single';
		break;
		case 3:
			$uncol_classes[] = 'zoom_width_double';
		break;
		case 4:
			$uncol_classes[] = 'zoom_width_triple';
		break;
		case 5:
			$uncol_classes[] = 'zoom_width_quad';
		break;
	}
	switch ($zoom_height) {
		case 1:
			$uncol_classes[] = 'zoom_height_half';
		break;
		case 2:
			$uncol_classes[] = 'zoom_height_single';
		break;
		case 3:
			$uncol_classes[] = 'zoom_height_double';
		break;
		case 4:
			$uncol_classes[] = 'zoom_height_triple';
		break;
		case 5:
			$uncol_classes[] = 'zoom_height_quad';
		break;
	}
	switch ($shift_x) {
		case 1:
			$uncol_classes[] = 'shift_x_half';
			$data_shift = 1;
		break;
		case 2:
			$uncol_classes[] = 'shift_x_single';
			$data_shift = 2;
		break;
		case 3:
			$uncol_classes[] = 'shift_x_double';
			$data_shift = 4;
		break;
		case 4:
			$uncol_classes[] = 'shift_x_triple';
			$data_shift = 6;
		break;
		case 5:
			$uncol_classes[] = 'shift_x_quad';
			$data_shift = 8;
		break;
		case -1:
			$uncol_classes[] = 'shift_x_neg_half';
			$data_shift = -1;
		break;
		case -2:
			$uncol_classes[] = 'shift_x_neg_single';
			$data_shift = -2;
		break;
		case -3:
			$uncol_classes[] = 'shift_x_neg_double';
			$data_shift = -4;
		break;
		case -4:
			$uncol_classes[] = 'shift_x_neg_triple';
			$data_shift = -6;
		break;
		case -5:
			$uncol_classes[] = 'shift_x_neg_quad';
			$data_shift = -8;
		break;
	}

	switch ($shift_y) {
		case 1:
			$uncol_classes[] = 'shift_y_half';
		break;
		case 2:
			$uncol_classes[] = 'shift_y_single';
		break;
		case 3:
			$uncol_classes[] = 'shift_y_double';
		break;
		case 4:
			$uncol_classes[] = 'shift_y_triple';
		break;
		case 5:
			$uncol_classes[] = 'shift_y_quad';
		break;
		case -1:
			$uncol_classes[] = 'shift_y_neg_half';
		break;
		case -2:
			$uncol_classes[] = 'shift_y_neg_single';
		break;
		case -3:
			$uncol_classes[] = 'shift_y_neg_double';
		break;
		case -4:
			$uncol_classes[] = 'shift_y_neg_triple';
		break;
		case -5:
			$uncol_classes[] = 'shift_y_neg_quad';
		break;
	}

	switch ($shift_y_down) {
		case 1:
			$uncol_classes[] = 'shift_y_down_half';
		break;
		case 2:
			$uncol_classes[] = 'shift_y_down_single';
		break;
		case 3:
			$uncol_classes[] = 'shift_y_down_double';
		break;
		case 4:
			$uncol_classes[] = 'shift_y_down_triple';
		break;
		case 5:
			$uncol_classes[] = 'shift_y_down_quad';
		break;
		case -1:
			$uncol_classes[] = 'shift_y_down_neg_half';
		break;
		case -2:
			$uncol_classes[] = 'shift_y_down_neg_single';
		break;
		case -3:
			$uncol_classes[] = 'shift_y_down_neg_double';
		break;
		case -4:
			$uncol_classes[] = 'shift_y_down_neg_triple';
		break;
		case -5:
			$uncol_classes[] = 'shift_y_down_neg_quad';
		break;
	}
	if ($shift_x_fixed === 'yes') {
		$uncol_classes[] = 'shift_x_fixed';
	}
	if ($shift_y_fixed === 'yes') {
		$uncol_classes[] = 'shift_y_fixed';
	}
	if ($shift_y_down_fixed === 'yes') {
		$uncol_classes[] = 'shift_y_down_fixed';
	}
}

if ($shift_y_down != '0' && $shift_y_down != '') {
	$col_classes[] = 'shift-col-wa';//workaround to remove vertical-align on mobile devices when shift bottom is enabled
}

if ($z_index !== '0' && $z_index !== '') {
	$col_classes[] = 'z_index_' . str_replace('-','neg_', $z_index);
}
/** END - shift construction **/

if ($css_animation !== '' && uncode_animations_enabled() ) {
	$uncol_classes[] = 'animate_when_almost_visible ' . $css_animation;
	if ($animation_delay !== '') {
		$div_data['data-delay'] = $animation_delay;
	}
	if ($animation_speed !== '') {
		$div_data['data-speed'] = $animation_speed;
	}
}

if ( function_exists('vc_is_page_editable') && vc_is_page_editable() && isset( $data_shift ) ) {
	$div_data['data-shift'] = $data_shift;
}

$uncell_div_data = '';

if ( $parallax_intensity !== '' ) {
	$uncell_classes[] .= ' parallax-el';
	$uncell_div_data = uncode_get_parallax_div_data( $parallax_intensity, $parallax_centered, true );
}

if ( $link_to !== '' && ( ! function_exists('vc_is_page_editable') || ! vc_is_page_editable() ) ) {
	$link = vc_build_link( $link_to );
	$a_rel = ($link['rel'] !== '') ? ' rel="' . esc_attr( trim($link['rel'] ) ) . '"' : '';
	if ($link['url'] !== '') {
		$link_div = '<a class="col-link custom-link" href="'.esc_url($link['url']).'" target="'.($link['target'] !== '' ? esc_attr( $link['target'] ) : '_self').'" title="' . esc_attr( $link['title'] ) . '"'.$a_rel.'></a>';
	}
}

$uncont_style = $read_more_btn = $btn_txt_open = '';

if ( $internal_width !== '' ) {
	$uncont_style = $internal_width;
}

$uncode_data = array();
if ( $toggle === 'yes' && $max_height !== '' ) {
	if ( $max_height > 0 && is_numeric( $max_height ) ) {
		$uncont_style .= 'max-height:' . esc_attr($max_height) . 'px;';
		$uncode_data['data-ov-height'] = esc_attr($max_height . 'px');
	} else {
		$uncont_style .= 'max-height:' . esc_attr($max_height) . ';';
		$uncode_data['data-ov-height'] = esc_attr($max_height);
	}
	$uncode_data['data-ov-height'] = esc_attr($max_height);

	if ( $max_height_mobile !== '' ) {
		if ( $max_height_mobile > 0 && is_numeric( $max_height_mobile ) ) {
			$uncode_data['data-ov-height-mobile'] = esc_attr($max_height_mobile . 'px');
		} else {
			$uncode_data['data-ov-height-mobile'] = esc_attr($max_height_mobile);
		}
	}

	$uncont_classes[] = 'overflow-hidden-mask overflow-mask';
	if ( $fade !== '' ) {
		$uncont_classes[] = 'overflow-fade-' . esc_attr( $fade );
	}
	$btn_txt = wp_kses_post( $closed_txt );

	if ( $open_txt !== '' ) {
		$btn_txt_open = wp_kses_post( $open_txt );
	}

	$btn_wrap_classes = array('btn-more-wrap', 'state-closed', 'style-' . $style);
	$btn_classes = array('read-more-ov-trigger', 'btn-no-scale');

	if ($icon_closed !== '') {
		$icon_closed = '<i class="' . esc_attr($icon_closed) . '"></i>';
	} else {
		$icon_closed = '';
	}

	if ($icon_open !== '') {
		$icon_open = '<i class="' . esc_attr($icon_open) . '"></i>';
	} else {
		$icon_open = '';
	}

	if ($icon_position === 'right') {
		$btn_txt = $btn_txt . $icon_closed;
		$btn_txt_open = $btn_txt_open . $icon_open;
		$btn_classes[] = 'btn-icon-right';
	} else {
		$btn_txt = $icon_closed . $btn_txt;
		$btn_txt_open = $icon_open . $btn_txt_open;
		$btn_classes[] = 'btn-icon-left';
	}

	$btn_txt = '<span class="read_more_of_txt_closed">' . $btn_txt . '</span>';
	if ( $btn_txt_open !== '' ) {
		$btn_txt = '<span class="read_more_of_txt_open">' . $btn_txt_open . '</span>' . $btn_txt;
	}

	if ( $btn_align !== '' ) {
		$btn_wrap_classes[] = 'read_more_of_' . $btn_align;
	} else {
		$btn_wrap_classes[] = 'read_more_of_center';
	}

	if ( $btn_margin !== '' ) {
		$btn_wrap_classes[] = $btn_margin . '-top-mrgn';
		$uncode_data['data-margin-closed'] = $btn_margin;
	} else {
		$uncode_data['data-margin-closed'] = 'no';
	}

	if ( $btn_margin_open !== '' ) {
		$uncode_data['data-margin-open'] = $btn_margin_open;
	}

	if ( $toggle_scroll === 'yes' ) {
		$btn_classes[] = 'toggle-scroll';
		if ( $toggle_navbar === 'yes' ) {
			$btn_classes[] = 'toggle-navbar';
		}
		if ( $toggle_navbar_mobile === 'yes' ) {
			$btn_classes[] = 'toggle-navbar-mobile';
		}
	}

	$btn_classes[] = $toggle_classes;

	$style_button = '';
	if ( $internal_width !== '' ) {
		$style_button = ' style="' . $internal_width . '"';
		$btn_wrap_classes[] = 'w-internal-width';
	}

	if ( $trigger_resize === 'yes' ) {
		$btn_wrap_classes[] = 'trigger-resize';
	}

	$btn_wrap_classes = implode(' ', $btn_wrap_classes);
	$btn_classes = implode(' ', $btn_classes);

	$read_more_btn = '<span class="' . esc_attr(trim($btn_wrap_classes)) . '"' . $style_button . '><a href="#" class="' . esc_attr(trim($btn_classes)) . '">' . $btn_txt . '</a></span>';
}

$uncont_style = $uncont_style != '' ? ' style="' . $uncont_style . '"' : '';

$uncol_style = $inner_column_style != '' ? ' style="' . $inner_column_style . '"' : '';

if ($uncoltable_style != '') {
	$uncoltable_style = ' style="' . esc_attr( $uncoltable_style ) . '"';
}

if ($is_carousel && $width_media === 12) {
	$output.= $content;
} else {
	if ( !function_exists('vc_is_page_editable') || !vc_is_page_editable() ) {
		global $uncode_row_parent, $uncode_vc_block, $uncode_vc_index;
		if ( !$uncode_vc_block && !$uncode_vc_index ) {
			$uncode_row_parent -= $width_media;
			if ($uncode_row_parent < 0) {
				$output.= '</div><div class="row-inner">';
				$uncode_row_parent = 12;
				$uncode_row_parent -= $width_media;
			}
		}
	}
	$output.= '<div class="' . esc_attr(trim(implode(' ', $col_classes))) . '"' . $col_style . $el_id . '>';
	$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));
	$output.= '<div class="' . esc_attr(trim(implode(' ', $uncol_classes))) . '"' . $uncol_style . '  '.implode(' ', $div_data_attributes).'>';
	$output.= '<div class="' . esc_attr(trim(implode(' ', $uncoltable_classes))) . '"' . $uncoltable_style . '>';
	$data_cell = function_exists('vc_is_page_editable') && vc_is_page_editable() ? ' data-bg="style-' . $back_color . '-bg" data-radius="' . $radius_classes . '" data-shadow="' . $shadow_classes . '"' : '';
	$output.= '<div' . $data_cell . ' class="' . esc_attr(trim(implode(' ', $uncell_classes))) . '"'.$uncell_style.' ' . $uncell_div_data . '>';
	$output .= $multi_bg_out; //multi bg
	$output.= $background_div;
	$uncode_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $uncode_data, array_keys($uncode_data));
	$output.= '<div class="' . esc_attr(trim(implode(' ', $uncont_classes))) . '"' . $uncont_style . ' '.implode(' ', $uncode_data_attributes).'>';
	$output.= $content;
	$output.= '</div>';
	$output.= $read_more_btn;
	$output.= '</div>';
	$output.= '</div>';
	$output.= '</div>';
	$output.= $link_div;
	$output .= uncode_print_dynamic_inline_style( $inline_style_css );
	$output.= '</div>';
}

echo uncode_remove_p_tag($output);
$changer_back_color_column = $changer_back_color_column_inner = false;
