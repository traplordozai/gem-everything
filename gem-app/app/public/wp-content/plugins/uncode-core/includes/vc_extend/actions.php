<?php
/**
 * VC related actions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Suggestion list for wp_query field
 */
class UncodeLoopSuggestions {
	protected $content = array();
	protected $exclude = array();
	protected $field;

	function __construct( $field, $query, $exclude ) {
		$this->exclude = explode( ',', $exclude );
		$method_name = 'get_' . preg_replace( '/_out$/', '', $field );
		if ( method_exists( $this, $method_name ) ) {
			$this->$method_name( $query );
		}
	}

	public function get_authors( $query ) {
		$args = ! empty( $query ) ? array( 'search' => '*' . $query . '*', 'search_columns' => array( 'user_nicename' ) ) : array();
		if ( ! empty( $this->exclude ) ) $args['exclude'] = $this->exclude;
		$users = get_users( $args );
		foreach ( $users as $user ) {
			$this->content[] = array( 'value' => (string)$user->ID, 'name' => (string)$user->data->user_nicename );
		}
	}

	public function get_categories( $query ) {
		$args = ! empty( $query ) ? array( 'search' => $query ) : array();
		if ( ! empty( $this->exclude ) ) $args['exclude'] = $this->exclude;
		$categories = get_categories( $args );

		foreach ( $categories as $cat ) {
			$this->content[] = array( 'value' => (string)$cat->cat_ID, 'name' => $cat->cat_name );
		}
	}

	public function get_tags( $query ) {
		$args = ! empty( $query ) ? array( 'search' => $query ) : array();
		if ( ! empty( $this->exclude ) ) $args['exclude'] = $this->exclude;
		$tags = get_tags( $args );
		foreach ( $tags as $tag ) {
			$this->content[] = array( 'value' => (string)$tag->term_id, 'name' => $tag->name );
		}
	}

	public function get_tax_query( $query ) {
		$args = ! empty( $query ) ? array( 'search' => $query ) : array();
		if ( ! empty( $this->exclude ) ) $args['exclude'] = $this->exclude;
		$tags = get_terms( VcLoopSettings::getTaxonomies(), $args );
		foreach ( $tags as $tag ) {
			$this->content[] = array( 'value' => $tag->term_id, 'name' => $tag->name );
		}
	}

	public function get_by_id( $query ) {
		$args = ! empty( $query ) ? array( 's' => $query, 'post_type' => 'any', 'posts_per_page' => -1 ) : array( 'post_type' => 'any', 'posts_per_page' => -1 );
		if ( ! empty( $this->exclude ) ) $args['exclude'] = $this->exclude;
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$this->content[] = array( 'value' => $post->ID, 'name' => $post->post_title );
		}
	}

	public function render() {
		echo json_encode( $this->content );
	}
}

function uncode_get_loop_suggestion() {
	$loop_suggestions = new UncodeLoopSuggestions(vc_post_param('field'), vc_post_param('query'), vc_post_param('exclude'));
	$loop_suggestions->render();
	die();
}

add_action( 'wp_ajax_wpb_get_loop_suggestion', 'uncode_get_loop_suggestion' );

/**
 * Get media post
 */
function uncode_get_admin_media_post() {
	$id = vc_post_param('content');
	$back_post = get_post($id);
	$post_mime = $back_post->post_mime_type;

	$back_url = $back_icon = '';
	if (strpos($post_mime, 'image/') !== false)
	{
		$background_url = wp_get_attachment_thumb_url( $id );
		$back_url = ($background_url != '') ? 'background-image: url(' . $background_url . ');' : '';
	} else if (strpos($post_mime, 'video/') !== false)
	{
		$back_icon = '<i class="fa fa-media-play" />';
	} else
	{
		switch ($post_mime)
		{
		case 'oembed/flickr':
		case 'oembed/instagram':
		case 'oembed/Imgur':
		case 'oembed/photobucket':
			$back_oembed = wp_oembed_get($back_post->guid);
			preg_match_all('/src="([^"]*)"/i', $back_oembed, $img_src);
			$back_url = (isset($img_src[1][0])) ? 'background-image: url(' . str_replace('"', '', $img_src[1][0]) . ');' : '';
			break;

		case 'oembed/vimeo':
		case 'oembed/youtube':
			$back_icon = '<i class="fa fa-social-' . str_replace('oembed/', '', $post_mime) . '" />';
			break;
		}
	}

	echo json_encode(array(
		'back_url' => $back_url,
		'back_icon' => $back_icon,
		'back_mime' => $post_mime
	));
	die();
}

add_action('wp_ajax_uncode_get_media_post', 'uncode_get_admin_media_post');

/**
 * Remove unusued layouts.
 * @since Uncode 1.7.1
 */
if ( ! function_exists( 'uncode_vc_row_layouts' ) ) :
	function uncode_vc_row_layouts() {
		global $vc_row_layouts;
		foreach ($vc_row_layouts as $vc_row_index => $vc_row_layout) {
			if ( $vc_row_layout['mask'] === '530' )
				unset($vc_row_layouts[$vc_row_index]);
		}
	}
endif; //uncode_vc_row_layouts
add_action( 'admin_init', 'uncode_vc_row_layouts' );

/**
 * Display the comment form on Frontend Builder
 * @since Uncode 2.3.0
 */
if ( ! function_exists( 'uncode_vc_frontend_comments_open' ) ) :
function uncode_vc_frontend_comments_open( $open, $post_id ) {
	if ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) {
		return true;
	}

	return $open;
}
endif; //uncode_vc_row_layouts
add_filter( 'comments_open', 'uncode_vc_frontend_comments_open', 10, 2 );

/**
 * Adds custom classes to the Front Editor and Admin body classes.
 */
function uncode_vc_body_classes($classes){

	if ( function_exists('vc_is_page_editable') && vc_is_page_editable() && is_plugin_active( 'vc_clipboard/vc_clipboard.php' ) ) {
		$classes[] = 'vc-clipboard-active';
	}

	return $classes;
}
function uncode_vc_admin_body_classes($classes){

	if ( is_admin() ) {
		if ( is_plugin_active( 'vc_clipboard/vc_clipboard.php' ) ) {
			$classes .= ' vc-clipboard-active';
		}
		if ( ! apply_filters( 'uncode_show_vc_ai', '__return_false' ) ) {
			$classes .= ' show-vc-ai';
		}
	}

	return $classes;
}
add_filter('body_class', 'uncode_vc_body_classes');
add_filter('admin_body_class', 'uncode_vc_admin_body_classes');

function uncode_vc_update_user_meta(){
	$user_id = get_current_user_id();
	update_user_meta( $user_id, '_vc_editor_promo_popup', WPB_VC_VERSION );
}
add_action('admin_init', 'uncode_vc_update_user_meta');

function uncode_vc_welcome_page() {
    global $pagenow;

    remove_submenu_page( 'vc-general', 'vc-welcome' );
    if ( $pagenow == 'admin.php' && isset( $_GET['page'] ) && $_GET['page'] == 'vc-welcome' ) {

        wp_redirect( admin_url( '/admin.php?page=vc-general' ) );
        exit;

    }
}
add_action( 'admin_init', 'uncode_vc_welcome_page' );

/**
 * Get media ALT for SEO
 */
function uncode_get_media_alt_by_id() {
	$id = vc_post_param('content');

	if ( $id ) {
		echo get_post_meta($id, '_wp_attachment_image_alt', TRUE);
	}
	die();
}

add_action('wp_ajax_uncode_get_media_alt', 'uncode_get_media_alt_by_id');

/**
 * Delete VC GFonts option
 */
function uncode_vc_remove_option() {
    delete_option( 'wpb_js_local_google_fonts' );
}
add_action( 'admin_init', 'uncode_vc_remove_option' );

/**
 * Delete VC GFonts option
 */
function uncode_vc_seo_toolkit_add_settings( $settings ) {
	$settings->addField( 'general', esc_html__( 'Enable SEO Toolkit', 'uncode-core' ), 'seo_toolkit', 'uncode_vc_sanitize_seo_toolkit_callback', 'uncode_vc_seo_toolkit_field_callback' );
}
//add_action( 'vc_settings_tab-general', 'uncode_vc_seo_toolkit_add_settings' );

function uncode_vc_seo_toolkit_field_callback() {
    // phpcs:ignore
	$checked = ( $checked = get_option( 'wpb_js_seo_toolkit' ) ) ? $checked : false;
	?>
	<label>
		<input type="checkbox"<?php echo esc_attr( $checked ) ? ' checked' : ''; ?> value="1" id="wpb_js_seo_toolkit" name="wpb_js_seo_toolkit">
		<?php esc_html_e( 'Enable', 'uncode-core' ) ?>
	</label><br/>
	<p class="description indicator-hint"><?php esc_html_e( 'Enable SEO Toolkit.', 'js_composer' ); ?></p>
	<?php
}

function uncode_vc_sanitize_seo_toolkit_callback( $rules ) {
	return (bool) $rules;
}

function uncode_vc_hide_admin_bar_from_front_end_editor( $show ){
	if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) ) {
		return false;
	}
	return $show;
}
add_filter( 'show_admin_bar', 'uncode_vc_hide_admin_bar_from_front_end_editor' );