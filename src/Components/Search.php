<?php

namespace Galahad\Aire\Components;

class Search extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'search';
		
		parent::createElement($element_class, $parameters);
	}
}
