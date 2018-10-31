<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class OldInputTest extends TestCase
{
	public function test_prior_input_is_preserved()
	{
		Route::get('/aire', function() {
			return view('basic-form');
		})->middleware('web');
		
		Session::flashInput([
			'generic_input' => 'foo',
			'basic_select' => 'a',
			'multi_select' => ['a', 'b'],
		]);
		
		$html = $this->get('/aire')->getContent();
		
		$this->assertSelectorAttribute($html, '#generic_input', 'value', 'foo');
		$this->assertSelectorAttribute($html, '#basic_select > option[value="a"]', 'selected');
		$this->assertSelectorAttributeMissing($html, '#basic_select > option[value="b"]', 'selected');
		$this->assertSelectorAttribute($html, '#multi_select > option[value="a"]', 'selected');
		$this->assertSelectorAttribute($html, '#multi_select > option[value="b"]', 'selected');
	}
}
