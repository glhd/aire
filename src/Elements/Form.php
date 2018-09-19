<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Value\Defaults;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;

class Form extends Element
{
	protected $view = 'form';
	
	protected $attributes = [
		'action' => '',
		'method' => 'POST',
	];
	
	protected $opened = false;
	
	/**
	 * @var \Galahad\Aire\Value\Defaults
	 */
	protected $defaults;
	
	/**
	 * @var \Illuminate\Routing\UrlGenerator
	 */
	protected $url;
	
	public function __construct(Aire $aire, UrlGenerator $url, Defaults $defaults)
	{
		parent::__construct($aire);
		
		if ($token = Session::token()) {
			$this->view_data['_token'] = $token;
		}
		
		$this->url = $url;
		$this->defaults = $defaults;
	}
	
	public function bind($bound_data) : self
	{
		$this->defaults->bind($bound_data);
		
		return $this;
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
	
	public function action(string $action) : self
	{
		$this->attributes['action'] = $action;
		
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
	
	public function __toString()
	{
		if ($this->opened) {
			return '';
		}
		
		return parent::__toString();
	}
}
