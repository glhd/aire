<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\HasJsonValue;
use Galahad\Aire\Elements\Concerns\AppliesIdToWrapper;
use Galahad\Aire\Elements\Concerns\HasOptions;
use Galahad\Aire\Elements\Concerns\HasValue;
use Galahad\Aire\Elements\Concerns\MapsValueToJsonValue;

class CheckboxGroup extends \Galahad\Aire\DTD\Input implements HasJsonValue
{
	use HasValue;
	use HasOptions;
	use AppliesIdToWrapper;
	use MapsValueToJsonValue;
	
	public $name = 'checkbox-group';
	
	protected $default_attributes = [
		'type' => 'checkbox',
	];
	
	public function __construct(Aire $aire, $options, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->setOptions($options);
	}
}
