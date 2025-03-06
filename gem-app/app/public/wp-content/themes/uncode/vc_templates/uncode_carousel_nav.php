<?php
$output = $inline_style_css = '';
extract(shortcode_atts(array(
	'uncode_shortcode_id' => '',
	'target' => '',
	'position' => '',
	'width' => '',
	'limit_width' => '',
	'padding' => '',
	'v_align' => '',
	'h_align' => '',
	'skin' => '',
	'space' => '',
	'css_animation' => '',
	'animation_delay' => '',
	'animation_speed' => '',
	'hide_arrows' => '',
	'arrows_position' => '',
	'arrow_style' => '',
	'arrow_shadow' => '',
	'icon_position' => '',
	'icon' => 'fa fa-angle-right',
	'arrow_size' => '',
	'arrow_bg_size' => '',
	'arrows_text' => '',
	'previous_label' => '',
	'next_label' => '',
	'arrows_width' => '',
	'arrows_v_align' => '',
	'arrows_h_align' => '',
	'arrows_padding' => '',
	'arrows_skin' => '',
	'arrows_hover' => '',
	'arrows_animation' => '',
	'animated_arrows' => '',
	'magnetic_arrows' => '',
	'arrows_desktop_visibility' => '',
	'arrows_medium_visibility' => '',
	'arrows_mobile_visibility' => '',
	'arrow_left_order' => '',
	'arrow_right_order' => '',
	'hide_dots' => '',
	'dots_position' => '',
	'dots_style' => '',
	'dots_look' => '',
	'digits' => '',
	'dots_width' => '',
	'dots_v_align' => '',
	'dots_h_align' => '',
	'dots_padding' => '',
	'dots_space' => '',
	'dots_skin' => '',
	'dots_hover' => '',
	'dots_animation' => '',
	'dots_desktop_visibility' => '',
	'dots_medium_visibility' => '',
	'dots_mobile_visibility' => '',
	'dot_single_width' => '',
	'dot_single_height' => '',
	'dot_single_space' => '',
	'dot_single_boundary' => '',
	'dot_single_radius' => '',
	'dot_single_active' => '',
	'dot_single_active_h' => '',
	'dot_number_align' => '',
	'dots_order' => '',
	'hide_counter' => '',
	'counter_position' => '',
	'hide_counter_total' => '',
	'counter_index_width' => '',
	'counter_digits' => '',
	'counter_width' => '',
	'counter_sep' => '',
	'counter_v_align' => '',
	'counter_h_align' => '',
	'counter_padding' => '',
	'counter_space' => '',
	'counter_skin' => '',
	'counter_hover' => '',
	'counter_animation' => '',
	'counter_desktop_visibility' => '',
	'counter_medium_visibility' => '',
	'counter_mobile_visibility' => '',
	'counter_order' => '',
	'text_font' => '',
	'text_size' => '',
	'heading_custom_size' => '',
	'text_weight' => '', 
	'text_transform' => '',
	'text_space' => '',
	'el_id' => '',
	'el_class' => '',
) , $atts));

$group_skin = $skin;

$nav_arr = array(
	'dots' => array(
		'hide' => $hide_dots,
		'position' => $dots_position,
		'v_align' => '',
		'h_align' => $dots_h_align
	),
	'counter' => array(
		'hide' => $hide_counter,
		'position' => $counter_position,
		'v_align' => $counter_v_align,
		'h_align' => $counter_h_align
	),
	'arrows' => array(
		'hide' => $hide_arrows,
		'position' => $arrows_position,
		'v_align' => $arrows_v_align,
		'h_align' => $arrows_h_align,
	),
);

$general_ops = array(
	'position' => $position,
	'width' => $width,
	'v_align' => $v_align,
	'h_align' => $h_align,
	'skin' => $skin,
	'padding' => $padding,
	'space' => $space,
);

$abs_ops = array(
	'desktop_visibility' => '',
	'medium_visibility' => '',
	'mobile_visibility' => '',
);

$nav_new = array();
$el_array = array('dots', 'counter', 'arrows');
$el_array_hide = array();
foreach ($el_array as $el_k => $el_val) {
	$el_hide = 'hide_' . $el_val;
	$el_array_hide[$el_val] = $$el_hide;
}

$loop_counter = 0;
foreach ($nav_arr as $nav_k => $nav_val) {
	if ( $nav_val['hide'] === '' ) {
		$loop_position = $nav_val['position'];
		if ( $loop_position !== '' && $loop_position !== 'absolute' ) {
			$loop_position .= '_' . $loop_counter;
			$loop_counter++;
		}
		$nav_new[$loop_position][] = $nav_k;
	}
}
ksort($nav_new);

if ( $text_size === 'custom' && $heading_custom_size !== '' ) {
	$inline_style_css = uncode_get_dynamic_css_font_size_shortcode( array(
		'id'         => $uncode_shortcode_id,
		'font_size'  => $heading_custom_size
	) );
}

$custom_class = '';
if ( $dot_single_width !== '' || $dot_single_height !== '' || $dot_single_space !== '' || $dot_single_radius !== '' || $dot_single_active !== '' || $dot_single_boundary !== '' || $dot_number_align !== '' || $counter_index_width ) {
	$inline_style_css .= uncode_get_dynamic_css_nav_carousel_shortcode( array(
		'id' => $uncode_shortcode_id,
		'width' => $dot_single_width,
		'height' => $dot_single_height,
		'space' => $dot_single_space,
		'radius' => $dot_single_radius,
		'active' => $dot_single_active,
		'boundary' => $dot_single_boundary,
		'counter_w' => $counter_index_width,
		'align' => $dot_number_align,
	) );
	$custom_class = 'carousel-nav-' . $uncode_shortcode_id . '-custom';
}

$wrap_classes = array('uncode-owl-nav-wrap');
$counter_nav = 0;

$output .= '<div class="' . esc_attr(trim(implode( ' ', $wrap_classes ))) . '"';
if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ) {
	$rand_id_front = uncode_big_rand();
	$output .= ' data-wrap-id="owl-nav-wrap-' . $rand_id_front . '"';
}
$output .= '>';
foreach ($nav_new as $_new_k => $_nav_new) {

	$hide_arr = array_diff($el_array, $_nav_new);
	foreach ($el_array_hide as $el_k => $el_val) {
		$opt = 'hide_' . $el_k;
		$$opt = $el_val;
	}

	foreach($hide_arr as $h_k => $hide_el) {
		$to_hide = 'hide_' . $hide_el;
		$$to_hide = "yes";
	}


	$guide_el = $_nav_new[0];
	if ( $_new_k !== '' && $_new_k !== 'absolute' ) {
		foreach ($general_ops as $opts_k => $opts_val) {
			$opt_to_switch = $guide_el . '_' . $opts_k;
			if ( isset($$opt_to_switch) ) {
				$$opts_k = $$opt_to_switch;
			}
		}
	} else {
		foreach ($general_ops as $opts_k => $opts_val) {
			$$opts_k = $opts_val;
		}
	}

	$hover_var = $guide_el . '_hover';
	$hover = $$hover_var;

	if ( $el_id !== '' ) {
		if ( $counter_nav > 0 ) {
			$el_id .= '_' . $counter_nav;
		}
		$el_id_html = ' id="' . esc_attr( trim( $el_id ) ) . '"';
	} else {
		$el_id_html = '';
	}

	if ( $el_class !== '' && $counter_nav > 0 ) {
		$el_class .= '_' . $counter_nav;
	}

	$classes = $dots_class = $arrow_class = $counter_class = array();
	$classes[] = 'uncode-owl-nav';
	$classes[] = $custom_class;
	$classes[] = trim($this->getExtraClass( $el_class ));

	$outer_classes = array('uncode-owl-nav-out');

	$div_data_outer = $div_data = array();

	if ( $target !== '' ) {
		$target = preg_replace('/\#/i', '', $target);
		$div_data['data-target'] = '#' . esc_attr( $target );
	}

	if ( $dots_style === '' ) {
		$div_data['data-dots'] = 'classic';
	} else {
		$div_data['data-dots'] = $dots_style;
		if ( $dots_style === 'numbers' && $digits === 'yes' ) {
			$div_data['data-digit'] = 2;
		}
	}

	if ( $dots_look === '' ) {
		$classes[] = 'dots-look-default';
	} else {
		$classes[] = 'dots-look-' . $dots_look;
	}

	if ( $counter_digits === 'yes' ) {
		$div_data['data-counter-digit'] = 2;
	}

	
	if ($css_animation !== '' && uncode_animations_enabled() ) {
		$css_animation = ' animate_when_almost_visible ' . $css_animation;
		if ($animation_delay !== '') {
			$div_data_outer['data-delay'] = $animation_delay;
		}
		if ($animation_speed !== '') {
			$div_data_outer['data-speed'] = $animation_speed;
		}
	}

	if ( $position !== '' ) {
		$classes[] = 'pos-abs';
		if ( $v_align === '' ) {
			$classes[] = 'pos-abs-bottom';
		} else {
			$classes[] = 'pos-abs-' . $v_align;
		}
		if ( $h_align === '' ) {
			if ( $position === 'el_absolute' && $guide_el !== 'arrows') {
				$classes[] = 'h-align-center';
			} else {
				$classes[] = 'h-align-justify';
			}
		} else {
			$classes[] = 'h-align-' . $h_align;
		}

		if ( isset($hover) && $hover !== '' ) {
			$classes[] = 'nav-hover';
		}
	
	} else {
		$classes[] = 'pos-rel';
		$classes[] = 'h-align-' . ( $h_align === '' ? 'justify' : $h_align );	
	}

	if ( $padding !== '' ) {
		switch ($padding) {
			case 0:
			  $classes[] = 'owl-nav-no-block-padding';
			  break;
		  case 1:
			  $classes[] = 'owl-nav-half-block-padding';
			  break;
		  case 2:
		  default:
			  $classes[] = 'owl-nav-single-block-padding';
			  break;
		  case 3:
			  $classes[] = 'owl-nav-double-block-padding';
			  break;
		  case 4:
			  $classes[] = 'owl-nav-triple-block-padding';
			  break;
		  case 5:
			  $classes[] = 'owl-nav-quad-block-padding';
			  break;
	  }
	}

	if ( $space !== '' ) {
		$classes[] = 'extra-space';
	}

	if ( ($skin === '' && $group_skin === '') || $skin === 'inherit' ) {
		$outer_classes[] = 'skin-inherit';
	} elseif ( $skin === '' && $group_skin !== '' ) {
		$outer_classes[] = 'style-' . $group_skin;
	} else {
		$outer_classes[] = 'style-' . $skin;
	}

	if ( $hide_dots !== 'yes' ) {
		$classes[] = 'dots-' . ( $dots_style === '' ? 'default' : $dots_style );
	}

	if ( $hide_arrows !== 'yes' ) {
		$classes[] = 'arrows-' . ( $arrow_style === '' ? 'default' : $arrow_style );
		if ( $arrow_size !== '' ) {
			$arrow_size = ' ' . $arrow_size;
		} else {
			$arrow_size = ' fa-1x';
		}
		if ( $arrow_bg_size !== '' ) {
			$classes[] = 'arrows-bg-' . $arrow_bg_size;
		}
		if ( $animated_arrows === 'yes' ) {
			$classes[] = 'animated-arrows';
		} elseif ( $animated_arrows === 'default' ) {
			$classes[] = 'animated-arrows-default';
		}
		if ( $arrow_shadow !== '' ) {
			$arrow_class[] = 'unshadow-arrows';
		}
	}

	if ($text_font !== '') {
		$classes[] = $text_font;
	}
	if ($text_size !== '') {
		$classes[] = $text_size;
	}
	if ($text_space !== '') {
		$classes[] = $text_space;
	}
	if ($text_weight !== '') {
		$classes[] = 'font-weight-' . $text_weight;
	}
	if ($text_transform !== '') {
		$classes[] = 'text-' . $text_transform;
	}
	if ($text_size === 'custom' && $heading_custom_size !== '') {
		$classes[] = 'fontsize-' . $uncode_shortcode_id . '-custom';
	}

	/* ABS options */
	foreach ($abs_ops as $opts_k => $opts_val) {
		$opt_to_switch = $guide_el . '_' . $opts_k;
		if ( isset($$opt_to_switch) ) {
			$$opts_k = $$opt_to_switch;
		} else {
			$$opts_k = false;
		}
	}
	if (isset(${$guide_el . '_desktop_visibility'}) && ${$guide_el . '_desktop_visibility'} === 'yes') {
		$classes[] = 'desktop-hidden';
	}
	if (isset(${$guide_el . '_medium_visibility'}) && ${$guide_el . '_medium_visibility'} === 'yes') {
		$classes[] = 'tablet-hidden';
	}
	if (isset(${$guide_el . '_mobile_visibility'}) && ${$guide_el . '_mobile_visibility'} === 'yes') {
		$classes[] = 'mobile-hidden';
	}
	if ( $position === 'el_absolute' ) {
		$classes[] = ( !isset(${$guide_el . '_width'}) || ${$guide_el . '_width'} === '' ? 'limit' : ${$guide_el . '_width'} ) . '-width';
		if ( $width === 'outer' ) {
			$classes[] = 'limit-width';
		}
	} elseif ( $position === 'absolute' ) {
		$classes[] = ( $width === '' ? 'limit' : $width ) . '-width';
	} else {
		if ( $limit_width === 'yes' ) {
			$classes[] = 'limit-width';
		} else {
			$classes[] = 'no-width';
		}
	}
	/* end ABS options */
	$div_data_outer_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data_outer, array_keys($div_data_outer));
	$div_data_attributes = array_map(function ($v, $k) { return $k . '="' . $v . '"'; }, $div_data, array_keys($div_data));

	$output .= '<div class="' . esc_attr(trim(implode( ' ', $outer_classes ))) . '"';
	if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ) {
		$output .= ' data-parent-wrap="owl-nav-wrap-' . $rand_id_front . '"';
	}
	$output .= '>';
	$output .= '<div class="' . esc_attr(trim(implode( ' ', $classes ))) . '" '.implode(' ', $div_data_attributes). $el_id_html . '>';
	$output .= '<div class="uncode-owl-nav-in uncode-owl-nav-waiting">';
	$output .= '<div class="uncode-owl-nav-safe' . $css_animation . '" ' . implode(' ', $div_data_outer_attributes) . '>';
	$output .= '<span class="uncode-nav-limit-before"></span>';// placeholder

	if ( $hide_arrows !== 'yes' ) {
		$arrow_class[] = 'uncode-nav-container';
		if ( $magnetic_arrows !== '' ) {
			$arrow_class[] = 'un-magnetic-el';
		}

		$arrow_anim_class = '';	
		if ( $position !== '' && isset($hover) && $hover !== '' ) {
			$arrow_anim_class = ' anim-' . ( $arrows_animation === '' ? 'alpha-anim' : $arrows_animation );
		}

		$arrow_left_output = '<span class="uncode-nav-prev' . $arrow_anim_class . ( $magnetic_arrows !== '' ? ' un-magnetic-zone' : '' ) . ( $arrow_left_order !== '' && $arrow_left_order !== $arrow_right_order ? ' nav-ordered order-' . $arrow_left_order : '' ) . '"><span class="uncode-nav-container-wrap"><span class="' . esc_attr(trim(implode( ' ', $arrow_class ))) . '"><span>';
		$icon_inside = $icon_outside = '';
		if ( $icon_position === '' ) {
			$icon_outside = '<i class="' . esc_html( $icon ) . esc_html($arrow_size) . '"></i>';
		} elseif  ( $icon_position === 'inside' ) {
			$icon_inside = '<i class="' . esc_html( $icon ) . esc_html($arrow_size) . '"></i>';
		}
		$arrow_left_output .= $icon_outside;
		if ( $previous_label !== '' ) {
			$arrow_left_output .= '<span class="uncode-nav-label">' . wp_kses_post( $previous_label ) . '</span>';
		}
		$arrow_left_output .= $icon_inside;
		$arrow_left_output .= '</span></span></span></span>';//.uncode-nav-container .uncode-nav-prev

		if ( ! ( $arrow_right_order !== '' && $arrow_left_order !== '' && $arrow_right_order === $arrow_left_order ) ) {
			$output .= $arrow_left_output;
		}
	}

	if ( $arrows_position === '' && $dots_position === '' && $counter_position === '' && $hide_arrows === '' && $hide_dots === '' && $hide_counter === '' && $dots_order === $counter_order ) {
		$output .= '<span class="uncode-nav-dots-wrap' . ( $dots_order !== '' ? ' nav-ordered order-' . $dots_order : '' ) . '">';
	}

	if ( $hide_counter !== 'yes' ) {
		$counter_class[] = 'uncode-nav-counter';
		if ( $position !== '' && isset($hover) && $hover !== '' ) {
			$counter_class[] = 'anim-' . ( $counter_animation === '' ? 'straight' : $counter_animation );
		}
		if ( $counter_order !== '' && $dots_order !== $counter_order ) {
			$counter_class[] = 'nav-ordered order-' . $counter_order;
		}

		$output .= '<span class="' . esc_attr(trim(implode( ' ', $counter_class ))) . '">';
		$output .= '<span class="uncode-nav-counter-index">';
		$output .= '</span>';//.uncode-nav-counter-index
		if ( $hide_counter_total !== 'yes' ) {
			$output .= '<span class="uncode-nav-counter-separator' . ($counter_sep !== '' ? ' custom-counter-separator' : '') . ($hide_counter_total === 'opacity' ? ' counter-opacity' : '') . '">';
				$output .= $counter_sep !== '' ? esc_html( $counter_sep ) : '';
			$output .= '</span>';//.uncode-nav-counter-separator
			$output .= '<span class="uncode-nav-counter-total' . ($hide_counter_total === 'opacity' ? ' counter-opacity' : '') . '">';
			$output .= '</span>';//.uncode-nav-counter-total
		}
		$output .= '</span>';//.uncode-nav-counter
	}

	if ( $hide_dots !== 'yes' ) {
		$dots_class[] = 'uncode-nav-dots';
		if ( $position !== '' && isset($hover) && $hover !== '' ) {
			$dots_class[] = 'anim-' . ( $dots_animation === '' ? 'straight' : $dots_animation );
		}
		if ( $dots_order !== '' && $dots_order !== $counter_order ) {
			$dots_class[] = 'nav-ordered order-' . $dots_order;
		}

		$output .= '<span class="' . esc_attr(trim(implode( ' ', $dots_class ))) . '">';
		$output .= '</span>';//.uncode-nav-dots
	}

	if ( $arrows_position === '' && $dots_position === '' && $counter_position === '' && $hide_arrows === '' && $hide_dots === '' && $hide_counter === '' && $dots_order === $counter_order ) {
		$output .= '</span>'; // .uncode-nav-dots-wrap
	}

	if ( $hide_arrows !== 'yes' ) {
		if ( ( $arrow_right_order !== '' && $arrow_left_order !== '' && $arrow_right_order === $arrow_left_order ) ) {
			$output .= '<div class="uncode-nav-prev-next nav-ordered order-' . $arrow_right_order . '">';
			$output .= $arrow_left_output;
		}

		$output .= '<span class="uncode-nav-next' . $arrow_anim_class . ( $magnetic_arrows !== '' ? ' un-magnetic-zone' : '' ) . ( $arrow_right_order !== '' && $arrow_right_order !== $arrow_left_order ? ' nav-ordered order-' . $arrow_right_order : '' ) . '"><span class="uncode-nav-container-wrap"><span class="' . esc_attr(trim(implode( ' ', $arrow_class ))) . '"><span>';
		$output .= $icon_inside;
		if ( $next_label !== '' ) {
			$output .= '<span class="uncode-nav-label">' . wp_kses_post( $next_label ) . '</span>';
		}
		$output .= $icon_outside;
		$output .= '</span></span></span></span>';//.uncode-nav-container .uncode-nav-next

		if ( ( $arrow_right_order !== '' && $arrow_left_order !== '' && $arrow_right_order === $arrow_left_order ) ) {
			$output .= '</div>';//.uncode-nav-prev-next
		}
	}

	$output .= '<span class="uncode-nav-limit-after"></span>';// placeholder
	$output .= '</div>';//.uncode-owl-nav-safe
	$output .= '</div>';//.uncode-owl-nav-in
	$output .= uncode_print_dynamic_inline_style( $inline_style_css );
	$output .= '</div>';//.uncode-owl-nav
	$output .= '</div>';//.uncode-owl-nav-out

	$counter_nav ++;
}
$output .= '</div>';//.uncode-owl-nav-wrap
echo uncode_remove_p_tag($output);