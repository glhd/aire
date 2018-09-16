<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Support\Facades\Aire;
use Galahad\Aire\Tests\TestCase;

class DataAttributesTest extends TestCase
{
	public function test_data_attributes_can_be_set()
	{
		$form = Aire::open();
		
		$form->data('foo', 'bar');
		
		$this->assertContains('data-foo="bar"', (string) $form);
	}
	
	public function test_data_attributes_can_be_unset()
	{
		$form = Aire::open();
		
		$form->data('foo', 'bar');
		$form->data('foo', null);
		
		$this->assertNotContains('data-foo="bar"', (string) $form);
	}
}
