<?php

namespace Galahad\Aire\Tests\Constraints;

class SelectorAttributeMissing extends CrawlerConstraint
{
	/**
	 * @var string
	 */
	protected $selector;
	
	/**
	 * @var string
	 */
	protected $attribute;
	
	public function __construct(string $selector, string $attribute)
	{
		$this->selector = $selector;
		$this->attribute = $attribute;
	}
	
	public function toString(): string
	{
		return "selector '{$this->selector}' does not have the attribute '{$this->attribute}'";
	}
	
	protected function matches($html): bool
	{
		$attribute = $this->crawl($html)
			->filter($this->selector)
			->attr($this->attribute);
		
		return null === $attribute;
	}
}
