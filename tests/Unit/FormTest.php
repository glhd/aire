<?php

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Support\Facades\Aire;
use Galahad\Aire\Tests\TestCase;

class FormTest extends TestCase
{
	public function test_forms_are_post_by_default()
	{
		$form = Aire::open();
		
		$expected = '<form method="POST">
			</form>';
		
		$this->assertHTML($expected, $form);
	}
	
	public function test_csrf_token_is_included_if_session_is_set_and_method_is_not_get()
	{
		$token = str_random();
		
		$this->withSession(['_token' => $token]);
		
		$form = Aire::open();
		
		$expected = '<form method="POST">
				<input type="hidden" name="_token" value="'.$token.'" />
			</form>';
		
		$this->assertHTML($expected, $form);
	}
	
	public function test_csrf_token_is_not_included_if_session_is_set_but_method_is_get()
	{
		$token = str_random();
		
		$this->withSession(['_token' => $token]);
		
		$form = Aire::open()->get();
		
		$expected = '<form method="GET">
			</form>';
		
		$this->assertHTML($expected, $form);
	}
	
	public function test_hidden_method_field_is_added_for_put_forms()
	{
		$form = Aire::open()->put();
		
		$expected = '<form method="POST">
				<input type="hidden" name="_method" value="PUT" />
			</form>';
		
		$this->assertHTML($expected, $form);
	}
	
	public function test_hidden_method_field_is_added_for_patch_forms()
	{
		$form = Aire::open()->patch();
		
		$expected = '<form method="POST">
				<input type="hidden" name="_method" value="PATCH" />
			</form>';
		
		$this->assertHTML($expected, $form);
	}
	
	public function test_hidden_method_field_is_added_for_delete_forms()
	{
		$form = Aire::open()->delete();
		
		$expected = '<form method="POST">
				<input type="hidden" name="_method" value="DELETE" />
			</form>';
		
		$this->assertHTML($expected, $form);
	}
}
