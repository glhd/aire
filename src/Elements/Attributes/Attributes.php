<?php

namespace Galahad\Aire\Elements\Attributes;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;

class Attributes implements Htmlable, ArrayAccess, Arrayable
{
	/**
	 * Attributes to except when generating HTML
	 *
	 * @var array
	 */
	protected $except = [];
	
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
	
	public function __construct(array $items)
	{
		$this->items = $items;
	}
	
	/**
	 * Register a mutator for an attribute
	 *
	 * When fetching the attribute, even if it does not exist, this mutator will
	 * be called. This provides an opportunity to mutate or calculate the value
	 * of the attribute based on outside data (for example, data binding).
	 *
	 * @param string $attribute
	 * @param callable $mutator
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function registerMutator(string $attribute, callable $mutator) : self
	{
		if (!isset($this->mutators[$attribute])) {
			$this->mutators[$attribute] = [];
		}
		
		$this->mutators[$attribute][] = $mutator;
		
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
		if ($this->offsetExists($key)) {
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
	public function has($key) : bool
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
	public function set($key, $value) : self
	{
		$this->offsetSet($key, $value);
		
		return $this;
	}
	
	/**
	 * @inheritdoc
	 *
	 * @param mixed $key
	 * @return bool
	 */
	public function offsetExists($key) : bool
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
	public function offsetGet($key)
	{
		$value = $this->items[$key] ?? null;
		
		if (isset($this->mutators[$key])) {
			foreach ($this->mutators[$key] as $mutator) {
				$value = $mutator($value);
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
	public function offsetSet($key, $value) : void
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
	public function offsetUnset($key) : void
	{
		unset($this->items[$key]);
	}
	
	/**
	 * Set a default/fallback value
	 *
	 * @param string $key
	 * @param $value
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function setDefault(string $key, $value) : self
	{
		$this->defaults[$key] = $value;
		
		return $this;
	}
	
	/**
	 * Exclude certain keys from being included when rendering to HTML
	 *
	 * @param mixed ...$keys
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function except(...$keys) : self
	{
		$this->except = array_merge($this->except, $keys);
		
		return $this;
	}
	
	/**
	 * Render attributes to key="value" pairs
	 *
	 * @return string
	 */
	public function toHtml() : string
	{
		return $this->toCollection()
			->except($this->except)
			->filter(function($value) {
				return false !== $value && null !== $value;
			})
			->map(function($value, $name) {
				if (true === $value) {
					return $name;
				}
				
				$name = strtolower($name);
				$value = e($value);
				
				return "{$name}=\"{$value}\"";
			})
			->implode(' ');
	}
	
	/**
	 * Get a collection of all attributes (after mutation)
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function toCollection() : Collection
	{
		return new Collection($this->toArray());
	}
	
	/**
	 * Get an array of all attributes (after mutation)
	 *
	 * @return array
	 */
	public function toArray() : array
	{
		$array = $this->items;
		
		foreach (array_keys($this->mutators) as $key) {
			$array[$key] = $this->offsetGet($key);
		}
		
		return $array;
	}
}
