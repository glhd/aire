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

namespace Galahad\Aire\Tests\Components;

use Illuminate\Support\Str;

class SelectTest extends ComponentTestCase
{
	public function test_auto_focus_flag_can_be_set_on_and_off(): void
	{
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" auto-focus />');
		$this->assertSelectorAttribute($select, 'select', 'autofocus');
		
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" :auto-focus="false" />');
		$this->assertSelectorAttributeMissing($select, 'select', 'autofocus');
	}
	
	public function test_disabled_flag_can_be_set_on_and_off(): void
	{
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" disabled />');
		$this->assertSelectorAttribute($select, 'select', 'disabled');
		
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" :disabled="false" />');
		$this->assertSelectorAttributeMissing($select, 'select', 'disabled');
	}
	
	public function test_form_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" :form="$value" />', compact('value'));
		$this->assertSelectorAttribute($select, 'select', 'form', $value);
		
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" :form="null" />');
		$this->assertSelectorAttributeMissing($select, 'select', 'form');
	}
	
	public function test_multiple_flag_can_be_set_on_and_off(): void
	{
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" multiple />');
		$this->assertSelectorAttribute($select, 'select', 'multiple');
		
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" :multiple="false" />');
		$this->assertSelectorAttributeMissing($select, 'select', 'multiple');
	}
	
	public function test_name_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" :name="$value" />', compact('value'));
		$this->assertSelectorAttribute($select, 'select', 'name', $value);
		
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" :name="null" />');
		$this->assertSelectorAttributeMissing($select, 'select', 'name');
	}
	
	public function test_required_flag_can_be_set_on_and_off(): void
	{
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" required />');
		$this->assertSelectorAttribute($select, 'select', 'required');
		
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" :required="false" />');
		$this->assertSelectorAttributeMissing($select, 'select', 'required');
	}
	
	public function test_size_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" :size="$value" />', compact('value'));
		$this->assertSelectorAttribute($select, 'select', 'size', $value);
		
		$select = $this->renderBlade('<x-aire::select :options="[\'a\', \'b\']" :size="null" />');
		$this->assertSelectorAttributeMissing($select, 'select', 'size');
	}
}
