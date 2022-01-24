<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Factory;
use Mockery;

class ViewFindingTest extends TestCase
{
	public function test_group_and_element_view_finder_tries_most_specific_view_first(): void
	{
		$this->aire()->setViewFactory(
			$mock = Mockery::mock(Factory::class)
		);
		
		$mock_view = Mockery::mock(Renderable::class);
		
		$mock_view->shouldReceive('render')
			->twice()
			->andReturn('HTML');
		
		$mock->shouldReceive('first')
			->with(['aire::input.password', 'aire::input'], Mockery::andAnyOtherArgs())
			->once()
			->andReturn($mock_view);
		
		$mock->shouldReceive('first')
			->with(['aire::group.input.password', 'aire::group.input', 'aire::group'], Mockery::andAnyOtherArgs())
			->once()
			->andReturn($mock_view);
		
		$input = $this->aire()->form()->password()->grouped();
		
		$this->assertEquals('HTML', $input->toHtml());
	}
}
