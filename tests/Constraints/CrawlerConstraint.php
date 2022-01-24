<?php

namespace Galahad\Aire\Tests\Constraints;

use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\DomCrawler\Crawler;

abstract class CrawlerConstraint extends Constraint
{
	public function evaluate($other, string $description = '', bool $returnResult = false): ?bool
	{
		try {
			return parent::evaluate($other, $description, $returnResult);
		} catch (\InvalidArgumentException $exception) {
			if ($returnResult) {
				return false;
			}
			
			$this->fail($other, $description);
		}
	}
	
	protected function crawl($html, $selector = null): Crawler
	{
		$crawler = $html instanceof Crawler
			? $html
			: new Crawler((string) $html);
		
		if ($selector) {
			$crawler = $crawler->filter($selector);
		}
		
		return $crawler;
	}
	
	protected function failureDescription($other): string
	{
		$selector = property_exists($this, 'selector')
			? $this->selector
			: null;
		
		try {
			return $this->crawl($other, $selector)->html().' '.$this->toString();
		} catch (\InvalidArgumentException $exception) {
			// Crawler throws an InvalidArgumentException if the selector returns an
			// empty Node list (which happens any time the selector can't be found).
		}
		
		return $other.' '.$this->toString();
	}
}
