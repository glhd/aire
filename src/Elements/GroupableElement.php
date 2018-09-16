<?php

namespace Galahad\Aire\Elements;

use Galahad\Aire\Aire;

abstract class GroupableElement extends Element
{
	protected $grouped = true;
	
	protected $group;
	
	public function __construct(Aire $aire)
	{
		parent::__construct($aire);
		
		$this->grouped = $aire->config('group_by_default', true);
		$this->group = new Group($this, $aire);
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
}
