<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Aire;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Mockery;

class ThemeTest extends TestCase
{
	public function test_a_theme_can_be_set(): void
	{
		$factory_mock = Mockery::mock(Factory::class);
		$view_mock = Mockery::mock(View::class);
		
		$factory_mock->shouldReceive('first')
			->once()
			->with(['theme-namespace::theme-prefix.input.text', 'theme-namespace::theme-prefix.input'], Mockery::andAnyOtherArgs())
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
	
	public function test_themes_can_override_defaults_but_not_user_config(): void
	{
		// Set up Aire with user config overrides
		$aire = new Aire(
			Mockery::mock(Factory::class),
			$this->app['session.store'],
			$this->app['galahad.aire.form.resolver'],
			array_merge(require __DIR__.'/../../config/aire.php', [
				'default_classes' => [
					'group' => '__test__',
				],
				'validation_classes' => [
					'none' => [
						'input' => '__test__',
					],
					'valid' => [
						'input' => '__test__',
					],
					'invalid' => [
						'input' => '__test__',
					],
				],
			])
		);
		
		// Make sure our "user" configuration is set
		$this->assertEquals('__test__', $aire->config('default_classes.group'));
		$this->assertEquals('__test__', $aire->config('validation_classes.none.input'));
		$this->assertEquals('__test__', $aire->config('validation_classes.valid.input'));
		$this->assertEquals('__test__', $aire->config('validation_classes.invalid.input'));
		
		// Other values should match the default config
		$default_theme = Aire::getDefaultThemeConfig();
		$this->assertEquals(Arr::get($default_theme, 'default_classes.label'), $aire->config('default_classes.label'));
		$this->assertEquals(Arr::get($default_theme, 'validation_classes.none.select'), $aire->config('validation_classes.none.select'));
		$this->assertEquals(Arr::get($default_theme, 'validation_classes.valid.select'), $aire->config('validation_classes.valid.select'));
		$this->assertEquals(Arr::get($default_theme, 'validation_classes.invalid.select'), $aire->config('validation_classes.invalid.select'));
		
		// Now set a new custom theme
		$aire->setTheme('aire', null, [
			'default_classes' => [
				'group' => '__test2__',
				'checkbox' => '__test2__',
			],
			'validation_classes' => [
				'none' => [
					'input' => '__test2__',
					'group_errors' => '__test2__',
				],
				'valid' => [
					'input' => '__test2__',
					'group_errors' => '__test2__',
				],
				'invalid' => [
					'input' => '__test2__',
					'group_errors' => '__test2__',
				],
			],
		]);
		
		// Values set by the user should remain the same
		$this->assertEquals('__test__', $aire->config('default_classes.group'));
		$this->assertEquals('__test__', $aire->config('validation_classes.none.input'));
		$this->assertEquals('__test__', $aire->config('validation_classes.valid.input'));
		$this->assertEquals('__test__', $aire->config('validation_classes.invalid.input'));
		
		// Values set in the theme should be applied
		$this->assertEquals('__test2__', $aire->config('default_classes.checkbox'));
		$this->assertEquals('__test2__', $aire->config('validation_classes.none.group_errors'));
		$this->assertEquals('__test2__', $aire->config('validation_classes.valid.group_errors'));
		$this->assertEquals('__test2__', $aire->config('validation_classes.invalid.group_errors'));
	}
}
