<?php
$output = $vertical = $valign_middle = $history = $target = $interval = $el_id = $el_class = $data_check_tab = $align = $width_100 = $border_100 = $typography = $titles_font = $titles_size = $titles_weight = $titles_transform = $titles_height = $titles_space = $excerpt_text_size = $tab_tablet_bp = $tab_custom_size = $tab_size = $tab_gap = $tabs_align = $tab_no_border = $tab_switch = $animation_active = $tabs_event = $tab_no_fade = $tab_hover = $active_bg_color = $active_bg_color_type = $active_bg_color_solid = $active_bg_color_gradient = $active_txt_color = $active_txt_color_type = $active_txt_color_solid = $active_txt_color_gradient = $radius = $shadow = $shadow_darker = $custom_padding = $gutter_tab = $tab_h_border = $no_lazy = $accordion_bp = '';

global $history_tab, $first_tab_active, $product, $tab_no_fade;

$first_tab_active = true;

extract( shortcode_atts( array(
	'uncode_shortcode_id' => '',
	'vertical' => '',
	'valign_middle' => '',
	'history' => '',
	'target' => '',
	'align' => '',
	'width_100' => '',
	'border_100' => '',
	'tab_scrolling' => '',
	'el_id' => '',
	'el_class' => '',
	'product_from_builder' => '',
	'typography' => '',
	'titles_font' => '',
	'titles_size' => '',
	'heading_custom_size' => '',
	'titles_weight' => '',
	'titles_transform' => '',
	'titles_height' => '',
	'titles_space' => '',
	'excerpt_text_size' => '',
	'tab_tablet_bp' => '',
	'accordion_bp' => '',
	'tab_custom_size' => '',
	'tab_size' => 3,
	'tab_gap' => 2,
	'tabs_align' => '',
	'tab_no_border' => '',
	'tab_h_border' => '',
	'radius' => '',
	'shadow' => '',
	'shadow_darker' => '',
	'custom_padding' => '',
	'gutter_tab' => '',
	'no_h_padding' => '',
	'tab_switch' => '',
	'animation_active' => '',
	'tabs_event' => '',
	'tab_no_fade' => '',
	'tab_hover' => '',
	'no_lazy' => '',
	'active_bg_color' => '',
	'active_bg_color_type' => 'uncode-palette',
	'active_bg_color_solid' => '',
	'active_bg_color_gradient' => '',
	'active_txt_color' => '',
	'active_txt_color_type' => 'uncode-palette',
	'active_txt_color_solid' => '',
	'active_txt_color_gradient' => '',
), $atts ) );

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$history_tab = $history;

$el_class = $this->getExtraClass( $el_class );
$tabs_wrap_class = array();
$tabs_class = array();
$tab_excerpts_class = array();

$element = 'uncode-tabs';

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();

if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}

if ( $vertical !== 'yes' ) {
	switch ( $align ) {
		case 'left':
			$tabs_class[] = 'text-left';
			break;

		case 'right':
			$tabs_class[] = 'text-right';
			break;

		default:
		$tabs_class[] = 'text-center';
		break;
	}
}

if ( $tab_hover === 'yes' ) {
	$tabs_class[] = 'tab-hover';	
}

if ( $width_100 === 'yes' && $vertical !== 'yes' ) {
	$tabs_class[] = 'width-100';
}

if ( $border_100 === 'yes' && $vertical !== 'yes' ) {
	$el_class .= ' border-100';
}

if ( $tab_scrolling === 'yes' && $vertical !== 'yes' ) {
	$el_class .= ' tab-scrolling';
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

$active_bg_color = uncode_get_shortcode_color_attribute_value( 'active_bg_color', $uncode_shortcode_id, $active_bg_color_type, $active_bg_color, $active_bg_color_solid, $active_bg_color_gradient );
$active_txt_color = uncode_get_shortcode_color_attribute_value( 'active_txt_color', $uncode_shortcode_id, $active_txt_color_type, $active_txt_color, $active_txt_color_solid, $active_txt_color_gradient );

$tabs_nav = '<div class="vc_tta-tabs-container';
$wrapper_class = $product || $product_from_builder ? ' wootabs' : '';

if ($vertical === 'yes') {
	$tabs_class[] = 'tabs-vertical';
	$tabs_nav .= ' vertical-tab-menu';
	$el_class .= ($valign_middle !== '') ? ' vertical-middle' : '';

	if ( $tab_custom_size === 'yes' ) {
		$tabs_nav .= ' col-lg-' . floatval($tab_size);
		$tabs_nav .= ' col-md-' . floatval($tab_size);
		$wrapper_class .= ' tab-' . floatval($tab_gap) . '-gutter';
	}
} else {
	if ( $tab_switch !== '' ) {
		$tabs_class[] = 'tab-switch';
		$el_class .= ' tab-scrolling';
	}
}

if ( $vertical === 'yes' && $tab_tablet_bp === 'yes' ) {
	$wrapper_class .= ' tab-tablet-bp';	
}

if ( $accordion_bp === 'yes' ) {
	$wrapper_class .= ' tabs-breakpoint';
}

if ( $tab_no_border !== '' || ( $tab_switch !== '' && $vertical !== 'yes' ) ) {
	$tabs_class[] = 'tab-no-border';
	$element .= ' tab-no-border';
}

if ( $tab_h_border === 'yes' ) {
	$tabs_class[] = 'tab-h-border';
}

if ( $animation_active !== '' ) {
	$tabs_class[] = 'tab-active-anim';
}

$tabs_advanced = array();
if( $typography === 'advanced' ) {
	$tabs_advanced[] = $titles_font;
	$tabs_advanced[] = $titles_size;
	if ($titles_size === 'custom' && $heading_custom_size !== '') {
		$tabs_advanced[] = 'fontsize-' . $uncode_shortcode_id . '-custom';
	}
	$tabs_advanced[] = $titles_weight !== '' ? 'font-weight-' . $titles_weight : '';
	$tabs_advanced[] = $titles_transform !== '' ? 'text-' . $titles_transform : '';
	$tabs_advanced[] = $titles_height;
	$tabs_advanced[] = $titles_space;
}

$tab_excerpts_class = array('tab-excerpt');
if ($excerpt_text_size === 'yes') {
	$tab_excerpts_class[] = 'text-lead';
} else if ($excerpt_text_size === 'small') {
	$tab_excerpts_class[] = 'text-small';
}

$tabs_nav .= '">';
if ( ( $tab_scrolling === 'yes' || $tab_switch !== '' ) && $vertical !== 'yes'  ) {
	$tabs_nav .= '<div class="vc_tta-tabs-scroller ' . esc_attr(trim(implode(' ', $tabs_class))) . '">';
}

$tabs_nav .= '<ul class="nav nav-tabs wpb_tabs_nav ui-tabs-nav vc_tta-tabs-list'.(($vertical === 'yes') ? ' tabs-left' : '') . ' ' . esc_attr(trim(implode(' ', $tabs_class))) . '">';
$counter = 0;
$data_class_str = '';
$data_class = array();
$remove_padding = true;
if (!empty($active_bg_color) && function_exists('vc_is_page_editable') && vc_is_page_editable()) {
	$data_class[] = 'has-active-bg';
	$data_class[] = 'style-' . $active_bg_color . '-bg';
	$remove_padding = false;
}

if (!empty($active_txt_color) && function_exists('vc_is_page_editable') && vc_is_page_editable()) {
	$data_class[] = 'has-active-color';
	$data_class[] = 'text-' . $active_txt_color . '-color';
}

if ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
	
	$data_class[] = $radius !== '' ? 'unradius-' . $radius : '';

	if ($shadow !== '') {
	
		if ( $shadow_darker !== '' ) {
			$shadow = 'darker-' . $shadow;
		}
		$data_class[] = 'unshadow-' . $shadow;
		$remove_padding = false;
	}
	
}

if ( $tab_custom_size === 'yes' ) {
	if ( $remove_padding === true && function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
		$data_class[] = 'remove-padding';
	} else {
		$data_class[] = 'maybe-padding';
	}

	if (function_exists('vc_is_page_editable') && vc_is_page_editable() && $custom_padding === 'yes') {
		switch ($gutter_tab) {
			case 0:
				$data_class[] = 'no-block-padding has-padding';
			break;
			case 1:
				$data_class[] = 'half-block-padding has-padding';
			break;
			case 2:
				$data_class[] = 'single-block-padding has-padding';
			break;
			case 3:
				$data_class[] = 'double-block-padding has-padding';
			break;
		}

		if ( $no_h_padding === 'yes' ) {
			$data_class[] = 'no-h-padding';
		}
	}

}

$link_class = '';

if (!empty($data_class) && function_exists('vc_is_page_editable') && vc_is_page_editable()) {
	$data_class_str = ' data-class="' . esc_attr(trim(implode(' ' , $data_class))) . '"';
}

foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts($tab[0]);

	if(isset($tab_atts['title'])) {
		$li_class = array('vc_tta-tab');

		$li_class[] = $radius !== '' ? 'unradius-' . $radius : '';
	
		if ($shadow !== '') {
		
			if ( $shadow_darker !== '' ) {
				$li_class[] = 'darker-' . $shadow;
			}
			$li_class[] = 'unshadow-' . $shadow;

			$remove_padding = false;
		}
		
		if (!empty($active_bg_color)) {
			$li_class[] = 'has-active-bg';
			$li_class[] = 'style-' . $active_bg_color . '-bg';
			$remove_padding = false;
		}
		
		if (!empty($active_txt_color)) {
			$li_class[] = 'has-active-color';
			$li_class[] = 'text-' . $active_txt_color . '-color';
		}

		if ( $tab_custom_size === 'yes' ) {
			if ($remove_padding === true) {
				$li_class[] = 'remove-padding';
			} else {
				$li_class[] = 'maybe-padding';
			}

			if ( $custom_padding === 'yes' ) {
				switch ($gutter_tab) {
					case 0:
						$li_class[] = 'no-block-padding has-padding';
					break;
					case 1:
						$li_class[] = 'half-block-padding has-padding';
						$link_class = 'half-block-padding has-padding';
					break;
					case 2:
						$li_class[] = 'single-block-padding has-padding';
						$link_class = 'single-block-padding has-padding';
					break;
					case 3:
						$li_class[] = 'double-block-padding has-padding';
						$link_class = 'double-block-padding has-padding';
					break;
				}

				if ( $no_h_padding === 'yes' ) {
					$li_class[] = 'no-h-padding';
				}
			}
			
		}

		$link_class = $link_class !== '' ? ' class="' . $link_class . '"' : '';
		
		$icon = isset( $tab_atts['icon'] ) ? $tab_atts['icon'] : '';
		$icon_position = isset( $tab_atts['icon_position'] ) ? $tab_atts['icon_position'] : '';
		$icon_size = isset( $tab_atts['icon_size'] ) ? $tab_atts['icon_size'] : '';
		if ( $icon !== '' ) {
			$icon = '<span class="icon-tab ' . esc_attr(trim(implode(' ', $tabs_advanced))) . ' icon-order-' . floatval($icon_position === 'right') . '"><i class="' . esc_attr($icon) . ' icon-position-' . esc_attr($icon_position ? $icon_position : 'left') . ' icon-size-' . esc_attr($icon_size ? $icon_size : 'rg') . '"></i></span>';
			$li_class[] = 'icon-position-' . esc_attr($icon_position ? $icon_position : 'left');
		}
	
		if ( isset( $tab_atts['slug'] ) && $tab_atts['slug'] !== '' ) {
			$hash = sanitize_title( $tab_atts['slug'] );	
		} else {
			$hash = 'tab-';
			if ( isset( $tab_atts['tab_id'] ) ) {
				$hash .= $tab_atts['tab_id'];
			} else {
				$hash .= sanitize_title( $tab_atts['title'] );
			}
		}
		$excerpt = $a_title = $a_target = $a_rel ='';
		if ( isset($tab_atts['excerpt']) && $vertical === 'yes' ) {
			$excerpt = '<span class="' . esc_attr(trim(implode(' ', $tab_excerpts_class))) . '">' . wp_kses( $tab_atts['excerpt'], array( 'strong' => array(), 'em' => array(), 'b' => array(), 'i' => array(), 'br' => array(), 'span' => array( 'class' => array() ) ) );
		}
		
		if ( isset($tab_atts['link']) && $vertical === 'yes' ) {
			$link = ( $tab_atts['link'] == '||' ) ? '' : $tab_atts['link'];
			$link = vc_build_link( $link );
			$a_href = $link['url'];
			if ($link['title'] !== '') {
				$a_title = ' title="' . esc_attr( $link['title'] ) . '"';
			}
			if ($link['target'] !== '') {
				$a_target = ' data-target="' . esc_attr( trim($link['target']) ) . '"';
			}
			if ($link['rel'] !== '') {
				$a_rel = ' rel="' . esc_attr( trim($link['rel']) ) . '"';
			}
			if ($link !== '') {
				if ( $a_href !== '' && $a_title !== '' ) {
					$excerpt .= '<span class="tab-excerpt-link color-accent-color" data-href="'. $a_href.'"'.$a_title.$a_target.$a_rel.'>' . esc_attr( $link['title'] ) . '</span>';
				}
			}
		}

		if ( isset($tab_atts['excerpt']) && $vertical === 'yes' ) {
			$excerpt .= '</span>';
		}
		
		$history_rend = $history !== '' ? ' data-tab-history="true" data-tab-history-changer="push" data-tab-history-update-url="true"' : '';
		$tabs_nav .= '<li data-tab-id="' . esc_attr( $hash ) . '" data-tab-o-id="' . esc_attr( $tab_atts['tab_id'] ) . '" class="' . esc_attr(trim(implode(' ' , $li_class))) .(($counter === 0) ? ' active' : '').'"><a href="#' . esc_attr( $hash ) . '" data-toggle="tab"' . $history_rend . $link_class . '><span>' . $icon . '<span><span class="' . esc_attr(trim(implode(' ', $tabs_advanced))) . '">' . $tab_atts['title'] . '</span>' . $excerpt . '</span></span></a></li>';
	}
	$counter++;
}
$tabs_nav .= '</ul>';
if ( ( $tab_scrolling === 'yes' || $tab_switch !== '' ) && $vertical !== 'yes'  ) {
	$tabs_nav .= '</div>';
}
$tabs_nav .= '</div>';

if( $tabs_event !== '' ) {
	$el_class .= ' tabs-trigger-' . esc_attr( $tabs_event );
}

if ( $no_lazy === 'yes' ) {
	$el_class .= ' tabs-no-lazy';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

if ( $typography !== '' ) {
	$wrapper_class .= ' default-typography';
	if ( $typography === 'advanced' ) {
		$wrapper_class .= ' advanced-typography';
	}
}

if ($vertical === 'yes' ) {
	$wrapper_class .= ' vertical-tab-wrapper';
	if ( $tabs_align === 'opposite' ) {
		$wrapper_class .= ' vertical-tab-menu-opposite';
	}
}


$output .= '<div class="' . esc_attr($css_class) . '" data-interval="' . esc_attr($interval) . '" ' . $el_id . ' data-target="' . esc_attr( $target ) . '"' . $data_class_str . '>';
$output .= '<div class="uncode-wrapper tab-container' . $wrapper_class . '">';
$output .= $tabs_nav;
if ($vertical === 'yes') {
	$content_class = 'vertical-tab-contents';
	if ( $tab_custom_size === 'yes' ) {
		$content_class .= ' col-lg-' . ( 12 - floatval($tab_size) );
		$content_class .= ' col-md-' . ( 12 - floatval($tab_size) );
	}
	$output .= '<div class="' . esc_attr($content_class) . '">';
}
$output .= '<div class="tab-content'.(($vertical === 'yes') ? ' vertical' : '').' wpb_wrapper">';
$output .= $content;
$output .= '</div>';
if ($vertical === 'yes') {
	$output .= '</div>';
}
$output .= '</div>';
$output .= uncode_print_dynamic_inline_style( $inline_style_css );
$output .= '</div>';

echo uncode_remove_p_tag($output);
$history_tab = $tab_no_fade = '';
