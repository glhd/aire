<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Tests\TestCase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class AlpineJsTest extends TestCase
{
	public function test_prior_input_is_preserved()
	{
		Session::flashInput([
			'generic_input' => 'foo',
			'basic_select' => 'a',
		]);
		
		$bound_data = [
			'check_box' => false,
		];
		
		ob_start();
		
		// This is going to be a bit of work, because the concept of "value" is really
		// bound to the element instead of the form. We need to centralize value at the
		// form level or find a way to register each element's value with the form on
		// instantiation.
		
		$form = $this->aire()->form()->bind($bound_data)->alpine()->open();
		
		echo $form->input('generic_input');
		echo $form->select(['a' => 'a', 'b' => 'b'], 'basic_select');
		echo $form->textArea('text_area')->defaultValue('text');
		echo $form->checkbox('check_box');
		
		dd(json_decode($form->attributes->get('x-data')));
			
		echo $form->close();
		
		$html = ob_get_clean();
		
		dd($html);
		
		// $this->assertSelectorAttribute($html, '#generic_input', 'value', 'foo');
		// $this->assertSelectorAttribute($html, '#basic_select > option[value="a"]', 'selected');
		// $this->assertSelectorAttributeMissing($html, '#basic_select > option[value="b"]', 'selected');
		// $this->assertSelectorAttribute($html, '#multi_select > option[value="a"]', 'selected');
		// $this->assertSelectorAttribute($html, '#multi_select > option[value="b"]', 'selected');
	}
}
