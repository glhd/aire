<?php

namespace Galahad\Aire\Components;

class DatetimeLocal extends Input
{
	protected function createElement(string $element_class, array $parameters)
	{
		$parameters['type'] = 'datetime-local';
		
		parent::createElement($element_class, $parameters);
	}
}
