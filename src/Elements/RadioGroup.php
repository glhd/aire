<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Concerns\AppliesIdToWrapper;
use Galahad\Aire\Elements\Concerns\HasOptions;
use Galahad\Aire\Elements\Concerns\HasValue;

class RadioGroup extends \Galahad\Aire\DTD\Input
{
	use HasValue, HasOptions, AppliesIdToWrapper;
	
	public $name = 'radio-group';
	
	protected $default_attributes = [
		'type' => 'radio',
	];
	
	/**
	 * Radio Group
	 *
	 * @param \Galahad\Aire\Aire $aire
	 * @param array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable $options
	 * @param \Galahad\Aire\Elements\Form|null $form
	 */
	public function __construct(Aire $aire, $options, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->setOptions($options);
	}
}
