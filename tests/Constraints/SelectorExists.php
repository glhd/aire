<?php

namespace Galahad\Aire\Tests\Constraints;

class SelectorExists extends CrawlerConstraint
{
	/**
	 * @var string
	 */
	protected $selector;
	
	public function __construct(string $selector)
	{
		$this->selector = $selector;
	}
	
	public function toString(): string
	{
		return "selector '{$this->selector}' exists";
	}
	
	protected function matches($html): bool
	{
		return $this->crawl($html)->filter($this->selector)->count() > 0;
	}
}
