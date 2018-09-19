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
 * Represents a clickable button, which can be used in forms, or anywhere
 * in a document that needs simple, standard button functionality.
 *
 */
class Button extends FormElement
{
	use HasValue;

	protected $view = 'button';

	/**
	 * Set the 'autofocus' flag
	 *
	 * @param bool $autofocus
	 * @return self
	 */
	public function autofocus(?bool $autofocus = true) : self
	{
		$this->attributes['autofocus'] = $autofocus;
		
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
	public function formaction($value = null) : self
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
	public function formenctype($value = null) : self
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
	public function formmethod($value = null) : self
	{
		$this->attributes['formmethod'] = $value;

		return $this;
	}

	/**
	 * Set the 'formnovalidate' flag
	 *
	 * @param bool $formnovalidate
	 * @return self
	 */
	public function formnovalidate(?bool $formnovalidate = true) : self
	{
		$this->attributes['formnovalidate'] = $formnovalidate;
		
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
	public function formtarget($value = null) : self
	{
		$this->attributes['formtarget'] = $value;

		return $this;
	}

	/**
	 * Set the 'type' attribute
	 *
	 * Possible values:
	 *
	 *  - 'button'
	 *  - 'reset'
	 *  - 'submit'
	 *
	 * @param string $value
	 * @return self
	 */
	public function type($value = null) : self
	{
		$this->attributes['type'] = $value;

		return $this;
	}

}
