<?php
/**
 * MemberPress helpers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Check if BuddyPress is active
if ( ! class_exists( 'BuddyPress' ) ) {
	return;
}

if ( ! class_exists( 'Uncode_BuddyPress' ) ) :

/**
 * Uncode_BuddyPress Class
 */
class Uncode_BuddyPress {

	/**
	 * Construct.
	 */
	public function __construct() {
		add_filter( 'uncode_apply_the_content', array( $this, 'apply_the_content' ) );
	}
	
	/**
	 * Skip singular post
	 */
	public function apply_the_content() {
		if ( ! is_singular( 'post' ) ) {
			return true;
		}
		
		return false;
	}
}

endif;

return new Uncode_BuddyPress();
