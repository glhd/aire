<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Elements\Form;
use Galahad\Aire\Tests\TestCase;

class AireTest extends TestCase
{
	public function test_a_form_can_be_opened_and_closed()
	{
		$form = $this->aire()->open();
		
		$this->assertInstanceOf(Form::class, $form);
		
		$closed = $this->aire()->close();
		
		$this->assertSame($form, $closed);
		
		$this->assertSelectorExists($form, 'form');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
	}
}
