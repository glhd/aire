<?php

namespace Galahad\Aire\Elements\Concerns;

trait HasOptions
{
	/**
	 * Set options from a key -> value associative array
	 *
	 * @param array $options
	 * @return $this
	 */
	public function setOptions(array $options) : self
	{
		$this->view_data['options'] = $options;
		
		return $this;
	}
	
	/**
	 * Set options using value as key
	 *
	 * @param array $values
	 * @return $this
	 */
	public function setOptionList(array $values) : self
	{
		$this->view_data['options'] = array_combine($values, $values);
		
		return $this;
	}
}
