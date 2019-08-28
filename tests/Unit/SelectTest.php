<?php

namespace Galahad\Aire\Tests\Unit;

use BenSampo\Enum\Enum;
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
	
	public function test_an_empty_option_can_be_prepended() : void
	{
		$options = [
			'coates' => 'Ta-Nehisi Coates',
			'roth' => 'Philip Roth',
			'patchett' => 'Ann Patchett',
		];
		
		$html = $this->aire()->select($options)->prependEmptyOption('None')->render();
		
		$this->assertSelectorTextEquals($html, 'option[value=""]', 'None');
		$this->assertSelectorTextEquals($html, 'option[value="coates"]', 'Ta-Nehisi Coates');
		$this->assertSelectorTextEquals($html, 'option[value="roth"]', 'Philip Roth');
		$this->assertSelectorTextEquals($html, 'option[value="patchett"]', 'Ann Patchett');
	}
	
	public function test_a_custom_empty_option_can_be_prepended() : void
	{
		$options = [
			'coates' => 'Ta-Nehisi Coates',
			'roth' => 'Philip Roth',
			'patchett' => 'Ann Patchett',
		];
		
		$html = $this->aire()->select($options)->prependEmptyOption('All', 'all')->render();
		
		$this->assertSelectorTextEquals($html, 'option[value="all"]', 'All');
		$this->assertSelectorTextEquals($html, 'option[value="coates"]', 'Ta-Nehisi Coates');
		$this->assertSelectorTextEquals($html, 'option[value="roth"]', 'Philip Roth');
		$this->assertSelectorTextEquals($html, 'option[value="patchett"]', 'Ann Patchett');
	}
	
	public function test_an_empty_option_can_be_prepended_to_a_non_associative_array() : void
	{
		$options = [
			0 => 'Ta-Nehisi Coates',
			1 => 'Philip Roth',
			2 => 'Ann Patchett',
		];
		
		$html = $this->aire()->select($options)->prependEmptyOption('Empty')->render();
		
		$this->assertSelectorTextEquals($html, 'option[value=""]', 'Empty');
		$this->assertSelectorTextEquals($html, 'option[value="0"]', 'Ta-Nehisi Coates');
		$this->assertSelectorTextEquals($html, 'option[value="1"]', 'Philip Roth');
		$this->assertSelectorTextEquals($html, 'option[value="2"]', 'Ann Patchett');
	}
	
	public function test_an_enum_class_name_will_be_converted_to_a_selectable_array() : void
	{
		$html = $this->aire()
			->select(SelectTestOptionsEnum::class)
			->defaultValue(SelectTestOptionsEnum::AnnPatchett)
			->render();
		
		$this->assertSelectorTextEquals($html, 'option[value="0"]', 'Ta-Nehisi Coates');
		$this->assertSelectorTextEquals($html, 'option[value="1"]', 'Philip Roth');
		$this->assertSelectorTextEquals($html, 'option[value="2"]', 'Ann Patchett');
		$this->assertSelectorTextEquals($html, 'option[selected]', 'Ann Patchett');
	}
}

class SelectTestOptionsEnum extends Enum
{
	public const TaNehisiCoates = 0;
	
	public const PhilipRoth = 1;
	
	public const AnnPatchett = 2;
	
	public static function getDescription($value): string
	{
		switch ($value) {
			case static::TaNehisiCoates: return 'Ta-Nehisi Coates';
			case static::PhilipRoth: return 'Philip Roth';
			case static::AnnPatchett: return 'Ann Patchett';
		}
	}
}
