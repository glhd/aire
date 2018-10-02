<?php

namespace Galahad\Aire\Tests;

use Galahad\Aire\Aire;
use Galahad\Aire\Support\AireServiceProvider;
use Galahad\Aire\Support\Facades\Aire as AireFacade;
use Galahad\Aire\Tests\Constraints\SelectorAttribute;
use Galahad\Aire\Tests\Constraints\SelectorHasClassNames;
use Galahad\Aire\Tests\Constraints\SelectorMissingClassNames;
use Orchestra\Testbench\TestCase as Orchestra;
use Symfony\Component\DomCrawler\Crawler;

abstract class TestCase extends Orchestra
{
	protected function getPackageProviders($app)
	{
		return [
			AireServiceProvider::class,
		];
	}
	
	protected function getPackageAliases($app)
	{
		return [
			'Aire' => AireFacade::class,
		];
	}
	
	protected function aire() : Aire
	{
		return $this->app['galahad.aire'];
	}
	
	protected function crawl($html) : Crawler
	{
		return $html instanceof Crawler
			? $html
			: new Crawler((string) $html);
	}
	
	protected function assertSelectorExists($html, $selector)
	{
		$count = $this->crawl($html)
			->filter($selector)
			->count();
		
		$this->assertGreaterThan(0, $count, "Selector '$selector' should exist");
	}
	
	protected function assertSelectorDoesNotExist($html, $selector)
	{
		return $this->assertSelectorCount($html, $selector, 0);
	}
	
	protected function assertSelectorCount($html, string $selector, int $count)
	{
		$count = $this->crawl($html)
			->filter($selector)
			->count();
		
		$this->assertEquals($count, $count);
	}
	
	protected function assertSelectorText($html, string $selector, string $text)
	{
		$actual = $this->crawl($html)
			->filter($selector)
			->text();
		
		$this->assertEquals($text, trim($actual));
	}
	
	protected function assertSelectorAttribute($html, string $selector, string $attribute, string $value = null)
	{
		static::assertThat($html, new SelectorAttribute($selector, $attribute, $value));
	}
	
	protected function assertSelectorAttributeMissing($html, string $selector, string $attribute)
	{
		$actual = $this->crawl($html)
			->filter($selector)
			->attr($attribute);
		
		$this->assertNull($actual, "Selector '$selector' should not have attribute '$attribute'");
	}
	
	protected function assertSelectorClassNames($html, string $selector, $class_names)
	{
		static::assertThat($html, new SelectorHasClassNames($selector, $class_names));
	}
	
	protected function assertSelectorMissingClassNames($html, string $selector, $class_names)
	{
		static::assertThat($html, new SelectorMissingClassNames($selector, $class_names));
	}
}
