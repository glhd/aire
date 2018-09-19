<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Value\HasValue;

class Button extends FormElement
{
	use HasValue;
	
	protected $view = 'button';
	
	public function label(string $label) : self
	{
		$this->view_data['label'] = $label;
		
		return $this;
	}
}
