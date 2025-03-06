<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $url
 * @var $items
 * @var $options
 * @var $el_class
 * @var $el_id
 * Shortcode class
 * @var WPBakeryShortCode_Vc_Wp_Rss $this
 */
$title = $url = $items = $options = $el_class = $el_id = '';

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts['url'] = html_entity_decode( $atts['url'], ENT_QUOTES ); // fix #2034
extract( $atts );

if ( '' === $url ) {
	return;
}

$options = explode( ',', $options );
if ( in_array( 'show_summary', $options, true ) ) {
	$atts['show_summary'] = true;
}
if ( in_array( 'show_author', $options, true ) ) {
	$atts['show_author'] = true;
}
if ( in_array( 'show_date', $options, true ) ) {
	$atts['show_date'] = true;
}

$el_class = $this->getExtraClass( $el_class );
$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if ( $atts['use_widget_style'] === 'yes' && $atts['widget_style_no_separator'] === 'yes' ) {
	$el_class .= ' widget-no-separator';
}

if ( $atts['use_widget_style'] === 'yes' ) {
	if ( $atts['widget_desktop_collapse'] === 'yes' ) {
		$el_class .= ' widget-desktop-collapse';
	} elseif ( $atts['widget_desktop_collapse'] === 'click' ) {
		$el_class .= ' widget-desktop-collapse  widget-desktop-collapse-open';
	}

	if ( $atts['widget_collapse'] === 'yes' ) {
		$el_class .= ' widget-mobile-collapse';
	} elseif ( $atts['widget_collapse'] === 'click' ) {
		$el_class .= ' widget-mobile-collapse  widget-mobile-collapse-open';
	}

	if ( $atts['widget_collapse_tablet'] === 'yes' ) {
		$el_class .= ' widget-tablet-collapse';
	} elseif ( $atts['widget_collapse_tablet'] === 'click' ) {
		$el_class .= ' widget-tablet-collapse  widget-tablet-collapse-open';
	} else {
		$el_class .= ' widget-no-tablet-collapse';
	}

	if ( isset($atts['widget_collapse_icon']) ) {
		$widget_class .= ' widget-collaps-icon' . $atts['widget_collapse_icon'];
	} else {
		$widget_class .= ' widget-collaps-icon';
	}
}


if ( $atts['use_widget_style'] === 'yes' && $atts['widget_style_title_typography'] ) {
	$el_class .= ' widget-typography-' . $widget_style_title_typography;
}

$widget_unique_id = uncode_get_widget_module_id();

$output = '<div ' . implode( ' ', $wrapper_attributes ) . ' class="vc_wp_rss wpb_content_element' . esc_attr( $el_class ) . '" data-id="' . esc_attr( $widget_unique_id ) . '">';
$type = 'WP_Widget_RSS';
$args = array();
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$widget = ob_get_clean();
	$output .= $widget;

	$output .= '</div>';

	return $output;
}
