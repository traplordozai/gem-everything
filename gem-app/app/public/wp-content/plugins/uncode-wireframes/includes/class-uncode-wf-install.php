<?php
/**
 * Install Functions
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'UNCDWF_Install' ) ) :

/**
 * UNCDWF_Install Class
 */
class UNCDWF_Install {

	/**
	 * Install Uncode Wireframe
	 */
	public static function install() {
		UNCDWF_Import::import();
	}
}

endif;

// UNCDWF_Install::init();
