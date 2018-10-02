<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class ConfiguredClassesTest extends TestCase
{
	protected function setUp()
	{
		parent::setUp();
		
		$config = $this->app['config'];
		
		$config->set('aire.default_classes.input', 'input-default');
		$config->set('aire.validation_classes.none.input', 'no-validation');
		$config->set('aire.validation_classes.valid.input', 'is-valid');
		$config->set('aire.validation_classes.invalid.input', 'is-invalid');
	}
	
	public function test_default_classes_can_be_set() : void
	{
		$input = $this->aire()->input();
		
		$this->assertSelectorClassNames($input, 'input', 'input-default');
	}
	
	public function test_no_validation_classes_are_applied_when_field_is_not_validated() : void
	{
		$input = $this->aire()->input();
		
		$this->assertSelectorClassNames($input, 'input', 'no-validation');
		$this->assertSelectorMissingClassNames($input, 'input', 'is-valid');
		$this->assertSelectorMissingClassNames($input, 'input', 'is-invalid');
	}
	
	public function test_valid_classes_are_applied_when_field_is_valid() : void
	{
		$input = $this->aire()->input()->valid();
		
		$this->assertSelectorClassNames($input, 'input', 'is-valid');
		$this->assertSelectorMissingClassNames($input, 'input', 'no-validation');
		$this->assertSelectorMissingClassNames($input, 'input', 'is-invalid');
	}
	
	public function test_invalid_classes_are_applied_when_field_is_invalid() : void
	{
		$input = $this->aire()->input()->invalid();
		
		$this->assertSelectorClassNames($input, 'input', 'is-invalid');
		$this->assertSelectorMissingClassNames($input, 'input', 'no-validation');
		$this->assertSelectorMissingClassNames($input, 'input', 'is-valid');
	}
}
