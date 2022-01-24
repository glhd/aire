<?php

namespace Galahad\Aire\Tests\Constraints;

class SelectorContainsText extends CrawlerConstraint
{
	/**
	 * @var string
	 */
	protected $selector;
	
	/**
	 * @var string
	 */
	protected $expected_text;
	
	/**
	 * @var bool
	 */
	protected $match_case;
	
	public function __construct(string $selector, string $expected_text, bool $match_case = true)
	{
		$this->selector = $selector;
		$this->expected_text = $expected_text;
		$this->match_case = $match_case;
	}
	
	public function toString(): string
	{
		return "selector '{$this->selector}' contains the text content '$this->expected_text'";
	}
	
	protected function matches($html): bool
	{
		$nodes = $this->crawl($html, $this->selector);
		
		if (0 === $nodes->count()) {
			return false;
		}
		
		$actual_text = $nodes->text();
		
		return $this->match_case
			? false !== strpos($actual_text, $this->expected_text)
			: false !== stripos($actual_text, $this->expected_text);
	}
}
