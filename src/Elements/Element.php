<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\DTD\Concerns\HasGlobalAttributes;
use Galahad\Aire\Elements\Attributes\Attributes;
use Galahad\Aire\Elements\Attributes\ClassNames;
use Galahad\Aire\Elements\Concerns\Groupable;
use Illuminate\Contracts\Support\Htmlable;
use stdClass;

// FIXME: Some elements need to have multiple components. Something like:
// FIXME: Group::$components = ['prepend']
// FIXME: On construct, we'll initialize attribute lists for each, and apply logic
// FIXME: to them. Wee need a good way of handling the JS side, though.
// FIXME: Each component could have a data-aire-component="prepend" attribute
// FIXME: that would let us apply classes to those components. And then we
// FIXME: just need to map the classname config to the components and diff the
// FIXME: Element.classList in some way. We may want to just calculate the states
// FIXME: initially, and just replace the whole list on render()

abstract class Element implements Htmlable
{
	use HasGlobalAttributes, Groupable;
	
	/**
	 * Additional components that need attribute and class name logic
	 *
	 * In the format 'component-alias' => Element::class
	 *
	 * @var array
	 */
	public static $components = [];
	
	/**
	 * @var string
	 */
	public $name;
	
	/**
	 * @var \Galahad\Aire\Elements\Attributes\Attributes
	 */
	public $attributes;
	
	/**
	 * @var \Galahad\Aire\Aire
	 */
	protected $aire;
	
	/**
	 * @var \Galahad\Aire\Elements\Form
	 */
	protected $form;
	
	/**
	 * @var array
	 */
	protected $default_attributes = [];
	
	/**
	 * @var array
	 */
	protected $view_data = [];
	
	/**
	 * Should we bind the value by default
	 *
	 * @var bool
	 */
	protected $bind_value = true;
	
	public function __construct(Aire $aire, Form $form = null)
	{
		$this->aire = $aire;
		
		if ($form) {
			$this->form = $form;
			$this->initGroup();
		}
		
		$this->attributes = new Attributes(array_merge(
			$this->default_attributes,
			$aire->config("default_attributes.{$this->name}", []),
			[
				'class' => new ClassNames($this->name, $this->group),
				'data-aire-component' => $this->name,
			]
		));
		
		if ($form) {
			$this->registerMutators();
		}
	}
	
	/**
	 * Set a data attribute
	 *
	 * @param $key
	 * @param $value
	 * @return $this
	 */
	public function data($key, $value) : self
	{
		$attribute = "data-{$key}";
		
		if (null === $value && isset($this->attributes[$attribute])) {
			unset($this->attributes[$attribute]);
		} else {
			$this->attributes[$attribute] = $value;
		}
		
		return $this;
	}
	
	public function setAttribute($key, $value) : self
	{
		$this->attributes->set($key, $value);
		
		return $this;
	}
	
	public function addClass(...$class_name) : self
	{
		$this->attributes->class->add(...$class_name);
		
		return $this;
	}
	
	public function removeClass(...$class_name) : self
	{
		$this->attributes->class->remove(...$class_name);
		
		return $this;
	}
	
	/**
	 * Render the Element to HTML
	 *
	 * @return string
	 */
	public function render() : string
	{
		return $this->aire->render(
			$this->name,
			$this->viewData()
		);
	}
	
	/**
	 * Render to HTML, including group if appropriate
	 *
	 * @return string
	 */
	public function toHtml() : string
	{
		return $this->grouped && $this->group
			? $this->group->render()
			: $this->render();
	}
	
	/**
	 * Alias for toHtml()
	 *
	 * @return string
	 */
	public function __toString() : string
	{
		return $this->toHtml();
	}
	
	/**
	 * Get the Element's view data
	 *
	 * @return array
	 */
	protected function viewData() : array
	{
		return array_merge(
			$this->attributes->toArray(), // Provide shortcuts to all attributes
			$this->view_data, // Override with view data
			[
				'attributes' => $this->attributes, // Ensure that $attributes always exists
				'validate' => $this->form ? $this->form->validate : false, // Set validation flag
				'components' => $this->components(),
			]
		);
	}
	
	protected function registerMutators() : self
	{
		if ($this->bind_value) {
			$this->attributes->setDefault('value', function() {
				return $this->form->getBoundValue($this->attributes->get('name'));
			});
		}
		
		$this->attributes->registerMutator('data-aire-for', function() {
			$name = $this instanceof Group
				? $this->element->attributes->get('name')
				: $this->attributes->get('name');
			
			return rtrim($name, '[]');
		});
		
		return $this;
	}
	
	protected function components() : stdClass
	{
		return (object) collect(static::$components)
			->mapWithKeys(function($component) {
				$key = "{$this->name}_{$component}";
				$attributes = new Attributes(array_merge(
					['data-aire-component' => $component],
					$this->aire->config("default_attributes.{$key}", []),
					['class' => new ClassNames($key, $this->group)]
				));
				
				$attributes->registerMutator('data-aire-for', function() {
					$name = $this instanceof Group
						? $this->element->attributes->get('name')
						: $this->attributes->get('name');
					
					return rtrim($name, '[]');
				});
				
				return [
					$component => $attributes,
				];
			})
			->all();
	}
}
