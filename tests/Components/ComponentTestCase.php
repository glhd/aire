<?php

namespace Galahad\Aire\Tests\Components;

use Galahad\Aire\Tests\TestCase;

abstract class ComponentTestCase extends TestCase
{
	protected function setUp(): void
	{
		parent::setUp();
		
		if (version_compare($this->app->version(), '8.0.0', '<')) {
			$this->markTestSkipped('Only applies to Laravel 8 and higher.');
		}
	}
}
