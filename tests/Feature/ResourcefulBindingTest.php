<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class ResourcefulBindingTest extends TestCase
{
	protected function setUp(): void
	{
		parent::setUp();
		
		Route::post('/users', function() {})->name('users.store');
		Route::put('/users/{user}', function() {})->name('users.update');
	}
	
	public function test_action_and_method_are_inferred_for_unsaved_models()
	{
		$model = new XResourcefulModel(['id' => 1]);
		
		$html = $this->aire()->form()->resourceful($model)->render();
		
		$this->assertSelectorAttribute($html, 'form', 'action', URL::to('/users'));
		$this->assertSelectorAttribute($html, 'form', 'method', 'POST');
		$this->assertSelectorDoesNotExist($html, 'input[name="_method"]');
	}
	
	public function test_action_and_method_are_inferred_for_saved_models()
	{
		$model = new XResourcefulModel(['id' => 1]);
		$model->exists = true;
		
		$html = $this->aire()->form()->resourceful($model)->render();
		
		$this->assertSelectorAttribute($html, 'form', 'action', URL::to('/users/1'));
		$this->assertSelectorAttribute($html, 'input[name="_method"]', 'value', 'PUT');
	}
	
	public function test_provided_name_overrides_inferred_name(): void
	{
		Route::post('/foo/bar', function() {})->name('foo.bar.store');
		
		$model = new XResourcefulModel(['id' => 1]);
		
		$html = $this->aire()->form()->resourceful($model, 'foo.bar')->render();
		
		$this->assertSelectorAttribute($html, 'form', 'action', URL::to('/foo/bar'));
	}
	
	public function test_route_parameters_are_prepended_when_loading_route(): void
	{
		Route::post('/{foo}/users', function() {})->name('foo.users.store');
		
		$model = new XResourcefulModel(['id' => 1]);
		
		$html = $this->aire()->form()->resourceful($model, 'foo.users', ['baz'])->render();
		
		$this->assertSelectorAttribute($html, 'form', 'action', URL::to('/baz/users'));
	}
}

class XResourcefulModel extends Model
{
	protected $guarded = [];
	
	protected $table = 'users';
}
