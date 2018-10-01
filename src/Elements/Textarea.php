<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Elements\Concerns\Groupable;
use Galahad\Aire\Value\HasValue;

class Textarea extends \Galahad\Aire\DTD\Textarea
{
	use Groupable,
		HasValue;
}
