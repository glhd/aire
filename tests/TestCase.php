<?php

namespace Galahad\Aire\Tests;

use Galahad\Aire\Aire;
use Galahad\Aire\Support\AireServiceProvider;
use Galahad\Aire\Support\Facades\Aire as AireFacade;
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
		
		$this->assertGreaterThan(0, $count);
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
		$actual = $this->crawl($html)
			->filter($selector)
			->attr($attribute);
		
		$this->assertNotNull($actual, "Selector '$selector' should have attribute '$attribute'");
		
		if ($value) {
			$this->assertEquals($value, $actual, "Selector '$selector' should have a '$attribute' with value'$value'");
		}
	}
	
	protected function assertSelectorClassNames($html, string $selector, $class_names)
	{
		$class_names = (array) $class_names;
		
		$actual = $this->crawl($html)
			->filter($selector)
			->attr('class');
		
		$this->assertNotNull($actual, "Selector '$selector' should have a class attribute");
		
		$actual_class_names = explode(' ', $actual);
		
		$intersection = array_intersect($actual_class_names, $class_names);
		
		$this->assertCount(
			count($intersection),
			$class_names,
			"Selector '$selector' should have all the classes '".implode(' ', $class_names)."'"
		);
	}
}
