<?php

namespace Galahad\Aire\Components;

class Date extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'date';
		
		parent::createElement($element_class, $parameters);
	}
}
