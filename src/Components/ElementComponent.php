<?php

namespace Galahad\Aire\Components;

use Galahad\Aire\Elements\Element;
use Galahad\Aire\Support\Facades\Aire;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

abstract class ElementComponent extends Component
{
	/**
	 * @var \Galahad\Aire\Elements\Element
	 */
	public $element;
	
	public function render()
	{
		return $this->element;
	}
	
	public function withAttributes(array $attributes)
	{
		parent::withAttributes($attributes);
		
		collect($this->attributes->getAttributes())
			->reject(function($arguments) {
				return null === $arguments;
			})
			->each(function($arguments, $name) {
				if (method_exists($this->element, $name)) {
					$arguments = Arr::wrap($arguments);
					$this->element->{$name}(...$arguments);
				} else {
					$this->element->setAttribute($name, $arguments);
				}
			});
		
		return $this;
	}
	
	protected function createElement(string $element_class, array $parameters)
	{
		$this->element = $this->getElementInstance($element_class);
		
		collect($parameters)
			->reject(function($arguments) {
				return null === $arguments;
			})
			->each(function($arguments, $name) {
				$arguments = Arr::wrap($arguments);
				$this->element->{$name}(...$arguments);
			});
	}
	
	protected function getElementInstance(string $element_class): Element
	{
		$aire = Aire::getFacadeRoot();
		
		return new $element_class($aire, $aire->form());
	}
}
