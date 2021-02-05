<?php

namespace Galahad\Aire\Components;

class Week extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'week';
		
		parent::createElement($element_class, $parameters);
	}
}
