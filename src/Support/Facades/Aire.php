<?php

namespace Galahad\Aire\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Galahad\Aire\Aire setTheme(string $namespace = NULL, string $prefix = NULL, array $config = [])
 * @method static \Galahad\Aire\Aire resetTheme()
 * @method static string applyTheme(string $view)
 * @method static \Galahad\Aire\Aire setIdGenerator(\Closure $id_generator)
 * @method static \Galahad\Aire\Elements\Form form($action = NULL, $bound_data = NULL)
 * @method static \Galahad\Aire\Elements\Form open($action = NULL, $bound_data = NULL)
 * @method static \Galahad\Aire\Elements\Form close()
 * @method static bool isOpened()
 * @method static \Galahad\Aire\Elements\Form route(string $route_name, $parameters = [], bool $absolute = true)
 * @method static \Galahad\Aire\Elements\Form resourceful(\Illuminate\Database\Eloquent\Model $model, $resource_name = null, $prepend_parameters = [])
 * @method static mixed config(string $key, $default = NULL)
 * @method static mixed getBoundValue(string $name, $default = NULL)
 * @method static \Galahad\Aire\Elements\Label label(string $label)
 * @method static \Galahad\Aire\Elements\Button button(string $label = NULL)
 * @method static \Galahad\Aire\Elements\Button submit(string $label = 'Submit')
 * @method static \Galahad\Aire\Elements\Input input($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Select select(array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable|string $options, $name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Select timezoneSelect($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\Textarea textArea($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Summary summary()
 * @method static \Galahad\Aire\Elements\Checkbox checkbox($name = null, $label = null)
 * @method static \Galahad\Aire\Elements\CheckboxGroup checkboxGroup(array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable|string $options, $name, $label = NULL)
 * @method static \Galahad\Aire\Elements\RadioGroup radioGroup(array|\Illuminate\Support\Collection|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Contracts\Support\Jsonable|\JsonSerializable|\Traversable|string $options, $name, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input hidden($name = NULL, $value = NULL)
 * @method static \Galahad\Aire\Elements\Input color($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input date($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input dateTime($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input dateTimeLocal($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input email($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input file($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input image($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input month($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input number($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input password($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input range($name = NULL, $label = NULL, $min = 0, $max = 100)
 * @method static \Galahad\Aire\Elements\Input search($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input tel($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input time($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input url($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Input week($name = NULL, $label = NULL)
 */
class Aire extends Facade
{
	/**
	 * @return \Galahad\Aire\Aire
	 */
	public static function getFacadeRoot()
	{
		return parent::getFacadeRoot();
	}
	
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'galahad.aire';
	}
}
