<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

class Select extends \Galahad\Aire\DTD\Select
{
	public function __construct(Aire $aire, array $options, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->view_data['options'] = $options;
		
		$this->attributes->registerMutator('name', function($name) {
			return $this->attributes->get('multiple', false)
				? "{$name}[]"
				: $name;
		});
	}
}
