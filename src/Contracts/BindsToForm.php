<?php

namespace Galahad\Aire\Contracts;

interface BindsToForm
{
	/**
	 * Get the data that should be used when binding this object to an Aire form
	 */
	public function getAireFormData(): array;
}
