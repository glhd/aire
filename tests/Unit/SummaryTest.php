<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\View\View as BaseView;

class SummaryTest extends TestCase
{
	public function test_summaries_are_simple_by_default(): void
	{
		$test_message = Str::random();
		
		View::composer('aire::summary', function(BaseView $view) use ($test_message) {
			$view->withErrors(['foo' => $test_message]);
		});
		
		$html = $this->aire()->summary();
		
		$this->assertSelectorContainsText($html, '[data-aire-component=summary]', 'one error');
		$this->assertSelectorMissingText($html, '[data-aire-component=summary]', $test_message);
	}
	
	public function test_summaries_can_be_set_as_verbose(): void
	{
		$test_message = Str::random();
		
		View::composer('aire::summary', function(BaseView $view) use ($test_message) {
			$view->withErrors(['foo' => $test_message]);
		});
		
		$html = $this->aire()->summary()->verbose();
		
		$this->assertSelectorContainsText($html, '[data-aire-component=summary]', 'one error');
		$this->assertSelectorContainsText($html, '[data-aire-component=summary]', $test_message);
	}
	
	public function test_summaries_can_be_set_as_verbose_by_default(): void
	{
		Config::set('aire.verbose_summaries_by_default', true);
		
		$this->app->forgetInstance('galahad.aire');
		
		$test_message = Str::random();
		
		View::composer('aire::summary', function(BaseView $view) use ($test_message) {
			$view->withErrors(['foo' => $test_message]);
		});
		
		$html = $this->aire()->summary();
		
		$this->assertSelectorContainsText($html, '[data-aire-component=summary]', 'one error');
		$this->assertSelectorContainsText($html, '[data-aire-component=summary]', $test_message);
	}
}
