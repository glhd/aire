<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Facades\View;

class FormRenderingTest extends TestCase
{
	public function test_a_basic_form_renders_as_expected()
	{
		$html = View::make('basic-form')->render();
		
		// Form
		$this->assertSelectorExists($html, 'form#test_form');
		
		// Summary
		$this->assertSelectorDoesNotExist($html, '[data-aire-summary]');
		
		// Input
		$this->assertSelectorExists($html, 'input#generic_input');
		$this->assertSelectorAttribute($html, '#generic_input', 'name', 'generic_input');
		$this->assertSelectorAttribute($html, '#generic_input', 'required');
		$this->assertSelectorExists($html, 'label[for="generic_input"]');
		$this->assertSelectorTextEquals($html, '[data-aire-help-text]', 'Sample help text');
		
		// Basic Select
		$this->assertSelectorExists($html, 'select#basic_select');
		$this->assertSelectorAttribute($html, '#basic_select', 'name', 'basic_select');
		$this->assertSelectorAttributeMissing($html, '#basic_select', 'multiple');
		$this->assertSelectorExists($html, 'label[for="basic_select"]');
		$this->assertSelectorExists($html, '#basic_select > option[value="a"]');
		$this->assertSelectorTextEquals($html, '#basic_select > option[value="a"]', 'a');
		$this->assertSelectorExists($html, '#basic_select > option[value="b"]');
		$this->assertSelectorTextEquals($html, '#basic_select > option[value="b"]', 'b');
		
		// Multi Select
		$this->assertSelectorExists($html, 'select#multi_select');
		$this->assertSelectorAttribute($html, '#multi_select', 'name', 'multi_select[]');
		$this->assertSelectorAttribute($html, '#multi_select', 'multiple');
		$this->assertSelectorExists($html, 'label[for="multi_select"]');
		
		// Text Area
		$this->assertSelectorExists($html, 'textarea#text_area');
		$this->assertSelectorAttribute($html, '#text_area', 'name', 'text_area');
		$this->assertSelectorExists($html, 'label[for="text_area"]');
		
		// File
		$this->assertSelectorExists($html, 'input#file_input');
		$this->assertSelectorAttribute($html, '#file_input', 'name', 'file_input');
		$this->assertSelectorAttribute($html, '#file_input', 'type', 'file');
		$this->assertSelectorExists($html, 'label[for="file_input"]');
		
		// Range
		$this->assertSelectorExists($html, 'input#range_input');
		$this->assertSelectorAttribute($html, '#range_input', 'name', 'range_input');
		$this->assertSelectorAttribute($html, '#range_input', 'type', 'range');
		$this->assertSelectorExists($html, 'label[for="range_input"]');
		
		// Checkbox
		$this->assertSelectorExists($html, 'input#checkbox');
		$this->assertSelectorAttribute($html, '#checkbox', 'name', 'checkbox');
		$this->assertSelectorAttribute($html, '#checkbox', 'type', 'checkbox');
		$this->assertSelectorExists($html, 'label[for="checkbox"]');
		
		// Radio Button
		$this->assertSelectorExists($html, 'input#radio');
		$this->assertSelectorAttribute($html, '#radio', 'name', 'radio');
		$this->assertSelectorAttribute($html, '#radio', 'type', 'radio');
		$this->assertSelectorExists($html, 'label[for="radio"]');
		
		// Submit Button
		$this->assertSelectorExists($html, 'button#submit');
		$this->assertSelectorAttribute($html, '#submit', 'type', 'submit');
	}
	
	public function test_a_button_with_html_content_renders()
	{
		$html = View::make('button-open-close')->render();
		
		$this->assertSelectorExists($html, 'form > button');
		$this->assertSelectorAttribute($html, 'form > button', 'type', 'submit');
		$this->assertSelectorExists($html, 'form > button > strong');
		$this->assertSelectorTextEquals($html, 'form > button > strong', 'Hello world');
	}
}
