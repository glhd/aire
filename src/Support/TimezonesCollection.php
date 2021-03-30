<?php

namespace Galahad\Aire\Support;

use DateTimeZone;
use Illuminate\Support\Collection;

class TimezonesCollection extends Collection
{
	public function __construct()
	{
		parent::__construct(
			collect(DateTimeZone::listIdentifiers())
				->mapWithKeys(function($timezone) {
					$label = str_replace(['/', '_'], [' - ', ' '], $timezone);
					return [$timezone => $label];
				})
		);
	}
}
