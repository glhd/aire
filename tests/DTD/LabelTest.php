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

use Galahad\Aire\DTD\Label;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class LabelTest extends TestCase
{
	public function test_for_attribute_can_be_set_and_unset(): void
	{
		$label = new Label($this->aire());
		
		$value = Str::random();
		
		$label->for($value);
		$this->assertSelectorAttribute($label, 'label', 'for', $value);
		
		$label->for(null);
		$this->assertSelectorAttributeMissing($label, 'label', 'for');
	}
	
	public function test_form_attribute_can_be_set_and_unset(): void
	{
		$label = new Label($this->aire());
		
		$value = Str::random();
		
		$label->form($value);
		$this->assertSelectorAttribute($label, 'label', 'form', $value);
		
		$label->form(null);
		$this->assertSelectorAttributeMissing($label, 'label', 'form');
	}
}
