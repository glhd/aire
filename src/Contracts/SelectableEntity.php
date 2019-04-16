<?php

namespace Galahad\Aire\Contracts;

interface SelectableEntity
{
	/**
	 * Get the value that should be included if this entity is selected from a list
	 *
	 * @return mixed
	 */
	public function getSelectableValue();
	
	/**
	 * Get the label to be shown in a list for selection
	 *
	 * @return string|\Illuminate\Contracts\Support\Htmlable
	 */
	public function getSelectableLabel();
}
