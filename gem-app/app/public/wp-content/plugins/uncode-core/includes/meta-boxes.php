<?php
/**
 * Meta boxes functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add Media meta box
 */
function uncode_core_display_metabox() {

	global $post;

	wp_enqueue_script( 'media_items_js', UNCODE_CORE_PLUGIN_URL . 'includes/vc_extend/assets/js/media_items.js', array( 'jquery' ), UncodeCore_Plugin::VERSION );

	$ids = get_post_meta( $post->ID, '_uncode_featured_media', 1);

	if ( function_exists( 'vc_editor_post_types' ) ) {
		$vc_post_type = vc_editor_post_types();
		if (!in_array($post->post_type, $vc_post_type)) $vc_message = esc_html__('WPBakery Page Builder is not active for this post type. Please activate it inside "WPBakery Page Builder > Role Manager"','uncode-core');
		else $vc_message = '';
	} else {
		$vc_message = esc_html__('WPBakery Page Builder is not active. Please activate it inside "Uncode > Install Plugins > Uncode WPBakery Page Builder"','uncode-core');
	}

	if ( $vc_message !== '' ) $vc_message = '<p class="notice notice-warning"><b>' . $vc_message . '</b></p>';

	?>

	<input type="hidden" name="uncode_medias_noncedata" id="uncode_medias_noncedata" value="<?php echo wp_create_nonce( 'uncode_medias_noncedata' ); ?>" />

	<div class="edit_form_line">
		<input type="hidden" class="wpb_vc_param_value uncode_gallery_attached_images_ids medias media_element" name="medias" value="<?php echo esc_attr($ids); ?>">
		<div class="gallery_widget_site_images"></div>
			<?php echo $vc_message; ?>
   		<a class="add_media_widget vc_btn vc_btn-sm vc_btn-primary add_media_widget--with-galleries" href="#" use-single="false" title="Add media"><?php esc_html_e( 'Select Media', 'uncode-core' ); ?></a>
   		<a href="#" class="vc_btn vc_btn-sm vc_btn-grey btn-remove-all"<?php if ($ids === '') echo ' style="display:none;"'; ?>><?php esc_html_e( 'Remove All', 'uncode-core' ); ?></a>
   		<div class="uncode_widget_attached_images">
			<ul class="uncode_widget_attached_images_list">
				<?php echo (( $ids != '' && function_exists('uncode_fieldAttachedMedia') ) ? uncode_fieldAttachedMedia( explode( ",", $ids ) ) : ''); ?>
			</ul>
			<div style="clear:both;"></div>
		</div>
   	</div>

	<?php
}

/**
 * Register Media meta box
 */
function uncode_core_register_metabox() {
	// Return early if Uncode is not active
	if ( ! function_exists( 'uncode_get_post_types' ) || ! function_exists( 'uncode_is_gutenberg_current_editor' ) ) {
		return;
	}

	$uncode_post_types   = uncode_get_post_types(true);
	$uncode_post_types[] = 'uncode_gallery';

	foreach ( $uncode_post_types as $post_type ) {
		if ( $post_type == 'popup' ) {
			continue;
		}

		if ( ! uncode_is_gutenberg_current_editor( $post_type ) ) {
			add_meta_box( 'uncode_gallery_div', esc_html__( 'Media', 'uncode-core' ), 'uncode_core_display_metabox', $post_type, 'normal', 'default' );
		}
	}
}
add_action( 'add_meta_boxes', 'uncode_core_register_metabox' );

/**
 * Save Media meta box
 */
function uncode_core_save_media_metadata( $post_id, $post ) {
	if ( empty( $_POST['uncode_medias_noncedata'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['uncode_medias_noncedata'], 'uncode_medias_noncedata' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		return;
	}

	$value_id = $_POST['medias'];
	$key_id = '_uncode_featured_media';

	if ( $post->post_type == 'revision' ) {
		return;
	}

	if ( get_post_meta( $post->ID, $key_id, FALSE ) ) {
		update_post_meta( $post->ID, $key_id, $value_id );
	} else {
		add_post_meta( $post->ID, $key_id, $value_id );
	}
	if ( ! $value_id ) {
		delete_post_meta( $post->ID, $key_id );
	}
}
add_action( 'save_post', 'uncode_core_save_media_metadata', 1, 2 );
