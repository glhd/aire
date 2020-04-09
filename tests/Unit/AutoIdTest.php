<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class AutoIdTest extends TestCase
{
	public function test_ids_are_not_applied_when_auto_id_is_off() : void
	{
		// Set config and clear instance
		$this->app['config']->set('aire.auto_id', false);
		$this->app->forgetInstance('galahad.aire');
		
		$input = $this->aire()->input();
		
		$this->assertSelectorAttributeMissing($input, 'input', 'id');
	}
	
	public function test_auto_ids_are_incremented() : void
	{
		// Create 2 inputs with the same name
		$input1 = $this->aire()->input('test');
		$input2 = $this->aire()->input('test');
		
		$this->assertNotEquals(
			$input1->attributes->get('id'),
			$input2->attributes->get('id')
		);
	}
}
