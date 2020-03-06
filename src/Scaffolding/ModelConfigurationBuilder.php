<?php

namespace Galahad\Aire\Scaffolding;

use Galahad\Aire\Aire;
use Galahad\Aire\Contracts\ConfiguresForm;
use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Form;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionClass;

class ModelConfigurationBuilder implements ConfiguresForm
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
	 * @var \Galahad\Aire\Aire
	 */
	protected $aire;
	
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
		$this->aire = $aire;
		$this->url = $url_generator;
		
		$this->model = $model;
		$this->reflection = new ReflectionClass($model);
	}
	
	public function configureForm(Form $form, Aire $aire) : void
	{
		$route_config = static::inferRoute($this->model);
		
		$form->action($this->url->route($route_config['name'], $route_config['parameters']));
		$form->method($route_config['method']);
	}
	
	public function formFields(Aire $aire) : array
	{
		$fields = $this->inferCasts()
			->merge($this->inferDates())
			->merge($this->inferDocBlocks())
			->merge($this->loadConfigurationAttribute());
		
		// FIXME: How can fields be removed
		
		return $fields;
	}
	
	protected function inferCasts() : Collection
	{
		$casts = $this->reflection->getProperty('casts');
		$casts->setAccessible(true);
		
		return Collection::make($casts->getValue($this->model))
			->keys()
			->map(function($key) {
				return Str::snake($key);
			});
	}
	
	protected function inferDates() : Collection
	{
		$dates = $this->reflection->getProperty('dates');
		$dates->setAccessible(true);
		
		return Collection::make($dates->getValue($this->model))
			->map(function($key) {
				return Str::snake($key);
			});
	}
	
	protected function inferDocBlocks() : Collection
	{
		return Collection::make();
	}
	
	protected function loadConfigurationAttribute() : Collection
	{
		return Collection::make($this->model->form_config ?? []);
	}
	
	protected function castToElement(string $name, string $cast) : Element
	{
		// FIXME: Label needs to be configurable
		// FIXME: in general :)
		
		return $this->aire->input($name, Str::title(str_replace('_', ' ', $name)));
	}
}
