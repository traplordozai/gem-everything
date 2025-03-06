<?php

/**
 * Plugin Name: WPBakery Page Builder Clipboard
 * Description: Clipboard and template manager for WPBakery Page Builder
 * Version: 5.0.4
 * Author: bitorbit
 * Author URI: http://codecanyon.net/user/bitorbit
 */

function vc_clipboard_enqueue() {
	wp_enqueue_style( 'vc_clipboard', plugins_url( 'style.css', __FILE__ ), [], filemtime( plugin_dir_path( __FILE__ ) . 'style.css' ) );
	wp_register_script( 'vc_clipboard', plugins_url( 'script.min.js', __FILE__ ), [], filemtime( plugin_dir_path( __FILE__ ) . 'script.min.js' ) );
	
	// Localize the script with new data
	$translation_array = array(
		'copy' => esc_html__( 'Copy', 'vc_clipboard' ),
		'copy_plus' => esc_html__( 'Copy+', 'vc_clipboard' ),
		'cut' => esc_html__( 'Cut', 'vc_clipboard' ),
		'cut_plus' => esc_html__( 'Cut+', 'vc_clipboard' ),
		'paste' => esc_html__( 'Paste', 'vc_clipboard' ),
		
		'copy_s' => esc_html__( 'C', 'vc_clipboard' ),
		'copy_plus_s' => esc_html__( 'C+', 'vc_clipboard' ),
		'cut_s' => esc_html__( 'X', 'vc_clipboard' ),
		'cut_plus_s' => esc_html__( 'X+', 'vc_clipboard' ),
		'paste_s' => esc_html__( 'P', 'vc_clipboard' ),
		
		'copy_l' => esc_html__( 'Copy', 'vc_clipboard' ),
		'copy_plus_l' => esc_html__( 'Copy+', 'vc_clipboard' ),
		'cut_l' => esc_html__( 'Cut', 'vc_clipboard' ),
		'cut_plus_l' => esc_html__( 'Cut+', 'vc_clipboard' ),
		'paste_l' => esc_html__( 'Paste', 'vc_clipboard' ),
		
		'copy_this_section' => esc_html__( 'Copy this section', 'vc_clipboard' ),
		'copy_to_clipboard_stack' => esc_html__( 'Copy to clipboard stack', 'vc_clipboard' ),
		'cut_this_section' => esc_html__( 'Cut this section', 'vc_clipboard' ),
		'move_to_clipboard_stack' => esc_html__( 'Move to clipboard stack', 'vc_clipboard' ),
		'paste_inside_after_this_section' => esc_html__( 'Paste inside/after this section', 'vc_clipboard' ),
		'click_to_clear_clipboard' => esc_html__( 'Click to clear clipboard', 'vc_clipboard' ),
		'copy_this_row' => esc_html__( 'Copy this row', 'vc_clipboard' ),
		'cut_this_row' => esc_html__( 'Cut this row', 'vc_clipboard' ),
		'paste_after_this_row' => esc_html__( 'Paste after this row', 'vc_clipboard' ),
		'copy_content_this_column' => esc_html__( 'Copy content of this column', 'vc_clipboard' ),
		'copy_content_this_section' => esc_html__( 'Copy content of this section', 'vc_clipboard' ),
		'cut_content_this_column' => esc_html__( 'Cut content of this column', 'vc_clipboard' ),
		'cut_content_this_section' => esc_html__( 'Cut content of this section', 'vc_clipboard' ),
		'paste_inside_this_column' => esc_html__( 'Paste inside this column', 'vc_clipboard' ),
		'copy_this_element' => esc_html__( 'Copy this element', 'vc_clipboard' ),
		'cut_this_element' => esc_html__( 'Cut this element', 'vc_clipboard' ),
		'paste_after_this_element' => esc_html__( 'Paste after this element', 'vc_clipboard' ),
		'paste_inside_this_section' => esc_html__( 'Paste inside this section', 'vc_clipboard' ),
		
		'exp' => esc_html__( 'Export', 'vc_clipboard' ),
		'imp' => esc_html__( 'Import', 'vc_clipboard' ),
		'load_from_google_cloud' => esc_html__( 'Load from Google Cloud', 'vc_clipboard' ),
		'gc_load' => esc_html__( 'GC Load', 'vc_clipboard' ),
		'save_to_google_cloud' => esc_html__( 'Save to Google Cloud', 'vc_clipboard' ),
		'gc_save' => esc_html__( 'GC Save', 'vc_clipboard' ),
		'name' => esc_html__( 'Name:', 'vc_clipboard' ),
		'submit' => esc_html__( 'Submit', 'vc_clipboard' ),
		'cancel' => esc_html__( 'Cancel', 'vc_clipboard' ),
		'deactivate' => esc_html__( 'Deactivate', 'vc_clipboard' ),
		'license' => esc_html__( 'License', 'vc_clipboard' ),
		'activate_product_license' => esc_html__( 'Activate product license', 'vc_clipboard' ),
		'purchase_code' => esc_html__( 'Item Purchase Code:', 'vc_clipboard' ),
		'email' => esc_html__( 'Email (optional) - enter to get important info and special offers:', 'vc_clipboard' ),
		'license_text' => esc_html__( 'A valid license qualifies you for support and enables Google Cloud template manager. One license may only be used for one WPBakery Page Builder (Visual Composer) Clipboard installation on one WordPress site at a time. If you have activated your license on another site, then you should ', 'vc_clipboard' ),
		'license_text1' => esc_html__( 'obtain a new license', 'vc_clipboard' ),
		'license_text2' => esc_html__( '.', 'vc_clipboard' ),
		'preferences' => esc_html__( 'Preferences', 'vc_clipboard' ),
		'prefs' => esc_html__( 'Prefs', 'vc_clipboard' ),
		'short_commands' => esc_html__( 'Short commands', 'vc_clipboard' ),
		'toolbar_initially_closed' => esc_html__( 'Toolbar Initially Closed', 'vc_clipboard' ),
		'hide_cut_buttons' => esc_html__( 'Hide Cut/Cut+ Buttons', 'vc_clipboard' ),
		'hide_paste_button' => esc_html__( 'Hide Paste Button', 'vc_clipboard' ),
		'hide_export_import' => esc_html__( 'Hide Export/Import', 'vc_clipboard' ),
		'hide_gc_buttons' => esc_html__( 'Hide GC Buttons', 'vc_clipboard' ),
		'hide_license_button' => esc_html__( 'Hide License Button', 'vc_clipboard' ),
		
		'pasting' => esc_html__( 'Pasting, please wait...', 'vc_clipboard' ),
		
		'cant_mix' => esc_html__( 'Can\'t mix ', 'vc_clipboard' ),
		'with_text' => esc_html__( ' with ', 'vc_clipboard' ),
		'exclamation_mark_start' => esc_html__( '', 'vc_clipboard' ),
		'exclamation_mark_end' => esc_html__( '!', 'vc_clipboard' ),
		
		'error_01' => esc_html__( 'Error 01. Please try later.', 'vc_clipboard' ),
		'error_02' => esc_html__( 'Error 02. Please try later.', 'vc_clipboard' ),
		'error_03' => esc_html__( 'Error 03. Please try later.', 'vc_clipboard' ),
		'error_04' => esc_html__( 'Error 04. Please try later.', 'vc_clipboard' ),
		'error_05' => esc_html__( 'Error 05. Please try later.', 'vc_clipboard' ),
		'error_06' => esc_html__( 'Error. Please check purchase code and try again.', 'vc_clipboard' ),
		'error_06_d' => esc_html__( 'Error 06. Please try later.', 'vc_clipboard' ),
		'error_07' => esc_html__( 'Error 07. Please try later.', 'vc_clipboard' ),
		'error_08' => esc_html__( 'Error 08. Please try later.', 'vc_clipboard' ),
		'error_09' => esc_html__( 'Error 09. Please try later.', 'vc_clipboard' ),
		'error_10' => esc_html__( 'Error 10. Please try later.', 'vc_clipboard' ),
		
		'clear_clipboard' => esc_html__( 'Clear clipboard?', 'vc_clipboard' ),
		
		'no_saved_templates' => esc_html__( 'No saved templates.', 'vc_clipboard' ),
		'load' => esc_html__( 'Load ', 'vc_clipboard' ),
		'delete_text' => esc_html__( 'Delete ', 'vc_clipboard' ),
		'enter_template_name' => esc_html__( 'Enter template name.', 'vc_clipboard' ),
		
		'clipboard_template_saved' => esc_html__( 'Clipboard template saved.', 'vc_clipboard' ),
		'name_already_taken' => esc_html__( 'Name already taken.', 'vc_clipboard' ),
		'nothing_to_save' => esc_html__( 'Nothing to save.', 'vc_clipboard' ),
		'now_activated' => esc_html__( 'WPBakery Page Builder (Visual Composer) Clipboard license is now activated!', 'vc_clipboard' ),
		'now_deactivated' => esc_html__( 'WPBakery Page Builder (Visual Composer) Clipboard license has been deactivated!', 'vc_clipboard' ),
		
		'cant_paste' => esc_html__( 'Can\'t paste ', 'vc_clipboard' ),
		'inside_after_vc_section' => esc_html__( ' inside/after vc_section!', 'vc_clipboard' ),
		'after_vc_row' => esc_html__( ' after vc_row!', 'vc_clipboard' ),
		'after_vc_row_inner' => esc_html__( ' after vc_row_inner!', 'vc_clipboard' ),
		'inside' => esc_html__( ' inside ', 'vc_clipboard' ),
		'to_root' => esc_html__( ' to root!', 'vc_clipboard' ),
		'after' =>  esc_html__( ' after ', 'vc_clipboard' ),
		'content_after' => esc_html__( ' content after ', 'vc_clipboard' ),
		'you_can_only' => esc_html__( 'You can only paste it inside a column.', 'vc_clipboard' ),
		'cant_paste_vc_row_inner_as_root' => esc_html__( 'Can\'t paste vc_row_inner as root element! You can only paste it inside a column.', 'vc_clipboard' ),
		'cant_paste_vc_column_content_to_root' => esc_html__( 'Can\'t paste vc_column content to root! You can only paste it inside a column.', 'vc_clipboard' ),
		'cant_paste_vc_column_inner_content_to_root' => esc_html__( 'Can\'t paste vc_column_inner content to root! You can only paste it inside a column.', 'vc_clipboard' ),
		'cant_paste_vc_column_content_to_vc_column_inner' => esc_html__( 'Can\'t paste vc_column content to vc_column_inner! You can only paste it inside a column.', 'vc_clipboard' ),
		'cant_paste_vc_row_inner_to_vc_column_inner' => esc_html__( 'Can\'t paste vc_row_inner to vc_column_inner! You can only paste it inside a column.', 'vc_clipboard' ),
		
		'column_empty' => esc_html__( 'Column is empty!', 'vc_clipboard' ),
		'section_empty' => esc_html__( 'Section is empty!', 'vc_clipboard' ),
		'tab_empty' => esc_html__( 'Tab is empty!', 'vc_clipboard' ),
		'clipboard_empty' => esc_html__( 'Clipboard is empty!', 'vc_clipboard' ),
		
		'license_already_activated_on' => esc_html__( 'This purhase code has been already used on: ', 'vc_clipboard' ),
		
		'copy_all' => esc_html__( 'Copy all sections/rows', 'vc_clipboard' ),

	);
	wp_localize_script( 'vc_clipboard', 'vc_clipboard_text', $translation_array );

	// Enqueued script with localized data.
	wp_enqueue_script( 'vc_clipboard' );
}
function vc_clipboard_custom_js() {
	echo '<script>';
	echo 'window.vc_clipboard_plugins_url="' . plugins_url() . '";window.vc_clipboard_site="' . ( isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'] ) . '";';
	echo '</script>';
}
add_action( 'admin_enqueue_scripts', 'vc_clipboard_enqueue' );
add_action( 'admin_head', 'vc_clipboard_custom_js' );

function vc_clipboard_enqueue_fe() {
	if ( isset( $_GET['vc_editable'] ) && $_GET['vc_editable'] == 'true' ) {
		wp_enqueue_style( 'vc_clipboard_fe', plugins_url( 'style_fe.css', __FILE__ ), [], filemtime( plugin_dir_path( __FILE__ ) . 'style_fe.css' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'vc_clipboard_enqueue_fe' );

/**
 * Load plugin textdomain.
 *
 * @since 4.5.0
 */
function vc_clipboard_load_textdomain() {
	load_plugin_textdomain( 'vc_clipboard', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'vc_clipboard_load_textdomain' );

/**
 * AJAX activation.
 *
 * @since 4.5.0
 */
function vc_clipboard_activate() {
	check_ajax_referer( 'vc_clipboard_nonce', 'nonce' );
	if ( ! current_user_can( 'install_plugins' ) ) return;
	$license_key = sanitize_text_field( $_POST['license_key'] );
	$email = sanitize_text_field( $_POST['email'] );
	update_option( 'envato_purchase_code_8897711', $license_key );
	update_option( 'vc_clipboard_email', $email );
	echo 'ok';
	wp_die();
}
add_action( 'wp_ajax_vc_clipboard_activate', 'vc_clipboard_activate' );

/**
 * AJAX deactivation.
 *
 * @since 4.5.0
 */
function vc_clipboard_deactivate() {
	check_ajax_referer( 'vc_clipboard_nonce', 'nonce' );
	if ( ! current_user_can( 'install_plugins' ) ) return;
	delete_option( 'envato_purchase_code_8897711' );
	delete_option( 'vc_clipboard_email' );
	echo 'ok';
	wp_die();
}
add_action( 'wp_ajax_vc_clipboard_deactivate', 'vc_clipboard_deactivate' );

function vc_clipboard_javascript() {
	$license_key = get_option( 'envato_purchase_code_8897711' );
	$email = get_option( 'vc_clipboard_email' );
	$nonce = wp_create_nonce( 'vc_clipboard_nonce' );
	?>
	<script>
		window.vc_clipboard_license_key = <?php echo esc_html( $license_key ) ? '"' . esc_html( $license_key ) . '"' : 'false'; ?>;
		window.vc_clipboard_email = <?php echo sanitize_email( $email ) ? '"' . sanitize_email( $email ) . '"' : '""'; ?>;
		window.vc_clipboard_current_user_can_install_plugins = <?php echo current_user_can( 'install_plugins' ) ? 'true' : 'false'; ?>;
		window.vc_clipboard_nonce = '<?php echo $nonce; ?>';
	</script><?php
}
add_action( 'admin_footer', 'vc_clipboard_javascript' ); // Write our JS below here