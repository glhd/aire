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

class GlobalAttributesTest extends ComponentTestCase
{
	public function test_access_key_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :access-key="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'accesskey', $value);
		
		$form = $this->renderBlade('<x-aire::form :access-key="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'accesskey');
	}
	
	public function test_class_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :class="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'class', $value);
	}
	
	public function test_content_editable_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form content-editable />');
		$this->assertSelectorAttribute($form, 'form', 'contenteditable', 'true');
		
		$form = $this->renderBlade('<x-aire::form :content-editable="false" />');
		$this->assertSelectorAttribute($form, 'form', 'contenteditable', 'false');
		
		$form = $this->renderBlade('<x-aire::form :content-editable="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'contenteditable');
	}
	
	public function test_context_menu_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :context-menu="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'contextmenu', $value);
		
		$form = $this->renderBlade('<x-aire::form :context-menu="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'contextmenu');
	}
	
	public function test_dir_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form dir="ltr" />');
		$this->assertSelectorAttribute($form, 'form', 'dir', 'ltr');
		
		$form = $this->renderBlade('<x-aire::form dir="rtl" />');
		$this->assertSelectorAttribute($form, 'form', 'dir', 'rtl');
		
		$form = $this->renderBlade('<x-aire::form :dir="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'dir');
	}
	
	public function test_draggable_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form draggable="auto" />');
		$this->assertSelectorAttribute($form, 'form', 'draggable', 'auto');
		
		$form = $this->renderBlade('<x-aire::form draggable="false" />');
		$this->assertSelectorAttribute($form, 'form', 'draggable', 'false');
		
		$form = $this->renderBlade('<x-aire::form draggable="true" />');
		$this->assertSelectorAttribute($form, 'form', 'draggable', 'true');
		
		$form = $this->renderBlade('<x-aire::form :draggable="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'draggable');
	}
	
	public function test_drop_zone_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form drop-zone="copy" />');
		$this->assertSelectorAttribute($form, 'form', 'dropzone', 'copy');
		
		$form = $this->renderBlade('<x-aire::form drop-zone="move" />');
		$this->assertSelectorAttribute($form, 'form', 'dropzone', 'move');
		
		$form = $this->renderBlade('<x-aire::form drop-zone="link" />');
		$this->assertSelectorAttribute($form, 'form', 'dropzone', 'link');
		
		$form = $this->renderBlade('<x-aire::form :drop-zone="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'dropzone');
	}
	
	public function test_hidden_flag_can_be_set_on_and_off(): void
	{
		$form = $this->renderBlade('<x-aire::form hide />');
		$this->assertSelectorAttribute($form, 'form', 'hidden');
		
		$form = $this->renderBlade('<x-aire::form :hide="false" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'hidden');
	}
	
	public function test_id_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :id="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'id', $value);
		
		$form = $this->renderBlade('<x-aire::form :id="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'id');
	}
	
	public function test_lang_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form lang="ab" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ab');
		
		$form = $this->renderBlade('<x-aire::form lang="aa" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'aa');
		
		$form = $this->renderBlade('<x-aire::form lang="af" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'af');
		
		$form = $this->renderBlade('<x-aire::form lang="sq" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sq');
		
		$form = $this->renderBlade('<x-aire::form lang="am" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'am');
		
		$form = $this->renderBlade('<x-aire::form lang="ar" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ar');
		
		$form = $this->renderBlade('<x-aire::form lang="an" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'an');
		
		$form = $this->renderBlade('<x-aire::form lang="hy" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'hy');
		
		$form = $this->renderBlade('<x-aire::form lang="as" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'as');
		
		$form = $this->renderBlade('<x-aire::form lang="ay" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ay');
		
		$form = $this->renderBlade('<x-aire::form lang="az" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'az');
		
		$form = $this->renderBlade('<x-aire::form lang="ba" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ba');
		
		$form = $this->renderBlade('<x-aire::form lang="eu" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'eu');
		
		$form = $this->renderBlade('<x-aire::form lang="bn" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'bn');
		
		$form = $this->renderBlade('<x-aire::form lang="dz" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'dz');
		
		$form = $this->renderBlade('<x-aire::form lang="bh" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'bh');
		
		$form = $this->renderBlade('<x-aire::form lang="bi" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'bi');
		
		$form = $this->renderBlade('<x-aire::form lang="br" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'br');
		
		$form = $this->renderBlade('<x-aire::form lang="bg" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'bg');
		
		$form = $this->renderBlade('<x-aire::form lang="my" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'my');
		
		$form = $this->renderBlade('<x-aire::form lang="be" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'be');
		
		$form = $this->renderBlade('<x-aire::form lang="km" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'km');
		
		$form = $this->renderBlade('<x-aire::form lang="ca" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ca');
		
		$form = $this->renderBlade('<x-aire::form lang="zh" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'zh');
		
		$form = $this->renderBlade('<x-aire::form lang="co" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'co');
		
		$form = $this->renderBlade('<x-aire::form lang="hr" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'hr');
		
		$form = $this->renderBlade('<x-aire::form lang="cs" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'cs');
		
		$form = $this->renderBlade('<x-aire::form lang="da" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'da');
		
		$form = $this->renderBlade('<x-aire::form lang="nl" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'nl');
		
		$form = $this->renderBlade('<x-aire::form lang="en" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'en');
		
		$form = $this->renderBlade('<x-aire::form lang="eo" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'eo');
		
		$form = $this->renderBlade('<x-aire::form lang="et" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'et');
		
		$form = $this->renderBlade('<x-aire::form lang="fo" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'fo');
		
		$form = $this->renderBlade('<x-aire::form lang="fa" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'fa');
		
		$form = $this->renderBlade('<x-aire::form lang="fi" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'fi');
		
		$form = $this->renderBlade('<x-aire::form lang="fr" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'fr');
		
		$form = $this->renderBlade('<x-aire::form lang="fy" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'fy');
		
		$form = $this->renderBlade('<x-aire::form lang="gl" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'gl');
		
		$form = $this->renderBlade('<x-aire::form lang="gd" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'gd');
		
		$form = $this->renderBlade('<x-aire::form lang="gv" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'gv');
		
		$form = $this->renderBlade('<x-aire::form lang="ka" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ka');
		
		$form = $this->renderBlade('<x-aire::form lang="de" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'de');
		
		$form = $this->renderBlade('<x-aire::form lang="el" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'el');
		
		$form = $this->renderBlade('<x-aire::form lang="kl" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'kl');
		
		$form = $this->renderBlade('<x-aire::form lang="gn" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'gn');
		
		$form = $this->renderBlade('<x-aire::form lang="gu" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'gu');
		
		$form = $this->renderBlade('<x-aire::form lang="ht" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ht');
		
		$form = $this->renderBlade('<x-aire::form lang="ha" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ha');
		
		$form = $this->renderBlade('<x-aire::form lang="he" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'he');
		
		$form = $this->renderBlade('<x-aire::form lang="hi" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'hi');
		
		$form = $this->renderBlade('<x-aire::form lang="hu" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'hu');
		
		$form = $this->renderBlade('<x-aire::form lang="is" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'is');
		
		$form = $this->renderBlade('<x-aire::form lang="io" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'io');
		
		$form = $this->renderBlade('<x-aire::form lang="id" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'id');
		
		$form = $this->renderBlade('<x-aire::form lang="ia" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ia');
		
		$form = $this->renderBlade('<x-aire::form lang="ie" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ie');
		
		$form = $this->renderBlade('<x-aire::form lang="iu" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'iu');
		
		$form = $this->renderBlade('<x-aire::form lang="ik" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ik');
		
		$form = $this->renderBlade('<x-aire::form lang="ga" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ga');
		
		$form = $this->renderBlade('<x-aire::form lang="it" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'it');
		
		$form = $this->renderBlade('<x-aire::form lang="ja" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ja');
		
		$form = $this->renderBlade('<x-aire::form lang="jv" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'jv');
		
		$form = $this->renderBlade('<x-aire::form lang="kn" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'kn');
		
		$form = $this->renderBlade('<x-aire::form lang="ks" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ks');
		
		$form = $this->renderBlade('<x-aire::form lang="kk" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'kk');
		
		$form = $this->renderBlade('<x-aire::form lang="rw" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'rw');
		
		$form = $this->renderBlade('<x-aire::form lang="ky" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ky');
		
		$form = $this->renderBlade('<x-aire::form lang="rn" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'rn');
		
		$form = $this->renderBlade('<x-aire::form lang="ko" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ko');
		
		$form = $this->renderBlade('<x-aire::form lang="ku" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ku');
		
		$form = $this->renderBlade('<x-aire::form lang="lo" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'lo');
		
		$form = $this->renderBlade('<x-aire::form lang="la" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'la');
		
		$form = $this->renderBlade('<x-aire::form lang="lv" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'lv');
		
		$form = $this->renderBlade('<x-aire::form lang="li" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'li');
		
		$form = $this->renderBlade('<x-aire::form lang="ln" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ln');
		
		$form = $this->renderBlade('<x-aire::form lang="lt" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'lt');
		
		$form = $this->renderBlade('<x-aire::form lang="mk" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mk');
		
		$form = $this->renderBlade('<x-aire::form lang="mg" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mg');
		
		$form = $this->renderBlade('<x-aire::form lang="ms" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ms');
		
		$form = $this->renderBlade('<x-aire::form lang="ml" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ml');
		
		$form = $this->renderBlade('<x-aire::form lang="mt" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mt');
		
		$form = $this->renderBlade('<x-aire::form lang="mi" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mi');
		
		$form = $this->renderBlade('<x-aire::form lang="mr" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mr');
		
		$form = $this->renderBlade('<x-aire::form lang="mo" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mo');
		
		$form = $this->renderBlade('<x-aire::form lang="mn" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mn');
		
		$form = $this->renderBlade('<x-aire::form lang="na" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'na');
		
		$form = $this->renderBlade('<x-aire::form lang="ne" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ne');
		
		$form = $this->renderBlade('<x-aire::form lang="no" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'no');
		
		$form = $this->renderBlade('<x-aire::form lang="oc" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'oc');
		
		$form = $this->renderBlade('<x-aire::form lang="or" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'or');
		
		$form = $this->renderBlade('<x-aire::form lang="om" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'om');
		
		$form = $this->renderBlade('<x-aire::form lang="ps" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ps');
		
		$form = $this->renderBlade('<x-aire::form lang="pl" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'pl');
		
		$form = $this->renderBlade('<x-aire::form lang="pt" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'pt');
		
		$form = $this->renderBlade('<x-aire::form lang="pa" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'pa');
		
		$form = $this->renderBlade('<x-aire::form lang="qu" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'qu');
		
		$form = $this->renderBlade('<x-aire::form lang="rm" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'rm');
		
		$form = $this->renderBlade('<x-aire::form lang="ro" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ro');
		
		$form = $this->renderBlade('<x-aire::form lang="ru" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ru');
		
		$form = $this->renderBlade('<x-aire::form lang="sz" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sz');
		
		$form = $this->renderBlade('<x-aire::form lang="sm" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sm');
		
		$form = $this->renderBlade('<x-aire::form lang="sg" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sg');
		
		$form = $this->renderBlade('<x-aire::form lang="sa" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sa');
		
		$form = $this->renderBlade('<x-aire::form lang="sr" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sr');
		
		$form = $this->renderBlade('<x-aire::form lang="sh" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sh');
		
		$form = $this->renderBlade('<x-aire::form lang="st" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'st');
		
		$form = $this->renderBlade('<x-aire::form lang="tn" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tn');
		
		$form = $this->renderBlade('<x-aire::form lang="sn" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sn');
		
		$form = $this->renderBlade('<x-aire::form lang="ii" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ii');
		
		$form = $this->renderBlade('<x-aire::form lang="sd" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sd');
		
		$form = $this->renderBlade('<x-aire::form lang="si" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'si');
		
		$form = $this->renderBlade('<x-aire::form lang="ss" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ss');
		
		$form = $this->renderBlade('<x-aire::form lang="sk" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sk');
		
		$form = $this->renderBlade('<x-aire::form lang="sl" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sl');
		
		$form = $this->renderBlade('<x-aire::form lang="so" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'so');
		
		$form = $this->renderBlade('<x-aire::form lang="es" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'es');
		
		$form = $this->renderBlade('<x-aire::form lang="su" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'su');
		
		$form = $this->renderBlade('<x-aire::form lang="sw" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sw');
		
		$form = $this->renderBlade('<x-aire::form lang="sv" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sv');
		
		$form = $this->renderBlade('<x-aire::form lang="tl" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tl');
		
		$form = $this->renderBlade('<x-aire::form lang="tg" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tg');
		
		$form = $this->renderBlade('<x-aire::form lang="ta" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ta');
		
		$form = $this->renderBlade('<x-aire::form lang="tt" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tt');
		
		$form = $this->renderBlade('<x-aire::form lang="te" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'te');
		
		$form = $this->renderBlade('<x-aire::form lang="th" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'th');
		
		$form = $this->renderBlade('<x-aire::form lang="bo" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'bo');
		
		$form = $this->renderBlade('<x-aire::form lang="ti" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ti');
		
		$form = $this->renderBlade('<x-aire::form lang="to" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'to');
		
		$form = $this->renderBlade('<x-aire::form lang="ts" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ts');
		
		$form = $this->renderBlade('<x-aire::form lang="tr" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tr');
		
		$form = $this->renderBlade('<x-aire::form lang="tk" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tk');
		
		$form = $this->renderBlade('<x-aire::form lang="tw" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tw');
		
		$form = $this->renderBlade('<x-aire::form lang="ug" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ug');
		
		$form = $this->renderBlade('<x-aire::form lang="uk" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'uk');
		
		$form = $this->renderBlade('<x-aire::form lang="ur" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ur');
		
		$form = $this->renderBlade('<x-aire::form lang="uz" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'uz');
		
		$form = $this->renderBlade('<x-aire::form lang="vi" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'vi');
		
		$form = $this->renderBlade('<x-aire::form lang="vo" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'vo');
		
		$form = $this->renderBlade('<x-aire::form lang="wa" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'wa');
		
		$form = $this->renderBlade('<x-aire::form lang="cy" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'cy');
		
		$form = $this->renderBlade('<x-aire::form lang="wo" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'wo');
		
		$form = $this->renderBlade('<x-aire::form lang="xh" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'xh');
		
		$form = $this->renderBlade('<x-aire::form lang="yi" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'yi');
		
		$form = $this->renderBlade('<x-aire::form lang="yo" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'yo');
		
		$form = $this->renderBlade('<x-aire::form lang="zu" />');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'zu');
		
		$form = $this->renderBlade('<x-aire::form :lang="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'lang');
	}
	
	public function test_role_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form role="alert" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'alert');
		
		$form = $this->renderBlade('<x-aire::form role="alertdialog" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'alertdialog');
		
		$form = $this->renderBlade('<x-aire::form role="article" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'article');
		
		$form = $this->renderBlade('<x-aire::form role="application" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'application');
		
		$form = $this->renderBlade('<x-aire::form role="banner" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'banner');
		
		$form = $this->renderBlade('<x-aire::form role="button" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'button');
		
		$form = $this->renderBlade('<x-aire::form role="checkbox" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'checkbox');
		
		$form = $this->renderBlade('<x-aire::form role="columnheader" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'columnheader');
		
		$form = $this->renderBlade('<x-aire::form role="combobox" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'combobox');
		
		$form = $this->renderBlade('<x-aire::form role="complementary" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'complementary');
		
		$form = $this->renderBlade('<x-aire::form role="contentinfo" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'contentinfo');
		
		$form = $this->renderBlade('<x-aire::form role="definition" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'definition');
		
		$form = $this->renderBlade('<x-aire::form role="directory" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'directory');
		
		$form = $this->renderBlade('<x-aire::form role="dialog" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'dialog');
		
		$form = $this->renderBlade('<x-aire::form role="document" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'document');
		
		$form = $this->renderBlade('<x-aire::form role="form" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'form');
		
		$form = $this->renderBlade('<x-aire::form role="grid" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'grid');
		
		$form = $this->renderBlade('<x-aire::form role="gridcell" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'gridcell');
		
		$form = $this->renderBlade('<x-aire::form role="group" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'group');
		
		$form = $this->renderBlade('<x-aire::form role="heading" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'heading');
		
		$form = $this->renderBlade('<x-aire::form role="img" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'img');
		
		$form = $this->renderBlade('<x-aire::form role="link" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'link');
		
		$form = $this->renderBlade('<x-aire::form role="list" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'list');
		
		$form = $this->renderBlade('<x-aire::form role="listbox" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'listbox');
		
		$form = $this->renderBlade('<x-aire::form role="listitem" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'listitem');
		
		$form = $this->renderBlade('<x-aire::form role="log" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'log');
		
		$form = $this->renderBlade('<x-aire::form role="main" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'main');
		
		$form = $this->renderBlade('<x-aire::form role="marquee" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'marquee');
		
		$form = $this->renderBlade('<x-aire::form role="math" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'math');
		
		$form = $this->renderBlade('<x-aire::form role="menu" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'menu');
		
		$form = $this->renderBlade('<x-aire::form role="menubar" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'menubar');
		
		$form = $this->renderBlade('<x-aire::form role="menuitem" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'menuitem');
		
		$form = $this->renderBlade('<x-aire::form role="menuitemcheckbox" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'menuitemcheckbox');
		
		$form = $this->renderBlade('<x-aire::form role="menuitemradio" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'menuitemradio');
		
		$form = $this->renderBlade('<x-aire::form role="navigation" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'navigation');
		
		$form = $this->renderBlade('<x-aire::form role="note" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'note');
		
		$form = $this->renderBlade('<x-aire::form role="option" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'option');
		
		$form = $this->renderBlade('<x-aire::form role="presentation" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'presentation');
		
		$form = $this->renderBlade('<x-aire::form role="progressbar" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'progressbar');
		
		$form = $this->renderBlade('<x-aire::form role="radio" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'radio');
		
		$form = $this->renderBlade('<x-aire::form role="radiogroup" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'radiogroup');
		
		$form = $this->renderBlade('<x-aire::form role="region" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'region');
		
		$form = $this->renderBlade('<x-aire::form role="row" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'row');
		
		$form = $this->renderBlade('<x-aire::form role="rowgroup" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'rowgroup');
		
		$form = $this->renderBlade('<x-aire::form role="rowheader" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'rowheader');
		
		$form = $this->renderBlade('<x-aire::form role="scrollbar" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'scrollbar');
		
		$form = $this->renderBlade('<x-aire::form role="search" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'search');
		
		$form = $this->renderBlade('<x-aire::form role="separator" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'separator');
		
		$form = $this->renderBlade('<x-aire::form role="slider" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'slider');
		
		$form = $this->renderBlade('<x-aire::form role="spinbutton" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'spinbutton');
		
		$form = $this->renderBlade('<x-aire::form role="status" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'status');
		
		$form = $this->renderBlade('<x-aire::form role="tab" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'tab');
		
		$form = $this->renderBlade('<x-aire::form role="tablist" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'tablist');
		
		$form = $this->renderBlade('<x-aire::form role="tabpanel" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'tabpanel');
		
		$form = $this->renderBlade('<x-aire::form role="textbox" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'textbox');
		
		$form = $this->renderBlade('<x-aire::form role="timer" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'timer');
		
		$form = $this->renderBlade('<x-aire::form role="toolbar" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'toolbar');
		
		$form = $this->renderBlade('<x-aire::form role="tooltip" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'tooltip');
		
		$form = $this->renderBlade('<x-aire::form role="tree" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'tree');
		
		$form = $this->renderBlade('<x-aire::form role="treegrid" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'treegrid');
		
		$form = $this->renderBlade('<x-aire::form role="treeitem" />');
		$this->assertSelectorAttribute($form, 'form', 'role', 'treeitem');
		
		$form = $this->renderBlade('<x-aire::form :role="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'role');
	}
	
	public function test_spell_check_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form spell-check />');
		$this->assertSelectorAttribute($form, 'form', 'spellcheck', 'true');
		
		$form = $this->renderBlade('<x-aire::form :spell-check="false" />');
		$this->assertSelectorAttribute($form, 'form', 'spellcheck', 'false');
		
		$form = $this->renderBlade('<x-aire::form :spell-check="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'spellcheck');
	}
	
	public function test_style_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :style="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'style', $value);
		
		$form = $this->renderBlade('<x-aire::form :style="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'style');
	}
	
	public function test_tab_index_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :tab-index="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'tabindex', $value);
		
		$form = $this->renderBlade('<x-aire::form :tab-index="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'tabindex');
	}
	
	public function test_title_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :title="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'title', $value);
		
		$form = $this->renderBlade('<x-aire::form :title="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'title');
	}
	
	public function test_aria_active_descendant_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :aria-active-descendant="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'aria-activedescendant', $value);
		
		$form = $this->renderBlade('<x-aire::form :aria-active-descendant="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-activedescendant');
	}
	
	public function test_aria_atomic_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form aria-atomic />');
		$this->assertSelectorAttribute($form, 'form', 'aria-atomic', 'true');
		
		$form = $this->renderBlade('<x-aire::form :aria-atomic="false" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-atomic', 'false');
		
		$form = $this->renderBlade('<x-aire::form :aria-atomic="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-atomic');
	}
	
	public function test_aria_busy_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form aria-busy />');
		$this->assertSelectorAttribute($form, 'form', 'aria-busy', 'true');
		
		$form = $this->renderBlade('<x-aire::form :aria-busy="false" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-busy', 'false');
		
		$form = $this->renderBlade('<x-aire::form :aria-busy="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-busy');
	}
	
	public function test_aria_controls_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :aria-controls="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'aria-controls', $value);
		
		$form = $this->renderBlade('<x-aire::form :aria-controls="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-controls');
	}
	
	public function test_aria_described_by_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :aria-described-by="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'aria-describedby', $value);
		
		$form = $this->renderBlade('<x-aire::form :aria-described-by="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-describedby');
	}
	
	public function test_aria_disabled_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form aria-disabled="true" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-disabled', 'true');
		
		$form = $this->renderBlade('<x-aire::form aria-disabled="false" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-disabled', 'false');
		
		$form = $this->renderBlade('<x-aire::form :aria-disabled="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-disabled');
	}
	
	public function test_aria_drop_effect_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form aria-drop-effect="copy" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'copy');
		
		$form = $this->renderBlade('<x-aire::form aria-drop-effect="move" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'move');
		
		$form = $this->renderBlade('<x-aire::form aria-drop-effect="link" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'link');
		
		$form = $this->renderBlade('<x-aire::form aria-drop-effect="execute" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'execute');
		
		$form = $this->renderBlade('<x-aire::form aria-drop-effect="popup" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'popup');
		
		$form = $this->renderBlade('<x-aire::form aria-drop-effect="none" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'none');
		
		$form = $this->renderBlade('<x-aire::form :aria-drop-effect="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-dropeffect');
	}
	
	public function test_aria_flow_to_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :aria-flow-to="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'aria-flowto', $value);
		
		$form = $this->renderBlade('<x-aire::form :aria-flow-to="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-flowto');
	}
	
	public function test_aria_grabbed_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form aria-grabbed="true" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-grabbed', 'true');
		
		$form = $this->renderBlade('<x-aire::form aria-grabbed="false" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-grabbed', 'false');
		
		$form = $this->renderBlade('<x-aire::form aria-grabbed="undefined" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-grabbed', 'undefined');
		
		$form = $this->renderBlade('<x-aire::form :aria-grabbed="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-grabbed');
	}
	
	public function test_aria_has_popup_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form aria-has-popup />');
		$this->assertSelectorAttribute($form, 'form', 'aria-haspopup', 'true');
		
		$form = $this->renderBlade('<x-aire::form :aria-has-popup="false" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-haspopup', 'false');
		
		$form = $this->renderBlade('<x-aire::form :aria-has-popup="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-haspopup');
	}
	
	public function test_aria_hidden_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form aria-hidden />');
		$this->assertSelectorAttribute($form, 'form', 'aria-hidden', 'true');
		
		$form = $this->renderBlade('<x-aire::form :aria-hidden="false" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-hidden', 'false');
		
		$form = $this->renderBlade('<x-aire::form :aria-hidden="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-hidden');
	}
	
	public function test_aria_invalid_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form aria-invalid="grammar" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-invalid', 'grammar');
		
		$form = $this->renderBlade('<x-aire::form aria-invalid="false" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-invalid', 'false');
		
		$form = $this->renderBlade('<x-aire::form aria-invalid="spelling" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-invalid', 'spelling');
		
		$form = $this->renderBlade('<x-aire::form aria-invalid="true" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-invalid', 'true');
		
		$form = $this->renderBlade('<x-aire::form :aria-invalid="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-invalid');
	}
	
	public function test_aria_label_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :aria-label="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'aria-label', $value);
		
		$form = $this->renderBlade('<x-aire::form :aria-label="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-label');
	}
	
	public function test_aria_labelled_by_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :aria-labelled-by="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'aria-labelledby', $value);
		
		$form = $this->renderBlade('<x-aire::form :aria-labelled-by="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-labelledby');
	}
	
	public function test_aria_live_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form aria-live="off" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-live', 'off');
		
		$form = $this->renderBlade('<x-aire::form aria-live="polite" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-live', 'polite');
		
		$form = $this->renderBlade('<x-aire::form aria-live="assertive" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-live', 'assertive');
		
		$form = $this->renderBlade('<x-aire::form :aria-live="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-live');
	}
	
	public function test_aria_owns_attribute_can_be_set_and_unset(): void
	{
		$value = Str::random();
		
		$form = $this->renderBlade('<x-aire::form :aria-owns="$value" />', compact('value'));
		$this->assertSelectorAttribute($form, 'form', 'aria-owns', $value);
		
		$form = $this->renderBlade('<x-aire::form :aria-owns="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-owns');
	}
	
	public function test_aria_relevant_attribute_can_be_set_and_unset(): void
	{
		$form = $this->renderBlade('<x-aire::form aria-relevant="additions" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', 'additions');
		
		$form = $this->renderBlade('<x-aire::form aria-relevant="removals" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', 'removals');
		
		$form = $this->renderBlade('<x-aire::form aria-relevant="text" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', 'text');
		
		$form = $this->renderBlade('<x-aire::form aria-relevant="all" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', 'all');
		
		$form = $this->renderBlade('<x-aire::form aria-relevant="additions text" />');
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', 'additions text');
		
		$form = $this->renderBlade('<x-aire::form :aria-relevant="null" />');
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-relevant');
	}
}
