<?php

namespace Galahad\Aire\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Galahad\Aire\Aire setTheme($namespace = NULL, $prefix = NULL)
 * @method static \Galahad\Aire\Elements\Form form($action = NULL, $bound_data = NULL)
 * @method static \Galahad\Aire\Elements\Form open($action = NULL, $bound_data = NULL)
 * @method static mixed config(string $key, $default = NULL)
 * @method static \Galahad\Aire\Elements\Form bind($bound_data)
 * @method static \Galahad\Aire\Elements\Form close()
 * @method static \Galahad\Aire\Elements\Button openButton()
 * @method static \Galahad\Aire\Elements\Button closeButton()
 * @method static \Galahad\Aire\Elements\Form route(string $route_name, $parameters = [], bool $absolute = true)
 * @method static \Galahad\Aire\Elements\Form get()
 * @method static \Galahad\Aire\Elements\Form post()
 * @method static \Galahad\Aire\Elements\Form put()
 * @method static \Galahad\Aire\Elements\Form patch()
 * @method static \Galahad\Aire\Elements\Form delete()
 * @method static \Galahad\Aire\Elements\Button button(string $label = NULL)
 * @method static \Galahad\Aire\Elements\Button submit(string $label = 'Submit')
 * @method static \Galahad\Aire\Elements\Input input($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Select select(array $options, $name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Textarea textArea($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\Summary summary()
 * @method static \Galahad\Aire\Elements\Checkbox checkbox($name = NULL, $label = NULL)
 * @method static \Galahad\Aire\Elements\CheckboxGroup checkboxGroup($name, array $options, $label = NULL)
 * @method static \Galahad\Aire\Elements\RadioGroup radioGroup($name, array $options, $label = NULL)
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
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'galahad.aire';
	}
}
