<?php

namespace Galahad\Aire\Elements;

class Label extends Element
{
	protected $view = 'label';
	
	public function text($text) : self
	{
		$this->view_data['text'] = $text;
		
		return $this;
	}
	
	public function for($id) : self
	{
		$this->attributes['for'] = $id;
		
		return $this;
	}
}
