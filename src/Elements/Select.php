<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\Groupable;

class Select extends \Galahad\Aire\DTD\Select
{
	use Groupable;
	
	public function __construct(Aire $aire, array $options, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->view_data['options'] = $options;
	}
	
	protected function viewData()
	{
		$view_data = parent::viewData();
		
		if ($this->attributes['multiple'] ?? false) {
			if (isset($view_data['name']) && '[]' !== substr($view_data['name'], -2)) {
				$view_data['name'] .= '[]';
			}
			if (isset($view_data['attributes']['name']) && '[]' !== substr($view_data['attributes']['name'], -2)) {
				$view_data['attributes']['name'] .= '[]';
			}
		}
		
		return $view_data;
	}
}
