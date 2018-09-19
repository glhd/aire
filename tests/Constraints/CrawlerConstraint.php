<?php

namespace Galahad\Aire\Tests\Constraints;

use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\DomCrawler\Crawler;

abstract class CrawlerConstraint extends Constraint
{
	protected function crawl($html) : Crawler
	{
		return $html instanceof Crawler
			? $html
			: new Crawler((string) $html);
	}
	
	protected function failureDescription($other): string
	{
		return $this->crawl($other)->html() . ' ' . $this->toString();
	}
}
