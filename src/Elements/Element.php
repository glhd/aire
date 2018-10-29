<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\DTD\Concerns\HasGlobalAttributes;
use Galahad\Aire\Elements\Attributes\Attributes;
use Galahad\Aire\Elements\Attributes\ClassNames;
use Galahad\Aire\Elements\Concerns\Groupable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;

abstract class Element implements Htmlable
{
	use HasGlobalAttributes, Groupable;
	
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
	
	public function __construct(Aire $aire, Form $form = null)
	{
		$this->aire = $aire;
		
		$this->attributes = new Attributes(array_merge(
			$this->default_attributes,
			$aire->config("default_attributes.{$this->name}", []),
			['class' => new ClassNames($this)]
		));
		
		if ($form) {
			$this->initForm($form);
		}
	}
	
	/**
	 * Get an Element's attribute
	 *
	 * @param string $attribute
	 * @param null $default
	 * @return mixed
	 */
	public function getAttribute(string $attribute, $default = null)
	{
		return Arr::get($this->attributes, $attribute, $default);
	}
	
	/**
	 * Set a data attribute
	 *
	 * @param $key
	 * @param $value
	 * @return $this
	 */
	public function data($key, $value)
	{
		if (null === $value && isset($this->attributes["data-{$key}"])) {
			unset($this->attributes["data-{$key}"]);
		} else {
			$this->attributes["data-{$key}"] = $value;
		}
		
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
	public function toHtml()
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
	public function __toString()
	{
		return $this->toHtml();
	}
	
	/**
	 * Get the Element's view data
	 *
	 * @return array
	 */
	protected function viewData()
	{
		$attributes = $this->attributes;
		
		return array_merge(
			$attributes->toArray(), // Provide shortcuts to all attributes
			$this->view_data, // Override with view data
			[
				'attributes' => $attributes, // Ensure that $attributes always exists
				'validate' => $this->form ? $this->form->validate : false, // Set validation flag
			],
		);
	}
	
	/**
	 * Run additional initialization if the Element is associated with a Form
	 *
	 * @param \Galahad\Aire\Elements\Form $form
	 * @return \Galahad\Aire\Elements\Element
	 */
	protected function initForm(Form $form) : self
	{
		$this->form = $form;
		
		$this->initGroup();
		
		$this->attributes->registerMutator('value', function($value) {
			if (null !== $value || !$this->attributes->has('name')) {
				return $value;
			}
			
			return $this->form->getBoundValue($this->attributes->get('name'));
		});
		
		$this->attributes->registerMutator('data-validate', function() {
			return $this->form->validate ? 'true' : 'false';
		});
		
		return $this;
	}
}
