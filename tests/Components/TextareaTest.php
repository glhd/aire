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

class TextareaTest extends ComponentTestCase
{
	public function test_auto_focus_flag_can_be_set_on_and_off(): void
	{
		$textarea = $this->renderBlade('<x-aire::textarea auto-focus />');
		$this->assertSelectorAttribute($textarea, 'textarea', 'autofocus');
		
		$textarea = $this->renderBlade('<x-aire::textarea :auto-focus="false" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'autofocus');
	}
	
	public function test_cols_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$textarea = $this->renderBlade('<x-aire::textarea :cols="$value" />', compact('value'));
		$this->assertSelectorAttribute($textarea, 'textarea', 'cols', $value);
		
		$textarea = $this->renderBlade('<x-aire::textarea :cols="null" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'cols');
	}
	
	public function test_dir_name_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$textarea = $this->renderBlade('<x-aire::textarea :dir-name="$value" />', compact('value'));
		$this->assertSelectorAttribute($textarea, 'textarea', 'dirname', $value);
		
		$textarea = $this->renderBlade('<x-aire::textarea :dir-name="null" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'dirname');
	}
	
	public function test_disabled_flag_can_be_set_on_and_off(): void
	{
		$textarea = $this->renderBlade('<x-aire::textarea disabled />');
		$this->assertSelectorAttribute($textarea, 'textarea', 'disabled');
		
		$textarea = $this->renderBlade('<x-aire::textarea :disabled="false" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'disabled');
	}
	
	public function test_form_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$textarea = $this->renderBlade('<x-aire::textarea :form="$value" />', compact('value'));
		$this->assertSelectorAttribute($textarea, 'textarea', 'form', $value);
		
		$textarea = $this->renderBlade('<x-aire::textarea :form="null" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'form');
	}
	
	public function test_max_length_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$textarea = $this->renderBlade('<x-aire::textarea :max-length="$value" />', compact('value'));
		$this->assertSelectorAttribute($textarea, 'textarea', 'maxlength', $value);
		
		$textarea = $this->renderBlade('<x-aire::textarea :max-length="null" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'maxlength');
	}
	
	public function test_name_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$textarea = $this->renderBlade('<x-aire::textarea :name="$value" />', compact('value'));
		$this->assertSelectorAttribute($textarea, 'textarea', 'name', $value);
		
		$textarea = $this->renderBlade('<x-aire::textarea :name="null" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'name');
	}
	
	public function test_placeholder_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$textarea = $this->renderBlade('<x-aire::textarea :placeholder="$value" />', compact('value'));
		$this->assertSelectorAttribute($textarea, 'textarea', 'placeholder', $value);
		
		$textarea = $this->renderBlade('<x-aire::textarea :placeholder="null" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'placeholder');
	}
	
	public function test_read_only_flag_can_be_set_on_and_off(): void
	{
		$textarea = $this->renderBlade('<x-aire::textarea read-only />');
		$this->assertSelectorAttribute($textarea, 'textarea', 'readonly');
		
		$textarea = $this->renderBlade('<x-aire::textarea :read-only="false" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'readonly');
	}
	
	public function test_required_flag_can_be_set_on_and_off(): void
	{
		$textarea = $this->renderBlade('<x-aire::textarea required />');
		$this->assertSelectorAttribute($textarea, 'textarea', 'required');
		
		$textarea = $this->renderBlade('<x-aire::textarea :required="false" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'required');
	}
	
	public function test_rows_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$textarea = $this->renderBlade('<x-aire::textarea :rows="$value" />', compact('value'));
		$this->assertSelectorAttribute($textarea, 'textarea', 'rows', $value);
		
		$textarea = $this->renderBlade('<x-aire::textarea :rows="null" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'rows');
	}
	
	public function test_wrap_attribute_can_be_set_and_unset(): void
	{
		$textarea = $this->renderBlade('<x-aire::textarea wrap="hard" />');
		$this->assertSelectorAttribute($textarea, 'textarea', 'wrap', 'hard');
		
		$textarea = $this->renderBlade('<x-aire::textarea wrap="soft" />');
		$this->assertSelectorAttribute($textarea, 'textarea', 'wrap', 'soft');
		
		$textarea = $this->renderBlade('<x-aire::textarea :wrap="null" />');
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'wrap');
	}
}
