<?php

namespace Galahad\Aire\Tests\Constraints;

use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\DomCrawler\Crawler;

abstract class CrawlerConstraint extends Constraint
{
	protected function crawl($html, $selector = null) : Crawler
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
		
		return $this->crawl($other, $selector)->html() . ' ' . $this->toString();
	}
}
