<?php

namespace Galahad\Aire\Elements\Concerns;

use BadMethodCallException;
use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Group;

/**
 * @mixin \Galahad\Aire\Elements\Group
 */
trait Groupable
{
	public $group;
	
	protected $grouped = true;
	
	public function id($value = null) : Element
	{
		if ($value && $this->group->label) {
			$this->group->label->for($value);
		}
		
		$this->attributes['id'] = $value;
		
		return $this;
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
	
	protected function initGroup()
	{
		$this->grouped = $this->aire->config('group_by_default', true);
		$this->group = new Group($this->aire, $this->form, $this);
	}
}
