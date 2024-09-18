<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

class DataBindingTest extends TestCase
{
	public function test_an_eloquent_model_can_be_bound_to_the_form(): void
	{
		$model = new ModelStub(['foo' => 'bar']);
		
		$this->aire()->form()->bind($model);
		
		$input = $this->aire()->input('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'bar');
	}
	
	public function test_an_array_can_be_bound_to_the_form(): void
	{
		$this->aire()->form()->bind(['foo' => 'bar']);
		
		$input = $this->aire()->input('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'bar');
	}
	
	public function test_an_object_can_be_bound_to_the_form(): void
	{
		$this->aire()->form()->bind((object) ['foo' => 'bar']);
		
		$input = $this->aire()->input('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'bar');
	}
	
	public function test_setting_a_fields_name_binds_value(): void
	{
		$input = $this->aire()
			->form()
			->bind(['foo' => 'bar'])
			->input();
		
		$this->assertSelectorAttributeMissing($input, 'input', 'value');
		
		$input->name('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'bar');
	}
	
	public function test_datetime_objects_are_bound_to_date_inputs_in_proper_format(): void
	{
		$now = now();
		
		$input = $this->aire()
			->form()
			->bind(['foo' => $now])
			->date('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'value', $now->format('Y-m-d'));
	}
	
	public function test_datetime_objects_are_bound_to_datetime_local_inputs_in_proper_format(): void
	{
		$now = now();
		
		$input = $this->aire()
			->form()
			->bind(['foo' => $now])
			->dateTimeLocal('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'value', $now->format('Y-m-d\TH:i'));
	}
	
	public function test_multiple_values_can_be_bound_to_a_multi_select(): void
	{
		$options = [
			'foo' => 'Foo',
			'bar' => 'Bar',
			'baz' => 'Baz',
		];
		
		$select = $this->aire()
			->form()
			->bind(['test' => ['bar', 'baz']])
			->select($options, 'test')
			->multiple();
		
		$this->assertSelectorAttribute($select, 'select', 'name', 'test[]');
		$this->assertSelectorAttributeMissing($select, 'option[value="foo"]', 'selected');
		$this->assertSelectorAttribute($select, 'option[value="bar"]', 'selected');
		$this->assertSelectorAttribute($select, 'option[value="baz"]', 'selected');
	}
	
	public function test_backed_enums_are_bound_propery(): void
	{
		if (
			version_compare(PHP_VERSION, '8.1.0', '<')
			|| version_compare($this->app->version(), '8.69.0', '<')
		) {
			$this->markTestSkipped('Only applies to PHP 8.1/Laravel 8.69 and higher.');
		}
		
		require_once __DIR__.'/enum-stubs.php';
		
		$model = new EnumModelStub(['name' => 'inxilpro']);
		
		$this->assertEquals(Names::ChrisMorrell, $model->name);
		
		$this->aire()->form()->bind($model);
		
		$input = $this->aire()->input('name');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'inxilpro');
	}
	
	public function test_bound_data_with_square_brackets_is_supported(): void
	{
		$form = $this->aire()->form();
		
		$form->bind(['foo' => ['bar' => 'baz']]);
		
		$this->assertEquals('baz', $form->getBoundValue('foo[bar]'));
		$this->assertEquals('baz', $form->getBoundValue('foo.bar'));
	}
}

class ModelStub extends Model
{
	protected $guarded = [];
}
