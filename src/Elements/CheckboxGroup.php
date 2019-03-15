<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\AppliesIdToWrapper;
use Galahad\Aire\Elements\Concerns\HasOptions;
use Galahad\Aire\Elements\Concerns\HasValue;

class CheckboxGroup extends \Galahad\Aire\DTD\Input
{
	use HasValue, HasOptions, AppliesIdToWrapper;
	
	public $name = 'checkbox-group';
	
	protected $default_attributes = [
		'type' => 'checkbox',
	];
	
	public function __construct(Aire $aire, array $options, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->setOptions($options);
	}
}
