<?php if ( ! defined( 'OT_VERSION' ) ) exit( 'No direct script access allowed' );
/**
 * Functions used to build each option type.
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2013, Derek Herman
 * @since     2.0
 */

/**
 * Builds the HTML for each of the available option types by calling those
 * function with call_user_func and passing the arguments to the second param.
 *
 * All fields are required!
 *
 * @param     array       $args The array of arguments are as follows:
 * @param     string      $type Type of option.
 * @param     string      $field_id The field ID.
 * @param     string      $field_name The field Name.
 * @param     mixed       $field_value The field value is a string or an array of values.
 * @param     string      $field_desc The field description.
 * @param     string      $field_std The standard value.
 * @param     string      $field_class Extra CSS classes.
 * @param     array       $field_choices The array of option choices.
 * @param     array       $field_settings The array of settings for a list item.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_display_by_type' ) ) {

  function ot_display_by_type( $args = array() ) {

	/* allow filters to be executed on the array */
	$args = apply_filters( 'ot_display_by_type', $args );

	/* build the function name */
	$function_name_by_type = str_replace( '-', '_', 'ot_type_' . $args['type'] );

	/* call the function & pass in arguments array */
	if ( function_exists( $function_name_by_type ) ) {
	  call_user_func( $function_name_by_type, $args );
	} else {
	  echo '<p>' . esc_html__( 'Sorry, this function does not exist', 'uncode-core' ) . '</p>';
	}

  }

}

/**
 * Background option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_background' ) ) {

  function ot_type_background( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* If an attachment ID is stored here fetch its URL and replace the value */
	if ( isset( $field_value['background-image'] ) && wp_attachment_is_image( $field_value['background-image'] ) ) {

	  $attachment_data = wp_get_attachment_image_src( $field_value['background-image'], 'original' );

	  /* check for attachment data */
	  if ( $attachment_data ) {

		$field_src = $attachment_data[0];

	  }

	}

	/* format setting outer wrapper */
	echo '<div class="format-setting type-background ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* allow fields to be filtered */
		$ot_recognized_background_fields = apply_filters( 'ot_recognized_background_fields', array(
		  'background-color',
		  'background-repeat',
		  'background-attachment',
		  'background-position',
		  'background-size',
		  'background-image'
		), $field_id );

		echo '<div class="ot-background-group">';

		  /* build background color */
		  if ( in_array( 'background-color', $ot_recognized_background_fields ) ) {

			echo '<div class="option-tree-ui-colorpicker-input-wrap">';

			  /* colorpicker JS */
			  echo '<script>jQuery(document).ready(function($) { OT_UI.bind_colorpicker("' . esc_attr( $field_id ) . '-picker"); });</script>';

			  /* set background color */
			  $background_color = isset( $field_value['background-color'] ) ? esc_attr( $field_value['background-color'] ) : '';

			  /* input */
			  echo '<input type="text" name="' . esc_attr( $field_name ) . '[background-color]" id="' . $field_id . '-picker" value="' . $background_color . '" class="hide-color-picker ' . esc_attr( $field_class ) . '" />';

			echo '</div>';

		  }

		  /* build background repeat */
		  if ( in_array( 'background-repeat', $ot_recognized_background_fields ) ) {

			$background_repeat = isset( $field_value['background-repeat'] ) ? esc_attr( $field_value['background-repeat'] ) : '';

			echo '<select name="' . esc_attr( $field_name ) . '[background-repeat]" id="' . esc_attr( $field_id ) . '-repeat" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';

			  echo '<option value="">' . esc_html__( 'background-repeat', 'uncode-core' ) . '</option>';
			  foreach ( ot_recognized_background_repeat( $field_id ) as $key => $value ) {

				echo '<option value="' . esc_attr( $key ) . '" ' . selected( $background_repeat, $key, false ) . '>' . esc_attr( $value ) . '</option>';

			  }

			echo '</select>';

		  }

		  /* build background attachment */
		  if ( in_array( 'background-attachment', $ot_recognized_background_fields ) ) {

			$background_attachment = isset( $field_value['background-attachment'] ) ? esc_attr( $field_value['background-attachment'] ) : '';

			echo '<select name="' . esc_attr( $field_name ) . '[background-attachment]" id="' . esc_attr( $field_id ) . '-attachment" class="option-tree-ui-select ' . $field_class . '">';

			  echo '<option value="">' . esc_html__( 'background-attachment', 'uncode-core' ) . '</option>';

			  foreach ( ot_recognized_background_attachment( $field_id ) as $key => $value ) {

				echo '<option value="' . esc_attr( $key ) . '" ' . selected( $background_attachment, $key, false ) . '>' . esc_attr( $value ) . '</option>';

			  }

			echo '</select>';

		  }

		  /* build background position */
		  if ( in_array( 'background-position', $ot_recognized_background_fields ) ) {

			$background_position = isset( $field_value['background-position'] ) ? esc_attr( $field_value['background-position'] ) : '';

			echo '<select name="' . esc_attr( $field_name ) . '[background-position]" id="' . esc_attr( $field_id ) . '-position" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';

			  echo '<option value="">' . esc_html__( 'background-position', 'uncode-core' ) . '</option>';

			  foreach ( ot_recognized_background_position( $field_id ) as $key => $value ) {

				echo '<option value="' . esc_attr( $key ) . '" ' . selected( $background_position, $key, false ) . '>' . esc_attr( $value ) . '</option>';

			  }

			echo '</select>';

		  }

		  /* Build background size  */
		  if ( in_array( 'background-size', $ot_recognized_background_fields ) ) {

			/**
			 * Use this filter to create a select instead of an text input.
			 * Be sure to return the array in the correct format. Add an empty
			 * value to the first choice so the user can leave it blank.
			 *
				array(
				  array(
					'label' => 'background-size',
					'value' => ''
				  ),
				  array(
					'label' => 'cover',
					'value' => 'cover'
				  ),
				  array(
					'label' => 'contain',
					'value' => 'contain'
				  )
				)
			 *
			 */
			$choices = apply_filters( 'ot_type_background_size_choices', '', $field_id );

			if ( is_array( $choices ) && ! empty( $choices ) ) {

			  /* build select */
			  echo '<select name="' . esc_attr( $field_name ) . '[background-size]" id="' . esc_attr( $field_id ) . '-size" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';

				foreach ( (array) $choices as $choice ) {
				  if ( isset( $choice['value'] ) && isset( $choice['label'] ) ) {
					echo '<option value="' . esc_attr( $choice['value'] ) . '"' . selected( ( isset( $field_value['background-size'] ) ? $field_value['background-size'] : '' ), $choice['value'], false ) . '>' . esc_attr( $choice['label'] ) . '</option>';
				  }
				}

			  echo '</select>';

			} else {

			  echo '<input type="text" name="' . esc_attr( $field_name ) . '[background-size]" id="' . esc_attr( $field_id ) . '-size" value="' . ( isset( $field_value['background-size'] ) ? esc_attr( $field_value['background-size'] ) : '' ) . '" class="widefat ot-background-size-input option-tree-ui-input ' . esc_attr( $field_class ) . '" placeholder="' . esc_html__( 'background-size', 'uncode-core' ) . '" />';

			}

		  }

		echo '</div>';

		/* build background image */
		if ( in_array( 'background-image', $ot_recognized_background_fields ) ) {

		  echo '<div class="option-tree-ui-upload-parent">';

			/* input */
			echo '<input type="text" name="' . esc_attr( $field_name ) . '[background-image]" id="' . esc_attr( $field_id ) . '" value="' . ( isset( $field_value['background-image'] ) ? esc_attr( $field_value['background-image'] ) : '' ) . '" class="widefat option-tree-ui-upload-input ' . esc_attr( $field_class ) . '" placeholder="' . esc_html__( 'background-image', 'uncode-core' ) . '" />';

			/* add media button */
			echo '<a href="javascript:void(0);" class="ot_upload_media option-tree-ui-button button button-primary light" rel="' . $post_id . '" title="' . esc_html__( 'Add Media', 'uncode-core' ) . '"><span class="icon ot-icon-plus-circle"></span>' . esc_html__( 'Add Media', 'uncode-core' ) . '</a>';

		  echo '</div>';

		  /* media */
		  if ( isset( $field_value['background-image'] ) && $field_value['background-image'] !== '' ) {

			/* replace image src */
			if ( isset( $field_src ) )
			  $field_value['background-image'] = $field_src;

			echo '<div class="option-tree-ui-media-wrap" id="' . esc_attr( $field_id ) . '_media">';

			  if ( preg_match( '/\.(?:jpe?g|png|gif|ico)$/i', $field_value['background-image'] ) )
				echo '<div class="option-tree-ui-image-wrap"><img src="' . esc_url( $field_value['background-image'] ) . '" alt="" /></div>';

			  echo '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button button button-secondary light" title="' . esc_html__( 'Remove Media', 'uncode-core' ) . '"><span class="icon ot-icon-minus-circle"></span>' . esc_html__( 'Remove Media', 'uncode-core' ) . '</a>';

			echo '</div>';

		  }

		}

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Colorpicker option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 * @updated   2.2.0
 */
if ( ! function_exists( 'ot_type_colorpicker' ) ) {

  function ot_type_colorpicker( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-colorpicker ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build colorpicker */
		echo '<div class="option-tree-ui-colorpicker-input-wrap">';
		  if (!(defined( 'DOING_AJAX' ) && DOING_AJAX)) {
		    /* colorpicker JS */
		    echo '<script>jQuery(document).ready(function($) { OT_UI.bind_colorpicker("' . esc_attr( $field_id ) . '"); });</script>';
		  }

		  /* set the default color */
		  $std = $field_std ? 'data-default-color="' . $field_std . '"' : '';

		  /* input */
		  echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="hide-color-picker ' . esc_attr( $field_class ) . '" ' . $std . ' />';

		echo '</div>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Gradientpicker option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 * @updated   2.2.0
 */
if ( ! function_exists( 'ot_type_gradientpicker' ) ) {

  function ot_type_gradientpicker( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-gradientpicker ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build gradientpicker */
		echo '<div class="option-tree-ui-gradientpicker-input-wrap">';

		  /* colorpicker JS */
		  $gradient_id = 'gradient-' . filter_var($field_id, FILTER_SANITIZE_NUMBER_INT);
		  echo '<div id="'.$gradient_id.'" class="gradient-picker"></div>';

		  /* gradientpicker JS */
		  echo '<script>jQuery(document).ready(function($) { OT_UI.bind_gradientpicker("' . esc_attr( $gradient_id ) . '"); });</script>';
		  /* set the default color */
		  $std = $field_std ? 'data-default-color="' . $field_std . '"' : '';

		  /* input */
		  echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( str_replace('\n', '', $field_value )) . '" class="hide-color-picker input-gradient ' . esc_attr( $field_class ) . '" ' . $std . ' />';

		echo '</div>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Colorpicker Opacity option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.5.0
 */
if ( ! function_exists( 'ot_type_colorpicker_opacity' ) ) {

  function ot_type_colorpicker_opacity( $args = array() ) {

	$args['field_class'] = isset( $args['field_class'] ) ? $args['field_class'] . ' ot-colorpicker-opacity' : 'ot-colorpicker-opacity';
	ot_type_colorpicker( $args );

  }

}

/**
 * CSS option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_css' ) ) {

  function ot_type_css( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-css simple ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build textarea for CSS */
		echo '<textarea class="hidden" id="textarea_' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_name ) .'">' . esc_attr( $field_value ) . '</textarea>';

		/* build pre to convert it into ace editor later */
		echo '<pre class="ot-css-editor ' . esc_attr( $field_class ) . '" id="' . esc_attr( $field_id ) . '">' . esc_textarea( $field_value ) . '</pre>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * JS option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_js' ) ) {

  function ot_type_js( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-js simple ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build textarea for JS */
		echo '<textarea class="hidden" id="textarea_' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_name ) .'">' . esc_attr( $field_value ) . '</textarea>';

		/* build pre to convert it into ace editor later */
		echo '<pre class="ot-js-editor ' . esc_attr( $field_class ) . '" id="' . esc_attr( $field_id ) . '">' . esc_textarea( $field_value ) . '</pre>';

	  echo '</div>';

	echo '</div>';

  }

}

if ( ! function_exists( 'ot_type_custom_post_type_select' ) ) {

  function ot_type_custom_post_type_select( $args = array() ) {

	if ( apply_filters( 'uncode_core_use_text_fields_for_cpt_selects', false ) ) {
		$args['placeholder'] = esc_html__( 'Inherit', 'uncode-core' );
		$args['type'] = 'text';
		ot_type_text( $args );
		return;
	}

	$post_active = '';

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	$has_frontend_editor = false;

	$field_choices = empty( $field_choices ) ? uncode_core_get_uncodeblocks_for_dropdowns() : $field_choices;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-custom-post-type-select select-with-switching-button ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build category */
		echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';

		if ( empty( $field_choices ) ) {
	  	echo '<option value="">' . esc_html__('No Content Blocks found', 'uncode-core') . '</option>';
	  } else {
	  	$choice_index = 0;

			/* has posts */
			foreach ( (array) $field_choices as $choice ) {

			  if ( isset( $choice['value'] ) && isset( $choice['label'] ) ) {
					$post_link = (isset( $choice['postlink'] )) ? ' data-link="'. esc_url( $choice['postlink'] ) . '"' : '';
					if ( isset( $choice['frontendlink'] ) && $choice['frontendlink'] ) {
						$post_link .= ' data-frontend-link="' . esc_url( $choice['frontendlink'] ) . '"';
						$has_frontend_editor = true;
					}

					if ( $choice_index === 0 && is_array( $field_extra_choices ) ) {
						foreach ( $field_extra_choices as $field_extra_choice_value => $field_extra_choice_label ) {
							echo '<option value="' . esc_attr( $field_extra_choice_value ) . '"' . selected( $field_value, $field_extra_choice_value, false ) . '>' . esc_attr( $field_extra_choice_label ) . '</option>';
						}
					}

					echo '<option value="' . esc_attr( $choice['value'] ) . '"' . selected( $field_value, $choice['value'], false ) . $post_link . '>' . esc_attr( $choice['label'] ) . '</option>';

					$choice_index++;
			  }
			}
		}

		echo '</select>';

		echo '<div class="link-button">';

			echo '<div class="option-tree-ui-button-switch hidden">';
			if ($post_active !== '') {
				echo '<a class="option-tree-ui-button button" data-action="edit-backend" href="'.$post_active.'" target="_blank">' . esc_html__('Edit backend','uncode-core') . '</a>';
				if ( $has_frontend_editor ) {
					echo '<a class="option-tree-ui-button button" data-action="edit-frontend" href="'.$post_active_frontend.'" target="_blank">' . esc_html__('Edit frontend','uncode-core') . '</a><span class="fa fa-caret-down dropdown"></span>';
				}
			} else {
				echo '<a class="option-tree-ui-button button" data-action="edit-backend" href="" target="_blank">' . esc_html__('Edit backend','uncode-core') . '</a>';
				if ( $has_frontend_editor ) {
					echo '<a class="option-tree-ui-button button" data-action="edit-frontend" href="" target="_blank">' . esc_html__('Edit frontend','uncode-core') . '</a><span class="fa fa-caret-down dropdown"></span>';
				}
			}
			echo '</div>';

		echo '</div>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * List Item option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_list_item' ) ) {

  function ot_type_list_item( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	// Default
	$sortable = true;

	// Check if the list can be sorted
	if ( ! empty( $field_class ) ) {
	  $classes = explode( ' ', $field_class );
	  if ( in_array( 'not-sortable', $classes ) ) {
		$sortable = false;
		str_replace( 'not-sortable', '', $field_class );
	  }
	}

	/* format setting outer wrapper */
	echo '<div class="format-setting type-list-item ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* pass the settings array arround */
		echo '<input type="hidden" name="' . esc_attr( $field_id ) . '_settings_array" id="' . esc_attr( $field_id ) . '_settings_array" value="' . ot_encode( serialize( $field_settings ) ) . '" />';

		/**
		 * settings pages have array wrappers like 'option_tree'.
		 * So we need that value to create a proper array to save to.
		 * This is only for NON metabox settings.
		 */
		if ( ! isset( $get_option ) )
		  $get_option = '';

		/* build list items */
		echo '<ul class="option-tree-setting-wrap' . ( $sortable ? ' option-tree-sortable' : '' ) .'" data-name="' . esc_attr( $field_id ) . '" data-id="' . esc_attr( $post_id ) . '" data-get-option="' . esc_attr( $get_option ) . '" data-type="' . esc_attr( $type ) . '">';

		if ( is_array( $field_value ) && ! empty( $field_value ) ) {

		  foreach( $field_value as $key => $list_item ) {

			echo '<li class="ui-state-default list-list-item">';
			  ot_list_item_view( $field_id, $key, $list_item, $post_id, $get_option, $field_settings, $type );
			echo '</li>';

		  }

		}

		echo '</ul>';

		/* button */
		echo '<a href="javascript:void(0);" class="option-tree-list-item-add option-tree-ui-button button right hug-right" title="' . esc_html__( 'Add New', 'uncode-core' ) . '">' . esc_html__( 'Add New', 'uncode-core' ) . '</a>';

		/* description */
		$list_desc = $sortable ? esc_html__( 'You can re-order with drag & drop, the order will update after saving.', 'uncode-core' ) : '';
		echo '<div class="list-item-description">' . apply_filters( 'ot_list_item_description', $list_desc, $field_id ) . '</div>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Measurement option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_measurement' ) ) {

  function ot_type_measurement( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-measurement ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		echo '<div class="option-tree-ui-measurement-input-wrap">';

		  echo '<input type="text" name="' . esc_attr( $field_name ) . '[0]" id="' . esc_attr( $field_id ) . '-0" value="' . ( isset( $field_value[0] ) ? esc_attr( $field_value[0] ) : '' ) . '" class="widefat option-tree-ui-input ' . esc_attr( $field_class ) . '" />';

		echo '</div>';

		/* build measurement */
		echo '<select name="' . esc_attr( $field_name ) . '[1]" id="' . esc_attr( $field_id ) . '-1" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';

		  echo '<option value="" disabled>' . esc_html__( 'unit', 'uncode-core' ) . '</option>';

		  foreach ( ot_measurement_unit_types( $field_id ) as $unit ) {
			echo '<option value="' . esc_attr( $unit ) . '"' . ( isset( $field_value[1] ) ? selected( $field_value[1], $unit, false ) : '' ) . '>' . esc_attr( $unit ) . '</option>';
		  }

		echo '</select>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Numeric Slider option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.1
 */
if ( ! function_exists( 'ot_type_numeric_slider' ) ) {

  function ot_type_numeric_slider( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	$_options = explode( ',', $field_min_max_step );
	$min = isset( $_options[0] ) ? $_options[0] : 0;
	$max = isset( $_options[1] ) ? $_options[1] : 100;
	$step = isset( $_options[2] ) ? $_options[2] : 1;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-numeric-slider ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		echo '<div class="ot-numeric-slider-wrap">';

		  echo '<input type="hidden" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="ot-numeric-slider-hidden-input" value="' . esc_attr( $field_value ) . '" data-min="' . esc_attr( $min ) . '" data-max="' . esc_attr( $max ) . '" data-step="' . esc_attr( $step ) . '">';

		  echo '<input type="text" class="ot-numeric-slider-helper-input widefat option-tree-ui-input ' . esc_attr( $field_class ) . '" value="' . esc_attr( $field_value ) . '" readonly>';

		  echo '<div id="ot_numeric_slider_' . esc_attr( $field_id ) . '" class="ot-numeric-slider"></div>';

		echo '</div>';

	  echo '</div>';

	echo '</div>';
  }

}

/**
 * On/Off option type
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     The options arguments
 * @return    string    The gallery metabox markup.
 *
 * @access    public
 * @since     2.2.0
 */
if ( ! function_exists( 'ot_type_on_off' ) ) {

  function ot_type_on_off( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-radio ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* Force only two choices, and allowing filtering on the choices value & label */
		$field_choices = array(
		  array(
			/**
			 * Filter the value of the On button.
			 *
			 * @since 2.5.0
			 *
			 * @param string The On button value. Default 'on'.
			 * @param string $field_id The field ID.
			 * @param string $filter_id For filtering both on/off value with one function.
			 */
			'value'   => apply_filters( 'ot_on_off_switch_on_value', 'on', $field_id, 'on' ),
			/**
			 * Filter the label of the On button.
			 *
			 * @since 2.5.0
			 *
			 * @param string The On button label. Default 'On'.
			 * @param string $field_id The field ID.
			 * @param string $filter_id For filtering both on/off label with one function.
			 */
			'label'   => apply_filters( 'ot_on_off_switch_on_label', esc_html__( 'On', 'uncode-core' ), $field_id, 'on' )
		  ),
		  array(
			/**
			 * Filter the value of the Off button.
			 *
			 * @since 2.5.0
			 *
			 * @param string The Off button value. Default 'off'.
			 * @param string $field_id The field ID.
			 * @param string $filter_id For filtering both on/off value with one function.
			 */
			'value'   => apply_filters( 'ot_on_off_switch_off_value', 'off', $field_id, 'off' ),
			/**
			 * Filter the label of the Off button.
			 *
			 * @since 2.5.0
			 *
			 * @param string The Off button label. Default 'Off'.
			 * @param string $field_id The field ID.
			 * @param string $filter_id For filtering both on/off label with one function.
			 */
			'label'   => apply_filters( 'ot_on_off_switch_off_label', esc_html__( 'Off', 'uncode-core' ), $field_id, 'off' )
		  )
		);

		/**
		 * Filter the width of the On/Off switch.
		 *
		 * @since 2.5.0
		 *
		 * @param string The switch width. Default '100px'.
		 * @param string $field_id The field ID.
		 */
		$switch_width = apply_filters( 'ot_on_off_switch_width', '100px', $field_id );

		echo '<div class="on-off-switch"' . ( $switch_width != '100px' ? sprintf( ' style="width:%s"', $switch_width ) : '' ) . '>';

		/* build radio */
		foreach ( (array) $field_choices as $key => $choice ) {
		  echo '
			<input type="radio" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" value="' . esc_attr( $choice['value'] ) . '"' . checked( $field_value, $choice['value'], false ) . ' class="radio option-tree-ui-radio ' . esc_attr( $field_class ) . '" />
			<label for="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" onclick="">' . esc_attr( $choice['label'] ) . '</label>';
		}

		  echo '<span class="slide-button"></span>';

		echo '</div>';

		do_action( 'ot_after_type_on_off', $field_id );

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Page Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_page_select' ) ) {

  function ot_type_page_select( $args = array() ) {

	if ( apply_filters( 'uncode_core_use_text_fields_for_cpt_selects', false ) ) {
		$args['placeholder'] = esc_html__( 'Inherit', 'uncode-core' );
		$args['type'] = 'text';
		ot_type_text( $args );
		return;
	}

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;
	$post_active = '';

	$has_frontend_editor = false;

	$field_choices = empty( $field_choices ) ? uncode_core_get_pages_for_dropdowns() : $field_choices;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-page-select select-with-switching-button ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build page select */
		echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';

		if ( empty( $field_choices ) ) {
	  	echo '<option value="">' . esc_html__('No pages found', 'uncode-core') . '</option>';
	  } else {
	  	/* has posts */
			foreach ( (array) $field_choices as $choice ) {

			  if ( isset( $choice['value'] ) && isset( $choice['label'] ) ) {
					$post_link = (isset( $choice['postlink'] )) ? ' data-link="'. esc_url( $choice['postlink'] ) . '"' : '';
					if ( isset( $choice['frontendlink'] ) && $choice['frontendlink'] ) {
						$post_link .= ' data-frontend-link="' . esc_url( $choice['frontendlink'] ) . '"';
						$has_frontend_editor = true;
					}
					echo '<option value="' . esc_attr( $choice['value'] ) . '"' . selected( $field_value, $choice['value'], false ) . $post_link . '>' . esc_attr( $choice['label'] ) . '</option>';
			  }
			}
	  }

		echo '</select>';

		echo '<div class="link-button">';

			echo '<div class="option-tree-ui-button-switch hidden">';
			if ($post_active !== '') {
					echo '<a class="option-tree-ui-button button" data-action="edit-backend" href="'.$post_active.'" target="_blank">' . esc_html__('Edit backend','uncode-core') . '</a>';
					if ( $has_frontend_editor ) {
						echo '<a class="option-tree-ui-button button" data-action="edit-frontend" href="'.$post_active_frontend.'" target="_blank">' . esc_html__('Edit frontend','uncode-core') . '</a><span class="fa fa-caret-down dropdown"></span>';
					}
			} else {
				echo '<a class="option-tree-ui-button button" data-action="edit-backend" href="" target="_blank">' . esc_html__('Edit backend','uncode-core') . '</a>';
				if ( $has_frontend_editor ) {
					echo '<a class="option-tree-ui-button button" data-action="edit-frontend" href="" target="_blank">' . esc_html__('Edit frontend','uncode-core') . '</a><span class="fa fa-caret-down dropdown"></span>';
				}
			}
			echo '</div>';

		echo '</div>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Radio Images option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_radio_image' ) ) {

  function ot_type_radio_image( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-radio-image ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/**
		 * load the default filterable images if nothing
		 * has been set in the choices array.
		 */
		if ( empty( $field_choices ) )
		  $field_choices = ot_radio_images( $field_id );

		/* build radio image */
		foreach ( (array) $field_choices as $key => $choice ) {

		  $src = str_replace( 'OT_URL', OT_URL, $choice['src'] );
		  $src = str_replace( 'OT_THEME_URL', OT_THEME_URL, $src );

		  /* make radio image source filterable */
		  $src = apply_filters( 'ot_type_radio_image_src', $src, $field_id );

		  /**
		   * Filter the image attributes.
		   *
		   * @since 2.5.3
		   *
		   * @param string $attributes The image attributes.
		   * @param string $field_id The field ID.
		   * @param array $choice The choice.
		   */
		  $attributes = apply_filters( 'ot_type_radio_image_attributes', '', $field_id, $choice );

		  echo '<div class="option-tree-ui-radio-images">';
			echo '<p style="display:none"><input type="radio" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" value="' . esc_attr( $choice['value'] ) . '"' . checked( $field_value, $choice['value'], false ) . ' class="option-tree-ui-radio option-tree-ui-images" /><label for="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '">' . esc_attr( $choice['label'] ) . '</label></p>';
			echo '<img ' . $attributes . ' src="' . esc_url( $src ) . '" alt="' . esc_attr( $choice['label'] ) .'" title="' . esc_attr( $choice['label'] ) .'" class="option-tree-ui-radio-image ' . esc_attr( $field_class ) . ( $field_value == $choice['value'] ? ' option-tree-ui-radio-image-selected' : '' ) . '" />';
		  echo '</div>';
		}

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_select' ) ) {

  function ot_type_select( $args = array() ) {

	$posts = false;
	$post_active = '';

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-custom-post-type-select select-with-switching-button ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* filter choices array */
	  $field_choices = apply_filters( 'ot_type_select_choices', $field_choices, $field_id );

	  /* is it is editable in VC */
	  $vc_editable = false;
	  if ( isset( $field_post_type ) && $field_post_type && class_exists( 'Vc_Roles' ) ) {
	  	$vc_roles = new Vc_Roles();
	  	$vc_post_types = $vc_roles->getPostTypes();

	  	foreach ($vc_post_types as $key => $value) {
		  	if ( isset( $field_post_type ) && $field_post_type == $value[0] ) {
		  		$vc_editable = true;
		  		break;
		  	}
	  	}

	  }

	  // $field_post_type

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build select */
		echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
		foreach ( (array) $field_choices as $choice ) {
		  if ( isset( $choice['value'] ) && isset( $choice['label'] ) ) {
			$post_link = (isset( $choice['postlink'] )) ? ' data-link="'. esc_url( $choice['postlink'] ) . '"' : '';
			if ( $vc_editable && function_exists( 'vc_frontend_editor' ) ) {
				$post_link .= ' data-frontend-link="' . esc_url( vc_frontend_editor()->getInlineUrl( '', $choice['value']) ) . '"';
			}
			if ($post_link !== '') {
				$posts = true;
			}
			echo '<option value="' . esc_attr( $choice['value'] ) . '"' . selected( $field_value, $choice['value'], false ) . $post_link . '>' . esc_attr( $choice['label'] ) . '</option>';
		  }
		}

		echo '</select>';

		echo '<div class="link-button">';

			echo '<div class="option-tree-ui-button-switch hidden">';

				if ($posts && $post_active !== '') {
					if ( $vc_editable ) {
						echo '<a class="option-tree-ui-button button" data-action="edit-backend" href="'.$post_active.'" target="_blank">' . esc_html__('Edit backend','uncode-core') . '</a>';
						if ( function_exists( 'vc_frontend_editor' ) ) {
							echo '<a class="option-tree-ui-button button" data-action="edit-frontend" href="'.$post_active_frontend.'" target="_blank">' . esc_html__('Edit frontend','uncode-core') . '</a><span class="fa fa-caret-down dropdown"></span>';
						}
					} else {
						echo '<a class="option-tree-ui-button button" data-action="edit" href="'.$post_active.'" target="_blank">' . esc_html__('Edit','uncode-core') . '</a>';
					}
				} else {
					if ( $vc_editable ) {
						echo '<a class="option-tree-ui-button button" data-action="edit-backend" href="" target="_blank">' . esc_html__('Edit backend','uncode-core') . '</a>';
						if ( function_exists( 'vc_frontend_editor' ) ) {
							echo '<a class="option-tree-ui-button button" data-action="edit-frontend" href="" target="_blank">' . esc_html__('Edit frontend','uncode-core') . '</a><span class="fa fa-caret-down dropdown"></span>';
						}
					} else {
						echo '<a class="option-tree-ui-button button" data-action="edit" href="" target="_blank">' . esc_html__('Edit','uncode-core') . '</a>';
					}
				}

			echo '</div>';

		echo '</div>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Menu Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.6.0
 */
if ( ! function_exists( 'ot_type_menu_select' ) ) {

  function ot_type_menu_select( $args = array() ) {

	if ( apply_filters( 'uncode_core_use_text_fields_for_cpt_selects', false ) ) {
		$args['placeholder'] = esc_html__( 'Inherit', 'uncode-core' );
		$args['type'] = 'text';
		ot_type_text( $args );
		return;
	}

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* filter choices array */
	  $field_choices = uncode_core_get_menus_for_dropdowns();

	  // $field_post_type

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build select */
		echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
		foreach ( (array) $field_choices as $choice ) {
		  if ( isset( $choice['value'] ) && isset( $choice['label'] ) ) {
			echo '<option value="' . esc_attr( $choice['value'] ) . '"' . selected( $field_value, $choice['value'], false ) . '>' . esc_attr( $choice['label'] ) . '</option>';
		  }
		}

		echo '</select>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Sidebar Select option type.
 *
 * This option type makes it possible for users to select a WordPress registered sidebar
 * to use on a specific area. By using the two provided filters, 'ot_recognized_sidebars',
 * and 'ot_recognized_sidebars_{$field_id}' we can be selective about which sidebars are
 * available on a specific content area.
 *
 * For example, if we create a WordPress theme that provides the ability to change the
 * Blog Sidebar and we don't want to have the footer sidebars available on this area,
 * we can unset those sidebars either manually or by using a regular expression if we
 * have a common name like footer-sidebar-$i.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.1
 */
if ( ! function_exists( 'ot_type_sidebar_select' ) ) {

  function ot_type_sidebar_select( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-sidebar-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build page select */
		echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';

		/* get the registered sidebars */
		global $wp_registered_sidebars;

		$sidebars = array();
		foreach( $wp_registered_sidebars as $id=>$sidebar ) {
		  $sidebars[ $id ] = $sidebar[ 'name' ];
		}

		/* filters to restrict which sidebars are allowed to be selected, for example we can restrict footer sidebars to be selectable on a blog page */
		$sidebars = apply_filters( 'ot_recognized_sidebars', $sidebars );
		$sidebars = apply_filters( 'ot_recognized_sidebars_' . $field_id, $sidebars );

		/* has sidebars */
		if ( count( $sidebars ) ) {
		  echo '<option value="">' . esc_html__( 'Select...', 'uncode-core' ) . '</option>';
		  foreach ( $sidebars as $id => $sidebar ) {
			echo '<option value="' . esc_attr( $id ) . '"' . selected( $field_value, $id, false ) . '>' . esc_attr( $sidebar ) . '</option>';
		  }
		} else {
		  echo '<option value="">' . esc_html__( 'No Sidebars', 'uncode-core' ) . '</option>';
		}

		echo '</select>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Tab option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.3.0
 */
if ( ! function_exists( 'ot_type_tab' ) ) {

  function ot_type_tab( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* format setting outer wrapper */
	echo '<div class="format-setting type-tab">';

	  echo '<br />';

	echo '</div>';

  }

}

/**
 * Text option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_text' ) ) {

  function ot_type_text( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-text ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

	  	$placeholder = isset( $placeholder ) && $placeholder ? 'placeholder="' . $placeholder . '"' : '';

		/* build text input */
		echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-input ' . esc_attr( $field_class ) . '" ' . $placeholder . ' />';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Number option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_number' ) ) {

  function ot_type_number( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-text ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build text input */
		echo '<input type="number" min="0" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-input ' . esc_attr( $field_class ) . '" />';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Textarea option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_textarea' ) ) {

  function ot_type_textarea( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-textarea ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . ' fill-area">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build textarea */
		wp_editor(
		  $field_value,
		  esc_attr( $field_id ),
		  array(
			'editor_class'  => esc_attr( $field_class ),
			'wpautop'       => apply_filters( 'ot_wpautop', false, $field_id ),
			'media_buttons' => apply_filters( 'ot_media_buttons', true, $field_id ),
			'textarea_name' => esc_attr( $field_name ),
			'textarea_rows' => esc_attr( $field_rows ),
			'tinymce'       => apply_filters( 'ot_tinymce', true, $field_id ),
			'quicktags'     => apply_filters( 'ot_quicktags', array( 'buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,spell,close' ), $field_id )
		  )
		);

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Textarea Simple option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_textarea_simple' ) ) {

  function ot_type_textarea_simple( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-textarea simple ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* filter to allow wpautop */
		$wpautop = apply_filters( 'ot_wpautop', false, $field_id );

		/* wpautop $field_value */
		if ( $wpautop == true )
		  $field_value = wpautop( $field_value );

		/* build textarea simple */
		echo '<textarea class="textarea ' . esc_attr( $field_class ) . '" rows="' . esc_attr( $field_rows )  . '" cols="40" name="' . esc_attr( $field_name ) .'" id="' . esc_attr( $field_id ) . '">' . esc_textarea( $field_value ) . '</textarea>';

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Textblock Titled option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_textblock_titled' ) ) {

  function ot_type_textblock_titled( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* format setting outer wrapper */
	echo '<div class="format-setting type-textblock titled wide-desc">';

	  /* description */
	  //echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	echo '</div>';

  }

}

/**
 * Upload option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_upload' ) ) {

  function ot_type_upload( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* If an attachment ID is stored here fetch its URL and replace the value */
	if ( $field_value && wp_attachment_is_image( $field_value ) ) {

		if ( function_exists( 'uncode_get_media_info' ) ) {
			$media_info = uncode_get_media_info($field_value);
			$media_metavalues = isset( $media_info->metadata ) ? unserialize($media_info->metadata ) : array();
			$field_src = $media_info->guid;

			if ( ! ( isset( $media_metavalues['width'] ) && $media_metavalues['width'] && isset( $media_metavalues['height'] ) && $media_metavalues['height'] ) ) {
				$has_correct_dimensions = false;
			}
		}

	}

	/* format setting outer wrapper */
	echo '<div class="format-setting type-upload ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';

		/* build upload */
		echo '<div class="option-tree-ui-upload-parent">';

		  /* input */
		  echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-upload-input ' . esc_attr( $field_class ) . '" />';

		  /* add media button */
		  echo '<a href="javascript:void(0);" class="ot_upload_media option-tree-ui-button button button-primary light" rel="' . $post_id . '" title="' . esc_html__( 'Add Media', 'uncode-core' ) . '"><span class="icon ot-icon-plus-circle"></span>' . esc_html__( 'Add Media', 'uncode-core' ) . '</a>';

		echo '</div>';

		/* media */
		if ( $field_value ) {

		  echo '<div class="option-tree-ui-media-wrap" id="' . esc_attr( $field_id ) . '_media">';

			/* replace image src */
			if ( isset( $field_src ) ) {
				$field_value = $field_src;
			}

			if ( ! $has_correct_dimensions ) {
				echo '<div class="option-tree-ui-image-wrap">' . sprintf( wp_kses_post( __( 'Please enter valid width and height measurements for your SVG. <a href="%s" target="_blank">Read More...</a>', 'uncode-core' ) ), 'https://support.undsgn.com/hc/en-us/articles/214001865#notes' ) . '</div>';
			} else if ( preg_match( '/\.(?:jpe?g|png|gif|ico)$/i', $field_value ) ) {
			  echo '<div class="option-tree-ui-image-wrap"><img src="' . esc_url( $field_value ) . '" alt="" /></div>';
			}

			echo '<a href="javascript:(void);" class="option-tree-ui-remove-media option-tree-ui-button button button-secondary light" title="' . esc_html__( 'Remove Media', 'uncode-core' ) . '"><span class="icon ot-icon-minus-circle"></span>' . esc_html__( 'Remove Media', 'uncode-core' ) . '</a>';

		  echo '</div>';

		}

	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Multi Text option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_multitext' ) ) {

  function ot_type_multitext( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-text ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

	  /* description */
	  //if ($has_desc) echo '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>';

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';
	  echo '<div class="format-setting-inner--multitext">';

	  	if ( is_array( $field_choices ) ) {
	  		$i = 0;
	  		$columns = count( $field_choices );

	  		foreach ( $field_choices as $option_key => $option_value ) {
	  			echo '<div class="option-tree-ui-multitext-wrapper option-tree-ui-multitext-wrapper--columns-' . $columns . '">';
	  			echo '<label for="' . esc_attr( $field_id ) . '-' . $i . '" class="option-tree-ui-multitext-label">' . $option_value . '</label>';
	  			echo '<input type="text" name="' . esc_attr( $field_name ) . '[' . $i . ']" id="' . esc_attr( $field_id ) . '-' . $i . '" value="" class="widefat option-tree-ui-input option-tree-ui-multitext' . esc_attr( $field_class ) . '" />';
	  			echo '</div>';
	  			// echo '<input type="text" name="' . esc_attr( $field_name ) . '[' . $i . ']" id="' . esc_attr( $field_id ) . '-' . $i . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-input ' . esc_attr( $field_class ) . '" />';
	  			$i++;
	  		}
	  	}

	  echo '</div>';
	  echo '</div>';

	echo '</div>';

  }

}

/**
 * Button option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_button' ) ) {

  function ot_type_button( $args = array() ) {

	/* turns arguments array into variables */
	extract( $args );

	/* verify a description */
	$has_desc = $field_desc ? true : false;

	/* format setting outer wrapper */
	echo '<div class="format-setting type-button ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . ' ">';

	  /* description */

	  /* format setting inner wrapper */
	  echo '<div class="format-setting-inner">';
	  	$span_class = $field_button_ajax ? 'uncode-ot-spinner-placeholder' : '';

		echo '<button class="option-tree-ui-button button ' . esc_attr( $field_class ) . '" id="' . esc_attr( $field_id ) . '" ><span><span class="' . $span_class . '"></span><span class="button__text">' . esc_attr( $field_button_text ) . '</span></span></button>';

	  echo '</div>';

	echo '</div>';

  }

}

/* End of file ot-functions-option-types.php */
/* Location: ./includes/ot-functions-option-types.php */
