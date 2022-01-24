<?php

namespace Galahad\Aire\Tests\Components;

use Illuminate\Support\Str;

abstract class InputTypeTestCase extends ComponentTestCase
{
	public function test_it_sets_input_type(): void
	{
		$type = $this->inputType();
		$input = $this->renderBlade('<x-aire::'.$type.' />');
		$this->assertSelectorAttribute($input, 'input', 'type', $type);
	}
	
	protected function inputType()
	{
		return Str::of(static::class)
			->afterLast('\\')
			->before('Test')
			->lower();
	}
}
