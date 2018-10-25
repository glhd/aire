<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\CreatesElements;
use Galahad\Aire\Elements\Concerns\CreatesInputTypes;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store;
use Illuminate\Support\HtmlString;

class Form extends \Galahad\Aire\DTD\Form
{
	use CreatesElements,
		CreatesInputTypes;
	
	public $bound_data;
	
	protected $default_attributes = [
		'action' => '',
		'method' => 'POST',
	];
	
	protected $opened = false;
	
	/**
	 * @var \Illuminate\Routing\UrlGenerator
	 */
	protected $url;
	
	/**
	 * @var \Illuminate\Session\Store
	 */
	protected $session_store;
	
	public function __construct(Aire $aire, UrlGenerator $url, Store $session_store = null)
	{
		parent::__construct($aire);
		
		$this->url = $url;
		
		if ($session_store) {
			$this->session_store = $session_store;
			$this->view_data['_token'] = $session_store->token();
		}
	}
	
	public function bind($bound_data) : self
	{
		$this->bound_data = $bound_data;
		
		return $this;
	}
	
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
	
	public function open() : self
	{
		ob_start();
		$this->opened = true;
		
		return $this;
	}
	
	public function close() : self
	{
		if (!$this->opened) {
			throw new \BadMethodCallException('Trying to close a form that hasn\'t been opened.');
		}
		
		$this->view_data['fields'] = new HtmlString(trim(ob_get_clean()));
		$this->opened = false;
		
		return $this;
	}
	
	public function route(string $route, array $parameters = [], bool $absolute = true) : self
	{
		$action = $this->url->route($route, $parameters, $absolute);
		
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
}
