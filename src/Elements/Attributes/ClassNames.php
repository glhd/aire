<?php

namespace Galahad\Aire\Elements\Attributes;

use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Group;
use Illuminate\Support\Arr;

class ClassNames
{
	/**
	 * Configured default class names
	 *
	 * @var array
	 */
	protected static $default_classes = [];
	
	/**
	 * Configured validation class names
	 *
	 * @var array
	 */
	protected static $validation_classes = [];
	
	/**
	 * The element that this attribute is connected to
	 *
	 * This is necessary to automatically set class names based on
	 * defaults and validation state.
	 *
	 * @var \Galahad\Aire\Elements\Element
	 */
	protected $element;
	
	/**
	 * Manually applied class names
	 *
	 * @var string[]
	 */
	protected $class_names = [];
	
	/**
	 * Constructor
	 *
	 * @param \Galahad\Aire\Elements\Element $element
	 */
	public function __construct(Element $element)
	{
		$this->element = $element;
	}
	
	/**
	 * Set the configured default class names
	 *
	 * @param array $default_classes
	 */
	public static function setDefaultClasses(array $default_classes) : void
	{
		static::$default_classes = $default_classes;
	}
	
	/**
	 * Set the configured validation class names
	 *
	 * @param array $validation_classes
	 */
	public static function setValidationClasses(array $validation_classes) : void
	{
		static::$validation_classes = $validation_classes;
	}
	
	/**
	 * Set the class names
	 *
	 * @param null|string|array $class_names
	 * @return \Galahad\Aire\Elements\Attributes\ClassNames
	 */
	public function set($class_names) : self
	{
		if (null === $class_names) {
			$class_names = [];
		} else if (is_string($class_names)) {
			$class_names = explode(' ', $class_names);
		}
		
		$this->class_names = $class_names;
		
		return $this;
	}
	
	/**
	 * Add class(es) to the class list
	 *
	 * @param mixed ...$class_names
	 * @return \Galahad\Aire\Elements\Attributes\ClassNames
	 */
	public function add(...$class_names) : self
	{
		$this->class_names = array_unique(array_merge($this->class_names, $class_names));
		
		return $this;
	}
	
	/**
	 * Remove class(es) from the class list
	 *
	 * @param string[] ...$class_names
	 * @return \Galahad\Aire\Elements\Attributes\ClassNames
	 */
	public function remove(...$class_names) : self
	{
		$this->class_names = array_diff($this->class_names, $class_names);
		
		return $this;
	}
	
	/**
	 * Apply defaults, configured, and validation class names
	 *
	 * @return string
	 */
	public function __toString()
	{
		return implode(' ', array_unique(array_merge(
			$this->defaults(),
			$this->class_names,
			$this->validation()
		)));
	}
	
	/**
	 * Get default class names for this element
	 *
	 * @return null|string
	 */
	protected function defaults() : array
	{
		$element_key = $this->element->name;
		
		if ('textarea' === $element_key && !isset(static::$default_classes[$element_key])) {
			$element_key = 'input';
		}
		
		if (!isset(static::$default_classes[$element_key])) {
			return [];
		}
		
		return is_string(static::$default_classes[$element_key])
			? explode(' ', static::$default_classes[$element_key])
			: static::$default_classes[$element_key];
	}
	
	/**
	 * Get validation class names based on the group's validation state
	 *
	 * @return null|string
	 */
	protected function validation() : array
	{
		$element_key = $this->element->name;
		
		if ('textarea' === $element_key && !isset(static::$validation_classes[$element_key])) {
			$element_key = 'input';
		}
		
		$class_names = [];
		
		if ($this->element->group) {
			$key = "{$this->element->group->validation_state}.{$element_key}";
			$class_names = Arr::get(static::$validation_classes, $key, []);
		} else if ($this->element instanceof Group) {
			$key = "{$this->element->validation_state}.{$element_key}";
			$class_names = Arr::get(static::$validation_classes, $key, []);
		}
		
		if (is_string($class_names)) {
			$class_names = explode(' ', $class_names);
		}
		
		return $class_names;
	}
}
