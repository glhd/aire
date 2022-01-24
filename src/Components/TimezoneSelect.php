<?php

namespace Galahad\Aire\Components;

use Galahad\Aire\Elements\Element;
use Galahad\Aire\Support\TimezonesCollection;

class TimezoneSelect extends Select
{
	protected function getElementInstance(string $element_class): Element
	{
		$this->options = new TimezonesCollection();
		
		return parent::getElementInstance($element_class);
	}
}
