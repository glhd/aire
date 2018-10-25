<?php

namespace Galahad\Aire;

use BadMethodCallException;
use Closure;
use Galahad\Aire\Elements\Attributes\ClassNames;
use Galahad\Aire\Elements\Concerns\Groupable;
use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Session\Store;
use Illuminate\Support\Arr;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Factory;

/**
 * @mixin \Galahad\Aire\Elements\Form
 */
class Aire
{
	/**
	 * @var \Illuminate\View\Factory
	 */
	protected $view_factory;
	
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
	 * @var array
	 */
	protected $attribute_observers = [];
	
	/**
	 * @var \Closure
	 */
	protected $form_resolver;
	
	/**
	 * @var \Illuminate\Session\Store
	 */
	protected $session_store;
	
	/**
	 * Aire constructor.
	 *
	 * @param \Illuminate\View\Factory $view_factory
	 * @param \Illuminate\Session\Store $session_store
	 * @param \Closure $form_resolver
	 * @param array $config
	 */
	public function __construct(Factory $view_factory, Store $session_store, Closure $form_resolver, array $config)
	{
		$this->view_factory = $view_factory;
		$this->session_store = $session_store;
		$this->form_resolver = $form_resolver;
		$this->config = $config;
		
		$this->registerObservers();
		$this->registerClasses();
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
		$this->form = call_user_func($this->form_resolver);
		
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
	 * Observe changes to attributes
	 *
	 * @param string $attribute
	 * @param callable $observer
	 * @return \Galahad\Aire\Aire
	 */
	public function registerAttributeObserver(string $attribute, callable $observer) : self
	{
		if (!isset($this->attribute_observers[$attribute])) {
			$this->attribute_observers[$attribute] = [];
		}
		
		$this->attribute_observers[$attribute][] = $observer;
		
		return $this;
	}
	
	public function callAttributeObservers(Element $element, string $attribute, $value = null) : self
	{
		if (isset($this->attribute_observers[$attribute])) {
			foreach ($this->attribute_observers[$attribute] as $observer) {
				$observer($element, $value);
			}
		}
		
		return $this;
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
		
		return $this->view_factory->make($view, $data, $merge_data);
	}
	
	protected function registerObservers() : self
	{
		// FIXME: This needs refactoring and tests — tests are passing but this doesn't work
		// Automatically set errors for named elements
		$this->registerAttributeObserver('name', function(Element $element, $name) {
			if (!in_array(Groupable::class, class_uses_recursive($element))) {
				return;
			}
			
			if (!$errors = $this->session_store->get('errors')) {
				return;
			}
			
			if (!$errors instanceof ViewErrorBag) {
				return;
			}
			
			if (!$errors->has($name)) {
				return;
			}
			
			/** @var Groupable $element */
			$element->errors($errors->get($name));
		});
		
		return $this;
	}
	
	protected function registerClasses() : self
	{
		ClassNames::setDefaultClasses($this->config('default_classes'));
		ClassNames::setValidationClasses($this->config('validation_classes'));
		
		return $this;
	}
}
