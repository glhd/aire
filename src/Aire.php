<?php

namespace Galahad\Aire;

use Galahad\Aire\Elements\Button;
use Galahad\Aire\Elements\Form;
use Galahad\Aire\Elements\Input;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Arr;
use Illuminate\View\Factory;

class Aire
{
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
	 * @var \Illuminate\Routing\UrlGenerator
	 */
	protected $url;
	
	/**
	 * Aire constructor.
	 *
	 * @param \Illuminate\View\Factory $factory
	 * @param \Illuminate\Routing\UrlGenerator $url
	 * @param array $config
	 */
	public function __construct(Factory $factory, UrlGenerator $url, array $config = [])
	{
		$this->factory = $factory;
		$this->config = $config;
		$this->url = $url;
	}
	
	public function form() : Form
	{
		$this->form = new Form($this, $this->url);
		
		return $this->form;
	}
	
	/**
	 * Open a new Form.
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function open() : Form
	{
		$this->form()->open();
		
		return $this->form;
	}
	
	/**
	 * Close active Form.
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function close() : Form
	{
		return $this->form->close();
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
