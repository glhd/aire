<?php

namespace Galahad\Aire\Tests\Feature;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\ConfiguresForm;
use Galahad\Aire\Elements\Form;
use Galahad\Aire\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// TODO: Not sure how to handle array attributes. I guess we could use a multi-select.
// TODO: There needs to be an easy way to set the order of fields

class FormScaffoldingTest extends TestCase
{
	protected function setUp() : void
	{
		parent::setUp();
		
		$ok = function() {
			return 'OK';
		};
		
		Route::post('/test/scaffolding-models', $ok)->name('scaffolding_models.store');
		Route::post('/test/camel-syntax-models', $ok)->name('camel_syntax_models.store');
		Route::post('/test/config-order-models', $ok)->name('config_order_models.store');
		Route::put('/test/scaffolding-models/{scaffolding_model}', $ok)->name('scaffolding_models.update');
	}
	
	public function test_it_intelligently_scaffolds_forms_for_model_classes() : void
	{
		$html = $this->aire()
			->scaffold(ScaffoldingModel::class)
			->render();
		
		$this->assertSelectorAttribute($html, 'form', 'action', url('/test/scaffolding-models'));
		$this->assertSelectorAttribute($html, 'form', 'method', 'POST');
		
		$this->assertSelectorContainsText($html, '[data-aire-for=config_int] label', 'Custom label');
		$this->assertSelectorAttribute($html, '[name=config_int]', 'type', 'number');
		
		$this->assertSelectorExists($html, 'textarea[name=config_textarea]');
		
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
		
		$this->assertSelectorContainsText($html, 'button[type=submit]', 'Create New Scaffolding Model');
	}
	
	public function test_it_intelligently_scaffolds_forms_for_model_instances() : void
	{
		$config_int = 37;
		$config_textarea = Str::random();
		
		$cast_string = Str::random();
		$cast_int = 77;
		$cast_float = 84.25;
		$cast_bool = true;
		$cast_boolean = false;
		
		$annotated_string = Str::random();;
		$annotated_int = 45;
		$annotated_float = 93.6;
		$annotated_bool = false;
		$annotated_boolean = true;
		
		$model = new ScaffoldingModel([
			'id' => 99,
			'config_int' => $config_int,
			'config_textarea' => $config_textarea,
			'cast_string' => $cast_string,
			'cast_int' => $cast_int,
			'cast_float' => $cast_float,
			'cast_bool' => $cast_bool,
			'cast_boolean' => $cast_boolean,
			'annotated_string' => $annotated_string,
			'annotated_int' => $annotated_int,
			'annotated_float' => $annotated_float,
			'annotated_bool' => $annotated_bool,
			'annotated_boolean' => $annotated_boolean,
		]);
		
		$model->exists = true;
		
		$html = $this->aire()
			->scaffold($model)
			->render();
		
		$this->assertSelectorAttribute($html, 'form', 'action', url('/test/scaffolding-models/99'));
		$this->assertSelectorAttribute($html, 'form', 'method', 'POST');
		$this->assertSelectorAttribute($html, 'input[name=_method]', 'value', 'PUT');
		
		// config_int
		$this->assertSelectorAttribute($html, '[name=config_int]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=config_int]', 'value', $config_int);
		
		// config_textarea
		$this->assertSelectorExists($html, 'textarea[name=config_textarea]');
		$this->assertSelectorContainsText($html, 'textarea[name=config_textarea]', $config_textarea);
		
		// cast_string
		$this->assertSelectorAttribute($html, '[name=cast_string]', 'type', 'text');
		$this->assertSelectorAttribute($html, '[name=cast_string]', 'value', $cast_string);
		
		// annotated_string
		$this->assertSelectorAttribute($html, '[name=annotated_string]', 'type', 'text');
		$this->assertSelectorAttribute($html, '[name=annotated_string]', 'value', $annotated_string);
		
		// cast_int
		$this->assertSelectorAttribute($html, '[name=cast_int]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=cast_int]', 'value', $cast_int);
		
		// annotated_int
		$this->assertSelectorAttribute($html, '[name=annotated_int]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=annotated_int]', 'value', $annotated_int);
		
		// cast_float
		$this->assertSelectorAttribute($html, '[name=cast_float]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=cast_float]', 'value', $cast_float);
		
		// annotated_float
		$this->assertSelectorAttribute($html, '[name=annotated_float]', 'type', 'number');
		$this->assertSelectorAttribute($html, '[name=annotated_float]', 'value', $annotated_float);
		
		// cast_bool = true
		$this->assertSelectorAttribute($html, '[name=cast_bool]', 'type', 'checkbox');
		$this->assertSelectorAttribute($html, '[name=cast_bool]', 'checked');
		
		// annotated_bool = false
		$this->assertSelectorAttribute($html, '[name=annotated_bool]', 'type', 'checkbox');
		$this->assertSelectorAttributeMissing($html, '[name=annotated_bool]', 'checked');
		
		// cast_boolean = false
		$this->assertSelectorAttribute($html, '[name=cast_boolean]', 'type', 'checkbox');
		$this->assertSelectorAttributeMissing($html, '[name=cast_boolean]', 'checked');
		
		// annotated_boolean = true
		$this->assertSelectorAttribute($html, '[name=annotated_boolean]', 'type', 'checkbox');
		$this->assertSelectorAttribute($html, '[name=annotated_boolean]', 'checked');
		
		$this->assertSelectorContainsText($html, 'button[type=submit]', 'Save Changes to Scaffolding Model');
	}
	
	public function test_it_scaffolds_a_configured_form() : void
	{
		$html = $this->aire()
			->scaffold(new TestConfiguredForm())
			->render();
		
		$this->assertSelectorAttribute($html, 'form', 'action', url('/demo'));
		$this->assertSelectorAttribute($html, 'form', 'method', 'POST');
		$this->assertSelectorAttribute($html, 'input[name=_method]', 'value', 'DELETE');
		$this->assertSelectorClassNames($html, 'form', 'test-class');
		
		$this->assertSelectorAttribute($html, '[name=date_field]', 'type', 'date');
		$this->assertSelectorAttribute($html, '[name=password_field]', 'type', 'password');
		
		$this->assertSelectorAttribute($html, 'button', 'type', 'submit');
		$this->assertSelectorContainsText($html, 'button', 'Submit Custom Form');
	}
	
	public function test_chained_methods_override_configured_defaults() : void
	{
		$html = $this->aire()
			->scaffold(new TestConfiguredForm())
			->route('scaffolding_models.update', 45)
			->delete()
			->render();
		
		$this->assertSelectorAttribute($html, 'form', 'action', url('/test/scaffolding-models/45'));
		$this->assertSelectorAttribute($html, 'form', 'method', 'POST');
		$this->assertSelectorAttribute($html, 'input[name=_method]', 'value', 'DELETE');
	}
	
	public function test_custom_model_field_ordering() : void
	{
		$html = $this->aire()
			->scaffold(ScaffoldingModel::class)
			->render();
		
		$cast_boolean_position = strpos($html, 'name="cast_boolean"');
		$cast_string_position = strpos($html, 'name="cast_string"');
		$annotated_string_position = strpos($html, 'name="annotated_string"');
		$config_int_position = strpos($html, 'name="config_int"');
		$cast_int_position = strpos($html, 'name="cast_int"');
		$cast_float_position = strpos($html, 'name="cast_float"');
		$annotated_int_position = strpos($html, 'name="annotated_int"');
		$annotated_bool_position = strpos($html, 'name="annotated_bool"');
		$cast_bool_position = strpos($html, 'name="cast_bool"');
		$annotated_float_position = strpos($html, 'name="annotated_float"');
		$annotated_boolean_position = strpos($html, 'name="annotated_boolean"');
		
		$this->assertNotEquals(0, $cast_boolean_position);
		$this->assertTrue($cast_string_position > $cast_boolean_position);
		$this->assertTrue($annotated_string_position > $cast_string_position);
		$this->assertTrue($config_int_position > $annotated_string_position);
		$this->assertTrue($cast_int_position > $config_int_position);
		$this->assertTrue($cast_float_position > $cast_int_position);
		$this->assertTrue($annotated_int_position > $cast_float_position);
		$this->assertTrue($annotated_bool_position > $annotated_int_position);
		$this->assertTrue($cast_bool_position > $annotated_bool_position);
		$this->assertTrue($annotated_float_position > $cast_bool_position);
		$this->assertTrue($annotated_boolean_position > $annotated_float_position);
	}
	
	public function test_camel_cased_properties() : void
	{
		$html = $this->aire()
			->scaffold(CamelSyntaxModel::class)
			->render();
		
		$a_position = strpos($html, 'name="a"');
		$b_position = strpos($html, 'name="b"');
		
		$this->assertSelectorAttribute($html, '[name=a]', 'type', 'text');
		$this->assertSelectorAttribute($html, '[name=b]', 'type', 'number');
		
		$this->assertTrue($b_position < $a_position);
	}
	
	public function test_it_applies_the_sorting_of_the_config() : void
	{
		$html = $this->aire()
			->scaffold(ConfigOrderModel::class)
			->render();
		
		$a_position = strpos($html, 'name="a"');
		$b_position = strpos($html, 'name="b"');
		
		$this->assertTrue($b_position < $a_position);
	}
	
	public function test_an_attribute_named_password_is_set_as_a_password_element() : void
	{
		$this->markTestIncomplete();
	}
	
	public function test_an_attribute_named_email_is_set_as_an_email_element() : void
	{
		$this->markTestIncomplete();
	}
	
	public function test_an_attribute_named_url_is_set_as_a_url_element() : void
	{
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
	public $form_order = [
		'cast_boolean',
		'cast_string',
		'annotated_string',
		'config_int',
		'cast_int',
		'cast_float',
		'annotated_int',
		'annotated_bool',
		'cast_bool',
		'annotated_float',
		'annotated_boolean',
	];
	
	public $form_config = [
		'config_int' => 'number|Custom label',
		'config_textarea' => 'textarea',
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

class CamelSyntaxModel extends Model
{
	public $formOrder = [
		'b',
		'a',
	];
	
	public $formConfig = [
		'a' => 'text',
		'b' => 'number',
	];
}

class ConfigOrderModel extends Model
{
	public $form_config = [
		'b' => 'checkbox',
		'a' => 'search',
	];
}

class TestConfiguredForm implements ConfiguresForm
{
	public function configureForm(Form $form, Aire $aire) : void
	{
		$form->action(url('/demo'))
			->method('delete')
			->addClass('test-class');
	}
	
	public function formFields(Aire $aire) : array
	{
		return [
			$aire->date('date_field'),
			$aire->password('password_field'),
			$aire->submit('Submit Custom Form'),
		];
	}
}
