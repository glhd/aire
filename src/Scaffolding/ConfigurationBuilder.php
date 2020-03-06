<?php

namespace Galahad\Aire\Scaffolding;

use Closure;
use Galahad\Aire\Aire;
use Galahad\Aire\Elements\Button;
use Galahad\Aire\Elements\Checkbox;
use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Input;
use Galahad\Aire\Elements\Select;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ConfigurationBuilder implements Htmlable
{
	/**
	 * @var \Galahad\Aire\Aire
	 */
	protected $aire;
	
	/**
	 * @var array
	 */
	protected $fields_config;
	
	public function __construct(Aire $aire, array $fields_config)
	{
		$this->aire = $aire;
		$this->fields_config = $fields_config;
	}
	
	/**
	 * This takes a field config of mixed format and normalizes it down
	 * to an array of Aire elements.
	 *
	 * @param array $fields_config
	 * @return Collection
	 */
	public function buildElements() : Collection
	{
		$elements = Collection::make($this->fields_config)
			->map(function($element_config, $field_name) {
				// Strings will be build from pre-defined named configurations
				if (is_string($element_config)) {
					return $this->buildElement($field_name, $element_config);
				}
				
				// Closures should return an element
				if ($element_config instanceof Closure) {
					return $element_config();
				}
				
				// Otherwise assume it's already an element
				return $element_config;
			})
			->each(function($element) {
				if (!$element instanceof Element) {
					$invalid_type = gettype($element);
					throw new \InvalidArgumentException("A form field cannot be configured with a '{$invalid_type}'");
				}
			});
		
		$contains_submit_button = $elements->contains(function(Element $element) {
			return $element instanceof Button
				&& 'submit' === $element->attributes->get('type');
		});
		
		if (!$contains_submit_button) {
			$elements->push($this->aire->submit());
		}
		
		$elements = $elements->sortBy(function(Element $element) {
			// TODO: Make this configurable
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
		});
		
		return $elements;
	}
	
	public function toHtml() : string
	{
		return $this->buildElements()
			->map(function(Element $element) {
				return $element->toHtml();
			})
			->implode("\n");
	}
	
	protected function buildElement(string $field_name, string $element_name) : Element
	{
		$label = Str::title(str_replace('_', ' ', $field_name));
		
		switch ($element_name) {
			case 'number':
				return $this->aire->number($field_name, $label);
			
			case 'checkbox':
				return $this->aire->checkbox($field_name, $label);
			
			case 'datetime-local':
				return $this->aire->dateTimeLocal($field_name, $label);
			
			case 'date':
				return $this->aire->date($field_name, $label);
			
			case 'text':
			default:
				return $this->aire->input($field_name, $label);
		}
	}
}
