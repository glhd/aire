<?php

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Facades\Session;
use Symfony\Component\DomCrawler\Crawler;

class AlpineJsTest extends TestCase
{
	public function test_alpine_js_integration() : void
	{
		$expected_x_data = [
			'generic_input' => 'foo',
			'basic_select' => 'a',
			'text_area' => 'text',
			'check_box' => true,
			'checkbox_group' => ['a', 'b'],
			'radio_group' => null,
			'nested_input' => [
				'a' => [
					'b' => [
						'c' => 'd',
					],
					'foo' => 'bar',
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
			'nested_input' => $expected_x_data['nested_input'],
		];
		
		ob_start();
		
		$form = $this->aire()->form()->bind($bound_data)->asAlpineComponent()->open();
		
		echo $form->input('generic_input');
		echo $form->select(['a' => 'a', 'b' => 'b'], 'basic_select');
		echo $form->textArea('text_area')->defaultValue($expected_x_data['text_area']);
		echo $form->checkbox('check_box');
		echo $form->checkboxGroup(['a' => 'a', 'b' => 'b'], 'checkbox_group');
		echo $form->radioGroup(['a' => 'a', 'b' => 'b'], 'radio_group');
		echo $form->input('nested_input[a][b][c]')->value('d');
		echo $form->input('nested_input[a][foo]')->value('bar');
		
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
		$this->assertSelectorAttribute($html, '[name="nested_input[a][b][c]"][value=d]', 'x-model', 'nested_input.a.b.c');
		$this->assertSelectorAttribute($html, '[name="nested_input[a][foo]"][value=bar]', 'x-model', 'nested_input.a.foo');
		
		$data = (new Crawler($html))->filter('form')->attr('x-data');
		$this->assertJsonStringEqualsJsonString(json_encode($expected_x_data, JSON_PRETTY_PRINT), $data);
	}
}
