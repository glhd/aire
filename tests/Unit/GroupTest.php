<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Support\Facades\Aire;
use Galahad\Aire\Tests\TestCase;

class GroupTest extends TestCase
{
	public function test_an_input_can_be_grouped()
	{
		$input = Aire::input();
		
		$this->assertSelectorExists($input, 'div > input[type="text"]');
		$this->assertSelectorClassNames($input, 'div', ['p-2', 'm-2']);
	}
}
