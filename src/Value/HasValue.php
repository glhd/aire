<?php

namespace Galahad\Aire\Value;

use Galahad\Aire\Elements\FormElement;

trait HasValue
{
	/**
	 * Set the element's value
	 *
	 * @param $value
	 * @return $this
	 */
	public function value($value = null) : FormElement
	{
		$this->attributes['value'] = $value;
		
		return $this;
	}
	
	public function getDefaultValue($fallback = null)
	{
		if (!$name = $this->getAttribute('name')) {
			return $fallback;
		}
		
		return $this->form->getDefaultValue($name, $fallback);
	}
	
	/**
	 * Re-set the default value when setting name
	 *
	 * @param string $value
	 * @return $this
	 */
	public function name($value = null) : FormElement
	{
		$this->attributes['name'] = $value;
		
		if (null === $this->getAttribute('value')) {
			$default = $this->getDefaultValue();
			
			if (null !== $default) {
				$this->value($default);
			}
		}
		
		return $this;
	}
}
