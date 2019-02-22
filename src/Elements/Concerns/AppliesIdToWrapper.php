<?php

namespace Galahad\Aire\Elements\Concerns;

trait AppliesIdToWrapper
{
	public function id($value = null)
	{
		$this->attributes->wrapper['id'] = $value;
		
		return $this;
	}
}
