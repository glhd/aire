<?php

namespace Galahad\Aire\Elements;

trait CreatesElements
{
	public function label(string $label) : Label
	{
		return (new Label($this->aire))->text($label);
	}
	
	public function button(string $label) : Button
	{
		return $this->injectDefaultValue(
			(new Button($this->aire, $this))->label($label)
		);
	}
	
	public function input($name = null, $label = null) : Input
	{
		return $this->injectDefaultValue(
			(new Input($this->aire, $this))
				->name($name)
				->label($label)
		);
	}
	
	/**
	 * Inject the default value for an element
	 *
	 * @param \Galahad\Aire\Elements\Element $element
	 * @return mixed
	 */
	protected function injectDefaultValue($element)
	{
		return tap($element, function(Element $element) {
			if (null !== $element->getAttribute('value')) {
				return;
			}
			
			if (!method_exists($element, 'value')) {
				return;
			}
			
			if (!$name = $element->getAttribute('name')) {
				return;
			}
			
			$default = $this->defaults->get($name);
			
			if (null !== $default) {
				$element->value($default);
			}
		});
	}
}
