<?php

/**
* VC scripts.
*/
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/scripts.php';

/**
* Init front scripts and functions.
*/
function uncode_init_front_custom_vc() {
	if ( ! defined( 'UNCODE_SLIM' ) ) {
		return;
	}

	add_action('wp_enqueue_scripts','uncode_dequeue_visual_composer');
	add_action('template_redirect','uncode_dequeue_visual_composer');
	remove_action('wp_head', array(visual_composer(), 'addMetaData'));
	remove_action('template_redirect', array(visual_composer(), 'frontCss'));
	require_once 'config/override_map.php';
}
add_action('init', 'uncode_init_front_custom_vc', 1000);

/**
* Init backend scripts and functions.
*/
function uncode_init_back_custom_vc() {
	if ( ! defined( 'UNCODE_SLIM' ) ) {
		return;
	}

	require_once 'config/override_map.php';
	require_once 'remove_components.php';
	require_once 'add_components.php';
}
add_action('admin_init', 'uncode_init_back_custom_vc');

/**
* VC class extends.
*/
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/extends.php';

/**
* Post module matrix.
*/
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/matrix-functions.php';

/**
* VC related actions.
*/
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/actions.php';

/**
* VC related filters.
*/
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/filters.php';

/**
* Loop settings.
*/
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/vc-loop-settings.php';

/**
* Frontend editor shortcuts.
*/
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/shortcuts.php';

/**
* WooCommerce functions.
*/
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/woocommerce/init.php';
