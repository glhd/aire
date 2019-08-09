<?php

namespace Galahad\Aire\Elements\Concerns;

trait HasVariants
{
	/**
	 * Set the element variant
	 *
	 * @param string|null $variant
	 * @return \Galahad\Aire\Elements\Element|static|$this
	 */
	public function variant(string $variant = null) : self
	{
		$this->view_data['variant'] = $variant;
		
		return $this;
	}
}
