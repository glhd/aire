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

use Galahad\Aire\DTD\Input;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class InputTest extends TestCase
{
	public function test_accept_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->accept('text/html');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'text/html');
		
		$input->accept('text/plain');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'text/plain');
		
		$input->accept('application/msword');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/msword');
		
		$input->accept('application/msexcel');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/msexcel');
		
		$input->accept('application/postscript');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/postscript');
		
		$input->accept('application/x-zip-compressed');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/x-zip-compressed');
		
		$input->accept('application/pdf');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/pdf');
		
		$input->accept('application/rtf');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/rtf');
		
		$input->accept('video/x-msvideo');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'video/x-msvideo');
		
		$input->accept('video/quicktime');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'video/quicktime');
		
		$input->accept('video/x-mpeg2');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'video/x-mpeg2');
		
		$input->accept('audio/x-pn/realaudio');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'audio/x-pn/realaudio');
		
		$input->accept('audio/x-mpeg');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'audio/x-mpeg');
		
		$input->accept('audio/x-waw');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'audio/x-waw');
		
		$input->accept('audio/x-aiff');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'audio/x-aiff');
		
		$input->accept('audio/basic');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'audio/basic');
		
		$input->accept('image/tiff');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/tiff');
		
		$input->accept('image/jpeg');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/jpeg');
		
		$input->accept('image/gif');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/gif');
		
		$input->accept('image/x-png');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-png');
		
		$input->accept('image/x-photo-cd');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-photo-cd');
		
		$input->accept('image/x-MS-bmp');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-MS-bmp');
		
		$input->accept('image/x-rgb');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-rgb');
		
		$input->accept('image/x-portable-pixmap');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-portable-pixmap');
		
		$input->accept('image/x-portable-greymap');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-portable-greymap');
		
		$input->accept('image/x-portablebitmap');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-portablebitmap');
		
		$input->accept(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'accept');
	}
	
	public function test_alt_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->alt($value);
		$this->assertSelectorAttribute($input, 'input', 'alt', $value);
		
		$input->alt(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'alt');
	}
	
	public function test_auto_complete_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->autoComplete('additional-name');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'additional-name');
		
		$input->autoComplete('address-level1');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-level1');
		
		$input->autoComplete('address-level2');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-level2');
		
		$input->autoComplete('address-level3');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-level3');
		
		$input->autoComplete('address-level4');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-level4');
		
		$input->autoComplete('address-line1');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-line1');
		
		$input->autoComplete('address-line2');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-line2');
		
		$input->autoComplete('address-line3');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-line3');
		
		$input->autoComplete('bday');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'bday');
		
		$input->autoComplete('bday-year');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'bday-year');
		
		$input->autoComplete('bday-day');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'bday-day');
		
		$input->autoComplete('bday-month');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'bday-month');
		
		$input->autoComplete('billing');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'billing');
		
		$input->autoComplete('cc-additional-name');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-additional-name');
		
		$input->autoComplete('cc-csc');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-csc');
		
		$input->autoComplete('cc-exp');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-exp');
		
		$input->autoComplete('cc-exp-month');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-exp-month');
		
		$input->autoComplete('cc-exp-year');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-exp-year');
		
		$input->autoComplete('cc-family-name');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-family-name');
		
		$input->autoComplete('cc-given-name');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-given-name');
		
		$input->autoComplete('cc-name');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-name');
		
		$input->autoComplete('cc-number');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-number');
		
		$input->autoComplete('cc-type');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-type');
		
		$input->autoComplete('country');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'country');
		
		$input->autoComplete('country-name');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'country-name');
		
		$input->autoComplete('current-password');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'current-password');
		
		$input->autoComplete('email');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'email');
		
		$input->autoComplete('family-name');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'family-name');
		
		$input->autoComplete('fax');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'fax');
		
		$input->autoComplete('given-name');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'given-name');
		
		$input->autoComplete('home');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'home');
		
		$input->autoComplete('honorific-prefix');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'honorific-prefix');
		
		$input->autoComplete('honorific-suffix');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'honorific-suffix');
		
		$input->autoComplete('impp');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'impp');
		
		$input->autoComplete('language');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'language');
		
		$input->autoComplete('mobile');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'mobile');
		
		$input->autoComplete('name');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'name');
		
		$input->autoComplete('new-password');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'new-password');
		
		$input->autoComplete('nickname');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'nickname');
		
		$input->autoComplete('off');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'off');
		
		$input->autoComplete('on');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'on');
		
		$input->autoComplete('organization');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'organization');
		
		$input->autoComplete('organization-title');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'organization-title');
		
		$input->autoComplete('pager');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'pager');
		
		$input->autoComplete('photo');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'photo');
		
		$input->autoComplete('postal-code');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'postal-code');
		
		$input->autoComplete('sex');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'sex');
		
		$input->autoComplete('shipping');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'shipping');
		
		$input->autoComplete('street-address');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'street-address');
		
		$input->autoComplete('tel-area-code');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-area-code');
		
		$input->autoComplete('tel');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel');
		
		$input->autoComplete('tel-country-code');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-country-code');
		
		$input->autoComplete('tel-extension');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-extension');
		
		$input->autoComplete('tel-local');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-local');
		
		$input->autoComplete('tel-local-prefix');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-local-prefix');
		
		$input->autoComplete('tel-local-suffix');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-local-suffix');
		
		$input->autoComplete('tel-national');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-national');
		
		$input->autoComplete('transaction-amount');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'transaction-amount');
		
		$input->autoComplete('transaction-currency');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'transaction-currency');
		
		$input->autoComplete('url');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'url');
		
		$input->autoComplete('username');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'username');
		
		$input->autoComplete('work');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'work');
		
		$input->autoComplete(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'autocomplete');
	}
	
	public function test_auto_focus_flag_can_be_set_on_and_off(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->autoFocus();
		$this->assertSelectorAttribute($input, 'input', 'autofocus');
		
		$input->autoFocus(false);
		$this->assertSelectorAttributeMissing($input, 'input', 'autofocus');
	}
	
	public function test_checked_flag_can_be_set_on_and_off(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->checked();
		$this->assertSelectorAttribute($input, 'input', 'checked');
		
		$input->checked(false);
		$this->assertSelectorAttributeMissing($input, 'input', 'checked');
	}
	
	public function test_dir_name_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->dirName($value);
		$this->assertSelectorAttribute($input, 'input', 'dirname', $value);
		
		$input->dirName(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'dirname');
	}
	
	public function test_disabled_flag_can_be_set_on_and_off(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->disabled();
		$this->assertSelectorAttribute($input, 'input', 'disabled');
		
		$input->disabled(false);
		$this->assertSelectorAttributeMissing($input, 'input', 'disabled');
	}
	
	public function test_form_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->form($value);
		$this->assertSelectorAttribute($input, 'input', 'form', $value);
		
		$input->form(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'form');
	}
	
	public function test_form_action_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->formAction($value);
		$this->assertSelectorAttribute($input, 'input', 'formaction', $value);
		
		$input->formAction(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'formaction');
	}
	
	public function test_form_enc_type_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->formEncType('application/x-www-form-urlencoded');
		$this->assertSelectorAttribute($input, 'input', 'formenctype', 'application/x-www-form-urlencoded');
		
		$input->formEncType('multipart/form-data');
		$this->assertSelectorAttribute($input, 'input', 'formenctype', 'multipart/form-data');
		
		$input->formEncType('text/plain');
		$this->assertSelectorAttribute($input, 'input', 'formenctype', 'text/plain');
		
		$input->formEncType(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'formenctype');
	}
	
	public function test_form_method_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->formMethod('get');
		$this->assertSelectorAttribute($input, 'input', 'formmethod', 'get');
		
		$input->formMethod('post');
		$this->assertSelectorAttribute($input, 'input', 'formmethod', 'post');
		
		$input->formMethod(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'formmethod');
	}
	
	public function test_form_no_validate_flag_can_be_set_on_and_off(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->formNoValidate();
		$this->assertSelectorAttribute($input, 'input', 'formnovalidate');
		
		$input->formNoValidate(false);
		$this->assertSelectorAttributeMissing($input, 'input', 'formnovalidate');
	}
	
	public function test_form_target_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->formTarget('_blank');
		$this->assertSelectorAttribute($input, 'input', 'formtarget', '_blank');
		
		$input->formTarget('_parent');
		$this->assertSelectorAttribute($input, 'input', 'formtarget', '_parent');
		
		$input->formTarget('_self');
		$this->assertSelectorAttribute($input, 'input', 'formtarget', '_self');
		
		$input->formTarget('_top');
		$this->assertSelectorAttribute($input, 'input', 'formtarget', '_top');
		
		$input->formTarget(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'formtarget');
	}
	
	public function test_height_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->height($value);
		$this->assertSelectorAttribute($input, 'input', 'height', $value);
		
		$input->height(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'height');
	}
	
	public function test_list_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->list($value);
		$this->assertSelectorAttribute($input, 'input', 'list', $value);
		
		$input->list(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'list');
	}
	
	public function test_max_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->max($value);
		$this->assertSelectorAttribute($input, 'input', 'max', $value);
		
		$input->max(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'max');
	}
	
	public function test_max_length_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->maxLength($value);
		$this->assertSelectorAttribute($input, 'input', 'maxlength', $value);
		
		$input->maxLength(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'maxlength');
	}
	
	public function test_min_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->min($value);
		$this->assertSelectorAttribute($input, 'input', 'min', $value);
		
		$input->min(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'min');
	}
	
	public function test_multiple_flag_can_be_set_on_and_off(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->multiple();
		$this->assertSelectorAttribute($input, 'input', 'multiple');
		
		$input->multiple(false);
		$this->assertSelectorAttributeMissing($input, 'input', 'multiple');
	}
	
	public function test_name_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->name($value);
		$this->assertSelectorAttribute($input, 'input', 'name', $value);
		
		$input->name(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'name');
	}
	
	public function test_pattern_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->pattern($value);
		$this->assertSelectorAttribute($input, 'input', 'pattern', $value);
		
		$input->pattern(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'pattern');
	}
	
	public function test_placeholder_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->placeholder($value);
		$this->assertSelectorAttribute($input, 'input', 'placeholder', $value);
		
		$input->placeholder(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'placeholder');
	}
	
	public function test_read_only_flag_can_be_set_on_and_off(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->readOnly();
		$this->assertSelectorAttribute($input, 'input', 'readonly');
		
		$input->readOnly(false);
		$this->assertSelectorAttributeMissing($input, 'input', 'readonly');
	}
	
	public function test_required_flag_can_be_set_on_and_off(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->required();
		$this->assertSelectorAttribute($input, 'input', 'required');
		
		$input->required(false);
		$this->assertSelectorAttributeMissing($input, 'input', 'required');
	}
	
	public function test_size_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->size($value);
		$this->assertSelectorAttribute($input, 'input', 'size', $value);
		
		$input->size(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'size');
	}
	
	public function test_src_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->src($value);
		$this->assertSelectorAttribute($input, 'input', 'src', $value);
		
		$input->src(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'src');
	}
	
	public function test_step_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->step($value);
		$this->assertSelectorAttribute($input, 'input', 'step', $value);
		
		$input->step(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'step');
	}
	
	public function test_type_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$input->type('button');
		$this->assertSelectorAttribute($input, 'input', 'type', 'button');
		
		$input->type('checkbox');
		$this->assertSelectorAttribute($input, 'input', 'type', 'checkbox');
		
		$input->type('color');
		$this->assertSelectorAttribute($input, 'input', 'type', 'color');
		
		$input->type('date');
		$this->assertSelectorAttribute($input, 'input', 'type', 'date');
		
		$input->type('datetime');
		$this->assertSelectorAttribute($input, 'input', 'type', 'datetime');
		
		$input->type('datetime-local');
		$this->assertSelectorAttribute($input, 'input', 'type', 'datetime-local');
		
		$input->type('email');
		$this->assertSelectorAttribute($input, 'input', 'type', 'email');
		
		$input->type('file');
		$this->assertSelectorAttribute($input, 'input', 'type', 'file');
		
		$input->type('hidden');
		$this->assertSelectorAttribute($input, 'input', 'type', 'hidden');
		
		$input->type('image');
		$this->assertSelectorAttribute($input, 'input', 'type', 'image');
		
		$input->type('month');
		$this->assertSelectorAttribute($input, 'input', 'type', 'month');
		
		$input->type('number');
		$this->assertSelectorAttribute($input, 'input', 'type', 'number');
		
		$input->type('password');
		$this->assertSelectorAttribute($input, 'input', 'type', 'password');
		
		$input->type('radio');
		$this->assertSelectorAttribute($input, 'input', 'type', 'radio');
		
		$input->type('range');
		$this->assertSelectorAttribute($input, 'input', 'type', 'range');
		
		$input->type('reset');
		$this->assertSelectorAttribute($input, 'input', 'type', 'reset');
		
		$input->type('search');
		$this->assertSelectorAttribute($input, 'input', 'type', 'search');
		
		$input->type('submit');
		$this->assertSelectorAttribute($input, 'input', 'type', 'submit');
		
		$input->type('tel');
		$this->assertSelectorAttribute($input, 'input', 'type', 'tel');
		
		$input->type('text');
		$this->assertSelectorAttribute($input, 'input', 'type', 'text');
		
		$input->type('time');
		$this->assertSelectorAttribute($input, 'input', 'type', 'time');
		
		$input->type('url');
		$this->assertSelectorAttribute($input, 'input', 'type', 'url');
		
		$input->type('week');
		$this->assertSelectorAttribute($input, 'input', 'type', 'week');
		
		$input->type(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'type');
	}
	
	public function test_value_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->value($value);
		$this->assertSelectorAttribute($input, 'input', 'value', $value);
		
		$input->value(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'value');
	}
	
	public function test_width_attribute_can_be_set_and_unset(): void
	{
		$input = new Input($this->aire(), $this->aire()->form());
		
		$value = Str::random();
		
		$input->width($value);
		$this->assertSelectorAttribute($input, 'input', 'width', $value);
		
		$input->width(null);
		$this->assertSelectorAttributeMissing($input, 'input', 'width');
	}
}
