<?php

namespace Galahad\Aire;

trait SelectableModel
{
	/**
	 * @inheritDoc
	 */
	public function getSelectableValue()
	{
		return $this->getKey();
	}
}
