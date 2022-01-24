<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Elements\Attributes\Attributes;
use Galahad\Aire\Elements\Attributes\ClassNames;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class AttributesTest extends TestCase
{
	public function test_method_based_api(): void
	{
		$attributes = new Attributes();
		
		$this->assertFalse($attributes->has('foo'));
		
		$attributes->set('foo', 'bar');
		
		$this->assertTrue($attributes->has('foo'));
		$this->assertEquals('bar', $attributes->get('foo'));
		
		$attributes->unset('foo');
		
		$this->assertFalse($attributes->has('foo'));
	}
	
	public function test_array_access_api(): void
	{
		$attributes = new Attributes();
		
		$this->assertFalse(isset($attributes['foo']));
		
		$attributes['foo'] = 'bar';
		
		$this->assertTrue(isset($attributes['foo']));
		$this->assertEquals('bar', $attributes['foo']);
		
		unset($attributes['foo']);
		
		$this->assertFalse(isset($attributes['foo']));
	}
	
	public function test_magic_api(): void
	{
		$attributes = new Attributes();
		
		$this->assertFalse(isset($attributes->foo));
		
		$attributes->foo = 'bar';
		
		$this->assertTrue(isset($attributes->foo));
		$this->assertEquals('bar', $attributes->foo);
		
		unset($attributes->foo);
		
		$this->assertFalse(isset($attributes->foo));
	}
	
	public function test_default_values(): void
	{
		$attributes = new Attributes();
		
		$attributes->setDefault('foo', 'default-bar');
		
		$this->assertFalse($attributes->has('foo'));
		$this->assertEquals('default-bar', $attributes->get('foo'));
		
		$attributes->set('foo', 'bar');
		
		$this->assertTrue($attributes->has('foo'));
		$this->assertEquals('bar', $attributes->get('foo'));
		
		$attributes->unset('foo', 'bar');
		
		$this->assertFalse($attributes->has('foo'));
		$this->assertEquals('default-bar', $attributes->get('foo'));
	}
	
	public function test_mutators(): void
	{
		$attributes = new Attributes();
		
		$attributes->set('foo', 'bar');
		
		$this->assertEquals('bar', $attributes->get('foo'));
		
		$attributes->registerMutator('foo', function($foo) {
			return strtoupper($foo);
		});
		
		$this->assertEquals('BAR', $attributes->get('foo'));
	}
	
	public function test_multiple_mutators(): void
	{
		$attributes = new Attributes();
		
		$attributes->set('foo', 'bar');
		$attributes->set('baz', 'buzz');
		
		$this->assertEquals('bar', $attributes->get('foo'));
		$this->assertEquals('buzz', $attributes->get('baz'));
		
		$attributes->registerMutator(['foo', 'baz'], function($foo) {
			return strtoupper($foo);
		});
		
		$this->assertEquals('BAR', $attributes->get('foo'));
		$this->assertEquals('BUZZ', $attributes->get('baz'));
	}
	
	public function test_class_name_mutator_can_return_null(): void
	{
		$attributes = new Attributes([
			'class' => new ClassNames(''),
		]);
		
		$attributes->registerMutator('class', function(ClassNames $class_names) {
			$class_names->add('mutated');
		});
		
		$this->assertInstanceOf(ClassNames::class, $attributes->class);
		$this->assertEquals('mutated', $attributes->get('class'));
	}
	
	public function test_value_equality_helper(): void
	{
		$attributes = new Attributes();
		
		$attributes->set('value', 'foo');
		
		$this->assertTrue($attributes->isValue('foo'));
		$this->assertFalse($attributes->isValue('bar'));
		$this->assertFalse($attributes->isValue(1));
		
		$attributes->set('value', ['foo', 'bar', 2]);
		
		$this->assertTrue($attributes->isValue('foo'));
		$this->assertTrue($attributes->isValue('bar'));
		$this->assertTrue($attributes->isValue(2));
		$this->assertTrue($attributes->isValue('2'));
		$this->assertFalse($attributes->isValue('baz'));
		$this->assertFalse($attributes->isValue(1));
		
		$attributes->set('value', collect(['foo', 'bar', 2]));
		
		$this->assertTrue($attributes->isValue('foo'));
		$this->assertTrue($attributes->isValue('bar'));
		$this->assertTrue($attributes->isValue(2));
		$this->assertTrue($attributes->isValue('2'));
		$this->assertFalse($attributes->isValue('baz'));
		$this->assertFalse($attributes->isValue(1));
	}
	
	public function test_basic_html_rendering(): void
	{
		$attributes = new Attributes([
			'hello' => 'world',
			'quotes' => '"yes"',
		]);
		
		$this->assertEquals('hello="world" quotes="&quot;yes&quot;"', $attributes->toHtml());
	}
	
	public function test_empty_classes_are_excluded_from_attribute_rendering(): void
	{
		$attributes = new Attributes([
			'hello' => 'world',
			'class' => '',
		]);
		
		$this->assertEquals('hello="world"', $attributes->toHtml());
	}
	
	public function test_false_and_null_attributes_are_excluded_from_rendering(): void
	{
		$attributes = new Attributes([
			'hello' => 'world',
			'foo' => false,
			'bar' => null,
		]);
		
		$this->assertEquals('hello="world"', $attributes->toHtml());
	}
	
	public function test_array_attributes_are_excluded_from_rendering(): void
	{
		// Arrays need to be handled specially, so they should be
		// excluded from the HTML string generated for attributes
		
		$attributes = new Attributes([
			'hello' => 'world',
			'foo' => ['bar', 'baz'],
		]);
		
		$this->assertEquals('hello="world"', $attributes->toHtml());
	}
	
	public function test_attribute_names_are_lowercase(): void
	{
		$attributes = new Attributes([
			'HELLO' => 'WORLD',
		]);
		
		$this->assertEquals('hello="WORLD"', $attributes->toHtml());
	}
	
	public function test_boolean_value_attributes_are_represented_with_1_and_0(): void
	{
		$attributes = new Attributes();
		
		$attributes->set('value', true);
		$this->assertEquals('value="1"', $attributes->toHtml());
		
		$attributes->set('value', false);
		$this->assertEquals('value="0"', $attributes->toHtml());
	}
	
	public function test_boolean_attributes_are_represented_without_a_value(): void
	{
		$attributes = new Attributes([
			'hello' => 'world',
			'foo' => false,
			'bar' => true,
		]);
		
		$this->assertEquals('hello="world" bar', $attributes->toHtml());
	}
	
	public function test_casting_attributes_to_an_array(): void
	{
		$attributes = new Attributes([
			'foo' => 'bar',
			'hello' => 'world',
		]);
		
		// Casting to array should include default values
		$attributes->setDefault('bar', 'baz');
		
		// Casting to array should also apply mutations
		$attributes->registerMutator('hello', function($value) {
			return strtoupper($value);
		});
		
		$expected = [
			'foo' => 'bar',
			'bar' => 'baz',
			'hello' => 'WORLD',
		];
		
		$this->assertEquals($expected, $attributes->toArray());
	}
	
	public function test_attributes_can_be_excluded_immutably(): void
	{
		$attributes = new Attributes([
			'foo' => 'bar',
			'hello' => 'world',
			'wow' => true,
		]);
		
		$attributes->setDefault('bar', 'baz');
		$attributes->registerMutator('hello', function($value) {
			return strtoupper($value);
		});
		
		$excluded = $attributes->except('foo');
		
		$expected_in_excluded = [
			'wow' => true,
			'bar' => 'baz',
			'hello' => 'WORLD',
		];
		
		$this->assertEquals($expected_in_excluded, $excluded->toArray());
		
		$expected_in_original = [
			'foo' => 'bar',
			'wow' => true,
			'bar' => 'baz',
			'hello' => 'WORLD',
		];
		
		$this->assertEquals($expected_in_original, $attributes->toArray());
	}
	
	public function test_attributes_can_be_isolated_immutably(): void
	{
		$attributes = new Attributes([
			'foo' => 'bar',
			'hello' => 'world',
			'wow' => true,
		]);
		
		$attributes->setDefault('bar', 'baz');
		$attributes->registerMutator('hello', function($value) {
			return strtoupper($value);
		});
		
		$isolated = $attributes->only('foo', 'bar', 'hello');
		
		$expected_in_isolated = [
			'foo' => 'bar',
			'bar' => 'baz',
			'hello' => 'WORLD',
		];
		
		$this->assertEquals($expected_in_isolated, $isolated->toArray());
		
		$expected_in_original = [
			'foo' => 'bar',
			'wow' => true,
			'bar' => 'baz',
			'hello' => 'WORLD',
		];
		
		$this->assertEquals($expected_in_original, $attributes->toArray());
	}
	
	public function test_default_can_be_set_using_a_closure(): void
	{
		$random_value = Str::random();
		
		$attributes = new Attributes();
		$attributes->setDefault('value', function() use ($random_value) {
			return $random_value;
		});
		
		$this->assertEquals($random_value, $attributes->get('value'));
	}
	
	public function test_default_value_cannot_be_injected_with_a_global_function_call(): void
	{
		require_once __DIR__.'/global-function-stub.php';
		
		$attributes = new Attributes();
		$attributes->setDefault('value', 'aire_test_global_function');
		
		$this->assertEquals('aire_test_global_function', $attributes->get('value'));
	}
}
