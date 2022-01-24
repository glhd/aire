<?php

namespace Galahad\Aire\Elements\Attributes;

use Galahad\Aire\Elements\Element;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection as BaseCollection;

class ClassNames
{
	/**
	 * Configured default class names
	 *
	 * @var array
	 */
	protected static $default_classes = [];
	
	/**
	 * Configured variant class names
	 *
	 * @var array
	 */
	protected static $variant_classes = [];
	
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
	 * Class names that have been explicitly removed
	 *
	 * @var array
	 */
	protected $removed_class_names = [];
	
	/**
	 * The name of the element that this class list targets
	 *
	 * @var string
	 */
	protected $element_name;
	
	/**
	 * @var \Galahad\Aire\Elements\Element|null
	 */
	protected $element;
	
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
	 * @param \Galahad\Aire\Elements\Element|null $element
	 */
	public function __construct($element_name, Element $element = null)
	{
		$this->element_name = $element_name;
		$this->element = $element;
		$this->group = $element->group ?? null;
		
		$this->class_names = $this->defaults();
	}
	
	/**
	 * Set the configured default class names
	 *
	 * @param array $default_classes
	 */
	public static function setDefaultClasses(array $default_classes): void
	{
		static::$default_classes = $default_classes;
	}
	
	/**
	 * Set the configured variant class names
	 *
	 * @param array $variant_classes
	 */
	public static function setVariantClasses(array $variant_classes): void
	{
		static::$variant_classes = $variant_classes;
	}
	
	/**
	 * Set the configured validation class names
	 *
	 * @param array $validation_classes
	 */
	public static function setValidationClasses(array $validation_classes): void
	{
		static::$validation_classes = $validation_classes;
	}
	
	/**
	 * Set the class names
	 *
	 * @param null|string|array $class_names
	 * @return \Galahad\Aire\Elements\Attributes\ClassNames
	 */
	public function set($class_names): self
	{
		if (null === $class_names) {
			$class_names = [];
		} elseif (is_string($class_names)) {
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
	public function add(...$class_names): self
	{
		$this->class_names = array_unique(array_merge($this->class_names, $class_names));
		
		return $this;
	}
	
	/**
	 * Remove class(es) from the final output
	 *
	 * @param string[] ...$class_names
	 * @return \Galahad\Aire\Elements\Attributes\ClassNames
	 */
	public function remove(...$class_names): self
	{
		$this->removed_class_names = array_unique(array_merge($this->removed_class_names, $class_names));
		
		return $this;
	}
	
	/**
	 * Get all the computed class names, including defaults and validation-based names
	 *
	 * @return array
	 */
	public function all(): array
	{
		$computed_class_names = array_unique(array_merge(
			$this->class_names,
			$this->variantClassNames(),
			$this->validationClassNames()
		));
		
		return array_diff($computed_class_names, $this->removed_class_names);
	}
	
	/**
	 * Check if a class name is set (including validation & defaults)
	 *
	 * @param string ...$class_names
	 * @return bool
	 */
	public function has(string ...$class_names): bool
	{
		$all = $this->all();
		
		foreach ($class_names as $class_name) {
			if (!in_array($class_name, $all)) {
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Apply defaults, configured, and validation class names
	 *
	 * @return string
	 */
	public function __toString()
	{
		return implode(' ', $this->all());
	}
	
	/**
	 * Get default class names for this element
	 *
	 * @return null|string
	 */
	protected function defaults(): array
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
	 * Get variant class names based on the input's variant setting
	 *
	 * @return array
	 */
	protected function variantClassNames(): array
	{
		if (null === $this->element) {
			return [];
		}
		
		// Start with default always
		$variants = new BaseCollection('default');
		
		// Merge in other variants if they're set
		if ($variant = $this->element->getViewData('variant')) {
			$variants = $variants->merge((array) $variant);
		}
		
		$element_name = $this->element_name;
		
		if ('textarea' === $element_name && !isset(static::$validation_classes[$element_name])) {
			$element_name = 'input';
		}
		
		return $variants
			->map(function($variant) use ($element_name) {
				$key = "{$element_name}.{$variant}";
				$class_names = Arr::get(static::$variant_classes, $key, []);
				
				$optionallyExplode = function($class_names) {
					if (is_string($class_names)) {
						return explode(' ', $class_names);
					}
					
					return $class_names;
				};
				
				if (is_string($class_names) || !Arr::isAssoc($class_names)) {
					$class_names = [
						$variant => $class_names,
					];
				}
				
				return array_map($optionallyExplode, $class_names);
			})
			->reduce(function(BaseCollection $combined, $class_names) {
				return $combined->replaceRecursive($class_names);
			}, new BaseCollection())
			->flatten()
			->toArray();
	}
	
	/**
	 * Get validation class names based on the group's validation state
	 *
	 * @return array
	 */
	protected function validationClassNames(): array
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
