<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\DTD\Concerns\HasGlobalAttributes;
use Galahad\Aire\Elements\Attributes\Attributes;
use Galahad\Aire\Elements\Attributes\ClassNames;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;

abstract class Element implements Htmlable
{
	use HasGlobalAttributes;
	
	/**
	 * @var string
	 */
	public $name;
	
	/**
	 * @var \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public $attributes;
	
	/**
	 * @var \Galahad\Aire\Aire
	 */
	protected $aire;
	
	/**
	 * @var array
	 */
	protected $default_attributes = [];
	
	/**
	 * @var array
	 */
	protected $view_data = [];
	
	public function __construct(Aire $aire)
	{
		$this->aire = $aire;
		
		$attributes = array_merge(
			$this->default_attributes,
			$aire->config("default_attributes.{$this->name}", []),
			['class' => new ClassNames($this)]
		);
		
		$attribute_listener = function($attribute, $value) use ($aire) {
			$aire->callAttributeObservers($this, $attribute, $value);
		};
		
		$this->attributes = new Attributes($attributes, $attribute_listener);
	}
	
	public function getAttribute(string $attribute, $default = null)
	{
		return Arr::get($this->attributes, $attribute, $default);
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
	
	public function render() : string
	{
		return $this->aire->render(
			$this->name,
			$this->viewData()
		);
	}
	
	public function toHtml()
	{
		return $this->render();
	}
	
	public function __toString()
	{
		return $this->render();
	}
	
	protected function viewData()
	{
		$attributes = $this->attributes;
		
		return array_merge(
			$attributes->toArray(),         // Provide shortcuts to all attributes
			$this->view_data,               // Override with view data
			compact('attributes')   // Finally, make sure $attributes is always available
		);
	}
}
