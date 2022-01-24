<?php

namespace Galahad\Aire\Tests\Components;

class TimezoneSelectTest extends ComponentTestCase
{
	public function test_it_renders_timezones_as_expected(): void
	{
		$html = $this->renderBlade('<x-aire::timezone-select />');
		
		$this->assertSelectorTextEquals($html, 'option[value="Africa/Cairo"]', 'Africa - Cairo');
		$this->assertSelectorTextEquals($html, 'option[value="Africa/Lagos"]', 'Africa - Lagos');
		$this->assertSelectorTextEquals($html, 'option[value="America/Argentina/Buenos_Aires"]', 'America - Argentina - Buenos Aires');
		$this->assertSelectorTextEquals($html, 'option[value="America/Denver"]', 'America - Denver');
		$this->assertSelectorTextEquals($html, 'option[value="America/Indiana/Indianapolis"]', 'America - Indiana - Indianapolis');
		$this->assertSelectorTextEquals($html, 'option[value="America/Los_Angeles"]', 'America - Los Angeles');
		$this->assertSelectorTextEquals($html, 'option[value="America/Mexico_City"]', 'America - Mexico City');
		$this->assertSelectorTextEquals($html, 'option[value="America/New_York"]', 'America - New York');
		$this->assertSelectorTextEquals($html, 'option[value="America/Sao_Paulo"]', 'America - Sao Paulo');
		$this->assertSelectorTextEquals($html, 'option[value="Asia/Baghdad"]', 'Asia - Baghdad');
		$this->assertSelectorTextEquals($html, 'option[value="Asia/Hong_Kong"]', 'Asia - Hong Kong');
		$this->assertSelectorTextEquals($html, 'option[value="Asia/Tokyo"]', 'Asia - Tokyo');
		$this->assertSelectorTextEquals($html, 'option[value="Atlantic/Bermuda"]', 'Atlantic - Bermuda');
		$this->assertSelectorTextEquals($html, 'option[value="Australia/Sydney"]', 'Australia - Sydney');
		$this->assertSelectorTextEquals($html, 'option[value="Antarctica/McMurdo"]', 'Antarctica - McMurdo');
		$this->assertSelectorTextEquals($html, 'option[value="Europe/Amsterdam"]', 'Europe - Amsterdam');
		$this->assertSelectorTextEquals($html, 'option[value="Europe/Berlin"]', 'Europe - Berlin');
		$this->assertSelectorTextEquals($html, 'option[value="Europe/Dublin"]', 'Europe - Dublin');
		$this->assertSelectorTextEquals($html, 'option[value="Europe/Istanbul"]', 'Europe - Istanbul');
		$this->assertSelectorTextEquals($html, 'option[value="Europe/London"]', 'Europe - London');
		$this->assertSelectorTextEquals($html, 'option[value="Europe/Madrid"]', 'Europe - Madrid');
		$this->assertSelectorTextEquals($html, 'option[value="Europe/Moscow"]', 'Europe - Moscow');
		$this->assertSelectorTextEquals($html, 'option[value="Europe/Paris"]', 'Europe - Paris');
		$this->assertSelectorTextEquals($html, 'option[value="Indian/Maldives"]', 'Indian - Maldives');
		$this->assertSelectorTextEquals($html, 'option[value="Pacific/Honolulu"]', 'Pacific - Honolulu');
		$this->assertSelectorTextEquals($html, 'option[value="UTC"]', 'UTC');
	}
}
