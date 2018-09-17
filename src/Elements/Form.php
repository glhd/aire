<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Illuminate\Support\HtmlString;

class Form extends Element
{
	protected $view = 'form';
	
	protected $attributes = [
		'method' => 'POST',
	];
	
	protected $opened = false;
	
	public function __construct(Aire $aire)
	{
		parent::__construct($aire);
		
		if ($session = app('session')) {
			$this->data['token'] = $session->token();
		}
	}
	
	public function open() : self
	{
		ob_start();
		$this->opened = true;
		
		return $this;
	}
	
	public function close() : self
	{
		$this->data['fields'] = new HtmlString(trim(ob_get_clean()));
		$this->opened = false;
		
		return $this;
	}
	
	public function get() : self
	{
		$this->attributes['method'] = 'GET';
		
		return $this;
	}
	
	public function post() : self
	{
		$this->attributes['method'] = 'POST';
		
		return $this;
	}
	
	public function put() : self
	{
		$this->attributes['method'] = 'PUT';
		
		return $this;
	}
	
	public function patch() : self
	{
		$this->attributes['method'] = 'PATCH';
		
		return $this;
	}
	
	public function delete() : self
	{
		$this->attributes['method'] = 'DELETE';
		
		return $this;
	}
	
	protected function viewData()
	{
		$data = parent::viewData();
		
		if ('GET' !== $data['method']) {
			$data['attributes']['method'] = 'POST';
		}
		
		return $data;
	}
	
	public function __toString()
	{
		if ($this->opened) {
			return '';
		}
		
		return parent::__toString();
	}
}
