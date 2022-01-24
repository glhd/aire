<?php

namespace Galahad\Aire\Elements\Attributes;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * @property \Galahad\Aire\Elements\Attributes\ClassNames $class
 */
class Attributes implements Htmlable, ArrayAccess, Arrayable
{
	/**
	 * @var array
	 */
	protected $items;
	
	/**
	 * @var array
	 */
	protected $defaults = [];
	
	/**
	 * Callbacks to mutate attribute values
	 *
	 * @var array
	 */
	protected $mutators = [];
	
	/**
	 * Constructor
	 *
	 * @param array $items
	 */
	public function __construct(array ...$items)
	{
		$this->items = array_merge([], ...$items);
	}
	
	/**
	 * Register a mutator for an attribute
	 *
	 * When fetching the attribute, even if it does not exist, this mutator will
	 * be called. This provides an opportunity to mutate or calculate the value
	 * of the attribute based on outside data (for example, data binding).
	 *
	 * @param string|string[] $attributes
	 * @param callable $mutator
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function registerMutator($attributes, callable $mutator): self
	{
		foreach ((array) $attributes as $attribute) {
			if (!isset($this->mutators[$attribute])) {
				$this->mutators[$attribute] = [];
			}
			
			$this->mutators[$attribute][] = $mutator;
		}
		
		return $this;
	}
	
	/**
	 * Get an attribute value, optionally with a fallback default
	 *
	 * @param $key
	 * @param null $default
	 * @return mixed|null
	 */
	public function get($key, $default = null)
	{
		if (isset($this->defaults[$key]) || $this->offsetExists($key)) {
			return $this->offsetGet($key);
		}
		
		return value($default);
	}
	
	/**
	 * Check if an attribute exists
	 *
	 * @param $key
	 * @return bool
	 */
	public function has($key): bool
	{
		return $this->offsetExists($key);
	}
	
	/**
	 * Set an attribute value
	 *
	 * @param $key
	 * @param $value
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function set($key, $value): self
	{
		$this->offsetSet($key, $value);
		
		return $this;
	}
	
	/**
	 * Removes an attribute
	 *
	 * @param $key
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function unset($key): self
	{
		$this->offsetUnset($key);
		
		return $this;
	}
	
	/**
	 * @inheritdoc
	 *
	 * @param mixed $key
	 * @return bool
	 */
	#[\ReturnTypeWillChange]
	public function offsetExists($key): bool
	{
		if (isset($this->items[$key])) {
			return true;
		}
		
		if (isset($this->mutators[$key])) {
			return null !== $this->offsetGet($key);
		}
		
		return false;
	}
	
	/**
	 * @inheritdoc
	 *
	 * @param mixed $key
	 * @return mixed|null
	 */
	#[\ReturnTypeWillChange]
	public function offsetGet($key)
	{
		$value = $this->items[$key] ?? null;
		
		if (isset($this->mutators[$key])) {
			foreach ($this->mutators[$key] as $mutator) {
				$mutated = $mutator($value);
				if ('class' !== $key || null !== $mutated) {
					$value = $mutated;
				}
			}
		}
		
		// Use the default value if all else fails
		if (null === $value && isset($this->defaults[$key])) {
			return $this->defaults[$key];
		}
		
		return $value;
	}
	
	/**
	 * @inheritdoc
	 *
	 * @param mixed $key
	 * @param mixed $value
	 */
	#[\ReturnTypeWillChange]
	public function offsetSet($key, $value): void
	{
		if ('class' === $key) {
			$this->items['class']->set($value);
		} else {
			$this->items[$key] = $value;
		}
	}
	
	/**
	 * @inheritdoc
	 *
	 * @param mixed $key
	 */
	#[\ReturnTypeWillChange]
	public function offsetUnset($key): void
	{
		unset($this->items[$key]);
	}
	
	/**
	 * Get attribute using object notation
	 *
	 * @param $name
	 * @return mixed|null
	 */
	public function __get($name)
	{
		return $this->offsetGet($name);
	}
	
	/**
	 * Set attribute using object notation
	 *
	 * @param $name
	 * @param $value
	 */
	public function __set($name, $value)
	{
		$this->offsetSet($name, $value);
	}
	
	/**
	 * Check if attribute is set using object notation
	 *
	 * @param $name
	 * @return bool
	 */
	public function __isset($name)
	{
		return $this->offsetExists($name);
	}
	
	/**
	 * Unset attribute using object notation
	 *
	 * @param $name
	 */
	public function __unset($name)
	{
		$this->offsetUnset($name);
	}
	
	/**
	 * Set a default/fallback value
	 *
	 * @param string $attribute
	 * @param mixed|callable $default
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function setDefault(string $attribute, $default): self
	{
		// If the default value is a closure, register it as a mutator
		if ($default instanceof \Closure) {
			return $this->registerMutator($attribute, function($value) use ($default) {
				return $value ?? $default();
			});
		}
		
		$this->defaults[$attribute] = $default;
		
		return $this;
	}
	
	/**
	 * Check if the "value" attribute matches a given value
	 *
	 * This function will cast string values to the same type as the
	 * current "value" attribute ("1" === true, etc)
	 *
	 * @param mixed $check_value
	 * @return bool
	 */
	public function isValue($check_value): bool
	{
		if (null === $check_value) {
			return false;
		}
		
		$current_value = $this->get('value');
		
		if ($current_value instanceof Collection) {
			return $current_value->contains($check_value);
		}
		
		if (is_array($current_value)) {
			return in_array($check_value, $current_value, false);
		}
		
		/** @noinspection TypeUnsafeComparisonInspection **/
		return $check_value == $current_value;
	}
	
	/**
	 * Exclude certain keys from being included when rendering to HTML
	 *
	 * @param mixed ...$keys
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function except(...$keys): self
	{
		$filtered_attributes = new static(Arr::except($this->items, $keys));
		$filtered_attributes->defaults = Arr::except($this->defaults, $keys);
		$filtered_attributes->mutators = Arr::except($this->mutators, $keys);
		
		return $filtered_attributes;
	}
	
	/**
	 * Only use certain keys when rendering to HTML
	 *
	 * @param mixed ...$keys
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function only(...$keys): self
	{
		$filtered_attributes = new static(Arr::only($this->items, $keys));
		$filtered_attributes->defaults = Arr::only($this->defaults, $keys);
		$filtered_attributes->mutators = Arr::only($this->mutators, $keys);
		
		return $filtered_attributes;
	}
	
	/**
	 * Render attributes to key="value" pairs
	 *
	 * @return string
	 */
	public function toHtml(): string
	{
		return $this->toCollection()
			->filter(function($value, $key) {
				return (false !== $value || (false === $value && 'value' === $key))
					&& null !== $value
					&& !('' === $value && 'class' === $key)
					&& !is_array($value); // Array values have to be handled in associated component
			})
			->map(function($value, $name) {
				$name = strtolower($name);
				
				// Cast boolean values to '1' or '0'
				if ('value' === $name && is_bool($value)) {
					$value = $value ? '1' : '0';
				}
				
				return true === $value
					? $name
					: sprintf('%s="%s"', $name, e($value));
			})
			->implode(' ');
	}
	
	public function __toString()
	{
		return $this->toHtml();
	}
	
	/**
	 * Get a collection of all attributes (after mutation)
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function toCollection(): Collection
	{
		return new Collection($this->toArray());
	}
	
	/**
	 * Get an array of all attributes (after mutation, and with defaults)
	 *
	 * @return array
	 */
	public function toArray(): array
	{
		// We want to get values for keys that are in the attribute list,
		// but also need to load defaults and anything that has a mutator
		
		$keys = array_unique(array_merge(
			array_keys($this->items),
			array_keys($this->defaults),
			array_keys($this->mutators)
		));
		
		// Once we've loaded a list of all keys, we'll call offsetGet()
		// to apply mutators and default values
		
		$array = [];
		foreach ($keys as $key) {
			$array[$key] = $this->offsetGet($key);
		}
		
		return $array;
	}
}
