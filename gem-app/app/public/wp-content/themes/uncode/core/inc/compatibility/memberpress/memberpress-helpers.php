<?php
/**
 * MemberPress helpers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Check if MemberPress is active
if ( ! class_exists( 'MeprRulesCtrl' ) ) {
	return;
}

if ( ! class_exists( 'Uncode_Mepr' ) ) :

/**
 * Uncode_Mepr Class
 */
class Uncode_Mepr {

	/**
	 * Construct.
	 */
	public function __construct() {
		add_filter( 'uncode_apply_the_content', array( $this, 'apply_the_content' ) );
        if ( apply_filters( 'uncode_mp_single_content_raw', '__return_true' ) ) {
            add_filter( 'uncode_get_single_content_raw', 'MeprRulesCtrl::rule_content', 999999, 1 );
        }
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

return new Uncode_Mepr();
