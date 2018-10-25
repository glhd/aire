<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class ValidationTest extends TestCase
{
	protected function setUp()
	{
		parent::setUp();
		
		$config = $this->app['config'];
		
		$config->set('aire.validation_classes.none.input', 'no-validation');
		$config->set('aire.validation_classes.valid.input', 'is-valid');
		$config->set('aire.validation_classes.invalid.input', 'is-invalid');
	}
	
	public function test_a_group_with_errors_is_marked_as_invalid() : void
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
		
		$this->assertSelectorText($input, 'ul li', 'Expected error');
		$this->assertSelectorMissingText($input, 'ul li', 'Unexpected error');
	}
}
