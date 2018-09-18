<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Support\Facades\Aire;
use Galahad\Aire\Tests\TestCase;

class FormTest extends TestCase
{
	public function test_forms_are_post_by_default()
	{
		$form = Aire::open()->close();
		
		$this->assertSelectorExists($form, 'form');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
	
	public function test_csrf_token_is_included_if_session_is_set_and_method_is_not_get()
	{
		$token = str_random();
		
		$this->withSession(['_token' => $token]);
		
		$form = Aire::open()->close();
		
		$this->assertSelectorExists($form, 'input[name="_token"]');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
	
	public function test_csrf_token_is_not_included_if_session_is_set_but_method_is_get()
	{
		$token = str_random();
		
		$this->withSession(['_token' => $token]);
		
		$form = Aire::open()->get()->close();
		
		$this->assertSelectorDoesNotExist($form, 'input[name="_token"]');
		$this->assertSelectorAttribute($form, 'form', 'method', 'GET');
	}
	
	public function test_hidden_method_field_is_added_for_put_forms()
	{
		$form = Aire::open()->put()->close();
		
		$this->assertSelectorExists($form, 'input[name="_method"]');
		$this->assertSelectorAttribute($form, 'input[name="_method"]', 'value', 'PUT');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
	
	public function test_hidden_method_field_is_added_for_patch_forms()
	{
		$form = Aire::open()->patch()->close();
		
		$this->assertSelectorExists($form, 'input[name="_method"]');
		$this->assertSelectorAttribute($form, 'input[name="_method"]', 'value', 'PATCH');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
	
	public function test_hidden_method_field_is_added_for_delete_forms()
	{
		$form = Aire::open()->delete()->close();
		
		$this->assertSelectorExists($form, 'input[name="_method"]');
		$this->assertSelectorAttribute($form, 'input[name="_method"]', 'value', 'DELETE');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
}
