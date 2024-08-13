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
	
	public function test_it_respects_error_bags()
	{
		Route::get('/aire', function() {
			return view('basic-form');
		})->middleware('web');
		
		Route::post('/default-bag', function(Request $request) {
			$request->validate([
				'generic_input' => 'required',
			]);
		})->middleware('web');
		
		Route::post('/bag2', function(Request $request) {
			$request->validateWithBag('bag2', [
				'generic_input' => 'required',
			]);
		})->middleware('web');
		
		$this->post('/default-bag')->assertRedirect();
		$html = $this->get('/aire')->getContent();

		$this->assertSelectorClassNames($html, '#generic_input_group', 'is-invalid');
		
		$this->post('/bag2')->assertRedirect();
		$html = $this->get('/aire')->getContent();
		
		$this->assertSelectorMissingClassNames($html, '#generic_input_group', 'is-invalid');
	}
}
