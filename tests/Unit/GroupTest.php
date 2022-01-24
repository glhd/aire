<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class GroupTest extends TestCase
{
	public function test_an_input_can_be_grouped(): void
	{
		$input = $this->aire()->input()->toHtml();
		
		$this->assertSelectorExists($input, 'div[data-aire-component="group"]');
		$this->assertSelectorExists($input, 'div > input[type="text"]');
	}
	
	public function test_an_input_can_be_ungrouped(): void
	{
		$input = $this->aire()->input()->withoutGroup()->toHtml();
		
		$this->assertSelectorDoesNotExist($input, 'div[data-aire-component="group"]');
		$this->assertSelectorExists($input, 'input[type="text"]');
	}
	
	public function test_an_element_that_is_not_grouped_by_default_can_be_grouped(): void
	{
		$button = $this->aire()->button()->grouped()->toHtml();
		
		$this->assertSelectorExists($button, 'div[data-aire-component="group"]');
	}
	
	public function test_a_group_can_have_a_label(): void
	{
		$input = $this->aire()
			->input('foo')
			->id('bar')
			->label('Foo Input')
			->toHtml();
		
		$this->assertSelectorTextEquals($input, 'div > label', 'Foo Input');
		$this->assertSelectorAttribute($input, 'div > label', 'for', 'bar');
	}
	
	public function test_setting_the_id_on_a_labelled_group_input_sets_for_tag_on_label(): void
	{
		$input = $this->aire()
			->input()
			->label('Foo Input');
		
		$this->assertSelectorAttributeIsNot($input->toHtml(), 'div > label', 'for', 'bar');
		
		$input->id('bar');
		
		$this->assertSelectorAttribute($input->toHtml(), 'div > label', 'for', 'bar');
	}
	
	public function test_a_group_can_have_help_text(): void
	{
		$input = $this->aire()
			->input()
			->helpText('Help text')
			->toHtml();
		
		$this->assertSelectorTextEquals($input, 'div > small', 'Help text');
	}
	
	public function test_a_group_can_have_errors(): void
	{
		$html = $this->aire()->input()->errors('Error message')->toHtml();
		
		$this->assertSelectorExists($html, '[data-aire-component="errors"]');
		$this->assertSelectorTextEquals($html, '[data-aire-component="errors"] li', 'Error message');
	}
	
	public function test_a_group_can_have_content_prepended(): void
	{
		$html = $this->aire()->input()->prepend('Foo')->toHtml();
		
		$this->assertSelectorTextEquals($html, '[data-aire-component="group"] .flex .rounded-l-sm', 'Foo');
	}
	
	public function test_a_group_can_have_content_appended(): void
	{
		$html = $this->aire()->input()->append('Foo')->toHtml();
		
		$this->assertSelectorTextEquals($html, '[data-aire-component="group"] .flex .rounded-r-sm', 'Foo');
	}
	
	public function test_group_methods_can_be_called_on_the_element(): void
	{
		$test_value = Str::random();
		
		$html = $this->aire()->input()->groupData('foo', $test_value);
		
		$this->assertSelectorAttribute($html, '[data-aire-component=group]', 'data-foo', $test_value);
	}
}
