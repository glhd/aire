<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Aire;
use Galahad\Aire\Tests\TestCase;

class HelpersTest extends TestCase
{
	public function test_aire_helper(): void
	{
		$this->assertTrue(function_exists('aire'));
		$this->assertInstanceOf(Aire::class, aire());
	}
}
