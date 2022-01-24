<?php

namespace Galahad\Aire\Support;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Form;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Blade;
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
	
	/**
	 * Resolved path to the built JS directory
	 *
	 * @var string
	 */
	protected $js_dist_directory;
	
	public function __construct(Application $app)
	{
		parent::__construct($app);
		
		$base_path = dirname(__DIR__, 2);
		
		$this->config_path = "$base_path/config/aire.php";
		$this->view_directory = "$base_path/views";
		$this->translations_directory = "$base_path/translations";
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
		$this->bootBladeComponents();
		$this->bootTranslations();
		$this->bootPublicAssets();
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
				$app['url'],
				$app->bound('router') ? $app['router'] : null,
				$app->bound('session.store') ? $app['session.store'] : null
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
	protected function bootViews(): self
	{
		$this->loadViewsFrom($this->view_directory, 'aire');
		
		if (method_exists($this->app, 'resourcePath')) {
			$this->publishes([
				$this->view_directory => $this->app->resourcePath('views/vendor/aire'),
			], 'aire-views');
		}
		
		return $this;
	}
	
	protected function bootBladeComponents(): self
	{
		if (version_compare($this->app->version(), '8.0.0', '>=')) {
			Blade::componentNamespace('Galahad\\Aire\\Components', 'aire');
		}
		
		return $this;
	}
	
	/**
	 * Boot the configuration
	 *
	 * @return \Galahad\Aire\Support\AireServiceProvider
	 */
	protected function bootConfig(): self
	{
		if (method_exists($this->app, 'configPath')) {
			$this->publishes([
				$this->config_path => $this->app->configPath('aire.php'),
			], 'aire-config');
		}
		
		return $this;
	}
	
	/**
	 * Boot the translations
	 *
	 * @return \Galahad\Aire\Support\AireServiceProvider
	 */
	protected function bootTranslations(): self
	{
		$this->loadTranslationsFrom($this->translations_directory, 'aire');
		
		if (method_exists($this->app, 'resourcePath')) {
			$this->publishes([
				$this->translations_directory => $this->app->resourcePath('lang/vendor/aire'),
			], 'aire-translations');
		}
		
		return $this;
	}
	
	/**
	 * Publish public assets (JS/etc)
	 *
	 * @return \Galahad\Aire\Support\AireServiceProvider
	 */
	protected function bootPublicAssets(): self
	{
		if (method_exists($this->app, 'publicPath')) {
			$this->publishes([
				$this->js_dist_directory => $this->app->publicPath().'/vendor/aire/js',
			], 'aire-public-assets');
		}
		
		return $this;
	}
}
