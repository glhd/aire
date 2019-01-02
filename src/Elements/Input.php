<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

class Input extends \Galahad\Aire\DTD\Input
{
	protected $default_attributes = [
		'type' => 'text',
	];
	
	public function __construct(Aire $aire, Form $form = null)
	{
		parent::__construct($aire, $form);
		
		$this->attributes->registerMutator('value', function($value) {
			if ($value instanceof \DateTime) {
				switch ($this->attributes->get('type')) {
					case 'date':
						return $value->format('Y-m-d');
					case 'datetime-local':
						return $value->format('Y-m-d\TH:i');
				}
			}
			
			return $value;
		});
	}
	
	public function type($value = null)
	{
		parent::type($value);
		
		if ('hidden' === $value) {
			$this->withoutGroup();
		}
		
		return $this;
	}
	
	/**
	 * Set the default value
	 *
	 * @param $value
	 * @return \Galahad\Aire\Elements\Input
	 */
	public function defaultValue($value) : self
	{
		$this->attributes['class']->default('value', $value);
		
		return $this;
	}
}
