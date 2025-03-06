<?php
/**
 * VC Counter Extend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class uncode_counter extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}
