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
	
	public function test_a_non_associative_array_maps_value_to_key() : void
	{
		$options = [
			'Ta-Nehisi Coates',
			'Philip Roth',
			'Ann Patchett',
		];
		
		$html = $this->aire()->select($options)->render();
		
		$this->assertSelectorTextEquals($html, 'option[value="Ta-Nehisi Coates"]', 'Ta-Nehisi Coates');
		$this->assertSelectorTextEquals($html, 'option[value="Philip Roth"]', 'Philip Roth');
		$this->assertSelectorTextEquals($html, 'option[value="Ann Patchett"]', 'Ann Patchett');
	}
}
