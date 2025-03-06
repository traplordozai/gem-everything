<?php
/**
 * VC List Extend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class uncode_list extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}
