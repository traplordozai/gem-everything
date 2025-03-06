<?php
/**
 * VC Socials Extend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class uncode_socials extends WPBakeryShortCode
{
	public function template($content = '')
	{
		return $this
			->contentAdmin($this->atts);
	}
}
