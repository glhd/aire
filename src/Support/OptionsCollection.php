<?php

namespace Galahad\Aire\Support;

use BackedEnum;
use Galahad\Aire\Contracts\SelectableEntity;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use UnitEnum;

class OptionsCollection extends Collection
{
	public function getOptions(): array
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
		if (is_string($items)) {
			if (is_subclass_of($items, '\\BenSampo\\Enum\\Enum')) {
				if (method_exists($items, 'asSelectArray')) {
					$items = forward_static_call([$items, 'asSelectArray']);
				} elseif (method_exists($items, 'toSelectArray')) {
					$items = forward_static_call([$items, 'toSelectArray']);
				}
			} elseif (is_subclass_of($items, UnitEnum::class)) {
				$items = collect($items::cases())->mapWithKeys(function(UnitEnum $case) {
					$label = method_exists($case, 'description')
						? $case->description()
						: Str::headline($case->name);
					
					if ($case instanceof BackedEnum) {
						return [$case->value => $label];
					}
					
					return [$case->name => $label];
				});
			}
		}
		
		return parent::getArrayableItems($items);
	}
}
