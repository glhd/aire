<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Support\Facades\Aire;
use Galahad\Aire\Tests\TestCase;

class AriaAttributesTest extends TestCase
{
	public function test_that_activedescendant_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaActiveDescendant('foo');
		
		$this->assertContains('aria-activedescendant="foo"', (string) $form);
	}
	
	public function test_that_atomic_can_be_set_and_unset()
	{
		$form = Aire::open();
		
		$form->ariaAtomic();
		
		$this->assertContains('aria-atomic', (string) $form);
		
		$form->ariaAtomic(false);
		
		$this->assertNotContains('aria-atomic', (string) $form);
	}
	
	public function test_that_busy_can_be_set_and_unset()
	{
		$form = Aire::open();
		
		$form->ariaBusy();
		
		$this->assertContains('aria-busy', (string) $form);
		
		$form->ariaBusy(false);
		
		$this->assertNotContains('aria-busy', (string) $form);
	}
	
	public function test_that_controls_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaControls('foo');
		
		$this->assertContains('aria-controls="foo"', (string) $form);
	}
	
	public function test_that_describedby_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaDescribedBy('foo');
		
		$this->assertContains('aria-describedby="foo"', (string) $form);
	}
	
	public function test_that_disabled_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaDisabled('foo');
		
		$this->assertContains('aria-disabled="foo"', (string) $form);
	}
	
	public function test_that_dropeffect_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaDropEffect('foo');
		
		$this->assertContains('aria-dropeffect="foo"', (string) $form);
	}
	
	public function test_that_flowto_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaFlowTo('foo');
		
		$this->assertContains('aria-flowto="foo"', (string) $form);
	}
	
	public function test_that_grabbed_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaGrabbed('foo');
		
		$this->assertContains('aria-grabbed="foo"', (string) $form);
	}
	
	public function test_that_haspopup_can_be_set_and_unset()
	{
		$form = Aire::open();
		
		$form->ariaHasPopup();
		
		$this->assertContains('aria-haspopup', (string) $form);
		
		$form->ariaHasPopup(false);
		
		$this->assertNotContains('aria-haspopup', (string) $form);
	}
	
	public function test_that_hidden_can_be_set_and_unset()
	{
		$form = Aire::open();
		
		$form->ariaHidden();
		
		$this->assertContains('aria-hidden', (string) $form);
		
		$form->ariaHidden(false);
		
		$this->assertNotContains('aria-hidden', (string) $form);
	}
	
	public function test_that_invalid_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaInvalid('foo');
		
		$this->assertContains('aria-invalid="foo"', (string) $form);
	}
	
	public function test_that_label_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaLabel('foo');
		
		$this->assertContains('aria-label="foo"', (string) $form);
	}
	
	public function test_that_labelledby_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaLabelledBy('foo');
		
		$this->assertContains('aria-labelledby="foo"', (string) $form);
	}
	
	public function test_that_live_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaLive('foo');
		
		$this->assertContains('aria-live="foo"', (string) $form);
	}
	
	public function test_that_owns_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaOwns('foo');
		
		$this->assertContains('aria-owns="foo"', (string) $form);
	}
	
	public function test_that_relevant_can_be_set()
	{
		$form = Aire::open();
		
		$form->ariaRelevant('foo');
		
		$this->assertContains('aria-relevant="foo"', (string) $form);
	}
}
