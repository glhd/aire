<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Support\Facades\Aire;
use Galahad\Aire\Tests\TestCase;

class ButtonTest extends TestCase
{
	public function test_a_button_can_be_created()
	{
		$button = Aire::button('Testing');
		
		$expected = '<button>
				Testing
			</button>';
		
		$this->assertHTML($expected, $button);
	}
	
	public function test_the_label_can_be_changed()
	{
		$button = Aire::button('Testing');
		
		$button->label('Foo');
		
		$expected = '<button>
				Foo
			</button>';
		
		$this->assertHTML($expected, $button);
	}
}
