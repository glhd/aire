<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ServerValidationTest extends TestCase
{
	public function test_validation_errors_are_shown_on_render()
	{
		Route::get('/aire', function() {
			return view('basic-form');
		})->middleware('web');
		
		Route::post('/aire', function(Request $request) {
			$request->validate([
				'generic_input' => 'required',
			]);
			
			return view('basic-form');
		})->middleware('web');
		
		// Post should redirect back to error page
		$this->post('/aire')->assertRedirect();
		
		// Now errors should be set
		$html = $this->get('/aire')->getContent();
		
		// Summary
		$this->assertSelectorExists($html, '[data-aire-component="summary"]');
		$this->assertSelectorContainsText($html, '[data-aire-component="summary"]', 'The generic input field is required');
		
		// Input validation
		$this->assertSelectorClassNames($html, '#generic_input_group', 'is-invalid');
		$this->assertSelectorClassNames($html, 'label[for="generic_input"]', 'is-invalid');
		$this->assertSelectorClassNames($html, '#generic_input', 'is-invalid');
		
		$this->assertSelectorExists($html, '[data-aire-component="errors"]');
		$this->assertSelectorContainsText($html, '[data-aire-component="errors"]', 'The generic input field is required');
	}
	
	public function test_it_uses_a_named_error_bag()
	{
		Route::get('/aire', function() {
			return view('custom-error-bag-form');
		})->middleware('web');
		
		Route::post('/aire', function(Request $request) {
			return redirect()->back()->withErrors(['generic_input' => 'Error message'], 'custom_errors');
		})->middleware('web');
		
		// Post should redirect back to error page
		$this->post('/aire')->assertRedirect();
		
		// Now errors should be set
		$html = $this->get('/aire')->getContent();
		$this->assertSelectorContainsText($html, '[data-aire-component="summary"]', 'Error message');
		$this->assertSelectorContainsText($html, '[data-aire-component="errors"]', 'Error message');
	}
}
