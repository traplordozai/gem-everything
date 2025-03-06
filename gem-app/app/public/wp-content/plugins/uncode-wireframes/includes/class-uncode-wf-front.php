<?php
/**
 * Front Functions
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'UNCDWF_Front' ) ) :

/**
 * UNCDWF_Front Class
 */
class UNCDWF_Front {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Add wireframes
		add_action( 'vc_load_default_templates_action',  'uncode_wf_add_wireframes' );

		// Override default VC templates
		add_filter( 'vc_load_default_templates', array( $this, 'modify_default_templates' ) );

		// Initialize dynamic class when loading a template via AJAX
		add_action( 'uncode_render_frontend_template', 'uncode_wf_initialize_dynamic_class' );

		// Override gettext
		add_filter( 'gettext', array( $this, 'override_gettext' ), 20, 3 );
	}

	/**
	 * Return an empty array to override the default VC templates
	 */
	public function modify_default_templates() {
		return array();
	}

	/**
	 * Change VC strings via gettext
	 */
	public function override_gettext( $translated_text, $text, $domain ) {
		if ( ! is_admin() ) {
			switch ( $text ) {
				case 'Add template' :
					if ( $domain  === 'js_composer' ) {
						$translated_text = __( 'Add Wireframe', 'uncode-wireframes' );
					}

					break;
			}
		}

		return $translated_text;
	}
}

endif;

return new UNCDWF_Front();
