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

/**
 * Represents a multi-line plain-text editing control.
 *
 */
class Textarea extends FormElement
{
	protected $view = 'textarea';

	/**
	 * Set the 'autofocus' attribute
	 *
	 * @param bool $autofocus
	 * @return self
	 */
	public function autofocus($autofocus = true) : self
	{
		$this->attributes['autofocus'] = $autofocus;

		return $this;
	}

	/**
	 * Set the 'cols' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function cols($value = null) : self
	{
		$this->attributes['cols'] = $value;

		return $this;
	}

	/**
	 * Set the 'dirname' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function dirname($value = null) : self
	{
		$this->attributes['dirname'] = $value;

		return $this;
	}

	/**
	 * Set the 'disabled' attribute
	 *
	 * @param bool $disabled
	 * @return self
	 */
	public function disabled($disabled = true) : self
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
	 * Set the 'label' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function label($value = null) : self
	{
		$this->attributes['label'] = $value;

		return $this;
	}

	/**
	 * Set the 'maxlength' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function maxlength($value = null) : self
	{
		$this->attributes['maxlength'] = $value;

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
	 * Set the 'readonly' attribute
	 *
	 * @param bool $readonly
	 * @return self
	 */
	public function readonly($readonly = true) : self
	{
		$this->attributes['readonly'] = $readonly;

		return $this;
	}

	/**
	 * Set the 'required' attribute
	 *
	 * @param bool $required
	 * @return self
	 */
	public function required($required = true) : self
	{
		$this->attributes['required'] = $required;

		return $this;
	}

	/**
	 * Set the 'rows' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function rows($value = null) : self
	{
		$this->attributes['rows'] = $value;

		return $this;
	}

	/**
	 * Set the 'wrap' attribute
	 *
	 * Possible values:
	 *
	 *  - 'hard'
	 *  - 'soft'
	 *
	 * @param string $value
	 * @return self
	 */
	public function wrap($value = null) : self
	{
		$this->attributes['wrap'] = $value;

		return $this;
	}

}
