<?php
/**
 * Frontend editor shortcuts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Allow frontend editor shortcuts in TinyMce editors
 */
function uncode_add_tinymce_shortcut_plugin( $plugin_array ) {
	if ( apply_filters( 'uncode_enable_front_editor_shortkeys_in_tinymce', true ) && function_exists('vc_is_frontend_editor') && vc_is_frontend_editor() ) {
		$plugin_array[ 'uncode_shortcuts' ] = UNCODE_CORE_PLUGIN_URL . 'includes/vc_extend/assets/js/uncode_shortcuts.js';
	}

	return $plugin_array;
}
add_filter( 'mce_external_plugins', 'uncode_add_tinymce_shortcut_plugin' );

/**
 * Define front editor configuration.
 */
function uncode_core_get_front_editor_shortkeys_configuration() {
	$conf = array(
		'enable_front_editor_shortkeys'            => apply_filters( 'uncode_enable_front_editor_shortkeys', true ),
		'enable_front_editor_shortkeys_in_tinymce' => apply_filters( 'uncode_enable_front_editor_shortkeys_in_tinymce', true ),
		'keys'                                     => uncode_core_get_front_editor_shortkeys()
	);

	return $conf;
}

/**
 * Define front editor shortkeys.
 */
function uncode_core_get_front_editor_shortkeys() {
	$keys = array(
		'save'     => 83, // s
		'close'    => 87, // w
		'left'     => 65, // a
		'right'    => 68, // d
		'modifier' => 'alt' // possible values = alt, ctrl, shift
	);

	$allowed_modifiers = array(
		'alt',
		'ctrl',
		'shift'
	);

	$keys = apply_filters( 'uncode_front_editor_shortkeys', $keys );

	if ( in_array( $keys[ 'modifier' ], $allowed_modifiers ) ) {
		$keys[ 'modifier' ] = $keys[ 'modifier' ] . 'Key';
	} else {
		$keys[ 'modifier' ] = 'altKey';
	}

	return $keys;
}
