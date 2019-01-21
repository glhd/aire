<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\HasValue;
use Illuminate\Support\Arr;

class RadioGroup extends \Galahad\Aire\DTD\Input
{
	use HasValue;
	
	public $name = 'radio-group';
	
	protected $default_attributes = [
		'type' => 'radio',
	];
	
	public function __construct(Aire $aire, array $options, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->setOptions($options);
	}
	
	public function setOptions(array $options) : self
	{
		$this->view_data['options'] = Arr::isAssoc($options)
			? $options
			: array_combine($options, $options);
		
		return $this;
	}
}
