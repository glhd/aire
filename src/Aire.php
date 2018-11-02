<?php

namespace Galahad\Aire;

use BadMethodCallException;
use Closure;
use Galahad\Aire\Elements\Attributes\ClassNames;
use Galahad\Aire\Elements\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Session\Store;
use Illuminate\Support\Arr;
use Illuminate\View\Factory;

/**
 * @method static \Galahad\Aire\Elements\Form bind($bound_data)
 * @method static mixed getBoundValue($name, $default = NULL)
 * @method static array getErrors(string $name)
 * @method static \Galahad\Aire\Elements\Form close()
 * @method static \Galahad\Aire\Elements\Form route(string $route_name, array $parameters = [], bool $absolute = true)
 * @method static \Galahad\Aire\Elements\Form get()
 * @method static \Galahad\Aire\Elements\Form post()
 * @method static \Galahad\Aire\Elements\Form put()
 * @method static \Galahad\Aire\Elements\Form patch()
 * @method static \Galahad\Aire\Elements\Form delete()
 * @method static mixed acceptCharset($value = NULL)
 * @method static mixed action($value = NULL)
 * @method static mixed autoComplete($value = NULL)
 * @method static mixed encType($value = NULL)
 * @method static mixed method($value = NULL)
 * @method static mixed name($value = NULL)
 * @method static mixed noValidate(bool $no_validate = true)
 * @method static mixed target($value = NULL)
 * @method static mixed getAttribute(string $attribute, $default = NULL)
 * @method static mixed data($key, $value)
 * @method static mixed toHtml()
 * @method static mixed accessKey($value = NULL)
 * @method static mixed class($value = NULL)
 * @method static mixed contentEditable(bool $content_editable = true)
 * @method static mixed contextMenu($value = NULL)
 * @method static mixed dir($value = NULL)
 * @method static mixed draggable($value = NULL)
 * @method static mixed dropZone($value = NULL)
 * @method static mixed hidden(bool $hidden = true)
 * @method static mixed id($value = NULL)
 * @method static mixed lang($value = NULL)
 * @method static mixed role($value = NULL)
 * @method static mixed spellCheck(bool $spell_check = true)
 * @method static mixed style($value = NULL)
 * @method static mixed tabIndex($value = NULL)
 * @method static mixed title($value = NULL)
 * @method static mixed ariaActiveDescendant($value = NULL)
 * @method static mixed ariaAtomic(bool $aria_atomic = true)
 * @method static mixed ariaBusy(bool $aria_busy = true)
 * @method static mixed ariaControls($value = NULL)
 * @method static mixed ariaDescribedBy($value = NULL)
 * @method static mixed ariaDisabled($value = NULL)
 * @method static mixed ariaDropEffect($value = NULL)
 * @method static mixed ariaFlowTo($value = NULL)
 * @method static mixed ariaGrabbed($value = NULL)
 * @method static mixed ariaHasPopup(bool $aria_has_popup = true)
 * @method static mixed ariaHidden(bool $aria_hidden = true)
 * @method static mixed ariaInvalid($value = NULL)
 * @method static mixed ariaLabel($value = NULL)
 * @method static mixed ariaLabelledBy($value = NULL)
 * @method static mixed ariaLive($value = NULL)
 * @method static mixed ariaOwns($value = NULL)
 * @method static mixed ariaRelevant($value = NULL)
 * @method static mixed grouped()
 * @method static mixed withoutGroup()
 * @method static \Galahad\Aire\Elements\Label label(string $label)
 * @method static \Galahad\Aire\Elements\Button button(string $label = null)
 * @method static \Galahad\Aire\Elements\Button submit(string $label = 'Submit')
 * @method static \Galahad\Aire\Elements\Input input($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Select select(array $options, $name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Textarea textArea($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Summary summary()
 * @method static \Galahad\Aire\Elements\Input checkbox($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input color($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input date($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input dateTime($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input dateTimeLocal($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input email($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input file($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input image($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input month($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input number($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input password($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input radio($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input range($name = NULL, $label = NULL, $min = 0, $max = 100)
 * @method static \Galahad\Aire\Elements\Input search($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input tel($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input time($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input url($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input week($name = NULL, $label = NULL)
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
