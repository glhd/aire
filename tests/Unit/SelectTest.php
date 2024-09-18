<?php

namespace Galahad\Aire\Tests\Unit;

use BenSampo\Enum\Enum;
use Galahad\Aire\Tests\TestCase;

class SelectTest extends TestCase
{
	public function test_an_associative_array_maps_to_value_and_label(): void
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
	
	public function test_a_zero_index_non_associative_array_maps_value_index(): void
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
	
	public function test_an_empty_option_can_be_prepended(): void
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
	
	public function test_a_custom_empty_option_can_be_prepended(): void
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
	
	public function test_an_empty_option_can_be_prepended_to_a_non_associative_array(): void
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
	
	public function test_opt_groups_render_properly_along_side_regular_select_options(): void
	{
		$options = [
			'Language' => [
				'php' => 'PHP',
				'js' => 'JavaScript',
			],
			1 => 'Philip Roth',
		];
		
		$html = $this->aire()->select($options)->render();
		
		$this->assertSelectorAttribute($html, 'select > optgroup', 'label', 'Language');

		$this->assertSelectorTextEquals($html, 'select > optgroup > option:nth-of-type(1)', 'PHP');
		$this->assertSelectorAttribute($html, 'select > optgroup > option:nth-of-type(1)', 'value', 'php');

		$this->assertSelectorTextEquals($html, 'select > optgroup > option:nth-of-type(2)', 'JavaScript');
		$this->assertSelectorAttribute($html, 'select > optgroup > option:nth-of-type(2)', 'value', 'js');

		$this->assertSelectorTextEquals($html, 'select > option[value="1"]', 'Philip Roth');
	}
	
	public function test_an_enum_class_name_will_be_converted_to_a_selectable_array(): void
	{
		if (!class_exists('BenSampo\Enum\Enum')) {
			$this->markTestSkipped();
			return;
		}
		
		$html = $this->aire()
			->select(SelectTestOptionsEnum::class)
			->defaultValue(SelectTestOptionsEnum::AnnPatchett)
			->render();
		
		$this->assertSelectorTextEquals($html, 'option[value="0"]', 'Ta-Nehisi Coates');
		$this->assertSelectorTextEquals($html, 'option[value="1"]', 'Philip Roth');
		$this->assertSelectorTextEquals($html, 'option[value="2"]', 'Ann Patchett');
		$this->assertSelectorTextEquals($html, 'option[selected]', 'Ann Patchett');
	}
	
	public function test_a_native_enum_is_supported(): void
	{
		if (version_compare(PHP_VERSION, '8.1.0', '<')) {
			$this->markTestSkipped('Only applies to PHP 8.1 and higher.');
		}
		
		require_once __DIR__.'/enum-stubs.php';
		
		$html = $this->aire()
			->select(Names::class)
			->defaultValue(Names::BogdanKharchenko)
			->render();
		
		$this->assertSelectorTextEquals($html, 'option[value="inxilpro"]', 'Chris Morrell');
		$this->assertSelectorTextEquals($html, 'option[value="boggybot"]', 'Bogdan Kharchenko');
		$this->assertSelectorTextEquals($html, 'option[selected]', 'Bogdan Kharchenko');
	}
}

if (class_exists('BenSampo\Enum\Enum')) {
	class SelectTestOptionsEnum extends Enum
	{
		public const TaNehisiCoates = 0;
		
		public const PhilipRoth = 1;
		
		public const AnnPatchett = 2;
		
		public static function getDescription($value): string
		{
			switch ($value) {
				case static::TaNehisiCoates:
					return 'Ta-Nehisi Coates';
				case static::PhilipRoth:
					return 'Philip Roth';
				case static::AnnPatchett:
					return 'Ann Patchett';
			}
		}
	}
}
