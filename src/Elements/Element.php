<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\DTD\Concerns\HasGlobalAttributes;
use Illuminate\Contracts\Support\Htmlable;

abstract class Element implements Htmlable
{
	use HasGlobalAttributes;
	
	/**
	 * @var \Galahad\Aire\Elements\Attributes
	 */
	public $attributes;
	
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
	protected $default_attributes = [];
	
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
		
		$attributes = array_merge(
			$this->default_attributes,
			$aire->config("default_attributes.{$this->view}", [])
		);
		
		$attribute_listener = function($attribute, $value) use ($aire) {
			$aire->callAttributeObservers($this, $attribute, $value);
		};
		
		$default_classes = $aire->config("default_classes.{$this->view}");
		
		$this->attributes = new Attributes($attributes, $attribute_listener, $default_classes);
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
		$attributes = $this->attributes;
		
		return array_merge($this->view_data, $attributes->toArray(), compact('attributes'));
	}
}
