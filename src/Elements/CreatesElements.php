<?php

namespace Galahad\Aire\Elements;

trait CreatesElements
{
	public function label(string $label) : Label
	{
		return $this->element(Label::class, func_get_args());
	}
	
	public function button(string $label) : Button
	{
		return $this->element(Button::class, func_get_args());
	}
	
	public function input($name = null, $label = null) : Input
	{
		return $this->element(Input::class, func_get_args());
	}
	
	protected function element($class_name, array $args)
	{
		/** @var \Galahad\Aire\Elements\Element $element */
		$element = new $class_name($this->aire, $this, ...$args);
		
		$needs_value = null === $element->getAttribute('value')
			&& method_exists($element, 'value');
		
		if ($needs_value && $name = $element->getAttribute('name')) {
			$default = $this->defaults->get($name);
			
			if (null !== $default) {
				$element->value($default);
			}
		}
		
		return $element;
	}
}
