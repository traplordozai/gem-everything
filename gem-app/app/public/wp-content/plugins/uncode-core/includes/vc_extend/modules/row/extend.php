<?php
/**
 * VC Row Extend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class uncode_row extends WPBakeryShortCode
{
	protected $predefined_atts = array(
		'el_class' => '',
	);

	protected function content($atts, $content = null)
	{
		$prefix = '';
		return $prefix . $this->loadTemplate($atts, $content);
	}

	/* This returs block controls
	 ---------------------------------------------------------- */
	public function getColumnControls($controls, $extended_css = ''/*, $atts*/)
	{
		global $vc_row_layouts;
		$controls_start = '<div class="vc_controls vc_controls-row controls controls_row vc_clearfix">';
		$controls_end = '</div>';

		//Create columns
		$controls_layout = '<span class="vc_row_layouts vc_control">';
		foreach ($vc_row_layouts as $layout)
		{
			$controls_layout.= '<a class="vc_control-set-column set_columns ' . $layout['icon_class'] . '" data-cells="' . $layout['cells'] . '" data-cells-mask="' . $layout['mask'] . '" title="' . $layout['title'] . '"></a> ';
		}
		$controls_layout.= '<a class="vc_control-set-column set_columns custom_columns" data-cells="custom" data-cells-mask="custom" title="' . esc_html__('Custom layout', 'js_composer') . '"><i class="fa fa-magic"></i><span>' . esc_html__('Custom', 'js_composer') . '</span></a> ';
		$controls_layout.= '</span>';

		$controls_move = ' <a class="vc_control column_move vc_column-move" href="#" title="' . esc_html__('Drag row to reorder', 'js_composer') . '"><i class="vc-composer-icon vc-c-icon-dragndrop"></i></a>';
		$controls_back = '';
		$controls_delete = '<a class="vc_control column_delete vc_column-delete" href="#" title="' . esc_html__('Delete this row', 'js_composer') . '" data-vc-control="delete"><i class="vc-composer-icon vc-c-icon-delete_empty"></i></a>';
		$controls_edit = ' <a class="vc_control column_edit vc_column-edit" href="#" title="' . esc_html__('Edit this row', 'js_composer') . '" data-vc-control="edit"><i class="vc-composer-icon vc-c-icon-mode_edit"></i></a>';
		$controls_clone = ' <a class="vc_control column_clone vc_column-clone" href="#" title="' . esc_html__('Clone this row', 'js_composer') . '" data-vc-control="clone"><i class="vc-composer-icon vc-c-icon-content_copy"></i></a>';
		$controls_copy = ' <a class="vc_control column_copy vc_column-copy" href="#" title="' . esc_attr__( 'Copy this row', 'js_composer' ) . '" data-vc-control="copy"><i class="vc-composer-icon vc-c-icon-copy"></i></a>';
		$controls_paste = ' <a class="vc_control column_paste vc_column-paste" href="#" title="' . esc_attr__( 'Paste', 'js_composer' ) . '" data-vc-control="paste"><i class="vc-composer-icon vc-c-icon-paste"></i></a>';
		$controls_toggle = ' <a class="vc_control column_toggle vc_column-toggle" href="#" title="' . esc_html__('Toggle row', 'js_composer') . '" data-vc-control="toggle"><i class="vc-composer-icon vc-c-icon-arrow_drop_down"></i></a>';
		$controls_center_end = '</span>';

		$row_edit_clone_delete = '<span class="vc_row_edit_clone_delete">';
		$row_edit_clone_delete.= $controls_delete . $controls_clone /*. $controls_add*/ .  $controls_copy . $controls_paste . $controls_toggle;
		$column_controls_full = $controls_start . $controls_move . $controls_layout . $controls_edit .$controls_back . $row_edit_clone_delete . $controls_end;

		return $column_controls_full;
	}

	public function contentAdmin($atts, $content = null)
	{
		$atts = shortcode_atts( $this->predefined_atts, $atts );

		$output = '';

		$column_controls = $this->getColumnControls($this->settings('controls') , null, $atts);

		$output.= '<div' . $this->customAdminBockParams() . ' data-element_type="' . $this->settings["base"] . '" class="wpb_' . $this->settings['base'] . ' wpb_sortable vc_main-sortable-element">';
		$output.= str_replace("%column_size%", 1, $column_controls);
		$output.= '<div class="wpb_element_wrapper">';
		$output.= '<div class="vc_row vc_row-fluid wpb_row_container vc_container_for_children">';
		if ($content == '' && !empty($this->settings["default_content_in_template"]))
		{
			$output.= do_shortcode(shortcode_unautop($this->settings["default_content_in_template"]));
		} else
		{
			$output.= do_shortcode(shortcode_unautop($content));
		}
		$output.= '</div>';
		if (isset($this->settings['params']))
		{
			$inner = '';
			foreach ($this->settings['params'] as $param)
			{
				$param_value = isset(${$param['param_name']}) ? ${$param['param_name']} : '';
				if (is_array($param_value))
				{

					// Get first element from the array
					reset($param_value);
					$first_key = key($param_value);
					$param_value = $param_value[$first_key];
				}
				$inner.= $this->singleParamHtmlHolder($param, $param_value);
			}
			$output.= $inner;
		}
		$output.= '</div>';
		$output.= '</div>';

		return $output;
	}

	public function customAdminBockParams()
	{
		return '';
	}

	public function buildStyle($bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '')
	{
		$has_image = false;
		$style = '';
		if ((int)$bg_image > 0 && ($image_url = wp_get_attachment_url($bg_image, 'large')) !== false)
		{
			$has_image = true;
			$style.= "background-image: url(" . $image_url . ");";
		}
		if (!empty($bg_color))
		{
			$style.= vc_get_css_color('background-color', $bg_color);
		}
		if (!empty($bg_image_repeat) && $has_image)
		{
			if ($bg_image_repeat === 'cover')
			{
				$style.= "background-repeat:no-repeat;background-size: cover;";
			} elseif ($bg_image_repeat === 'contain')
			{
				$style.= "background-repeat:no-repeat;background-size: contain;";
			} elseif ($bg_image_repeat === 'no-repeat')
			{
				$style.= 'background-repeat: no-repeat;';
			}
		}
		if (!empty($font_color))
		{
			$style.= vc_get_css_color('color', $font_color);
		}
		if ($padding != '')
		{
			$style.= 'padding: ' . (preg_match('/(px|em|\%|pt|cm)$/', $padding) ? $padding : $padding . 'px') . ';';
		}
		if ($margin_bottom != '')
		{
			$style.= 'margin-bottom: ' . (preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom . 'px') . ';';
		}
		return empty($style) ? $style : ' style="' . $style . '"';
	}
}
