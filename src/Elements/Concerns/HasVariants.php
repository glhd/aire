<?php

namespace Galahad\Aire\Elements\Concerns;

use Galahad\Aire\Support\HigherOrderVariantProxy;

trait HasVariants
{
	/**
	 * Set the element variant
	 *
	 * @param string|null $variant
	 * @return \Galahad\Aire\Support\HigherOrderVariantProxy|\Galahad\Aire\Elements\Element|static|$this
	 */
	public function variant(string $variant = null)
	{
		if (null === $variant) {
			return new HigherOrderVariantProxy($this, function($variant) {
				$this->variant($variant);
			});
		}
		
		$this->view_data['variant'] = $variant;
		$this->attributes->primary()->class->variant($variant);
		
		return $this;
	}
}
