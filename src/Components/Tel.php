<?php

namespace Galahad\Aire\Components;

class Tel extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'tel';
		
		parent::createElement($element_class, $parameters);
	}
}
