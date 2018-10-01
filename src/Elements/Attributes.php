<?php

namespace Galahad\Aire\Elements;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;

class Attributes extends Collection implements Htmlable
{
	/**
	 * Attributes to excluding when generating HTML
	 *
	 * @var array
	 */
	protected $exclude = [];
	
	/**
	 * @var callable
	 */
	protected $attribute_listener;
	
	/**
	 * Default classes
	 *
	 * @var string
	 */
	protected $default_classes;
	
	public function __construct(array $items, callable $attribute_listener, string $default_classes = null)
	{
		parent::__construct($items);
		
		$this->default_classes = $default_classes;
		$this->attribute_listener = $attribute_listener;
	}
	
	public function offsetSet($key, $value)
	{
		if ($this->default_classes && 'class' === $key) {
			$value = "{$this->default_classes} {$value}";
		}
		
		parent::offsetSet($key, $value);
		
		if ($key) {
			call_user_func($this->attribute_listener, $key, $value);
		}
	}
	
	public function offsetUnset($key)
	{
		parent::offsetUnset($key);
		
		call_user_func($this->attribute_listener, $key, null);
	}
	
	public function excluding(...$keys)
	{
		$this->exclude = array_merge($this->exclude, $keys);
		
		return $this;
	}
	
	public function toHtml()
	{
		// TODO: We may not need Attributes to extend Collection — it doesn't really do what we need
		
		return collect($this->items)
			->filter(function($value, $name) {
				return !in_array($name, $this->exclude, false);
			})
			->filter(function($value) {
				return false !== $value && null !== $value;
			})
			->map(function($value) {
				return is_array($value)
					? implode(' ', $value)
					: $value;
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
}
