<?php
/**
 * Widget functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add custom widgets
 */
function uncode_core_add_widgets() {
	if ( class_exists( 'WooCommerce' ) ) {
		include_once UNCODE_CORE_PLUGIN_DIR . '/includes/widgets/widget-sorting.php';
		register_widget( 'Uncode_WC_Widget_Sorting' );
	}
}
add_action( 'widgets_init', 'uncode_core_add_widgets' );
