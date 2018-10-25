<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Elements\Concerns\Groupable;

class Input extends \Galahad\Aire\DTD\Input
{
	use Groupable;
	
	protected $default_attributes = [
		'type' => 'text',
	];
	
	protected function viewData()
	{
		$view_data = parent::viewData();
		
		switch ($view_data['type']) {
			case 'date':
				if ($view_data['value'] instanceof \DateTime) {
					$view_data['value'] = $view_data['value']->format('Y-m-d');
				}
				if ($view_data['attributes']['value'] instanceof \DateTime) {
					$view_data['attributes']['value'] = $view_data['attributes']['value']->format('Y-m-d');
				}
				break;
			
			case 'datetime-local':
				if ($view_data['value'] instanceof \DateTime) {
					$view_data['value'] = $view_data['value']->format('Y-m-d\TH:i');
				}
				if ($view_data['attributes']['value'] instanceof \DateTime) {
					$view_data['attributes']['value'] = $view_data['attributes']['value']->format('Y-m-d\TH:i');
				}
				break;
		}
		
		return $view_data;
	}
}
