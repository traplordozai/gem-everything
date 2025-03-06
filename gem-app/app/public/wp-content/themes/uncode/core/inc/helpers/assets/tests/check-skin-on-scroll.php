<?php
/**
 * Check Skin on Scroll test
 */

function uncode_page_require_check_skin_on_scroll() {
	if ( apply_filters( 'uncode_enqueue_check_skin_on_scroll', false ) ) {
		return true;
	}

	$menu_desktop_transparency = ot_get_option('_uncode_menu_desktop_transparency');
	$menu_mobile_transparency = ot_get_option('_uncode_menu_mobile_transparency_scroll');

	if ( $menu_desktop_transparency === 'on' || $menu_mobile_transparency === 'on' ) {
		return true;
	}

	return false;
}
