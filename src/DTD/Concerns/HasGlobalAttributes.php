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

namespace Galahad\Aire\DTD\Concerns;

trait HasGlobalAttributes
{
	/**
	 * Set the 'accesskey' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function accessKey($value = null)
	{
		$this->attributes['accesskey'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'class' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function class($value = null)
	{
		$this->attributes['class'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'contenteditable' boolean attribute
	 *
	 * @param bool $content_editable
	 * @return $this
	 */
	public function contentEditable(?bool $content_editable = true)
	{
		if (null === $content_editable) {
			$this->attributes['contenteditable'] = null;
		} else {
			$this->attributes['contenteditable'] = $content_editable
				? 'true'
				: 'false';
		}
		
		return $this;
	}
	
	/**
	 * Set the 'contextmenu' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function contextMenu($value = null)
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
	 * @return $this
	 */
	public function dir($value = null)
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
	 * @return $this
	 */
	public function draggable($value = null)
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
	 * @return $this
	 */
	public function dropZone($value = null)
	{
		$this->attributes['dropzone'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'hidden' flag
	 *
	 * @param bool $hidden
	 * @return $this
	 */
	public function hide(?bool $hidden = true)
	{
		$this->attributes['hidden'] = $hidden;
		
		return $this;
	}
	
	/**
	 * Set the 'id' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function id($value = null)
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
	 * @return $this
	 */
	public function lang($value = null)
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
	 * @return $this
	 */
	public function role($value = null)
	{
		$this->attributes['role'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'spellcheck' boolean attribute
	 *
	 * @param bool $spell_check
	 * @return $this
	 */
	public function spellCheck(?bool $spell_check = true)
	{
		if (null === $spell_check) {
			$this->attributes['spellcheck'] = null;
		} else {
			$this->attributes['spellcheck'] = $spell_check
				? 'true'
				: 'false';
		}
		
		return $this;
	}
	
	/**
	 * Set the 'style' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function style($value = null)
	{
		$this->attributes['style'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'tabindex' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function tabIndex($value = null)
	{
		$this->attributes['tabindex'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'title' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function title($value = null)
	{
		$this->attributes['title'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'aria-activedescendant' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function ariaActiveDescendant($value = null)
	{
		$this->attributes['aria-activedescendant'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'aria-atomic' boolean attribute
	 *
	 * Possible values:
	 *
	 *  - 'true'
	 *  - 'false'
	 *
	 * @param bool $aria_atomic
	 * @return $this
	 */
	public function ariaAtomic(?bool $aria_atomic = true)
	{
		if (null === $aria_atomic) {
			$this->attributes['aria-atomic'] = null;
		} else {
			$this->attributes['aria-atomic'] = $aria_atomic
				? 'true'
				: 'false';
		}
		
		return $this;
	}
	
	/**
	 * Set the 'aria-busy' boolean attribute
	 *
	 * @param bool $aria_busy
	 * @return $this
	 */
	public function ariaBusy(?bool $aria_busy = true)
	{
		if (null === $aria_busy) {
			$this->attributes['aria-busy'] = null;
		} else {
			$this->attributes['aria-busy'] = $aria_busy
				? 'true'
				: 'false';
		}
		
		return $this;
	}
	
	/**
	 * Set the 'aria-controls' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function ariaControls($value = null)
	{
		$this->attributes['aria-controls'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'aria-describedby' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function ariaDescribedBy($value = null)
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
	 * @return $this
	 */
	public function ariaDisabled($value = null)
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
	 * @return $this
	 */
	public function ariaDropEffect($value = null)
	{
		$this->attributes['aria-dropeffect'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'aria-flowto' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function ariaFlowTo($value = null)
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
	 * @return $this
	 */
	public function ariaGrabbed($value = null)
	{
		$this->attributes['aria-grabbed'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'aria-haspopup' boolean attribute
	 *
	 * Possible values:
	 *
	 *  - 'true'
	 *  - 'false'
	 *
	 * @param bool $aria_has_popup
	 * @return $this
	 */
	public function ariaHasPopup(?bool $aria_has_popup = true)
	{
		if (null === $aria_has_popup) {
			$this->attributes['aria-haspopup'] = null;
		} else {
			$this->attributes['aria-haspopup'] = $aria_has_popup
				? 'true'
				: 'false';
		}
		
		return $this;
	}
	
	/**
	 * Set the 'aria-hidden' boolean attribute
	 *
	 * Possible values:
	 *
	 *  - 'true'
	 *  - 'false'
	 *
	 * @param bool $aria_hidden
	 * @return $this
	 */
	public function ariaHidden(?bool $aria_hidden = true)
	{
		if (null === $aria_hidden) {
			$this->attributes['aria-hidden'] = null;
		} else {
			$this->attributes['aria-hidden'] = $aria_hidden
				? 'true'
				: 'false';
		}
		
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
	 * @return $this
	 */
	public function ariaInvalid($value = null)
	{
		$this->attributes['aria-invalid'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'aria-label' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function ariaLabel($value = null)
	{
		$this->attributes['aria-label'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'aria-labelledby' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function ariaLabelledBy($value = null)
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
	 * @return $this
	 */
	public function ariaLive($value = null)
	{
		$this->attributes['aria-live'] = $value;
		
		return $this;
	}
	
	/**
	 * Set the 'aria-owns' attribute
	 *
	 * @param string $value
	 * @return $this
	 */
	public function ariaOwns($value = null)
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
	 * @return $this
	 */
	public function ariaRelevant($value = null)
	{
		$this->attributes['aria-relevant'] = $value;
		
		return $this;
	}
}
