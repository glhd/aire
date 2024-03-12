<?php

namespace Galahad\Aire\Tests\Components;

class NonStandardAttributesTest extends ComponentTestCase
{
	protected function setUp(): void
	{
		parent::setUp();
		
		if (
			version_compare($this->app->version(), '11.0.0', '>=')
			&& version_compare($this->app->version(), '11.0.1', '<')
		) {
			$this->markTestSkipped('There is a bug in Laravel 11.0.0 that breaks this test.');
		}
		
		if (
			version_compare($this->app->version(), '10.48.0', '>=')
			&& version_compare($this->app->version(), '10.48.2', '<')
		) {
			$this->markTestSkipped('There is a bug in Laravel 10.48.0-10.48.1 that breaks this test.');
		}
	}
	
	public function test_alpine_style_attributes(): void
	{
		$blade = '
			<x-aire::form 
				x-data="{ open: true }"
				x-init="baz"
				x-show.transition.in.duration.200ms.out.duration.50ms="!open"
				x-bind:type="input_type"
				x-bind:view-box.camel="viewBox"
				x-on:click="open = true"
				x-on:keydown.escape="open = false"
				:x-on:keyup="$keyup"
				:@click="$click"
				@click.away="open = false"
				x-transition:enter="transition ease-out duration-300"
				x-cloak
			/>
		';
		
		$form = $this->renderBlade($blade, ['keyup' => 'doKeyUp()', 'click' => 'doClick()']);
		
		$this->assertSelectorAttribute($form, 'form', 'x-data', '{ open: true }');
		$this->assertSelectorAttribute($form, 'form', 'x-init', 'baz');
		$this->assertSelectorAttribute($form, 'form', 'x-show.transition.in.duration.200ms.out.duration.50ms', '!open');
		$this->assertSelectorAttribute($form, 'form', 'x-bind:type', 'input_type');
		$this->assertSelectorAttribute($form, 'form', 'x-bind:view-box.camel', 'viewBox');
		$this->assertSelectorAttribute($form, 'form', 'x-on:click', 'open = true');
		$this->assertSelectorAttribute($form, 'form', 'x-on:keydown.escape', 'open = false');
		$this->assertSelectorAttribute($form, 'form', 'x-on:keyup', 'doKeyUp()');
		$this->assertSelectorAttribute($form, 'form', 'x-transition:enter', 'transition ease-out duration-300');
		$this->assertSelectorAttribute($form, 'form', 'x-cloak');
		
		// DOM Crawler doesn't like @-prefixed attributes, so we'll just check those strings
		$this->assertStringContainsString('@click="doClick()"', $form);
		$this->assertStringContainsString('@click.away="open = false"', $form);
	}
	
	public function test_livewire_style_attributes(): void
	{
		$blade = '
			<x-aire::form 
				wire:key="form_key"
				wire:click.prefetch="prefetch_click"
				wire:model.debounce.100ms="debounced_model"
				:wire:poll.500ms="$poll"
			/>
		';
		
		$form = $this->renderBlade($blade, ['poll' => 'poll_500ms']);
		
		$this->assertSelectorAttribute($form, 'form', 'wire:key', 'form_key');
		$this->assertSelectorAttribute($form, 'form', 'wire:click.prefetch', 'prefetch_click');
		$this->assertSelectorAttribute($form, 'form', 'wire:model.debounce.100ms', 'debounced_model');
		$this->assertSelectorAttribute($form, 'form', 'wire:poll.500ms', 'poll_500ms');
	}
}
