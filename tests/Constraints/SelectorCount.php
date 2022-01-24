<?php

namespace Galahad\Aire\Tests\Constraints;

class SelectorCount extends CrawlerConstraint
{
	/**
	 * @var string
	 */
	protected $selector;
	
	/**
	 * @var int
	 */
	protected $expected_count;
	
	public function __construct(string $selector, int $expected_count)
	{
		$this->selector = $selector;
		$this->expected_count = $expected_count;
	}
	
	public function toString(): string
	{
		$times = 1 === $this->expected_count ? 'time' : 'times';
		
		return "selector '{$this->selector}' appears {$this->expected_count} $times";
	}
	
	protected function matches($html): bool
	{
		return $this->crawl($html)->filter($this->selector)->count() === $this->expected_count;
	}
}
