<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class OldInputTest extends TestCase
{
	public function test_old_input_is_used_by_default(): void
	{
		$this->withSession([
			'_old_input' => [
				'foo' => 'bar',
			],
		]);
		
		$input = $this->aire()
			->form()
			->input('foo')
			->defaultValue('not bar');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'bar');
	}
	
	public function test_old_input_supercedes_bound_data(): void
	{
		$this->withSession([
			'_old_input' => [
				'foo' => 'bar',
			],
		]);
		
		$input = $this->aire()
			->form()
			->bind(['foo' => 'definitely not bar'])
			->input('foo')
			->defaultValue('also not bar');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'bar');
	}
	
	public function test_old_input_is_preserved_even_if_it_is_a_blank_string(): void
	{
		$this->withSession([
			'_old_input' => [
				'foo' => null,
			],
		]);
		
		$input = $this->aire()
			->form()
			->bind(['foo' => 'definitely not bar'])
			->input('foo')
			->defaultValue('also not bar');
		
		$this->assertSelectorAttribute($input, 'input', 'value', '');
	}
	
	public function test_explicit_value_supercedes_old_input(): void
	{
		$this->withSession([
			'_old_input' => [
				'foo' => 'bar',
			],
		]);
		
		$input = $this->aire()
			->form()
			->input('foo')
			->value('baz')
			->defaultValue('not baz');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'baz');
	}

	public function test_nested_old_input_can_be_accessed(): void
	{
		$this->withSession([
			'_old_input' => [
				'foo' => ['bar' => ['baz' => 'foo-bar-baz']],
			],
		]);

		$input = $this->aire()
			->form()
			->input('foo[bar][baz]');

		$this->assertSelectorAttribute($input, 'input', 'value', 'foo-bar-baz');
	}
}
