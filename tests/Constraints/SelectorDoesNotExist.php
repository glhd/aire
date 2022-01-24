<?php

namespace Galahad\Aire\Tests\Constraints;

class SelectorDoesNotExist extends CrawlerConstraint
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
		return "selector '{$this->selector}' does not exist";
	}
	
	protected function matches($html): bool
	{
		return 0 === $this->crawl($html)->filter($this->selector)->count();
	}
}
