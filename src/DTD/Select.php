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

use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Form;
use Galahad\Aire\Support\OptionsCollection;

/**
 * Represents a control that provides a menu of options:
 */
class Select extends Element
{
	public $name = 'select';
	
	public function __construct(Aire $aire, Form $form = null)
	{
		$this->view_data['options'] = new OptionsCollection();
		
		parent::__construct($aire, $form);
	}
	
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
	 * Set the 'multiple' flag
	 *
	 * @param bool $multiple
	 * @return $this
	 */
	public function multiple(?bool $multiple = true)
	{
		$this->attributes['multiple'] = $multiple;
		
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
	 * Set the 'size' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function size($value = null)
	{
		$this->attributes['size'] = $value;

		return $this;
	}
}
