<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class DataAttributesTest extends TestCase
{
	public function test_data_attributes_can_be_set(): void
	{
		$form = $this->aire()->form();
		
		$form->data('foo', 'bar');
		
		$this->assertSelectorAttribute($form, 'form', 'data-foo', 'bar');
	}
	
	public function test_data_attributes_can_be_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->data('foo', 'bar');
		$form->data('foo', null);
		
		$this->assertSelectorAttributeMissing($form, 'form', 'data-foo');
	}
	
	public function test_jsonable_data_is_serialized(): void
	{
		$data = new class() implements Jsonable {
			public function toJson($options = 0)
			{
				return '{"foo":"bar"}';
			}
		};
		
		$form = $this->aire()->form()->data('foo', $data);
		
		$this->assertSelectorAttribute($form, 'form', 'data-foo', '{"foo":"bar"}');
	}
	
	public function test_json_serializable_data_is_serialized(): void
	{
		$data = new class() implements JsonSerializable {
			public function jsonSerialize()
			{
				return ['foo' => 'bar'];
			}
		};
		
		$form = $this->aire()->form()->data('foo', $data);
		
		$this->assertSelectorAttribute($form, 'form', 'data-foo', '{"foo":"bar"}');
	}
	
	public function test_array_data_is_serialized(): void
	{
		$data = ['foo' => 'bar'];
		
		$form = $this->aire()->form()->data('foo', $data);
		
		$this->assertSelectorAttribute($form, 'form', 'data-foo', '{"foo":"bar"}');
	}
	
	public function test_arrayable_data_is_serialized(): void
	{
		$data = new class() implements Arrayable {
			public function toArray()
			{
				return ['foo' => 'bar'];
			}
		};
		
		$form = $this->aire()->form()->data('foo', $data);
		
		$this->assertSelectorAttribute($form, 'form', 'data-foo', '{"foo":"bar"}');
	}
}
