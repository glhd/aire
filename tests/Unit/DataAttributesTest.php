<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class DataAttributesTest extends TestCase
{
	public function test_data_attributes_can_be_set()
	{
		$form = $this->aire()->open();
		
		$form->data('foo', 'bar');
		
		$form->close();
		
		$this->assertContains('data-foo="bar"', (string) $form);
	}
	
	public function test_data_attributes_can_be_unset()
	{
		$form = $this->aire()->open();
		
		$form->data('foo', 'bar');
		$form->data('foo', null);
		
		$form->close();
		
		$this->assertNotContains('data-foo="bar"', (string) $form);
	}
}
