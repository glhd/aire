<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Elements\Input;
use Galahad\Aire\Tests\TestCase;

class VariantTest extends TestCase
{
	protected function setUp(): void
	{
		parent::setUp();
		
		$config = $this->app['config'];
		
		$config->set('aire.default_classes.input', 'input');
		$config->set('aire.variant_classes.input.default', 'input-default');
		$config->set('aire.variant_classes.input.sm', 'input-sm');
		$config->set('aire.variant_classes.input.lg', 'input-lg');
	}
	
	public function test_the_default_variant_is_used_by_default_if_it_exists(): void
	{
		$this->assertSelectorClassNames($this->aire()->input(), 'input', ['input', 'input-default']);
	}
	
	public function test_a_variant_overrides_the_default_variant_but_not_default_classes(): void
	{
		$small_input = $this->aire()->input()->variant('sm');
		$large_input = $this->aire()->input()->variant('lg');
		
		$this->assertSelectorClassNames($small_input, 'input', ['input', 'input-sm', 'input-default']);
		$this->assertSelectorMissingClassNames($small_input, 'input', ['input-lg']);
		
		$this->assertSelectorClassNames($large_input, 'input', ['input', 'input-lg', 'input-default']);
		$this->assertSelectorMissingClassNames($large_input, 'input', ['input-sm']);
	}
	
	public function test_variants_that_are_not_configured_are_ignored(): void
	{
		$input = $this->aire()->input()->variant('more cowbell');
		
		$this->assertSelectorClassNames($input, 'input', ['input']);
		$this->assertSelectorMissingClassNames($input, 'input', ['input-sm', 'input-lg']);
		
		$input = $this->aire()->input()->variant()->extraCowbell();
		
		$this->assertSelectorClassNames($input, 'input', ['input']);
		$this->assertSelectorMissingClassNames($input, 'input', ['input-sm', 'input-lg']);
	}
	
	public function test_variants_can_be_set_fluently(): void
	{
		$small_input = $this->aire()->input()->variant()->sm();
		$large_input = $this->aire()->input()->variant()->lg();
		
		$this->assertInstanceOf(Input::class, $small_input);
		$this->assertInstanceOf(Input::class, $large_input);
		
		$this->assertSelectorClassNames($small_input, 'input', ['input', 'input-sm', 'input-default']);
		$this->assertSelectorMissingClassNames($small_input, 'input', 'input-lg');
		
		$this->assertSelectorClassNames($large_input, 'input', ['input', 'input-lg', 'input-default']);
		$this->assertSelectorMissingClassNames($large_input, 'input', 'input-sm');
	}
	
	public function test_variants_are_applied_to_all_attributes_in_the_element(): void
	{
		$this->app['config']->set('aire.variant_classes.group.sm', 'group-sm');
		$this->app['config']->set('aire.variant_classes.group_help_text.sm', 'help-text-sm');
		$this->app->forgetInstance('galahad.aire');
		
		$input = $this->aire()->input()->helpText('help text')->variant()->sm();
		
		$this->assertSelectorClassNames($input, '[data-aire-component=group]', 'group-sm');
		$this->assertSelectorClassNames($input, 'input', 'input-sm');
		$this->assertSelectorClassNames($input, '[data-aire-component=help_text]', 'help-text-sm');
	}
	
	public function test_variants_can_be_combined(): void
	{
		$input = $this->aire()->input()->variant(['default', 'sm']);
		
		$this->assertSelectorClassNames($input, 'input', ['input', 'input-sm', 'input-default']);
		$this->assertSelectorMissingClassNames($input, 'input', 'input-lg');
		
		$input = $this->aire()->input()->variants('default', 'sm');
		
		$this->assertSelectorClassNames($input, 'input', ['input', 'input-sm', 'input-default']);
		$this->assertSelectorMissingClassNames($input, 'input', 'input-lg');
	}
	
	public function test_variants_can_be_combined_and_partially_merged(): void
	{
		$config = $this->app['config'];
		
		$config->set('aire.default_classes', [
			'input' => 'input-default-class',
		]);
		
		$config->set('aire.variant_classes', [
			'input' => [
				'default' => [
					'size' => 'input-default-variant-size',
					'color' => 'input-default-variant-color',
				],
				'not-nested' => 'input-not-nested-variant',
				'sm' => [
					'size' => 'input-sm-variant-size',
				],
				'blue' => [
					'color' => 'input-blue-variant-color',
				],
				'special' => [
					'size' => 'input-special-variant-size',
					'color' => 'input-special-variant-color',
				],
			],
		]);
		
		$this->app->forgetInstance('galahad.aire');
		
		// Default case
		$input = $this->aire()->input();
		$this->assertSelectorClassNames($input, 'input', ['input-default-class', 'input-default-variant-size', 'input-default-variant-color']);
		
		// Add "sm" to default
		$input = $this->aire()->input()->variant()->sm();
		$this->assertSelectorClassNames($input, 'input', ['input-default-class', 'input-sm-variant-size', 'input-default-variant-color']);
		$this->assertSelectorMissingClassNames($input, 'input', ['input-default-variant-size']);
		
		// Add "blue" to default
		$input = $this->aire()->input()->variant('blue');
		$this->assertSelectorClassNames($input, 'input', ['input-default-class', 'input-default-variant-size', 'input-blue-variant-color']);
		$this->assertSelectorMissingClassNames($input, 'input', ['input-default-variant-color']);
		
		// Combined
		$input = $this->aire()->input()->variants('sm', 'blue');
		$this->assertSelectorClassNames($input, 'input', ['input-default-class', 'input-sm-variant-size', 'input-blue-variant-color']);
		$this->assertSelectorMissingClassNames($input, 'input', ['input-default-variant-size', 'input-default-variant-color']);
		
		// Variant that override all default keys
		$input = $this->aire()->input()->variant('special');
		$this->assertSelectorClassNames($input, 'input', ['input-default-class', 'input-special-variant-size', 'input-special-variant-color']);
		$this->assertSelectorMissingClassNames($input, 'input', ['input-default-variant-size', 'input-default-variant-color']);
		
		// Non-Nested Variant
		$input = $this->aire()->input()->variant('not-nested');
		$this->assertSelectorClassNames($input, 'input', [
			'input-default-class',
			'input-default-variant-size',
			'input-default-variant-color',
			'input-not-nested-variant',
		]);
	}
}
