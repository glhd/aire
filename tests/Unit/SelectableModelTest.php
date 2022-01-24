<?php

/** @noinspection ReturnTypeCanBeDeclaredInspection */

namespace Galahad\Aire\Tests\Unit;

use Galahad\Aire\Contracts\SelectableEntity;
use Galahad\Aire\SelectableModel;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

class SelectableModelTest extends TestCase
{
	public function test_a_selectable_model_can_be_used_as_a_select_option(): void
	{
		$collection = collect([
			new XSelectableModelStub(['id' => 1, 'name' => 'Model One']),
			new XSelectableModelStub(['id' => 2, 'name' => 'Model Two']),
		]);
		
		$html = $this->aire()->select($collection)->render();
		
		$this->assertSelectorTextEquals($html, 'option[value="1"]', 'Model One');
		$this->assertSelectorTextEquals($html, 'option[value="2"]', 'Model Two');
	}
	
	public function test_a_selectable_model_can_be_used_as_a_radio_group_option(): void
	{
		$collection = collect([
			new XSelectableModelStub(['id' => 1, 'name' => 'Model One']),
			new XSelectableModelStub(['id' => 2, 'name' => 'Model Two']),
		]);
		
		$html = $this->aire()->radioGroup($collection, 'models');
		
		$this->assertSelectorTextEquals($html, 'input[value="1"] + span', 'Model One');
		$this->assertSelectorTextEquals($html, 'input[value="2"] + span', 'Model Two');
	}
	
	public function test_a_selectable_model_can_be_used_as_a_checkbox_group_option(): void
	{
		$collection = collect([
			new XSelectableModelStub(['id' => 1, 'name' => 'Model One']),
			new XSelectableModelStub(['id' => 2, 'name' => 'Model Two']),
		]);
		
		$html = $this->aire()->checkboxGroup($collection, 'models');
		
		$this->assertSelectorTextEquals($html, 'input[value="1"] + span', 'Model One');
		$this->assertSelectorTextEquals($html, 'input[value="2"] + span', 'Model Two');
	}
}

class XSelectableModelStub extends Model implements SelectableEntity
{
	use SelectableModel;
	
	protected $guarded = [];
	
	public function getSelectableLabel()
	{
		return $this->getAttribute('name');
	}
}
