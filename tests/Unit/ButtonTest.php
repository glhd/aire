<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class ButtonTest extends TestCase
{
	public function test_a_button_can_be_created()
	{
		$button = $this->aire()->button('Testing');
		
		$this->assertSelectorExists($button, 'button');
		$this->assertSelectorText($button, 'button', 'Testing');
	}
	
	public function test_the_label_can_be_changed()
	{
		$button = $this->aire()->button('Testing');
		
		$button->label('Foo');
		
		$this->assertSelectorText($button, 'button', 'Foo');
	}
}
