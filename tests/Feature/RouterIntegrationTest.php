<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Facades\Route;

class RouterIntegrationTest extends TestCase
{
	public function test_a_form_action_can_be_set_using_a_route_name()
	{
		Route::post('foo')->name('foo');
		
		$html = $this->aire()->route('foo')->close()->render();
		
		$this->assertSelectorAttribute($html, 'form', 'action', route('foo'));
	}
	
	public function test_a_route_with_a_single_verb_sets_the_form_method()
	{
		Route::put('foo')->name('foo');
		
		$html = $this->aire()->route('foo')->close()->render();
		
		$this->assertSelectorAttribute($html, 'form', 'method', 'POST');
		$this->assertSelectorAttribute($html, 'input[name="_method"]', 'value', 'PUT');
	}
	
	public function test_a_route_with_multiple_verbs_do_not_set_the_form_method()
	{
		Route::any('foo')->name('foo');
		
		$html = $this->aire()->route('foo')->close()->render();
		
		$this->assertSelectorDoesNotExist($html, 'input[name="_method"]');
	}
	
	public function test_a_get_route_removes_hidden_method_field()
	{
		Route::get('foo')->name('foo');
		
		$html = $this->aire()->route('foo')->close()->render();
		
		$this->assertSelectorAttribute($html, 'form', 'method', 'GET');
		$this->assertSelectorDoesNotExist($html, 'input[name="_method"]');
	}
}
