<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

class Input extends \Galahad\Aire\DTD\Input
{
	protected $default_attributes = [
		'type' => 'text',
	];
	
	public function __construct(Aire $aire, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->attributes->registerMutator('value', function($value) {
			if ($value instanceof \DateTime) {
				switch ($this->attributes->get('type')) {
					case 'date':
						return $value->format('Y-m-d');
					case 'datetime-local':
						return $value->format('Y-m-d\TH:i');
				}
			}
			
			return $value;
		});
	}
}
