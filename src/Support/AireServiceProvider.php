<?php

namespace Galahad\Aire\Support;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Form;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AireServiceProvider extends ServiceProvider
{
	/**
	 * Resolved path to internal config file
	 *
	 * @var string
	 */
	protected $config_path;
	
	/**
	 * Resolved path to internal views
	 *
	 * @var string
	 */
	protected $view_directory;
	
	/**
	 * Resolved path to internal translations
	 *
	 * @var string
	 */
	protected $translations_directory;
	
	public function __construct(Application $app)
	{
		parent::__construct($app);
		
		$this->config_path = __DIR__.'/../../config/aire.php';
		$this->view_directory = __DIR__.'/../../views';
		$this->translations_directory = __DIR__.'/../../translations';
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
		$this->bootTranslations();
	}
	
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom($this->config_path, 'aire');
		
		$this->app->singleton('galahad.aire', function(Application $app) {
			return new Aire(
				$app['view'],
				$app['session.store'],
				$app['galahad.aire.form.resolver'],
				$app['config']['aire']
			);
		});
		
		$this->app->alias('galahad.aire', Aire::class);
		
		$this->app->bind('galahad.aire.form', function(Application $app) {
			return new Form(
				$app['galahad.aire'],
				$app['routes'],
				$app['session.store']
			);
		});
		
		$this->app->alias('galahad.aire.form', Form::class);
		
		$this->app->singleton('galahad.aire.form.resolver', function(Application $app) {
			return function() use ($app) {
				return $app->make(Form::class);
			};
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
			], 'views');
		}
		
		return $this;
	}
	
	/**
	 * Boot the configuration
	 *
	 * @return \Galahad\Aire\Support\AireServiceProvider
	 */
	protected function bootConfig() : self
	{
		if (method_exists($this->app, 'configPath')) {
			$this->publishes([
				$this->config_path => $this->app->configPath('aire.php'),
			], 'config');
		}
		
		return $this;
	}
	
	/**
	 * Boot the translations
	 *
	 * @return \Galahad\Aire\Support\AireServiceProvider
	 */
	protected function bootTranslations() : self
	{
		$this->loadTranslationsFrom($this->translations_directory, 'aire');
		
		if (method_exists($this->app, 'resourcePath')) {
			$this->publishes([
				$this->translations_directory => $this->app->resourcePath('lang/vendor/aire'),
			], 'translations');
		}
		
		return $this;
	}
}
