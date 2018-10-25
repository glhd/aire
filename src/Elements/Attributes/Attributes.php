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
	 * Callbacks to mutate attribute values
	 *
	 * @var array
	 */
	protected $mutators = [];
	
	public function __construct(array $items)
	{
		$this->items = $items;
	}
	
	public function registerMutator(string $attribute, callable $mutator) : self
	{
		if (!isset($this->mutators[$attribute])) {
			$this->mutators[$attribute] = [];
		}
		
		$this->mutators[$attribute][] = $mutator;
		
		return $this;
	}
	
	public function get($key, $default = null)
	{
		if ($this->offsetExists($key)) {
			return $this->offsetGet($key);
		}
		
		return value($default);
	}
	
	public function has($key) : bool
	{
		return $this->offsetExists($key);
	}
	
	public function set($key, $value) : self
	{
		$this->offsetSet($key, $value);
		
		return $this;
	}
	
	public function offsetExists($key) : bool
	{
		if (isset($this->items[$key])) {
			return true;
		}
		
		if (isset($this->mutators[$key])) {
			return null !== call_user_func($this->mutators[$key], null);
		}
		
		return false;
	}
	
	public function offsetGet($key)
	{
		$value = $this->items[$key] ?? null;
		
		if (isset($this->mutators[$key])) {
			foreach($this->mutators[$key] as $mutator) {
				$value = $mutator($value);
			}
		}
		
		return $value;
	}
	
	public function offsetSet($key, $value) : void
	{
		if ('class' === $key) {
			$this->items['class']->set($value);
		} else {
			$this->items[$key] = $value;
		}
	}
	
	public function offsetUnset($key) : void
	{
		unset($this->items[$key]);
	}
	
	public function except(...$keys) : self
	{
		$this->except = array_merge($this->except, $keys);
		
		return $this;
	}
	
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
	
	public function toCollection() : Collection
	{
		return new Collection($this->toArray());
	}
	
	/**
	 * Get the instance as an array.
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
