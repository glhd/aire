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
	
	protected function createElement(string $element_class, array $parameters)
	{
		$this->element = $this->getElementInstance($element_class);
		
		collect($parameters)
			->filter()
			->each(function($arguments, $name) {
				$arguments = Arr::wrap($arguments);
				$this->element->{$name}(...$arguments);
			});
	}
	
	protected function getElementInstance(string $element_class): Element
	{
		$aire = Aire::getFacadeRoot();
		$form = $aire->form();
		
		if ($element_class === \Galahad\Aire\Elements\Form::class) {
			return $form;
		}
		
		return new $element_class($aire, $form);
	}
}
