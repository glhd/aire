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

namespace Galahad\Aire\DTD\Concerns;

trait HasGlobalAttributes
{
	/**
	 * Set the 'accesskey' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function accessKey($value = null) : self
	{
		$this->attributes['accesskey'] = $value;

		return $this;
	}

	/**
	 * Set the 'class' cssStyle
	 *
	 * @param string $value
	 * @return self
	 */
	public function class($value = null) : self
	{
		$this->attributes['class'] = $value;

		return $this;
	}

	/**
	 * Set the 'contenteditable' boolean
	 *
	 * @param bool $content_editable
	 * @return self
	 */
	public function contentEditable(bool $content_editable = true) : self
	{
		$this->attributes['contenteditable'] = $content_editable
			? 'true'
			: 'false';

		return $this;
	}

	/**
	 * Set the 'contextmenu' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function contextMenu($value = null) : self
	{
		$this->attributes['contextmenu'] = $value;

		return $this;
	}

	/**
	 * Set the 'dir' attribute
	 *
	 * Possible values:
	 *
	 *  - 'ltr'
	 *  - 'rtl'
	 *
	 * @param string $value
	 * @return self
	 */
	public function dir($value = null) : self
	{
		$this->attributes['dir'] = $value;

		return $this;
	}

	/**
	 * Set the 'draggable' attribute
	 *
	 * Possible values:
	 *
	 *  - 'auto'
	 *  - 'false'
	 *  - 'true'
	 *
	 * @param string $value
	 * @return self
	 */
	public function draggable($value = null) : self
	{
		$this->attributes['draggable'] = $value;

		return $this;
	}

	/**
	 * Set the 'dropzone' attribute
	 *
	 * Possible values:
	 *
	 *  - 'copy'
	 *  - 'move'
	 *  - 'link'
	 *
	 * @param string $value
	 * @return self
	 */
	public function dropZone($value = null) : self
	{
		$this->attributes['dropzone'] = $value;

		return $this;
	}

	/**
	 * Set the 'hidden' flag
	 *
	 * @param bool $hidden
	 * @return self
	 */
	public function hidden(bool $hidden = true) : self
	{
		$this->attributes['hidden'] = $hidden;

		return $this;
	}

	/**
	 * Set the 'id' cssId
	 *
	 * @param string $value
	 * @return self
	 */
	public function id($value = null) : self
	{
		$this->attributes['id'] = $value;

		return $this;
	}

	/**
	 * Set the 'lang' attribute
	 *
	 * Possible values:
	 *
	 *  - 'ab'
	 *  - 'aa'
	 *  - 'af'
	 *  - 'sq'
	 *  - 'am'
	 *  - 'ar'
	 *  - 'an'
	 *  - 'hy'
	 *  - 'as'
	 *  - 'ay'
	 *  - 'az'
	 *  - 'ba'
	 *  - 'eu'
	 *  - 'bn'
	 *  - 'dz'
	 *  - 'bh'
	 *  - 'bi'
	 *  - 'br'
	 *  - 'bg'
	 *  - 'my'
	 *  - 'be'
	 *  - 'km'
	 *  - 'ca'
	 *  - 'zh'
	 *  - 'co'
	 *  - 'hr'
	 *  - 'cs'
	 *  - 'da'
	 *  - 'nl'
	 *  - 'en'
	 *  - 'eo'
	 *  - 'et'
	 *  - 'fo'
	 *  - 'fa'
	 *  - 'fi'
	 *  - 'fr'
	 *  - 'fy'
	 *  - 'gl'
	 *  - 'gd'
	 *  - 'gv'
	 *  - 'ka'
	 *  - 'de'
	 *  - 'el'
	 *  - 'kl'
	 *  - 'gn'
	 *  - 'gu'
	 *  - 'ht'
	 *  - 'ha'
	 *  - 'he'
	 *  - 'hi'
	 *  - 'hu'
	 *  - 'is'
	 *  - 'io'
	 *  - 'id'
	 *  - 'ia'
	 *  - 'ie'
	 *  - 'iu'
	 *  - 'ik'
	 *  - 'ga'
	 *  - 'it'
	 *  - 'ja'
	 *  - 'jv'
	 *  - 'kn'
	 *  - 'ks'
	 *  - 'kk'
	 *  - 'rw'
	 *  - 'ky'
	 *  - 'rn'
	 *  - 'ko'
	 *  - 'ku'
	 *  - 'lo'
	 *  - 'la'
	 *  - 'lv'
	 *  - 'li'
	 *  - 'ln'
	 *  - 'lt'
	 *  - 'mk'
	 *  - 'mg'
	 *  - 'ms'
	 *  - 'ml'
	 *  - 'mt'
	 *  - 'mi'
	 *  - 'mr'
	 *  - 'mo'
	 *  - 'mn'
	 *  - 'na'
	 *  - 'ne'
	 *  - 'no'
	 *  - 'oc'
	 *  - 'or'
	 *  - 'om'
	 *  - 'ps'
	 *  - 'pl'
	 *  - 'pt'
	 *  - 'pa'
	 *  - 'qu'
	 *  - 'rm'
	 *  - 'ro'
	 *  - 'ru'
	 *  - 'sz'
	 *  - 'sm'
	 *  - 'sg'
	 *  - 'sa'
	 *  - 'sr'
	 *  - 'sh'
	 *  - 'st'
	 *  - 'tn'
	 *  - 'sn'
	 *  - 'ii'
	 *  - 'sd'
	 *  - 'si'
	 *  - 'ss'
	 *  - 'sk'
	 *  - 'sl'
	 *  - 'so'
	 *  - 'es'
	 *  - 'su'
	 *  - 'sw'
	 *  - 'sv'
	 *  - 'tl'
	 *  - 'tg'
	 *  - 'ta'
	 *  - 'tt'
	 *  - 'te'
	 *  - 'th'
	 *  - 'bo'
	 *  - 'ti'
	 *  - 'to'
	 *  - 'ts'
	 *  - 'tr'
	 *  - 'tk'
	 *  - 'tw'
	 *  - 'ug'
	 *  - 'uk'
	 *  - 'ur'
	 *  - 'uz'
	 *  - 'vi'
	 *  - 'vo'
	 *  - 'wa'
	 *  - 'cy'
	 *  - 'wo'
	 *  - 'xh'
	 *  - 'yi'
	 *  - 'yo'
	 *  - 'zu'
	 *
	 * @param string $value
	 * @return self
	 */
	public function lang($value = null) : self
	{
		$this->attributes['lang'] = $value;

		return $this;
	}

	/**
	 * Set the 'role' attribute
	 *
	 * Possible values:
	 *
	 *  - 'alert'
	 *  - 'alertdialog'
	 *  - 'article'
	 *  - 'application'
	 *  - 'banner'
	 *  - 'button'
	 *  - 'checkbox'
	 *  - 'columnheader'
	 *  - 'combobox'
	 *  - 'complementary'
	 *  - 'contentinfo'
	 *  - 'definition'
	 *  - 'directory'
	 *  - 'dialog'
	 *  - 'document'
	 *  - 'form'
	 *  - 'grid'
	 *  - 'gridcell'
	 *  - 'group'
	 *  - 'heading'
	 *  - 'img'
	 *  - 'link'
	 *  - 'list'
	 *  - 'listbox'
	 *  - 'listitem'
	 *  - 'log'
	 *  - 'main'
	 *  - 'marquee'
	 *  - 'math'
	 *  - 'menu'
	 *  - 'menubar'
	 *  - 'menuitem'
	 *  - 'menuitemcheckbox'
	 *  - 'menuitemradio'
	 *  - 'navigation'
	 *  - 'note'
	 *  - 'option'
	 *  - 'presentation'
	 *  - 'progressbar'
	 *  - 'radio'
	 *  - 'radiogroup'
	 *  - 'region'
	 *  - 'row'
	 *  - 'rowgroup'
	 *  - 'rowheader'
	 *  - 'scrollbar'
	 *  - 'search'
	 *  - 'separator'
	 *  - 'slider'
	 *  - 'spinbutton'
	 *  - 'status'
	 *  - 'tab'
	 *  - 'tablist'
	 *  - 'tabpanel'
	 *  - 'textbox'
	 *  - 'timer'
	 *  - 'toolbar'
	 *  - 'tooltip'
	 *  - 'tree'
	 *  - 'treegrid'
	 *  - 'treeitem'
	 *
	 * @param string $value
	 * @return self
	 */
	public function role($value = null) : self
	{
		$this->attributes['role'] = $value;

		return $this;
	}

	/**
	 * Set the 'spellcheck' boolean
	 *
	 * @param bool $spell_check
	 * @return self
	 */
	public function spellCheck(bool $spell_check = true) : self
	{
		$this->attributes['spellcheck'] = $spell_check
			? 'true'
			: 'false';

		return $this;
	}

	/**
	 * Set the 'style' style
	 *
	 * @param string $value
	 * @return self
	 */
	public function style($value = null) : self
	{
		$this->attributes['style'] = $value;

		return $this;
	}

	/**
	 * Set the 'tabindex' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function tabIndex($value = null) : self
	{
		$this->attributes['tabindex'] = $value;

		return $this;
	}

	/**
	 * Set the 'title' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function title($value = null) : self
	{
		$this->attributes['title'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-activedescendant' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaActiveDescendant($value = null) : self
	{
		$this->attributes['aria-activedescendant'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-atomic' boolean
	 *
	 * Possible values:
	 *
	 *  - 'true'
	 *  - 'false'
	 *
	 * @param bool $aria_atomic
	 * @return self
	 */
	public function ariaAtomic(bool $aria_atomic = true) : self
	{
		$this->attributes['aria-atomic'] = $aria_atomic
			? 'true'
			: 'false';

		return $this;
	}

	/**
	 * Set the 'aria-busy' boolean
	 *
	 * @param bool $aria_busy
	 * @return self
	 */
	public function ariaBusy(bool $aria_busy = true) : self
	{
		$this->attributes['aria-busy'] = $aria_busy
			? 'true'
			: 'false';

		return $this;
	}

	/**
	 * Set the 'aria-controls' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaControls($value = null) : self
	{
		$this->attributes['aria-controls'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-describedby' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaDescribedBy($value = null) : self
	{
		$this->attributes['aria-describedby'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-disabled' attribute
	 *
	 * Possible values:
	 *
	 *  - 'true'
	 *  - 'false'
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaDisabled($value = null) : self
	{
		$this->attributes['aria-disabled'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-dropeffect' attribute
	 *
	 * Possible values:
	 *
	 *  - 'copy'
	 *  - 'move'
	 *  - 'link'
	 *  - 'execute'
	 *  - 'popup'
	 *  - 'none'
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaDropEffect($value = null) : self
	{
		$this->attributes['aria-dropeffect'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-flowto' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaFlowTo($value = null) : self
	{
		$this->attributes['aria-flowto'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-grabbed' attribute
	 *
	 * Possible values:
	 *
	 *  - 'true'
	 *  - 'false'
	 *  - 'undefined'
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaGrabbed($value = null) : self
	{
		$this->attributes['aria-grabbed'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-haspopup' boolean
	 *
	 * Possible values:
	 *
	 *  - 'true'
	 *  - 'false'
	 *
	 * @param bool $aria_has_popup
	 * @return self
	 */
	public function ariaHasPopup(bool $aria_has_popup = true) : self
	{
		$this->attributes['aria-haspopup'] = $aria_has_popup
			? 'true'
			: 'false';

		return $this;
	}

	/**
	 * Set the 'aria-hidden' boolean
	 *
	 * Possible values:
	 *
	 *  - 'true'
	 *  - 'false'
	 *
	 * @param bool $aria_hidden
	 * @return self
	 */
	public function ariaHidden(bool $aria_hidden = true) : self
	{
		$this->attributes['aria-hidden'] = $aria_hidden
			? 'true'
			: 'false';

		return $this;
	}

	/**
	 * Set the 'aria-invalid' attribute
	 *
	 * Possible values:
	 *
	 *  - 'grammar'
	 *  - 'false'
	 *  - 'spelling'
	 *  - 'true'
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaInvalid($value = null) : self
	{
		$this->attributes['aria-invalid'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-label' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaLabel($value = null) : self
	{
		$this->attributes['aria-label'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-labelledby' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaLabelledBy($value = null) : self
	{
		$this->attributes['aria-labelledby'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-live' attribute
	 *
	 * Possible values:
	 *
	 *  - 'off'
	 *  - 'polite'
	 *  - 'assertive'
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaLive($value = null) : self
	{
		$this->attributes['aria-live'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-owns' attribute
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaOwns($value = null) : self
	{
		$this->attributes['aria-owns'] = $value;

		return $this;
	}

	/**
	 * Set the 'aria-relevant' attribute
	 *
	 * Possible values:
	 *
	 *  - 'additions'
	 *  - 'removals'
	 *  - 'text'
	 *  - 'all'
	 *  - 'additions text'
	 *
	 * @param string $value
	 * @return self
	 */
	public function ariaRelevant($value = null) : self
	{
		$this->attributes['aria-relevant'] = $value;

		return $this;
	}

}
