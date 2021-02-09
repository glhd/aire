<?php

namespace Galahad\Aire\Contracts;

interface HasJsonValue
{
	/**
	 * Get the value that should be used if this form element were serialized to JSON
	 *
	 * @return mixed
	 */
	public function getJsonValue();
}
