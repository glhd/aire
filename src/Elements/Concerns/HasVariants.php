<?php

namespace Galahad\Aire\Elements\Concerns;

use Galahad\Aire\Elements\Group;
use Galahad\Aire\Support\HigherOrderVariantProxy;

trait HasVariants
{
	/**
	 * Set the element variant
	 *
	 * @param string|array|null $variant
	 * @return \Galahad\Aire\Support\HigherOrderVariantProxy|\Galahad\Aire\Elements\Element|static|$this
	 */
	public function variant($variant = null)
	{
		if (null === $variant) {
			return new HigherOrderVariantProxy($this, function($variant) {
				$this->variant($variant);
			});
		}
		
		$this->view_data['variant'] = $variant;
		
		$this->applyVariantToGroup($variant);
		
		return $this;
	}
	
	/**
	 * Set multiple combined variants
	 *
	 * @param string ...$variants
	 * @return \Galahad\Aire\Elements\Concerns\HasVariants|\Galahad\Aire\Elements\Element|\Galahad\Aire\Support\HigherOrderVariantProxy
	 */
	public function variants(string ...$variants)
	{
		return $this->variant($variants);
	}
	
	/**
	 * @param array|string $variant
	 */
	protected function applyVariantToGroup($variant): void
	{
		if ($this->group instanceof Group) {
			$this->group->variant($variant);
		}
	}
}
