<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Support\Facades\Aire;
use Galahad\Aire\Tests\TestCase;

class GlobalAttributesTest extends TestCase
{
	public function test_the_accesskey_can_be_set()
	{
		$form = Aire::open();
		
		$form->accessKey('foo');
		
		$this->assertContains('accesskey="foo"', (string) $form);
	}
	
	public function test_the_class_can_be_set()
	{
		$form = Aire::open();
		
		$form->class('foo');
		
		$this->assertContains('class="foo"', (string) $form);
	}
	
	public function test_the_contenteditable_can_be_set_and_unset()
	{
		$form = Aire::open();
		
		$form->contentEditable();
		
		$this->assertContains('contenteditable', (string) $form);
		
		$form->contentEditable(false);
		
		$this->assertNotContains('contenteditable', (string) $form);
	}
	
	public function test_the_contextmenu_can_be_set()
	{
		$form = Aire::open();
		
		$form->contextMenu('foo');
		
		$this->assertContains('contextmenu="foo"', (string) $form);
	}
	
	public function test_the_dir_can_be_set()
	{
		$form = Aire::open();
		
		$form->dir('foo');
		
		$this->assertContains('dir="foo"', (string) $form);
	}
	
	public function test_the_draggable_can_be_set()
	{
		$form = Aire::open();
		
		$form->draggable('foo');
		
		$this->assertContains('draggable="foo"', (string) $form);
	}
	
	public function test_the_dropzone_can_be_set()
	{
		$form = Aire::open();
		
		$form->dropZone('foo');
		
		$this->assertContains('dropzone="foo"', (string) $form);
	}
	
	public function test_the_hidden_can_be_set()
	{
		$form = Aire::open();
		
		$form->hidden('foo');
		
		$this->assertContains('hidden="foo"', (string) $form);
	}
	
	public function test_the_id_can_be_set()
	{
		$form = Aire::open();
		
		$form->id('foo');
		
		$this->assertContains('id="foo"', (string) $form);
	}
	
	public function test_the_lang_can_be_set()
	{
		$form = Aire::open();
		
		$form->lang('foo');
		
		$this->assertContains('lang="foo"', (string) $form);
	}
	
	public function test_the_role_can_be_set()
	{
		$form = Aire::open();
		
		$form->role('foo');
		
		$this->assertContains('role="foo"', (string) $form);
	}
	
	public function test_the_spellcheck_can_be_set_and_unset()
	{
		$form = Aire::open();
		
		$form->spellCheck();
		
		$this->assertContains('spellcheck', (string) $form);
		
		$form->spellCheck(false);
		
		$this->assertNotContains('spellcheck', (string) $form);
	}
	
	public function test_the_style_can_be_set()
	{
		$form = Aire::open();
		
		$form->style('foo');
		
		$this->assertContains('style="foo"', (string) $form);
	}
	
	public function test_the_tabindex_can_be_set()
	{
		$form = Aire::open();
		
		$form->tabIndex('foo');
		
		$this->assertContains('tabindex="foo"', (string) $form);
	}
	
	public function test_the_title_can_be_set()
	{
		$form = Aire::open();
		
		$form->title('foo');
		
		$this->assertContains('title="foo"', (string) $form);
	}
}
