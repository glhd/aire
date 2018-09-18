<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

/**
 * @mixin \Galahad\Aire\Elements\Group
 */
abstract class GroupableElement extends Element
{
	protected $grouped = true;
	
	public $group;
	
	public function __construct(Aire $aire)
	{
		parent::__construct($aire);
		
		$this->grouped = $aire->config('group_by_default', true);
		$this->group = new Group($aire, $this);
	}
	
	public function grouped() : self
	{
		$this->grouped = true;
		
		return $this;
	}
	
	public function withoutGroup() : self
	{
		$this->grouped = false;
		
		return $this;
	}
	
	public function __toString()
	{
		return $this->grouped
			? $this->group->__toString()
			: $this->renderInsideElement();
	}
	
	public function renderInsideElement()
	{
		return parent::__toString();
	}
	
	public function __call($name, $arguments)
	{
		$this->group->$name(...$arguments);
	}
}
