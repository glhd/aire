<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\CreatesElements;
use Galahad\Aire\Elements\Concerns\CreatesInputTypes;
use Galahad\Aire\Value\Defaults;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Session\Store;
use Illuminate\Support\HtmlString;

class Form extends \Galahad\Aire\DTD\Form
{
	use CreatesElements,
		CreatesInputTypes;
	
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
	
	public function __construct(Aire $aire, UrlGenerator $url, Store $session)
	{
		parent::__construct($aire);
		
		$this->defaults = new Defaults($session);
		
		$this->url = $url;
		
		if ($token = $session->token()) {
			$this->view_data['_token'] = $token;
		}
	}
	
	public function bind($bound_data) : self
	{
		$this->defaults->bind($bound_data);
		
		return $this;
	}
	
	public function getDefaultValue($name, $fallback = null)
	{
		return $this->defaults->get($name, $fallback = null);
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
	
	public function __toString()
	{
		if ($this->opened) {
			return '';
		}
		
		return parent::__toString();
	}
}
