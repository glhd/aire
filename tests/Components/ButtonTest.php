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
 *
 */

namespace Galahad\Aire\Tests\Components;

use Galahad\Aire\DTD\Button;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class ButtonTest extends TestCase
{
	public function test_auto_focus_flag_can_be_set_on_and_off() : void
	{
		$button = $this->renderBlade('<x-aire::button auto-focus />');
		$this->assertSelectorAttribute($button, 'button', 'autofocus');
		
		$button = $this->renderBlade('<x-aire::button :auto-focus="false" />');
		$this->assertSelectorAttributeMissing($button, 'button', 'autofocus');
	}
	
	public function test_disabled_flag_can_be_set_on_and_off() : void
	{
		$button = $this->renderBlade('<x-aire::button disabled />');
		$this->assertSelectorAttribute($button, 'button', 'disabled');
		
		$button = $this->renderBlade('<x-aire::button :disabled="false" />');
		$this->assertSelectorAttributeMissing($button, 'button', 'disabled');
	}
	
	public function test_form_attribute_can_be_set_and_unset() : void
	{
		$value = Str::random();
		
		$button = $this->renderBlade('<x-aire::button form="'.$value.'" />');
		$this->assertSelectorAttribute($button, 'button', 'form', $value);
		
		$button = $this->renderBlade('<x-aire::button :form="null" />');
		$this->assertSelectorAttributeMissing($button, 'button', 'form');
	}
	
	public function test_form_action_attribute_can_be_set_and_unset() : void
	{
		$value = Str::random();
		
		$button = $this->renderBlade('<x-aire::button form-action="'.$value.'" />');
		$this->assertSelectorAttribute($button, 'button', 'formaction', $value);
		
		$button = $this->renderBlade('<x-aire::button :form-action="null" />');
		$this->assertSelectorAttributeMissing($button, 'button', 'formaction');
	}
	
	public function test_form_enc_type_attribute_can_be_set_and_unset() : void
	{
		$button = $this->renderBlade('<x-aire::button form-enc-type="application/x-www-form-urlencoded" />');
		$this->assertSelectorAttribute($button, 'button', 'formenctype', 'application/x-www-form-urlencoded');
		
		$button = $this->renderBlade('<x-aire::button form-enc-type="multipart/form-data" />');
		$this->assertSelectorAttribute($button, 'button', 'formenctype', 'multipart/form-data');
		
		$button = $this->renderBlade('<x-aire::button form-enc-type="text/plain" />');
		$this->assertSelectorAttribute($button, 'button', 'formenctype', 'text/plain');
		
		$button = $this->renderBlade('<x-aire::button :form-enc-type="null" />');
		$this->assertSelectorAttributeMissing($button, 'button', 'formenctype');
	}
	
	public function test_form_method_attribute_can_be_set_and_unset() : void
	{
		$button = $this->renderBlade('<x-aire::button form-method="get" />');
		$this->assertSelectorAttribute($button, 'button', 'formmethod', 'get');
		
		$button = $this->renderBlade('<x-aire::button form-method="post" />');
		$this->assertSelectorAttribute($button, 'button', 'formmethod', 'post');
		
		$button = $this->renderBlade('<x-aire::button :form-method="null" />');
		$this->assertSelectorAttributeMissing($button, 'button', 'formmethod');
	}
}
