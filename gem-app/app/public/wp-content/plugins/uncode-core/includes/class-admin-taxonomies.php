<?php
/**
 * Admin taxonomies class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_Core_Admin_Taxonomies' ) ) :

/**
 * Uncode_Core_Admin_Taxonomies class.
 */
class Uncode_Core_Admin_Taxonomies {
	/**
	 * Class instance.
	 *
	 * @var Uncode_Core_Admin_Taxonomies instance
	 */
	protected static $instance = false;

	/**
	 * Get class instance
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	public function __construct() {
		$registered_taxonomies = uncode_get_registered_taxonomies();

		foreach ( $registered_taxonomies as $taxonomy_key => $taxonomy_value ) {
			add_action( $taxonomy_key. '_add_form_fields', array( $this, 'add_taxonomy_fields' ) );
			add_action( $taxonomy_key . '_edit_form_fields', array( $this, 'edit_taxonomy_fields' ), 10 );

			if ( function_exists( 'uncode_get_legacy_taxonomies' ) && function_exists( 'uncode_taxonomy_add_meta_field' ) && function_exists( 'uncode_taxonomy_edit_meta_field' ) && function_exists( 'uncode_save_taxonomy_custom_meta' ) ) {
				if ( ! in_array( $taxonomy_key, uncode_get_legacy_taxonomies() ) ) {
					add_action( $taxonomy_key. '_add_form_fields', 'uncode_taxonomy_add_meta_field', 10, 2 );
					add_action( $taxonomy_key. '_edit_form_fields', 'uncode_taxonomy_edit_meta_field', 10, 2 );
					add_action( 'edited_' . $taxonomy_key, 'uncode_save_taxonomy_custom_meta', 10, 2 );
					add_action( 'create_' . $taxonomy_key, 'uncode_save_taxonomy_custom_meta', 10, 2 );
				}
			}
		}

		add_action( 'created_term', array( $this, 'save_taxonomy_fields' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'save_taxonomy_fields' ), 10, 3 );
	}

	/**
	 * Add taxonomy fields.
	 */
	public function add_taxonomy_fields() {
		?>
		<div class="form-field term-thumbnail-wrap">
			<label><?php esc_html_e( 'Module Thumbnail', 'uncode-core' ); ?></label>
			<div id="uncode_term_thumbnail" style="float: left; margin-right: 10px;"><img src="" width="60px" height="60px" style="display:none;" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="uncode_term_thumbnail_id" name="uncode_term_thumbnail_id" />
				<button type="button" class="upload_term_thumbnail_button upload_term_primary_thumbnail_button button" data-type="primary"><?php esc_html_e( 'Upload/Add image', 'uncode-core' ); ?></button>
				<button type="button" class="remove_term_thumbnail_button remove_term_primary_thumbnail_button button" data-type="primary"><?php esc_html_e( 'Remove image', 'uncode-core' ); ?></button>
			</div>
			<div class="clear"></div>
		</div>
		<div class="form-field term-thumbnail-wrap">
			<label><?php esc_html_e( 'Module Secondary Thumbnail', 'uncode-core' ); ?></label>
			<div id="uncode_term_secondary_thumbnail" style="float: left; margin-right: 10px;"><img src="" width="60px" height="60px" style="display:none;" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="uncode_term_secondary_thumbnail_id" name="uncode_term_secondary_thumbnail_id" />
				<button type="button" class="upload_term_thumbnail_button upload_term_secondary_thumbnail_button button" data-type="secondary"><?php esc_html_e( 'Upload/Add image', 'uncode-core' ); ?></button>
				<button type="button" class="remove_term_thumbnail_button remove_term_secondary_thumbnail_button button" data-type="secondary"><?php esc_html_e( 'Remove image', 'uncode-core' ); ?></button>
			</div>
			<div class="clear"></div>
		</div>
		<script type="text/javascript">
			if (!jQuery('#uncode_term_thumbnail_id').val()) {
				jQuery('.remove_term_primary_thumbnail_button').hide();
			}

			if (!jQuery('#uncode_term_secondary_thumbnail_id').val()) {
				jQuery('.remove_term_secondary_thumbnail_button').hide();
			}

			var file_frame;

			jQuery(document).on('click', '.upload_term_thumbnail_button', function(event) {
				event.preventDefault();

				var thumb_type = jQuery(this).attr('data-type');

				file_frame = wp.media.frames.downloadable_file = wp.media({
					title: '<?php esc_html_e( 'Choose an image', 'uncode-core' ); ?>',
					button: {
						text: '<?php esc_html_e( 'Use image', 'uncode-core' ); ?>'
					},
					multiple: false
				});

				file_frame.on('select', function() {
					var attachment = file_frame.state().get('selection').first().toJSON();
					var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

					if (thumb_type === 'primary') {
						jQuery('#uncode_term_thumbnail_id').val(attachment.id);
						jQuery('#uncode_term_thumbnail').find('img').attr('src', attachment_thumbnail.url).show();
						jQuery('.remove_term_primary_thumbnail_button').show();
					} else {
						jQuery('#uncode_term_secondary_thumbnail_id').val(attachment.id);
						jQuery('#uncode_term_secondary_thumbnail').find('img').attr('src', attachment_thumbnail.url).show();
						jQuery('.remove_term_secondary_thumbnail_button').show();
					}
				});

				file_frame.open();
			});

			jQuery(document).on('click', '.remove_term_thumbnail_button', function() {
				var thumb_type = jQuery(this).attr('data-type');

				if (thumb_type === 'primary') {
					jQuery('#uncode_term_thumbnail').find('img').attr('src', '').hide();
					jQuery('#uncode_term_thumbnail_id').val('');
					jQuery('.remove_term_primary_thumbnail_button').hide();
				} else {
					jQuery('#uncode_term_secondary_thumbnail').find('img').attr('src', '').hide();
					jQuery('#uncode_term_secondary_thumbnail_id').val('');
					jQuery('.remove_term_secondary_thumbnail_button').hide();
				}

				return false;
			});

			jQuery(document).ajaxComplete(function(event, request, options) {
				if (request && 4 === request.readyState && 200 === request.status
					&& options.data && 0 <= options.data.indexOf('action=add-tag')) {

					var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
					if (!res || res.errors) {
						return;
					}
					jQuery('#uncode_term_thumbnail').find('img').attr('src', '').hide();
					jQuery('#uncode_term_thumbnail_id').val('');
					jQuery('#uncode_term_secondary_thumbnail').find('img').attr('src', '').hide();
					jQuery('#uncode_term_secondary_thumbnail_id').val('');
					jQuery('.remove_term_thumbnail_button').hide();
					return;
				}
			} );

		</script>
		<?php
	}

	/**
	 * Edit taxonomy fields.
	 */
	public function edit_taxonomy_fields( $term ) {
		$thumbnail_id = absint( get_term_meta( $term->term_id, 'uncode_term_thumbnail_id', true ) );

		if ( $thumbnail_id ) {
			$image = wp_get_attachment_thumb_url( $thumbnail_id );
		} else {
			$image = '';
		}

		$secondary_thumbnail_id = absint( get_term_meta( $term->term_id, 'uncode_term_secondary_thumbnail_id', true ) );

		if ( $secondary_thumbnail_id ) {
			$secondary_image = wp_get_attachment_thumb_url( $secondary_thumbnail_id );
		} else {
			$secondary_image = '';
		}

		?>
		<tr class="form-field term-thumbnail-wrap">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Module Thumbnail', 'uncode-core' ); ?></label></th>
			<td>
				<div id="uncode_term_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" <?php echo $image ? '' : 'style="display:none;"'; ?>/></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="uncode_term_thumbnail_id" name="uncode_term_thumbnail_id" value="<?php echo esc_attr( $thumbnail_id ); ?>" />
					<button type="button" class="upload_term_thumbnail_button upload_term_primary_thumbnail_button button" data-type="primary"><?php esc_html_e( 'Upload/Add image', 'uncode-core' ); ?></button>
					<button type="button" class="remove_term_thumbnail_button remove_term_primary_thumbnail_button button" data-type="primary"><?php esc_html_e( 'Remove image', 'uncode-core' ); ?></button>
				</div>
				<div class="clear"></div>
			</td>
		</tr>
		<tr class="form-field term-thumbnail-wrap">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Module Secondary Thumbnail', 'uncode-core' ); ?></label></th>
			<td>
				<div id="uncode_term_secondary_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $secondary_image ); ?>" width="60px" height="60px" <?php echo $secondary_image ? '' : 'style="display:none;"'; ?>/></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="uncode_term_secondary_thumbnail_id" name="uncode_term_secondary_thumbnail_id" value="<?php echo esc_attr( $secondary_thumbnail_id ); ?>" />
					<button type="button" class="upload_term_thumbnail_button upload_term_secondary_thumbnail_button button" data-type="secondary"><?php esc_html_e( 'Upload/Add image', 'uncode-core' ); ?></button>
					<button type="button" class="remove_term_thumbnail_button remove_term_secondary_thumbnail_button button" data-type="secondary"><?php esc_html_e( 'Remove image', 'uncode-core' ); ?></button>
				</div>
				<script type="text/javascript">
					if ('0' === jQuery('#uncode_term_thumbnail_id').val()) {
						jQuery('.remove_term_primary_thumbnail_button').hide();
					}

					if ('0' === jQuery('#uncode_term_secondary_thumbnail_id').val()) {
						jQuery('.remove_term_secondary_thumbnail_button').hide();
					}

					var file_frame;

					jQuery(document).on('click', '.upload_term_thumbnail_button', function(event) {
						event.preventDefault();

						var thumb_type = jQuery(this).attr('data-type');

						file_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php esc_html_e( 'Choose an image', 'uncode-core' ); ?>',
							button: {
								text: '<?php esc_html_e( 'Use image', 'uncode-core' ); ?>'
							},
							multiple: false
						});

						file_frame.on('select', function() {
							var attachment = file_frame.state().get('selection').first().toJSON();
							var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

							if (thumb_type === 'primary') {
								jQuery('#uncode_term_thumbnail_id').val(attachment.id);
								jQuery('#uncode_term_thumbnail').find('img').attr('src', attachment_thumbnail.url).show();
								jQuery('.remove_term_primary_thumbnail_button').show();
							} else {
								jQuery('#uncode_term_secondary_thumbnail_id').val(attachment.id);
								jQuery('#uncode_term_secondary_thumbnail').find('img').attr('src', attachment_thumbnail.url).show();
								jQuery('.remove_term_secondary_thumbnail_button').show();
							}
						});

						file_frame.open();
					});

					jQuery(document).on('click', '.remove_term_thumbnail_button', function() {
						var thumb_type = jQuery(this).attr('data-type');

						if (thumb_type === 'primary') {
							jQuery('#uncode_term_thumbnail').find('img').attr('src', '').hide();
							jQuery('#uncode_term_thumbnail_id').val('');
							jQuery('.remove_term_primary_thumbnail_button').hide();
						} else {
							jQuery('#uncode_term_secondary_thumbnail').find('img').attr('src', '').hide();
							jQuery('#uncode_term_secondary_thumbnail_id').val('');
							jQuery('.remove_term_secondary_thumbnail_button').hide();
						}

						return false;
					});

				</script>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
	}

	/**
	 * Save taxonomy fields
	 */
	public function save_taxonomy_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
		if ( isset( $_POST['uncode_term_thumbnail_id'] ) && array_key_exists( $taxonomy, uncode_get_registered_taxonomies() ) ) {
			update_term_meta( $term_id, 'uncode_term_thumbnail_id', absint( $_POST['uncode_term_thumbnail_id'] ) );
		}

		if ( isset( $_POST['uncode_term_secondary_thumbnail_id'] ) && array_key_exists( $taxonomy, uncode_get_registered_taxonomies() ) ) {
			update_term_meta( $term_id, 'uncode_term_secondary_thumbnail_id', absint( $_POST['uncode_term_secondary_thumbnail_id'] ) );
		}
	}

}

endif;

$uncode_admin_taxonomies = Uncode_Core_Admin_Taxonomies::get_instance();
