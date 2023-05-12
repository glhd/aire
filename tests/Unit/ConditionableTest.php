<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class ConditionableTest extends TestCase
{
	public function test_when_with_closure()
	{
		$input = $this->aire()->input();
		
		$input->when(true, function($input) {
			$input->value('when true');
		}, function($input) {
			$input->value('when false');
		});
		
		$this->assertEquals('when true', $input->attributes->get('value'));
	}
	
	public function test_when_with_callback_proxy()
	{
		$this->requiresHigherOrderProxies();
		
		$input = $this->aire()->input();
		
		$input->when(true)->value('when true');
		$input->when(false)->value('when false');
		
		$this->assertEquals('when true', $input->attributes->get('value'));
	}
	
	public function test_when_with_proxy()
	{
		$this->requiresHigherOrderProxies();
		
		$input = $this->aire()->input()->variant('foo');
		
		$input->when()->hasViewData('variant')->value('when has variant');
		$input->when()->hasViewData('this is never set')->value('should not be set');
		
		$this->assertEquals('when has variant', $input->attributes->get('value'));
	}
	
	protected function requiresHigherOrderProxies()
	{
		if (version_compare($this->app->version(), '9.0.0', '<')) {
			$this->markTestSkipped('Requires Laravel 9 or higher.');
		}
	}
}
