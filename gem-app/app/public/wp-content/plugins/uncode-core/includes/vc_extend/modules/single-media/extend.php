<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * VC Single Media Extend
 */
class uncode_single_media extends WPBakeryShortCode {

	public function singleParamHtmlHolder( $param, $value ) {
		$output = '';
		$param_name = isset($param['param_name']) ? $param['param_name'] : '';
		$type = isset($param['type']) ? $param['type'] : '';
		$class = isset($param['class']) ? $param['class'] : '';
		if (!empty($param['admin_label']) && $param['admin_label'] === true)
		{
			$output.= '<span class="vc_admin_label admin_label_' . $param['param_name'] . (empty($value) ? ' hidden-label' : '') . '"><label>' . $param['heading'] . '</label>: ' . $value . '</span>';
		}
		if (!empty($param['holder']))
		{
			$output.= '<' . $param['holder'] . ' class="vc_admin_label wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
		}
		if ( 'media' === $param_name ) {
			$output .= '<img class="attachment-thumbnail vc_general vc_element-icon" alt="" title="" style="display: none;" />';
		}

		return $output;
	}
}
