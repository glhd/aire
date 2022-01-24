<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class ClassNamesTest extends TestCase
{
	protected function setUp(): void
	{
		parent::setUp();
		
		$config = $this->app['config'];
		
		$config->set('aire.default_classes.input', 'input-default');
		$config->set('aire.validation_classes.none.input', 'no-validation');
		$config->set('aire.validation_classes.valid.input', 'is-valid');
		$config->set('aire.validation_classes.invalid.input', 'is-invalid');
	}
	
	public function test_class_names_can_export_a_final_list_of_classes(): void
	{
		$class_names = $this->aire()->input()->valid()->attributes->primary()->class;
		
		$class_names->add('added-1', 'added-2');
		$class_names->remove('added-2');
		
		$this->assertEmpty(array_diff([
			'is-valid',
			'input-default',
			'added-1',
		], $class_names->all()));
	}
	
	public function test_the_has_method_includes_validation_and_respects_removals(): void
	{
		$class_names = $this->aire()->input()->valid()->attributes->primary()->class;
		
		$class_names->add('added-1', 'added-2');
		$class_names->remove('added-2');
		
		$this->assertTrue($class_names->has('is-valid'));
		$this->assertTrue($class_names->has('input-default'));
		$this->assertTrue($class_names->has('added-1'));
		$this->assertFalse($class_names->has('added-2'));
		$this->assertFalse($class_names->has('no-validation'));
		$this->assertFalse($class_names->has('is-invalid'));
		$this->assertFalse($class_names->has(Str::random()));
	}
	
	public function test_default_classes_are_applied_by_default(): void
	{
		$input = $this->aire()->input();
		
		$this->assertSelectorClassNames($input, 'input', 'input-default');
	}
	
	public function test_no_validation_classes_are_applied_when_field_is_not_validated(): void
	{
		$input = $this->aire()->input();
		
		$this->assertSelectorClassNames($input, 'input', 'no-validation');
		$this->assertSelectorMissingClassNames($input, 'input', 'is-valid');
		$this->assertSelectorMissingClassNames($input, 'input', 'is-invalid');
	}
	
	public function test_valid_classes_are_applied_when_field_is_valid(): void
	{
		$input = $this->aire()->input()->valid();
		
		$this->assertSelectorClassNames($input, 'input', 'is-valid');
		$this->assertSelectorMissingClassNames($input, 'input', 'no-validation');
		$this->assertSelectorMissingClassNames($input, 'input', 'is-invalid');
	}
	
	public function test_invalid_classes_are_applied_when_field_is_invalid(): void
	{
		$input = $this->aire()->input()->invalid();
		
		$this->assertSelectorClassNames($input, 'input', 'is-invalid');
		$this->assertSelectorMissingClassNames($input, 'input', 'no-validation');
		$this->assertSelectorMissingClassNames($input, 'input', 'is-valid');
	}
}
