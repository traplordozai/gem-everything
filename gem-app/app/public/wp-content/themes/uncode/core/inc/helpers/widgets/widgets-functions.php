<?php
/**
 * Widgets functions
 */


/**
 * Function that gets the unique ID of the widget
 */
function uncode_get_widget_module_id() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['widget_counter'] ) ) {
		$counter = $uncode_post_data['widget_counter'];
	} else {
		$counter = 0;
	}

	$counter++;

	$uncode_post_data['widget_counter'] = $counter;

	return $counter;
}
