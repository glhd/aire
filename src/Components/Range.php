<?php

namespace Galahad\Aire\Components;

class Range extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'range';
		
		parent::createElement($element_class, $parameters);
	}
}
