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

namespace Galahad\Aire\DTD;

use Galahad\Aire\Elements\Element;

/**
 * Used to define an item contained in a select, an optgroup, or a
 * datalist element.
 *
 */
class Option extends Element
{
	public $name = 'option';
	
	/**
	 * Set the 'disabled' flag
	 *
	 * @param bool $disabled
	 * @return $this
	 */
	public function disabled(bool $disabled = true)
	{
		$this->attributes['disabled'] = $disabled;
		
		return $this;
	}
	
	/**
	 * Set the 'label' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function label($value = null)
	{
		$this->attributes['label'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'selected' flag
	 *
	 * @param bool $selected
	 * @return $this
	 */
	public function selected(bool $selected = true)
	{
		$this->attributes['selected'] = $selected;
		
		return $this;
	}
	
	/**
	 * Set the 'value' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function value($value = null)
	{
		$this->attributes['value'] = $value;
		
		return $this;
	}
	
}
