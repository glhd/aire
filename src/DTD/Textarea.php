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
 * Represents a multi-line plain-text editing control.
 */
class Textarea extends Element
{
	public $name = 'textarea';

	/**
	 * Set the 'autofocus' flag
	 *
	 * @param bool $auto_focus
	 * @return $this
	 */
	public function autoFocus(?bool $auto_focus = true)
	{
		$this->attributes['autofocus'] = $auto_focus;
		
		return $this;
	}

	/**
	 * Set the 'cols' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function cols($value = null)
	{
		$this->attributes['cols'] = $value;

		return $this;
	}

	/**
	 * Set the 'dirname' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function dirName($value = null)
	{
		$this->attributes['dirname'] = $value;

		return $this;
	}

	/**
	 * Set the 'disabled' flag
	 *
	 * @param bool $disabled
	 * @return $this
	 */
	public function disabled(?bool $disabled = true)
	{
		$this->attributes['disabled'] = $disabled;
		
		return $this;
	}

	/**
	 * Set the 'form' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function form($value = null)
	{
		$this->attributes['form'] = $value;

		return $this;
	}

	/**
	 * Set the 'maxlength' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function maxLength($value = null)
	{
		$this->attributes['maxlength'] = $value;

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
	 * Set the 'placeholder' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function placeholder($value = null)
	{
		$this->attributes['placeholder'] = $value;

		return $this;
	}

	/**
	 * Set the 'readonly' flag
	 *
	 * @param bool $read_only
	 * @return $this
	 */
	public function readOnly(?bool $read_only = true)
	{
		$this->attributes['readonly'] = $read_only;
		
		return $this;
	}

	/**
	 * Set the 'required' flag
	 *
	 * @param bool $required
	 * @return $this
	 */
	public function required(?bool $required = true)
	{
		$this->attributes['required'] = $required;
		
		return $this;
	}

	/**
	 * Set the 'rows' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function rows($value = null)
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
	 * @return $this
	 */
	public function wrap($value = null)
	{
		$this->attributes['wrap'] = $value;

		return $this;
	}
}
