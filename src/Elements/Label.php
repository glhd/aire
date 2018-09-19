<?php

namespace Galahad\Aire\Elements;

class Label extends \Galahad\Aire\DTD\Label
{
	public function text($text) : self
	{
		$this->view_data['text'] = $text;
		
		return $this;
	}
}
