<?php

namespace Galahad\Aire\Elements\Attributes;

use Galahad\Aire\Elements\Concerns\Groupable;
use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Group;
use Illuminate\Support\Arr;

class Classes
{
	protected static $default_classes = [];
	
	protected static $validation_classes = [];
	
	/**
	 * @var \Galahad\Aire\Elements\Element
	 */
	protected $element;
	
	/**
	 * @var string
	 */
	protected $class_names;
	
	public function __construct(Element $element)
	{
		$this->element = $element;
	}
	
	public static function setDefaultClasses(array $default_classes)
	{
		static::$default_classes = $default_classes;
	}
	
	public static function setValidationClasses(array $validation_classes)
	{
		static::$validation_classes = $validation_classes;
	}
	
	public function set(?string $class_names) : self
	{
		$this->class_names = $class_names;
		
		return $this;
	}
	
	public function __toString()
	{
		return implode(' ', array_filter([
			$this->defaults(),
			$this->class_names,
			$this->validation(),
		]));
	}
	
	protected function defaults() : ?string
	{
		return Arr::get(static::$default_classes, $this->element->name);
	}
	
	protected function validation() : ?string
	{
		if (property_exists($this->element, 'group')) {
			$key = "{$this->element->group->validation_state}.{$this->element->name}";
			return Arr::get(static::$validation_classes, $key);
		}
		
		return null;
	}
}
