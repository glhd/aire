<?php

namespace Galahad\Aire\Tests\Constraints;

class SelectorAttribute extends CrawlerConstraint
{
	/**
	 * @var string
	 */
	protected $selector;
	
	/**
	 * @var string
	 */
	protected $attribute;
	
	/**
	 * @var string
	 */
	protected $value;
	
	public function __construct(string $selector, string $attribute, string $value = null)
	{
		$this->selector = $selector;
		$this->attribute = $attribute;
		$this->value = $value;
	}
	
	public function toString(): string
	{
		$description = "selector '{$this->selector}' has the attribute '{$this->attribute}'";
		
		if ($this->value) {
			$description .= " with the value '{$this->value}'";
		}
		
		return $description;
	}
	
	protected function matches($html): bool
	{
		$attribute = $this->crawl($html)
			->filter($this->selector)
			->attr($this->attribute);
		
		// If value is null, we're just checking for existence
		if (null === $this->value) {
			return null !== $attribute;
		}
		
		return $attribute === $this->value;
	}
}
