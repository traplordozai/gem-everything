<?php
/**
 * Post Data template related functions
 */

/**
 * Check if is a singular template
 */
function uncode_post_data_is_singular() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_singular'] ) && $uncode_post_data['is_singular'] && isset( $uncode_post_data['ID'] ) && $uncode_post_data['ID'] > 0 && isset( $uncode_post_data['post_type'] ) ) {
		return true;
	}

	return false;
}

/**
 * Check if is an archive template
 */
function uncode_post_data_is_archive() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_archive'] ) && $uncode_post_data['is_archive'] ) {
		return true;
	}

	return false;
}

/**
 * Check if is a 404 template
 */
function uncode_post_data_is_404() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_404'] ) && $uncode_post_data['is_404'] ) {
		return true;
	}

	return false;
}

/**
 * Check if is a search template
 */
function uncode_post_data_is_search() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_search'] ) && $uncode_post_data['is_search'] ) {
		return true;
	}

	return false;
}

/**
 * Check if is a category template
 */
function uncode_post_data_is_category() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_category'] ) && $uncode_post_data['is_category'] ) {
		return true;
	}

	return false;
}

/**
 * Check if is a tag template
 */
function uncode_post_data_is_tag() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_tag'] ) && $uncode_post_data['is_tag'] ) {
		return true;
	}

	return false;
}

/**
 * Check if is an author template
 */
function uncode_post_data_is_author() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_author'] ) && $uncode_post_data['is_author'] ) {
		return true;
	}

	return false;
}

/**
 * Check if is a date template
 */
function uncode_post_data_is_date() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_date'] ) && $uncode_post_data['is_date'] ) {
		return true;
	}

	return false;
}

/**
 * Check if is a post type archive template
 */
function uncode_post_data_is_post_type_archive() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_post_type_archive'] ) && $uncode_post_data['is_post_type_archive'] ) {
		return true;
	}

	return false;
}

/**
 * Check if is a taxonomy template
 */
function uncode_post_data_is_tax() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_tax'] ) && $uncode_post_data['is_tax'] ) {
		return true;
	}

	return false;
}

/**
 * Check if is the home template
 */
function uncode_post_data_is_home() {
	global $uncode_post_data;

	if ( isset( $uncode_post_data['is_home'] ) && $uncode_post_data['is_home'] ) {
		return true;
	}

	return false;
}
