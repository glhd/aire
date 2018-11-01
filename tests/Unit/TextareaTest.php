<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class TextareaTest extends TestCase
{
	public function test_a_textarea_can_be_created()
	{
		$html = $this->aire()->textarea()->value('Foo')->render();
		
		$this->assertSelectorExists($html, 'textarea');
		$this->assertSelectorTextEquals($html, 'textarea', 'Foo');
		$this->assertSelectorAttributeMissing($html, 'textarea', 'value');
	}
}
