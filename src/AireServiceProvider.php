<?php

namespace Galahad\Aire;

use Illuminate\Support\ServiceProvider;

class AireServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;
	
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->bootViews();
	}
	
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('galahad.aire', function($app) {
			return new Aire($app['view']);
		});
	}
	
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			Aire::class,
			'galahad.aire',
		];
	}
	
	/**
	 * Boot our views
	 *
	 * @return $this
	 */
	protected function bootViews() : self
	{
		$path = __DIR__.'/../views';
		
		$this->loadViewsFrom($path, 'aire');
		
		if (method_exists($this->app, 'resourcePath')) {
			$this->publishes([
				$path => $this->app->resourcePath('views/vendor/aire'),
			]);
		}
		
		return $this;
	}
}
