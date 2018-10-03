<?php

namespace Galahad\Aire\Elements;

class Summary extends Element
{
	public $name = 'summary';
	
	protected $view_data = [
		'verbose' => false,
	];
	
	public function verbose(bool $verbose = true) : self
	{
		$this->view_data['verbose'] = $verbose;
		
		return $this;
	}
}
