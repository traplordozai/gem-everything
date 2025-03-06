<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$output = '';

extract(shortcode_atts(array(
	'title' => '',
	'hide_title' => '',
	'el_id' => '',
	'el_class' => '',
	'use_widget_style' => '',
	'widget_desktop_collapse' => '',
	'widget_collapse' => '',
	'widget_collapse_tablet' => '',
	'widget_collapse_icon' => '',
	'widget_style_no_separator' => '',
	'widget_style_title_typography' => '',
), $atts));

if ( $hide_title === 'yes' ) {
	$atts['title'] = '!';
}

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$el_class = $this->getExtraClass( $el_class );

if ( $use_widget_style === 'yes' && $widget_style_no_separator === 'yes' ) {
	$el_class .= ' widget-no-separator';
}

$widget_open = $widget_is_collapse = '';
$_args = array();
if ( $use_widget_style === 'yes' ) {
	$widget_class = '';
	if ( $widget_desktop_collapse === 'yes' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-desktop-collapse';
	} elseif ( $widget_desktop_collapse === 'click' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-desktop-collapse widget-desktop-collapse-open';
		$widget_open = ' open';
	}

	if ( $widget_collapse === 'yes' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-mobile-collapse';
	} elseif ( $widget_collapse === 'click' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-mobile-collapse widget-mobile-collapse-open';
		$widget_open = ' open';
	}

	if ( $widget_collapse_tablet === 'yes' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-tablet-collapse';
	} elseif ( $widget_collapse_tablet === 'click' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-tablet-collapse widget-tablet-collapse-open';
		$widget_open = ' open';
	} else {
		$widget_class .= ' widget-no-tablet-collapse';
	}

	$widget_class .= ' widget-collaps-icon' . $widget_collapse_icon;

	$el_class .= $widget_is_collapse . $widget_class;
	if ( $widget_is_collapse !== '' ) {
		$tag = apply_filters( 'uncode_widget_title_tag', 'h3' );
		$_args['after_widget'] = '</div></aside>';
		$_args['after_title'] = '</' . $tag . '><div class="widget-collapse-content">';
	}
}

if ( $use_widget_style === 'yes' && $widget_style_title_typography ) {
	$el_class .= ' widget-typography-' . $widget_style_title_typography;
}

$widget_unique_id = uncode_get_widget_module_id();

$output = '<div class="uncode_woocommerce_widget uncode_woocommerce_widget--layered-nav-filters wpb_content_element' . esc_attr( $el_class ) . '" ' . $el_id . ' data-id="' . esc_attr( $widget_unique_id ) . '">';
$type = 'WC_Widget_Layered_Nav_Filters';
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	$args = $use_widget_style === 'yes' ? uncode_get_default_widget_args( 'layered_nav_filters', $_args ) : array();
	the_widget( $type, $atts, $args );
	$widget = ob_get_clean();

	if ( $widget ) { // don't print the widget if empty (no active filters)
		if ( $use_widget_style === 'yes' && $widget_collapse === 'yes' ) {
			$widget = uncode_add_default_widget_title( $widget, false, esc_html__( 'Active Filters', 'uncode' ) );
		}
		$output .= $widget;
		$output .= '</div>';

		echo uncode_switch_stock_string( $output );
	}
}
