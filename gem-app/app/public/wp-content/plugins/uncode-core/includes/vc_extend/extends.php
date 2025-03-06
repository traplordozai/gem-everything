<?php
/**
 * VC extends
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Extend label
 */
class uncode_generic_admin extends WPBakeryShortCode {
	public function singleParamHtmlHolder($param, $value) {
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
		return $output;
	}
}

/**
 * Extend modules
 */
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/row/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/row-inner/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/slider/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/counter/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/countdown/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/list/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/pricing/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/share/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/twentytwenty/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/content-block/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/author-profile/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/socials/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/info-box/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/uncode-index/extend.php';
require_once UNCODE_CORE_PLUGIN_DIR . '/includes/vc_extend/modules/single-media/extend.php';
