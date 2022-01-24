<?php

namespace Galahad\Aire\Elements\Concerns;

trait AutoId
{
	protected function registerAutoId(): void
	{
		if (false === $this->aire->config('auto_id', true)) {
			return;
		}
		
		$this->attributes->setDefault('id', function() {
			return $this->aire->generateAutoId($this, $this->form);
		});
	}
}
