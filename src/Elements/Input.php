<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

class Input extends GroupableElement
{
	use HasValue;
	
	protected $view = 'input';
	
	protected $attributes = [
		'type' => 'text',
	];
	
	public function __construct(Aire $aire, $name = null, $label = null)
	{
		parent::__construct($aire);
		
		if ($name) {
			$this->attributes['name'] = $name;
		}
		
		if ($label) {
			$this->group->label($label);
		}
	}
}
