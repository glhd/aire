<?php

namespace Galahad\Aire;

use BadMethodCallException;
use Galahad\Aire\Elements\Form;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Factory;

/**
 * @mixin \Galahad\Aire\Elements\Form
 */
class Aire
{
	/**
	 * @var \Illuminate\Contracts\Foundation\Application
	 */
	protected $app;
	
	/**
	 * @var \Illuminate\View\Factory
	 */
	protected $factory;
	
	/**
	 * @var \Galahad\Aire\Elements\Form
	 */
	protected $form;
	
	/**
	 * @var array
	 */
	protected $config;
	
	/**
	 * @var string
	 */
	protected $view_namespace = 'aire';
	
	/**
	 * @var string
	 */
	protected $view_prefix;
	
	/**
	 * Aire constructor.
	 *
	 * @param \Illuminate\View\Factory $factory
	 * @param \Illuminate\Contracts\Foundation\Application $app
	 * @param array $config
	 */
	public function __construct(Factory $factory, Application $app, array $config = [])
	{
		$this->factory = $factory;
		$this->app = $app;
		$this->config = $config;
	}
	
	/**
	 * Set where Aire looks for view files
	 *
	 * This is mostly useful for third-party themes. By utilizing package
	 * auto-discovery, a theme can call this from its service provider's
	 * boot() method to automatically set the Aire theme.
	 *
	 * If you want to override the default Aire views, just publish
	 * the views to your vendor directory with `artisan publish`
	 *
	 * @param string|null $namespace
	 * @param string|null $prefix
	 * @return \Galahad\Aire\Aire
	 */
	public function setTheme($namespace = null, $prefix = null) : self
	{
		$this->view_namespace = $namespace;
		$this->view_prefix = $prefix;
		
		return $this;
	}
	
	/**
	 * Instantiate a new Form
	 *
	 * @param string $action
	 * @param \Illuminate\Database\Eloquent\Model|object|array $bound_data
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function form($action = null, $bound_data = null) : Form
	{
		$this->form = $this->app->make(Form::class);
		
		if ($action) {
			$this->form->action($action);
		}
		
		if ($bound_data) {
			$this->form->bind($bound_data);
		}
		
		return $this->form;
	}
	
	/**
	 * Open a new Form.
	 *
	 * @param null $action
	 * @param null $bound_data
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function open($action = null, $bound_data = null) : Form
	{
		$this->form($action, $bound_data)->open();
		
		return $this->form;
	}
	
	/**
	 * Get a configuration value
	 *
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function config(string $key, $default = null)
	{
		return Arr::get($this->config, $key, $default);
	}
	
	/**
	 * Render an Aire view.
	 *
	 * @param $view
	 * @param array $data
	 * @param array $merge_data
	 * @return string
	 */
	public function render($view, array $data = [], array $merge_data = []) : string
	{
		return $this->make($view, $data, $merge_data)->render();
	}
	
	/**
	 * Defer to the Form object for all other method calls
	 *
	 * @param string $method_name
	 * @param array $arguments
	 * @return Form
	 */
	public function __call($method_name, $arguments)
	{
		$form = $this->form ?? $this->form();
		
		if (!method_exists($form, $method_name)) {
			throw new BadMethodCallException(sprintf(
				'Method %s::%s does not exist.', static::class, $method_name
			));
		}
		
		return $form->$method_name(...$arguments);
	}
	
	/**
	 * Make a namespaced View.
	 *
	 * @param $view
	 * @param array $data
	 * @param array $merge_data
	 * @return \Illuminate\Contracts\View\View
	 */
	protected function make($view, array $data = [], array $merge_data = []) : View
	{
		if ($this->view_prefix) {
			$view = "{$this->view_prefix}.{$view}";
		}
		
		if ($this->view_namespace) {
			$view = "{$this->view_namespace}::{$view}";
		}
		
		return $this->factory->make($view, $data, $merge_data);
	}
}
