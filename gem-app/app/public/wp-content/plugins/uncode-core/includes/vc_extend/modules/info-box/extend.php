<?php
/**
 * VC Info Box Extend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class uncode_info_box extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}
