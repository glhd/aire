<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Support\Facades\Aire;
use Galahad\Aire\Tests\TestCase;

class GroupTest extends TestCase
{
	public function test_an_input_can_be_grouped()
	{
		$input = Aire::input();
		
		$expected = '<div>
				<input type="text" />
			</div>';
		
		$this->assertHTML($expected, $input);
	}
}
