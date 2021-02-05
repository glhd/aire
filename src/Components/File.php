<?php

namespace Galahad\Aire\Components;

class File extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'file';
		
		parent::createElement($element_class, $parameters);
	}
}
