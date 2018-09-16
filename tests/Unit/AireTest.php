<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Elements\Form;
use Galahad\Aire\Support\Facades\Aire;
use Galahad\Aire\Tests\TestCase;

class AireTest extends TestCase
{
	public function test_a_form_can_be_opened_and_closed()
	{
		$form = Aire::open();
		
		$this->assertInstanceOf(Form::class, $form);
		
		$closed = Aire::close();
		
		$this->assertSame($form, $closed);
		
		$expected = '<form method="POST">
			</form>';
		
		$this->assertHTML($expected, $closed);
	}
}
