<?php

namespace Galahad\Aire\Support;

use Galahad\Aire\Contracts\SelectableEntity;
use Illuminate\Support\Collection;

class OptionsCollection extends Collection
{
	public function getOptions() : array
	{
		return $this
			->mapWithKeys(function($option, $key) {
				if ($option instanceof SelectableEntity) {
					return [$option->getSelectableId() => $option->getSelectableLabel()];
				}
				return [$key => $option];
			})
			->toArray();
	}
}
