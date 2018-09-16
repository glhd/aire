<?php

namespace Galahad\Aire\Support;

use Galahad\Aire\Aire;
use Illuminate\Support\ServiceProvider;

class AireServiceProvider extends ServiceProvider
{
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		require_once __DIR__.'/helpers.php';
		
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
	 * Boot our views
	 *
	 * @return $this
	 */
	protected function bootViews() : self
	{
		$path = __DIR__.'/../../views';
		
		$this->loadViewsFrom($path, 'aire');
		
		if (method_exists($this->app, 'resourcePath')) {
			$this->publishes([
				$path => $this->app->resourcePath('views/vendor/aire'),
			]);
		}
		
		return $this;
	}
}
