<?php

namespace Galahad\Aire\Components;

class Submit extends Button
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'submit';
		
		parent::createElement($element_class, $parameters);
	}
}
