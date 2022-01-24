<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;

class ValidationTest extends TestCase
{
	protected function setUp(): void
	{
		parent::setUp();
		
		$config = $this->app['config'];
		
		$config->set('aire.validation_classes.none.input', 'no-validation');
		$config->set('aire.validation_classes.valid.input', 'is-valid');
		$config->set('aire.validation_classes.invalid.input', 'is-invalid');
	}
	
	public function test_a_group_with_errors_is_marked_as_invalid(): void
	{
		$errors = new ViewErrorBag();
		$errors->put('default', new MessageBag([
			'foo' => 'Expected error',
			'bar' => 'Unexpected error',
		]));
		
		Session::put('errors', $errors);
		
		$input = $this->aire()->input('foo');
		
		$this->assertSelectorClassNames($input, 'input', 'is-invalid');
		$this->assertSelectorMissingClassNames($input, 'input', 'no-validation');
		$this->assertSelectorMissingClassNames($input, 'input', 'is-valid');
		
		$this->assertSelectorTextEquals($input, 'ul li', 'Expected error');
		$this->assertSelectorMissingText($input, 'ul li', 'Unexpected error');
	}
	
	public function test_adding_rules_enables_client_side_validation(): void
	{
		$rules = ['foo' => 'required'];
		$script_path = Str::random().'.js';
		
		$this->app['config']->set('aire.inline_validation', false);
		$this->app['config']->set('aire.validation_script_path', $script_path);
		
		$form = $this->aire()->form()->rules($rules);
		
		$this->assertSelectorAttribute($form, 'script', 'src', $script_path);
		$this->assertSelectorContainsText($form, 'script', 'Aire.connect');
		$this->assertSelectorContainsText($form, 'script', json_encode($rules));
	}
	
	public function test_client_side_validation_can_be_disabled_explicity(): void
	{
		$form = $this->aire()->form()->rules(['foo' => 'required'])->withoutValidation();
		
		$this->assertSelectorDoesNotExist($form, 'script');
	}
}
