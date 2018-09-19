<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Tests\TestCase;

class GlobalAttributesTest extends TestCase
{
	public function test_the_accesskey_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->accessKey($value);
		
		$this->assertSelectorAttribute($form, 'form', 'accesskey', $value);
	}
	
	public function test_the_class_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->class($value);
		
		$this->assertSelectorAttribute($form, 'form', 'class', $value);
	}
	
	public function test_the_contenteditable_can_be_set_and_unset()
	{
		$form = $this->aire()->form();
		
		$form->contentEditable();
		
		$this->assertSelectorAttribute($form, 'form', 'contenteditable', 'true');
		
		$form->contentEditable(false);
		
		$this->assertSelectorAttribute($form, 'form', 'contenteditable', 'false');
	}
	
	public function test_the_contextmenu_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->contextMenu($value);
		
		$this->assertSelectorAttribute($form, 'form', 'contextmenu', $value);
	}
	
	public function test_the_dir_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->dir($value);
		
		$this->assertSelectorAttribute($form, 'form', 'dir', $value);
	}
	
	public function test_the_draggable_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->draggable($value);
		
		$this->assertSelectorAttribute($form, 'form', 'draggable', $value);
	}
	
	public function test_the_dropzone_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->dropZone($value);
		
		$this->assertSelectorAttribute($form, 'form', 'dropzone', $value);
	}
	
	public function test_the_hidden_can_be_set()
	{
		$form = $this->aire()->form();
		
		$form->hidden();
		
		$this->assertSelectorAttribute($form, 'form', 'hidden');
	}
	
	public function test_the_id_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->id($value);
		
		$this->assertSelectorAttribute($form, 'form', 'id', $value);
	}
	
	public function test_the_lang_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->lang($value);
		
		$this->assertSelectorAttribute($form, 'form', 'lang', $value);
	}
	
	public function test_the_role_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->role($value);
		
		$this->assertSelectorAttribute($form, 'form', 'role', $value);
	}
	
	public function test_the_spellcheck_can_be_set_and_unset()
	{
		$form = $this->aire()->form();
		
		$form->spellCheck();
		
		$this->assertSelectorAttribute($form, 'form', 'spellcheck', 'true');
		
		$form->spellCheck(false);
		
		$this->assertSelectorAttribute($form, 'form', 'spellcheck', 'false');
	}
	
	public function test_the_style_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->style($value);
		
		$this->assertSelectorAttribute($form, 'form', 'style', $value);
	}
	
	public function test_the_tabindex_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->tabIndex($value);
		
		$this->assertSelectorAttribute($form, 'form', 'tabindex', $value);
	}
	
	public function test_the_title_can_be_set()
	{
		$form = $this->aire()->form();
		
		$value = str_random();
		$form->title($value);
		
		$this->assertSelectorAttribute($form, 'form', 'title', $value);
	}
}
