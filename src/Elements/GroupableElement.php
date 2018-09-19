<?php

namespace Galahad\Aire\Elements;

use BadMethodCallException;
use Galahad\Aire\Aire;

/**
 * @mixin \Galahad\Aire\Elements\Group
 */
abstract class GroupableElement extends Element
{
	public $group;
	
	protected $grouped = true;
	
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
	
	public function __call($method_name, $arguments)
	{
		if ($this->grouped && method_exists($this->group, $method_name)) {
			$this->group->$method_name(...$arguments);
			
			return $this;
		}
		
		throw new BadMethodCallException(sprintf(
			'Method %s::%s does not exist on the element or Group.',
			class_basename(static::class),
			$method_name
		));
	}
}
