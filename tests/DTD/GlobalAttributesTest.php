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

namespace Galahad\Aire\Tests\DTD;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Str;

class GlobalAttributesTest extends TestCase
{
	public function test_access_key_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->accessKey($value);
		$this->assertSelectorAttribute($form, 'form', 'accesskey', $value);
		
		$form->accessKey(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'accesskey');
	}
	
	public function test_class_attribute_can_be_set(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->class($value);
		$this->assertSelectorAttribute($form, 'form', 'class', $value);
	}
	
	public function test_content_editable_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->contentEditable();
		$this->assertSelectorAttribute($form, 'form', 'contenteditable', 'true');
		
		$form->contentEditable(false);
		$this->assertSelectorAttribute($form, 'form', 'contenteditable', 'false');
		
		$form->contentEditable(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'contenteditable');
	}
	
	public function test_context_menu_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->contextMenu($value);
		$this->assertSelectorAttribute($form, 'form', 'contextmenu', $value);
		
		$form->contextMenu(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'contextmenu');
	}
	
	public function test_dir_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->dir('ltr');
		$this->assertSelectorAttribute($form, 'form', 'dir', 'ltr');
		
		$form->dir('rtl');
		$this->assertSelectorAttribute($form, 'form', 'dir', 'rtl');
		
		$form->dir(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'dir');
	}
	
	public function test_draggable_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->draggable('auto');
		$this->assertSelectorAttribute($form, 'form', 'draggable', 'auto');
		
		$form->draggable('false');
		$this->assertSelectorAttribute($form, 'form', 'draggable', 'false');
		
		$form->draggable('true');
		$this->assertSelectorAttribute($form, 'form', 'draggable', 'true');
		
		$form->draggable(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'draggable');
	}
	
	public function test_drop_zone_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->dropZone('copy');
		$this->assertSelectorAttribute($form, 'form', 'dropzone', 'copy');
		
		$form->dropZone('move');
		$this->assertSelectorAttribute($form, 'form', 'dropzone', 'move');
		
		$form->dropZone('link');
		$this->assertSelectorAttribute($form, 'form', 'dropzone', 'link');
		
		$form->dropZone(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'dropzone');
	}
	
	public function test_hidden_flag_can_be_set_on_and_off(): void
	{
		$form = $this->aire()->form();
		
		$form->hide();
		$this->assertSelectorAttribute($form, 'form', 'hidden');
		
		$form->hide(false);
		$this->assertSelectorAttributeMissing($form, 'form', 'hidden');
	}
	
	public function test_id_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->id($value);
		$this->assertSelectorAttribute($form, 'form', 'id', $value);
		
		$form->id(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'id');
	}
	
	public function test_lang_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->lang('ab');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ab');
		
		$form->lang('aa');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'aa');
		
		$form->lang('af');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'af');
		
		$form->lang('sq');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sq');
		
		$form->lang('am');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'am');
		
		$form->lang('ar');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ar');
		
		$form->lang('an');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'an');
		
		$form->lang('hy');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'hy');
		
		$form->lang('as');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'as');
		
		$form->lang('ay');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ay');
		
		$form->lang('az');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'az');
		
		$form->lang('ba');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ba');
		
		$form->lang('eu');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'eu');
		
		$form->lang('bn');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'bn');
		
		$form->lang('dz');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'dz');
		
		$form->lang('bh');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'bh');
		
		$form->lang('bi');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'bi');
		
		$form->lang('br');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'br');
		
		$form->lang('bg');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'bg');
		
		$form->lang('my');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'my');
		
		$form->lang('be');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'be');
		
		$form->lang('km');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'km');
		
		$form->lang('ca');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ca');
		
		$form->lang('zh');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'zh');
		
		$form->lang('co');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'co');
		
		$form->lang('hr');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'hr');
		
		$form->lang('cs');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'cs');
		
		$form->lang('da');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'da');
		
		$form->lang('nl');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'nl');
		
		$form->lang('en');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'en');
		
		$form->lang('eo');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'eo');
		
		$form->lang('et');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'et');
		
		$form->lang('fo');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'fo');
		
		$form->lang('fa');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'fa');
		
		$form->lang('fi');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'fi');
		
		$form->lang('fr');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'fr');
		
		$form->lang('fy');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'fy');
		
		$form->lang('gl');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'gl');
		
		$form->lang('gd');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'gd');
		
		$form->lang('gv');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'gv');
		
		$form->lang('ka');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ka');
		
		$form->lang('de');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'de');
		
		$form->lang('el');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'el');
		
		$form->lang('kl');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'kl');
		
		$form->lang('gn');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'gn');
		
		$form->lang('gu');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'gu');
		
		$form->lang('ht');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ht');
		
		$form->lang('ha');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ha');
		
		$form->lang('he');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'he');
		
		$form->lang('hi');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'hi');
		
		$form->lang('hu');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'hu');
		
		$form->lang('is');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'is');
		
		$form->lang('io');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'io');
		
		$form->lang('id');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'id');
		
		$form->lang('ia');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ia');
		
		$form->lang('ie');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ie');
		
		$form->lang('iu');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'iu');
		
		$form->lang('ik');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ik');
		
		$form->lang('ga');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ga');
		
		$form->lang('it');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'it');
		
		$form->lang('ja');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ja');
		
		$form->lang('jv');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'jv');
		
		$form->lang('kn');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'kn');
		
		$form->lang('ks');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ks');
		
		$form->lang('kk');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'kk');
		
		$form->lang('rw');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'rw');
		
		$form->lang('ky');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ky');
		
		$form->lang('rn');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'rn');
		
		$form->lang('ko');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ko');
		
		$form->lang('ku');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ku');
		
		$form->lang('lo');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'lo');
		
		$form->lang('la');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'la');
		
		$form->lang('lv');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'lv');
		
		$form->lang('li');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'li');
		
		$form->lang('ln');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ln');
		
		$form->lang('lt');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'lt');
		
		$form->lang('mk');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mk');
		
		$form->lang('mg');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mg');
		
		$form->lang('ms');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ms');
		
		$form->lang('ml');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ml');
		
		$form->lang('mt');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mt');
		
		$form->lang('mi');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mi');
		
		$form->lang('mr');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mr');
		
		$form->lang('mo');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mo');
		
		$form->lang('mn');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'mn');
		
		$form->lang('na');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'na');
		
		$form->lang('ne');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ne');
		
		$form->lang('no');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'no');
		
		$form->lang('oc');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'oc');
		
		$form->lang('or');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'or');
		
		$form->lang('om');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'om');
		
		$form->lang('ps');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ps');
		
		$form->lang('pl');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'pl');
		
		$form->lang('pt');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'pt');
		
		$form->lang('pa');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'pa');
		
		$form->lang('qu');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'qu');
		
		$form->lang('rm');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'rm');
		
		$form->lang('ro');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ro');
		
		$form->lang('ru');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ru');
		
		$form->lang('sz');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sz');
		
		$form->lang('sm');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sm');
		
		$form->lang('sg');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sg');
		
		$form->lang('sa');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sa');
		
		$form->lang('sr');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sr');
		
		$form->lang('sh');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sh');
		
		$form->lang('st');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'st');
		
		$form->lang('tn');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tn');
		
		$form->lang('sn');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sn');
		
		$form->lang('ii');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ii');
		
		$form->lang('sd');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sd');
		
		$form->lang('si');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'si');
		
		$form->lang('ss');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ss');
		
		$form->lang('sk');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sk');
		
		$form->lang('sl');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sl');
		
		$form->lang('so');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'so');
		
		$form->lang('es');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'es');
		
		$form->lang('su');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'su');
		
		$form->lang('sw');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sw');
		
		$form->lang('sv');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'sv');
		
		$form->lang('tl');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tl');
		
		$form->lang('tg');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tg');
		
		$form->lang('ta');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ta');
		
		$form->lang('tt');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tt');
		
		$form->lang('te');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'te');
		
		$form->lang('th');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'th');
		
		$form->lang('bo');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'bo');
		
		$form->lang('ti');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ti');
		
		$form->lang('to');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'to');
		
		$form->lang('ts');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ts');
		
		$form->lang('tr');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tr');
		
		$form->lang('tk');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tk');
		
		$form->lang('tw');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'tw');
		
		$form->lang('ug');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ug');
		
		$form->lang('uk');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'uk');
		
		$form->lang('ur');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'ur');
		
		$form->lang('uz');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'uz');
		
		$form->lang('vi');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'vi');
		
		$form->lang('vo');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'vo');
		
		$form->lang('wa');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'wa');
		
		$form->lang('cy');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'cy');
		
		$form->lang('wo');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'wo');
		
		$form->lang('xh');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'xh');
		
		$form->lang('yi');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'yi');
		
		$form->lang('yo');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'yo');
		
		$form->lang('zu');
		$this->assertSelectorAttribute($form, 'form', 'lang', 'zu');
		
		$form->lang(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'lang');
	}
	
	public function test_role_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->role('alert');
		$this->assertSelectorAttribute($form, 'form', 'role', 'alert');
		
		$form->role('alertdialog');
		$this->assertSelectorAttribute($form, 'form', 'role', 'alertdialog');
		
		$form->role('article');
		$this->assertSelectorAttribute($form, 'form', 'role', 'article');
		
		$form->role('application');
		$this->assertSelectorAttribute($form, 'form', 'role', 'application');
		
		$form->role('banner');
		$this->assertSelectorAttribute($form, 'form', 'role', 'banner');
		
		$form->role('button');
		$this->assertSelectorAttribute($form, 'form', 'role', 'button');
		
		$form->role('checkbox');
		$this->assertSelectorAttribute($form, 'form', 'role', 'checkbox');
		
		$form->role('columnheader');
		$this->assertSelectorAttribute($form, 'form', 'role', 'columnheader');
		
		$form->role('combobox');
		$this->assertSelectorAttribute($form, 'form', 'role', 'combobox');
		
		$form->role('complementary');
		$this->assertSelectorAttribute($form, 'form', 'role', 'complementary');
		
		$form->role('contentinfo');
		$this->assertSelectorAttribute($form, 'form', 'role', 'contentinfo');
		
		$form->role('definition');
		$this->assertSelectorAttribute($form, 'form', 'role', 'definition');
		
		$form->role('directory');
		$this->assertSelectorAttribute($form, 'form', 'role', 'directory');
		
		$form->role('dialog');
		$this->assertSelectorAttribute($form, 'form', 'role', 'dialog');
		
		$form->role('document');
		$this->assertSelectorAttribute($form, 'form', 'role', 'document');
		
		$form->role('form');
		$this->assertSelectorAttribute($form, 'form', 'role', 'form');
		
		$form->role('grid');
		$this->assertSelectorAttribute($form, 'form', 'role', 'grid');
		
		$form->role('gridcell');
		$this->assertSelectorAttribute($form, 'form', 'role', 'gridcell');
		
		$form->role('group');
		$this->assertSelectorAttribute($form, 'form', 'role', 'group');
		
		$form->role('heading');
		$this->assertSelectorAttribute($form, 'form', 'role', 'heading');
		
		$form->role('img');
		$this->assertSelectorAttribute($form, 'form', 'role', 'img');
		
		$form->role('link');
		$this->assertSelectorAttribute($form, 'form', 'role', 'link');
		
		$form->role('list');
		$this->assertSelectorAttribute($form, 'form', 'role', 'list');
		
		$form->role('listbox');
		$this->assertSelectorAttribute($form, 'form', 'role', 'listbox');
		
		$form->role('listitem');
		$this->assertSelectorAttribute($form, 'form', 'role', 'listitem');
		
		$form->role('log');
		$this->assertSelectorAttribute($form, 'form', 'role', 'log');
		
		$form->role('main');
		$this->assertSelectorAttribute($form, 'form', 'role', 'main');
		
		$form->role('marquee');
		$this->assertSelectorAttribute($form, 'form', 'role', 'marquee');
		
		$form->role('math');
		$this->assertSelectorAttribute($form, 'form', 'role', 'math');
		
		$form->role('menu');
		$this->assertSelectorAttribute($form, 'form', 'role', 'menu');
		
		$form->role('menubar');
		$this->assertSelectorAttribute($form, 'form', 'role', 'menubar');
		
		$form->role('menuitem');
		$this->assertSelectorAttribute($form, 'form', 'role', 'menuitem');
		
		$form->role('menuitemcheckbox');
		$this->assertSelectorAttribute($form, 'form', 'role', 'menuitemcheckbox');
		
		$form->role('menuitemradio');
		$this->assertSelectorAttribute($form, 'form', 'role', 'menuitemradio');
		
		$form->role('navigation');
		$this->assertSelectorAttribute($form, 'form', 'role', 'navigation');
		
		$form->role('note');
		$this->assertSelectorAttribute($form, 'form', 'role', 'note');
		
		$form->role('option');
		$this->assertSelectorAttribute($form, 'form', 'role', 'option');
		
		$form->role('presentation');
		$this->assertSelectorAttribute($form, 'form', 'role', 'presentation');
		
		$form->role('progressbar');
		$this->assertSelectorAttribute($form, 'form', 'role', 'progressbar');
		
		$form->role('radio');
		$this->assertSelectorAttribute($form, 'form', 'role', 'radio');
		
		$form->role('radiogroup');
		$this->assertSelectorAttribute($form, 'form', 'role', 'radiogroup');
		
		$form->role('region');
		$this->assertSelectorAttribute($form, 'form', 'role', 'region');
		
		$form->role('row');
		$this->assertSelectorAttribute($form, 'form', 'role', 'row');
		
		$form->role('rowgroup');
		$this->assertSelectorAttribute($form, 'form', 'role', 'rowgroup');
		
		$form->role('rowheader');
		$this->assertSelectorAttribute($form, 'form', 'role', 'rowheader');
		
		$form->role('scrollbar');
		$this->assertSelectorAttribute($form, 'form', 'role', 'scrollbar');
		
		$form->role('search');
		$this->assertSelectorAttribute($form, 'form', 'role', 'search');
		
		$form->role('separator');
		$this->assertSelectorAttribute($form, 'form', 'role', 'separator');
		
		$form->role('slider');
		$this->assertSelectorAttribute($form, 'form', 'role', 'slider');
		
		$form->role('spinbutton');
		$this->assertSelectorAttribute($form, 'form', 'role', 'spinbutton');
		
		$form->role('status');
		$this->assertSelectorAttribute($form, 'form', 'role', 'status');
		
		$form->role('tab');
		$this->assertSelectorAttribute($form, 'form', 'role', 'tab');
		
		$form->role('tablist');
		$this->assertSelectorAttribute($form, 'form', 'role', 'tablist');
		
		$form->role('tabpanel');
		$this->assertSelectorAttribute($form, 'form', 'role', 'tabpanel');
		
		$form->role('textbox');
		$this->assertSelectorAttribute($form, 'form', 'role', 'textbox');
		
		$form->role('timer');
		$this->assertSelectorAttribute($form, 'form', 'role', 'timer');
		
		$form->role('toolbar');
		$this->assertSelectorAttribute($form, 'form', 'role', 'toolbar');
		
		$form->role('tooltip');
		$this->assertSelectorAttribute($form, 'form', 'role', 'tooltip');
		
		$form->role('tree');
		$this->assertSelectorAttribute($form, 'form', 'role', 'tree');
		
		$form->role('treegrid');
		$this->assertSelectorAttribute($form, 'form', 'role', 'treegrid');
		
		$form->role('treeitem');
		$this->assertSelectorAttribute($form, 'form', 'role', 'treeitem');
		
		$form->role(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'role');
	}
	
	public function test_spell_check_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->spellCheck();
		$this->assertSelectorAttribute($form, 'form', 'spellcheck', 'true');
		
		$form->spellCheck(false);
		$this->assertSelectorAttribute($form, 'form', 'spellcheck', 'false');
		
		$form->spellCheck(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'spellcheck');
	}
	
	public function test_style_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->style($value);
		$this->assertSelectorAttribute($form, 'form', 'style', $value);
		
		$form->style(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'style');
	}
	
	public function test_tab_index_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->tabIndex($value);
		$this->assertSelectorAttribute($form, 'form', 'tabindex', $value);
		
		$form->tabIndex(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'tabindex');
	}
	
	public function test_title_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->title($value);
		$this->assertSelectorAttribute($form, 'form', 'title', $value);
		
		$form->title(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'title');
	}
	
	public function test_aria_active_descendant_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->ariaActiveDescendant($value);
		$this->assertSelectorAttribute($form, 'form', 'aria-activedescendant', $value);
		
		$form->ariaActiveDescendant(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-activedescendant');
	}
	
	public function test_aria_atomic_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->ariaAtomic();
		$this->assertSelectorAttribute($form, 'form', 'aria-atomic', 'true');
		
		$form->ariaAtomic(false);
		$this->assertSelectorAttribute($form, 'form', 'aria-atomic', 'false');
		
		$form->ariaAtomic(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-atomic');
	}
	
	public function test_aria_busy_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->ariaBusy();
		$this->assertSelectorAttribute($form, 'form', 'aria-busy', 'true');
		
		$form->ariaBusy(false);
		$this->assertSelectorAttribute($form, 'form', 'aria-busy', 'false');
		
		$form->ariaBusy(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-busy');
	}
	
	public function test_aria_controls_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->ariaControls($value);
		$this->assertSelectorAttribute($form, 'form', 'aria-controls', $value);
		
		$form->ariaControls(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-controls');
	}
	
	public function test_aria_described_by_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->ariaDescribedBy($value);
		$this->assertSelectorAttribute($form, 'form', 'aria-describedby', $value);
		
		$form->ariaDescribedBy(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-describedby');
	}
	
	public function test_aria_disabled_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->ariaDisabled('true');
		$this->assertSelectorAttribute($form, 'form', 'aria-disabled', 'true');
		
		$form->ariaDisabled('false');
		$this->assertSelectorAttribute($form, 'form', 'aria-disabled', 'false');
		
		$form->ariaDisabled(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-disabled');
	}
	
	public function test_aria_drop_effect_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->ariaDropEffect('copy');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'copy');
		
		$form->ariaDropEffect('move');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'move');
		
		$form->ariaDropEffect('link');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'link');
		
		$form->ariaDropEffect('execute');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'execute');
		
		$form->ariaDropEffect('popup');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'popup');
		
		$form->ariaDropEffect('none');
		$this->assertSelectorAttribute($form, 'form', 'aria-dropeffect', 'none');
		
		$form->ariaDropEffect(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-dropeffect');
	}
	
	public function test_aria_flow_to_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->ariaFlowTo($value);
		$this->assertSelectorAttribute($form, 'form', 'aria-flowto', $value);
		
		$form->ariaFlowTo(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-flowto');
	}
	
	public function test_aria_grabbed_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->ariaGrabbed('true');
		$this->assertSelectorAttribute($form, 'form', 'aria-grabbed', 'true');
		
		$form->ariaGrabbed('false');
		$this->assertSelectorAttribute($form, 'form', 'aria-grabbed', 'false');
		
		$form->ariaGrabbed('undefined');
		$this->assertSelectorAttribute($form, 'form', 'aria-grabbed', 'undefined');
		
		$form->ariaGrabbed(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-grabbed');
	}
	
	public function test_aria_has_popup_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->ariaHasPopup();
		$this->assertSelectorAttribute($form, 'form', 'aria-haspopup', 'true');
		
		$form->ariaHasPopup(false);
		$this->assertSelectorAttribute($form, 'form', 'aria-haspopup', 'false');
		
		$form->ariaHasPopup(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-haspopup');
	}
	
	public function test_aria_hidden_boolean_can_be_set_to_true_and_false_and_be_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->ariaHidden();
		$this->assertSelectorAttribute($form, 'form', 'aria-hidden', 'true');
		
		$form->ariaHidden(false);
		$this->assertSelectorAttribute($form, 'form', 'aria-hidden', 'false');
		
		$form->ariaHidden(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-hidden');
	}
	
	public function test_aria_invalid_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->ariaInvalid('grammar');
		$this->assertSelectorAttribute($form, 'form', 'aria-invalid', 'grammar');
		
		$form->ariaInvalid('false');
		$this->assertSelectorAttribute($form, 'form', 'aria-invalid', 'false');
		
		$form->ariaInvalid('spelling');
		$this->assertSelectorAttribute($form, 'form', 'aria-invalid', 'spelling');
		
		$form->ariaInvalid('true');
		$this->assertSelectorAttribute($form, 'form', 'aria-invalid', 'true');
		
		$form->ariaInvalid(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-invalid');
	}
	
	public function test_aria_label_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->ariaLabel($value);
		$this->assertSelectorAttribute($form, 'form', 'aria-label', $value);
		
		$form->ariaLabel(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-label');
	}
	
	public function test_aria_labelled_by_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->ariaLabelledBy($value);
		$this->assertSelectorAttribute($form, 'form', 'aria-labelledby', $value);
		
		$form->ariaLabelledBy(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-labelledby');
	}
	
	public function test_aria_live_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->ariaLive('off');
		$this->assertSelectorAttribute($form, 'form', 'aria-live', 'off');
		
		$form->ariaLive('polite');
		$this->assertSelectorAttribute($form, 'form', 'aria-live', 'polite');
		
		$form->ariaLive('assertive');
		$this->assertSelectorAttribute($form, 'form', 'aria-live', 'assertive');
		
		$form->ariaLive(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-live');
	}
	
	public function test_aria_owns_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$value = Str::random();
		
		$form->ariaOwns($value);
		$this->assertSelectorAttribute($form, 'form', 'aria-owns', $value);
		
		$form->ariaOwns(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-owns');
	}
	
	public function test_aria_relevant_attribute_can_be_set_and_unset(): void
	{
		$form = $this->aire()->form();
		
		$form->ariaRelevant('additions');
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', 'additions');
		
		$form->ariaRelevant('removals');
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', 'removals');
		
		$form->ariaRelevant('text');
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', 'text');
		
		$form->ariaRelevant('all');
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', 'all');
		
		$form->ariaRelevant('additions text');
		$this->assertSelectorAttribute($form, 'form', 'aria-relevant', 'additions text');
		
		$form->ariaRelevant(null);
		$this->assertSelectorAttributeMissing($form, 'form', 'aria-relevant');
	}
}
