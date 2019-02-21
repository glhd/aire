<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\HasValue;
use Illuminate\Support\Arr;

class Select extends \Galahad\Aire\DTD\Select
{
	use HasValue;
	
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
	
	public function setOptions(array $options) : self
	{
		$this->view_data['options'] = Arr::isAssoc($options)
			? $options
			: array_combine($options, $options);
		
		return $this;
	}
}
