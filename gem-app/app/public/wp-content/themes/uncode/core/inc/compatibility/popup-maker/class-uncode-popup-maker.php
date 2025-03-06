<?php
/**
 * Popup Maker support
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Check if Popup Make is active
if ( ! function_exists( 'PopMake' ) ) {
	return;
}

if ( ! class_exists( 'Uncode_Popup_Maker' ) ) :

/**
 * Uncode_Popup_Maker Class
 */
class Uncode_Popup_Maker {
	private $theme_id;

	/**
	 * Construct.
	 */
	public function __construct() {
		$this->theme_id = apply_filters( 'uncode_popup_maker_theme_id', 999999 );

		add_action( 'admin_head', array( $this, 'add_admin_css' ) );
		add_action( 'admin_footer', array( $this, 'add_admin_js' ), 100 );
		add_filter( 'pum_popup_display_settings_fields', array( $this, 'display_settings_fields' ) );
		add_filter( 'pum_popup_classes', array( $this, 'add_popup_classes' ), 10, 2 );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
		add_action( 'pum_preload_popup', array( $this, 'load_scripts' ) );
		add_action( 'wp',  array( $this, 'fix_preview' ) );
		add_filter( 'uncode_get_post_data_content_array', array( $this, 'add_to_post_data_content_array' ) );
		add_filter( 'pum_popup_is_loadable', array( $this, 'disable_popups_frontend_editor' ) );
	}

	/**
	 * Add scripts
	 */
	public function add_scripts() {
		$scripts_prod_conf = uncode_get_scripts_production_conf();
		$resources_version = $scripts_prod_conf[ 'resources_version' ];

		wp_register_style( 'uncode-popup-maker', get_template_directory_uri() . '/core/inc/compatibility/popup-maker/assets/css/uncode-popup-maker.css', array() , $resources_version, 'all');
	}

	/**
	 * Load scripts
	 */
	public function load_scripts( $popup_id ) {
		$settings = get_post_meta( $popup_id, 'popup_settings', true );

		if ( isset( $settings['theme_id'] ) && $settings['theme_id'] == $this->theme_id ) {
			wp_enqueue_style( 'uncode-popup-maker' );

			add_action( 'wp_footer', array( $this, 'add_js' ), 100 );
		}
	}

	/**
	 * Add JS (frontend)
	 */
	public function add_js() {
		?>
		<script>
			(function($) {
				$('.pum-form__submit').addClass('btn btn-default btn-flat btn-no-scale');
				$('.pum').on('pumAfterOpen', function() {
					if ($(this).is(':hidden')) {
						$('html').removeClass('pum-open');
					}
				});
			})(jQuery);
		</script>
		<?php

		do_action( 'uncode_popup_maker_add_js' );
	}

	/**
	 * Add Uncode to themes list
	 */
	public function display_settings_fields( $fields ) {
		$main_fields = isset( $fields['main'] ) ? $fields['main'] : array();

		if ( is_array( $main_fields ) ) {
			foreach ( $main_fields as $field_id => $field_value ) {
				if ( $field_id === 'theme_id' ) {
					$theme_field = $main_fields[ $field_id ];
					$theme_field_options = isset( $theme_field['options'] ) ? $theme_field['options'] : array();

					if ( is_array( $theme_field_options ) ) {
						$theme_field_options[$this->theme_id] = esc_html__( 'Uncode Theme', 'uncode' );

						$fields['main']['theme_id']['options'] = $theme_field_options;
					}
				}
			}
		}

		return $fields;
	}

	/**
	 * Add custom CSS
	 */
	public function add_admin_css() {
		$screen = get_current_screen();

		if ( isset( $screen->id ) && $screen->id === 'popup' ) {
			ob_start();
			?>
			<style>
				.uncode-hide-settings #edit_theme_link,
				.uncode-hide-settings .close_text-wrapper {
					display: none !important;
				}
			</style>
			<?php

			echo ob_get_clean();
		}
	}

	/**
	 * Add custom JS
	 */
	public function add_admin_js() {
		$screen = get_current_screen();

		if ( isset( $screen->id ) && $screen->id === 'popup' ) {
			ob_start();
			?>
			<script>
				(function($) {
					$(document).on('pum_init pum_form_check', function(){
						if ( $('#theme_id').val() == <?php echo esc_js( $this->theme_id ); ?> ) {
							$('#pum_popup_settings').addClass('uncode-hide-settings');
							$('#popup-titlediv').hide();
						}
					})

					$(document).on('change', '#theme_id', function() {
						if ($(this).val() == <?php echo esc_js( $this->theme_id ); ?>) {
							$('#pum_popup_settings').addClass('uncode-hide-settings');
							$('#popup-titlediv').hide();
						} else {
							$('#pum_popup_settings').removeClass('uncode-hide-settings');
							$('#popup-titlediv').show();
						}
					})
				})(jQuery);
			</script>
			<?php

			echo ob_get_clean();
		}
	}

	/**
	 * Add classes to popup
	 */
	public function add_popup_classes( $classes, $popup_id ) {
		$settings = get_post_meta( $popup_id, 'popup_settings', true );

		$classes['container'][] = apply_filters( 'uncode_popup_maker_container_class', 'main-container' );

		if ( isset( $settings['theme_id'] ) && $settings['theme_id'] == $this->theme_id ) {
			$classes['overlay'][]   = 'pum-overlay-uncode';
			$classes['container'][] = 'pum-container-uncode';
			$classes['title'][]     = 'pum-title-uncode';
			$classes['content'][]   = 'pum-content-uncode';
			$classes['close'][]     = 'pum-close-uncode';
		}

		return $classes;
	}

	/**
	 * Add popups to post data content
	 */
	public function add_to_post_data_content_array( $content_array ) {
		$popups = pum_get_all_popups( [ 'post_status' => [ 'publish', 'private' ] ] );

		if ( ! empty( $popups ) ) {

			foreach ( $popups as $popup ) {
				// Set this popup as the global $current.
				pum()->current_popup = $popup;

				// If the popup is loadable (passes conditions) load it.
				if ( pum_is_popup_loadable( $popup->ID ) ) {
					$popup_id = absint( apply_filters( 'wpml_object_id', $popup->ID, 'popup' ) );

					$content_array[] = get_post_field( 'post_content', $popup_id );
				}
			}

			// Clear the global $current.
			pum()->current_popup = null;
		}

		return $content_array;
	}

	/**
	 * Fix preview
	 */
	public function fix_preview() {
		if ( isset( $_GET['popup_preview'] ) ) {
			// Map VC shortcodes
			WPBMap::addAllMappedShortcodes();
		}
	}

	/**
	 * Disable popups while using the frontend editor
	 */
	public function disable_popups_frontend_editor( $enabled ) {
		if ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
			return false;
		}

		return $enabled;
	}
}

endif;

return new Uncode_Popup_Maker();
