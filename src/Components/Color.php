<?php

namespace Galahad\Aire\Components;

class Color extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'color';
		
		parent::createElement($element_class, $parameters);
	}
}
