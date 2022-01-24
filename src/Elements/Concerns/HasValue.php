<?php

namespace Galahad\Aire\Elements\Concerns;

trait HasValue
{
	/**
	 * Set the default value
	 *
	 * @param $value
	 * @return \Galahad\Aire\Elements\Input
	 */
	public function defaultValue($value): self
	{
		$this->attributes->setDefault('value', $value);
		
		return $this;
	}
	
	/**
	 * @param $value
	 * @return $this
	 */
	public function value($value = null): self
	{
		$this->attributes->set('value', $value);
		
		return $this;
	}
}
