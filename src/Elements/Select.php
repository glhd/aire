<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\HasOptions;
use Galahad\Aire\Elements\Concerns\HasValue;

class Select extends \Galahad\Aire\DTD\Select
{
	use HasValue, HasOptions;
	
	public function __construct(Aire $aire, array $options, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->setOptions($options);
		
		$this->attributes->registerMutator('name', function($name) {
			return $this->attributes->get('multiple', false)
				? rtrim($name, '[]').'[]'
				: $name;
		});
	}
}
