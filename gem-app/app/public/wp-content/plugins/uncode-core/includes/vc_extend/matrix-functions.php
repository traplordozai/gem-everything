<?php
/**
 * Matrix related functions (Posts Module)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Alter query hiding current post. And show only published and privated posts
 */
function uncode_hide_posts_not_published($query) {
	$query->set('post_status', array(
		'publish',
		'private'
	));

	if (isset($query->query['post__not_in'])) {
		$get_array_not_in = $query->query['post__not_in'];
		$get_array_not_in[] = $_POST['postid'];
		$query->set('post__not_in', $get_array_not_in);
	}

	return $query;
}

/**
 * Get all posts
 */
function uncode_all_posts($query) {
	$query->set( 'posts_per_page', -1 );

	return;
}

/**
 * Post module matrix query
 */
function uncode_index_get_query() {
	$post_types = array();
	if (function_exists('uncode_get_post_types')) {
		$post_types = uncode_get_post_types(true);
	}
	$loop = vc_post_param('content');
	$allItems = vc_post_param('allItems');
	$matrix_amount = vc_post_param('matrix_amount');
	$template_single = vc_post_param('templateSingle');
	$templatePostArray = array();
	foreach ($post_types as $key => $value) {
	    $templatePostArray[$value] = vc_post_param('template' . ucfirst($value));
	}
	$exclude_current = vc_post_param('postid');
	if (empty($loop)) {
		return;
	}
	require_once vc_path_dir('PARAMS_DIR', 'loop/loop.php');
	add_filter('pre_get_posts', 'uncode_hide_posts_not_published');
	if ($allItems === 'true') {
		add_filter('pre_get_posts', 'uncode_all_posts');
	}

	global $uncode_index_map;
	$u_index = new uncode_index($uncode_index_map);
	$is_tax_query = $u_index->is_tax_query( $loop );

	if ( $is_tax_query ) {
		$u_index->callGetLoop( $loop );
		$taxonomies = uncode_get_registered_taxonomies();
	}

	list($args, $my_query) = $u_index->vc_build_loop_query($loop, get_the_ID());

	add_filter( 'wp_kses_allowed_html', 'uncode_core_single_matrix_allowed_html', 10, 2);

	if ( vc_post_param( 'custom_order' ) === 'true' ) {
		if ( vc_post_param( 'order_ids' ) !== '' ) {
			$ordered   = array();
			$post_list = explode( ',', vc_post_param( 'order_ids' ) );

			if ( $is_tax_query ) {
				$terms_copy = $my_query->terms;

				foreach( $post_list as $key ) {
					foreach( $terms_copy as $skey => $spost ) {
						if ( $key == $spost->term_id ) {
							$ordered[] = $spost;
							unset($terms_copy[$skey]);
							break;
						}
					}
				}

				if ( count( $terms_copy ) > 0 ) {
					foreach( $terms_copy as $skey => $spost ) {
						$ordered[] = $spost;
					}
				}

				$my_query->terms = $ordered;
			} else {
				foreach( $post_list as $key ) {
					foreach( $my_query->posts as $skey => $spost ) {
						if ( $key == $spost->ID ) {
							$ordered[] = $spost;
							unset( $my_query->posts[$skey] );
						}
					}
				}
				$my_query->posts = array_merge( $my_query->posts, $ordered );
			}
		}
	}

	if ( floatval( $matrix_amount ) != 0 ) {
		if ( ! $is_tax_query ) {
			// ???
			$my_query->set('posts_per_page', $matrix_amount);
			$my_query->query($my_query->query_vars);
		}
	}

	$html = '';

	$list_item_class = $is_tax_query ? 'list-list-item--tax' : '';

	if ( floatval( $matrix_amount ) != 0 ) {

		$template_cat = '';
		if ( $is_tax_query ) {
			$template_cat .= vc_post_param( 'templateUncodeTaxonomy' );
		} else {
			$matrix_post_types = $my_query->get('post_type');
			foreach ($matrix_post_types as $key => $matrix_post_type) {
				$template_cat .= $templatePostArray[$matrix_post_type];
			}
		}

		for ($i = 0; $i < $matrix_amount; $i++) {

			//Create matrix loop
			$html.= '<li class="list-list-item ' . $list_item_class . '" data-id="' . esc_attr( $i ) . '">
						<div class="option-tree-setting">
							<div class="open"><span class="post-title">' . sprintf(__('Item no. %s', 'uncode-core'), '<span class="matrix-item-no">' . esc_attr($i + 1) . '</span>' ) . '</span><span class="grey size">width: <span class="single_width_factor"></span>, height: <span class="single_height_factor"></span></span></div>
							<div class="button-section">
								<a href="javascript:void(0);" class="option-tree-setting-edit option-tree-ui-button button left-item" title="Edit">
									<span class="icon fa fa-pencil3"></span>Edit
								</a>
								<a href="javascript:void(0);" class="option-tree-setting-reset option-tree-ui-button button left-item hidden" title="Reset">
									<span class="icon fa fa-reload"></span>
								</a>
							</div>
							<div class="option-tree-setting-body">' . wp_kses_post( $template_single . $template_cat ) . '</div>
						</div>
					</li>';

		}


	} else {
		$posts = array();

		if ( $is_tax_query ) {
			foreach ( $my_query->terms as $term ) {
				$post = new stdClass();
				$post->id = $term->term_id;
				$post->link = get_term_link( $term );
				$post->type = false;
				$post->title = $term->name;
				$post->template_cat = vc_post_param( 'templateUncodeTaxonomy' );
				$posts[] = $post;

				if ( isset( $taxonomies[$term->taxonomy] ) ) {
					$post->type = $taxonomies[$term->taxonomy];
				}
			}
		} else {
			while ($my_query->have_posts()) {
				$my_query->the_post();

				$post = new stdClass();
				$post->id = get_the_ID();
				$post->link = get_permalink($post->id);
				$post->type = get_post_type($post->id);
				$post->title = get_the_title();
				$post->template_cat = $templatePostArray[$post->type];
				$posts[] = $post;
			}
		}

		foreach ( $posts as $post_key => $post_object ) {
			if ( $template_single !== 'false' ) {
				$html.= '<li class="list-list-item ' . $list_item_class . '" data-id="' . esc_attr( $post_object->id ) . '">
						<div class="option-tree-setting">
							<div class="open"><span class="post-title">' . esc_html( $post_object->title ) . '</span> <span class="grey">' . ( $post_object->type ? esc_html( $post_object->type ) : '' ) . '</span><span class="grey size">width: <span class="single_width_factor"></span>, height: <span class="single_height_factor"></span></span></div>
							<div class="button-section">
								<a href="javascript:void(0);" class="option-tree-setting-edit option-tree-ui-button button left-item" title="Edit">
									<span class="icon fa fa-pencil3"></span>Edit
								</a>
								<a href="javascript:void(0);" class="option-tree-setting-reset option-tree-ui-button button left-item hidden" title="Reset">
									<span class="icon fa fa-reload"></span>
								</a>
							</div>
							<div class="option-tree-setting-body">' . wp_kses_post( $template_single . $post_object->template_cat ) . '</div>
						</div>
					</li>';
			} else {
				$html.= '<li class="list-list-item ' . $list_item_class . '" data-id="' . esc_attr( $post_object->id ) . '">
					<div class="option-tree-setting">
						<div class="open"><span class="post-title">' . esc_html( $post_object->title ) . '</span> <span class="grey">' . ( $post_object->type ? esc_html( $post_object->type ) : '' ) . '</span></div>
						<div class="option-tree-setting-body"></div>
					</div>
				</li>';
			}
		}
	}

	$html = str_replace('\"', '"', $html);
	echo do_shortcode( shortcode_unautop( $html ) );

	remove_filter( 'wp_kses_allowed_html', 'uncode_core_single_matrix_allowed_html', 10, 2);

	die();
}
add_action('wp_ajax_uncode_get_query','uncode_index_get_query');

/**
 * Post module matrix media
 */
function uncode_get_medias() {
	$loop = vc_post_param('content');
	$matrix_amount = vc_post_param('matrix_amount');
	$template_single = vc_post_param('templateSingle');
	$template_media = vc_post_param('templateMedia');

	$html = '';

	add_filter( 'wp_kses_allowed_html', 'uncode_core_single_matrix_allowed_html', 10, 2);

	if ( floatval( $matrix_amount ) != 0 ) {
		for ($i = 0; $i < $matrix_amount; $i++) {
			//Create matrix loop
			$html.= '<li class="list-list-item" data-id="' . esc_attr( $i ) . '">
						<div class="option-tree-setting">
							<div class="open"><span class="post-title">' . sprintf(__('Item no. %s', 'uncode-core'), '<span class="matrix-item-no">' . esc_attr($i + 1) . '</span>' ) . '</span><span class="grey size">width: <span class="single_width_factor"></span>, height: <span class="single_height_factor"></span></span></div>
							<div class="button-section">
								<a href="javascript:void(0);" class="option-tree-setting-edit option-tree-ui-button button left-item" title="Edit">
									<span class="icon fa fa-pencil3"></span>Edit
								</a>
								<a href="javascript:void(0);" class="option-tree-setting-reset option-tree-ui-button button left-item hidden" title="Reset">
									<span class="icon fa fa-reload"></span>
								</a>
							</div>
							<div class="option-tree-setting-body">' . wp_kses_post( $template_single . $template_media ) . '</div>
						</div>
					</li>';
		}

	} else {
		foreach ($loop as $key => $value) {
			$post = get_post($value);

			if (isset($post) && !empty($post)) {
				$html.= 	'<li class="list-list-item" data-id="' . esc_attr( $post->ID ) . '">
								<div class="option-tree-setting">
									<div class="open"><span class="post-title">' . ( isset($post->post_title) ? esc_html( $post->post_title ) : esc_html( $post->post_name ) ) . '</span> <span class="grey">' . esc_html( $post->post_mime_type ) . '</span><span class="grey size">width: <span class="single_width_factor"></span>, height: <span class="single_height_factor"></span></span></div>
									<div class="button-section">
										<a href="javascript:void(0);" class="option-tree-setting-edit option-tree-ui-button button left-item" title="Edit">
											<span class="icon fa fa-pencil3"></span>Edit
										</a>
										<a href="javascript:void(0);" class="option-tree-setting-reset option-tree-ui-button button left-item hidden" title="Reset">
											<span class="icon fa fa-reload"></span>
										</a>
									</div>
									<div class="option-tree-setting-body">' . wp_kses_post( $template_single . $template_media ) . '</div>
								</div>
							</li>';
			}
		}
	}

	$html = str_replace('\"', '"', $html);
	echo do_shortcode( shortcode_unautop( $html ) );

	remove_filter( 'wp_kses_allowed_html', 'uncode_core_single_matrix_allowed_html', 10, 2);

	die();
}

add_action('wp_ajax_uncode_get_medias', 'uncode_get_medias');

function uncode_core_single_matrix_allowed_html( $allowed_tags, $context ) {
	if ( $context === 'post' ) {
		$allowed_tags['input'] = array(
			'type'        => true,
			'name'        => true,
			'value'       => true,
			'placeholder' => true,
			'id'          => true,
			'class'       => true,
			'required'    => true,
			'style'       => true,
			'data-*'      => true,
		);

		$allowed_tags['select'] = array(
			'name'     => true,
			'value'    => true,
			'id'       => true,
			'class'    => true,
			'required' => true,
			'style'    => true,
			'data-*'   => true,
		);

		$allowed_tags['option'] = array(
			'value'    => true,
			'id'       => true,
			'class'    => true,
			'selected' => true,
			'style'    => true,
			'data-*'   => true,
		);
	}

	return $allowed_tags;
}
