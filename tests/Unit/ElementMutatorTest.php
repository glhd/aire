<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Elements\Checkbox;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class ElementMutatorTest extends TestCase
{
	public function test_an_element_can_have_defaults_changed_through_initializers(): void
	{
		$test_value = Str::random();
		
		// First make sure the default rendering of the element doesn't have our attribute
		$checkbox = $this->aire()->checkbox();
		$this->assertSelectorAttributeMissing($checkbox, 'input', 'data-mutated');
		
		// Now register a mutator
		Checkbox::registerElementMutator(function(Checkbox $checkbox) use ($test_value) {
			$checkbox->attributes->setDefault('data-mutated', $test_value);
		});
		
		// Now the element should have out mutated state
		$checkbox = $this->aire()->checkbox();
		$this->assertSelectorAttribute($checkbox, 'input[type="checkbox"]', 'data-mutated', $test_value);
		
		// If we set the attribute ourselves, this should take precedence
		$checkbox = $this->aire()->checkbox()->setAttribute('data-mutated', 'custom value');
		$this->assertSelectorAttribute($checkbox, 'input[type="checkbox"]', 'data-mutated', 'custom value');
		
		// Make sure the mutator was only applied to the Checkbox element
		$input = $this->aire()->input();
		$this->assertSelectorAttributeMissing($input, 'input', 'data-mutated');
	}
}
