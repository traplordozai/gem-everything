<?php
/**
 * Add secondary featured image box
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Uncode_Core_Featured_Image' ) ) :

/**
 * Uncode_Core_Featured_Image Class
 */
class Uncode_Core_Featured_Image {

	/**
	 * Constructor
	 */
	public function __construct() {
		// Actions
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 30 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'wp_ajax_uncode_core_get_secondary_thumbnail_markup', array( $this, 'get_secondary_thumbnail_markup' ) );
		add_action( 'save_post', array( $this, 'save' ), 10, 2 );
	}

	/**
	 * Enqueue scripts
	 */
	public function admin_scripts() {
		wp_enqueue_script( 'uncode-featured-images', UNCODE_CORE_PLUGIN_URL . 'includes/assets/js/uncode-featured-images.js', array( 'jquery' ), UncodeCore_Plugin::VERSION );

		// Localize
		$params = array(
			'post_id' => get_the_ID(),
			'nonce'   => wp_create_nonce( 'uncode-get-secondary-thumbnail-markup-nonce' )
		);

		wp_localize_script( 'uncode-featured-images', 'FeaturedImagesParameters', $params );
	}

	/**
	 * Add meta boxes
	 */
	public function add_meta_boxes() {
		// Return early if Uncode is not active
		if ( ! function_exists( 'uncode_get_post_types' ) ) {
			return;
		}

		$uncode_post_types = uncode_get_post_types( true );

		foreach ( $uncode_post_types as $post_type ) {
			if ( $post_type == 'popup' ) {
				continue;
			}

			add_meta_box( 'uncode-secondary-featured-image', esc_html__( 'Secondary featured image', 'uncode-core' ), array( $this, 'display_secondary_featured_image_box' ), $post_type, 'side', 'low' );
		}
	}

	/**
	 * Output the metabox
	 */
	public function display_secondary_featured_image_box() {
		$post                        = get_post();
		$upload_iframe_src           = get_upload_iframe_src( 'image', $post->ID );
		$secondary_featured_image_id = absint( get_post_meta( $post->ID, '_uncode_secondary_thumbnail_id', true ) );
		$secondary_featured_image_id = $secondary_featured_image_id > 0 ? $secondary_featured_image_id : false;
		$thumbnail_img               = false;

		if ( $secondary_featured_image_id ) {
			$_wp_additional_image_sizes = wp_get_additional_image_sizes();
			$size                       = isset( $_wp_additional_image_sizes['post-thumbnail'] ) ? 'post-thumbnail' : array( 266, 266 );
			$thumbnail_img              = wp_get_attachment_image( $secondary_featured_image_id, $size );
		}
		?>

		<p class="hide-if-no-js"><a href="<?php echo esc_url( $upload_iframe_src ); ?>" id="set-secondary-post-thumbnail" data-modal-title="<?php esc_attr_e( 'Secondary featured image', 'uncode-core' ); ?>" data-choose="<?php esc_attr_e( 'Set secondary featured image', 'uncode-core' ); ?>" data-link-text="<?php esc_html_e( 'Set secondary featured image', 'uncode-core' ); ?>"><?php echo $thumbnail_img? $thumbnail_img : esc_html_e( 'Set secondary featured image', 'uncode-core' ); ?></a></p>

		<p class="hide-if-no-js howto no-thumbnail-elements <?php echo ! $secondary_featured_image_id ? 'hidden' : ''; ?>" id="set-secondary-post-thumbnail-desc"><?php esc_html_e( 'Click the image to edit or update', 'uncode-core' ); ?></p>

		<p class="hide-if-no-js no-thumbnail-elements <?php echo ! $secondary_featured_image_id ? 'hidden' : ''; ?>"><a href="#" id="remove-secondary-post-thumbnail"><?php esc_html_e( 'Remove featured image', 'uncode-core' ); ?></a></p>

		<input type="hidden" id="_uncode_secondary_thumbnail_id" name="_uncode_secondary_thumbnail_id" value="<?php echo $secondary_featured_image_id ? $secondary_featured_image_id : ''; ?>" />

		<?php
		wp_nonce_field( 'uncode_core_featured_images_save_data', 'uncode_core_featured_images_meta_nonce' );
	}

	/**
	 * Get secondary thumbnail markup via AJAX (we need srcset)
	 */
	public function get_secondary_thumbnail_markup() {
		if ( isset( $_POST[ 'get_secondary_thumbnail_markup_nonce' ] ) && isset( $_POST[ 'post_id' ] ) && isset( $_POST[ 'thumbnail_id' ] ) ) {
			// Check the nonce
			if ( ! wp_verify_nonce( $_POST[ 'get_secondary_thumbnail_markup_nonce' ], 'uncode-get-secondary-thumbnail-markup-nonce' ) ) {
				// Invalid nonce
				wp_send_json_error();
			}

			$post_ID = intval( $_POST['post_id'] );

			if ( ! current_user_can( 'edit_post', $post_ID ) ) {
				// Can't edit post
				wp_send_json_error();
			}

			$_wp_additional_image_sizes = wp_get_additional_image_sizes();

			$thumbnail_id  = intval( $_POST['thumbnail_id'] );
			$size          = isset( $_wp_additional_image_sizes['post-thumbnail'] ) ? 'post-thumbnail' : array( 266, 266 );
			$thumbnail_img = wp_get_attachment_image( $thumbnail_id, $size );

			if ( ! $thumbnail_img ) {
				// No img
				wp_send_json_error();
			}

			$response = array(
				'html' => $thumbnail_img
			);

			wp_send_json_success( $response );
		} else {
			// Invalid data
			wp_send_json_error();
		}
	}

	/**
	 * Save thumbnail
	 */
	public function save( $post_id, $post ) {
		// Check the nonce
		if ( empty( $_POST['uncode_core_featured_images_meta_nonce'] ) || ! wp_verify_nonce( $_POST['uncode_core_featured_images_meta_nonce'], 'uncode_core_featured_images_save_data' ) ) {
			return;
		}

		// Don't save meta boxes for revisions or autosaves
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check user has permission to edit
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Save thumbnail
		$attachment_id = isset( $_POST[ '_uncode_secondary_thumbnail_id' ] ) ? absint( $_POST[ '_uncode_secondary_thumbnail_id' ] ) : false;

		update_post_meta( $post_id, '_uncode_secondary_thumbnail_id', $attachment_id );
	}
}

endif;

new Uncode_Core_Featured_Image();
