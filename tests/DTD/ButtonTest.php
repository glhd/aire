<?php

/**
 * Portions of this code have been generated using Atom autocompletion data.
 *
 * @see https://github.com/atom/autocomplete-html
 *
 * Copyright (c) 2015 GitHub Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Galahad\Aire\Tests\DTD;

use Galahad\Aire\DTD\Button;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class ButtonTest extends TestCase
{
	public function test_auto_focus_flag_can_be_set_on_and_off(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$button->autoFocus();
		$this->assertSelectorAttribute($button, 'button', 'autofocus');
		
		$button->autoFocus(false);
		$this->assertSelectorAttributeMissing($button, 'button', 'autofocus');
	}
	
	public function test_disabled_flag_can_be_set_on_and_off(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$button->disabled();
		$this->assertSelectorAttribute($button, 'button', 'disabled');
		
		$button->disabled(false);
		$this->assertSelectorAttributeMissing($button, 'button', 'disabled');
	}
	
	public function test_form_attribute_can_be_set_and_unset(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$button->form($value);
		$this->assertSelectorAttribute($button, 'button', 'form', $value);
		
		$button->form(null);
		$this->assertSelectorAttributeMissing($button, 'button', 'form');
	}
	
	public function test_form_action_attribute_can_be_set_and_unset(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$button->formAction($value);
		$this->assertSelectorAttribute($button, 'button', 'formaction', $value);
		
		$button->formAction(null);
		$this->assertSelectorAttributeMissing($button, 'button', 'formaction');
	}
	
	public function test_form_enc_type_attribute_can_be_set_and_unset(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$button->formEncType('application/x-www-form-urlencoded');
		$this->assertSelectorAttribute($button, 'button', 'formenctype', 'application/x-www-form-urlencoded');
		
		$button->formEncType('multipart/form-data');
		$this->assertSelectorAttribute($button, 'button', 'formenctype', 'multipart/form-data');
		
		$button->formEncType('text/plain');
		$this->assertSelectorAttribute($button, 'button', 'formenctype', 'text/plain');
		
		$button->formEncType(null);
		$this->assertSelectorAttributeMissing($button, 'button', 'formenctype');
	}
	
	public function test_form_method_attribute_can_be_set_and_unset(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$button->formMethod('get');
		$this->assertSelectorAttribute($button, 'button', 'formmethod', 'get');
		
		$button->formMethod('post');
		$this->assertSelectorAttribute($button, 'button', 'formmethod', 'post');
		
		$button->formMethod(null);
		$this->assertSelectorAttributeMissing($button, 'button', 'formmethod');
	}
	
	public function test_form_no_validate_flag_can_be_set_on_and_off(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$button->formNoValidate();
		$this->assertSelectorAttribute($button, 'button', 'formnovalidate');
		
		$button->formNoValidate(false);
		$this->assertSelectorAttributeMissing($button, 'button', 'formnovalidate');
	}
	
	public function test_form_target_attribute_can_be_set_and_unset(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$button->formTarget('_blank');
		$this->assertSelectorAttribute($button, 'button', 'formtarget', '_blank');
		
		$button->formTarget('_parent');
		$this->assertSelectorAttribute($button, 'button', 'formtarget', '_parent');
		
		$button->formTarget('_self');
		$this->assertSelectorAttribute($button, 'button', 'formtarget', '_self');
		
		$button->formTarget('_top');
		$this->assertSelectorAttribute($button, 'button', 'formtarget', '_top');
		
		$button->formTarget(null);
		$this->assertSelectorAttributeMissing($button, 'button', 'formtarget');
	}
	
	public function test_name_attribute_can_be_set_and_unset(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$button->name($value);
		$this->assertSelectorAttribute($button, 'button', 'name', $value);
		
		$button->name(null);
		$this->assertSelectorAttributeMissing($button, 'button', 'name');
	}
	
	public function test_type_attribute_can_be_set_and_unset(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$button->type('button');
		$this->assertSelectorAttribute($button, 'button', 'type', 'button');
		
		$button->type('reset');
		$this->assertSelectorAttribute($button, 'button', 'type', 'reset');
		
		$button->type('submit');
		$this->assertSelectorAttribute($button, 'button', 'type', 'submit');
		
		$button->type(null);
		$this->assertSelectorAttributeMissing($button, 'button', 'type');
	}
	
	public function test_value_attribute_can_be_set_and_unset(): void
	{
		$button = new Button($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$button->value($value);
		$this->assertSelectorAttribute($button, 'button', 'value', $value);
		
		$button->value(null);
		$this->assertSelectorAttributeMissing($button, 'button', 'value');
	}
}
