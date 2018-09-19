<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

class DataBindingTest extends TestCase
{
	public function test_an_eloquent_model_can_be_bound_to_the_form() : void
	{
		$model = new ModelStub(['foo' => 'bar']);
		
		$this->aire()->form()->bind($model);
		
		$input = $this->aire()->input('foo');
		
		$this->assertSelectorAttribute($input, 'input', 'value', 'bar');
	}
}

class ModelStub extends Model
{
	protected $guarded = [];
}
