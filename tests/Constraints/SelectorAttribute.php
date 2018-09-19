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
		parent::__construct();
		
		$this->selector = $selector;
		$this->attribute = $attribute;
		$this->value = $value;
	}
	
	public function toString(): string
	{
		$description = "selector '{$this->selector}' has the attribute '{$this->value}'";
		
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
		
		if (null !== $attribute && null === $this->value) {
			return true;
		}
		
		return $attribute === $this->value;
	}
}
