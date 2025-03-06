<?php
/**
 * VC related filters
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Replace default css class for vc_row shortcode and vc_column
 */
function uncode_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
	if ($tag == 'vc_row' || $tag == 'vc_row_inner')
	{
		$class_string = str_replace('vc_row-fluid', 'row', $class_string);
	}
	if ($tag == 'vc_column' || $tag == 'vc_column_inner')
	{
		$class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'col-lg-$1', $class_string);
	}
	return $class_string;
}
add_filter('vc_shortcodes_css_class', 'uncode_custom_css_classes_for_vc_row_and_vc_column', 10, 2);

/**
 * Custom icon picker in vc_icon
 */
function uncode_vc_iconpicker_type_uncode( $icons ) {
	$uncode_icons = array();
	$uncode_icons[] = array( '' =>  '');

	global $wp_filesystem;
	if (empty($wp_filesystem)) {
		require_once (ABSPATH . '/wp-admin/includes/file.php');
		WP_Filesystem();
	}
	$file      = UNCODE_ICONS_PATH ? get_template_directory() . '/core/assets/icons/selection.json' : '';
	$response  = $wp_filesystem->get_contents($file);

	if ( ! $response ) {
		return $icons;
	}

	/* Will result in $api_response being an array of data,
	parsed from the JSON response of the API listed above */
	$icons_file = json_decode( $response, true );

	foreach ($icons_file['icons'] as $key => $value) {
		$names = explode(',', $value['properties']['name']);
		$uncode_icons[] = array( 'fa fa-' . $names[0] =>  ucwords(implode(', ', $value['icon']['tags'])));
	}

	return array_merge( $icons, $uncode_icons );
}
add_filter( 'vc_iconpicker-type-uncode', 'uncode_vc_iconpicker_type_uncode' );

/**
 * Hide custom CSS from Content Block.
 * @since Uncode 2.0.0
 */
if ( ! function_exists( 'uncode_vc_nav_controls' ) ) :
	function uncode_vc_nav_controls( $controls ) {
		$post_type = uncode_get_current_post_type();

		if ( $post_type !== 'uncodeblock' ) {
			return $controls;
		} else {
			$new_controls = array();
			foreach ($controls as $key => $control) {
				if ( $control[0] !== 'custom_css' ) {
					$new_controls[] = $control;
				}
			}
			return $new_controls;
		}
	}
endif; //uncode_vc_nav_controls
add_filter( 'vc_nav_controls', 'uncode_vc_nav_controls' );

/**
 * Move vc_element class to the container (we want it as the first div).
 */
function uncode_frontend_editor_content_filter( $content ) {
    $content = preg_replace_callback('/<div class="vc_element"(.*?)><(.*?) class="(.*?)"/', function( $matches ) {
    	if ( substr( $matches[3], 0, 17 ) !== "uncode-accordion " && substr( $matches[2], 0, 8 ) !== "section " ) {
	    	return '<' . $matches[2] . ' class="vc_element ' . $matches[3] . '"' . $matches[1];
    	} else {
    		return '<div class="vc_element"' . $matches[1] . '><' . $matches[2] . ' class="' . $matches[3] . '"';
    	}
    }, $content);

    $content = preg_replace('/<p[^>]*>(.*?)data-mce-type="bookmark"(.*?)<\/p>/', '', $content);

    return $content;
}
add_filter( 'the_content', 'uncode_frontend_editor_content_filter', 100 );
add_filter( 'vc_front_render_shortcodes', 'uncode_frontend_editor_content_filter' );
add_filter( 'vc_frontend_template_the_content', 'uncode_frontend_editor_content_filter', 100 );

/**
 * Set the default Frontend Editor layout.
 */
function uncode_vc_post_custom_layout_name( $layout ) {

    $layout = apply_filters( 'uncode_vc_post_custom_layout_name', 'default' );

    return $layout;
}

add_filter( 'vc_post_custom_layout_name', 'uncode_vc_post_custom_layout_name', 100 );

function uncode_js_composer_toString_tags_array( $tags ) {

		$tags_array = array( 'vc_accordion', 'vc_raw_html', 'vc_raw_js', 'vc_flickr', 'vc_section', 'contact-form-7', 'uncode_twentytwenty', 'vc_gutenberg', 'product', 'add_to_cart', 'add_to_cart_url', 'product_page', 'rev_slider', 'uncode_do_action', 'vc_widget_sidebar', 'uncode_portfolio_details', 'uncode_woocommerce_widget_layered_nav_filters', 'uncode_woocommerce_wishlist', 'uncode_ajax_filter', 'uncode_ajax_active_filters', 'uncode_woocommerce_attribute_image' );
		$tags = array_merge($tags, $tags_array);
		return $tags;

}
add_filter( 'uncode_js_composer_toString_tags_array', 'uncode_js_composer_toString_tags_array' );

function uncode_js_composer_renderShortcodes_tags_array( $tags ) {

		$tags_array = array( 'vc_accordion', 'vc_raw_html', 'vc_raw_js', 'vc_flickr', 'vc_section', 'contact-form-7', 'uncode_twentytwenty', 'vc_gutenberg', 'product', 'add_to_cart', 'add_to_cart_url', 'product_page', 'rev_slider', 'uncode_do_action', 'vc_widget_sidebar', 'uncode_portfolio_details', 'uncode_woocommerce_widget_layered_nav_filters', 'uncode_woocommerce_wishlist', 'uncode_ajax_filter', 'uncode_ajax_active_filters', 'uncode_woocommerce_attribute_image' );
		$tags = array_merge($tags, $tags_array);
		return $tags;

}
add_filter( 'uncode_js_composer_renderShortcodes_tags_array', 'uncode_js_composer_renderShortcodes_tags_array' );

/**
 * Remove p tags before/after VC content.
 */
function uncode_p_tag_issue_filter( $content, $post_id ) {
	$content = preg_replace('/<p[^>]*>\[vc_row(.*?)\/vc_row]<\/p>/', '[vc_row$1/vc_row]', $content);
	return $content;
}
add_filter( 'content_edit_pre', 'uncode_p_tag_issue_filter', 10, 2 );

/**
 * Filter VC strings via gettext.
 */
function uncode_frontend_editor_adminbar_button( $translated_text, $text, $domain ) {
	if ( $domain === 'js_composer' ) {

		switch ( $translated_text ) {

	        case 'Edit with WPBakery Page Builder' :

	            $translated_text = esc_html__( 'Edit Frontend', 'uncode-core' );
	            break;

	        case 'Edit %s with WPBakery Page Builder' :

	        	global $post;
	        	if ( $post ) {
		            $translated_text = sprintf( esc_html__( 'Frontend Editor - %s', 'uncode-core' ), $post->post_title );
	        	} else {
		            $translated_text = esc_html__( 'Frontend Editor', 'uncode-core' );
	        	}
	            break;

	        case 'Edit %s with WPBakery Page Builder' :

	        	global $post;
	        	if ( $post ) {
		            $translated_text = sprintf( esc_html__( 'Frontend Editor - %s', 'uncode-core' ), $post->post_title );
	        	} else {
		            $translated_text = esc_html__( 'Frontend Editor', 'uncode-core' );
	        	}
	            break;

	        case 'Backend Editor' :

	        	if ( function_exists('vc_is_frontend_editor') && vc_is_frontend_editor() ) {
		            $translated_text = esc_html__( 'Backend', 'uncode-core' );
	        	}
	            break;

	        case 'Enter custom layout for your row' :
				$translated_text = esc_html__( 'Enter custom layout', 'uncode-core' );

	    }
    }

    return $translated_text;
}
add_filter( 'gettext', 'uncode_frontend_editor_adminbar_button', 20, 3 );

/**
 * Change row actions order
 */
function uncode_js_composer_row_actions( $actions ) {
	$temp_actions = array();

	if ( isset( $actions[ 'edit' ] ) ) {
		$temp_actions[ 'edit' ] = $actions[ 'edit' ];
		unset( $actions[ 'edit' ] );
	}

	if ( isset( $actions[ 'edit_vc' ] ) ) {
		$temp_actions[ 'edit_vc' ] = $actions[ 'edit_vc' ];
		unset( $actions[ 'edit_vc' ] );
	}

	$new_actions = array_merge(
		$temp_actions,
		$actions
	);

	return $new_actions;
}
add_filter( 'page_row_actions', 'uncode_js_composer_row_actions', 100 );
add_filter( 'post_row_actions', 'uncode_js_composer_row_actions', 100 );

/**
 * Particles is not allowed in the frontend editor
 */
function uncode_js_composer_frontend_not_allowed_shortcodes( $tags ) {
	$tags_array = array( 'vc_particles_background' );
	$tags = array_merge($tags, $tags_array);
	return $tags;
}
add_filter( 'uncode_js_composer_frontend_not_allowed_shortcodes', 'uncode_js_composer_frontend_not_allowed_shortcodes' );

/**
 * Add cpt edit links.
 */
function uncode_core_vc_add_edit_link_button( $output, $param, $value, $settings, $atts ) {
	if ( isset( $settings[ 'base' ] ) ) {
		if ( $settings[ 'base' ] === 'contact-form-7' ) {
			if ( isset( $param[ 'type' ] ) && $param[ 'type' ] === 'dropdown'&& isset( $param[ 'param_name' ] )  && $param[ 'param_name' ] === 'id' ) {
				$value  = absint( $value );
				$url    = $value > 0 ? admin_url( 'admin.php?page=wpcf7&post=' . $value . '&action=edit' ) : '#';
				$state  = $value > 0 ? '' : 'disabled';
				$button = '<div class="cf7-edit-link backend-edit-link"><a data-url="' . esc_attr( admin_url( 'admin.php?' ) ) . '" class="cf7-edit-button backend-edit-button ' . $state . '" href="' . esc_url( $url ) . '" target="_blank">' . esc_html__( 'Edit', 'uncode-core' ) .'</a></div>';
				$output = str_replace( '</div></div>', $button . '</div></div>', $output );
			}
		} else if ( $settings[ 'base' ] === 'uncode_block' ) {
			if ( isset( $param[ 'type' ] ) && $param[ 'type' ] === 'dropdown'&& isset( $param[ 'param_name' ] )  && $param[ 'param_name' ] === 'id' ) {
				$value  = absint( $value );
				if ( $value > 0 ) {
					$url    = get_edit_post_link( $value );
					$button = '<div class="cb-edit-link backend-edit-link"><a data-url="' . esc_attr( admin_url( 'post.php?' ) ) . '" class="cb-edit-button backend-edit-button" href="' . esc_url( $url ) . '" target="_blank">' . esc_html__( 'Edit', 'uncode-core' ) .'</a></div>';
					$output = str_replace( '</div></div>', $button . '</div></div>', $output );
				}

			}
		} else if ( $settings[ 'base' ] === 'uncode_index' ) {
			if ( isset( $param[ 'type' ] ) && $param[ 'type' ] === 'dropdown' && isset( $param[ 'param_name' ] ) && ( $param[ 'param_name' ] === 'widgetized_content_block_id' || $param[ 'param_name' ] === 'ajax_filters_content_block_id' || $param[ 'param_name' ] === 'custom_grid_content_block_id' ) ) {
				$value  = absint( $value );
				if ( $value > 0 ) {
					$url    = get_edit_post_link( $value );
					$button = '<div class="cb-edit-link backend-edit-link"><a data-url="' . esc_attr( admin_url( 'post.php?' ) ) . '" class="cb-edit-button backend-edit-button" href="' . esc_url( $url ) . '" target="_blank">' . esc_html__( 'Edit', 'uncode-core' ) .'</a></div>';
					$output = str_replace( '</div></div>', $button . '</div></div>', $output );
				}

			}
		} else if ( $settings[ 'base' ] === 'vc_gallery' ) {
			if ( isset( $param[ 'type' ] ) && $param[ 'type' ] === 'dropdown' && isset( $param[ 'param_name' ] ) && $param[ 'param_name' ] === 'custom_grid_content_block_id' ) {
				$value  = absint( $value );
				if ( $value > 0 ) {
					$url    = get_edit_post_link( $value );
					$button = '<div class="cb-edit-link backend-edit-link"><a data-url="' . esc_attr( admin_url( 'post.php?' ) ) . '" class="cb-edit-button backend-edit-button" href="' . esc_url( $url ) . '" target="_blank">' . esc_html__( 'Edit', 'uncode-core' ) .'</a></div>';
					$output = str_replace( '</div></div>', $button . '</div></div>', $output );
				}

			}
		}
	}

	return $output;
}
add_filter( 'vc_single_param_edit_holder_output', 'uncode_core_vc_add_edit_link_button', 10, 5 );

/**
 *
 * Modify default frontend editor navbar.
 */
class Uncode_Vc_Navbar_Frontend {
	public function __construct() {
		add_filter( 'vc_nav_front_controls', array(
			$this,
			'uncodeAdditionalNavBarControls',
		) );
	}

	/**
	 * @param $controls
	 * @return array
	 */
	public function uncodeAdditionalNavBarControls( $controls ) {
		$sidebar_switch = array(
			array(
				'sidebar_switch',
				'<li><a id="vc_navbar-sidebar-switch" href="javascript:;" class="vc_icon-btn" title="' . esc_attr__( 'Sidebar mode', 'uncode-core' ) . '"><i class="vc_navbar-icon fa fa-minimize"></i></a></li>',
			)
		);

		$safe_mode = array(
			array(
				'safe_mode',
				'<li><a id="vc_navbar-safe-mode" href="javascript:;" class="vc_icon-btn" title="' . esc_attr__( 'Safe mode', 'uncode-core' ) . '"><i class="vc_navbar-icon fa fa-marquee-plus"></i></a></li>'
			)
		);

		// $controls = array(
		// 	'custom_css',
		// 	'add_element',
		// 	'view_post',
		// 	'templates',
		// 	'save_update',
		// 	'screen_size',
		// 	'redo',
		// 	'undo',
		// );

		foreach ($controls as $key => $value) {
			if ( $value[0] === 'save_update' ) {
				$save_update_control = array(
					array(
						'save_update',
						$value[1]
					)
				);
				unset($controls[$key]);
			}
			if ( $value[0] === 'add_element' ) {
				$add_element_control = array(
					array(
						'add_element',
						$value[1]
					)
				);
				unset($controls[$key]);
			}
			if ( $value[0] === 'templates' ) {
				$templates_control = array(
					array(
						'templates',
						$value[1]
					)
				);
				unset($controls[$key]);
			}
			if ( $value[0] === 'view_post' ) {
				$view_post_control = array(
					array(
						'view_post',
						$value[1]
					)
				);
				unset($controls[$key]);
			}
			if ( $value[0] === 'undo' ) {
				$undo_control = array(
					array(
						'undo',
						$value[1]
					)
				);
				unset($controls[$key]);
			}
			if ( $value[0] === 'redo' ) {
				$redo_control = array(
					array(
						'redo',
						$value[1]
					)
				);
				unset($controls[$key]);
			}
			if ( $value[0] === 'custom_css' ) {
				$custom_css_control_key = $key;
				// $new_value = str_replace( ' class="vc_pull-right"', '', $value[1] );
				$custom_css = array(
					array(
						'custom_css',
						// $new_value
						$value[1]
					)
				);
				unset($controls[$key]);
			}
			if ( $value[0] === 'screen_size' ) {
				$screen_size_control_key = $key;
				// $new_value = str_replace( ' class="vc_pull-right"', '', $value[1] );
				$screen_size = array(
					array(
						'screen_size',
						// $new_value
						$value[1]
					)
				);
				unset($controls[$key]);
			}
		}

		array_splice($controls, 0, 0, $undo_control);
		array_splice($controls, 0, 0, $redo_control);
		array_splice($controls, 0, 0, $custom_css);
		array_splice($controls, 0, 0, $screen_size);
		array_splice($controls, 0, 0, $view_post_control);
		array_splice($controls, 0, 0, $save_update_control);
		array_splice($controls, 0, 0, $safe_mode);
		array_splice($controls, 0, 0, $sidebar_switch);
		array_splice($controls, 0, 0, $templates_control);
		array_splice($controls, 0, 0, $add_element_control);

		return $controls;
	}
}

function uncode_vc_navbar_frontend() {
	if ( vc_is_frontend_editor() || is_admin() ) {
		new Uncode_Vc_Navbar_Frontend();
	}
}
add_action( 'admin_init', 'uncode_vc_navbar_frontend', 1000 );

// Add custom class to the wrapper of a VC param
function uncode_core_vc_single_param_edit( $param, $value) {
	if ( isset( $param[ 'vc_single_param_edit_holder_class' ] ) && isset( $param[ 'uncode_wrapper_class' ] ) && $param[ 'uncode_wrapper_class' ] ) {
		$param[ 'vc_single_param_edit_holder_class' ][] = $param[ 'uncode_wrapper_class' ];
	}

	return $param;
}
add_filter( 'vc_single_param_edit', 'uncode_core_vc_single_param_edit', 10, 2 );

// VC Add Module Tabs Order
function uncode_add_element_categories( $tabs ) {
	$new_order = array();
	foreach ($tabs as $key => $tab) {
		if ( $tab['name'] == 'All' ) {
			$new_order[0] = $tab;
			unset($tabs[$key]);
		} elseif ( $tab['name'] == 'Essentials' ) {
			$new_order[1] = $tab;
			unset($tabs[$key]);
		} elseif ( $tab['name'] == 'Dynamic' ) {
			$new_order[2] = $tab;
			unset($tabs[$key]);
		} elseif ( $tab['name'] == 'WordPress Widgets' ) {
			$new_order[3] = $tab;
			unset($tabs[$key]);
		} elseif ( $tab['name'] == 'WordPress Widegts' ) {
			$new_order[4] = $tab;
			unset($tabs[$key]);
		} elseif ( $tab['name'] == 'WooCommerce' ) {
			$new_order[5] = $tab;
			unset($tabs[$key]);
		} elseif ( $tab['name'] == 'WooCommerce Product' ) {
			$new_order[6] = $tab;
			unset($tabs[$key]);
		} elseif ( $tab['name'] == 'WooCommerce Widgets' ) {
			$new_order[7] = $tab;
			unset($tabs[$key]);
		} elseif ( $tab['name'] == 'Extra' ) {
			$new_order[8] = $tab;
			unset($tabs[$key]);
		}
	}
	ksort($new_order);
	$tabs = array_merge($new_order, $tabs);
	return $tabs;
}
add_filter( 'vc_add_element_categories', 'uncode_add_element_categories', 1 );

/**
 * Reorder post types in build query
 */
function uncode_core_reorder_cpt_build_query( $post_types ) {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return $post_types;
	}

	$new_post_types = array();

	$product_cpt = false;

	foreach ( $post_types as $post_type ) {
		if ( $post_type === 'product' ) {
			$product_cpt = $post_type;

			continue;
		}

		$new_post_types[] = $post_type;

		if ( $product_cpt && $post_type === 'portfolio' ) {
			$new_post_types[] = $product_cpt;
		}
	}

	return $new_post_types;
}
add_filter( 'uncode_cpts_build_query_options', 'uncode_core_reorder_cpt_build_query' );

/**
 * Get enabled options in single tab in simple mode
 */
function uncode_core_enabled_simplified_single_options() {
	$enabled = array(
		'single_width',
		'images_size',
		'custom_grid_images_size',
		'single_height',
		'single_image_position',
		'single_image_size',
		'single_padding',
		'single_title_dimension',
		'heading_custom_size',
		'single_link',
		'single_css_animation',
		'single_animation_speed',
		'single_animation_delay',
		'single_parallax_intensity',
		'single_parallax_centered',
	);

	return $enabled;
}

/**
 * Check VC access.
 */
function uncode_core_vc_check_post_type_validation( $valid ) {
	if ( ! uncode_core_check_valid_purchase_code() ) {
		$valid = false;
	}

	return $valid;
}
add_filter( 'vc_check_post_type_validation', 'uncode_core_vc_check_post_type_validation' );

/**
 * Disable Frontend Editor button for PopUp Maker
 */
function uncode_core_popup_editor() {
	$post_type = uncode_get_current_post_type();

	if ( $post_type === 'popup' ) {
		vc_disable_frontend();
	}
}
add_filter( 'admin_init', 'uncode_core_popup_editor' );
