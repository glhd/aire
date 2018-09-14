<?php

namespace Galahad\Aire\Tests;

use Galahad\Aire\AireServiceProvider;
use Galahad\Aire\Facades\Aire;
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
}
