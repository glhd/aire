<?php

namespace Galahad\Aire\Elements\Concerns;

/**
 * @property \Galahad\Aire\Elements\Attributes\Attributes $attributes
 */
trait MapsValueToJsonValue
{
	public function getJsonValue()
	{
		return $this->attributes->get('value');
	}
}
