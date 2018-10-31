<?php

namespace Galahad\Aire\Tests;

use Galahad\Aire\Aire;
use Galahad\Aire\Support\AireServiceProvider;
use Galahad\Aire\Support\Facades\Aire as AireFacade;
use Galahad\Aire\Tests\Constraints\SelectorAttribute;
use Galahad\Aire\Tests\Constraints\SelectorContainsText;
use Galahad\Aire\Tests\Constraints\SelectorCount;
use Galahad\Aire\Tests\Constraints\SelectorDoesNotExist;
use Galahad\Aire\Tests\Constraints\SelectorExists;
use Galahad\Aire\Tests\Constraints\SelectorHasClassNames;
use Galahad\Aire\Tests\Constraints\SelectorMissingClassNames;
use Galahad\Aire\Tests\Constraints\SelectorTextEquals;
use Orchestra\Testbench\TestCase as Orchestra;
use Symfony\Component\DomCrawler\Crawler;

abstract class TestCase extends Orchestra
{
	protected function setUp()
	{
		parent::setUp();
		
		// Don't pollute test output with JS unless necessary
		$this->app['config']->set('aire.inline_validation', false);
		
		// Add encryption key for HTTP tests
		$this->app['config']->set('app.key', 'base64:tfsezwCu4ZRixRLA/+yL/qoouX++Q3lPAPOAbtnBCG8=');
	}
	
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
		static::assertThat($html, new SelectorExists($selector));
	}
	
	protected function assertSelectorDoesNotExist($html, $selector)
	{
		static::assertThat($html, new SelectorDoesNotExist($selector));
	}
	
	protected function assertSelectorCount($html, string $selector, int $expected_count)
	{
		static::assertThat($html, new SelectorCount($selector, $expected_count));
	}
	
	/**
	 * @deprecated
	 * @param $html
	 * @param string $selector
	 * @param string $text
	 */
	protected function assertSelectorText($html, string $selector, string $text)
	{
		$this->assertSelectorTextEquals($html, $selector, $text);
	}
	
	protected function assertSelectorTextEquals($html, string $selector, string $expected_text, bool $trim_actual = true)
	{
		static::assertThat($html, new SelectorTextEquals($selector, $expected_text, $trim_actual));
	}
	
	protected function assertSelectorContainsText($html, string $selector, string $expected_text, bool $match_case = true)
	{
		static::assertThat($html, new SelectorContainsText($selector, $expected_text, $match_case));
	}
	
	protected function assertSelectorMissingText($html, string $selector, string $text)
	{
		$actual = $this->crawl($html)
			->filter($selector)
			->text();
		
		$this->assertNotContains($text, trim($actual));
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
