<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Value\HasValue;

class Button extends \Galahad\Aire\DTD\Button
{
	use HasValue;
	
	public function label(string $label) : self
	{
		$this->view_data['label'] = $label;
		
		return $this;
	}
}
