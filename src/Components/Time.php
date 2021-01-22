<?php

namespace Galahad\Aire\Components;

class Time extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'time';
		
		parent::createElement($element_class, $parameters);
	}
}
