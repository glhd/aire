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
 *
 */

namespace Galahad\Aire\DTD;

use Galahad\Aire\Elements\FormElement;
use Galahad\Aire\Value\HasValue;

/**
 * Used to create interactive controls for web-based forms in order to
 * accept data from the user.
 *
 */
class Input extends FormElement
{
	use HasValue;

	protected $view = 'input';

	/**
	 * Set the 'accept' attribute
	 *
	 * Possible values:
	 *
	 *  - 'text/html'
	 *  - 'text/plain'
	 *  - 'application/msword'
	 *  - 'application/msexcel'
	 *  - 'application/postscript'
	 *  - 'application/x-zip-compressed'
	 *  - 'application/pdf'
	 *  - 'application/rtf'
	 *  - 'video/x-msvideo'
	 *  - 'video/quicktime'
	 *  - 'video/x-mpeg2'
	 *  - 'audio/x-pn/realaudio'
	 *  - 'audio/x-mpeg'
	 *  - 'audio/x-waw'
	 *  - 'audio/x-aiff'
	 *  - 'audio/basic'
	 *  - 'image/tiff'
	 *  - 'image/jpeg'
	 *  - 'image/gif'
	 *  - 'image/x-png'
	 *  - 'image/x-photo-cd'
	 *  - 'image/x-MS-bmp'
	 *  - 'image/x-rgb'
	 *  - 'image/x-portable-pixmap'
	 *  - 'image/x-portable-greymap'
	 *  - 'image/x-portablebitmap'
	 *
	 * @param string $value
	 * @return self
	 */
	public function accept($value = null) : self
	{
		$this->attributes['accept'] = $value;

		return $this;
	}

	/**
	 * Set the 'alt' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function alt($value = null) : self
	{
		$this->attributes['alt'] = $value;

		return $this;
	}

	/**
	 * Set the 'autocomplete' attribute
	 *
	 * Possible values:
	 *
	 *  - 'additional-name'
	 *  - 'address-level1'
	 *  - 'address-level2'
	 *  - 'address-level3'
	 *  - 'address-level4'
	 *  - 'address-line1'
	 *  - 'address-line2'
	 *  - 'address-line3'
	 *  - 'bday'
	 *  - 'bday-year'
	 *  - 'bday-day'
	 *  - 'bday-month'
	 *  - 'billing'
	 *  - 'cc-additional-name'
	 *  - 'cc-csc'
	 *  - 'cc-exp'
	 *  - 'cc-exp-month'
	 *  - 'cc-exp-year'
	 *  - 'cc-family-name'
	 *  - 'cc-given-name'
	 *  - 'cc-name'
	 *  - 'cc-number'
	 *  - 'cc-type'
	 *  - 'country'
	 *  - 'country-name'
	 *  - 'current-password'
	 *  - 'email'
	 *  - 'family-name'
	 *  - 'fax'
	 *  - 'given-name'
	 *  - 'home'
	 *  - 'honorific-prefix'
	 *  - 'honorific-suffix'
	 *  - 'impp'
	 *  - 'language'
	 *  - 'mobile'
	 *  - 'name'
	 *  - 'new-password'
	 *  - 'nickname'
	 *  - 'off'
	 *  - 'on'
	 *  - 'organization'
	 *  - 'organization-title'
	 *  - 'pager'
	 *  - 'photo'
	 *  - 'postal-code'
	 *  - 'sex'
	 *  - 'shipping'
	 *  - 'street-address'
	 *  - 'tel-area-code'
	 *  - 'tel'
	 *  - 'tel-country-code'
	 *  - 'tel-extension'
	 *  - 'tel-local'
	 *  - 'tel-local-prefix'
	 *  - 'tel-local-suffix'
	 *  - 'tel-national'
	 *  - 'transaction-amount'
	 *  - 'transaction-currency'
	 *  - 'url'
	 *  - 'username'
	 *  - 'work'
	 *
	 * @param string $value
	 * @return self
	 */
	public function autoComplete($value = null) : self
	{
		$this->attributes['autocomplete'] = $value;

		return $this;
	}

	/**
	 * Set the 'autofocus' flag
	 *
	 * @param bool $auto_focus
	 * @return self
	 */
	public function autoFocus(?bool $auto_focus = true) : self
	{
		$this->attributes['autofocus'] = $auto_focus;
		
		return $this;
	}

	/**
	 * Set the 'checked' flag
	 *
	 * @param bool $checked
	 * @return self
	 */
	public function checked(?bool $checked = true) : self
	{
		$this->attributes['checked'] = $checked;
		
		return $this;
	}

	/**
	 * Set the 'dirname' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function dirName($value = null) : self
	{
		$this->attributes['dirname'] = $value;

		return $this;
	}

	/**
	 * Set the 'disabled' flag
	 *
	 * @param bool $disabled
	 * @return self
	 */
	public function disabled(?bool $disabled = true) : self
	{
		$this->attributes['disabled'] = $disabled;
		
		return $this;
	}

	/**
	 * Set the 'form' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function form($value = null) : self
	{
		$this->attributes['form'] = $value;

		return $this;
	}

	/**
	 * Set the 'formaction' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function formAction($value = null) : self
	{
		$this->attributes['formaction'] = $value;

		return $this;
	}

	/**
	 * Set the 'formenctype' attribute
	 *
	 * Possible values:
	 *
	 *  - 'application/x-www-form-urlencoded'
	 *  - 'multipart/form-data'
	 *  - 'text/plain'
	 *
	 * @param string $value
	 * @return self
	 */
	public function formEncType($value = null) : self
	{
		$this->attributes['formenctype'] = $value;

		return $this;
	}

	/**
	 * Set the 'formmethod' attribute
	 *
	 * Possible values:
	 *
	 *  - 'get'
	 *  - 'post'
	 *
	 * @param string $value
	 * @return self
	 */
	public function formMethod($value = null) : self
	{
		$this->attributes['formmethod'] = $value;

		return $this;
	}

	/**
	 * Set the 'formnovalidate' flag
	 *
	 * @param bool $form_no_validate
	 * @return self
	 */
	public function formNoValidate(?bool $form_no_validate = true) : self
	{
		$this->attributes['formnovalidate'] = $form_no_validate;
		
		return $this;
	}

	/**
	 * Set the 'formtarget' attribute
	 *
	 * Possible values:
	 *
	 *  - '_blank'
	 *  - '_parent'
	 *  - '_self'
	 *  - '_top'
	 *
	 * @param string $value
	 * @return self
	 */
	public function formTarget($value = null) : self
	{
		$this->attributes['formtarget'] = $value;

		return $this;
	}

	/**
	 * Set the 'height' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function height($value = null) : self
	{
		$this->attributes['height'] = $value;

		return $this;
	}

	/**
	 * Set the 'list' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function list($value = null) : self
	{
		$this->attributes['list'] = $value;

		return $this;
	}

	/**
	 * Set the 'max' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function max($value = null) : self
	{
		$this->attributes['max'] = $value;

		return $this;
	}

	/**
	 * Set the 'maxlength' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function maxLength($value = null) : self
	{
		$this->attributes['maxlength'] = $value;

		return $this;
	}

	/**
	 * Set the 'min' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function min($value = null) : self
	{
		$this->attributes['min'] = $value;

		return $this;
	}

	/**
	 * Set the 'multiple' flag
	 *
	 * @param bool $multiple
	 * @return self
	 */
	public function multiple(?bool $multiple = true) : self
	{
		$this->attributes['multiple'] = $multiple;
		
		return $this;
	}

	/**
	 * Set the 'pattern' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function pattern($value = null) : self
	{
		$this->attributes['pattern'] = $value;

		return $this;
	}

	/**
	 * Set the 'placeholder' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function placeholder($value = null) : self
	{
		$this->attributes['placeholder'] = $value;

		return $this;
	}

	/**
	 * Set the 'readonly' flag
	 *
	 * @param bool $read_only
	 * @return self
	 */
	public function readOnly(?bool $read_only = true) : self
	{
		$this->attributes['readonly'] = $read_only;
		
		return $this;
	}

	/**
	 * Set the 'required' flag
	 *
	 * @param bool $required
	 * @return self
	 */
	public function required(?bool $required = true) : self
	{
		$this->attributes['required'] = $required;
		
		return $this;
	}

	/**
	 * Set the 'size' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function size($value = null) : self
	{
		$this->attributes['size'] = $value;

		return $this;
	}

	/**
	 * Set the 'src' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function src($value = null) : self
	{
		$this->attributes['src'] = $value;

		return $this;
	}

	/**
	 * Set the 'step' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function step($value = null) : self
	{
		$this->attributes['step'] = $value;

		return $this;
	}

	/**
	 * Set the 'type' attribute
	 *
	 * Possible values:
	 *
	 *  - 'button'
	 *  - 'checkbox'
	 *  - 'color'
	 *  - 'date'
	 *  - 'datetime'
	 *  - 'datetime-local'
	 *  - 'email'
	 *  - 'file'
	 *  - 'hidden'
	 *  - 'image'
	 *  - 'month'
	 *  - 'number'
	 *  - 'password'
	 *  - 'radio'
	 *  - 'range'
	 *  - 'reset'
	 *  - 'search'
	 *  - 'submit'
	 *  - 'tel'
	 *  - 'text'
	 *  - 'time'
	 *  - 'url'
	 *  - 'week'
	 *
	 * @param string $value
	 * @return self
	 */
	public function type($value = null) : self
	{
		$this->attributes['type'] = $value;

		return $this;
	}

	/**
	 * Set the 'width' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function width($value = null) : self
	{
		$this->attributes['width'] = $value;

		return $this;
	}

}
