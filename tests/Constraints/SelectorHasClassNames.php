<?php

namespace Galahad\Aire\Tests\Constraints;

class SelectorHasClassNames extends CrawlerConstraint
{
	/**
	 * @var string
	 */
	protected $selector;
	
	/**
	 * @var array
	 */
	protected $class_names;
	
	public function __construct(string $selector, $class_names)
	{
		$this->selector = $selector;
		$this->class_names = (array) $class_names;
	}
	
	public function toString(): string
	{
		$class_names = implode(' ', $this->class_names);
		
		return "selector '{$this->selector}' has the class names '$class_names'";
	}
	
	protected function matches($html): bool
	{
		$nodes = $this->crawl($html)->filter($this->selector);
		
		if (0 === $nodes->count()) {
			return false;
		}
		
		$actual = $nodes->attr('class');
		
		if (null === $actual) {
			return false;
		}
		
		$actual_class_names = explode(' ', $actual);
		
		$intersection = array_intersect($actual_class_names, $this->class_names);
		
		return count($this->class_names) === count($intersection);
	}
}
