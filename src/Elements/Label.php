<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

class Label extends Element
{
	protected $view = 'label';
	
	public function __construct(Aire $aire, string $text)
	{
		parent::__construct($aire);
		
		$this->view_data['text'] = $text;
	}
	
	public function for($id) : self
	{
		$this->attributes['for'] = $id;
		
		return $this;
	}
}
