<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class DataAttributesTest extends TestCase
{
	public function test_data_attributes_can_be_set()
	{
		$form = $this->aire()->form();
		
		$form->data('foo', 'bar');
		
		$this->assertSelectorAttribute($form, 'form', 'data-foo', 'bar');
	}
	
	public function test_data_attributes_can_be_unset()
	{
		$form = $this->aire()->form();
		
		$form->data('foo', 'bar');
		$form->data('foo', null);
		
		$this->assertSelectorAttributeMissing($form, 'form', 'data-foo');
	}
}
