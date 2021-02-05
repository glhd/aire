<?php

namespace Galahad\Aire\Components;

class Image extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'image';
		
		parent::createElement($element_class, $parameters);
	}
}
