<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class CheckboxTest extends TestCase
{
	public function test_setting_value_does_not_affect_checked_state(): void
	{
		$html = $this->aire()->checkbox()->value('bar');
		
		$this->assertSelectorAttribute($html, 'input[type="checkbox"]', 'value', 'bar');
		$this->assertSelectorAttributeMissing($html, 'input[type="checkbox"]', 'checked');
	}
	
	public function test_a_checkbox_can_default_to_checked(): void
	{
		$html = $this->aire()->checkbox()->defaultChecked();
		
		$this->assertSelectorAttribute($html, 'input[type="checkbox"]', 'checked');
	}
	
	public function test_checkbox_labels_are_shown_inline(): void
	{
		$html = $this->aire()->checkbox()->label('Foo');
		
		$this->assertSelectorExists($html, '[data-aire-component="group"] label input[type="checkbox"]');
		$this->assertSelectorContainsText($html, '[data-aire-component="group"] label', 'Foo');
	}
	
	public function test_inline_label_uses_for_attribute_if_id_is_set(): void
	{
		$html = $this->aire()->checkbox()->label('Foo')->id('bar');
		
		$this->assertSelectorExists($html, '[data-aire-component="group"] label[for="bar"] input[type="checkbox"]');
	}
	
	public function test_bound_integer_sets_checked_attribute(): void
	{
		$this->aire()->form()->bind(['foo' => 1]);
		
		$input = $this->aire()->checkbox('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'checked');
	}
	
	public function test_bound_boolean_sets_checked_attribute(): void
	{
		$this->aire()->form()->bind(['foo' => true]);
		
		$input = $this->aire()->checkbox('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'checked');
	}
	
	public function test_bound_data_unsets_default_checked_state(): void
	{
		$this->aire()->form()->bind([]);
		
		$input = $this->aire()->checkbox('foo')->defaultChecked();
		
		$this->assertSelectorAttributeMissing($input, 'input', 'checked');
	}
}
