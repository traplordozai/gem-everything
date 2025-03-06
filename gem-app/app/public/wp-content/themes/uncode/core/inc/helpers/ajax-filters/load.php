<?php
/**
 * Init Ajax Filters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Main functions
 */
require_once get_template_directory() . '/core/inc/helpers/ajax-filters/ajax-filters.php';
require_once get_template_directory() . '/core/inc/helpers/ajax-filters/ajax-filters-views.php';
require_once get_template_directory() . '/core/inc/helpers/ajax-filters/ajax-filters-query.php';
require_once get_template_directory() . '/core/inc/helpers/ajax-filters/ajax-filters-cache.php';
require_once get_template_directory() . '/core/inc/helpers/ajax-filters/class-uncode-walker-filters.php';
