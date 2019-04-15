<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\DTD\Concerns\HasGlobalAttributes;
use Galahad\Aire\Elements\Attributes\Collection;
use Galahad\Aire\Elements\Concerns\Groupable;
use Illuminate\Contracts\Support\Htmlable;

abstract class Element implements Htmlable
{
	use HasGlobalAttributes, Groupable;
	
	/**
	 * @var string
	 */
	public $name;
	
	/**
	 * @var \Galahad\Aire\Elements\Attributes\Collection
	 */
	public $attributes;
	
	/**
	 * @var int
	 */
	public $element_id;
	
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
	protected $default_attributes;
	
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
		$this->element_id = $aire->generateElementId();
		
		if ($form) {
			$this->form = $form;
			$this->initGroup();
		}
		
		$this->attributes = new Collection($aire, $this, $this->default_attributes);
		
		if ($form) {
			$this->registerMutators();
		}
	}
	
	/**
	 * Set a data attribute
	 *
	 * @param $data_key
	 * @param $value
	 * @return $this
	 */
	public function data($data_key, $value) : self
	{
		$key = "data-{$data_key}";
		
		if (null === $value) {
			if ($this->attributes->has($key)) {
				$this->attributes->unset($key);
			}
		} else {
			$this->attributes->set($key, $value);
		}
		
		return $this;
	}
	
	public function getInputName($default = null) : ?string
	{
		$name = $this->attributes->get('name', $default);
		
		if (null === $name) {
			return null;
		}
		
		return rtrim($name, '[]');
	}
	
	public function setAttribute($key, $value) : self
	{
		$this->attributes->set($key, $value);
		
		return $this;
	}
	
	public function addClass(...$class_name) : self
	{
		$this->attributes['class']->add(...$class_name);
		
		return $this;
	}
	
	public function removeClass(...$class_name) : self
	{
		$this->attributes['class']->remove(...$class_name);
		
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
			$this->attributes->primary()->toArray(), // Provide shortcuts to all attributes
			$this->view_data, // Override with view data
			[
				'attributes' => $this->attributes, // Ensure that $attributes always exists
				'validate' => $this->form ? $this->form->validate : false, // Set validation flag
			]
		);
	}
	
	/**
	 * Register default mutators
	 *
	 * @return \Galahad\Aire\Elements\Element
	 */
	protected function registerMutators() : self
	{
		if ($this->bind_value) {
			$this->attributes->setDefault('value', function() {
				return $this->form->getBoundValue($this->getInputName());
			});
		}
		
		// TODO: We may want to generate internal IDs to use here if no name exists
		$this->attributes->registerMutator('data-aire-for', function() {
			return $this->getInputName();
		});
		
		return $this;
	}
}
