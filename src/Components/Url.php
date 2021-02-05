<?php

namespace Galahad\Aire\Components;

class Url extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'url';
		
		parent::createElement($element_class, $parameters);
	}
}
