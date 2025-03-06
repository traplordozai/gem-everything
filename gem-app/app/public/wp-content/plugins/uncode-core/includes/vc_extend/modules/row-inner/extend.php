<?php
/**
 * VC Row Inner Extend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class uncode_row_inner extends uncode_row
{
	protected function getFileName()
	{
		return 'vc_row_inner';
	}

	public function template($content = '')
	{
		return $this->contentAdmin($this->atts);
	}
}
