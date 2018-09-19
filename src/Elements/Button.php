<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Value\HasValue;

class Button extends Element
{
	use HasValue;
	
	protected $view = 'button';
	
	public function __construct(Aire $aire, Form $form = null, string $label)
	{
		parent::__construct($aire, $form);
		
		$this->label($label);
	}
	
	public function label(string $label) : self
	{
		$this->view_data['label'] = $label;
		
		return $this;
	}
}
