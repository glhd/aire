<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\CreatesElements;
use Galahad\Aire\Elements\Concerns\CreatesInputTypes;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ViewErrorBag;

class Form extends \Galahad\Aire\DTD\Form
{
	use CreatesElements, CreatesInputTypes;
	
	/**
	 * Data that's bound to the form
	 *
	 * @var object|\Illuminate\Database\Eloquent\Model|array
	 */
	public $bound_data;
	
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
	 * @var \Illuminate\Routing\UrlGenerator
	 */
	protected $url;
	
	/**
	 * @var \Illuminate\Routing\RouteCollection
	 */
	protected $routes;
	
	/**
	 * @var \Illuminate\Session\Store
	 */
	protected $session_store;
	
	public function __construct(Aire $aire, UrlGenerator $url, RouteCollection $routes, Store $session_store = null)
	{
		parent::__construct($aire);
		
		$this->url = $url;
		$this->routes = $routes;
		
		if ($session_store) {
			$this->session_store = $session_store;
			$this->view_data['_token'] = $session_store->token();
		}
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
	
	public function render() : string
	{
		if ($this->opened) {
			return '';
		}
		
		return parent::render();
	}
	
	protected function initGroup()
	{
		// Ignore
	}
}
