<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Input;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class MacroTest extends TestCase
{
	public function test_macros_are_applied() : void
	{
		$test_value = Str::random();
		
		Element::macro('macroTest', function() use ($test_value) {
			/** @var Element $this */
			$this->attributes->set('x:macro-test', $test_value);
			return $this;
		});
		
		$this->assertSelectorAttribute($this->aire()->input()->macroTest(), 'input', 'x:macro-test', $test_value);
	}
	
	public function test_group_methods_are_applied_before_macros() : void
	{
		$test_value = Str::random();
		
		Element::macro('groupAddClass', function() use ($test_value) {
			throw new \RuntimeException('Cannot macro groupAddClass');
		});
		
		$this->assertSelectorAttribute($this->aire()->input()->macroTest(), 'input', 'x:macro-test', $test_value);
	}
}
