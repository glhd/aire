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

class InputTest extends ComponentTestCase
{
	public function test_accept_attribute_can_be_set_and_unset(): void
	{
		$input = $this->renderBlade('<x-aire::input accept="text/html" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'text/html');
		
		$input = $this->renderBlade('<x-aire::input accept="text/plain" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'text/plain');
		
		$input = $this->renderBlade('<x-aire::input accept="application/msword" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/msword');
		
		$input = $this->renderBlade('<x-aire::input accept="application/msexcel" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/msexcel');
		
		$input = $this->renderBlade('<x-aire::input accept="application/postscript" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/postscript');
		
		$input = $this->renderBlade('<x-aire::input accept="application/x-zip-compressed" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/x-zip-compressed');
		
		$input = $this->renderBlade('<x-aire::input accept="application/pdf" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/pdf');
		
		$input = $this->renderBlade('<x-aire::input accept="application/rtf" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'application/rtf');
		
		$input = $this->renderBlade('<x-aire::input accept="video/x-msvideo" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'video/x-msvideo');
		
		$input = $this->renderBlade('<x-aire::input accept="video/quicktime" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'video/quicktime');
		
		$input = $this->renderBlade('<x-aire::input accept="video/x-mpeg2" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'video/x-mpeg2');
		
		$input = $this->renderBlade('<x-aire::input accept="audio/x-pn/realaudio" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'audio/x-pn/realaudio');
		
		$input = $this->renderBlade('<x-aire::input accept="audio/x-mpeg" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'audio/x-mpeg');
		
		$input = $this->renderBlade('<x-aire::input accept="audio/x-waw" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'audio/x-waw');
		
		$input = $this->renderBlade('<x-aire::input accept="audio/x-aiff" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'audio/x-aiff');
		
		$input = $this->renderBlade('<x-aire::input accept="audio/basic" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'audio/basic');
		
		$input = $this->renderBlade('<x-aire::input accept="image/tiff" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/tiff');
		
		$input = $this->renderBlade('<x-aire::input accept="image/jpeg" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/jpeg');
		
		$input = $this->renderBlade('<x-aire::input accept="image/gif" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/gif');
		
		$input = $this->renderBlade('<x-aire::input accept="image/x-png" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-png');
		
		$input = $this->renderBlade('<x-aire::input accept="image/x-photo-cd" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-photo-cd');
		
		$input = $this->renderBlade('<x-aire::input accept="image/x-MS-bmp" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-MS-bmp');
		
		$input = $this->renderBlade('<x-aire::input accept="image/x-rgb" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-rgb');
		
		$input = $this->renderBlade('<x-aire::input accept="image/x-portable-pixmap" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-portable-pixmap');
		
		$input = $this->renderBlade('<x-aire::input accept="image/x-portable-greymap" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-portable-greymap');
		
		$input = $this->renderBlade('<x-aire::input accept="image/x-portablebitmap" />');
		$this->assertSelectorAttribute($input, 'input', 'accept', 'image/x-portablebitmap');
		
		$input = $this->renderBlade('<x-aire::input :accept="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'accept');
	}
	
	public function test_alt_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :alt="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'alt', $value);
		
		$input = $this->renderBlade('<x-aire::input :alt="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'alt');
	}
	
	public function test_auto_complete_attribute_can_be_set_and_unset(): void
	{
		$input = $this->renderBlade('<x-aire::input auto-complete="additional-name" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'additional-name');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="address-level1" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-level1');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="address-level2" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-level2');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="address-level3" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-level3');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="address-level4" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-level4');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="address-line1" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-line1');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="address-line2" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-line2');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="address-line3" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'address-line3');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="bday" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'bday');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="bday-year" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'bday-year');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="bday-day" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'bday-day');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="bday-month" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'bday-month');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="billing" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'billing');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="cc-additional-name" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-additional-name');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="cc-csc" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-csc');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="cc-exp" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-exp');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="cc-exp-month" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-exp-month');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="cc-exp-year" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-exp-year');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="cc-family-name" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-family-name');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="cc-given-name" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-given-name');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="cc-name" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-name');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="cc-number" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-number');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="cc-type" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'cc-type');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="country" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'country');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="country-name" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'country-name');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="current-password" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'current-password');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="email" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'email');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="family-name" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'family-name');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="fax" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'fax');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="given-name" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'given-name');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="home" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'home');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="honorific-prefix" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'honorific-prefix');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="honorific-suffix" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'honorific-suffix');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="impp" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'impp');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="language" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'language');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="mobile" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'mobile');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="name" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'name');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="new-password" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'new-password');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="nickname" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'nickname');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="off" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'off');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="on" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'on');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="organization" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'organization');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="organization-title" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'organization-title');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="pager" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'pager');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="photo" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'photo');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="postal-code" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'postal-code');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="sex" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'sex');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="shipping" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'shipping');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="street-address" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'street-address');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="tel-area-code" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-area-code');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="tel" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="tel-country-code" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-country-code');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="tel-extension" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-extension');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="tel-local" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-local');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="tel-local-prefix" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-local-prefix');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="tel-local-suffix" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-local-suffix');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="tel-national" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'tel-national');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="transaction-amount" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'transaction-amount');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="transaction-currency" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'transaction-currency');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="url" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'url');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="username" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'username');
		
		$input = $this->renderBlade('<x-aire::input auto-complete="work" />');
		$this->assertSelectorAttribute($input, 'input', 'autocomplete', 'work');
		
		$input = $this->renderBlade('<x-aire::input :auto-complete="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'autocomplete');
	}
	
	public function test_auto_focus_flag_can_be_set_on_and_off(): void
	{
		$input = $this->renderBlade('<x-aire::input auto-focus />');
		$this->assertSelectorAttribute($input, 'input', 'autofocus');
		
		$input = $this->renderBlade('<x-aire::input :auto-focus="false" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'autofocus');
	}
	
	public function test_checked_flag_can_be_set_on_and_off(): void
	{
		$input = $this->renderBlade('<x-aire::input checked />');
		$this->assertSelectorAttribute($input, 'input', 'checked');
		
		$input = $this->renderBlade('<x-aire::input :checked="false" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'checked');
	}
	
	public function test_dir_name_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :dir-name="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'dirname', $value);
		
		$input = $this->renderBlade('<x-aire::input :dir-name="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'dirname');
	}
	
	public function test_disabled_flag_can_be_set_on_and_off(): void
	{
		$input = $this->renderBlade('<x-aire::input disabled />');
		$this->assertSelectorAttribute($input, 'input', 'disabled');
		
		$input = $this->renderBlade('<x-aire::input :disabled="false" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'disabled');
	}
	
	public function test_form_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :form="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'form', $value);
		
		$input = $this->renderBlade('<x-aire::input :form="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'form');
	}
	
	public function test_form_action_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :form-action="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'formaction', $value);
		
		$input = $this->renderBlade('<x-aire::input :form-action="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'formaction');
	}
	
	public function test_form_enc_type_attribute_can_be_set_and_unset(): void
	{
		$input = $this->renderBlade('<x-aire::input form-enc-type="application/x-www-form-urlencoded" />');
		$this->assertSelectorAttribute($input, 'input', 'formenctype', 'application/x-www-form-urlencoded');
		
		$input = $this->renderBlade('<x-aire::input form-enc-type="multipart/form-data" />');
		$this->assertSelectorAttribute($input, 'input', 'formenctype', 'multipart/form-data');
		
		$input = $this->renderBlade('<x-aire::input form-enc-type="text/plain" />');
		$this->assertSelectorAttribute($input, 'input', 'formenctype', 'text/plain');
		
		$input = $this->renderBlade('<x-aire::input :form-enc-type="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'formenctype');
	}
	
	public function test_form_method_attribute_can_be_set_and_unset(): void
	{
		$input = $this->renderBlade('<x-aire::input form-method="get" />');
		$this->assertSelectorAttribute($input, 'input', 'formmethod', 'get');
		
		$input = $this->renderBlade('<x-aire::input form-method="post" />');
		$this->assertSelectorAttribute($input, 'input', 'formmethod', 'post');
		
		$input = $this->renderBlade('<x-aire::input :form-method="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'formmethod');
	}
	
	public function test_form_no_validate_flag_can_be_set_on_and_off(): void
	{
		$input = $this->renderBlade('<x-aire::input form-no-validate />');
		$this->assertSelectorAttribute($input, 'input', 'formnovalidate');
		
		$input = $this->renderBlade('<x-aire::input :form-no-validate="false" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'formnovalidate');
	}
	
	public function test_form_target_attribute_can_be_set_and_unset(): void
	{
		$input = $this->renderBlade('<x-aire::input form-target="_blank" />');
		$this->assertSelectorAttribute($input, 'input', 'formtarget', '_blank');
		
		$input = $this->renderBlade('<x-aire::input form-target="_parent" />');
		$this->assertSelectorAttribute($input, 'input', 'formtarget', '_parent');
		
		$input = $this->renderBlade('<x-aire::input form-target="_self" />');
		$this->assertSelectorAttribute($input, 'input', 'formtarget', '_self');
		
		$input = $this->renderBlade('<x-aire::input form-target="_top" />');
		$this->assertSelectorAttribute($input, 'input', 'formtarget', '_top');
		
		$input = $this->renderBlade('<x-aire::input :form-target="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'formtarget');
	}
	
	public function test_height_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :height="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'height', $value);
		
		$input = $this->renderBlade('<x-aire::input :height="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'height');
	}
	
	public function test_list_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :list="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'list', $value);
		
		$input = $this->renderBlade('<x-aire::input :list="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'list');
	}
	
	public function test_max_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :max="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'max', $value);
		
		$input = $this->renderBlade('<x-aire::input :max="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'max');
	}
	
	public function test_max_length_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :max-length="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'maxlength', $value);
		
		$input = $this->renderBlade('<x-aire::input :max-length="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'maxlength');
	}
	
	public function test_min_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :min="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'min', $value);
		
		$input = $this->renderBlade('<x-aire::input :min="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'min');
	}
	
	public function test_multiple_flag_can_be_set_on_and_off(): void
	{
		$input = $this->renderBlade('<x-aire::input multiple />');
		$this->assertSelectorAttribute($input, 'input', 'multiple');
		
		$input = $this->renderBlade('<x-aire::input :multiple="false" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'multiple');
	}
	
	public function test_name_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :name="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'name', $value);
		
		$input = $this->renderBlade('<x-aire::input :name="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'name');
	}
	
	public function test_pattern_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :pattern="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'pattern', $value);
		
		$input = $this->renderBlade('<x-aire::input :pattern="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'pattern');
	}
	
	public function test_placeholder_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :placeholder="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'placeholder', $value);
		
		$input = $this->renderBlade('<x-aire::input :placeholder="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'placeholder');
	}
	
	public function test_read_only_flag_can_be_set_on_and_off(): void
	{
		$input = $this->renderBlade('<x-aire::input read-only />');
		$this->assertSelectorAttribute($input, 'input', 'readonly');
		
		$input = $this->renderBlade('<x-aire::input :read-only="false" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'readonly');
	}
	
	public function test_required_flag_can_be_set_on_and_off(): void
	{
		$input = $this->renderBlade('<x-aire::input required />');
		$this->assertSelectorAttribute($input, 'input', 'required');
		
		$input = $this->renderBlade('<x-aire::input :required="false" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'required');
	}
	
	public function test_size_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :size="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'size', $value);
		
		$input = $this->renderBlade('<x-aire::input :size="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'size');
	}
	
	public function test_src_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :src="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'src', $value);
		
		$input = $this->renderBlade('<x-aire::input :src="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'src');
	}
	
	public function test_step_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :step="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'step', $value);
		
		$input = $this->renderBlade('<x-aire::input :step="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'step');
	}
	
	public function test_type_attribute_can_be_set_and_unset(): void
	{
		$input = $this->renderBlade('<x-aire::input type="button" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'button');
		
		$input = $this->renderBlade('<x-aire::input type="checkbox" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'checkbox');
		
		$input = $this->renderBlade('<x-aire::input type="color" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'color');
		
		$input = $this->renderBlade('<x-aire::input type="date" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'date');
		
		$input = $this->renderBlade('<x-aire::input type="datetime" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'datetime');
		
		$input = $this->renderBlade('<x-aire::input type="datetime-local" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'datetime-local');
		
		$input = $this->renderBlade('<x-aire::input type="email" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'email');
		
		$input = $this->renderBlade('<x-aire::input type="file" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'file');
		
		$input = $this->renderBlade('<x-aire::input type="hidden" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'hidden');
		
		$input = $this->renderBlade('<x-aire::input type="image" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'image');
		
		$input = $this->renderBlade('<x-aire::input type="month" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'month');
		
		$input = $this->renderBlade('<x-aire::input type="number" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'number');
		
		$input = $this->renderBlade('<x-aire::input type="password" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'password');
		
		$input = $this->renderBlade('<x-aire::input type="radio" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'radio');
		
		$input = $this->renderBlade('<x-aire::input type="range" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'range');
		
		$input = $this->renderBlade('<x-aire::input type="reset" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'reset');
		
		$input = $this->renderBlade('<x-aire::input type="search" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'search');
		
		$input = $this->renderBlade('<x-aire::input type="submit" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'submit');
		
		$input = $this->renderBlade('<x-aire::input type="tel" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'tel');
		
		$input = $this->renderBlade('<x-aire::input type="text" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'text');
		
		$input = $this->renderBlade('<x-aire::input type="time" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'time');
		
		$input = $this->renderBlade('<x-aire::input type="url" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'url');
		
		$input = $this->renderBlade('<x-aire::input type="week" />');
		$this->assertSelectorAttribute($input, 'input', 'type', 'week');
	}
	
	public function test_value_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :value="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'value', $value);
		
		$input = $this->renderBlade('<x-aire::input :value="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'value');
	}
	
	public function test_width_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$input = $this->renderBlade('<x-aire::input :width="$value" />', compact('value'));
		$this->assertSelectorAttribute($input, 'input', 'width', $value);
		
		$input = $this->renderBlade('<x-aire::input :width="null" />');
		$this->assertSelectorAttributeMissing($input, 'input', 'width');
	}
}
