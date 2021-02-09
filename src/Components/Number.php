<?php

namespace Galahad\Aire\Components;

class Number extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'number';
		
		parent::createElement($element_class, $parameters);
	}
}
