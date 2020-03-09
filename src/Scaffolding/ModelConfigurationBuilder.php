<?php

namespace Galahad\Aire\Scaffolding;

use Barryvdh\Reflection\DocBlock;
use Closure;
use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\ConfiguresForm;
use Galahad\Aire\Elements\Button;
use Galahad\Aire\Elements\Checkbox;
use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Form;
use Galahad\Aire\Elements\Input;
use Galahad\Aire\Elements\Select;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;

class ModelConfigurationBuilder extends ConfigurationBuilder implements ConfiguresForm
{
	/**
	 * @var \Illuminate\Database\Eloquent\Model
	 */
	protected $model;
	
	/**
	 * @var \ReflectionClass
	 */
	protected $reflection;
	
	/**
	 * @var \Illuminate\Contracts\Routing\UrlGenerator
	 */
	protected $url;
	
	public static function inferRoute(Model $model, $resource_name = null, $prepend_parameters = []) : array
	{
		if (null === $resource_name) {
			$resource_name = Str::kebab(Str::plural($model->getTable()));
		}
		
		if ($model->exists) {
			$parameters = (array) $prepend_parameters;
			$parameters[] = $model;
			
			return [
				'name' => "{$resource_name}.update",
				'parameters' => $parameters,
				'method' => 'PUT',
			];
		}
		
		return [
			'name' => "{$resource_name}.store",
			'parameters' => $prepend_parameters,
			'method' => 'POST',
		];
	}
	
	public function __construct(Aire $aire, UrlGenerator $url_generator, Model $model)
	{
		parent::__construct($aire, []);
		
		$this->url = $url_generator;
		
		$this->model = $model;
		$this->reflection = new ReflectionClass($model);
	}
	
	public function configureForm(Form $form, Aire $aire) : void
	{
		$route_config = static::inferRoute($this->model);
		
		$form->action($this->url->route($route_config['name'], $route_config['parameters']));
		$form->method($route_config['method']);
		
		$form->bind($this->model);
	}
	
	public function buildElements() : Collection
	{
		if (empty($this->fields_config)) {
			$this->fields_config = $this->formFields($this->aire);
		}
		
		return parent::buildElements()->sortBy($this->sortingMethod());
	}
	
	public function formFields(Aire $aire) : array
	{
		// We'll load the fields from $casts, $dates, @property annotations
		// and a $form_config property (if it exists) and merge them together.
		// We'll also filter out NULL and FALSE values, letting you
		// explicitly remove a field by simply setting its configuration to false.
		return $this->inferDates()
			->merge($this->inferCasts())
			->merge($this->inferDocBlocks())
			->merge($this->loadConfigurationAttribute())
			->merge($this->loadMagicMethods())
			->merge($this->buildSubmitButton())
			->map(function($element_config, $element_name) {
				// Look for configure[Attribute]FormField on the model and use that
				// if it exists. This lets the end user apply special configuration logic
				// on a field-by-field basis without having to add any other boilerplate.
				$method_name = 'configure'.Str::studly($element_name).'FormField';
				if (method_exists($this->model, $method_name)) {
					return $this->model->$method_name($this->aire, $element_config);
				}
				
				return $element_config;
			})
			->filter()
			->toArray();
	}
	
	protected function sortingMethod() : Closure
	{
		$configured_order = $this->model->form_order ?? $this->model->formOrder ?? null;
		
		return function(Element $element, $name) use ($configured_order) {
			// If the order is defined and this element is in it, use that
			if ($configured_order) {
				$position = array_search($name, $configured_order);
				if (false !== $position) {
					return $position;
				}
			}
			
			// This applies some (relatively arbitrary) sorting logic if none is supplied
			if ($element instanceof Input) {
				switch ($element->attributes->get('type')) {
					case 'search':
						return 100;
					
					case 'email':
						return 200;
					
					case 'password':
						return 300;
					
					case 'text':
						return 350;
					
					case 'tel':
					case 'url':
					case 'number':
						return 400;
					
					case 'file':
						return 500;
					
					case 'month':
					case 'week':
					case 'date':
					case 'datetime':
					case 'datetime-local':
					case 'time':
						return 800;
					
					case 'image':
					case 'button':
					case 'submit':
						return PHP_INT_MAX;
				}
			}
			
			if ($element instanceof Select) {
				return 600;
			}
			
			if ($element instanceof Checkbox) {
				return 700;
			}
			
			if ($element instanceof Button) {
				return PHP_INT_MAX;
			}
			
			return 900;
		};
	}
	
	protected function buildElement(string $field_name, string $element_name) : Element
	{
		$element = parent::buildElement($field_name, $element_name);
		
		// Allow for overriding the label via get[Attribute]FormLabl
		$label_method = 'get'.Str::studly($field_name).'FormLabel';
		if (method_exists($this->model, $label_method)) {
			$element->label($this->model->$label_method());
		}
		
		return $element;
	}
	
	/**
	 * Infer form fields based on the Model's $casts property
	 *
	 * @return \Illuminate\Support\Collection
	 * @throws \ReflectionException
	 */
	protected function inferCasts() : Collection
	{
		$casts = $this->reflection->getProperty('casts');
		$casts->setAccessible(true);
		
		return Collection::make($casts->getValue($this->model))
			->mapWithKeys(function($cast, $attribute) {
				return [$attribute => $this->convertCastToElementName($cast)];
			});
	}
	
	/**
	 * Infer form fields based on the Model's $dates property
	 *
	 * @return \Illuminate\Support\Collection
	 * @throws \ReflectionException
	 */
	protected function inferDates() : Collection
	{
		$dates = $this->reflection->getProperty('dates');
		$dates->setAccessible(true);
		
		return Collection::make($dates->getValue($this->model))
			->mapWithKeys(function($attribute) {
				return [$attribute => 'datetime-local'];
			});
	}
	
	/**
	 * Infer form fields based on @propery docblock annotations
	 *
	 * @return \Illuminate\Support\Collection
	 */
	protected function inferDocBlocks() : Collection
	{
		$doc = new DocBlock($this->reflection);
		
		return Collection::make($doc->getTagsByName('property'))
			->mapWithKeys(function(DocBlock\Tag\PropertyTag $tag) {
				$attribute = ltrim($tag->getVariableName(), '$');
				$element_name = $this->convertTypeHintToElementName($tag->getType());
				
				return [$attribute => $element_name];
			});
	}
	
	/**
	 * Load the model's $form_config (or $formConfig) property if one exists
	 *
	 * @return \Illuminate\Support\Collection
	 */
	protected function loadConfigurationAttribute() : Collection
	{
		return Collection::make($this->model->form_config ?? $this->model->formConfig ?? []);
	}
	
	/**
	 * Load any field configuration method and add that field to the list to be configured
	 *
	 * @return \Illuminate\Support\Collection
	 */
	protected function loadMagicMethods() : Collection
	{
		return Collection::make($this->reflection->getMethods(ReflectionMethod::IS_PUBLIC))
			->mapWithKeys(function(ReflectionMethod $method) {
				$name = $method->getName();
				
				if (preg_match('/^configure(.*)FormField$/', $name, $matches)) {
					// We'll call the method later, so we just need to push it into our collection
					// for now and let configuration happen later
					$name = Str::snake($matches[1]);
				}
				
				return [$name => null];
			});
	}
	
	protected function buildSubmitButton() : Collection
	{
		$key = 'submit_'.Str::kebab($this->model->getTable());
		
		$resource_name = Str::title(Str::singular(str_replace('_', ' ', $this->model->getTable())));
		
		$label = $this->model->exists
			? "Save Changes to {$resource_name}"
			: "Create New {$resource_name}";
		
		return Collection::make([
			$key => $this->aire->submit($label),
		]);
	}
	
	/**
	 * Convert a valid $cast value to a valid element configuration name
	 *
	 * @param string $cast
	 * @return string
	 */
	protected function convertCastToElementName(string $cast) : string
	{
		// integer, real, float, double, decimal:<digits>, string, boolean, object, array, collection, date, datetime, and timestamp
		
		if (0 === stripos($cast, 'decimal:')) {
			$cast = 'decimal';
		}
		
		switch ($cast) {
			case 'int':
			case 'integer':
			case 'real':
			case 'decimal':
			case 'float':
				return 'number';
			
			case 'bool':
			case 'boolean':
				return 'checkbox';
			
			case 'datetime':
			case 'timestamp':
				return 'datetime-local';
			
			case 'date':
				return 'date';
			
			case 'string':
			default:
				return 'text';
		}
	}
	
	/**
	 * Convert a valid PHP type hint to a valid element configuration name
	 *
	 * @param string $type_hint
	 * @return string
	 */
	protected function convertTypeHintToElementName(string $type_hint) : string
	{
		// string, int or integer, float, bool or boolean, array, resource, null, callable, mixed, void, object, false or true, self, static, $this
		// Needs to handle type[] notation
		// Needs to handle multiple|types
		
		switch ($type_hint) {
			case 'int':
			case 'integer':
			case 'float':
				return 'number';
			
			case 'bool':
			case 'boolean':
				return 'checkbox';
			
			case 'string':
			default:
				return 'text';
		}
	}
}
