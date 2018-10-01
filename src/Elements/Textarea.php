<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Elements\Concerns\Groupable;

class Textarea extends \Galahad\Aire\DTD\Textarea
{
	use Groupable;
	
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
