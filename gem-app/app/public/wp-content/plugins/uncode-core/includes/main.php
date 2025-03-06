<?php
/**
 * Include all required files
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
* Customizer Visual Composer
*/
function before_visual_composer() {
	if ( ! defined( 'UNCODE_SLIM' ) ) {
		return;
	}

	$ok_php = true;

	if ( function_exists( 'phpversion' ) ) {
		$php_version = phpversion();

		if ( version_compare( $php_version, '5.3.0' ) < 0 ) {
			$ok_php = false;
		}
	}

	if ( $ok_php ) {
		require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/init.php';
	}
}
add_action( 'vc_before_init', 'before_visual_composer' );

/**
* Custom posts type.
*/
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/custom-post-types/register-custom-post-type.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/custom-post-types/custom-post-type-functions.php';

/**
 * Shared functions.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/core-functions.php';

/**
 * Admin functions.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/admin.php';

/**
 * Upgrade functions.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/upgrade.php';

/**
 * SVG support.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/svg-support.php';

/**
 * Meta boxes functions.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/meta-boxes.php';

/**
* I recommend this implementation.
*/
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/i-recommend-this/i-recommend-this.php';

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/theme-options/assets/theme-mode/functions.php';

/**
 * Required: include OptionTree.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/theme-options/ot-loader.php';

/**
 * Load the theme options.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/theme-options/assets/theme-mode/theme-options.php';

/**
 * Core Settings page.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/core-settings/class-core-settings.php';

/**
 * Performance functions.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/performance/performance.php';

/**
 * Load the theme meta boxes.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/theme-options/assets/theme-mode/meta-boxes.php';

/**
 * Load one click demo
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/one-click-demo/init.php';

/**
 * Font system.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/font-system/font-system.php';

/**
 * Third-party related functions.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/compatibility.php';

/**
 * Native shortcodes.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/shortcodes.php';

/**
 * Deprecated function.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/deprecated-functions.php';

/**
 * Add widgets.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/widgets.php';

/**
 * Assets functions.
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/assets-functions.php';

/**
* Requires files after WP is loaded.
*/
function uncode_core_require_files_after_wp_loaded() {
	if ( is_admin() ) {
		require_once UNCODE_CORE_PLUGIN_DIR . '/includes/class-admin-taxonomies.php';
	}
}
add_action( 'wp_loaded', 'uncode_core_require_files_after_wp_loaded' );
