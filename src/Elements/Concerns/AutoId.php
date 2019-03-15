<?php

namespace Galahad\Aire\Elements\Concerns;

trait AutoId
{
	protected function registerAutoId()
	{
		if (false === $this->aire->config('auto_id', true)) {
			return;
		}
		
		$this->attributes->setDefault('id', function() {
			$name = $this->getInputName($this->element_id);
			return "__aire-{$this->form->element_id}-{$name}";
		});
	}
}
