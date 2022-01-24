<?php

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Facades\Session;
use Symfony\Component\DomCrawler\Crawler;

class AlpineJsTest extends TestCase
{
	public function test_alpine_js_integration(): void
	{
		$expected_x_data = [
			'generic_input' => 'foo',
			'basic_select' => 'a',
			'text_area' => 'text',
			'check_box' => true,
			'checkbox_group' => ['a', 'b'],
			'radio_group' => null,
			'nested_values' => [
				'first' => 'yes',
				'deeply_nested' => [
					'one' => 1,
					'two' => 2,
				],
			],
		];
		
		Session::flashInput([
			'generic_input' => $expected_x_data['generic_input'],
			'basic_select' => $expected_x_data['basic_select'],
		]);
		
		$bound_data = [
			'check_box' => $expected_x_data['check_box'],
			'checkbox_group' => $expected_x_data['checkbox_group'],
			'nested_values' => [
				'first' => 'yes',
				'deeply_nested' => [
					'one' => 1,
					'two' => 2,
				],
			],
		];
		
		ob_start();
		
		$form = $this->aire()->form()->bind($bound_data)->asAlpineComponent()->open();
		
		echo $form->input('generic_input');
		echo $form->select(['a' => 'a', 'b' => 'b'], 'basic_select');
		echo $form->textArea('text_area')->defaultValue($expected_x_data['text_area']);
		echo $form->checkbox('check_box');
		echo $form->checkboxGroup(['a' => 'a', 'b' => 'b'], 'checkbox_group');
		echo $form->radioGroup(['a' => 'a', 'b' => 'b'], 'radio_group');
		echo $form->input('nested_values[first]');
		echo $form->input('nested_values[deeply_nested][one]');
		echo $form->input('nested_values[deeply_nested][two]');
			
		echo $form->close();
		
		$html = ob_get_clean();
		
		$this->assertSelectorAttribute($html, '[name=generic_input]', 'x-model', 'generic_input');
		$this->assertSelectorAttribute($html, '[name=basic_select]', 'x-model', 'basic_select');
		$this->assertSelectorAttribute($html, '[name=text_area]', 'x-model', 'text_area');
		$this->assertSelectorAttribute($html, '[name=check_box]', 'x-model', 'check_box');
		$this->assertSelectorAttribute($html, '[name="checkbox_group[]"][value=a]', 'x-model', 'checkbox_group');
		$this->assertSelectorAttribute($html, '[name="checkbox_group[]"][value=b]', 'x-model', 'checkbox_group');
		$this->assertSelectorAttribute($html, '[name=radio_group][value=a]', 'x-model', 'radio_group');
		$this->assertSelectorAttribute($html, '[name=radio_group][value=b]', 'x-model', 'radio_group');
		$this->assertSelectorAttribute($html, '[name="nested_values[first]"]', 'x-model', 'nested_values.first');
		$this->assertSelectorAttribute($html, '[name="nested_values[deeply_nested][one]"]', 'x-model', 'nested_values.deeply_nested.one');
		$this->assertSelectorAttribute($html, '[name="nested_values[deeply_nested][two]"]', 'x-model', 'nested_values.deeply_nested.two');
		
		$data = (new Crawler($html))->filter('form')->attr('x-data');
		$this->assertJsonStringEqualsJsonString(json_encode($expected_x_data), $data);
	}
	
	public function test_explicit_x_data(): void
	{
		$expected_x_data = [
			'bound' => 'foo',
			'bound_override' => 'bar',
			'x_data' => 'baz',
		];
		
		$bound_data = [
			'bound' => 'foo',
			'bound_override' => 'also foo',
		];
		
		$x_data = [
			'bound_override' => 'bar',
			'x_data' => 'baz',
		];
		
		ob_start();
		
		$form = $this->aire()->form()->bind($bound_data)->asAlpineComponent($x_data)->open();
		
		echo $form->input('bound');
		echo $form->input('bound_override');
		
		echo $form->close();
		
		$data = (new Crawler(ob_get_clean()))->filter('form')->attr('x-data');
		
		$this->assertJsonStringEqualsJsonString(json_encode($expected_x_data), $data);
	}
}
