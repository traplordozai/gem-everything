<?php

/**
 * Class Radium_Theme_Importer
 *
 * This class provides the capability to import demo content as well as import widgets and WordPress menus
 *
 * @since 2.2.0
 *
 * @category RadiumFramework
 * @package  NewsCore WP
 * @author   Franklin M Gitonga
 * @link     http://radiumthemes.com/
 *
 */
class Radium_Theme_Importer {

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $theme_options_file;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $widgets;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $content_demo;
	public $import_menu;

	/**
	 * Flag imported to prevent duplicates
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $flag_as_imported = array();

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Default font stack.
	 */
	private $font_stack = array(
		'font_stack' => '[{&quot;family&quot;:&quot;Lora&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;regular,italic,700,700italic&quot;,&quot;selvariants&quot;:&quot;regular,italic,700,700italic&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;vietnamese,cyrillic,latin,cyrillic-ext,latin-ext&quot;,&quot;selsubsets&quot;:&quot;vietnamese,cyrillic,latin,cyrillic-ext,latin-ext&quot;},{&quot;family&quot;:&quot;Roboto Condensed&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;300,300italic,regular,italic,700,700italic&quot;,&quot;selvariants&quot;:&quot;300,300italic,regular,italic,700,700italic&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;greek,vietnamese,cyrillic,greek-ext,latin,cyrillic-ext,latin-ext&quot;,&quot;selsubsets&quot;:&quot;greek,vietnamese,cyrillic,greek-ext,latin,cyrillic-ext,latin-ext&quot;},{&quot;family&quot;:&quot;Inter&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;100,200,300,regular,500,600,700,800,900&quot;,&quot;selvariants&quot;:&quot;100,200,300,regular,500,600,700,800,900&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese&quot;,&quot;selsubsets&quot;:&quot;cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese&quot;},{&quot;family&quot;:&quot;Jost&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic&quot;,&quot;selvariants&quot;:&quot;100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;cyrillic,latin,latin-ext&quot;,&quot;selsubsets&quot;:&quot;cyrillic,latin,latin-ext&quot;},{&quot;family&quot;:&quot;Space Grotesk&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;300,regular,500,600,700&quot;,&quot;selvariants&quot;:&quot;300,regular,500,600,700&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;latin,latin-ext,vietnamese&quot;,&quot;selsubsets&quot;:&quot;latin,latin-ext,vietnamese&quot;},{&quot;family&quot;:&quot;Syne&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;regular,500,600,700,800&quot;,&quot;selvariants&quot;:&quot;regular,500,600,700,800&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;latin,latin-ext&quot;,&quot;selsubsets&quot;:&quot;latin,latin-ext&quot;},{&quot;family&quot;:&quot;Outfit&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;100,200,300,regular,500,600,700,800,900&quot;,&quot;selvariants&quot;:&quot;100,200,300,regular,500,600,700,800,900&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;latin&quot;,&quot;selsubsets&quot;:&quot;latin&quot;},{&quot;family&quot;:&quot;Plus Jakarta Sans&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;200,300,regular,500,600,700,800,200italic,300italic,italic,500italic,600italic,700italic,800italic&quot;,&quot;selvariants&quot;:&quot;200,300,regular,500,600,700,800,200italic,300italic,italic,500italic,600italic,700italic,800italic&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;cyrillic-ext,latin,latin-ext,vietnamese&quot;,&quot;selsubsets&quot;:&quot;cyrillic-ext,latin,latin-ext,vietnamese&quot;},{&quot;family&quot;:&quot;Barlow&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&quot;,&quot;selvariants&quot;:&quot;100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;latin,latin-ext,vietnamese&quot;,&quot;selsubsets&quot;:&quot;latin,latin-ext,vietnamese&quot;},{&quot;family&quot;:&quot;Fahkwang&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic&quot;,&quot;selvariants&quot;:&quot;200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;latin,latin-ext,thai,vietnamese&quot;,&quot;selsubsets&quot;:&quot;latin,latin-ext,thai,vietnamese&quot;},{&quot;family&quot;:&quot;Public Sans&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic&quot;,&quot;selvariants&quot;:&quot;100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;latin,latin-ext,vietnamese&quot;,&quot;selsubsets&quot;:&quot;latin,latin-ext,vietnamese&quot;},{&quot;family&quot;:&quot;EB Garamond&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;regular,500,600,700,800,italic,500italic,600italic,700italic,800italic&quot;,&quot;selvariants&quot;:&quot;regular,500,600,700,800,italic,500italic,600italic,700italic,800italic&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese&quot;,&quot;selsubsets&quot;:&quot;cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese&quot;},{&quot;family&quot;:&quot;Fraunces&quot;,&quot;familyID&quot;:&quot;&quot;,&quot;source&quot;:&quot;Google Web Fonts&quot;,&quot;stub&quot;:&quot;&quot;,&quot;generic&quot;:&quot;&quot;,&quot;variants&quot;:&quot;100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic&quot;,&quot;selvariants&quot;:&quot;100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic&quot;,&quot;variantselectors&quot;:&quot;&quot;,&quot;files&quot;:&quot;&quot;,&quot;subsets&quot;:&quot;latin,latin-ext,vietnamese&quot;,&quot;selsubsets&quot;:&quot;latin,latin-ext,vietnamese&quot;}]'
	);

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 2.2.0
	 */
	public function __construct() {

		self::$instance = $this;

		$this->theme_options_file = $this->demo_files_path . $this->theme_options_file_name;
		$this->widgets = $this->demo_files_path . $this->widgets_file_name;
		$this->content_demo = $this->demo_files_path . $this->content_demo_file_name;

		add_action( 'admin_menu', array($this, 'add_admin'), 20 );

	}

	/**
	 * Add Panel Page
	 *
	 * @since 2.2.0
	 */
	public function add_admin() {
		if ( ! defined( 'UNCODE_SLIM' ) ) {
			return;
		}

		add_submenu_page('uncode-system-status', esc_html__('Import Demo','uncode-core'), esc_html__('Import Demo','uncode-core'), 'switch_themes', 'uncode-import-demo', array($this, 'demo_installer'));

	}

	/**
	 * [demo_installer description]
	 *
	 * @since 2.2.0
	 *
	 * @return [type] [description]
	 */
	public function demo_installer() {

		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
		?>

		<div class="wrap uncode-wrap" id="uncode-import-demo">

			<?php echo uncode_admin_panel_page_title( 'import' ); ?>

			<div class="uncode-admin-panel">
				<?php echo uncode_admin_panel_menu( 'import' ); ?>

				<div class="uncode-admin-panel__content">
					<?php if ($action === '') : ?>
						<div id="import-area">
							<div class="uncode-admin-panel__left">
								<h2 class="uncode-admin-panel__heading"><?php esc_html_e( 'Import Notes', 'uncode-core' ); ?></h2>

								<div class="uncode-info-box">
									<p class="uncode-admin-panel__description"><?php printf(esc_html__( 'Uncode\'s main demo (200+ pages), which includes placeholder media files, can be imported with Import Demo or partially imported with Import Single Layouts. %s', 'uncode-core' ), '<a href="//support.undsgn.com/hc/en-us/articles/214001065">'.esc_html__('More info','uncode-core').'</a>.'); ?></p>

									<h4 class="uncode-import-description__heading"><?php echo esc_html__( 'Important', 'uncode-core' ); ?></h4>

									<ul class="uncode-import-description__list checklist">
										<li><?php echo esc_html__( 'Using this import feature is only recommended for fresh installations.', 'uncode-core' ); ?></li>
										<li><?php echo esc_html__( 'The import will merge any existing content with the Uncode demo content.', 'uncode-core' ); ?></li>
										<li><?php echo esc_html__( 'Make sure there are no red messages within the System Status section before proceeding.', 'uncode-core' ); ?></li>
										<li><?php echo esc_html__( 'Deactivate all plugins before importing, except for the theme\'s official plugins.', 'uncode-core' ); ?></li>
										<li><?php echo esc_html__( 'The importer will create an exact replica of the demo site, with placeholder images included.', 'uncode-core' ); ?></li>
										<li><?php echo esc_html__( 'No existing content or any other data will be deleted or modified during the import process.', 'uncode-core' ); ?></li>
										<li><?php echo esc_html__( 'The time it takes for demo imports to complete can vary, based on your server’s performance.', 'uncode-core' ); ?></li>
									</ul>
								</div><!-- .uncode-info-box -->
							</div><!-- .uncode-admin-panel__left -->

							<div class="uncode-admin-panel__right">
								<div class="uncode-import-methods-wrap">
									<div class="uncode-import-method uncode-import-method--import-all">
										<div>
											<?php
											global $wp_filesystem;
											if (empty($wp_filesystem)) {
											  require_once (ABSPATH . '/wp-admin/includes/file.php');
											}
											$demo_file = $this->content_demo;
											$can_read_file = true;
											if (false === ($creds = request_filesystem_credentials($demo_file, '', false, false))) {
												$can_read_file = false;
											}
											/* initialize the API */
											if ( ! WP_Filesystem($creds) ) {
												/* any problems and we exit */
												$can_read_file = false;
											}
											$response = $wp_filesystem->get_contents($demo_file);
											if($response && $can_read_file) {
												?>
												<div class="uncode-import-method-left">
													<h3 class="box-card__title"><?php esc_html_e('Import Demo', 'uncode-core'); ?></h3>
													<p><?php esc_html_e('Import all demos layouts and create a technical replica of the Uncode demo site.', 'uncode-core'); ?></p>
												</div><!-- .uncode-import-method-left -->
												<div class="uncode-import-method-right">
													<form class="uncode-import-form import-demo">
														<input class="uncode-import-button button button-primary uncode-ui-button" type="submit" value="<?php echo esc_html__('Import Demo', 'uncode-core'); ?>" />
													</form>
												</div><!-- .uncode-import-method-right -->
												<?php
											} else { ?>
												<p class="uncode-import-perms-error"><?php printf( esc_html__( 'The file %s can\'t be read. Please change file permission to 775.','uncode-core'), $this->content_demo ); ?></p>
											<?php
												die();
											}
											?>
										</div><!-- .uncode-import-method.uncode-import-method--import-all -->
									</div><!-- .uncode-import-methods-wrap -->

									<?php
									// include WXR file parsers
									require_once dirname( __FILE__ ) . '/parsers.php';
									$parser = new Uncode_WXR_Parser();
									$parsed_xml = $parser->parse( $this->content_demo );
									$post_array = array();
									$page_array = array();
									$portfolio_array = array();
									$gallery_array = array();
									$product_array = array();
									$original_array = array();

									foreach ($parsed_xml['posts'] as $key => $value) {
										$original_array[$value['post_id']] = $value['post_title'];
									}

									foreach ($parsed_xml['posts'] as $key => $value) {
										$post_content = isset( $value['post_content'] ) ? $value['post_content'] : '';

										$extra_cb_ids = array();

										// Check content blocks in content
										if ( strpos( $post_content, '[uncode_block' ) !== false ) {
											$regex = '/\[uncode_block(.*?)\]/';
											$regex_attr = '/(.*?)=\"(.*?)\"/';
											preg_match_all( $regex, $post_content, $matches, PREG_SET_ORDER );

											foreach ( $matches as $regex_key => $regex_value ) {
												if (isset( $regex_value[1] ) ) {
													preg_match_all( $regex_attr, trim( $regex_value[ 1 ] ), $matches_attr, PREG_SET_ORDER );

													foreach ( $matches_attr as $key_attr => $value_attr ) {
														if ( 'id' === trim( $value_attr[1] ) ) {
															$cb_id = $value_attr[2];

															if ( $cb_id > 0 ) {
																$extra_cb_ids[] = $cb_id;
															}
														}
													}
												}
											}
										}

										// Check widgetized content blocks in post modules
										if ( strpos( $post_content, 'widgetized_content_block_id' ) !== false ) {
											$regex = '/widgetized_content_block_id=\"(\d+)\"/';
											preg_match_all( $regex, $post_content, $matches, PREG_SET_ORDER );

											foreach ( $matches as $regex_key => $regex_value ) {
												if (isset( $regex_value[1] ) ) {
													$cb_id = trim( $regex_value[1] );
													if ( $cb_id > 0 ) {
														$extra_cb_ids[] = $cb_id;
													}
												}
											}
										}

										// Check ajax filters content blocks in post modules
										if ( strpos( $post_content, 'ajax_filters_content_block_id' ) !== false ) {
											$regex = '/ajax_filters_content_block_id=\"(\d+)\"/';
											preg_match_all( $regex, $post_content, $matches, PREG_SET_ORDER );

											foreach ( $matches as $regex_key => $regex_value ) {
												if (isset( $regex_value[1] ) ) {
													$cb_id = trim( $regex_value[1] );
													if ( $cb_id > 0 ) {
														$extra_cb_ids[] = $cb_id;
													}
												}
											}
										}

										// Check custom grids content blocks in post modules
										if ( strpos( $post_content, 'custom_grid_content_block_id' ) !== false ) {
											$regex = '/custom_grid_content_block_id=\"(\d+)\"/';
											preg_match_all( $regex, $post_content, $matches, PREG_SET_ORDER );

											foreach ( $matches as $regex_key => $regex_value ) {
												if (isset( $regex_value[1] ) ) {
													$cb_id = trim( $regex_value[1] );
													if ( $cb_id > 0 ) {
														$extra_cb_ids[] = $cb_id;
													}
												}
											}
										}

										$postmeta = array();

										if ( isset( $value['postmeta'] ) && is_array( $value['postmeta'] ) ) {
											foreach ( $value['postmeta'] as $meta_key => $meta_value ) {
												$postmeta[ $meta_value['key'] ] = $meta_value['value'];
											}
										}

										switch ($value['post_type']) {
											case 'post':
												$ids = array($value['post_id']);
												if ( count( $extra_cb_ids ) > 0 ) {
													$ids = array_merge( $ids, $extra_cb_ids );
												}
												foreach ( $postmeta as $meta_key => $meta_value ) {
													if ( isset( $postmeta['_uncode_header_type'] ) && $postmeta['_uncode_header_type'] === 'header_uncodeblock' && $meta_key === '_uncode_blocks_list' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_footer_block' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block_after_pre' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block_after' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( isset( $postmeta['_uncode_specific_navigation_hide'] ) && $postmeta['_uncode_specific_navigation_hide'] === 'uncodeblock' && $meta_key === '_uncode_specific_navigation_content_block') {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
												}
												$post_array[$value['post_title']] = array(
													'ids' => $ids,
												);
												break;
											case 'page':
												$ids = array($value['post_id']);
												if ( count( $extra_cb_ids ) > 0 ) {
													$ids = array_merge( $ids, $extra_cb_ids );
												}
												$parent = $value['post_parent'];
												foreach ( $postmeta as $meta_key => $meta_value ) {
													if ( isset( $postmeta['_uncode_header_type'] ) && $postmeta['_uncode_header_type'] === 'header_uncodeblock' && $meta_key === '_uncode_blocks_list' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_footer_block' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block_after_pre' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block_after' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( isset( $postmeta['_uncode_specific_navigation_hide'] ) && $postmeta['_uncode_specific_navigation_hide'] === 'uncodeblock' && $meta_key === '_uncode_specific_navigation_content_block') {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
												}
												$value_post_title = $value['post_title'];
												if ( isset( $original_array[$parent] ) && $original_array[$parent] === 'Homepages' ) {
													$value_post_title = $value_post_title . ' (Homepage)';
												}
												$page_array[$value_post_title] = array(
													'ids' => $ids,
												);
												break;
											case 'portfolio':
												$ids = array($value['post_id']);
												if ( count( $extra_cb_ids ) > 0 ) {
													$ids = array_merge( $ids, $extra_cb_ids );
												}
												foreach ( $postmeta as $meta_key => $meta_value ) {
													if ( isset( $postmeta['_uncode_header_type'] ) && $postmeta['_uncode_header_type'] === 'header_uncodeblock' && $meta_key === '_uncode_blocks_list' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_footer_block' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block_after_pre' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block_after' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( isset( $postmeta['_uncode_specific_navigation_hide'] ) && $postmeta['_uncode_specific_navigation_hide'] === 'uncodeblock' && $meta_key === '_uncode_specific_navigation_content_block') {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
												}
												$portfolio_array[$value['post_title']] = array(
													'ids' => $ids,
												);
												break;
											case 'uncode_gallery':
												$ids = array($value['post_id']);
												if ( count( $extra_cb_ids ) > 0 ) {
													$ids = array_merge( $ids, $extra_cb_ids );
												}
												foreach ( $postmeta as $meta_key => $meta_value ) {
													if ( isset( $postmeta['_uncode_header_type'] ) && $postmeta['_uncode_header_type'] === 'header_uncodeblock' && $meta_key === '_uncode_blocks_list' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_footer_block' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block_after_pre' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block_after' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( isset( $postmeta['_uncode_specific_navigation_hide'] ) && $postmeta['_uncode_specific_navigation_hide'] === 'uncodeblock' && $meta_key === '_uncode_specific_navigation_content_block') {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
												}
												$gallery_array[$value['post_title']] = array(
													'ids' => $ids,
												);
												break;
											case 'product':
												$ids = array($value['post_id']);
												if ( count( $extra_cb_ids ) > 0 ) {
													$ids = array_merge( $ids, $extra_cb_ids );
												}
												foreach ( $postmeta as $meta_key => $meta_value ) {
													if ( isset( $postmeta['_uncode_header_type'] ) && $postmeta['_uncode_header_type'] === 'header_uncodeblock' && $meta_key === '_uncode_blocks_list' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_footer_block' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block_after_pre' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( $meta_key === '_uncode_specific_content_block_after' ) {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
													if ( isset( $postmeta['_uncode_specific_navigation_hide'] ) && $postmeta['_uncode_specific_navigation_hide'] === 'uncodeblock' && $meta_key === '_uncode_specific_navigation_content_block') {
														if ( absint( $meta_value ) > 0 ) {
															$ids[] = $meta_value;
														}
													}
												}
												$product_array[$value['post_title']] = array(
													'ids' => $ids,
												);
												break;
										}
									}

									$is_woocommerce = class_exists( 'WooCommerce' );
									?>

									<div class="uncode-import-methods-wrap">
										<div class="uncode-import-method uncode-import-method--import-selective">
											<div class="uncode-import-method-left">
												<h3 class="box-card__title"><?php esc_html_e('Import Single Layouts', 'uncode-core'); ?></h3>
												<p><?php esc_html_e('Import selected layouts and create your own custom Uncode import.', 'uncode-core'); ?></p>
											</div><!-- .uncode-import-method-left -->
											<div class="uncode-import-method-right">
												<input id="import-single-switch" type="button" class="uncode-import-button button button-primary uncode-ui-button" value="<?php echo esc_html__('Import Layouts', 'uncode-core'); ?>" />
											</div><!-- .uncode-import-method-right -->
										</div><!-- .uncode-import-method.uncode-import-method--import-selective -->
									</div><!-- .uncode-import-methods-wrap -->

									<div class="uncode-import-methods-wrap">
										<div class="uncode-import-method uncode-import-method--import-options">
											<div class="uncode-import-method-left">
												<h3 class="box-card__title"><?php esc_html_e('Import Theme Options', 'uncode-core'); ?></h3>
												<p><?php esc_html_e('Import the Theme Options and Content Blocks from the Uncode demo site.', 'uncode-core'); ?></p>
											</div><!-- .uncode-import-method-left -->
											<div class="uncode-import-method-right">
												<form class="uncode-import-form import-ot">
													<input class="uncode-import-button button button-primary uncode-ui-button" type="submit" value="<?php echo esc_html__('Import Options', 'uncode-core'); ?>" />
												</form>
											</div><!-- .uncode-import-method-right -->
										</div><!-- .uncode-import-method.uncode-import-method--import-options -->
									</div><!-- .uncode-import-methods-wrap -->

									<div class="uncode-import-methods-wrap">
										<div class="uncode-import-method uncode-import-method--import-menu">
											<div class="uncode-import-method-left">
												<h3 class="box-card__title"><?php esc_html_e('Import Menu', 'uncode-core'); ?></h3>
												<p><?php esc_html_e('Import the menus from the Uncode demo site.', 'uncode-core'); ?></p>
											</div><!-- .uncode-import-method-left -->
											<div class="uncode-import-method-right">
												<form class="uncode-import-form import-menu">
													<input class="uncode-import-button button button-primary uncode-ui-button" type="submit" value="<?php echo esc_html__('Import Menu', 'uncode-core'); ?>" />
												</form>
											</div><!-- .uncode-import-method-right -->
										</div><!-- .uncode-import-method.uncode-import-method--import-menu -->
									</div><!-- .uncode-import-methods-wrap -->

									<div class="uncode-import-methods-wrap">
										<div class="uncode-import-method uncode-import-method--import-widgets">
											<div class="uncode-import-method-left">
												<h3 class="box-card__title"><?php esc_html_e('Import Widgets', 'uncode-core'); ?></h3>
												<p><?php esc_html_e('Import the widgets from the Uncode demo site.', 'uncode-core'); ?></p>
											</div><!-- .uncode-import-method-left -->
											<div class="uncode-import-method-right">
												<form class="uncode-import-form import-widgets">
													<input class="uncode-import-button button button-primary uncode-ui-button" type="submit" value="<?php echo esc_html__('Import Widgets', 'uncode-core'); ?>" />
												</form>
											</div><!-- .uncode-import-method-right -->
										</div><!-- .uncode-import-method.uncode-import-method--import-widgets -->
									</div><!-- .uncode-import-methods-wrap -->

									<div class="uncode-import-methods-wrap">
										<div class="uncode-import-method uncode-import-method--delete-media">
											<?php /*<div class="uncode-import-method-left">
												<h3 class="box-card__title"><?php esc_html_e('Delete media', 'uncode-core'); ?></h3>
												<p><?php esc_html_e('Import the widgets of the Uncode demo site.', 'uncode-core'); ?></p>
											</div><!-- .uncode-import-method-left --> */?>
											<div class="uncode-import-method-right">
												<form class="uncode-import-form delete-media">
													<input class="uncode-import-button button button-secondary uncode-ui-button uncode-import-button--delete" type="submit" value="<?php echo esc_html__('Delete Demo Media', 'uncode-core'); ?>" />
												</form>
											</div><!-- .uncode-import-method-right -->
										</div><!-- .uncode-import-method.uncode-import-method--delete-media -->
									</div><!-- .uncode-import-methods-wrap -->

									<div class="uncode-singles-import-wrap" style="display: none;">

										<form class="uncode-import-form uncode-import-form--singles">
											<div class="uncode-import-single-blocks uncode-ui-layout uncode-ui-layout--<?php echo ($is_woocommerce) ? 'four' : 'three'; ?>-cols">
												<div class="uncode-import-single-block uncode-ui-layout__item uncode-ui-layout__item--<?php echo ($is_woocommerce) ? 'four' : 'three'; ?>-cols">
													<h4 class="uncode-import-single-block__title"><?php esc_html_e( 'Pages', 'uncode-core' ); ?></h4>
													<select class="uncode-import-single-block__select" name="post[]" multiple>
														<?php
														ksort($page_array);
														foreach ($page_array as $key => $value) {
															echo '<option value="'.esc_attr(implode(',', $value['ids'])).'">'.$key.'</option>';
														}
														?>
													</select>
												</div><!-- .uncode-import-single-block -->
												<div class="uncode-import-single-block uncode-ui-layout__item uncode-ui-layout__item--<?php echo ($is_woocommerce) ? 'four' : 'three'; ?>-cols">
													<h4 class="uncode-import-single-block__title"><?php esc_html_e( 'Posts', 'uncode-core' ); ?></h4>
													<select class="uncode-import-single-block__select" name="post[]" multiple>
														<?php
														ksort($post_array);
														foreach ($post_array as $key => $value) {
															echo '<option value="'.esc_attr(implode(',', $value['ids'])).'">'.$key.'</option>';
														}
														?>
													</select>
												</div><!-- .uncode-import-single-block -->
												<div class="uncode-import-single-block uncode-ui-layout__item uncode-ui-layout__item--<?php echo ($is_woocommerce) ? 'four' : 'three'; ?>-cols">
													<h4 class="uncode-import-single-block__title"><?php esc_html_e( 'Portfolios', 'uncode-core' ); ?></h4>
													<select class="uncode-import-single-block__select" name="post[]" multiple>
														<?php
														ksort($portfolio_array);
														foreach ($portfolio_array as $key => $value) {
															echo '<option value="'.esc_attr(implode(',', $value['ids'])).'">'.$key.'</option>';
														}
														?>
													</select>
												</div><!-- .uncode-import-single-block -->
												<?php /*<div class="uncode-import-single-block uncode-ui-layout__item uncode-ui-layout__item--<?php echo ($is_woocommerce) ? 'four' : 'three'; ?>-cols">
													<h4 class="uncode-import-single-block__title"><?php esc_html_e( 'Galleries', 'uncode-core' ); ?></h4>
													<select class="uncode-import-single-block__select" name="post[]" multiple>
														<?php
														ksort($gallery_array);
														foreach ($gallery_array as $key => $value) {
															echo '<option value="'.esc_attr(implode(',', $value['ids'])).'">'.$key.'</option>';
														}
														?>
													</select>
												</div><!-- .uncode-import-single-block --> */ ?>
												<?php if ( $is_woocommerce ) : ?>
													<div class="uncode-import-single-block uncode-ui-layout__item uncode-ui-layout__item--<?php echo ($is_woocommerce) ? 'four' : 'three'; ?>-cols">
														<h4 class="uncode-import-single-block__title"><?php esc_html_e( 'Products', 'uncode-core' ); ?></h4>
														<select class="uncode-import-single-block__select" name="post[]" multiple>
															<?php
															ksort($product_array);
															foreach ($product_array as $key => $value) {
																echo '<option value="'.esc_attr(implode(',', $value['ids'])).'">'.$key.'</option>';
															}
															?>
														</select>
													</div><!-- .uncode-import-single-block -->
												<?php endif; ?>
											</div><!-- .uncode-import-single-blocks -->

											<input class="uncode-import-button button button-primary uncode-ui-button" type="submit" style="display: none;" value="<?php echo esc_attr( 'Import Singles', 'uncode-core' ); ?>" />
										</form>

										<p><strong><?php esc_html_e('NB.', 'uncode-core'); ?></strong> <?php esc_html_e('When you import a single layout, you’re only importing the Page Builder layout. If you need to import a page that includes external elements such as a blog or portfolio, please also select those elements. To select multiple options on Windows hold down the control (ctrl) button, on Mac hold down the command button.', 'uncode-core'); ?></p>

									</div><!-- .uncode-singles-import-wrap -->

								</div><!-- .uncode-box-wrap -->

							</div><!-- .uncode-admin-panel__right -->

						</div><!-- #import-area -->

						<div class="uncode-import-response"></div>

						<input id="uncode-import-back" class="uncode-import-button button uncode-ui-button" type="button" value="<?php echo esc_attr__( 'Back', 'uncode-core' ); ?>" style="display:none;" />

					<?php elseif ( 'demo-data' == $action && check_admin_referer('radium-demo-code' , 'demononce') ) :
						$ids = isset($_REQUEST['ids']) ? $_REQUEST['ids'] : '';
						$theme_options = isset($_REQUEST['options']) ? $_REQUEST['options'] : '';
						$options_with_cb = isset($_REQUEST['options_with_cb']) && $_REQUEST['options_with_cb'] === 'true' ? true : false;
						$import_menu = isset($_REQUEST['menu']) ? $_REQUEST['menu'] : '';
						$widgets = isset($_REQUEST['widgets']) ? $_REQUEST['widgets'] : '';
						$delete = isset($_REQUEST['delete']) ? $_REQUEST['delete'] : '';

						$this->import_menu = ($import_menu !== '' && $import_menu === 'true') ? true : false;

						$partial_import_done_title = ( $delete !== '' && $delete === 'true' ) ? esc_html__( 'All demo medias deleted!', 'uncode-core' ): esc_html__( 'Import completed!', 'uncode-core' );

						$partial_import_done = '<div class="uncode-import-response">
							<div class="uncode-import-response-content">
								<div class="uncode-svg-success"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="-263.5 236.5 26 26"><g class="svg-success"><circle cx="-250.5" cy="249.5" r="12"/><path d="M-256.46 249.65l3.9 3.74 8.02-7.8"/></g></svg></div>
								<h4 class=" uncode-import-response__title">' . $partial_import_done_title . '</h4><div id="import-fine" style="display: none;"></div>
							</div>
						</div>';

						if ($theme_options !== '' && $theme_options === 'true') {
							$this->set_demo_theme_options( $this->theme_options_file, $options_with_cb );
							echo $partial_import_done;
						} else if ($widgets !== '' && $widgets === 'true') {
							$this->process_widget_import_file( $this->widgets );
							echo $partial_import_done;
						} else if ($delete !== '' && $delete === 'true') {
							$this->delete_demo_media();
							echo $partial_import_done;
						} else if ($this->import_menu) {
							$this->set_demo_data( $this->content_demo, '');
							if ($this->import_menu) $this->set_demo_menus();
						} else {
							if ($ids === '' || (string) $ids === '-1') {
								$this->set_demo_theme_options( $this->theme_options_file ); //import before widgets incase we need more sidebars
								$this->set_demo_data( $this->content_demo, '');
								if ($this->import_menu) $this->set_demo_menus();
								$this->process_widget_import_file( $this->widgets );
								$homepage = get_page_by_title( 'Index' );
								if ( $homepage )
								{
							    update_option( 'page_on_front', $homepage->ID );
							    update_option( 'show_on_front', 'page' );
								}
							} else {
								$this->set_demo_data( $this->content_demo, $ids );
							}
						}
					endif; ?>
				</div><!-- .uncode-admin-panel__content -->
			</div><!-- .uncode-admin-panel -->

		</div><!-- .uncode-wrap -->

		<script type="text/javascript">
			jQuery( function ( $ ) {
				'use strict';
				var runned = 0;

				function show_import_result(result, error) {
					// $('.uncode-import-response').html(result);
					// $('.uncode-import-response').show();

					// if (error) {
					// 	$('.uncode-import-response').addClass('uncode-import-response--error');
					// }

					// $('.uncode-import-loader').remove();
					// $('#uncode-import-back').show();

					$('.uncode-import-demo-modal .ui-dialog-content').html(result);
					$('.uncode-import-demo-modal .ui-dialog-titlebar button').show();
				}

				$('#import-single-switch').on('click', function(event) {
					/*$('.uncode-secondary-import').hide();
					$('.uncode-singles-import-wrap').show();
					$('#uncode-import-back').show();*/
					var import_single_content = $('.uncode-singles-import-wrap').html();
					$("<div />").html(import_single_content).dialog({
						autoOpen: true,
						modal: true,
						dialogClass: 'uncode-modal',
						title: "<?php echo esc_html__('Import Single Layouts', 'uncode-core'); ?>",
						minHeight: 500,
						minWidth: 500,
						width: 1200,
						closeText: '',
						position: { my: "center", at: "center", of: window },
						buttons : {
							"<?php echo esc_html__('Import', 'uncode-core'); ?>" : function() {
								var $form = $('form.uncode-import-form', this).submit();
								//confirmImportRun();
								$(this).dialog("close");
							},
							"<?php echo esc_html__('Cancel', 'uncode-core'); ?>" : function() {
								$(this).dialog("close");
							}
						},
						open: function( event, ui ) {
							$('body').addClass('overflow_hidden');
						},
						close: function( event, ui ) {
							$('body').removeClass('overflow_hidden');
						}
					});
				});
				/*$('#uncode-import-back').on('click', function() {
					//$('#import-area').show();
					$('.uncode-secondary-import').show();
					$('.uncode-singles-import-wrap').hide();
					$('#uncode-import-back').hide();
				});*/

				$(document).on('submit', '.uncode-import-form', function(e) {
					e.preventDefault();
					var _form = $(this);
					var modal_content = ''; // Will hold the modal content
					var dialog_title;

					// Title
					modal_content += '<h4><?php esc_html_e( 'Important', 'uncode-core' ); ?></h4>';

					// Default message
					var theme_options_message_text = '<p><?php esc_html_e( 'This action will replace your Theme Options.', 'uncode-core' ); ?></p>';
					var menu_message_text = '<p><?php esc_html_e( 'This action will import the Uncode\'s demo site menus.', 'uncode-core' ); ?></p>';
					var widget_message_text = '<p><?php esc_html_e( 'This action will import the Uncode\'s demo site widgets.', 'uncode-core' ); ?></p>';

					// When the user clicks on the import button (demo or singles), show some instructions
					var import_warning_text = '<ol>' +
						'<li><?php esc_html_e( 'This action will not import the Uncode demo site\'s main menu. If you want to import that element as well, please use the "Import Menu" button.', 'uncode-core' ); ?></li>'

					if (!$(e.currentTarget).hasClass('uncode-import-form--singles')) {
						import_warning_text += '<li><?php esc_html_e( 'If you are importing demos to an existing installation of Uncode, please note that this action will also overwrite your "Theme Options". If you need to import specific layouts to your existing installation, please use the "Single Layouts" button.', 'uncode-core' ); ?></li>';
					}

					// Show a different message when the user deletes the uncode medias
					var delete_media_text = '<p><?php esc_html_e('This action will delete your images.', 'uncode-core'); ?></p>';

					// Show a list of inactive plugins when the user clicks on the import button
					var cf7_active_text = '<?php echo ( class_exists( 'WPCF7' ) ) ? '' : esc_html__( 'Contact Form 7 (recommended)', 'uncode-core' ); ?>';
					var woo_active_text = '<?php echo ( defined( 'WC_VERSION' ) ) ? '' : esc_html__('WooCommerce (recommended)', 'uncode-core'); ?>';
					var inactive_plugins_text;

					if (cf7_active_text || woo_active_text) {
						var inactive_plugins_desc = '<span class="inactive-plugins__sep"> - </span><span class="inactive-plugins__desc"><?php esc_html_e( 'Plugin is not active', 'uncode-core'); ?></span>'

						inactive_plugins_text = '<li><?php esc_html_e('The following plugins are inactive, which will prevent the relevant content from being imported:', 'uncode-core'); ?>';

						inactive_plugins_text += '<ul class="inactive-plugins__list">';

						if (cf7_active_text) {
							inactive_plugins_text += '<li><span class="inactive-plugins__name">' + cf7_active_text + '</span>' + inactive_plugins_desc + '</li>';
						}

						if (woo_active_text) {
							inactive_plugins_text += '<li><span class="inactive-plugins__name">' + woo_active_text + '</span>' + inactive_plugins_desc + '</li>';
						}

						inactive_plugins_text += '</ul></li>';
					}

					// Add checkbox for content blocks
					var content_block_checkbox = '<p class="import-required-content-blocks"><label><input type="checkbox" id="import-required-content-blocks-input" name="import-required-content-blocks-input" value="1" checked> <?php esc_html_e('Import required Content Blocks', 'uncode-core'); ?></label></p>';

					// Create a specific message according to the selected action
					if ($(e.currentTarget).hasClass('delete-media')) {
						modal_content += delete_media_text;
						dialog_title = '<?php esc_html_e('Delete Demo Media', 'uncode-core'); ?>';
					} else if ($(e.currentTarget).hasClass('import-ot')) {
						modal_content += theme_options_message_text;
						modal_content += content_block_checkbox;
						dialog_title = '<?php esc_html_e('Import Theme Options', 'uncode-core'); ?>';
					} else if ($(e.currentTarget).hasClass('import-widgets')) {
						modal_content += widget_message_text;
						dialog_title = '<?php esc_html_e('Import Widgets', 'uncode-core'); ?>';
					} else if ($(e.currentTarget).hasClass('import-menu')) {
						modal_content += menu_message_text;
						dialog_title = '<?php esc_html_e('Import Menu', 'uncode-core'); ?>';
					} else {
						modal_content += import_warning_text;
						if (inactive_plugins_text) {
							modal_content += inactive_plugins_text;
						}

						modal_content += '</ol>';
						if ($(e.currentTarget).hasClass('uncode-import-form--singles'))
							dialog_title = '<?php esc_html_e('Import Single Layouts', 'uncode-core'); ?>';
						else
							dialog_title = '<?php esc_html_e('Import Demo', 'uncode-core'); ?>';

					}

					modal_content += '<p><?php esc_html_e( 'Are you sure?', 'uncode-core' ); ?></p>';

					// $().uncode_modal('open', modal_content);

					// $(document).on('click', '#uncode-cancel-modal, .uncode-ui-overlay', function() {
					// 	$().uncode_modal('close');
					// });

					var confirmImportRun = function(){
					//$(document).on('click', '#uncode-confirm-modal', function() {
						var is_delete_form = false;

						// Loader title
						var loader_title = '<?php esc_html_e( 'Import Demo', 'uncode-core' ); ?>';

						if (_form.hasClass('uncode-import-form--singles')) {
							loader_title = '<?php esc_html_e( 'Import Single Layouts', 'uncode-core' ); ?>';
						} else if (_form.hasClass('import-ot')) {
							loader_title = '<?php esc_html_e( 'Import Theme Options', 'uncode-core' ); ?>';
						} else if (_form.hasClass('import-menu')) {
							loader_title = '<?php esc_html_e( 'Import Menu', 'uncode-core' ); ?>';
						} else if (_form.hasClass('import-widgets')) {
							loader_title = '<?php esc_html_e( 'Import Widgets', 'uncode-core' ); ?>';
						} else if (_form.hasClass('delete-media')) {
							is_delete_form = true;
							loader_title = '<?php esc_html_e( 'Delete Demo Media', 'uncode-core' ); ?>';
						}

						if (! _form.hasClass('delete-media')) {
							is_delete_form = true;
						}

						//$().uncode_modal('close');
						//$('#import-area').hide();
						//$('#uncode-import-back').hide();

						var import_loader = '<div class="uncode-import-loader">' +
							'<div class="uncode-ot-spinner"></div>' +
							//'<h4 class="uncode-import-loader__title">' + loader_title + '</h4>' +
							'<div class="uncode-import-loader__description">' +
								'<p><strong><?php echo esc_html__( 'Do not close the browser or navigate away from this page.', 'uncode-core' ); ?></strong></p>' +
								'<p><?php echo esc_html__( 'Please be patient. The import procedure can take up to a few minutes, based on your server\'s performance.', 'uncode-core' ); ?></p>';

						if (!is_delete_form) {
							import_loader += '<?php printf( '<p class="uncode-import-loader__tip"><strong>%s:</strong> %s <strong>%s</strong> %s</p>', esc_html__( 'Tips', 'uncode-core' ), esc_html__( 'Did you know that you can delete all the imported demo media using the', 'uncode-core' ), esc_html__( 'delete demo media', 'uncode-core' ), esc_html__( 'button inside this page?', 'uncode-core' ) ); ?>';
						}

						import_loader += '</div>'; // close description
						import_loader += '</div>'; // close loader

						var import_options_with_content_blocks = $('#import-required-content-blocks-input').prop('checked');

						//$(import_loader).insertAfter('#import-area');

						$('.uncode-import-demo-modal .ui-dialog-content').html(import_loader);
						$('.uncode-import-demo-modal .ui-dialog-buttonpane').hide();
						$('.uncode-import-demo-modal .ui-dialog-title').text(loader_title);
						$('.uncode-import-demo-modal .ui-dialog-titlebar button').hide();

						var data = {
							action: 'demo-data',
							dataType: "html",
							ids: _form.hasClass('uncode-import-form--singles') ? _form.serialize() : '-1',
							single_layout: _form.hasClass('uncode-import-form--singles') ? true : false,
							options: _form.hasClass('import-ot') ? true : false,
							options_with_cb: import_options_with_content_blocks,
							menu: _form.hasClass('import-menu') ? true : false,
							widgets: _form.hasClass('import-widgets') ? true : false,
							delete: _form.hasClass('delete-media') ? true : false,
							demononce: '<?php echo wp_create_nonce('radium-demo-code'); ?>'
						};
						uncode_import_demo(data);
					};

					if (_form.hasClass('uncode-import-form--singles') && !_form.serialize()) {
						return false;
					}

					$("<div />").html(modal_content).dialog({
						autoOpen: true,
						modal: true,
						dialogClass: 'uncode-modal uncode-import-demo-modal',
						title: dialog_title,
						minHeight: 500,
						minWidth: 500,
						closeText: '',
						position: { my: "center", at: "center", of: window },
						buttons : {
							"<?php echo esc_html__('Confirm', 'uncode-core'); ?>" : function() {
								confirmImportRun();
								//$(this).dialog("close");
							},
							"<?php echo esc_html__('Cancel', 'uncode-core'); ?>" : function() {
								$(this).dialog("close");
							}
						}
					});

					return false;
				});
				function uncode_import_demo(data) {
					var this_data = data;
					$.ajax({
						type : "post",
						dataType : "html",
						url : '<?php echo admin_url("admin.php?page=uncode-import-demo"); ?>',
						data : data,
						success: function(response, textStatus, xhr) {
							var result = $(response).find('.uncode-import-response').html(),
								is_fine = $(response).find('#import-fine');
							if (!$(is_fine).length) {
								if ($(response).find('.post-imported').length > 0 && runned < 20) {
									runned++;
									uncode_import_demo(this_data);
								} else {
									result = '<div class="uncode-import-response"><div class="uncode-import-response-content"><div class="uncode-svg-error"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40px" height="40px" viewBox="-263.5 236.5 26 26"><g class="svg-error"><circle cx="-250.5" cy="249.5" r="12"/><path d="M-254.51,253.391l8.02-7.801"/><path d="M-246.6,253.5l-7.801-8.02"/></g></svg></div><h4><?php echo esc_html__('Ooops, the Demo Content couldn\'t be imported all in once','uncode-core'); ?></h4><p><?php printf(esc_html__('Please refer to this %s for a possible workaround.','uncode-core'), '<a href="' . esc_url('support.undsgn.com/hc/en-us/articles/213459629') . '" target="_blank">'.esc_html__('troubleshoot thread','uncode-core').'</a>'); ?></p></div></div>';
									show_import_result(result, true);
								}
							} else {
								show_import_result(result, false);
								$('.uncode-wrap .log-link').on('click', function() {
									$('#import-log').show();
								});
								//save CSS with custom options
								var css_data = { action: 'css_compile_ajax' };
								$.post(ajaxurl, css_data);
							}
						},
						error: function (xhr, ajaxOptions, thrownError) {
							thrownError = '<div class="uncode-import-response"><div class="uncode-import-response-content"><div class="uncode-svg-error"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40px" height="40px" viewBox="-263.5 236.5 26 26"><g class="svg-error"><circle cx="-250.5" cy="249.5" r="12"/><path d="M-254.51,253.391l8.02-7.801"/><path d="M-246.6,253.5l-7.801-8.02"/></g></svg></div><h4><?php echo esc_html__('Ooops, the Demo Content couldn\'t be imported all in once','uncode-core'); ?></h4><p><?php printf(esc_html__('Please refer to this %s for a possible workaround.','uncode-core'), '<a href="' . esc_url('support.undsgn.com/hc/en-us/articles/213459629') . '" target="_blank">'.esc_html__('troubleshoot thread','uncode-core').'</a>'); ?></p></div></div>';
							if (runned < 10) {
								runned++;
								uncode_import_demo(this_data);
							} else {
								var result = '<b>' + thrownError + '</b>';
								show_import_result(result, true);
							}
						}
					});
				}
			});
		</script>
		<?php
	}

	/**
	 * add_widget_to_sidebar Import sidebars
	 * @param  string $sidebar_slug    Sidebar slug to add widget
	 * @param  string $widget_slug     Widget slug
	 * @param  string $count_mod       position in sidebar
	 * @param  array  $widget_settings widget settings
	 *
	 * @since 2.2.0
	 *
	 * @return null
	 */
	public function add_widget_to_sidebar($sidebar_slug, $widget_slug, $count_mod, $widget_settings = array()){

		$sidebars_widgets = get_option('sidebars_widgets');

		if(!isset($sidebars_widgets[$sidebar_slug]))
		   $sidebars_widgets[$sidebar_slug] = array('_multiwidget' => 1);

		$newWidget = get_option('widget_'.$widget_slug);

		if(!is_array($newWidget))
			$newWidget = array();

		$count = count($newWidget)+1+$count_mod;
		$sidebars_widgets[$sidebar_slug][] = $widget_slug.'-'.$count;

		$newWidget[$count] = $widget_settings;

		update_option('sidebars_widgets', $sidebars_widgets);
		update_option('widget_'.$widget_slug, $newWidget);

	}

	public function set_demo_data( $file, $ids = '', $from_theme_options = false ) {

		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

		require_once ABSPATH . 'wp-admin/includes/import.php';

		// Remove uncode gallery action hook to avoid duplicates
		remove_action( 'save_post_uncode_gallery', 'uncode_save_gallery_media', 10, 3 );

		$importer_error = false;

		if ( ! uncode_core_is_registered() ) {
			wp_die(
				esc_html__( 'Please register your copy of Uncode Theme to import premium contents.', 'uncode-core' )
			);
		}

		if ( !class_exists( 'WP_Importer' ) ) {

			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

			if ( file_exists( $class_wp_importer ) ){

				require_once($class_wp_importer);

			} else {

				$importer_error = true;

			}

		}

		if ( !class_exists( 'WP_Import' ) ) {

			$class_wp_import = dirname( __FILE__ ) .'/wordpress-importer.php';

			if ( file_exists( $class_wp_import ) )
				require_once($class_wp_import);
			else
				$importer_error = true;

		}

		if ( $importer_error ) {

			die( "Error on import" );

		} else {

			global $wp_filesystem;
			if (empty($wp_filesystem)) {
			  require_once (ABSPATH . '/wp-admin/includes/file.php');
			}
			$creds = request_filesystem_credentials($file, '', false, false);
			WP_Filesystem($creds);
			$response = $wp_filesystem->get_contents($file);
			if($response){

				$wp_import = new WP_Import();
				$wp_import->import_menu = $this->import_menu;
				$wp_import->fetch_attachments = true;
				$wp_import->import( $file, $ids, $from_theme_options );

				$this->after_xml_demo_import();

				return true;

			} else {

				echo "The XML file containing the dummy content is not available or could not be read .. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the WordPress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually ";

				return false;

			}

			// Re-hook uncode gallery action
			add_action( 'save_post_uncode_gallery', 'uncode_save_gallery_media', 10, 3 );

		}

		// Re-hook uncode gallery action
		add_action( 'save_post_uncode_gallery', 'uncode_save_gallery_media', 10, 3 );

		return true;

	}

	public function set_demo_menus() {
		// Menus to Import and assign - you can remove or add as many as you want
		$top_menu    = get_term_by('name', 'Menu - Secondary', 'nav_menu');
		$main_menu   = get_term_by('name', 'Menu - Demo', 'nav_menu');

		set_theme_mod( 'nav_menu_locations', array(
				'secondary' => $top_menu->term_id,
				'primary' => $main_menu->term_id,
			)
		);

		$this->flag_as_imported['menus'] = true;
	}

	public function delete_demo_media() {
		if ( ! uncode_core_is_registered() ) {
			return;
		}

		global $wpdb;
		$s_string = $wpdb->esc_like( 'demo media' );
		$s_string = '%' . $s_string . '%';
		$sql = "SELECT ID FROM $wpdb->posts WHERE post_title LIKE %s";
		$sql = $wpdb->prepare( $sql, $s_string );
		$matching_ids = $wpdb->get_results( $sql,OBJECT );
		foreach ($matching_ids as $key => $value) {
			wp_delete_attachment($value->ID, true);
		}
	}

	public function set_demo_theme_options( $file, $with_content_blocks = false ) {
		if ( ! uncode_core_is_registered() ) {
			wp_die(
				esc_html__( 'Please register your copy of Uncode Theme to import premium contents.', 'uncode-core' )
			);
		}

		global $wp_filesystem;
		if (empty($wp_filesystem)) {
		  require_once (ABSPATH . '/wp-admin/includes/file.php');
		}
		$creds = request_filesystem_credentials($file, '', false, false);
		WP_Filesystem($creds);
		/* Will result in $api_response being an array of data,
		parsed from the JSON response of the API listed above */
		$data = $wp_filesystem->get_contents($file);

		// Have valid data?
		// If no data or could not decode
		if ( empty( $data ) ) {
			wp_die(
				esc_html__( 'Theme options import data could not be read. Please try a different file.', 'uncode-core' ),
				'',
				array( 'back_link' => true )
			);
		}

		/* textarea value */
		$options = unserialize( base64_decode( $data ) );

		/* get settings array */
		$settings = ot_settings_value();

		/* has options */
		if ( is_array( $options ) ) {

			/* validate options */
			if ( is_array( $settings ) ) {

				foreach( $settings['settings'] as $setting ) {

					if ( isset( $options[$setting['id']] ) ) {

						$content = ot_stripslashes( $options[$setting['id']] );

						$options[$setting['id']] = ot_validate_setting( $content, $setting['type'], $setting['id'] );

					}

				}

			}

			/* update the option tree array */
			update_option( ot_options_id(), $options );

			// import content blocks if needed
			if ( $with_content_blocks ) {
				$this->import_theme_options_content_blocks( $options );
			}

			/* execute the action hook and pass the theme options to it */
			do_action( 'ot_after_theme_options_save', $options );

		}

		// Update font stack
		update_option( 'uncode_font_options', $this->font_stack );

	}

	/**
	 * Import the content blocks required by the theme options
	 */
	function import_theme_options_content_blocks( $options ) {
		$content_block_ids = array();

		$content_block_options = array(
			'_uncode_footer_block',
			'_uncode_post_blocks',
			'_uncode_post_content_block',
			'_uncode_post_content_block_after_pre',
			'_uncode_post_content_block_after',
			'_uncode_post_footer_block',
			'_uncode_page_blocks',
			'_uncode_page_content_block',
			'_uncode_page_content_block_after',
			'_uncode_page_footer_block',
			'_uncode_portfolio_blocks',
			'_uncode_portfolio_content_block',
			'_uncode_portfolio_content_block_after',
			'_uncode_portfolio_footer_block',
			'_uncode_404_blocks',
			'_uncode_404_content_block',
			'_uncode_404_footer_block',
			'_uncode_product_blocks',
			'_uncode_product_content_block',
			'_uncode_product_content_block_after',
			'_uncode_product_footer_block',
			'_uncode_post_index_blocks',
			'_uncode_post_index_content_block',
			'_uncode_post_index_footer_block',
			'_uncode_page_index_blocks',
			'_uncode_page_index_content_block',
			'_uncode_page_index_footer_block',
			'_uncode_portfolio_index_blocks',
			'_uncode_portfolio_index_content_block',
			'_uncode_portfolio_index_footer_block',
			'_uncode_author_index_blocks',
			'_uncode_author_index_content_block',
			'_uncode_author_index_footer_block',
			'_uncode_search_index_blocks',
			'_uncode_search_index_content_block',
			'_uncode_search_index_footer_block',
			'_uncode_product_index_blocks',
			'_uncode_product_index_content_block',
			'_uncode_product_index_footer_block',
			'_uncode_product_index_quick_view_type',
		);

		foreach ( $options as $option_id => $option_value ) {
			if ( intval( $option_value ) > 0 && in_array( $option_id, $content_block_options ) ) {
				$content_block_ids[] = intval( $option_value );
			}
		}

		$done = $this->set_demo_data( $this->content_demo, $content_block_ids, true );

		if ( ! $done ) {
			wp_die(
				esc_html__( 'XML file could not be read. Please try a different file.', 'uncode-core' ),
				'',
				array( 'back_link' => true )
			);
		}
	}

	/**
	 * Available widgets
	 *
	 * Gather site's widgets into array with ID base, name, etc.
	 * Used by export and import functions.
	 *
	 * @since 2.2.0
	 *
	 * @global array $wp_registered_widget_updates
	 * @return array Widget information
	 */
	function available_widgets() {

		global $wp_registered_widget_controls;

		$widget_controls = $wp_registered_widget_controls;

		$available_widgets = array();

		foreach ( $widget_controls as $widget ) {

			if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

				$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
				$available_widgets[$widget['id_base']]['name'] = $widget['name'];

			}

		}

		return apply_filters( 'radium_theme_import_widget_available_widgets', $available_widgets );

	}


	/**
	 * Process import file
	 *
	 * This parses a file and triggers importation of its widgets.
	 *
	 * @since 2.2.0
	 *
	 * @param string $file Path to .wie file uploaded
	 * @global string $widget_import_results
	 */
	function process_widget_import_file( $file ) {

		global $wp_filesystem;
		if (empty($wp_filesystem)) {
		  require_once (ABSPATH . '/wp-admin/includes/file.php');
		}
		$creds = request_filesystem_credentials($file, '', false, false);
		WP_Filesystem($creds);
		$response = $wp_filesystem->get_contents($file);
		/* Will result in $api_response being an array of data,
		parsed from the JSON response of the API listed above */
		$data = json_decode( $response, false );

		// Import the widget data
		// Make results available for display on import/export page
		$this->widget_import_results = $this->import_widgets( $data );

	}


	/**
	 * Import widget JSON data
	 *
	 * @since 2.2.0
	 * @global array $wp_registered_sidebars
	 * @param object $data JSON widget data from .wie file
	 * @return array Results array
	 */
	public function import_widgets( $data ) {
		if ( ! uncode_core_is_registered() ) {
			wp_die(
				esc_html__( 'Please register your copy of Uncode Theme to import premium contents.', 'uncode-core' )
			);
		}

		global $wp_registered_sidebars;

		$settings = ot_get_option( '_uncode_sidebars' );
		foreach ($settings as $key => $value) {
			$wp_registered_sidebars[$value['_uncode_sidebar_unique_id']] = array(
				'name' => $value['title'],
				'id' => $value['_uncode_sidebar_unique_id']
			);
		}

		// Have valid data?
		// If no data or could not decode
		if ( empty( $data ) || ! is_object( $data ) ) {
			wp_die(
				esc_html__( 'Widget import data could not be read. Please try a different file.', 'uncode-core' ),
				'',
				array( 'back_link' => true )
			);
		}

		// Hook before import
		$data = apply_filters( 'radium_theme_import_widget_data', $data );

		// Get all available widgets site supports
		$available_widgets = $this->available_widgets();

		// Get all existing widget instances
		$widget_instances = array();
		foreach ( $available_widgets as $widget_data ) {
			$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
		}

		// Begin results
		$results = array();

		// Loop import data's sidebars
		foreach ( $data as $sidebar_id => $widgets ) {

			// Skip inactive widgets
			// (should not be in export file)
			if ( 'wp_inactive_widgets' == $sidebar_id ) {
				continue;
			}

			// Check if sidebar is available on this site
			// Otherwise add widgets to inactive, and say so
			if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
				$sidebar_available = true;
				$use_sidebar_id = $sidebar_id;
				$sidebar_message_type = 'success';
				$sidebar_message = '';
			} else {
				$sidebar_available = false;
				$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
				$sidebar_message_type = 'error';
				$sidebar_message = esc_html__( 'Sidebar does not exist in theme (using Inactive)', 'uncode-core' );
			}

			// Result for sidebar
			$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
			$results[$sidebar_id]['message_type'] = $sidebar_message_type;
			$results[$sidebar_id]['message'] = $sidebar_message;
			$results[$sidebar_id]['widgets'] = array();

			// Loop widgets
			foreach ( $widgets as $widget_instance_id => $widget ) {

				$fail = false;

				// Get id_base (remove -# from end) and instance ID number
				$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
				$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );

				// Does site support this widget?
				if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
					$fail = true;
					$widget_message_type = 'error';
					$widget_message = esc_html__( 'Site does not support widget', 'uncode-core' ); // explain why widget not imported
				}

				// Filter to modify settings before import
				// Do before identical check because changes may make it identical to end result (such as URL replacements)
				$widget = apply_filters( 'radium_theme_import_widget_settings', $widget );

				// Does widget with identical settings already exist in same sidebar?
				if ( ! $fail && isset( $widget_instances[$id_base] ) ) {

					// Get existing widgets in this sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' );
					$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

					// Loop widgets with ID base
					$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
					foreach ( $single_widget_instances as $check_id => $check_widget ) {

						// Is widget in same sidebar and has identical settings?
						if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {

							$fail = true;
							$widget_message_type = 'warning';
							$widget_message = esc_html__( 'Widget already exists', 'uncode-core' ); // explain why widget not imported

							break;

						}

					}

				}

				// No failure
				if ( ! $fail ) {

					// Add widget instance
					$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
					$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
					$single_widget_instances[] = (array) $widget; // add it

						// Get the key it was given
						end( $single_widget_instances );
						$new_instance_id_number = key( $single_widget_instances );

						// If key is 0, make it 1
						// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
						if ( '0' === strval( $new_instance_id_number ) ) {
							$new_instance_id_number = 1;
							$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
							unset( $single_widget_instances[0] );
						}

						// Move _multiwidget to end of array for uniformity
						if ( isset( $single_widget_instances['_multiwidget'] ) ) {
							$multiwidget = $single_widget_instances['_multiwidget'];
							unset( $single_widget_instances['_multiwidget'] );
							$single_widget_instances['_multiwidget'] = $multiwidget;
						}

						// Update option with new widget
						update_option( 'widget_' . $id_base, $single_widget_instances );

					// Assign widget instance to sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
					$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
					$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
					update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data

					// Success message
					if ( $sidebar_available ) {
						$widget_message_type = 'success';
						$widget_message = esc_html__( 'Imported', 'uncode-core' );
					} else {
						$widget_message_type = 'warning';
						$widget_message = esc_html__( 'Imported to Inactive', 'uncode-core' );
					}

				}

				// Result for widget instance
				$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
				$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = ! empty( $widget->title ) ? $widget->title : esc_html__( 'No Title', 'uncode-core' ); // show "No Title" if widget instance is untitled
				$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
				$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;

			}

		}

		// Hook after import
		do_action( 'radium_theme_import_widget_after_import' );

		// Return results
		return apply_filters( 'radium_theme_import_widget_results', $results );

	}

	/**
	 * We only want to regenerate the two small crops
	 */
	public function adjust_intermediate_image_sizes() {
		return array( 'uncode_woocommerce_nav_thumbnail_regular', 'uncode_woocommerce_nav_thumbnail_crop' );
	}

	/**
	 * Generate small crops for product placeholders
	 */
	public function regenerate_thumbnails() {
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		global $wpdb;

		$images = $wpdb->get_results( "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_mime_type = 'image/jpeg' AND guid LIKE '%product-placeholder%'" );

		if ( is_array( $images ) ) {
			add_filter( 'intermediate_image_sizes', array( $this, 'adjust_intermediate_image_sizes' ) );

			foreach ( $images as $image ) {
				$image_path = wp_get_original_image_path( $image->ID );

				if ( $image_path && @file_exists( $image_path ) ) {
					wp_generate_attachment_metadata( $image->ID, $image_path );
				}
			}

			remove_filter( 'intermediate_image_sizes', array( $this, 'uncode_import_adjust_intermediate_image_sizes' ) );
		}
	}

	/**
	 * Run custom actions after succesful import
	 */
	public function after_xml_demo_import() {
		global $wpdb;

		// Ensure that the three SVG icons have the correct width/height. For some reason in
		// some servers the metadata is not saved during the import.
		// And yes, this is really an ugly workaround!
		update_post_meta( 44569, '_wp_attachment_metadata', array( 'width' => '50', 'height' => '50' ) );

		// Ensure correct count of page categories
		$wpdb->query(
			"UPDATE $wpdb->term_taxonomy tt
			SET count = (
				SELECT count(p.ID)
				FROM $wpdb->term_relationships tr
				LEFT JOIN $wpdb->posts p ON p.ID = tr.object_id
				WHERE tr.term_taxonomy_id = tt.term_taxonomy_id
			);
		");

		// Set thumb id in categories/tags
		$tags = get_terms( array(
			'taxonomy' => 'post_tag',
			'hide_empty' => false,
		) );
		foreach ($tags as $tag ) {
			if ( isset( $tag->description ) && strpos( $tag->description, 'page with a thumbnail' ) !== false ) {
				update_option( '_uncode_taxonomy_' . $tag->term_id, array( 'term_media' => 2286, 'term_color' => '' ), false );
			}
		}
		$cats = get_terms( array(
			'taxonomy' => 'category',
			'hide_empty' => false,
		) );
		foreach ($cats as $cat ) {
			if ( isset( $cat->description ) && strpos( $cat->description, 'page with a thumbnail' ) !== false ) {
				update_option( '_uncode_taxonomy_' . $cat->term_id, array( 'term_media' => 2286, 'term_color' => '' ), false );;
			}
		}

		// Set thumb id in product cats
		$product_cats = get_terms( array(
			'taxonomy' => 'product_cat',
			'hide_empty' => false,
		) );
		foreach ($product_cats as $product_cat ) {
			if ( isset( $product_cat->description ) && strpos( $product_cat->description, 'Dynamic description for' ) !== false ) {
				update_term_meta( $product_cat->term_id, 'thumbnail_id', 18912 );
			}
		}

		// Set logo in brand product attribute
		$brands = get_terms( array(
			'taxonomy' => 'pa_brand',
			'hide_empty' => false,
		) );

		if ( ! empty( $brands ) && ! is_wp_error( $brands ) ) {
			foreach ( $brands as $key => $brand ) {
				update_term_meta( $brand->term_id, 'uncode_pa_thumbnail_id', 17917 );
			}
		}

		// Set color in color product attribute
		$colors = get_terms( array(
			'taxonomy' => 'pa_color',
			'hide_empty' => false,
		) );

		if ( ! empty( $colors ) && ! is_wp_error( $colors ) ) {
			foreach ( $colors as $key => $color ) {
				switch ( $color->slug ) {
					case 'black':
						update_term_meta( $color->term_id, 'uncode_pa_color', '#000000' );
						break;

					case 'white':
						update_term_meta( $color->term_id, 'uncode_pa_color', '#ffffff' );
						break;

					case 'orange':
						update_term_meta( $color->term_id, 'uncode_pa_color', '#e58b14' );
						break;

					case 'blue':
						update_term_meta( $color->term_id, 'uncode_pa_color', '#1e73be' );
						break;

					case 'green':
						update_term_meta( $color->term_id, 'uncode_pa_color', '#89b750' );
						break;

					case 'grey':
						update_term_meta( $color->term_id, 'uncode_pa_color', '#969696' );
						break;

					case 'yellow':
						update_term_meta( $color->term_id, 'uncode_pa_color', '#f8d557' );
						break;

					case 'pink':
						update_term_meta( $color->term_id, 'uncode_pa_color', '#e98198' );
						break;

					case 'red':
						update_term_meta( $color->term_id, 'uncode_pa_color', '#dd3333' );
						break;

				}
			}
		}

		if ( function_exists( 'wc_attribute_taxonomy_id_by_name' ) ) {
			// Update product attribute type
			$brand_id = wc_attribute_taxonomy_id_by_name( 'pa_brand' );
			wc_update_attribute( $brand_id, array( 'type' => 'image' ) );

			$color_id = wc_attribute_taxonomy_id_by_name( 'pa_color' );
			wc_update_attribute( $color_id, array( 'type' => 'color' ) );

			$size_id = wc_attribute_taxonomy_id_by_name( 'pa_size' );
			wc_update_attribute( $size_id, array( 'type' => 'label' ) );

			$size_shoes_id = wc_attribute_taxonomy_id_by_name( 'pa_size-shoes' );
			wc_update_attribute( $size_shoes_id, array( 'type' => 'label' ) );
		}

		$this->regenerate_thumbnails();
	}
}
