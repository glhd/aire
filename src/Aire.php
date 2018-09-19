<?php

namespace Galahad\Aire;

use Galahad\Aire\Elements\Button;
use Galahad\Aire\Elements\Form;
use Galahad\Aire\Elements\Input;
use Galahad\Aire\Elements\Label;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Factory;

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
	
	public function getForm() : Form
	{
		return $this->form ?? $this->form();
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
	 * Close active Form.
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function close() : Form
	{
		return $this->getForm()->close();
	}
	
	public function label(string $label) : Label
	{
		return $this->element(Label::class, func_get_args());
	}
	
	public function button(string $label) : Button
	{
		return $this->element(Button::class, func_get_args());
	}
	
	public function input($name = null, $label = null) : Input
	{
		return $this->element(Input::class, func_get_args());
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
	
	protected function element($class_name, array $args)
	{
		return new $class_name($this, ...$args);
	}
}
