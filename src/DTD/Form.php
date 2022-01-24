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

namespace Galahad\Aire\DTD;

use Galahad\Aire\Elements\Element;

/**
 * Represents a document section that contains interactive controls to
 * submit information to a web server.
 */
class Form extends Element
{
	public $name = 'form';

	/**
	 * Set the 'accept-charset' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function acceptCharset($value = null)
	{
		$this->attributes['accept-charset'] = $value;

		return $this;
	}

	/**
	 * Set the 'action' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function action($value = null)
	{
		$this->attributes['action'] = $value;

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
	 * @return $this
	 */
	public function autoComplete($value = null)
	{
		$this->attributes['autocomplete'] = $value;

		return $this;
	}

	/**
	 * Set the 'enctype' attribute
	 *
	 * Possible values:
	 *
	 *  - 'application/x-www-form-urlencoded'
	 *  - 'multipart/form-data'
	 *  - 'text/plain'
	 *
	 * @param string $value
	 * @return $this
	 */
	public function encType($value = null)
	{
		$this->attributes['enctype'] = $value;

		return $this;
	}

	/**
	 * Set the 'method' attribute
	 *
	 * Possible values:
	 *
	 *  - 'get'
	 *  - 'post'
	 *
	 * @param string $value
	 * @return $this
	 */
	public function method($value = null)
	{
		$this->attributes['method'] = $value
			? strtoupper($value)
			: null;

		return $this;
	}

	/**
	 * Set the 'name' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function name($value = null)
	{
		$this->attributes['name'] = $value;

		return $this;
	}

	/**
	 * Set the 'novalidate' flag
	 *
	 * @param bool $no_validate
	 * @return $this
	 */
	public function noValidate(?bool $no_validate = true)
	{
		$this->attributes['novalidate'] = $no_validate;
		
		return $this;
	}

	/**
	 * Set the 'target' attribute
	 *
	 * Possible values:
	 *
	 *  - '_blank'
	 *  - '_parent'
	 *  - '_self'
	 *  - '_top'
	 *
	 * @param string $value
	 * @return $this
	 */
	public function target($value = null)
	{
		$this->attributes['target'] = $value;

		return $this;
	}
}
