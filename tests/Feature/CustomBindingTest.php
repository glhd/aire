<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Contracts\BindsToForm;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

class CustomBindingTest extends TestCase
{
	public function test_action_and_method_are_inferred_for_unsaved_models()
	{
		$model = new XCustomBindingModel(['a' => 'not foo', 'b' => 'not bar']);
		
		$this->aire()->form()->bind($model);
		
		$input_a = $this->aire()->input('a')->render();
		$input_b = $this->aire()->input('b')->render();
		
		$this->assertSelectorAttribute($input_a, 'input[name=a]', 'value', 'foo');
		$this->assertSelectorAttribute($input_b, 'input[name=b]', 'value', 'bar');
	}
}

class XCustomBindingModel extends Model implements BindsToForm
{
	protected $guarded = [];
	
	protected $table = 'users';
	
	public function getAireFormData(): array
	{
		return ['a' => 'foo', 'b' => 'bar'];
	}
}
