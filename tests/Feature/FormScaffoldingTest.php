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
		
		$this->assertSelectorAttribute($html, 'form', 'action', url('/test-store-route'));
		$this->assertSelectorAttribute($html, 'form', 'method', 'POST');
		
		$this->assertSelectorAttribute($html, '[name=config_text]', 'type', 'text');
		
		$this->assertSelectorExists($html, 'select[name=author]');
		$this->assertSelectorContainsText($html, '[data-aire-for=author] label', 'Pick an Author');
		
		$this->assertSelectorAttribute($html, '[name=annotated_string]', 'type', 'text');
		$this->assertSelectorAttribute($html, '[name=annotated_int]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=annotated_float]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=annotated_bool]', 'type', 'checkbox');
		$this->assertSelectorAttribute($html, '[name=annotated_boolean]', 'type', 'checkbox');
		
		$this->assertSelectorAttribute($html, '[name=cast_string]', 'type', 'text');
		$this->assertSelectorAttribute($html, '[name=cast_int]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=cast_float]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=cast_bool]', 'type', 'checkbox');
		$this->assertSelectorAttribute($html, '[name=cast_boolean]', 'type', 'checkbox');
		
		$this->assertSelectorContainsText($html, '[data-aire-for=cast_string] label', 'Custom Label');
		
		// TODO: Not sure how to handle array attributes. I guess we could use a multi-select.
		// TODO: There needs to be an easy way to set the order of fields
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
 */
class ScaffoldingModel extends Model
{
	public $form_config = [
		'config_text' => 'text',
	];
	
	protected $guarded = [];
	
	protected $casts = [
		'cast_string' => 'string',
		'cast_int' => 'int',
		'cast_float' => 'float',
		'cast_bool' => 'bool',
		'cast_boolean' => 'boolean',
	];
	
	public function getCastStringFormLabel() : string
	{
		return 'Custom Label';
	}
	
	public function configureAuthorFormField(Aire $aire)
	{
		$authors = ['nkj' => 'N.K. Jemisin', 'esjm' => 'Emily St. John Mandel'];
		
		return $aire->select($authors, 'author', 'Pick an Author');
	}
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
