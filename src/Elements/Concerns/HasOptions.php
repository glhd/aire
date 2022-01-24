<?php

namespace Galahad\Aire\Elements\Concerns;

use Galahad\Aire\Support\OptionsCollection;

trait HasOptions
{
	/**
	 * Set options from a key -> value associative array
	 *
	 * @param array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable $options
	 * @return $this
	 */
	public function setOptions($options): self
	{
		$this->view_data['options'] = new OptionsCollection($options);
		
		return $this;
	}
	
	/**
	 * Set options using value as key
	 *
	 * @param array $values
	 * @return $this
	 */
	public function setOptionList(array $values): self
	{
		return $this->setOptions(array_combine($values, $values));
	}
	
	/**
	 * Push an option to the beginning of the list for "no value"
	 *
	 * @param string|\Illuminate\Contracts\Support\Htmlable $label
	 * @param mixed $empty_value
	 * @return \Galahad\Aire\Elements\Concerns\HasOptions
	 */
	public function prependEmptyOption($label, $empty_value = ''): self
	{
		$this->view_data['prepend_empty_option'] = (object) [
			'value' => $empty_value,
			'label' => $label,
		];
		
		return $this;
	}
}
