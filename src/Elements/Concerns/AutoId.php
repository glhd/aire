<?php

namespace Galahad\Aire\Elements\Concerns;

trait AutoId
{
	protected function registerAutoId()
	{
		// TODO: It should be possible to disable this
		$this->attributes->setDefault('id', function() {
			if ($name = $this->attributes->get('name')) {
				return "__aire-{$this->form->form_id}-{$name}";
			}
		});
	}
}
