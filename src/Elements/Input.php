<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Value\HasValue;

class Input extends GroupableElement
{
	use HasValue;
	
	protected $view = 'input';
	
	protected $attributes = [
		'type' => 'text',
	];
	
	public function name($name) : self
	{
		$this->attributes['name'] = $name;
		
		return $this;
	}
}
