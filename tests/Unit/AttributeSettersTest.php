<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class AttributeSettersTest extends TestCase
{
	public function test_an_attribute_can_be_set_fluently(): void
	{
		$input = $this->aire()->input()->setAttribute('name', 'my-name');
		
		$this->assertSelectorAttribute($input, 'input', 'name', 'my-name');
	}
	
	public function test_a_class_can_be_added_to_an_element_fluently(): void
	{
		$input = $this->aire()->input()->addClass('foo', 'bar');
		
		$this->assertSelectorClassNames($input, 'input', ['bar', 'foo']);
	}
	
	public function test_a_class_can_be_removed_from_an_element_fluently(): void
	{
		$this->app['config']->set('aire.default_classes.input', 'class1 class2 class3');
		
		$input = $this->aire()->input()->removeClass('class2');
		
		$this->assertSelectorClassNames($input, 'input', ['class1', 'class3']);
		$this->assertSelectorMissingClassNames($input, 'input', 'class2');
	}
}
