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

namespace Galahad\Aire\Tests\DTD;

use Galahad\Aire\Elements\FormElement;
use Galahad\Aire\DTD\Textarea;
use Galahad\Aire\Tests\TestCase;

class TextareaTest extends TestCase
{
	public function test_auto_focus_flag_can_be_set_on_and_off() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$textarea->autoFocus();
		$this->assertSelectorAttribute($textarea, 'textarea', 'autofocus');
		
		$textarea->autoFocus(false);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'autofocus');
	}
	
	public function test_cols_attribute_can_be_set_and_unset() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$value = str_random();
		
		$textarea->cols($value);
		$this->assertSelectorAttribute($textarea, 'textarea', 'cols', $value);
		
		$textarea->cols(null);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'cols');
	}
	
	public function test_dir_name_attribute_can_be_set_and_unset() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$value = str_random();
		
		$textarea->dirName($value);
		$this->assertSelectorAttribute($textarea, 'textarea', 'dirname', $value);
		
		$textarea->dirName(null);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'dirname');
	}
	
	public function test_disabled_flag_can_be_set_on_and_off() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$textarea->disabled();
		$this->assertSelectorAttribute($textarea, 'textarea', 'disabled');
		
		$textarea->disabled(false);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'disabled');
	}
	
	public function test_form_attribute_can_be_set_and_unset() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$value = str_random();
		
		$textarea->form($value);
		$this->assertSelectorAttribute($textarea, 'textarea', 'form', $value);
		
		$textarea->form(null);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'form');
	}
	
	public function test_label_attribute_can_be_set_and_unset() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$value = str_random();
		
		$textarea->label($value);
		$this->assertSelectorAttribute($textarea, 'textarea', 'label', $value);
		
		$textarea->label(null);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'label');
	}
	
	public function test_max_length_attribute_can_be_set_and_unset() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$value = str_random();
		
		$textarea->maxLength($value);
		$this->assertSelectorAttribute($textarea, 'textarea', 'maxlength', $value);
		
		$textarea->maxLength(null);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'maxlength');
	}
	
	public function test_name_attribute_can_be_set_and_unset() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$value = str_random();
		
		$textarea->name($value);
		$this->assertSelectorAttribute($textarea, 'textarea', 'name', $value);
		
		$textarea->name(null);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'name');
	}
	
	public function test_placeholder_attribute_can_be_set_and_unset() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$value = str_random();
		
		$textarea->placeholder($value);
		$this->assertSelectorAttribute($textarea, 'textarea', 'placeholder', $value);
		
		$textarea->placeholder(null);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'placeholder');
	}
	
	public function test_read_only_flag_can_be_set_on_and_off() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$textarea->readOnly();
		$this->assertSelectorAttribute($textarea, 'textarea', 'readonly');
		
		$textarea->readOnly(false);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'readonly');
	}
	
	public function test_required_flag_can_be_set_on_and_off() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$textarea->required();
		$this->assertSelectorAttribute($textarea, 'textarea', 'required');
		
		$textarea->required(false);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'required');
	}
	
	public function test_rows_attribute_can_be_set_and_unset() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$value = str_random();
		
		$textarea->rows($value);
		$this->assertSelectorAttribute($textarea, 'textarea', 'rows', $value);
		
		$textarea->rows(null);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'rows');
	}
	
	public function test_wrap_attribute_can_be_set_and_unset() : void
	{
		$form = $this->aire()->form();
		
		$textarea = is_subclass_of(Textarea::class, FormElement::class)
			? new Textarea($this->aire(), $form)
			: new Textarea($this->aire());
		
		$textarea->wrap('hard');
		$this->assertSelectorAttribute($textarea, 'textarea', 'wrap', 'hard');
		
		$textarea->wrap('soft');
		$this->assertSelectorAttribute($textarea, 'textarea', 'wrap', 'soft');
		
		$textarea->wrap(null);
		$this->assertSelectorAttributeMissing($textarea, 'textarea', 'wrap');
	}
	
}
