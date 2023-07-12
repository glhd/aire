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

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class FormTest extends TestCase
{
	public function test_accept_charset_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->acceptCharset($value);
		$this->assertSelectorAttribute($form, 'form', 'accept-charset', $value);
		
		$form->acceptCharset(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'accept-charset');
	}
	
	public function test_action_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->action($value);
		$this->assertSelectorAttribute($form, 'form', 'action', $value);
		
		$form->action(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'action');
	}
	
	public function test_auto_complete_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->autoComplete('additional-name');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'additional-name');
		
		$form->autoComplete('address-level1');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-level1');
		
		$form->autoComplete('address-level2');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-level2');
		
		$form->autoComplete('address-level3');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-level3');
		
		$form->autoComplete('address-level4');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-level4');
		
		$form->autoComplete('address-line1');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-line1');
		
		$form->autoComplete('address-line2');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-line2');
		
		$form->autoComplete('address-line3');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-line3');
		
		$form->autoComplete('bday');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'bday');
		
		$form->autoComplete('bday-year');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'bday-year');
		
		$form->autoComplete('bday-day');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'bday-day');
		
		$form->autoComplete('bday-month');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'bday-month');
		
		$form->autoComplete('billing');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'billing');
		
		$form->autoComplete('cc-additional-name');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-additional-name');
		
		$form->autoComplete('cc-csc');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-csc');
		
		$form->autoComplete('cc-exp');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-exp');
		
		$form->autoComplete('cc-exp-month');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-exp-month');
		
		$form->autoComplete('cc-exp-year');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-exp-year');
		
		$form->autoComplete('cc-family-name');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-family-name');
		
		$form->autoComplete('cc-given-name');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-given-name');
		
		$form->autoComplete('cc-name');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-name');
		
		$form->autoComplete('cc-number');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-number');
		
		$form->autoComplete('cc-type');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-type');
		
		$form->autoComplete('country');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'country');
		
		$form->autoComplete('country-name');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'country-name');
		
		$form->autoComplete('current-password');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'current-password');
		
		$form->autoComplete('email');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'email');
		
		$form->autoComplete('family-name');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'family-name');
		
		$form->autoComplete('fax');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'fax');
		
		$form->autoComplete('given-name');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'given-name');
		
		$form->autoComplete('home');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'home');
		
		$form->autoComplete('honorific-prefix');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'honorific-prefix');
		
		$form->autoComplete('honorific-suffix');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'honorific-suffix');
		
		$form->autoComplete('impp');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'impp');
		
		$form->autoComplete('language');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'language');
		
		$form->autoComplete('mobile');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'mobile');
		
		$form->autoComplete('name');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'name');
		
		$form->autoComplete('new-password');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'new-password');
		
		$form->autoComplete('nickname');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'nickname');
		
		$form->autoComplete('off');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'off');
		
		$form->autoComplete('on');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'on');
		
		$form->autoComplete('organization');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'organization');
		
		$form->autoComplete('organization-title');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'organization-title');
		
		$form->autoComplete('pager');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'pager');
		
		$form->autoComplete('photo');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'photo');
		
		$form->autoComplete('postal-code');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'postal-code');
		
		$form->autoComplete('sex');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'sex');
		
		$form->autoComplete('shipping');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'shipping');
		
		$form->autoComplete('street-address');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'street-address');
		
		$form->autoComplete('tel-area-code');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-area-code');
		
		$form->autoComplete('tel');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel');
		
		$form->autoComplete('tel-country-code');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-country-code');
		
		$form->autoComplete('tel-extension');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-extension');
		
		$form->autoComplete('tel-local');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-local');
		
		$form->autoComplete('tel-local-prefix');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-local-prefix');
		
		$form->autoComplete('tel-local-suffix');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-local-suffix');
		
		$form->autoComplete('tel-national');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-national');
		
		$form->autoComplete('transaction-amount');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'transaction-amount');
		
		$form->autoComplete('transaction-currency');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'transaction-currency');
		
		$form->autoComplete('url');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'url');
		
		$form->autoComplete('username');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'username');
		
		$form->autoComplete('work');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'work');
		
		$form->autoComplete(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'autocomplete');
	}
	
	public function test_enc_type_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->encType('application/x-www-form-urlencoded');
		$this->assertSelectorAttribute($form, 'form', 'enctype', 'application/x-www-form-urlencoded');
		
		$form->encType('multipart/form-data');
		$this->assertSelectorAttribute($form, 'form', 'enctype', 'multipart/form-data');
		
		$form->encType('text/plain');
		$this->assertSelectorAttribute($form, 'form', 'enctype', 'text/plain');
		
		$form->encType(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'enctype');
	}
	
	public function test_method_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->method('get');
		$this->assertSelectorAttribute($form, 'form', 'method', 'GET');
		
		$form->method('post');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
		
		$form->method(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'method');
	}
	
	public function test_name_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->name($value);
		$this->assertSelectorAttribute($form, 'form', 'name', $value);
		
		$form->name(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'name');
	}
	
	public function test_no_validate_flag_can_be_set_on_and_off(): void
	{
		$form = $this->aire()->form();
		
		$form->noValidate();
		$this->assertSelectorAttribute($form, 'form', 'novalidate');
		
		$form->noValidate(false);
		$this->assertSelectorAttributeMissing($form, 'form', 'novalidate');
	}
	
	public function test_target_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->target('_blank');
		$this->assertSelectorAttribute($form, 'form', 'target', '_blank');
		
		$form->target('_parent');
		$this->assertSelectorAttribute($form, 'form', 'target', '_parent');
		
		$form->target('_self');
		$this->assertSelectorAttribute($form, 'form', 'target', '_self');
		
		$form->target('_top');
		$this->assertSelectorAttribute($form, 'form', 'target', '_top');
		
		$form->target(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'target');
	}
	
	public function test_you_can_check_whether_a_form_has_been_opened(): void
	{
		$this->assertFalse($this->aire()->isOpened());
		
		$form = $this->aire()->form();
		
		$this->assertFalse($this->aire()->isOpened());
		
		$form->open();
		
		$this->assertTrue($this->aire()->isOpened());
		
		$this->aire()->close();
		
		$this->assertFalse($this->aire()->isOpened());
	}
}
