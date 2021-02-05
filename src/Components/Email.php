<?php

namespace Galahad\Aire\Components;

class Email extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'email';
		
		parent::createElement($element_class, $parameters);
	}
}
