<?php

namespace Galahad\Aire;

use BadMethodCallException;
use Closure;
use Galahad\Aire\Elements\Attributes\ClassNames;
use Galahad\Aire\Elements\Form;
use Illuminate\Session\Store;
use Illuminate\Support\Arr;
use Illuminate\View\Factory;

// TODO: Aire::scaffold(User::class, $action = null) -> generate a form from User attributes, default action = resource route
// TODO: Aire::scaffold($user) -> generate update form

/**
 * @method static \Galahad\Aire\Elements\Form route(string $route_name, $parameters = [], bool $absolute = true)
 * @method static \Galahad\Aire\Elements\Label label(string $label)
 * @method static \Galahad\Aire\Elements\Button button(string $label = null)
 * @method static \Galahad\Aire\Elements\Button submit(string $label = 'Submit')
 * @method static \Galahad\Aire\Elements\Input input($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Select select(array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable $options, $name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Select timezoneSelect($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Textarea textArea($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Summary summary(bool $verbose = true)
 * @method static \Galahad\Aire\Elements\Checkbox checkbox($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\CheckboxGroup checkboxGroup(array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable $options, $name, $label = null)
 * @method static \Galahad\Aire\Elements\RadioGroup radioGroup(array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable $options, $name, $label = null)
 * @method static \Galahad\Aire\Elements\Input hidden($name = null, $value = null)
 * @method static \Galahad\Aire\Elements\Input color($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input date($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input dateTime($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input dateTimeLocal($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input email($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input file($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input image($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input month($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input number($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input password($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input range($name = null, $label = null, $min = 0, $max = 100)
 * @method static \Galahad\Aire\Elements\Input search($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input tel($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input time($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input url($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Input week($name = null, $label = null)
 */
class Aire
{
	/**
	 * Global store of element IDs
	 *
	 * @var int
	 */
	protected $next_element_id = 0;
	
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
	protected $user_config;
	
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
		$this->user_config = $config;
		
		$default_theme_config = require dirname(__DIR__).'/config/default-theme.php';
		$this->setTheme('aire', null, $default_theme_config);
		
		$this->registerClasses();
	}
	
	/**
	 * Set where Aire looks for view files + any config overrides
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
	 * @param array|null $config
	 * @return \Galahad\Aire\Aire
	 */
	public function setTheme($namespace = null, $prefix = null, array $config = []) : self
	{
		$this->view_namespace = $namespace;
		$this->view_prefix = $prefix;
		$this->config = array_replace_recursive($config, $this->user_config);
		
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
	 * Close a new Form.
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function close() : Form
	{
		if (!($this->form instanceof Form)) {
			throw new BadMethodCallException('Trying to close a form before opening one.');
		}
		
		$this->form->close();
		
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
	 * Apply the current theme to a view's name
	 *
	 * @param string $view
	 * @return string
	 */
	public function applyTheme(string $view) : string
	{
		if ($this->view_prefix) {
			$view = "{$this->view_prefix}.{$view}";
		}
		
		if ($this->view_namespace) {
			$view = "{$this->view_namespace}::{$view}";
		}
		
		return $view;
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
		return $this->view_factory->make($this->applyTheme($view), $data, $merge_data)->render();
	}
	
	/**
	 * Get the next globally unique element ID
	 *
	 * @return int
	 */
	public function generateElementId() : int
	{
		return $this->next_element_id++;
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
		
		// @codeCoverageIgnoreStart
		if (!method_exists($form, $method_name)) {
			throw new BadMethodCallException(sprintf(
				'Method %s::%s does not exist.', static::class, $method_name
			));
		}
		// @codeCoverageIgnoreEnd
		
		return $form->$method_name(...$arguments);
	}
	
	/**
	 * Register the configured class names with the ClassName class
	 *
	 * @return \Galahad\Aire\Aire
	 */
	protected function registerClasses() : self
	{
		ClassNames::setDefaultClasses($this->config('default_classes', []));
		ClassNames::setValidationClasses($this->config('validation_classes', []));
		
		return $this;
	}
}
