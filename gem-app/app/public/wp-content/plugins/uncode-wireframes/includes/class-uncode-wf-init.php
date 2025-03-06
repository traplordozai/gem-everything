<?php
/**
 * Init Functions
 *
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'UNCDWF_Init' ) ) :

/**
 * UNCDWF_Init Class
 */
class UNCDWF_Init {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Filter user VC templates args
		add_filter( 'uncode_vc_category_templates_args', array( $this, 'category_templates_args' ), 10, 3 );

		// Filter user VC templates name args
		add_filter( 'uncode_vc_category_templates_name_args', array( $this, 'templates_name_args' ) );

		// Filter default VC templates args
		add_filter( 'uncode_vc_default_category_templates_args', array( $this, 'default_category_templates_args' ), 10, 3 );

		// Add images to VC templates HTML
		add_filter( 'uncode_vc_templates_html', array( $this, 'add_custom_vc_templates_html' ), 10, 4 );

		// Add wireframes
		add_action( 'vc_load_default_templates_action', 'uncode_wf_add_wireframes' );

		// Enqueue scripts
		add_action( 'vc_backend_editor_render', array( $this, 'add_scripts' ) );
		add_action( 'vc_frontend_editor_render', array( $this, 'add_scripts' ) );

		// Add wireframes categories navigation
		add_action( 'uncode_wireframes_before_templates_list', array( $this, 'add_wireframes_navigation' ) );

		// Add markup before/after templates list
		add_action( 'uncode_vc_before_templates_list', array( $this, 'add_html_before_templates_list' ) );
		add_action( 'uncode_vc_after_templates_list', array( $this, 'add_html_after_templates_list' ) );

		// Add markup before/after single template
		add_filter( 'uncode_vc_before_single_template', array( $this, 'add_html_before_single_templates' ), 10, 2 );
		add_filter( 'uncode_vc_after_single_template', array( $this, 'add_html_after_single_templates' ) );

		// Filter search placeholder text
		add_filter( 'uncode_search_template_placeholder', array( $this, 'change_search_placeholder' ) );

		// Change title of default templates
		add_filter( 'uncode_template_tab_title', array( $this, 'change_template_tab_title' ) );

		// Add class for ie
		add_filter( 'admin_body_class', array( $this, 'add_ie_class' ) );

		// Add wireframes button
		// add_filter( 'vc_nav_controls', array( $this, 'add_wireframes_button' ) );

		// Change templates window title
		add_filter( 'uncode_templates_window_title', array( $this, 'change_window_title' ) );

		// Initialize dynamic class when loading a template via AJAX
		add_action( 'uncode_render_backend_template', 'uncode_wf_initialize_dynamic_class' );

		// Import wireframes demo contents (if needed)
		add_action( 'init', array( $this, 'import_demo_contents' ) );

		// Override default VC templates
		add_filter( 'vc_load_default_templates', array( $this, 'modify_default_templates' ) );
	}

	/**
	 * Filter user VC templates args
	 */
	public function category_templates_args( $category_template, $template_id, $template_data ) {
		$category_template = array(
			'unique_id'    => $template_id,
			'name'         => $template_data[ 'name' ],
			'type'         => 'my_templates',
			'image'        => isset( $template_data[ 'image_path' ] ) ? $template_data[ 'image_path' ] : false,
			'cat_name'     => isset( $template_data[ 'cat_name' ] ) ? $template_data[ 'cat_name' ] : '',
			'custom_class' => isset( $template_data[ 'custom_class' ] ) ? $template_data[ 'custom_class' ] : false,
		);

		return $category_template;
	}

	/**
	 * Filter user VC templates name args
	 */
	public function templates_name_args( $arr_category ) {
		$arr_category = array(
			'category'             => 'default_templates',
			'category_name'        => __( 'Wireframes', 'uncode-wireframes' ),
			'category_description' => __( 'Append predefined Uncode Wireframes to the current layout.', 'uncode-wireframes' ),
			'category_weight'      => 1,
		);

		return $arr_category;
	}

	/**
	 * Filter default VC templates args
	 */
	public function default_category_templates_args( $category_template, $template_id, $template_data ) {
		$category_template = array(
			'unique_id'    => $template_id,
			'name'         => $template_data[ 'name' ],
			'type'         => 'default_templates',
			'image'        => isset( $template_data['image_path'] ) ? $template_data['image_path'] : false,
			'custom_class' => isset( $template_data['custom_class'] ) ? $template_data['custom_class'] : false,
			'cat_name'     => isset( $template_data[ 'cat_name' ] ) ? $template_data[ 'cat_name' ] : '',
		);

		return $category_template;
	}

	/**
	 * Filter user VC templates args
	 */
	public function add_custom_vc_templates_html( $output, $name, $template, $template_type ) {
		$preview_img = esc_attr( isset( $template[ 'image' ] ) &&  $template[ 'image' ] != '' ? $template[ 'image' ] : UNCDWF_THUMBS_URL .'wireframe-no-image.jpg' );
		$cat_name    = esc_attr( isset( $template[ 'cat_name' ] ) ? $template[ 'cat_name' ] : '' );

		if ( ! empty( $preview_img ) && $template_type == 'default_templates' ) {
			$output .= '<div class="wireframe-image-wrap"><img data-src="' . $preview_img . '" alt="' . $name . '" width="300" height="200" /></div><div class="wireframe-category">' . $cat_name . '</div>';
		}

		return $output;
	}

	/**
	 * Adds wireframes navigation
	 */
	public function add_wireframes_navigation( $category ) {
		if ( $category[ 'category' ] == 'default_templates' ) {
			$wireframe_cats = uncode_wf_get_wireframe_categories();
			ob_start();
			?>
			<nav class="wireframe-categories-navigation">
				<ul class="wireframe-categories-navigation__list">
					<?php foreach( $wireframe_cats as $id => $category ) : ?>
						<li data-sort="<?php echo esc_attr( $id ) ?>"><?php echo esc_html( $category ) ?> <span class="count">0</span></li>
					<?php endforeach; ?>
				</ul>
			</nav>

			<?php
			$html = ob_get_clean();
			echo $html;
		}
	}

	/**
	 * Enqueue scripts
	 */
	public function add_scripts() {
		// Use minified libraries if SCRIPT_DEBUG is turned off
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( 'imagesloaded' );

		wp_enqueue_script( 'uncode-wf-bricks', UNCDWF_PLUGIN_URL . 'assets/js/lib/bricks.js', false, UNCDWF_VERSION );
		wp_enqueue_script( 'uncode-wf-admin', UNCDWF_PLUGIN_URL . 'assets/js/uncode-wireframes' . $suffix . '.js', false, UNCDWF_VERSION );

		wp_enqueue_style( 'uncode-wf-admin', UNCDWF_PLUGIN_URL . 'assets/css/uncode-wireframes.css', false, UNCDWF_VERSION );

		if ( is_rtl() ) {
			wp_enqueue_style( 'uncode-wf-admin-rtl', UNCDWF_PLUGIN_URL . 'assets/css/uncode-wireframes-rtl.css', false, UNCDWF_VERSION );
		}

		$parameters = array(
			'enable_debug' => apply_filters( 'uncode_enable_debug_on_js_scripts', false ),
			'locale'       => array(
				'add_element'       => esc_html__( 'Add Element', 'uncode-wireframes' ),
				'add_wireframe'     => esc_html__( 'Add Wireframe', 'uncode-wireframes' ),
				'needs_dependency'  => esc_html__( 'Please install %s', 'uncode-wireframes' ),
				'for_content_block' => esc_html__( 'Best use in a Content Block', 'uncode-wireframes' ),
			),
			'dependecies_map' => array(
				'woocommerce' => esc_html__( 'WooCommerce', 'uncode-wireframes' ),
				'cf7'         => esc_html__( 'Contact Form 7', 'uncode-wireframes' ),
			)
		);

		wp_localize_script( 'uncode-wf-admin', 'WireframeParameters', $parameters );
	}

	/**
	 * Adds ie class in body
	 */
	public function add_ie_class( $classes ) {
		global $is_IE, $is_edge;

		if ( $is_IE || $is_edge ) {
			$classes .= ' uncode-is-ie';
		}

        return $classes;
	}

	/**
	 * Adds markup before templates list
	 */
	public function add_html_before_templates_list() {
		$output = '<div class="wireframes-list-wrapper"><div class="wireframes-list-inner">';

		return $output;
	}

	/**
	 * Adds markup after templates list
	 */
	public function add_html_after_templates_list() {
		$output = '</div></div>';

		return $output;
	}

	/**
	 * Adds markup before single template
	 */
	public function add_html_before_single_templates( $output, $template ) {
		$name          = isset( $template[ 'name' ] ) ? esc_html( $template[ 'name' ] ) : esc_html( __( 'No title', 'uncode-wireframes' ) );
		$template_name = esc_attr( vc_slugify( $name ) );

		$output = '<div data-wireframe_name="' . $template_name . '" class="wireframes-list-item wireframes-list-item-masonry">';

		return $output;
	}

	/**
	 * Adds markup after single template
	 */
	public function add_html_after_single_templates( $output ) {
		$output = '</div>';

		return $output;
	}

	/**
	 * Change search placeholder text
	 */
	public function change_search_placeholder( $placeholder ) {
		$placeholder = esc_html__( 'Search Wireframe', 'uncode-wireframes' );

		return $placeholder;
	}

	/**
	 * Change template tab title
	 */
	public function change_template_tab_title( $title ) {
		$title = esc_html__( 'Templates', 'uncode-wireframes' );

		return $title;
	}

	/**
	 * Add wireframes button
	 */
	public function add_wireframes_button( $list ) {
		if ( is_array( $list ) ) {
			foreach ( $list as $key => $button ) {
				if ( isset( $button[0] ) && $button[0] == 'templates' ) {
					unset( $list[ $key ] );
				}
			}

			$list[] = array( 'user_templates', $this->user_templates_button_html() );
			$list[] = array( 'uncode_wireframes', $this->wireframes_button_html() );
		}

		return $list;
	}

	/**
	 * Wireframes button HTML
	 */
	public function wireframes_button_html() {
		return '<li><a href="javascript:;" class="vc_icon-btn vc_templates-button uncode-open-wireframes-button"  id="vc_templates-editor-button" data-panel="wireframes" title="' . esc_html__( 'Wireframes', 'uncode-wireframes' ) . '"><span><i class="fa fa-layers"></i>' . esc_html__( 'Wireframes','salient' ) . '</span></a></li>';
	}

	/**
	 * Legacy button HTML
	 */
	public function user_templates_button_html() {
		return '<li><a href="javascript:;" class="vc_icon-btn vc_templates-button user-templates"  id="vc_templates-editor-button" data-panel="user-templates" title="' . esc_html__( 'Templates', 'uncode-wireframes' ) . '"><i class="vc-composer-icon vc-c-icon-add_template"></i></a></li>';
	}

	/**
	 * Change window title
	 */
	public function change_window_title( $title ) {
		$title = esc_html__( 'Sections', 'uncode-wireframes' );

		return $title;
	}

	/**
	 * Import demo contents if need. This check is done only on edit/add new pages
	 */
	public function import_demo_contents() {
		global $pagenow;

		if ( isset( $pagenow ) && ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) ) {
			UNCDWF_Import::import();
		}
	}

	/**
	 * Return an empty array to override the default VC templates
	 */
	public function modify_default_templates() {
		return array();
	}
}

endif;

return new UNCDWF_Init();
