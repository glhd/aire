<?php

namespace Galahad\Aire\Tests\Constraints;

class SelectorMissingClassNames extends CrawlerConstraint
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
		
		return "selector '{$this->selector}' is missing the class names '$class_names'";
	}
	
	protected function matches($html): bool
	{
		$actual = $this->crawl($html)
			->filter($this->selector)
			->attr('class');
		
		if (null === $actual) {
			return true;
		}
		
		$actual_class_names = explode(' ', $actual);
		
		$intersection = array_intersect($actual_class_names, $this->class_names);
		
		return 0 === count($intersection);
	}
}
