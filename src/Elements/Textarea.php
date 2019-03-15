<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\AutoId;
use Galahad\Aire\Elements\Concerns\HasValue;

class Textarea extends \Galahad\Aire\DTD\Textarea
{
	use HasValue, AutoId;
	
	public function __construct(Aire $aire, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->registerAutoId();
	}
}
