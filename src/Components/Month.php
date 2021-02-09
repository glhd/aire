<?php

namespace Galahad\Aire\Components;

class Month extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'month';
		
		parent::createElement($element_class, $parameters);
	}
}
