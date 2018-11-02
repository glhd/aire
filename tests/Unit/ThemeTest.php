<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Aire;
use Galahad\Aire\Tests\TestCase;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Mockery;

class ThemeTest extends TestCase
{
	public function test_a_theme_can_be_set() : void
	{
		$factory_mock = Mockery::mock(Factory::class);
		$view_mock = Mockery::mock(View::class);
		
		$factory_mock->shouldReceive('make')
			->once()
			->with('theme-namespace::theme-prefix.input', Mockery::andAnyOtherArgs())
			->andReturn($view_mock);
		
		$view_mock->shouldReceive('render')
			->once()
			->andReturn('hello world');
		
		$aire = new Aire(
			$factory_mock,
			$this->app['session.store'],
			$this->app['galahad.aire.form.resolver'],
			$this->app['config']['aire']
		);
		
		$this->app->instance('galahad.aire', $aire);
		
		$aire->setTheme('theme-namespace', 'theme-prefix');
		
		$result = $aire->input()->withoutGroup()->render();
		
		$this->assertEquals('hello world', $result);
	}
}
