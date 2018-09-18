<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

class Button extends Element
{
	protected $view = 'button';
	
	public function __construct(Aire $aire, string $label)
	{
		parent::__construct($aire);
		
		$this->label($label);
	}
	
	public function label(string $label) : self
	{
		$this->data['label'] = $label;
		
		return $this;
	}
}
