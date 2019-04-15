<?php

namespace Galahad\Aire;

trait SelectableModel
{
	/**
	 * @inheritDoc
	 */
	public function getSelectableId()
	{
		return $this->getKey();
	}
}
