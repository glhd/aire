<?php

namespace Galahad\Aire\Elements\Attributes;

use ArrayAccess;
use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Element;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;

/**
 * @mixin \Galahad\Aire\Elements\Attributes\Attributes
 */
class Collection implements Htmlable, Arrayable, ArrayAccess
{
	/**
	 * @var \Galahad\Aire\Aire
	 */
	protected $aire;
	
	/**
	 * @var \Galahad\Aire\Elements\Element
	 */
	protected $element;
	
	/**
	 * @var \Galahad\Aire\Elements\Attributes\Attributes[]
	 */
	protected $attributes = [];
	
	/**
	 * Constructor
	 *
	 * @param \Galahad\Aire\Aire $aire
	 * @param \Galahad\Aire\Elements\Element $element
	 * @param array|null $default_attributes
	 */
	public function __construct(Aire $aire, Element $element, array $default_attributes = null)
	{
		$this->aire = $aire;
		$this->element = $element;
		
		if ($default_attributes) {
			$this->instance($element->name, $default_attributes);
		}
	}
	
	/**
	 * Get all the attribute sets
	 *
	 * @return array
	 */
	public function toArray(): array
	{
		return $this->attributes;
	}
	
	/**
	 * Defer to the primary attributes' toHtml()
	 *
	 * @return string
	 */
	public function toHtml(): string
	{
		return $this->primary()->toHtml();
	}
	
	/**
	 * Get the primary attribute set
	 *
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function primary(): Attributes
	{
		return $this->instance($this->element->name);
	}
	
	/**
	 * Pass all other method calls to the primary attribute set
	 *
	 * @param $name
	 * @param $arguments
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{
		return $this->primary()->$name(...$arguments);
	}
	
	/**
	 * Lazy load attribute sets as needed
	 *
	 * @param string $name
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public function __get($name): Attributes
	{
		return $this->instance($name);
	}
	
	/**
	 * Set attributes
	 *
	 * @param string $name
	 * @param \Galahad\Aire\Elements\Attributes\Attributes $value
	 */
	public function __set($name, Attributes $value)
	{
		$this->attributes[$name] = $value;
	}
	
	/**
	 * Because attribute sets are created as needed, isset() is always true
	 *
	 * @param $name
	 * @return bool
	 */
	public function __isset($name)
	{
		return true;
	}
	
	/**
	 * Defer array access to primary attributes
	 * @inheritdoc
	 */
	#[\ReturnTypeWillChange]
	public function offsetExists($key)
	{
		return $this->primary()->offsetExists($key);
	}
	
	/**
	 * Defer array access to primary attributes
	 * @inheritdoc
	 */
	#[\ReturnTypeWillChange]
	public function offsetGet($key)
	{
		return $this->primary()->offsetGet($key);
	}
	
	/**
	 * Defer array access to primary attributes
	 * @inheritdoc
	 */
	#[\ReturnTypeWillChange]
	public function offsetSet($key, $value)
	{
		$this->primary()->offsetSet($key, $value);
	}
	
	/**
	 * Defer array access to primary attributes
	 * @inheritdoc
	 */
	#[\ReturnTypeWillChange]
	public function offsetUnset($key)
	{
		$this->primary()->offsetUnset($key);
	}
	
	/**
	 * Ensure that an instance of the attribute set exists & initialize it
	 *
	 * @param string $component
	 * @param array $defaults
	 * @return \Galahad\Aire\Elements\Attributes\Attributes
	 */
	protected function instance($component, $defaults = []): Attributes
	{
		$key = $component === $this->element->name
			? $component
			: "{$this->element->name}_{$component}";
		
		$key = str_replace('-', '_', $key);
		
		if (!isset($this->attributes[$key])) {
			$configured = $this->aire->config("default_attributes.{$key}", []);
			$computed = [
				'class' => new ClassNames($key, $this->element),
				'data-aire-component' => $component,
			];
			
			if ($key !== $component) {
				$computed['data-aire-validation-key'] = $key;
			}
			
			$this->attributes[$key] = tap(new Attributes($defaults, $configured, $computed))
				->registerMutator('data-aire-for', function() {
					return $this->element->getInputName();
				});
		}
		
		return $this->attributes[$key];
	}
}
