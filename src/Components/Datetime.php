<?php

namespace Galahad\Aire\Components;

class Datetime extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'datetime';
		
		parent::createElement($element_class, $parameters);
	}
}
