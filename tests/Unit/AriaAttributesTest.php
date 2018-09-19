<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class AriaAttributesTest extends TestCase
{
	public function test_that_activedescendant_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaActivedescendant($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-activedescendant', $value);
	}
	
	public function test_that_atomic_can_be_set_and_unset()
	{
		$form = $this->aire()->form();
		
		$form->ariaAtomic('true');
		
		$this->assertSelectorAttribute($form, 'form', 'aria-atomic', 'true');
	}
	
	public function test_that_busy_can_be_set_and_unset()
	{
		$form = $this->aire()->form();
		
		$form->ariaBusy();
		
		$this->assertSelectorAttribute($form, 'form', 'aria-busy', 'true');
		
		$form->ariaBusy(false);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-busy', 'false');
	}
	
	public function test_that_controls_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaControls($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-controls', $value);
	}
	
	public function test_that_describedby_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaDescribedby($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-describedby', $value);
	}
	
	public function test_that_disabled_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaDisabled($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-disabled', $value);
	}
	
	public function test_that_dropeffect_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaDropeffect($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', $value);
	}
	
	public function test_that_flowto_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaFlowto($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-flowto', $value);
	}
	
	public function test_that_grabbed_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaGrabbed($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-grabbed', $value);
	}
	
	public function test_that_haspopup_can_be_set_and_unset()
	{
		$form = $this->aire()->form();
		
		$form->ariaHasPopup();
		
		$this->assertSelectorAttribute($form, 'form', 'aria-haspopup', 'true');
		
		$form->ariaHasPopup(false);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-haspopup', 'false');
	}
	
	public function test_that_hidden_can_be_set_and_unset()
	{
		$form = $this->aire()->form();
		
		$form->ariaHidden();
		
		$this->assertSelectorAttribute($form, 'form', 'aria-hidden', 'true');
		
		$form->ariaHidden(false);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-hidden', 'false');
	}
	
	public function test_that_invalid_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaInvalid($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-invalid', $value);
	}
	
	public function test_that_label_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaLabel($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-label', $value);
	}
	
	public function test_that_labelledby_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaLabelledby($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-labelledby', $value);
	}
	
	public function test_that_live_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaLive($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-live', $value);
	}
	
	public function test_that_owns_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaOwns($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-owns', $value);
	}
	
	public function test_that_relevant_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->ariaRelevant($value);
		
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', $value);
	}
}
