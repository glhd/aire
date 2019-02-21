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
	 * Manually applied class names
	 *
	 * @var string[]
	 */
	protected $class_names = [];
	
	/**
	 * The name of the element that this class list targets
	 *
	 * @var string
	 */
	protected $element_name;
	
	/**
	 * If the class list is associated with a group, we can pull validation classes as well
	 *
	 * @var \Galahad\Aire\Elements\Group
	 */
	protected $group;
	
	/**
	 * Constructor
	 *
	 * @param string $element_name
	 * @param \Galahad\Aire\Elements\Group|null $group
	 */
	public function __construct($element_name, Group $group = null)
	{
		$this->element_name = $element_name;
		$this->group = $group;
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
		$element_name = $this->element_name;
		
		if ('textarea' === $element_name && !isset(static::$default_classes[$element_name])) {
			$element_name = 'input';
		}
		
		if (!isset(static::$default_classes[$element_name])) {
			return [];
		}
		
		return is_string(static::$default_classes[$element_name])
			? explode(' ', static::$default_classes[$element_name])
			: static::$default_classes[$element_name];
	}
	
	/**
	 * Get validation class names based on the group's validation state
	 *
	 * @return null|string
	 */
	protected function validation() : array
	{
		if (null === $this->group) {
			return [];
		}
		
		$element_name = $this->element_name;
		
		if ('textarea' === $element_name && !isset(static::$validation_classes[$element_name])) {
			$element_name = 'input';
		}
		
		$key = "{$this->group->validation_state}.{$element_name}";
		$class_names = Arr::get(static::$validation_classes, $key, []);
		
		if (is_string($class_names)) {
			$class_names = explode(' ', $class_names);
		}
		
		return $class_names;
	}
}
