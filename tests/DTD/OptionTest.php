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

use Galahad\Aire\DTD\Option;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class OptionTest extends TestCase
{
	public function test_disabled_flag_can_be_set_on_and_off(): void
	{
		$option = new Option($this->aire(), $this->aire()->form());
		
		$option->disabled();
		$this->assertSelectorAttribute($option, 'option', 'disabled');
		
		$option->disabled(false);
		$this->assertSelectorAttributeMissing($option, 'option', 'disabled');
	}
	
	public function test_label_attribute_can_be_set_and_unset(): void
	{
		$option = new Option($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$option->label($value);
		$this->assertSelectorAttribute($option, 'option', 'label', $value);
		
		$option->label(null);
		$this->assertSelectorAttributeMissing($option, 'option', 'label');
	}
	
	public function test_selected_flag_can_be_set_on_and_off(): void
	{
		$option = new Option($this->aire(), $this->aire()->form());
		
		$option->selected();
		$this->assertSelectorAttribute($option, 'option', 'selected');
		
		$option->selected(false);
		$this->assertSelectorAttributeMissing($option, 'option', 'selected');
	}
	
	public function test_value_attribute_can_be_set_and_unset(): void
	{
		$option = new Option($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$option->value($value);
		$this->assertSelectorAttribute($option, 'option', 'value', $value);
		
		$option->value(null);
		$this->assertSelectorAttributeMissing($option, 'option', 'value');
	}
}
