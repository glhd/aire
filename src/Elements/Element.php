<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\HasAriaAttributes;
use Galahad\Aire\Elements\Concerns\HasGlobalAttributes;
use Illuminate\Contracts\Support\Htmlable;

abstract class Element implements Htmlable
{
	use HasGlobalAttributes,
		HasAriaAttributes;
	
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
		$attributes = $this->getAttributes();
		
		return array_merge($this->view_data, $attributes, compact('attributes'));
	}
}
