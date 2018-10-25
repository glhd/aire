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
		
		$attributes = array_merge(
			$this->default_attributes,
			$aire->config("default_attributes.{$this->name}", []),
			['class' => new ClassNames($this)]
		);
		
		$this->attributes = new Attributes($attributes);
		
		if ($form) {
			$this->initForm($form);
		}
	}
	
	public function getAttribute(string $attribute, $default = null)
	{
		return Arr::get($this->attributes, $attribute, $default);
	}
	
	public function data($key, $value)
	{
		if (null === $value && isset($this->attributes["data-{$key}"])) {
			unset($this->attributes["data-{$key}"]);
		} else {
			$this->attributes["data-{$key}"] = $value;
		}
		
		return $this;
	}
	
	public function render() : string
	{
		return $this->aire->render(
			$this->name,
			$this->viewData()
		);
	}
	
	public function toHtml()
	{
		return $this->grouped && $this->group
			? $this->group->render()
			: $this->render();
	}
	
	public function __toString()
	{
		return $this->toHtml();
	}
	
	protected function viewData()
	{
		$attributes = $this->attributes;
		
		return array_merge(
			$attributes->toArray(),         // Provide shortcuts to all attributes
			$this->view_data,               // Override with view data
			compact('attributes')   // Finally, make sure $attributes is always available
		);
	}
	
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
		
		return $this;
	}
}
