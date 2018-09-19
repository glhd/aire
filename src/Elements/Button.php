<?php

namespace Galahad\Aire\Elements;

class Button extends \Galahad\Aire\DTD\Button
{
	public function label(string $label) : self
	{
		$this->view_data['label'] = $label;
		
		return $this;
	}
}
