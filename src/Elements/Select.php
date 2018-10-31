<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Illuminate\Support\Arr;

class Select extends \Galahad\Aire\DTD\Select
{
	public function __construct(Aire $aire, array $options, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->setOptions($options);
		
		$this->attributes->registerMutator('name', function($name) {
			return $this->attributes->get('multiple', false)
				? "{$name}[]"
				: $name;
		});
	}
	
	public function setOptions(array $options) : self
	{
		// FIXME: Needs tests
		$this->view_data['options'] = Arr::isAssoc($options)
			? $options
			: array_combine($options, $options);
		
		return $this;
	}
}
