<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class FormTest extends TestCase
{
	public function test_forms_are_post_by_default()
	{
		$form = $this->aire()->form();
		
		$this->assertSelectorExists($form, 'form');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
	
	public function test_forms_have_an_action_set_automatically(): void
	{
		$form = $this->aire()->form();
		
		$this->assertSelectorAttribute($form, 'form', 'action', '');
	}
	
	public function test_form_actions_can_be_set(): void
	{
		$form = $this->aire()->form('/foo/bar');
		
		$this->assertSelectorAttribute($form, 'form', 'action', '/foo/bar');
	}
	
	public function test_form_actions_can_be_set_using_routes(): void
	{
		Route::get('/foo/bar')->name('demo-route');
		$expected = URL::route('demo-route');
		
		$form = $this->aire()->form()->route('demo-route');
		
		$this->assertSelectorAttribute($form, 'form', 'action', $expected);
	}
	
	public function test_csrf_token_is_included_if_session_is_set_and_method_is_not_get()
	{
		$token = Str::random();
		
		$this->withSession(['_token' => $token]);
		
		$form = $this->aire()->form();
		
		$this->assertSelectorExists($form, 'input[name="_token"]');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
	
	public function test_csrf_token_is_not_included_if_session_is_set_but_method_is_get()
	{
		$token = Str::random();
		
		$this->withSession(['_token' => $token]);
		
		$form = $this->aire()->open()->get()->close();
		
		$this->assertSelectorDoesNotExist($form, 'input[name="_token"]');
		$this->assertSelectorAttribute($form, 'form', 'method', 'GET');
	}
	
	public function test_hidden_method_field_is_added_for_put_forms()
	{
		$form = $this->aire()->open()->put()->close();
		
		$this->assertSelectorExists($form, 'input[name="_method"]');
		$this->assertSelectorAttribute($form, 'input[name="_method"]', 'value', 'PUT');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
	
	public function test_hidden_method_field_is_added_for_patch_forms()
	{
		$form = $this->aire()->open()->patch()->close();
		
		$this->assertSelectorExists($form, 'input[name="_method"]');
		$this->assertSelectorAttribute($form, 'input[name="_method"]', 'value', 'PATCH');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
	
	public function test_hidden_method_field_is_added_for_delete_forms()
	{
		$form = $this->aire()->open()->delete()->close();
		
		$this->assertSelectorExists($form, 'input[name="_method"]');
		$this->assertSelectorAttribute($form, 'input[name="_method"]', 'value', 'DELETE');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
	
	public function test_calling_route_implicitly_opens_the_form(): void
	{
		Route::get('/foo/bar')->name('demo-route');
		
		$form = $this->aire()->form();
		
		$this->assertFalse($form->isOpened());
		
		$this->aire()->route('demo-route');
		
		$this->assertTrue($form->isOpened());
		
		$form->close();
	}
	
	public function test_calling_resourceful_implicitly_opens_the_form(): void
	{
		Route::post('/tests')->name('tests.store');
		
		$form = $this->aire()->form();
		
		$this->assertFalse($form->isOpened());
		
		$this->aire()->resourceful(new class() extends Model {
			protected $table = 'test';
		});
		
		$this->assertTrue($form->isOpened());
		
		$form->close();
	}
	
	public function test_when_opening_two_forms_the_second_form_does_not_inherit_attributes_and_classes_from_the_first_form_inline(): void
	{
		Route::get('/foo/bar')->name('demo-route');
		
		$form_1 = $this->aire()->route('demo-route')->setAttribute('title', 'foo-bar')->addClass('foo-class')->id('foobar-id')->close();
		$form_2 = $this->aire()->route('demo-route')->close();
		
		$this->assertSelectorExists($form_1, 'form[id="foobar-id"]');
		$this->assertSelectorExists($form_1, 'form[title="foo-bar"]');
		$this->assertSelectorExists($form_1, 'form[class="foo-class"]');
		
		// Form 2 should not get the ID, Class or any other attributes from Form 1
		$this->assertSelectorDoesNotExist($form_2, 'form[id="foobar-id"]');
		$this->assertSelectorDoesNotExist($form_2, 'form[title="foo-bar"]');
		$this->assertSelectorDoesNotExist($form_2, 'form[class="foo-class"]');
	}
	
	public function test_when_opening_two_forms_the_second_form_does_not_inherit_attributes_and_classes_from_the_first_form_double_line(): void
	{
		Route::get('/foo/bar')->name('demo-route');
		
		$this->aire()->route('demo-route')->setAttribute('title', 'foo-bar')->addClass('foo-class')->id('foobar-id');
		$form_1 = $this->aire()->close();
		
		$this->aire()->route('demo-route');
		$form_2 = $this->aire()->close();
		
		$this->assertSelectorExists($form_1, 'form[id="foobar-id"]');
		$this->assertSelectorExists($form_1, 'form[title="foo-bar"]');
		$this->assertSelectorExists($form_1, 'form[class="foo-class"]');
		
		// Form 2 should not get the ID, Class or any other attributes from Form 1
		$this->assertSelectorDoesNotExist($form_2, 'form[id="foobar-id"]');
		$this->assertSelectorDoesNotExist($form_2, 'form[title="foo-bar"]');
		$this->assertSelectorDoesNotExist($form_2, 'form[class="foo-class"]');
	}
}
