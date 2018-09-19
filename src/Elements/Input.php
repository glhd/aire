<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Elements\Concerns\Groupable;
use Galahad\Aire\Value\HasValue;

class Input extends \Galahad\Aire\DTD\Input
{
	use Groupable,
		HasValue;
	
	protected $attributes = [
		'type' => 'text',
	];
}
