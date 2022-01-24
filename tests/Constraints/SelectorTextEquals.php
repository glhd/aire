<?php

namespace Galahad\Aire\Tests\Constraints;

class SelectorTextEquals extends CrawlerConstraint
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
	protected $trim_actual = true;
	
	public function __construct(string $selector, string $expected_text, bool $trim_actual = true)
	{
		$this->selector = $selector;
		$this->expected_text = $expected_text;
		$this->trim_actual = $trim_actual;
	}
	
	public function toString(): string
	{
		return "selector '{$this->selector}' has the text content '$this->expected_text'";
	}
	
	protected function matches($html): bool
	{
		$actual_text = $this->crawl($html)
			->filter($this->selector)
			->text();
		
		if ($this->trim_actual) {
			$actual_text = trim($actual_text);
		}
		
		return $actual_text === $this->expected_text;
	}
}
