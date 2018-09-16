<?php

namespace Galahad\Aire\Tests;

use Galahad\Aire\Support\AireServiceProvider;
use Galahad\Aire\Support\Facades\Aire;
use Orchestra\Testbench\TestCase as Orchestra;

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
			'Aire' => Aire::class,
		];
	}
	
	protected function assertHTML($expected, $actual)
	{
		$this->assertEquals(
			$this->normalizeHTML($expected),
			$this->normalizeHTML($actual)
		);
	}
	
	protected function normalizeHTML($html)
	{
		$trimmed = trim((string) $html);
		
		// Remove excess whitespace
		$normalized = preg_replace('/\s*\n\s*/m', ' ', $trimmed);
		
		// Remove trailing space in attribute list
		$normalized = str_replace(' >', '>', $normalized);
		
		return $normalized;
	}
}
