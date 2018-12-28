<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\CreatesElements;
use Galahad\Aire\Elements\Concerns\CreatesInputTypes;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ViewErrorBag;

class Form extends \Galahad\Aire\DTD\Form
{
	use CreatesElements, CreatesInputTypes;
	
	/**
	 * Global "id" for use with JS targeting
	 *
	 * @var int
	 */
	protected static $next_form_id = 1;
	
	/**
	 * Data that's bound to the form
	 *
	 * @var object|\Illuminate\Database\Eloquent\Model|array
	 */
	public $bound_data;
	
	/**
	 * Forms are validated by default
	 *
	 * @var bool
	 */
	public $validate = true;
	
	/**
	 * @inheritdoc
	 */
	protected $default_attributes = [
		'action' => '',
		'method' => 'POST',
	];
	
	/**
	 * Forms are not grouped
	 *
	 * @var bool
	 */
	protected $grouped = false;
	
	/**
	 * Forms can either be open or closed, which determines how it's rendered
	 *
	 * @var bool
	 */
	protected $opened = false;
	
	/**
	 * @var \Galahad\Aire\Elements\Button
	 */
	protected $pending_button;
	
	/**
	 * @var \Illuminate\Routing\UrlGenerator
	 */
	protected $url;
	
	/**
	 * @var \Illuminate\Routing\Router
	 */
	protected $router;
	
	/**
	 * @var \Illuminate\Session\Store
	 */
	protected $session_store;
	
	public function __construct(Aire $aire, UrlGenerator $url, string $validation_src, Router $router = null, Store $session_store = null)
	{
		parent::__construct($aire);
		
		$this->url = $url;
		$this->router = $router;
		
		if ($session_store) {
			$this->session_store = $session_store;
			$this->view_data['_token'] = $session_store->token();
		}
		
		$this->initValidation($validation_src);
	}
	
	/**
	 * Bind data to the form
	 *
	 * This data will automatically be used to determine an Element's
	 * value if a value is not set, and no old input exists
	 *
	 * @param $bound_data
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function bind($bound_data) : self
	{
		$this->bound_data = $bound_data;
		
		return $this;
	}
	
	/**
	 * Get the bound value for an Element
	 *
	 * @param $name
	 * @param null $default
	 * @return mixed|null
	 */
	public function getBoundValue($name, $default = null)
	{
		$name = rtrim($name, '[]');
		
		// If old input is set, use that
		if ($this->session_store && $this->session_store->hasOldInput($name)) {
			return $this->session_store->getOldInput($name);
		}
		
		// If form has bound data, use that
		if ($bound_data = $this->bound_data) {
			$bound_value = is_object($bound_data)
				? object_get($bound_data, $name)
				: array_get($bound_data, $name);
			
			if ($bound_value) {
				return $bound_value;
			}
		}
		
		return $default;
	}
	
	/**
	 * Get any validation errors associated with an Element
	 *
	 * @param string $name
	 * @return array
	 */
	public function getErrors(string $name) : array
	{
		if (!$errors = $this->session_store->get('errors')) {
			return [];
		}
		
		if (!$errors instanceof ViewErrorBag) {
			return [];
		}
		
		if (!$errors->has($name)) {
			return [];
		}
		
		return $errors->get($name);
	}
	
	/**
	 * Open the form
	 *
	 * This will start output buffering until the form is closed
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function open() : self
	{
		ob_start();
		$this->opened = true;
		
		return $this;
	}
	
	/**
	 * Close the form
	 *
	 * This will end output buffering and set all the output to the 'fields'
	 * property in the view data
	 *
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function close() : self
	{
		if (!$this->opened) {
			throw new \BadMethodCallException('Trying to close a form that hasn\'t been opened.');
		}
		
		$this->view_data['fields'] = new HtmlString(trim(ob_get_clean()));
		$this->opened = false;
		
		return $this;
	}
	
	public function openButton() : Button
	{
		$this->pending_button = new Button($this->aire, $this);
		
		return $this->pending_button->open();
	}
	
	public function closeButton() : Button
	{
		if (!$this->pending_button) {
			throw new \BadMethodCallException('Trying to close a button that hasn\'t been opened.');
		}
		
		$button = $this->pending_button->close();
		
		$this->pending_button = null;
		
		return $button;
	}
	
	/**
	 * Set the form's action to a named route
	 *
	 * @param string $route_name
	 * @param array $parameters
	 * @param bool $absolute
	 * @return \Galahad\Aire\Elements\Form
	 */
	public function route(string $route_name, array $parameters = [], bool $absolute = true) : self
	{
		$action = $this->url->route($route_name, $parameters, $absolute);
		$this->action($action);
		
		$this->inferMethodFromRoute($route_name);
		
		return $this;
	}
	
	public function get() : self
	{
		$this->attributes['method'] = 'GET';
		unset($this->view_data['_method']);
		
		return $this;
	}
	
	public function post() : self
	{
		$this->attributes['method'] = 'POST';
		unset($this->view_data['_method']);
		
		return $this;
	}
	
	public function put() : self
	{
		$this->attributes['method'] = 'POST';
		$this->view_data['_method'] = 'PUT';
		
		return $this;
	}
	
	public function patch() : self
	{
		$this->attributes['method'] = 'POST';
		$this->view_data['_method'] = 'PATCH';
		
		return $this;
	}
	
	public function delete() : self
	{
		$this->attributes['method'] = 'POST';
		$this->view_data['_method'] = 'DELETE';
		
		return $this;
	}
	
	public function method($method = null)
	{
		if (method_exists($this, strtolower($method))) {
			return $this->$method();
		}
		
		return parent::method($method);
	}
	
	/**
	 * Enable client-side validation
	 *
	 * @return $this
	 */
	public function validate() : self
	{
		$this->validate = true;
		
		return $this;
	}
	
	/**
	 * Disable client-side validation
	 *
	 * @return $this
	 */
	public function withoutValidation() : self
	{
		$this->validate = false;
		
		return $this;
	}
	
	public function render() : string
	{
		if ($this->opened) {
			return '';
		}
		
		return parent::render();
	}
	
	protected function viewData() : array
	{
		return array_merge(parent::viewData(), ['validate' => $this->validate]);
	}
	
	protected function initGroup()
	{
		// Ignore for Form
	}
	
	protected function inferMethodFromRoute($route_name)
	{
		if ($this->attributes['method'] !== $this->default_attributes['method']) {
			return;
		}
		
		if (!$this->router) {
			return;
		}
		
		if (!$route = $this->router->getRoutes()->getByName($route_name)) {
			return;
		}
		
		$methods = array_filter($route->methods(), function($method) {
			return 'HEAD' !== $method;
		});
		
		if (!count($methods)) {
			return;
		}
		
		$method = strtolower($methods[0]);
		
		if (in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
			$this->$method();
		}
	}
	
	protected function initValidation(string $validation_src) : void
	{
		$this->data('aire-id', static::$next_form_id++);
		
		$this->validate = $this->aire->config('validate_by_default', true);
		
		$this->view_data['inline_validation'] = $this->aire->config('inline_validation', true);
		$this->view_data['validation_script_path'] = $this->aire->config('validation_script_path');
		$this->view_data['validation_src'] = $validation_src;
	}
}
