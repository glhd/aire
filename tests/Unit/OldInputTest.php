<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class OldInputTest extends TestCase
{
	public function test_old_input_is_used_by_default() : void
	{
		$this->withSession([
			'_old_input' => [
				'foo' => 'bar',
			],
		]);
		
		$input = $this->aire()
			->form()
			->input('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'bar');
	}
	
	public function test_old_input_supercedes_bound_data() : void
	{
		$this->withSession([
			'_old_input' => [
				'foo' => 'bar',
			],
		]);
		
		$input = $this->aire()
			->form()
			->bind(['foo' => 'definitely not bar'])
			->input('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'bar');
	}
	
	public function test_explicit_value_supercedes_old_input() : void
	{
		$this->withSession([
			'_old_input' => [
				'foo' => 'bar',
			],
		]);
		
		$input = $this->aire()
			->form()
			->input('foo')
			->value('baz');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'baz');
	}
}
