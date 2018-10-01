<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\DTD\Concerns\HasGlobalAttributes;
use Illuminate\Contracts\Support\Htmlable;

abstract class Element implements Htmlable
{
	use HasGlobalAttributes;
	
	/**
	 * @var \Galahad\Aire\Aire
	 */
	protected $aire;
	
	/**
	 * @var string
	 */
	protected $view;
	
	/**
	 * @var array
	 */
	protected $attributes = [];
	
	/**
	 * @var array
	 */
	protected $view_data = [];
	
	/**
	 * @var array
	 */
	protected $merge_data = [];
	
	public function __construct(Aire $aire)
	{
		$this->aire = $aire;
	}
	
	public function data($key, $value)
	{
		if (null === $value && isset($this->attributes["data-{$key}"])) {
			unset($this->attributes["data-{$key}"]);
		} else {
			$this->attributes["data-{$key}"] = $value;
		}
		
		return $this;
	}
	
	public function getAttribute($name, $default = null)
	{
		$attributes = $this->getAttributes();
		
		return $attributes[$name] ?? $default;
	}
	
	public function getAttributes() : array
	{
		return $this->attributes;
	}
	
	public function toHtml()
	{
		return (string) $this;
	}
	
	public function __toString()
	{
		return $this->aire->render(
			$this->view,
			$this->viewData(),
			$this->merge_data
		);
	}
	
	protected function viewData()
	{
		$default_attributes = $this->aire->config("default_attributes.{$this->view}", []);
		$attributes = array_merge($default_attributes, $this->getAttributes());
		
		if ($default_classes = $this->aire->config("default_classes.{$this->view}")) {
			$attributes['class'] = isset($attributes['class'])
				? "$default_classes {$attributes['class']}"
				: $default_classes;
		}
		
		return array_merge($this->view_data, $attributes, compact('attributes'));
	}
}
