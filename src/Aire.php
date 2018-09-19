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
	
	public function config($key, $default = null)
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
		return $this->factory->make("aire::{$view}", $data, $merge_data);
	}
}
