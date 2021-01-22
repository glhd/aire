<?php

namespace Galahad\Aire\Components;

class Hidden extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'hidden';
		
		parent::createElement($element_class, $parameters);
	}
}
