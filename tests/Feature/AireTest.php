<?php

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Facades\Aire;
use Galahad\Aire\Form;
use Galahad\Aire\Tests\TestCase;

class AireTest extends TestCase
{
	public function test_opening_a_form_generates_a_form_tag()
	{
		$form = Aire::open();
		
		$this->assertInstanceOf(Form::class, $form);
		$this->assertContains('<form', (string) $form);
	}
}
