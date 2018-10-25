<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

class Label extends \Galahad\Aire\DTD\Label
{
	/**
	 * @var \Galahad\Aire\Elements\Group
	 */
	public $group;
	
	public function __construct(Aire $aire, Group $group = null)
	{
		parent::__construct($aire);
		
		$this->group = $group;
	}
	
	public function text($text) : self
	{
		$this->view_data['text'] = $text;
		
		return $this;
	}
	
	public function render() : string
	{
		$this->inferForAttribute();
		
		return parent::render();
	}
	
	protected function inferForAttribute()
	{
		if (isset($this->attributes['for'])) {
			return;
		}
		
		if ($id = $this->group->element->getAttribute('id')) {
			$this->attributes['for'] = $id;
		}
	}
}
