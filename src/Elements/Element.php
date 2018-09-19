<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

abstract class Element implements Htmlable
{
	use HasGlobalAttributes,
		HasAriaAttributes;
	
	/**
	 * @var int
	 */
	protected static $id_suffix = 0;
	
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
	
	/**
	 * @var \Galahad\Aire\Elements\Form
	 */
	protected $form;
	
	public function __construct(Aire $aire, Form $form = null)
	{
		$this->aire = $aire;
		$this->form = $form;
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
		$attributes = $this->attributes;
		
		if (!isset($attributes['value']) && method_exists($this, 'getValue') && $value = $this->getValue()) {
			$attributes['value'] = $value;
		}
		
		return $attributes;
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
	
	protected function generateId() : string
	{
		$element_identifier = Str::snake(class_basename(static::class));
		$id = sprintf('aire_%s_%d', $element_identifier, self::$id_suffix);
		self::$id_suffix++;
		
		$this->id($id);
		
		return $id;
	}
}
