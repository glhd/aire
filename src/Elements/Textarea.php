<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\HasJsonValue;
use Galahad\Aire\Elements\Concerns\AutoId;
use Galahad\Aire\Elements\Concerns\HasValue;
use Galahad\Aire\Elements\Concerns\MapsValueToJsonValue;

class Textarea extends \Galahad\Aire\DTD\Textarea implements HasJsonValue
{
	use HasValue;
	use AutoId;
	use MapsValueToJsonValue;
	
	protected $view_data = [
		'auto_size' => false,
	];
	
	public function __construct(Aire $aire, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->registerAutoId();
	}
	
	public function autoSize(bool $auto_size = true): self
	{
		$this->view_data['auto_size'] = $auto_size;
		
		return $this;
	}
}
