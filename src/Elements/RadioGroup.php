<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\HasOptions;
use Galahad\Aire\Elements\Concerns\HasValue;

class RadioGroup extends \Galahad\Aire\DTD\Input
{
	use HasValue, HasOptions;
	
	public $name = 'radio-group';
	
	protected $default_attributes = [
		'type' => 'radio',
	];
	
	public function __construct(Aire $aire, array $options, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->setOptions($options);
	}
}
