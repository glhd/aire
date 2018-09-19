<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

class Label extends Element
{
	protected $view = 'label';
	
	/**
	 * @var \Galahad\Aire\Elements\Element
	 */
	protected $element;
	
	public function __construct(Aire $aire, Element $for, string $text)
	{
		parent::__construct($aire);
		
		$this->data['text'] = $text;
		$this->element = $for;
	}
	
	public function getAttributes() : array
	{
		$attributes = parent::getAttributes();
		
		if (!isset($attributes['for']) && $id = $this->element->getId()) {
			$attributes['for'] = $id;
		}
		
		return $attributes;
	}
}
