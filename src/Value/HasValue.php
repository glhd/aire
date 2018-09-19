<?php

namespace Galahad\Aire\Value;

trait HasValue
{
	public function value($value) : self
	{
		$this->attributes['value'] = $value;
		
		return $this;
	}
	
	public function name($name) : self
	{
		if (null === $this->getAttribute('value')) {
			$default = $this->defaults->get($name);
			
			if (null !== $default) {
				$element->value($default);
			}
		}
		
		return parent::name($name);
	}
}
