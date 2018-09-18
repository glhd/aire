<?php

namespace Galahad\Aire\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Aire extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'galahad.aire';
	}
}
