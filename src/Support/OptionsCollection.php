<?php

namespace Galahad\Aire\Support;

use Galahad\Aire\Contracts\SelectableEntity;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use JsonSerializable;
use Traversable;

class OptionsCollection extends Collection
{
	public function getOptions() : array
	{
		return $this
			->mapWithKeys(function($option, $key) {
				if ($option instanceof SelectableEntity) {
					return [$option->getSelectableValue() => $option->getSelectableLabel()];
				}
				return [$key => $option];
			})
			->toArray();
	}
	
	protected function getArrayableItems($items)
	{
		if (is_string($items) && is_subclass_of($items, '\\BenSampo\\Enum\\Enum')) {
			$items = forward_static_call([$items, 'toSelectArray']);
		}
		
		return parent::getArrayableItems($items);
	}
}
