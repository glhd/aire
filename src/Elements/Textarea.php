<?php

namespace Galahad\Aire\Elements;

class Textarea extends \Galahad\Aire\DTD\Textarea
{
	/**
	 * Set the text area value
	 *
	 * @param string $value
	 * @return $this
	 */
	public function value($value = null)
	{
		$this->view_data['value'] = $value;
		
		return $this;
	}
}
