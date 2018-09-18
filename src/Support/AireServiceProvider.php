<?php

namespace Galahad\Aire\Support;

use Galahad\Aire\Aire;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AireServiceProvider extends ServiceProvider
{
	protected $config_path;
	
	protected $view_directory;
	
	public function __construct(Application $app)
	{
		parent::__construct($app);
		
		$this->config_path = __DIR__.'/../../config/aire.php';
		$this->view_directory = __DIR__.'/../../views';
	}
	
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		require_once __DIR__.'/helpers.php';
		
		$this->bootConfig();
		$this->bootViews();
	}
	
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom($this->config_path, 'aire');
		
		$this->app->singleton('galahad.aire', function($app) {
			return new Aire(
				$app['view'],
				$app['url'],
				$app['config']['aire'] ?? []
			);
		});
	}
	
	/**
	 * Boot our views
	 *
	 * @return $this
	 */
	protected function bootViews() : self
	{
		$this->loadViewsFrom($this->view_directory, 'aire');
		
		if (method_exists($this->app, 'resourcePath')) {
			$this->publishes([
				$this->view_directory => $this->app->resourcePath('views/vendor/aire'),
			]);
		}
		
		return $this;
	}
	
	protected function bootConfig() : self
	{
		if (method_exists($this->app, 'configPath')) {
			$this->publishes([
				$this->config_path => $this->app->configPath('aire.php'),
			]);
		}
		
		return $this;
	}
}
