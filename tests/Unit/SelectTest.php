<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class SelectTest extends TestCase
{
	public function test_an_associative_array_maps_to_value_and_label() : void
	{
		$options = [
			'coates' => 'Ta-Nehisi Coates',
			'roth' => 'Philip Roth',
			'patchett' => 'Ann Patchett',
		];
		
		$html = $this->aire()->select($options)->render();
		
		$this->assertSelectorTextEquals($html, 'option[value="coates"]', 'Ta-Nehisi Coates');
		$this->assertSelectorTextEquals($html, 'option[value="roth"]', 'Philip Roth');
		$this->assertSelectorTextEquals($html, 'option[value="patchett"]', 'Ann Patchett');
	}
	
	public function test_a_zero_index_non_associative_array_maps_value_index() : void
	{
		$options = [
			0 => 'Ta-Nehisi Coates',
			1 => 'Philip Roth',
			2 => 'Ann Patchett',
		];
		
		$html = $this->aire()->select($options)->render();
		
		$this->assertSelectorTextEquals($html, 'option[value="0"]', 'Ta-Nehisi Coates');
		$this->assertSelectorTextEquals($html, 'option[value="1"]', 'Philip Roth');
		$this->assertSelectorTextEquals($html, 'option[value="2"]', 'Ann Patchett');
	}
}
