<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$output = '';

extract(shortcode_atts(array(
	'title' => '',
	'show_clear' => '',
	'display' => '',
	'el_id' => '',
	'el_class' => '',
	'use_widget_style' => '',
	'widget_desktop_collapse' => '',
	'widget_collapse' => '',
	'widget_collapse_tablet' => '',
	'widget_collapse_icon' => '',
	'widget_style_no_separator' => '',
	'widget_style_title_typography' => '',
	'desktop_visibility' => '',
	'medium_visibility' => '',
	'mobile_visibility' => '',
), $atts));

if ( $el_id !== '' ) {
	$el_id = ' id="' . esc_attr( trim( $el_id ) ) . '"';
} else {
	$el_id = '';
}

$el_class = $this->getExtraClass( $el_class );

if ($desktop_visibility === 'yes') {
	$el_class .= ' desktop-hidden';
}
if ($medium_visibility === 'yes') {
	$el_class .= ' tablet-hidden';
}
if ($mobile_visibility === 'yes') {
	$el_class .= ' mobile-hidden';
}

if ( $use_widget_style === 'yes' && $widget_style_no_separator === 'yes' ) {
	$el_class .= ' widget-no-separator';
}

$widget_open = $widget_is_collapse = '';
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
	}

	if ( $widget_collapse_tablet === 'yes' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-tablet-collapse';
	} elseif ( $widget_collapse_tablet === 'click' ) {
		$widget_is_collapse = ' widget-collapse';
		$widget_class .= ' widget-tablet-collapse widget-tablet-collapse-open';
	} else {
		$widget_class .= ' widget-no-tablet-collapse';
	}

	$el_class .= $widget_is_collapse . $widget_class;

	$widget_class .= ' widget-collaps-icon' . $widget_collapse_icon;
}

if ( $use_widget_style === 'yes' && $widget_style_title_typography ) {
	$el_class .= ' widget-typography-' . $widget_style_title_typography;
}

$show_clear = $show_clear === 'yes' ? true : false;

ob_start();
echo uncode_show_active_ajax_filters( 'left', $show_clear, '', $display );
$active_filters_output = ob_get_clean();
?>

<?php if ( $active_filters_output ) : ?>
	<div class="uncode_widget widget-ajax-active-filters wpb_content_element<?php echo esc_attr( $el_class ); ?>" <?php echo uncode_switch_stock_string( $el_id ); ?>>
		<?php if ( $use_widget_style === 'yes' ) : ?>
			<aside class="widget widget-style widget-container sidebar-widgets">
		<?php endif; ?>

		<?php if ( $title ) : ?>
			<?php $title_tag = apply_filters( 'uncode_widget_title_tag', 'h3' ); ?>
			<?php if ( $use_widget_style === 'yes' ) : ?>
				<<?php echo esc_attr( $title_tag); ?> class="widget-title<?php echo uncode_switch_stock_string( $widget_open ); ?>"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_tag); ?>>
			<?php else : ?>
				<<?php echo esc_attr( $title_tag); ?> class="widgettitle"><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_tag); ?>>
			<?php endif; ?>
			<?php if ( $widget_is_collapse !== '' ) : ?>
				<div class="widget-collapse-content">
			<?php endif; ?>
		<?php endif; ?>

		<?php echo uncode_switch_stock_string( $active_filters_output ); ?>

		<?php if ( $use_widget_style === 'yes' ) : ?>
			<?php if ( $title && $widget_is_collapse !== '' ) : ?>
				</div>
			<?php endif; ?>
			</aside>
		<?php endif; ?>
	</div>
<?php endif; ?>
