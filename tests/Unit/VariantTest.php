<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Elements\Input;
use Galahad\Aire\Tests\TestCase;

class VariantTest extends TestCase
{
	protected function setUp() : void
	{
		parent::setUp();
		
		$config = $this->app['config'];
		
		$config->set('aire.default_classes.input', 'input');
		$config->set('aire.variant_classes.input.default', 'input-default');
		$config->set('aire.variant_classes.input.sm', 'input-sm');
		$config->set('aire.variant_classes.input.lg', 'input-lg');
	}
	
	public function test_the_default_variant_is_used_by_default_if_it_exists() : void
	{
		$this->assertSelectorClassNames($this->aire()->input(), 'input', ['input', 'input-default']);
		$this->assertSelectorMissingClassNames($this->aire()->checkbox(), 'input', 'input-default');
	}
	
	public function test_a_variant_overrides_the_default_variant_but_not_default_classes() : void
	{
		$small_input = $this->aire()->input()->variant('sm');
		$large_input = $this->aire()->input()->variant('lg');
		
		$this->assertSelectorClassNames($small_input, 'input', ['input', 'input-sm']);
		$this->assertSelectorMissingClassNames($small_input, 'input', ['input-lg', 'input-default']);
		
		$this->assertSelectorClassNames($large_input, 'input', ['input', 'input-lg']);
		$this->assertSelectorMissingClassNames($large_input, 'input', ['input-sm', 'input-default']);
	}
	
	public function test_variants_that_are_not_configured_are_ignored() : void
	{
		$input = $this->aire()->input()->variant('more cowbell');
		
		$this->assertSelectorClassNames($input, 'input', ['input']);
		$this->assertSelectorMissingClassNames($input, 'input', ['input-sm', 'input-lg', 'input-default']);
		
		$input = $this->aire()->input()->variant()->extraCowbell();
		
		$this->assertSelectorClassNames($input, 'input', ['input']);
		$this->assertSelectorMissingClassNames($input, 'input', ['input-sm', 'input-lg', 'input-default']);
	}
	
	public function test_variants_can_be_set_fluently() : void
	{
		$small_input = $this->aire()->input()->variant()->sm();
		$large_input = $this->aire()->input()->variant()->lg();
		
		$this->assertInstanceOf(Input::class, $small_input);
		$this->assertInstanceOf(Input::class, $large_input);
		
		$this->assertSelectorClassNames($small_input, 'input', ['input', 'input-sm']);
		$this->assertSelectorMissingClassNames($small_input, 'input', ['input-lg', 'input-default']);
		
		$this->assertSelectorClassNames($large_input, 'input', ['input', 'input-lg']);
		$this->assertSelectorMissingClassNames($large_input, 'input', ['input-sm', 'input-default']);
	}
}
