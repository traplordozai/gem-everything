<?php
/**
 * Custom Woocommerce term settings
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_WooCommerce_Term_Settings' ) ) :

/**
 * Uncode_WooCommerce_Term_Settings Class
 */
class Uncode_WooCommerce_Term_Settings {
	/**
	 * Constructor.
	 */
	public function __construct() {
		// Return early if swatches functionality is disabled
		if ( ! uncode_wc_swatches_global_active() ) {
			return;
		}

		// Add scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );

		// Filter WC attribute types
		add_filter( 'product_attributes_type_selector', array( $this, 'add_new_attribute_types' ) );

		// Add thumbnail size selector when editing/creating attributes
		add_action( 'woocommerce_after_add_attribute_fields', array( $this, 'add_attribute_fields' ) );
		add_action( 'woocommerce_after_edit_attribute_fields', array( $this, 'edit_attribute_fields' ) );

		// Save thumbnail size selector when editing/creating attributes
		add_action( 'woocommerce_attribute_added', array( $this, 'save_attribute_fields' ) );
		add_action( 'woocommerce_attribute_updated', array( $this, 'save_attribute_fields' ) );

		// Term fields
		$attribute_taxonomies = wc_get_attribute_taxonomies();
		if ( $attribute_taxonomies ) {
			foreach ( $attribute_taxonomies as $tax ) {
				$name = wc_attribute_taxonomy_name( $tax->attribute_name );

				if ( $name ) {
					add_action( $name . '_add_form_fields', array( $this, 'add_term_fields' ) );
					add_action( $name . '_edit_form_fields', array( $this, 'edit_term_fields' ), 10, 2 );
					add_action( 'created_term', array( $this, 'save_term_fields' ), 10, 3 );
					add_action( 'edit_term', array( $this, 'save_term_fields' ), 10, 3 );
				}
			}
		}
	}

	/**
	 * Enqueue scripts.
	 */
	public function add_scripts() {
		$load_scripts = false;
		$screen       = get_current_screen();
		$screen_id    = $screen ? $screen->id : '';

		if ( $screen_id === 'product_page_product_attributes' ) {
			$load_scripts = true;
		} else {
			$attribute_taxonomies = wc_get_attribute_taxonomies();

			if ( $attribute_taxonomies ) {
				foreach ( $attribute_taxonomies as $tax ) {
					$name = wc_attribute_taxonomy_name( $tax->attribute_name );

					if ( $name ) {
						if ( in_array( $screen_id, array( 'edit-' . $name ) ) ) {
							$load_scripts = true;
							break;
						}
					}
				}
			}
		}

		if ( $load_scripts ) {
			wp_enqueue_media();
			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_style( 'uncode-wc-terms', get_template_directory_uri() . '/core/assets/css/uncode-wc-terms.css', array(), UNCODE_VERSION );
			wp_enqueue_script( 'uncode-wc-terms', get_template_directory_uri() . '/core/assets/js/min/uncode-wc-terms.min.js', array( 'jquery', 'wp-color-picker' ), UNCODE_VERSION , true );
		}
	}

	/**
	 * Filter WC attribute types.
	 */
	public function add_new_attribute_types( $types ) {
		if ( ( isset( $_GET['page'] ) && $_GET['page'] === 'product_attributes' ) || defined('WP_LOAD_IMPORTERS') ) {
			$new_types = array(
				'color' => __( 'Color', 'uncode' ),
				'image' => __( 'Image', 'uncode' ),
				'label' => __( 'Label', 'uncode' ),
			);

			$types = array_merge( $types, $new_types );
		}

		return $types;
	}

	/**
	 * Edit term fields.
	 */
	public function add_term_fields( $taxonomy ) {
		$tax_props   = uncode_wc_get_taxonomy_props( $taxonomy );
		$swatch_type = isset( $tax_props->attribute_type ) && $tax_props->attribute_type ? $tax_props->attribute_type : 'select';

		// Default swatches (selects) and label ones don't need a setting
		if ( $swatch_type === 'select' || $swatch_type === 'label' ) {
			return;
		}
		?>

		<?php if ( $swatch_type === 'color' ) : ?>
			<div class="form-field term-color-wrap term-swatch-value" data-swatch-value="color">
				<label for="product_attribute_color"><?php esc_html_e( 'Color', 'uncode' ); ?></label>
				<input type="text" id="product_attribute_color" class="product_attribute_color wp-color-picker" name="product_attribute_color" value="#EEEEEF" />
			</div>
		<?php elseif ( $swatch_type === 'image' ) : ?>
			<div class="form-field term-thumbnail-wrap term-swatch-value" data-swatch-value="image">
				<label><?php esc_html_e( 'Thumbnail', 'uncode' ); ?></label>
				<div id="product_attribute_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_attribute_thumbnail_id" name="product_attribute_thumbnail_id" />
					<button type="button" class="upload_image_button button"><?php esc_html_e( 'Upload/Add image', 'uncode' ); ?></button>
					<button type="button" class="remove_image_button button"><?php esc_html_e( 'Remove image', 'uncode' ); ?></button>
				</div>
				<script type="text/javascript">

					// Only show the "remove image" button when needed
					if ( ! jQuery( '#product_attribute_thumbnail_id' ).val() ) {
						jQuery( '.remove_image_button' ).hide();
					}

					// Uploading files
					var file_frame;

					jQuery( document ).on( 'click', '.upload_image_button', function( event ) {

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}

						// Create the media frame.
						file_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php esc_html_e( 'Choose an image', 'uncode' ); ?>',
							button: {
								text: '<?php esc_html_e( 'Use image', 'uncode' ); ?>'
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
							var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

							jQuery( '#product_attribute_thumbnail_id' ).val( attachment.id );
							jQuery( '#product_attribute_thumbnail' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
							jQuery( '.remove_image_button' ).show();
						});

						// Finally, open the modal.
						file_frame.open();
					});

					jQuery( document ).on( 'click', '.remove_image_button', function() {
						jQuery( '#product_attribute_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#product_attribute_thumbnail_id' ).val( '' );
						jQuery( '.remove_image_button' ).hide();
						return false;
					});

					jQuery( document ).ajaxComplete( function( event, request, options ) {
						if ( request && 4 === request.readyState && 200 === request.status
							&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

							var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
							if ( ! res || res.errors ) {
								return;
							}
							// Clear Thumbnail fields on submit
							jQuery( '#product_attribute_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
							jQuery( '#product_attribute_thumbnail_id' ).val( '' );
							jQuery( '.remove_image_button' ).hide();
							// Clear Color field on submit
							jQuery( '#product_attribute_color' ).val( '' );
							jQuery( '.wp-color-result' ).removeAttr( 'style' );
							return;
						}
					} );

				</script>
				<div class="clear"></div>
			</div>
		<?php endif; ?>
		<?php
	}

	/**
	 * Edit term fields.
	 */
	public function edit_term_fields( $term, $taxonomy ) {
		$tax_props   = uncode_wc_get_taxonomy_props( $taxonomy );
		$swatch_type = isset( $tax_props->attribute_type ) && $tax_props->attribute_type ? $tax_props->attribute_type : 'select';

		// Default swatches (selects) and label ones don't need a setting
		if ( $swatch_type === 'select' || $swatch_type === 'label' ) {
			return;
		}
		?>

		<?php if ( $swatch_type === 'color' ) : ?>
			<?php
			$color = get_term_meta( $term->term_id, 'uncode_pa_color', true );
			?>

			<tr class="form-field term-color-wrap term-swatch-value" data-swatch-value="color">
				<th scope="row" valign="top"><label><?php esc_html_e( 'Color', 'uncode' ); ?></label></th>
				<td>
					<input type="text" id="product_attribute_color" class="product_attribute_color wp-color-picker" name="product_attribute_color" value="<?php echo esc_attr( $color ); ?>" value="#EEEEEF" />
				</td>
			</tr>

		<?php elseif ( $swatch_type === 'image' ) : ?>
			<?php
			$thumbnail_id = absint( get_term_meta( $term->term_id, 'uncode_pa_thumbnail_id', true ) );
			$image        = $thumbnail_id ? wp_get_attachment_thumb_url( $thumbnail_id ) : wc_placeholder_img_src();
			?>

			<tr class="form-field term-thumbnail-wrap term-swatch-value" data-swatch-value="image">
				<th scope="row" valign="top"><label><?php esc_html_e( 'Thumbnail', 'uncode' ); ?></label></th>
				<td>
					<div id="product_attribute_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" /></div>
					<div style="line-height: 60px;">
						<input type="hidden" id="product_attribute_thumbnail_id" name="product_attribute_thumbnail_id" value="<?php echo esc_attr( $thumbnail_id ); ?>" />
						<button type="button" class="upload_image_button button"><?php esc_html_e( 'Upload/Add image', 'uncode' ); ?></button>
						<button type="button" class="remove_image_button button"><?php esc_html_e( 'Remove image', 'uncode' ); ?></button>
					</div>
					<script type="text/javascript">

						// Only show the "remove image" button when needed
						if ( '0' === jQuery( '#product_attribute_thumbnail_id' ).val() ) {
							jQuery( '.remove_image_button' ).hide();
						}

						// Uploading files
						var file_frame;

						jQuery( document ).on( 'click', '.upload_image_button', function( event ) {

							event.preventDefault();

							// If the media frame already exists, reopen it.
							if ( file_frame ) {
								file_frame.open();
								return;
							}

							// Create the media frame.
							file_frame = wp.media.frames.downloadable_file = wp.media({
								title: '<?php esc_html_e( 'Choose an image', 'uncode' ); ?>',
								button: {
									text: '<?php esc_html_e( 'Use image', 'uncode' ); ?>'
								},
								multiple: false
							});

							// When an image is selected, run a callback.
							file_frame.on( 'select', function() {
								var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
								var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

								jQuery( '#product_attribute_thumbnail_id' ).val( attachment.id );
								jQuery( '#product_attribute_thumbnail' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
								jQuery( '.remove_image_button' ).show();
							});

							// Finally, open the modal.
							file_frame.open();
						});

						jQuery( document ).on( 'click', '.remove_image_button', function() {
							jQuery( '#product_attribute_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
							jQuery( '#product_attribute_thumbnail_id' ).val( '' );
							jQuery( '.remove_image_button' ).hide();
							return false;
						});

					</script>
					<div class="clear"></div>
				</td>
			</tr>
		<?php endif; ?>
		<?php
	}

	/**
	 * Save category fields
	 *
	 * @param mixed  $term_id Term ID being saved.
	 * @param mixed  $tt_id Term taxonomy ID.
	 * @param string $taxonomy Taxonomy slug.
	 */
	public function save_term_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
		$all_product_atts     = array();
		$attribute_taxonomies = wc_get_attribute_taxonomies();

		if ( $attribute_taxonomies ) {
			foreach ( $attribute_taxonomies as $tax ) {
				$name = wc_attribute_taxonomy_name( $tax->attribute_name );

				if ( $name ) {
					$all_product_atts[] = $name;
				}
			}
		}

		if ( isset( $_POST['product_attribute_color'] ) && in_array( $taxonomy, $all_product_atts ) ) {
			update_term_meta( $term_id, 'uncode_pa_color', esc_attr( $_POST['product_attribute_color'] ) );
		}
		if ( isset( $_POST['product_attribute_thumbnail_id'] ) && in_array( $taxonomy, $all_product_atts ) ) {
			update_term_meta( $term_id, 'uncode_pa_thumbnail_id', absint( $_POST['product_attribute_thumbnail_id'] ) );
		}
	}

	/**
	 * Add thumbnail size selector.
	 */
	public function add_attribute_fields() {
		?>
		<div class="form-field">
			<label for="swatch_thumbnail_size"><?php esc_html_e( 'Image size', 'uncode' ); ?></label>
			<select name="swatch_thumbnail_size" id="swatch_thumbnail_size">
				<option value="crop"><?php esc_html_e( 'Square', 'uncode' ); ?></option>
				<option value="regular"><?php esc_html_e( 'Regular', 'uncode' ); ?></option>
			</select>
			<p class="description"><?php esc_html_e( 'Determines the size of the swatch image.', 'uncode' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Edit thumbnail size selector.
	 */
	public function edit_attribute_fields() {
		$attribute_id       = isset( $_GET['edit'] ) ? absint( $_GET['edit'] ) : 0;
		$options            = get_option( 'uncode_wc_attribute_options' );
		$att_thumbnail_size = false;

		if ( is_array( $options ) && isset( $options[$attribute_id] ) && is_array( $options[$attribute_id] ) && isset( $options[$attribute_id]['swatch_thumbnail_size'] ) ) {
			$att_thumbnail_size = $options[$attribute_id]['swatch_thumbnail_size'];
		}

		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="swatch_thumbnail_size"><?php esc_html_e( 'Image size', 'uncode' ); ?></label>
			</th>
			<td>
				<select name="swatch_thumbnail_size" id="swatch_thumbnail_size">
					<option value="crop" <?php selected( $att_thumbnail_size, 'crop' ); ?>><?php esc_html_e( 'Square', 'uncode' ); ?></option>
					<option value="regular" <?php selected( $att_thumbnail_size, 'regular' ); ?>><?php esc_html_e( 'Regular', 'uncode' ); ?></option>
				</select>
				<p class="description"><?php esc_html_e( 'Determines the size of the swatch image.', 'uncode' ); ?></p>
			</td>
		</tr>
		<?php
	}

	/**
	 * save thumbnail size selector.
	 */
	public function save_attribute_fields( $attribute_id ) {
		if ( is_admin() && $attribute_id && isset( $_POST['swatch_thumbnail_size'] ) ) {
			$size    = sanitize_text_field( $_POST['swatch_thumbnail_size'] );
			$size    = $size === 'regular' || $size === 'crop' ? $size : 'crop';
			$options = get_option( 'uncode_wc_attribute_options' );
			$options = is_array( $options ) ? $options : array();

			$options[$attribute_id]['swatch_thumbnail_size'] = $size;

			update_option( 'uncode_wc_attribute_options', $options, false );
		}
	}
}

endif;

return new Uncode_WooCommerce_Term_Settings();
