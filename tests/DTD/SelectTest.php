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

use Galahad\Aire\DTD\Select;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class SelectTest extends TestCase
{
	public function test_auto_focus_flag_can_be_set_on_and_off(): void
	{
		$select = new Select($this->aire(), $this->aire()->form());
		
		$select->autoFocus();
		$this->assertSelectorAttribute($select, 'select', 'autofocus');
		
		$select->autoFocus(false);
		$this->assertSelectorAttributeMissing($select, 'select', 'autofocus');
	}
	
	public function test_disabled_flag_can_be_set_on_and_off(): void
	{
		$select = new Select($this->aire(), $this->aire()->form());
		
		$select->disabled();
		$this->assertSelectorAttribute($select, 'select', 'disabled');
		
		$select->disabled(false);
		$this->assertSelectorAttributeMissing($select, 'select', 'disabled');
	}
	
	public function test_form_attribute_can_be_set_and_unset(): void
	{
		$select = new Select($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$select->form($value);
		$this->assertSelectorAttribute($select, 'select', 'form', $value);
		
		$select->form(null);
		$this->assertSelectorAttributeMissing($select, 'select', 'form');
	}
	
	public function test_multiple_flag_can_be_set_on_and_off(): void
	{
		$select = new Select($this->aire(), $this->aire()->form());
		
		$select->multiple();
		$this->assertSelectorAttribute($select, 'select', 'multiple');
		
		$select->multiple(false);
		$this->assertSelectorAttributeMissing($select, 'select', 'multiple');
	}
	
	public function test_name_attribute_can_be_set_and_unset(): void
	{
		$select = new Select($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$select->name($value);
		$this->assertSelectorAttribute($select, 'select', 'name', $value);
		
		$select->name(null);
		$this->assertSelectorAttributeMissing($select, 'select', 'name');
	}
	
	public function test_required_flag_can_be_set_on_and_off(): void
	{
		$select = new Select($this->aire(), $this->aire()->form());
		
		$select->required();
		$this->assertSelectorAttribute($select, 'select', 'required');
		
		$select->required(false);
		$this->assertSelectorAttributeMissing($select, 'select', 'required');
	}
	
	public function test_size_attribute_can_be_set_and_unset(): void
	{
		$select = new Select($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$select->size($value);
		$this->assertSelectorAttribute($select, 'select', 'size', $value);
		
		$select->size(null);
		$this->assertSelectorAttributeMissing($select, 'select', 'size');
	}
}
