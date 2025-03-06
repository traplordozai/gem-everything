<?php
/**
 * Admin functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add admin bar Uncode support button
 */
function uncode_support_admin_bar_menu( $wp_admin_bar ) {
	if ( ! function_exists( '_uncode_admin_help' ) || ! is_admin_bar_showing() || ot_get_option('_uncode_admin_help') === 'off' || defined('ENVATO_HOSTED_SITE') ) {
		return;
	}

	$wp_admin_bar->add_node( array(
		'id'      => 'uncode-help',
		'title'   => esc_html__( 'Uncode Help Center', 'uncode-core' ),
		'href'    => 'https://support.undsgn.com/hc/',
		'meta'    => array( 'class' => 'uncode-support', 'target' => '_blank' )
	) );
}

add_action( 'admin_bar_menu', 'uncode_support_admin_bar_menu', 9999 );

/**
* Register menu widget
*/
function uncode_custom_menu_widget() {
	register_widget("Uncode_Nav_Menu_Widget");
}

/**
 * Add secondary featured image.
 */
if ( is_admin() ) {
	require_once UNCODE_CORE_PLUGIN_DIR . '/includes/class-featured-images.php';
}
