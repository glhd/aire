<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Elements\Concerns\Groupable;

class Input extends \Galahad\Aire\DTD\Input
{
	use Groupable;
	
	protected $default_attributes = [
		'type' => 'text',
	];
}
