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

class FormTest extends ComponentTestCase
{
	public function test_accept_charset_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :accept-charset="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'accept-charset', $value);
		
		$form = $this->renderBlade('<x-aire::form :accept-charset="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'accept-charset');
	}
	
	public function test_action_attribute_can_be_set(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :action="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'action', $value);
		
		// Action is special so it cannot be unset
	}
	
	public function test_auto_complete_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form auto-complete="additional-name" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'additional-name');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="address-level1" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-level1');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="address-level2" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-level2');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="address-level3" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-level3');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="address-level4" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-level4');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="address-line1" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-line1');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="address-line2" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-line2');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="address-line3" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'address-line3');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="bday" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'bday');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="bday-year" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'bday-year');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="bday-day" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'bday-day');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="bday-month" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'bday-month');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="billing" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'billing');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="cc-additional-name" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-additional-name');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="cc-csc" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-csc');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="cc-exp" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-exp');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="cc-exp-month" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-exp-month');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="cc-exp-year" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-exp-year');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="cc-family-name" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-family-name');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="cc-given-name" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-given-name');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="cc-name" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-name');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="cc-number" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-number');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="cc-type" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'cc-type');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="country" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'country');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="country-name" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'country-name');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="current-password" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'current-password');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="email" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'email');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="family-name" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'family-name');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="fax" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'fax');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="given-name" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'given-name');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="home" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'home');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="honorific-prefix" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'honorific-prefix');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="honorific-suffix" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'honorific-suffix');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="impp" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'impp');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="language" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'language');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="mobile" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'mobile');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="name" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'name');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="new-password" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'new-password');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="nickname" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'nickname');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="off" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'off');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="on" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'on');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="organization" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'organization');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="organization-title" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'organization-title');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="pager" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'pager');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="photo" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'photo');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="postal-code" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'postal-code');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="sex" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'sex');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="shipping" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'shipping');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="street-address" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'street-address');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="tel-area-code" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-area-code');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="tel" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="tel-country-code" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-country-code');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="tel-extension" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-extension');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="tel-local" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-local');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="tel-local-prefix" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-local-prefix');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="tel-local-suffix" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-local-suffix');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="tel-national" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'tel-national');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="transaction-amount" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'transaction-amount');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="transaction-currency" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'transaction-currency');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="url" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'url');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="username" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'username');
		
		$form = $this->renderBlade('<x-aire::form auto-complete="work" />');
		$this->assertSelectorAttribute($form, 'form', 'autocomplete', 'work');
		
		$form = $this->renderBlade('<x-aire::form :auto-complete="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'autocomplete');
	}
	
	public function test_enc_type_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form enc-type="application/x-www-form-urlencoded" />');
		$this->assertSelectorAttribute($form, 'form', 'enctype', 'application/x-www-form-urlencoded');
		
		$form = $this->renderBlade('<x-aire::form enc-type="multipart/form-data" />');
		$this->assertSelectorAttribute($form, 'form', 'enctype', 'multipart/form-data');
		
		$form = $this->renderBlade('<x-aire::form enc-type="text/plain" />');
		$this->assertSelectorAttribute($form, 'form', 'enctype', 'text/plain');
		
		$form = $this->renderBlade('<x-aire::form :enc-type="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'enctype');
	}
	
	public function test_method_attribute_can_be_set(): void
	{
		$form = $this->renderBlade('<x-aire::form method="get" />');
		$this->assertSelectorAttribute($form, 'form', 'method', 'GET');
		
		$form = $this->renderBlade('<x-aire::form method="post" />');
		$this->assertSelectorAttribute($form, 'form', 'method', 'POST');
		
		// Method cannot be unset
	}
	
	public function test_name_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :name="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'name', $value);
		
		$form = $this->renderBlade('<x-aire::form :name="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'name');
	}
	
	public function test_no_validate_flag_can_be_set_on_and_off(): void
	{
		$form = $this->renderBlade('<x-aire::form no-validate />');
		$this->assertSelectorAttribute($form, 'form', 'novalidate');
		
		$form = $this->renderBlade('<x-aire::form :no-validate="false" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'novalidate');
	}
	
	public function test_target_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form target="_blank" />');
		$this->assertSelectorAttribute($form, 'form', 'target', '_blank');
		
		$form = $this->renderBlade('<x-aire::form target="_parent" />');
		$this->assertSelectorAttribute($form, 'form', 'target', '_parent');
		
		$form = $this->renderBlade('<x-aire::form target="_self" />');
		$this->assertSelectorAttribute($form, 'form', 'target', '_self');
		
		$form = $this->renderBlade('<x-aire::form target="_top" />');
		$this->assertSelectorAttribute($form, 'form', 'target', '_top');
		
		$form = $this->renderBlade('<x-aire::form :target="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'target');
	}
}
