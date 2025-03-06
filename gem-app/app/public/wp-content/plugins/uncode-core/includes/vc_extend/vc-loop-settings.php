<?php
/**
 * An extended version of VcLoopSettings
 * that adds some special options
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once vc_path_dir('PARAMS_DIR', 'loop/loop.php');

/**
 *	Add new options in post module query builder
 */
function uncode_core_add_loop_settings() {
	ob_start();
	?>

	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
	<# if(vc.loop_field_not_hidden('product_type', loop)) { #>
		<div class="vc_row vc_row--product_type">
			<div class="vc_col-sm-12">
				<label class="wpb_element_label"><span><?php esc_html_e('Product Attribute (Products)', 'uncode-core') ?><span class="toggle-description"></span><small class="description clear"><?php esc_html_e('Filter by special product attributes.', 'uncode-core'); ?></small></span></label>
				<div class="edit_form_line">
					{{{ vc.loop_partial('dropdown', 'product_type', loop) }}}
				</div>
			</div>
		</div>
	<# } #>
	<?php endif; ?>

	<# if(vc.loop_field_not_hidden('taxonomy_query', loop)) { #>
		<div class="vc_row vc_row--taxonomy_query">
			<div class="vc_col-sm-12">
				<label class="wpb_element_label"><span><?php esc_html_e('Taxonomy Query', 'uncode-core') ?><span class="toggle-description"></span><small class="description clear"><?php esc_html_e('Use taxonomies instead of posts.', 'uncode-core'); ?></small></span></label>
				<div class="edit_form_line">
					{{{ vc.loop_partial('dropdown', 'taxonomy_query', loop) }}}
				</div>
			</div>
		</div>
	<# } #>

	<# if(vc.loop_field_not_hidden('taxonomy_count', loop)) { #>
		<div class="vc_row vc_row--taxonomy_count vc_row--taxonomy-field">
			<div class="vc_col-sm-12">
				<label class="wpb_element_label"><span><?php esc_html_e('Count', 'uncode-core') ?><span class="toggle-description"></span><small class="description clear"><?php esc_html_e('Set the number of elements or use "All".', 'uncode-core'); ?></small></span></label>
				<div class="edit_form_line">
					{{{ vc.loop_partial('text-input', 'taxonomy_count', loop) }}}
				</div>
			</div>
		</div>
	<# } #>

	<# if(vc.loop_field_not_hidden('taxonomy_order', loop)) { #>
		<div class="vc_row vc_row--taxonomy_order vc_row--taxonomy-field">
			<div class="vc_col-sm-12">
				<label class="wpb_element_label"><span><?php esc_html_e('Order By', 'uncode-core') ?><span class="toggle-description"></span><small class="description clear"><?php esc_html_e('Select how to sort retrieved terms.', 'uncode-core'); ?></small></span></label>
				<div class="edit_form_line">
					{{{ vc.loop_partial('dropdown', 'taxonomy_order', loop) }}}
				</div>
			</div>
		</div>
	<# } #>

	<# if(vc.loop_field_not_hidden('taxonomy_sort', loop)) { #>
		<div class="vc_row vc_row--taxonomy_sort vc_row--taxonomy-field">
			<div class="vc_col-sm-12">
				<label class="wpb_element_label"><span><?php esc_html_e('Sort Order', 'uncode-core') ?><span class="toggle-description"></span><small class="description clear"><?php esc_html_e('Designates the ascending or descending order.', 'uncode-core'); ?></small></span></label>
				<div class="edit_form_line">
					{{{ vc.loop_partial('dropdown', 'taxonomy_sort', loop) }}}
				</div>
			</div>
		</div>
	<# } #>

	<# if(vc.loop_field_not_hidden('taxonomy_include_ids', loop)) { #>
		<div class="vc_row vc_row--taxonomy_include_ids vc_row--taxonomy-field">
			<div class="vc_col-sm-12">
				<label class="wpb_element_label"><span><?php esc_html_e('Term IDs', 'uncode-core') ?><span class="toggle-description"></span><small class="description clear"><?php esc_html_e('Filter output by custom terms, enter comma separated term IDs here.', 'uncode-core'); ?></small></span></label>
				<div class="edit_form_line">
					{{{ vc.loop_partial('text-input', 'taxonomy_include_ids', loop) }}}
				</div>
			</div>
		</div>
	<# } #>

	<# if(vc.loop_field_not_hidden('taxonomy_show_empty', loop)) { #>
		<div class="vc_row vc_row--taxonomy_show_empty vc_row--taxonomy-field">
			<div class="vc_col-sm-12">
				<label class="wpb_element_label"><span><?php esc_html_e('Show Empty', 'uncode-core') ?><span class="toggle-description"></span><small class="description clear"><?php esc_html_e('Show empty terms.', 'uncode-core'); ?></small></span></label>
				<div class="edit_form_line">
					{{{ vc.loop_partial('dropdown', 'taxonomy_show_empty', loop) }}}
				</div>
			</div>
		</div>
	<# } #>

	<# if(vc.loop_field_not_hidden('taxonomy_hierarchical', loop)) { #>
		<div class="vc_row vc_row--taxonomy_shierarchical vc_row--taxonomy-field">
			<div class="vc_col-sm-12">
				<label class="wpb_element_label"><span><?php esc_html_e('Hierarchical', 'uncode-core') ?><span class="toggle-description"></span><small class="description clear"><?php esc_html_e('Limit results to parent terms only.', 'uncode-core'); ?></small></span></label>
				<div class="edit_form_line">
					{{{ vc.loop_partial('dropdown', 'taxonomy_hierarchical', loop) }}}
				</div>
			</div>
		</div>
	<# } #>

	<?php
	$html = ob_get_clean();

	echo $html;
}
add_action( 'uncode_vc_loop_settings', 'uncode_core_add_loop_settings' );

/**
 * Override vc_loop_form_field function. This is basically
 * a copy of the original function that instantiates an
 * extended version of the VcLoopSettings class. We need it
 * to pass our custom options to the loop param (UncodeVcLoopSettings)
 */
function uncode_override_vc_loop_form_field( $settings, $value ) {
	$query_builder = new UncodeVcLoopSettings( $value );
	$params = $query_builder->getContent();
	$loop_info = '';
	$parsed_value = array();
	if ( is_array( $params ) ) {
		foreach ( $params as $key => $param ) {
			$param_value_render = vc_loop_get_value( $param );
			if ( ! empty( $param_value_render ) ) {
				$parsed_value[] = $key . ':' . ( is_array( $param['value'] ) ? implode( ',', $param['value'] ) : $param['value'] );

				if ( isset( $params['taxonomy_query'] ) && isset( $params['taxonomy_query']['value'] ) && $params['taxonomy_query']['value'] ) {
					if ( strpos( $key, 'taxonomy_') === 0 ) {
						$loop_info .= ' <b>' . $query_builder->getLabel( $key ) . '</b>: ' . $param_value_render . ';';
					}
				} else {
					if ( ! ( strpos( $key, 'taxonomy_') === 0 ) ) {
						$loop_info .= ' <b>' . $query_builder->getLabel( $key ) . '</b>: ' . $param_value_render . ';';
					}
				}
			}
		}
	}
	if ( ! isset( $settings['settings'] ) ) {
		$settings['settings'] = array();
	}

	return '<div class="vc_loop">' . '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value  ' . esc_attr( $settings['param_name'] . ' ' . $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( join( '|', $parsed_value ) ) . '"/>' . '<a href="javascript:;" class="button vc_loop-build ' . esc_attr( $settings['param_name'] ) . '_button" data-settings="' . rawurlencode( wp_json_encode( $settings['settings'] ) ) . '">' . esc_html__( 'Build query', 'js_composer' ) . '</a>' . '<div class="vc_loop-info">' . $loop_info . '</div>' . '</div>';
}

/**
 * Override vc_get_loop_settings_json function. This is basically
 * a copy of the original function that instantiates an
 * extend version of the VcLoopSettings class. We need it
 * to pass our custom options to the loop param (UncodeVcLoopSettings)
 */
function uncode_vc_get_loop_settings_json() {
	vc_user_access()->checkAdminNonce()->validateDie()->wpAny( 'edit_posts', 'edit_pages' )->validateDie();

	$loop_settings = new UncodeVcLoopSettings( vc_post_param( 'value' ), vc_post_param( 'settings' ) );
	$loop_settings->render();
	die();
}
remove_action( 'wp_ajax_wpb_get_loop_settings', 'vc_get_loop_settings_json' );
add_action( 'wp_ajax_wpb_get_loop_settings', 'uncode_vc_get_loop_settings_json' );

/**
 * Class VcLoopSettings
 * @since 4.2
 */
class UncodeVcLoopSettings extends VcLoopSettings {
	protected $query_parts = array(
		'size',
		'order_by',
		'meta_key',
		'order',
		'post_type',
		'authors',
		'categories',
		'tags',
		'tax_query',
		'by_id',
		'product_type',
		'taxonomy_query',
		'taxonomy_order',
		'taxonomy_sort',
		'taxonomy_count',
		'taxonomy_show_empty',
		'taxonomy_hierarchical',
		'taxonomy_include_ids',
	);

	/**
	 * @param $value
	 *
	 * @return array
	 * @since 4.2
	 */
	public function parse_order_by( $value ) {
		return $this->parseDropDown( $value, array(
			array(
				'date',
				esc_html__( 'Date', 'uncode-core' ),
			),
			'ID',
			array(
				'author',
				esc_html__( 'Author', 'uncode-core' ),
			),
			array(
				'title',
				esc_html__( 'Title', 'uncode-core' ),
			),
			array(
				'modified',
				esc_html__( 'Modified', 'uncode-core' ),
			),
			array(
				'rand',
				esc_html__( 'Random', 'uncode-core' ),
			),
			array(
				'comment_count',
				esc_html__( 'Comment count', 'uncode-core' ),
			),
			array(
				'menu_order',
				esc_html__( 'Menu order', 'uncode-core' ),
			),
			array(
				'meta_value',
				esc_html__( 'Meta value', 'uncode-core' ),
			),
			array(
				'meta_value_num',
				esc_html__( 'Meta value (numeric)', 'uncode-core' ),
			),
			array(
				'popularity',
				esc_html__( 'Popularity (products only)', 'uncode-core' ),
			),
			array(
				'rating',
				esc_html__( 'Rating (products only)', 'uncode-core' ),
			),
			array(
				'price',
				esc_html__( 'Price (products only)', 'uncode-core' ),
			),
		) );
	}

	/**
	 * @param $value
	 *
	 * @return array
	 * @since 4.2
	 */
	public function parse_product_type( $value ) {
		return $this->parseDropDown( $value, array(
			array(
				'on_sale',
				esc_html__( 'On-Sale Products', 'uncode-core' ),
			),
			array(
				'best_selling',
				esc_html__( 'Best Selling Products', 'uncode-core' ),
			),
			array(
				'top_rated',
				esc_html__( 'Top Rated Products', 'uncode-core' ),
			),
			array(
				'featured',
				esc_html__( 'Featured Products', 'uncode-core' ),
			),
			array(
				'cross_sells',
				esc_html__( 'Cross-Sells', 'uncode-core' ),
			),
		) );
	}

	/**
	 * @param $value
	 *
	 * @return array
	 * @since 4.2
	 */
	public function parse_taxonomy_query( $value ) {
		return $this->parseDropDown( $value, uncode_get_taxonomies_for_posts_module() );
	}

	/**
	 * @param $value
	 *
	 * @return array
	 * @since 4.2
	 */
	public function parse_taxonomy_order( $value ) {
		$values = array(
			array(
				'name',
				esc_html__( 'Name', 'uncode-core' ),
			),
			array(
				'id',
				esc_html__( 'ID', 'uncode-core' ),
			),
			array(
				'slug',
				esc_html__( 'Slug', 'uncode-core' ),
			),
			array(
				'count',
				esc_html__( 'Count', 'uncode-core' ),
			)
		);

		if ( defined( 'TOPATH' ) || class_exists( 'WooCommerce' ) ) {
			// Category Order and Taxonomy Terms Order
			$terms_order_label = defined( 'TOPATH' ) ? esc_html__( 'Terms Order', 'uncode-core' ) : esc_html__( 'Terms Order (Product Categories only)', 'uncode-core' );

			$values[] = array(
				'term_order',
				$terms_order_label,
			);
		}

		return $this->parseDropDown( $value, $values );
	}

	/**
	 * @param $value
	 *
	 * @return array
	 * @since 4.2
	 */
	public function parse_taxonomy_sort( $value ) {
		return $this->parseDropDown( $value, array(
			array(
				'ASC',
				esc_html__( 'Ascending', 'uncode-core' ),
			),
			array(
				'DESC',
				esc_html__( 'Descending', 'uncode-core' ),
			),
		) );
	}

	/**
	 * @param $value
	 *
	 * @return array
	 * @since 4.2
	 */
	public function parse_taxonomy_count( $value ) {
		$value = $value === 'All' ? 'All' : absint( $value );
		$value = $value === 0 ? 10 : $value;
		return $this->parseString( $value );
	}

	/**
	 * @param $value
	 *
	 * @return array
	 * @since 4.2
	 */
	public function parse_taxonomy_show_empty( $value ) {
		return $this->parseDropDown( $value, array(
			array(
				'yes',
				esc_html__( 'Yes', 'uncode-core' ),
			),
		) );
	}

	/**
	 * @param $value
	 *
	 * @return array
	 * @since 4.2
	 */
	public function parse_taxonomy_hierarchical( $value ) {
		return $this->parseDropDown( $value, array(
			array(
				'parents',
				esc_html__( 'Parents Only', 'uncode-core' ),
			),
		) );
	}

	/**
	 * @param $value
	 *
	 * @return array
	 * @since 4.2
	 */
	public function parse_taxonomy_include_ids( $value ) {
		$value_sanitized = '';
		$ids = explode( ',', trim( $value ) );

		if ( is_array( $ids ) ) {
			$temp_ids = array();

			// Validate IDs
			foreach ( $ids as $id ) {
				$id = absint( $id );

				if ( $id > 0 ) {
					$temp_ids[] = $id;
				}
			}

			$value_sanitized = implode( ',', $temp_ids );
		}

		return $this->parseString( $value_sanitized );
	}

	/**
	 * @param $key
	 *
	 * @return mixed
	 * @since 4.2
	 */
	public function getLabel( $key ) {
		$parts = array(
			'size'                  => esc_html__( 'Post Count', 'uncode-core' ),
			'order_by'              => esc_html__( 'Order By', 'uncode-core' ),
			'order'                 => esc_html__( 'Sort Order', 'uncode-core' ),
			'post_type'             => esc_html__( 'Post types', 'uncode-core' ),
			'authors'               => esc_html__( 'Author', 'uncode-core' ),
			'categories'            => esc_html__( 'Categories', 'uncode-core' ),
			'tags'                  => esc_html__( 'Tags', 'uncode-core' ),
			'tax_query'             => esc_html__( 'Taxonomies', 'uncode-core' ),
			'by_id'                 => esc_html__( 'Individual Posts/Pages', 'uncode-core' ),
			'product_type'          => esc_html__( 'Product Attribute', 'uncode-core' ),
			'taxonomy_query'        => esc_html__( 'Taxonomy Query', 'uncode-core' ),
			'taxonomy_order'        => esc_html__( 'Order By', 'uncode-core' ),
			'taxonomy_sort'         => esc_html__( 'Sort Order', 'uncode-core' ),
			'taxonomy_count'        => esc_html__( 'Count', 'uncode-core' ),
			'taxonomy_show_empty'   => esc_html__( 'Show Empty', 'uncode-core' ),
			'taxonomy_hierarchical' => esc_html__( 'Hierarchical', 'uncode-core' ),
			'taxonomy_include_ids'  => esc_html__( 'Term IDs', 'uncode-core' ),
			'meta_key'  => esc_html__( 'Meta Key', 'uncode-core' ),
		);

		return isset( $parts[ $key ] ) ? $parts[ $key ] : $key;
	}
}
