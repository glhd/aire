<?php

namespace Galahad\Aire\Components;

class Password extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'password';
		
		parent::createElement($element_class, $parameters);
	}
}
