<?php
/**
 * Plugin Name:       Uncode Privacy
 * Plugin URI:        https://undsgn.com/
 * Description:       Privacy toolkit for Undsgn themes.
 * Version:           2.2.4
 * Author:            Undsgn
 * Author URI:        https://undsgn.com/
 * Requires at least: 4.0
 * Tested up to:      5.4
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       uncode-privacy
 * Domain Path:       languages
 *
 * Uncode Privacy is based on GDPR https://wordpress.org/plugins/gdpr/
 * GDPR is distributed under the terms of the GNU GPL v2 or later.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Plugin version.
 */
define( 'UNCODE_TOOLKIT_PRIVACY_VERSION', '2.2.4' );

if ( ! defined( 'UNCODE_TOOLKIT_PRIVACY_LOGS_URL' ) ) {
	define( 'UNCODE_TOOLKIT_PRIVACY_LOGS_URL', admin_url( 'admin.php?page=uncode-privacy-logs' ) );
}

include plugin_dir_path( __FILE__ ) . 'includes/class-uncode-toolkit-privacy-install.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-uncode-toolkit-privacy.php';
require plugin_dir_path( __FILE__ ) . 'includes/uncode-toolkit-privacy-helper-functions.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-uncode-toolkit-privacy-session.php';
require plugin_dir_path( __FILE__ ) . 'includes/uncode-toolkit-privacy-logs-functions.php';
require plugin_dir_path( __FILE__ ) . 'includes/uncode-toolkit-privacy-logs-personal-data.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-uncode-toolkit-privacy-logs-list-table.php';
require plugin_dir_path( __FILE__ ) . 'includes/legacy/class-uncode-toolkit-privacy-legacy-tools.php';

new Uncode_Toolkit_Privacy();
