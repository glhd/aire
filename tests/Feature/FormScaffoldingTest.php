<?php

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\ConfiguresForm;
use Galahad\Aire\Elements\Form;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class FormScaffoldingTest extends TestCase
{
	public function test_it_intelligently_scaffolds_forms_for_model_classes() : void
	{
		Route::post('/test-store-route', function() {
			return 'OK';
		})->name('scaffolding_models.store');
		
		$html = $this->aire()
			->scaffold(ScaffoldingModel::class)
			->render();
		
		dd($html);
		
		$this->assertSelectorAttribute($html, 'form', 'action', url('/test-store-route'));
		$this->assertSelectorAttribute($html, 'form', 'method', 'POST');
		
		$this->assertSelectorAttribute($html, '[name=annotated_string]', 'type', 'text');
		$this->assertSelectorAttribute($html, '[name=annotated_int]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=annotated_float]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=annotated_bool]', 'type', 'checkbox');
		$this->assertSelectorAttribute($html, '[name=annotated_boolean]', 'type', 'checkbox');
		$this->assertSelectorAttribute($html, '[name=annotated_array]', 'type', 'select');
		$this->assertSelectorAttribute($html, '[name=annotated_collection]', 'type', 'select');
		
		$this->assertSelectorAttribute($html, '[name=annotated_read_only_string]', 'type', 'text');
		$this->assertSelectorAttribute($html, '[name=annotated_read_only_int]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=annotated_read_only_float]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=annotated_read_only_bool]', 'type', 'checkbox');
		$this->assertSelectorAttribute($html, '[name=annotated_read_only_boolean]', 'type', 'checkbox');
		$this->assertSelectorAttribute($html, '[name=annotated_read_only_array]', 'type', 'select');
		$this->assertSelectorAttribute($html, '[name=annotated_read_only_collection]', 'type', 'select');
		
		$this->assertSelectorAttribute($html, '[name=cast_string]', 'type', 'text');
		$this->assertSelectorAttribute($html, '[name=cast_int]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=cast_float]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=cast_bool]', 'type', 'checkbox');
		$this->assertSelectorAttribute($html, '[name=cast_boolean]', 'type', 'checkbox');
		$this->assertSelectorAttribute($html, '[name=cast_array]', 'type', 'select');
		$this->assertSelectorAttribute($html, '[name=cast_collection]', 'type', 'select');
		
		// input
		// select
		// text area
		// checkbox
		// checkbox group
		// color
		// date
		// dateTimeLocal
		// email
		// file
		// image
		// number
		// password
		// tel
		// url
		
		// integer, real, float, double, decimal:<digits>, string, boolean, object, array, collection, date, datetime, and timestamp.
		// When casting to decimal, you must define the number of digits (decimal:2).
		
		// Should use @property annotations
		// Should use @property-read annotations
		// Should use $casts
		// Should honor $hidden
		
		$this->markTestIncomplete();
	}
	
	public function test_it_intelligently_scaffolds_forms_for_model_instances() : void
	{
		Route::put('/test-update-route/{scaffolding_model}', function() {
			return 'OK';
		})->name('scaffolding_models.update');
		
		$model = new ScaffoldingModel([
			'id' => 99,
		]);
		
		$model->exists = true;
		
		$html = $this->aire()
			->scaffold($model)
			->render();
		
		$this->assertSelectorAttribute($html, 'form', 'action', url('/test-update-route/99'));
		$this->assertSelectorAttribute($html, 'form', 'method', 'POST');
		$this->assertSelectorAttribute($html, 'input[name=_method]', 'value', 'PUT');
		
		$this->markTestIncomplete();
	}
	
	public function test_it_scaffolds_a_configured_form() : void
	{
		$html = $this->aire()
			->scaffold(new TestConfiguredForm())
			->render();
		
		$this->markTestIncomplete();
	}
	
	public function test_chained_methods_override_configured_defaults() : void
	{
		$html = $this->aire()
			->scaffold(new TestConfiguredForm())
			->route() // TODO
			->method() // TODO
			->render();
		
		$this->markTestIncomplete();
	}
}

/**
 * @property string $annotated_string
 * @property int $annotated_int
 * @property float $annotated_float
 * @property bool $annotated_bool
 * @property boolean $annotated_boolean
 * @property array $annotated_array
 * @property \Illuminate\Support\Collection $annotated_collection
 *
 * @property-read string $annotated_read_only_string
 * @property-read int $annotated_read_only_int
 * @property-read float $annotated_read_only_float
 * @property-read bool $annotated_read_only_bool
 * @property-read boolean $annotated_read_only_boolean
 * @property-read array $annotated_read_only_array
 * @property-read \Illuminate\Support\Collection $annotated_read_only_collection
 */
class ScaffoldingModel extends Model
{
	protected $guarded = [];
	
	protected $casts = [
		'cast_string' => 'string',
		'cast_int' => 'int',
		'cast_float' => 'float',
		'cast_bool' => 'bool',
		'cast_boolean' => 'boolean',
		'cast_array' => 'array',
		'cast_collection' => 'collection',
	];
}

class TestConfiguredForm implements ConfiguresForm
{
	public function configureForm(Form $form, Aire $aire) : void
	{
		// TODO
	}
	
	public function formFields(Aire $aire) : array
	{
		return [
			// TODO
		];
	}
}
