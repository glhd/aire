<?php

namespace Galahad\Aire\Components;

use Galahad\Aire\Elements\Element;
use Galahad\Aire\Support\Facades\Aire;

trait RequiresOptionsAttribute
{
	protected $options;
	
	protected function getElementInstance(string $element_class): Element
	{
		$aire = Aire::getFacadeRoot();
		
		return new $element_class($aire, $this->options, $aire->form());
	}
}
